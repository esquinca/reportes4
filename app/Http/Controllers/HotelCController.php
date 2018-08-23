<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
class HotelCController extends Controller
{
  /**
   * Show the application hotel with costs.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.inventory.det_costs',compact('hotels'));
    }
    else {
      $hotels = auth()->user()->hotels;
      return view('permitted.inventory.det_costs',compact('hotels'));
    }
  }
}
