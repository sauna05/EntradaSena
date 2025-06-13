<x-layout>
  <x-slot:title>Programación de Instructores</x-slot:title>
  <!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>Programación de Instructores</title>
{{-- <script>
  document.addEventListener('DOMContentLoaded', function () {
      const flashes = document.querySelectorAll('.flash-message');
      flashes.forEach(flash => {
          setTimeout(() => {
              flash.style.transition = 'opacity 0.5s ease';
              flash.style.opacity = '0';
              setTimeout(() => flash.remove(), 500); // Lo quita del DOM tras la animación
          }, 4000); // 4 segundos
      });
  });
</script> --}}

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
    width: 100%;
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #c3e6cb;
  }
  .alert-danger{
    width: 100%;
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 4px;
    border: 1px solid #f5c6cb;
  }
  .error-message {
    color: #dc3545;
    font-size: 0.875em;
    margin-top: 5px;
  }
  .time-container {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .time-container input {
    width: auto;
  }
</style>
</head>
<body>
<div class="container">
  <h2>Programación de Instructores</h2>

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

  @if ($errors->any())
      <div class="alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form id="programmingForm" action="{{ route('programming.register_programming_instructor_store') }}" method="POST">
    @csrf

    <label for="instructor">Instructor:</label>
    <select id="instructor" name="instructor_id" required>
      <option value="">Seleccione un instructor</option>
      @foreach ($instructors as $instructor)
        <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>{{ $instructor->person->name }}</option>
      @endforeach
    </select>

    <label for="ficha">Ficha:</label>
    <select id="ficha" name="ficha_id" required>
      <option value="">Selecione la ficha</option>
      @foreach ($cohorts as $ficha)
        <option value="{{ $ficha->id }}" {{ old('ficha_id') == $ficha->id ? 'selected' : '' }}>{{ $ficha->number_cohort }} - {{$ficha->program->name}}</option>
      @endforeach
    </select>

    <label for="competencia">Competencia:</label>
    <select id="competencia" name="competencia_id" disabled required>
      <option value="">Seleccione un instructor primero</option>
    </select>

    <label for="ambiente">Ambiente:</label>
    <select id="ambiente" name="ambiente_id" required>
      <option value="">Selecione Ambiente</option>
      @foreach ($ambientes as $ambiente)
        <option value="{{ $ambiente->id }}" {{ old('ambiente_id') == $ambiente->id ? 'selected' : '' }}>{{ $ambiente->name }} - {{$ambiente->towns->name}}</option>
      @endforeach
    </select>

    <div class="two-cols">
      <div>
        <label for="fecha_inicio">Fecha Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required />
      </div>
      <div>
        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" required />
      </div>
    </div>

    <label>Horario:</label>
    <div class="time-container">
      <input type="time" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" required min="08:00" step="1800" />
      <span>a</span>
      <input type="time" id="hora_fin" name="hora_fin" value="{{ old('hora_fin') }}" required min="08:00" step="1800" />
      
    </div>
    <div id="horasCalculadas" class="error-message"></div>

    <label>Días de la semana:</label>
    <div class="day-checkboxes">
      @php
          $dias = ['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'];
      @endphp
      @foreach ($dias as $dia)
          <label>
              <input type="checkbox" name="dias[]" value="{{ $dia }}" 
                  {{ is_array(old('dias')) && in_array($dia, old('dias')) ? 'checked' : '' }}> 
              {{ $dia }}
          </label>
      @endforeach
    </div>
    <div id="diasError" class="error-message"></div>

    <div class="two-cols">
      <div>
        <label for="horas_dia">Horas Diarias:</label>
        <input type="number" id="horas_dia" name="horas_dia" min="1" max="8" 
               value="{{ old('horas_dia', 1) }}" required readonly />
      </div>
      <div>
        <label for="total_horas">Total de Horas de la Competencia:</label>
        <input type="number" id="total_horas" name="total_horas" value="{{ old('total_horas') }}" required readonly />

      </div>
    </div>

    <button type="submit" class="submit-btn">Guardar Programación</button>
  </form>
</div>

<script>
  // Mapea instructor_id => [competencia_id, ...]
  const competenciasPorInstructor = @json(
      $instructors->mapWithKeys(function($instructor) {
          return [$instructor->id => $instructor->competencies->pluck('id')->toArray()];
      })
  );

  const selectInstructor = document.getElementById('instructor');
  const selectCompetencia = document.getElementById('competencia');
  const totalHorasInput = document.getElementById('total_horas');

   const todasLasCompetencias = @json($competencias->map(function($comp) {
    return ['id' => $comp->id, 'name' => $comp->name, 'hours' => $comp->duration_hours ?? $comp->hours ?? 40];
}));

  

  selectCompetencia.addEventListener('change', function() {
      const competenciaId = parseInt(this.value);

      if (!competenciaId) {
          totalHorasInput.value = '';
          return;
      }

      const competencia = todasLasCompetencias.find(c => c.id === competenciaId);

      if (competencia) {
          totalHorasInput.value = competencia.hours;
      } else {
          totalHorasInput.value = '';
      }
  });

  if (selectInstructor.value) {
      selectInstructor.dispatchEvent(new Event('change'));
  }
  if (selectCompetencia.value) {
      selectCompetencia.dispatchEvent(new Event('change'));
  }

  selectInstructor.addEventListener('change', function() {
      const instructorId = this.value;
      selectCompetencia.innerHTML = '<option value="">Seleccione una competencia</option>';
      
      if (!instructorId || !competenciasPorInstructor[instructorId] || competenciasPorInstructor[instructorId].length === 0) {
          selectCompetencia.disabled = true;
          return;
      }
      
      // Filtra las competencias asignadas
      const competenciasAsignadas = todasLasCompetencias.filter(comp =>
          competenciasPorInstructor[instructorId].includes(comp.id)
      );
      
      competenciasAsignadas.forEach(comp => {
          selectCompetencia.innerHTML += `<option value="${comp.id}">${comp.name}</option>`;
      });
      
      selectCompetencia.disabled = false;
      
      // Seleccionar valor anterior si existe
      const oldValue = "{{ old('competencia_id') }}";
      if (oldValue) {
          selectCompetencia.value = oldValue;
      }
  });

  // Ejecutar al cargar la página si hay instructor seleccionado
  if (selectInstructor.value) {
      selectInstructor.dispatchEvent(new Event('change'));
  }

  // Calcular horas diarias automáticamente
  const horaInicio = document.getElementById('hora_inicio');
  const horaFin = document.getElementById('hora_fin');
  const horasDia = document.getElementById('horas_dia');
  const horasCalculadas = document.getElementById('horasCalculadas');

  function calcularHoras() {
      if (horaInicio.value && horaFin.value) {
          const inicio = new Date(`2000-01-01T${horaInicio.value}`);
          const fin = new Date(`2000-01-01T${horaFin.value}`);
          
          // Validar que la hora de inicio sea después de las 8 am
          const horaMinima = new Date(`2000-01-01T08:00`);
          if (inicio < horaMinima) {
              horasCalculadas.textContent = 'La hora de inicio debe ser a partir de las 8:00 am';
              horasDia.value = '';
              return;
          } else {
              horasCalculadas.textContent = '';
          }
          
          // Validar que la hora fin sea mayor que la hora inicio
          if (fin <= inicio) {
              horasCalculadas.textContent = 'La hora de fin debe ser posterior a la hora de inicio';
              horasDia.value = '';
              return;
          } else {
              horasCalculadas.textContent = '';
          }
          
          // Calcular diferencia en horas
          const diffMs = fin - inicio;
          const diffHrs = diffMs / (1000 * 60 * 60);
          
          // Redondear a 1 decimal
          const horasRedondeadas = Math.round(diffHrs * 10) / 10;
          
          // Validar máximo 8 horas
          if (horasRedondeadas > 8) {
              horasCalculadas.textContent = 'El horario no puede exceder 8 horas diarias';
              horasDia.value = '';
          } else {
              horasDia.value = horasRedondeadas;
              horasCalculadas.textContent = '';
          }
      }
  }

  horaInicio.addEventListener('change', calcularHoras);
  horaFin.addEventListener('change', calcularHoras);

  // Validar fechas
  const fechaInicio = document.getElementById('fecha_inicio');
  const fechaFin = document.getElementById('fecha_fin');

  fechaInicio.addEventListener('change', function() {
      if (fechaFin.value && new Date(fechaInicio.value) > new Date(fechaFin.value)) {
          alert('La fecha de inicio no puede ser posterior a la fecha de fin');
          fechaInicio.value = '';
      }
  });

  fechaFin.addEventListener('change', function() {
      if (fechaInicio.value && new Date(fechaFin.value) < new Date(fechaInicio.value)) {
          alert('La fecha de fin no puede ser anterior a la fecha de inicio');
          fechaFin.value = '';
      }
  });


  // Validar días seleccionados
  const form = document.getElementById('programmingForm');
  const diasError = document.getElementById('diasError');

  form.addEventListener('submit', function(e) {
      const diasSeleccionados = document.querySelectorAll('input[name="dias[]"]:checked').length;
      
      if (diasSeleccionados === 0) {
          e.preventDefault();
          diasError.textContent = 'Debe seleccionar al menos un día de la semana';
      } else {
          diasError.textContent = '';
      }
  });

document.getElementById('hora_inicio').addEventListener('change', validarHora);
document.getElementById('hora_fin').addEventListener('change', validarHora);

function validarHora(e) {
    const valor = e.target.value;
    if (valor) {
        const [hora, minuto] = valor.split(':').map(Number);
        if (minuto !== 0 && minuto !== 30) {
            alert('Solo se permiten horas en punto o media hora (:00 o :30)');
            e.target.value = '';
        }
    }
}
</script>

  


</script>
</body>
</html>
</x-layout>

