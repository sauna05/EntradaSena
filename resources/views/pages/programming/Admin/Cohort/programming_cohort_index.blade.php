<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Gestión de Fichas</x-slot:title>


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

        .page-description {
            text-align: center;
            color: #000;
            margin-bottom: 30px;
            font-size: 16px;
            max-width: 900px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.5;
        }

        /* Botones */
        .btn-primary {
            background-color: #28a745;
            color: white;
            padding: 14px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            margin-bottom: 25px;
        }
        .filters-form {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    width: 100%;
    align-items: flex-end;
}

/* Grupo de búsqueda ocupa más espacio */
.search-group {
    flex: 2;
}

/* Contenedor del input y botones */
.search-wrapper {
    display: flex;
    gap: 10px;
    align-items: center;
}

/* Input con ícono de lupa en el lado izquierdo */
.search-input {
    flex: 1;
    padding: 12px 15px 12px 45px; /* espacio para el icono */
    border: 1px solid #d1d5db;
    border-radius: 8px;
    font-size: 16px;
    background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='%236b7280' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E") no-repeat 15px center;
    background-size: 18px;
    transition: border-color 0.2s, box-shadow 0.2s;
}
.search-input:focus {
    outline: none;
    border-color: #28a745;
    box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.2);
}

/* Botones */
.btn-search,
.btn-reset {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 18px;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 15px;
    cursor: pointer;
    transition: all 0.3s ease;
    height: 45px;
    text-decoration: none;
}

.btn-search {
    background-color: #28a745;
    color: #fff;
}
.btn-search:hover {
    background-color: #218838;
}

.btn-reset {
    background-color: #6c757d;
    color: #fff;
}
.btn-reset:hover {
    background-color: #5a6268;
}

/* Responsive */
@media (max-width: 768px) {
    .filters-form {
        flex-direction: column;
        align-items: stretch;
    }
    .search-wrapper {
        flex-direction: column;
        align-items: stretch;
    }
    .btn-search,
    .btn-reset {
        width: 100%;
        justify-content: center;
    }
}


        .btn-primary:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Alertas */
        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #28a745;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #dc3545;
        }

        .alert-danger ul {
            margin: 10px 0 0 20px;
        }

        /* Filtros */
        .filters-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
            align-items: end;
            background-color: #f1f5f9;
            border-radius: 10px;
            padding: 20px;
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

        /* Modal */
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
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
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
            background: none;
            border: none;
        }

        .close:hover {
            color: #444;
        }

        .modal-content h3 {
            margin-bottom: 25px;
            color: #2c3e50;
            text-align: center;
            font-size: 24px;
        }

        /* Formulario */
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }


        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        .btn-submit {
            background-color: #28a745;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #218838;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-cancel:hover {
            background-color: #5a6268;
        }

        /* Tabla */
        .table-container {
            max-height: 600px;
            overflow-y: auto;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            margin-top: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
        }
        .filters-form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            width: 100%;
            align-items: flex-end;
        }

        .search-group {
            flex: 2;
        }

        .search-wrapper {
            display: flex;
            gap: 10px;
            align-items: center;
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

            .btn-admin {
            background-color: #007bff;
            color: white;
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 14px;
            text-decoration: none;
        }

        .btn-admin:hover {
            background-color: #0069d9;
            transform: translateY(-1px);
        }

        tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Status badges */
        .status-badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-inactive {
            background-color: #fee2e2;
            color: #b91c1c;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
        }

        .empty-state svg {
            margin-bottom: 15px;
            opacity: 0.5;
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 800px;
            }
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

    </style>

    <div class="container">

        <div class="dashboard-header">
            <h1>Gestión de Fichas de Formación</h1>
            <p>En esta sección puede administrar todas las fichas de formación del centro.
                Registre nuevas fichas, consulte el estado de cada una y gestione
                la información relacionada con programas, jornadas y municipios.
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

        @if ($errors->any())
            <div class="alert-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <div>
                    <strong>Por favor, corrige los siguientes errores:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        <button class="btn-primary" onclick="openModal()">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="12" y1="5" x2="12" y2="19"></line>
                <line x1="5" y1="12" x2="19" y2="12"></line>
            </svg>
            Registrar Nueva Ficha
        </button>
                <!-- Filtros -->
        <div class="filters-container">
            <form action="" method="GET" class="filters-form">
                @csrf

                <!-- Filtro de estado -->
                <div class="filter-group">
                    <label for="statusFilter">Estado de la ficha:</label>
                    <select id="statusFilter" name="status" onchange="filterTable()">
                        <option value="all" {{ request('status')=='all'?'selected':'' }}>Todas</option>
                        <option value="active" {{ request('status')=='active'?'selected':'' }}>Activas</option>
                        <option value="inactive" {{ request('status')=='inactive'?'selected':'' }}>Inactivas</option>
                    </select>
                </div>

                <!-- Búsqueda por número de ficha -->
                <div class="filter-group search-group">
                    <label for="search">Número de ficha:</label>
                    <div class="search-wrapper">
                        <input type="text"
                            id="search"
                            name="search"
                            class="search-input"
                            placeholder="Buscar por número de ficha"
                            value="{{ request('search') }}">
                        <button type="submit" class="btn-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Buscar
                        </button>
                        <a href="{{ route('programing.cohort_index') }}" class="btn-reset">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12l2-2 4 4 8-8 4 4"></path>
                            </svg>
                            Restablecer
                        </a>
                    </div>
                </div>

            </form>
        </div>




       <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Ficha</th>
                        <th>Programa</th>
                        <th>Jornada</th>
                        <th>Municipio</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Matriculados</th>
                        <th>Acciones</th> <!-- Nueva columna para acciones -->
                    </tr>
                </thead>
                <tbody>
                    @forelse($cohorts as $cohort)
                        @php
                            $isActive = $cohort->end_date > now();
                            $statusClass = $isActive ? 'status-active' : 'status-inactive';
                            $statusText = $isActive ? 'Activa' : 'Inactiva';
                        @endphp
                        <tr class="ficha-row" data-status="{{ $isActive ? 'active' : 'inactive' }}">
                            <td><strong>{{ $cohort->number_cohort }}</strong></td>
                            <td>{{ $cohort->program->name ?? 'N/A' }}</td>
                            <td>{{ $cohort->cohortime->name ?? 'N/A' }}</td>
                            <td>{{ $cohort->town->name ?? 'N/A' }}</td>
                            <td>{{ $cohort->start_date }}</td>
                            <td>{{ $cohort->end_date }}</td>
                            <td>
                                <span class="status-badge {{ $statusClass }}">
                                    {{ $statusText }}
                                </span>
                            </td>
                            <td>{{ $cohort->enrolled_quantity }}</td>
                            <td>
                                <a href="{{ route('programing.competencies_index_administrar', $cohort->id) }}" class="btn-admin">
                                    <i class="fas fa-cog"></i> Administrar
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9"> <!-- Aumentado a 9 columnas -->
                                <div class="empty-state">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                    <p>No hay fichas registradas</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal de registro -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <button class="close" onclick="closeModal()">&times;</button>
                <h3>Registrar Nueva Ficha</h3>

                <form method="POST" action="{{ route('programming.Register') }}">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label>Número de ficha</label>
                            <input type="number" name="number_cohort" required min="1" placeholder="Ej: 123456">
                        </div>

                        <div class="form-group">
                            <label>Programa</label>
                            <select name="id_program" required>
                                <option value="">Seleccione programa</option>
                                @foreach ($programs as $pro)
                                    <option value="{{ $pro->id }}" @if(old('id_program') == $pro->id) selected @endif>
                                        {{ $pro->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Jornada</label>
                            <select name="id_time" required>
                                <option value="">Seleccione jornada</option>
                                @foreach ($cohortimes as $tms)
                                    <option value="{{ $tms->id }}" @if(old('id_time') == $tms->id) selected @endif>
                                        {{ $tms->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Municipio</label>
                            <select name="id_town" required>
                                <option value="">Seleccione municipio</option>
                                @foreach ($towns as $tn)
                                    <option value="{{ $tn->id }}" @if(old('id_town') == $tn->id) selected @endif>
                                        {{ $tn->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Fecha Inicio</label>
                            <input type="date" name="start_date" required value="{{ old('start_date') }}">
                        </div>

                        <div class="form-group">
                            <label>Fecha Finalización</label>
                            <input type="date" name="end_date" required value="{{ old('end_date') }}">
                        </div>

                        <div class="form-group">
                            <label>Cantidad Matriculados</label>
                            <input type="number" name="enrolled_quantity" required min="1"
                                   value="{{ old('enrolled_quantity') }}" placeholder="Número de aprendices">
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel" onclick="closeModal()">Cancelar</button>
                        <button type="submit" class="btn-submit">Guardar Ficha</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.getElementById('modal').style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            document.getElementById('modal').style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        function filterTable() {
            const filter = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('.ficha-row');

            rows.forEach(row => {
                const status = row.getAttribute('data-status');
                if (filter === 'all' || filter === status) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Validación de fechas
        document.addEventListener('DOMContentLoaded', function() {
            const startDateInput = document.querySelector('input[name="start_date"]');
            const endDateInput = document.querySelector('input[name="end_date"]');

            startDateInput.addEventListener('change', function() {
                if (this.value) {
                    endDateInput.min = this.value;
                }
            });

            // Cerrar modal al hacer clic fuera
            window.addEventListener('click', function(event) {
                if (event.target === document.getElementById('modal')) {
                    closeModal();
                }
            });

            // Cerrar con tecla ESC
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeModal();
                }
            });
        });
    </script>
</x-layout>
