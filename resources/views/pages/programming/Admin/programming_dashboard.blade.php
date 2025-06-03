<x-layout>
    <x-slot:page_style>css/pages/Programming/style_programans.css</x-slot:page_style>
    <x-slot:title>CAA</x-slot:title>
    <link rel="stylesheet" href="{{ asset('css/pages/Programming/style_programans.css') }}">


    <h3>Lista de Programas</h3>

    <!-- Botón para abrir modal -->
    <a  href="#" onclick="openModal()" class="submit-btn">➕ Agregar Programa</a>

    <!-- Tabla de programas -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Código del Programa</th>
                <th>Programa</th>
                <th>Versión</th>
                <th>Nivel</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
                <tr>
                    <td>{{ $program->program_code }}</td>
                    <td>{{ $program->name }}</td>
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
            <button class="close-btn" onclick="closeModal()" aria-label="Cerrar modal">&times;</button>
            <h2>Registrar Nuevo Programa</h2>

            <form method="POST" action="{{ route('programming.admin') }}" class="program-form">
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


</x-layout>
