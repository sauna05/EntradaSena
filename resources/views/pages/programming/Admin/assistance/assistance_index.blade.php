<x-layout>
    {{-- CSS --}}
    <x-slot:page_style></x-slot:page_style>
    {{-- Título --}}
    <x-slot:title>CAA</x-slot:title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    {{-- Navbar --}}

   <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

  <style>
    body {
        background-color: #f4f6f5;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 100%;
        padding: 30px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        margin-top: 20px;
    }

    h3 {
        margin-top: 15px;
        margin-bottom: 20px;
        color: #2c3e50;
        font-size: 1.4rem;
    }

    .badge.bg-primary {
        background-color: #2e7d32 !important;
        color: white;
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 15px;
    }

    .filter-box {
        background: #f9fafb;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 25px;
        margin-bottom: 25px;
    }

    .filter-group {
        flex: 1 1 220px;
        display: flex;
        flex-direction: column;
    }

    .filter-group label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 5px;
    }

    .form-select,
    .form-control {
        border-radius: 8px;
        border: 1px solid #ccc;
        padding: 8px;
        font-size: 14px;
    }

    .input-group {
        display: flex;
    }

    .input-group input {
        flex: 1;
        border-radius: 8px 0 0 8px;
        border: 1px solid #ccc;
        padding: 8px;
        font-size: 14px;
    }

    .input-group button {
        border-radius: 0 8px 8px 0;
        background-color: #2e7d32;
        border: none;
        color: white;
        padding: 8px 16px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .input-group button:hover {
        background-color: #1b5e20;
    }

    .btn {
        display: inline-block;
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        text-align: center;
        transition: background-color 0.3s ease;
    }

    .btn-success {
        background-color: #2e7d32;
        color: white;
    }

    .btn-danger {
        background-color: #c0392b;
        color: white;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
    }

    .btn-outline-primary {
        border: 1px solid #007bff;
        color: #007bff;
        background-color: transparent;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .table-responsive {
        max-height: 500px;
        overflow-y: auto;
        overflow-x: auto;
        border-radius: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #ffffff;
    }

    thead {
        background-color: #ecf0f1;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    thead th {
        padding: 12px;
        text-align: left;
        color: #2c3e50;
        font-weight: bold;
        border-bottom: 1px solid #ddd;
    }

    tbody td {
        padding: 10px;
        border-bottom: 1px solid #eee;
        vertical-align: top;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    .entrada-salida {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    hr {
        margin: 6px 0;
        border: none;
        border-top: 1px solid #ccc;
    }

    .alert {
        margin-top: 20px;
        padding: 15px;
        border-radius: 10px;
        background-color: #fdf6e3;
        color: #7a5a00;
        font-weight: 500;
        text-align: center;
    }

    @media (max-width: 768px) {
        .filter-box {
            flex-direction: column;
        }

        .input-group {
            flex-direction: column;
        }

        .input-group input,
        .input-group button {
            border-radius: 8px;
        }
    }
    .excel-btn {
    background-color: #217346; /* Verde estilo Excel */
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.excel-btn:hover {
    background-color: #14532d;
}

</style>



<div class="container">
    {{-- Encabezado dinámico --}}
    @if (request('month'))
        Mes de {{ \Carbon\Carbon::parse(request('month'))->locale('es')->isoFormat('MMMM [de] YYYY') }}
    @elseif (request('start_date') && request('end_date'))
        Desde el {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }} hasta el {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}
    @else
        <span id="fechaActual"></span>
    @endif

 <button class="excel-btn" onclick="exportCleanedTableToExcel()">
    📥 Exportar a Excel
</button>


    <h3>Cantidad de Asistencias:
        <span class="badge bg-primary">{{ count($formattedPersons) }}</span>
    </h3>

   {{-- Filtros --}}
<form method="GET" action="{{ route('entrance.assistance.index') }}" class="filter-box d-flex flex-wrap gap-3 mt-4 align-items-end justify-content-start">

    {{-- Cargo --}}
    <div class="filter-group">
        <label for="position_id"><i class="fas fa-user-tie me-1"></i> Cargo</label>
        <select name="position_id" class="form-select" onchange="this.form.submit()">
            <option value="">Todos los Cargos</option>
            @foreach ($positions as $position)
                <option value="{{ $position->id }}" {{ request('position_id') == $position->id ? 'selected' : '' }}>
                    {{ $position->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Mes --}}
    <div class="filter-group">
        <label for="month"><i class="fas fa-calendar-alt me-1"></i> Mes</label>
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
    </div>

    {{-- Rango de Fechas --}}
    <div class="filter-group">
        <label for="start_date"><i class="fas fa-calendar-day me-1"></i> Fecha inicio</label>
        <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
    </div>

    <div class="filter-group">
        <label for="end_date"><i class="fas fa-calendar-day me-1"></i> Fecha fin</label>
        <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
    </div>

    {{-- Búsqueda --}}
    <div class="filter-group flex-grow-1">
        <label for="search"><i class="fas fa-search me-1"></i> Buscar</label>
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Nombre o documento" value="{{ request('search') }}">
            <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i></button>
        </div>
    </div>

    {{-- Botones --}}
    <div class="filter-group">
        <label class="d-block">&nbsp;</label>
        <button type="submit" class="btn btn-success w-100"><i class="fas fa-filter"></i> Filtrar</button>
    </div>
    <div class="filter-group">
        <label class="d-block">&nbsp;</label>
        <a href="{{ route('entrance.assistance.index') }}" class="btn btn-danger w-100"><i class="fas fa-times-circle"></i> Restablecer</a>
    </div>

</form>


    {{-- Tabla --}}
    @if (count($formattedPersons) === 0)
        <div class="alert text-center mt-4">
            @if (request('month'))
                No hay asistencias registradas para el mes de {{ \Carbon\Carbon::parse(request('month'))->locale('es')->isoFormat('MMMM [de] YYYY') }}.
            @elseif (request('start_date') && request('end_date'))
                No hay asistencias entre el {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }} y {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}.
            @else
                Hoy no se han registrado asistencias.
            @endif
        </div>
    @else
        <div class="table-responsive" style="max-height: 500px; overflow-y: auto; overflow-x: auto;">
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
                            <td>
                                <a href="{{ route('entrance.assistance.show', $person['id']) }}" class="btn btn-outline-primary btn-sm" title="Ver detalles">
                                    <i class="fas fa-eye"></i> Ver más
                                </a>
                            </td>
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
                const fecha = new Date();
                const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                const fechaFormateada = fecha.toLocaleDateString('es-ES', opciones);
                document.getElementById('fechaActual').textContent = `Asistencias del día de hoy: ${fechaFormateada}`;


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
