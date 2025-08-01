
<x-layout>
    {{-- Librerías y meta --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .h-1 {
            text-align: center;
            color: #34516b;
            margin-top: 20px;
        }

        .container {
            max-width: 90%;
            margin: 40px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
        }

        form.form-create-people {

            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        section > div {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }
        select{
              cursor: pointer;
        }

        input,
        select {

            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: border 0.3s ease;
        }

        input:focus,
        select:focus {
            border-color: #1b5e20;
            background-color: #fff;
        }

        .ocult {
            display: none;
        }

        .btn-register,
        .excel-button {
            background-color: #1b5e20;
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            border: none;
        }

        .excel-button:hover {
            background-color: #2e7d32;
        }

        .days-checkboxes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }


        .excel-upload-section {
            background-color: #fff;
            max-width: 800px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
            text-align: center;
        }

        #progressContainer {
            display: none;
            margin-top: 20px;
        }

        #progressBar {
        height: 20px;
        width: 0%;
        background-color: #2e7d32;
        border-radius: 10px;
        transition: width 0.4s ease;
    }


        @media (max-width: 768px) {
            section > div {
                flex: 1 1 100%;
            }
        }
    </style>

    <x-slot:title>CAA</x-slot:title>
    <div id="overlay" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
     background-color: rgba(0, 0, 0, 0.5); z-index: 9999; justify-content: center; align-items: center; flex-direction: column; color: white; font-family: 'Segoe UI'; text-align: center;">
    <div style="background: #1b5e20; padding: 20px 40px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.3);">
        <h2 style="margin: 0;">🔄 Importando datos...</h2>
        <p style="margin-top: 10px;">Por favor, no interactúe con la página hasta que se complete la operación.</p>
    </div>
</div>

    <div class="container">
        <h1 class="h-1">Formulario de Registro Personas</h1>
        <form action="{{ route('entrance.people.store') }}" method="POST" class="form-create-people">
            @csrf
            <section>
                <div>
                    <label for="id_position">Cargo</label>
                    <select name="id_position" id="id_position" onchange="ShowForm()">
                        <option value="">Seleccione un Cargo</option>
                        @foreach ($positions as $id => $position)
                           <option value="{{ $id }}" data-nombre="{{ $position }}">{{ $position }}</option>
                        @endforeach
                    </select>
                </div>

               {{-- Mensajes de error --}}
            @if($errors->any())
            <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                <h4 style="margin-top: 0; margin-bottom: 10px;">¡Hay errores en el formulario!</h4>
                <ul style="margin-bottom: 0;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                </div>
            @endif

                {{-- Mensajes de éxito --}}
                @if(session('succes'))
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    {{ session('succes') }}
                </div>
                @endif

                @if(session('error'))
                <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #f5c6cb;">
                    {{ session('error') }}
                </div>
                @endif

                @if(session('succes'))
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #c3e6cb;">
                    {{ session('succes') }}
                </div>
            @endif

                <div><label for="document_number">Número de Documento</label><input type="number" name="document_number" id="document_number"></div>
                <div><label for="name">Nombre Completo</label><input type="text" name="name" id="name"></div>
                <div><label for="email">Correo Electrónico</label><input type="email" name="email" id="email"></div>
                <div><label for="phone_number">Número de Teléfono</label><input type="text" name="phone_number" id="phone_number"></div>
                <div><label for="address">Dirección</label><input type="text" name="address" id="address"></div>
                <div><label for="start_date">Fecha de Inicio</label><input type="date" name="start_date" id="start_date"></div>
                <div><label for="end_date">Fecha de Finalización</label><input type="date" name="end_date" id="end_date"></div>
                <div>
                    <label for="id_town">Municipio Donde inpartira Formación</label>
                    <select name="id_town" id="id_town">
                        <option value="">Seleccione un Municipio</option>
                        @foreach ($towns as $id => $town)
                            <option value="{{ $town->id }}">{{ $town->name }}</option>
                        @endforeach
                    </select>
                </div>
            </section>

            <section id="form_Instructor" class="ocult form">
                <div><label for="id_link_type">Tipo de Vinculación</label>
                    <select name="id_link_type" id="id_link_type">
                        <option value="">Selecione Tipo vinculacion</option>
                        @foreach ($link_types as $id => $link_type)
                            <option value="{{ $link_type->id }}" {{ old('id_link_type') == $link_type->id ? 'selected' : '' }}>
                                {{ $link_type->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_link_type')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div><label for="id_speciality">Especialidad</label>
                    <select name="id_speciality" id="id_speciality">
                        <option value="">Selecione Especialidad</option>
                        @foreach ($specialities as $id => $speciality)
                            <option value="{{ $speciality->id }}" {{ old('id_speciality') == $speciality->id ? 'selected' : '' }}>
                                {{ $speciality->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_speciality')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div><label for="id_instructor_status">Estado</label>
                    <select name="id_instructor_status" id="id_instructor_status">
                        @foreach ($instructor_status as $id => $status)
                            <option value="{{ $status->id }}" {{ old('id_instructor_status') == $status->id ? 'selected' : '' }}>
                                {{ $status->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_instructor_status')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                <div><label for="assigned_hours">Horas Asignadas</label>
                    <input type="number" name="assigned_hours" id="assigned_hours" value="{{ old('assigned_hours') }}">
                    @error('assigned_hours')<span class="error-message">{{ $message }}</span>@enderror
                </div>

                {{-- <div><label for="months_contract">Meses de Contrato</label>
                    <input type="number" name="months_contract" id="months_contract" value="{{ old('months_contract') }}">
                    @error('months_contract')<span class="error-message">{{ $message }}</span>@enderror
                </div> --}}

                <div><label for="hours_day">Horas por Día</label>
                    <input type="number" name="hours_day" id="hours_day" value="{{ old('hours_day') }}">
                    @error('hours_day')<span class="error-message">{{ $message }}</span>@enderror
                </div>
            </section>

            <x-button class="btn-register" type="submit">Enviar</x-button>

            <section>
                <p style="font-weight: 600; margin-bottom: 10px;">Días que puede asistir al centro:</p>
                <div class="days-checkboxes">
                    @foreach ($days_available as $day)
                        <div>
                            <input type="checkbox" value="{{ $day->id }}" {{ $day->name !== 'Sábado' && $day->name !== 'Domingo' ? 'checked' : '' }} name="days[]" id="day_{{ $day->id }}">
                            <label for="day_{{ $day->id }}">{{ $day->name }}</label>
                        </div>
                    @endforeach
                </div>
            </section>
        </form>

        {{-- Subida desde Excel --}}
        <div class="excel-upload-section">
            <form id="excelForm" method="POST" enctype="multipart/form-data">
                @csrf
                <h3 class="excel-title">📥 Importar Aprendices desde archivo Excel</h3>
                <label for="fileInput" class="excel-button">📁 Seleccionar archivo Excel</label>
                <input type="file" accept=".xlsx, .xls" name="excel_file" id="fileInput" style="display: none">
                <div id="progressContainer">
                    <div style="background-color: #e0e0e0; border-radius: 10px;">
                        <div id="progressBar"></div>
                    </div>
                    <p id="progressText">0%</p>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Función para mostrar u ocultar el formulario de Instructor
        function ShowForm() {
            const select = document.getElementById("id_position");
            const selectedOption = select.options[select.selectedIndex];
            const nombreCargo = selectedOption.getAttribute("data-nombre");

            const formInstructor = document.getElementById("form_Instructor");

            if (nombreCargo && nombreCargo.toLowerCase().includes("instructor")) {
                formInstructor.classList.remove("ocult");
            } else {
                formInstructor.classList.add("ocult");
            }
        }
        // Mostrar campos de instructor si hay errores en esos campos
        document.addEventListener("DOMContentLoaded", function() {
            const errors = @json($errors->keys());
            const instructorFields = ['id_link_type', 'id_speciality', 'id_instructor_status',
                                    'assigned_hours', 'months_contract', 'hours_day'];

            if (errors.some(error => instructorFields.includes(error))) {
                document.getElementById("form_Instructor").classList.remove("ocult");
            }
        });

        // Mostrar el formulario si ya está seleccionado al cargar la página
        document.addEventListener("DOMContentLoaded", ShowForm);

        // Manejador para el archivo Excel
        document.getElementById("fileInput").addEventListener("change", function(event) {
            const file = event.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function(e) {
                const data = new Uint8Array(e.target.result);
                const workbook = XLSX.read(data, { type: "array" });
                const sheet = workbook.Sheets[workbook.SheetNames[0]];
                let jsonData = XLSX.utils.sheet_to_json(sheet, { raw: false });

                jsonData = jsonData.map(row => {
                    row.FECHA_INICIO = row.FECHA_INICIO ? new Date(row.FECHA_INICIO).toISOString().split("T")[0] : null;
                    row.FECHA_FINALIZACION = row.FECHA_FINALIZACION ? new Date(row.FECHA_FINALIZACION).toISOString().split("T")[0] : null;
                    return row;
                });

                // Mostrar overlay
                document.getElementById("overlay").style.display = "flex";
                document.getElementById("progressContainer").style.display = "block";
                document.getElementById("progressBar").style.width = "0%";
                document.getElementById("progressText").innerText = "0%";

                // Simulación de barra de progreso
                let progress = 0;
                const interval = setInterval(() => {
                    if (progress < 90) {
                        progress += 1;
                        document.getElementById("progressBar").style.width = `${progress}%`;
                        document.getElementById("progressText").innerText = `${progress}%`;
                    }
                }, 100);

                // Enviar datos al backend
                fetch("{{ route('entrance.excel.upload') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ people: jsonData })
                })
                .then(response => response.json())
                .then(data => {
                    clearInterval(interval);
                    document.getElementById("progressBar").style.width = "100%";
                    document.getElementById("progressText").innerText = "100%";

                    document.getElementById("overlay").style.display = "none";
                    alert("✅ Importación completada correctamente");
                    console.log("Respuesta:", data);
                })
                .catch(error => {
                    clearInterval(interval);
                    document.getElementById("progressText").innerText = "❌ Error";
                    document.getElementById("overlay").style.display = "none";
                    console.error("Error:", error);
                    alert("❌ Error durante la importación");
                });
            };

            reader.readAsArrayBuffer(file);
        });
    </script>

</x-layout>
