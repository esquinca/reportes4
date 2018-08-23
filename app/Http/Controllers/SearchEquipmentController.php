<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use DB;
use Auth;
use Carbon\Carbon;

class SearchEquipmentController extends Controller
{
  /**
   * Show the application search equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.equipment.search_equipment',compact('hotels'));
  }
  public function search_range(Request $request)
  {
    $data_a = $request->inicio;
    $data_b = $request->fin;
    $result = DB::select('CALL detail_device_baja (?, ?)', array($data_a, $data_b));
    return json_encode($result);
  }
  public function search_mac(Request $request)
  {
    $mac = $request->mac_input;
    $result = DB::select('CALL detail_device_mac_serie(?)', array($mac));
    return json_encode($result);
  }
}
