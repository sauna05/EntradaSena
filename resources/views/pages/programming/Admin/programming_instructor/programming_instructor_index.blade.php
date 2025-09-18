<x-layout>
    <x-slot:title>Listado de Instructores con Programaciones</x-slot:title>

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
            max-width: 1600px;
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
            margin-bottom: 10px;
            font-weight: 700;
        }

        .dashboard-header p {
            color: #000;
            font-size: 16px;
            opacity: 0.8;
            max-width: 900px;
            line-height: 1.5;
        }

        /* Action buttons */
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-primary {
            background-color: #28a745;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }


        .search-input {
            flex: 1;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 15px center;
            background-size: 18px;
        }

        .search-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }

        /* Tabs */
        .tabs {
            display: flex;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .tab-btn {
            padding: 12px 24px;
            background: none;
            border: none;
            cursor: pointer;
            font-weight: 600;
            color: #6c757d;
            position: relative;
            transition: all 0.3s;
        }

        .tab-btn.active {
            color: #28a745;
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: #28a745;
            border-radius: 3px 3px 0 0;
        }

        .tab-btn:hover {
            color: #28a745;
        }

        /* Instructor cards */
        .instructors-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .instructor-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .instructor-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .card-header {
            padding: 20px;
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: bold;
        }

        .instructor-info h3 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
        }

        .instructor-info p {
            margin: 5px 0 0;
            opacity: 0.9;
            font-size: 14px;
        }

        .card-body {
            padding: 20px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
            margin-bottom: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 10px;
            border-radius: 8px;
        }

        .stat-value {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 12px;
            color: #6c757d;
        }

        .hours-assigned {
            background-color: #e9f5ff;
            color: #0066cc;
        }

        .hours-completed {
            background-color: #e6f7ee;
            color: #0b8c56;
        }

        .hours-remaining {
            background-color: #fff4e6;
            color: #e67700;
        }

        .programmings-list {
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .programmings-list h4 {
            margin-bottom: 12px;
            font-size: 16px;
            color: #495057;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .programming-item {
            padding: 12px;
            margin-bottom: 10px;
            border-radius: 8px;
            background-color: #f8f9fa;
            border-left: 4px solid #28a745;
        }

        .programming-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: #212529;
        }

        .programming-details {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #6c757d;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
        }

        .status-pendiente {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-en_ejecucion {
            background-color: #e2d51d;
            color: #0c5460;
        }

        .status-finalizada_no_evaluada {
            background-color: #d6d8d9;
            color: #383d41;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
            grid-column: 1 / -1;
        }

        .empty-state svg {
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            padding: 20px;
            backdrop-filter: blur(3px);
        }

        .modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 900px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: modalFadeIn 0.3s ease;
            max-height: 90vh;
            overflow-y: auto;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .close {
            color: #888;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: 700;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close:hover {
            color: #444;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .instructors-grid {
                grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
                margin: 15px;
            }

            .action-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .search-container {
                width: 100%;
            }

            .stats {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="container">
        <div class="dashboard-header">
            <h1>Gestión de Instructores y Programaciones</h1>
            <p>
                En esta sección puede visualizar y gestionar todos los instructores del sistema junto con sus programaciones asignadas.
                Utilice el campo de búsqueda para encontrar instructores por nombre o documento. Puede ver el perfil completo
                de cada instructor haciendo clic en el botón "Ver Perfil".
            </p>
        </div>

        <div class="action-buttons">
            <a href="{{ route('entrance.people.create') }}" class="btn btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                    <circle cx="9" cy="7" r="4"></circle>
                    <line x1="19" y1="8" x2="19" y2="14"></line>
                    <line x1="22" y1="11" x2="16" y2="11"></line>
                </svg>
                Nuevo
            </a>
            <input type="text" id="filtroInstructor" class="search-input" placeholder="Buscar por nombre o documento...">



        </div>

        <div class="tabs">
            <button class="tab-btn active" data-tab="all">Todos los Instructores</button>
            <button class="tab-btn" data-tab="with-programming">Con Programaciones</button>
            <button class="tab-btn" data-tab="without-programming">Sin Programaciones</button>
        </div>

        <div class="instructors-grid" id="instructores-container">
            @forelse($instructores as $instructor)
                <div class="instructor-card" data-name="{{ strtolower($instructor->person->name) }}" data-document="{{ $instructor->person->document_number }}" data-has-programming="{{ $instructor->programming->count() > 0 ? 'yes' : 'no' }}">
                    <div class="card-header">
                        <div class="avatar">
                            {{ substr($instructor->person->name, 0, 1) }}{{ substr(($instructor->person->last_name ?? ''), 0, 1) }}
                        </div>
                        <div class="instructor-info">
                            <h3>{{ $instructor->person->name }} {{ $instructor->person->last_name ?? '' }}</h3>
                            <p>{{ $instructor->person->document_number }} | {{ $instructor->speciality->name }}</p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="stats">
                            <div class="stat-item hours-assigned">
                                <div class="stat-value">{{ $instructor->assigned_hours }}h</div>
                                <div class="stat-label">Asignadas</div>
                            </div>
                            <div class="stat-item hours-completed">
                                <div class="stat-value">{{ $instructor->horas_programadas }}h</div>
                                <div class="stat-label">Cumplidas</div>
                            </div>
                            <div class="stat-item hours-remaining">
                                <div class="stat-value">{{ $instructor->horas_restantes }}h</div>
                                <div class="stat-label">Restantes</div>
                            </div>
                        </div>

                        <div class="programmings-list">
                            <h4>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                Programaciones ({{ $instructor->programming->count() }})
                            </h4>

                            @forelse($instructor->programming->take(3) as $programming)
                                <div class="programming-item">
                                    <div class="programming-title">{{ $programming->competencie->name ?? 'Sin competencia' }}</div>
                                    <div class="programming-details">
                                        <span>{{ \Carbon\Carbon::parse($programming->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($programming->end_date)->format('d/m/Y') }}</span>
                                        <span class="status-badge status-{{ $programming->status }}">
                                            @if($programming->status == 'pendiente')
                                                Pendiente
                                            @elseif($programming->status == 'en_ejecucion')
                                                En ejecución
                                            @elseif($programming->status == 'finalizada_no_evaluada')
                                                Finalizada
                                            @else
                                                {{ $programming->status }}
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            @empty
                                <p style="text-align: center; color: #6c757d; font-size: 14px;">No hay programaciones asignadas</p>
                            @endforelse

                            @if($instructor->programming->count() > 3)
                                <p style="text-align: center; margin-top: 10px; color: #28a745; font-weight: 600;">
                                    +{{ $instructor->programming->count() - 3 }} más
                                </p>
                            @endif
                        </div>

                        <button class="btn btn-primary" style="width: 100%; margin-top: 15px;" onclick="openModal('{{ $instructor->id }}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            Ver Perfil Completo
                        </button>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <p>No se encontraron instructores registrados</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Modales para cada instructor -->
    @foreach($instructores as $instructor)
    <div id="modal-{{ $instructor->id }}" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal('{{ $instructor->id }}')">&times;</span>
            <h2 style="color: #28a745; margin-bottom: 25px; text-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 10px;">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                Perfil del Instructor - {{ $instructor->person->name }}
            </h2>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 30px;">
                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
                    <h3 style="color: #28a745; margin-bottom: 15px;">Información Personal</h3>
                    <div style="display: flex; margin-bottom: 10px;">
                        <div style="width: 140px; font-weight: 600; color: #6c757d;">Nombre completo:</div>
                        <div>{{ $instructor->person->name }} {{ $instructor->person->last_name ?? '' }}</div>
                    </div>
                    <div style="display: flex; margin-bottom: 10px;">
                        <div style="width: 140px; font-weight: 600; color: #6c757d;">Número de documento:</div>
                        <div>{{ $instructor->person->document_number }}</div>
                    </div>
                    <div style="display: flex; margin-bottom: 10px;">
                        <div style="width: 140px; font-weight: 600; color: #6c757d;">Correo electrónico:</div>
                        <div>{{ $instructor->person->email }}</div>
                    </div>
                    <div style="display: flex; margin-bottom: 10px;">
                        <div style="width: 140px; font-weight: 600; color: #6c757d;">Teléfono:</div>
                        <div>{{ $instructor->person->phone_number ?? 'No registrado' }}</div>
                    </div>
                </div>

                <div style="background: #f8f9fa; padding: 20px; border-radius: 8px;">
                    <h3 style="color: #28a745; margin-bottom: 15px;">Información Profesional</h3>
                    <div style="display: flex; margin-bottom: 10px;">
                        <div style="width: 140px; font-weight: 600; color: #6c757d;">Tipo de vinculación:</div>
                        <div>{{ $instructor->link_types->name }}</div>
                    </div>
                    <div style="display: flex; margin-bottom: 10px;">
                        <div style="width: 140px; font-weight: 600; color: #6c757d;">Especialidad:</div>
                        <div>{{ $instructor->speciality->name }}</div>
                    </div>
                    <div style="display: flex; margin-bottom: 10px;">
                        <div style="width: 140px; font-weight: 600; color: #6c757d;">Zona:</div>
                        <div>{{ $instructor->zona ?? 'No especificada' }}</div>
                    </div>
                    <div style="display: flex; margin-bottom: 10px;">
                        <div style="width: 140px; font-weight: 600; color: #6c757d;">Estado:</div>
                        <div>
                            <span style="color: {{ $instructor->instructor_status->name ? '#28a745' : '#dc3545' }}; font-weight: 600;">
                                {{ $instructor->instructor_status->name ?? 'Desconocido' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div style="background: #f8f9fa; padding: 20px; border-radius: 8px; margin-bottom: 20px;">
                <h3 style="color: #28a745; margin-bottom: 15px;">Control de Horas</h3>
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px;">
                    <div style="text-align: center; padding: 15px; border-radius: 8px;" class="hours-assigned">
                        <div style="font-size: 24px; font-weight: 700;">{{ $instructor->assigned_hours }}</div>
                        <div style="font-size: 14px;">Horas asignadas</div>
                    </div>
                    <div style="text-align: center; padding: 15px; border-radius: 8px;" class="hours-completed">
                        <div style="font-size: 24px; font-weight: 700;">{{ $instructor->horas_programadas }}</div>
                        <div style="font-size: 14px;">Horas cumplidas</div>
                    </div>
                    <div style="text-align: center; padding: 15px; border-radius: 8px;" class="hours-remaining">
                        <div style="font-size: 24px; font-weight: 700;">{{ $instructor->horas_restantes }}</div>
                        <div style="font-size: 14px;">Horas restantes</div>
                    </div>
                </div>
            </div>

            <div>
                <h3 style="color: #28a745; margin-bottom: 15px;">Programaciones Asignadas</h3>
                <div style="max-height: 300px; overflow-y: auto;">
                    @forelse($instructor->programming as $programming)
                        <div style="padding: 15px; margin-bottom: 10px; border-radius: 8px; background-color: white; border-left: 4px solid #28a745;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                <div style="font-weight: 600; font-size: 16px;">{{ $programming->competencie->name ?? 'Sin competencia' }}</div>
                                <span class="status-badge status-{{ $programming->status }}">
                                    @if($programming->status == 'pendiente')
                                        Pendiente
                                    @elseif($programming->status == 'en_ejecucion')
                                        En ejecución
                                    @elseif($programming->status == 'finalizada_no_evaluada')
                                        Finalizada
                                    @else
                                        {{ $programming->status }}
                                    @endif
                                </span>
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; font-size: 14px;">
                                <div><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($programming->start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($programming->end_date)->format('d/m/Y') }}</div>
                                <div><strong>Duración:</strong> {{ $programming->hours_duration }} horas</div>
                                <div><strong>Programa:</strong> {{ $programming->cohort->program->name ?? 'N/A' }}</div>
                                <div><strong>Aula:</strong> {{ $programming->classroom->name ?? 'N/A' }}</div>
                            </div>
                            @if($programming->days && count($programming->days) > 0)
                                <div style="margin-top: 10px;">
                                    <strong>Días:</strong>
                                    @foreach($programming->days as $day)
                                        <span style="background: #e9ecef; padding: 4px 8px; border-radius: 4px; margin-right: 5px; font-size: 12px;">
                                            {{ $day->name }}
                                        </span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @empty
                        <p style="text-align: center; padding: 20px; color: #6c757d;">No hay programaciones asignadas</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        // Búsqueda en tiempo real
        document.getElementById('filtroInstructor').addEventListener('input', function() {
            const filtro = this.value.trim().toLowerCase();
            const cards = document.querySelectorAll('.instructor-card');

            cards.forEach(card => {
                const name = card.getAttribute('data-name');
                const document = card.getAttribute('data-document');

                if (name.includes(filtro) || document.includes(filtro)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Funcionalidad de pestañas
        document.querySelectorAll('.tab-btn').forEach(button => {
            button.addEventListener('click', function() {
                // Actualizar estado activo de pestañas
                document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                const tab = this.getAttribute('data-tab');
                const cards = document.querySelectorAll('.instructor-card');

                cards.forEach(card => {
                    const hasProgramming = card.getAttribute('data-has-programming');

                    if (tab === 'all') {
                        card.style.display = 'block';
                    } else if (tab === 'with-programming' && hasProgramming === 'yes') {
                        card.style.display = 'block';
                    } else if (tab === 'without-programming' && hasProgramming === 'no') {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Funciones para modales
        function openModal(id) {
            document.getElementById('modal-' + id).style.display = 'flex';
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }

        // Cerrar modal al hacer clic fuera
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        };

        // Cerrar con tecla ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.style.display = 'none';
                });
            }
        });
    </script>
</x-layout>
