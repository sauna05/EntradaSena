<x-layout>
    <x-slot:title>Listado de Aprendices por Ficha</x-slot:title>

    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
        max-width: 100%;
        margin: 40px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 15px rgba(0, 0, 0, 0.07);
        }

        h2.title {
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 30px;
            color: #2c3e50;
        }

        .success-message {
            background-color: #d1f5d3;
            border: 1px solid #b2e2b6;
            color: #2e7d32;
            padding: 12px 16px;
            border-radius: 6px;
            margin-bottom: 25px;
        }

        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .filters div {
            flex: 1;
            min-width: 220px;
        }

        .filters label {
            font-weight: 600;
            margin-bottom: 6px;
            display: block;
            color: #34495e;
        }

        .filters select {
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            background-color: #fff;
            font-size: 14px;
            width: 100%;
            transition: border-color 0.3s ease;
        }

        .filters select:focus {
            border-color: #2980b9;
            outline: none;
        }

        .table-container {
            overflow-x: auto;
            max-height: 500px;
            border-radius: 8px;
            box-shadow: 0 0 6px rgba(0,0,0,0.1);
            background-color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        thead th {
            background-color: #e9ecef;
            color: #495057;
            font-weight: 600;
            position: sticky;
            top: 0;
            z-index: 1;
            padding: 12px;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            text-align: left;
            white-space: nowrap;
        }

        tbody tr:hover {
            background-color: #f2f2f2;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
        }

        /* Custom scrollbar for Chrome/Edge/Safari */
        .table-container::-webkit-scrollbar {
            height: 8px;
            width: 8px;
        }

        .table-container::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        .table-container::-webkit-scrollbar-thumb {
            background-color: #bbb;
            border-radius: 10px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .filters {
                flex-direction: column;
            }
        }
    </style>

    <div class="container">
        <h2 class="title">Aprendices asignados a Fichas</h2>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <form method="GET" action="">
            <div class="filters">
                <div>
                    <label for="combo_ficha">Ficha y Programa:</label>
                    <select name="combo_ficha" id="combo_ficha" onchange="this.form.submit()">
                        <option value="">-- Todas --</option>
                        @foreach($fichas as $ficha)
                            <option value="{{ $ficha['id'] }}" {{ request('combo_ficha') == $ficha['id'] ? 'selected' : '' }}>
                                {{ $ficha['ficha'] }} - {{ $ficha['programa'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="etapa">Filtrar por Etapa:</label>
                    <select name="etapa" id="etapa" onchange="this.form.submit()">
                        <option value="">-- Todas --</option>
                        <option value="lectiva" {{ request('etapa') == 'lectiva' ? 'selected' : '' }}>Lectiva</option>
                        <option value="practica" {{ request('etapa') == 'practica' ? 'selected' : '' }}>Práctica</option>
                    </select>
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
                        <th>Inicio Lectiva</th>
                        <th>Fin Lectiva</th>
                        <th>Inicio Práctica</th>
                        <th>Fin Práctica</th>
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
                            <td>{{ $apprentice['start_date_school_stage'] }}</td>
                            <td>{{ $apprentice['end_date_school_stage'] }}</td>
                            <td>{{ $apprentice['start_date_practical_stage'] }}</td>
                            <td>{{ $apprentice['end_date_practical_stage'] }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="no-data">No hay aprendices asignados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
