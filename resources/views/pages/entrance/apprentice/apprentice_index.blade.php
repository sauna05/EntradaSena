<x-layout_aprendiz>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>CAA - Aprendiz</x-slot:title>

    <style>
        /* Estilos específicos para la vista del aprendiz */
        .welcome-card {
            background: linear-gradient(135deg, #e6f4ef 0%, #d4eed0 100%);
            border-radius: 16px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: var(--sombra);
            border-left: 5px solid var(--verde-sena);
        }

        .welcome-title {
            color: var(--verde-header-hover);
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .welcome-subtitle {
            color: #555;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .user-info-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid var(--gris-borde);
        }

        .user-info-title {
            color: var(--verde-sena);
            font-size: 18px;
            margin-bottom: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info-title i {
            font-size: 20px;
        }

        .user-details {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
        }

        .user-detail-item {
            display: flex;
            flex-direction: column;
            padding: 12px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .user-detail-label {
            font-size: 12px;
            color: #777;
            margin-bottom: 5px;
            font-weight: 500;
        }

        .user-detail-value {
            font-size: 16px;
            color: var(--gris-texto);
            font-weight: 600;
        }

        .action-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid var(--gris-borde);
            transition: var(--transicion);
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .action-icon {
            font-size: 40px;
            color: var(--verde-sena);
            margin-bottom: 15px;
        }

        .action-title {
            color: var(--verde-header-hover);
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .action-description {
            color: #666;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .btn-primary {
            background: var(--verde-boton);
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: var(--radius);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transicion);
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary:hover {
            background: var(--verde-boton-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(57, 169, 0, 0.3);
        }

        .grid-layout {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        /* Estilos para las secciones de asistencias */
        .attendance-section {
            background: white;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 30px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border: 1px solid var(--gris-borde);
        }

        .section-title {
            color: var(--verde-header-hover);
            font-size: 22px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--verde-sena);
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
        }
        .cohort-details {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 15px;
}

.cohort-separator {
    border: none;
    border-top: 1px dashed #ccc;
    margin: 15px 0;
}

.info-badge i {
    margin-right: 5px;
}

/* Para responsive */
@media (max-width: 768px) {
    .cohort-details {
        flex-direction: column;
    }
}

        .attendance-table th {
            background-color: #f5f5f5;
            padding: 12px;
            text-align: left;
            font-weight: 600;
            color: var(--gris-texto);
        }

        .attendance-table td {
            padding: 12px;
            border-bottom: 1px solid var(--gris-borde);
        }

        .attendance-table tr:last-child td {
            border-bottom: none;
        }

        .attendance-table .entrada {
            color: var(--verde-sena);
            font-weight: 600;
        }

        .attendance-table .salida {
            color: #e74c3c;
            font-weight: 600;
        }

        .no-records {
            text-align: center;
            padding: 20px;
            color: #777;
            font-style: italic;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .grid-layout {
                grid-template-columns: 1fr;
            }

            .welcome-card {
                padding: 20px;
            }

            .welcome-title {
                font-size: 24px;
            }

            .attendance-table {
                display: block;
                overflow-x: auto;
            }
        }

        @media (max-width: 576px) {
            .user-details {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <!-- Tarjeta de Bienvenida -->
    <div class="welcome-card">
        <h2 class="welcome-title">¡Bienvenido, {{ optional($person)->name ?? 'Aprendiz' }}!</h2>
        <p class="welcome-subtitle">Sistema de Gestión de Aprendices - Centro Agroempresarial y Acuícola</p>
    </div>

    <!-- Información del Usuario -->
    <div class="user-info-card">
        <h3 class="user-info-title"><i class="fas fa-user-circle"></i> Información Personal</h3>
        <div class="user-details">

            <div class="user-detail-item">
                <span class="user-detail-label">Usuario</span>
                <span class="user-detail-value">{{ $user->user_name }}</span>
            </div>
            <div class="user-detail-item">
                <span class="user-detail-label">Nombre Completo</span>
                <span class="user-detail-value">{{ optional($person)->name ?? 'No disponible' }}</span>
            </div>
            <div class="user-detail-item">
                <span class="user-detail-label">Documento</span>
                <span class="user-detail-value">{{ optional($person)->document_number ?? 'No disponible' }}</span>
            </div>
            <div class="user-detail-item">
                <span class="user-detail-label">Correo</span>
                <span class="user-detail-value">{{ optional($person)->email ?? 'No disponible' }}</span>
            </div>
        </div>
    </div>
    <!-- Información de Programa y Ficha -->
<div class="user-info-card">
    <h3 class="user-info-title"><i class="fas fa-graduation-cap"></i> Información Académica</h3>
    <div class="program-info">
        @if(!empty($programs))
            <div class="info-badge">
                <i class="fas fa-book"></i> Programa: {{ implode(', ', $programs) }}
            </div>
        @else
            <div class="info-badge">
                <i class="fas fa-book"></i> Programa: No asignado
            </div>
        @endif

        @if(!empty($cohortsData))
            @foreach($cohortsData as $cohort)
                <div class="cohort-details">
                    <div class="info-badge">
                        <i class="fas fa-hashtag"></i> Ficha: {{ $cohort['number'] }}
                    </div>
                    <div class="info-badge">
                        <i class="fas fa-calendar-start"></i> Inicio: {{ \Carbon\Carbon::parse($cohort['start_date'])->format('d/m/Y') }}
                    </div>
                    <div class="info-badge">
                        <i class="fas fa-calendar-check"></i> Fin: {{ \Carbon\Carbon::parse($cohort['end_date'])->format('d/m/Y') }}
                    </div>
                </div>
                @if(!$loop->last)
                    <hr class="cohort-separator">
                @endif
            @endforeach
        @else
            <div class="info-badge">
                <i class="fas fa-hashtag"></i> Ficha: No asignada
            </div>
        @endif
    </div>
</div>

    <!-- Asistencias de Hoy -->
    <div class="attendance-section">
        <h3 class="section-title"><i class="fas fa-calendar-day"></i> Asistencias de Hoy</h3>
        @if($formattedTodayEntrances->count() > 0)
            <table class="attendance-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formattedTodayEntrances as $entry)
                    <tr>
                        <td>{{ $entry['date'] }}</td>
                        <td>{{ $entry['time'] }}</td>
                        <td>
                            <span class="{{ $entry['action'] === 'entrada' ? 'entrada' : 'salida' }}">
                                {{ ucfirst($entry['action']) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-records">
                <p>No hay registros de asistencia para hoy.</p>
            </div>
        @endif
    </div>

    <!-- Historial Completo -->
    <div class="attendance-section">
        <h3 class="section-title"><i class="fas fa-history"></i> Historial Completo</h3>
        @if($formattedHistoryEntrances->count() > 0)
            <table class="attendance-table">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($formattedHistoryEntrances as $entry)
                    <tr>
                        <td>{{ $entry['date'] }}</td>
                        <td>{{ $entry['time'] }}</td>
                        <td>
                            <span class="{{ $entry['action'] === 'entrada' ? 'entrada' : 'salida' }}">
                                {{ ucfirst($entry['action']) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-records">
                <p>No hay registros de asistencia en el historial.</p>
            </div>
        @endif
    </div>

    <!-- Acciones Rápidas -->
    <h3 style="margin-bottom: 20px; color: var(--verde-header-hover);">Acciones Rápidas</h3>
    <div class="grid-layout">
        <div class="action-card">
            <div class="action-icon">
                <i class="fas fa-key"></i>
            </div>
            <h4 class="action-title">Cambiar Contraseña</h4>
            <p class="action-description">Actualiza tu contraseña para mantener tu cuenta segura</p>
            <form action="{{ route('password.change') }}" method="GET">
                @csrf
                <button type="submit" class="btn-primary">Cambiar Contraseña</button>
            </form>
        </div>
    </div>
</x-layout_aprendiz>
