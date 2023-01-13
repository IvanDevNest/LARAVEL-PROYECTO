<?php
 
namespace Tests\Feature;
 
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Mymodel;
use Laravel\Sanctum\Sanctum;
use Illuminate\Testing\Fluent\AssertableJson;

 
class PlaceTest extends TestCase

{
    public static User $testUser;
    public static array $validData = [];
    public static array $invalidData = [];

    public static function setUpBeforeClass() : void
    {
        parent::setUpBeforeClass();
        // Creem usuari/a de prova
        $name = "test_" . time();
        self::$testUser = new User([
            "name"      => "{$name}",
            "email"     => "{$name}@mailinator.com",
            "password"  => "12345678"
        ]);
        // TODO Omplir amb dades vàlides
        self::$validData = [];
        // TODO Omplir amb dades incorrectes
        self::$invalidData = [];
    }
  
    public function test_myresource_first()
    {
        // Desem l'usuari al primer test
        self::$testUser->save();
        // Comprovem que s'ha creat
        $this->assertDatabaseHas('users', [
            'email' => self::$testUser->email,
        ]);
    }
   public function test_place_list()
   {
       // List all places using API web service
       $response = $this->getJson("/api/places");
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
       Sanctum::actingAs(self::$testUser);
       $name="kakak.png";

       $size = 500; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       $description="sada";
       $latitude=12;
       $longitude=32;
       $category_id=33;
       $visibility_id=56;
       $author_id=12;


       // Upload fake place using API web service
       $response = $this->postJson("/api/places", [
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
       $json = $response->getData();
       return $json->data;
   }
 
   public function test_file_create_error()
   {
       // Create fake file with invalid max size
       $name  = "avatar.png";
       $size = 5000; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       $description="descripcion de prueba";
       $latitude=41.2310371;
       $longitude=1.7282036;
       // Upload fake file using API web service
       $response = $this->postJson("/api/files", [
           "upload" => $upload,
           "description"=>$description,
           "latitude"=>$latitude,
           "longitude"=>$longitude
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
       $response = $this->getJson("/api/places/{$file->id}");
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
       $response = $this->getJson("/api/places/{$id}");
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
       $response = $this->putJson("/api/places/{$file->id}", [
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
       $response = $this->putJson("/api/places/{$file->id}", [
           "upload" => $upload,
       ]);
       // Check ERROR response
       $this->_test_error($response);
   }
 
   public function test_place_update_notfound()
   {
       $id = "not_exists";
       $response = $this->putJson("/api/places/{$id}", []);
       $this->_test_notfound($response);
   }
       /**
     * @depends test_place_create
     */
    public function  test_places_favorite(object $place)
    {
        Sanctum::actingAs(self::$testUser);
        // Delete one file using API web service
        $response = $this->postJson("/api/place/{$place->id}/favorites");
        // Check OK response
        $this->_test_ok($response);
    }
    /**
     * @depends test_place_create
     */
    public function test_places_unfavorite(object $place)
    {
        Sanctum::actingAs(self::$testUser);
        // Delete one file using API web service
        $response = $this->deleteJson("/api/places/{$place->id}/favorites");
        // Check OK response
        $this->_test_ok($response);
    }
 
   /**
    * @depends test_place_create
    */
   public function test_place_delete(object $place)
   {
       // Delete one place using API web service
       $response = $this->deleteJson("/api/places/{$place->id}");
       // Check OK response
       $this->_test_ok($response);
   }
 
   public function test_place_delete_notfound()
   {
       $id = "not_exists";
       $response = $this->deleteJson("/api/places/{$id}");
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


   public function test_myresource_last()
   {
       // Eliminem l'usuari al darrer test
       self::$testUser->delete();
       // Comprovem que s'ha eliminat
       $this->assertDatabaseMissing('users', [
           'email' => self::$testUser->email,
       ]);
   }


}
