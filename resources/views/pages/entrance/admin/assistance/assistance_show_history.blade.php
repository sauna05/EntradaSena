<x-layout_asistencia>
    {{-- Archivo CSS de la página --}}
    <x-slot:page_style>css/pages/assistance/assistance_show.css</x-slot:page_style>
    {{-- Título de la página --}}
    <x-slot:title>Historial de Asistencias</x-slot:title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <div class="container mt-5">
        <h1 class="text-center mb-4">
            Historial de Asistencias de: <span class="text-primary">{{ $person->name }}</span>
        </h1>

        <!-- Información del usuario -->
        <div class="mb-4 p-4 border rounded shadow-sm bg-light user-info">
            <h3 class="text-secondary">Información del Usuario</h3>
            <p><strong>Nombre:</strong> {{ $person->name }}</p>
            <p><strong>Documento:</strong> {{ $person->document_number }}</p>
            <p><strong>Cargo:</strong> {{ $person->position->name ?? 'Sin puesto asignado' }}</p>
        </div>

        <!-- Historial de asistencias -->
        <h2 class="mb-4">Todas las asistencias registradas</h2>
        <a href="{{ route('entrance.assistance.show', $person['id']) }}" class="btn btn-primary mb-3">
            Ver solo asistencias de hoy
        </a>

        @if ($formattedEntrancesExits->count() > 0)
            <!-- Tabla estilizada -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover shadow-sm">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formattedEntrancesExits as $entry)
                            <tr class="text-center">
                                <td>{{ $entry['date'] }}</td>
                                <td>{{ $entry['time'] }}</td>
                                <td>
                                    @if ($entry['action'] === 'entrada')
                                        <span class="badge bg-success">Entrada</span>
                                    @elseif ($entry['action'] === 'salida')
                                        <span class="badge bg-danger">Salida</span>
                                    @else
                                        {{ $entry['action'] }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Mensaje si no hay asistencias -->
            <div class="alert alert-info text-center">Este usuario no tiene registros de asistencia.</div>
        @endif
    </div>
</x-layout_asistencia>
