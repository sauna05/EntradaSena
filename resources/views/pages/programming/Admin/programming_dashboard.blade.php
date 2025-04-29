<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x-slot:page_style>
    <x-slot:title>CAA</x-slot:title>
    <x-programming_navbar></x-programming_navbar>

    <h5>Bienvenido al apartado de programación, señor <p>{{ Auth::user()->user_name }}</p></h5>

    <h6>Lista de Programas</h6>
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Programa</th>
                <th>Código del Programa</th>
                <th>Versión</th>
                <th>Nivel</th>
            </tr>
        </thead>
        <tbody>
            @foreach($programs as $program)
                <tr>
                    <td>{{ $program->name }}</td>
                    <td>{{ $program->program_code }}</td>
                    <td>{{ $program->program_version }}</td>
                    <td>{{ $program->id_level == 1 ? 'Técnico' : 'Tecnólogo' }}</td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>
</x-layout>
