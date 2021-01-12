<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metadata;

class MetadataController extends Controller
{
    public function index()
    {
        return response()->json(Metadata::get());
    }

    public function create()
    {
        // retornando la pagina del index de meta DATA
        return view('metadata.index');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
