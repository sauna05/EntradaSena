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
        }

        .filter-group select,
        .filter-group input {
            width: 100%;
            padding: 12px 15px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
            font-size: 16px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .filter-group select:focus,
        .filter-group input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.2);
        }

        /* Search box */
        .search-container {
            display: flex;
            margin-bottom: 0;
            max-width: 100%;
        }



        .search-input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.25);
        }

        .btn-search {
            background-color: #6c757d;
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
            background-color: #5a6268;
            transform: translateY(-1px);
        }

        /* Tabla */
        .table-container {
            max-height: 500px;
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
        }

        .empty-state svg {
            margin-bottom: 15px;
            opacity: 0.5;
        }

        /* Badges para etapas */
        .badge {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-lectiva {
            background-color: #e9f5ff;
            color: #0066cc;
        }

        .badge-practica {
            background-color: #e6f7ee;
            color: #0b8c56;
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

            .filter-group {
                width: 100%;
            }

            .table-container {
                overflow-x: auto;
            }

            table {
                min-width: 1000px;
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

        <form method="GET" action="">
            <div class="filters-container">
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


                <div class="filter-group">
                    <label for="buscar">Buscar aprendiz:</label>
                    <form method="GET" action="">
                        <div class="search-container">
                        <input type="text" name="buscar"  placeholder="Nombre o documento..." value="{{ request('buscar') }}">
                        <button type="submit" class="btn-search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Buscar
                        </button>
                    </div>
                    </form>

                </div>
            </div>
        </form>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Documento</th>
                        <th>Aprendiz</th>
                        <th>Correo</th>
                        <th>Ficha</th>
                        <th>Programa</th>
                        <th>Inicio</th>
                        <th>Finalizacion</th>

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
                            <td>{{$apprentice['start_date']}}</td>
                            <td>{{$apprentice['end_date']}}</td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="11">
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
    </div>
</x-layout>
