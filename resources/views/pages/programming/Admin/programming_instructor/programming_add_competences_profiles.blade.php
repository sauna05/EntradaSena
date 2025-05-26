<x-layout>
    <x-slot:page_style>css/pages/Programming/style_competencies_add_programan.css</x-slot:page_style>
    <x-slot:title>Asignar Competencias</x-slot:title>
    <link rel="stylesheet" href="{{ asset('css/pages/Programming/style_competencies_add_programan.css') }}">

    <div class="container">
        <h2>Asignar Competencias al perfil del Instructor</h2>

        <form action="{{route('programming.instructors_competencies_profile_store')}}" method="POST" id="asignarForm">
            @csrf

            <label for="isntructor">Selecciona un instructor:</label>
            <select id="programa" name="instructor_id" required>
                <option value="">-- Selecciona un instructor --</option>
                @forelse ($instructors as $perfil)
                    <option value="{{ $perfil->id }}">
                        {{ $perfil->person->name }} - {{ $perfil->person->document_number }}
                    </option>
                @empty
                    <option disabled>No hay instructores disponibles</option>
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
