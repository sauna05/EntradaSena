<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Administrar Competencias - Ficha {{ $cohort->number_cohort }}</x-slot:title>

    <style>
        /* --- ESTILOS GENERALES --- */
        .admin-header {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }

        .page-title {
            color: #28a745;
            margin-bottom: 15px;
            font-size: 28px;
        }

        .ficha-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .info-card {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
        }

        .info-card h3 {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 5px;
        }

        .info-card p {
            font-size: 16px;
            font-weight: 500;
        }

        .tabs {
            display: flex;
            border-bottom: 2px solid #dee2e6;
            margin-bottom: 20px;
        }

        .tab {
            padding: 12px 20px;
            cursor: pointer;
            font-weight: 500;
            border-bottom: 3px solid transparent;
            margin-bottom: -2px;
        }

        .tab.active {
            border-bottom-color: #28a745;
            color: #28a745;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            padding: 15px 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-header h2 {
            font-size: 18px;
            color: #343a40;
        }

        /* --- BOTONES --- */
       .btn {
            padding: 8px 16px;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s;
            width: max-content; /* 👈 evita que ocupen todo el ancho */
}


        .btn-primary {
            background-color: #28a745;
            color: white;
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        /* --- TABLA --- */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #dee2e6;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f8f9fa;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 16px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .status-active {
            background-color: #d1fae5;
            color: #065f46;
        }

        /* --- MODAL --- */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(-20px);}
            to {opacity: 1; transform: translateY(0);}
        }

        .modal-content h3 {
            margin-bottom: 15px;
            font-size: 20px;
            color: #28a745;
        }

        .modal-content .form-group {
            margin-bottom: 15px;
        }

        .modal-content label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .modal-content input,
        .modal-content select {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal-content .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-secondary {
            background-color: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .close {
            float: right;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            cursor: pointer;
        }
    </style>

    <div class="container">
        <div class="admin-header">
            <h1 class="page-title">Administrar Competencias - Ficha {{ $cohort->number_cohort }}</h1>

            <div class="ficha-info">
                <div class="info-card">
                    <h3>Programa de Formación</h3>
                    <p>{{ $cohort->program->name ?? 'N/A' }}</p>
                </div>
                <div class="info-card">
                    <h3>Jornada</h3>
                    <p>{{ $cohort->cohortime->name ?? 'N/A' }}</p>
                </div>
                <div class="info-card">
                    <h3>Municipio</h3>
                    <p>{{ $cohort->town->name ?? 'N/A' }}</p>
                </div>
                <div class="info-card">
                    <h3>Fecha Inicio - Fin</h3>
                    <p>{{ $cohort->start_date }} - {{ $cohort->end_date }}</p>
                </div>
                <div class="info-card">
                    <h3>Matriculados</h3>
                    <p>{{ $cohort->enrolled_quantity }} Aprendices</p>
                </div>
            </div>
        </div>

        <div class="tabs">
            <div class="tab active" data-tab="asignadas">Competencias</div>
            <div class="tab" data-tab="programaciones">Programaciones</div>
        </div>

        <div class="tab-content active" id="asignadas">
            <div class="card">
                <div class="card-header">
                    <h2>Competencias Asignadas a la Ficha</h2>
                    <!-- Botón para abrir modal -->
                    <button class="btn btn-primary" onclick="openModal('competenceModal')">
                        Registrar Competencia
                    </button>
                </div>

                @if($assignedCompetencies->count() > 0)
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre de la Competencia</th>
                            <th>Duración (Horas)</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($assignedCompetencies as $competence)
                        <tr>
                            <td>{{ $competence->code ?? 'N/A' }}</td>
                            <td>{{ $competence->name }}</td>
                            <td>{{ $competence->duration_hours }} hrs</td>
                            <td><span class="status-badge status-active">Asignada</span></td>
                            <td class="actions">
                                <button class="btn btn-primary btn-sm">Programar</button>
                                <button class="btn btn-danger btn-sm">Quitar</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div style="padding: 20px; text-align: center; color: #6c757d;">
                    <p>No hay competencias asignadas a esta ficha</p>
                </div>
                @endif
            </div>
        </div>
    </div>

   <!-- Modal Registrar Competencia -->
<div id="competenceModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal('competenceModal')">&times;</span>
        <h3>Registrar Nueva Competencia</h3>

        <!-- Mensajes de error generales -->
        @if ($errors->any())
            <div style="background: #fdecea; color: #d93025; padding: 10px; border-radius: 6px; margin-bottom: 15px;">
                <ul style="margin: 0; padding-left: 18px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('programing.competencies_store') }}">
            @csrf
            <input type="hidden" name="cohort_id" value="{{ $cohort->id }}">

            <div class="form-group">
                <label for="speciality_id">Especialidad *</label>
                <select name="speciality_id" id="speciality_id" required>
                    <option value="">Seleccione especialidad</option>
                    @forelse ($especialidad as $espe)
                        <option value="{{ $espe->id }}" {{ old('speciality_id') == $espe->id ? 'selected' : '' }}>
                            {{ $espe->name }}
                        </option>
                    @empty
                        <option value="">No hay especialidades registradas</option>
                    @endforelse
                </select>
                @error('speciality_id')
                    <p style="color: #d93025; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="name">Nombre de la competencia *</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Ingrese el nombre de la competencia">
                @error('name')
                    <p style="color: #d93025; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="duration_hours">Duración (horas) *</label>
                <input type="number" id="duration_hours" name="duration_hours" value="{{ old('duration_hours') }}" required min="1" placeholder="Horas de duración">
                @error('duration_hours')
                    <p style="color: #d93025; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="closeModal('competenceModal')">Cancelar</button>
                <button type="submit" class="btn btn-primary">Crear y Asignar</button>
            </div>
        </form>
    </div>
</div>


    <script>
        // Funcionalidad de pestañas
        document.querySelectorAll('.tab').forEach(tab => {
            tab.addEventListener('click', () => {
                document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));

                tab.classList.add('active');
                document.getElementById(tab.dataset.tab).classList.add('active');
            });
        });

        // Abrir y cerrar modal
        function openModal(id) {
            document.getElementById(id).style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeModal(id) {
            document.getElementById(id).style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = "none";
                document.body.style.overflow = 'auto';
            }
        }

        // Cerrar con ESC
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.style.display = 'none';
                });
                document.body.style.overflow = 'auto';
            }
        });

        // Mostrar mensajes de éxito/error
        @if(session('success'))
            alert('{{ session('success') }}');
        @endif

        @if(session('error'))
            alert('{{ session('error') }}');
        @endif

        @if($errors->any())
            openModal('competenceModal');
        @endif
    </script>
</x-layout>
