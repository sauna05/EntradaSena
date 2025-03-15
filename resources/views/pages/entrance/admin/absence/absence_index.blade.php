<x-layout>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/entrance/admin/people_index.css</x:slot-page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>CAA</x:slot-title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <h1>Inasistencias</h1>

 @if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

<section class="search-container">
    {{-- de momento al buscar personas se cargará la pagina (al darle al botón)--}}
   <form method="GET" action="{{ route('entrance.absence.index') }}">
    <div>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Ingrese el documento o el nombre de la persona">
        <x-button type="submit">Buscar</x-button>
    </div>

    <section>
        <div>
            <p>Respondidas</p>
            <label for="answered-yes">Sí</label>
            <input type="checkbox" name="answered-yes" id="answered-yes" {{ request('answered-yes') ? 'checked' : '' }}>

            <label for="answered-no">No</label>
            <input type="checkbox" name="answered-no" id="answered-no" {{ request('answered-no') ? 'checked' : '' }}>
        </div>

        <div>
            <p>Leídas</p>
            <label for="readed-yes">Sí</label>
            <input type="checkbox" name="readed-yes" id="readed-yes" {{ request('readed-yes') ? 'checked' : '' }}>

            <label for="readed-no">No</label>
            <input type="checkbox" name="readed-no" id="readed-no" {{ request('readed-no') ? 'checked' : '' }}>
        </div>
    </section>
</form>


            {{-- Tabla con las inasistencias --}}
            
             <div class="">
                <table class="table table-bordered table-striped table-hover shadow-sm">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>documento</th>
                            <th>Nombre</th>
                            <th>Posicion</th>
                            <th>Ultima Asistencia</th>
                            <th>Estado</th>
                            <th>Leida</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($absences as $absence)
                            <tr>
                                <td>{{ $absence->person->document_number}}</td>
                                <td>{{ $absence->person->name}}</td>
                                <td>{{ $absence->person->position->position}}</td>
                                <td>{{ $absence->last_assistance}}</td>
                                <td>{{ $absence->state}}</td>
                                <td>{{ ($absence->readed) == 1 ? "Si" : "No"}}</td>
                                  
                                <td class="text-center">
                                    <a href="{{ route('entrance.absence.show', $absence->id) }}" class="btn btn-primary btn-sm">
                                        Ver más
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No se encontraron asistencias.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
    </div>
   
    


</section>



   
  
</x-layout> 