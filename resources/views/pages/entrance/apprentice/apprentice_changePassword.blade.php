<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x:slot-page_style>

    <x-slot:title>Cambiar Contraseña</x-slot:title>

    <h2>Cambiar Contraseña</h2>

    <!-- Formulario de cambio de contraseña -->
    <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <!-- Contraseña actual -->
        <div>
            <label for="current_password">Contraseña Actual</label>
            <input type="password" id="current_password" name="current_password" required>
        </div>

        <!-- Nueva contraseña -->
        <div>
            <label for="new_password">Nueva Contraseña</label>
            <input type="password" id="new_password" name="new_password" required>
        </div>

        <!-- Confirmar nueva contraseña -->
        <div>
            <label for="new_password_confirmation">Confirmar Nueva Contraseña</label>
            <input type="password" id="new_password_confirmation" name="new_password_confirmation" required>
        </div>

        <!-- Mostrar errores si existen -->
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-button type="submit">Cambiar Contraseña</x-button>
    </form>

    <!-- Mensaje de éxito -->
    @if(session('success'))
        <div>
            <p>{{ session('success') }}</p>
        </div>
    @endif

</x-layout>
