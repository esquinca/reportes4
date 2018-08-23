<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use App\Proveedor;
use App\Modelo;
use DB;
use Auth;
use Carbon\Carbon;

class AddEquipmentController extends Controller
{
  /**
   * Show the application add equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $hotels = Hotel::select('id', 'Nombre_hotel')->get();
    $modelos = DB::table('modelos')->select('id', 'ModeloNombre')->orderBy('ModeloNombre', 'asc')->get();
    $marcas = DB::table('marcas')->select('id', 'Nombre_marca')->orderBy('Nombre_marca', 'asc')->get();
    $estados = DB::table('get_estados_devices')->select('id', 'Nombre_estado')->get();
    $proveedores = DB::table('list_proveedores')->select('id', 'nombre')->get();
    $especificaciones = DB::table('especificacions')->select('id', 'name')->get();
    $groups = DB::table('groups')->select('id', 'name')->get();
    return view('permitted.equipment.add_equipment',compact('hotels','estados', 'proveedores', 'especificaciones', 'groups'));
  }
  public function search(Request $request){
    $considencia = $request->key;
    $result = DB::select('CALL get_grupo_rlike (?)', array($considencia));
    return json_encode($result);
  }
  public function search_provider(Request $request){
    $result = DB::table('list_proveedores')->orderBy('nombre', 'asc')->get();
    return json_encode($result);
  }
  public function create_Model(Request $request){
    $name = $request->add_modelitho;
    $marca_modl = $request->marcas_current;
    $flag = 0;
    $count_md = DB::table('modelos')->where('ModeloNombre', $name)->where('marca_id', $marca_modl)->count();
    if ($count_md == '0') {
      $result = DB::table('modelos')->insertGetId(['ModeloNombre' => $name, 'marca_id' => $marca_modl ]);
      if($result != '0'){
        $flag =1;
      }
    }
    return $flag;
  }
  public function search_modelo(Request $request){
    $name = $request->numero;
    $result = DB::select('CALL get_model (?)', array($name));
    return json_encode($result);
  }
  public function create_marca(Request $request){
    $name = $request->add_marquitha;
    $dist = $request->add_distribuidor;
    $type = $request->modelitho_current;

    $flag = 0;
    $count_md = DB::table('marcas')->where('Nombre_marca', $name)->where('Distribuidor', $dist)->count();
    if ($count_md == '0') {
      $result = DB::table('marcas')->insertGetId(['Nombre_marca' => $name, 'Distribuidor' => $dist ]);
      $eq_prt = DB::table('especification_marcas')->insertGetId([
        'especification_id' => $type,
        'marca_id' => $result,
        'created_at' => \Carbon\Carbon::now(),
      ]);
      if($result != '0'){
        $flag =1;
      }
    }
    return $flag;
  }
  public function search_marca(Request $request){
    $name = $request->numero;
    $result = DB::select('CALL get_brand (?)', array($name));
    return json_encode($result);
  }
  public function create_group(Request $request){
    $name = $request->add_grupitho;
    $flag = 0;
    $count_md = DB::table('groups')->where('name', $name)->count();
    if ($count_md == '0') {
      $eq_prt = DB::table('groups')->insertGetId([
        'name' => $name,
        'created' => \Carbon\Carbon::now(),
      ]);
      if($eq_prt != '0'){
        $flag =1;
      }
    }
    return $flag;
  }
  public function search_grupo(Request $request){
    $result = DB::table('groups')->select('id', 'name')->get();
    return json_encode($result);
  }

  public function search_marca_all(Request $request){
    $result = DB::table('marcas')->select('id', 'Nombre_marca')->orderBy('Nombre_marca', 'asc')->get();
    return json_encode($result);
  }
  public function create_equipament_n(Request $request){
    $eq_mac = $request->add_mac_eq;
    $eq_serie = $request->add_num_se;
    $eq_grup = $request->grupitho;
    $eq_descrip = $request->add_descrip;
    $eq_type = $request->type_equipment;
    $eq_marca = $request->Marcas;
    $eq_modelo = $request->mmodelo;
    $eq_estado = $request->add_estado;
    $eq_venue = $request->venue;

    $eq_nfactura = $request->nfactura;
    $eq_date_fact = $request->date_fact;
    $eq_nproveedor = $request->select_one;

    $flag = 0;
    $count_m0 = DB::table('equipos')->where('MAC', $eq_mac)->count();
    if ($count_m0 != '0') {$flag = 2;  return $flag; }

    $count_m1 = DB::table('equipos')->where('Serie', $eq_serie)->count();
    if ($count_m1 != '0') {$flag = 3;  return $flag; }

    $count_md = DB::table('equipos')->where('MAC', $eq_mac)->where('Serie', $eq_serie)->count();
    if ($count_md == '0') {
      $flag = 1;
      if (isset($eq_grup)) {
        $insert_eq = DB::table('equipos')->insertGetId([
          'MAC' => $eq_mac,
          'Serie' => $eq_serie,
          'Fecha_Registro' => date('Y-m-d'),
          'Descripcion' => $eq_descrip,
          'modelos_id' => $eq_modelo,
          'estados_id' => $eq_estado,
          'check_it_id' => '2',
          'hotel_id' => $eq_venue,
          'especificacions_id' => $eq_type,
          'created_at' => \Carbon\Carbon::now(),
        ]);
        $result_match = DB::table('devices_groups')->insertGetId(['id_equipo' => $insert_eq, 'id_grupo' => $eq_grup ]);

      }
      else {
        $insert_eq = DB::table('equipos')->insertGetId([
          'MAC' => $eq_mac,
          'Serie' => $eq_serie,
          'Fecha_Registro' => date('Y-m-d'),
          'Descripcion' => $eq_descrip,
          'modelos_id' => $eq_modelo,
          'estados_id' => $eq_estado,
          'check_it_id' => '2',
          'hotel_id' => $eq_venue,
          'especificacions_id' => $eq_type,
          'created_at' => \Carbon\Carbon::now(),
        ]);
      }
      if( !is_null($insert_eq))
      {
        $eq_prt = DB::table('equipo_proveedor')->insertGetId([
          'proveedor_id' => $eq_nproveedor,
          'equipo_id' => $insert_eq,
          'No_Fact_Compra' => $eq_nfactura,
          'Fecha_factura' => $eq_date_fact,
          'created_at' => \Carbon\Carbon::now(),
        ]);
      }
    }
    return $flag;
  }

  public function create_equipament_nd(Request $request){
    $eq_mac = $request->add_mac_eq;
    $eq_serie = $request->add_num_se;
    $eq_grup = $request->grupitho;
    $eq_descrip = $request->add_descrip;
    $eq_type = $request->type_equipment;
    $eq_marca = $request->Marcas;
    $eq_modelo = $request->mmodelo;
    $eq_estado = $request->add_estado;
    $eq_venue = $request->venue;

    $flag = 0;
    $count_m0 = DB::table('equipos')->where('MAC', $eq_mac)->count();
    if ($count_m0 != '0') {$flag = 2;  return $flag; }

    $count_m1 = DB::table('equipos')->where('Serie', $eq_serie)->count();
    if ($count_m1 != '0') {$flag = 3;  return $flag; }

    $count_md = DB::table('equipos')->where('MAC', $eq_mac)->where('Serie', $eq_serie)->count();
    if ($count_md == '0') {
      $flag = 1;
      if (isset($eq_grup)) {
        $insert_eq = DB::table('equipos')->insertGetId([
          'MAC' => $eq_mac,
          'Serie' => $eq_serie,
          'Fecha_Registro' => date('Y-m-d'),
          'Descripcion' => $eq_descrip,
          'modelos_id' => $eq_modelo,
          'estados_id' => $eq_estado,
          'check_it_id' => '2',
          'hotel_id' => $eq_venue,
          'especificacions_id' => $eq_type,
          'created_at' => \Carbon\Carbon::now(),
        ]);
        $result_match = DB::table('devices_groups')->insertGetId(['id_equipo' => $insert_eq, 'id_grupo' => $eq_grup ]);

      }
      else {
        $insert_eq = DB::table('equipos')->insertGetId([
          'MAC' => $eq_mac,
          'Serie' => $eq_serie,
          'Fecha_Registro' => date('Y-m-d'),
          'Descripcion' => $eq_descrip,
          'modelos_id' => $eq_modelo,
          'estados_id' => $eq_estado,
          'check_it_id' => '2',
          'hotel_id' => $eq_venue,
          'especificacions_id' => $eq_type,
          'created_at' => \Carbon\Carbon::now(),
        ]);
      }
    }
    return $flag;
  }
}
