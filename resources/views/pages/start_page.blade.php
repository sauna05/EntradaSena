<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x:slot-page_style>
    <x-slot:title>CAA</x:slot-title>

    <form action="entrance/login" method="POST">
        @csrf

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

 
    <form action="{{route('programming-login')}}" method="POST">
        @csrf

         <div>
            <section>
                <p>Programacion</p>
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

</x-layout>