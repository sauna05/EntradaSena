<x-layout>
    <x-slot:title>Listado de Aprendices por Ficha</x-slot:title>

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

        /* FILTROS - MEJORADOS */
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
            min-width: 250px;
        }

        .filter-group label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            color: #374151;
            font-size: 15px;
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 15px;
            transition: border-color 0.2s, box-shadow 0.2s;
            background-color: white;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
        }

        /* Grupo de búsqueda mejorado */
        .search-group {
            flex: 2;
            min-width: 300px;
        }

        .search-container {
            display: flex;
            gap: 0;
        }

       .search-input {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 15px center;
            background-size: 18px;
            padding-left: 45px !important;
        }

        .search-input:focus {
            outline: none;
            border-color: #28a745;
            box-shadow: 0 0 0 3px rgba(40, 167, 69, 0.1);
        }

        .btn-search {
            background-color: #28a745;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 0 8px 8px 0;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-search:hover {
            background-color: #218838;
            transform: translateY(-1px);
        }

        /* Botón limpiar */
        .btn-clear {
            background-color: #6c757d;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-left: 10px;
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

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #6b7280;
            background-color: #f9fafb;
            border-radius: 10px;
        }

        .empty-state svg {
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Badges para etapas */
        .badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-lectiva {
            background-color: #e9f5ff;
            color: #0066cc;
            border: 1px solid #b3d9ff;
        }
        .btn-reset {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-search,
        .btn-reset {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            height: 45px;
            text-decoration: none;
            white-space: nowrap;
        }

        .badge-practica {
            background-color: #e6f7ee;
            color: #0b8c56;
            border: 1px solid #a3e6c5;
        }

        /* PAGINACIÓN - NUEVO */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px 0;
            border-top: 1px solid #dee2e6;
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

            .search-container {
                flex-direction: column;
            }

            .search-input {
                border-radius: 8px;
                margin-bottom: 10px;
            }

            .btn-search {
                border-radius: 8px;
                width: 100%;
            }

            .btn-clear {
                margin-left: 0;
                margin-top: 10px;
                width: 100%;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 1000px;
            }

            .pagination-container {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
        }

        @media (max-width: 768px) {
            .pagination {
                flex-wrap: wrap;
                justify-content: center;
            }

            .dashboard-header h1 {
                font-size: 24px;
            }

            .dashboard-header p {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .pagination {
                flex-direction: column;
                width: 100%;
            }

            .pagination a {
                width: 100%;
                text-align: center;
            }
        }
    </style>

    <div class="container">
        <div class="dashboard-header">
            <h1>Gestión de Aprendices por Ficha</h1>
            <p>En esta sección puede visualizar y gestionar los aprendices asignados a cada ficha de formación.
                Utilice los filtros para buscar por ficha específica, programa de formación o etapa (lectiva/práctica).
                También puede buscar aprendices por nombre o número de documento.
            </p>
        </div>

        @if(session('success'))
            <div class="alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        <!-- Filtros mejorados -->
        <div class="filters-container">
            <form method="GET" action="" class="filters-form">
                <div class="filter-group">
                    <label for="combo_ficha">Ficha y Programa:</label>
                    <select name="combo_ficha" id="combo_ficha" onchange="this.form.submit()">
                        <option value="">-- Todas las fichas --</option>
                        @foreach($fichas as $ficha)
                            <option value="{{ $ficha['id'] }}" {{ request('combo_ficha') == $ficha['id'] ? 'selected' : '' }}>
                                {{ $ficha['ficha'] }} - {{ $ficha['programa'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-group search-group">
                    <label for="buscar">Buscar aprendiz:</label>
                    <div class="search-container">
                        <input type="text" name="buscar" id="buscar" class="search-input"
                               placeholder="Nombre o documento..." value="{{ request('buscar') }}">
                        <button type="submit" class="btn-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Buscar
                        </button>

                    </div>
                  
                </div>

                <div class="filter-group">

                  <a href="{{ route('programing.list_apprentices') }}" class="btn-reset">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M3 12l2-2 4 4 8-8 4 4"></path>
                            </svg>
                            Restablecer
                        </a>
                </div>
            </form>
        </div>

        <!-- Tabla con paginación -->
        <div class="table-container">
            <table id="apprenticesTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Aprendiz</th>
                        <th>Correo</th>
                        <th>Ficha</th>
                        <th>Programa</th>
                        <th>Inicio</th>
                        <th>Finalización</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($apprentices as $index => $apprentice)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $apprentice['document_number'] }}</td>
                            <td>{{ $apprentice['name'] }}</td>
                            <td>{{ $apprentice['email'] }}</td>
                            <td>{{ $apprentice['cohort_name'] }}</td>
                            <td>{{ $apprentice['nombre_programa'] }}</td>
                            <td>{{ $apprentice['start_date'] }}</td>
                            <td>{{ $apprentice['end_date'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">
                                <div class="empty-state">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"></circle>
                                        <line x1="12" y1="8" x2="12" y2="12"></line>
                                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                    </svg>
                                    <p>No se encontraron aprendices con los filtros seleccionados</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

                <!-- Paginación JavaScript -->
        @if(count($apprentices) > 0)
            <div class="pagination-container" id="paginationContainer">
                <div class="pagination-info" id="paginationInfo">
                    Mostrando <span id="currentItems">0</span> de <span id="totalItems">{{ count($apprentices) }}</span> aprendices
                </div>
                <div class="pagination" id="pagination">
                    <!-- La paginación se generará con JavaScript -->
                </div>
            </div>
        @endif
    </div>

    <script>
        // Función para limpiar filtros
        function clearFilters() {
            document.getElementById('combo_ficha').value = '';
            document.getElementById('buscar').value = '';
            document.querySelector('form').submit();
        }

        // Sistema de paginación con JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            const table = document.getElementById('apprenticesTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const totalItems = rows.length;

            // Solo inicializar paginación si hay registros
            if (totalItems > 0 && !tbody.querySelector('.empty-state')) {
                initPagination();
            }

            // Focus en campo de búsqueda si está vacío
            const searchInput = document.getElementById('buscar');
            if (searchInput && !searchInput.value) {
                searchInput.focus();
            }
        });

        function initPagination() {
            const table = document.getElementById('apprenticesTable');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const totalItems = rows.length;
            const itemsPerPage = 10; // Mostrar solo 30 registros por página
            let currentPage = 1;
            const totalPages = Math.ceil(totalItems / itemsPerPage);

            // Actualizar información de paginación
            document.getElementById('totalItems').textContent = {{ count($apprentices) }};
            updatePaginationInfo();

            // Generar controles de paginación
            generatePaginationControls(totalPages);

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

            function generatePaginationControls(totalPages) {
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
