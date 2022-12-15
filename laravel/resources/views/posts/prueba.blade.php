@extends('layouts.app')

@section('content')

@csrf
@vite('resources/js/posts/create-post.js')


    <div class="cuerpo">
        <div class="contenido"><div class="foto"><img src="./imagenes/logoNegro.png"  width="100" height="90"></div><div class="info"></div> </div>
        <div class="contenido"><div class="foto"><img src="./imagenes/jordi.png"  width="100" height="90"></div><div class="info"></div> </div>
        
    </div>

@endsection