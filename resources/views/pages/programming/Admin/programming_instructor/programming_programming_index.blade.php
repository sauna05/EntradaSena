<x-layout>
    <x-slot:title>Listado de programaciones</x-slot:title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 100%;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        .table-responsive {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        /* Estilos para los estados */
        .status-badge {
            font-weight: bold;
            border-radius: 20px;
            padding: 5px 10px;
            display: inline-block;
            font-size: 0.8rem;
            text-align: center;
            min-width: 100px;
            margin-right: 5px;
        }

        /* Pendiente */
        .status-pendiente {
            background-color: #d0e3ff;
            color: #0047ab;
        }

        /* En ejecución */
        .status-en_ejecucion {
            background-color: #fff3bf;
            color: #8a6d3b;
        }

        /* Finalizada evaluada */
        .status-finalizada_evaluada {
            background-color: #d4edda;
            color: #155724;
        }

        /* Finalizada no evaluada */
        .status-finalizada_no_evaluada {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Disponible */
        .status-disponible {
            background-color: #ffffff;
            color: #000000;
            border: 1px solid #ddd;
        }

        /* Estado desconocido */
        .status-desconocido {
            background-color: #e2e3e5;
            color: #383d41;
        }
        .disponible-badge {
            font-size: 0.7rem;
            color: #666;
            background-color: #f0f0f0;
            padding: 2px 5px;
            border-radius: 3px;
            margin-left: 5px;
            font-weight: normal;
            border: 1px solid #ddd;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        /* Estilos para los iconos */
        .status-icon {
            margin-right: 5px;
        }

        /* Estilos para los filtros */
        .filters-container {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            color: #495057;
        }

        .filter-group select, .filter-group input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 14px;
        }

        .reset-btn {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            align-self: flex-end;
        }

        .btn-evaluar {
            background-color: #28a745;
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            border: none;
        }

        .btn-reprogramar {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border-radius: 6px;
            border: none;
        }

        .btn-excel {
            background-color: #1d6f42;
            color: white;
            padding: 8px 15px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }

        .btn-excel:hover {
            background-color: #165a36;
        }

        .reset-btn:hover {
            background-color: #5a6268;
        }

        .no-results {
            text-align: center;
            padding: 20px;
            font-style: italic;
            color: #6c757d;
            display: none;
        }

        .status-container {
            display: flex;
            align-items: center;
            gap: 5px;
        }
    </style>

    <div class="container">
        <h1 class="h1">Competencias Programadas</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Filtros -->
        <div class="filters-container">
            <div class="filter-group">
                <label for="program-filter">Filtrar por programa:</label>
                <select id="program-filter">
                    <option value="">Todos los programas</option>
                    @foreach($programaciones->pluck('cohort.program.name')->unique()->filter() as $programName)
                        <option value="{{ $programName }}">{{ $programName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="status-filter">Filtrar por estado:</label>
                <select id="status-filter">
                    <option value="">Todos los estados</option>
                    <option value="pendiente">Pendiente</option>
                    <option value="en_ejecucion">En ejecución</option>
                    <option value="finalizada_evaluada">Finalizada (Evaluada)</option>
                    <option value="finalizada_no_evaluada">Finalizada (Pendiente evaluación)</option>

                </select>
            </div>

            <button class="reset-btn" id="reset-filters">Restablecer filtros</button>
        </div>

        <div class="no-results" id="no-results">
            No se encontraron programaciones con los filtros aplicados.
        </div>

        <!-- Botón de descarga Excel -->
        <button id="export-excel" class="btn-excel">
            <i class="fas fa-file-excel"></i> Descargar Excel
        </button>

        <div class="table-responsive" style="max-height: 500px; overflow-y: auto; overflow-x: auto;">

            <table id="programming-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Programa</th>
                        <th>Ficha</th>
                        <th>Instructor</th>
                        <th>Competencia</th>
                        <th>Duracion</th>
                        <th>Ambiente</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Horario</th>
                        <th>Estado</th>
                        <th>Accion</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($programaciones as $programacion)
                        <tr data-program="{{ $programacion->cohort->program->name ?? '' }}"
                            data-status="{{ $programacion->status }}"
                            @if($programacion->status === 'finalizada_evaluada')
                                data-disponible="true"
                            @endif>
                            <td>{{ $programacion->id }}</td>

                            <td>{{ $programacion->cohort->program->name ?? 'N/A' }}</td>
                            <td>{{ $programacion->cohort->number_cohort ?? 'N/A' }}</td>
                            <td>{{ $programacion->instructor->person->name ?? 'N/A' }}</td>
                            <td>
                                {{ $programacion->competencie->name ?? 'N/A' }}
                                @if($programacion->status === 'finalizada_evaluada' && in_array($programacion->id, $ultimasProgramaciones))
                                    <span class="disponible-badge" title="Esta competencia está disponible para reprogramación">
                                        (Disponible)
                                    </span>
                                @endif
                            </td>
                            <td>{{$programacion->hours_duration}}  hrs </td>
                            <td>{{ $programacion->classroom->name ?? 'N/A' }}</td>
                            <td>{{ $programacion->start_date }}</td>
                            <td>{{ $programacion->end_date }}</td>
                            <td>
                                {{ $programacion->start_time }} -
                                {{ $programacion->end_time }}
                            </td>
                            <td>
                                <div class="status-container">
                                    @php
                                        $estados = [
                                            'pendiente' => [
                                                'class' => 'status-pendiente',
                                                'text' => 'Pendiente',
                                                'icon' => '⏱️'
                                            ],
                                            'en_ejecucion' => [
                                                'class' => 'status-en_ejecucion',
                                                'text' => 'En ejecución',
                                                'icon' => '🔄'
                                            ],
                                            'finalizada_evaluada' => [
                                                'class' => 'status-finalizada_evaluada',
                                                'text' => 'Finalizada (Evaluada)',
                                                'icon' => '✅'
                                            ],
                                            'finalizada_no_evaluada' => [
                                                'class' => 'status-finalizada_no_evaluada',
                                                'text' => 'Finalizada (Pendiente evaluación)',
                                                'icon' => '⚠️'
                                            ],
                                        ];

                                        $estado = $estados[$programacion->status] ?? [
                                            'class' => 'status-desconocido',
                                            'text' => 'Desconocido',
                                            'icon' => '❓'
                                        ];
                                    @endphp

                                    <span class="status-badge {{ $estado['class'] }}">
                                        <span class="status-icon">{{ $estado['icon'] }}</span>
                                        {{ $estado['text'] }}
                                    </span>
                                </div>
                            </td>
                            <td class="action-cell">
                                @if ($programacion->status === 'finalizada_no_evaluada')
                                    {{-- Botón para Evaluar --}}
                                    <form action="{{ route('programmig.evaluate', $programacion->id) }}" method="POST" onsubmit="return confirm('¿Está seguro que desea evaluar esta programación?')">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-evaluar" style="cursor: pointer">
                                            <i class="fas fa-check-circle"></i> Evaluar
                                        </button>
                                    </form>

                                @elseif ($programacion->status === 'finalizada_evaluada')
                                    @if (in_array($programacion->id, $ultimasProgramaciones))
                                        {{-- ✅ Solo la última programación de la competencia puede reprogramarse --}}
                                        <form action="{{ route('programmig.reprogramming_index', $programacion->id) }}" method="GET" onsubmit="return confirm('¿Está seguro que desea reprogramar?')">
                                            @csrf
                                            <button type="submit" class="btn-reprogramar" style="cursor: pointer">
                                                <i class="fas fa-calendar-alt"></i> Reprogramar
                                            </button>
                                        </form>
                                    @else
                                        {{-- ❌ Esta ya fue reprogramada --}}
                                        <span class="text-muted">Reprogramado</span>
                                    @endif

                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" style="text-align: center;">No hay programaciones registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Incluir SheetJS -->
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>

    <!-- Incluir Font Awesome para el ícono de Excel -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const programFilter = document.getElementById('program-filter');
            const statusFilter = document.getElementById('status-filter');
            const resetBtn = document.getElementById('reset-filters');
            const rows = document.querySelectorAll('#programming-table tbody tr');
            const noResults = document.getElementById('no-results');

            function applyFilters() {
                const selectedProgram = programFilter.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();
                let visibleRows = 0;

                rows.forEach(row => {
                    const program = row.getAttribute('data-program').toLowerCase();
                    const status = row.getAttribute('data-status').toLowerCase();
                    const disponible = row.getAttribute('data-disponible');

                    const programMatch = selectedProgram === '' || program.includes(selectedProgram);
                    let statusMatch = selectedStatus === '' || status === selectedStatus;

                    // Caso especial para filtrar por "disponible"
                    if (selectedStatus === 'disponible') {
                        statusMatch = disponible === 'true';
                    }

                    if (programMatch && statusMatch) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                // Mostrar mensaje si no hay resultados
                if (visibleRows === 0) {
                    noResults.style.display = 'block';
                } else {
                    noResults.style.display = 'none';
                }
            }

            // Event listeners
            programFilter.addEventListener('change', applyFilters);
            statusFilter.addEventListener('change', applyFilters);

            resetBtn.addEventListener('click', function() {
                programFilter.value = '';
                statusFilter.value = '';
                applyFilters();
            });

            document.getElementById('export-excel').addEventListener('click', function() {
                // Obtener la tabla
                const table = document.getElementById('programming-table');

                // Obtener todas las filas visibles (considerando los filtros)
                const visibleRows = Array.from(table.querySelectorAll('tbody tr')).filter(row =>
                    row.style.display !== 'none'
                );

                // Preparar los datos
                const data = [];

                // Obtener encabezados (excluyendo la columna Acción)
                const headers = [];
                const headerCells = table.querySelectorAll('thead tr th');
                headerCells.forEach((cell, index) => {
                    // Excluir la columna "Acción" (última columna)
                    if (index < headerCells.length - 1) {
                        headers.push(cell.textContent.trim());
                    }
                });
                data.push(headers);

                // Obtener datos de cada fila visible
                visibleRows.forEach(row => {
                    const rowData = [];
                    const cells = row.querySelectorAll('td');

                    cells.forEach((cell, index) => {
                        // Excluir la columna "Acción" (última columna)
                        if (index < cells.length - 1) {
                            let cellValue;

                            // Caso especial para estado (columna 10)
                            if (index === 9) {
                                const statusBadge = cell.querySelector('.status-badge');
                                if (statusBadge) {
                                    // Obtener solo el texto, eliminando iconos y espacios extra
                                    cellValue = statusBadge.textContent.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ()\s]/g, '').trim();
                                } else {
                                    cellValue = cell.textContent.trim();
                                }
                            }
                            // Caso especial para duración (columna 5)
                            else if (index === 5) {
                                cellValue = cell.textContent.trim().replace('hrs', '').trim();
                            }
                            // Para las demás columnas
                            else {
                                cellValue = cell.textContent.trim();
                            }

                            rowData.push(cellValue);
                        }
                    });

                    data.push(rowData);
                });

                // Crear libro de trabajo
                const wb = XLSX.utils.book_new();
                const ws = XLSX.utils.aoa_to_sheet(data);

                // Aplicar estilos a las celdas
                if (!ws['!cols']) ws['!cols'] = [];

                // Definir anchos de columnas
                const colWidths = [
                    { wch: 5 },   // #
                    { wch: 25 },  // Programa
                    { wch: 10 },  // Ficha
                    { wch: 25 },  // Instructor
                    { wch: 30 },  // Competencia
                    { wch: 10 },  // Duración
                    { wch: 15 },  // Ambiente
                    { wch: 12 },  // Fecha Inicio
                    { wch: 12 },  // Fecha Fin
                    { wch: 20 },  // Horario
                    { wch: 25 }   // Estado
                ];

                ws['!cols'] = colWidths;

                // Estilo para los encabezados
                const headerStyle = {
                    font: { bold: true, color: { rgb: "FFFFFF" } },
                    fill: { fgColor: { rgb: "4472C4" } }, // Azul corporativo
                    alignment: { horizontal: "center" },
                    border: {
                        top: { style: "thin", color: { rgb: "000000" } },
                        bottom: { style: "thin", color: { rgb: "000000" } },
                        left: { style: "thin", color: { rgb: "000000" } },
                        right: { style: "thin", color: { rgb: "000000" } }
                    }
                };

                // Aplicar estilo a los encabezados
                for (let col = 0; col < headers.length; col++) {
                    const cellAddress = XLSX.utils.encode_cell({ r: 0, c: col });
                    if (!ws[cellAddress]) continue;

                    ws[cellAddress].s = headerStyle;
                }

                // Estilo para las celdas de datos
                const dataStyle = {
                    font: { name: "Calibri", sz: 11 },
                    alignment: { vertical: "center" },
                    border: {
                        top: { style: "thin", color: { rgb: "D9D9D9" } },
                        bottom: { style: "thin", color: { rgb: "D9D9D9" } },
                        left: { style: "thin", color: { rgb: "D9D9D9" } },
                        right: { style: "thin", color: { rgb: "D9D9D9" } }
                    }
                };

                // Aplicar estilo a los datos
                for (let row = 1; row < data.length; row++) {
                    for (let col = 0; col < headers.length; col++) {
                        const cellAddress = XLSX.utils.encode_cell({ r: row, c: col });
                        if (!ws[cellAddress]) continue;

                        // Si es la columna de duración, alinear a la derecha
                        if (col === 5) {
                            ws[cellAddress].s = { ...dataStyle, alignment: { ...dataStyle.alignment, horizontal: "right" } };
                        }
                        // Si es la columna de estado, aplicar formato según estado
                        else if (col === 10) {
                            const estado = ws[cellAddress].v;
                            let fillColor;

                            if (estado.includes("Pendiente")) fillColor = { rgb: "D0E3FF" };
                            else if (estado.includes("ejecución")) fillColor = { rgb: "FFF3BF" };
                            else if (estado.includes("Evaluada")) fillColor = { rgb: "D4EDDA" };
                            else if (estado.includes("Pendiente evaluación")) fillColor = { rgb: "F8D7DA" };
                            else fillColor = { rgb: "FFFFFF" };

                            ws[cellAddress].s = {
                                ...dataStyle,
                                fill: { fgColor: fillColor },
                                font: { ...dataStyle.font, bold: true }
                            };
                        }
                        // Para las demás celdas
                        else {
                            ws[cellAddress].s = dataStyle;
                        }
                    }
                }

                // Añadir hoja al libro
                XLSX.utils.book_append_sheet(wb, ws, "Programaciones");

                // Generar archivo y descargar
                const fileName = `Programaciones_${new Date().toISOString().slice(0,10)}.xlsx`;
                XLSX.writeFile(wb, fileName);
            });

            // Aplicar filtros iniciales si hay valores en la URL
            const urlParams = new URLSearchParams(window.location.search);
            const initialProgram = urlParams.get('program');
            const initialStatus = urlParams.get('status');

            if (initialProgram) {
                programFilter.value = initialProgram;
            }
            if (initialStatus) {
                statusFilter.value = initialStatus;
            }

            if (initialProgram || initialStatus) {
                applyFilters();
            }
        });
    </script>
</x-layout>
