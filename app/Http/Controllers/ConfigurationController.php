<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

use Carbon\Carbon;

use Spatie\Permission\Models\Role;

use Spatie\Permission\Models\Permission;

use App\User; //Importar el modelo eloquent

use App\Menu; //Importar el modelo eloquent

class ConfigurationController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $roles = Role::pluck('name', 'id');
      $menus = Menu::pluck('display_name', 'id');
      $permisos = Permission::pluck('name', 'id');
      return view('permitted.configuration', compact('roles', 'menus', 'permisos'));
  }
  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
  {
      if (auth()->user()->can('Create user')) {
        $name= $request->inputCreatName;
        $email= $request->inputCreatEmail;
        $city= $request->inputCreatLocation;
        $role= $request->selectCreatRole;

        $new_user = new User;
        $new_user->name=$name;
        $new_user->email=$email;
        $new_user->password= bcrypt('123456');
        $new_user->city=$city;
        $new_user->save();
        $new_user->assignRole($role);

        return 'true';
      }
      else {
        return 'false';
      }
  }
  public function showMenu(Request $request)
  {
    $id = $request->sector;
    $bar = User::find($id);
    $bar->permissions;
    $bar->menus;
    return $bar;
  }
  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    if (auth()->user()->can('Edit user')) {
      $id = $request->sector;
      $user = User::find($id);
      $user->getRoleNames();
      return $user;
    }
    else {
      return '';
    }
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit(Request $request)
  {
    if (auth()->user()->can('Edit user')) {
      $name= $request->inputEditName;
      $email= $request->inputEditEmail;
      $city= $request->inpuEditlocation;
      $priv= $request->selectEditPriv;

      $user = User::where('email',$email) -> first();
      $user->name = $name;
      $user->city = $city;
      $user->save();
      $user->syncRoles($priv);
      return 'true';
    }
    else {
      return 'false';
    }
  }


  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update_priv(Request $request)
  {

    if (auth()->user()->can('Edit Configuration')) {
      if (auth()->user()->id == $request->identificador) { //View Configuration
        if ( empty ( $request->permissions ) ) {
          return 'abort';
        }
        else {
          if (in_array("View Configuration", $request->permissions)) { //Comprobamos que traiga minimo el permiso de View Configuration
            $user = User::find($request->identificador);
            $user->permissions()->detach(); //Method of eloquent remove all
            $user->syncPermissions($request->permissions);
            return 'complete';
          }
          else {
            return 'uncompleted';//Si selecciono pero no trajo la opcion de View Configuration
          }
        }
      }
      else {//No es el usuario actual
          $user = User::find($request->identificador);
          $user->permissions()->detach(); //Method of eloquent remove all
          if ( !empty ( $request->permissions ) ) {
            $user->syncPermissions($request->permissions);
            return 'success';
          }
          else {
            return 'uncheck';
          }
      }
    }
  }
  public function update_menu(Request $request)
  {
    if (auth()->user()->can('Edit Configuration')) {
      if (auth()->user()->id == $request->identificador) {
        if ( empty ( $request->menu ) ) {
          return 'abort';
        }
        else {
          if (in_array("4", $request->menu)) { //Comprobamos que traiga minimo el menu de Configuration
            $user = User::find($request->identificador);
            $user->menus()->detach(); //Method of eloquent remove all
            $user->menus()->sync($request->menu);
            return 'complete';
          }
          else {
            return 'uncompleted';//Si selecciono pero no trajo la opcion del menu de Configuration
          }
        }
      }
      else { //No es el usuario actual
        $user = User::find($request->identificador);
        $user->menus()->detach(); //Method of eloquent remove all
        if ( !empty ( $request->menu ) ) {
          $user->menus()->sync($request->menu);
          return 'success';
        }
        else {
          return 'uncheck';
        }
      }
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request)
  {
      if (auth()->user()->can('Delete user')) {
        if (auth()->user()->id == $request->identificador) {
          return 'abort';
        }
        else{
          $id_user = $request->identificador;
          $user = User::find($id_user);
          $user->menus()->detach(); //Method of eloquent remove all
          $user->delete(); //Method of eloquent remove user
          return 'true';
        }
      }
      else {
        return 'false';
      }
  }
}
