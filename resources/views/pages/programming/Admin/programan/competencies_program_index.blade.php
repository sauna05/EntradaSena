<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Listado de Competencias por Programa</x-slot:title>
    <x-programming_navbar></x-programming_navbar>

    <style>
        .container {
            padding: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
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



<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Programación</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f4f4f4;
      margin: 0;
      padding: 20px;
    }
    h2 {
      background: #2c3e50;
      color: white;
      padding: 10px;
      border-radius: 5px;
    }
    section {
      background: white;
      margin: 20px 0;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      display: block;
      margin-top: 10px;
    }
    input, select, textarea {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }
    .btn {
      margin-top: 15px;
      background: #2980b9;
      color: white;
      border: none;
      padding: 10px 15px;
      cursor: pointer;
      border-radius: 4px;
    }
    .btn:hover {
      background: #3498db;
    }
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 15px;
    }
    .tag {
      display: inline-block;
      padding: 5px 10px;
      border-radius: 20px;
      font-size: 12px;
      margin-top: 5px;
    }
    .tag.blanco { background: #ecf0f1; color: #2c3e50; }
    .tag.amarillo { background: #f1c40f; color: #2c3e50; }
    .tag.verde { background: #2ecc71; color: white; }
    .tag.rojo { background: #e74c3c; color: white; }
  </style>
</head>
<body>

  <section>
    <h2>Inicio de Sesión</h2>
    <label>Usuario</label>
    <input type="text" placeholder="admin@correo.com">
    <label>Contraseña</label>
    <input type="password" placeholder="••••••••">
    <select>
      <option>Gestión de Asistencias</option>
      <option>Programación Académica</option>
    </select>
    <button class="btn">Iniciar Sesión</button>
  </section>

  <section>
    <h2>Registrar Programa</h2>
    <label>Nombre del Programa</label>
    <input type="text" placeholder="ADSO, Cocina, etc.">
    <label>Competencias Vinculadas</label>
    <textarea rows="4" placeholder="Competencia 1, Competencia 2..."></textarea>
    <button class="btn">Guardar Programa</button>
  </section>

  <section>
    <h2>Registrar Ficha</h2>
    <label>Número de Ficha</label>
    <input type="text" placeholder="2598745">
    <label>Programa Asociado</label>
    <select><option>ADSO</option><option>Cocina</option></select>
    <button class="btn">Registrar Ficha</button>
  </section>

  <section>
    <h2>Asignar Aprendices a Ficha</h2>
    <label>Ficha</label>
    <select><option>2598745 - ADSO</option></select>
    <label>Documento Aprendices (CSV/Senasofía)</label>
    <input type="file">
    <button class="btn">Cargar Aprendices</button>
  </section>

  <section>
    <h2>Programar Competencia</h2>
    <label>Ficha</label>
    <select><option>2598745</option></select>
    <label>Competencia</label>
    <input type="text" placeholder="Desarrollar aplicaciones web">
    <label>Fecha Inicio</label>
    <input type="date">
    <label>Fecha Fin</label>
    <input type="date">
    <label>Estado</label>
    <select><option>Disponible</option><option>Iniciada</option><option>Cesionada</option><option>Terminada</option></select>
    <button class="btn">Programar</button>
  </section>

  <section>
    <h2>Asignar Instructor</h2>
    <label>Instructor</label>
    <select><option>Juan Pérez - Desarrollo</option></select>
    <label>Competencia</label>
    <select><option>Desarrollar aplicaciones web</option></select>
    <label>Ambiente</label>
    <select><option>Ambiente 302</option></select>
    <label>Horario</label>
    <input type="time"> a <input type="time">
    <label>Días</label>
    <input type="checkbox"> Lunes
    <input type="checkbox"> Martes
    <input type="checkbox"> Miércoles
    <button class="btn">Asignar Instructor</button>
  </section>

  <section>
    <h2>Visualización - Estado de Competencias</h2>
    <div class="grid">
      <div><strong>Competencia:</strong> Fundamentos de programación <span class="tag blanco">Disponible</span></div>
      <div><strong>Competencia:</strong> Desarrollo Frontend <span class="tag amarillo">En ejecución</span></div>
      <div><strong>Competencia:</strong> Backend en Laravel <span class="tag verde">Finalizada y evaluada</span></div>
      <div><strong>Competencia:</strong> Base de datos <span class="tag rojo">Finalizada sin evaluar</span></div>
    </div>
  </section>

  <section>
    <h2>Calendario Académico</h2>
    <label>Registrar Día No Lectivo</label>
    <input type="date">
    <textarea placeholder="Motivo del día no lectivo"></textarea>
    <button class="btn">Registrar Día</button>
  </section>

</body>
</html>
