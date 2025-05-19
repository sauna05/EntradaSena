<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Listado de Aprendices por Ficha</x-slot:title>
    <x-programming_navbar></x-programming_navbar>

    <style>
        .container {
            padding: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
        }

        h2.title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .success-message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
        }
    </style>

    <div class="container">
        <h2 class="title">Aprendices asignados a Fichas</h2>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="">
        <label for="combo_ficha">Seleccionar ficha y programa:</label>
        <select name="combo_ficha" id="combo_ficha" onchange="this.form.submit()">
            <option value="">-- Todas --</option>
            @foreach($fichas as $ficha)
                <option value="{{ $ficha['id'] }}" {{ request('combo_ficha') == $ficha['id'] ? 'selected' : '' }}>
                    {{ $ficha['ficha'] }} - {{ $ficha['programa'] }}
                </option>
            @endforeach
        </select>
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
                        <th>Fecha inicio lectiva</th>
                        <th>Fecha fin lectiva</th>
                        <th>Fecha inicio práctica</th>
                        <th>Fecha fin práctica</th>
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
