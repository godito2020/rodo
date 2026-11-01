<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Models\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminClaimController extends Controller
{
    public function index(Request $request)
    {
        // 1. Auto-check and auto-migrate claims table if missing on hosting
        if (!Schema::hasTable('claims')) {
            try {
                Artisan::call('migrate', ['--force' => true]);
            } catch (\Throwable $e) {
                Log::error("Auto-migrate claims failed: " . $e->getMessage());
            }
        }

        // 2. If table is still missing, gracefully show setup screen instead of crashing with 500
        if (!Schema::hasTable('claims')) {
            $claims = new LengthAwarePaginator([], 0, 15);
            $pendingCount = 0;
            $inProcessCount = 0;
            $resolvedCount = 0;
            $tableNotReady = true;

            return view('admin.claims.index', compact(
                'claims',
                'pendingCount',
                'inProcessCount',
                'resolvedCount',
                'tableNotReady'
            ));
        }

        try {
            $query = Claim::query()->orderBy('created_at', 'desc');

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('claim_type')) {
                $query->where('claim_type', $request->claim_type);
            }

            if ($request->filled('q')) {
                $search = $request->q;
                $query->where(function ($q) use ($search) {
                    $q->where('claim_number', 'LIKE', "%{$search}%")
                      ->orWhere('full_name', 'LIKE', "%{$search}%")
                      ->orWhere('doc_number', 'LIKE', "%{$search}%")
                      ->orWhere('email', 'LIKE', "%{$search}%");
                });
            }

            $claims = $query->paginate(15)->withQueryString();

            $pendingCount = Claim::where('status', 'pendiente')->count();
            $inProcessCount = Claim::where('status', 'en_proceso')->count();
            $resolvedCount = Claim::where('status', 'atendido')->count();
            $tableNotReady = false;
        } catch (\Throwable $e) {
            Log::error("Error loading claims in AdminClaimController: " . $e->getMessage());
            $claims = new LengthAwarePaginator([], 0, 15);
            $pendingCount = 0;
            $inProcessCount = 0;
            $resolvedCount = 0;
            $tableNotReady = true;
        }

        return view('admin.claims.index', compact(
            'claims',
            'pendingCount',
            'inProcessCount',
            'resolvedCount',
            'tableNotReady'
        ));
    }

    public function initTable()
    {
        try {
            Artisan::call('migrate', ['--force' => true]);
            return back()->with('success', '¡Tabla de reclamaciones inicializada exitosamente en la base de datos!');
        } catch (\Throwable $e) {
            return back()->with('error', 'Error al ejecutar migración: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $claim = Claim::findOrFail($id);
        return view('admin.claims.show', compact('claim'));
    }

    public function updateStatus(Request $request, $id)
    {
        $claim = Claim::findOrFail($id);

        $request->validate([
            'status' => 'required|in:pendiente,en_proceso,atendido',
            'admin_notes' => 'nullable|string',
            'response_text' => 'nullable|string',
            'send_email' => 'nullable|boolean',
        ]);

        $claim->status = $request->status;
        $claim->admin_notes = $request->admin_notes;

        if ($request->filled('response_text')) {
            $claim->response_text = $request->response_text;
            if (!$claim->responded_at) {
                $claim->responded_at = now();
            }
        }

        $claim->save();

        if ($request->boolean('send_email') && $request->filled('response_text')) {
            try {
                $fromAddress = Setting::get('smtp_from_address', config('mail.from.address', 'ventas@rodoperu.com.pe'));
                $fromName = Setting::get('smtp_from_name', config('mail.from.name', 'RODOPERU'));

                $mailSubject = "Respuesta Formal a Hoja de Reclamación {$claim->claim_number} - RODOPERU S.A.C.";
                $mailBody = "Estimado(a) {$claim->full_name},\n\n" .
                    "Nos dirigimos a usted en relación a su " . strtoupper($claim->claim_type) . " registrado bajo el código correlativo {$claim->claim_number} con fecha " . $claim->created_at->format('d/m/Y') . ".\n\n" .
                    "RESPUESTA DE LA EMPRESA:\n" .
                    "--------------------------------------------------\n" .
                    $claim->response_text . "\n" .
                    "--------------------------------------------------\n\n" .
                    "En cumplimiento del Código de Protección y Defensa del Consumidor (Ley N° 29571) y los lineamientos del INDECOPI, quedamos a su entera disposición para cualquier aclaración o seguimiento.\n\n" .
                    "Atentamente,\n" .
                    "Dirección de Atención y Gestión de Reclamos\n" .
                    "RODOPERU S.A.C. - RUC " . Setting::get('company_ruc', '20616665589') . "\n" .
                    Setting::get('company_address', 'Av. Nicolas Ayllon 2925 el Agustino - Lima') . "\n" .
                    "Teléfono: " . Setting::get('company_phone', '+51 953 501 762');

                Mail::raw($mailBody, function ($message) use ($claim, $fromAddress, $fromName, $mailSubject) {
                    $message->to($claim->email)
                        ->from($fromAddress, $fromName)
                        ->subject($mailSubject);
                });

                return back()->with('success', 'Estado y respuesta guardados correctamente, y enviada copia por correo al consumidor.');
            } catch (\Throwable $e) {
                Log::error("Error enviando respuesta a {$claim->email}: " . $e->getMessage());
                return back()->with('success', 'Respuesta guardada pero ocurrió un error al enviar el email: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Estado de la reclamación actualizado exitosamente.');
    }

    public function print($id)
    {
        $claim = Claim::findOrFail($id);
        $companyName = Setting::get('site_name', 'RODOPERU S.A.C.');
        $companyAddress = Setting::get('company_address', 'Av. Nicolas Ayllon 2925 el Agustino - Lima');
        $companyRuc = Setting::get('company_ruc', '20616665589');
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
