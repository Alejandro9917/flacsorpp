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
        return Collection::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $collections = Collection::get();
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
        $data = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'priority' => 'required|max:255',
            'is_folder' => 'required|boolean',
            'is_public' => 'required|boolean',
            'status' => 'boolean',
            'created_by' => 'required',
            'collection_id' => 'required'
        ]);

        //Final object with data
        $collection = Collection::create($data);
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
        $data = $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255',
            'priority' => 'required|max:255',
            'is_folder' => 'required|boolean',
            'is_public' => 'required|boolean',
            'status' => 'boolean',
            'created_by' => 'required',
            'collection_id' => 'required'
        ]);

        $collection = Collection::where(['id' => $id])->update($data);
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
