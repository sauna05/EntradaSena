<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Listado de Competencias</x-slot:title>

    <style>
       .container {
        max-width: 950px;
        margin: 40px auto;
        background: #fff;
        padding: 30px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
        border-radius: 10px;
    }

        h1 {
            color: #2c3e50;
            font-weight: 600;
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #ecf0f1;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        thead {
            background-color: #3498db;
            color: #fff;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            vertical-align: top;
        }

        .badge {
            font-size: 0.9rem;
            padding: 0.4em 0.75em;
            border-radius: 8px;
            font-weight: 500;
            display: inline-block;
            margin: 3px;
        }

        .bg-primary {
            background-color: #3498db !important;
            color: white;
        }

        .bg-success {
            background-color: #2ecc71 !important;
            color: white;
        }

        .bg-danger {
            background-color: #e74c3c !important;
            color: white;
        }

        .text-muted {
            color: #7f8c8d !important;
        }
    </style>

    <div class="container">
        <h1 class="mb-4">Gestión de Ambientes</h1>

        <table>
            <thead>
                <tr>
                    <th>Ambiente</th>
                    <th>Rango de Programación</th>
                    <th>🕓 Horarios Programados</th>
                    <th>✅ Horarios Disponibles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ambientes as $ambiente)
                <tr>
                    <td><strong>{{ $ambiente->name }}</strong></td>
                    <td>
                        @if($ambiente->rango_fechas)
                            {{ \Carbon\Carbon::parse($ambiente->rango_fechas['inicio'])->format('d/m/Y') }}
                            -
                            {{ \Carbon\Carbon::parse($ambiente->rango_fechas['fin'])->format('d/m/Y') }}
                        @else
                            <span class="text-muted">Sin programación</span>
                        @endif
                    </td>
                    <td>
                        @if(!empty($ambiente->horas_programadas))
                            @foreach($ambiente->horas_programadas as $bloque)
                                <span class="badge bg-danger">{{ substr($bloque['start'], 0, 5) }} - {{ substr($bloque['end'], 0, 5) }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">No hay horarios ocupados</span>
                        @endif
                    </td>
                    <td>
                        @if(!empty($ambiente->horas_disponibles))
                            @foreach($ambiente->horas_disponibles as $bloque)
                                <span class="badge bg-success">{{ substr($bloque['start'], 0, 5) }} - {{ substr($bloque['end'], 0, 5) }}</span>
                            @endforeach
                        @else
                            <span class="text-muted">No hay bloques disponibles</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>
