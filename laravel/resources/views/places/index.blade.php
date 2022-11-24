@extends('layouts.app')
 
@section('content')
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card border-0">
               <div class="card-body">
                   <table class="table table-striped table border-0">
                       <thead>
                       <tr>
     <th     class="border-0">Places</th>
</tr>
<tr >
    <td class="border-0">Spain</td>

</tr>
    <tr>
    <td class="border-0">Portugal</td>

</tr>
    <tr>
    <td class="border-0">Mexico</td>

</tr>
    <tr>
    <td class="border-0">Romania</td>
</tr>
    <tr>
    <td class="border-0">Moroco</td>


</tr>
                       </thead>
                       <tbody>
                           @foreach ($places as $place)
                           <tr>
                               
                               <td><a href="{{ route('places.show',$place) }}">{{ $place->id }}</a></td>
                               <td>{{ $place->id }}</td>
                               <td>{{ $place->name }}</td>
                               <td>{{ $place->description }}</td>
                               <td>{{ $place->file_id }}</td>
                               <td>{{ $place->latitude }}</td>
                               <td>{{ $place->category_id }}</td>
                               <td>{{ $place->visibility_id }}</td>
                               <td>{{ $place->author_id }}</td>
                               <td>{{ $place->created_at }}</td>
                               <td>{{ $place->updated_at }}</td>

                               


                           </tr>
                           @endforeach
                       </tbody>
                       <i class="cil-arrow-thick-bottom"></i>
    
                   </table>
                   <a class="btn btn-primary position-absolute top-100 start-50 translate-middle" href="{{ route('places.create') }}" role="button">Add new place</a>
               </div>
           </div>
       </div>
   </div>
</div>
@endsection

