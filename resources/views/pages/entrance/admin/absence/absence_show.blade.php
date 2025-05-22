<x-layout_asistencia>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/assistance/assistance_show.css</x-slot:page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>Detalles de Inasistencia</x-slot:title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <div class="container mt-5">
        <h1 class="text-center mb-4">
            Detalle de Inasistencia de: <span class="text-primary">{{ $absence->person->name }}</span>
        </h1>

        <!-- Información del usuario -->
        <section class="mb-4 p-4 border rounded shadow-sm bg-light user-info">
            <h3 class="text-secondary">Información del Usuario</h3>
            <p><strong>Nombre:</strong> {{ $absence->person->name }}</p>
            <p><strong>Documento:</strong> {{ $absence->person->document_number }}</p>
            <p><strong>Posicion:</strong> {{ $absence->person->position->name ?? 'Sin puesto asignado' }}</p>
            <p><strong>Estado:</strong> {{$absence->state}}</p>
        </section>


        {{-- Motivo de la inasistencia --}}
        <section>
            <h2>Motivo de Inasistencia</h2>

            <div>
                @if (!$absence->motive)
                    <h3>No ha sido respondida</h3>
                @else
                    <p>{{$absence->motive}}</p>
                @endif
            </div>

            <div>
                @if ($absence->motive && $absence->readed == "0")
                <form action="{{route('entrance.absence.update.readed',$absence->person->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="submit" value="Leido">
                </form>
                @endif
            </div>
        </section>

    </div>

</x-layout_asistencia>


