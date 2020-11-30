<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\Collection;
use App\Models\File;

class FileController extends Controller
{
    public function index()
    {
        return response()->json(File::with('user')->get());
    }

    public function create()
    {
        return view('files.index');
    }

    public function getChilds($collection_id){
        return response()->json(File::where(['collection_id' => $collection_id])->with('user')->get());
    }

    public function inCollection($collection_slug)
    {
        $collection = Collection::where(['slug' => $collection_slug])->first();
        $id = $collection->id;

        if($collection != null)
        {
            return view('files/child')->with('collection_id', $id);
        }

        else{
            return view('colecciones/index');
        }
    }

    public function store(Request $request)
    {
        try{
            //Validating recived data
            $data = $request->validate([
                'name' => 'required|max:255',
                'document' => 'required|file',
                'status' => 'required|max:255',
                'created_by' => 'required',
                'collection_id' => 'required',
                'published_at' => 'required|date'
            ]);
            
            $path = Storage::putFile('documents', $request->file('document'));

            $file = new File();
            $file->name = $request->name;
            $file->file = $path;
            $file->status = $request->status;
            $file->created_by = $request->created_by;
            $file->collection_id = $request->collection_id;
            $file->published_at = $request->published_at;

            if($file->save()){
                return response()->json(['message' => 'Archivo creado']);
            }
        }

        catch(Exception $ex){
            $error = array(['error' => 'No se ha podido completar'.$ex]);
            return response()->json($error);
        }
    }

    public function show($id)
    {
        return response()->json(File::where(['id' => $id])->first());
    }

    public function getTagsFile($id){
        $tags = File::where(['id' => $id])->first();
        return response()->json($tags->tags);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try{
            //Validating recived data
            $data = $request->validate([
                'name' => 'required|max:255',
                'type' => 'required|max:255',
                'status' => 'required|max:255',
                'published_at' => 'required|date'
            ]);

            $file = File::where(['id' => $id])->update($data);
            return response()->json($file);
        }

        catch(Exception $ex){
            $error = array(['error' => 'No se ha podido completar'.$ex]);
            return response()->json($error);
        }
    }

    public function destroy($id)
    {
        //
    }

    public function setFileTag(Request $request){
        try{
            $exists = DB::table('file_tags')->where([
                'file_id' => $request->file_id, 
                'tag_id' => $request->tag_id
                ])->get();
    
            if(count($exists) == 0){
                $file_tag = DB::table('file_tags')->insert([
                    'file_id' => $request->file_id,
                    'tag_id' => $request->tag_id
                ]);
        
                return response()->json($file_tag);
            }
    
            else{
                return response()->json(['warning' => 'Ya existe el registro']);
            }
        }

        catch(Exception $ex){
            $error = array(['error' => 'No se ha podido completar'.$ex]);
            return response()->json($error);
        }
    }

    public function removeFileTag(Request $request){
        try{
            $file_tag = DB::table('file_tags')->where([
                'file_id' => $request->file_id,
                'tag_id' => $request->tag_id
            ])->delete();
    
            return response()->json($file_tag);
        }

        catch(Exception $ex){
            $error = array(['error' => 'No se ha podido completar'.$ex]);
            return response()->json($error);
        }
    }
}
