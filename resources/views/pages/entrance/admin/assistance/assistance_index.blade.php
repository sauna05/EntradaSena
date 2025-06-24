<x-layout_asistencia>
    {{-- CSS --}}
    <x-slot:page_style></x-slot:page_style>
    {{-- Título --}}
    <x-slot:title>CAA</x-slot:title>
  
    {{-- Navbar --}}

   <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    <style>
    body {
        background-color: #f4f6f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .container {
        max-width: 100%;
        padding: 20px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
    }

    h3 {
        margin-top: 20px;
        color: #2c3e50;
    }

    .badge.bg-primary {
        background-color: #2e7d32;
        color: white;
        padding: 5px 10px;
        border-radius: 12px;
        font-size: 16px;
    }

    .form-select, .form-control, .input-group input, .input-group button {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 8px;
        font-size: 14px;
    }

    .form-select:focus, .form-control:focus {
        outline: none;
        border-color: #27ae60;
        box-shadow: 0 0 0 2px rgba(39, 174, 96, 0.2);
    }

    .form-check-input:checked {
        background-color: #2e7d32;
        border-color: #2ecc71;
    }

    .input-group button {
        background-color: #2e7d32;
        color: white;
        border: none;
        transition: background 0.3s;
    }

    .input-group button:hover {
        background-color: #2e7d32;
    }

    .table-container {
        overflow-x: auto;
        margin-top: 20px;
        border-radius: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
    }

    thead {
        background-color: #ecf0f1;
    }

    thead th {
        padding: 12px;
        text-align: left;
        color: #2c3e50;
        font-weight: bold;
    }

    tbody td {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .entrada-salida {
        display: flex;
        flex-direction: column;
        gap: 3px;
    }

    hr {
        margin: 5px 0;
        border: none;
        border-top: 1px solid #ccc;
    }

    .btn {
        background-color: #007bff;
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        text-decoration: none;
      
        display: inline-block;
    
    }

    .btn:hover {
        background-color: #1c271c;
    }

    .alert {
        margin-top: 20px;
        padding: 15px;
        border-radius: 10px;
        background-color: #fdf6e3;
        color: #7a5a00;
        font-weight: 500;
    }

    a {
        margin-right: 10px;
        color: #2ecc71;
        font-weight: bold;
        text-decoration: none;
    }

    a:hover {
        text-decoration: underline;
    }

    button {
        background-color: #2e7d32;
            color: #fff;
            border: none;
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 15px;
    }

    button:hover {
        background-color: #082916;
    }
</style>

<div class="container">
    {{-- Filtros dinámicos de fechas --}}
    @if (request('month'))
        Mes de {{ \Carbon\Carbon::parse(request('month'))->locale('es')->isoFormat('MMMM [de] YYYY') }}
    @elseif (!empty($filterAllAssist))
        Todas las asistencias
    @elseif (request('week'))
        @php [$start, $end] = explode('|', request('week')); @endphp
        Semana del {{ \Carbon\Carbon::parse($start)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($end)->format('d/m/Y') }}
    @elseif (request('filter_date'))
        {{ \Carbon\Carbon::parse(request('filter_date'))->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY') }}
    @else
        <span id="fechaActual"></span>
    @endif

    <button onclick="exportCleanedTableToExcel()">Exportar a Excel</button>

    <h3>Cantidad de Asistencias: 
        <span class="badge bg-primary">{{ count($formattedPersons) }}</span>
    </h3>

    <form method="GET" action="{{ route('entrance.assistance.index') }}" class="d-flex align-items-center flex-wrap gap-2 mt-3">
        <select name="position_id" class="form-select" onchange="this.form.submit()">
            <option value="">Todos los Cargos</option>
            @foreach ($positions as $position)
                <option value="{{ $position->id }}" {{ request('position_id') == $position->id ? 'selected' : '' }}>
                    {{ $position->name }}
                </option>
            @endforeach
        </select>

        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="toggleWeekFilter" {{ request('week') ? 'checked' : '' }}>
            <label class="form-check-label" for="toggleWeekFilter">Filtrar por semana</label>
        </div>

        <select id="weekSelect" name="week" class="form-select" onchange="this.form.submit()">
            <option value="">Filtrar por semana</option>
        </select>

        <select name="month" class="form-select" onchange="this.form.submit()">
            <option value="">Filtrar por mes</option>
            @foreach (range(1, 12) as $m)
                @php
                    $monthValue = now()->year . '-' . str_pad($m, 2, '0', STR_PAD_LEFT);
                    $monthLabel = \Carbon\Carbon::createFromDate(null, $m, 1)->locale('es')->isoFormat('MMMM');
                @endphp
                <option value="{{ $monthValue }}" {{ request('month') == $monthValue ? 'selected' : '' }}>
                    {{ ucfirst($monthLabel) }}
                </option>
            @endforeach
        </select>

        {{-- <a href="{{ route('entrance.assistance.all') }}">Todas las asistencias</a> --}}

      
        <label for="">Filtrar Por dia</label>
        <input type="date" name="filter_date" class="form-control"
            max="{{ now()->toDateString() }}" value="{{ request('filter_date', now()->toDateString()) }}"
            onchange="this.form.submit()">

        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar por nombre o documento"
                value="{{ request('search') }}">
            <button type="submit">Buscar</button>
        </div>
    </form>

    {{-- Tabla de Asistencias --}}
    @if (count($formattedPersons) === 0)
        <div class="alert text-center mt-4">
            @if (request('month'))
                No hay asistencias registradas para el mes de {{ \Carbon\Carbon::parse(request('month'))->locale('es')->isoFormat('MMMM [de] YYYY') }}.
            @elseif (request('week'))
                @php [$start, $end] = explode('|', request('week')); @endphp
                No hay asistencias registradas para la semana del {{ \Carbon\Carbon::parse($start)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($end)->format('d/m/Y') }}.
            @elseif (request('filter_date'))
                No hay asistencias registradas para el día {{ \Carbon\Carbon::parse(request('filter_date'))->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY') }}.
            @else
                Hoy no se han registrado asistencias.
            @endif
        </div>
    @else
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Cargo</th>
                        <th>Entrada y Salida</th>
                        <th>Tiempo en el centro</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($formattedPersons as $person)
                        <tr>
                            <td>{{ $person['document_number'] }}</td>
                            <td>{{ $person['name'] }}</td>
                            <td>{{ $person['position'] }}</td>
                            <td>
                                @foreach ($person['daily_data'] as $data)
                                    <div class="entrada-salida">
                                        <span>Entrada: {{ $data['entrada'] }}</span>
                                        <span>Salida: {{ $data['salida'] }}</span>
                                    </div>
                                    @if (!$loop->last)<hr>@endif
                                @endforeach
                            </td>
                            <td>{{ $person['total_time'] }}</td>
                            <td>{{ $data['date'] }}</td>
                            <td><a href="{{ route('entrance.assistance.show', $person['id']) }}" class="btn">Ver más</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

        
    {{-- Scripts --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fechaActualSpan = document.getElementById('fechaActual');
            const toggleWeekFilter = document.getElementById('toggleWeekFilter');
            const weekSelect = document.getElementById('weekSelect');
            const filterDate = document.querySelector('input[name="filter_date"]');
            const selectedWeek = @json(request('week'));

            function actualizarFechaHora() {
                const fechaHora = new Date();
                const opcionesFecha = { day: 'numeric', month: 'long', year: 'numeric' };
                const opcionesHora = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
                const fecha = fechaHora.toLocaleDateString('es-ES', opcionesFecha);
                const hora = fechaHora.toLocaleTimeString('es-ES', opcionesHora);
                if (fechaActualSpan) {
                    fechaActualSpan.textContent = `${fecha.replace(' de ', ' ').replace(' de ', ' del ')} - ${hora}`;
                }
            }
            actualizarFechaHora();
            setInterval(actualizarFechaHora, 1000);

        // Inicializar semana
        const now = new Date();
        const startOfWeek = new Date(now.setDate(now.getDate() - (now.getDay() + 6) % 7));
        for (let i = 0; i <= 10; i++) {
            const start = new Date(startOfWeek);
            start.setDate(start.getDate() - (7 * i));
            const end = new Date(start);
            end.setDate(start.getDate() + 6);
            const value = `${start.toISOString().split('T')[0]}|${end.toISOString().split('T')[0]}`;
            const label = `Semana del ${start.toLocaleDateString('es-CO')} al ${end.toLocaleDateString('es-CO')}`;
            const option = document.createElement('option');
            option.value = value;
            option.textContent = label;
            if (selectedWeek === value) option.selected = true;
            weekSelect.appendChild(option);
        }

        // Habilita/deshabilita select según checkbox
        toggleWeekFilter.addEventListener('change', function () {
            weekSelect.disabled = !this.checked;
            filterDate.disabled = this.checked;
            if (!this.checked) {
                weekSelect.value = '';
                weekSelect.form.submit(); // Quitar filtro
            }
        });

        // Estado inicial
        weekSelect.disabled = !toggleWeekFilter.checked;
        filterDate.disabled = toggleWeekFilter.checked;

        // Formatear fechas en la tabla
        const formatter = new Intl.DateTimeFormat('es-CO', {
            weekday: 'long', day: 'numeric', month: 'long', year: 'numeric'
        });
        document.querySelectorAll('.date-cell').forEach(cell => {
            const isoDate = cell.dataset.date;
            if (isoDate) {
                const date = new Date(isoDate);
                cell.textContent = formatter.format(date).replace(',', '');
            }
        });
    });

    //funcion para la exportacion de archivos
        function exportCleanedTableToExcel() {
            const originalTable = document.querySelector('table');

            // Clonar y limpiar la tabla
            const tempTable = document.createElement('table');
            tempTable.innerHTML = originalTable.innerHTML;

            // Eliminar la última columna (Acción)
            tempTable.querySelectorAll('thead tr, tbody tr').forEach(row => {
                row.removeChild(row.lastElementChild);
            });

            // Limpiar entrada/salida (convertir divs a texto)
            tempTable.querySelectorAll('tbody tr').forEach(row => {
                const cell = row.cells[3];
                const entradasSalidas = Array.from(cell.querySelectorAll('div'))
                    .map(div => div.textContent.trim())
                    .join(' | ');
                cell.textContent = entradasSalidas;
            });

            // Convertir la tabla en una hoja de Excel
            const ws = XLSX.utils.table_to_sheet(tempTable);

            // Agregar estilos simples a cabeceras (negrita y fondo gris)
            const cabecera = ['A1', 'B1', 'C1', 'D1', 'E1', 'F1'];
            cabecera.forEach(celda => {
                if (ws[celda]) {
                    ws[celda].s = {
                        font: { bold: true },
                        fill: { fgColor: { rgb: "D3D3D3" } },
                        alignment: { horizontal: "center" }
                    };
                }
            });

            // Crear el libro
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Asistencias");

            // Nombre dinámico
            const fecha = new Date();
            const nombreArchivo = `asistencias_${fecha.getFullYear()}-${fecha.getMonth() + 1}-${fecha.getDate()}_${fecha.getHours()}-${fecha.getMinutes()}-${fecha.getSeconds()}.xlsx`;

            // Guardar el archivo
            XLSX.writeFile(wb, nombreArchivo);

            // Mostrar mensaje de éxito
            alert(`✅ Se exportó correctamente el archivo "${nombreArchivo}".\nRevisa tu carpeta de descargas.`);
        }

</script>

</x-layout_asistencia>
