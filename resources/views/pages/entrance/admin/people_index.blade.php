<x-layout>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/entrance/admin/people_index.css</x:slot-page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>CAA</x:slot-title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <h1>PERSONAS EN EL CENTRO DE FORMACIÓN</h1>

 @if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

<section class="search-container">
    {{-- de momento al buscar personas se cargará la pagina --}}
   <form method="GET" action="{{ route('entrance.people.index') }}" class="search-form">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Ingrese el documento o el nombre de la persona">
                <x-button type="submit" >Buscar</x-button>
            </div>
    </form>

    <div class="btn-search-container">
        <a href="{{route('entrance.people.create')}}"><x-button>Registrar Persona</x-button></a>
    </div>
</section>
   

    {{-- Index de personas registradas --}}
    <section>
     
        @if ($person->isEmpty())
            <h3>No se encontraron resultados</h3>
        @else
          <table>
            
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Posición</th>
                    <th>Numero de Documento</th>
                    <th>Nombre</th>
                    <th>Fecha de Inicio</th>
                    <th>Fecha de Finalizacion</th>
                    <th>Accion</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($person as $p)
                    
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->position->position}}</td>
                    <td>{{$p->document_number}}</td>
                    <td>{{$p->name}}</td>
                    <td>{{$p->start_date->format('d/m/Y')}}</td>
                    <td>{{$p->end_date->format('d/m/Y')}}</td>
                    <td><a href="{{route('entrance.people.show',$p->id)}}">
                            {{-- <img src="{{asset('icons/edit.png')}}" alt="" class="icon"> --}}
                            Ver
                        </a>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>    
            
        @endif
    </section>

    <div>
        {{$person->links()}}
    </div>
</x-layout> 