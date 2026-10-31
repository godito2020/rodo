<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hoja de Reclamación {{ $claim->claim_number }} - RODOPERU S.A.C.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #111;
            background-color: #f8f9fa;
        }
        .sheet-container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 30px;
            border: 2px solid #000;
        }
        .header-title {
            text-align: center;
            font-weight: bold;
            font-size: 15px;
            text-transform: uppercase;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 12px;
        }
        .section-header {
            background-color: #e9ecef;
            border: 1px solid #000;
            font-weight: bold;
            font-size: 11px;
            padding: 4px 8px;
            margin-top: 10px;
            text-transform: uppercase;
        }
        .table-data {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        .table-data td, .table-data th {
            border: 1px solid #000;
            padding: 5px 8px;
            vertical-align: top;
        }
        .table-data th {
            background-color: #f8f9fa;
            width: 25%;
            font-weight: bold;
        }
        @media print {
            body { background: #fff; }
            .no-print { display: none !important; }
            .sheet-container { border: 1px solid #000; margin: 0; padding: 15px; max-width: 100%; }
        }
    </style>
</head>
<body>

    <div class="no-print text-center py-3 bg-dark text-white mb-3">
        <button onclick="window.print()" class="btn btn-warning btn-sm fw-bold me-2">
            <i class="fas fa-print me-1"></i> Imprimir / Guardar como PDF
        </button>
        <button onclick="window.close()" class="btn btn-secondary btn-sm">Cerrar</button>
    </div>

    <div class="sheet-container">
        
        <!-- Header -->
        <div class="row align-items-center mb-2">
            <div class="col-8">
                <h4 class="fw-bold mb-0 text-uppercase">RODOPERU S.A.C.</h4>
                <div><strong>RUC:</strong> {{ $companyRuc }}</div>
                <div><strong>Dirección:</strong> {{ $companyAddress }}</div>
                <div><strong>Canal de Venta:</strong> Comercio Electrónico / Plataforma Web</div>
            </div>
            <div class="col-4 text-end">
                <div class="border border-2 border-dark p-2 text-center bg-light">
                    <div class="small fw-bold">LIBRO DE RECLAMACIONES</div>
                    <div class="small text-muted">HOJA DE RECLAMACIÓN</div>
                    <div class="fs-6 fw-bold text-danger mt-1">{{ $claim->claim_number }}</div>
                    <div class="small text-muted">{{ $claim->created_at->format('d/m/Y H:i:s') }}</div>
                </div>
            </div>
        </div>

        <div class="header-title">
            Libro de Reclamaciones Virtual - D.S. N° 011-2011-PCM / Ley N° 29571
        </div>

        <!-- 1. Identificación del Consumidor -->
        <div class="section-header">1. Identificación del Consumidor Reclamante</div>
        <table class="table-data">
            <tr>
                <th>Nombre Completo:</th>
                <td colspan="3"><strong>{{ $claim->full_name }}</strong></td>
            </tr>
            <tr>
                <th>Documento de Identidad:</th>
                <td>{{ $claim->doc_type }}: {{ $claim->doc_number }}</td>
                <th>Teléfono / Celular:</th>
                <td>{{ $claim->phone }}</td>
            </tr>
            <tr>
                <th>Correo Electrónico:</th>
                <td colspan="3">{{ $claim->email }}</td>
            </tr>
            <tr>
                <th>Domicilio / Dirección:</th>
                <td colspan="3">{{ $claim->address }} {{ $claim->district ? "({$claim->district}, {$claim->province}, {$claim->department})" : '' }}</td>
            </tr>
            @if($claim->is_minor)
            <tr>
                <th>Padre / Apoderado (Menor de edad):</th>
                <td colspan="3">{{ $claim->guardian_name }} (Doc: {{ $claim->guardian_doc }})</td>
            </tr>
            @endif
        </table>

        <!-- 2. Identificación del Bien Contratado -->
        <div class="section-header">2. Identificación del Bien Contratado</div>
        <table class="table-data">
            <tr>
                <th>Tipo de Bien:</th>
                <td><strong>{{ strtoupper($claim->contracted_type) }}</strong></td>
                <th>Monto Reclamado:</th>
                <td>{{ $claim->claimed_amount ? $claim->currency . ' ' . number_format((float)$claim->claimed_amount, 2) : 'No especificado' }}</td>
            </tr>
            <tr>
                <th>Descripción del Producto / Servicio:</th>
                <td colspan="3">{{ $claim->product_description }}</td>
            </tr>
        </table>

        <!-- 3. Detalle de la Reclamación -->
        <div class="section-header">3. Detalle de la Reclamación y Pedido del Consumidor</div>
        <table class="table-data">
            <tr>
                <th>Tipo de Reclamación:</th>
                <td colspan="3">
                    <span class="badge bg-dark text-white px-3 py-1 fs-6">
                        {{ strtoupper($claim->claim_type) }}
                    </span>
                    <span class="ms-2 text-muted small">
                        ({{ $claim->claim_type === 'reclamo' ? 'Disconformidad relacionada a los productos o servicios adquiridos' : 'Malestar o descontento respecto a la atención al público' }})
                    </span>
                </td>
            </tr>
            <tr>
                <th>Detalle de los Hechos:</th>
                <td colspan="3" style="min-height: 80px; white-space: pre-wrap;">{{ $claim->details }}</td>
            </tr>
            <tr>
                <th>Pedido Concreto:</th>
                <td colspan="3" style="white-space: pre-wrap;"><strong>{{ $claim->consumer_request }}</strong></td>
            </tr>
        </table>

        <!-- 4. Acciones Adoptadas por el Proveedor -->
        <div class="section-header">4. Observaciones y Acciones Adoptadas por el Proveedor</div>
        <table class="table-data">
            <tr>
                <th>Estado de Atención:</th>
                <td><strong>{{ strtoupper($claim->status) }}</strong></td>
                <th>Fecha de Respuesta:</th>
                <td>{{ $claim->responded_at ? $claim->responded_at->format('d/m/Y H:i') : 'En plazo legal de evaluación (15 días hábiles)' }}</td>
            </tr>
            <tr>
                <th>Respuesta Oficial de la Empresa:</th>
                <td colspan="3" style="min-height: 60px; white-space: pre-wrap;">{{ $claim->response_text ?: 'Requerimiento en proceso de investigación y evaluación técnica según Ley N° 29571.' }}</td>
            </tr>
        </table>

        <!-- Signatures / Footer Legal -->
        <div class="row mt-4 pt-3 text-center">
            <div class="col-6">
                <div class="border-top border-dark mx-4 pt-1">
                    <strong>Firma / Aceptación Virtual del Consumidor</strong><br>
                    <small class="text-muted">Conforme al Art. 4° del D.S. N° 011-2011-PCM</small>
                </div>
            </div>
            <div class="col-6">
                <div class="border-top border-dark mx-4 pt-1">
                    <strong>RODOPERU S.A.C.</strong><br>
                    <small class="text-muted">RUC 20601234567</small>
                </div>
            </div>
        </div>

        <div class="mt-4 pt-2 border-top border-secondary text-muted" style="font-size: 9px; line-height: 1.3;">
            * <strong>RECLAMO:</strong> Disconformidad relacionada a los bienes o servicios. * <strong>QUEJA:</strong> Malestar o descontento respecto a la atención al público.<br>
            * De conformidad con el D.S. N° 011-2011-PCM y D.S. N° 101-2022-PCM, el proveedor deberá dar respuesta al reclamo en un plazo no mayor a 15 (quince) días hábiles.<br>
            * La formulación del reclamo no impide acudir a otras vías de solución de controversias ni es requisito previo para interponer una denuncia ante el <strong>INDECOPI</strong>.
        </div>

    </div>

</body>
</html>
