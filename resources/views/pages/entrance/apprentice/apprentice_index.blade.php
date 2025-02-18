<x-layout>
    <x-slot:page_style>css/pages/start_page.css</x:slot-page_style>
    <x-slot:title>CAA</x:slot-title>


   <h2>HOLAAAA <p>Usuario: {{ $user->user_name }}</p>
    <p>Nombre: {{ optional($person)->name ?? 'Nombre no disponible' }}</p>
    </h2> 
<form >
    @csrf
    <x-button type="submit" >Cambiar Contraseña</x-button>
</form>
    
</x-layout>