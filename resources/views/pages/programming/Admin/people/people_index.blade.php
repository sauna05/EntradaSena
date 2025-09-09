<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Gestión de Personas</x-slot:title>

    <style>
        /* Tus estilos CSS existentes (se mantienen igual) */
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
            min-width: 250px;
        }

        .filter-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #374151;
            font-size: 16px;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        .search-input {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 15px center;
            background-size: 18px;
            padding-left: 45px !important;
        }

        .btn-search {
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

        .btn-search:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
        }

        tbody tr:hover {
            background-color: #f8fafc;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Botones de acción */
        .btn-action {
            padding: 8px 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            text-decoration: none;
        }

        .btn-view {
            background-color: #17a2b8;
            color: white;
        }

        .btn-view:hover {
            background-color: #138496;
            transform: translateY(-1px);
        }

        /* Estados */
        .status-active {
            color: #28a745;
            font-weight: 600;
        }

        .status-inactive {
            color: #dc3545;
            font-weight: 600;
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

        /* Paginación */
        .pagination {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
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


        .pagination a:hover {
            background-color: #e5e7eb;
        }

        .pagination .active span {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
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

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 800px;
            }
        }
    </style>

    <div class="container">

         <div class="dashboard-header">
                <h1>Gestión de Personas del Centro</h1>
                <p> En esta sección puede visualizar y gestionar todas las personas registradas en el centro de formación.
            Utilice los filtros para buscar por nombre, documento o cargo específico. Desde aquí puede gestionar
            los permisos de acceso para cada persona del sistema.
          </p>
        </div>


        @if (session('message'))
            <div class="alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('message') }}
            </div>
            <script>
                setTimeout(() => {
                    const msg = document.querySelector('.alert-success');
                    if (msg) {
                        msg.style.transition = 'opacity 0.5s';
                        msg.style.opacity = '0';
                        setTimeout(() => msg.remove(), 500);
                    }
                }, 4000);
            </script>
        @endif

        {{-- Búsqueda y Filtros --}}
        <section class="filters-container">
            <form method="GET" action="{{ route('entrance.people.index') }}" id="filterForm">
                <div class="filter-group">
                    <label for="search">Buscar persona:</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                           class="search-input" placeholder="Nombre o número de documento">
                </div>

                <div class="filter-group">
                    <label for="position">Filtrar por cargo:</label>
                    <select id="position" name="position">
                        <option value="">Todos los cargos</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}" {{ request('position') == $position->id ? 'selected' : '' }}>
                                {{ $position->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group">
                    <button type="submit" class="btn-search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                        Buscar
                    </button>
                    <button type="button" class="btn-search" onclick="clearFilters()" style="background-color: #6c757d; margin-left: 10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                        Limpiar
                    </button>
                </div>
            </form>
        </section>

        {{-- Tabla de Personas --}}
        <section>
            @if ($person->isEmpty())
                <div class="empty-state">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <p>No se encontraron personas con los criterios de búsqueda</p>
                </div>
            @else
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cargo</th>
                                <th>Documento</th>
                                <th>Nombre Completo</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($person as $p)
                                @php
                                    $isActive = $p->end_date && $p->end_date->isFuture();
                                @endphp
                                <tr>
                                    <td>{{ $p->id }}</td>
                                    <td>{{ $p->position->name }}</td>
                                    <td>{{ $p->document_number }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->start_date->format('d/m/Y') }}</td>
                                    <td>{{ $p->end_date->format('d/m/Y') }}</td>
                                    <td>
                                        <span class="{{ $isActive ? 'status-active' : 'status-inactive' }}">
                                            {{ $isActive ? 'Activo' : 'Inactivo' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('entrance.people.show', $p->id) }}" class="btn-action btn-view">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            Gestionar Permiso
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>

    <script>
        // Mejora: Auto-submit al escribir después de un delay
        let searchTimeout;
        document.getElementById('search').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                document.getElementById('filterForm').submit();
            }, 500);
        });

        // Auto-submit al cambiar el select de cargo
        document.getElementById('position').addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });

        // Función para limpiar filtros
        function clearFilters() {
            document.getElementById('search').value = '';
            document.getElementById('position').value = '';
            document.getElementById('filterForm').submit();
        }

        // Mejora: Focus en el campo de búsqueda al cargar
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            if (searchInput && !searchInput.value) {
                searchInput.focus();
            }
        });
    </script>
</x-layout>
