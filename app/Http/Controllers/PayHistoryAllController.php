<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User; //Importar el modelo eloquent
use App\Proveedor;
use App\Vertical;
use App\Reference;
use App\Hotel;
use App\Cadena;
use App\Banco;
use App\Currency;
use App\Prov_bco_cta;
use App\Pay_status_user;

use App\Payments_application;
use App\Payments_area;
use App\Payments_classification;
use App\Payments_comment;
use App\Payments_financing;
use App\Payments_project_options;
use App\Payments_states;
use App\Payments_verticals;
use App\Payments_way_pay;
use App\Payments;
use DateTime;

class PayHistoryAllController extends Controller
{
  public function index()
  {
    $proveedor = Proveedor::select('id', 'nombre')->get();
    $vertical = Payments_verticals::pluck('name', 'id');
    $currency = Currency::select('id','name')->get();
    $way = Payments_way_pay::select('id','name')->get();
    $area = Payments_area::pluck('name', 'id');
    $application = Payments_application::pluck('name', 'id');
    $options = Payments_project_options::pluck('name', 'id');
    $classification =Payments_classification::select('id','name')->get();
    $financing = Payments_financing::pluck('name', 'id');

      return view('permitted.payments.history_all_requests_pay',compact('proveedor','vertical', 'currency', 'way', 'area', 'application', 'options', 'classification', 'financing'));
  }

  public function solicitudes_historic(Request $request)
  {
    $input1 = $request->startDate;
    $input2 = $request->endDate;

    if (empty($input1) || empty($input2)) {
      $fecha_f = new DateTime();
      $fecha_f->modify('last day of this month');
      $date_fin= $fecha_f->format('Y-m-d');

      $date_inicio = date('Y-m');
    	$date_inicio = $date_inicio . '-01';

    	$res = DB::select('CALL payments_fechasolicitud(?, ?)', array($date_inicio, $date_fin));
    	return json_encode($res);
    }else{
  		$fecha_inicio = "";
  		$fecha_fin = "";

  		if ($input1 < $input2) {
  		    $fecha_inicio = $input1;
  		    $fecha_fin = $input2;
  		}else{
  		    $fecha_inicio = $input2;
  		    $fecha_fin = $input1;
  		}
  		$res = DB::select('CALL payments_fechasolicitud(?, ?)', array($fecha_inicio, $fecha_fin));

  		return json_encode($res);
    }
  }

}
