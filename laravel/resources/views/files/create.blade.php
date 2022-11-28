
@extends('layouts.app')
 
@section('content')
<form id="create" method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
   @csrf
   @vite('resources/js/files/create.js')

   <div class="form-group">
       <label for="upload">File:</label>
       <input type="file" class="form-control" name="upload"/>
   </div >
   <p id="rambo"></p><br>
   <button type="submit" class="btn btn-primary">Create</button>

   <button type="reset" class="btn btn-secondary">Reset</button>
</form>
@endsection
