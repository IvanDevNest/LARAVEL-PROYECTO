<?php
 
namespace Tests\Feature;
 
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use App\Models\User;
use App\Models\Place;
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
        $name  = "avatar.png";
        $size = 500; /*KB*/
        $pupload = UploadedFile::fake()->image($name)->size($size);
        self::$validData = [
                'name' => 'Prueba place',
                'description' => 'Prueba descripcion',
                'latitude' => '1',
                'longitude' => '1',
                'category_id' => '1',
                'visibility_id' => '1',
                'upload' => $pupload
            ];
        // TODO Omplir amb dades incorrectes
        $size = 5000; /*KB*/
        $fpupload = UploadedFile::fake()->image($name)->size($size);
        self::$invalidData = [
            'name' => 'Prueba place',
            'description' => 'Prueba descripcion',
            'latitude' => 'a',
            'longitude' => 'a',
            'category_id' => 'a',
            'visibility_id' => 'a',
            'upload' => $fpupload
        ];
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
       Sanctum::actingAs(self::$testUser);
       // Cridar servei web de l'API
       $response = $this->postJson("/api/places", self::$validData);
       // Revisar que no hi ha errors de validació
       $params = array_keys(self::$validData);
       $response->assertValid($params);
       // TODO Revisar més errors
       $this->_test_ok($response, 201);
       // Check JSON exact values
       $response->assertJsonPath("data.id",
           fn ($id) => !empty($id)
       );
       // Read, update and delete dependency!!!
       $json = $response->getData();
       return $json->data;
   }
   
   public function test_place_create_error()
   {
       Sanctum::actingAs(self::$testUser);
       // Cridar servei web de l'API
       $response = $this->postJson("/api/places", self::$invalidData);
       // TODO Revisar errors de validació
       $params = ['upload' ];
       $response->assertInvalid($params);
       // TODO Revisar més errors
       $this->_test_error($response);
   }
 
   /**
    * @depends test_place_create
    */
   public function test_place_read(object $place)
   {
       // Read one place
       $response = $this->getJson("/api/places/{$place->id}");
       // Check OK response
       $this->_test_ok($response);
       // Check JSON exact values
       $response->assertJsonPath("data.id",
           fn ($id) => !empty($id)
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
   public function test_place_update(object $place)
   {
       Sanctum::actingAs(self::$testUser);
       // Create fake place
       $name  = "photo.jpg";
       $size = 1000; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       // Upload fake place using API web service
       $data = self::$validData;
       $data['upload'] = $upload;
       $response = $this->putJson("/api/places/{$place->id}", $data);
       // Check OK response
       $this->_test_ok($response);
       // Check validation errors
       $response->assertValid(["upload"]);
        // Check JSON exact values
        $response->assertJsonPath("data.id",
            fn ($id) => !empty($id)
        );
        // Read, update and delete dependency!!!
        $json = $response->getData();
        return $json->data;
   }
 
   /**
    * @depends test_place_create
    */
   public function test_place_update_error(object $place)
   {
       Sanctum::actingAs(self::$testUser);
       // Create fake place with invalid max size
       $name  = "photo.jpg";
       $size = 3000; /*KB*/
       $upload = UploadedFile::fake()->image($name)->size($size);
       // Upload fake place using API web service
       $response = $this->putJson("/api/places/{$place->id}", [
           "upload" => $upload,
       ]);
       // Check ERROR response
       $this->_test_error($response);
   }
 
   public function test_place_update_notfound()
   {

       Sanctum::actingAs(self::$testUser);
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
        //
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
       Sanctum::actingAs(self::$testUser);
       // Delete one place using API web service
       $response = $this->deleteJson("/api/places/{$place->id}");
       // Check OK response
       $this->_test_ok($response);
   }
 
   public function test_place_delete_notfound()
   {
       Sanctum::actingAs(self::$testUser);
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
