<form method="post" action="{{ route('files.store') }}" enctype="multipart/form-data">
   @csrf
   <div class="form-group">
       <label for="upload">File:</label>
       <input type="file" class="form-control" name="upload"/>
   </div><hr>
   <button type="submit" class="btn btn-primary">Create</button>
   <hr>
   <button type="reset" class="btn btn-secondary">Reset</button>
</form>