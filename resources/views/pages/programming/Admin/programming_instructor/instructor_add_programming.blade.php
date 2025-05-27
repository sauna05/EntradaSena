<x-layout>
    <x-slot:title>Programación de Instructores</x-slot:title>
    <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Programación de Instructores</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 950px;
      margin: 40px auto;
      background: #fff;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      border-radius: 10px;
    }
    h2 {
      color: #2c3e50;
    }
    label {
      font-weight: bold;
      margin-top: 15px;
      display: block;
    }
    select, input[type="time"], input[type="number"], input[type="date"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    .day-checkboxes {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
      margin-top: 10px;
    }
    .day-checkboxes label {
      font-weight: normal;
    }
    .submit-btn {
      background-color: #3498db;
      color: white;
      padding: 12px 20px;
      margin-top: 25px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-size: 16px;
    }
    .submit-btn:hover {
      background-color: #2980b9;
    }
    .two-cols {
      display: flex;
      gap: 20px;
    }
    .two-cols > div {
      flex: 1;
    }
    .alert-success{
      width: 500px;
      background-color: green;
      color: white;
    }
    .alert-danger{
      width: 500px;
      background-color: red;
      color: white;
    }

  </style>

    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-danger">
            {{ session('error') }}
        </div>
    @endif

</head>
<body>
  <div class="container">
    <h2>Programación de Instructores</h2>

    <form action="{{ route('programming.register_programming_instructor_store') }}" method="POST">
      @csrf

      <label for="instructor">Instructor:</label>
      <select id="instructor" name="instructor_id">
        <option value="">Seleccione un instructor</option>
        @foreach ($instructors as $instructor)
          <option value="{{ $instructor->id }}">{{ $instructor->person->name }}</option>
        @endforeach
      </select>

      <label for="ficha">Ficha:</label>
      <select id="ficha" name="ficha_id">
        <option value="">Selecione la ficha</option>
        @foreach ($cohorts as $ficha)
          <option value="{{ $ficha->id }}">{{ $ficha->number_cohort }}</option>
        @endforeach
      </select>

      <label for="competencia">Competencia:</label>
      <select id="competencia" name="competencia_id" disabled>
        <option value="">Seleccione un instructor primero</option>
      </select>

      <label for="ambiente">Ambiente:</label>
      <select id="ambiente" name="ambiente_id">
        <option value="">Selecione Ambiente</option>
        @foreach ($ambientes as $ambiente)
          <option value="{{ $ambiente->id }}">{{ $ambiente->name }}</option>
        @endforeach
      </select>

      <div class="two-cols">
        <div>
          <label for="fecha_inicio">Fecha Inicio:</label>
          <input type="date" id="fecha_inicio" name="fecha_inicio" />
        </div>
        <div>
          <label for="fecha_fin">Fecha Fin:</label>
          <input type="date" id="fecha_fin" name="fecha_fin" />
        </div>
      </div>

      <label>Horario:</label>
      <input type="time" name="hora_inicio" /> a <input type="time" name="hora_fin" />

    <label>Días de la semana:</label>
    <div class="day-checkboxes">
        @php
            $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
        @endphp
        @foreach ($dias as $dia)
            <label>
                <input type="checkbox" name="dias[]" value="{{ $dia }}"> {{ $dia }}
            </label>
        @endforeach
    </div>


      <div class="two-cols">
        <div>
          <label for="horas_dia">Horas Diarias:</label>
          <input type="number" id="horas_dia" name="horas_dia" min="1" max="8" />
        </div>
        <div>
          <label for="total_horas">Total de Horas de la Competencia:</label>
          <input type="number" id="total_horas" name="total_horas" value="40" />
        </div>
      </div>

      <button type="submit" class="submit-btn">Guardar Programación</button>
    </form>
  </div>
</body>
</html>
{{-- ... (resto de tu vista) ... --}}

<script>
    // Mapea instructor_id => [competencia_id, ...]
    const competenciasPorInstructor = @json(
        $instructors->mapWithKeys(function($instructor) {
            return [$instructor->id => $instructor->competencies->pluck('id')->toArray()];
        })
    );

    // Lista de todas las competencias (id y nombre)
    const todasLasCompetencias = @json($competencias->map(function($comp) {
        return ['id' => $comp->id, 'nombre' => $comp->name];
    }));

    const selectInstructor = document.getElementById('instructor');
    const selectCompetencia = document.getElementById('competencia');

    selectInstructor.addEventListener('change', function() {
        const instructorId = this.value;
        selectCompetencia.innerHTML = '';
        if (!instructorId || !competenciasPorInstructor[instructorId] || competenciasPorInstructor[instructorId].length === 0) {
           selectCompetencia.innerHTML += `<option value="${comp.id}">${comp.name}</option>`;
            selectCompetencia.disabled = true;
            return;
        }
        // Filtra las competencias asignadas
        const competenciasAsignadas = todasLasCompetencias.filter(comp =>
            competenciasPorInstructor[instructorId].includes(comp.id)
        );
        competenciasAsignadas.forEach(comp => {
            selectCompetencia.innerHTML += `<option value="${comp.id}">${comp.nombre}</option>`;
        });
        selectCompetencia.disabled = false;
    });
</script>

</x-layout>
