<?php
 
namespace Tests\Feature;
 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

 
class PlaceTest extends TestCase
{
   public function test_place_list()
   {
       // List all places using API web service
       $response = $this->getJson("/api/place");
       // Check OK response
       $this->_test_ok($response);
       // Check JSON dynamic values
       $response->assertJsonPath("data",
           fn ($data) => is_array($data)
       );
   }
 
   public function test_place_create() : object
   {
       // Create fake place
       $name  = "avatar.png";
       $size = 500; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       $name="kakak";
       $description="sada";
       $latitude=2;
       $longitude=3;
       $category_id=3;
       $visibility_id=6;
       $author_id=1;


       // Upload fake place using API web service
       $response = $this->postJson("/api/place", [
           "upload" => $upload,
           "name" => $name,
           "description" => $description,
           "latitude" => $latitude,
           "longitude" => $longitude,
           "category_id" => $category_id,
           "visibility_id" => $visibility_id,
           "author_id"=>$author_id,



       ]);
       // Check OK response
       $this->_test_ok($response, 201);
       // Check validation errors
       $response->assertValid([
           "upload",
           "name",
           "description",
           "latitude",
           "longitude",
           "category_id",
           "visibility_id",
           "author_id",


        ]);

       $response->assertJsonPath("data.id",
           fn ($id) => !empty($id)
       );

       return $json->data;
   }
 
   public function test_place_create_error()
   {
       // Create fake place with invalid max size
       $name  = "avatar.png";
       $size = 5000; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       // Upload fake place using API web service
       $response = $this->postJson("/api/place", [
           "upload" => $upload,
       ]);
       // Check ERROR response
       $this->_test_error($response);
   }
 
   /**
    * @depends test_place_create
    */
   public function test_place_read(object $file)
   {
       // Read one place
       $response = $this->getJson("/api/place/{$file->id}");
       // Check OK response
       $this->_test_ok($response);
       // Check JSON exact values
       $response->assertJsonPath("data.filepath",
           fn ($filepath) => !empty($filepath)
       );
   }
  
   public function test_place_read_notfound()
   {
       $id = "not_exists";
       $response = $this->getJson("/api/place/{$id}");
       $this->_test_notfound($response);
   }
 
   /**
    * @depends test_place_create
    */
   public function test_place_update(object $file)
   {
       // Create fake place
       $name  = "photo.jpg";
       $size = 1000; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       // Upload fake place using API web service
       $response = $this->putJson("/api/place/{$file->id}", [
           "upload" => $upload,
       ]);
       // Check OK response
       $this->_test_ok($response);
       // Check validation errors
       $response->assertValid(["upload"]);
       // Check JSON exact values
       $response->assertJsonPath("data.filesize", $size*1024);
       // Check JSON dynamic values
       $response->assertJsonPath("data.filepath",
           fn ($filepath) => str_contains($filepath, $name)
       );
   }
 
   /**
    * @depends test_place_create
    */
   public function test_place_update_error(object $file)
   {
       // Create fake place with invalid max size
       $name  = "photo.jpg";
       $size = 3000; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       // Upload fake place using API web service
       $response = $this->putJson("/api/place/{$file->id}", [
           "upload" => $upload,
       ]);
       // Check ERROR response
       $this->_test_error($response);
   }
 
   public function test_place_update_notfound()
   {
       $id = "not_exists";
       $response = $this->putJson("/api/place/{$id}", []);
       $this->_test_notfound($response);
   }
 
   /**
    * @depends test_place_create
    */
   public function test_place_delete(object $file)
   {
       // Delete one place using API web service
       $response = $this->deleteJson("/api/place/{$file->id}");
       // Check OK response
       $this->_test_ok($response);
   }
 
   public function test_place_delete_notfound()
   {
       $id = "not_exists";
       $response = $this->deleteJson("/api/place/{$id}");
       $this->_test_notfound($response);
   }
 
   protected function _test_ok($response, $status = 200)
   {
       // Check JSON response
       $response->assertStatus($status);
       // Check JSON properties
       $response->assertJson([
           "success" => true,
           "data"    => true // any value
       ]);
   }
 
   protected function _test_error($response)
   {
       // Check response
       $response->assertStatus(422);
       // Check validation errors
       $response->assertInvalid(["upload"]);
       // Check JSON properties
       $response->assertJson([
           "message" => true, // any value
           "errors"  => true, // any value
       ]);       
       // Check JSON dynamic values
       $response->assertJsonPath("message",
           fn ($message) => !empty($message) && is_string($message)
       );
       $response->assertJsonPath("errors",
           fn ($errors) => is_array($errors)
       );
   }
  
   protected function _test_notfound($response)
   {
       // Check JSON response
       $response->assertStatus(404);
       // Check JSON properties
       $response->assertJson([
           "success" => false,
           "message" => true // any value
       ]);
       // Check JSON dynamic values
       $response->assertJsonPath("message",
           fn ($message) => !empty($message) && is_string($message)
       );       
   }
}
