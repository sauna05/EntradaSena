<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>CAA</x-slot:title>
    <x-programming_navbar></x-programming_navbar>

    <title>Fichas</title>

    <h5>Bienvenido al apartado de programación, señor <p>{{ Auth::user()->user_name }}</p></h5>

    <body>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario de registro de fichas --}}
        <p>Programas</p>
        <form method="POST" action="{{ route('programming.Register') }}">
            @csrf

            <p>Programas</p>
            <select name="program_id" id="program_id" required>
                <option value="">Seleccione programas disponibles</option>
                @foreach ($programs as $pro)
                    <option value="{{ $pro->id }}">{{ $pro->name }}</option>
                @endforeach
            </select>

            <p>Instructores</p>
            <select name="instructor_id" id="instructor_id" required>
                <option value="">Seleccione instructores disponibles</option>
                @foreach ($instructors as $in)
                    <option value="{{ $in->id }}">{{ $in->name }}</option>
                @endforeach
            </select>

            <p>Jornada</p>
            <select name="cohortime_id" id="cohortime_id" required>
                <option value="">Seleccione jornada</option>
                @foreach ($cohortimes as $tms)
                    <option value="{{ $tms->id }}">{{ $tms->name }}</option>
                @endforeach
            </select>

            <p>Municipios</p>
            <select name="town_id" id="town_id" required>
                <option value="">Seleccione municipio</option>
                @foreach ($towns as $tn)
                    <option value="{{ $tn->id }}">{{ $tn->name }}</option>
                @endforeach
            </select>

            <p>Aulas</p>
            <select name="classroom_id" id="classroom_id" required>
                <option value="">Seleccione aula</option>
                @foreach ($classroom as $cl)
                    <option value="{{ $cl->id }}">{{ $cl->name }}</option>
                @endforeach
            </select>

            <p>Horas etapa escolar</p>
            <input type="number" name="hours_school_stage" required min="0">

            <p>Horas etapa práctica</p>
            <input type="number" name="hours_practical_stage" required min="0">

            <p>Fecha inicio etapa escolar</p>
            <input type="date" name="start_date_school_stage" required>

            <p>Fecha fin etapa escolar</p>
            <input type="date" name="end_date_school_stage" required>

            <p>Fecha inicio etapa práctica</p>
            <input type="date" name="start_date_practical_stage" required>

            <p>Fecha fin etapa práctica</p>
            <input type="date" name="end_date_practical_stage" required>

            <button type="submit">Registrar ficha</button>
        </form>



    </body>
</x-layout>
