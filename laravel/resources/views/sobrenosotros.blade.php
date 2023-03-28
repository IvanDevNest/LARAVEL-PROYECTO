@extends('layouts.app')
@section('content')
<style>
  
  /* div con la primera foto */
.retroceder{
  align-content:center;
}  
  .foto-nosotros{
/* propiedades esteticas del div */
    width: 300px;
    height: 500px;
    background-repeat: no-repeat;
    background-size: 400px 500px;
    border-radius: 10px;
    filter: grayscale(80%);
    /* Usamos el collage de fotos con el sprite para poner una foto */
    background: url("/imagenes/sprite.png") 300px 500px;
    
}

/* animacion del div 2 y cambio de foto */
.foto-nosotros:hover{
  /* propiedades esteticas del div */
    width: 300px;
    height: 500px;
    background-repeat: no-repeat;
    border-radius: 10px;
    background-image: url("/imagenes/sprite.png");
    filter: saturate(150%);
    transition: width 2s, height 2s, transform 6s;
    transform: rotate(1080deg);
    /* Usamos el collage de fotos con el sprite para cambiar de foto */
    background: url("/imagenes/sprite.png") 0px 500px;

    
}
/* div con la primera foto */
.foto-nosotros2{
  /* propiedades esteticas del div */
    width: 300px;
    height: 500px;
    background-repeat: no-repeat;
    background-size: 400px 500px;
    border-radius: 10px;
    filter: grayscale(80%);
    /* Usamos el collage de fotos con el sprite para poner una foto */
    background: url("/imagenes/sprite.png") 300px 0px;
    
    
}

/* animacion del div 1 y cambio de foto */
.foto-nosotros2:hover{
  /* propiedades esteticas del div */
    width: 300px;
    height: 500px;
    background-repeat: no-repeat;
    border-radius: 10px;
    filter: saturate(150%);
    border-radius:50%;
    -webkit-border-radius:50%;
    box-shadow: 0px 0px 15px 15px #94ce83;
    -webkit-box-shadow: 0px 0px 15px 15px #94ce83;
    /* animacion de rotacion  */
    transform: rotate(-1080deg);
    -webkit-transform: rotate(-1080deg);zxsz
    transition: width 2s, height 2s, transform 1s;
    transform: perspective(6);
    /* Usamos el collage de fotos con el sprite para cambiar de foto */
    background: url("/imagenes/sprite.png") 0px 0px;
}

  </style>

<div class='div-general-sobrenosotros'>
    <h2>Sobre Nosotros</h2>
    <div id="drag" class='div-sobrenosotros'>
        <div id='aboutus2'  class='div-foto-aboutus'>
            <div   type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id='fotonieve' class="foto-nosotros2 
            ">

            </div>  
            <audio id='nieve'>
                <source src='/imagenes/nieve.mp3' type="audio/mp3"></source>
            </audio>
            <br>
            <p id='p-cargo'>Scrum Master</p>
            <br>
            <p>Arnau Olea</p>
            
                    </div>
        <div id='aboutus1'  class='div-foto-aboutus'>
            <div  type="button" data-bs-toggle="modal" data-bs-target="#exampleModal2" id='fotoshrek' class="foto-nosotros"></div>
            <audio id='shrek'>
                <source src='/imagenes/mal.mp3' type="audio/mp3"></source>
            </audio>
            <br>
            <p id='p-cargo2'>Yeperut</p>
            <br>
            <p>Ivan Moscoso</p>
        </div>
    </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Video </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <video width="100%" height="100%" controls autoplay muted >
                <source src="/imagenes/quevedo.mp4" type="video/mp4">
              </video>
            </div>
            <div class="carousel-item">
              <video width="100%" height="100%" controls>
                <source src="/imagenes/beast.mp4" type="video/mp4">
              </video>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

 
        <!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Video </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="carouselExampleControls2" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <video width="100%" height="100%" controls autoplay muted>
                <source src="/imagenes/pokemon.mp4" type="video/mp4">
              </video>
            </div>
            <div class="carousel-item">
              <video width="100%" height="100%" controls>
                <source src="/imagenes/quevedo.mp4" type="video/mp4">
              </video>
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls2"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls2"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
  <a href=""></a>

<script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.3/dragula.min.js'></script>
<script>
    
    dragula([document.getElementById('drag')]);
    
    var shrek = document.getElementById('shrek');
    var nieve = document.getElementById('nieve');

    var cargo1 = document.getElementById('p-cargo1');
    var cargo2 = document.getElementById('p-cargo2');

    var foto1 = document.getElementById('fotoshrek');
    var foto2 = document.getElementById('fotonieve');

    window.addEventListener('load', iniciarfoto1, false);
    window.addEventListener('load', pararfoto1, false);

    function iniciarfoto1(){
        foto1.addEventListener('mouseover', iniciar1, false);
        document.querySelector('#p-cargo').innerHTML = "Conductor Professional"
    }
   
    function pararfoto1(){
        foto1.addEventListener('mouseout', parar1, false);
        document.querySelector('#p-cargo').innerHTML = "Scrum Master"
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


const videos = document.getElementsByTagName("video");
const prevBtn = document.getElementsByClassName("carousel-control-prev")[0]
const nextBtn = document.getElementsByClassName("carousel-control-next")[0]
 
var cur = 0
const max = videos.length
console.log("🎬 Total videos: " + max)
 
const playVideos = function(){
   // Pause all videos
   for (v=0; v<max; v++) {
       videos[v].pause();
   }
   // Play current video
   console.log("🎬 PLAY VIDEO " + cur)
   videos[cur].play()
}
 
prevBtn.addEventListener("click", function(){
   cur = (cur-1 >= 0) ? cur-1 : max
   playVideos()
})
 
nextBtn.addEventListener("click", function(){
   cur = (cur+1 < max) ? cur+1 : 0
   playVideos()
})


// function allowDrop(ev) {
//     ev.preventDefault();
//   }

//   function drag(ev) {
//     ev.dataTransfer.setData("text", ev.target.id);
//   }

//   function drop(ev) {
//     ev.preventDefault();
//     var data = ev.dataTransfer.getData("text");
//     let xxx = ev.target.src  
//     console.log(xxx)
//     ev.target.src = document.getElementById(data).src;
//     console.log(ev.target.src)
//     document.getElementById(data).src = xxx


//   }

</script>

@endsection