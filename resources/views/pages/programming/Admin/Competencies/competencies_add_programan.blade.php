<x-layout>
    <x-slot:page_style>css/pages/Programming/style_competencies_add_programan.css</x-slot:page_style>
    <x-slot:title>Asignar Competencias</x-slot:title>

    {{-- FontAwesome para íconos --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f1f3f5;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.07);
        }

        h2 {
            text-align: center;
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            color: #555;
        }

        select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            margin-bottom: 25px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: border-color 0.3s;
        }

        select:focus {
            border-color: #6c757d;
            outline: none;
            box-shadow: 0 0 4px rgba(108, 117, 125, 0.3);
        }

        .table-container {
            max-height: 350px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            color: #444;
            background-color: #f8f9fa;
        }

        table th, table td {
            padding: 14px 16px;
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

        input[type="checkbox"] {
            cursor: pointer;
            transform: scale(1.2);
        }

        .form-buttons {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .btn {
            background-color: #6c757d;
            color: white;
            padding: 14px 35px;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .btn:hover {
            background-color: #5a6268;
        }
    </style>

    <div class="container">
        <h2>Vincular Competencias a Programas</h2>

        <form action="{{ route('programing.competencies_store_program') }}" method="POST" id="asignarForm">
            @csrf

            <label for="programa">Selecciona un programa:</label>
            <select id="programa" name="programa_id" required>
                <option value="">-- Selecciona un programa --</option>
                @forelse ($programas as $programa)
                    <option value="{{ $programa->id }}">{{ $programa->name }}</option>
                @empty
                    <option disabled>No hay programas disponibles</option>
                @endforelse
            </select>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre Competencia</th>
                            <th>Duración</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($competencias as $competencia)
                            <tr>
                                <td>
                                    <input type="checkbox" name="competencias[]" value="{{ $competencia->id }}">
                                </td>
                                <td>{{ $competencia->name }}</td>
                                <td>{{ $competencia->duration_hours }} hr</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="text-align:center; color:#888; font-style: italic;">
                                    No hay competencias para vincular.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn">
                    <i class="fas fa-check-circle"></i> Asignar Competencias
                </button>
            </div>
        </form>
    </div>
</x-layout>
