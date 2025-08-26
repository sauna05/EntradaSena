<x-layout>
    <x-slot:title>Asignar Competencias</x-slot:title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8fafc;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            color: #28a745;
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 700;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #eaeaea;
        }

        .dashboard-header p {
            text-align: center;
            color: #000;
            margin-bottom: 30px;
            font-size: 16px;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.5;
        }

        /* Alertas */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #dc3545;
        }

        /* Formulario */
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 25px;
            margin-bottom: 30px;
        }

        .form-group {
            flex: 1;
            min-width: 300px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #374151;
            font-size: 16px;
        }

        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 16px;
            background-color: white;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 16px;
            appearance: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        /* Tabla */
        .table-container {
            max-height: 500px;
            overflow-y: auto;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            margin-top: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            color: #444;
        }

        thead th {
            background-color: #f1f5f9;
            font-weight: 700;
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            position: sticky;
            top: 0;
            z-index: 1;
            color: #2d3748;
        }

        tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Checkbox personalizado */
        .checkbox-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        input[type="checkbox"] {
            transform: scale(1.3);
            cursor: pointer;
            accent-color: #28a745;
        }

        /* Badge para duración */
        .duration-badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 13px;
            font-weight: 600;
            background-color: #e9f5ff;
            color: #0066cc;
        }

        /* Botón */
        .form-buttons {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            background-color: #28a745;
            color: white;
            width: max-content;
            padding: 14px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }

        .empty-state svg {
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Estilos para agrupación de fichas */
        .ficha-group {
            background-color: #f1f8ff;
            border-left: 4px solid #007bff;
        }

        .ficha-group td {
            font-weight: bold;
            padding: 12px 15px;
        }

        .ficha-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .ficha-badge {
            background-color: #007bff;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 15px;
            }

            .form-container {
                flex-direction: column;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 600px;
            }
        }
    </style>

    {{-- Alertas --}}
    @if (session('success'))
        <div class="alert-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-danger">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="15" y1="9" x2="9" y2="15"></line>
                <line x1="9" y1="9" x2="15" y2="15"></line>
            </svg>
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <div class="dashboard-header">
            <h1>Asignación de Competencias a Instructores</h1>
            <p>En esta sección puede vincular competencias al perfil de los instructores.
                Seleccione un instructor y marque las competencias que desea asignarle.
                Esta acción permitirá al instructor ser asignado a programas que requieran estas competencias específicas.
            </p>
        </div>

        <form action="{{ route('programming.instructors_competencies_profile_store') }}" method="POST">
            @csrf

            <div class="form-container">
                <div class="form-group">
                    <label for="fichaSelect">Filtrar por ficha:</label>
                    <select id="fichaSelect">
                        <option value="">-- Todas las Fichas --</option>
                        @foreach ($fichas as $ficha)
                            <option value="{{ $ficha->id }}">{{ $ficha->number_cohort }} | {{ $ficha->program->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="instructorSelect">Seleccionar Instructor:</label>
                    <select id="instructorSelect" name="instructor_id" required>
                        <option value="">-- Seleccione un instructor --</option>
                        @foreach ($instructors as $instructor)
                            <option value="{{ $instructor->id }}">
                                {{ $instructor->person->document_number }} - {{ $instructor->person->name }} - {{ $instructor->speciality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            {{-- <th style="width: 50px; text-align: center;">
                                <input type="checkbox" id="selectAll">
                            </th> --}}
                            <th>Codigo</th>
                            <th>Ficha</th>
                            <th>Competencia</th>
                            <th>Duración</th>
                            <th>Especialidad</th>
                        </tr>
                    </thead>
                    <tbody id="competenciasContainer">
                        @php
                            $hasCompetencias = false;
                        @endphp

                        @foreach($fichas as $ficha)
                            @if($ficha->competences->count() > 0)
                                @php $hasCompetencias = true; @endphp

                                <!-- Fila de agrupación por ficha -->
                                <tr class="ficha-group" data-ficha="{{ $ficha->id }}">
                                    <td colspan="6">
                                        <div class="ficha-info">
                                            <span class="ficha-badge">FICHA</span>
                                            {{ $ficha->number_cohort }} - {{ $ficha->program->name }}
                                            ({{ $ficha->competences->count() }} competencias)
                                        </div>
                                    </td>
                                </tr>

                                <!-- Competencias de esta ficha -->
                                @foreach($ficha->competences as $competencia)
                                    <tr class="competencia-row" data-ficha="{{ $ficha->id }}">
                                        <td class="checkbox-container">
                                            <input type="checkbox" name="competencias[]" value="{{ $competencia->id }}"
                                                   class="competencia-checkbox">
                                        </td>
                                        <td>{{ $ficha->program->program_code ?? 'N/A' }}</td>
                                        <td>{{ $ficha->number_cohort }}</td>
                                        <td>{{ $competencia->name }}</td>
                                        <td>
                                            <span class="duration-badge">{{ $competencia->duration_hours }} horas</span>
                                        </td>
                                        <td>
                                            {{ $competencia->specialty->name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach

                        @if(!$hasCompetencias)
                            <tr>
                                <td colspan="6">
                                    <div class="empty-state">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                            <circle cx="12" cy="12" r="10"></circle>
                                            <line x1="12" y1="8" x2="12" y2="12"></line>
                                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                        </svg>
                                        <p>No hay fichas con competencias disponibles</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if($hasCompetencias)
            <div class="form-buttons">
                <button type="submit" class="btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                        <line x1="12" y1="11" x2="12" y2="17"></line>
                        <line x1="9" y1="14" x2="15" y2="14"></line>
                    </svg>
                    Vincular Competencias Seleccionadas
                </button>
            </div>
            @endif
        </form>
    </div>

    <script>
        // Filtrar competencias por ficha
        document.getElementById('fichaSelect').addEventListener('change', function () {
            const selectedId = this.value;
            const rows = document.querySelectorAll('.competencia-row, .ficha-group');

            if (selectedId === '') {
                // Mostrar todas
                rows.forEach(row => {
                    row.style.display = '';
                });
            } else {
                // Ocultar todas primero
                rows.forEach(row => {
                    row.style.display = 'none';
                });

                // Mostrar solo las de la ficha seleccionada
                const filteredRows = document.querySelectorAll(`[data-ficha="${selectedId}"]`);
                filteredRows.forEach(row => {
                    row.style.display = '';
                });
            }
        });

        // // Seleccionar/deseleccionar todos
        // document.getElementById('selectAll').addEventListener('change', function() {
        //     const checkboxes = document.querySelectorAll('.competencia-checkbox');
        //     checkboxes.forEach(checkbox => {
        //         checkbox.checked = this.checked;
        //     });
        // });

        // Validación del formulario
        document.querySelector('form').addEventListener('submit', function(e) {
            const instructorSelected = document.getElementById('instructorSelect').value;
            const competenciasSelected = document.querySelectorAll('input[name="competencias[]"]:checked');

            if (!instructorSelected) {
                e.preventDefault();
                alert('Por favor, seleccione un instructor.');
                return;
            }

            if (competenciasSelected.length === 0) {
                e.preventDefault();
                alert('Por favor, seleccione al menos una competencia.');
                return;
            }
        });
    </script>
</x-layout>
