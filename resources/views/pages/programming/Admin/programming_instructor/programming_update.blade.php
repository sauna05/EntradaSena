<x-layout>
    <x-slot:title>Listado de programaciones</x-slot:title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
        }

        .btn-register {
            background-color: #28a745;
            color: white;
            padding: 4px 8px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .btn-register:hover {
            background-color: #218838;
        }

        .status-ok {
            color: #28a745;
            font-weight: bold;
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

        .status {
            font-weight: bold;
            border-radius: 20px;
            padding: 5px 10px;
            display: inline-block;
            font-size: 0.8rem;
            text-align: center;
            min-width: 100px;
        }

        .status-active {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-cancelled {
            background-color: #f8d7da;
            color: #721c24;
        }

        .status-completed {
            background-color: #cce5ff;
            color: #004085;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 20px;
        }

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

        .filter-group select {
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
    </style>

    <div class="container">
        <h1 class="h1">Listado de Registro de Programaciones</h1>

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
                <label for="instructor-filter">Filtrar por instructor:</label>
                <select id="instructor-filter">
                    <option value="">Todos los instructores</option>
                    @foreach($programaciones->pluck('instructor.person.name')->unique()->filter() as $instructorName)
                        <option value="{{ $instructorName }}">{{ $instructorName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="status-filter">Filtrar por estado:</label>
                <select id="status-filter">
                    <option value="">Todos los estados</option>
                    <option value="ok">Registrada</option>
                    <option value="!ok">No registrada</option>
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
                        <th>Estado de registro</th>
                        <th>Registrar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($programaciones as $programacion)
                        <tr data-program="{{ $programacion->cohort->program->name ?? '' }}"
                            data-status="{{ $programacion->statu_programming === 'ok' ? 'ok' : '!ok' }}"
                            data-instructor="{{ $programacion->instructor->person->name ?? '' }}">
                            <td>{{ $programacion->id }}</td>
                            <td>{{ $programacion->instructor->person->name ?? 'N/A' }}</td>
                            <td>{{ $programacion->cohort->program->name ?? 'N/A' }}</td>
                            <td>{{ $programacion->cohort->number_cohort ?? 'N/A' }}</td>
                            <td>{{ $programacion->competencie->name ?? 'N/A' }}</td>
                            <td>{{ $programacion->classroom->name ?? 'N/A' }}</td>
                            <td>{{ $programacion->start_date }}</td>
                            <td>{{ $programacion->end_date }}</td>
                            <td>{{ $programacion->start_time }} - {{ $programacion->end_time }}</td>
                            <td>{{ $programacion->statu_programming }}</td>
                            <td>
                                @if ($programacion->statu_programming !== 'ok')
                                    <form action="{{ route('programing.programming_update', $programacion->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-register">✔ Marcar como registrada</button>
                                    </form>
                                @else
                                    <span class="status-ok">✔ Registrada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" style="text-align: center;">No hay programaciones registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const programFilter = document.getElementById('program-filter');
            const statusFilter = document.getElementById('status-filter');
            const instructorFilter = document.getElementById('instructor-filter');
            const resetBtn = document.getElementById('reset-filters');
            const rows = document.querySelectorAll('#programming-table tbody tr');
            const noResults = document.getElementById('no-results');

            function applyFilters() {
                const selectedProgram = programFilter.value.toLowerCase();
                const selectedStatus = statusFilter.value.toLowerCase();
                const selectedInstructor = instructorFilter.value.toLowerCase();
                let visibleRows = 0;

                rows.forEach(row => {
                    const program = row.getAttribute('data-program').toLowerCase();
                    const status = row.getAttribute('data-status').toLowerCase();
                    const instructor = row.getAttribute('data-instructor').toLowerCase();

                    const programMatch = selectedProgram === '' || program.includes(selectedProgram);
                    const statusMatch = selectedStatus === '' ||
                                        (selectedStatus === 'ok' && status === 'ok') ||
                                        (selectedStatus === '!ok' && status === '!ok');
                    const instructorMatch = selectedInstructor === '' || instructor.includes(selectedInstructor);

                    if (programMatch && statusMatch && instructorMatch) {
                        row.style.display = '';
                        visibleRows++;
                    } else {
                        row.style.display = 'none';
                    }
                });

                noResults.style.display = visibleRows === 0 ? 'block' : 'none';
            }

            programFilter.addEventListener('change', applyFilters);
            statusFilter.addEventListener('change', applyFilters);
            instructorFilter.addEventListener('change', applyFilters);

            resetBtn.addEventListener('click', function() {
                programFilter.value = '';
                statusFilter.value = '';
                instructorFilter.value = '';
                applyFilters();
            });

            // Aplicar filtro por defecto a "No registrada"
            statusFilter.value = '!ok';
            applyFilters();
        });
    </script>
</x-layout>
