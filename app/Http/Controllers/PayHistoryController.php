<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
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
use Mail;
use File;
use App\Mail\SolicitudConP;
class PayHistoryController extends Controller
{
  public function index()
  {
    $cadena = Cadena::select('id', 'name')->get()->sortBy('name');
    $proveedor = Proveedor::select('id', 'nombre')->get();
    $vertical = Payments_verticals::pluck('name', 'id');
    $currency = Currency::select('id','name')->get();
    $way = Payments_way_pay::select('id','name')->get();
    $area = Payments_area::pluck('name', 'id');
    $application = Payments_application::pluck('name', 'id');
    $options = Payments_project_options::pluck('name', 'id');
    $classification =Payments_classification::select('id','name')->get();
    $financing = Payments_financing::pluck('name', 'id');

    return view('permitted.payments.history_requests_pay',compact('cadena','proveedor','vertical', 'currency', 'way', 'area', 'application', 'options', 'classification', 'financing'));

  }

  public function history_zero (Request $request) {
    $user = Auth::user()->id;
    $email = Auth::user()->email;
    $result = array();
    $input_date_i= $request->get('date_to_search');

    if ($input_date_i != '') {
      $date = $input_date_i.'-01';
    }
    else {
      $date_current = date('Y-m');
      $date = $date_current.'-01';
    }
    if (auth()->user()->can('View history of payment')) {
      if (auth()->user()->can('View level zero payment notification')){ /*Notificaciones del usuario, con estatus nuevo*/
        $result = DB::select('CALL  get_payments_mes (?)', array($date));
      }
      if (auth()->user()->can('View level one payment notification')){ /*Notificaciones del usuario, con estatus nuevo*/
        $result = DB::select('CALL  get_payments_mes (?)', array($date));
      }
      if (auth()->user()->can('View level two payment notification')){ /*Notificaciones del usuario, con estatus nuevo*/
        $result = DB::select('CALL  get_payments_mes (?)', array($date));
      }
      if (auth()->user()->can('View level three payment notification')){ /*Notificaciones del usuario, con estatus nuevo*/
        $result = DB::select('CALL  get_payments_mes (?)', array($date));
      }
    }
    return json_encode($result);
  }
  public function approval_one(Request $request) {
    $solicitud_id = json_decode($request->idents);
    $user = Auth::user()->id;
    $valor= 'false';
    for ($i=0; $i <= (count($solicitud_id)-1); $i++) {
      $sql = DB::table('payments')->where('id', '=', $solicitud_id[$i])->update(['payments_states_id' => '2', 'updated_at' => Carbon::now()]);
      $new_reg_paym = new Pay_status_user;
      $new_reg_paym->payment_id = $solicitud_id[$i];
      $new_reg_paym->user_id = $user;
      $new_reg_paym->status_id = '2';
      $new_reg_paym->save();
      $valor= 'true';
    }
    return $valor;
  }
  public function approval_two(Request $request) {
    $solicitud_id = json_decode($request->idents);
    $user = Auth::user()->id;
    $valor= 'false';
    for ($i=0; $i <= (count($solicitud_id)-1); $i++) {
      $sql = DB::table('payments')->where('id', '=', $solicitud_id[$i])->update(['payments_states_id' => '3', 'updated_at' => Carbon::now()]);
      $new_reg_paym = new Pay_status_user;
      $new_reg_paym->payment_id = $solicitud_id[$i];
      $new_reg_paym->user_id = $user;
      $new_reg_paym->status_id = '3';
      $new_reg_paym->save();
      $valor= 'true';
    }
    return $valor;
  }
  public function approval_three (Request $request) {
    $solicitud_id = json_decode($request->idents);
    $user = Auth::user()->id;
    $valor= 'false';
    for ($i=0; $i <= (count($solicitud_id)-1); $i++) {
      $sql = DB::table('payments')->where('id', '=', $solicitud_id[$i])->update(['payments_states_id' => '4', 'updated_at' => Carbon::now()]);

      $user_sol = DB::table('pay_status_users')->select('user_id')->where([['payment_id', '=', $solicitud_id[$i]],['status_id', '=', 1]])->value('user_id');

      $user_email = DB::table('users')->select('email')->where('id', $user_sol)->value('email');
      $user_email = trim($user_email);
      $result = DB::select('CALL px_payments_data (?)', array($solicitud_id[$i]));

      $new_reg_paym = new Pay_status_user;
      $new_reg_paym->payment_id = $solicitud_id[$i];
      $new_reg_paym->user_id = $user;
      $new_reg_paym->status_id = '4';
      $new_reg_paym->save();
      $valor= 'true';

      $parametros1 = [
        'folio' => $result[0]->folio,
        'elaboro' => $result[0]->elaboro,
        'cadena' => $result[0]->cadena,
        'sitio' => $result[0]->Sitio,
        'proveedor' => $result[0]->proveedor,
        'monto' => $result[0]->monto,
        'moneda' => $result[0]->moneda,
        'concepto' => $result[0]->concepto_pago,
        'forma_pago' => $result[0]->forma_pago,
        'banco' => $result[0]->banco,
        'areas' => $result[0]->areas,
        'proyecto_nombre' => $result[0]->proyecto,
        'instalacion' => $result[0]->pago_por,
        'verticales' => $result[0]->verticales,
        'finance' => $result[0]->financiamiento,
        'observaciones' => $result[0]->observaciones,
        'fecha_elaboro' => $result[0]->fecha_elaboro,
        'clasificacion' => $result[0]->clasification,
        'aplicacion' => $result[0]->aplication
      ];
      Mail::to($user_email)->send(new SolicitudConP($parametros1));
    }
    return $valor;
  }
  public function approval_three_ind (Request $request) {
    $user = Auth::user()->id;
    $valor= '0';
    $solicitud_id = $request->idents;
    $result_exist = DB::select('CALL px_pay_status_user_4o3 (?)', array($solicitud_id));
    if ($result_exist[0]->resp === '0'){
      $valor= $result_exist[0]->resp;
    }
    if ($result_exist[0]->resp === '1'){
      $valor= $result_exist[0]->resp;
      $sql = DB::table('payments')->where('id', '=', $solicitud_id)->update(['payments_states_id' => '4', 'updated_at' => Carbon::now()]);

      $user_sol = DB::table('pay_status_users')->select('user_id')->where([['payment_id', '=', $solicitud_id],['status_id', '=', 1]])->value('user_id');

      $user_email = DB::table('users')->select('email')->where('id', $user_sol)->value('email');
      $user_email = trim($user_email);
      $result = DB::select('CALL px_payments_data (?)', array($solicitud_id));

      $new_reg_paym = new Pay_status_user;
      $new_reg_paym->payment_id = $solicitud_id;
      $new_reg_paym->user_id = $user;
      $new_reg_paym->status_id = '4';
      $new_reg_paym->save();

      $parametros1 = [
        'folio' => $result[0]->folio,
        'elaboro' => $result[0]->elaboro,
        'cadena' => $result[0]->cadena,
        'sitio' => $result[0]->Sitio,
        'proveedor' => $result[0]->proveedor,
        'monto' => $result[0]->monto,
        'moneda' => $result[0]->moneda,
        'concepto' => $result[0]->concepto_pago,
        'forma_pago' => $result[0]->forma_pago,
        'banco' => $result[0]->banco,
        'areas' => $result[0]->areas,
        'proyecto_nombre' => $result[0]->proyecto,
        'instalacion' => $result[0]->pago_por,
        'verticales' => $result[0]->verticales,
        'finance' => $result[0]->financiamiento,
        'observaciones' => $result[0]->observaciones,
        'fecha_elaboro' => $result[0]->fecha_elaboro,
        'clasificacion' => $result[0]->clasification,
        'aplicacion' => $result[0]->aplication
      ];
      Mail::to($user_email)->send(new SolicitudConP($parametros1));
    }
    if ($result_exist[0]->resp === '2'){
      $valor= $result_exist[0]->resp;
    }
    return $valor;
  }

  public function data_basic (Request $request) {
    $pay_id= $request->get('pay');
    $result = DB::select('CALL payments_data (?)', array($pay_id));
    $result2 = json_encode($result);
    $result3 = json_decode($result2,true);
    $monto = $result3[0]['amount'];
    $amount = number_format($monto, 2, '.', ',');
    $result3[0]['amount_format']="$amount";
    return $result3;
  }
  public function data_basic_area (Request $request) {
    $pay_id= $request->get('pay');
    $result = DB::select('CALL payments_areas (?)', array($pay_id));
    return json_encode($result);
  }
  public function data_basic_type (Request $request) {
    $pay_id= $request->get('pay');
    $result = DB::select('CALL payments_verticals (?)', array($pay_id));
    return json_encode($result);
  }
  public function data_basic_financing (Request $request) {
    $pay_id= $request->get('pay');
    $result = DB::select('CALL payments_financings (?)',array($pay_id));
    return json_encode($result);
  }
  public function data_basic_comments (Request $request) {
    $pay_id= $request->get('pay');
    $result = DB::select('CALL payments_comments (?)',array($pay_id));
    return json_encode($result);
  }
  public function data_basic_firmas (Request $request) {
    $pay_id= $request->get('pay');
    $result = DB::select('CALL payments_user_statuses_all (?)',array($pay_id));
    return json_encode($result);
  }
  public function data_basic_bank (Request $request) {
    $pay_id= $request->get('pay');
    $result = DB::select('CALL payments_ctabco_data (?)',array($pay_id));
    return json_encode($result);
  }
  public function deny_payment_act (Request $request) {
    $user = Auth::user()->id;
    $pay_id= $request->get('idents');
    $valor= 'false';
    if (auth()->user()->can('View level one payment notification')){
      $count_md = DB::table('payments')->where('id', '=', $pay_id)->where('payments_states_id', '!=', '5')->where('payments_states_id', '!=', '4')->count();
      if ($count_md != '0') {
        $sql = DB::table('payments')->where('id', '=', $pay_id)->update(['payments_states_id' => '5', 'updated_at' => Carbon::now()]);
        $new_reg_paym = new Pay_status_user;
        $new_reg_paym->payment_id = $pay_id;
        $new_reg_paym->user_id = $user;
        $new_reg_paym->status_id = '5';
        $new_reg_paym->save();
        $valor= 'true';
      }
    }
    if (auth()->user()->can('View level two payment notification')){
      $count_md = DB::table('payments')->where('id', '=', $pay_id)->where('payments_states_id', '!=', '5')->where('payments_states_id', '!=', '4')->count();
      if ($count_md != '0') {
        $sql = DB::table('payments')->where('id', '=', $pay_id)->update(['payments_states_id' => '5', 'updated_at' => Carbon::now()]);
        $new_reg_paym = new Pay_status_user;
        $new_reg_paym->payment_id = $pay_id;
        $new_reg_paym->user_id = $user;
        $new_reg_paym->status_id = '5';
        $new_reg_paym->save();
        $valor= 'true';
      }
    }
    return $valor;
  }

  public function getInvoice(Request $request)
  {
     $id = $request->id_fact;
     $count = DB::table('pay_facturas')->select('name')->where('payment_id',$id)->count();
     if($count != 0)
     {
       $sql = DB::table('pay_facturas')->select('name')->where('payment_id',$id)->get();
       $file =  $sql[0]->name;

       $path = public_path('/images/storage/'.$file);
       if(File::exists($path)){
         return response()->download(public_path('/images/storage/'.$file));
       }

     }

  }


}
