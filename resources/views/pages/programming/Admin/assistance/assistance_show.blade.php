<x-layout>
    {{-- Titulo de la pagina --}}
    <x-slot:title>Detalle de Asistencia</x-slot:title>

    <style>
        /* Variables de colores SENA */
        :root {
            --verde-sena: #39A900;
            --verde-claro: #e6f4ef;
            --verde-oscuro: #2f7a00;
            --gris-claro: #f8f9fa;
            --gris-medio: #e9ecef;
            --gris-oscuro: #343a40;
            --blanco: #ffffff;
            --sombra: 0 4px 20px rgba(0, 0, 0, 0.08);
            --radius: 12px;
            --transicion: all 0.3s ease;
        }

        /* Estructura principal */
        .container-custom {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        /* Header con gradiente */
        .page-header {
            background: linear-gradient(135deg, var(--verde-sena) 0%, var(--verde-oscuro) 100%);
            color: white;
            padding: 30px;
            border-radius: var(--radius);
            margin-bottom: 30px;
            box-shadow: var(--sombra);
            position: relative;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(-15deg);
        }

        .page-title {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            position: relative;
        }

        .page-subtitle {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        /* Tarjeta de información del usuario */
        .user-info-card {
            background: var(--blanco);
            border-radius: var(--radius);
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: var(--sombra);
            border-left: 4px solid var(--verde-sena);
        }

        .card-title {
            color: var(--verde-oscuro);
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-title i {
            color: var(--verde-sena);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            padding: 15px;
            background: var(--gris-claro);
            border-radius: 8px;
            transition: var(--transicion);
        }

        .info-item:hover {
            background: var(--gris-medio);
            transform: translateY(-2px);
        }

        .info-label {
            font-size: 0.9rem;
            color: var(--gris-oscuro);
            margin-bottom: 5px;
            font-weight: 500;
        }

        .info-value {
            font-size: 1.1rem;
            color: var(--gris-oscuro);
            font-weight: 600;
        }

        /* Botón de historial */
        .button-container {
            margin-bottom: 30px;
        }

        .history-button {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 15px 25px;
            background: var(--verde-sena);
            color: white;
            text-decoration: none;
            border-radius: var(--radius);
            transition: var(--transicion);
            font-weight: 600;
            box-shadow: var(--sombra);
        }

        .history-button:hover {
            background: var(--verde-oscuro);
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(57, 169, 0, 0.3);
        }

        /* Sección de historial */
        .section-title {
            font-size: 1.6rem;
            color: var(--gris-oscuro);
            margin-bottom: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title i {
            color: var(--verde-sena);
        }

        /* Tabla de asistencias */
        .table-container {
            background: var(--blanco);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--sombra);
            margin-bottom: 30px;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table thead {
            background: linear-gradient(135deg, var(--verde-sena) 0%, var(--verde-oscuro) 100%);
            color: white;
        }

        .data-table th {
            padding: 18px 15px;
            text-align: left;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .data-table td {
            padding: 16px 15px;
            border-bottom: 1px solid var(--gris-medio);
            color: var(--gris-oscuro);
        }

        .data-table tbody tr {
            transition: var(--transicion);
        }

        .data-table tbody tr:hover {
            background: var(--gris-claro);
        }

        .data-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges de estado */
        .badge {
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: rgba(46, 204, 113, 0.15);
            color: #27ae60;
            border: 1px solid rgba(46, 204, 113, 0.3);
        }

        .badge-danger {
            background: rgba(231, 76, 60, 0.15);
            color: #c0392b;
            border: 1px solid rgba(231, 76, 60, 0.3);
        }

        /* Mensaje de estado vacío */
        .empty-state {
            text-align: center;
            padding: 60px 30px;
            color: var(--gris-oscuro);
        }

        .empty-state i {
            font-size: 4rem;
            color: var(--gris-medio);
            margin-bottom: 20px;
        }

        .empty-state h3 {
            font-size: 1.4rem;
            margin-bottom: 10px;
            color: var(--gris-oscuro);
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 0;
        }

        /* Estadísticas rápidas */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--blanco);
            padding: 20px;
            border-radius: var(--radius);
            box-shadow: var(--sombra);
            text-align: center;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            background: var(--verde-claro);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            color: var(--verde-sena);
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--verde-sena);
            margin-bottom: 5px;
        }

        .stat-label {
            color: var(--gris-oscuro);
            font-weight: 500;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container-custom {
                padding: 0 15px;
            }

            .page-title {
                font-size: 1.8rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .data-table {
                display: block;
                overflow-x: auto;
            }

            .stats-container {
                grid-template-columns: 1fr;
            }

            .history-button {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .page-header {
                padding: 20px;
            }

            .page-title {
                font-size: 1.5rem;
            }

            .section-title {
                font-size: 1.3rem;
            }

            .user-info-card,
            .table-container {
                padding: 15px;
            }

            .data-table th,
            .data-table td {
                padding: 12px 8px;
                font-size: 0.9rem;
            }
        }

        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }
    </style>

    <div class="container-custom fade-in">
        <!-- Header con gradiente -->
        <div class="page-header">
            <h1 class="page-title">
                <i class="fas fa-calendar-check"></i>
                Detalle de Asistencia
            </h1>
            <p class="page-subtitle">Registro completo de entradas y salidas de {{ $person->name }}</p>
        </div>

        <!-- Tarjeta de información del usuario -->
        <div class="user-info-card">
            <h3 class="card-title">
                <i class="fas fa-user-circle"></i>
                Información del Usuario
            </h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nombre completo</span>
                    <span class="info-value">{{ $person->name }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Número de documento</span>
                    <span class="info-value">{{ $person->document_number }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Cargo/Posición</span>
                    <span class="info-value">{{ $person->position->name ?? 'Sin puesto asignado' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Total de registros hoy</span>
                    <span class="info-value">{{ $formattedEntrancesExits->count() }}</span>
                </div>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        <div class="stats-container">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <div class="stat-number">{{ $formattedEntrancesExits->where('action', 'entrada')->count() }}</div>
                <div class="stat-label">Entradas</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-sign-out-alt"></i>
                </div>
                <div class="stat-number">{{ $formattedEntrancesExits->where('action', 'salida')->count() }}</div>
                <div class="stat-label">Salidas</div>
            </div>
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number">{{ now()->format('d/m/Y') }}</div>
                <div class="stat-label">Fecha actual</div>
            </div>
        </div>

        <!-- Botón de historial completo -->
        <div class="button-container">
            <a href="{{ route('assistance_show_history', $person->id) }}" class="history-button">
                <i class="fas fa-history"></i>
                Ver historial completo de {{ $person->name }}
            </a>
        </div>

        <!-- Sección de historial del día -->
        <h2 class="section-title">
            <i class="fas fa-calendar-day"></i>
            Historial de Asistencias - Hoy
        </h2>

        @if ($formattedEntrancesExits->count() > 0)
            <!-- Tabla de asistencias -->
            <div class="table-container">
                <table class="data-table">
                    <thead>
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
                                <td>
                                    @if ($entry['action'] === 'entrada')
                                        <span class="badge badge-success">
                                            <i class="fas fa-sign-in-alt"></i> Entrada
                                        </span>
                                    @elseif ($entry['action'] === 'salida')
                                        <span class="badge badge-danger">
                                            <i class="fas fa-sign-out-alt"></i> Salida
                                        </span>
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
            <!-- Estado vacío -->
            <div class="empty-state">
                <i class="fas fa-clipboard-list"></i>
                <h3>No hay registros de asistencia</h3>
                <p>No se encontraron registros de asistencia para {{ $person->name }} en la fecha de hoy.</p>
            </div>
        @endif
    </div>

    <script>
        // Efectos de hover mejorados
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('.data-table tbody tr');

            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });

                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</x-layout>
