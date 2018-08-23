<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class ResultsSurveyController extends Controller
{
  /**
   * Show the application result survey
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.qualification.results_survey');
  }

  public function test()
  {
    $result1 = DB::select('CALL NPS (?)', array('2018-02-01'));
    $result2 = DB::select('CALL Get_Comment (?)', array(1));
    // $result3 = DB::select('CALL GetWLAN_top5 (?, ?, ?)', array(7, 2018, 2));
    // $result4 = DB::select('CALL Get_User (?, ?, ?)', array(2018, 2, 7));
    // $result5 = DB::select('CALL Get_GB (?, ?, ?)', array(2018, 2, 7));
    // $result6 = DB::select('CALL Get_MostAP_top5 (?, ?, ?)', array(7, 2018, 2));
    // $result7 = DB::select('CALL Comparative (?, ?)', array(7, '2018-2-01'));

    dd($result2);
  }

  public function result_survey(Request $request)
  {
    $input_date_i= $request->get('date_to_search');
    if ($input_date_i != '') {
      $date = $input_date_i.'-01';
    }
    else {
      $date_current = date('Y-m');
      $sub_month = strtotime ( '-1 month' , strtotime ( $date_current ) ) ;
      $sub_month = date ( 'Y-m' , $sub_month );
      $date = $sub_month.'-01';
    }
    $result = DB::select('CALL NPS (?)', array($date));
    return json_encode($result);
  }
  public function comment_survey(Request $request)
  {
    $input_id= $request->get('sector');
    $result = DB::select('CALL Get_Comment (?)', array($input_id));
    return json_encode($result);
  }

}
