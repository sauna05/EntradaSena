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
  .alert-warning {
    width: 100%;
    background-color: #fff3cd;
    color: #856404;
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
    border: 1px solid #ffeeba;
    display: none; /* Oculto por defecto */
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
  <h2>Programación de Cursos</h2>

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

    <label for="ficha">Selecione ficha y Programa </label>
    <select id="ficha" name="ficha_id" required>
      <option value="">Selecione </option>
      @foreach ($cohorts as $ficha)
        <option value="{{ $ficha->id }}" {{ old('ficha_id') == $ficha->id ? 'selected' : '' }}>{{ $ficha->number_cohort }} - {{$ficha->program->name}}</option>
      @endforeach
    </select>

    <label for="instructor">Instructor:</label>
    <select id="instructor" name="instructor_id" required>
      <option value="">Seleccione un instructor</option>
      @foreach ($instructors as $instructor)
        <option value="{{ $instructor->id }}" {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}> {{$instructor->person->document_number}} - {{ $instructor->person->name }} - {{$instructor->speciality->name}}</option>
      @endforeach
    </select>
    <!-- Nuevo mensaje de alerta -->
    <div id="noCompetenciesAlert" class="alert-warning">
      El instructor seleccionado no tiene competencias vinculadas. Por favor, asigne competencias al instructor antes de continuar.
    </div>



    <label for="competencia">Competencia:</label>
    <select id="competencia" name="competencia_id" disabled required>
      <option value="">Seleccione un instructor primero</option>
    </select>

    <label for="ambiente">Ambiente:</label>
    <select id="ambiente" name="ambiente_id" required>
      <option value="">Selecione Ambiente</option>
      @foreach ($ambientes as $ambiente)
        <option value="{{ $ambiente->id }}" {{ old('ambiente_id') == $ambiente->id ? 'selected' : '' }}> {{$ambiente->Block->name}} - {{ $ambiente->name }} - {{$ambiente->towns->name}}</option>
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
         step="0.01" value="{{ old('horas_dia', 1) }}"  readonly />

      </div>
      <div>
         {{-- aca validar que se cumplan las horas durante ese periodo de fecha --}}
        <label for="total_horas">Horas A programar:</label>
        <input type="number" id="total_horas" name="total_horas" min="1" step="0.01" 
        value="{{ old('total_horas') }}" required readonly />

      </div>
    </div>

    <button type="submit" class="submit-btn">Guardar Programación</button>
  </form>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const horaInicioInput = document.getElementById('hora_inicio');
      const horaFinInput = document.getElementById('hora_fin');
      const horasDiaInput = document.getElementById('horas_dia');
      const totalHorasInput = document.getElementById('total_horas');
      const diasCheckboxes = document.querySelectorAll('input[name="dias[]"]');
      const fechaInicioInput = document.getElementById('fecha_inicio');
      const fechaFinInput = document.getElementById('fecha_fin');
      const horasCalculadasDiv = document.getElementById('horasCalculadas');
      const selectInstructor = document.getElementById('instructor');
      const selectCompetencia = document.getElementById('competencia');
      const noCompetenciesAlert = document.getElementById('noCompetenciesAlert');
  
      let competenciaHoras = 0;
  
      const competenciasPorInstructor = @json(
          $instructors->mapWithKeys(function($instructor) {
              return [$instructor->id => $instructor->competencies->pluck('id')->toArray()];
          })
      );
  
      const todasLasCompetencias = @json($competencias->map(function($comp) {
          return ['id' => $comp->id, 'name' => $comp->name, 'hours' => $comp->duration_hours ?? $comp->hours ?? 40];
      }));
  
      selectInstructor.addEventListener('change', function () {
          const instructorId = this.value;
          selectCompetencia.innerHTML = '<option value="">Seleccione una competencia</option>';
          noCompetenciesAlert.style.display = 'none';
  
          if (!instructorId) {
              selectCompetencia.disabled = true;
              return;
          }
  
          if (!competenciasPorInstructor[instructorId] || competenciasPorInstructor[instructorId].length === 0) {
              selectCompetencia.disabled = true;
              noCompetenciesAlert.style.display = 'block';
              return;
          }
  
          const competenciasAsignadas = todasLasCompetencias.filter(comp =>
              competenciasPorInstructor[instructorId].includes(comp.id)
          );
  
          competenciasAsignadas.forEach(comp => {
              selectCompetencia.innerHTML += `<option value="${comp.id}">${comp.name}</option>`;
          });
  
          selectCompetencia.disabled = false;
      });
  
      selectCompetencia.addEventListener('change', function () {
          const competenciaId = parseInt(this.value);
          const competencia = todasLasCompetencias.find(c => c.id === competenciaId);
          competenciaHoras = competencia ? competencia.hours : 0;
          calcularTotalHoras();
      });
  
      function calcularHorasDiarias() {
          const horaInicio = horaInicioInput.value;
          const horaFin = horaFinInput.value;
  
          if (horaInicio && horaFin) {
              const [h1, m1] = horaInicio.split(':').map(Number);
              const [h2, m2] = horaFin.split(':').map(Number);
  
              const minutosInicio = h1 * 60 + m1;
              const minutosFin = h2 * 60 + m2;
  
              const diferenciaMinutos = minutosFin - minutosInicio;
  
              if (diferenciaMinutos > 0) {
                  const horas = diferenciaMinutos / 60;
                  horasDiaInput.value = horas.toFixed(2);
                  horasCalculadasDiv.textContent = '';
              } else {
                  horasDiaInput.value = '';
                  horasCalculadasDiv.textContent = '⚠️ La hora final debe ser mayor a la hora inicial';
              }
  
              calcularTotalHoras();
          }
      }
  
      function calcularTotalHoras() {
          const fechaInicio = fechaInicioInput.value;
          const fechaFin = fechaFinInput.value;
          const horasDia = parseFloat(horasDiaInput.value);
  
          if (!fechaInicio || !fechaFin || isNaN(horasDia)) {
              totalHorasInput.value = '';
              return;
          }
  
          const startDate = new Date(fechaInicio);
          const endDate = new Date(fechaFin);
  
          if (endDate < startDate) {
              totalHorasInput.value = '';
              horasCalculadasDiv.textContent = '⚠️ La fecha fin debe ser mayor o igual a la fecha inicio';
              return;
          }
  
          const diasSeleccionados = Array.from(diasCheckboxes)
              .filter(cb => cb.checked)
              .map(cb => cb.value);
  
          let totalHoras = 0;
          let currentDate = new Date(startDate);
  
          while (currentDate <= endDate) {
              const diaSemana = capitalize(currentDate.toLocaleDateString('es-ES', { weekday: 'long' }));
              if (diasSeleccionados.includes(diaSemana)) {
                  totalHoras += horasDia;
              }
              currentDate.setDate(currentDate.getDate() + 1);
          }
  
          totalHorasInput.value = totalHoras.toFixed(2);
  
          if (competenciaHoras > 0 && totalHoras < competenciaHoras) {
              horasCalculadasDiv.textContent = `⚠️ Las horas programadas (${totalHoras.toFixed(2)}) son menores a las requeridas por la competencia (${competenciaHoras})`;
          } else {
              horasCalculadasDiv.textContent = '';
          }
      }
  
      function capitalize(str) {
          return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
      }
  
      horaInicioInput.addEventListener('change', calcularHorasDiarias);
      horaFinInput.addEventListener('change', calcularHorasDiarias);
      diasCheckboxes.forEach(cb => cb.addEventListener('change', calcularTotalHoras));
      fechaInicioInput.addEventListener('change', calcularTotalHoras);
      fechaFinInput.addEventListener('change', calcularTotalHoras);
  
      // Inicializa si hay valores previos
      if (selectInstructor.value) {
          selectInstructor.dispatchEvent(new Event('change'));
      }
  });
  </script>
  
</body>
</html>
</x-layout>

