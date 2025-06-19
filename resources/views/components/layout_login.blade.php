<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ $title ?? 'Sistema SENA' }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
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
            --error-color: #ff8080;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background: var(--gris-fondo);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .module-info {
            position: relative;
            display: inline-block;
            margin-left: 5px;
            cursor: help;
        }
        
        .module-info-icon {
            color: var(--verde-sena);
            font-size: 0.9em;
        }
        
        .module-tooltip {
            visibility: hidden;
            width: 300px;
            background-color: #333;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 10px;
            position: absolute;
            z-index: 100;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s;
            font-size: 0.9rem;
            font-weight: normal;
            line-height: 1.4;
        }
        
        .module-info:hover .module-tooltip {
            visibility: visible;
            opacity: 1;
        }
        
        .module-tooltip::after {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: #333 transparent transparent transparent;
        }
        
        .form-description {
            text-align: center;
            margin-bottom: 1.5rem;
            color: #555;
            font-size: 0.95rem;
            position: relative;
            z-index: 1;
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
            position: relative;
            z-index: 10;
        }

        .header-container {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo-header {
            height: 70px;
            object-fit: contain;
        }

        .texto-header {
            font-size: 24px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            background-color: rgb(241, 244, 245)
            /* background-image: url({{asset('senav.jpg')}}) ; */
        }

        /* Form Container */
        .form-container {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
            justify-content: center;
            max-width: 1200px;
            width: 100%;
        }

        /* Forms */
        .login-form {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            overflow: hidden;
        }

        .login-form::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.3), transparent 70%);
            animation: glow 10s infinite linear;
            z-index: 0;
        }

        @keyframes glow {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .login-form h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            color: #2f3640;
            position: relative;
            z-index: 1;
        }

        .icon-header {
            font-size: 2.5rem;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--verde-sena);
            position: relative;
            z-index: 1;
        }

        /* Input Groups */
        .input-group {
            margin-bottom: 1.2rem;
            position: relative;
            z-index: 1;
        }

        .input-group label {
            display: block;
            margin-bottom: 0.4rem;
            font-weight: 600;
            color: #34495e;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 12px;
            transform: translateY(-50%);
            color: #7f8c8d;
            pointer-events: none;
        }

        .input-group input,
        .input-group select {
            width: 100%;
            padding: 0.75rem 0.75rem 0.75rem 2.5rem;
            border-radius: 12px;
            border: 1px solid #dcdde1;
            background-color: rgba(255, 255, 255, 0.8);
            color: #2c3e50;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .input-group input:focus,
        .input-group select:focus {
            outline: none;
            border-color: var(--verde-sena);
            background-color: #ffffff;
            box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.3);
        }

        /* Buttons */
        .submit-btn {
            width: 100%;
            padding: 0.9rem;
            font-size: 1rem;
            font-weight: 600;
            background: var(--verde-boton);
            border: none;
            border-radius: 12px;
            color: #fff;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(57, 169, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .submit-btn:hover {
            background: var(--verde-boton-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(57, 169, 0, 0.4);
        }

        /* Error Messages */
        .error-message {
            color: var(--error-color);
            font-size: 0.9rem;
            margin-top: 0.5rem;
            text-align: center;
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

        /* Responsive */
        @media (max-width: 768px) {
            .header {
                padding: 15px;
                flex-direction: column;
                text-align: center;
            }
            
            .header-container {
                margin-bottom: 10px;
            }
            
            .texto-header {
                font-size: 20px;
            }
            
            .login-form {
                width: 100%;
                max-width: 360px;
                padding: 1.5rem;
            }
            
            .form-container {
                gap: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .logo-header, .logo-footer {
                height: 50px;
            }
            
            .texto-header {
                font-size: 18px;
            }
            
            .login-form {
                padding: 1.2rem;
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
        <a href="{{ route('gestion_entrada') }}" style="color: var(--gris-texto); text-decoration: none; font-weight: bold; display: flex; align-items: center; gap: 6px;">
            <i class="fas fa-door-open"></i> Gestión de Entrada
        </a>
    </header>
    

    <!-- Main Content -->
    <main class="main-content">
        <div class="form-container">
           
            <!-- FORMULARIO PROGRAMACIÓN -->
            <form class="login-form" action="{{ route('programming-login') }}" method="POST">
                @csrf
                <div class="icon-header"><i class="fas fa-calendar-check"></i></div>
                <h2>Programación</h2>

                @if ($errors->has('programming.user_name'))
                    <div class="error-message">
                        {{ $errors->first('programming.user_name') }}
                    </div>
                @endif

                <div class="input-group">
                    <label for="user_name_program">Usuario</label>
                    <i class="fas fa-user"></i>
                    <input type="text" id="user_name_program" name="user_name" placeholder="Usuario">
                </div>
                <div class="input-group" style="position: relative;">
                    <label for="password_program">Contraseña</label>
                
                    <input type="password" id="password_program" name="password" placeholder="Tu contraseña">
                    
                    <!-- Ojito dentro del input -->
                    <i class="fas fa-eye-slash" id="eyeIcon" 
                       style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #7f8c8d;"></i>
                
                    <!-- Checkbox debajo a la derecha -->
                    <div style="position: absolute; right: 10px; bottom: -25px; display: flex; align-items: center; gap: 4px;">
                        <input type="checkbox" id="togglePassword" style="cursor: pointer;">
                        <label for="togglePassword" style="cursor: pointer; font-size: 0.85rem; color: #7f8c8d;">Mostrar</label>
                    </div>
                </div>
                
                
                
                

                <div class="input-group">
                    <label for="module">Ingresar a:</label>
                    <i class="fas fa-list"></i>
                    <select id="module" name="module">
                        <option value="Administrador_programacion">Gestión de Programación</option>
                        <option value="Administrador_asistencia">Gestión de Asistencia</option>
                    </select>
                </div>

                <button type="submit" class="submit-btn">Ingresar</button>
                
            </form>
            
        </div>
    </main>
    
    

    <!-- Footer -->
    <footer class="footer">
        <img src="{{ asset('logoSena.png') }}" alt="Logo Sena" class="logo-footer" />
        <p>&copy; {{ date('Y') }} Centro Agroempresarial y Acuícola. Todos los derechos reservados.</p>
    </footer>
    <script>
        const toggle = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password_program');
        const eyeIcon = document.getElementById('eyeIcon');
    
        toggle.addEventListener('change', function () {
            if (this.checked) {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        });
    </script>
    
</body>
</html>