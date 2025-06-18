<x-layout>
    <x-slot:page_style>css/pages/Programming/style_programans.css</x-slot:page_style>
    <x-slot:title>CAA</x-slot:title>

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
        /* Botones */
        .submit-btn {
            background-color: #ffffff;
            border: 2px solid #9ca3af;
            color: #374151;
            padding: 12px 24px;
            font-weight: 600;
            text-decoration: none;
            font-size: 15px;
            border-radius: 10px;
            cursor: pointer;
            display: inline-block;
            transition: all 0.3s ease;
            margin-bottom: 20px;
            user-select: none;
        }

        .submit-btn:hover,
        .submit-btn:focus {
            background-color: #e5e7eb;
            border-color: #6b7280;
            color: #111827;
            outline: none;
        }

        /* Alertas */
        .alert {
            padding: 14px 20px;
            border-radius: 8px;
            font-size: 14px;
            margin-top: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        .alert-success {
            background-color: #d1fae5;
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        /* Listas de errores */
        .alert-danger ul {
            margin: 5px 0 0;
            padding-left: 20px;
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.4);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            padding: 10px;
        }

        .modal-content {
            background-color: #ffffff;
            padding: 30px;
            max-width: 500px;
            width: 100%;
            border-radius: 14px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            display: flex;
            flex-direction: column;
            animation: fadeIn 0.3s ease;
        }

        .modal-content h2 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #1f2937;
            font-size: 20px;
        }

        .close-btn {
            position: absolute;
            top: 14px;
            right: 18px;
            background: transparent;
            border: none;
            font-size: 24px;
            font-weight: 700;
            color: #9ca3af;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .close-btn:hover {
            color: #4b5563;
        }

        /* Formularios */
        .program-form {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .form-group {
            margin-bottom: 18px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            padding: 12px 14px;
            font-size: 15px;
            border: 1.5px solid #d1d5db;
            border-radius: 10px;
            background-color: #f9fafb;
            color: #111827;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #6366f1;
            background-color: #ffffff;
            outline: none;
        }

        /* Botón dentro del formulario */
        .program-form button.submit-btn {
            background-color: #111827;
            color: #ffffff;
            font-size: 16px;
            border-radius: 12px;
            padding: 14px;
            font-weight: 700;
            border: none;
            transition: background-color 0.3s ease;
        }

        .program-form button.submit-btn:hover,
        .program-form button.submit-btn:focus {
            background-color: #1f2937;
            outline: none;
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.98);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>

    <!-- Contenido principal -->
    <h1>Programación Cursos</h1>
    <div class="container">
        <main>


            <!-- Botón para abrir modal -->
            <a href="#" onclick="openModal()" class="submit-btn">Registrar Programa</a>

            <!-- Tabla de programas -->
            <div class="table-responsive">
                <h4>Programas Disponibles</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código del Programa</th>
                            <th>Programa</th>
                            <th>Versión</th>
                            <th>Nivel</th>
                            <th>Instructor A cargo</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($programs as $program)
                            <tr>
                                <td>{{ $program->program_code }}</td>
                                <td>{{ $program->name }}</td>
                                <td>{{ $program->program_version }}</td>
                                <td>{{ $program->id_level == 1 ? 'Técnico' : 'Tecnólogo' }}</td>
                                <td>{{ $program->instructor->person->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mensajes de estado -->
            <section class="messages">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </section>

            <!-- Modal de registro -->
            <div id="programModal" class="modal-overlay" style="display: none;">
                <div class="modal-content">
                    <button class="close-btn" onclick="closeModal()" aria-label="Cerrar modal">&times;</button>
                    <h2>Registrar Nuevo Programa</h2>

                    <form method="POST" action="{{ route('programing.programan_store_add') }}" class="program-form">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nombre del Programa</label>
                            <input type="text" name="name" id="name" required autocomplete="off" />
                        </div>

                        <div class="form-group">
                            <label for="program_code">Código del Programa</label>
                            <input type="text" name="program_code" id="program_code" required autocomplete="off" />
                        </div>

                        <div class="form-group">
                            <label for="program_version">Versión del Programa</label>
                            <input type="text" name="program_version" id="program_version" required autocomplete="off" />
                        </div>

                        <div class="form-group">
                            <label for="id_level">Nivel del Programa</label>
                            <select name="id_level" id="id_level" required>
                                <option value="" disabled selected>Seleccione nivel</option>
                                @foreach ($programan_level as $level)
                                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="instructor_id">Instructor Responsable del Programa</label>
                            <select name="instructor_id" id="instructor_id" required>
                                <option value="" disabled selected>Seleccione instructor</option>
                                @foreach ($instructors as $instru)
                                    <option value="{{ $instru->id }}">{{ $instru->person->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="submit-btn">Registrar Programa</button>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <!-- Scripts -->
        <script>
            function openModal() {
                document.getElementById('programModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('programModal').style.display = 'none';
            }

            window.onclick = function(event) {
                const modal = document.getElementById('programModal');
                if (event.target === modal) {
                    closeModal();
                }
            }
        </script>
    </div>
</x-layout>