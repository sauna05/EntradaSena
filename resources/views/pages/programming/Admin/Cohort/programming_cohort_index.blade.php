<x-layout>
   <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Crear Programa</x-slot:title>
    <x-programming_navbar></x-programming_navbar>


    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const startSchoolInput = document.querySelector('input[name="start_date_school_stage"]');
        const endSchoolInput = document.querySelector('input[name="end_date_school_stage"]');
        const startPracticeInput = document.querySelector('input[name="start_date_practical_stage"]');
        const endPracticeInput = document.querySelector('input[name="end_date_practical_stage"]');

        // Cuando se elige una fecha de inicio de etapa escolar
        startSchoolInput.addEventListener('change', function () {
            if (this.value) {
                // La fecha mínima para fin de etapa escolar será 15 días después
                const startDate = new Date(this.value);
                const minEndDate = new Date(startDate);
                minEndDate.setDate(startDate.getDate() + 15);

                endSchoolInput.min = minEndDate.toISOString().split('T')[0];

                // La fecha mínima de inicio de práctica será después de la nueva fecha de fin escolar
                endSchoolInput.addEventListener('change', function () {
                    if (this.value) {
                        const endSchoolDate = new Date(this.value);
                        const minPracticeStart = new Date(endSchoolDate);
                        minPracticeStart.setDate(endSchoolDate.getDate() + 1);
                        startPracticeInput.min = minPracticeStart.toISOString().split('T')[0];
                    }
                });
            }
        });

        // Cuando se elige una fecha de inicio de etapa práctica
        startPracticeInput.addEventListener('change', function () {
            if (this.value) {
                // La fecha mínima de fin de práctica debe ser 15 días después
                const startPracticeDate = new Date(this.value);
                const minEndPractice = new Date(startPracticeDate);
                minEndPractice.setDate(startPracticeDate.getDate() + 15);
                endPracticeInput.min = minEndPractice.toISOString().split('T')[0];
            }
        });
    });
</script>


  <style>
    .container {
        max-width: 1100px;
        margin: auto;
        padding: 20px;
    }



    .btn:hover {
        background-color: #00b351;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.6);
    }

    .modal-content {
    background-color: #fff;
    margin: 5% auto;
    padding: 20px;
    border: 1px solid #ccc; /* borde clásico */
    border-radius: 4px; /* menos redondeado */
    width: 35%;
    max-width: 600px;
    min-width: 300px;
    max-height: 90vh;
    overflow-y: auto;
    position: relative;
    box-shadow: none; /* sin sombras */
}


    .close {
        color: #aaa;
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 28px;
        cursor: pointer;
    }

    .close:hover {
        color: red;
    }

    form label {
        display: block;
        margin-top: 8px;
        font-weight: 600;
        font-size: 14px;
    }

  form input,
    form select {
        width: 50%;
        min-width: 200px;
    }

    .form-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 16px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
        background-color: #fff;
    }

    table th,
    table td {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 14px;
    }

    table th {
        background-color: #eee;
    }

    .message {
        padding: 8px;
        margin-bottom: 12px;
        border-radius: 4px;
        font-size: 14px;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>


    <div class="container">
        <h2>Registro de Fichas</h2>

        @if (session('success'))
            <div class="message success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="message error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Botón para mostrar el modal -->
        <button class="btn" onclick="document.getElementById('modal').style.display='block'">
            Registrar nueva ficha
        </button>

        <!-- Modal -->
        <div id="modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="document.getElementById('modal').style.display='none'">&times;</span>
                <h3>Registrar ficha</h3>

                <form method="POST" action="{{ route('programming.Register') }}">
                    @csrf

                    <label>Número de ficha</label>
                    <input type="number" name="number_cohort" required>

                    <label>Programa</label>
                    <select name="id_program" required>
                        <option value="">Seleccione programa</option>
                        @foreach ($programs as $pro)
                            <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                        @endforeach
                    </select>

                    <label>Jornada</label>
                    <select name="id_time" required>
                        <option value="">Seleccione jornada</option>
                        @foreach ($cohortimes as $tms)
                            <option value="{{ $tms->id }}">{{ $tms->name }}</option>
                        @endforeach
                    </select>

                    <label>Municipio</label>
                    <select name="id_town" required>
                        <option value="">Seleccione municipio</option>
                        @foreach ($towns as $tn)
                            <option value="{{ $tn->id }}">{{ $tn->name }}</option>
                        @endforeach
                    </select>

                    <label>Horas etapa escolar</label>
                    <input type="number" name="hours_school_stage" required min="0">

                    <label>Horas etapa práctica</label>
                    <input type="number" name="hours_practical_stage" required min="0">

                    <label>Inicio etapa escolar</label>
                    <input type="date" name="start_date_school_stage" required>

                    <label>Fin etapa escolar</label>
                    <input type="date" name="end_date_school_stage" required>

                    <label>Inicio etapa práctica</label>
                    <input type="date" name="start_date_practical_stage" required>

                    <label>Fin etapa práctica</label>
                    <input type="date" name="end_date_practical_stage" required>

                    <div class="form-buttons">
                        <button type="submit" class="btn" style="background-color: green">Guardar</button>
                        <button type="button" class="btn" style="background-color: gray"
                            onclick="document.getElementById('modal').style.display='none'">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de fichas -->
        <table>
            <thead>
                <tr>
                    <th>Ficha</th>
                    <th>Programa</th>
                    <th>Jornada</th>
                    <th>Municipio</th>
                    <th>Etapa Escolar</th>
                    <th>Etapa Práctica</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cohorts as $cohort)
                    <tr>
                        <td>{{ $cohort->number_cohort }}</td>
                        <td>{{ $cohort->program->name ?? 'N/A' }}</td>
                        <td>{{ $cohort->time->name ?? 'N/A' }}</td>
                        <td>{{ $cohort->town->name ?? 'N/A' }}</td>
                        <td>{{ $cohort->start_date_school_stage }} a {{ $cohort->end_date_school_stage }}</td>
                        <td>{{ $cohort->start_date_practical_stage }} a {{ $cohort->end_date_practical_stage }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No hay fichas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>



</div>


    <div class="container" style="max-width: 700px; margin: auto; padding: 20px;">
        <h2 style="margin-bottom: 20px;">Registrar Nuevo Programa</h2>

        <form action="#" method="POST">
            <!-- Nombre del programa -->
            <label for="name" style="font-weight: bold;">Nombre del Programa:</label><br>
            <input type="text" id="name" name="name" required style="width: 100%; padding: 8px; margin-bottom: 15px;">

            <!-- Competencias -->
            <label for="competencias" style="font-weight: bold;">Seleccionar Competencias:</label><br>
            <select name="competencias[]" id="competencias" multiple required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                <option value="1">Competencia en Programación</option>
                <option value="2">Competencia en Redes</option>
                <option value="3">Competencia en Diseño Web</option>
                <option value="4">Competencia en Bases de Datos</option>
            </select>

            <button type="submit" style="background-color: #2a9d8f; color: white; padding: 10px 20px; border: none; cursor: pointer;">
                Registrar Programa
            </button>
        </form>

        <hr style="margin: 40px 0;">

        <h2 style="margin-bottom: 20px;">Asignar Competencias a Instructores</h2>

        <form action="#" method="POST">
            <!-- Instructor -->
            <label for="instructor" style="font-weight: bold;">Instructor:</label><br>
            <select name="instructor_id" id="instructor" required style="width: 100%; padding: 8px; margin-bottom: 15px;">
                <option value="">-- Selecciona un instructor --</option>
                <option value="1">Juan Pérez</option>
                <option value="2">María Gómez</option>
                <option value="3">Carlos Rodríguez</option>
            </select>

            <!-- Competencias -->
            <label for="competenciasInstructor" style="font-weight: bold;">Competencias que puede impartir:</label><br>
            <select name="competencias[]" id="competenciasInstructor" multiple required style="width: 100%; padding: 8px; margin-bottom: 20px;">
                <option value="1">Competencia en Programación</option>
                <option value="2">Competencia en Redes</option>
                <option value="3">Competencia en Diseño Web</option>
                <option value="4">Competencia en Bases de Datos</option>
            </select>

            <button type="submit" style="background-color: #264653; color: white; padding: 10px 20px; border: none; cursor: pointer;">
                Asignar Competencias
            </button>
        </form>
    </div>


    <div class="container mx-auto max-w-3xl p-6 bg-white shadow-lg rounded-lg mt-6">
        <h2 class="text-2xl font-bold mb-6">Programar Instructor</h2>

        <form action="#" method="POST" id="programarInstructorForm">
            @csrf

            <!-- Instructor -->
            <div class="mb-4">
                <label for="instructor" class="block font-semibold">Instructor</label>
                <select name="instructor_id" id="instructor" required class="w-full border px-3 py-2 rounded">
                    <option value="">-- Selecciona un instructor --</option>
                    <option value="1">Juan Pérez (Especialidad: Programación)</option>
                    <option value="2">Laura Gómez (Especialidad: Redes)</option>
                    <option value="3">Carlos Torres (Especialidad: Bases de Datos)</option>
                </select>
            </div>

            <!-- Ficha -->
            <div class="mb-4">
                <label for="ficha" class="block font-semibold">Ficha</label>
                <select name="ficha_id" id="ficha" required class="w-full border px-3 py-2 rounded">
                    <option value="">-- Selecciona una ficha --</option>
                    <option value="1001">259384 - ADSO (Etapa Productiva) - 1200h</option>
                    <option value="1002">265410 - Sistemas (Etapa Lectiva) - 800h</option>
                </select>
            </div>

            <!-- Competencia (solo muestra las de la especialidad) -->
            <div class="mb-4">
                <label for="competencia" class="block font-semibold">Competencia Asignada</label>
                <select name="competencia_id" id="competencia" required class="w-full border px-3 py-2 rounded">
                    <option value="">-- Selecciona una competencia --</option>
                    <option value="1">Desarrollar aplicaciones web (120h)</option>
                    <option value="2">Implementar bases de datos (100h)</option>
                    <option value="3">Configurar redes LAN (80h)</option>
                </select>
            </div>

            <!-- Ambiente -->
            <div class="mb-4">
                <label for="ambiente" class="block font-semibold">Ambiente</label>
                <select name="ambiente_id" id="ambiente" required class="w-full border px-3 py-2 rounded">
                    <option value="">-- Selecciona un ambiente --</option>
                    <option value="1">Ambiente 401 - Laboratorio de Software</option>
                    <option value="2">Ambiente 203 - Redes</option>
                </select>
            </div>

            <!-- Horas diarias -->
            <div class="mb-4">
                <label for="horas_dia" class="block font-semibold">Horas Diarias</label>
                <input type="number" name="horas_dia" id="horas_dia" min="1" max="8" required class="w-full border px-3 py-2 rounded">
            </div>

            <!-- Rango horario -->
            <div class="mb-4">
                <label for="rango" class="block font-semibold">Rango Horario</label>
                <div class="flex gap-4">
                    <input type="time" name="hora_inicio" required class="border px-3 py-2 rounded">
                    <span class="self-center">a</span>
                    <input type="time" name="hora_fin" required class="border px-3 py-2 rounded">
                </div>
            </div>

            <!-- Días de la semana -->
            <div class="mb-4">
                <label class="block font-semibold mb-2">Días de la semana</label>
                <div class="grid grid-cols-3 gap-2">
                    <label><input type="checkbox" name="dias[]" value="Lunes"> Lunes</label>
                    <label><input type="checkbox" name="dias[]" value="Martes"> Martes</label>
                    <label><input type="checkbox" name="dias[]" value="Miércoles"> Miércoles</label>
                    <label><input type="checkbox" name="dias[]" value="Jueves"> Jueves</label>
                    <label><input type="checkbox" name="dias[]" value="Viernes"> Viernes</label>
                </div>
            </div>

            <!-- Botón de enviar -->
            <div class="mt-6 text-right">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    Programar Instructor
                </button>
            </div>
        </form>
    </div>



</x-layout>
