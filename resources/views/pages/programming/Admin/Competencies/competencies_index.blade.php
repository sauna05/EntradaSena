<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Listado de Competencias</x-slot:title>


    <style>
        .container {
            max-width: 900%; /* ancho limitado */
            margin: 40px auto;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        h2 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #2c3e50;
            font-weight: 700;
            text-align: center;
        }

        .btn-primary {
            background-color: #6c757d; /* gris oscuro */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto 25px auto;
            width: 200px;
            text-align: center;
            user-select: none;
        }

        .btn-primary:hover {
            background-color: #5a6268; /* gris más oscuro al hover */
        }

        table {
            width: 90%; /* menos ancho para no ocupar todo */
            margin: 0 auto;
            border-collapse: collapse;
            font-size: 15px;
            color: #444;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        table th, table td {
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #e9ecef;
            font-weight: 700;
            color: #495057;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Mensaje éxito */
        .alert-success {
            max-width: 900px;
            margin: 20px auto;
            background-color: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(21, 87, 36, 0.2);
            font-weight: 600;
            font-size: 14px;
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
            display: flex;
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
        .form-group select{
             padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .form-group input {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
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

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <h2>Listado de Competencias</h2>

        <button class="btn-primary" onclick="document.getElementById('competenceModal').style.display='flex'">
            Registrar Competencia
        </button>

        <!-- Tabla de Competencias -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Duración (horas)</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($competencies as $competence)
                    <tr>
                        <td>{{ $competence->id }}</td>
                        <td>{{ $competence->name }}</td>
                        <td>{{ $competence->duration_hours }} hr </td>
                        <td>{{ $competence->created_at->format('d/m/Y') }}</td>
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

    <!-- Modal para Registrar Competencia -->
    <div id="competenceModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('competenceModal').style.display='none'">&times;</span>
            <h3>Registrar Nueva Competencia</h3>

            <form method="POST" action="{{ route('programing.competencies_store') }}">
                @csrf
                <div class="form-group">
                    <label for="">Especialidad</label>
                    <select name="speciality_id" id="">
                        <option value="">selecione especialidad</option>
                        @forelse ($especialidad as $espe )
                            <option value="{{ $espe->id }}">{{$espe->name}} </option>
                        @empty

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

    <!-- Script para cerrar modal al hacer clic fuera del contenido -->
    <script>
        window.onclick = function(event) {
            const modal = document.getElementById('competenceModal');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>

</x-layout>

