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
            background-color: #eef2f6;
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            padding: 25px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.08);
        }

        h2 {
            font-size: 28px;
            margin-bottom: 25px;
            color: #2c3e50;
            font-weight: 700;
            text-align: center;
        }

        /* Botones */
        .btn {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease, transform 0.2s ease;
            display: inline-block;
        }

        .btn:hover {
            transform: translateY(-1px);
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
            max-width: max-content;
            background-color: #5bc0de;
            color: white;
        }

        .btn-edit:hover {
            background-color: #31b0d5;
        }

        /* Tabla */
        .table-container {
            max-height: 400px; /* Altura máxima con scroll */
            overflow-y: auto;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            color: #444;
        }

        thead th {
            background-color: #e9ecef;
            font-weight: 700;
            padding: 12px;
            text-align: left;
            border-bottom: 2px solid #dee2e6;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        tbody td {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Alertas */
        .alert-success,
        .alert-danger {
            padding: 12px 15px;
            margin-bottom: 20px;
            border-radius: 6px;
            font-weight: 600;
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
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            inset: 0;
            background-color: rgba(0, 0, 0, 0.45);
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .modal-content {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0px 6px 20px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .close {
            color: #888;
            position: absolute;
            top: 12px;
            right: 18px;
            font-size: 26px;
            font-weight: 700;
            cursor: pointer;
        }

        .close:hover {
            color: #444;
        }

        .modal-content h3 {
            margin-bottom: 20px;
            font-weight: 700;
            color: #2c3e50;
            text-align: center;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: #555;
        }


        .form-group select,
        .form-group input {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.4);
        }
        button{
          margin-bottom: 10px;
        }


        .form-group button {

            max-width: ;: 100%;
        }
    </style>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert-danger">{{ session('error') }}</div>
    @endif

    <div class="container">
        <h2>Listado de Competencias</h2>

        <button class="btn btn-success" onclick="document.getElementById('competenceModal').style.display='flex'">
             Registrar
        </button>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Duración (horas)</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($competencies as $competence)
                        <tr>
                            <td>{{ $competence->id }}</td>
                            <td>{{ $competence->name }}</td>
                            <td>{{ $competence->duration_hours }} hr</td>
                            <td>
                                <button class="btn btn-edit"
                                    onclick="openEditModal({{ $competence->id }}, '{{ $competence->name }}', {{ $competence->duration_hours }}, {{ $competence->speciality_id }})">
                                    ✏️ Editar
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; font-style: italic; color: #888;">
                                No hay competencias registradas.
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

                <div class="form-group">
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

                <div class="form-group">
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
