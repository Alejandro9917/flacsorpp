<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citation;
use App\Models\File;

class CitationController extends Controller
{
    public function index()
    {
        return response()->json(Citation::get());
    }

    public function getChilds($file_id)
    {
        return response()->json(Citation::where(['file_id' => $file_id])->get());
    }

    public function inFile($file_id)
    {
        $file = File::where(['id' => $file_id])->first();
        $id = $file->id;

        if($file != null)
        {
            return view('citaciones/child')->with('file_id', $id);
        }

        else{
            return view('files/index');
        }
    }

    public function create()
    {
        // Retornando la vista Idndex del recurso de citaciones
        return view('citaciones.index');
    }

    public function store(Request $request)
    {
        try{
            //Validating recived data
            $data = $request->validate([
                'content' => 'required|max:255',
                'title' => 'required|max:255',
                'pointer' => 'required|max:255',
                'reference' => 'required|max:255',
                'file_id' => 'required'
            ]);

            //Final object with data
            $citation = Citation::create($data);
            return response()->json($citation);
        }

        catch(Exception $ex){
            $error = array(['error' => 'No se ha podido completar'.$ex]);
            return response()->json($error);
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
        //Return the Citations in json format
        return response()->json(Citation::where(['id' => $id])->first());
    }

    public function getCitationsFile($file_id){
        //Return the citations for file id in json
        $citations = Citation::where(['file_id' => $file_id])->get();
        return response()->json($citations);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
                'content' => 'required|max:255',
                'title' => 'required|max:255',
                'pointer' => 'required|max:255',
                'reference' => 'required|max:255',
                'file_id' => 'required'
            ]);

            $citation = Citation::where(['id' => $id])->update($data);
            return response()->json($citation);
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
