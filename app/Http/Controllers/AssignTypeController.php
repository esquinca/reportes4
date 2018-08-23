<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
use App\Typereport;
use DB;
use Auth;
use Carbon\Carbon;

class AssignTypeController extends Controller
{
  /**
   * Show the application view blade Assign Type Report
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      $types = Typereport::all();
      return view('permitted.report.assign_report',compact('hotels', 'types'));
    }
    else {
      $hotels = auth()->user()->hotels;
      $types = Typereport::all();
      return view('permitted.report.assign_report',compact('hotels', 'types'));
    }
  }
  public function show(Request $request)
  {
    $resultados = Typereport::all();
    return json_encode($resultados);
  }
  public function edit(Request $request)
  {
    $id= $request->sector;
    $resultados = Typereport::find($id);
    return json_encode($resultados);
  }

  public function table(Request $request)
  {
    $result = DB::table('hotel_type_report_view')->select('id', 'Nombre_hotel', 'name')->orderBy('Nombre_hotel', 'asc')->get();
    return json_encode($result);
  }
  public function create_rel_user(Request $request)
  {
    $hotels= $request->select_one;
    $type= $request->select_two;
    $flag = 0;
    $count_md = DB::table('hotel_typereport')->where('hotel_id', $hotels)->where('typereport_id', $type)->count();
    if ($count_md == '0') {
      $result = DB::table('hotel_typereport')->insertGetId(['hotel_id' => $hotels, 'typereport_id' => $type ]);
      if($result != '0'){
        $flag =1;
      }
    }
    return $flag;
  }
  public function delete_rel_user(Request $request)
  {
    $id= $request->recibidoconf;
    $result = DB::table('hotel_typereport')->where('id', '=', $id)->delete();
    return '1';
  }
}
