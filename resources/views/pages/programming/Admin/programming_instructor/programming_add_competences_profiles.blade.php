<x-layout>
    <x-slot:page_style>css/pages/Programming/style_competencies_add_programan.css</x-slot:page_style>
    <x-slot:title>Asignar Competencias</x-slot:title>
    <link rel="stylesheet" href="{{ asset('css/pages/Programming/style_competencies_add_programan.css') }}">

    <div class="container">
        <h2>Vincular Competencias al perfil del Instructor</h2>

        <form action="{{route('programming.instructors_competencies_profile_store')}}" method="POST" id="asignarForm">
            @csrf

            {{-- Nuevo filtro de especialidad --}}
            <label for="especialidadSelect">Filtrar por Especialidad:</label>
            <select id="especialidadSelect">
                <option value="">Todas las especialidades</option>
                @foreach ($especialidad as $esp)
                    <option value="{{ $esp->id }}">{{ $esp->name }}</option>
                @endforeach
            </select>

            {{-- Selector de instructor --}}
            <label for="isntructor">Selecciona un instructor según su especialidad:</label>
            <select id="programa" name="instructor_id" required>
                <option value=""> Selecciona un instructor </option>
                @forelse ($instructors as $perfil)
                    <option value="{{ $perfil->id }}">
                        {{ $perfil->person->document_number }} - {{ $perfil->person->name }} - {{$perfil->speciality->name}}
                    </option>
                @empty
                    <option disabled>No hay instructores disponibles</option>
                @endforelse
            </select>

            {{-- Tabla de competencias --}}
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Nombre Competencia</th>
                        <th>Código</th>
                    </tr>
                </thead>
                <tbody id="competenciasContainer">
                    @foreach($especialidad as $esp)
                        @foreach($esp->competencies as $competencia)
                            <tr data-especialidad="{{ $esp->id }}">
                                <td>
                                    <input type="checkbox" name="competencias[]" value="{{ $competencia->id }}">
                                </td>
                                <td>{{ $competencia->name }}</td>
                                <td>{{ $competencia->duration_hours }} hr </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>

            <div class="form-buttons">
                <button type="submit" class="btn">Asignar Competencias</button>
            </div>
        </form>
    </div>

    {{-- Script para filtrar por especialidad --}}
    <script>
        document.getElementById('especialidadSelect').addEventListener('change', function () {
            const selectedId = this.value;
            const rows = document.querySelectorAll('#competenciasContainer tr');

            rows.forEach(row => {
                const rowEspId = row.getAttribute('data-especialidad');
                if (selectedId === '' || rowEspId === selectedId) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</x-layout>
