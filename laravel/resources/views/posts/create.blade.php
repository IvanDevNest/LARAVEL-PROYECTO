@extends('layouts.app')
    
    @section('content')
<form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
   @csrf
   @env(['local','development'])
        @vite('resources/js/posts/create.js')
    @endenv

   <div class="div-create">
        <div class="div-create-post">
            <div id="upload">
                <label for="upload">Post:</label>
                <input type="file" class="form-control input-create" name="upload"/>
                <div class="error"></div>
            </div>
            <br>
            <br>
            <div id="body">
                <label for="body">Body:</label>
                <input type="text" class="form-control" name="body"/>
                <div class="error"></div>
            <br>
            <br>
            <div id="latitude">
                <label for="latitude">Latitude:</label>
                <input type="text" class="form-control" name="latitude"/>
                <div class="error"></div>
            </div>
            <br>
            <br>
            <div id="longitude">
                <label for="longitude">Longitude:</label>
                <input type="text" class="form-control" name="longitude"/>
                <div class="error"></div>
            </div>
            <br>
            <br>
            <div id="visibility_id">
                <label for="visibility_id">Visibility_id:</label>
                <input type="text" class="form-control" name="visibility_id"/>
                <div class="error"></div>
            </div>
            <br>
            <br>
            <button type="submit" class="btn btn-primary mb-3">Create</button>
            <button type="reset" class="btn btn-secondary mb-3">Reset</button>
        </div>
    </div>
</form>
@endsection