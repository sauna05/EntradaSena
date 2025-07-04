<x-layout>
   <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Crear Ficha</x-slot:title>
    <link rel="stylesheet" href="{{ asset('css/pages/Programming/style_cohort.css') }}">

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

        <button class="btn" onclick="document.getElementById('modal').style.display='block'">
            Registrar ficha
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
                    <label for="">Cantidad Matriculados</label>
                    <input type="number" name="enrolled_quantity" required>

                    <div class="form-buttons">
                        <button type="submit" class="btn" style="background-color: green">Guardar</button>
                        <button type="button" class="btn cancel" onclick="document.getElementById('modal').style.display='none'">
                        Cancelar</button>

                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de fichas -->
       <!-- Tabla de fichas -->
       <table>
        <thead>
            <tr>
                <th>Ficha</th>
                <th>Programa</th>
                <th>Jornada</th>
                <th>Municipio</th>
                <th>Hrs etapa lectiva</th>
                <th>Hrs programadas</th>
                <th>Hrs cumplidas</th>
                <th>Avance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cohorts as $cohort)
                <tr>
                    <td>{{ $cohort->number_cohort }}</td>
                    <td>{{ $cohort->program->name ?? 'N/A' }}</td>
                    <td>{{ $cohort->cohortime->name ?? 'N/A' }}</td>
                    <td>{{ $cohort->town->name ?? 'N/A' }}</td>
                    <td>{{ $cohort->hours_school_stage }} hrs</td>
                    <td>{{ $cohort->horas_programadas }} hrs</td>
                    <td>{{ $cohort->horas_cumplidas }} hrs</td>
                    <td>
                        @php
                            $color = match(true) {
                                $cohort->porcentaje_avance >= 100 => 'success',
                                $cohort->porcentaje_avance >= 75 => 'warning',
                                default => 'danger'
                            };
                        @endphp
                        <div class="progress">
                            <div class="progress-bar bg-{{ $color }}" 
                                 style="width: {{ min($cohort->porcentaje_avance, 100) }}%">
                                {{ $cohort->porcentaje_avance }}%
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>



</div>




</x-layout>
