<x-layout>
    <x-slot:title>Listado de Instructores</x-slot:title>

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
            max-width: 1400px;
            margin: 30px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .page-title {
            font-size: 32px;
            margin-bottom: 15px;
            color: #28a745;
            font-weight: 700;
            text-align: center;
            padding-bottom: 15px;
            border-bottom: 2px solid #eaeaea;
        }

        .page-description {
            text-align: center;
            color: #000;
            margin-bottom: 30px;
            font-size: 16px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
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

        /* Search box */
        .search-container {
            display: flex;
            max-width: 400px;
        }

        .search-input {
            flex: 1;
            padding: 12px 15px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 8px 0 0 8px;
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
            font-size: 14px;
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

        /* Botones de acción */
        .btn-action {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
        }

        .btn-view {
            background-color: #17a2b8;
            color: white;
        }

        .btn-view:hover {
            background-color: #138496;
            transform: translateY(-1px);
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
            max-width: 700px;
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

        /* Perfil */
        .profile-section {
            margin-bottom: 25px;
        }

        .profile-section h3 {
            margin-bottom: 15px;
            color: #2c3e50;
            font-size: 18px;
            padding-bottom: 8px;
            border-bottom: 2px solid #eaeaea;
        }

        .profile-row {
            display: flex;
            margin-bottom: 10px;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .profile-label {
            width: 180px;
            font-weight: 600;
            color: #6c757d;
        }

        .profile-value {
            flex: 1;
            color: #333;
        }

        .status-active {
            color: #28a745;
            font-weight: 600;
        }

        .status-inactive {
            color: #dc3545;
            font-weight: 600;
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

        /* Badge para horas */
        .hours-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 600;
        }
           .dashboard-header {
            margin-bottom: 20px;
        }

        .dashboard-header h1 {
            color: var(--verde-sena);
            font-size: 28px;
            margin-bottom: 10px;
        }

        .dashboard-header p {
            color: var(--gris-texto);
            font-size: 16px;
            opacity: 0.8;
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

        /* Responsive */
        @media (max-width: 1024px) {
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

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 1000px;
            }

            .profile-row {
                flex-direction: column;
                gap: 5px;
            }

            .profile-label {
                width: 100%;
            }
        }
    </style>

    <div class="container">

          <div class="dashboard-header">
                <h1>Gestión de Instructores</h1>
                <p >
                En esta sección puede visualizar y gestionar todos los instructores del sistema.
                Utilice el campo de búsqueda para encontrar instructores por número de documento.
                Puede ver el perfil completo de cada instructor haciendo clic en el botón "Ver Perfil".
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

            <div class="search-container">
                <input type="text" id="filtroDocumento" class="search-input" placeholder="Buscar por documento...">
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Especialidad</th>
                        <th>Horas Asignadas</th>
                        <th>Horas Cumplidas</th>
                        <th>Horas Restantes</th>
                        <th>Zona</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($instructores as $index => $instructor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $instructor->person->document_number }}</td>
                            <td>{{ $instructor->person->name ?? 'Sin nombre' }}</td>
                            <td>{{ $instructor->person->email ?? 'Sin email' }}</td>
                            <td>{{ $instructor->speciality->name }}</td>
                            <td>
                                <span class="hours-badge hours-assigned">{{ $instructor->assigned_hours }} hr</span>
                            </td>
                            <td>
                                <span class="hours-badge hours-completed">{{ $instructor->horas_programadas }} hr</span>
                            </td>
                            <td>
                                <span class="hours-badge hours-remaining">{{ $instructor->horas_restantes }} hr</span>
                            </td>
                            <td>{{ $instructor->zona ?? 'Sin zona' }}</td>
                            <td>
                                <button class="btn-action btn-view" onclick="openModal('{{ $instructor->id }}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                    Ver Perfil
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10">
                                <div class="empty-state">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                    <p>No se encontraron instructores registrados</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
                Perfil del Instructor
            </h2>

            <div class="profile-section">
                <h3>Información Personal</h3>
                <div class="profile-row">
                    <div class="profile-label">Nombre completo:</div>
                    <div class="profile-value">{{ $instructor->person->name }}</div>
                </div>
                <div class="profile-row">
                    <div class="profile-label">Número de documento:</div>
                    <div class="profile-value">{{ $instructor->person->document_number }}</div>
                </div>
                <div class="profile-row">
                    <div class="profile-label">Correo electrónico:</div>
                    <div class="profile-value">{{ $instructor->person->email }}</div>
                </div>
                <div class="profile-row">
                    <div class="profile-label">Teléfono:</div>
                    <div class="profile-value">{{ $instructor->person->phone_number ?? 'No registrado' }}</div>
                </div>
            </div>

            <div class="profile-section">
                <h3>Información Profesional</h3>
                <div class="profile-row">
                    <div class="profile-label">Tipo de vinculación:</div>
                    <div class="profile-value">{{ $instructor->link_types->name }}</div>
                </div>
                <div class="profile-row">
                    <div class="profile-label">Especialidad:</div>
                    <div class="profile-value">{{ $instructor->speciality->name }}</div>
                </div>
                <div class="profile-row">
                    <div class="profile-label">Zona:</div>
                    <div class="profile-value">{{ $instructor->zona ?? 'No especificada' }}</div>
                </div>
            </div>

            <div class="profile-section">
                <h3>Control de Horas</h3>
                <div class="profile-row">
                    <div class="profile-label">Horas asignadas:</div>
                    <div class="profile-value">
                        <span class="hours-badge hours-assigned">{{ $instructor->assigned_hours }} horas</span>
                    </div>
                </div>
                <div class="profile-row">
                    <div class="profile-label">Horas cumplidas:</div>
                    <div class="profile-value">
                        <span class="hours-badge hours-completed">{{ $instructor->horas_programadas }} horas</span>
                    </div>
                </div>
                <div class="profile-row">
                    <div class="profile-label">Horas restantes:</div>
                    <div class="profile-value">
                        <span class="hours-badge hours-remaining">{{ $instructor->horas_restantes }} horas</span>
                    </div>
                </div>
            </div>

            <div class="profile-section">
                <h3>Estado Actual</h3>
                <div class="profile-row">
                    <div class="profile-label">Estado:</div>
                    <div class="profile-value">
                        <span class="{{ $instructor->instructor_status->name ? 'status-active' : 'status-inactive' }}">
                            {{ $instructor->instructor_status->name ?? 'Desconocido' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <script>
        // Búsqueda en tiempo real
        document.getElementById('filtroDocumento').addEventListener('input', function() {
            const filtro = this.value.trim().toLowerCase();
            const filas = document.querySelectorAll('table tbody tr');

            filas.forEach(fila => {
                if (fila.cells.length > 1) { // Asegura que es una fila de datos
                    const documento = fila.cells[1].textContent.toLowerCase();
                    fila.style.display = documento.includes(filtro) ? '' : 'none';
                }
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
