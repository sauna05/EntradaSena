<x-layout>
    <x-slot:title>Editar Registro</x-slot:title>

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #e0f7fa 0%, #e8f5e9 100%);
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 950px;
            margin: 40px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        }
        .h-1 {
            text-align: center;
            color: #1e3a8a;
            font-size: 28px;
            margin-bottom: 25px;
            font-weight: 700;
        }
        form.form-create-people {
            max-width: 850px;
            margin: 0 auto;
            padding: 25px;
            background-color: #fafafa;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.06);
        }
        section {
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            margin-bottom: 20px;
        }
        section > div {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 6px;
            font-weight: 600;
            color: #374151;
        }
        input[type="text"], input[type="email"], input[type="number"],
        input[type="date"], select {
            padding: 12px 14px;
            border: 1px solid #cbd5e1;
            border-radius: 10px;
            background-color: #f8fafc;
            transition: all 0.3s ease;
            font-size: 15px;
        }
        input:focus, select:focus {
            border-color: #2563eb;
            background-color: #fff;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.2);
        }
        .btn-register {
            background: linear-gradient(90deg, #2563eb 0%, #1e40af 100%);
            color: #fff;
            padding: 14px 22px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            display: inline-block;
            transition: transform 0.2s ease, background 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            background: linear-gradient(90deg, #1d4ed8 0%, #1e3a8a 100%);
        }
        .days-checkboxes {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
            gap: 12px;
            margin-top: 15px;
        }
        .days-checkboxes div {
            background-color: #f0f4f8;
            padding: 12px 16px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.2s ease, transform 0.2s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        .days-checkboxes div:hover {
            background-color: #dbeafe;
            transform: translateY(-1px);
        }
        .days-checkboxes label {
            margin: 0;
            font-weight: 500;
            color: #1e293b;
        }
        .delete-section {
            margin-top: 50px;
            padding: 20px;
            background: #fff1f2;
            border: 1px solid #fecaca;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 6px 12px rgba(0,0,0,0.05);
        }
        .btn-delete {
            background: linear-gradient(90deg, #dc2626 0%, #b91c1c 100%);
            color: #fff;
            padding: 12px 24px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: transform 0.2s ease, background 0.3s ease;
        }
        .btn-delete:hover {
            transform: translateY(-2px);
            background: linear-gradient(90deg, #b91c1c 0%, #7f1d1d 100%);
        }
        @media (max-width: 768px) {
            section > div { flex: 1 1 100%; }
        }
    </style>

    <div class="container">
        <h1 class="h-1">Editar Registro de {{ $person->name }}</h1>

        {{-- Formulario principal --}}
        <form action="{{ route('entrance.people.update', $person->id) }}" method="POST" class="form-create-people">
            @method('PUT')
            @csrf

            <section>
                {{-- Cargo --}}
                <div>
                    <label for="id_position">Cargo</label>
                    <select name="id_position" id="id_position">
                        <option value="">Seleccione un cargo</option>
                        @foreach($positions as $position)
                            <option value="{{ $position->id }}"
                                {{ $person->id_position == $position->id ? 'selected' : '' }}>
                                {{ $position->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Documento --}}
                <div>
                    <label for="document_number">Número de Documento</label>
                    <input type="text" name="document_number" id="document_number"
                           value="{{ $person->document_number }}">
                </div>

                {{-- Nombre --}}
                <div>
                    <label for="name">Nombre Completo</label>
                    <input type="text" name="name" id="name" value="{{ $person->name }}">
                </div>

                {{-- Fecha Inicio --}}
                <div>
                    <label for="start_date">Fecha de Inicio</label>
                    <input type="date" name="start_date" id="start_date"
                           value="{{ $person->start_date->format('Y-m-d') }}">
                </div>

                {{-- Fecha Fin --}}
                <div>
                    <label for="end_date">Fecha de Finalización</label>
                    <input type="date" name="end_date" id="end_date"
                           value="{{ $person->end_date->format('Y-m-d') }}">
                </div>
            </section>

            {{-- Errores --}}
            @if ($errors->any())
                <div style="color: #dc2626; margin-top: 10px; font-weight:600;">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ===== Bloque extra si es Instructor ===== --}}
            @if (strtolower($person->position->name) === 'instructor')
                <hr style="margin:30px 0; border-color:#e2e8f0;">
                <h2 style="color:#1e40af; margin-bottom:20px; text-align:center;">Información de Instructor</h2>
                <section>
                    <div>
                        <label for="id_link_type">Tipo de Vinculación</label>
                        <select name="id_link_type" id="id_link_type">
                            @foreach($link_types as $link)
                                <option value="{{ $link->id }}"
                                    {{ optional($person->instructor)->id_link_type == $link->id ? 'selected' : '' }}>
                                    {{ $link->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="id_speciality">Especialidad</label>
                        <select name="id_speciality" id="id_speciality">
                            @foreach($specialities as $spec)
                                <option value="{{ $spec->id }}"
                                    {{ optional($person->instructor)->id_speciality == $spec->id ? 'selected' : '' }}>
                                    {{ $spec->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="assigned_hours">Horas Asignadas</label>
                        <input type="number" name="assigned_hours" id="assigned_hours"
                               value="{{ optional($person->instructor)->assigned_hours }}">
                    </div>
                    <div>
                        <label for="hours_day">Horas por Día</label>
                        <input type="number" step="0.5" name="hours_day" id="hours_day"
                               value="{{ optional($person->instructor)->hours_day }}">
                    </div>
                </section>
            @endif

            {{-- Días disponibles --}}
            <section>
                <p style="font-weight: 600; margin-bottom: 10px;">Editar Días que puede asistir al centro:</p>
                <div class="days-checkboxes">
                    @foreach ($days_available as $day)
                        <div>
                            <input style="cursor: pointer" type="checkbox" name="days[]" value="{{ $day->id }}"
                                {{ $person->days_available->contains('id', $day->id) ? 'checked' : '' }}
                                id="day_{{ $day->id }}">
                            <label for="day_{{ $day->id }}">{{ $day->name }}</label>
                        </div>
                    @endforeach
                </div>
            </section>

            {{-- Guardar --}}
            <button type="submit" class="btn-register">Guardar Cambios</button>
        </form>

        {{-- Eliminar --}}
        <div class="delete-section">
            <form action="{{ route('entrance.people.delete', $person->id) }}" method="POST" onsubmit="return eliminarReturn()">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Eliminar Registro</button>
            </form>
        </div>
    </div>

    <script>
        function eliminarReturn() {
            return confirm("¿Está seguro que desea eliminar este registro?");
        }
    </script>
</x-layout>
