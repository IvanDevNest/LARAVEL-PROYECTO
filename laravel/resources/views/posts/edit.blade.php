@extends('layouts.app')
 
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Posts') }}</div>
               <div class="card-body">
                    <form method="post" action="{{ route('posts.update',$post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" />
                        <div class="form-group">
                            <br>
                            <label for="upload">Post:</label>
                            <input type="file" class="form-control" name="upload"/>
                            <label for="body">Body:</label>
                            <input type="text" class="form-control" name="body" value="{{ $post->body }}"/>
                            <label for="latitude">Latitude:</label>
                            <input type="text" class="form-control" name="latitude" value="{{ $post->latitude }}"/>
                            <label for="longitude">Longitude:</label>
                            <input type="text" class="form-control" name="longitude" value="{{ $post->longitude }}"/>
                            <label for="visibility_id">Visibility:</label>
                            <input type="text" class="form-control" name="visibility_id" value="{{ $post->visibility_id }}"/>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
           </div>
       </div>
   </div>
</div>
@endsection