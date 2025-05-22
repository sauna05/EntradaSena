<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Listado de Competencias</x-slot:title>


    <style>
        .container {
            max-width: 900px; /* ancho limitado */
            margin: 40px auto;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        h2 {
            font-size: 26px;
            margin-bottom: 25px;
            color: #2c3e50;
            font-weight: 700;
            text-align: center;
        }

        .btn-primary {
            background-color: #6c757d; /* gris oscuro */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto 25px auto;
            width: 200px;
            text-align: center;
            user-select: none;
        }

        .btn-primary:hover {
            background-color: #5a6268; /* gris más oscuro al hover */
        }

        table {
            width: 90%; /* menos ancho para no ocupar todo */
            margin: 0 auto;
            border-collapse: collapse;
            font-size: 15px;
            color: #444;
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        table th, table td {
            padding: 14px 18px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #e9ecef;
            font-weight: 700;
            color: #495057;
        }

        table tr:last-child td {
            border-bottom: none;
        }

        /* Mensaje éxito */
        .alert-success {
            max-width: 900px;
            margin: 20px auto;
            background-color: #d4edda;
            color: #155724;
            padding: 12px 20px;
            border-radius: 6px;
            box-shadow: 0 0 8px rgba(21, 87, 36, 0.2);
            font-weight: 600;
            font-size: 14px;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 15px;
        }

        .modal-content {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
            position: relative;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .close {
            color: #888;
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            font-weight: 700;
            cursor: pointer;
            transition: color 0.3s ease;
            user-select: none;
        }

        .close:hover {
            color: #444;
        }

        .modal-content h3 {
            margin-top: 0;
            margin-bottom: 25px;
            font-weight: 700;
            color: #2c3e50;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 8px;
            color: #555;
        }

        .form-group input {
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #6c757d;
            box-shadow: 0 0 5px rgba(108, 117, 125, 0.5);
        }

        .form-group button {
            background-color: #6c757d;
            color: white;
            padding: 12px 0;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            user-select: none;
        }

        .form-group button:hover {
            background-color: #5a6268;
        }
    </style>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <h2>Listado de Competencias</h2>

        <button class="btn-primary" onclick="document.getElementById('competenceModal').style.display='flex'">
            Registrar Competencia
        </button>

        <!-- Tabla de Competencias -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Duración (horas)</th>
                    <th>Fecha de Registro</th>
                </tr>
            </thead>
            <tbody>
                @forelse($competencies as $competence)
                    <tr>
                        <td>{{ $competence->id }}</td>
                        <td>{{ $competence->name }}</td>
                        <td>{{ $competence->duration_hours }} hr </td>
                        <td>{{ $competence->created_at->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center; font-style: italic; color: #888;">
                            No hay competencias registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Modal para Registrar Competencia -->
    <div id="competenceModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('competenceModal').style.display='none'">&times;</span>
            <h3>Registrar Nueva Competencia</h3>

            <form method="POST" action="{{ route('programing.competencies_store') }}">
                @csrf
                <div class="form-group">
                    <label for="name">Nombre de la competencia</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="duration_hours">Duración (horas)</label>
                    <input type="number" id="duration_hours" name="duration_hours" required min="1">
                </div>

                <div class="form-group">
                    <button type="submit">Guardar Competencia</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script para cerrar modal al hacer clic fuera del contenido -->
    <script>
        window.onclick = function(event) {
            const modal = document.getElementById('competenceModal');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>

</x-layout>

{{--

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Programación Académica</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background: #f5f5f5;
    }
    header {
      background-color: #1a237e;
      color: white;
      padding: 1rem;
      text-align: center;
    }
    section {
      background: white;
      margin: 1rem auto;
      padding: 1rem;
      width: 90%;
      max-width: 1000px;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }
    h2 {
      color: #1a237e;
    }
    input, select, textarea, button {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background-color: #1a237e;
      color: white;
      cursor: pointer;
    }
    button:hover {
      background-color: #3949ab;
    }
    .estado {
      display: inline-block;
      padding: 0.3rem 0.6rem;
      border-radius: 5px;
      color: white;
      margin-right: 5px;
    }
    .blanco { background: gray; }
    .amarillo { background: gold; }
    .verde { background: green; }
    .rojo { background: red; }
  </style>
</head>
<body>

<header>
  <h1>Sistema de Programación Académica - SENA</h1>
</header>

<!-- Login -->
<section>
  <h2>Vista: Login</h2>
  <form>
    <label>Usuario:</label>
    <input type="text" placeholder="Ingrese su usuario">

    <label>Contraseña:</label>
    <input type="password" placeholder="Ingrese su contraseña">

    <label>Tipo de Acceso:</label>
    <select>
      <option>Gestión de Asistencias</option>
      <option>Programación Administrativa</option>
    </select>

    <button>Ingresar</button>
  </form>
</section>

<!-- Dashboard -->
<section>
  <h2>Vista: Dashboard</h2>
  <p>Resumen: 10 Fichas activas, 5 instructores disponibles, 3 alertas pendientes</p>
</section>

<!-- Gestión de Fichas -->
<section>
  <h2>Vista: Gestión de Fichas</h2>
  <form>
    <label>Nombre de la Ficha:</label>
    <input type="text">
    <label>Programa Asignado:</label>
    <input type="text">
    <label>Horas Totales:</label>
    <input type="number">
    <button>Registrar Ficha</button>
  </form>
</section>

<!-- Gestión de Programas -->
<section>
  <h2>Vista: Gestión de Programas</h2>
  <form>
    <label>Nombre del Programa:</label>
    <input type="text">
    <label>Competencias Asociadas:</label>
    <textarea placeholder="Ej: Comunicación efectiva, Programación Web..."></textarea>
    <button>Guardar Programa</button>
  </form>
</section>

<!-- Gestión de Competencias -->
<section>
  <h2>Vista: Gestión de Competencias</h2>
  <form>
    <label>Nombre de la Competencia:</label>
    <input type="text">
    <label>Asignar a Ficha:</label>
    <select>
      <option>Ficha 245123</option>
    </select>
    <label>Estado:</label>
    <select>
      <option>Cesionada</option>
      <option>Iniciada</option>
      <option>Finalizada</option>
    </select>
    <button>Registrar Competencia</button>
  </form>
  <div>
    <p><span class="estado blanco">Disponible</span> <span class="estado amarillo">En ejecución</span> <span class="estado verde">Evaluada</span> <span class="estado rojo">Sin evaluar</span></p>
  </div>
</section>

<!-- Gestión de Instructores -->
<section>
  <h2>Vista: Gestión de Instructores</h2>
  <form>
    <label>Nombre del Instructor:</label>
    <input type="text">
    <label>Especialidad:</label>
    <input type="text">
    <label>Horas Disponibles:</label>
    <input type="number">
    <button>Registrar Instructor</button>
  </form>
</section>

<!-- Gestión de Ambientes -->
<section>
  <h2>Vista: Gestión de Ambientes</h2>
  <form>
    <label>Nombre del Ambiente:</label>
    <input type="text">
    <label>Capacidad:</label>
    <input type="number">
    <button>Registrar Ambiente</button>
  </form>
</section>

<!-- Programación Semanal -->
<section>
  <h2>Vista: Programación Semanal</h2>
  <form>
    <label>Instructor:</label>
    <select><option>María Gómez</option></select>
    <label>Ficha:</label>
    <select><option>245123</option></select>
    <label>Competencia:</label>
    <select><option>Desarrollo Web</option></select>
    <label>Días:</label>
    <input type="text" placeholder="Lunes a Viernes">
    <label>Rango Horario:</label>
    <input type="text" placeholder="08:00 - 12:00">
    <button>Asignar</button>
  </form>
</section>

<!-- Calendario Académico -->
<section>
  <h2>Vista: Calendario Académico</h2>
  <form>
    <label>Día Festivo:</label>
    <input type="date">
    <label>Motivo:</label>
    <input type="text">
    <button>Registrar Día No Lectivo</button>
  </form>
</section>

<!-- Vista de Aprendices -->
<section>
  <h2>Vista: Aprendices</h2>
  <p>Ficha: 245123</p>
  <p>Competencia: Desarrollo Web</p>
  <p>Ambiente: Sala 5</p>
  <p>Horario: Lunes a Viernes 08:00 - 12:00</p>
</section>

<!-- Vista de Coordinador -->
<section>
  <h2>Vista: Coordinador</h2>
  <p>Ambiente Sala 5: Programado de 8:00 a 12:00</p>
  <p>Instructor Juan no ha llegado (alerta enviada)</p>
</section>

<!-- Alertas y Notificaciones -->
<section>
  <h2>Vista: Alertas</h2>
  <ul>
    <li>Instructor Juan Pérez no ha llegado - Sala 5 - 08:15 AM</li>
    <li>Competencia Desarrollo Web finaliza en 5 días</li>
  </ul>
</section>

</body>
</html> --}}
