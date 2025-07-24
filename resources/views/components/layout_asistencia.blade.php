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
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--gris-fondo);
        }

        /* Header */
        .header {
            background-color: var(--blanco);
            color: var(--verde-header);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .logo-header {
            height: 70px; /* Logo más grande */
            margin-right: 15px;
            object-fit: contain;
        }

        .header-container {
            display: flex;
            align-items: center;
        }

        .texto-header {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        /* Layout */
        .main-layout {
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background-color: var(--verde-sidebar-bg);
            border-right: 2px solid var(--gris-borde);
            min-height: calc(100vh - 120px); /* Ajustado por header + footer */
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
            position: relative;
            user-select: none;
        }

        .sidebar-menu > li > a.menu-toggle:hover,
        .sidebar-menu > li > a.menu-toggle.active {
            background-color: #c5f3de;
            color: var(--verde-header-hover);
        }

        /* Flecha animada */
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
            box-shadow: 0 2px 10px rgba(57, 169, 0, 0.1);
            margin-bottom: 8px;
            background: #fafdff;
            border-radius: 4px;
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

        /* Main Content */
        .content {
            flex-grow: 1;
            padding: 25px;
            background-color: var(--blanco);
            min-height: calc(100vh - 120px);
        }

        /* Footer */
        .footer {
            background-color: var(--blanco);
            color: var(--verde-header);
            text-align: center;
            padding: 25px 20px;
            box-shadow: 0 -2px 8px rgba(0, 0, 0, 0.05);
            border-top: 1px solid #e0e0e0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .logo-footer {
            height: 60px; /* Logo más grande */
            margin-bottom: 10px;
            object-fit: contain;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* Botón cerrar sesión */
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

        /* Cursor pointer para todos los enlaces del menú */
        .sidebar-menu a,
        .sidebar-menu .menu-toggle {
            cursor: pointer;
        }

        /* Responsividad */
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
            .header, .footer {
                padding: 10px;
            }
            .content {
                padding: 10px;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header class="header">
        <div class="header-container">
            <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-header" />
            <h1 class="texto-header">Centro Agroempresarial y Acuícola</h1>
        </div>
        <div class="usuario-info" title="{{ Auth::user()->user_name ?? 'Invitado' }}">
                <i class="fa-solid fa-user-circle"></i>
                <span>{{ Auth::user()->user_name ?? 'Invitado' }}</span>
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

    </header>

    <!-- Layout -->
    <div class="main-layout">

        <!-- Sidebar -->
        <nav class="sidebar" aria-label="Menú lateral">
            <ul class="sidebar-menu">
                <li>
                    <a class="menu-toggle">
                        <i class="fas fa-users" style="margin-right: 10px;"></i>
                        <span>Gestión de Personas</span>
                    </a>
                    <ul>
                        <li><a href="{{route('entrance.people.index')}}"><i class="fas fa-id-card"></i> Personas</a></li>
                        <li><a href="{{ route('entrance.people.create') }}"><i class="fas fa-user-plus"></i> Gestión de Registros</a></li>
                    </ul>
                </li>
                <li>
                    <a class="menu-toggle">
                        <i class="fas fa-calendar-check" style="margin-right: 10px;"></i>
                        <span>Gestión de Asistencia</span>
                    </a>
                    <ul>
                        <li><a href="{{route('entrance.assistance.index')}}"><i class="fas fa-check-circle"></i> Asistencias</a></li>
                    </ul>
                </li>
                <li>
                    <a class="menu-toggle">
                        <i class="fas fa-user-times" style="margin-right: 10px;"></i>
                        <span>Gestión de Inasistencia</span>
                    </a>
                    <ul>
                        <li><a href="{{route('entrance.absence.index')}}"><i class="fas fa-user-slash"></i> Inasistencias</a></li>

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
