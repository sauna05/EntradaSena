<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
      <style>
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
  CONTENT
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
  NOTIFICACIONES MEJORADAS
===============================*/
.notifications-container {
    position: relative;
    display: inline-block;
}

.notification-bell {
    position: relative;
    background: #f8f9fa;
    border: 2px solid #e9ecef;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s ease;
    color: #6c757d;
    font-size: 1.2rem;
}

.notification-bell:hover {
    background: #007bff;
    color: white;
    border-color: #007bff;
    transform: scale(1.1);
}

.notification-bell.alert {
    animation: pulse 2s infinite;
    border-color: #dc3545;
    color: #dc3545;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.notification-counter {
    position: absolute;
    top: -5px;
    right: -5px;
    background: #dc3545;
    color: white;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    font-size: 0.8rem;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: bounce 2s infinite;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-5px); }
    60% { transform: translateY(-3px); }
}

.notifications-panel {
    position: absolute;
    top: 100%;
    right: 0;
    width: 380px;
    background: white;
    border: 1px solid #e9ecef;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    z-index: 1000;
    display: none;
    margin-top: 10px;
}

.notifications-panel.show {
    display: block;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.notifications-header {
    padding: 20px;
    border-bottom: 1px solid #e9ecef;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #f8f9fa;
    border-radius: 12px 12px 0 0;
}

.notifications-header h3 {
    margin: 0;
    color: #2c3e50;
    font-size: 1.2rem;
}

.mark-all-read {
    background: none;
    border: none;
    color: #007bff;
    cursor: pointer;
    font-size: 0.9rem;
    text-decoration: underline;
}

.mark-all-read:hover {
    color: #0056b3;
}

.notifications-list {
    max-height: 400px;
    overflow-y: auto;
}

.notification-item {
    display: flex;
    align-items: center;
    padding: 15px 20px;
    border-bottom: 1px solid #f8f9fa;
    transition: background 0.2s ease;
    position: relative;
}

.notification-item:hover {
    background: #f8f9fa;
}

.notification-item::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
}

.notification-item.urgent::before { background: #dc3545; }
.notification-item.warning::before { background: #ffc107; }
.notification-item.success::before { background: #28a745; }
.notification-item.info::before { background: #17a2b8; }

.notification-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 1.1rem;
}

.notification-item.urgent .notification-icon { background: #fee; color: #dc3545; }
.notification-item.warning .notification-icon { background: #fff3cd; color: #856404; }
.notification-item.success .notification-icon { background: #d4edda; color: #155724; }
.notification-item.info .notification-icon { background: #d1ecf1; color: #0c5460; }

.notification-content {
    flex: 1;
}

.notification-title {
    font-weight: 600;
    margin: 0 0 5px 0;
    color: #2c3e50;
    font-size: 0.95rem;
}

.notification-message {
    margin: 0 0 5px 0;
    color: #6c757d;
    font-size: 0.9rem;
    line-height: 1.4;
}

.notification-time {
    font-size: 0.8rem;
    color: #adb5bd;
}

.notification-empty {
    padding: 40px 20px;
    text-align: center;
    color: #6c757d;
}

.notification-empty i {
    font-size: 2rem;
    margin-bottom: 10px;
    opacity: 0.5;
}

/*===============================
  USUARIO Y BOTONES
===============================*/
.usuario-info {
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

.usuario-info:hover {
    background-color: rgba(57, 169, 0, 0.1);
}

.usuario-info i {
    font-size: 20px;
    margin-right: 8px;
    color: var(--verde-header);
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
  RESPONSIVE MEJORADO
===============================*/
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

    .usuario-info {
        padding: 8px;
    }

    .usuario-info i {
        margin-right: 0;
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

    .notifications-panel {
        position: fixed;
        top: 60px;
        right: 10px;
        left: 10px;
        width: auto;
        max-width: 400px;
        margin: 0 auto;
    }

    .notification-bell {
        width: 45px;
        height: 45px;
        font-size: 1.1rem;
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
    </style>
    {{-- llamada de icoconos para el menu --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
 <header class="header">
        <div class="header-container">
            <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-header" />
            <h1 class="texto-header">Centro Agroempresarial y Acuícola</h1>
        </div>

        <div class="header-actions">
            <!-- Apartado de usuario -->
            <div class="usuario-info" title="{{ Auth::user()->user_name ?? 'Invitado' }}">
                <i class="fa-solid fa-user-circle"></i>
                <span>{{ Auth::user()->user_name ?? 'Invitado' }}</span>
            </div>

        <!-- Notificaciones -->
<div class="notifications-container">
    <div class="notifications-dropdown">
        <button class="notification-bell" id="notificationBell">
            <i class="fa-solid fa-bell"></i>
            @if($totalNotificaciones > 0)
                <span class="notification-counter">{{ $totalNotificaciones }}</span>
            @endif
        </button>

        <div class="notifications-panel" id="notificationsPanel">
            <div class="notifications-header">
                <h3>Notificaciones</h3>
                <button class="mark-all-read" id="markAllRead">Marcar todo como leído</button>
            </div>

            <div class="notifications-list">
                @if($programacionesSinRegistrar > 0)
                <div class="notification-item urgent">
                    <div class="notification-icon">
                       <a href="{{route('programming.programming_update_index')}}"><i class="fa-solid fa-calendar-xmark"></i></a>
                    </div>
                    <div class="notification-content">
                        <p class="notification-title">Pendientes sin Registrar</p>
                        <p class="notification-message">
                            Tienes <strong>{{ $programacionesSinRegistrar }}</strong> programación(es) sin registrar
                        </p>
                        <span class="notification-time">Acción requerida</span>
                    </div>
                </div>
                @endif

                <!-- NUEVA CATEGORÍA: Programaciones que YA deberían haber finalizado hoy -->
                @if($programacionesPendientesHoy > 0)
                <div class="notification-item urgent">
                    <div class="notification-icon">
                        <a href="#"><i class="fa-solid fa-exclamation-triangle"></i></a>
                    </div>
                    <div class="notification-content">
                        <p class="notification-title">Finalizaciones pendientes</p>
                        <p class="notification-message">
                            <strong>{{ $programacionesPendientesHoy }}</strong> programación(es) deberían haber finalizado hoy
                        </p>
                        <span class="notification-time">Revisión urgente</span>
                    </div>
                </div>
                @endif

                @if($programacionesFinalizanHoy > 0)
                <div class="notification-item warning">
                    <div class="notification-icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="notification-content">
                        <p class="notification-title">Finalizan hoy</p>
                        <p class="notification-message">
                            <strong>{{ $programacionesFinalizanHoy }}</strong> programación(es) finalizan hoy
                        </p>
                        <span class="notification-time">Por finalizar</span>
                    </div>
                </div>
                @endif

                <!-- NUEVA CATEGORÍA: Programaciones en curso -->
                @if($programacionesEnCurso > 0)
                <div class="notification-item info">
                    <div class="notification-icon">
                        <i class="fa-solid fa-play-circle"></i>
                    </div>
                    <div class="notification-content">
                        <p class="notification-title">En curso</p>
                        <p class="notification-message">
                            <strong>{{ $programacionesEnCurso }}</strong> programación(es) activas actualmente
                        </p>
                        <span class="notification-time">En progreso</span>
                    </div>
                </div>
                @endif

                @if($programacionesProximas > 0)
                <div class="notification-item info">
                    <div class="notification-icon">
                        <i class="fa-solid fa-hourglass-half"></i>
                    </div>
                    <div class="notification-content">
                        <p class="notification-title">Próximas a finalizar</p>
                        <p class="notification-message">
                            <strong>{{ $programacionesProximas }}</strong> programación(es) finalizan en los próximos 3 días
                        </p>
                        <span class="notification-time">Próximamente</span>
                    </div>
                </div>
                @endif

                @if($programacionesFinalizadas > 0)
                <div class="notification-item success">
                    <div class="notification-icon">
                        <i class="fa-solid fa-calendar-check"></i>
                    </div>
                    <div class="notification-content">
                        <p class="notification-title">Programaciones finalizadas</p>
                        <p class="notification-message">
                            <strong>{{ $programacionesFinalizadas }}</strong> programación(es) finalizada(s) recientemente
                        </p>
                        <span class="notification-time">Últimos 7 días</span>
                    </div>
                </div>
                @endif

                @if($totalNotificaciones === 0)
                <div class="notification-empty">
                    <i class="fa-solid fa-bell-slash"></i>
                    <p>No hay notificaciones nuevas</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

            @auth
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="logout-button" title="Cerrar sesión"
                        onclick="return confirm('¿Está seguro que quiere cerrar Sesión?')">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Cerrar sesión</span>
                </button>
            </form>
            @endauth
        </div>
    </header>

    <!-- Layout -->
<div class="main-layout">
    <!-- Sidebar -->
    <nav class="sidebar" aria-label="Menú lateral" id="sidebar">
        <div class="sidebar-toggle" id="sidebar-toggle"></div>
        <ul class="sidebar-menu">

           <!-- INICIO -->
            <li class="{{ Route::is('programing.admin_inicio', 'programing.competencies_program_index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programing.admin_inicio', 'programing.competencies_program_index') ? 'active' : '' }}">
                    <i class="fas fa-home menu-icon"></i>
                    <span class="menu-text">Inicio</span>
                </a>
                <ul class="{{ Route::is('programing.admin_inicio', 'programing.competencies_program_index') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.admin_inicio') }}" class="{{ Route::is('programing.admin_inicio') ? 'active-link' : '' }}"><i class="fas fa-chart-line menu-icon"></i> <span class="submenu-text">Dashboard - Sistema SENA</span></a></li>
                    <li><a href="{{ route('programing.competencies_program_index') }}" class="{{ Route::is('programing.competencies_program_index') ? 'active-link' : '' }}"><i class="fas fa-clipboard-list menu-icon"></i> <span class="submenu-text">Gestión de Programas</span></a></li>
                </ul>
            </li>
             <!-- FICHAS -->
          <li class="{{ Route::is('programing.cohort_index','programing.list_apprentices', 'programing.add_apprentices_cohorts') ? 'open' : '' }}">
            <a class="menu-toggle {{ Route::is('programing.cohort_index','programing.list_apprentices', 'programing.add_apprentices_cohorts') ? 'active' : '' }}">
                <i class="fas fa-folder-open menu-icon"></i>
                <span class="menu-text">Fichas</span>

            </a>
            <ul class="{{ Route::is('programing.cohort_index','programing.list_apprentices', 'programing.add_apprentices_cohorts') ? 'show' : '' }}">
                <li>
                    <a href="{{ route('programing.cohort_index') }}" class="{{ Route::is('programing.cohort_index') ? 'active-link' : '' }}">
                        <i class="fas fa-file-alt menu-icon"></i>
                        <span class="submenu-text">Gestión de Fichas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('programing.list_apprentices') }}" class="{{ Route::is('programing.list_apprentices') ? 'active-link' : '' }}">
                        <i class="fas fa-address-card menu-icon"></i>
                        <span class="submenu-text">Gestión de Aprendices</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('programing.add_apprentices_cohorts') }}" class="{{ Route::is('programing.add_apprentices_cohorts') ? 'active-link' : '' }}">
                        <i class="fas fa-user-check menu-icon"></i>
                        <span class="submenu-text">Agregar Aprendiz</span>
                    </a>
                </li>
            </ul>
        </li>


            <!-- PROGRAMACIÓN ACADÉMICA -->
          <li class="{{ Route::is('programming.programming_index_states', 'programmig.*', 'programming.register_programming_instructor_index', 'programming.programming_update_index', 'programing.unrecorded_days_index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programming.programming_index_states', 'programmig.*', 'programming.register_programming_instructor_index', 'programming.programming_update_index', 'programing.unrecorded_days_index') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt menu-icon"></i>
                    <span class="menu-text">Programación</span>
                </a>
                <ul class="{{ Route::is('programming.*', 'programmig.*', 'programing.unrecorded_days_index') ? 'show' : '' }}">
                    <li><a href="{{ route('programming.register_programming_instructor_index') }}" class="{{ Route::is('programming.register_programming_instructor_index') ? 'active-link' : '' }}"><i class="fas fa-calendar-plus menu-icon"></i> <span class="submenu-text">Programar Curso</span></a></li>
                    <li><a href="{{ route('programmig.programaciones_index') }}" class="{{ Route::is('programmig.programaciones_index') ? 'active-link' : '' }}"><i class="fas fa-list-ul menu-icon"></i> <span class="submenu-text">Ver Programaciones</span></a></li>
                    <li><a href="{{ route('programming.programming_index_states') }}" class="{{ Route::is('programming.programming_index_states') ? 'active-link' : '' }}"><i class="fas fa-tasks menu-icon"></i> <span class="submenu-text">Estado de Competencias</span></a></li>
                 <li>
                 <a href="{{ route('programming.programming_update_index') }}"
                  class="{{ Route::is('programming.programming_update_index') ? 'active-link' : '' }}">
                   <i class="fas fa-check-circle menu-icon"></i>
                   <span class="submenu-text">Marcar como registrada</span>
                 </a>
</li>

                    <li><a href="{{ route('programing.unrecorded_days_index') }}" class="{{ Route::is('programing.unrecorded_days_index') ? 'active-link' : '' }}"><i class="fas fa-calendar-times menu-icon"></i> <span class="submenu-text">Días No Programados</span></a></li>
                </ul>
            </li>

            {{-- <!-- COMPETENCIAS -->
            <li class="{{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'active' : '' }}">
                    <i class="fas fa-cubes menu-icon"></i>
                    <span class="menu-text">Competencias</span>
                </a>
                <ul class="{{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.competencies_index') }}" class="{{ Route::is('programing.competencies_index') ? 'active-link' : '' }}"><i class="fas fa-check-square menu-icon"></i> <span class="submenu-text">Gestión de Competencias</span></a></li>
                                   </ul>
            </li> --}}

            <!-- INSTRUCTORES -->
            <li class="{{ Route::is('programing.instructor_programan_index', 'programming.programming_instructors_profiles') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programing.instructor_programan_index', 'programming.programming_instructors_profiles') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher menu-icon"></i>
                    <span class="menu-text">Instructores</span>
                </a>
                <ul class="{{ Route::is('programing.instructor_programan_index', 'programming.programming_instructors_profiles') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.instructor_programan_index') }}" class="{{ Route::is('programing.instructor_programan_index') ? 'active-link' : '' }}"><i class="fas fa-user-cog menu-icon"></i> <span class="submenu-text">Gestión de Instructores</span></a></li>
                    <li><a href="{{ route('programing.programming_instructors_profiles') }}" class="{{ Route::is('programming.programing_instructors_profiles') ? 'active-link' : '' }}"><i class="fas fa-user-tag menu-icon"></i> <span class="submenu-text">Vincular Competencias</span></a></li>
                </ul>
            </li>

            <!-- AMBIENTES -->
            <li class="{{ Route::is('ambientes_index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('ambientes_index') ? 'active' : '' }}">
                    <i class="fas fa-door-open menu-icon"></i>
                    <span class="menu-text">Ambientes</span>
                </a>
                <ul class="{{ Route::is('ambientes_index') ? 'show' : '' }}">
                    <li><a href="{{ route('ambientes_index') }}" class="{{ Route::is('ambientes_index') ? 'active-link' : '' }}"><i class="fas fa-warehouse menu-icon"></i> <span class="submenu-text">Gestión de Ambientes</span></a></li>
                </ul>
            </li>

            <!-- GESTIÓN DE PERSONAS -->
            <li class="{{ Route::is('entrance.people.index', 'entrance.people.create') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('entrance.people.index', 'entrance.people.create') ? 'active' : '' }}">
                    <i class="fas fa-users menu-icon"></i>
                    <span class="menu-text">Gestión de Personas</span>
                </a>
                <ul class="{{ Route::is('entrance.people.index', 'entrance.people.create') ? 'show' : '' }}">
                    <li><a href="{{ route('entrance.people.index') }}" class="{{ Route::is('entrance.people.index') ? 'active-link' : '' }}"><i class="fas fa-id-card menu-icon"></i> <span class="submenu-text">Personas</span></a></li>
                    <li><a href="{{ route('entrance.people.create') }}" class="{{ Route::is('entrance.people.create') ? 'active-link' : '' }}"><i class="fas fa-user-plus menu-icon"></i> <span class="submenu-text">Registro de Personas</span></a></li>
                </ul>
            </li>

            <!-- ASISTENCIA -->
            <li class="{{ Route::is('entrance.assistance.index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('entrance.assistance.index') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check menu-icon"></i>
                    <span class="menu-text">Asistencia</span>
                </a>
                <ul class="{{ Route::is('entrance.assistance.index') ? 'show' : '' }}">
                    <li><a href="{{ route('entrance.assistance.index') }}" class="{{ Route::is('entrance.assistance.index') ? 'active-link' : '' }}"><i class="fas fa-check-circle menu-icon"></i> <span class="submenu-text">Control de Asistencia</span></a></li>
                </ul>
            </li>

        </ul>
    </nav>

    <!-- Contenido principal -->
    <main class="content" id="main-content">
        {{ $slot }}
    </main>
</div>


    <!-- Footer -->
    <footer class="footer">
        <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-footer" />
        <p>&copy; {{ date('Y') }} Centro Agroempresarial y Acuícola. Todos los derechos reservados.</p>
    </footer>

    <!-- JS: Menú toggle mejorado -->
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = document.getElementById('sidebar-toggle');
            const mainContent = document.getElementById('main-content');
            const notificationBell = document.getElementById('notificationBell');
            const notificationsPanel = document.getElementById('notificationsPanel');
            const markAllRead = document.getElementById('markAllRead');

            // Función para alternar el menú lateral
            sidebarToggle.addEventListener('click', function() {
                if (window.innerWidth > 768) {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                } else {
                    sidebar.classList.toggle('active');
                }
            });

            // Cerrar submenús al hacer clic fuera en móviles
            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768 &&
                    sidebar.classList.contains('active') &&
                    !sidebar.contains(event.target) &&
                    !sidebarToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            });

            // Manejo de submenús
            document.querySelectorAll('.menu-toggle').forEach(menu => {
                menu.addEventListener('click', function(e) {
                    if (window.innerWidth <= 768) {
                        e.stopPropagation();
                    }

                    const submenu = this.nextElementSibling;

                    if (window.innerWidth > 768 && sidebar.classList.contains('collapsed')) {
                        submenu.classList.toggle('show');
                        this.classList.toggle('active');
                        return;
                    }

                    document.querySelectorAll('.sidebar-menu ul').forEach(ul => {
                        if (ul !== submenu && !sidebar.classList.contains('collapsed')) {
                            ul.classList.remove('show');
                            if (ul.previousElementSibling) {
                                ul.previousElementSibling.classList.remove('active');
                            }
                        }
                    });

                    submenu.classList.toggle('show');
                    this.classList.toggle('active');
                });
            });

            // Notificaciones
            notificationBell.addEventListener('click', function(e) {
                e.stopPropagation();
                notificationsPanel.classList.toggle('show');
                notificationBell.classList.remove('alert');
            });

            document.addEventListener('click', function() {
                notificationsPanel.classList.remove('show');
            });

            notificationsPanel.addEventListener('click', function(e) {
                e.stopPropagation();
            });

            markAllRead.addEventListener('click', function() {
                notificationBell.querySelector('.notification-counter')?.remove();
                notificationsPanel.classList.remove('show');
                alert('Todas las notificaciones han sido marcadas como leídas');
            });

            // Animación de alerta si hay notificaciones urgentes
            const urgentNotifications = document.querySelectorAll('.notification-item.urgent');
            if (urgentNotifications.length > 0) {
                notificationBell.classList.add('alert');
            }

            // Ajustar layout inicial
            function adjustLayout() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
            }

            window.addEventListener('resize', adjustLayout);
            adjustLayout();
        });
    </script>


</body>
</html>
