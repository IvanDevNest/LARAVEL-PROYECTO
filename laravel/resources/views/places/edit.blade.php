@extends('layouts.app')
    
    @section('content')
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Places') }}</div>
                <div class="card-body">
                          <form method="post" action="{{ route('places.update',$place) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <label for="name">Nombre</label><br>
                            <input type="text" id="name" value="{{ $place->name }}" name="name" ><br>
                            <label for="description">Descripcion</label><br>
                            <input type="text" id="description" name="description" value="{{ $place->description }}"><br><br>
                            <label for="upload">Arxivo</label><br>
                            <input type="file" id="upload" name="upload" ><br>
                            <label for="latitud">Latitud</label><br>
                            <input type="text" id="latitud" value="{{ $place->latitude }}" name="latitud" ><br><br>
                            <label for="longitud">Longitud</label><br>
                            <input type="text" id="longitud" value="{{ $place->longitude   }}" name="longitud" ><br>
                            <label for="category">Categoria</label><br>
                            <input type="text" id="category" value="{{ $place->category_id }}" name="category" ><br><br>
                            <label for="visibility">Visibilidad</label><br>
                            <input type="text" id="visibility" value="{{ $place->visibility_id }}" name="visibility" ><br><br>
                            <button type="submit" class="btn btn-primary">   Update </button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    </div>

    @endsection