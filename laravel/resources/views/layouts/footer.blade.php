<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Geo Mir</title>
    <script src="https://kit.fontawesome.com/7545c6f6db.js" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/7545c6f6db.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @include('flash')

</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm ">
            <div class="container ">
                <a class="navbar-brand" href="{{ url('/home') }}">
                <img src="imagenes/Captura de 2022-10-25 17-54-11.png"  width="100" height="90">

                </a>
                

            </div>
            
        </nav>

    </div>
    
</body>
</html>
