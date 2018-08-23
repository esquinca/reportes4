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

class ViaticWeeklyController extends Controller
{
  public function index()
  {
      return view('permitted.viaticos.weekly_viatic');
  }

  public function viatic_historic_weekly(Request $request)
  {
    $input1 = $request->startDate;
    $input2 = $request->endDate;


  		$fecha_inicio = $input1;
  		$fecha_fin = $input2;

  		if ($input1 < $input2) {
  		    $fecha_inicio = $input1;
  		    $fecha_fin = $input2;
  		}else{
  		    $fecha_inicio = $input2;
  		    $fecha_fin = $input1;
  		}

  	  $result = DB::select('CALL history_viatic_weekly(?, ?)', array($fecha_inicio, $fecha_fin));
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
  		return json_encode($result);


  }

}
