<x-layout>

        <style>
            /* --- ESTILOS GENERALES --- */
            .admin-header {
                background-color: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                margin-bottom: 20px;
            }

            .page-title {
                color: #28a745;
                margin-bottom: 15px;
                font-size: 28px;
            }

            .ficha-info {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 15px;
                margin-bottom: 20px;
            }

            .info-card {
                background-color: #f8f9fa;
                padding: 15px;
                border-radius: 8px;
                border-left: 4px solid #28a745;
            }

            .info-card h3 {
                font-size: 14px;
                color: #6c757d;
                margin-bottom: 5px;
            }

            .info-card p {
                font-size: 16px;
                font-weight: 500;
            }

            .tabs {
                display: flex;
                border-bottom: 2px solid #dee2e6;
                margin-bottom: 20px;
            }

            .tab {
                padding: 12px 20px;
                cursor: pointer;
                font-weight: 500;
                border-bottom: 3px solid transparent;
                margin-bottom: -2px;
            }

            .tab.active {
                border-bottom-color: #28a745;
                color: #28a745;
            }

            .tab-content {
                display: none;
            }

            .tab-content.active {
                display: block;
            }

            .card {
                background-color: white;
                border-radius: 8px;
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                margin-bottom: 20px;
                overflow: hidden;
            }

            .card-header {
                padding: 15px 20px;
                background-color: #f8f9fa;
                border-bottom: 1px solid #dee2e6;
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
                gap: 10px;
            }

            .card-header h2 {
                font-size: 18px;
                color: #343a40;
                margin: 0;
            }

            /* --- BOTONES --- */
            .btn {
                padding: 8px 16px;
                border-radius: 4px;
                border: none;
                width: max-content;
                cursor: pointer;
                font-weight: 500;
                transition: all 0.3s;
                text-decoration: none;
                display: inline-block;
                text-align: center;
            }

            .btn-primary {
                background-color: #28a745;
                color: white;
            }

            .btn-primary:hover {
                background-color: #218838;
            }

            .btn-danger {
                background-color: #dc3545;
                color: white;
            }

            .btn-sm {
                padding: 5px 10px;
                font-size: 12px;
            }

            .btn-secondary {
                background-color: #6c757d;
                color: white;
            }

            .btn-secondary:hover {
                background-color: #5a6268;
            }

            .btn:disabled {
                opacity: 0.6;
                cursor: not-allowed;
            }

            /* --- TABLA --- */
            table {
                width: 100%;
                border-collapse: collapse;
            }

            th, td {
                padding: 12px 15px;
                text-align: left;
                border-bottom: 1px solid #dee2e6;
            }

            th {
                background-color: #f8f9fa;
                font-weight: 600;
            }

            tr:hover {
                background-color: #f8f9fa;
            }

            /* Estados de programación */
            .status-pendiente {
                background-color: #e2e3e5;
                color: #383d41;
            }

            .status-en_ejecucion {
                background-color: #fff3cd;
                color: #856404;
            }

            .status-finalizada_evaluada {
                background-color: #d4edda;
                color: #155724;
            }

            .status-finalizada_no_evaluada {
                background-color: #f8d7da;
                color: #721c24;
            }

            .status-desconocido {
                background-color: #e2e3e5;
                color: #383d41;
            }

            .status-badge {
                padding: 6px 12px;
                border-radius: 16px;
                font-size: 12px;
                font-weight: 600;
                display: inline-block;
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

            .actions {
                display: flex;
                gap: 8px;
                flex-wrap: wrap;
            }

            .action-cell {
                white-space: nowrap;
            }

            .text-muted {
                color: #6c757d !important;
            }

            /* --- MODAL --- */
            .modal {
                display: none;
                position: fixed;
                z-index: 1000;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                overflow: auto;
                background-color: rgba(0,0,0,0.5);
                justify-content: center;
                align-items: center;
            }

            .modal-content {
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                width: 100%;
                max-width: 500px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.3);
                animation: fadeIn 0.3s ease;
                position: relative;
            }

            @keyframes fadeIn {
                from {opacity: 0; transform: translateY(-20px);}
                to {opacity: 1; transform: translateY(0);}
            }

            .modal-content h3 {
                margin-bottom: 15px;
                font-size: 20px;
                color: #28a745;
            }

            .form-group {
                margin-bottom: 15px;
            }

            .form-group label {
                display: block;
                font-weight: 600;
                margin-bottom: 5px;
            }

            .form-group input,
            .form-group select {
                width: 100%;
                padding: 8px 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }

            .form-actions {
                display: flex;
                justify-content: flex-end;
                gap: 10px;
                margin-top: 20px;
            }

            .close {
                position: absolute;
                top: 15px;
                right: 15px;
                font-size: 24px;
                font-weight: bold;
                color: #333;
                cursor: pointer;
            }

            .table-responsive {
                overflow-x: auto;
                max-width: 100%;
            }

            .alert {
                padding: 10px 15px;
                border-radius: 4px;
                margin-bottom: 15px;
            }

            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border: 1px solid #c3e6cb;
            }

            .alert-danger {
                background-color: #f8d7da;
                color: #721c24;
                border: 1px solid #f5c6cb;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .card-header {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .actions {
                    width: 100%;
                    justify-content: flex-start;
                }

                .ficha-info {
                    grid-template-columns: 1fr;
                }

                .table-responsive {
                    overflow-x: auto;
                }

                table {
                    min-width: 600px;
                }
            }
        </style>


    <x-slot:title>Administrar Competencias - Ficha {{ $cohort->number_cohort }}</x-slot:title>

    <div class="container">
        <!-- Mensajes de alerta -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-header">
            <h1 class="page-title">Administrar Competencias - Ficha {{ $cohort->number_cohort }}</h1>

            <div class="ficha-info">
                <div class="info-card">
                    <h3>Programa de Formación</h3>
                    <h3>COD PROGRAMA: {{ $cohort->program->program_code ?? 'N/A' }}</h3>
                    <p>{{ $cohort->program->name ?? 'N/A' }}</p>
                </div>
                <div class="info-card">
                    <h3>Jornada</h3>
                    <p>{{ $cohort->cohortime->name ?? 'N/A' }}</p>
                </div>
                <div class="info-card">
                    <h3>Municipio</h3>
                    <p>{{ $cohort->town->name ?? 'N/A' }}</p>
                </div>
                <div class="info-card">
                    <h3>Fecha Inicio - Fin</h3>
                    <p>{{ $cohort->start_date }} - {{ $cohort->end_date }}</p>
                </div>
                <div class="info-card">
                    <h3>Matriculados</h3>
                    <p>{{ $cohort->enrolled_quantity }} Aprendices</p>
                </div>
            </div>
        </div>

        {{-- Tabs para navegar entre secciones --}}
        <div class="tabs">
            <div class="tab active" data-tab="asignadas">Competencias</div>
            <div class="tab" data-tab="programaciones">Programaciones</div>
        </div>

        {{-- Sección de Competencias --}}
        <div class="tab-content active" id="asignadas">
            <div class="card">
                <div class="card-header">
                    <h2>Competencias Asignadas</h2>
                    <div style="display:flex; gap:10px;">
                        <button class="btn btn-primary" onclick="openModal('competenceModal')">
                            Registrar Competencia
                        </button>
                        <button class="btn btn-secondary" onclick="openModal('copyModal')"
                                {{ count($otherCohortsData) > 0 ? '' : 'disabled' }}>
                            Agregar desde otra Ficha
                        </button>
                    </div>
                </div>

                @if($assignedCompetencies->count() > 0)
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Nombre de la Competencia</th>
                                <th>Duración (Horas)</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($assignedCompetencies as $competence)
                            <tr>
                                <td>{{ $competence->id ?? 'N/A' }}</td>
                                <td>{{ $competence->name }}</td>
                                <td>{{ $competence->duration_hours }} hrs</td>
                                {{-- <td class="actions">
                                    <a href="{{ route('programming.register_programming_instructor_index', ['competenceId' => $competence->id, 'cohortId' => $cohort->id]) }}"
                                       class="btn btn-primary btn-sm">
                                        Programar
                                    </a>
                                    <form action="{{ route('programing.competencies_remove', ['cohortId' => $cohort->id, 'competenceId' => $competence->id]) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Está seguro de quitar esta competencia?')"
                                          style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Quitar</button>
                                    </form>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div style="padding: 20px; text-align: center; color: #6c757d;">
                    <p>No hay competencias asignadas a esta ficha</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Sección de Programaciones --}}
        <div class="tab-content" id="programaciones">
            <div class="card">
                <div class="card-header">
                    <h2>Programaciones de Competencias</h2>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Programa</th>
                                <th>Ficha</th>
                                <th>Instructor</th>
                                <th>Competencia</th>
                                <th>Duración</th>
                                <th>Ambiente</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Horario</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($programaciones as $programacion)
                                <tr>
                                    <td>{{ $programacion->id }}</td>
                                    <td>{{ $programacion->cohort->program->name ?? 'N/A' }}</td>
                                    <td>{{ $programacion->cohort->number_cohort ?? 'N/A' }}</td>
                                    <td>{{ $programacion->instructor->person->name ?? 'N/A' }}</td>
                                    <td>
                                        {{ $programacion->competencie->name ?? 'N/A' }}
                                        @if($programacion->status === 'finalizada_evaluada')
                                            <span class="disponible-badge" title="Disponible para reprogramación">
                                                (Disponible)
                                            </span>
                                        @endif
                                    </td>
                                    <td>{{ $programacion->hours_duration }} hrs</td>
                                    <td>{{ $programacion->classroom->name ?? 'N/A' }}</td>
                                    <td>{{ $programacion->start_date }}</td>
                                    <td>{{ $programacion->end_date }}</td>
                                    <td>{{ $programacion->start_time }} - {{ $programacion->end_time }}</td>
                                    <td>
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
                                    </td>
                                    <td class="action-cell">
                                        @if ($programacion->status === 'finalizada_no_evaluada')
                                            <form action="{{ route('programmig.evaluate', $programacion->id) }}" method="POST"
                                                  onsubmit="return confirm('¿Está seguro que desea evaluar esta programación?')">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary btn-sm">
                                                    Evaluar
                                                </button>
                                            </form>
                                        @elseif ($programacion->status === 'finalizada_evaluada')
                                            @if (in_array($programacion->id, $ultimasProgramaciones))
                                                <a href="{{ route('programming.programming_update_index', $programacion->id) }}"
                                                   class="btn btn-primary btn-sm"
                                                   onclick="return confirm('¿Está seguro que desea reprogramar?')">
                                                    Reprogramar
                                                </a>
                                            @else
                                                <span class="text-muted">Reprogramado</span>
                                            @endif
                                        @else
                                            <span class="text-muted">N/A</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" style="text-align: center;">No hay programaciones registradas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Registrar Competencia -->
    <div id="competenceModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('competenceModal')">&times;</span>
            <h3>Registrar Nueva Competencia</h3>

            <form method="POST" action="{{ route('programing.competencies_store') }}">
                @csrf
                <input type="hidden" name="cohort_id" value="{{ $cohort->id }}">

                <div class="form-group">
                    <label for="speciality_id">Especialidad *</label>
                    <select name="speciality_id" id="speciality_id" required>
                        <option value="">Seleccione especialidad</option>
                        @foreach ($especialidad as $espe)
                            <option value="{{ $espe->id }}" {{ old('speciality_id') == $espe->id ? 'selected' : '' }}>
                                {{ $espe->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Nombre de la competencia *</label>
                    <input type="text" id="name" name="name" required
                           value="{{ old('name') }}"
                           placeholder="Ingrese el nombre de la competencia">
                </div>

                <div class="form-group">
                    <label for="code">Código de la competencia</label>
                    <input type="text" id="code" name="code"
                           value="{{ old('code') }}"
                           placeholder="Código de la competencia (opcional)">
                </div>

                <div class="form-group">
                    <label for="duration_hours">Duración (horas) *</label>
                    <input type="number" id="duration_hours" name="duration_hours" required min="1"
                           value="{{ old('duration_hours') }}"
                           placeholder="Horas de duración">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('competenceModal')">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Crear y Asignar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para Copiar Competencias -->
    <div id="copyModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('copyModal')">&times;</span>
            <h3>Agregar Competencias desde otra Ficha</h3>

            @if(count($otherCohortsData) > 0)
            <form method="POST" action="{{ route('programing.programming.competencies_copy') }}">
                @csrf
                <input type="hidden" name="target_cohort_id" value="{{ $cohort->id }}">

                <div class="form-group">
                    <label for="source_cohort_id">Ficha de origen *</label>
                    <select id="source_cohort_id" name="source_cohort_id" required>
                        <option value="">-- Seleccione ficha origen --</option>
                        @foreach($otherCohortsData as $oc)
                            <option value="{{ $oc['id'] }}">
                                Ficha {{ $oc['number_cohort'] }} —
                                {{ \Carbon\Carbon::parse($oc['start_date'])->format('d/m/Y') }} /
                                {{ \Carbon\Carbon::parse($oc['end_date'])->format('d/m/Y') }}
                                ({{ count($oc['competences']) }} competencias)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div id="previewCompetencies" style="margin-top:12px; display:none;">
                    <strong>Competencias que se copiarán:</strong>
                    <ul id="previewList" style="margin-top:8px; max-height: 200px; overflow-y: auto;"></ul>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('copyModal')">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Copiar Competencias</button>
                </div>
            </form>
            @else
            <div style="padding: 15px; text-align: center; color: #6c757d;">
                <p>No hay otras fichas del mismo programa disponibles para copiar competencias.</p>
            </div>
            @endif
        </div>
    </div>

    <script>
        // Funciones para manejar modales
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Cerrar modal al hacer clic fuera del contenido
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        }

        // Manejo de tabs
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Desactivar todas las tabs
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                // Activar la tab seleccionada
                this.classList.add('active');
                document.getElementById(this.dataset.tab).classList.add('active');
            });
        });

        // Previsualización de competencias al seleccionar ficha origen
        const otherCohortsData = @json($otherCohortsData);

        document.addEventListener('DOMContentLoaded', function() {
            const selectSource = document.getElementById('source_cohort_id');
            const preview = document.getElementById('previewCompetencies');
            const previewList = document.getElementById('previewList');

            if (selectSource) {
                selectSource.addEventListener('change', function() {
                    const id = this.value;
                    previewList.innerHTML = '';
                    preview.style.display = 'none';

                    if (!id) return;

                    const found = otherCohortsData.find(c => String(c.id) === String(id));
                    if (!found) return;

                    if (found.competences && found.competences.length > 0) {
                        preview.style.display = 'block';
                        found.competences.forEach(cp => {
                            const li = document.createElement('li');
                            li.textContent = `${cp.name} — ${cp.hours ?? 'N/A'} hrs`;
                            previewList.appendChild(li);
                        });
                    } else {
                        preview.style.display = 'block';
                        previewList.innerHTML = '<li>No hay competencias en la ficha origen.</li>';
                    }
                });
            }

            // Abrir modal de competencia si hay errores
            @if($errors->has('name') || $errors->has('duration_hours') || $errors->has('speciality_id'))
                openModal('competenceModal');
            @endif
        });
    </script>
</x-layout>
