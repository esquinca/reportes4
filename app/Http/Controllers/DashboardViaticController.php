<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User; //Importar el modelo eloquent
use App\Cadena;
use App\Viatic_service;
use App\Viatic_beneficiary;
use App\Viatic_state;
use App\Viatic_list_concept;
use App\Jefedirecto;
use App\Hotel;
use App\Reference;
use App\Viatic;
use App\Concept;
use App\viatic_user_status;
use App\Viatic_state_concept;
class DashboardViaticController extends Controller
{
  public function index()
  {
      return view('permitted.viaticos.dashboard_viaticos');
  }
  public function info(Request $request)
  {
    $user = Auth::user()->id;
    $result = array();
    $input_date_i= $request->get('date_to_search');
    if ($input_date_i != '') {
      $date = $input_date_i.'-01';
    }
    else {
      $date_current = date('Y-m');
      $date = $date_current.'-01';
    }

    if (auth()->user()->can('Travel allowance notification')) {
        $result = DB::select('CALL dashboardviaticos (?,?)', array($user, $date));
        return json_encode($result);
    }
    return json_encode($result);
  }
}
