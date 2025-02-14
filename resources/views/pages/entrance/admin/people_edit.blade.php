<x-layout>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/entrance/admin/people_show.css</x:slot-page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>Edit</x:slot-title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <h1>{{$person->name}}</h1>
    <h1>Vista de edicion</h1>
    <form action="{{route('entrance.people.update',$person->id)}}" method="POST">
    @method('PUT')
    @csrf
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

   
</form> 

</x-layout> 