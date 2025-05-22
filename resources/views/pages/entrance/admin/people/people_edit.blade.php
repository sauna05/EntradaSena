<x-layout_asistencia>
    {{-- Archivo CSS de la página --}}
    <x-slot:page_style>css/pages/entrance/admin/people_show.css</x:slot-page_style>

    {{-- Título de la página --}}
    <x-slot:title>Edit</x:slot-title>



    <h1>{{$person->name}}</h1>

    {{-- Formulario para editar los datos de la persona --}}
    <form action="{{route('entrance.people.update', $person->id)}}" method="POST" class="data-people-container">
        @method('PUT')
        @csrf

        <section>
            <h2>Modificación de datos</h2>

            {{-- Campo para seleccionar el cargo --}}
            <div>
                <label for="id_position">Cargo</label>
                <select name="id_position" id="id_position">
                    <option value="">Seleccione un cargo</option>
                    @foreach($positions as $id => $position)
                        <option value="{{ $position->id }}" {{ $person->id_position == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Campo para el número de documento --}}
            <div>
                <label for="document_number">Número de Documento</label>
                <input type="text" name="document_number" id="document_number" value="{{ $person->document_number }}">
            </div>

            {{-- Campo para el nombre completo --}}
            <div>
                <label for="name">Nombre Completo</label>
                <input type="text" name="name" id="name" value="{{ $person->name }}">
            </div>

            {{-- Campo para la fecha de inicio --}}
            <div>
                <label for="start_date">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date" value="{{ $person->start_date->format('Y-m-d') }}">
            </div>

            {{-- Campo para la fecha de finalización --}}
            <div>
                <label for="end_date">Fecha de Finalización</label>  {{-- Corregido aquí --}}
                <input type="date" name="end_date" id="end_date" value="{{ $person->end_date->format('Y-m-d') }}">
            </div>

            {{-- Botón para guardar cambios --}}
            <x-button type="submit">Guardar Cambios</x-button>
        </section>

        {{-- Sección para seleccionar los días disponibles --}}
        <section class="data-person-days-available">
            <h2>Días Disponibles</h2>

            @foreach($days_available as $day)
                <div>
                    <label for="{{ $day->id }}">{{ $day->name }}</label>
                    <input type="checkbox" name="days[]" value="{{ $day->id }}"
                        {{ $person->days_available->contains('id', $day->id) ? 'checked' : '' }} id="{{ $day->id }}">
                </div>
            @endforeach
        </section>
    </form>

    {{-- Formulario para eliminar la persona --}}
    <form action="{{ route('entrance.people.delete', $person->id) }}" method="POST" onsubmit="return eliminarReturn()">
        @csrf
        @method('DELETE')
        <x-button class="btn" type="submit">Eliminar</x-button>
    </form>

    {{-- Script para confirmar la eliminación --}}
    <script>
        function eliminarReturn() {
            return confirm("¿Está seguro que desea eliminar este registro?");
        }
    </script>

</x-layout_asistencia>
