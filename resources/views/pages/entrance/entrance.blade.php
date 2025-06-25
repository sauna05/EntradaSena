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
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: var(--gris-fondo);
            line-height: 1.6;
        }

        /* Header (mantenido como está) */
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
            height: 70px;
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

        /* Contenido principal - Optimizado */
        .content-wrapper {
            padding: 2rem 1rem;
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        h1 {
            font-size: 2rem;
            color: var(--verde-header);
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        #full_hour {
            font-size: 2.5rem;
            color: var(--verde-header);
            margin: 1rem 0;
            font-family: 'Courier New', monospace;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .document-input-container {
            margin: 2rem auto;
            max-width: 600px;
        }

        label[for="document_number"] {
            display: block;
            font-size: 1.25rem;
            color: var(--gris-texto);
            margin-bottom: 0.75rem;
            font-weight: 500;
        }

        #document_number {
            font-size: 1.5rem;
            padding: 1rem;
            width: 100%;
            border: 2px solid var(--verde-sena);
            border-radius: 8px;
            text-align: center;
            transition: all 0.2s ease;
            box-shadow: 0 2px 8px rgba(57, 169, 0, 0.1);
            color: var(--gris-texto);
        }

        #document_number:focus {
            outline: none;
            border-color: var(--verde-header-hover);
            box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.2);
        }

        .action-container {
            margin: 1.5rem 0;
            padding: 1rem;
            border-radius: 8px;
            background-color: rgba(57, 169, 0, 0.05);
        }

        .action {
            font-size: 1.75rem;
            font-weight: 700;
            text-transform: uppercase;
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 6px;
            margin-top: 0.5rem;
            animation: fadeIn 0.3s ease;
        }

        .action.entrada {
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
            border: 2px solid #28a745;
        }

        .action.salida {
            color: #ffc107;
            background-color: rgba(255, 193, 7, 0.1);
            border: 2px solid #ffc107;
        }

        .user-info {
            background-color: var(--blanco);
            border-radius: 8px;
            padding: 1.5rem;
            margin: 1.5rem auto;
            max-width: 600px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.05);
            border: 1px solid var(--gris-borde);
        }

        .user-info h2 {
            margin: 0.5rem 0;
            font-size: 1.25rem;
        }

        #error_message {
            font-size: 1.1rem;
            color: #dc3545;
            padding: 0.75rem;
            margin: 1rem auto;
            max-width: 500px;
            background-color: rgba(220, 53, 69, 0.1);
            border-radius: 6px;
            border: 1px solid #dc3545;
            display: none;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Footer (mantenido como está) */
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
            height: 60px;
            margin-bottom: 10px;
            object-fit: contain;
        }

        .footer p {
            margin: 0;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.3px;
        }

        /* Responsividad */
        @media (max-width: 768px) {
            .content-wrapper {
                padding: 1.5rem 1rem;
            }
            
            h1 {
                font-size: 1.75rem;
            }
            
            #full_hour {
                font-size: 2rem;
            }
            
            #document_number {
                font-size: 1.25rem;
                padding: 0.75rem;
            }
            
            .action {
                font-size: 1.5rem;
            }
            
            .user-info h2 {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.5rem;
            }
            
            #full_hour {
                font-size: 1.75rem;
            }
            
            label[for="document_number"] {
                font-size: 1.1rem;
            }
            
            #document_number {
                font-size: 1.1rem;
            }
            
            .action {
                font-size: 1.25rem;
                padding: 0.5rem 1rem;
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
    </header>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <div class="content-wrapper">
        <h1>REGISTRO DE ENTRADA AL CENTRO DE FORMACIÓN</h1>
        
        <div id="full_hour"></div>
        
        <div class="document-input-container">
            <label for="document_number">NÚMERO DE DOCUMENTO</label>
            <input type="text" id="document_number" autofocus>
        </div>
        
        <div class="action-container">
            <h2>ACCIÓN REGISTRADA</h2>
            <span class="action" id="action"></span>
        </div>
        
        <div class="user-info">
            <h2>Nombre: <span id="name"></span></h2>
            <h2>Cargo: <span id="position"></span></h2>
        </div>
        
        <div id="error_message"></div>
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
                            const actionText = response.action.toLowerCase();
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

            $('#document_number').on('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });

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
    </script>

    <!-- Footer -->
    <footer class="footer">
        <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-footer" />
        <p>&copy; {{ date('Y') }} Centro Agroempresarial y Acuícola. Todos los derechos reservados.</p>
    </footer>
</body>
</html>