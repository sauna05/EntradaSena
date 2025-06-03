<x-layout>
  <x-slot:title>Listado de programaciones</x-slot:title>
  
  <style>
      body {
          font-family: 'Segoe UI', sans-serif;
          background-color: #f4f4f4;
          
      }

      .container {
          width: 100%;
          margin: 0 auto;
          background: white;
          padding: 20px;
          border-radius: 8px;
          box-shadow: 0 0 10px rgba(0,0,0,0.1);
      }

      .h1 {
          text-align: center;
          margin-bottom: 30px;
          color: #333;
      }

      .table-responsive {
          overflow-x: auto;
      }

      table {
          width: 100%;
          border-collapse: collapse;
          margin-bottom: 20px;
      }

      th, td {
          padding: 12px 15px;
          text-align: left;
          border-bottom: 1px solid #ddd;
      }

      th {
          background-color: #f8f9fa;
          color: #495057;
          font-weight: 600;
      }

      tr:hover {
          background-color: #f8f9fa;
      }

      .status {
          font-weight: bold;
          border-radius: 20px;
          padding: 5px 10px;
          display: inline-block;
          font-size: 0.8rem;
          text-align: center;
          min-width: 100px;
      }

      .status-active {
          background-color: #d4edda;
          color: #155724;
      }

      .status-pending {
          background-color: #fff3cd;
          color: #856404;
      }

      .status-cancelled {
          background-color: #f8d7da;
          color: #721c24;
      }

      .status-completed {
          background-color: #cce5ff;
          color: #004085;
      }
      
      .alert-danger {
          background-color: #f8d7da;
          color: #721c24;
          padding: 10px;
          border-radius: 4px;
          margin-bottom: 20px;
      }
  </style>


  <div class="container">
      <h1 class="h1">Listado de Programaciones</h1>
      
      @if(session('error'))
          <div class="alert alert-danger">
              {{ session('error') }}
          </div>
      @endif

      <div class="table-responsive">
          <table>
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Instructor</th>
                      <th>Programa</th>
                      <th>Ficha</th>
                      <th>Competencia</th>
                      <th>Ambiente</th>
                      <th>Fecha Inicio</th>
                      <th>Fecha Fin</th>
                      <th>Horario</th>
                      <th>Estado</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($programaciones as $programacion)
                      <tr>
                          <td>{{ $programacion->id }}</td>
                          <td>{{ $programacion->instructor->person->name ?? 'N/A' }}</td>
                          <td>{{ $programacion->cohort->program->name ?? 'N/A' }}</td>
                          <td>{{ $programacion->cohort->number_cohort ?? 'N/A' }}</td>
                          <td>{{ $programacion->competencie->name ?? 'N/A' }}</td>
                          <td>{{ $programacion->classroom->name ?? 'N/A' }}</td>
                          <td>{{ $programacion->start_date}}</td>
                          <td>{{ $programacion->end_date}}</td>
                          <td>
                              {{ $programacion->start_time }} - 
                              {{ $programacion->end_time}}
                          </td>
                          <td>
                            @php
                            $estados = [
                                'en_ejecucion' => ['color' => 'status-pending', 'text' => 'En ejecución'],
                                'finalizada_evaluada' => ['color' => 'status-active', 'text' => 'Finalizada y evaluada'],
                                'finalizada_no_evaluada' => ['color' => 'status-cancelled', 'text' => 'Finalizada sin evaluar'],
                            ];
                            $estado = $estados[$programacion->estado] ?? ['color' => 'status-completed', 'text' => 'Desconocido'];
                        @endphp
                        <span class="status {{ $estado['color'] }}">
                            {{ $estado['text'] }}
                        </span>
                        
                        </td>
                        
                      </tr>
                  @empty
                      <tr>
                          <td colspan="10" style="text-align: center;">No hay programaciones registradas</td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
  </div>
</x-layout>