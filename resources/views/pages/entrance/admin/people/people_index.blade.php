<x-layout_asistencia>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/entrance/admin/people_index.css</x-slot:page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>CAA</x-slot:title>
    
    {{-- Incluir Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Estilos generales */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
      
        
        /* Mensajes de sesión */
        .session-message {
            padding: 10px 15px;
            margin-bottom: 20px;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            border-radius: 4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .session-message i {
            font-size: 1.1rem;
        }
        
        /* Contenedor de búsqueda */
        .search-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }
        
        .search-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            flex-grow: 1;
        }
        
        .search-form div {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        
        .search-form input[type="text"] {
            padding: 8px 12px 8px 35px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 0.9rem;
            min-width: 250px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23999' viewBox='0 0 16 16'%3E%3Cpath d='M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: 12px center;
            background-size: 16px;
        }
        
        .search-form select {
            padding: 8px 12px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 0.9rem;
            background-color: white;
        }
        
        .btn-search-container {
            display: flex;
            gap: 10px;
        }
        
        .btn-search-container a {
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
        }
        
        /* Estilos de la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
        
        th, td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }
        
        th {
            background-color: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        
        tr:hover {
            background-color: #f8f9fa;
        }
        
        /* Estilos para el botón de permiso de entrada */
        .btn-action {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 10px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.8rem;
            transition: background-color 0.2s;
        }
        
        .btn-action:hover {
            background-color: #0056b3;
        }
        
        /* Estilos para la paginación */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        
        .pagination a, .pagination span {
            padding: 8px 12px;
            margin: 0 5px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            color: #007bff;
            text-decoration: none;
        }
        
        .pagination .active {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        
        /* Mensaje cuando no hay resultados */
        .no-results {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-style: italic;
        }
    </style>

    <div class="container">
        <h1>PERSONAS EN EL CENTRO DE FORMACIÓN</h1>

        @if (session('message'))
            <div class="session-message">
                <i class="fas fa-check-circle"></i>
                {{ session('message') }}
            </div>
        @endif

        <section class="search-container">
            {{-- Formulario de búsqueda --}}
            <form method="GET" action="{{ route('entrance.people.index') }}" class="search-form">
                <div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nombre o documento">
                    <x-button type="submit">
                        <i class="fas fa-search"></i> Buscar
                    </x-button>
                </div>

                {{-- Filtro por cargo --}}
                <div>
                    <select name="position" onchange="this.form.submit()">
                        <option value="">Filtrar por Cargo</option>
                        @foreach ($positions as $position)
                            <option value="{{ $position->id }}"
                                @if ($position->id == request('position')) selected @endif>
                                {{ $position->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>

            <div class="btn-search-container">
                <a href="{{ route('entrance.people.create') }}">
                    <x-button>
                        <i class="fas fa-user-plus"></i> Registrar Persona
                    </x-button>
                </a>
            </div>
        </section>

        {{-- Tabla de personas --}}
        <section>
            @if ($person->isEmpty())
                <h3 class="no-results">
                    <i class="fas fa-info-circle"></i> No se encontraron resultados
                </h3>
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