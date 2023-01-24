@extends('layouts.app')
@section('content')
<head>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
     integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI="
     crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
     integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM="
     crossorigin=""></script>


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
			<div class="content">
				<h1>Contactanos!</h1>
				<h3>Envia tu mensaje</h3>
				<a href="https://pornhub.com" class="btn">Formulario de contacto</a>
			</div>
</div>
    </header>
	<main>
        <div id="about">
            <h1>Quieres Visitarnos?</h1>
			<p>Encuentranos en esta direccion!</p>
            <br>
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
        window.addEventListener('load',function(){
            x = navigator.geolocation.getCurrentPosition(showPosition);
        })
        //Funciones para tener
       var map = L.map('map').setView([41.231273815596715, 1.7282039997421028], 13);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([41.231273815596715, 1.7282039997421028]).addTo(map)
            .bindPopup('Estamos en esta ubicacion!')
            .openPopup();
        

            // Funciones ubicacion del usuario
            

            function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude;
            }

            
            var popup = L.popup()
                .setLatLng([position.coords.latitude, position.coords.longitude])
                .setContent("Usted esta aqui.")
                .openOn(map);


    
            </script>

@endsection