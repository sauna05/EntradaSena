<x-layout_aprendiz>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Cambiar Contraseña</x-slot:title>

    <style>
        /* Estilos específicos para el formulario de cambio de contraseña */
        .password-container {
            max-width: 500px;
            margin: 0 auto;
        }

        .password-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .password-title {
            color: var(--verde-header-hover);
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .password-subtitle {
            color: #555;
            font-size: 16px;
        }

        .password-form {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border: 1px solid var(--gris-borde);
        }

        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--gris-texto);
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 14px 16px;
            border: 2px solid var(--gris-borde);
            border-radius: 10px;
            font-size: 16px;
            transition: all 0.3s ease;
            background-color: #f9f9f9;
        }

        .form-group input:focus {
            outline: none;
            border-color: var(--verde-sena);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(57, 169, 0, 0.1);
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 42px;
            cursor: pointer;
            color: #777;
            transition: color 0.3s ease;
        }

        .password-toggle:hover {
            color: var(--verde-sena);
        }

        .error-message {
            color: #e74c3c;
            font-size: 14px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .error-message i {
            font-size: 16px;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #28a745;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .success-message i {
            font-size: 20px;
        }

        .error-list {
            background-color: #f8d7da;
            color: #721c24;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            border-left: 4px solid #dc3545;
        }

        .error-list ul {
            margin: 0;
            padding-left: 20px;
        }

        .error-list li {
            margin-bottom: 5px;
        }

        .password-strength {
            margin-top: 8px;
            height: 5px;
            border-radius: 3px;
            background-color: #eee;
            overflow: hidden;
        }

        .strength-meter {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .strength-weak { width: 33%; background-color: #e74c3c; }
        .strength-medium { width: 66%; background-color: #f39c12; }
        .strength-strong { width: 100%; background-color: #27ae60; }

        .strength-text {
            font-size: 12px;
            color: #777;
            margin-top: 5px;
            text-align: right;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: var(--verde-boton);
            color: white;
            border: none;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .submit-btn:hover {
            background: var(--verde-boton-hover);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(57, 169, 0, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .password-requirements {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-top: 30px;
            border-left: 4px solid var(--verde-sena);
        }

        .requirements-title {
            color: var(--verde-header-hover);
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .requirements-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .requirements-list li {
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .requirements-list li i {
            color: var(--verde-sena);
            font-size: 12px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .password-container {
                padding: 0 15px;
            }

            .password-form {
                padding: 20px;
            }

            .password-title {
                font-size: 24px;
            }
        }
    </style>

    <div class="password-container">
        <div class="password-header">
            <h2 class="password-title">Cambiar Contraseña</h2>
            <p class="password-subtitle">Actualiza tu contraseña para mantener tu cuenta segura</p>
        </div>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="success-message">
                <i class="fas fa-check-circle"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Mostrar errores si existen -->
        @if ($errors->any())
            <div class="error-list">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario de cambio de contraseña -->
        <form action="{{ route('password.update') }}" method="POST" class="password-form" id="passwordForm">
            @csrf

            <!-- Contraseña actual -->
            <div class="form-group">
                <label for="current_password">Contraseña Actual</label>
                <input type="password" id="current_password" name="current_password" required>
                <span class="password-toggle" onclick="togglePassword('current_password', 'toggleCurrent')">
                    <i class="fas fa-eye" id="toggleCurrent"></i>
                </span>
                @error('current_password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Nueva contraseña -->
            <div class="form-group">
                <label for="new_password">Nueva Contraseña</label>
                <input type="password" id="new_password" name="new_password" required oninput="checkPasswordStrength(this.value)">
                <span class="password-toggle" onclick="togglePassword('new_password', 'toggleNew')">
                    <i class="fas fa-eye" id="toggleNew"></i>
                </span>
                <div class="password-strength">
                    <div class="strength-meter" id="strengthMeter"></div>
                </div>
                <div class="strength-text" id="strengthText">Seguridad de la contraseña</div>
                @error('new_password')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <!-- Confirmar nueva contraseña -->
            <div class="form-group">
                <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
                <span class="password-toggle" onclick="togglePassword('new_password_confirmation', 'toggleConfirm')">
                    <i class="fas fa-eye" id="toggleConfirm"></i>
                </span>
                @error('new_password_confirmation')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>{{ $message }}</span>
                    </div>
                @enderror
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-key"></i>
                Cambiar Contraseña
            </button>
        </form>

        <div class="password-requirements">
            <h3 class="requirements-title">
                <i class="fas fa-info-circle"></i>
                Requisitos de la contraseña
            </h3>
            <ul class="requirements-list">
                <li><i class="fas fa-check"></i> Mínimo 8 caracteres</li>
                <li><i class="fas fa-check"></i> Al menos una letra mayúscula</li>
                <li><i class="fas fa-check"></i> Al menos una letra minúscula</li>
                <li><i class="fas fa-check"></i> Al menos un número</li>
                <li><i class="fas fa-check"></i> Al menos un carácter especial</li>
            </ul>
        </div>
    </div>

    <script>
        // Función para mostrar/ocultar contraseña
        function togglePassword(inputId, toggleId) {
            const passwordInput = document.getElementById(inputId);
            const toggleIcon = document.getElementById(toggleId);

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }

        // Función para verificar la fortaleza de la contraseña
        function checkPasswordStrength(password) {
            const meter = document.getElementById('strengthMeter');
            const text = document.getElementById('strengthText');

            // Reiniciar
            meter.className = 'strength-meter';
            text.textContent = 'Seguridad de la contraseña';

            if (password.length === 0) {
                return;
            }

            // Verificar fortaleza
            let strength = 0;

            // Longitud
            if (password.length >= 8) strength++;

            // Letras mayúsculas y minúsculas
            if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength++;

            // Números
            if (password.match(/([0-9])/)) strength++;

            // Caracteres especiales
            if (password.match(/([!,@,#,$,%,^,&,*,?,_,~])/)) strength++;

            // Actualizar visualización
            if (password.length < 8) {
                meter.className = 'strength-meter strength-weak';
                text.textContent = 'Débil';
                text.style.color = '#e74c3c';
            } else if (strength <= 2) {
                meter.className = 'strength-meter strength-weak';
                text.textContent = 'Débil';
                text.style.color = '#e74c3c';
            } else if (strength === 3) {
                meter.className = 'strength-meter strength-medium';
                text.textContent = 'Media';
                text.style.color = '#f39c12';
            } else {
                meter.className = 'strength-meter strength-strong';
                text.textContent = 'Fuerte';
                text.style.color = '#27ae60';
            }
        }

        // Validación del formulario
        document.getElementById('passwordForm').addEventListener('submit', function(e) {
            const newPassword = document.getElementById('new_password').value;
            const confirmPassword = document.getElementById('new_password_confirmation').value;

            if (newPassword !== confirmPassword) {
                e.preventDefault();
                alert('Las contraseñas no coinciden. Por favor, verifica.');
            }
        });
    </script>
</x-layout_aprendiz>
