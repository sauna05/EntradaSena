<x-layout>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/start_page.css</x:slot-page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>CAA</x:slot-title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <h1>PERSONAS EN EL CENTRO DE FORMACIÓN</h1>

 @if (session('message'))
    <div>
        {{ session('message') }}
    </div>
@endif

    <div>
        <a href="{{route('entrance.people.create')}}"><x-button>Registrar Persona</x-button></a>
    </div>
    <section>

    </section>

</x-layout> 