
@extends('layouts.app')
 
 @section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $place->id }}</div>
                <div class="card-body">
                <form method="post" action="{{ route('places.destroy',$place) }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <table class="table">
                        <thead>
                            <tr>
                                <td scope="col">ID</td>
                                <td scope="col">Name</td>
                                <td scope="col">Description</td>
                                <td scope="col">File_id</td>
                                <td scope="col">Latitude</td>
                                <td scope="col">Longiude</td>
                                <td scope="col">category_id</td>
                                <td scope="col">visibility_id</td>
                                <td scope="col">author_id</td>
                                <td scope="col">Created_at</td>
                                <td scope="col">Updated_at</td>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                
                                <td>{{ $place->id }}</td>
                                <td>{{ $place->name }}</td>
                                <td>{{ $place->id }}</td>
                                <td>{{ $place->name }}</td>
                                <td>{{ $place->id }}</td>
                                <td>{{ $place->name }}</td>
                                <td>{{ $place->id }}</td>
                                <td>{{ $place->name }}</td>

                            </tr>
                        </tbody>
                    </table>
                        <img class="img-fluid" src="{{ asset("storage/{$place->placepath}") }}" />
                        <br>
                        <button type="submit">Delete</button>
                        <a href="{{ route('places.edit',$place) }}">Edit</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
 @endsection
 
 

