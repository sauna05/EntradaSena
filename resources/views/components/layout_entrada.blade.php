<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}" />
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
        @auth
        <form action="{{ route('logout') }}" method="POST" class="logout-form">
            @csrf
            <button type="submit" class="logout-button">Cerrar sesión</button>
        </form>
        @endauth
    </header>



     <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



    <h1>SISTEMA DE ASISTENCIAS AL CENTRO DE FORMACIÓN</h1>
    <h2>Acción: <span class="action" id="action"></span></h2>
    <h1><span id="full_hour"></span></h1>

    <div>
        <label for="document_number">Número de Documento</label>
        <input type="text" id="document_number" autofocus>
        <button id="send">Ingresar</button>
    </div>

    <h2>Nombre: <span id="name"></span></h2>
    <h2>Cargo: <span id="position"></span></h2>
    <div id="error_message" style="color: red; display: none;"></div>

    <script>
        // Actualiza la hora en tiempo real
        function updateHour() {
            let now = new Date();
            let hour = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('full_hour').textContent = `${hour}:${minutes}:${seconds}`;
        }

        setInterval(updateHour, 1000);
        updateHour();

        $(document).ready(function() {
            // Función para enviar los datos
            function sendDocumentNumber(documentNumber) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('entrance.store') }}",
                    type: 'POST',
                    data: {
                        document_number: documentNumber,
                        _token: csrfToken
                    },
                    success: function(response) {
                        if (response.error) {
                            // Mostrar mensaje de error si no está registrado
                            $('#error_message').text(response.error).show();
                            $('#document_number').val(''); // Limpiar el campo después de enviar
                        } else {
                            // Mostrar información cuando los datos son correctos
                            $('#action').text(`${response.action}`);
                            $('#position').text(`${response.position}`);
                            $('#name').text(`${response.name}`);
                            $('#error_message').hide(); // Ocultar cualquier mensaje de error previo
                            $('#document_number').val(''); // Limpiar el campo
                        }
                    },
                    // error: function(xhr) {
                    //     console.log(xhr.responseText);
                    //     $('#action').text('Error al enviar los datos');
                    // }
                });
            }

            // Evento al hacer clic en el botón de ingresar
            $('#send').click(function() {
                let documentNumber = $('#document_number').val();
                if (documentNumber) {
                    sendDocumentNumber(documentNumber);
                }
            });

            // // Detectar el escaneo del código de barras en el campo de documento
            // $('#document_number').on('input', function() {
            //     let documentNumber = $('#document_number').val();
            //     if (documentNumber.length > 0) {
            //         // Si el campo tiene algún valor (como el escaneo de código de barras), enviar los datos
            //         sendDocumentNumber(documentNumber);
            //     }
            // });
        });
    </script>





    <!-- Footer -->
    <footer class="footer">
        <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-footer" />
        <p>&copy; {{ date('Y') }} Centro Agroempresarial y Acuícola. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
