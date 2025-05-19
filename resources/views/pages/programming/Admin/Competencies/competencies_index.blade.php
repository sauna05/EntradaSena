<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Listado de Competencias</x-slot:title>
    <x-programming_navbar></x-programming_navbar>



    <style>
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        table th {
            background-color: #ecf0f1;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 30px;
            border-radius: 8px;
            width: 400px;
            position: relative;
        }

        .close {
            color: #aaa;
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .form-group {
            margin-top: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input {
            width: 100%;
            padding: 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        .form-group button {
            margin-top: 15px;
            width: 100%;
        }
    </style>

    @if(session('success'))
        <div style="background: #2ecc71; color: white; padding: 10px; margin-bottom: 15px; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif


    <div class="container">
        <h2>Listado de Competencias</h2>

        <button class="btn-primary" onclick="document.getElementById('competenceModal').style.display='block'">Registrar Competencia</button>

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
                        <td>{{ $competence->duration_hours }}</td>
                        <td>{{ $competence->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay competencias registradas.</td>
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
                    <label>Nombre de la competencia</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Duración (horas)</label>
                    <input type="number" name="duration_hours" required min="1">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn-primary">Guardar Competencia</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para cerrar modal al hacer clic fuera del contenido -->
    <script>
        window.onclick = function(event) {
            const modal = document.getElementById('competenceModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>

</x-layout>

