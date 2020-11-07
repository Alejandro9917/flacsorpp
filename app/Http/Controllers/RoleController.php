<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Module;
use App\Models\Permison;
use Illuminate\Http\Request;
use Validator;

class RoleController extends Controller
{
    public function get_scopes(){
        $scopes= array(
            "can_create",
            "can_read",
            "can_update",
            "can_delete",
            "can_upload",
            "can_download"
        );
        return $scopes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_roles = Role::all();
        return view('role.role')->with(
            array(
                'all_roles' => $all_roles
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
        return view('role.create');
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
                'name' => 'required|min:4|max:15',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
    
            $new_role = new Role();
            $new_role->name = $request->name;
    
            if ($new_role->save()){
                return redirect('role')->with('message', 'Rol creado');
            }else{
                return back()->withErrors($validator)->withInput();
            }
        }catch(Exception $ex){
            return redirect('role')->with('messageErr', 'No se puedo crear el rol ' . $ex);
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
        $role = Role::find($id);
        return view('role.edit')->with(
            array(
                'role' => $role
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
                'name' => 'required|min:4|max:15',
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
    
            $edit_role = Role::find($id);
            if( $edit_role == null)
                redirect('role')->with('messageErr', 'No se puedo actualizar el rol, no hay registro');

            $edit_role->name = $request->name;
    
            if ($edit_role->save()){
                return redirect('role')->with('message', 'Rol actualizado');
            }else{
                return back()->withErrors($validator)->withInput();
            }
        }catch(Exception $ex){
            return redirect('role')->with('messageErr', 'No se puedo actualizar el rol ' . $ex);
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

    public function permisos($id){
        try{
            $rol = Role::find($id);
            $all_modules = Module::all();
            

            if ($rol == null) {
                return redirect('role')->with('messageErr', 'El rol seleccionado no existe ');
            }
            return view('role.permisos')->with(
                array(
                    'rol' => $rol,
                    'all_modules' => $all_modules,
                    'scopes' => $this->get_scopes()
                )
            );

        }catch(Exception $ex){
            return redirect('role')->with('messageErr', 'No se puede proceder ' . $ex);
        }
    }

    public function actualizar_permisos(Request $request,$id){
        $rol = Role::find($id);
        $all_modules = Module::all();
        
        foreach ($all_modules as $single_module){

            $permisson_config = Permison::where("role_id","=", $rol->id)->where("module_id","=",$single_module->id)->first();
            if($permisson_config == null)
                $permisson_config = new Permison();

            //setting flags CRUD + up&down
            foreach ( $this->get_scopes() as $single_scope){
                
                $permisson_config->role_id= $rol->id;
                $permisson_config->module_id= $single_module->id; 

                $generated_key = $single_scope."_".$single_module->id;
                if(isset($request->$generated_key)){ //atributo implicito (autogenerado)
                    $permisson_config->$single_scope = 1;
                }else{
                    $permisson_config->$single_scope = 0;
                }
            }
            if($permisson_config->save()){

            }
        }

        return view('role.permisos')->with(
            array(
                'rol' => $rol,
                'all_modules' => $all_modules,
                'scopes' => $this->get_scopes()
            )
        );
        
        //echo json_encode($_POST);
    }
}
