<x-layout_asistencia>
    {{-- Titulo de la pagina --}}
    <x-slot:title>Detalle de Asistencia</x-slot:title>
 
    {{-- Header - Navbar --}}
    <style>
        /* General Body & Container */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f7f6; /* Un gris muy claro */
    color: #333;
}

.container-custom {
    width: 90%;
    max-width: 1200px;
    margin: 50px auto; /* Margen superior e inferior para separación */
    padding: 30px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

/* Títulos */
.page-title {
    text-align: center;
    margin-bottom: 40px;
    color: #2c3e50; /* Azul oscuro */
    font-size: 2.5em;
    font-weight: bold;
}

.section-title {
    margin-top: 40px;
    margin-bottom: 25px;
    color: #2c3e50;
    font-size: 2em;
    font-weight: 600;
}

.card-title {
    color: #34495e; /* Gris azulado */
    margin-bottom: 20px;
    font-size: 1.5em;
    font-weight: 600;
}

/* Información del Usuario */
.user-info-card {
    padding: 25px;
    background-color: #ecf0f1; /* Gris claro */
    border: 1px solid #dcdcdc;
    border-radius: 8px;
    margin-bottom: 40px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
}

.user-info-card p {
    margin-bottom: 10px;
    line-height: 1.6;
    font-size: 1.1em;
}

/* Botón de Historial */
.button-container {
    margin-bottom: 30px;
    text-align: left; /* Alinea el botón a la izquierda */
}

.history-button {
    display: inline-block; /* Permite que el padding y margin funcionen correctamente */
    padding: 12px 25px;
    background-color: #3498db; /* Azul vibrante */
    color: white;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
    font-size: 1.1em;
    font-weight: bold;
    border: none;
    cursor: pointer;
}

.history-button:hover {
    background-color: #2980b9; /* Azul más oscuro al pasar el mouse */
}

.history-button h2 {
    display: inline; /* Para que el h2 no ocupe todo el ancho */
    font-size: 1.1em; /* Ajusta el tamaño de la fuente dentro del botón */
    margin: 0; /* Elimina márgenes por defecto del h2 */
    font-weight: bold;
    color: inherit; /* Hereda el color del botón */
}


/* Tabla */
.table-responsive-custom {
    overflow-x: auto; /* Permite desplazamiento horizontal en pantallas pequeñas */
    margin-top: 30px;
    margin-bottom: 30px;
}

.data-table {
    width: 100%;
    border-collapse: collapse; /* Elimina espacios entre celdas */
    margin-bottom: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    background-color: #fff;
}

.data-table thead.table-header {
    background-color: #2c3e50; /* Azul oscuro */
    color: white;
}

.data-table th,
.data-table td {
    padding: 15px;
    text-align: center;
    border: 1px solid #ddd; /* Bordes suaves para celdas */
}

.data-table tbody tr:nth-child(even) {
    background-color: #f8f8f8; /* Fondo rayado para filas pares */
}

.data-table tbody tr:hover {
    background-color: #f1f1f1; /* Resaltar fila al pasar el mouse */
}

/* Badges (Acciones: Entrada/Salida) */
.badge-success,
.badge-danger {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px; /* Bordes redondeados */
    font-size: 0.9em;
    font-weight: bold;
    color: white;
    min-width: 70px; /* Ancho mínimo para consistencia */
}

.badge-success {
    background-color: #2ecc71; /* Verde */
}

.badge-danger {
    background-color: #e74c3c; /* Rojo */
}

/* Mensaje de Alerta */
.alert-info-custom {
    padding: 20px;
    background-color: #d9edf7; /* Azul claro */
    border: 1px solid #bce8f1;
    color: #31708f;
    border-radius: 5px;
    text-align: center;
    margin-top: 30px;
    font-size: 1.1em;
}

/* Clases de texto personalizadas */
.text-primary-custom {
    color: #3498db; /* Azul principal */
}

.text-dark-custom {
    color: #2c3e50; /* Texto oscuro para información */
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .container-custom {
        width: 95%;
        padding: 20px;
        margin: 20px auto;
    }

    .page-title {
        font-size: 2em;
        margin-bottom: 30px;
    }

    .section-title {
        font-size: 1.8em;
    }

    .user-info-card p,
    .history-button,
    .data-table th,
    .data-table td,
    .alert-info-custom {
        font-size: 1em;
    }

    .data-table th, .data-table td {
        padding: 10px;
    }
}

@media (max-width: 480px) {
    .page-title {
        font-size: 1.8em;
    }

    .section-title {
        font-size: 1.5em;
    }

    .user-info-card, .table-responsive-custom {
        margin-bottom: 20px;
    }

    .history-button {
        display: block; /* Ocupa todo el ancho en pantallas muy pequeñas */
        text-align: center;
    }
}

    </style>
 
    <div class="container-custom">
        <h1 class="page-title">
            Detalle de Asistencia de: <span class="text-primary-custom">{{ $person->name }}</span>
        </h1>

        <!-- Información del usuario -->
        <div class="user-info-card">
            <h3 class="card-title">Información del Usuario</h3>
            <p><strong>Nombre:</strong> <span class="text-dark-custom">{{ $person->name }}</span></p>
            <p><strong>Documento:</strong> <span class="text-dark-custom">{{ $person->document_number }}</span></p>
            <p><strong>Cargo:</strong> <span class="text-dark-custom">{{ $person->position->name ?? 'Sin puesto asignado' }}</span></p>
        </div>

        <!-- Historial de asistencias  -->
        <h2 class="section-title">Historial de Asistencias del día de hoy</h2>

        <div class="button-container">
            <a href="{{ route('assistance_show_history', $person->id) }}" class="history-button">
                Ver historial de todas las asistencias de <h2>{{ $person->name }}</h2>
            </a>
        </div>


        @if ($formattedEntrancesExits->count() > 0)
            <!-- Tabla estilizada -->
            <div class="table-responsive-custom">
                <table class="data-table">
                    <thead class="table-header">
                        <tr>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($formattedEntrancesExits as $entry)
                            <tr>
                                <td>{{ $entry['date'] }}</td>
                                <td>{{ $entry['time'] }}</td>
                                <!-- Acción estilizada -->
                                <td>
                                    @if ($entry['action'] === 'entrada')
                                        <span class="badge-success">Entrada</span>
                                    @elseif ($entry['action'] === 'salida')
                                        <span class="badge-danger">Salida</span>
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
            <div class="alert-info-custom">No hay registros de asistencia para esta persona.</div>
        @endif
    </div>

</x-layout_asistencia>
