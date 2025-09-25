<x-layout>
    {{-- Archivo CSS de la página --}}

    {{-- Título de la página --}}
    <x-slot:title>Historial de Asistencias</x-slot:title>

    <style>
        /* Contenedor principal */
        .container {
            width: 90%;
            max-width: 1100px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        /* Títulos */
        h1.text-center, h2 {
            text-align: center;
            color: #2c3e50;
            margin-bottom: 25px;
            font-weight: 700;
        }

        h1.text-center {
            font-size: 32px;
            border-bottom: 2px solid #eaeaea;
            padding-bottom: 15px;
        }

        h3.text-secondary {
            color: #555;
            margin-bottom: 15px;
            font-size: 22px;
        }

        /* Información del usuario */
        .user-info {
            background: linear-gradient(135deg, #f9f9f9 0%, #f0f4f8 100%);
            padding: 25px;
            border: 1px solid #e1e5eb;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .user-info p {
            margin: 10px 0;
            font-size: 1.1em;
            display: flex;
            align-items: center;
        }

        .user-info p strong {
            min-width: 120px;
            color: #2c3e50;
        }

        /* Estadísticas de asistencias */
        .stats-container {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            text-align: center;
            flex: 1;
            min-width: 200px;
            border-top: 4px solid #007bff;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 700;
            color: #2c3e50;
            margin: 10px 0;
        }

        .stat-label {
            font-size: 16px;
            color: #6c757d;
            font-weight: 600;
        }

        /* Botón */
        a.btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background-color: #007bff;
            color: white;
            padding: 12px 20px;
            width: max-content;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
        }

        a.btn-primary:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        /* Tabla responsive */
        .table-responsive {
            overflow-x: auto;
            border-radius: 10px;
            border: 1px solid #dee2e6;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }

        /* Tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        thead {
            background-color: #2c3e50;
            color: white;
            position: sticky;
            top: 0;
        }

        th, td {
            padding: 14px 16px;
            border: 1px solid #e2e8f0;
            text-align: center;
            font-size: 1em;
        }

        th {
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }

        tbody tr:hover {
            background-color: #e9ecef;
            transition: background-color 0.2s;
        }

        /* Badges */
        .badge {
            display: inline-block;
            padding: 8px 14px;
            border-radius: 20px;
            font-weight: 600;
            color: white;
            min-width: 90px;
            font-size: 14px;
        }

        .bg-success {
            background-color: #28a745;
        }

        .bg-danger {
            background-color: #dc3545;
        }

        /* Alert info */
        .alert {
            padding: 20px;
            border-radius: 8px;
            font-size: 1.1em;
            text-align: center;
            margin-top: 30px;
            border-left: 4px solid #0c5460;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }

        /* Controles de paginación */
        .pagination-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px 0;
            border-top: 1px solid #eaeaea;
        }

        .pagination-info {
            font-weight: 600;
            color: #555;
        }

        .pagination-buttons {
            display: flex;
            gap: 10px;
        }

        .pagination-btn {
            padding: 10px 16px;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.2s;
        }

        .pagination-btn:hover:not(:disabled) {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        .pagination-btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-btn.active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 20px;
            }

            .stats-container {
                flex-direction: column;
            }

            .stat-card {
                min-width: 100%;
            }

            th, td {
                padding: 10px 8px;
                font-size: 0.9em;
            }

            a.btn-primary {
                padding: 10px 16px;
                font-size: 0.95em;
            }

            .pagination-controls {
                flex-direction: column;
                gap: 15px;
                align-items: stretch;
            }

            .pagination-buttons {
                justify-content: center;
            }
        }
    </style>

    <div class="container mt-5">
        <h1 class="text-center mb-4">
            Historial de Asistencias de: <span class="text-primary">{{ $person->name }}</span>
        </h1>

        <!-- Información del usuario -->
        <div class="mb-4 p-4 border rounded shadow-sm bg-light user-info">
            <h3 class="text-secondary">Información del Usuario</h3>
            <p><strong>Nombre:</strong> {{ $person->name }}</p>
            <p><strong>Documento:</strong> {{ $person->document_number }}</p>
            <p><strong>Cargo:</strong> {{ $person->position->name ?? 'Sin puesto asignado' }}</p>
        </div>

        <!-- Estadísticas de asistencias -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-number" id="totalAsistencias">0</div>
                <div class="stat-label">Total Asistencias</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalEntradas">0</div>
                <div class="stat-label">Entradas</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" id="totalSalidas">0</div>
                <div class="stat-label">Salidas</div>
            </div>
        </div>

        <!-- Historial de asistencias -->
        <h2 class="mb-4">Todas las asistencias registradas</h2>
        <a href="{{ route('entrance.assistance.show', $person['id']) }}" class="btn-primary mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                <line x1="16" y1="2" x2="16" y2="6"></line>
                <line x1="8" y1="2" x2="8" y2="6"></line>
                <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
            Asistencias de hoy
        </a>

        @if ($formattedEntrancesExits->count() > 0)
            <!-- Tabla estilizada -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover shadow-sm" id="asistenciasTable">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Las filas se cargarán dinámicamente con JavaScript -->
                    </tbody>
                </table>
            </div>

            <!-- Controles de paginación -->
            <div class="pagination-controls">
                <div class="pagination-info" id="paginationInfo">
                    Mostrando 0 de 0 registros
                </div>
                <div class="pagination-buttons" id="paginationButtons">
                    <!-- Los botones de paginación se generarán con JavaScript -->
                </div>
            </div>
        @else
            <!-- Mensaje si no hay asistencias -->
            <div class="alert alert-info text-center">Este usuario no tiene registros de asistencia.</div>
        @endif
    </div>

    <script>
        // Datos de asistencias desde PHP
        const asistencias = @json($formattedEntrancesExits);

        // Configuración de paginación
        let currentPage = 1;
        const recordsPerPage = 10;
        let totalPages = Math.ceil(asistencias.length / recordsPerPage);

        // Elementos DOM
        const tableBody = document.getElementById('tableBody');
        const paginationInfo = document.getElementById('paginationInfo');
        const paginationButtons = document.getElementById('paginationButtons');
        const totalAsistenciasElement = document.getElementById('totalAsistencias');
        const totalEntradasElement = document.getElementById('totalEntradas');
        const totalSalidasElement = document.getElementById('totalSalidas');

        // Función para contar estadísticas
        function contarEstadisticas() {
            const total = asistencias.length;
            const entradas = asistencias.filter(a => a.action === 'entrada').length;
            const salidas = asistencias.filter(a => a.action === 'salida').length;

            totalAsistenciasElement.textContent = total;
            totalEntradasElement.textContent = entradas;
            totalSalidasElement.textContent = salidas;
        }

        // Función para mostrar la página actual
        function displayPage(page) {
            // Limpiar tabla
            tableBody.innerHTML = '';

            // Calcular índices de los registros a mostrar
            const startIndex = (page - 1) * recordsPerPage;
            const endIndex = Math.min(startIndex + recordsPerPage, asistencias.length);

            // Mostrar registros de la página actual
            for (let i = startIndex; i < endIndex; i++) {
                const entry = asistencias[i];
                const row = document.createElement('tr');
                row.className = 'text-center';

                row.innerHTML = `
                    <td>${entry.date}</td>
                    <td>${entry.time}</td>
                    <td>
                        ${entry.action === 'entrada'
                            ? '<span class="badge bg-success">Entrada</span>'
                            : entry.action === 'salida'
                                ? '<span class="badge bg-danger">Salida</span>'
                                : entry.action}
                    </td>
                `;

                tableBody.appendChild(row);
            }

            // Actualizar información de paginación
            paginationInfo.textContent = `Mostrando ${startIndex + 1} a ${endIndex} de ${asistencias.length} registros`;

            // Actualizar botones de paginación
            updatePaginationButtons(page);
        }

        // Función para actualizar los botones de paginación
        function updatePaginationButtons(currentPage) {
            paginationButtons.innerHTML = '';

            // Botón Anterior
            const prevButton = document.createElement('button');
            prevButton.textContent = 'Anterior';
            prevButton.className = 'pagination-btn';
            prevButton.disabled = currentPage === 1;
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    displayPage(currentPage - 1);
                }
            });
            paginationButtons.appendChild(prevButton);

            // Botones de páginas
            const maxVisiblePages = 5;
            let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
            let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);

            // Ajustar si estamos cerca del final
            if (endPage - startPage + 1 < maxVisiblePages) {
                startPage = Math.max(1, endPage - maxVisiblePages + 1);
            }

            // Botón Primera página
            if (startPage > 1) {
                const firstButton = document.createElement('button');
                firstButton.textContent = '1';
                firstButton.className = 'pagination-btn';
                firstButton.addEventListener('click', () => displayPage(1));
                paginationButtons.appendChild(firstButton);

                if (startPage > 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '...';
                    ellipsis.style.padding = '10px';
                    paginationButtons.appendChild(ellipsis);
                }
            }

            // Botones de páginas numeradas
            for (let i = startPage; i <= endPage; i++) {
                const pageButton = document.createElement('button');
                pageButton.textContent = i;
                pageButton.className = `pagination-btn ${i === currentPage ? 'active' : ''}`;
                pageButton.addEventListener('click', () => displayPage(i));
                paginationButtons.appendChild(pageButton);
            }

            // Botón Última página
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.textContent = '...';
                    ellipsis.style.padding = '10px';
                    paginationButtons.appendChild(ellipsis);
                }

                const lastButton = document.createElement('button');
                lastButton.textContent = totalPages;
                lastButton.className = 'pagination-btn';
                lastButton.addEventListener('click', () => displayPage(totalPages));
                paginationButtons.appendChild(lastButton);
            }

            // Botón Siguiente
            const nextButton = document.createElement('button');
            nextButton.textContent = 'Siguiente';
            nextButton.className = 'pagination-btn';
            nextButton.disabled = currentPage === totalPages;
            nextButton.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    displayPage(currentPage + 1);
                }
            });
            paginationButtons.appendChild(nextButton);
        }

        // Inicializar la página
        document.addEventListener('DOMContentLoaded', function() {
            if (asistencias.length > 0) {
                contarEstadisticas();
                displayPage(1);
            }
        });
    </script>
</x-layout>
