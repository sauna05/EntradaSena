<x-layout>
    <x-slot:page_style>css/pages/Programming/style_competencies_add_programan.css</x-slot:page_style>
    <x-slot:title>Asignar Competencias</x-slot:title>
    <link rel="stylesheet" href="{{ asset('css/pages/Programming/style_competencies_add_programan.css') }}">

    <div class="container">
        <h2>Asignar Competencias a Programas</h2>

        <form action="{{ route('programing.competencies_store_program') }}" method="POST" id="asignarForm">
            @csrf

            <label for="programa">Selecciona un programa:</label>
            <select id="programa" name="programa_id" required>
                <option value="">-- Selecciona un programa --</option>

                @forelse ( $programas  as  $programa)
                <option value="{{ $programa->id }}">
                    {{ $programa->name }}
                </option>
                @empty
                <tr>
                    <td colspan="4" style="text-align:center; font-style: italic; color: #888;">
                        No hay competencias para vincular.
                    </td>
                </tr>
                    
                @endforelse

            </select>

            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre Competencia</th>
                        <th>Código</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($competencias as $competencia)
                        <tr>
                            <td>
                                <input type="checkbox" name="competencias[]" value="{{ $competencia->id }}">
                            </td>
                            <td>{{ $competencia->name }}</td>
                            <td>{{ $competencia->duration_hours }} hr </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="form-buttons">
                <button type="submit" class="btn">Asignar Competencias</button>
            </div>
        </form>
    </div>
</x-layout>
