@extends('layouts.app')
    
    @section('content')
<form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
   @csrf
   <div class="div-create">
        <div class="div-create-post">
            <label for="upload">Post:</label>
            <input type="file" class="form-control input-create" name="upload"/>
            <br>
            <br>
            <label for="body">Body:</label>
            <input type="text" class="form-control" name="body"/>
            <br>
            <br>
            <label for="latitude">Latitude:</label>
            <input type="text" class="form-control" name="latitude"/>
            <br>
            <br>
            <label for="longitude">Longitude:</label>
            <input type="text" class="form-control" name="longitude"/>
            <br>
            <br>
            <label for="visibility_id">Visibility_id:</label>
            <input type="text" class="form-control" name="visibility_id"/>
            <br>
            <br>
            <button type="submit" class="btn btn-primary mb-3">Create</button>
            <button type="reset" class="btn btn-secondary mb-3">Reset</button>
        </div>
    </div>
</form>
@endsection