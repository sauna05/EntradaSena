<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Listado de Competencias</x-slot:title>

    <style>
        /* Estilos generales */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #2c3e50;
            font-weight: 700;
            text-align: center;
        }

        .btn-primary {
            background-color: #6c757d;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto 25px auto;
            width: 220px;
            text-align: center;
            user-select: none;
        }

        .btn-primary:hover {
            background-color: #5a6268;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
            margin: 0 auto;
            width: 95%;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #f8f9fa;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            color: #444;
        }

      table th, table td {
    padding: 8px 14px;
    border-bottom: 1px solid #ddd;
    text-align: left;
}


        table th {
            background-color: #e9ecef;
            font-weight: 700;
            color: #495057;
            position: sticky;
            top: 0;
            z-index: 2;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        .alert-success,
        .alert-danger {
            width: 100%;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-weight: 600;
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

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.45);
            display: none;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .modal-content {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            position: relative;
        }

        .close {
            color: #888;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: 700;
            cursor: pointer;
            transition: color 0.3s ease;
            user-select: none;
        }

        .close:hover {
            color: #444;
        }

        .modal-content h3 {
            margin-top: 0;
            margin-bottom: 25px;
            font-weight: 700;
            color: #2c3e50;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group select,
        .form-group input {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group select:focus {
            outline: none;
            border-color: #6c757d;
            box-shadow: 0 0 5px rgba(108, 117, 125, 0.5);
        }

        .form-group button {
            background-color: #6c757d;
            color: white;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            user-select: none;
        }

        .form-group button:hover {
            background-color: #5a6268;
        }
    </style>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <h2>Listado de Competencias</h2>

        <button class="btn-primary" onclick="document.getElementById('competenceModal').style.display='flex'">
            Registrar Competencia
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
                        <button class="btn-primary" style="width:auto; padding:8px 16px;"
                            onclick="openEditModal({{ $competence->id }}, '{{ $competence->name }}', {{ $competence->duration_hours }}, {{ $competence->speciality_id }})">
                            <i class="fa fa-pen-to-square" style="margin-right:6px;"></i>Editar
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
                    <button type="submit">Guardar Competencia</button>
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
                    <button type="submit">Actualizar Competencia</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script -->
    <script>
        function openEditModal(id, name, duration, specialityId) {
            const modal = document.getElementById('editCompetenceModal');
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_duration_hours').value = duration;
            document.getElementById('edit_speciality_id').value = specialityId;

            const form = document.getElementById('editCompetenceForm');
            form.action = `/programming/admin/competencie_update/${id}`;

            modal.style.display = 'flex';
        }

        window.onclick = function(event) {
            const modals = [
                document.getElementById('competenceModal'),
                document.getElementById('editCompetenceModal')
            ];
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        }
    </script>
</x-layout>
