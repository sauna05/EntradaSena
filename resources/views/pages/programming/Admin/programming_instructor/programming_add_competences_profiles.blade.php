<x-layout>
    <x-slot:title>Asignar Competencias</x-slot:title>
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

        .form-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 25px;
        }

        .form-group > div {
            flex: 1;
            min-width: 260px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
        }

        select {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            border: 1px solid #ced4da;
            border-radius: 6px;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-top: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            background-color: #fff;
        }

        thead th {
            position: sticky;
            top: 0;
            background-color: #e9ecef;
            z-index: 1;
        }

        th, td {
            padding: 12px 14px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        input[type="checkbox"] {
            transform: scale(1.2);
            cursor: pointer;
        }

        .form-buttons {
            text-align: center;
            margin-top: 30px;
        }

        .btn {
            background-color: #198754;
            color: white;
            padding: 14px 35px;
            width: max-content;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn i {
            margin-right: 8px;
        }

        .btn:hover {
            background-color: #146c43;
        }

        .alert {
            padding: 12px;
            border-radius: 6px;
            font-weight: 500;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }
    </style>

    <div class="container">
        <h2>Vincular Competencias al perfil del Instructor</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('programming.instructors_competencies_profile_store') }}" method="POST">
            @csrf

            <div class="form-group">
                <div>
                    <label for="especialidadSelect">Filtrar por Especialidad:</label>
                    <select id="especialidadSelect">
                        <option value="">Todas las especialidades</option>
                        @foreach ($especialidad as $esp)
                            <option value="{{ $esp->id }}">{{ $esp->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="programa">Selecciona un Instructor:</label>
                    <select id="programa" name="instructor_id" required>
                        <option value="">Selecciona un instructor</option>
                        @foreach ($instructors as $perfil)
                            <option value="{{ $perfil->id }}">
                                {{ $perfil->person->document_number }} - {{ $perfil->person->name }} - {{ $perfil->speciality->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Nombre de la Competencia</th>
                            <th>Duración</th>
                        </tr>
                    </thead>
                    <tbody id="competenciasContainer">
                        @foreach($especialidad as $esp)
                            @foreach($esp->competencies as $competencia)
                                <tr data-especialidad="{{ $esp->id }}">
                                    <td><input type="checkbox" name="competencias[]" value="{{ $competencia->id }}"></td>
                                    <td>{{ $competencia->name }}</td>
                                    <td>{{ $competencia->duration_hours }} hr</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn">
                    <i class="fas fa-link"></i> Vincular Competencias
                </button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('especialidadSelect').addEventListener('change', function () {
            const selectedId = this.value;
            const rows = document.querySelectorAll('#competenciasContainer tr');

            rows.forEach(row => {
                const rowEspId = row.getAttribute('data-especialidad');
                row.style.display = (selectedId === '' || rowEspId === selectedId) ? '' : 'none';
            });
        });
    </script>
</x-layout>
