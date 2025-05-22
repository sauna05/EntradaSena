<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>Crear Programa</x-slot:title>
  

    <h2>Registrar Nuevo Programa</h2>


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('programming.Programan_store') }}" class="program-form">
        @csrf
        <div class="form-group">
            <label for="name">Nombre del Programa</label>
            <input type="text" name="name" id="name" required>
        </div>

        <div class="form-group">
            <label for="program_code">Código del Programa</label>
            <input type="text" name="program_code" id="program_code" required>
        </div>

        <div class="form-group">
            <label for="program_version">Versión del Programa</label>
            <input type="text" name="program_version" id="program_version" required>
        </div>

        <div class="form-group">
            <label for="id_level">Nivel del Programa</label>
            <select name="id_level" id="id_level" required>
                <option value="">Seleccione nivel</option>
                @foreach ($programan_level as $level)
                    <option value="{{ $level->id }}">{{ $level->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <button type="submit" class="submit-btn">Registrar Programa</button>
        </div>
    </form>

    <style>
        .program-form {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            font-family: Arial, sans-serif;
        }

        .form-group {
            margin-bottom: 15px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .form-group input,
        .form-group select {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-btn {
            background-color: #007bff;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        .submit-btn:hover {
            background-color: #0056b3;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</x-layout>
