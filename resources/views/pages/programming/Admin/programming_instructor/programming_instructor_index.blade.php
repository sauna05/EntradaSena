<x-layout>
    <x-slot:title>Listado de Instructores</x-slot:title>

    <style>
        .container {
            padding: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 6px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            border: 1px solid #f3f0f0;
            background-color: white;
        }

        h2.title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        thead {
            background-color: #ecf0f1;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .btn-ver-perfil {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background-color: #2980b9;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 15px;
            transition: background 0.2s, box-shadow 0.2s;
            box-shadow: 0 2px 6px rgba(41, 128, 185, 0.08);
        }

        .btn-ver-perfil:hover {
            background-color: #1d5a8b;
            box-shadow: 0 4px 12px rgba(41, 128, 185, 0.15);
        }

        .btn-ver-perfil svg {
            width: 18px;
            height: 18px;
            vertical-align: middle;
            fill: white;
        }

        /* Estilos para el modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 70%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .profile-section {
            margin-bottom: 20px;
        }

        .profile-section h3 {
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
            color: #2c3e50;
        }

        .profile-row {
            display: flex;
            margin-bottom: 10px;
        }

        .profile-label {
            font-weight: bold;
            width: 200px;
            color: #7f8c8d;
        }

        .profile-value {
            flex: 1;
        }
    </style>


    <div class="container">
        <div style="margin-bottom: 20px;">
            <label for="filtroDocumento"><strong>Busqueda por documento:</strong></label>
            <input type="text" id="filtroDocumento" placeholder="Escribe el documento..." style="padding: 6px 10px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <h2 class="title">Listado de Instructores</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Especialidad</th>
                    <th>Horas A Ejecutar</th>
                    <th>Meses de Contrato</th>
                    <th>Horas por día</th>
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
                            <button class="btn-ver-perfil" onclick="openModal('{{ $instructor->id }}')" title="Ver perfil">
                                <!-- SVG de usuario/ojos -->
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 13c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zm0-10a4 4 0 100 8 4 4 0 000-8z"/>
                                </svg>
                                Ver Perfil
                            </button>
                        </td>
                    </tr>

                    <!-- Modal para cada instructor -->
                    <div id="modal-{{ $instructor->id }}" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('{{ $instructor->id }}')">&times;</span>
                            <h2>Perfil del Instructor</h2>

                            <div class="profile-section">
                                <h3>Información Personal</h3>
                                <div class="profile-row">
                                    <div class="profile-label">Nombre completo:</div>
                                    <div class="profile-value">{{ $instructor->person->name }}</div>
                                </div>
                                <div class="profile-row">
                                    <div class="profile-label">Documento:</div>
                                    <div class="profile-value">{{ $instructor->person->document_number }}</div>
                                </div>
                                <div class="profile-row">
                                    <div class="profile-label">Email:</div>
                                    <div class="profile-value">{{ $instructor->person->email }}</div>
                                </div>
                                <div class="profile-row">
                                    <div class="profile-label">Teléfono:</div>
                                    <div class="profile-value">{{ $instructor->person->phone ?? 'No registrado' }}</div>
                                </div>
                            </div>
                            <div class="profile-section">
                                <h3>Información Profesional</h3>
                                <div class="profile-row">
                                    <div class="profile-label">Tipo vinculación:</div>
                                    <div class="profile-value">{{ $instructor->link_types->name }}</div>
                                </div>
                                <div class="profile-row">
                                    <div class="profile-label">Especialidad:</div>
                                    <div class="profile-value">{{ $instructor->speciality->name }}</div>
                                </div>
                                <div class="profile-row">
                                    <div class="profile-label">Horas asignadas:</div>
                                    <div class="profile-value">{{ $instructor->assigned_hours }} horas</div>
                                </div>
                                <div class="profile-row">
                                    <div class="profile-label">Horas restantes :</div>
                                    <div class="profile-value">{{ $instructor->horas_restantes}} horas</div>
                                </div>
                                <div class="profile-row">
                                    <div class="profile-label">Meses de contrato:</div>
                                    <div class="profile-value">{{ $instructor->months_contract ?? 'No especificado' }}</div>
                                </div>
                                <div class="profile-row">
                                    <div class="profile-label">Zona:</div>
                                    <div class="profile-value">{{ $instructor->zona ?? 'No especificada' }}</div>
                                </div>
                            </div>

                            <div class="profile-section">
                                <h3>Otra Información</h3>
                                <div class="profile-row">
                                    <div class="profile-label">Estado:</div>
                                    <div class="profile-value">
                                        <span style="color: {{ $instructor->instructor_status->name ? 'green' : 'red' }}">
                                            {{ $instructor->instructor_status->name ? 'Activo' : 'Inactivo' }}
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

    <script>
        document.getElementById('filtroDocumento').addEventListener('input', function() {
        const filtro = this.value.trim().toLowerCase();
        const filas = document.querySelectorAll('table tbody tr');
        filas.forEach(fila => {
            // El documento está en la segunda celda (índice 1)
            const documento = fila.children[1].textContent.toLowerCase();
            if (documento.includes(filtro)) {
                fila.style.display = '';
            } else {
                fila.style.display = 'none';
            }
        });
    });
        function openModal(instructorId) {
            document.getElementById('modal-' + instructorId).style.display = 'block';
        }

        function closeModal(instructorId) {
            document.getElementById('modal-' + instructorId).style.display = 'none';
        }

        // Cerrar el modal si se hace clic fuera del contenido
        window.onclick = function(event) {
            document.querySelectorAll('.modal').forEach(modal => {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        }
    </script>
</x-layout>
