<x-layout>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - Sistema SENA</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        /*===============================
  VARIABLES ROOT - MEJORADAS
===============================*/
:root {
    --verde-sena: #39A900;
    --verde-header: #39A900;
    --verde-header-hover: #2f7a00;
    --verde-sidebar-bg: #e6f4ef;
    --verde-boton: #39A900;
    --verde-boton-hover: #2f7a00;
    --gris-borde: #d1d1d1;
    --gris-fondo: #f4f4f4;
    --gris-texto: #333333;
    --blanco: #ffffff;
    --sombra: 0 2px 16px rgba(57, 169, 0, 0.15);
    --transicion: all 0.3s ease;
    --radius: 8px;
    --sidebar-width: 280px;
    --sidebar-collapsed: 70px;
}

/*===============================
  RESETEO GENERAL
===============================*/
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Segoe UI', sans-serif;
    background-color: var(--gris-fondo);
    color: var(--gris-texto);
    line-height: 1.6;
}

/*===============================
  HEADER MEJORADO
===============================*/
.header {
    background-color: var(--blanco);
    color: var(--verde-header);
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    position: sticky;
    top: 0;
    z-index: 1000;
}

.header-container {
    display: flex;
    align-items: center;
    flex-grow: 1;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.logo-header {
    height: 60px;
    margin-right: 15px;
    object-fit: contain;
}

.texto-header {
    font-size: 22px;
    font-weight: bold;
    letter-spacing: 0.5px;
}

/*===============================
  LAYOUT MEJORADO
===============================*/
.main-layout {
    display: flex;
    min-height: calc(100vh - 120px);
}

/*===============================
  SIDEBAR MEJORADO
===============================*/
.sidebar {
    width: var(--sidebar-width);
    background-color: var(--verde-sidebar-bg);
    border-right: 1px solid var(--gris-borde);
    padding: 20px 0;
    box-shadow: var(--sombra);
    transition: var(--transicion);
    overflow-y: auto;
    overflow-x: hidden;
    position: relative;
    z-index: 900;
}

.sidebar-toggle {
    position: absolute;
    top: 15px;
    right: -15px;
    background: var(--verde-sena);
    color: white;
    width: 30px;
    height: 30px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    z-index: 950;
    transition: var(--transicion);
}

.sidebar-toggle:hover {
    background: var(--verde-header-hover);
    transform: scale(1.05);
}

.sidebar.collapsed {
    width: var(--sidebar-collapsed);
}

.sidebar.collapsed .menu-text,
.sidebar.collapsed .submenu-text {
    display: none;
}

.sidebar.collapsed .sidebar-menu > li > a.menu-toggle::after {
    display: none;
}

.sidebar.collapsed .sidebar-menu ul {
    position: absolute;
    left: var(--sidebar-collapsed);
    top: 0;
    background: var(--verde-sidebar-bg);
    width: 200px;
    border-radius: 0 var(--radius) var(--radius) 0;
    box-shadow: 3px 3px 10px rgba(0,0,0,0.1);
    padding: 10px;
    display: none !important;
}

.sidebar.collapsed .sidebar-menu li:hover > ul {
    display: block !important;
}

.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu > li {
    margin-bottom: 5px;
    position: relative;
}

.sidebar-menu > li > a.menu-toggle {
    text-decoration: none;
    color: var(--gris-texto);
    font-weight: 600;
    display: flex;
    align-items: center;
    padding: 12px 20px;
    border-radius: 0 var(--radius) var(--radius) 0;
    cursor: pointer;
    transition: var(--transicion);
    user-select: none;
    position: relative;
    border-left: 4px solid transparent;
}

.sidebar-menu > li > a.menu-toggle:hover,
.sidebar-menu > li > a.menu-toggle.active {
    background-color: rgba(57, 169, 0, 0.1);
    color: var(--verde-header-hover);
    border-left-color: var(--verde-sena);
}

.sidebar-menu > li > a.menu-toggle::after {
    content: '▼';
    font-size: 0.7em;
    margin-left: auto;
    transition: var(--transicion);
}

.sidebar-menu > li > a.menu-toggle.active::after {
    transform: rotate(-180deg);
}

.menu-icon {
    margin-right: 12px;
    font-size: 18px;
    width: 24px;
    text-align: center;
    color: var(--verde-sena);
}

.sidebar-menu li ul {
    list-style: none;
    padding-left: 20px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s ease, padding 0.3s ease;
}

.sidebar-menu li ul.show {
    max-height: 500px;
    margin-bottom: 8px;
}

.sidebar-menu li ul li a {
    display: flex;
    align-items: center;
    text-decoration: none;
    color: var(--gris-texto);
    padding: 10px 15px;
    font-size: 14px;
    border-radius: var(--radius);
    margin: 4px 0;
    cursor: pointer;
    transition: var(--transicion);
    position: relative;
}

.sidebar-menu li ul li a::before {
    content: '';
    width: 6px;
    height: 6px;
    background: var(--verde-sena);
    border-radius: 50%;
    margin-right: 10px;
    opacity: 0.6;
    transition: var(--transicion);
}

.sidebar-menu li ul li a:hover {
    background-color: rgba(57, 169, 0, 0.1);
    color: var(--verde-header-hover);
    padding-left: 20px;
}

.sidebar-menu li ul li a:hover::before {
    opacity: 1;
    transform: scale(1.2);
}

.sidebar-menu li ul li a.active-link {
    background-color: rgba(57, 169, 0, 0.15);
    color: var(--verde-header-hover);
    font-weight: 600;
}

/*===============================
  CONTENT - DASHBOARD
===============================*/
.content {
    flex-grow: 1;
    padding: 25px;
    background-color: var(--blanco);
    transition: var(--transicion);
}

.content.expanded {
    margin-left: calc(var(--sidebar-collapsed) - var(--sidebar-width));
}

.dashboard {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.dashboard-header {
    margin-bottom: 20px;
}

.dashboard-header h1 {
    color: var(--verde-sena);
    font-size: 28px;
    margin-bottom: 10px;
}

.dashboard-header p {
    color: var(--gris-texto);
    font-size: 16px;
    opacity: 0.8;
}

/* Tarjetas de estadísticas */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stat-card {
    background: var(--blanco);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--sombra);
    display: flex;
    align-items: center;
    transition: var(--transicion);
    border-left: 4px solid var(--verde-sena);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(57, 169, 0, 0.2);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(57, 169, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 24px;
    color: var(--verde-sena);
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-size: 28px;
    font-weight: bold;
    color: var(--verde-sena);
    margin-bottom: 5px;
}

.stat-label {
    font-size: 14px;
    color: var(--gris-texto);
    opacity: 0.8;
}

.stat-trend {
    font-size: 12px;
    padding: 3px 8px;
    border-radius: 12px;
    background: rgba(57, 169, 0, 0.1);
    color: var(--verde-sena);
    margin-top: 5px;
    display: inline-block;
}

/* Gráficos y tablas */
.dashboard-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 25px;
}

.chart-container, .recent-container {
    background: var(--blanco);
    border-radius: var(--radius);
    padding: 20px;
    box-shadow: var(--sombra);
}

.chart-header, .recent-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--gris-borde);
}

.chart-header h2, .recent-header h2 {
    font-size: 18px;
    color: var(--verde-sena);
}

.view-all {
    color: var(--verde-sena);
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    transition: var(--transicion);
}

.view-all:hover {
    text-decoration: underline;
}

.chart-placeholder {
    height: 300px;
    background: rgba(57, 169, 0, 0.05);
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--verde-sena);
    font-weight: 600;
}

/* Tabla de programaciones recientes */
.recent-table {
    width: 100%;
    border-collapse: collapse;
}

.recent-table th, .recent-table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid var(--gris-borde);
}

.recent-table th {
    font-weight: 600;
    color: var(--verde-sena);
}

.recent-table tr:hover {
    background: rgba(57, 169, 0, 0.05);
}

.status-badge {
    padding: 5px 10px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
}

.status-completed {
    background: rgba(57, 169, 0, 0.15);
    color: var(--verde-sena);
}

.status-pending {
    background: rgba(255, 193, 7, 0.15);
    color: #ffc107;
}

.status-delayed {
    background: rgba(220, 53, 69, 0.15);
    color: #dc3545;
}

/* Acciones rápidas */
.quick-actions {
    margin-top: 30px;
}

.quick-actions h2 {
    font-size: 20px;
    color: var(--verde-sena);
    margin-bottom: 20px;
}

.action-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 15px;
}

.action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: var(--blanco);
    border-radius: var(--radius);
    padding: 20px 15px;
    text-decoration: none;
    color: var(--gris-texto);
    box-shadow: var(--sombra);
    transition: var(--transicion);
    text-align: center;
}

.action-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(57, 169, 0, 0.2);
    color: var(--verde-sena);
}

.action-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(57, 169, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    font-size: 20px;
    color: var(--verde-sena);
}

.action-label {
    font-weight: 600;
    font-size: 14px;
}

/*===============================
  FOOTER MEJORADO
===============================*/
.footer {
    background-color: var(--blanco);
    color: var(--verde-header);
    text-align: center;
    padding: 20px;
    border-top: 1px solid #e0e0e0;
    box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.footer p {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
    letter-spacing: 0.3px;
}

.logo-footer {
    height: 50px;
    margin-bottom: 10px;
    object-fit: contain;
}

/*===============================
  ICONOS / NOTIFICACIONES MEJORADOS
===============================*/
.usuario-info,
.notificaciones,
.programaciones-info {
    display: inline-flex;
    align-items: center;
    font-size: 16px;
    color: var(--verde-header-hover);
    padding: 8px 12px;
    border-radius: var(--radius);
    transition: var(--transicion);
    position: relative;
    cursor: pointer;
}

.usuario-info:hover,
.notificaciones:hover,
.programaciones-info:hover {
    background-color: rgba(57, 169, 0, 0.1);
}

.usuario-info i,
.notificaciones i,
.programaciones-info i {
    font-size: 20px;
    margin-right: 8px;
    color: var(--verde-header);
}

.notificaciones .contador,
.programaciones-info .contador {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #e74c3c;
    color: white;
    font-size: 11px;
    border-radius: 50%;
    width: 18px;
    height: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

/*===============================
  BOTÓN CERRAR SESIÓN MEJORADO
===============================*/
form.logout-form {
    margin: 0;
}

.logout-button {
    background-color: var(--verde-boton);
    color: var(--blanco);
    padding: 10px 16px;
    border: none;
    border-radius: var(--radius);
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: var(--transicion);
    display: flex;
    align-items: center;
    gap: 8px;
}

.logout-button:hover {
    background-color: var(--verde-boton-hover);
    transform: translateY(-2px);
}

/*===============================
  BADGE PARA ELEMENTOS NUEVOS
===============================*/
.menu-badge {
    background: var(--verde-sena);
    color: white;
    font-size: 10px;
    padding: 2px 6px;
    border-radius: 10px;
    margin-left: 8px;
    font-weight: bold;
}

/*===============================
  RESPONSIVE MEJORADO
===============================*/
@media (max-width: 1200px) {
    .dashboard-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 992px) {
    .header {
        padding: 12px 20px;
    }

    .texto-header {
        font-size: 18px;
    }

    .logo-header {
        height: 50px;
    }

    .header-actions {
        gap: 12px;
    }

    .usuario-info span,
    .logout-button span {
        display: none;
    }

    .usuario-info,
    .notificaciones,
    .programaciones-info {
        padding: 8px;
    }

    .usuario-info i,
    .notificaciones i,
    .programaciones-info i {
        margin-right: 0;
    }

    .stats-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
    }
}

@media (max-width: 768px) {
    .main-layout {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        padding: 10px 0;
        border-right: none;
        border-bottom: 1px solid var(--gris-borde);
        max-height: 60px;
        overflow: hidden;
        transition: max-height 0.4s ease;
    }

    .sidebar.active {
        max-height: 1000px;
    }

    .sidebar-toggle {
        top: 10px;
        right: 10px;
        background: var(--verde-sena);
    }

    .sidebar-toggle::before {
        content: '☰';
    }

    .sidebar.active .sidebar-toggle::before {
        content: '✕';
    }

    .content {
        padding: 15px;
    }

    .sidebar.collapsed {
        width: 100%;
    }

    .sidebar.collapsed .menu-text,
    .sidebar.collapsed .submenu-text {
        display: inline;
    }

    .sidebar.collapsed .sidebar-menu ul {
        position: static;
        width: auto;
        box-shadow: none;
        background: transparent;
    }

    .action-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .header {
        flex-direction: column;
        text-align: center;
        gap: 10px;
    }

    .header-container {
        justify-content: center;
    }

    .header-actions {
        justify-content: center;
        flex-wrap: wrap;
    }

    .footer {
        padding: 15px;
    }

    .footer p {
        font-size: 12px;
    }

    .logo-footer {
        height: 40px;
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .action-grid {
        grid-template-columns: 1fr;
    }
}

/*===============================
  ANIMACIONES
===============================*/
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.sidebar-menu li {
    animation: fadeIn 0.3s ease forwards;
    opacity: 0;
}

.sidebar-menu li:nth-child(1) { animation-delay: 0.05s; }
.sidebar-menu li:nth-child(2) { animation-delay: 0.1s; }
.sidebar-menu li:nth-child(3) { animation-delay: 0.15s; }
.sidebar-menu li:nth-child(4) { animation-delay: 0.2s; }
.sidebar-menu li:nth-child(5) { animation-delay: 0.25s; }
.sidebar-menu li:nth-child(6) { animation-delay: 0.3s; }
.sidebar-menu li:nth-child(7) { animation-delay: 0.35s; }
.sidebar-menu li:nth-child(8) { animation-delay: 0.4s; }

.stat-card {
    animation: fadeIn 0.5s ease forwards;
}

.stat-card:nth-child(1) { animation-delay: 0.1s; }
.stat-card:nth-child(2) { animation-delay: 0.2s; }
.stat-card:nth-child(3) { animation-delay: 0.3s; }
.stat-card:nth-child(4) { animation-delay: 0.4s; }

    </style>
</head>
<body>





    <!-- Contenido principal - DASHBOARD -->
    <main class="content" id="main-content">
        <div class="dashboard">
            <div class="dashboard-header">
                <h1>Panel de Control</h1>
                <p>Bienvenido al sistema de gestión del Centro Agroempresarial y Acuícola</p>
            </div>

            <!-- Estadísticas -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{$personas->count()}}</div>
                        <div class="stat-label">Total de Personas</div>
                        <span class="stat-trend">+12 este mes</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{$programaciones->count()}}</div>
                        <div class="stat-label">Programaciones Activas</div>
                        <span class="stat-trend">+3 esta semana</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{$instructores->count()}}</div>
                        <div class="stat-label">Instructores Activos</div>
                        <span class="stat-trend">+2 este mes</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-tasks"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $programacionesSinRegistrar ?? 0 }}</div>
                        <div class="stat-label">Pendientes por Registrar</div>
                        <span class="stat-trend" style="background: rgba(220, 53, 69, 0.15); color: #dc3545;">Urgente</span>
                    </div>
                </div>
            </div>

            <!-- Gráficos y programaciones recientes -->
            {{-- <div class="dashboard-grid">
                <div class="chart-container">
                    <div class="chart-header">
                        <h2>Programaciones por Estado</h2>
                        <a href="#" class="view-all">Ver reporte completo</a>
                    </div>
                    <div class="chart-placeholder">
                        <i class="fas fa-chart-pie" style="font-size: 24px; margin-right: 10px;"></i>
                        Gráfico de programaciones por estado
                    </div>
                </div>

                <div class="recent-container">
                    <div class="recent-header">
                        <h2>Programaciones Recientes</h2>
                        <a href="#" class="view-all">Ver todas</a>
                    </div>
                    <table class="recent-table">
                        <thead>
                            <tr>
                                <th>Programación</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>ADSO-2023-01</td>
                                <td>15/08/2023</td>
                                <td><span class="status-badge status-completed">Completada</span></td>
                            </tr>
                            <tr>
                                <td>ADSI-2023-02</td>
                                <td>18/08/2023</td>
                                <td><span class="status-badge status-pending">Pendiente</span></td>
                            </tr>
                            <tr>
                                <td>ADSO-2023-03</td>
                                <td>20/08/2023</td>
                                <td><span class="status-badge status-completed">Completada</span></td>
                            </tr>
                            <tr>
                                <td>ADSI-2023-04</td>
                                <td>22/08/2023</td>
                                <td><span class="status-badge status-delayed">Atrasada</span></td>
                            </tr>
                            <tr>
                                <td>ADSO-2023-05</td>
                                <td>25/08/2023</td>
                                <td><span class="status-badge status-pending">Pendiente</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> --}}

            <!-- Acciones rápidas -->
            <div class="quick-actions">
                <h2>Acciones Rápidas</h2>
                <div class="action-grid">
                    <a href="{{ route('programming.register_programming_instructor_index') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="fas fa-calendar-plus"></i>
                        </div>
                        <div class="action-label">Nueva Programación</div>
                    </a>

                    <a href="{{ route('entrance.people.create') }}" class="action-btn">
                        <div class="action-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <div class="action-label">Registrar Aprendiz</div>
                    </a>

                    <a href="{{ route('programing.instructor_programan_index') }}        " class="action-btn">
                        <div class="action-icon">
                            <i class="fas fa-chalkboard-teacher"></i>
                        </div>
                        <div class="action-label">Gestionar Instructor</div>
                    </a>

                    <a href="#" class="action-btn">
                        <div class="action-icon">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <div class="action-label">Reportes</div>
                    </a>
                </div>
            </div>
        </div>
    </main>
</div>


</body>
</html>
</x-layout>
