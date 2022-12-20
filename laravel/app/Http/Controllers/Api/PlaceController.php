<?php

namespace App\Http\Controllers\Api;

use App\Models\Place;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\File;
use App\Http\Controllers\Controller;
use App\Http\Controllers\api\Places;

use Illuminate\Http\Request;

class PlaceController extends Controller
{
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
            'data'    => $file
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
        $file=File::find($id);
        if($file){
            return response()->json([
                "success" => true,
                "data" => $file
            ], 200);

        }
        else{
            return response()->json([
                "success" => false,
                "message" => "te huele "
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
        $file=File::find($id);
        if($file){
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
                    'data'    => $file
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


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $file=File::find($id);
        if($file){
            if (\Storage::disk('public')->exists($file->filepath)) {
                File::destroy($file->id);
                \Storage::disk('public')->delete($file->filepath);
                return response()->json([
                    'success' => true,
                    'data'    => $file
                ], 200);     
            } else {
                return response()->json([
                    'success'  => false,
                    'message' => 'Error deletting file'
                ], 500);
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
   public function delete_workaround(Request $request, $id)
   {
       return $this->destroy($request, $id);
   }

}
