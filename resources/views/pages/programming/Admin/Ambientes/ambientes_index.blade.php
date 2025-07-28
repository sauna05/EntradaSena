<x-layout>
    <x-slot:title>Gestión de Ambientes</x-slot:title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .alert-success, .alert-danger {
        width: 100%;
        padding: 10px 14px;
        margin-bottom: 20px;
        border-radius: 6px;
        font-size: 0.95rem;
    }

    .alert-success {
        background-color: #e6f4ea;
        color: #276749;
        border: 1px solid #c6e6c7;
    }

    .alert-danger {
        background-color: #fdecea;
        color: #9b2c2c;
        border: 1px solid #f5c6cb;
    }

    .container {
        max-width: 1000px;
        margin: 30px auto;
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    }
.table-wrapper {
    max-height: 450px;
    overflow-y: auto;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    position: relative;
}
.align-middle {
    vertical-align: middle !important;
}

/* Cabecera fija */
table thead th {
    position: sticky;
    top: 0;
    background-color: #f9fafb;
    z-index: 2;
    box-shadow: 0 2px 2px -1px rgba(0, 0, 0, 0.1);
}


    table {
        width: 100%;
        border-collapse: collapse;
        background-color: white;
    }

    thead {
        background-color: #f9fafb;
    }

    th, td {
        padding: 8px 12px;
        border-bottom: 1px solid #e5e7eb;
        text-align: left;
        font-size: 0.95rem;
        vertical-align: top;
    }

    th {
        font-weight: 600;
        color: #374151;
    }

    td strong {
        color: #111827;
    }

    .badge {
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.78rem;
        display: inline-block;
        margin: 2px 2px 4px 0;
    }

    .bg-danger {
        background: #f87171;
        color: white;
    }

    .bg-success {
        background: #4ade80;
        color: #1e3a1e;
    }

    .bg-light {
        background: #f3f4f6;
        color: #111827;
        padding: 4px 6px;
        border-radius: 4px;
        font-weight: 500;
        display: inline-block;
        margin-bottom: 4px;
    }

    .action-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .btn-edit, .btn-delete {
        padding: 6px 12px;
        border-radius: 5px;
        border: none;
        font-size: 0.9rem;
        cursor: pointer;
        transition: background-color 0.2s ease;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-edit {
        background-color: #e0f2fe;
        color: #0369a1;
    }

    .btn-edit:hover {
        background-color: #bae6fd;
    }

    .btn-delete {
        background-color: #fee2e2;
        color: #b91c1c;
    }

    .btn-delete:hover {
        background-color: #fecaca;
    }

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
        background: #fff;
        margin: 5% auto;
        padding: 20px;
        border-radius: 10px;
        width: 400px;
        position: relative;
    }

    .error-message {
        color: #dc2626;
        font-size: 0.85rem;
        margin-top: 4px;
    }

    select {
        padding: 6px 10px;
        border-radius: 5px;
        border: 1px solid #d1d5db;
        margin-bottom: 10px;
        margin-right: 10px;
    }
</style>


    <div class="container">
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif
        <h1 style="text-align: center;">Gestión de Ambientes</h1>

        <div>
            <label for="filtroAmbiente"><strong>Filtrar por ambiente:</strong></label>
            <select id="filtroAmbiente" onchange="filtrarVista()">
                <option value="todos">Todos</option>
                @foreach($ambientes as $ambiente)
                    <option value="ambiente-{{ $ambiente->id }}">{{ $ambiente->name }}</option>
                @endforeach
            </select>

            <label for="filtroMes"><strong>Filtrar por mes:</strong></label>
            <select id="filtroMes" onchange="filtrarVista()">
                <option value="todos">Todos</option>
                @php
                    $meses = [
                        '01' => 'Enero',
                        '02' => 'Febrero',
                        '03' => 'Marzo',
                        '04' => 'Abril',
                        '05' => 'Mayo',
                        '06' => 'Junio',
                        '07' => 'Julio',
                        '08' => 'Agosto',
                        '09' => 'Septiembre',
                        '10' => 'Octubre',
                        '11' => 'Noviembre',
                        '12' => 'Diciembre',
                    ];
                @endphp

                @foreach ($meses as $numero => $nombre)
                    <option value="{{ $numero }}">{{ $nombre }}</option>
                @endforeach
    </select>

            <button onclick="openModal('create')" style="margin-bottom: 20px; padding: 10px 20px; background-color: #2980b9; color: white; border: none; border-radius: 5px; cursor: pointer;">
                <i class="fas fa-plus"></i> Registrar
            </button>

        </div>

        <!-- Modal para Crear -->
        <div id="modalRegistroAmbiente" class="modal">
            <div class="modal-content">
                <span onclick="closeModal()" style="position:absolute; top:10px; right:15px; font-size: 28px; font-weight: bold; cursor:pointer;">&times;</span>
                <h2>Registrar Nuevo Ambiente</h2>

                <form action="{{ route('programing.classroom_store') }}" method="POST">
                    @csrf

                    <label for="id_town">Municipio:</label><br>
                    <select id="id_town" name="id_town" required style="width: 100%; padding: 8px; margin-bottom: 15px;">
                        <option value="">Seleccione un municipio</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->id }}">{{ $municipio->name }}</option>
                        @endforeach
                    </select>

                    <label for="id_block">Bloque:</label><br>
                    <select id="id_block" name="id_block" required style="width: 100%; padding: 8px; margin-bottom: 15px;">
                        <option value="">Seleccione un bloque</option>
                        @foreach($bloques as $bloque)
                            <option value="{{ $bloque->id }}">{{ $bloque->name }}</option>
                        @endforeach
                    </select>

                    <label for="name">Nombre del Ambiente:</label><br>
                    <input type="text" id="name" name="name" required style="width: 100%; padding: 8px; margin-bottom: 20px;" placeholder="Ejemplo: Aula 101">

                    <button type="submit" style="background-color: #27ae60; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">
                        Guardar Ambiente
                    </button>
                </form>
            </div>
        </div>

        <!-- Modal para Editar -->
        <div id="modalEditarAmbiente" class="modal">
            <div class="modal-content">
                <span onclick="closeModal()" style="position:absolute; top:10px; right:15px; font-size: 28px; font-weight: bold; cursor:pointer;">&times;</span>
                <h2>Editar Ambiente</h2>

                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')

                    <label for="edit_id_town">Municipio:</label><br>
                    <select id="edit_id_town" name="id_town" required style="width: 100%; padding: 8px; margin-bottom: 15px;">
                        <option value="">Seleccione un municipio</option>
                        @foreach($municipios as $municipio)
                            <option value="{{ $municipio->id }}">{{ $municipio->name }}</option>
                        @endforeach
                    </select>

                    <label for="edit_id_block">Bloque:</label><br>
                    <select id="edit_id_block" name="id_block" required style="width: 100%; padding: 8px; margin-bottom: 15px;">
                        <option value="">Seleccione un bloque</option>
                        @foreach($bloques as $bloque)
                            <option value="{{ $bloque->id }}">{{ $bloque->name }}</option>
                        @endforeach
                    </select>

                    <label for="edit_name">Nombre del Ambiente:</label><br>
                    <input type="text" id="edit_name" name="name" required style="width: 100%; padding: 8px; margin-bottom: 20px;">

                    <button type="submit" style="background-color: #27ae60; color: white; padding: 10px 15px; border: none; border-radius: 5px; cursor: pointer;">
                        Actualizar Ambiente
                    </button>
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
                                                    <div style="font-size: 0.8rem; margin-top: 2px;">
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
                                    <i class="fas fa-edit btn-icon"></i> Editar
                                </button>
                                <form action="{{ route('programing.ambiente_delete', $ambiente->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar este Ambiente?')">
                                        <i class="fas fa-trash-alt btn-icon"></i> Eliminar
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
        function openModal(type) {
            if(type === 'create') {
                document.getElementById('modalRegistroAmbiente').style.display = 'block';
            }
        }

        function openEditModal(id, name, id_town, id_block) {
            // Verificar si el ambiente tiene programación
            const filaAmbiente = document.querySelector(`.ambiente-${id}`);
            const tieneProgramacion = filaAmbiente.querySelector('.badge.bg-danger') !== null;

            if (tieneProgramacion) {
                alert('No se puede editar este ambiente porque tiene horarios asignados. Primero elimine las programaciones asociadas.');
                return;
            }

            // Configurar el formulario de edición
            document.getElementById('editForm').action = `/programming/admin/classroom_update/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_id_town').value = id_town;
            document.getElementById('edit_id_block').value = id_block;

            // Mostrar el modal de edición
            document.getElementById('modalEditarAmbiente').style.display = 'block';
        }
        // Modificar el evento de eliminación para verificar programación
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

        // Cerrar modal si se hace clic fuera del contenido
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

            // Mostrar/ocultar filas de ambiente
            document.querySelectorAll('.row-ambiente').forEach(row => {
                if (ambiente === 'todos' || row.classList.contains(ambiente)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Dentro de cada ambiente mostrado, filtrar bloques por mes
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
