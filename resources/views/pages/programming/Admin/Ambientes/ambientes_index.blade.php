<x-layout>
    <x-slot:title>Gestión de Ambientes</x-slot:title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        /* Alertas mejoradas */
        .alert-success, .alert-danger {
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            border-left: 4px solid #dc3545;
        }

        /* Filtros mejorados */
        .filters-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
            align-items: end;
        }

        .filter-group {
            flex: 1;
            min-width: 200px;
        }

        .filter-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #374151;
            font-size: 16px;
        }

        .filter-group select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .filter-group select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        /* Botón registrar mejorado */
        .btn-register {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-register:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Tabla mejorada */
        .table-wrapper {
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
            vertical-align: top;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        /* Badges mejorados */
        .badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            margin: 2px;
        }

        .bg-danger {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .bg-success {
            background-color: #d1fae5;
            color: #065f46;
        }

        .bg-light {
            background-color: #f3f4f6;
            color: #374151;
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 600;
        }

        /* Botones de acción mejorados */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .btn-edit, .btn-delete {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
        }

        .btn-edit {
            background-color: #e0f2fe;
            color: #0369a1;
        }

        .btn-edit:hover {
            background-color: #bae6fd;
            transform: translateY(-1px);
        }

        .btn-delete {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .btn-delete:hover {
            background-color: #fecaca;
            transform: translateY(-1px);
        }

        /* Modales mejorados */
        .modal {
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
            max-width: 500px;
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

        .close {
            color: #888;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: 700;
            cursor: pointer;
            transition: color 0.2s;
        }

        .close:hover {
            color: #444;
        }

        .modal-content h2 {
            margin-bottom: 25px;
            color: #2c3e50;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #374151;
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


        .form-group select,
        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-group select:focus,
        .form-group input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
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
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        /* Textos mejorados */
        .text-muted {
            color: #6b7280;
            font-style: italic;
        }

        .align-middle {
            vertical-align: middle;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .container {
                padding: 20px;
                margin: 15px;
            }

            .filters-container {
                flex-direction: column;
            }

            .table-wrapper {
                overflow-x: auto;
            }
        }

        /* Estilos específicos para programación */
        .bloque-fecha {
            margin-bottom: 15px;
            padding: 12px;
            border-radius: 8px;
            background-color: #f9fafb;
            border: 1px solid #e5e7eb;
        }

        .instructor-info {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
    </style>

    <div class="container">
           <div class="dashboard-header">
                <h1>Gestión de Ambientes de Formación</h1>
                <p> En esta sección puede administrar los ambientes físicos disponibles para la formación.
                    Registre nuevos espacios, edite los existentes y consulte la programación de horarios
                    con los instructores asignados y las horas disponibles para cada ambiente.
                </p>
        </div>
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



        <div class="filters-container">
            <div class="filter-group">
                <label for="filtroAmbiente">Filtrar por ambiente:</label>
                <select id="filtroAmbiente" onchange="filtrarVista()">
                    <option value="todos">Todos</option>
                    @foreach($ambientes as $ambiente)
                        <option value="ambiente-{{ $ambiente->id }}">{{ $ambiente->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <label for="filtroMes">Filtrar por mes:</label>
                <select id="filtroMes" onchange="filtrarVista()">
                    <option value="todos">Todos</option>
                    @php
                        $meses = [
                            '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
                            '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
                            '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre',
                        ];
                    @endphp
                    @foreach ($meses as $numero => $nombre)
                        <option value="{{ $numero }}">{{ $nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="filter-group">
                <button class="btn-register" onclick="openModal('create')">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Registrar
                </button>
            </div>
        </div>

        <!-- Modal para Crear -->
        <div id="modalRegistroAmbiente" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Registrar Nuevo Ambiente</h2>

                <form action="{{ route('programing.classroom_store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_town">Municipio:</label>
                        <select id="id_town" name="id_town" required>
                            <option value="">Seleccione un municipio</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id }}">{{ $municipio->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_block">Bloque:</label>
                        <select id="id_block" name="id_block" required>
                            <option value="">Seleccione un bloque</option>
                            @foreach($bloques as $bloque)
                                <option value="{{ $bloque->id }}">{{ $bloque->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="name">Nombre del Ambiente:</label>
                        <input type="text" id="name" name="name" required placeholder="Ejemplo: Aula 101">
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">Guardar Ambiente</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal para Editar -->
        <div id="modalEditarAmbiente" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Editar Ambiente</h2>

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit_id_town">Municipio:</label>
                        <select id="edit_id_town" name="id_town" required>
                            <option value="">Seleccione un municipio</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id }}">{{ $municipio->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_id_block">Bloque:</label>
                        <select id="edit_id_block" name="id_block" required>
                            <option value="">Seleccione un bloque</option>
                            @foreach($bloques as $bloque)
                                <option value="{{ $bloque->id }}">{{ $bloque->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="edit_name">Nombre del Ambiente:</label>
                        <input type="text" id="edit_name" name="name" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">Actualizar Ambiente</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Ambiente</th>
                        <th>Rango</th>
                        <th>Programación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ambientes as $ambiente)
                    <tr class="row-ambiente ambiente-{{ $ambiente->id }}">
                        <td class="align-middle"><strong>{{ $ambiente->name }}</strong></td>
                        <td class="align-middle">
                        @if($ambiente->rango_fechas)
                                {{ \Carbon\Carbon::parse($ambiente->rango_fechas['inicio'])->format('d/m/Y') }} -
                                {{ \Carbon\Carbon::parse($ambiente->rango_fechas['fin'])->format('d/m/Y') }}
                            @else
                                <span class="text-muted">Sin programación</span>
                            @endif
                        </td>

                        <td>
                            @php
                                $programados = collect($ambiente->horas_programadas)->groupBy('fecha');
                                $disponibles = collect($ambiente->horas_disponibles)->keyBy('fecha');
                            @endphp

                            @forelse($programados as $fecha => $bloques)
                                <div class="bloque-fecha" data-mes="{{ \Carbon\Carbon::parse($fecha)->format('m') }}">
                                    <div class="bg-light">
                                        <strong>{{ \Carbon\Carbon::parse($fecha)->translatedFormat('l d/m/Y') }}</strong>
                                    </div>

                                    <div>
                                        @foreach($bloques as $b)
                                            <div style="margin-bottom: 5px;">
                                                <span class="badge bg-danger">
                                                    {{ substr($b['start'],0,5) }} - {{ substr($b['end'],0,5) }}
                                                </span>
                                                @if(isset($b['instructor']))
                                                    <div class="instructor-info">
                                                        Instructor: {{ $b['instructor'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    <div>
                                        @if($disponibles->has($fecha))
                                            @foreach($disponibles[$fecha]['disponibles'] as $d)
                                                <span class="badge bg-success">{{ substr($d['start'],0,5) }} - {{ substr($d['end'],0,5) }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No hay horas libres</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <span class="text-muted">Sin programación</span>
                            @endforelse
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-edit" onclick="openEditModal({{ $ambiente->id }}, '{{ $ambiente->name }}', {{ $ambiente->id_town }}, {{ $ambiente->id_block }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                    </svg>
                                    Editar
                                </button>
                                <form action="{{ route('programing.ambiente_delete', $ambiente->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar este Ambiente?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                        Eliminar
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Mantengo exactamente el mismo JavaScript original
        function openModal(type) {
            if(type === 'create') {
                document.getElementById('modalRegistroAmbiente').style.display = 'flex';
            }
        }

        function openEditModal(id, name, id_town, id_block) {
            const filaAmbiente = document.querySelector(`.ambiente-${id}`);
            const tieneProgramacion = filaAmbiente.querySelector('.badge.bg-danger') !== null;

            if (tieneProgramacion) {
                alert('No se puede editar este ambiente porque tiene horarios asignados. Primero elimine las programaciones asociadas.');
                return;
            }

            document.getElementById('editForm').action = `/programming/admin/classroom_update/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_id_town').value = id_town;
            document.getElementById('edit_id_block').value = id_block;

            document.getElementById('modalEditarAmbiente').style.display = 'flex';
        }

        document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function(e) {
                const form = this.closest('form');
                const id = form.action.split('/').pop();
                const filaAmbiente = document.querySelector(`.ambiente-${id}`);
                const tieneProgramacion = filaAmbiente.querySelector('.badge.bg-danger') !== null;

                if (tieneProgramacion) {
                    e.preventDefault();
                    alert('No se puede eliminar este ambiente porque tiene horarios asignados. Primero elimine las programaciones asociadas.');
                    return false;
                }

                if (!confirm('¿Estás seguro de eliminar este Ambiente? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                    return false;
                }
            });
        });

        function closeModal() {
            document.getElementById('modalRegistroAmbiente').style.display = 'none';
            document.getElementById('modalEditarAmbiente').style.display = 'none';
        }

        window.onclick = function(event) {
            const modals = ['modalRegistroAmbiente', 'modalEditarAmbiente'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target == modal) {
                    closeModal();
                }
            });
        }

        function filtrarVista() {
            const ambiente = document.getElementById('filtroAmbiente').value;
            const mes = document.getElementById('filtroMes').value;

            document.querySelectorAll('.row-ambiente').forEach(row => {
                if (ambiente === 'todos' || row.classList.contains(ambiente)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            document.querySelectorAll('.row-ambiente').forEach(row => {
                if (row.style.display !== 'none') {
                    row.querySelectorAll('.bloque-fecha').forEach(bloque => {
                        if (mes === 'todos' || bloque.dataset.mes === mes) {
                            bloque.style.display = '';
                        } else {
                            bloque.style.display = 'none';
                        }
                    });
                }
            });
        }
    </script>
</x-layout>
