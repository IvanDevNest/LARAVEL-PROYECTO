<form method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
   @csrf
   <div class="form-group">
       <label for="upload">Post:</label>
       <input type="file" class="form-control" name="upload"/>
       <label for="body">Body:</label>
       <input type="text" class="form-control" name="body"/>
       <label for="latitude">Latitude:</label>
       <input type="text" class="form-control" name="latitude"/>
       <label for="longitude">Longitude:</label>
       <input type="text" class="form-control" name="longitude"/>
       <label for="visibility_id">Visibility_id:</label>
       <input type="text" class="form-control" name="visibility_id"/>
   </div>
   <button type="submit" class="btn btn-primary">Create</button>
   <button type="reset" class="btn btn-secondary">Reset</button>
</form>