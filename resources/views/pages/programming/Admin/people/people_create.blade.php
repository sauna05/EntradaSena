<x-layout>
    <x-slot:title>CAA - Formulario de Registro</x-slot:title>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        /* styles.css */

        /* Mejora general */
body {
    background: #eef1f5;
}

/* Subtítulo elegante */
.caas-subtitle {
    color: #1e3a8a;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 10px;
    margin-bottom: 25px;
    font-size: 1.3rem;
    font-weight: 600;
    text-align: center;
}

/* Estado Activo en verde */
.caas-input-active {
    background-color: #d1fae5;
    color: #065f46;
    font-weight: bold;
    border: 1px solid #34d399;
    text-align: center;
}

/* Contenedor centrado y amplio */
.caas-container {
    max-width: 1000px;
    margin: 50px auto;
    padding: 40px;
    background-color: #fff;
    border-radius: 16px;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
}

/* Ajustes de inputs */
.caas-input, .caas-select {
    background-color: #f1f5f9;
    border: 1px solid #cbd5e1;
}
.caas-input:focus, .caas-select:focus {
    background-color: #fff;
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);
}

.caas-form-container {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f8fafc;
    margin: 0;
    padding: 0;
    color: #334155;
}

.caas-header {
    text-align: center;
     color: #28a745;
    margin-top: 20px;
    font-size: 2rem;
    font-weight: 600;
}

.caas-container {
    max-width: 90%;
    margin: 40px auto;
    padding: 30px;
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.caas-form {
    max-width: 800px;
    margin: 20px auto;
    padding: 30px;
    background-color: white;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
}

.caas-form-section {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    margin-bottom: 25px;
}

.caas-form-group {
    flex: 1 1 45%;
    display: flex;
    flex-direction: column;
}

.caas-label {
    margin-bottom: 8px;
    font-weight: 600;
    color: #374151;
    font-size: 0.95rem;
}

.caas-input, .caas-select {
    padding: 12px 15px;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    background-color: #f9fafb;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.caas-input:focus, .caas-select:focus {
    border-color: #3b82f6;
    background-color: #fff;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    outline: none;
}

.caas-select {
    cursor: pointer;
}

.caas-hidden {
    display: none;
}

.caas-button {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: white;
    padding: 14px 28px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
    margin-top: 20px;
    width: 100%;
}

.caas-button:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(30, 64, 175, 0.3);
}

.caas-days-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
    gap: 12px;
    margin-top: 20px;
    padding: 20px;
    background-color: #f8fafc;
    border-radius: 8px;
    border: 1px solid #e5e7eb;
}

.caas-day-checkbox {
    display: flex;
    align-items: center;
    gap: 8px;
}

.caas-excel-section {
    background: linear-gradient(135deg, #f8fafc, #e2e8f0);
    max-width: 800px;
    margin: 40px auto;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    text-align: center;
    border: 1px solid #e2e8f0;
}

.caas-excel-title {
    color: #1e40af;
    margin-bottom: 20px;
    font-size: 1.4rem;
    font-weight: 600;
}

.caas-excel-button {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    padding: 14px 28px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 1rem;
    font-weight: 600;
    border: none;
    transition: all 0.3s ease;
    display: inline-block;
    margin-bottom: 20px;
}

.caas-excel-button:hover {
    background: linear-gradient(135deg, #059669, #047857);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3);
}

.caas-progress-container {
    display: none;
    margin-top: 20px;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.caas-progress-bar {
    height: 20px;
    width: 0%;
    background: linear-gradient(90deg, #10b981, #34d399);
    border-radius: 10px;
    transition: width 0.4s ease;
}

.caas-progress-text {
    margin-top: 10px;
    font-weight: 600;
    color: #374151;
}

.caas-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 9999;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    color: white;
    font-family: 'Segoe UI';
    text-align: center;
}

.caas-overlay-content {
    background: linear-gradient(135deg, #1eaf6b, #1d4ed8);
    padding: 30px 50px;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

.caas-alert {
    padding: 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid transparent;
}

.caas-alert-danger {
    background-color: #fee2e2;
    color: #b91c1c;
    border-color: #fecaca;
}

.caas-alert-success {
    background-color: #d1fae5;
    color: #065f46;
    border-color: #a7f3d0;
}

@media (max-width: 768px) {
    .caas-form-group {
        flex: 1 1 100%;
    }

    .caas-container {
        padding: 20px;
    }

    .caas-form {
        padding: 20px;
    }

    .caas-days-grid {
        grid-template-columns: repeat(auto-fit, minmax(110px, 1fr));
    }

    .caas-header {
        font-size: 1.6rem;
    }
}
    </style>

    <!-- Librerías -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="caas-overlay" id="overlay">
        <div class="caas-overlay-content">
            <h2 style="margin: 0;">🔄 Importando datos...</h2>
            <p style="margin-top: 10px;">Por favor, no interactúe con la página hasta que se complete la operación.</p>
        </div>
    </div>

    <div class="caas-container">
        <h1 class="caas-header">Formulario de Registro Personas</h1>

        <form action="{{ route('entrance.people.store') }}" method="POST" class="caas-form">
            @csrf

            <div class="caas-form-section">
                <div class="caas-form-group">
                    <label for="id_position" class="caas-label">Cargo</label>
                    <select name="id_position" id="id_position" class="caas-select" onchange="ShowForm()">
                        <option value="">Seleccione un Cargo</option>
                        @foreach ($positions as $id => $position)
                           <option value="{{ $id }}" data-nombre="{{ $position }}">{{ $position }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: '¡Acción exitosa!',
                        text: '{{ session('success') }}',
                        confirmButtonColor: '#28a745'
                    });
                </script>
                @endif

                @if (session('error'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error al registrar',
                        text: '{{ session('error') }}',
                        confirmButtonColor: '#d33'
                    });
                </script>
                @endif

                @if ($errors->any())
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Errores de validación',
                        html: '{!! implode("<br>", $errors->all()) !!}',
                        confirmButtonColor: '#d33'
                    });
                </script>
            @endif

            <div class="caas-form-section">
                <div class="caas-form-group">
                    <label for="document_number" class="caas-label">Número de Documento</label>
                    <input type="number" name="document_number" id="document_number" class="caas-input">
                </div>

                <div class="caas-form-group">
                    <label for="name" class="caas-label">Nombre Completo</label>
                    <input type="text" name="name" id="name" class="caas-input">
                </div>

                <div class="caas-form-group">
                    <label for="email" class="caas-label">Correo Electrónico</label>
                    <input type="email" name="email" id="email" class="caas-input">
                </div>

                <div class="caas-form-group">
                    <label for="phone_number" class="caas-label">Número de Teléfono</label>
                    <input type="text" name="phone_number" id="phone_number" class="caas-input">
                </div>

                <div class="caas-form-group">
                    <label for="address" class="caas-label">Dirección</label>
                    <input type="text" name="address" id="address" class="caas-input">
                </div>

                <div class="caas-form-group">
                    <label for="start_date" class="caas-label">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date" class="caas-input">
                </div>

                <div class="caas-form-group">
                    <label for="end_date" class="caas-label">Fecha de Finalización</label>
                    <input type="date" name="end_date" id="end_date" class="caas-input">
                </div>

                <div class="caas-form-group">
                    <label for="id_town" class="caas-label">Municipio Donde impartirá Formación</label>
                    <select name="id_town" id="id_town" class="caas-select">
                        <option value="">Seleccione un Municipio</option>
                        @foreach ($towns as $id => $town)
                            <option value="{{ $town->id }}">{{ $town->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- ... resto del código ... -->

            <!-- Formulario de Instructor (oculto inicialmente) -->
            <div id="form_Instructor" class="caas-hidden">
                <h3 class="caas-subtitle">
                    Información del Instructor
                </h3>

                <div class="caas-form-section">
                    <div class="caas-form-group">
                        <label for="id_link_type" class="caas-label">Tipo de Vinculación</label>
                        <select name="id_link_type" id="id_link_type" class="caas-select">
                            <option value="">Seleccione Tipo vinculación</option>
                            @foreach ($link_types as $id => $link_type)
                                <option value="{{ $link_type->id }}" {{ old('id_link_type') == $link_type->id ? 'selected' : '' }}>
                                    {{ $link_type->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="caas-form-group">
                        <label for="id_speciality" class="caas-label">Especialidad</label>
                        <select name="id_speciality" id="id_speciality" class="caas-select">
                            <option value="">Seleccione Especialidad</option>
                            @foreach ($specialities as $id => $speciality)
                                <option value="{{ $speciality->id }}" {{ old('id_speciality') == $speciality->id ? 'selected' : '' }}>
                                    {{ $speciality->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Estado fijo en Activo --}}
                    <div class="caas-form-group">
                        <label class="caas-label">Estado</label>
                        <input type="text"
                            value="Activo"
                            class="caas-input caas-input-active"
                            readonly
                            style="cursor: not-allowed;">
                        <input type="hidden" name="id_instructor_status" value="{{ $instructor_status->firstWhere('name','Activo')->id ?? '' }}">
                    </div>

                    <div class="caas-form-group">
                        <label for="assigned_hours" class="caas-label">Horas Asignadas</label>
                        <input type="number" name="assigned_hours" id="assigned_hours" class="caas-input" value="{{ old('assigned_hours') }}">
                    </div>

                    <div class="caas-form-group">
                        <label for="hours_day" class="caas-label">Horas por Día</label>
                        <input type="number" name="hours_day" id="hours_day" class="caas-input" value="{{ old('hours_day') }}">
                    </div>
                </div>
            </div>

<!-- ... resto del código ... -->


            <button type="submit" class="caas-button">Enviar Formulario</button>

            <!-- Días de disponibilidad -->
            <div style="margin-top: 30px;">
                <h3 style="color: #1e40af; margin-bottom: 15px;">Días que puede asistir al centro:</h3>
                <div class="caas-days-grid">
                    @foreach ($days_available as $day)
                        <div class="caas-day-checkbox">
                            <input type="checkbox" value="{{ $day->id }}"
                                {{ $day->name !== 'Sábado' && $day->name !== 'Domingo' ? 'checked' : '' }}
                                name="days[]" id="day_{{ $day->id }}">
                            <label for="day_{{ $day->id }}">{{ $day->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        </form>

        <!-- Sección de importación desde Excel -->
        <div class="caas-excel-section">
            <form id="excelForm" method="POST" enctype="multipart/form-data">
                @csrf
                <h3 class="caas-excel-title">📥 Importar Aprendices desde archivo Excel</h3>
                <label for="fileInput" class="caas-excel-button">📁 Seleccionar archivo Excel</label>
                <input type="file" accept=".xlsx, .xls" name="excel_file" id="fileInput" style="display: none">

                <div class="caas-progress-container" id="progressContainer">
                    <div style="background-color: #e5e7eb; border-radius: 10px; height: 20px;">
                        <div class="caas-progress-bar" id="progressBar"></div>
                    </div>
                    <p class="caas-progress-text" id="progressText">0%</p>
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
                formInstructor.classList.remove("caas-hidden");
            } else {
                formInstructor.classList.add("caas-hidden");
            }
        }

        // Mostrar campos de instructor si hay errores en esos campos
        document.addEventListener("DOMContentLoaded", function() {
            const errors = @json($errors->keys());
            const instructorFields = ['id_link_type', 'id_speciality', 'id_instructor_status',
                                    'assigned_hours', 'months_contract', 'hours_day'];

            if (errors.some(error => instructorFields.includes(error))) {
                document.getElementById("form_Instructor").classList.remove("caas-hidden");
            }

            // Mostrar el formulario si ya está seleccionado al cargar la página
            ShowForm();
        });

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

                // Mostrar overlay y progreso
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

                    setTimeout(() => {
                        document.getElementById("overlay").style.display = "none";
                        if (data.success) {
                            alert("✅ " + data.message);
                            window.location.reload();
                        } else {
                            alert("❌ " + (data.message || "Error durante la importación"));
                        }
                    }, 500);
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
