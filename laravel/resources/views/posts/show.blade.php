
@extends('layouts.app')
 
 @section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $post->id }}</div>
                <div class="card-body">
                <form method="post" action="{{ route('posts.destroy',$post) }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Body</td>
                                <td scope="col">File_id</td>
                                <td scope="col">Latitude</td>
                                <td scope="col">Longitude</td>
                                <td scope="col">Visibility_id</td>
                                <td scope="col">Author_id</td>
                                <td scope="col">Create_at</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->body }}</td>
                                <td>{{ $post->file_id }}</td>
                                <td>{{ $post->latitude }}</td>
                                <td>{{ $post->longitude }}</td>
                                <td>{{ $post->visibility_id }}</td>
                                <td>{{ $post->author_id }}</td>
                                <td>{{ $post->create_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                        <img class="img-fluid" src="{{ asset("storage/{$file->filepath}") }}" />
                        <br>
                        <button type="submit">Delete</button>
                        <a href="{{ route('posts.edit',$post) }}">Edit</a>
                    </form>
                </div>
            </div> 
        </div>
    </div>
 </div>
 @endsection
 
 

