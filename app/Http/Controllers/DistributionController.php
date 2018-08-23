<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
use DB;
class DistributionController extends Controller
{
  /**
   * Show the application distribution
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.inventory.det_distribution',compact('hotels'));
  }
  public function show(Request $request)
  {
    $hotels = Hotel::select('Nombre_hotel', 'Direccion', 'Latitude', 'Longitude')->get();
    return json_encode($hotels);
  }

  public function show_device(Request $request)
  {
    $hotel = $request->ident;
    $result = DB::select('CALL desglose_inventario_venue(?)', array($hotel));
    return json_encode($result);
  }

}
