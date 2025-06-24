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
                    <option value="disponible">Disponible</option>
                </select>
            </div>

            <button class="reset-btn" id="reset-filters">Restablecer filtros</button>
        </div>

        <div class="no-results" id="no-results">
            No se encontraron programaciones con los filtros aplicados.
        </div>

        <div class="table-responsive">
            <table id="programming-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Instructor</th>
                        <th>Programa</th>
                        <th>Ficha</th>
                        <th>Competencia</th>
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
                            <td>{{ $programacion->instructor->person->name ?? 'N/A' }}</td>
                            <td>{{ $programacion->cohort->program->name ?? 'N/A' }}</td>
                            <td>{{ $programacion->cohort->number_cohort ?? 'N/A' }}</td>
                          <td>
                                {{ $programacion->competencie->name ?? 'N/A' }}
                                @if($programacion->status === 'finalizada_evaluada')
                                    <span class="disponible-badge" title="Esta competencia está disponible para reprogramación">
                                        (Disponible)
                                    </span>
                                @endif
                            </td>
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

                                    {{-- @if($programacion->status === 'finalizada_evaluada')
                                        <span class="status-badge status-disponible">
                                            <span class="status-icon">🔄</span>
                                            Disponible
                                        </span>
                                    @endif --}}
                                </div>
                            </td>
                           <td class="action-cell">
                                @if($programacion->status === 'finalizada_evaluada')
                                    <form action="{{ route('programmig.programming_update_index', $programacion->id) }}" method="GET" onsubmit="return confirm('¿Está seguro que desea reprogramar?')">
                                        @csrf {{-- No es necesario para GET, pero no hace daño --}}
                                        <button type="submit" class="btn-reprogramar">
                                            <i class="fas fa-calendar-alt"></i>
                                            Reprogramar
                                        </button>
                                    </form>
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

    <script>
        // // Función para manejar la reprogramación
        // function reprogramar {
        //     return confirm('¿Estás seguro de reprogramar esta competencia?') ;


        // }

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
