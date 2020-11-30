<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Collection::where(['collection_id' => null])->with('user')->get());
    }

    public function publicCollections(){
        return response()->json(Collection::where(['collection_id' => null])->get());
    }

    public function getChilds($collection_id){
        return response()->json(Collection::where(['collection_id' => $collection_id])->with('user')->get());
    }

    public function create()
    {
        return view('colecciones/index');
    }

    public function inCollection($collection_slug)
    {
        $collection = Collection::where(['slug' => $collection_slug])->first();
        $id = $collection->id;

        if($collection != null)
        {
            return view('colecciones/child')->with('id', $id);
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
                'slug' => 'required|max:255',
                'priority' => 'required|max:255',
                'is_folder' => 'required|boolean',
                'is_public' => 'required|boolean',
                'status' => 'required|boolean',
                'created_by' => 'required',
                'collection_id' => 'numeric'
            ]);

            //Final object with data
            $collection = Collection::create($data);
            return response()->json($collection);
        }

        catch(Exception $ex){
            $error = array(['error' => 'No se ha podido completar'.$ex]);
            return response()->json($error);
        }
    }

    public function show($id)
    {
        return response()->json(Collection::where(['id' => $id])->first());
    }

    public function edit($id)
    {
        //
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
        try{
            //Validating recived data
            $data = $request->validate([
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
                'priority' => 'required|max:255',
                'is_folder' => 'required|boolean',
                'is_public' => 'required|boolean',
                'status' => 'boolean',
                'collection_id' => 'numeric'
            ]);

            $collection = Collection::where(['id' => $id])->update($data);
        }

        catch(Exception $ex){
            $error = array(['error' => 'No se ha podido completar'.$ex]);
            return response()->json($error);
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
        //
    }
}
