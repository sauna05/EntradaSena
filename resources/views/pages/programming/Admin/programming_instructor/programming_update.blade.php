<x-layout>
    <x-slot:title>Listado de programaciones</x-slot:title>
    
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            
        }
        .btn-register {
    background-color: #28a745;
    color: white;
    padding: 4px 8px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.btn-register:hover {
    background-color: #218838;
}

.status-ok {
    color: #28a745;
    font-weight: bold;
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
                        <th>Estado de registro</th>
                        <th>Registrar</th>
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
                            <td>{{ $programacion->start_date }}</td>
                            <td>{{ $programacion->end_date }}</td>
                            <td>{{ $programacion->start_time }} - {{ $programacion->end_time }}</td>
                            <td>{{ $programacion->statu_programming }}</td>
                            <td>
                                @if ($programacion->statu_programming !== 'ok')
                                    <form action="{{ route('programing.programming_update', $programacion->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn-register">✔ Marcar como registrada</button>
                                    </form>
                                @else
                                    <span class="status-ok">✔ Registrada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" style="text-align: center;">No hay programaciones registradas</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
    </div>
  </x-layout>