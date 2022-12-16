@extends('layouts.app')
@section('content')
<p>hola</p>
<div class='div-general-sobrenosotros'>
    <h2>Sobre Nosotros</h2>
    <div class='div-sobrenosotros'>
        <div class='div-foto-aboutus'>
            <div id='fotonieve'class="foto-nosotros2"></div>  
            <audio id='nieve'>
                <source src='/imagenes/nieve.mp3' type="audio/mp3"></source>
            </audio>
            <br>
            <p class='p-cargo'>Scrum Master</p>
            <br>
            <p>Arnau Olea</p>
        </div>
        <div class='div-foto-aboutus'>
            <div  id='fotoshrek' class="foto-nosotros"></div>
            <audio id='shrek'>
                <source src='/imagenes/mal.mp3' type="audio/mp3"></source>
            </audio>
            <br>
            <p>Yeperut</p>
            <br>
            <p>Ivan Moscoso</p>
        </div>
    </div>
</div>
</style>
<script>

    var shrek = document.getElementById('shrek');
    var nieve = document.getElementById('nieve');


    var foto1 = document.getElementById('fotoshrek');
    var foto2 = document.getElementById('fotonieve');

    window.addEventListener('load', iniciarfoto1, false);
    window.addEventListener('load', pararfoto1, false);

    function iniciarfoto1(){
        foto1.addEventListener('mouseover', iniciar1, false);

    }
   
    function pararfoto1(){
        foto1.addEventListener('mouseout', parar1, false);
    }
    function parar1(){
        shrek.pause();
    }
    function iniciar1(){
        shrek.play();
    }
    
    window.addEventListener('load', iniciarfoto2, false);
    window.addEventListener('load', pararfoto2, false);

    function iniciarfoto2(){
        foto2.addEventListener('mouseover', iniciar2, false);

    }
   
    function pararfoto2(){
        foto2.addEventListener('mouseout', parar2, false);
    }
    function parar2(){
        nieve.pause();
    }
    function iniciar2(){
        nieve.play();
    }
</script>
@endsection