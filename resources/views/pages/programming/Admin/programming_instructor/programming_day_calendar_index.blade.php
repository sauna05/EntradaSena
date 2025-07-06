<x-layout>
    <x-slot:title>Calendario Académico</x-slot:title>

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

        form.filtro-form {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        form.filtro-form select,
        form.filtro-form button {
            padding: 6px 12px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            font-size: 14px;
        }

        form.filtro-form button {
            background-color: #6c757d;
            color: white;
            cursor: pointer;
        }

        form.filtro-form button:hover {
            background-color: #495057;
        }

        .btn-nuevo {
            background-color: #0d6efd;
            color: white;
        }

        .alert {
            margin-bottom: 1em;
            padding: 10px;
            border-radius: 5px;
        }

        .alert-success {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #842029;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            top: 0; left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
        }

        .modal-content h3 {
            margin-top: 0;
            color: #333;
        }

        .modal-content input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .modal-content button {
            padding: 8px 16px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-save {
            background-color: #0d6efd;
            color: white;
        }

        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }

    </style>

    <div class="container">
        <h1 class="h1">📅 Días sin Formación Programada</h1>

        {{-- Filtros --}}
        <form method="GET" id="filtroForm" class="filtro-form">
            <label>Año:
                <select name="year" id="filtroYear">
                    @foreach(range(now()->year, now()->year - 5) as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </label>

            <label>Mes:
                <select name="month" id="filtroMonth">
                    <option value="">Todos</option>
                    @foreach(range(1,12) as $m)
                        <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($m)->locale('es')->isoFormat('MMMM') }}
                        </option>
                    @endforeach
                </select>
            </label>

            @if(request()->has('year') || request()->has('month'))
                <a href="{{ route('programing.unrecorded_days_index') }}">
                    <button type="button">Restablecer filtros</button>
                </a>
            @endif

            <button type="button" class="btn-nuevo" onclick="document.getElementById('modal').style.display='flex'" style="margin-left:auto;">➕ Nuevo Día</button>
        </form>

        {{-- Mensajes --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        {{-- Tabla --}}
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Motivo</th>
                        <th>Accion</th>
                    </tr>
                </thead>
               <tbody>
                    @forelse ($days as $day)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($day->date)->locale('es')->isoFormat('dddd D [de] MMMM [de] YYYY') }}</td>
                            <td>{{ $day->reason }}</td>
                            <td>
                                <form action="{{ route('programing.unrecorded_days_delete', $day->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('¿Estás seguro de eliminar este día?')" style="background:#dc3545;color:white;border:none;padding:6px 12px;border-radius:4px;cursor:pointer;">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No hay fechas registradas.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>

    {{-- Modal --}}
    <div id="modal" class="modal">
        <div class="modal-content">
            <h3>Registrar Día sin Formación</h3>
            <form method="POST" action="{{ route('programing.unrecorded_days_store') }}">
                @csrf
                <label for="date">Fecha:</label>
                <input type="date" name="date" required value="{{ old('date') }}">

                <label for="reason">Motivo:</label>
                <input type="text" name="reason" required value="{{ old('reason') }}">

                <div style="text-align: right;">
                    <button type="submit" class="btn-save">Guardar</button>
                    <button type="button" class="btn-cancel" onclick="document.getElementById('modal').style.display='none'">Cancelar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Cierra el modal al hacer clic fuera
        window.onclick = function(event) {
            const modal = document.getElementById('modal');
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }

        // Autoenviar el formulario si cambian año o mes
        document.getElementById('filtroYear').addEventListener('change', function () {
            document.getElementById('filtroForm').submit();
        });
        document.getElementById('filtroMonth').addEventListener('change', function () {
            document.getElementById('filtroForm').submit();
        });
    </script>
</x-layout>
