<x-layout>
  <x-slot:title>Programación de Instructores</x-slot:title>
  <!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<style>
  body { font-family: Arial, sans-serif; background-color: #f4f6f8; margin: 0; padding: 0; }
  #buscarInstructor { width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 6px; border: 1px solid #ccc; }
  .alert-warning { width:100%; background:#fff3cd; color:#856404; padding:10px; margin:10px 0; border-radius:4px; border:1px solid #ffeeba; display:none; }
  .container { max-width: 950px; margin: 40px auto; background: #fff; padding: 30px; box-shadow: 0 0 10px rgba(0,0,0,0.1); border-radius: 10px; }
  h2 { color: #2c3e50; }
  label { font-weight: bold; margin-top: 15px; display: block; }
  select, input[type="time"], input[type="number"], input[type="date"] { width:100%; padding:10px; margin-top:5px; border:1px solid #ccc; border-radius:6px; }
  .day-checkboxes { display:flex; gap:10px; flex-wrap:wrap; margin-top:10px; }
  .day-checkboxes label { font-weight: normal; }
  .submit-btn { background:#3498db; color:#fff; padding:12px 20px; margin-top:25px; border:none; border-radius:6px; cursor:pointer; font-size:16px; }
  .submit-btn:hover { background:#2980b9; }
  .two-cols { display:flex; gap:20px; }
  .two-cols > div { flex:1; }
  .alert-success{ width:100%; background:#d4edda; color:#155724; padding:10px; margin-bottom:20px; border-radius:4px; border:1px solid #c3e6cb; }
  .alert-danger{ width:100%; background:#f8d7da; color:#721c24; padding:10px; margin-bottom:20px; border-radius:4px; border:1px solid #f5c6cb; }
  .error-message { color:#dc3545; font-size:0.875em; margin-top:5px; }
  .time-container { display:flex; align-items:center; gap:10px; }
  .time-container input { width:auto; }
  .alert-info { width:100%; background:#d1ecf1; color:#0c5460; padding:10px; margin:10px 0; border-radius:4px; border:1px solid #bee5eb; }
  .excluded-dates { margin-top:5px; font-size:0.9em; color:#6c757d; }
</style>
</head>
<body>
<div class="container">
  <h2>Programación de Cursos</h2>

  @if (session('success'))
      <div class="alert-success">{{ session('success') }}</div>
  @endif

  @if (session('error'))
      <div class="alert-danger">{{ session('error') }}</div>
  @endif

  @if ($errors->any())
      <div class="alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <form id="programmingForm" action="{{ route('programming.register_programming_instructor_store') }}" method="POST">
    @csrf

    {{-- FICHA --}}
    <label for="ficha">Seleccione ficha y programa</label>
    <select id="ficha" name="ficha_id" required>
      <option value="">Seleccione</option>
      @foreach ($cohorts as $ficha)
        <option value="{{ $ficha->id }}">{{ $ficha->number_cohort }} - {{ $ficha->program->name }}</option>
      @endforeach
    </select>

    {{-- COMPETENCIA (DE LA FICHA) --}}
    <label for="competencia">Competencia:</label>
    <select id="competencia" name="competencia_id" disabled required>
      <option value="">Seleccione una ficha primero</option>
    </select>
    <div id="noCompetenciasAlert" class="alert-warning">La ficha seleccionada no tiene competencias asignadas. Por favor registrele competencias  <a href="{{ route('programing.competencies_index_administrar', $ficha->id) }}"> aqui </a></div>

    {{-- BUSCADOR + INSTRUCTOR (FILTRADO POR COMPETENCIA) --}}
    <label for="buscarInstructor">Buscar Instructor:</label>
    <input type="text" id="buscarInstructor" placeholder="Escribe el nombre o documento" disabled>

    <label for="instructor">Instructor:</label>
    <select id="instructor" name="instructor_id" disabled required>
      <option value="">Seleccione una competencia primero</option>
    </select>
    <div id="noInstructorAlert" class="alert-warning">Ningún instructor tiene la competencia seleccionada. Por favor asignele la competencia <a href="{{ route('programing.programming_instructors_profiles') }}">Aqui</a></div>

    {{-- AMBIENTE --}}
    <label for="ambiente">Ambiente:</label>
    <select id="ambiente" name="ambiente_id" required>
      <option value="">Seleccione Ambiente</option>
      @foreach ($ambientes as $ambiente)
        <option value="{{ $ambiente->id }}">
          {{ $ambiente->Block->name }} - {{ $ambiente->name }} - {{ $ambiente->towns->name }}
        </option>
      @endforeach
    </select>

    {{-- FECHAS --}}
    <div class="two-cols">
      <div>
        <label for="fecha_inicio">Fecha Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required />
      </div>
      <div>
        <label for="fecha_fin">Fecha Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" value="{{ old('fecha_fin') }}" required />
      </div>
    </div>

    {{-- HORARIO --}}
    <label>Horario:</label>
    <div class="time-container">
      <input type="time" id="hora_inicio" name="hora_inicio" value="{{ old('hora_inicio') }}" required min="06:00" max="23:00" step="1800" />
      <span>a</span>
      <input type="time" id="hora_fin" name="hora_fin" value="{{ old('hora_fin') }}" required min="06:00" max="23:00" step="1800" />
    </div>

    <div id="horasCalculadas" class="error-message"></div>

    {{-- DÍAS --}}
    <label>Días de la semana:</label>
    <div class="day-checkboxes">
      @php $dias = ['Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo']; @endphp
      @foreach ($dias as $dia)
        <label>
          <input type="checkbox" name="dias[]" value="{{ $dia }}" {{ is_array(old('dias')) && in_array($dia, old('dias')) ? 'checked' : '' }}>
          {{ $dia }}
        </label>
      @endforeach
    </div>
    <div id="diasError" class="error-message"></div>

    {{-- HORAS --}}
    <div class="two-cols">
      <div>
        <label for="horas_dia">Horas Diarias:</label>
        <input type="number" id="horas_dia" name="horas_dia" min="1" max="8" step="0.01" value="{{ old('horas_dia', 1) }}" readonly />
      </div>
      <div>
        <label for="total_horas">Horas a programar:</label>
        <input type="number" id="total_horas" name="total_horas" min="1" step="0.01" value="{{ old('total_horas') }}" required readonly />
      </div>
    </div>

    {{-- EXCLUIDAS --}}
    <div id="fechas-excluidas-info" class="alert-info" style="display:none;">
      <div id="excluded-dates-list" class="excluded-dates"></div>
      <div id="effective-days-info"></div>
    </div>

    <button type="submit" class="submit-btn">Guardar Programación</button>
  </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ----- ELEMENTOS -----
    const horaInicioInput     = document.getElementById('hora_inicio');
    const horaFinInput        = document.getElementById('hora_fin');
    const horasDiaInput       = document.getElementById('horas_dia');
    const totalHorasInput     = document.getElementById('total_horas');
    const diasCheckboxes      = document.querySelectorAll('input[name="dias[]"]');
    const fechaInicioInput    = document.getElementById('fecha_inicio');
    const fechaFinInput       = document.getElementById('fecha_fin');
    const horasCalculadasDiv  = document.getElementById('horasCalculadas');
    const selectInstructor    = document.getElementById('instructor');
    const selectCompetencia   = document.getElementById('competencia');
    const selectFicha         = document.getElementById('ficha');
    const buscarInput         = document.getElementById('buscarInstructor');
    const noCompetenciesAlert = document.getElementById('noCompetenciasAlert');
    const noInstructorAlert   = document.getElementById('noInstructorAlert');
    const fechasExcluidasInfo = document.getElementById('fechas-excluidas-info');
    const excludedDatesList   = document.getElementById('excluded-dates-list');
    const effectiveDaysInfo   = document.getElementById('effective-days-info');

    // ----- DATOS DESDE PHP -----
    const fechasExcluidas = @json(
        \App\Models\DbProgramacion\Days_training::pluck('date')
            ->map(fn($f) => \Carbon\Carbon::parse($f)->format('Y-m-d'))
            ->toArray()
    );

    // Cohort -> Competencias (id, name, hours)
        const cohortCompetencies = @json(
            $cohorts->mapWithKeys(fn($c) => [
                $c->id => $c->competences->map(fn($comp) => [
                    'id' => $comp->id,
                    'name' => $comp->name,
                    'hours' => $comp->duration_hours
                ])
            ])
        );

    // Competencia -> Instructores (id, name, doc)
    const competenciaInstructores = @json(
        \App\Models\DbProgramacion\Competencies::with('instructors.person')
            ->get()
            ->mapWithKeys(fn($c) => [
                $c->id => $c->instructors->map(fn($i) => [
                    'id'   => $i->id,
                    'name' => $i->person->name,
                    'doc'  => $i->person->document_number
                ])
            ])
    );

    // ----- ESTADO -----
    let competenciaHoras = 0;              // horas requeridas por la competencia seleccionada
    let selectOriginalSnapshot = null;     // para el buscador de instructores

    // ----- HELPERS -----
    function capitalize(str) { return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase(); }

    function resetCompetencia() {
        selectCompetencia.innerHTML = '<option value="">Seleccione competencia</option>';
        selectCompetencia.disabled = true;
        noCompetenciesAlert.style.display = 'none';
        competenciaHoras = 0;
    }

    function resetInstructor() {
        selectInstructor.innerHTML = '<option value="">Seleccione instructor</option>';
        selectInstructor.disabled = true;
        noInstructorAlert.style.display = 'none';
        buscarInput.value = '';
        buscarInput.disabled = true;
        selectOriginalSnapshot = null;
    }

    function setCompetenciaHorasFromSelection() {
        const fichaId = selectFicha.value;
        const compId  = parseInt(selectCompetencia.value);
        competenciaHoras = 0;
        if (!fichaId || !compId || !cohortCompetencies[fichaId]) return;

        const found = cohortCompetencies[fichaId].find(c => parseInt(c.id) === compId);
        if (found) competenciaHoras = Number(found.hours || 0);
    }

    // ----- EVENTOS -----
    // 1) Ficha → cargar competencias
    selectFicha.addEventListener('change', function() {
        resetCompetencia();
        resetInstructor();

        const fichaId = this.value;
        if (!fichaId || !cohortCompetencies[fichaId] || cohortCompetencies[fichaId].length === 0) {
            noCompetenciesAlert.style.display = 'block';
            return;
        }

        cohortCompetencies[fichaId].forEach(c => {
            selectCompetencia.innerHTML += `<option value="${c.id}">${c.name}</option>`;
        });

        selectCompetencia.disabled = true; // se habilita al usuario elegir
        noCompetenciesAlert.style.display = 'none';
        // Habilitamos el select ahora que hay opciones
        selectCompetencia.disabled = false;
    });

    // 2) Competencia → cargar instructores + set horas competencia
    selectCompetencia.addEventListener('change', function() {
        resetInstructor();
        setCompetenciaHorasFromSelection();
        calcularTotalHoras(); // recalcular comparaciones

        const compId = this.value;
        if (!compId || !competenciaInstructores[compId] || competenciaInstructores[compId].length === 0) {
            noInstructorAlert.style.display = 'block';
            return;
        }

        // Llenar instructores
        competenciaInstructores[compId].forEach(i => {
            selectInstructor.innerHTML += `<option value="${i.id}">${i.doc} - ${i.name}</option>`;
        });

        selectInstructor.disabled = false;
        noInstructorAlert.style.display = 'none';

        // Guardar snapshot para búsqueda
        selectOriginalSnapshot = Array.from(selectInstructor.options).map(op => ({value:op.value, text:op.text}));
        buscarInput.disabled = false;
    });

    // 3) Buscador de instructores
    buscarInput.addEventListener('input', function () {
        if (!selectOriginalSnapshot) return;

        const filtro = this.value.toLowerCase();
        // reconstruir el select
        selectInstructor.innerHTML = '';
        selectInstructor.appendChild(new Option('Seleccione instructor',''));
        selectOriginalSnapshot.forEach(op => {
            const txt = op.text.toLowerCase();
            if (txt.includes(filtro) || filtro === '') {
                const o = new Option(op.text, op.value);
                selectInstructor.appendChild(o);
            }
        });
    });

    // 4) Horas diarias
    function calcularHorasDiarias() {
        const hi = horaInicioInput.value, hf = horaFinInput.value;
        if (hi && hf) {
            const [h1,m1] = hi.split(':').map(Number);
            const [h2,m2] = hf.split(':').map(Number);
            const diff = (h2*60+m2) - (h1*60+m1);

            if (diff > 0) {
                const horas = diff / 60;
                horasDiaInput.value = horas.toFixed(2);
                horasCalculadasDiv.textContent = '';
            } else {
                horasDiaInput.value = '';
                horasCalculadasDiv.textContent = '⚠️ La hora final debe ser mayor a la hora inicial';
            }
            calcularTotalHoras();
            verificarFechasExcluidas();
        }
    }
    horaInicioInput.addEventListener('change', calcularHorasDiarias);
    horaFinInput.addEventListener('change', calcularHorasDiarias);

    // 5) Fechas excluidas
    function verificarFechasExcluidas() {
        const fi = fechaInicioInput.value, ff = fechaFinInput.value;
        const seleccionados = Array.from(diasCheckboxes).filter(cb => cb.checked).map(cb => cb.value);

        if (!fi || !ff || seleccionados.length === 0) {
            fechasExcluidasInfo.style.display = 'none';
            return;
        }

        const diasSemana = {'Lunes':1,'Martes':2,'Miércoles':3,'Jueves':4,'Viernes':5,'Sábado':6,'Domingo':0};
        const diasNum = seleccionados.map(d => diasSemana[d]);
        const start = new Date(fi), end = new Date(ff);

        const excluidas = [];
        let efectivos = 0;
        let cur = new Date(start);

        while (cur <= end) {
            const dow = cur.getDay();
            const ymd = cur.toISOString().split('T')[0];
            if (diasNum.includes(dow)) {
                if (fechasExcluidas.includes(ymd)) {
                    excluidas.push(new Date(ymd).toLocaleDateString('es-ES'));
                } else {
                    efectivos++;
                }
            }
            cur.setDate(cur.getDate()+1);
        }

        if (excluidas.length > 0) {
            fechasExcluidasInfo.style.display = 'block';
            excludedDatesList.innerHTML = `<strong>Fechas no laborables detectadas:</strong> ${excluidas.join(', ')}`;
            effectiveDaysInfo.innerHTML = `<strong>Días efectivos de programación:</strong> ${efectivos}`;
        } else {
            fechasExcluidasInfo.style.display = 'none';
        }
    }

    // 6) Total de horas (vs horas de la competencia)
    function calcularTotalHoras() {
        const fi = fechaInicioInput.value, ff = fechaFinInput.value;
        const horasDia = parseFloat(horasDiaInput.value);

        if (!fi || !ff || isNaN(horasDia)) { totalHorasInput.value = ''; return; }

        const startDate = new Date(fi), endDate = new Date(ff);
        if (endDate <= startDate) {
            totalHorasInput.value = '';
            horasCalculadasDiv.textContent = '⚠️ La fecha fin debe ser mayor a la fecha inicio';
            return;
        }

        const seleccionados = Array.from(diasCheckboxes).filter(cb => cb.checked).map(cb => cb.value);
        let total = 0;
        let cur = new Date(startDate);
        let excluidos = 0;

        while (cur <= endDate) {
            const diaSemana = capitalize(cur.toLocaleDateString('es-ES', { weekday: 'long' }));
            const ymd = cur.toISOString().split('T')[0];

            if (seleccionados.includes(diaSemana)) {
                if (!fechasExcluidas.includes(ymd)) {
                    total += horasDia;
                } else {
                    excluidos++;
                }
            }
            cur.setDate(cur.getDate()+1);
        }

        totalHorasInput.value = total.toFixed(2);

        if (competenciaHoras > 0) {
            if (total < competenciaHoras) {
                const faltan = competenciaHoras - total;
                horasCalculadasDiv.innerHTML = `
                    ⚠️ <strong>Horas programadas:</strong> ${total.toFixed(2)}<br>
                    <strong>Horas requeridas por la competencia:</strong> ${competenciaHoras}<br>
                    <strong>Horas faltantes:</strong> ${faltan.toFixed(2)}
                `;
            } else {
                horasCalculadasDiv.textContent = '';
            }
        }
    }

    // 7) Eventos de días/fechas
    diasCheckboxes.forEach(cb => cb.addEventListener('change', function() {
        calcularTotalHoras(); verificarFechasExcluidas();
    }));
    fechaInicioInput.addEventListener('change', function() {
        calcularTotalHoras(); verificarFechasExcluidas();
    });
    fechaFinInput.addEventListener('change', function() {
        calcularTotalHoras(); verificarFechasExcluidas();
    });

    // Inicializar (si hay valores previos de validación)
    if (fechaInicioInput.value && fechaFinInput.value) verificarFechasExcluidas();
});
</script>
</body>
</html>
</x-layout>
