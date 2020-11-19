<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Citation;

class CitationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Citation::get());
    }
    
    /*
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Retornando la vista Idndex del recurso de citaciones
        return view('citaciones.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
