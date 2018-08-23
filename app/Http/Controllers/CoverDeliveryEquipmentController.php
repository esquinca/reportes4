<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Grupo;
use App\Cadena;
use App\Estado;
use App\Reference;
use DB;


class CoverDeliveryEquipmentController extends Controller
{
  public function index()
  {
        $groups = DB::table('listar_grupos')->get();
        return view('permitted.equipment.cover_delivery',compact('groups'));
  }


  public function getHeader(Request $request)
  {
    $group = $request->data_one;

    $result = DB::select('CALL delivery_groups_header(?)', array($group));

    return json_encode($result);
  }

  public function getCoverDistEquipos(Request $request)
  {
    $group = $request->data_one;

    $result1 = DB::select('CALL delivery_groups_venue_disp (?)', array($group));

    return json_encode($result1);
  }

  public function getCoverDistModelos(Request $request)
  {
    $group = $request->data_one;

    $result1 = DB::select('CALL delivery_groups_venue_models (?)', array($group));

    return json_encode($result1);
  }



  public function table_group(Request $request)
  {
    $group_selected = $request->data_one;
    $res = DB::select('CALL delivery_groups_devices(?)', array($group_selected));
    return json_encode($res);
  }

}
