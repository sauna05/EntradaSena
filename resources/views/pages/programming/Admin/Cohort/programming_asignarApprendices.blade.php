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

    table th, table td {
        padding: 14px 18px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    table th {
        position: sticky;
        top: 0;
        background-color: #e9ecef;
        z-index: 1;
        font-weight: 700;
        color: #495057;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
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

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mt-2" style="margin-bottom: 20px; padding: 12px 16px; background-color: #d4edda; color: #155724; border-radius: 6px; border: 1px solid #c3e6cb;">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-2" style="margin-bottom: 20px; padding: 12px 16px; background-color: #f8d7da; color: #721c24; border-radius: 6px; border: 1px solid #f5c6cb;">
            {{ session('error') }}
        </div>
    @endif


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
             <!-- Botón -->
             <div class="form-buttons">
                <button type="submit" class="btn">Asignar Aprendices</button>
              </div>

            <div class="table-container" >
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
                                <td><input style="cursor: pointer" type="checkbox" name="aprendices[]" value="{{ $aprendiz->id }}"></td>
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
            </div>



        </form>

    </div>

</x-layout>
