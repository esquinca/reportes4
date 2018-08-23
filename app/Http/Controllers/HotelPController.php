<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
use DB;

class HotelPController extends Controller
{
  /**
   * Show the application hotel for project.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin')) {
      $cadena = Cadena::select('id', 'name')->get();
      return view('permitted.inventory.det_project',compact('cadena'));
    }
    else if (auth()->user()->hasanyrole('Admin')) {
      $cadena = DB::table('listarcadena_noasignar')->select('id', 'name')->get();
      return view('permitted.inventory.det_project',compact('cadena'));
    }
    else {
      $hotel = auth()->user()->hotels;
      $cadena_total =array();
      foreach ($hotel as $data)
      {
        $name_cadena = Cadena::select(['id','name'])->find($data->cadena_id);
        array_push($cadena_total, $name_cadena);
      }
      $cadena = array_values(array_unique($cadena_total));
      return view('permitted.inventory.det_project',compact('cadena'));
    }
  }

  public function test()
  {
    $result1 = DB::select('CALL GetHeader_Proyect (?)', array(10));
    $result2 = DB::select('CALL GetStatusAP_Proyect (?)', array(10));
    $result3 = DB::select('CALL GetStatusSW_Proyect (?)', array(10));
    $result4 = DB::select('CALL GetStatusAll_Disp_Proyect (?)', array(10));
    $result5 = DB::select('CALL GetStatusAll_Disp_Model_Proyect (?)', array(10));
    $result6 = DB::select('CALL GetStatusAll_Proyect_Table (?, ?)', array(10 ,1));
    $result7 = DB::select('CALL Get_Status_Proyect (?)', array(10));

    dd($result6);
  }

  public function getHeaderProject(Request $request)
  {
    $hotel = $request->data_one;
    $result = DB::select('CALL GetHeader_Proyect (?)', array($hotel));

    return json_encode($result);
  }

  public function getStatusProject(Request $request)
  {
    $cadena = $request->numero;
    $result = DB::select('CALL Get_Status_Proyect (?)', array($cadena));

    return json_encode($result);
  }

  public function getGraphAPS(Request $request)
  {
    $hotel = $request->data_one;
    $result = DB::select('CALL GetStatusAP_Proyect (?)', array($hotel));

    return json_encode($result);
  }

  public function getGraphSWS(Request $request)
  {
    $hotel = $request->data_one;
    $result = DB::select('CALL GetStatusSW_Proyect (?)', array($hotel));

    return json_encode($result);
  }

  public function getDispProject(Request $request)
  {
    $hotel = $request->data_one;
    $result = DB::select('CALL GetStatusAll_Disp_Proyect (?)', array($hotel));

    return json_encode($result);
  }

  public function getModelProject(Request $request)
  {
    $hotel = $request->data_one;
    $result = DB::select('CALL GetStatusAll_Disp_Model_Proyect (?)', array($hotel));

    return json_encode($result);
  }

  public function getProjectTable(Request $request)
  {
    $cadena = $request->cadena;
    $stat = $request->status;

    $result = DB::select('CALL GetStatusAll_Proyect_Table (?, ?)', array($cadena , $stat));

    return json_encode($result);
  }
  public function getProjectTableGen(Request $request)
  {
    $cadena = $request->cadena;
    $result = DB::select('CALL GetStatusAll_Proyect_Table_all (?)', array($cadena));
    return json_encode($result);
  }

}
