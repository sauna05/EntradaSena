<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Asignar Aprendices</x-slot:title>

    <style>
        .container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.07);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h2 {
            font-size: 26px;
            margin-bottom: 30px;
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
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            margin-bottom: 25px;
            max-width: 500px;
        }

        .alert {
            margin: 0 auto 20px auto;
            max-width: 1000px;
        }

        .table-container {
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 15px;
            background-color: #fff;
        }

        th, td {
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
            text-align: left;
            vertical-align: middle;
        }

        thead th {
            position: sticky;
            top: 0;
            background-color: #e9ecef;
            z-index: 1;
            font-weight: 700;
            color: #495057;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .form-section {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-buttons {
            text-align: center;
            margin-top: 30px;
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

        .no-data {
            text-align: center;
            font-style: italic;
            color: #888;
            padding: 20px 0;
        }

        input[type="checkbox"] {
            transform: scale(1.2);
            cursor: pointer;
        }
    </style>

    {{-- Alertas --}}
    @if (session('success'))
        <div class="alert alert-success" style="background-color: #d4edda; color: #155724; border-radius: 6px; border: 1px solid #c3e6cb; padding: 12px 16px;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; border-radius: 6px; border: 1px solid #f5c6cb; padding: 12px 16px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <h2>Vincular Aprendices a Programa y Ficha</h2>

        <form action="{{ route('programing.add_apprentices_store') }}" method="POST" id="asignarForm">
            @csrf

            <div class="form-section">
                <label for="ficha">Seleccione Ficha y Programa de Formación</label>
                <select id="ficha" name="ficha_id" required>
                    <option value="">Seleccionar</option>
                    @foreach($cohorts as $cohort)
                        <option value="{{ $cohort->id }}">
                            {{ $cohort->number_cohort }} - {{ $cohort->program->name ?? 'Programa no asignado' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($aprentices as $aprendiz)
                            <tr>
                                <td>
                                    <input type="checkbox" name="aprendices[]" value="{{ $aprendiz->id }}">
                                </td>
                                  <td>{{ $aprendiz->person->document_number }}</td>
                                <td>{{ $aprendiz->person->name }}</td>

                                <td>{{ $aprendiz->person->email }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="no-data">No hay aprendices disponibles.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn">Vincular Aprendices</button>
            </div>
        </form>
    </div>
</x-layout>
