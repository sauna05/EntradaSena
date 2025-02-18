<x-layout>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/entrance/admin/people_show.css</x:slot-page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>Edit</x:slot-title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <h1>{{$person->name}}</h1>
    <form action="{{route('entrance.people.update',$person->id)}}" method="POST" class="data-people-container">
    @method('PUT')
    @csrf
        <section>
            <h2>Modificación de datos</h2>
            <div>
                <label for="id_position">Posición</label>
                <select name="id_position" id="id_position">
                    <option value="">Seleccione una Posición</option>
                    @foreach($positions as $id => $p)
                        <option value="{{ $p->id }}" {{ $person->id_position == $p->id ? 'selected' : '' }}>
                            {{ $p->position}}
                        </option>
                    @endforeach
                </select>
            </div>  
        
            <div>
                <label for="document_number">Numero de Documento</label>
                <input type="text" name="document_number" id="document_number" value="{{$person->document_number}}" >
            </div>

            <div>
                <label for="name">Nombre Completo</label>
                <input type="text" name="name" id="name" value="{{$person->name}}">
            </div>
            
            <div>
                <label for="start_date">Fecha de Inicio</label>
                <input type="date" name="start_date" id="start_date" value="{{$person->start_date->format('Y-m-d')}}">
            </div>

            <div>
                <label for="end_date">Fecha de Inicio</label>
                <input type="date" name="end_date" id="end_date" value="{{$person->end_date->format('Y-m-d')}}">
            </div>
            
            <x-button type="submit">Guardar Cambios</x-button>
        </section>

        <section class="data-person-days-available">
            <h2>Días Disponibles</h2>

            @foreach($days_available as $day)
                <div>
                    <label for="{{ $day->id }}">{{ $day->day }}</label>
                    <input type="checkbox" name="days[]" value="{{ $day->id }}" 
                    {{ $person->days_available->contains('id', $day->id) ? 'checked' : '' }} id="{{ $day->id }}">
                </div>
            @endforeach
        </section>
</form> 

<form action="{{route('entrance.people.delete',$person->id)}}" method="POST">
    @csrf
    @method('DELETE')
    <x-button class="btn" type="submit">Eliminar</x-button>
</form>

</x-layout> 