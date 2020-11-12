<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
<<<<<<< HEAD
use App\Models\Tag;
=======
>>>>>>> e9c852c3251a191925d773d0f357a41c490910b3

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        return response()->json(Tag::get());
=======
        // Retornando la vista index
        return view('tags.index');
>>>>>>> e9c852c3251a191925d773d0f357a41c490910b3
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        // Retornando la vista index
        return view('tags.index');
=======
        //
>>>>>>> e9c852c3251a191925d773d0f357a41c490910b3
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        try{
            //Validating received data
            $data = $request->validate([
                'cod_tag' => 'required|alpha_num|max:250',
                'name' => 'required|alpha_num|max:250',
                'color' => 'required|alpha_num|max:250'
            ]);

            //Final object with data
            $tag = Tag::create($data);
            return response()->json($tag);
        }

        catch(Exception $ex){
            $error = array(['error' => 'No se ha podido completar'.$ex]);
            return response()->json($error);
        }
=======
        //
>>>>>>> e9c852c3251a191925d773d0f357a41c490910b3
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
<<<<<<< HEAD
        return response()->json(Tag::where(['id' => $id])->get());
=======
        //
>>>>>>> e9c852c3251a191925d773d0f357a41c490910b3
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
<<<<<<< HEAD
        //Validating received data
        $data = $request->validate([
            'cod_tag' => 'required|alpha_num|max:250',
            'name' => 'required|alpha_num|max:250',
            'color' => 'required|alpha_num|max:250'
        ]);

        //Final object with data
        $tag = Tag::where(['id' => $id])->update($data);
=======
        //
>>>>>>> e9c852c3251a191925d773d0f357a41c490910b3
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
