<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>

    {{-- css del layout --}}
    <link rel="stylesheet" href="{{asset('css/components/layout.css')}}">
    {{-- css de las paginas --}}
    <link rel="stylesheet" href="{{asset($page_style)}}">
    {{-- css de los botones --}}
    <link rel="stylesheet" href="{{asset('css/components/buttons.css')}}">

</head>
<body>
    <header class="header">
        <div class="header-container">
            <img src="{{asset('logoSena.png')}}" alt="Logo Sena" class="logo-header">
            <h1 class="texto-header">Centro Agroempresarial Y Acuícola </h1>
        </div>
    </header>

    <main class="content">
        {{$slot}}
    </main>

    <footer class="footer">
        <div class="footer-container">
            <img src="{{asset('logoSena.png')}}" alt="Logo Sena" class="logo-footer">
        </div>
    </footer>
</body>
</html>