<x-layout>
    <x-slot:page_style>css\pages\entrance\entrance.css</x-slot-page_style>
    <x-slot:title>CAA</x-slot-title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <h1>SISTEMA DE ASISTENCIAS AL CENTRO DE FORMACIÓN</h1>
    <h2>Accion: <span class="action" id="action"> </span></h2>
    <h1><span id="full_hour"></span></h1>

    <div>
        <label for="document_number">Numero de Documento</label>
        <input type="text" id="document_number">
        <button id="send">Ingresar</button>
    </div>

    <h2>Nombre: <span id="name"></span></h2>
    <h2>Cargo: <span id="position"></span></h2>

    <script>
        function updateHour() {
            let now = new Date();
            let hour = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('full_hour').textContent = `${hour}:${minutes}:${seconds}`;
        }

        setInterval(updateHour, 1000);
        updateHour();

        $(document).ready(function () {
            $('#send').click(function () {
                let documentNumber = $('#document_number').val();
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{route('entrance.store')}}",
                    type: 'POST',
                    data: {
                        document_number: documentNumber,
                        _token: csrfToken
                    },
                    success: function (response) {
                        $('#action').text(`${response.action}`);
                        $('#position').text(`${response.position}`);
                        $('#name').text(`${response.name}`);

                    },
                    error: function (xhr) {
                        console.log(xhr.responseText); // Ver error en consola
                        $('#action').text('Error al enviar los datos');
                    }
                });
            });
        });
    </script>
</x-layout>