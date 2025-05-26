<x-layout>
    <x-slot:title>Listado de programaciones</x-slot:title>
    <!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f4f4;
      padding: 40px;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    th, td {
      padding: 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #2c2c2c;
      color: white;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .status-green {
      background-color: #d4edda;
      color: #155724;
      font-weight: bold;
      border-radius: 6px;
      padding: 5px 10px;
      display: inline-block;
    }

    .status-yellow {
      background-color: #fff3cd;
      color: #856404;
      font-weight: bold;
      border-radius: 6px;
      padding: 5px 10px;
      display: inline-block;
    }

    .status-red {
      background-color: #f8d7da;
      color: #721c24;
      font-weight: bold;
      border-radius: 6px;
      padding: 5px 10px;
      display: inline-block;
    }
  </style>
</head>
<body>
  <h1>Listado de Programaciones</h1>
  <table>
    <thead>
      <tr>
        <th>#</th>
        <th>Instructor</th>
        <th>Programa</th>
        <th>Ficha</th>
        <th>Competencia</th>
        <th>Ambiente</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Estado</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Laura Gómez</td>
        <td>ADSO</td>
        <td>2547896</td>
        <td><span class="status-green">Desarrollar Interfaces Web</span></td>
        <td>Ambiente 01</td>
        <td>2025-06-10</td>
        <td>08:00 - 12:00</td>
        <td>Confirmada</td>
      </tr>
      <tr>
        <td>2</td>
        <td>Mario Rojas</td>
        <td>Gestión Empresarial</td>
        <td>3641258</td>
        <td><span class="status-yellow">Gestión de Proyectos</span></td>
        <td>Ambiente 03</td>
        <td>2025-06-11</td>
        <td>10:00 - 14:00</td>
        <td>Pendiente</td>
      </tr>
      <tr>
        <td>3</td>
        <td>Andrea Díaz</td>
        <td>Cocina</td>
        <td>1427895</td>
        <td><span class="status-red">Manipulación de Alimentos</span></td>
        <td>Ambiente 07</td>
        <td>2025-06-12</td>
        <td>13:00 - 17:00</td>
        <td>Cancelada</td>
      </tr>
    </tbody>
  </table>
</body>
</html>


</x-layout>


