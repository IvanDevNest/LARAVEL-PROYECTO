<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\File;
use App\Models\User;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("posts.index", [
            "posts" => Post::all(),
            "files" => File::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("posts.create");
    }
    public function prueba(){
        return view("posts.prueba");
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
            'upload' => 'required|mimes:gif,jpeg,jpg,mp4,png|max:1024',
            'body' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'visibility_id' => 'required',
        ]);
    
        // Obtenir dades del fitxer
        $upload = $request->file('upload');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        $body = $request->input('body');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $visibility_id = $request->input('visibility_id');
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

            $post = Post::create([
                'body' => $body,
                'file_id' => $file->id,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'visibility_id' => $visibility_id,
                'author_id' =>auth()->user()->id,
            ]);

            \Log::debug("DB storage OK");
            // Patró PRG amb missatge d'èxit
            return redirect()->route('posts.show', $post)
                ->with('success', __('Post Successfully Saved'));


        } else {
            \Log::debug("Local storage FAILS");
            // Patró PRG amb missatge d'error
            return redirect()->route("posts.create")
                ->with('error', __('ERROR Uploading Post'));
        }
        
     }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $file=File::find($post->file_id);
        return view("posts.show", [
            'post' => $post,
            'file' => $file,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(auth()->user()->id == $post->author_id){

        $file=File::find($post->file_id);
        return view("posts.edit", [
            'post' => $post,
            'file' => $file,    
        ]);
        }else {
            return abort('403');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if(auth()->user()->id == $post->author_id){
            // Validar fitxer
            $validatedData = $request->validate([
                'upload'    => 'nullable|mimes:gif,jpeg,jpg,png,mp4|max:2048',
            ]);
        
            $file=File::find($post->file_id);

            // Obtenir dades del fitxer

            $upload = $request->file('upload');
            $controlNull = FALSE;
            if(! is_null($upload)){
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
            }
            else{
                $filePath = $file->filepath;
                $fileSize = $file->filesize;
                $controlNull = TRUE;
            }

            if (\Storage::disk('public')->exists($filePath)) {
                if ($controlNull == FALSE){
                    \Storage::disk('public')->delete($file->filepath);
                    \Log::debug("Local storage OK");
                    $fullPath = \Storage::disk('public')->path($filePath);
                    \Log::debug("File saved at {$fullPath}");

                }

                // Desar dades a BD

                $file->filepath=$filePath;
                $file->filesize=$fileSize;
                $file->save();
                \Log::debug("DB storage OK");
                $post->body=$request->input('body');
                $post->latitude=$request->input('latitude');
                $post->longitude=$request->input('longitude');
                $post->visibility_id=$request->input('visibility_id');
                $post->save();

                // Patró PRG amb missatge d'èxit
                return redirect()->route('posts.show', $post)
                    ->with('success', __('Post Successfully Saved'));


            } else {
                \Log::debug("Local storage FAILS");
                // Patró PRG amb missatge d'error
                return redirect()->route("posts.edit")
                    ->with('error', __('ERROR Uploading Post'));
            }
        }else {
            return abort('403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if(auth()->user()->id == $post->author_id){
            $file=File::find($post->file_id);

            \Storage::disk('public')->delete($post -> id);
            $post->delete();

            \Storage::disk('public')->delete($file -> filepath);
            $file->delete();
            if (\Storage::disk('public')->exists($post->id)) {
                \Log::debug("Local storage OK");
                // Patró PRG amb missatge d'error
                return redirect()->route('posts.show', $post)
                    ->with('error',__('Error post already exist'));
            }
            else{
                \Log::debug("Post Delete");
                // Patró PRG amb missatge d'èxit
                return redirect()->route("posts.index")
                    ->with('success', __('Post Successfully Deleted'));
            }  
        }else {
            return abort('403');
        }
    }
    public function like(Post $post)
    {
        $like =Like::create ([
            'id_user' => auth()->user()->id,
            'id_post' => $post->id,
        ]);
        return redirect()->back();
    }
    public function unlike(Post $post)
    {
        DB::table('likes')->where(['id_user'=>Auth::id(),'id_post'=>$post->id])->delete();
        return redirect()->back();
    }

   
    
}
