<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA - Aprendiz' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
        /* Estilos del layout base para aprendiz */
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
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* HEADER */
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

        /* LAYOUT PRINCIPAL */
        .main-layout {
            display: flex;
            flex-grow: 1;
        }

        /* SIDEBAR */
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

        .sidebar-menu li ul li a:hover {
            background-color: rgba(57, 169, 0, 0.1);
            color: var(--verde-header-hover);
            padding-left: 20px;
        }

        /* CONTENIDO PRINCIPAL */
        .content {
            flex-grow: 1;
            padding: 30px;
            background-color: var(--blanco);
            transition: var(--transicion);
            min-height: calc(100vh - 120px);
        }

        /* FOOTER */
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

        /* BOTÓN CERRAR SESIÓN */
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
            background: var(--verde-boton-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(57, 169, 0, 0.3);
        }

        /* RESPONSIVE */
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

            .content {
                padding: 20px;
            }
        }
    </style>
    @if(isset($page_style))
        <link rel="stylesheet" href="{{ asset($page_style) }}" />
    @endif
</head>
<body>
    @php
        // Obtener el ID del usuario autenticado
        $userId = Auth::id();
    @endphp

    <header class="header">
        <div class="header-container">
            <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-header" />
            <h1 class="texto-header">Centro Agroempresarial y Acuícola</h1>
        </div>

        <div class="header-actions">
            <div class="usuario-info">
                <i class="fas fa-user-graduate"></i>
                <span>Aprendiz</span>
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

    <!-- Layout Principal -->
    <div class="main-layout">
        <!-- Sidebar para Aprendiz -->
        <aside class="sidebar">
            <div class="sidebar-toggle"></div>
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('apprentice.show', $userId) }}" class="menu-toggle {{ request()->routeIs('apprentice.show') ? 'active' : '' }}">
                        <i class="menu-icon fas fa-home"></i>
                        <span class="menu-text">Inicio</span>
                    </a>
                </li>

                <li>
                    <a class="menu-toggle">
                        <i class="menu-icon fas fa-cog"></i>
                        <span class="menu-text">Configuración</span>
                    </a>
                    <ul>
                        <li><a href="#"><span class="submenu-text">Perfil</span></a></li>
                        <li><a href="{{ route('password.change') }}" class="{{ request()->routeIs('password.change') ? 'active-link' : '' }}">
                            <span class="submenu-text">Cambiar Contraseña</span>
                        </a></li>
                    </ul>
                </li>
            </ul>
        </aside>

        <!-- Contenido Principal -->
        <main class="content">
            {{ $slot }}
        </main>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-footer" />
        <p>&copy; {{ date('Y') }} Centro Agroempresarial y Acuícola. Todos los derechos reservados.</p>
    </footer>

    <script>
        // Script para el funcionamiento del sidebar
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.querySelector('.sidebar-toggle');
            const sidebar = document.querySelector('.sidebar');
            const menuToggles = document.querySelectorAll('.menu-toggle');

            // Toggle sidebar collapse
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                });
            }

            // Toggle submenus
            menuToggles.forEach(toggle => {
                // Solo aplicar toggle a elementos que no tienen href o tienen href="#"
                if (!toggle.getAttribute('href') || toggle.getAttribute('href') === '#') {
                    toggle.addEventListener('click', function(e) {
                        if (window.innerWidth > 768 || !sidebar.classList.contains('collapsed')) {
                            e.preventDefault();
                            const parent = this.parentElement;
                            const submenu = parent.querySelector('ul');

                            if (submenu) {
                                // Cerrar otros submenús
                                document.querySelectorAll('.sidebar-menu ul.show').forEach(menu => {
                                    if (menu !== submenu) {
                                        menu.classList.remove('show');
                                        menu.previousElementSibling.classList.remove('active');
                                    }
                                });

                                // Toggle submenu actual
                                submenu.classList.toggle('show');
                                this.classList.toggle('active');
                            }
                        }
                    });
                }
            });

            // Responsive sidebar para móviles
            function handleMobileSidebar() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.remove('collapsed');
                    if (!sidebar.classList.contains('active')) {
                        sidebar.classList.add('active');
                    }
                } else {
                    sidebar.classList.remove('active');
                }
            }

            // Inicializar y escuchar cambios de tamaño
            handleMobileSidebar();
            window.addEventListener('resize', handleMobileSidebar);

            // Marcar elemento activo basado en la URL actual
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar-menu a').forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active-link');
                    // Abrir el menú padre si está en un submenú
                    const parentMenu = link.closest('ul');
                    if (parentMenu && parentMenu.classList.contains('show')) {
                        const parentToggle = parentMenu.previousElementSibling;
                        if (parentToggle) {
                            parentToggle.classList.add('active');
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
