<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        /*===============================
  VARIABLES ROOT
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
}

/*===============================
  RESETEO GENERAL
===============================*/
* {
    box-sizing: border-box;
}

body {
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background-color: var(--gris-fondo);
}

/*===============================
  HEADER
===============================*/
.header {
    background-color: var(--blanco);
    color: var(--verde-header);
    padding: 15px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.header-container {
    display: flex;
    align-items: center;
    flex-grow: 1;
}

.header-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.logo-header {
    height: 70px;
    margin-right: 15px;
    object-fit: contain;
}

.texto-header {
    font-size: 24px;
    font-weight: bold;
    letter-spacing: 0.5px;
}

/*===============================
  LAYOUT
===============================*/
.main-layout {
    display: flex;
}

/*===============================
  SIDEBAR
===============================*/
.sidebar {
    width: 250px;
    background-color: var(--verde-sidebar-bg);
    border-right: 2px solid var(--gris-borde);
    min-height: calc(100vh - 120px);
    padding: 15px;
    box-shadow: var(--sombra);
}

.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu > li {
    margin-bottom: 8px;
}

.sidebar-menu > li > a.menu-toggle {
    text-decoration: none;
    color: var(--verde-header);
    font-weight: bold;
    display: flex;
    align-items: center;
    padding: 10px 12px;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.2s, color 0.2s;
    user-select: none;
    position: relative;
}

.sidebar-menu > li > a.menu-toggle:hover,
.sidebar-menu > li > a.menu-toggle.active {
    background-color: #c5f3de;
    color: var(--verde-header-hover);
}

.sidebar-menu > li > a.menu-toggle::after {
    content: '▼';
    font-size: 0.8em;
    margin-left: auto;
    transition: transform 0.3s;
}

.sidebar-menu > li > a.menu-toggle.active::after {
    transform: rotate(-180deg);
}

.sidebar-menu li ul {
    list-style: none;
    padding-left: 18px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.4s cubic-bezier(.4,2,.6,1), box-shadow 0.3s;
    box-shadow: none;
}

.sidebar-menu li ul.show {
    max-height: 500px;
    margin-bottom: 8px;
    background: #fafdff;
    border-radius: 4px;
    box-shadow: 0 2px 10px rgba(57, 169, 0, 0.1);
}

.sidebar-menu li ul li a {
    display: block;
    text-decoration: none;
    color: var(--gris-texto);
    padding: 7px 10px;
    font-size: 15px;
    border-radius: 4px;
    margin: 2px 0;
    cursor: pointer;
    transition: background 0.2s, color 0.2s, padding-left 0.2s;
}

.sidebar-menu li ul li a:hover {
    background-color: #e0f8ee;
    color: var(--verde-header-hover);
    padding-left: 20px;
}

.menu-toggle.active,
.active-link {
    font-weight: bold;
    color: #007bff;
}

.sidebar-menu li.open > ul {
    display: block;
}

.sidebar-menu .show {
    display: block !important;
}

.sidebar-menu a,
.sidebar-menu .menu-toggle {
    cursor: pointer;
}

/*===============================
  CONTENT
===============================*/
.content {
    flex-grow: 1;
    padding: 25px;
    background-color: var(--blanco);
    min-height: calc(100vh - 120px);
}

/*===============================
  FOOTER
===============================*/
.footer {
    background-color: var(--blanco);
    color: var(--verde-header);
    text-align: center;
    padding: 25px 20px;
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
    height: 60px;
    margin-bottom: 10px;
    object-fit: contain;
}

/*===============================
  ICONOS / NOTIFICACIONES
===============================*/
.usuario-info,
.notificaciones,
.programaciones-info {
    display: inline-flex;
    align-items: center;
    font-size: 18px;
    color: var(--verde-header-hover);
    margin-right: 20px;
    position: relative;
}

.usuario-info i,
.notificaciones i,
.programaciones-info i {
    font-size: 24px;
    margin-right: 6px;
    color: var(--verde-header);
}

.notificaciones .contador,
.programaciones-info .contador {
    position: absolute;
    top: -6px;
    right: -10px;
    background: red;
    color: white;
    font-size: 11px;
    border-radius: 50%;
    padding: 2px 5px;
    font-weight: bold;
}

/*===============================
  BOTÓN CERRAR SESIÓN
===============================*/
form.logout-form {
    margin: 0;
}

.logout-button {
    background-color: var(--verde-boton);
    color: var(--blanco);
    padding: 10px 18px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 700;
    font-size: 16px;
    transition: background-color 0.3s ease;
    box-shadow: 0 3px 8px rgba(57, 169, 0, 0.4);
}

.logout-button:hover {
    background-color: var(--verde-boton-hover);
}

/*===============================
  RESPONSIVE
===============================*/
@media (max-width: 800px) {
    .main-layout {
        flex-direction: column;
    }

    .sidebar {
        width: 100%;
        min-height: auto;
        border-right: none;
        border-bottom: 2px solid var(--gris-borde);
    }
}

@media (max-width: 600px) {
    .header,
    .footer {
        padding: 10px;
    }

    .content {
        padding: 10px;
    }
}

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
            <div class="notificaciones" title="Notificaciones">
                <i class="fa-solid fa-bell"></i>
                <span class="contador">3</span>
            </div>

            <!-- Programaciones sin registrar -->
            <div class="programaciones-info" style="cursor: pointer" title="Programaciones pendientes por registrar">
            <a href="{{ route('programming.programming_update_index') }}" class="programaciones-info" title="Programaciones pendientes por registrar" style="cursor: pointer; text-decoration: none; color: inherit;">
                <i class="fa-solid fa-calendar-xmark"></i>
                <span class="contador">{{ $programacionesSinRegistrar ?? 0 }}</span>
            </a>

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
    <nav class="sidebar" aria-label="Menú lateral">
        <ul class="sidebar-menu">

            <!-- INICIO -->
           <li class="{{ Route::is('programing.admin_inicio', 'programing.competencies_program_index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programming.admin', 'programing.competencies_program_index') ? 'active' : '' }}">

                    <i class="fas fa-home"></i> Inicio
                </a>
                <ul class="{{ Route::is('programing.admin_inicio', 'programing.competencies_program_index') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.admin_inicio') }}" class="{{ Route::is('programing.admin_inicio') ? 'active-link' : '' }}"><i class="fas fa-clipboard-list"></i> Gestión de Programas</a></li>
                    <li><a href="{{ route('programing.competencies_program_index') }}" class="{{ Route::is('programing.competencies_program_index') ? 'active-link' : '' }}"><i class="fas fa-link"></i> Competencias Vinculadas</a></li>
                </ul>
            </li>

            <!-- PROGRAMACIÓN ACADÉMICA -->
          <li class="{{ Route::is('programming.programming_index_states', 'programmig.*', 'programming.register_programming_instructor_index', 'programming.programming_update_index', 'programing.unrecorded_days_index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programming.programming_index_states', 'programmig.*', 'programming.register_programming_instructor_index', 'programming.programming_update_index', 'programing.unrecorded_days_index') ? 'active' : '' }}">

                                <i class="fas fa-calendar-alt"></i> Programación Academica
                </a>
                <ul class="{{ Route::is('programming.*', 'programmig.*', 'programing.unrecorded_days_index') ? 'show' : '' }}">
                    <li><a href="{{ route('programming.programming_index_states') }}" class="{{ Route::is('programming.programming_index_states') ? 'active-link' : '' }}"><i class="fas fa-tasks"></i> Estado de Competencias</a></li>
                    <li><a href="{{ route('programmig.programaciones_index') }}" class="{{ Route::is('programmig.programaciones_index') ? 'active-link' : '' }}"><i class="fas fa-list-ul"></i> Ver Programaciones</a></li>
                    <li><a href="{{ route('programming.register_programming_instructor_index') }}" class="{{ Route::is('programming.register_programming_instructor_index') ? 'active-link' : '' }}"><i class="fas fa-calendar-plus"></i> Programar Curso</a></li>
                    <li><a href="{{ route('programming.programming_update_index') }}" class="{{ Route::is('programming.programming_update_index') ? 'active-link' : '' }}"><i class="fas fa-edit"></i> Registrar Programación</a></li>
                    <li><a href="{{ route('programing.unrecorded_days_index') }}" class="{{ Route::is('programing.unrecorded_days_index') ? 'active-link' : '' }}"><i class="fas fa-calendar-times"></i> Días No Programados</a></li>
                </ul>
            </li>

            <!-- COMPETENCIAS -->
            <li class="{{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'active' : '' }}">
                    <i class="fas fa-cubes"></i> Competencias
                </a>
                <ul class="{{ Route::is('programing.competencies_index', 'programing.competencies_index_program') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.competencies_index') }}" class="{{ Route::is('programing.competencies_index') ? 'active-link' : '' }}"><i class="fas fa-check-square"></i> Gestión de Competencias</a></li>
                    <li><a href="{{ route('programing.competencies_index_program') }}" class="{{ Route::is('programing.competencies_index_program') ? 'active-link' : '' }}"><i class="fas fa-random"></i> Vincular a Programas y Fichas</a></li>
                </ul>
            </li>

            <!-- INSTRUCTORES -->
            <li class="{{ Route::is('programing.instructor_programan_index', 'programming.programming_instructors_profiles') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programing.instructor_programan_index', 'programming.programming_instructors_profiles') ? 'active' : '' }}">
                    <i class="fas fa-chalkboard-teacher"></i> Instructores
                </a>
                <ul class="{{ Route::is('programing.instructor_programan_index', 'programming.programming_instructors_profiles') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.instructor_programan_index') }}" class="{{ Route::is('programing.instructor_programan_index') ? 'active-link' : '' }}"><i class="fas fa-user-cog"></i> Gestión de Instructores</a></li>
                    <li><a href="{{ route('programing.programming_instructors_profiles') }}" class="{{ Route::is('programming.programing_instructors_profiles') ? 'active-link' : '' }}"><i class="fas fa-user-tag"></i> Vincular al Perfil</a></li>
                </ul>
            </li>

            <!-- APRENDICES -->
            <li class="{{ Route::is('programing.list_apprentices', 'programing.add_apprentices_cohorts') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programing.list_apprentices', 'programing.add_apprentices_cohorts') ? 'active' : '' }}">
                    <i class="fas fa-user-graduate"></i> Aprendices
                </a>
                <ul class="{{ Route::is('programing.list_apprentices', 'programing.add_apprentices_cohorts') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.list_apprentices') }}" class="{{ Route::is('programing.list_apprentices') ? 'active-link' : '' }}"><i class="fas fa-address-card"></i> Gestión de Aprendices</a></li>
                    <li><a href="{{ route('programing.add_apprentices_cohorts') }}" class="{{ Route::is('programing.add_apprentices_cohorts') ? 'active-link' : '' }}"><i class="fas fa-user-plus"></i> Asignar a Fichas</a></li>
                </ul>
            </li>

            <!-- FICHAS -->
            <li class="{{ Route::is('programing.cohort_index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('programing.cohort_index') ? 'active' : '' }}">
                    <i class="fas fa-folder-open"></i> Fichas
                </a>
                <ul class="{{ Route::is('programing.cohort_index') ? 'show' : '' }}">
                    <li><a href="{{ route('programing.cohort_index') }}" class="{{ Route::is('programing.cohort_index') ? 'active-link' : '' }}"><i class="fas fa-file-alt"></i> Gestión de Fichas</a></li>
                    <li><a href="{{ route('programing.add_apprentices_cohorts') }}" class="{{ Route::is('programing.add_apprentices_cohorts') ? 'active-link' : '' }}"><i class="fas fa-user-check"></i> Agregar Aprendiz</a></li>
                </ul>
            </li>

            <!-- AMBIENTES -->
            <li class="{{ Route::is('ambientes_index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('ambientes_index') ? 'active' : '' }}">
                    <i class="fas fa-door-open"></i> Ambientes
                </a>
                <ul class="{{ Route::is('ambientes_index') ? 'show' : '' }}">
                    <li><a href="{{ route('ambientes_index') }}" class="{{ Route::is('ambientes_index') ? 'active-link' : '' }}"><i class="fas fa-warehouse"></i> Gestión de Ambientes</a></li>
                </ul>
            </li>

            <!-- GESTIÓN DE PERSONAS -->
            <li class="{{ Route::is('entrance.people.index', 'entrance.people.create') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('entrance.people.index', 'entrance.people.create') ? 'active' : '' }}">
                    <i class="fas fa-users"></i> Gestión de Personas
                </a>
                <ul class="{{ Route::is('entrance.people.index', 'entrance.people.create') ? 'show' : '' }}">
                    <li><a href="{{ route('entrance.people.index') }}" class="{{ Route::is('entrance.people.index') ? 'active-link' : '' }}"><i class="fas fa-id-card"></i> Personas</a></li>
                    <li><a href="{{ route('entrance.people.create') }}" class="{{ Route::is('entrance.people.create') ? 'active-link' : '' }}"><i class="fas fa-user-plus"></i> Registro de Personas</a></li>
                </ul>
            </li>

            <!-- ASISTENCIA -->
            <li class="{{ Route::is('entrance.assistance.index') ? 'open' : '' }}">
                <a class="menu-toggle {{ Route::is('entrance.assistance.index') ? 'active' : '' }}">
                    <i class="fas fa-calendar-check"></i> Asistencia
                </a>
                <ul class="{{ Route::is('entrance.assistance.index') ? 'show' : '' }}">
                    <li><a href="{{ route('entrance.assistance.index') }}" class="{{ Route::is('entrance.assistance.index') ? 'active-link' : '' }}"><i class="fas fa-check-circle"></i> Control de Asistencia</a></li>
                </ul>
            </li>

        </ul>
    </nav>

    <!-- Contenido principal -->
    <main class="content">
        {{ $slot }}
    </main>
</div>


    <!-- Footer -->
    <footer class="footer">
        <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-footer" />
        <p>&copy; {{ date('Y') }} Centro Agroempresarial y Acuícola. Todos los derechos reservados.</p>
    </footer>

    <!-- JS: Menú toggle -->
    <script>
        document.querySelectorAll('.menu-toggle').forEach(menu => {
            menu.addEventListener('click', function () {
                const submenu = this.nextElementSibling;

                // Cierra otros submenús y desactiva otras flechas
                document.querySelectorAll('.sidebar-menu ul').forEach(ul => {
                    if (ul !== submenu) {
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


    </script>

</body>
</html>

