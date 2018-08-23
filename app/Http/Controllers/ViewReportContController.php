<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Reference;
use DB;

class ViewReportContController extends Controller
{
  public function index()
  {
      if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
        $cadena = Cadena::select('id', 'name')->get();
        return view('permitted.report.view_reports_cont',compact('cadena'));
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
        return view('permitted.report.view_reports_cont',compact('cadena'));
      }
  }

  public function test()
  {
    $result1 = DB::select('CALL  summary_chain_gb (?, ?)', array('2018-02-01',44));
    $result2 = DB::select('CALL summary_chain_user (?, ?)', array('2018-02-01',44));
    // $result3 = DB::select('CALL GetWLAN_top5 (?, ?, ?)', array(7, 2018, 2));
    // $result4 = DB::select('CALL Get_User (?, ?, ?)', array(2018, 2, 7));

    dd($result2);
  }

  public function table_gb(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];
    $datefull = $dateyear . '-' . $datemonth . '-01';

    $result1 = DB::select('CALL  summary_chain_gb (?, ?)', array($datefull,$hotel));

    return json_encode($result1);
  }

  public function table_user(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];
    $datefull = $dateyear . '-' . $datemonth . '-01';

    $result1 = DB::select('CALL summary_chain_user (?, ?)', array($datefull,$hotel));

    return json_encode($result1);
  }
  public function table_device(Request $request)
  {
    $hotel = $request->data_one;
    $date = $request->data_two;

    $datemonthyear =  explode('-', $date);
    $dateyear= (int)$datemonthyear[0];
    $datemonth= (int)$datemonthyear[1];
    $datefull = $dateyear . '-' . $datemonth . '-01';

    $result1 = DB::select('CALL summary_chain_devices (?, ?)', array($datefull,$hotel));

    return json_encode($result1);
  }


}
