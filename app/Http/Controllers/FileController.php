<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\File;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(File::with('user')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('files.index');
    }

    public function store(Request $request)
    {
        try{
            //Validating recived data
            $data = $request->validate([
                'name' => 'required|max:255',
                'type' => 'required|max:255',
                'status' => 'required|max:255',
                'created_by' => 'required',
                'collection_id' => 'required'
            ]);

            //Final object with data
            $file = File::create($data);
            return response()->json($file);
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
                'status' => 'required|max:255'
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
