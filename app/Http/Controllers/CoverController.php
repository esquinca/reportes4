<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
use DB;
class CoverController extends Controller
{
  /**
   * Show the application cover
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.inventory.det_cover',compact('hotels'));
    }
    else {
      $hotels = auth()->user()->hotels;
      return view('permitted.inventory.det_cover',compact('hotels'));
    }
  }

  public function test()
  {
    $result1 = DB::select('CALL delivery_letter_venue_header (?)', array(9));
    $result2 = DB::select('CALL delivery_letter_venue_disp (?)', array(9));
    $result3 = DB::select('CALL delivery_letter_venue_models (?)', array(9));


    dd($result3);
  }

  public function getHeader(Request $request) 
  { 
    $hotel = $request->data_one; 
 
    $result1 = DB::select('CALL delivery_letter_venue_header (?)', array($hotel)); 
     
    return json_encode($result1); 
  }

  public function getCoverDistEquipos(Request $request)
  {
    $hotel = $request->data_one; 
 
    $result1 = DB::select('CALL delivery_letter_venue_disp (?)', array($hotel)); 
     
    return json_encode($result1); 
  }

  public function getCoverDistModelos(Request $request)
  {
    $hotel = $request->data_one; 
 
    $result1 = DB::select('CALL delivery_letter_venue_models (?)', array($hotel)); 
     
    return json_encode($result1); 
  }

}
