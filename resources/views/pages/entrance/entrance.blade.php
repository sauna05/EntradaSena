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

        .content-wrapper {
        padding-top: 120px;  /* Espacio para el header */
        padding-bottom: 100px; /* Espacio para el footer */
    }

    /* Campo de documento grande y destacado */
    #document_number {
        font-size: 2rem;
        padding: 20px;
        width: 60%;
        max-width: 600px;
        border: 2px solid var(--verde-sena);
        border-radius: 10px;
        display: block;
        margin: 30px auto;
        box-shadow: 0 4px 12px rgba(57,169,0,0.2);
        text-align: center;
    }

    #document_number:focus {
        outline: none;
        border-color: var(--verde-header-hover);
        box-shadow: 0 0 10px rgba(57,169,0,0.4);
    }

    /* Títulos más grandes y centrados */
    h1 {
        font-size: 2.5rem;
        text-align: center;
        margin: 20px 0;
    }

    h2 {
        font-size: 2rem;
        text-align: center;
        margin: 15px 0;
    }

    /* Mensaje de error destacado */
    #error_message {
        font-size: 1.5rem;
        text-align: center;
        color: red;
        margin-top: 10px;
    }

    /* Etiqueta del campo centrada y grande */
    label[for="document_number"] {
        display: block;
        text-align: center;
        font-size: 1.5rem;
        margin-bottom: 10px;
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
        /* Estilos para el span de acción */
            #action.entrada {
            color: #28a745; /* verde suave */
            }
            #action.salida {
            color: #ffc107; /* amarillo/ámbar suave */
            }

            /* Input de documento con texto menos intenso */
            #document_number {
            color: #444; /* un gris más suave en lugar de negro puro */
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
      
    </header>



     <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <div class="content-wrapper">
        <h1>SISTEMA DE ASISTENCIAS AL CENTRO DE FORMACIÓN</h1>
        <h2>Acción: <span class="action" id="action"></span></h2>
        <h1><span id="full_hour"></span></h1>
    
        <div>
            <label for="document_number">Número de Documento</label>
            <input type="text" id="document_number" autofocus>
        </div>
    
        <h2>Nombre: <span id="name"></span></h2>
        <h2>Cargo: <span id="position"></span></h2>
        <div id="error_message" style="display: none;"></div>
    </div>
    

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
                $('#error_message').text(response.error).show();
                $('#document_number').val('').focus();
            } else {
                const actionText = response.action.toLowerCase(); // “entrada” o “salida”
                const $action = $('#action');
                $action.text(response.action)
                    .removeClass('entrada salida')
                    .addClass(actionText);
                $('#position').text(response.position);
                $('#name').text(response.name);
                $('#error_message').hide();
                $('#document_number').val('').focus();
            }
        }
        });
    }

        $(document).ready(function() {
        // Al escribir, eliminamos todo lo que no sea dígito
        $('#document_number').on('input', function() {
        this.value = this.value.replace(/\D/g, '');
        });

        // Ya existente: enviar con ENTER
        $('#document_number').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
            let documentNumber = $(this).val();
            if (documentNumber) {
            sendDocumentNumber(documentNumber);
            }
        }
        });
  });
 
});

    </script>




    <!-- Footer -->
    <footer class="footer">
        <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-footer" />
        <p>&copy; {{ date('Y') }} Centro Agroempresarial y Acuícola. Todos los derechos reservados.</p>
    </footer>

</body>
</html>
