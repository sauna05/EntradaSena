<x-layout>
    <x-slot:title>Gestión de Ambientes</x-slot:title>

    <style>
        .container {
            max-width: 1000px;
            margin: 30px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            vertical-align: top;
        }
        thead {
            background: #455661;
            color: white;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 5px;
            font-size: 0.85rem;
            display: inline-block;
            margin: 2px;
        }
        .bg-danger { background: #e74c3c; color: white; }
        .bg-success { background: #2ecc71; color: white; }
        .bg-light { background: #ecf0f1; color: #2c3e50; padding: 3px 5px; border-radius: 5px; display: inline-block; }
        select {
            padding: 6px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
            margin-right: 10px;
        }
    </style>

    <div class="container">
        <h1 style="text-align: center;">Gestión de Ambientes</h1>

        <div>
            <label for="filtroAmbiente"><strong>Filtrar por ambiente:</strong></label>
            <select id="filtroAmbiente" onchange="filtrarVista()">
                <option value="todos">Todos</option>
                @foreach($ambientes as $ambiente)
                    <option value="ambiente-{{ $ambiente->id }}">{{ $ambiente->name }}</option>
                @endforeach
            </select>

            <label for="filtroMes"><strong>Filtrar por mes:</strong></label>
            <select id="filtroMes" onchange="filtrarVista()">
                <option value="todos">Todos</option>
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ sprintf('%02d', $m) }}">{{ \Carbon\Carbon::create()->month($m)->format('F') }}</option>
                @endfor
            </select>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Ambiente</th>
                    <th>Rango</th>
                    <th>Programación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ambientes as $ambiente)
                <tr class="row-ambiente ambiente-{{ $ambiente->id }}">
                    <td><strong>{{ $ambiente->name }}</strong></td>
                    <td>
                        @if($ambiente->rango_fechas)
                            {{ \Carbon\Carbon::parse($ambiente->rango_fechas['inicio'])->format('d/m/Y') }} -
                            {{ \Carbon\Carbon::parse($ambiente->rango_fechas['fin'])->format('d/m/Y') }}
                        @else
                            <span class="text-muted">Sin programación</span>
                        @endif
                    </td>
                    <td>
                        @php
                            $programados = collect($ambiente->horas_programadas)->groupBy('fecha');
                            $disponibles = collect($ambiente->horas_disponibles)->keyBy('fecha');
                        @endphp

                        @forelse($programados as $fecha => $bloques)
                            <div class="bloque-fecha" data-mes="{{ \Carbon\Carbon::parse($fecha)->format('m') }}">
                                <div class="bg-light">
                                    <strong>{{ \Carbon\Carbon::parse($fecha)->translatedFormat('l d/m/Y') }}</strong>
                                </div>

                                <div>
                                    @foreach($bloques as $b)
                                        <div style="margin-bottom: 5px;">
                                            <span class="badge bg-danger">
                                                {{ substr($b['start'],0,5) }} - {{ substr($b['end'],0,5) }}
                                            </span>
                                            @if(isset($b['instructor']))
                                                <div style="font-size: 0.8rem; margin-top: 2px;">
                                                    Instructor: {{ $b['instructor'] }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    @if($disponibles->has($fecha))
                                        @foreach($disponibles[$fecha]['disponibles'] as $d)
                                            <span class="badge bg-success">{{ substr($d['start'],0,5) }} - {{ substr($d['end'],0,5) }}</span>
                                        @endforeach
                                    @else
                                        <span class="text-muted">No hay horas libres</span>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <span class="text-muted">Sin programación</span>
                        @endforelse
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function filtrarVista() {
            const ambiente = document.getElementById('filtroAmbiente').value;
            const mes = document.getElementById('filtroMes').value;

            // Mostrar/ocultar filas de ambiente
            document.querySelectorAll('.row-ambiente').forEach(row => {
                if (ambiente === 'todos' || row.classList.contains(ambiente)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Dentro de cada ambiente mostrado, filtrar bloques por mes
            document.querySelectorAll('.row-ambiente').forEach(row => {
                if (row.style.display !== 'none') {
                    row.querySelectorAll('.bloque-fecha').forEach(bloque => {
                        if (mes === 'todos' || bloque.dataset.mes === mes) {
                            bloque.style.display = '';
                        } else {
                            bloque.style.display = 'none';
                        }
                    });
                }
            });
        }
    </script>
</x-layout>
