<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x:slot-page_style>
    <x-slot:title>CAA</x:slot-title>

    <form action="entrance/login" method="POST">
        @csrf

       @if (session('message'))
    <div>
        {{ session('message') }}
    </div>
        @endif
        <div>
            <section>
                <p>Asistencia</p>
                <img src="" alt="">
            </section>

            <section>
                <div>
                    <label for="user_name">Usuario</label>
                    <input type="text" id="user_name" name="user_name">
                </div>

                <div>
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password">
                </div>
                
                <x-button type="submit" class="btn">Ingresar</x-button>
            </section>
        </div>
    </form>
    {{--  VERIFICACION DE ERRORES Y ADEMAS LOS MUESTRA EN LA PARTE PRINCIPAL DE EL LOGIN :)   --}}
    @if ($errors->has('entrance.user_name'))
    <div>
        <ul>
            <li>{{ $errors->first('entrance.user_name') }}</li>
        </ul>
    </div>
@endif



 
    <form action="{{route('programming-login')}}" method="POST">
        @csrf

         <div>
            <section>
                <p>Programacion</p>
                <img src="" alt="">
            </section>

            <section>
                <div>
                    <label for="user_name" class="name">Usuario</label>
                    <input type="text" id="user_name" name="user_name">
                </div>

                <div>
                    <label for="password">Contraseña</label>
                    <input type="password" id="password" name="password">
                </div>
                
                <x-button type="submit" class="btn">Ingresar</x-button>
            </section>
        </div>

    </form>
    @if ($errors->has('programming.user_name'))
    <div>
        <ul>
            <li>{{ $errors->first('programming.user_name') }}</li>
        </ul>
    </div>
@endif

  

</x-layout>