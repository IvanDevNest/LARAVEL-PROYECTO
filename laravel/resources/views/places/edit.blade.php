@extends('layouts.app')
 
@section('content') 
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <div class="card-header"></div>
                <div class="card-body">
                        <form method="post" action="{{ route('places.update',$place) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="div-show">
                                <img class="img-fluid rounded-4" src="{{ asset("storage/{$file->filepath}") }}" />
                                <div class="form-group">
                                    <br>
                                    <label for="name">Nombre</label>
                                    <input class="form-control" type="text" id="name" value="{{ $place->name }}" name="name" >
                                    <label for="description">Descripcion</label>
                                    <input class="form-control" type="text" id="description" name="description" value="{{ $place->description }}">
                                    <label for="upload">Arxivo</label>
                                    <input class="form-control" type="file" id="upload" name="upload" >
                                    <label for="latitud">Latitud</label>
                                    <input class="form-control" type="text" id="latitud" value="{{ $place->latitude }}" name="latitud" >
                                    <label for="longitud">Longitud</label>
                                    <input class="form-control" type="text" id="longitud" value="{{ $place->longitude   }}" name="longitud" >
                                    <label for="category">Categoria</label>
                                    <input class="form-control" type="text" id="category" value="{{ $place->category_id }}" name="category" >
                                    <label for="visibility">Visibilidad</label>
                                    <input class="form-control" type="text" id="visibility" value="{{ $place->visibility_id }}" name="visibility" >
                                </div>
                                <br>
                                <div class="div-botones-show">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a class="btn btn-primary" href="{{ route('places.index',$place) }}"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                                </div>
                            <div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
