<x-layout>
    <x-slot:title>Listado de Instructores</x-slot:title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f8;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0,0,0,0.08);
        }

        h2.title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #2c3e50;
            text-align: center;
        }

        .search-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            max-width: 400px;
            margin: 0 auto 30px;
            position: relative;
        }

        .search-wrapper input {
            width: 100%;
            padding: 10px 40px 10px 14px;
            font-size: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        .search-wrapper i {
            position: absolute;
            right: 14px;
            color: #888;
        }

        .table-container {
            max-height: 450px;
            overflow-y: auto;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14.5px;
            background-color: white;
        }

        thead {
            background-color: #f5f7fa;
            position: sticky;
            top: 0;
            z-index: 1;
        }

        th, td {
            padding: 12px 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        tr:hover {
            background-color: #f9f9f9;
        }

        .btn-ver-perfil {
            background-color: #3498db;
            color: white;
            padding: 6px 14px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background 0.3s ease;
        }

        .btn-ver-perfil:hover {
            background-color: #2270ad;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow-y: auto;
            background-color: rgba(0,0,0,0.5);
            padding: 20px;
        }

        .modal-content {
            background-color: #fff;
            margin: 60px auto;
            padding: 20px 30px;
            border-radius: 8px;
            max-width: 750px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .close {
            float: right;
            font-size: 26px;
            font-weight: bold;
            color: #888;
            cursor: pointer;
        }

        .close:hover {
            color: #000;
        }

        .profile-section {
            margin-bottom: 20px;
        }

        .profile-section h3 {
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            color: #2c3e50;
        }

        .profile-row {
            display: flex;
            margin-bottom: 8px;
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
    </style>

    <div class="container">
        <div class="search-wrapper">
            <input type="text" id="filtroDocumento" placeholder="Buscar por documento...">
            <i class="fas fa-search"></i>
        </div>

        <h2 class="title">Listado de Instructores</h2>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Especialidad</th>
                        <th>Horas a Ejecutar</th>
                        <th>Meses de Contrato</th>
                        <th>Horas por Día</th>
                        <th>Zona</th>
                        <th>Perfil</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($instructores as $index => $instructor)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $instructor->person->document_number }}</td>
                            <td>{{ $instructor->person->name ?? 'Sin nombre' }}</td>
                            <td>{{ $instructor->person->email ?? 'Sin email' }}</td>
                            <td>{{ $instructor->speciality->name }}</td>
                            <td>{{ $instructor->assigned_hours }} hr</td>
                            <td>{{ $instructor->months_contract ?? 'Meses' }}</td>
                            <td>{{ $instructor->hours_day }} hr</td>
                            <td>{{ $instructor->zona ?? 'Sin zona' }}</td>
                            <td>
                                <button class="btn-ver-perfil" onclick="openModal('{{ $instructor->id }}')">
                                    <i class="fas fa-user-circle"></i> Ver
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de perfil -->
                        <div id="modal-{{ $instructor->id }}" class="modal">
                            <div class="modal-content">
                                <span class="close" onclick="closeModal('{{ $instructor->id }}')">&times;</span>
                                <h2>Perfil del Instructor</h2>

                                <div class="profile-section">
                                    <h3>Información Personal</h3>
                                    <div class="profile-row"><div class="profile-label">Nombre:</div><div class="profile-value">{{ $instructor->person->name }}</div></div>
                                    <div class="profile-row"><div class="profile-label">Documento:</div><div class="profile-value">{{ $instructor->person->document_number }}</div></div>
                                    <div class="profile-row"><div class="profile-label">Email:</div><div class="profile-value">{{ $instructor->person->email }}</div></div>
                                    <div class="profile-row"><div class="profile-label">Teléfono:</div><div class="profile-value">{{ $instructor->person->phone ?? 'No registrado' }}</div></div>
                                </div>

                                <div class="profile-section">
                                    <h3>Información Profesional</h3>
                                    <div class="profile-row"><div class="profile-label">Vinculación:</div><div class="profile-value">{{ $instructor->link_types->name }}</div></div>
                                    <div class="profile-row"><div class="profile-label">Especialidad:</div><div class="profile-value">{{ $instructor->speciality->name }}</div></div>
                                    <div class="profile-row"><div class="profile-label">Horas asignadas:</div><div class="profile-value">{{ $instructor->assigned_hours }} horas</div></div>
                                    <div class="profile-row"><div class="profile-label">Horas cumplidas:</div><div class="profile-value">{{ $instructor->horas_programadas }} horas</div></div>
                                    <div class="profile-row"><div class="profile-label">Horas restantes:</div><div class="profile-value">{{ $instructor->horas_restantes }} horas</div></div>
                                    {{-- <div class="profile-row"><div class="profile-label">Meses contrato:</div><div class="profile-value">{{ $instructor->months_contract ?? 'No especificado' }}</div></div> --}}
                                    <div class="profile-row"><div class="profile-label">Zona:</div><div class="profile-value">{{ $instructor->zona ?? 'No especificada' }}</div></div>
                                </div>

                                <div class="profile-section">
                                    <h3>Estado</h3>
                                    <div class="profile-row">
                                        <div class="profile-label">Estado actual:</div>
                                        <div class="profile-value">
                                            <span style="color: {{ $instructor->instructor_status->name ? 'green' : 'red' }}">
                                                {{ $instructor->instructor_status->name ?? 'Desconocido' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.getElementById('filtroDocumento').addEventListener('input', function() {
            const filtro = this.value.trim().toLowerCase();
            const filas = document.querySelectorAll('table tbody tr');
            filas.forEach(fila => {
                const documento = fila.children[1].textContent.toLowerCase();
                fila.style.display = documento.includes(filtro) ? '' : 'none';
            });
        });

        function openModal(id) {
            document.getElementById('modal-' + id).style.display = 'block';
        }

        function closeModal(id) {
            document.getElementById('modal-' + id).style.display = 'none';
        }

        window.onclick = function(event) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        };
    </script>
</x-layout>
