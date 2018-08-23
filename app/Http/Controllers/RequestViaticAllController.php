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

class RequestViaticAllController extends Controller
{
  public function index()
  {
      return view('permitted.viaticos.history_request_month');
  }
  public function history_all (Request $request) {
    $result = array();
    $input_date_i= $request->get('date_to_search');
    if ($input_date_i != '') {
      $date = $input_date_i.'-01';
    }
    else {
      $date_current = date('Y-m');
      $date = $date_current.'-01';
    }
    if (auth()->user()->can('View history all viatic')){ /*Le muestro todas las solicitudes al usuario*/
        $result = DB::select('CALL history_viatic_month_year (?)', array($date));
        $count = count($result);
        for($i = 0; $i < $count; $i++)
        {
          $solicitado = $result[$i]->solicitado;
          $solicitado_format = '$' . number_format($solicitado, 2, '.', ',') . ' MXN';

          $aprobado = $result[$i]->aprobado;
          $aprobado_format = '$' . number_format($aprobado, 2, '.', ',') . ' MXN';

          $result[$i]->solicitado = $solicitado_format;
          $result[$i]->aprobado = $aprobado_format;
        }

    }
    return json_encode($result);
  }

  public function timeline(Request $request){
    $input_date_i= $request->get('viatic');
    $result = DB::select('CALL viatic_user_statuses_all	 (?)', array($input_date_i));
    return json_encode($result);
  }
  public function totales(Request $request){
    $input_id= $request->get('viatic');
    $result = DB::select('CALL viatic_concepts_status	 (?)', array($input_id));
    $count = count($result);
    for($i = 0; $i < $count; $i++)
    {
      $total = $result[$i]->suma;
      $total_format = '$' . number_format($total, 2, '.', ',') . ' MXN';

      $result[$i]->suma = $total_format;

    }
    return json_encode($result);
  }

}
