<x-layout>
    <x-slot:page_style></x-slot:page_style>
    <x-slot:title>Crear Ficha</x-slot:title>

    <style>
       body {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          background-color: #f4f6f8;
          margin: 0;
          padding: 0;
       }

       .container {
          max-width: 1200px;
          margin: 40px auto;
          padding: 40px;
          border-radius: 10px;
          background-color: white;
          box-shadow: 0 0 12px rgba(0, 0, 0, 0.08);
       }

       h2 {
          font-size: 26px;
          font-weight: bold;
          color: #2c3e50;
          margin-bottom: 20px;
          text-align: center;
       }

       .btn {
          background-color: #2980b9;
          color: white;
          width: max-content;
          border: none;
          padding: 10px 20px;
          font-size: 15px;
          border-radius: 8px;
          cursor: pointer;
          transition: background-color 0.3s ease;
          margin-bottom: 20px;
       }

       .btn:hover {
          background-color: #1c598c;
       }

       .form-buttons {
          display: flex;
          justify-content: flex-end;
          gap: 10px;
          margin-top: 20px;
          flex-wrap: wrap;
       }

       .form-buttons .btn {
          min-width: 100px;
       }

       /* Modal */
       .modal {
          display: none;
          position: fixed;
          z-index: 1000;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          overflow: auto;
          background-color: rgba(0, 0, 0, 0.5);
       }

       .modal-content {
          background-color: #fff;
          margin: 5% auto;
          padding: 30px;
          border-radius: 10px;
          width: 90%;
          max-width: 600px;
          max-height: 90vh;
          overflow-y: auto;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
          position: relative;
       }

       .close {
          color: #888;
          position: absolute;
          top: 10px;
          right: 20px;
          font-size: 28px;
          cursor: pointer;
       }

       .close:hover {
          color: red;
       }

       form label {
          display: block;
          margin-top: 14px;
          font-weight: 600;
          color: #333;
       }

       form input,
       form select {
          width: 100%;
          padding: 10px;
          margin-top: 6px;
          border: 1px solid #ccc;
          border-radius: 6px;
          background-color: #f9f9f9;
          font-size: 14px;
       }

       table {
          width: 100%;
          border-collapse: collapse;
          margin-top: 30px;
          background-color: white;
          border-radius: 8px;
          overflow: hidden;
          box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
       }

       table th,
       table td {
          padding: 12px 15px;
          text-align: left;
          border-bottom: 1px solid #eee;
          font-size: 14px;
       }
       .table-container{
         max-height: 400px;
            overflow-y: auto;

            border-radius: 8px;
            margin-top: 20px;
       }


       thead th {
          background-color: #ecf0f1;
          font-weight: bold;
          color: #2c3e50;
          position: sticky;
          top: 0;
        z-index: 1;
       }

       table tbody tr:hover {
          background-color: #f2f2f2;
       }

       .message {
          padding: 12px;
          border-radius: 6px;
          margin-bottom: 20px;
          font-size: 14px;
       }

       .success {
          background-color: #d4edda;
          color: #155724;
          border-left: 6px solid #28a745;
       }

       .error {
          background-color: #f8d7da;
          color: #721c24;
          border-left: 6px solid #dc3545;
       }

       .progress {
          background-color: #ddd;
          height: 20px;
          border-radius: 10px;
          overflow: hidden;
       }

       .progress-bar {
          height: 100%;
          color: white;
          text-align: center;
          line-height: 20px;
          font-size: 13px;
       }

       .bg-success {
          background-color: #28a745;
       }

       .bg-warning {
          background-color: #f0ad4e;
       }

       .bg-danger {
          background-color: #d9534f;
       }
    </style>

    <script>
       document.addEventListener('DOMContentLoaded', function () {
          const startSchoolInput = document.querySelector('input[name="start_date_school_stage"]');
          const endSchoolInput = document.querySelector('input[name="end_date_school_stage"]');
          const startPracticeInput = document.querySelector('input[name="start_date_practical_stage"]');
          const endPracticeInput = document.querySelector('input[name="end_date_practical_stage"]');

          startSchoolInput.addEventListener('change', function () {
             if (this.value) {
                const startDate = new Date(this.value);
                const minEndDate = new Date(startDate);
                minEndDate.setDate(startDate.getDate() + 15);
                endSchoolInput.min = minEndDate.toISOString().split('T')[0];

                endSchoolInput.addEventListener('change', function () {
                   if (this.value) {
                      const endSchoolDate = new Date(this.value);
                      const minPracticeStart = new Date(endSchoolDate);
                      minPracticeStart.setDate(endSchoolDate.getDate() + 1);
                      startPracticeInput.min = minPracticeStart.toISOString().split('T')[0];
                   }
                });
             }
          });

          startPracticeInput.addEventListener('change', function () {
             if (this.value) {
                const startPracticeDate = new Date(this.value);
                const minEndPractice = new Date(startPracticeDate);
                minEndPractice.setDate(startPracticeDate.getDate() + 15);
                endPracticeInput.min = minEndPractice.toISOString().split('T')[0];
             }
          });

          // Cerrar modal al hacer clic fuera del contenido
          window.addEventListener('click', function(event) {
              if (event.target === document.getElementById('modal')) {
                  document.getElementById('modal').style.display = 'none';
              }
          });
       });
    </script>

    <div class="container">
       <h2>Gestion de Fichas </h2>

       @if (session('success'))
       <div class="message success">{{ session('success') }}</div>
       @endif

       @if ($errors->any())
       <div class="message error">
          <ul>
             @foreach ($errors->all() as $error)
             <li>{{ $error }}</li>
             @endforeach
          </ul>
       </div>
       @endif

       <button class="btn" onclick="document.getElementById('modal').style.display='block'">Registrar ficha</button>

       <!-- Modal -->
       <div id="modal" class="modal">
          <div class="modal-content">
             <span class="close" onclick="document.getElementById('modal').style.display='none'">&times;</span>
             <h3>Registrar ficha</h3>

             <form method="POST" action="{{ route('programming.Register') }}">
                @csrf

                <label>Número de ficha</label>
                <input type="number" name="number_cohort" required min="1">

                <label>Programa</label>
                <select name="id_program" required>
                   <option value="">Seleccione programa</option>
                   @foreach ($programs as $pro)
                   <option value="{{ $pro->id }}" @if(old('id_program') == $pro->id) selected @endif>{{ $pro->name }}</option>
                   @endforeach
                </select>

                <label>Jornada</label>
                <select name="id_time" required>
                   <option value="">Seleccione jornada</option>
                   @foreach ($cohortimes as $tms)
                   <option value="{{ $tms->id }}" @if(old('id_time') == $tms->id) selected @endif>{{ $tms->name }}</option>
                   @endforeach
                </select>

                <label>Municipio</label>
                <select name="id_town" required>
                   <option value="">Seleccione municipio</option>
                   @foreach ($towns as $tn)
                   <option value="{{ $tn->id }}" @if(old('id_town') == $tn->id) selected @endif>{{ $tn->name }}</option>
                   @endforeach
                </select>

                <label>Horas etapa escolar</label>
                <input type="number" name="hours_school_stage" required min="1" value="{{ old('hours_school_stage') }}">

                <label>Horas etapa práctica</label>
                <input type="number" name="hours_practical_stage" required min="0" value="{{ old('hours_practical_stage') }}">

                <label>Inicio etapa escolar</label>
                <input type="date" name="start_date_school_stage" required value="{{ old('start_date_school_stage') }}">

                <label>Fin etapa escolar</label>
                <input type="date" name="end_date_school_stage" required value="{{ old('end_date_school_stage') }}">

                <label>Inicio etapa práctica</label>
                <input type="date" name="start_date_practical_stage" required value="{{ old('start_date_practical_stage') }}">

                <label>Fin etapa práctica</label>
                <input type="date" name="end_date_practical_stage" required value="{{ old('end_date_practical_stage') }}">

                <label>Cantidad Matriculados</label>
                <input type="number" name="enrolled_quantity" required min="1" value="{{ old('enrolled_quantity') }}">

                <div class="form-buttons">
                   <button type="submit" class="btn">Guardar</button>
                   <button type="button" class="btn" style="background-color: #ccc; color: #333;" onclick="document.getElementById('modal').style.display='none'">Cancelar</button>
                </div>
             </form>
          </div>
       </div>
       {{-- agregar filtro de fchas por activas y no activas
       las activas son aquellas que la fecha final es menor ala fecha actual y las inactivas son aquellas
       que la fecha final es mayor ala actual el cual se le agregaria color rojo  --}}


       <!-- Tabla de fichas -->
       <div class="table-container" >
          <table>
             <thead>
                <tr>
                   <th>Ficha</th>
                   <th>Programa</th>
                   <th>Jornada</th>
                   <th>Municipio</th>
                   <th>Hrs lectiva</th>
                   <th>Hrs programadas</th>
                   <th>Hrs cumplidas</th>
                   <th>Matriculados</th>
                   <th>Avance</th>
                </tr>
             </thead>
             <tbody>
                @foreach($cohorts as $cohort)
                <tr>
                   <td>{{ $cohort->number_cohort }}</td>
                   <td>{{ $cohort->program->name ?? 'N/A' }}</td>
                   <td>{{ $cohort->cohortime->name ?? 'N/A' }}</td>
                   <td>{{ $cohort->town->name ?? 'N/A' }}</td>
                   <td>{{ $cohort->hours_school_stage }} hrs</td>
                   <td>{{ $cohort->horas_programadas }} hrs</td>
                   <td>{{ $cohort->horas_cumplidas }} hrs</td>
                   <td>{{ $cohort->enrolled_quantity}}</td>
                   <td>
                      @php
                         $color = match(true) {
                            $cohort->porcentaje_avance >= 100 => 'success',
                            $cohort->porcentaje_avance >= 75 => 'warning',
                            default => 'danger'
                         };
                      @endphp
                      <div class="progress">
                         <div class="progress-bar bg-{{ $color }}" style="width: {{ min($cohort->porcentaje_avance, 100) }}%">
                            {{ $cohort->porcentaje_avance }}%
                         </div>
                      </div>
                   </td>
                </tr>
                @endforeach
             </tbody>
          </table>
       </div>
    </div>
 </x-layout>
