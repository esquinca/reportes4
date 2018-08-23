<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
use DB;
class HotelDController extends Controller
{
  /**
   * Show the application hotel detailed.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin')) {
      $cadena = Cadena::select('id', 'name')->get();
      return view('permitted.inventory.det_hotel',compact('cadena'));
    }
    else if (auth()->user()->hasanyrole('Admin')) {
      $cadena = DB::table('listarcadena_noasignar')->select('id', 'name')->get();
      return view('permitted.inventory.det_hotel',compact('cadena'));
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
      return view('permitted.inventory.det_hotel',compact('cadena'));
    }
  }

  public function hotel_cadena(Request $request)
  {
    $value= $request->numero;
    //$cadena = 44;
    $hoteles = Hotel::where('cadena_id', $value)->get();

    return $hoteles;
    //dd($hoteles);

  }

  public function acm1pt()
  {

    $result1 = DB::select('CALL GetStatusAP_Venue (?)', array(9));
    $result2 = DB::select('CALL GetStatusSW_Venue (?)', array(9));
    $result3 = DB::select('CALL GetStatusZD_Venue (?)', array(9));
    //Call para tabla
    $result4 = DB::select('CALL GetDetail_Disp_Venue(?)', array(9));
    //Modelos y unidades
    $result5 = DB::select('CALL GetStatusAll_Disp_Model_Venue (?)', array(9));
    //Equipos status para Graph Pie
    $result6 = DB::select('CALL GetStatusAll_Disp_Status_Venue(?)', array(9));
    // Distribucion 1er barra
    $result7 = DB::select('CALL GetStatusAll_Disp_Venue (?)', array(9));
    // Header
    $result8 = DB::select('CALL GetHeader_Venue (?)', array(9));

    dd($result8);

  }

  public function getHeaders(Request $request)
  {
    $hotel = $request->data_two;
    $result = DB::select('CALL GetHeader_Venue (?)', array($hotel));

    return json_encode($result);
  }

  public function getSummary(Request $request)
  {
    $hotel = $request->data_two;
    $result = DB::select('CALL GetStatusAP_Venue (?)', array($hotel));

    return json_encode($result);
  }

  public function getSwitch(Request $request)
  {
    $hotel = $request->data_two;
    $result = DB::select('CALL GetStatusSW_Venue (?)', array($hotel));

    return json_encode($result);
  }

  public function getZone(Request $request)
  {
    $hotel = $request->data_two;
    $result = DB::select('CALL GetStatusZD_Venue (?)', array($hotel));

    return json_encode($result);

  }

  public function getSummaryPie(Request $request)
  {
    $hotel = $request->data_two;
    $result = DB::select('CALL GetStatusAll_Disp_Status_Venue(?)', array($hotel));

    return json_encode($result);
  }

  //Quantitys
  public function getDristributionQuantitys(Request $request)
  {
    $hotel = $request->data_two;
    $result = DB::select('CALL GetStatusAll_Disp_Venue (?)', array($hotel));

    return json_encode($result);

  }

  public function getEquipmentModels(Request $request)
  {
    $hotel = $request->data_two;
    $result = DB::select('CALL GetStatusAll_Disp_Model_Venue (?)', array($hotel));

    return json_encode($result);

  }

  public function getDetailedEquipment(Request $request)
  {
    $hotel = $request->data_two;
    $result = DB::select('CALL GetDetail_Disp_Venue (?)', array($hotel));

    return json_encode($result);

  }

}
