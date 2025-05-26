<x-layout>
    <x-slot:title>Listado de Instructores</x-slot:title>
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
  </style>
</head>
<body>
  <div class="container">
    <h2>Programación de Instructores</h2>

    <form action="" method="POST">
      @csrf

      <label for="instructor">Instructor:</label>
      <select id="instructor" name="instructor_id">
        @foreach ($instructors as $instructor)
          <option value="{{ $instructor->id }}">{{ $instructor->nombre }}</option>
        @endforeach
      </select>

      <label for="ficha">Ficha:</label>
      <select id="ficha" name="ficha_id">
        @foreach ($cohorts as $ficha)
          <option value="{{ $ficha->id }}">{{ $ficha->number_cohort }} - {{ $ficha->program->namme }}</option>
        @endforeach
      </select>

      <label for="competencia">Competencia:</label>
      <select id="competencia" name="competencia_id">
        @foreach ($competencias as $competencia)
          <option value="{{ $competencia->id }}">{{ $competencia->nombre }}</option>
        @endforeach
      </select>

      <label for="ambiente">Ambiente:</label>
      <select id="ambiente" name="ambiente_id">
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
</x-layout>

{{-- 
<x-layout>
    <x-slot:title>Programar Instructor</x-slot:title>
  
    <style>
      body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f3f4f6;
      }
  
      .container {
        max-width: 700px;
        margin: 40px auto;
        background-color: white;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      }
  
      h2 {
        text-align: center;
        margin-bottom: 25px;
        font-size: 24px;
        color: #2d3748;
      }
  
      label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 6px;
        color: #4a5568;
      }
  
      input[type="text"],
      input[type="date"],
      input[type="time"],
      select {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #cbd5e0;
        border-radius: 8px;
        font-size: 14px;
        transition: border-color 0.3s ease;
      }
  
      input:focus,
      select:focus {
        border-color: #3182ce;
        outline: none;
      }
  
      .time-group {
        display: flex;
        gap: 20px;
      }
  
      .time-group > div {
        flex: 1;
      }
  
      button {
        background-color: #38a169;
        color: white;
        padding: 12px 25px;
        font-size: 15px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }
  
      button:hover {
        background-color: #2f855a;
      }
  
      .text-center {
        text-align: center;
      }
    </style>
  
    <div class="container">
      <h2>Registrar Programación de Instructor</h2>
  
      <form action="" method="POST">
        @csrf
  
        <!-- Instructor -->
        <div>
          <label for="instructor_id">Instructor</label>
          <select name="instructor_id" id="instructor_id" required>
            <option value="">Seleccione un instructor</option>
            @foreach($instructors as $instructor)
              <option value="{{ $instructor->id }}">
                {{ optional($instructor->person)->name }} {{ optional($instructor->person)->lastname }}
              </option>
            @endforeach
          </select>
        </div>
  
        <!-- Programa -->
        <div>
          <label for="program_id">Programa</label>
          <select name="program_id" id="program_id" required>
            <option value="">Seleccione un programa</option>
            @foreach($programs as $program)
              <option value="{{ $program->id }}">{{ $program->name }}</option>
            @endforeach
          </select>
        </div>
  
        <!-- Competencia -->
        <div>
          <label for="competency_id">Competencia</label>
          <select name="competency_id" id="competency_id" required>
            <option value="">Seleccione una competencia</option>
          </select>
        </div>
  
        <!-- Ambiente -->
        <div>
          <label for="ambiente">Ambiente</label>
          <input type="text" name="ambiente" id="ambiente" required>
        </div>
  
        <!-- Fecha -->
        <div>
          <label for="fecha">Fecha</label>
          <input type="date" name="fecha" id="fecha" required>
        </div>
  
        <!-- Hora Inicio y Fin -->
        <div class="time-group">
          <div>
            <label for="hora_inicio">Hora Inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" required>
          </div>
          <div>
            <label for="hora_fin">Hora Fin</label>
            <input type="time" name="hora_fin" id="hora_fin" required>
          </div>
        </div>
  
        <!-- Botón -->
        <div class="text-center">
          <button type="submit">Registrar Programación</button>
        </div>
      </form>
    </div>
  
    <!-- Script para cargar competencias dinámicamente -->
    <script>
      document.getElementById('instructor_id').addEventListener('change', function () {
        const instructorId = this.value;
        const competencySelect = document.getElementById('competency_id');
  
        if (!instructorId) {
          competencySelect.innerHTML = '<option value="">Seleccione una competencia</option>';
          return;
        }
  
        fetch(`/api/competencies-by-instructor/${instructorId}`)
          .then(response => {
            if (!response.ok) {
              throw new Error('Error al obtener competencias.');
            }
            return response.json();
          })
          .then(data => {
            competencySelect.innerHTML = '<option value="">Seleccione una competencia</option>';
            data.forEach(c => {
              competencySelect.innerHTML += `<option value="${c.id}">${c.name}</option>`;
            });
          })
          .catch(error => {
            console.error('Error:', error);
            competencySelect.innerHTML = '<option value="">No se pudieron cargar las competencias</option>';
          });
      });
    </script>
  </x-layout>
   --}}