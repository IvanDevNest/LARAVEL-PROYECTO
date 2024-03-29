@extends('layouts.app')
@section('content')
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>
	
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.css" />
		
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>
	 
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"/>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>


</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap');

:root {
	--primary-color: #94ce83;
}

* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}

body {
	font-family: 'Helvetica', sans-serif;
	line-height: 1.5;
}

a {
	text-decoration: none;
	color: var(--primary-color);
}


h1 {
	font-weight: 300;
	font-size: 60px;
	line-height: 1.2;
	margin-bottom: 15px;
}

.showcase {
	height: 100vh;
	display: flex;
	align-items: center;
	justify-content: center;
	text-align: center;
	color: #fff;
	padding: 0 20px;
}

.video-container {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	overflow: hidden;
    margin-top:120px;
	background: var(--primary-color) url('./https://traversymedia.com/downloads/cover.jpg') no-repeat center
		center/cover;
}

.video-container video {
	min-width: 100%;
	min-height: 100%;
  position: absolute;
	top: 50%;
	left: 50%;
	transform: translate(-50%, -50%);
	object-fit: cover;
}

.video-container:after {
	content: '';
	z-index: 1;
	height: 100%;
	width: 100%;
	top: 0;
	left: 0;
	background: rgba(0, 0, 0, 0.5);
	position: absolute;
}

.content {
	z-index: 2;
}

.btn {
	display: inline-block;
	padding: 10px 30px;
	background: var(--primary-color);
	color: #fff;
	border-radius: 5px;
	border: solid #fff 1px;
	margin-top: 25px;
	opacity: 0.7;
}

.btn:hover {
	transform: scale(0.98);
}

#about {
	padding: 40px;
	text-align: center;
}

#about p {
	font-size: 1.2rem;
	max-width: 600px;
	margin: auto;
}

#about h2 {
	margin: 30px 0;
	
}

.social a {
	margin: 0 5px;
}

#map { height: 180px; }

</style>
    <header>
        <div class="showcase">
            <div class="video-container">
				<video src="./imagenes/quevedo.mp4" autoplay muted loop></video>
			</div>
			<div class="content" ondblclick="speakContent()" >
				<h1 id="contactanos">Contactanos!</h1>
				<h3 id="envmsj">Envia tu mensaje</h3>

				<a href="https://youtube.com" class="btn">Formulario de contacto</a>
			</div>
			<a href="https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwjNu5TuoYv9AhUXPuwKHdJeCIAQFnoECAsQAQ&url=https%3A%2F%2Fdocs.google.com%2Fforms%2Fcreate%3Fhl%3DES&usg=AOvVaw3lqGk_68o6EJPs6z_c6Z0_" accesskey="h"></a><br>
</div>
    </header>
	<main>

<script>
	function starter(){
// Configuramos la instancia
		const recognition = new webkitSpeechRecognition();

		


	console.log("ola")
	recognition.continuous = true;
recognition.interimResults = false;
recognition.lang = 'es-ES';
recognition.start();

	// Cuando se detecta una palabra clave, se sube o baja la página
	
recognition.onresult = (event) => {
const last = event.results.length - 1;
const command = event.results[last][0].transcript.toLowerCase();
console.log(command);
if (command.includes('subir página')) {
	window.scrollBy(0, -window.innerHeight);
} else {
	window.scrollBy(0, window.innerHeight);
}};

}	
</script>
	<h3 id="startButton" onClick='starter()' >DI LO QUE QUIERAS</h3>

    <div id="about">
		<h1 class="body-h1">Vols visitar-nos?</h1>
    <a href="#" onClick="getLocation()"><h3 class="body-h3">Ubica'ns al mapa</h3></a>
    <div id="map"></div>
           
        </div>
</main>	
	<footer>
        <div id="about">
            <h2>Siguenos en Redes!</h2>

            <div class="social">
                <a href="https://twitter.com/insjmir?ref_src=twsrc%5Etfw%7Ctwcamp%5Eembeddedtimeline%7Ctwterm%5Escreen-name%3Ainsjmir%7Ctwcon%5Es1_c1" target="_blank"><i class="fab fa-twitter fa-3x"></i></a>
                <a href="https://m.facebook.com/profile.php?id=112082288817274" target="_blank"><i class="fab fa-facebook fa-3x"></i></a>
                <a href="https://github.com/profe-pep" target="_blank"><i class="fab fa-github fa-3x"></i></a>
                <a href="https://es.linkedin.com/in/institut-joaquim-mir-161a05230?trk=public_profile_browsemap" target="_blank"><i class="fab fa-linkedin fa-3x"></i></a>
            </div>
        </div>
    </footer>
	<script>


		// Obtener el elemento h1
		const contactanos = document.getElementById("contactanos");
		const envmsj = document.getElementById("envmsj");

// Agregar un event listener para el clic
contactanos.addEventListener("click", () => {
  // Crear objeto de SpeechSynthesisUtterance
  const mensaje = new SpeechSynthesisUtterance();

  // Establecer el texto que se va a leer
  mensaje.text = "Contactanos";

  // Llamar a la función speak() para que el navegador comience a leer el texto
  speechSynthesis.speak(mensaje);
});
envmsj.addEventListener("click", () => {
  // Crear objeto de SpeechSynthesisUtterance
  const mensaje = new SpeechSynthesisUtterance();

  // Establecer el texto que se va a leer
  mensaje.text = "Enviar Mensaje!";

  // Llamar a la función speak() para que el navegador comience a leer el texto
  speechSynthesis.speak(mensaje);
});
function speakContent() {
  const contentDiv = document.querySelector(".content");
  const contentText = contentDiv.textContent;
  const utterance = new SpeechSynthesisUtterance(contentText);
  speechSynthesis.speak(utterance);
}
function leerToda(){
	var texto=document.body.innerText;
	const msj = new SpeechSynthesisUtterance(texto);
	speechSynthesis.speak(msj);

}

var map = L.map('map').setView([41.23114477320315, 1.7281181849031044], 18);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
maxZoom: 18,
attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var marker = L.marker([41.23114477320315, 1.7281181849031044]).addTo(map);

L.Routing.control({
waypoints: [
	L.latLng(41.23114477320315, 1.7281181849031044),
	L.latLng(41.22317016641275, 1.7176998961503782)
]
}).addTo(map);

function getLocation(e) {
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(showPosition);
	} else { 
		x.innerHTML = "Geolocation is not supported by this browser.";
	}
	e.preventDefault()
	return false
}

function showPosition(position) {
	var marker = L.marker([position.coords.latitude, position.coords.longitude]).addTo(map);
	var circle = L.circle([position.coords.latitude, position.coords.longitude],{color:'blue', fillColor: '#0000FF', fillOpacity: 0.5, radius: 30}).addTo(map);
}

// 4.2 ATAJOS
document.onkeyup = function(e) {
  if (e.ctrlKey && e.altKey && e.which == 71) {
    var options = {
      enableHighAccuracy: true,
      timeout: 6000,
      maximumAge: 0
    };
    navigator.geolocation.getCurrentPosition( success, error, options );
    function success(position) {
      var coordenadas = position.coords;
      alert("Tu posición actual es:"+
      "\n- Latitud : " + coordenadas.latitude+
      "\n- Longitud: " + coordenadas.longitude+
      "\n- Rango de error de " + coordenadas.accuracy + " metros");
    };
    function error(error) {
      console.warn('ERROR(' + error.code + '): ' + error.message);
    };
  } else if (e.ctrlKey && e.altKey && e.which == 67) {
    alert("Ctrl + Alt + C shortcut combination was pressed");
  }
};


// Al activarse el botón, empezamos a escuchar la voz del usuario





</script>

@endsection