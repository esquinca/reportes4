<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hotel;
use DB;
use Auth;
use Carbon\Carbon;

class RemovedEquipmentController extends Controller
{
  /**
   * Show the application removed equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $hotels = Hotel::select('id', 'Nombre_hotel')->get();
    return view('permitted.equipment.removed_equipment',compact('hotels'));
  }

  public function show(Request $request)
  {
    $hotel = $request->ident;
    $result = DB::select('CALL detail_device_venue(?)', array($hotel));
    return json_encode($result);
  }
  public function edit(Request $request)
  {
    $equipos = json_decode($request->idents);
    $valor= 'false';
    for ($i=0; $i <= (count($equipos)-1); $i++) {
      $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['estados_id' => '2', 'Fecha_Baja' => date('Y-m-d'), 'updated_at' => Carbon::now()]);
      $valor= 'true';
    }
    return $valor;
  }
}
