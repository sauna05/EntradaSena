<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Listado de Competencias por Programa</x-slot:title>
   

    <style>
        .container {
          padding: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 6px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            border: 1px solid #f3f0f0;
            background-color: white;
        }

        h2.title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .success-message {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 12px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        thead {
            background-color: #ecf0f1;
            color: #2c3e50;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        .no-data {
            text-align: center;
            padding: 20px;
            color: #7f8c8d;
        }
    </style>

    <div class="container">
        <h2 class="title">Competencias asignadas a Programas</h2>

        @if(session('success'))
            <div class="success-message">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="">
            <label for="programa_id">Filtrar por programa:</label>
            <select name="programa_id" id="programa_id" onchange="this.form.submit()">
                <option value="">-- Todos --</option>
                @foreach($programas as $prog)
                    <option value="{{ $prog->id }}" {{ request('programa_id') == $prog->id ? 'selected' : '' }}>
                        {{ $prog->name }}
                    </option>
                @endforeach
            </select>
        </form>

        <div class="table-container" style="margin-top: 20px;">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Programa</th>
                        <th>Competencia</th>
                        <th>Duracion competencia</th>
                    </tr>
                </thead>
                <tbody>
                    @php $index = 1; @endphp
                   @forelse($programas as $programa)
                    <tr>
                        <td colspan="4" style="background-color: #ecf0f1; font-weight: bold;">
                            {{ $programa->name }}
                        </td>
                    </tr>
                    @forelse($programa->competencies as $competencia)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $programa->name }}</td>
                            <td>{{ $competencia->name }}</td>
                            <td>{{ $competencia->duration_hours }} hr </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">Este programa aún no tiene competencias asignadas.</td>
                        </tr>
                    @endforelse
                @empty
                    <tr>
                        <td colspan="4" class="no-data">No hay programas con competencias asignadas.</td>
                    </tr>
                @endforelse

                </tbody>
            </table>
        </div>
    </div>
</x-layout>


{{-- 

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Gestión Sistema de Programación</title>
  <style>
    /* Reset */
    * {
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      background: #f4f6f8;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    h1, h2 {
      color: #2c3e50;
      margin-bottom: 10px;
    }
    h1 {
      text-align: center;
      margin-bottom: 40px;
    }
    section {
      background: #fff;
      padding: 25px 30px;
      margin-bottom: 40px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    form {
      max-width: 800px;
      margin: 0 auto;
    }
    label {
      display: block;
      font-weight: bold;
      margin-top: 15px;
      margin-bottom: 6px;
    }
    input[type="text"],
    input[type="number"],
    input[type="date"],
    select {
      width: 100%;
      padding: 8px 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }
    button {
      margin-top: 25px;
      background-color: #3498db;
      border: none;
      color: white;
      padding: 12px 25px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    button:hover {
      background-color: #2980b9;
    }
    /* Layout for dual inputs */
    .two-cols {
      display: flex;
      gap: 20px;
    }
    .two-cols > div {
      flex: 1;
    }
    /* Checkbox container */
    .checkbox-group {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
    }
    .checkbox-group label {
      font-weight: normal;
      display: flex;
      align-items: center;
      gap: 5px;
    }
  </style>
</head>
<body>

  <h1>Sistema de Gestión de Programación</h1>

  <!-- Registro de Programas -->
  <section id="registro-programa">
    <h2>Registrar Programa</h2>
    <form>
      <label for="programa-nombre">Nombre del Programa:</label>
      <input type="text" id="programa-nombre" placeholder="Ej: ADSO, Cocina, Gestión Empresarial" required />
      
      <label for="programa-descripcion">Descripción (opcional):</label>
      <input type="text" id="programa-descripcion" placeholder="Descripción breve del programa" />
      
      <button type="submit">Guardar Programa</button>
    </form>
  </section>

  <!-- Registro de Competencias -->
  <section id="registro-competencia">
    <h2>Registrar Competencia</h2>
    <form>
      <label for="competencia-nombre">Nombre de la Competencia:</label>
      <input type="text" id="competencia-nombre" placeholder="Ej: Desarrollar aplicaciones web" required />

      <label for="competencia-horas">Horas Totales de la Competencia:</label>
      <input type="number" id="competencia-horas" min="1" placeholder="Ej: 40" required />

      <label for="competencia-descripcion">Descripción (opcional):</label>
      <input type="text" id="competencia-descripcion" placeholder="Descripción breve" />

      <button type="submit">Guardar Competencia</button>
    </form>
  </section>

  <!-- Registro de Fichas -->
  <section id="registro-ficha">
    <h2>Registrar Ficha</h2>
    <form>
      <label for="ficha-numero">Número de Ficha:</label>
      <input type="text" id="ficha-numero" placeholder="Ej: 2598476" required />

      <label for="ficha-programa">Asignar Programa:</label>
      <select id="ficha-programa" required>
        <option value="" disabled selected>Seleccione un programa</option>
        <option>ADSO</option>
        <option>Cocina</option>
        <option>Gestión Empresarial</option>
      </select>

      <label for="ficha-horas">Horas Totales de la Ficha:</label>
      <input type="number" id="ficha-horas" min="1" placeholder="Ej: 800" required />

      <button type="submit">Guardar Ficha</button>
    </form>
  </section>

  <!-- Vinculación Competencias - Programas - Fichas -->
  <section id="vinculacion">
    <h2>Vincular Competencias a Programas y Fichas</h2>
    <form>
      <label for="vincular-programa">Seleccionar Programa:</label>
      <select id="vincular-programa" required>
        <option value="" disabled selected>Seleccione un programa</option>
        <option>ADSO</option>
        <option>Cocina</option>
        <option>Gestión Empresarial</option>
      </select>

      <label for="vincular-competencia">Seleccionar Competencia:</label>
      <select id="vincular-competencia" required>
        <option value="" disabled selected>Seleccione una competencia</option>
        <option>Desarrollar aplicaciones web</option>
        <option>Preparar alimentos saludables</option>
        <option>Analizar modelos de negocios</option>
      </select>

      <label for="vincular-ficha">Seleccionar Ficha:</label>
      <select id="vincular-ficha" required>
        <option value="" disabled selected>Seleccione una ficha</option>
        <option>2598476 - ADSO</option>
        <option>3216548 - Cocina</option>
        <option>2147895 - Gestión Empresarial</option>
      </select>

      <label for="vincular-fecha-inicio">Fecha Inicio:</label>
      <input type="date" id="vincular-fecha-inicio" required />

      <label for="vincular-fecha-fin">Fecha Fin:</label>
      <input type="date" id="vincular-fecha-fin" required />

      <label for="vincular-estado">Estado:</label>
      <select id="vincular-estado" required>
        <option value="" disabled selected>Seleccione estado</option>
        <option value="disponible">Disponible (Blanco)</option>
        <option value="ejecucion">En ejecución (Amarillo)</option>
        <option value="finalizada-evaluada">Finalizada y evaluada (Verde)</option>
        <option value="finalizada-no-evaluada">Finalizada pero no evaluada (Rojo)</option>
      </select>

      <button type="submit">Guardar Vinculación</button>
    </form>
  </section>

  <!-- Programación de Instructores -->
  <section id="programacion-instructores">
    <h2>Programación de Instructores</h2>
    <form>
      <label for="instructor">Instructor:</label>
      <select id="instructor" required>
        <option value="" disabled selected>Seleccione un instructor</option>
        <option>Juan Pérez</option>
        <option>María Torres</option>
        <option>Luis García</option>
      </select>

      <label for="ficha">Ficha:</label>
      <select id="ficha" required>
        <option value="" disabled selected>Seleccione una ficha</option>
        <option>2598476 - ADSO</option>
        <option>3216548 - Cocina</option>
        <option>2147895 - Gestión Empresarial</option>
      </select>

      <label for="competencia">Competencia:</label>
      <select id="competencia" required>
        <option value="" disabled selected>Seleccione competencia</option>
        <option>Desarrollar aplicaciones web</option>
        <option>Preparar alimentos saludables</option>
        <option>Analizar modelos de negocios</option>
      </select>

      <label for="ambiente">Ambiente:</label>
      <select id="ambiente" required>
        <option value="" disabled selected>Seleccione un ambiente</option>
        <option>Ambiente 101 - Sala de Sistemas</option>
        <option>Ambiente 202 - Cocina Industrial</option>
        <option>Ambiente 303 - Sala Empresarial</option>
      </select>

      <div class="two-cols">
        <div>
          <label for="fecha_inicio">Fecha Inicio:</label>
          <input type="date" id="fecha_inicio" required />
        </div>
        <div>
          <label for="fecha_fin">Fecha Fin:</label>
          <input type="date" id="fecha_fin" required />
        </div>
      </div>

      <label>Horario:</label>
      <div class="two-cols" style="gap: 10px;">
        <input type="time" id="hora_inicio" required /> a <input type="time" id="hora_fin" required />
      </div>

      <label>Días de la semana:</label>
      <div class="checkbox-group">
        <label><input type="checkbox" name="dias" value="Lunes" /> Lunes</label>
        <label><input type="checkbox" name="dias" value="Martes" /> Martes</label>
        <label><input type="checkbox" name="dias" value="Miércoles" /> Miércoles</label>
        <label><input type="checkbox" name="dias" value="Jueves" /> Jueves</label>
        <label><input type="checkbox" name="dias" value="Viernes" /> Viernes</label>
        <label><input type="checkbox" name="dias" value="Sábado" /> Sábado</label>
        <label><input type="checkbox" name="dias" value="Domingo" /> Domingo</label>
      </div>

      <div class="two-cols">
        <div>
          <label for="horas_dia">Horas Diarias:</label>
          <input type="number" id="horas_dia" min="1" max="8" required />
        </div>
        <div>
          <label for="total_horas">Total de Horas de la Competencia:</label>
          <input type="number" id="total_horas" min="1" value="40" required />
        </div>
      </div>

      <label for="acumuladas">Horas Acumuladas (Simulado):</label>
      <input type="number" id="acumuladas" value="20" readonly />

      <button type="submit">Guardar Programación</button>
    </form>
  </section>

</body>
</html> --}}
