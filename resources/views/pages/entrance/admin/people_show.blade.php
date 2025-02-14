<x-layout>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/entrance/admin/people_show.css</x:slot-page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>CAA</x:slot-title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>
   
    <h2>Datos de la persona seleccionada</h2>

    <div>
        <p>Nombre: {{$person->name}}</p>
        <p>Numero de documento: {{$person->document_number}}</p>
        <p>Posicion: {{$person->position->position}}</p>
        <p>Fecha de inicio: {{$person->start_date->format('Y/m/d')}}</p>
        <p>Fecha de Finalizacion: {{$person->end_date->format('Y/m/d')}}</p>
    </div> 
   
    <section>
        <form action="{{route('entrance.people.edit',$person->id)}}" method="GET">
            @csrf
            <button type="submit">Editar Datos</button>
        </form>
        {{-- Formulario de borrar --}}  
    </section>

</x-layout> 