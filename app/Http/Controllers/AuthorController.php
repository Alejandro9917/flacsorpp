<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Author::get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $auhtor = Author::get();
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
            'first_name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'first_lastname' => 'required|max:255',
            'second_lastname' => 'required|max:255',
            'birthday' => 'required|date',
            'email' => 'required|email|max:255'
        ]);

        //Final object with data
        $author = Auhtor::create($data);
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
            'first_name' => 'required|max:255',
            'second_name' => 'required|max:255',
            'first_lastname' => 'required|max:255',
            'second_lastname' => 'required|max:255',
            'birthday' => 'required|date',
            'email' => 'required|email|max:255'
        ]);

        $author = Author::where(['id' => $id])->update($data);
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
