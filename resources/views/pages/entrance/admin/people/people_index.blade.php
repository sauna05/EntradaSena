<x-layout_asistencia>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>CAA</x-slot:title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 30px 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        h-1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #343a40;
        }

        .session-message {
            padding: 12px 16px;
            margin-bottom: 20px;
            background-color: #d1e7dd;
            color: #0f5132;
            border: 1px solid #badbcc;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .search-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
            background-color: #f1f3f5;
            border-radius: 6px;
            padding: 20px;
            justify-content: space-between;
        }

        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            flex-grow: 1;
        }

        .search-form input[type="text"],
        .search-form select {
            padding: 10px 12px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .search-form input[type="text"] {
            min-width: 240px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23999' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 10px center;
            background-size: 16px;
            padding-left: 35px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
            background-color: white;
            border-radius: 6px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #e9ecef;
            text-align: left;
            color: #495057;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 12px;
            font-size: 0.8rem;
            background-color: #0d6efd;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-action:hover {
            background-color: #084298;
        }

        .pagination {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .pagination a,
        .pagination span {
            padding: 8px 14px;
            border-radius: 4px;
            border: 1px solid #dee2e6;
            color: #0d6efd;
            text-decoration: none;
            transition: all 0.2s ease-in-out;
        }

        .pagination .active span {
            background-color: #0d6efd;
            color: white;
            border-color: #0d6efd;
        }

        .no-results {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 20px 0;
        }

        @media screen and (max-width: 768px) {
            .search-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .search-form input,
            .search-form select {
                width: 100%;
            }
        }
    </style>

    <div class="container">
        <h1 class="h-1">PERSONAS EN EL CENTRO DE FORMACIÓN</h1>

        @if (session('message'))
            <div id="session-message" class="session-message">
                <i class="fas fa-check-circle"></i> {{ session('message') }}
            </div>
            <script>
                setTimeout(() => {
                    const msg = document.getElementById('session-message');
                    if (msg) {
                        msg.style.transition = 'opacity 0.5s';
                        msg.style.opacity = 0;
                        setTimeout(() => msg.remove(), 500);
                    }
                }, 4000);
            </script>
        @endif

        {{-- Búsqueda --}}
        <section class="search-container">
            <form method="GET" action="{{ route('entrance.people.index') }}" class="search-form">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre o documento">
                <x-button type="submit">
                    <i class="fas fa-search"></i> Buscar
                </x-button>

                <select name="position" onchange="this.form.submit()">
                    <option value="">Filtrar por Cargo</option>
                    @foreach ($positions as $position)
                        <option value="{{ $position->id }}" {{ request('position') == $position->id ? 'selected' : '' }}>
                            {{ $position->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </section>

        {{-- Tabla --}}
        <section>
            @if ($person->isEmpty())
                <div class="no-results">
                    <i class="fas fa-info-circle"></i> No se encontraron resultados
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Cargo</th>
                            <th>Documento</th>
                            <th>Nombre</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($person as $p)
                            <tr>
                                <td>{{ $p->id }}</td>
                                <td>{{ $p->position->name }}</td>
                                <td>{{ $p->document_number }}</td>
                                <td>{{ $p->name }}</td>
                                <td>{{ $p->start_date->format('d/m/Y') }}</td>
                                <td>{{ $p->end_date->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('entrance.people.show', $p->id) }}" class="btn-action">
                                        <i class="fas fa-id-card"></i> Permiso
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </section>

        <div class="pagination">
            {{ $person->links() }}
        </div>
    </div>
</x-layout_asistencia>
