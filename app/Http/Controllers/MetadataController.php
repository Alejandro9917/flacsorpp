<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metadata;
use App\Models\Fields;
use App\Models\FieldTypes;
use App\Models\FileTypes;
use App\Models\FileTypesMetadataForms;

class MetadataController extends Controller
{
    public function index()
    {
        return response()->json(Metadata::get());
    }

    // Metodos para cargar vistas generales

    public function display_file_types( Request $request){
        try {
            $file_types = FileTypes::all();
            if($file_types != null){
                return view('fileTypes.index')->with( 
                    array(
                        "file_types" => $file_types
                    )
                );
            }
        } catch (Exception $ex) {
            return redirect('/metadata/create');
        }
    }
    
    // Metodos para cargar vistas de detalle de configuracion (que requieren id)

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

    public function display_forms_by_file_type( Request $request){
        try {
            $myFileType = FileTypes::find($request->id);
            $allMetadata = Metadata::all();
            if($myFileType != null){
                return view('fileTypes.forms')->with( 
                    array(
                        "myFileType" => $myFileType,
                        "allMetadata" => $allMetadata
                    )
                );
            }
        } catch (Exception $ex) {
            return redirect('/metadata/create');
        }
    }

    // Obtener info de pantallas con detalles AJAX

    public function print_fields(Request $request, $metadata_id)
    {
        try {
            $myFormMetadata = Metadata::find($metadata_id);
            if($myFormMetadata != null){
                return response()->json($myFormMetadata->fields);
            }
        } catch (Exception $ex) {
            return redirect('/metadata/create');
        }
    }

    // Mostrar la configuracion de forms de metadata de un filetype
    public function print_fields_types_forms(Request $request, $file_type_id)
    {
        try {
            $myFileType = FileTypes::find($file_type_id);

            if($myFileType != null){
                foreach ($myFileType->file_types_metadata_forms as $singlePivot) {
                    $singlePivot->metadatas->fields;
                }
                return response()->json($myFileType);
            }
        } catch (Exception $ex) {
            return redirect('/metadata/create');
        }
    }

    // Metodos para refrescar con AJAX
    public function print_field_types(Request $request)
    {
        try {
            $all_file_types = FileTypes::all();
            if($all_file_types != null){
                return response()->json($all_file_types);
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
            'priority' => 'max:255',
            'class_container' => 'max:255',
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

    public function store_file_types(Request $request)
    {
        //Validating recived data
        $data = $request->validate([
            'name' => 'required|max:255',
        ]);

        //Final object with data
        $field = FileTypes::create($data);
        return response()->json($field);
    }

    //stores con foraneas

    public function store_file_type_metadata_form(Request $request)
    {
        //Validating recived data
        $data = $request->validate([
            'file_type_id' => 'required',
            'meta_data_forms_id' => 'required',
            'visible' => 'boolean',
        ]);

        //Final object with data
        $field = FileTypesMetadataForms::create($data);
        return response()->json($field);
    }


    public function store_field(Request $request)
    {
        //Validating recived data
        $data = $request->validate([
            'field_name' => 'required|max:255',
            'field_type_id' => 'max:255',
            'class' => 'max:255',
            'class_container' => 'max:255',
            'id_element' => 'max:255',
            'is_required' => 'boolean',
            'validation_rule' => '',
            'default_value' => 'max:255',
            'placeholder' => 'max:255',
            'priority' => '',
            'json_config' => 'required',
            'meta_data_form_id' => 'required'
        ]);

        //Final object with data
        $field = Fields::create($data);
        return response()->json($field);
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
