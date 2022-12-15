@extends('layouts.app')
@section('content')
<p>hola</p>
<div class='div-general-sobrenosotros'>
    <h2>Sobre Nosotros</h2>
    <div class='div-sobrenosotros'>
        <div class='div-foto-aboutus'>
            <a href='javascript:void(0);' onmouseover="javascript:reproducirmusica();"><div class="foto-nosotros2"></div></a>        
            <br>
            <p class='p-cargo'>Scrum Master</p>
            <br>
            <p>Arnau Olea</p>
        </div>
        <div class='div-foto-aboutus'>
            <div class="foto-nosotros"></div>
            <br>
            <p>Yeperut</p>
            <br>
            <p>Ivan Moscoso</p>
        </div>
    </div>
</div>
</style>
<script type="text/javascript">
    var sonido = '/public/imagenes/Shrek.mp3';

    var audio ='<embed id="musica" src="'+sonido+'" autoplay="false" type="audio/mpeg" enablejavascript="true"></embed>';
    document.write(audio);

    function reproducirmusica() {
    var tocando = document.getElementById('musica');
    tocando.Play();
    }
</script>
@endsection