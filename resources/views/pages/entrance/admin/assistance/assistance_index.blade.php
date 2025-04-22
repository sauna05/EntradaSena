<x-layout>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/assistance/assistance_index.css</x-slot:page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>CAA</x-slot:title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <div class="container mt-5">
        <h1 class="text-center mb-4">
            Lista de Asistencias -
            @if (request('week'))
                @php
                    [$start, $end] = explode('|', request('week'));
                @endphp
                Semana del {{ date('d/m/Y', strtotime($start)) }} al {{ date('d/m/Y', strtotime($end)) }}
            @else
                {{ request('filter_date', now()->format('Y-m-d')) }}
            @endif
        </h1>


        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Cantidad de Asistencias: <span class="badge bg-primary">{{ count($formattedPersons) }}</span></h3>

            <form method="GET" action="{{ route('entrance.assistance.index') }}" class="d-flex align-items-center">
                <!-- Select para filtrar por posición -->
                <select name="position_id" class="form-select me-2" onchange="this.form.submit()">
                    <option value="">Todos los puestos</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}"
                            {{ request('position_id') == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>

                <!-- Select para filtrar por semana -->
                <select id="weekSelect" name="week" class="form-select me-2" onchange="this.form.submit()">
                    <option value="">Todas las semanas</option>
                </select>



                <!-- Campo de fecha -->
                <input type="date" name="filter_date" class="form-control me-2" max="{{ now()->toDateString() }}"
                    value="{{ request('filter_date', now()->toDateString()) }}" onchange="this.form.submit()">

                <!-- Formulario de búsqueda -->
                <div class="input-group">
                    <input type="text" name="search" class="form-control"
                        placeholder="Buscar por nombre o documento" value="{{ request('search') }}">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </form>
        </div>

        @if (isset($noAttendanceMessage) && $noAttendanceMessage)
            <div class="alert alert-warning text-center">Hoy no se han registrado asistencias.</div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover shadow-sm">
                    <thead class="thead-dark text-center">
                        <tr>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Cargo</th>
                            <th>Entrada y Salida</th>
                            <th>Tiempo en el centro</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($formattedPersons as $person)
                            <tr>
                                <td>{{ $person['document_number'] }}</td>
                                <td>{{ $person['name'] }}</td>
                                <td>{{ $person['position'] }}</td>
                                <td>
                                    @forelse ($person['daily_data'] as $data)
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                Entrada: {{ $data['entrada'] ?? 'Sin registro' }}
                                            </div>
                                            <div>
                                                Salida: {{ $data['salida'] ?? 'No ha escaneado salida' }}
                                            </div>
                                        </div>
                                        @if (!$loop->last)
                                            <hr>
                                        @endif
                                    @empty
                                        <div class="text-center">Sin asistencias registradas para este día.</div>
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    {{ $person['total_time'] ?? 'No disponible' }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('entrance.assistance.show', $person['id']) }}"
                                        class="btn btn-primary btn-sm">
                                        Ver más
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No se encontraron asistencias.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const weekSelect = document.getElementById('weekSelect');
            const selectedWeek = @json(request('week'));

            const now = new Date();
            const startOfWeek = new Date(now.setDate(now.getDate() - (now.getDay() + 6) %
                7)); // Lunes de esta semana

            for (let i = 1; i <= 10; i++) {
                const start = new Date(startOfWeek);
                start.setDate(start.getDate() - (7 * i));
                const end = new Date(start);
                end.setDate(start.getDate() + 6);

                const startStr = start.toISOString().split('T')[0];
                const endStr = end.toISOString().split('T')[0];
                const label =
                    `Semana del ${start.toLocaleDateString('es-CO')} al ${end.toLocaleDateString('es-CO')}`;
                const value = `${startStr}|${endStr}`;

                const option = document.createElement('option');
                option.value = value;
                option.textContent = label;
                if (selectedWeek === value) option.selected = true;

                weekSelect.appendChild(option);
            }
        });
    </script>

</x-layout>
