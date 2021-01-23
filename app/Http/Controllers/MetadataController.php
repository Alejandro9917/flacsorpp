<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metadata;
use App\Models\FieldTypes;

class MetadataController extends Controller
{
    public function index()
    {
        return response()->json(Metadata::get());
    }

    public function display_fields( Request $request){
        try {
            $myFormMetadata = Metadata::find($request->id);
            $field_types = FieldTypes::all();
            if($myFormMetadata != null){
                return view('metadata.campos')->with( 
                    array(
                        "myFormMetadata" => $myFormMetadata,
                        "field_types" => $field_types
                    )
                );
            }
        } catch (Exception $ex) {
            return redirect('/metadata/create');
        }
    }

    public function print_fields(Request $request)
    {
        try {
            $myFormMetadata = Metadata::find($request->id);
            if($myFormMetadata != null){
                return response()->json($myFormMetadata->fields);
            }
        } catch (Exception $ex) {
            return redirect('/metadata/create');
        }
    }

    public function create()
    {
        // retornando la pagina del index de meta DATA
        return view('metadata.index');
    }

    public function store(Request $request)
    {
        //Validating recived data
        $data = $request->validate([
            'form_name' => 'required|max:255',
            'header' => 'required|max:255',
            'priority' => 'required|max:255',
            'class_container' => 'required|max:255',
            'is_accordion' => 'required|boolean',
            'is_collapsed' => 'required|boolean',
            'extra_js' => 'max:255',
            'extra_css' => 'max:255',
            'is_required' => 'required'
        ]);

        //Final object with data
        $metaData = Metadata::create($data);
        return response()->json($metaData);
    }

    public function storeField(Request $request)
    {
        //Validating recived data
        $data = $request->validate([
            'field_name' => 'required|max:255',
            'field_type_id' => 'required',
            'class' => 'required|max:255',
            'class_container' => 'required|max:255',
            'id_element' => 'required|max:255',
            'is_required' => 'required|boolean',
            'validation_rule' => 'required',
            'default_value' => 'max:255',
            'placeholder' => 'max:255',
            'priority' => 'required',
            'json_config' => 'required'
        ]);

        //Final object with data
        $metaData = Metadata::create($data);
        return response()->json($metaData);
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
