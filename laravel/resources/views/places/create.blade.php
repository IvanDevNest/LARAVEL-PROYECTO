    @extends('layouts.app')
    
    @section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Places') }}</div>
                <div class="card-body">
                        <form method="post" action="{{ route('places.store') }}" enctype="multipart/form-data">
                            @csrf
                            @env(['local','development'])
                                @vite('resources/js/places/create.js')
                            @endenv

                            <label for="name">Nombre</label><br>
                            <input class="form-control" type="text" id="name" name="name" ><br>
                            <label for="description">Descripcion</label><br>
                            <input class="form-control" type="text" id="description" name="description" ><br><br>
                            <label for="upload">Archivo</label><br>
                            <input class="form-control" type="file" id="upload" name="upload" ><br>
                            <label for="latitud">Latitud</label><br>
                            <input class="form-control" type="text" id="latitud" name="latitud" ><br><br>
                            <label for="longitud">Longitud</label><br>
                            <input class="form-control" type="text" id="longitud" name="longitud" ><br>
                            <label for="category">Categoria</label><br>
                            <input class="form-control" type="text" id="category" name="category" ><br><br>
                            <label for="visibility">Visibilidad</label><br>
                            <input class="form-control" type="text" id="visibility" name="visibility" ><br><br>
                            <button type="submit" class="btn btn-primary">  Submit </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    </div>

    @endsection