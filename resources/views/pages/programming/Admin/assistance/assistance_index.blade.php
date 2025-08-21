<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Gestión de Asistencias</x-slot:title>

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
            max-width: 1600px;
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

        /* Header info */
        .header-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .attendance-count {
            background-color: #e9f5ff;
            padding: 15px 20px;
            border-radius: 10px;
            border-left: 4px solid #007bff;
        }

        .attendance-count span {
            font-size: 24px;
            font-weight: 700;
            color: #007bff;
        }

        /* Filtros */
        .filters-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
            background-color: #f1f5f9;
            border-radius: 10px;
            padding: 25px;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .filter-group select,
        .filter-group input {
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        .search-group {
            grid-column: 1 / -1;
        }

        .search-input {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%236c757d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Ccircle cx='11' cy='11' r='8'%3E%3C/circle%3E%3Cline x1='21' y1='21' x2='16.65' y2='16.65'%3E%3C/line%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 15px center;
            background-size: 18px;
            padding-left: 45px !important;
        }

        /* Botones */
        .btn {
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            width: max-content;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            font-size: 14px;
        }

        .btn-primary {
            background-color: #28a745;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #218838;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .btn-excel {
            background-color: #217346;
            color: #fff;
        }

        .btn-excel:hover {
            background-color: #14532d;
            transform: translateY(-2px);
        }

        .buttons-container {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
            flex-wrap: wrap;
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

        /* Entrada/Salida */
        .attendance-record {
            display: flex;
            flex-direction: column;
            gap: 4px;
            padding: 8px;
            background-color: #f9fafb;
            border-radius: 6px;
            margin: 4px 0;
        }

        .attendance-time {
            font-size: 12px;
            color: #6b7280;
        }

        .attendance-value {
            font-weight: 600;
            color: #374151;
        }

        /* Badges */
        .badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .badge-primary {
            background-color: #e9f5ff;
            color: #0066cc;
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

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #6b7280;
        }

        .empty-state svg {
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Alertas */
        .alert-info {
            background-color: #e9f5ff;
            color: #0066cc;
            padding: 15px 20px;
            margin-bottom: 25px;
            border-radius: 8px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #007bff;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .container {
                padding: 20px;
                margin: 15px;
            }

            .filters-container {
                grid-template-columns: 1fr;
            }

            .header-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .buttons-container {
                flex-direction: column;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 1000px;
            }
        }

        @media (max-width: 768px) {
            .filters-container {
                padding: 15px;
            }

            .filter-group {
                min-width: 100%;
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
                <h1>Gestión de Asistencias</h1>
                <p>  En esta sección puede consultar y gestionar las asistencias registradas en el centro de formación.
                    Utilice los filtros para buscar por fecha, cargo o persona específica. Exporte los datos a Excel
                    para análisis y reportes detallados.
                </p>
            </div>


        <!-- Header Information -->
        <div class="header-info">
            <div class="attendance-count">
                <div>Total de asistencias registradas</div>
                <span>{{ count($formattedPersons) }}</span>
            </div>

            <div class="buttons-container">
                <button class="btn btn-excel" onclick="exportCleanedTableToExcel()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <path d="M16 13H8"></path>
                        <path d="M16 17H8"></path>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Exportar a Excel
                </button>

                <a href="{{ route('entrance.assistance.index') }}" class="btn btn-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    Restablecer Filtros
                </a>
            </div>
        </div>

        <!-- Filtros -->
        <form method="GET" action="{{ route('entrance.assistance.index') }}" class="filters-container">
            <!-- Cargo -->
            <div class="filter-group">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    Cargo
                </label>
                <select name="position_id" onchange="this.form.submit()">
                    <option value="">Todos los cargos</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ request('position_id') == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Mes -->
            <div class="filter-group">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Mes
                </label>
                <select name="month" onchange="this.form.submit()">
                    <option value="">Todos los meses</option>
                    @foreach (range(1, 12) as $m)
                        @php
                            $monthValue = now()->year . '-' . str_pad($m, 2, '0', STR_PAD_LEFT);
                            $monthLabel = \Carbon\Carbon::createFromDate(null, $m, 1)->locale('es')->isoFormat('MMMM');
                        @endphp
                        <option value="{{ $monthValue }}" {{ request('month') == $monthValue ? 'selected' : '' }}>
                            {{ ucfirst($monthLabel) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fecha Inicio -->
            <div class="filter-group">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Fecha inicio
                </label>
                <input type="date" name="start_date" value="{{ request('start_date') }}">
            </div>

            <!-- Fecha Fin -->
            <div class="filter-group">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    Fecha fin
                </label>
                <input type="date" name="end_date" value="{{ request('end_date') }}">
            </div>

            <!-- Búsqueda -->
            <div class="filter-group search-group">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Buscar persona
                </label>
                <input type="text" name="search" class="search-input" placeholder="Nombre o documento" value="{{ request('search') }}">
            </div>

            <div class="filter-group">
                <button type="submit" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                    Aplicar Filtros
                </button>
            </div>
        </form>

        <!-- Información del filtro aplicado -->
        @if (request('month') || request('start_date') || request('end_date') || request('position_id') || request('search'))
            <div class="alert-info">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="16" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12.01" y2="8"></line>
                </svg>
                Filtros aplicados:
                @if (request('month'))
                    Mes de {{ \Carbon\Carbon::parse(request('month'))->locale('es')->isoFormat('MMMM [de] YYYY') }}
                @elseif (request('start_date') && request('end_date'))
                    Desde {{ \Carbon\Carbon::parse(request('start_date'))->format('d/m/Y') }} hasta {{ \Carbon\Carbon::parse(request('end_date'))->format('d/m/Y') }}
                @else
                    Hoy
                @endif
                @if (request('position_id'))
                    • Cargo específico
                @endif
                @if (request('search'))
                    • Búsqueda: "{{ request('search') }}"
                @endif
            </div>
        @endif

        <!-- Tabla de asistencias -->
        @if (count($formattedPersons) === 0)
            <div class="empty-state">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <p>No se encontraron asistencias con los criterios seleccionados</p>
                <p class="text-muted">Intente ajustar los filtros o seleccione un rango de fechas diferente</p>
            </div>
        @else
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Documento</th>
                            <th>Nombre Completo</th>
                            <th>Cargo</th>
                            <th>Registros de Entrada/Salida</th>
                            <th>Tiempo Total</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formattedPersons as $person)
                            <tr>
                                <td>
                                    <span class="badge badge-primary">{{ $person['document_number'] }}</span>
                                </td>
                                <td><strong>{{ $person['name'] }}</strong></td>
                                <td>{{ $person['position'] }}</td>
                                <td>
                                    @foreach ($person['daily_data'] as $data)
                                        <div class="attendance-record">
                                            <div class="attendance-time">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                                Entrada:
                                                <span class="attendance-value">{{ $data['entrada'] }}</span>
                                            </div>
                                            <div class="attendance-time">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                                Salida:
                                                <span class="attendance-value">{{ $data['salida'] }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </td>
                                <td>
                                    <span class="badge badge-primary">{{ $person['total_time'] }}</span>
                                </td>
                                <td>{{ $data['date'] }}</td>
                                <td>
                                    <a href="{{ route('entrance.assistance.show', $person['id']) }}" class="btn-action btn-view">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        Detalles
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <script>
        function exportCleanedTableToExcel() {
            const originalTable = document.querySelector('table');
            const tempTable = document.createElement('table');
            tempTable.innerHTML = originalTable.innerHTML;

            // Eliminar la columna de acciones
            tempTable.querySelectorAll('thead tr, tbody tr').forEach(row => {
                row.removeChild(row.lastElementChild);
            });

            // Simplificar registros de entrada/salida
            tempTable.querySelectorAll('tbody tr').forEach(row => {
                const cell = row.cells[3];
                const entradasSalidas = Array.from(cell.querySelectorAll('.attendance-record'))
                    .map(record => {
                        const entrada = record.querySelector('span.attendance-value').textContent;
                        const salida = record.querySelectorAll('span.attendance-value')[1].textContent;
                        return `Entrada: ${entrada} - Salida: ${salida}`;
                    })
                    .join(' | ');
                cell.textContent = entradasSalidas;
            });

            const ws = XLSX.utils.table_to_sheet(tempTable);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Asistencias");

            const fecha = new Date();
            const nombreArchivo = `asistencias_${fecha.getFullYear()}-${fecha.getMonth() + 1}-${fecha.getDate()}.xlsx`;

            XLSX.writeFile(wb, nombreArchivo);

            // Mostrar notificación de éxito
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                background-color: #28a745;
                color: white;
                padding: 15px 20px;
                border-radius: 8px;
                z-index: 10000;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            `;
            notification.innerHTML = `
                <strong>✅ Exportación exitosa</strong><br>
                El archivo "${nombreArchivo}" se descargó correctamente.
            `;
            document.body.appendChild(notification);

            setTimeout(() => {
                notification.style.opacity = '0';
                notification.style.transition = 'opacity 0.5s';
                setTimeout(() => notification.remove(), 500);
            }, 3000);
        }

        // Auto-submit para búsqueda con delay
        let searchTimeout;
        document.querySelector('input[name="search"]').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 800);
        });

        // Mostrar fecha actual
        document.addEventListener('DOMContentLoaded', function() {
            const fecha = new Date();
            const opciones = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            const fechaFormateada = fecha.toLocaleDateString('es-ES', opciones);

            if (!document.querySelector('.alert-info')) {
                const fechaElement = document.createElement('div');
                fechaElement.className = 'alert-info';
                fechaElement.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="16" y1="2" x2="16" y2="6"></line>
                        <line x1="8" y1="2" x2="8" y2="6"></line>
                        <line x1="3" y1="10" x2="21" y2="10"></line>
                    </svg>
                    Consulta de asistencias - ${fechaFormateada}
                `;
                document.querySelector('.filters-container').after(fechaElement);
            }
        });
    </script>
</x-layout>
