<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;
use Log;
use App\Models\Permison;
use App\Models\Role;
use App\Models\Module;
use Exception;

class NeedsRoleLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function get_scopes()
    {
        $scopes = array(
            "can_create" => ["index", "create", "store"],
            "can_read" => ["index"],
            "can_update"  => ["index", "edit", "update"],
            "can_delete"  => ["index", "destroy"],
            "can_upload"  => ["index"],
            "can_download"  => ["index"]
        );
        return $scopes;
    }

    public function handle(Request $request, Closure $next)
    {
        try {
            if (Auth::user()) {
                $routeName = $request->route()->getName();
                $role_id = Auth::user()->role_id;
                $role = Role::find($role_id);
                //Log::channel('single')->info($routeName);
                //Log::channel('single')->info(json_encode($role->permisons));
                foreach ($role->permisons as $single_permison) { // Recorremos todas las asignaciones

                    $pattern = $single_permison->module->route_regex;
                    $pattern = str_replace('/', '\/', $pattern);
                    $pattern = str_replace('.', '\\.', $pattern);
                    $pattern = str_replace('*', '', $pattern);
                    $pattern = '/^' . $pattern . '/';

                    // Log::channel('single')->info($pattern);
                    /* */
                    if (preg_match($pattern, $routeName, $matches_array)) { // Verificamos si alguna ruta coincide
                        // Log::channel('single')->info($routeName);
                        $requested_action = str_replace('.', '', strrchr($routeName, '.'));
                        // Log::channel('single')->info("requested: " . $requested_action);
                        foreach ($this->get_scopes() as $scope_name => $scope_actions) { // Verificamos cada scope (si puede editar, ver, crear, eliminar, etc...)
                            if ($single_permison->$scope_name > 0) { //cada ruta tiene su equivalente al permiso
                                // Log::channel('single')->info("Podemos: " . $scope_name . " En " . $routeName);
                                if (in_array($requested_action, $scope_actions)) {
                                    return $next($request);
                                }
                            }
                        }
                    }
                    /* */
                }
            }
            return redirect('home')->with('error', 'You have not admin access');
        } catch (Exception $ex) {
            Log::channel('single')->info($ex);
            return redirect('home')->with('error', 'You have not admin access');
        }
    }
}
