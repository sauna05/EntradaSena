<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --verde-sena: #39A900;
            --verde-oscuro: #2E7D32;
            --verde-claro: #E8F5E9;
            --verde-destaque: #43A047;
            --gris-oscuro: #37474F;
            --gris-medio: #78909C;
            --gris-claro: #ECEFF1;
            --blanco: #FFFFFF;
            --sombra-suave: 0 4px 20px rgba(0, 0, 0, 0.08);
            --sombra-focus: 0 0 0 4px rgba(57, 169, 0, 0.2);
            --degradado-verde: linear-gradient(135deg, var(--verde-sena), var(--verde-oscuro));
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', 'Roboto', sans-serif;
            background-color: var(--gris-claro);
            line-height: 1.6;
            color: var(--gris-oscuro);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Header (mantenido como está) */
        .header {
            background-color: var(--blanco);
            color: var(--verde-sena);
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--sombra-suave);
            position: relative;
            z-index: 10;
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

        /* Contenido principal - Completamente renovado */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
        }

        .content-card {
            background: var(--blanco);
            border-radius: 16px;
            box-shadow: var(--sombra-suave);
            width: 100%;
            max-width: 800px;
            padding: 2.5rem;
            position: relative;
            z-index: 2;
            margin: 1rem 0;
        }

        .card-title {
            text-align: center;
            margin-bottom: 2rem;
            position: relative;
            padding-bottom: 1rem;
        }

        .card-title h1 {
            font-size: 2.2rem;
            color: var(--verde-oscuro);
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .card-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 25%;
            width: 50%;
            height: 4px;
            background: var(--degradado-verde);
            border-radius: 2px;
        }

        .time-display {
            text-align: center;
            margin: 1.5rem 0;
            padding: 1rem;
            background: var(--verde-claro);
            border-radius: 12px;
            position: relative;
        }

        #full_hour {
            font-size: 3.2rem;
            font-weight: 700;
            color: var(--verde-oscuro);
            font-family: 'Courier New', monospace;
            letter-spacing: 2px;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
        }

        .date-display {
            font-size: 1.2rem;
            color: var(--gris-medio);
            margin-top: 0.5rem;
        }

        .input-section {
            margin: 2rem 0;
        }

        .input-container {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-label {
            display: block;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--gris-oscuro);
            margin-bottom: 0.8rem;
            text-align: center;
        }

        .input-field {
            width: 100%;
            padding: 1.2rem 1.5rem;
            font-size: 1.4rem;
            border: 2px solid var(--verde-sena);
            border-radius: 12px;
            text-align: center;
            transition: all 0.3s ease;
            background: var(--blanco);
            color: var(--gris-oscuro);
            font-weight: 500;
            box-shadow: 0 2px 8px rgba(57, 169, 0, 0.1);
        }

        .input-field:focus {
            outline: none;
            border-color: var(--verde-oscuro);
            box-shadow: var(--sombra-focus);
            transform: translateY(-2px);
        }

        .input-field::placeholder {
            color: #BDBDBD;
            font-weight: 400;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--verde-sena);
            font-size: 1.5rem;
        }

        .action-section {
            text-align: center;
            margin: 2rem 0;
            padding: 1.5rem;
            border-radius: 12px;
            background: var(--verde-claro);
            transition: all 0.4s ease;
        }

        .action-label {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--gris-oscuro);
            margin-bottom: 0.5rem;
            display: block;
        }

        .action-badge {
            display: inline-block;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-size: 1.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            animation: fadeIn 0.5s ease;
        }

        .action-badge.entrada {
            background: linear-gradient(135deg, #4CAF50, #2E7D32);
            color: white;
        }

        .action-badge.salida {
            background: linear-gradient(135deg, #FF9800, #EF6C00);
            color: white;
        }

        .user-info-card {
            background: var(--blanco);
            border-radius: 12px;
            padding: 1.8rem;
            margin: 1.5rem 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.05);
            border-left: 5px solid var(--verde-sena);
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
            text-align: left;
        }

        .info-item {
            margin-bottom: 0.8rem;
        }

        .info-label {
            font-weight: 600;
            color: var(--gris-medio);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.3rem;
        }

        .info-value {
            font-size: 1.1rem;
            color: var(--gris-oscuro);
            font-weight: 500;
        }

        #error_message {
            background: #FFEBEE;
            color: #C62828;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin: 1.5rem 0;
            text-align: center;
            font-weight: 500;
            border-left: 4px solid #C62828;
            display: none;
            animation: shake 0.5s ease;
        }

        .decoration {
            position: absolute;
            z-index: 1;
            opacity: 0.05;
        }

        .decoration-1 {
            top: 10%;
            left: 5%;
            font-size: 15rem;
            color: var(--verde-sena);
        }

        .decoration-2 {
            bottom: 10%;
            right: 5%;
            font-size: 12rem;
            color: var(--verde-sena);
        }

        /* Animaciones */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }

        /* Footer (mantenido como está) */
        .footer {
            background-color: var(--blanco);
            color: var(--verde-sena);
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
            .content-card {
                padding: 2rem 1.5rem;
            }

            .card-title h1 {
                font-size: 1.8rem;
            }

            #full_hour {
                font-size: 2.5rem;
            }

            .input-field {
                font-size: 1.2rem;
                padding: 1rem;
            }

            .action-badge {
                font-size: 1.5rem;
                padding: 0.7rem 1.5rem;
            }

            .user-info-card {
                grid-template-columns: 1fr;
            }

            .decoration {
                display: none;
            }
        }

        @media (max-width: 480px) {
            .card-title h1 {
                font-size: 1.5rem;
            }

            #full_hour {
                font-size: 2rem;
            }

            .input-label {
                font-size: 1.1rem;
            }

            .input-field {
                font-size: 1.1rem;
            }

            .action-badge {
                font-size: 1.3rem;
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

    <!-- Contenido Principal -->
    <main class="main-content">
        <!-- Elementos decorativos -->
        <i class="fas fa-calendar-check decoration decoration-1"></i>
        <i class="fas fa-clock decoration decoration-2"></i>

        <div class="content-card">
            <div class="card-title">
                <h1>REGISTRO DE ENTRADA Y SALIDA</h1>
                <p>Centro de Formación Agroempresarial y Acuícola</p>
            </div>

            <div class="time-display">
                <div id="full_hour"></div>
                <div class="date-display" id="full_date"></div>
            </div>

            <div class="input-section">
                <div class="input-container">
                    <label for="document_number" class="input-label">INGRESE SU NÚMERO DE DOCUMENTO</label>
                    <input type="text" id="document_number" class="input-field" placeholder="Ej: 123456789" autofocus>
                    <i class="fas fa-id-card input-icon"></i>
                </div>
            </div>

            <div class="action-section">
                <span class="action-label">ACCIÓN REGISTRADA</span>
                <div class="action-badge" id="action">ESPERANDO REGISTRO</div>
            </div>

            <div class="user-info-card">
                <div class="info-item">
                    <div class="info-label">Nombre</div>
                    <div class="info-value" id="name">-</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Cargo</div>
                    <div class="info-value" id="position">-</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Hora de registro</div>
                    <div class="info-value" id="register-time">-</div>
                </div>
                <div class="info-item">
                    <div class="info-label">Estado</div>
                    <div class="info-value" id="status">Pendiente</div>
                </div>
            </div>

            <div id="error_message"></div>
        </div>
    </main>

    <script>
        // Actualiza la hora y fecha en tiempo real
        function updateDateTime() {
            const now = new Date();

            // Formatear hora
            const hour = now.getHours().toString().padStart(2, '0');
            const minutes = now.getMinutes().toString().padStart(2, '0');
            const seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('full_hour').textContent = `${hour}:${minutes}:${seconds}`;

            // Formatear fecha
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById('full_date').textContent = now.toLocaleDateString('es-ES', options);

            // Actualizar hora de registro si está visible
            const registerTime = document.getElementById('register-time');
            if (registerTime.textContent !== '-') {
                registerTime.textContent = `${hour}:${minutes}:${seconds}`;
            }
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();

        $(document).ready(function() {
            // Inicializar el badge de acción
            $('#action').text('ESPERANDO REGISTRO').removeClass('entrada salida');

            function sendDocumentNumber(documentNumber) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('entrance.store') }}",
                    type: 'POST',
                    data: {
                        document_number: documentNumber,
                        _token: csrfToken
                    },
                    beforeSend: function() {
                        $('#status').text('Verificando...').css('color', '#FF9800');
                    },
                    success: function(response) {
                        if (response.error) {
                            $('#error_message').text(response.error).show();
                            $('#document_number').val('').focus();
                            $('#status').text('Error').css('color', '#C62828');

                            // Animación de error
                            $('#error_message').css('animation', 'none');
                            setTimeout(function() {
                                $('#error_message').css('animation', 'shake 0.5s ease');
                            }, 10);
                        } else {
                            const actionText = response.action.toUpperCase();
                            const $action = $('#action');

                            // Actualizar la interfaz con los datos recibidos
                            $action.text(actionText)
                                .removeClass('entrada salida')
                                .addClass(response.action.toLowerCase());

                            $('#position').text(response.position);
                            $('#name').text(response.name);
                            $('#register-time').text($('#full_hour').text());
                            $('#status').text('Registro exitoso').css('color', '#2E7D32');
                            $('#error_message').hide();
                            $('#document_number').val('').focus();

                            // Animación de confirmación
                            $action.css('animation', 'none');
                            setTimeout(function() {
                                $action.css('animation', 'pulse 0.6s ease');
                            }, 10);
                        }
                    },
                    error: function() {
                        $('#error_message').text('Error de conexión. Intente nuevamente.').show();
                        $('#status').text('Error').css('color', '#C62828');
                    }
                });
            }

            // Validar que solo se ingresen números
            $('#document_number').on('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });

            // Enviar el formulario al presionar Enter
            $('#document_number').on('keypress', function(e) {
                if (e.which === 13) {
                    e.preventDefault();
                    let documentNumber = $(this).val().trim();
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
