<x-layout>
    {{-- CSS --}}
    <x-slot:page_style>css/pages/assistance/assistance_index.css</x-slot:page_style>
    {{-- Título --}}
    <x-slot:title>CAA</x-slot:title>
    {{-- Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>



    <div class="container mt-5">
        {{-- Mensaje según filtro --}}
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

    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Cantidad de Asistencias: <span class="badge bg-primary">{{ count($formattedPersons) }}</span></h3>

        <form method="GET" action="{{ route('entrance.assistance.index') }}" class="d-flex align-items-center">
            {{-- Select por puesto --}}
            <select name="position_id" class="form-select me-2" onchange="this.form.submit()">
                <option value="">Todos los puestos</option>
                @foreach ($positions as $position)
                    <option value="{{ $position->id }}" {{ request('position_id') == $position->id ? 'selected' : '' }}>
                        {{ $position->name }}
                    </option>
                @endforeach
            </select>

            {{-- Checkbox para activar filtro por semana --}}
            <div class="form-check form-switch me-2">
                <input class="form-check-input" type="checkbox" id="toggleWeekFilter" {{ request('week') ? 'checked' : '' }}>
                <label class="form-check-label" for="toggleWeekFilter">Filtrar por semana</label>
            </div>

            {{-- Select para semana (inicialmente habilitado solo si hay filtro) --}}
            <select id="weekSelect" name="week" class="form-select me-2" onchange="this.form.submit()">
                <option value="">Filtrar por semana</option>
                {{-- Opciones se agregan vía JS --}}
            </select>

            {{-- Filtro por mes --}}
            <select name="month" class="form-select me-2" onchange="this.form.submit()">
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

            {{-- Link para ver todas las asistencias --}}
            <a href="{{ route('entrance.assistance.all') }}" class="btn btn-link">Todas las asistencias</a>

            {{-- Filtro por fecha específica --}}
            <input type="date" name="filter_date" class="form-control me-2"
                max="{{ now()->toDateString() }}" value="{{ request('filter_date', now()->toDateString()) }}"
                onchange="this.form.submit()">

            {{-- Búsqueda --}}
            <div class="input-group">
                <input type="text" name="search" class="form-control"
                    placeholder="Buscar por nombre o documento" value="{{ request('search') }}">
                <button class="btn btn-outline-secondary" type="submit">Buscar</button>
            </div>
        </form>
    </div>

    {{-- Mensajes de vacío --}}
    @if (count($formattedPersons) === 0)
        <div class="alert alert-warning text-center">
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
        {{-- Tabla --}}
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover shadow-sm">
                <thead class="thead-dark text-center">
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
                                    <div class="d-flex justify-content-between">
                                        <div>Entrada: {{ $data['entrada'] }}</div>
                                        <div>Salida: {{ $data['salida'] }}</div>
                                    </div>
                                    @if (!$loop->last)<hr>@endif
                                @endforeach
                            </td>
                            <td class="text-center">{{ $person['total_time'] }}</td>
                            <td class="text-center date-cell">
                                {{ $data['date'] }}</td>
                            <td class="text-center">
                                <a href="{{ route('entrance.assistance.show', $person['id']) }}" class="btn btn-primary btn-sm">Ver más</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

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

</x-layout>
