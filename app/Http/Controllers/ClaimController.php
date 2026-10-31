<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class ClaimController extends Controller
{
    public function index()
    {
        $companyName = Setting::get('site_name', 'RODOPERU S.A.C.');
        $companyAddress = Setting::get('company_address', 'Av. Nicolas Ayllon 2925 el Agustino - Lima');
        $companyRuc = '20601234567';
        $companyPhone = Setting::get('company_phone', '+51 953 501 762');
        $companyEmail = Setting::get('support_email', 'ventas@rodoperu.com.pe');

        return view('frontend.pages.libro_reclamaciones', compact(
            'companyName',
            'companyAddress',
            'companyRuc',
            'companyPhone',
            'companyEmail'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:150',
            'doc_type' => 'required|in:DNI,CE,RUC,Pasaporte',
            'doc_number' => 'required|string|max:30',
            'phone' => 'required|string|max:30',
            'email' => 'required|email|max:150',
            'address' => 'required|string|max:255',
            'department' => 'nullable|string|max:100',
            'province' => 'nullable|string|max:100',
            'district' => 'nullable|string|max:100',
            'is_minor' => 'nullable|boolean',
            'guardian_name' => 'nullable|string|max:150',
            'guardian_doc' => 'nullable|string|max:30',
            'contracted_type' => 'required|in:producto,servicio',
            'claimed_amount' => 'nullable|numeric|min:0',
            'currency' => 'required|in:USD,PEN',
            'product_description' => 'required|string|max:2000',
            'claim_type' => 'required|in:reclamo,queja',
            'details' => 'required|string|max:4000',
            'consumer_request' => 'required|string|max:2000',
            'terms_accepted' => 'required|accepted',
        ], [
            'full_name.required' => 'Ingresa tu nombre y apellido completo.',
            'doc_number.required' => 'Ingresa el número de tu documento de identidad.',
            'phone.required' => 'Ingresa un número telefónico o celular de contacto.',
            'email.required' => 'Ingresa un correo electrónico válido para recibir tu constancia.',
            'address.required' => 'Ingresa tu domicilio o dirección de contacto.',
            'product_description.required' => 'Describe el bien contratado o servicio adquirido.',
            'details.required' => 'Detalla los hechos materia del reclamo o queja.',
            'consumer_request.required' => 'Especifica el pedido concreto que solicitas a la empresa.',
            'terms_accepted.required' => 'Debes confirmar la veracidad de la información según Ley N° 29571.',
        ]);

        if (!Schema::hasTable('claims')) {
            try {
                Artisan::call('migrate', ['--force' => true]);
            } catch (\Throwable $e) {
                Log::error("Auto-migrate claims before store failed: " . $e->getMessage());
            }
        }

        $validated['claim_number'] = Claim::generateClaimNumber();
        $validated['is_minor'] = $request->boolean('is_minor');
        $validated['ip_address'] = $request->ip();
        $validated['status'] = 'pendiente';

        $claim = Claim::create($validated);

        // Send email confirmation
        try {
            $fromAddress = Setting::get('smtp_from_address', config('mail.from.address', 'notificaciones@rodoperu.com.pe'));
            $fromName = Setting::get('smtp_from_name', config('mail.from.name', 'RODOPERU'));
            $companyEmail = Setting::get('support_email', 'ventas@rodoperu.com.pe');

            $mailSubject = "Constancia de Reclamación Virtual {$claim->claim_number} - RODOPERU S.A.C.";
            $mailBody = "Estimado(a) {$claim->full_name},\n\n" .
                "Confirmamos el registro de su " . strtoupper($claim->claim_type) . " en nuestro Libro de Reclamaciones Virtual de acuerdo con la Ley N° 29571 (Código de Protección y Defensa del Consumidor) y el D.S. N° 011-2011-PCM.\n\n" .
                "DATOS DE LA HOJA DE RECLAMACIÓN:\n" .
                "Número Correlativo: {$claim->claim_number}\n" .
                "Fecha de Registro: " . $claim->created_at->format('d/m/Y H:i:s') . "\n" .
                "Tipo: " . strtoupper($claim->claim_type) . "\n" .
                "Bien Contratado: " . ucfirst($claim->contracted_type) . " - {$claim->product_description}\n" .
                "Monto Reclamado: {$claim->currency} " . number_format((float)$claim->claimed_amount, 2) . "\n" .
                "Detalle: {$claim->details}\n" .
                "Pedido Concreto: {$claim->consumer_request}\n\n" .
                "PLAZO LEGAL DE ATENCIÓN:\n" .
                "De conformidad con la normativa del INDECOPI, daremos respuesta a su requerimiento en un plazo máximo de 15 días hábiles a la dirección de correo electrónico consignada.\n\n" .
                "Atentamente,\n" .
                "Área de Atención al Cliente y Gestión de Reclamos\n" .
                "RODOPERU S.A.C. - RUC 20601234567\n" .
                Setting::get('company_address', 'Av. Nicolas Ayllon 2925 el Agustino - Lima') . "\n" .
                "Central: " . Setting::get('company_phone', '+51 953 501 762');

            // Send to customer
            Mail::raw($mailBody, function ($message) use ($claim, $fromAddress, $fromName, $mailSubject) {
                $message->to($claim->email)
                    ->from($fromAddress, $fromName)
                    ->subject($mailSubject);
            });

            // Send notification to company
            Mail::raw("Se ha registrado una nueva hoja de reclamación en el sistema:\n\n" . $mailBody, function ($message) use ($companyEmail, $fromAddress, $fromName, $claim) {
                $message->to($companyEmail)
                    ->from($fromAddress, $fromName)
                    ->subject("ALERTA NUEVO RECLAMO: {$claim->claim_number} - {$claim->full_name}");
            });
        } catch (\Throwable $e) {
            Log::error("Error enviando email de reclamación {$claim->claim_number}: " . $e->getMessage());
        }

        return redirect()->route('libro_reclamaciones.constancia', $claim->claim_number)
            ->with('success', 'Tu reclamación ha sido registrada exitosamente con código ' . $claim->claim_number);
    }

    public function constancia($claimNumber)
    {
        $claim = Claim::where('claim_number', $claimNumber)->firstOrFail();
        $companyName = Setting::get('site_name', 'RODOPERU S.A.C.');
        $companyAddress = Setting::get('company_address', 'Av. Nicolas Ayllon 2925 el Agustino - Lima');
        $companyRuc = '20601234567';
        $companyPhone = Setting::get('company_phone', '+51 953 501 762');
        $companyEmail = Setting::get('support_email', 'ventas@rodoperu.com.pe');

        return view('frontend.pages.libro_reclamaciones_constancia', compact(
            'claim',
            'companyName',
            'companyAddress',
            'companyRuc',
            'companyPhone',
            'companyEmail'
        ));
    }

    public function printHoja($claimNumber)
    {
        $claim = Claim::where('claim_number', $claimNumber)->firstOrFail();
        $companyName = Setting::get('site_name', 'RODOPERU S.A.C.');
        $companyAddress = Setting::get('company_address', 'Av. Nicolas Ayllon 2925 el Agustino - Lima');
        $companyRuc = '20601234567';
        $companyPhone = Setting::get('company_phone', '+51 953 501 762');
        $companyEmail = Setting::get('support_email', 'ventas@rodoperu.com.pe');

        return view('frontend.pages.libro_reclamaciones_print', compact(
            'claim',
            'companyName',
            'companyAddress',
            'companyRuc',
            'companyPhone',
            'companyEmail'
        ));
    }
}
