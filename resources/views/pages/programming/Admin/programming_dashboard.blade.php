<x-layout>
    <x-slot:page_style>css/pages/Programming/style_programans.css</x-slot:page_style>
    <x-slot:title>Gestión de Programas</x-slot:title>

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

        /* Botones */
        .btn-primary {
            background-color: #28a745;
            color: white;
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
            margin-bottom: 25px;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Tabla */
        .table-container {
            max-height: 600px;
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

        /* Badge para nivel */
        .badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-technical {
            background-color: #e9f5ff;
            color: #0066cc;
        }

        .badge-technologist {
            background-color: #e6f7ee;
            color: #0b8c56;
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

        .alert-danger ul {
            margin: 10px 0 0 20px;
        }

        /* Modal */
        .modal-overlay {
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
            max-width: 600px;
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

        .close-btn {
            color: #888;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: 700;
            cursor: pointer;
            transition: color 0.2s;
            background: none;
            border: none;
        }

        .close-btn:hover {
            color: #444;
        }

        .modal-content h2 {
            margin-bottom: 25px;
            color: #2c3e50;
            text-align: center;
            font-size: 24px;
        }

        /* Formulario */
        .program-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
            font-size: 16px;
        }

        .form-group input,
        .form-group select {
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
        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #218838;
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

        /* Responsive */
        @media (max-width: 1024px) {
            .container {
                padding: 20px;
                margin: 15px;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 800px;
            }

            .modal-content {
                margin: 20px;
                padding: 20px;
            }
        }
    </style>

    <div class="container">

          <div class="dashboard-header">
                <h1>Gestión de Programas de Formación</h1>
                <p> En esta sección puede administrar todos los programas de formación disponibles en el centro.
            Registre nuevos programas, consulte la información existente y gestione la asignación de
            instructores responsables para cada programa formativo.
          </p>
        </div>
        <button class="btn-primary" onclick="openModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Registrar Nuevo Programa
        </button>

        <!-- Alertas -->
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

        @if ($errors->any())
            <div class="alert-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <div>
                    <strong>Por favor, corrige los siguientes errores:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <!-- Tabla de programas -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Código del Programa</th>
                        <th>Nombre del Programa</th>
                        <th>Versión</th>
                        <th>Nivel</th>
                        <th>Instructor Responsable</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programs as $program)
                        <tr>
                            <td><strong>{{ $program->program_code }}</strong></td>
                            <td>{{ $program->name }}</td>
                            <td>{{ $program->program_version }}</td>
                            <td>
                                <span class="badge {{ $program->id_level == 1 ? 'badge-technical' : 'badge-technologist' }}">
                                    {{ $program->id_level == 1 ? 'Técnico' : 'Tecnólogo' }}
                                </span>
                            </td>
                            <td>{{ $program->instructor->person->name }}</td>
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
                                    <p>No hay programas registrados</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal de registro -->
        <div id="programModal" class="modal-overlay">
            <div class="modal-content">
                <button class="close-btn" onclick="closeModal()">&times;</button>
                <h2>Registrar Nuevo Programa</h2>

                <form method="POST" action="{{ route('programing.programan_store_add') }}" class="program-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nombre del Programa</label>
                        <input type="text" name="name" id="name" required placeholder="Ingrese el nombre del programa">
                    </div>

                    <div class="form-group">
                        <label for="program_code">Código del Programa</label>
                        <input type="text" name="program_code" id="program_code" required placeholder="Ej: PROG-001">
                    </div>

                    <div class="form-group">
                        <label for="program_version">Versión del Programa</label>
                        <input type="text" name="program_version" id="program_version" required placeholder="Ej: 1.0">
                    </div>

                    <div class="form-group">
                        <label for="id_level">Nivel del Programa</label>
                        <select name="id_level" id="id_level" required>
                            <option value="">Seleccione el nivel</option>
                            @foreach ($programan_level as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="instructor_id">Instructor Responsable</label>
                        <select name="instructor_id" id="instructor_id" required>
                            <option value="">Seleccione el instructor</option>
                            @foreach ($instructors as $instru)
                                <option value="{{ $instru->id }}">{{ $instru->person->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-submit" style="background-color: #6c757d;" onclick="closeModal()">Cancelar</button>
                        <button type="submit" class="btn-submit">Registrar Programa</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('programModal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('programModal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('programModal');
            if (event.target === modal) {
                closeModal();
            }
        }

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });

        // Auto-focus en el primer campo al abrir el modal
        document.getElementById('programModal').addEventListener('shown', function() {
            document.getElementById('name').focus();
        });
    </script>
</x-layout>
