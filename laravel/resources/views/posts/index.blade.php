@extends('layouts.app')
 
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div>
               <div class="card-header"></div>
               <div class="card-body">
               @foreach ($posts as $post)
                <div class=div-post>  
                    <div class="perfil-post">
                        <div>
                            <img class="foto-perfil" src="data:image/jpeg;base64,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"> 
                        </div>
                        <div>
                            <p>{{$post->user->name }}</p> 
                        </div> 
                    </div>
     
                                @foreach ($files as $file)
                                    @if($file->id == $post->file_id)
                                        <div class="div-foto-post">
                                            <img class="foto-post" src='{{ asset("storage/{$file->filepath}") }}' />
                                        </div>                                   
                                    @endif  
                                @endforeach
                                <div>
                                    <p>{{$post->contadorlike()}} likes</p>
                                </div>
                    <div class="div-like-post"> 
                        @if($post->comprobarlike())                       
                            <form action="{{ route('posts.like',$post) }}" method="post" enctype="multipart/form-data">
                            @csrf                            
                                <button class="btn btn-primary"><i class="fa-regular fa-heart h3"></i></button>                           
                            </form>
                        @else
                            <form action="{{ route('posts.unlike',$post) }}" method="post" enctype="multipart/form-data">
                            @csrf 
                            @method('DELETE')                          
                                <button class="btn btn-primary"><i class="fa-solid fa-heart"></i></button>                           
                            </form>
                        @endif
                        <input class="border-secondary border" type="text" id="Comentario" name="Comentario" placeholder="Comentario..">
                        <a href="{{ route('posts.show',$post) }}"><i class="fa-solid fa-eye"></i></a>

                    </div>
                           
                                                     

                       
                       
                      
                </div>  
                @endforeach
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
<a class="btn btn-primary" role="button"><i class="fa-brands fa-instagram h1 "></i></a>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <a class="btn btn-primary" href="{{ route('posts.create') }}" role="button">Add new Post</a>
      <a class="btn btn-primary" href="{{ route('places.create') }}" role="button">Add new Place</a>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>                
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

