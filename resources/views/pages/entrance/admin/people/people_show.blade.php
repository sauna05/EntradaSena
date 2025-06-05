<x-layout_asistencia>
    <x-slot:title>CAA</x-slot:title>

    <style>
        .container-class{
            max-width: 900%; /* ancho limitado */
            margin: 40px auto;
            padding: 20px;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem;
            font-family: Arial, sans-serif;
        }

        .card {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        }

        .card h2 {
            margin-bottom: 1rem;
            color: #333;
            border-bottom: 2px solid #ddd;
            padding-bottom: 0.5rem;
        }

        .card p {
            margin: 0.4rem 0;
            color: #444;
        }

        .days-available {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
        }

        .day {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 6px;
            padding: 8px 12px;
        }

        .available {
            color: green;
            font-weight: bold;
        }

        .not-available {
            color: red;
            font-weight: bold;
        }

        button {
            background-color: #35854d;
            border: none;
            color: white;
            padding: 10px 20px;
            margin-top: 1rem;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
    <div class="container-class">
        <section class="container">
            <div class="card">
                <h2>Datos de la persona seleccionada</h2>
                <p><strong>Nombre:</strong> {{$person->name}}</p>
                <p><strong>Número de documento:</strong> {{$person->document_number}}</p>
                <p><strong>Cargo:</strong> {{$person->position->name}}</p>
                <p><strong>Fecha de inicio:</strong> {{$person->start_date->format('Y/m/d')}}</p>
                <p><strong>Fecha de finalización:</strong> {{$person->end_date->format('Y/m/d')}}</p>
            </div>
    
            <div class="card">
                <h2>Días que puede ir la persona al centro</h2>
                <div class="days-available">
                    @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo'] as $dayName)
                        @php
                            $isAvailable = $person->days_available->contains('name', $dayName);
                        @endphp
                        <div class="day">
                            <span>{{ $dayName }}</span>
                            @if ($isAvailable)
                                <span class="available">✓</span>
                            @else
                                <span class="not-available">✘</span>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
    
            <form action="{{ route('entrance.people.edit', $person->id) }}" method="GET">
                @csrf
                <button type="submit">Actualizar Datos</button>
            </form>
        </section>

    </div>

</x-layout_asistencia>
