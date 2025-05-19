<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>CAA</x-slot:title>
    <x-programming_navbar></x-programming_navbar>

    <h3>Lista de Programas</h3>

    <!-- Botón para abrir modal -->
    <a href="#" onclick="openModal()" class="submit-btn">Agregar Programa</a>

    <!-- Tabla de programas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Programa</th>
                <th>Código del Programa</th>
                <th>Versión</th>
                <th>Nivel</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
                <tr>
                    <td>{{ $program->name }}</td>
                    <td>{{ $program->program_code }}</td>
                    <td>{{ $program->program_version }}</td>
                    <td>{{ $program->id_level == 1 ? 'Técnico' : 'Tecnólogo' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Mostrar mensajes -->
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

    <!-- Modal de registro -->
    <div id="programModal" class="modal-overlay" style="display: none;">
        <div class="modal-content">
            <span class="close-btn" onclick="closeModal()">&times;</span>
            <h2>Registrar Nuevo Programa</h2>

            <form method="POST" action="{{ route('programming.admin') }}" class="program-form">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre del Programa</label>
                    <input type="text" name="name" id="name" required>
                </div>

                <div class="form-group">
                    <label for="program_code">Código del Programa</label>
                    <input type="text" name="program_code" id="program_code" required>
                </div>

                <div class="form-group">
                    <label for="program_version">Versión del Programa</label>
                    <input type="text" name="program_version" id="program_version" required>
                </div>

                <div class="form-group">
                    <label for="id_level">Nivel del Programa</label>
                    <select name="id_level" id="id_level" required>
                        <option value="">Seleccione nivel</option>
                        @foreach ($programan_level as $level)
                            <option value="{{ $level->id }}">{{ $level->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <button type="submit" class="submit-btn">Registrar Programa</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts para el modal -->
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

    <!-- Estilos personalizados -->
    <style>
        .program-form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
            display: inline-block;
            margin-top: 15px;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            width: 90%;
            max-width: 500px;
            border-radius: 8px;
            position: relative;
            box-shadow: 0 0 10px rgba(0,0,0,0.25);
        }

        .close-btn {
            position: absolute;
            top: 10px; right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #555;
        }

        .close-btn:hover {
            color: black;
        }
    </style>
</x-layout>
