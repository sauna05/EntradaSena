<x-layout>
    <x-slot:page_style>css\pages\entrance\entrance.css</x-slot-page_style>
    <x-slot:title>CAA</x-slot-title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <h1>SISTEMA DE ASISTENCIAS AL CENTRO DE FORMACIÓN</h1>
    <h2>Acción: <span class="action" id="action"></span></h2>
    <h1><span id="full_hour"></span></h1>

    <div>
        <label for="document_number">Número de Documento</label>
        <input type="text" id="document_number" autofocus>
        <button id="send">Ingresar</button>
    </div>

    <h2>Nombre: <span id="name"></span></h2>
    <h2>Cargo: <span id="position"></span></h2>
    <div id="error_message" style="color: red; display: none;"></div>

    <script>
        // Actualiza la hora en tiempo real
        function updateHour() {
            let now = new Date();
            let hour = now.getHours().toString().padStart(2, '0');
            let minutes = now.getMinutes().toString().padStart(2, '0');
            let seconds = now.getSeconds().toString().padStart(2, '0');
            document.getElementById('full_hour').textContent = `${hour}:${minutes}:${seconds}`;
        }

        setInterval(updateHour, 1000);
        updateHour();

        $(document).ready(function() {
            // Función para enviar los datos
            function sendDocumentNumber(documentNumber) {
                let csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('entrance.store') }}",
                    type: 'POST',
                    data: {
                        document_number: documentNumber,
                        _token: csrfToken
                    },
                    success: function(response) {
                        if (response.error) {
                            // Mostrar mensaje de error si no está registrado
                            $('#error_message').text(response.error).show();
                            $('#document_number').val(''); // Limpiar el campo después de enviar
                        } else {
                            // Mostrar información cuando los datos son correctos
                            $('#action').text(`${response.action}`);
                            $('#position').text(`${response.position}`);
                            $('#name').text(`${response.name}`);
                            $('#error_message').hide(); // Ocultar cualquier mensaje de error previo
                            $('#document_number').val(''); // Limpiar el campo
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        $('#action').text('Error al enviar los datos');
                    }
                });
            }

            // Evento al hacer clic en el botón de ingresar
            $('#send').click(function() {
                let documentNumber = $('#document_number').val();
                if (documentNumber) {
                    sendDocumentNumber(documentNumber);
                }
            });

            // Detectar el escaneo del código de barras en el campo de documento
            $('#document_number').on('input', function() {
                let documentNumber = $('#document_number').val();
                if (documentNumber.length > 0) {
                    // Si el campo tiene algún valor (como el escaneo de código de barras), enviar los datos
                    sendDocumentNumber(documentNumber);
                }
            });
        });
    </script>
</x-layout>
