<x-layout>
    <x-slot:page_style>css/pages/Programming/style_dasboard.css</x-slot:page_style>
    <x-slot:title>Asignar Aprendices</x-slot:title>
    <x-programming_navbar></x-programming_navbar>

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
                    @foreach($aprentices as $aprendiz)
                        <tr>
                            <td>
                                <input type="checkbox" name="aprendices[]" value="{{ $aprendiz->id }}">
                            </td>
                            <td>{{ $aprendiz->person->name }} </td>
                            <td>{{ $aprendiz->person->document_number }}</td>
                            <td>{{ $aprendiz->person->email }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Botón -->
            <div class="form-buttons">
                <button type="submit" class="btn">Asignar Aprendices</button>
            </div>
        </form>
    </div>
</x-layout>
