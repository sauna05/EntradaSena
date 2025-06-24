<x-layout_asistencia>
    {{-- Archivo CSS de la página --}}
 
    {{-- Título de la página --}}
    <x-slot:title>Historial de Asistencias</x-slot:title>

    <style>
        /* Contenedor principal */
.container {
    width: 90%;
    max-width: 1100px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
    color: #333;
}

/* Títulos */
h1.text-center, h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
    font-weight: 700;
}

h3.text-secondary {
    color: #555;
    margin-bottom: 15px;
}

/* Información del usuario */
.user-info {
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 6px;
    margin-bottom: 30px;
}

.user-info p {
    margin: 8px 0;
    font-size: 1.1em;
}

/* Botón */
a.btn-primary {
    display: inline-block;
    background-color: #007bff;
    color: white;
    padding: 10px 18px;
    width: max-content;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    margin-bottom: 20px;
    transition: background-color 0.3s ease;
}

a.btn-primary:hover {
    background-color: #0056b3;
}

/* Tabla responsive */
.table-responsive {
    overflow-x: auto;
}

/* Tabla */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

thead {
    background-color: #2c3e50;
    color: white;
}

th, td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: center;
    font-size: 1em;
}

tbody tr:nth-child(even) {
    background-color: #f5f5f5;
}

tbody tr:hover {
    background-color: #e9ecef;
}

/* Badges */
.badge {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-weight: 600;
    color: white;
    min-width: 70px;
}

.bg-success {
    background-color: #28a745;
}

.bg-danger {
    background-color: #dc3545;
}

/* Alert info */
.alert {
    padding: 15px 20px;
    border-radius: 6px;
    font-size: 1.1em;
    text-align: center;
    margin-top: 30px;
}

.alert-info {
    background-color: #d1ecf1;
    color: #0c5460;
    border: 1px solid #bee5eb;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        width: 95%;
        padding: 15px;
    }

    th, td {
        padding: 10px 8px;
        font-size: 0.9em;
    }

    a.btn-primary {
        padding: 8px 14px;
        font-size: 0.95em;
    }
}

    </style>
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
            Asistencias de hoy
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
