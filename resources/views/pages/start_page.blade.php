<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAA Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/pages/start_page_login.css') }}">
</head>
<body>




<div class="form-container">
    <!-- FORMULARIO ENTRADA -->

        @if ($errors->has('entrance.user_name'))
            <div style="color: #ff8080; font-size: 0.9rem; margin-top: 0.5rem;">
                {{ $errors->first('entrance.user_name') }}
            </div>
        @endif

    <form action="{{ route('entrance-login') }}" method="POST">
        @csrf
        <div class="icon-header"><i class="fas fa-door-open"></i></div>
        <h2>Entrada</h2>

        <div class="input-group">
            <label for="user_name_entrada">Usuario</label>
            <i class="fas fa-user"></i>
            <input type="text" id="user_name_entrada" name="user_name" placeholder="Usuario">
        </div>

        <div class="input-group">
            <label for="password_entrada">Contraseña</label>
            <i class="fas fa-lock"></i>
            <input type="password" id="password_entrada" name="password" placeholder="Contraseña">
        </div>

        <button type="submit">Ingresar</button>
    </form>

    <!-- FORMULARIO PROGRAMACIÓN -->
    @if ($errors->has('programming.user_name'))
        <div style="color: #ff8080; font-size: 0.9rem; margin-top: 0.5rem;">
            {{ $errors->first('programming.user_name') }}
        </div>
    @endif

    <form action="{{ route('programming-login') }}" method="POST">
        @csrf
        <div class="icon-header"><i class="fas fa-calendar-check"></i></div>
        <h2>Programación</h2>

        <div class="input-group">
            <label for="user_name_program">Usuario</label>
            <i class="fas fa-user"></i>
            <input type="text" id="user_name_program" name="user_name" placeholder="Usuario">
        </div>

        <div class="input-group">
            <label for="password_program">Contraseña</label>
            <i class="fas fa-lock"></i>
            <input type="password" id="password_program" name="password" placeholder="Contraseña">
        </div>

        <div class="input-group">
            <label for="module">Ingresar a:</label>
            <i class="fas fa-list"></i>
            <select id="module" name="module">
                <option value="Administrador_programacion">Gestión de Programación</option>
                <option value="Administrador_asistencia">Gestión de Asistencia</option>
            </select>
        </div>

        <button type="submit">Ingresar</button>
    </form>
</div>

</body>
</html>
