@extends('layouts.app')
 
 @section('content')
 <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <div class="card-header"></div>
                <div class="card-body">
                <form method="post" action="{{ route('places.destroy',$place) }}" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div class="div-show">
                        <div >
                            <img class="img-fluid rounded-4 " src='{{ asset("storage/{$file->filepath}") }}' />
                            <br>
                        </div>
                        <div class="div-botones-show">
                            <button class="btn btn-danger" type="submit">Delete</button>

                            <a class="btn btn-primary" href="{{ route('places.edit',$place) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                            <a class="btn btn-primary" href="{{ route('places.index',$place) }}"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
                        </div>
                    </div>
                    </form>
                </div>
            </div> 
        </div>
    </div>
 </div>
 @endsection
 
 

