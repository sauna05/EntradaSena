<x-layout_asistencia>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/entrance/admin/people_show.css</x:slot-page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>CAA</x:slot-title>



    <section class="data-people-container">
        {{-- <h2>{{$email}}</h2> --}}
        <div>
            <h2>Datos de la persona seleccionada</h2>

            <p>Nombre: {{$person->name}}</p>
            <p>Numero de documento: {{$person->document_number}}</p>
            <p>Cargo: {{$person->position->name}}</p>
            <p>Fecha de inicio: {{$person->start_date->format('Y/m/d')}}</p>
            <p>Fecha de Finalizacion: {{$person->end_date->format('Y/m/d')}}</p>
        </div>

    <div class="data-person-days-available">
    <h2>Días que puede ir la persona al centro</h2>

    @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dayName)
        <div>
            <span>{{ $dayName }}</span>
            @php
                // Buscar si el día está disponible en los días de la persona
                $isAvailable = $person->days_available->contains('name', $dayName);
            @endphp

            @if ($isAvailable)
                <span style="color: green;">✓</span>  {{-- Chulito verde si está disponible --}}
            @else
                <span style="color: red;">✘</span>  {{-- X roja si no está disponible --}}
            @endif
        </div>
    @endforeach
</div>


    </section>

    <section>
        <form action="{{route('entrance.people.edit',$person->id)}}" method="GET">
            @csrf
            <button type="submit">Actualizar Datos</button>
        </form>
        {{-- Formulario de borrar --}}
    </section>

</x-layout_asistencia>
