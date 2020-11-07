<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layout.login');
        $all_user = User::all();
        return view('user.user')->with(
            array(
                'all_user' => $all_user
            )
        );
    }

    //Función para mostrar el login
    public function login()
    {
        return 'Página de login';
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
                'email' => 'required|email',
                'password' => 'required',
                'first_name' => 'required',
                'second_name' => 'required',
                'first_lastname' => 'required',
                'second_lastname' => 'required',
                'birthday' => 'required|date',
                'role_id' => 'required'
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
    
            $new_user = new User();
            $new_user->name = $request->name;
            $new_user->email = $request->email;
            $new_user->password = $request->password;
            $new_user->first_name = $request->first_name;
            $new_user->second_name = $request->second_name;
            $new_user->first_lastname = $request->first_lastname;
            $new_user->birthday = $request->birthday;
            $new_user->role_id = $request->role_id;
    
            if ($new_user->save()){
                return redirect('user')->with('message', 'Usuario creado');
            }else{
                return back()->withErrors($validator)->withInput();
            }
        }catch(Exception $ex){
            return redirect('role')->with('messageErr', 'No se puedo crear el usuario ' . $ex);
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
        $user = User::find($id);
        return view('user.show')->with(
            array(
                'user' => $user
            )
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit')->with(
            array(
                'user' => $user
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
                'email' => 'required|email',
                'password' => 'required',
                'first_name' => 'required',
                'second_name' => 'required',
                'first_lastname' => 'required',
                'second_lastname' => 'required',
                'birthday' => 'required|date',
                'role_id' => 'required'
            ]);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
    
            $edit_user = User::find($id);
            if( $edit_user == null)
                redirect('user')->with('messageErr', 'No se puedo actualizar el usuario, no hay registro');

            $edit_user->name = $request->name;
            $edit_user->email = $request->email;
            $edit_user->password = $request->password;
            $edit_user->first_name = $request->first_name;
            $edit_user->second_name = $request->second_name;
            $edit_user->first_lastname = $request->first_lastname;
            $edit_user->birthday = $request->birthday;
            $edit_user->role_id = $request->role_id;
    
            if ($edit_user->save()){
                return redirect('user')->with('message', 'User actualizado');
            }else{
                return back()->withErrors($validator)->withInput();
            }
        }catch(Exception $ex){
            return redirect('user')->with('messageErr', 'No se puedo actualizar el user ' . $ex);
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
        try{
            $user_to_delete = User::find($id);
            $user_to_delete->delete();
        }catch(Exception $ex){
            return redirect('user')->with('messageErr', 'No se puedo eliminar el user ' . $ex);
        }
    }
}
