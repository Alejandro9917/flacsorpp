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
<<<<<<< HEAD:app/Http/Controllers/CitationController.php
        return Citation::get();
=======
        return view('layout.login');
>>>>>>> e9c852c3251a191925d773d0f357a41c490910b3:app/Http/Controllers/LoginController.php
    }

    /**
     * Show the form for creating a new resource.
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
        //Validating recived data
        $data = $request->validation([
            'content' => 'required|max:255',
            'title' => 'required|max:255',
            'pointer' => 'required|max:255',
            'reference' => 'required|max:255',
            'file_id' => 'required'
        ]);

        //Final object with data
        $citation = Citation::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //Validating recived data
        $data = $request->validation([
            'content' => 'required|max:255',
            'title' => 'required|max:255',
            'pointer' => 'required|max:255',
            'reference' => 'required|max:255',
            'file_id' => 'required'
        ]);

        $citation = Citation::where(['id' => $id])->update($data);
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
