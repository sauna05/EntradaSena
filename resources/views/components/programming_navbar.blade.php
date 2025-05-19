<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú con Submenús</title>
    <style>
        .sidebar {
            width: 250px;
            padding: 15px;
            font-family: Arial, sans-serif;
        }

        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-menu > li {
            margin-bottom: 10px;
        }

        .sidebar-menu > li > a {
            text-decoration: none;
            color: #222;
            font-weight: bold;
            display: block;
            cursor: pointer;
            font-size: 16px;
        }

        .sidebar-menu > li > a:hover {
            color: #0077cc; /* azul al pasar el mouse */
        }

        .sidebar-menu li ul {
            list-style: none;
            padding-left: 20px;
            margin: 5px 0;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.5s ease;
        }

        .sidebar-menu li ul.show {
            max-height: 500px;
        }

        .sidebar-menu li ul li a {
            text-decoration: none;
            color: #555;
            font-weight: normal;
            display: block;
            padding: 4px 0;
            font-size: 14px;
        }

        .sidebar-menu li ul li a:hover {
            color: #e60039; /* rojo al pasar el mouse */
        }
    </style>
</head>
<body>

<div class="sidebar">
    <ul class="sidebar-menu">
        <li>
            <a class="menu-toggle">Programas</a>
            <ul>
                <li><a href="{{ route('programming.admin') }}">Gestion Programas</a></li>

                <li><a href="#">Agregar competencias al programa</a></li>
            </ul>
        </li>
        <li>
            <a class="menu-toggle">Programación</a>
            <ul>
                <li><a href="#">Gestion de Programacion</a></li>
                <li><a href="#">Agregar Programación</a></li>

                <li><a href="#">Ver Calendario</a></li>
            </ul>
        </li>
        <li>
            <a class="menu-toggle">Competencias</a>
            <ul>
                <li><a href="{{ route('programing.competencies_index') }}">Gestion de Competencias</a></li>

            </ul>
        </li>
        <li>
            <a class="menu-toggle">Aprendiz</a>
            <ul>
                <li><a href="{{ route('programing.list_apprentices') }}">Gestion de Aprendiz</a></li>

                <li><a href="#">Asignar Ficha</a></li>
            </ul>
        </li>
        <li>
            <a class="menu-toggle">Fichas</a>
            <ul>
                <li><a href="{{ route('programing.cohort_index') }}">Gestion de fichas </a></li>

                <li><a href="{{ route('programing.add_apprentices_cohorts') }}">Agregar Aprendices a la ficha</a></li>
            </ul>
        </li>
    </ul>
</div>

<script>
    document.querySelectorAll('.menu-toggle').forEach(menu => {
        menu.addEventListener('click', function () {
            const submenu = this.nextElementSibling;

            // Cierra otros submenús abiertos
            document.querySelectorAll('.sidebar-menu ul').forEach(ul => {
                if (ul !== submenu) {
                    ul.classList.remove('show');
                }
            });

            // Alterna este submenú
            submenu.classList.toggle('show');
        });
    });
</script>

</body>
</html>
