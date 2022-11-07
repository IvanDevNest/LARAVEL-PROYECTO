@extends('layouts.app')
 
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card">
               <div class="card-header">{{ __('Posts') }}</div>
               <div class="card-body">
                    <form method="post" action="{{ route('post.update',$post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <table class="table">
                            <thead>
                                <tr>
                                    <td scope="col">Body:</td>
                                    <td scope="col">Latitude:</td>
                                    <td scope="col">Longitude:</td>
                                    <td scope="col">Visibility_id:</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $post->body }}</td>
                                    <td><img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" /></td>
                                    <td>{{ $post->latitude }}</td>
                                    <td>{{ $post->longitude }}</td>
                                    <td>{{ $post->visibility_id }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <label for="upload">Post:</label>
                            <input type="file" class="form-control" name="upload"/>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
           </div>
       </div>
   </div>
</div>
@endsection