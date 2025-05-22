<x-layout_asistencia>
    {{-- Librería para leer excel desde la web --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

    {{-- Token CSRF --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Estilo de la página --}}
   <link rel="stylesheet" href="{{ asset('css/pages/entrance/admin/people_create.css') }}">

        {{-- Título de la página --}}
        <x-slot:title>CAA</x-slot:title>



        <h1>Formulario de Registro Personas</h1>

        <form action="{{ route('entrance.people.store') }}" method="POST" class="form-create-people">
            @csrf
            <section>
                <div>
                    <label for="id_position">Cargo</label>
                    <select name="id_position" id="id_position" onchange="ShowForm()">
                        <option value="">Seleccione un Cargo</option>
                        @foreach ($positions as $id => $position)
                            <option value="{{ $position }}">{{ $position }}</option>
                        @endforeach
                    </select>
                </div>

                @if ($errors->any())
                    <div style="color: red;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label for="document_number">Número de Documento</label>
                    <input type="text" name="document_number" id="document_number">
                </div>

                <div>
                    <label for="name">Nombre Completo</label>
                    <input type="text" name="name" id="name">
                </div>

                <div>
                    <label for="email">Correo Electrónico</label>
                    <input type="email" name="email" id="email">
                </div>

                <div>
                    <label for="phone_number">Número de Teléfono</label>
                    <input type="text" name="phone_number" id="phone_number">
                </div>

                <div>
                    <label for="address">Dirección</label>
                    <input type="text" name="address" id="address">
                </div>

                <div>
                    <label for="start_date">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date">
                </div>

                <div>
                    <label for="end_date">Fecha de Finalización</label>
                    <input type="date" name="end_date" id="end_date">
                </div>

                <div>
                    <label for="id_town">Municipio donde nació</label>
                    <select name="id_town" id="id_town">
                        <option value="">Seleccione un Municipio</option>
                        @foreach ($towns as $id => $town)
                            <option value="{{ $town->id }}">{{ $town->name }}</option>
                        @endforeach
                    </select>
                </div>
            </section>

            {{-- Formulario adicional para instructores --}}
            <section id="form_Instructor" class="ocult form">
                <div>
                    <label for="id_link_type">Tipo de Vinculación</label>
                    <select name="id_link_type" id="id_link_type">
                        <option value="">Seleccione un tipo de vinculación</option>
                        @foreach ($link_types as $id => $link_type)
                            <option value="{{ $link_type->id }}">{{ $link_type->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="id_speciality">Especialidad</label>
                    <select name="id_speciality" id="id_speciality">
                        <option value="">Seleccione la especialidad</option>
                        @foreach ($specialities as $id => $speciality)
                            <option value="{{ $id }}">{{ $speciality->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="id_instructor_status">Estado</label>
                    <select name="id_instructor_status" id="id_instructor_status">
                        <option value="">Seleccione el Estado</option>
                        @foreach ($instructor_status as $id => $status)
                            <option value="{{ $status->id }}">{{ $status->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="assigned_hours">Horas Asignadas</label>
                    <input type="number" name="assigned_hours" id="assigned_hours">
                </div>

                <div>
                    <label for="months_contract">Meses de Contrato</label>
                    <input type="number" name="months_contract" id="months_contract">
                </div>

                <div>
                    <label for="hours_day">Horas por Día</label>
                    <input type="number" name="hours_day" id="hours_day">
                </div>
            </section>

            <x-button type="submit">Enviar</x-button>

            <section>
                @foreach ($days_available as $day)
                    <div>
                        <label for="day_{{ $day->id }}">{{ $day->name }}</label>
                        <input type="checkbox" value="{{ $day->id }}"
                            {{ $day->name !== 'Sábado' && $day->name !== 'Domingo' ? 'checked' : '' }} name="days[]"
                            id="{{ $day->id }}">
                    </div>
                @endforeach
            </section>
        </form>

        {{-- Importar desde archivo Excel --}}
        <div>
            <h5>Si desea registrar varios aprendices al mismo tiempo</h5>
            <form id="excelForm" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" accept=".xlsx, .xls" name="excel_file" id="fileInput" style="display: none">
                <button type="button" id="uploadButton">Subir Excel</button>
            </form>
        </div>

        <script>
            function ShowForm() {
                let positionPerson = document.getElementById("id_position").value;
                document.querySelectorAll(".form").forEach(form => {
                    form.classList.add("ocult");
                });
                if (positionPerson) {
                    document.getElementById("form_" + positionPerson).classList.remove("ocult");
                }
            }

            document.getElementById('uploadButton').addEventListener('click', function() {
                document.getElementById('fileInput').click();
            });

            document.getElementById("fileInput").addEventListener("change", function(event) {
                const file = event.target.files[0];
                if (!file) return;

                const reader = new FileReader();

                reader.onload = function(e) {
                    const data = new Uint8Array(e.target.result);
                    const workbook = XLSX.read(data, {
                        type: "array"
                    });

                    const sheet = workbook.Sheets[workbook.SheetNames[0]];
                    let jsonData = XLSX.utils.sheet_to_json(sheet, {
                        raw: false
                    });

                    jsonData = jsonData.map(row => {
                        if (row.FECHA_INICIO && typeof row.FECHA_INICIO === "string") {
                            row.FECHA_INICIO = formatDate(row.FECHA_INICIO);
                        }
                        if (row.FECHA_FINALIZACION && typeof row.FECHA_FINALIZACION === "string") {
                            row.FECHA_FINALIZACION = formatDate(row.FECHA_FINALIZACION);
                        }
                        return row;
                    });

                    console.log("Enviando a Laravel:", jsonData);

                    fetch("{{ route('entrance.excel.upload') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    "content")
                            },
                            body: JSON.stringify({
                                people: jsonData
                            })
                        })
                        .then(async response => {
                            alert(
                                "Iniciando Importación de datos, por favor no interactuar con la pagina hasta nuevo aviso!");
                            const text = await response.text();
                            console.log("RAW RESPONSE:", text);
                            try {
                                return JSON.parse(text);
                            } catch (error) {
                                throw new Error(
                                    "No se pudo parsear JSON. Laravel devolvió HTML en vez de JSON.");
                            }
                        })
                        .then(data => {
                            console.log("Respuesta de Laravel:", data);
                            alert("Importación completada correctamente!");
                        })
                        .catch(error => {
                            console.error("Error en la importación:", error);
                        });
                };

                reader.readAsArrayBuffer(file);
            });

            function formatDate(fecha) {
                const date = new Date(fecha);
                return date.toISOString().split("T")[0];
            }
        </script>
</x-layout_asistencia>
