<form method="post" action="{{ route('posts.update',$post) }}" enctype="multipart/form-data">
@csrf
@method('PUT')  
  <label for="lname">Archivo: {{ $file->filepath }}</label><br>
  <div class="form-group">
       <label for="upload">Fitxer sustitut: </label>
       <input type="file" class="form-control" name="upload"/>
   </div>
   <button type="reset" class="btn btn-secondary">Reset</button>
  <input type="submit" value="Update">
</form> 