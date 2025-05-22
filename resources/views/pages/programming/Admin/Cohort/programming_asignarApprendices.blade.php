<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Asignar Aprendices</x-slot:title>

    <style>
        .container {
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        h2 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #2c3e50;
            font-weight: 700;
            text-align: center;
        }

        label {
            font-weight: 600;
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        select {
            width: 100%;
            max-width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
            font-size: 15px;
            color: #444;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        table th, table td {
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #e9ecef;
            font-weight: 700;
            color: #495057;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        .form-buttons {
            text-align: center;
            margin-top: 25px;
        }

        .btn {
            background-color: #6c757d;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            max-width: 250px;
            width: 100%;
        }

        .btn:hover {
            background-color: #5a6268;
        }

        #ficha {
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
    </style>

    <div class="container">
        <h2>Asignar Aprendices a Fichas</h2>

        <!-- Selector de ficha -->
        <form action="{{ route('programing.add_apprentices_store') }}" method="POST" id="asignarForm">
            @csrf

            <label for="ficha">Selecciona una ficha:</label>
            <select id="ficha" name="ficha_id" required>
                <option value="">-- Selecciona una ficha --</option>
                @foreach($cohorts as $cohort)
                    <option value="{{ $cohort->id }}">
                        {{ $cohort->number_cohort }} - {{ $cohort->program->name ?? 'Programa no asignado' }}
                    </option>
                @endforeach
            </select>

            <!-- Lista de aprendices -->
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre</th>
                        <th>Documento</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aprentices as $aprendiz)
                        <tr>
                            <td><input type="checkbox" name="aprendices[]" value="{{ $aprendiz->id }}"></td>
                            <td>{{ $aprendiz->person->name }}</td>
                            <td>{{ $aprendiz->person->document_number }}</td>
                            <td>{{ $aprendiz->person->email }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; font-style: italic; color: #888;">
                                No hay aprendices disponibles.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Botón -->
            <div class="form-buttons">
                <button type="submit" class="btn">Asignar Aprendices</button>
            </div>
        </form>
    </div>
</x-layout>
