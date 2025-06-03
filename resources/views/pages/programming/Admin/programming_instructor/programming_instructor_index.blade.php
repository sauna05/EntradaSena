<x-layout>
    <x-slot:title>Listado de Instructores</x-slot:title>

    <style>
        .container {
            padding: 40px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            border-radius: 6px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
            border: 1px solid #f3f0f0;
            background-color: white;
        }

        h2.title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
        }

        thead {
            background-color: #ecf0f1;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>

    <div class="container">
        <h2 class="title">Listado de Instructores</h2>

        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Documento</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Especialidad</th>
                    <th>Horas A Ejecutar</th>
                    <th>Meses de Contrato</th>
                    <th>Horas por día</th>
                    <th>Zona</th>
                    <th>Perfil</th> {{-- Nueva columna --}}
                </tr>
            </thead>
            <tbody>
                @foreach($instructores as $index => $instructor)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $instructor->person->document_number }}</td>
                        <td>{{ $instructor->person->name ?? 'Sin nombre' }}</td>
                        <td>{{ $instructor->person->email ?? 'Sin email' }}</td>
                        <td>{{ $instructor->speciality->name }}</td>
                        <td>{{ $instructor->assigned_hours }} hr</td>
                        <td>{{ $instructor->months_contract ?? 'Meses' }}</td>
                        <td>{{ $instructor->hours_day }} hr</td>
                        <td>{{ $instructor->zona ?? 'Sin zona' }}</td>
                        <td>
                            <a href="" 
                               style="padding: 6px 12px; background-color: #2980b9; color: white; text-decoration: none; border-radius: 4px;">
                                Ver Perfil
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            
        </table>
    </div>
</x-layout>
