<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x:slot-page_style>
    <x-slot:title>CAA</x:slot-title>

    <form action="error" method="GET">
        <div>
            <section>
                <p>Asistencia</p>
                <img src="" alt="">
            </section>

            <section>
                <div>
                    <label for="text_user">Usuario</label>
                    <input type="text" id="text_user">
                </div>

                <div>
                    <label for="password">Contraseña</label>
                    <input type="text" id="password">
                </div>
                
                <x-button type="submit" class="btn">Ingresar</x-button>
            </section>
            
        </div>
       
    </form>

</x-layout>