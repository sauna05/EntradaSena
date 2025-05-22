<x-layout_asistencia>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/assistance/assistance_show.css</x-slot:page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>Detalles de Inasistencia</x-slot:title>

    <div class="container mt-5">
        <h1>Formulario de inasistencia</h1>

        <div>
            <p>Hola <strong>{{$absence->person->name}}</strong></p>

            <p>Quería expresarte mi preocupación porque no has asistido al ambiente de formación ni a la cena. Me preocupa que todo esté bien y que no haya habido algún inconveniente que te haya impedido estar presente.

            Me gustaría saber cuáles son los motivos por los que no has podido asistir. ¿Hay algo que te preocupa o algún problema que necesites resolver? Estoy aquí para escucharte y apoyarte en lo que necesites.

            Por favor, házmelo saber si hay algo que pueda hacer para ayudarte. Estoy interesado en saber las razones por las que no has llegado y en encontrar una solución para que puedas reintegrarte a nuestras actividades.

            Espero tu respuesta y ojalá que todo se resuelva de manera positiva.</p>

            <p>Saludos cordiales, Coordinación Academica.</p>

        </div>
    </div>

    <section class="container ">
        <form action="{{route('entrance.absence.update.answer',$absence->person->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <textarea name="motive" id="motive" cols="30" rows="10" placeholder="Ejemplo: Se me dificultó acceder al Centro de Formación porque..."></textarea>
            </div>
             <div>
                <input type="file" name="excuse_image" id="excuse_image">
            </div>
            <input type="submit" value="Enviar">

        </form>
    </section>

</x-layout_asistencia>


