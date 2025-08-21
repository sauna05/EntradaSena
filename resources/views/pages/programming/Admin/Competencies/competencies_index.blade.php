<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Listado de Competencias</x-slot:title>

    <style>
        /* Reset básico */
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
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.5;
        }

        /* Botones */
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
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #007bff;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #0069d9;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-success {
            background-color: #28a745;
            color: #fff;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-edit {
            background-color: #17a2b8;
            color: white;
            padding: 8px 15px;
            font-size: 14px;
        }

        .btn-edit:hover {
            background-color: #138496;
        }

        .btn-search {
            background-color: #6c757d;
            color: white;
            padding: 10px 20px;
        }

        .btn-search:hover {
            background-color: #5a6268;
        }

        /* Search box */
        .search-container {
            display: flex;
            margin-bottom: 25px;
            max-width: 500px;
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
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Alertas */
        .alert-success,
        .alert-danger {
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
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
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            position: relative;
            animation: modalFadeIn 0.3s ease;
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

        .modal-content h3 {
            margin-bottom: 25px;
            font-weight: 700;
            color: #2c3e50;
            text-align: center;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #374151;
        }

        .form-group select,
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
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

        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
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
        }
    </style>

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
                <h1>Gestión de Competencias</h1>
                <p>En esta sección se gestionan las competencias del sistema. Puede registrar nuevas competencias,
                editarlas o buscarlas por nombre. Cada competencia está asociada a una especialidad y tiene una duración específica.
          </p>
        </div>

        <div class="action-buttons">
            <button class="btn btn-success" onclick="document.getElementById('competenceModal').style.display='flex'">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="12" y1="5" x2="12" y2="19"></line>
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                </svg>
                Registrar
            </button>

            <form method="GET" class="search-container">
                <input type="text" name="buscar" class="search-input" placeholder="Buscar por nombre..." value="{{ request('buscar') }}">
                <button type="submit" class="btn btn-search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Buscar
                </button>
            </form>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Duración (horas)</th>
                        <th>Especialidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $contador=0;

                    @endphp
                    @forelse($competencies as $competence)
                            @php
                                $contador=$contador +1;
                            @endphp
                        <tr>
                            <td>{{ $contador }}</td>
                            <td>{{ $competence->name }}</td>
                            <td>{{ $competence->duration_hours }} hr</td>
                            <td>
                                @php
                                    $specialityName = $especialidad->firstWhere('id', $competence->speciality_id)->name ?? 'N/A';
                                @endphp
                                {{ $specialityName }}
                            </td>
                            <td>
                                <button class="btn btn-edit"
                                    onclick="openEditModal({{ $competence->id }}, '{{ $competence->name }}', {{ $competence->duration_hours }}, {{ $competence->speciality_id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Editar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                    <p>No se encontraron competencias</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Registrar -->
    <div id="competenceModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('competenceModal').style.display='none'">&times;</span>
            <h3>Registrar Nueva Competencia</h3>

            <form method="POST" action="{{ route('programing.competencies_store') }}">
                @csrf
                <div class="form-group">
                    <label for="speciality_id">Especialidad</label>
                    <select name="speciality_id" id="speciality_id" required>
                        <option value="">Seleccione especialidad</option>
                        @forelse ($especialidad as $espe)
                            <option value="{{ $espe->id }}">{{ $espe->name }}</option>
                        @empty
                            <option value="">No hay especialidades</option>
                        @endforelse
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Nombre de la competencia</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="duration_hours">Duración (horas)</label>
                    <input type="number" id="duration_hours" name="duration_hours" required min="1">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('competenceModal').style.display='none'">Cancelar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar -->
    <div id="editCompetenceModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('editCompetenceModal').style.display='none'">&times;</span>
            <h3>Editar Competencia</h3>

            <form id="editCompetenceForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="edit_speciality_id">Especialidad</label>
                    <select name="speciality_id" id="edit_speciality_id" required>
                        <option value="">Seleccione especialidad</option>
                        @foreach ($especialidad as $espe)
                            <option value="{{ $espe->id }}">{{ $espe->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="edit_name">Nombre de la competencia</label>
                    <input type="text" id="edit_name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="edit_duration_hours">Duración (horas)</label>
                    <input type="number" id="edit_duration_hours" name="duration_hours" required min="1">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="document.getElementById('editCompetenceModal').style.display='none'">Cancelar</button>
                    <button type="submit" class="btn btn-edit">Actualizar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, name, duration, specialityId) {
            const modal = document.getElementById('editCompetenceModal');
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_duration_hours').value = duration;
            document.getElementById('edit_speciality_id').value = specialityId;
            document.getElementById('editCompetenceForm').action = `/programming/admin/competencie_update/${id}`;
            modal.style.display = 'flex';
        }

        window.onclick = function(event) {
            const modals = [document.getElementById('competenceModal'), document.getElementById('editCompetenceModal')];
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
</x-layout>
