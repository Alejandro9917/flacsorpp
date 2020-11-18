<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Module;
use Validator;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_modules = Module::all();
        return view('module.module')->with(
            array(
                'all_modules' => $all_modules
            )
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('module.create');
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
            $validator = Validator::make($request->all(), [
                'route_regex' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
    
            $new_module = new Module();
            $new_module->route_regex = $request->route_regex;
    
            if ($new_module->save()){
                return redirect('module')->with('message', 'Modulo creado');
            }else{
                return back()->withErrors($validator)->withInput();
            }
        }catch(Exception $ex){
            return redirect('module')->with('messageErr', 'No se puedo crear el modulo ' . $ex);
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
        $module = Module::find($id);
        return view('module.edit')->with(
            array(
                'module' => $module
            )
        );
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
            $validator = Validator::make($request->all(), [
                'route_regex' => 'required',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
    
            $edit_module = Module::find($id);
            if( $edit_module == null)
                redirect('module')->with('messageErr', 'No se puedo actualizar el modulo, no hay registro');

            $edit_module->route_regex = $request->route_regex;
    
            if ($edit_module->save()){
                return redirect('module')->with('message', 'Modulo actualizado');
            }else{
                return back()->withErrors($validator)->withInput();
            }
        }catch(Exception $ex){
            return redirect('module')->with('messageErr', 'No se puedo actualizar el modulo ' . $ex);
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
