<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Gestión de Personas</x-slot:title>
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

        .dashboard-header {
            margin-bottom: 30px;
        }

        .dashboard-header h1 {
            color: #28a745;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .dashboard-header p {
            color: #6b7280;
            font-size: 16px;
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

        /* FILTROS - CORREGIDO Y MEJORADO */
        .filters-container {
            background-color: #f8fafc;
            border-radius: 10px;
            padding: 25px;
            margin-bottom: 25px;
            border: 1px solid #e2e8f0;
        }

        .filters-form {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            align-items: flex-end;
            width: 100%;
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
            font-size: 15px;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 15px;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: white;
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
        }

        .search-input {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 15px center;
            background-size: 18px;
            padding-left: 45px !important;
        }

        /* Grupo de búsqueda mejorado */
        .search-group {
            flex: 2;
            min-width: 300px;
        }

        /* Botones de acción de filtros */
        .filter-actions {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-top: 8px;
        }

        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .btn-search {
            background-color: #28a745;
            color: white;
        }

        .btn-search:hover {
            background-color: #218838;
            transform: translateY(-1px);
        }

        .btn-clear {
            background-color: #6c757d;
            color: white;
        }

        .btn-clear:hover {
            background-color: #5a6268;
            transform: translateY(-1px);
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
            background-color: #f9fafb;
            border-radius: 10px;
            margin: 20px 0;
        }

        .empty-state svg {
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Paginación - MEJORADA */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            flex-wrap: wrap;
            gap: 15px;
            padding: 15px 0;
        }

        .pagination-info {
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
        }

        .pagination {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .page-info {
            font-weight: 600;
            color: #374151;
            padding: 8px 12px;
            background-color: #f8f9fa;
            border-radius: 6px;
            border: 1px solid #dee2e6;
            font-size: 14px;
        }

        .pagination a {
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            color: #374151;
            text-decoration: none;
            transition: all 0.2s ease;
            font-weight: 500;
            background-color: white;
        }

        .pagination a:hover:not(.disabled) {
            background-color: #e5e7eb;
            border-color: #28a745;
        }

        .pagination a.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            background-color: #f8f9fa;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .container {
                padding: 20px;
                margin: 15px;
            }

            .filters-form {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                min-width: 100%;
            }

            .filter-actions {
                justify-content: center;
                margin-top: 15px;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 800px;
            }

            .pagination-container {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .filter-actions {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }

            .pagination {
                flex-direction: column;
                gap: 8px;
            }

            .page-info {
                order: -1;
            }
        }
    </style>

    <div class="container">
        <div class="dashboard-header">
            <h1>Gestión de Personas del Centro</h1>
            <p>En esta sección puede visualizar y gestionar todas las personas registradas en el centro de formación.
                Utilice los filtros para buscar por nombre, documento o cargo específico. Desde aquí puede gestionar
                los permisos de acceso para cada persona del sistema.
            </p>
        </div>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: '¡Acción exitosa!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#28a745'
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Error al registrar',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#d33'
                });
            </script>
        @endif

        @if ($errors->any())
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Errores de validación',
                    html: '{!! implode("<br>", $errors->all()) !!}',
                    confirmButtonColor: '#d33'
                });
            </script>
        @endif

        {{-- Búsqueda y Filtros - DISEÑO CORREGIDO --}}
        <section class="filters-container">
            <form method="GET" action="{{ route('entrance.people.index') }}" id="filterForm" class="filters-form">
                @csrf

                <!-- Filtro de cargo -->
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

                <!-- Búsqueda por nombre/documento -->
                <div class="filter-group search-group">
                    <label for="search">Buscar persona:</label>
                    <input type="text" id="search" name="search" value="{{ request('search') }}"
                           class="search-input" placeholder="Nombre o número de documento">
                </div>

                <!-- Botones de acción -->
                <div class="filter-group">
                    <label style="visibility: hidden;">Acciones</label>
                    <div class="filter-actions">
                        <button type="submit" class="btn btn-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Buscar
                        </button>
                        <button type="button" class="btn btn-clear" onclick="clearFilters()">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                            Limpiar
                        </button>
                    </div>
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
                    @php
                        $contador = 0;
                    @endphp
                    <table id="peopleTable">
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
                                    $contador = $contador + 1;
                                    $isActive = $p->end_date && $p->end_date->isFuture();
                                @endphp
                                <tr>
                                    <td>{{ $contador }}</td>
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
                                        <a href="{{ route('entrance.people.edit', $p->id) }}" class="btn-action btn-view">
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

                <!-- Paginación con JavaScript -->
                <div class="pagination-container">
                    <div class="pagination-info" id="paginationInfo">
                        Mostrando <span id="currentItems">0</span> de <span id="totalItems">{{ $person->count() }}</span> registros
                    </div>
                    <div class="pagination" id="pagination">
                        <!-- La paginación se generará con JavaScript -->
                    </div>
                </div>
            @endif
        </section>
    </div>

    <script>
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

            // Inicializar paginación si hay registros
            if (document.getElementById('peopleTable')) {
                initPagination();
            }
        });

        // Sistema de paginación con JavaScript
        function initPagination() {
            const table = document.getElementById('peopleTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const totalItems = rows.length;
            const itemsPerPage = 10; // Reducido para mejor visualización
            let currentPage = 1;
            const totalPages = Math.ceil(totalItems / itemsPerPage);

            // Actualizar información de paginación
            document.getElementById('totalItems').textContent = totalItems;
            updatePaginationInfo();

            // Generar controles de paginación
            generatePaginationControls();

            // Mostrar primera página
            showPage(currentPage);

            function showPage(page) {
                currentPage = page;
                const startIndex = (page - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;

                // Ocultar todas las filas
                rows.forEach(row => row.style.display = 'none');

                // Mostrar solo las filas de la página actual
                for (let i = startIndex; i < endIndex && i < totalItems; i++) {
                    rows[i].style.display = '';
                }

                // Actualizar información de paginación
                updatePaginationInfo();

                // Actualizar controles de paginación
                updatePaginationControls();
            }

            function updatePaginationInfo() {
                const startIndex = (currentPage - 1) * itemsPerPage + 1;
                const endIndex = Math.min(currentPage * itemsPerPage, totalItems);
                document.getElementById('currentItems').textContent = `${startIndex}-${endIndex}`;
            }

            function generatePaginationControls() {
                const paginationContainer = document.getElementById('pagination');
                paginationContainer.innerHTML = '';

                // Información de página
                const pageInfo = document.createElement('span');
                pageInfo.className = 'page-info';
                pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
                paginationContainer.appendChild(pageInfo);

                // Botón Anterior
                const prevButton = document.createElement('a');
                prevButton.href = '#';
                prevButton.innerHTML = '&laquo; Anterior';
                prevButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (currentPage > 1) showPage(currentPage - 1);
                });
                paginationContainer.appendChild(prevButton);

                // Botón Siguiente
                const nextButton = document.createElement('a');
                nextButton.href = '#';
                nextButton.innerHTML = 'Siguiente &raquo;';
                nextButton.addEventListener('click', (e) => {
                    e.preventDefault();
                    if (currentPage < totalPages) showPage(currentPage + 1);
                });
                paginationContainer.appendChild(nextButton);
            }

            function updatePaginationControls() {
                const paginationLinks = document.querySelectorAll('#pagination a');
                paginationLinks.forEach(link => link.classList.remove('disabled'));

                // Deshabilitar botones anterior/siguiente si es necesario
                if (currentPage === 1) {
                    paginationLinks[0].classList.add('disabled');
                }

                if (currentPage === totalPages) {
                    paginationLinks[1].classList.add('disabled');
                }

                // Actualizar el texto de la página actual
                const pageInfo = document.querySelector('#pagination .page-info');
                if (pageInfo) {
                    pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
                }
            }
        }
    </script>
</x-layout>
