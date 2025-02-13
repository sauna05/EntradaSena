<x-layout>
    {{-- Archivo CSS de la pagina --}}
    <x-slot:page_style>css/pages/entrance/admin/people_show.css</x:slot-page_style>
    {{-- Titulo de la pagina --}}
    <x-slot:title>CAA</x:slot-title>
    {{-- Header - Navbar --}}
    <x-entrance_navbar></x-entrance_navbar>

    <h1>{{$person->name}}</h1>

</x-layout> 