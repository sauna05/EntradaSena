<x-layout>
    <x-slot:title>Editar Registro</x-slot:title>

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .h-1 {
            text-align: center;
            color: #34516b;
            margin-top: 20px;
            font-size: 24px;
        }

        .container {
            max-width: 900%; /* ancho limitado */
            margin: 40px auto;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        form.form-create-people {
            background-color: white;
            max-width: 800px;
            margin: 20px auto;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        section > div {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 6px;
            font-weight: 600;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #f9f9f9;
            transition: border 0.3s ease;
        }

        input:focus,
        select:focus {
            border-color: #1b5e20;
            background-color: #fff;
        }

        .btn-register {
            background-color: #1b5e20;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-register:hover {
            background-color: #2e7d32;
        }

        .days-checkboxes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 10px;
            margin-top: 20px;
        }

        .days-checkboxes div {
            background-color: #f0f4f8;
            padding: 10px 14px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            transition: background-color 0.2s ease;
        }

        .days-checkboxes div:hover {
            background-color: #e0f2f1;
        }

        .days-checkboxes label {
            margin: 0;
            font-weight: 500;
            color: #2c3e50;
        }

        .delete-section {
            margin-top: 40px;
            padding: 20px;
            background-color: #ffeaea;
            border-radius: 8px;
            text-align: center;
        }

        .btn-delete {
            background-color: #c62828;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #b71c1c;
        }

        @media (max-width: 768px) {
            section > div {
                flex: 1 1 100%;
            }
        }
    </style>

    <div class="container">
        <h1 class="h-1">Editar Registro de {{ $person->name }}</h1>

        {{-- Formulario para editar los datos de la persona --}}
        <form action="{{ route('entrance.people.update', $person->id) }}" method="POST" class="form-create-people">
            @method('PUT')
            @csrf

            <section>
                {{-- Cargo --}}
                <div>
                    <label for="id_position">Cargo</label>
                    <select name="id_position" id="id_position">
                        <option value="">Seleccione un cargo</option>
                        @foreach($positions as $id => $position)
                            <option value="{{ $position->id }}" {{ $person->id_position == $position->id ? 'selected' : '' }}>
                                {{ $position->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Documento --}}
                <div>
                    <label for="document_number">Número de Documento</label>
                    <input type="text" name="document_number" id="document_number" value="{{ $person->document_number }}">
                </div>

                {{-- Nombre --}}
                <div>
                    <label for="name">Nombre Completo</label>
                    <input type="text" name="name" id="name" value="{{ $person->name }}">
                </div>


                {{-- Fecha Inicio --}}
                <div>
                    <label for="start_date">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $person->start_date->format('Y-m-d') }}">
                </div>

                {{-- Fecha Fin --}}
                <div>
                    <label for="end_date">Fecha de Finalización</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $person->end_date->format('Y-m-d') }}">
                </div>
            </section>

            {{-- Mostrar errores --}}
            @if ($errors->any())
                <div style="color: red; margin-top: 10px;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Checkboxes de días --}}
            <section>
                <p style="font-weight: 600; margin-bottom: 10px;">Editar Días que puede asistir al centro:</p>
                <div class="days-checkboxes">
                    @foreach ($days_available as $day)
                        <div>
                            <input style="cursor: pointer" type="checkbox" name="days[]" value="{{ $day->id }}"
                                {{ $person->days_available->contains('id', $day->id) ? 'checked' : '' }} id="day_{{ $day->id }}">
                            <label for="day_{{ $day->id }}">{{ $day->name }}</label>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Botón Guardar --}}
            <button type="submit" class="btn-register">Guardar Cambios</button>

        </form>
        <div class="delete-section">
            <form action="{{ route('entrance.people.delete', $person->id) }}" method="POST" onsubmit="return eliminarReturn()">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Eliminar Registro</button>
            </form>
        </div>

        {{-- Eliminar --}}

    </div>

    {{-- Confirmación para eliminar --}}
    <script>
        function eliminarReturn() {
            return confirm("¿Está seguro que desea eliminar este registro?");
        }
    </script>
</x-layout>
