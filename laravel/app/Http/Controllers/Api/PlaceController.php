<?php

namespace App\Http\Controllers\Api;

use App\Models\Place;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

use App\Models\File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\Places;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:sanctum'])->only(['store']);
        $this->middleware(['auth:sanctum'])->only(['update']);
        $this->middleware(['auth:sanctum'])->only(['destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'success'=> true,
            'data' => Place::all()
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        // Validar fitxer
        $validatedData = $request->validate([
            'upload' => 'required|mimes:gif,jpeg,jpg,png|max:2048'
        ]);
        // Desar fitxer al disc i inserir dades a BD
        $upload = $request->file('upload');
        $file = new File();
        $upload = $request->file('upload');
       $fileName = $upload->getClientOriginalName();
       $fileSize = $upload->getSize();
       $name = $request->get('name');
        $description = $request->get('description');
        $latitude = $request->get('latitude');
        $longitude = $request->get('longitude');
        $category_id = $request->get('category_id');
        $author_id = $request->get('author_id');
        $visibility_id = $request->get('visibility_id');
       
       \Log::debug("Storing file '{$fileName}' ($fileSize)...");
 
       // Pujar fitxer al disc dur
       $uploadName = time() . '_' . $fileName;
       $filePath = $upload->storeAs(
           'uploads',      // Path
           $uploadName ,   // Filename
           'public'        // Disk
       );
      
       if (\Storage::disk('public')->exists($filePath)) {
           \Log::debug("Local storage OK");
           $fullPath = \Storage::disk('public')->path($filePath);
           \Log::debug("File saved at {$fullPath}");
           // Desar dades a BD
           $file = File::create([
               'filepath' => $filePath,
               'filesize' => $fileSize,
           ]);
           $place = Place::create([
            'name' => $name,
            'description' => $description,
            'file_id' => $file->id,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'category_id' => $category_id,
            'visibility_id' => $visibility_id,
            'author_id' => auth()->user()->id,
        ]);
           return response()->json([
            'success' => true,
            'data'    => $place
        ], 201);
  
        
        } else {
            return response()->json([
                'success'  => false,
                'message' => 'Error uploading file'
            ], 421);
        }
    }
 

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $place=Place::find($id);
        if($place){
            return response()->json([
                "success" => true,
                "data" => $place
            ], 200);

        }
        else{
            return response()->json([
                "success" => false,
                "message" => "Place not found"
            ], 404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $place=Place::find($id);
        if($place){
            $file=File::find($place->file_id);
            $validatedData = $request->validate([
                'upload' => 'required|mimes:gif,jpeg,jpg,png|max:1024'
            ]);
        
            // Obtenir dades del fitxer
            $upload = $request->file('upload');
            $fileName = $upload->getClientOriginalName();
            $fileSize = $upload->getSize();
            \Log::debug("Storing file '{$fileName}' ($fileSize)...");
    
            // Pujar fitxer al disc dur
            $uploadName = time() . '_' . $fileName;
            $filePath = $upload->storeAs(
                'uploads',      // Path
                $uploadName ,   // Filename
                'public'        // Disk
            );
        
            if (\Storage::disk('public')->exists($filePath)) {
                \Storage::disk('public')->delete($file->filepath);
                \Log::debug("Local storage OK");
                $fullPath = \Storage::disk('public')->path($filePath);
                \Log::debug("File saved at {$fullPath}");
                // Desar dades a BD
                $file->filepath=$filePath;
                $file->filesize=$fileSize;
                $file->save();
                \Log::debug("DB storage OK");
                // Patró PRG amb missatge d'èxit
                return response()->json([
                    'success' => true,
                    'data'    => $place
                ], 200);       
            }    
            else {
                return response()->json([
                    'success'  => false,
                    'message' => 'Error uploading file'
                ], 421);
            }
        }else{
            return response()->json([
                'success'  => false,
                'message' => 'Error searching file'
            ], 404);
        }
    }


    
public function update_workaround(Request $request, $id)
   {
       return $this->update($request, $id);
   }
   public function read_workaround(Request $request, $id)
   {
       return $this->show($request, $id);
   }
   public function favorite(Place $place){
    $favorite=Favorite::create([
        'id_place'=>$place->id,
        'id_user'=>auth()->user()->id,

    ]);
    if ($favorite){
        return response()->json([
            'success' => true,
            'data'    => $favorite
        ], 200);
    } else {
        return response()->json([
            'success'  => false,
            'message' => 'Error deleting file'
        ], 500);
    }        
}


public function unfavorite(Place $place)
{
    $favorite=DB::table('favorites')->where(['id_user'=>Auth::id(),'id_place'=>$place->id])->delete();
    if ($favorite){
        return response()->json([
            'success' => true,
            'data'    => $favorite
        ], 200);
    } else {
        return response()->json([
            'success'  => false,
            'message' => 'Error deleting file'
        ], 500);
    }     
}


   /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place=Place::find($id);
        Log::debug($place);
        Log::debug($id);
        if(empty($place)){

            return response()->json([
                'success'  => false,
                'message' => 'Error searching place'
            ], 404);
    
        }else{
            $place->delete();

            return response()->json([
                'success' => true,
                'data'    => $place
            ], 200); 
        }
}
   public function delete_workaround(Request $request, $id)
   {
       return $this->destroy($request, $id);
   }

}
