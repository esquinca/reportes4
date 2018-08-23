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
use Mail;
use App\Mail\ConfirmacionV;

class RequestsViaticController extends Controller
{
    public function index()
    {
        return view('permitted.viaticos.history_requests');
    }

    public function deny_viatic (Request $request) {
      $user = Auth::user()->id;
      $viatic_id= $request->get('idents');
      $valor= 'false';
      if (auth()->user()->can('Deny travel allowance request')) {
        $count_md = DB::table('viatics')->where('id', '=', $viatic_id)->where('state_id', '!=', '5')->where('state_id', '!=', '6')->count();
        if ($count_md != '0') {
          $sql = DB::table('viatics')->where('id', '=', $viatic_id)->update(['state_id' => '5', 'updated_at' => Carbon::now()]);
          $new_reg_viatic = new viatic_user_status;
          $new_reg_viatic->viatic_id = $viatic_id;
          $new_reg_viatic->user_id = $user;
          $new_reg_viatic->status_id = '5';
          $new_reg_viatic->save();
          $valor= 'true';
        }
      }
      return $valor;
    }

    public function history (Request $request) {
      $user = Auth::user()->id;
      $email = Auth::user()->email;

      $input_date_i= $request->get('date_to_search');

      if ($input_date_i != '') {
        $date = $input_date_i.'-01';
      }
      else {
        $date_current = date('Y-m');
        $date = $date_current.'-01';
      }

      if (auth()->user()->can('Travel allowance notification')) {
        if (auth()->user()->can('View level zero notifications')){ /*Le muestro sus solicitudes al usuario*/
          $result = DB::select('CALL history_viatic_user_solicitado_aprobado (?,?)', array($user, $date));
          return json_encode($result);
        }
        if (auth()->user()->can('View level one notifications')){ /*Notificaciones del usuario, con estatus nuevo*/
          $result = DB::select('CALL  history_viatic_user_solicitado_aprobado_N1 (?)', array($date));
          return json_encode($result);
        }
        if (auth()->user()->can('View level two notifications')){ /*Notificaciones del usuario, con estatus pendiente*/
          $result = DB::select('CALL  history_viatic_user_solicitado_aprobado_N2 (?,?)', array($date, $id_gerente));
          return json_encode($result);
        }
        if (auth()->user()->can('View level three notifications')){ /*Notificaciones del usuario, con estatus aprueba*/
          $result = DB::select('CALL history_viatic_user_solicitado_aprobado (?,?)', array($user, 3));
          return json_encode($result);
        }
        if (auth()->user()->can('View level four notifications')){ /*Notificaciones del usuario, con estatus pagado*/
          $result = DB::select('CALL history_viatic_user_solicitado_aprobado (?,?)', array($user, 4));
          return json_encode($result);
        }
      }
      else {}
    }

    public function history_zero (Request $request) {
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
        if (auth()->user()->can('View level zero notifications')){ /*Le muestro sus solicitudes al usuario*/
          $result = DB::select('CALL history_viatic_user_solicitado_aprobado (?,?)', array($user, $date));
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
      }

      return json_encode($result);
    }
    public function show_viatic_up (Request $request) {
      $viatic= $request->get('viatic');
      $result = DB::select('CALL history_viatic_user_beneficiarios (?)', array($viatic));
      return json_encode($result);
    }
    public function show_viatic_down (Request $request) {
      $viatic= $request->get('viatic');
      $result = DB::select('CALL history_viatic_user_conceptos (?)', array($viatic));
      $count = count($result);
      for($i = 0; $i < $count; $i++)
      {
        $amount = $result[$i]->amount;
        $amount_format = '$' . number_format($amount, 2, '.', ',') . ' MXN';

        $total = $result[$i]->total;
        $total_format = '$' . number_format($total, 2, '.', ',') . ' MXN';

        $result[$i]->amount = $amount_format;
        $result[$i]->total = $total_format;
      }
      return json_encode($result);
    }

    public function history_one (Request $request) { /*Devuelve todas las solicitudes del usuario con estatus *Nuevo* para aprobar y denegar conceptos*/
      $user = Auth::user()->id;
      $estado = 1;
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
        if (auth()->user()->can('View level one notifications')){ /*Notificaciones del usuario, con estatus nuevo*/
          $result = DB::select('CALL history_viatic_user_solicitado_aprobado_status (?,?,?)', array($user, $date, $estado));
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
      return json_encode($result);
    }
    public function pertain_viatic (Request $request) { /*Me pertenece el viatico. 0 Significa NO. 1 Significa SI*/
      $user = Auth::user()->id;
      $viatic_id= $request->get('viatic');
      $input_date_i= $request->get('date_to_search');
      if ($input_date_i != '') {
        $date = $input_date_i.'-01';
      }
      else {
        $date_current = date('Y-m');
        $date = $date_current.'-01';
      }
      $find_pertain_viatic = DB::select('CALL pertain_viatic_user_nuevo (?,?,?)', array($user, $viatic_id, $date));
      $result_find_pertain_viatic = $find_pertain_viatic[0]->respuesta;
      return $result_find_pertain_viatic;
    }
    public function edit_status_one (Request $request) {
      $viaticos_id = json_decode($request->idents);
      $user = Auth::user()->id;
      $valor= 'false';
      for ($i=0; $i <= (count($viaticos_id)-1); $i++) {
        $sql = DB::table('viatics')->where('id', '=', $viaticos_id[$i])->update(['state_id' => '2', 'updated_at' => Carbon::now()]);
        $new_reg_viatic = new viatic_user_status;
        $new_reg_viatic->viatic_id = $viaticos_id[$i];
        $new_reg_viatic->user_id = $user;
        $new_reg_viatic->status_id = '2';
        $new_reg_viatic->save();
        $valor= 'true';
      }
      return $valor;
    }
    public function find_concept_all (Request $request) {
      $user = Auth::user()->id;
      $result = array();
      $viatic= $request->get('viatic');
      if (auth()->user()->can('Travel allowance notification')) {
        if (auth()->user()->can('View level one notifications')){ /*Le muestro los conceptos del viatico*/
          $result = DB::select('CALL history_viatic_user_conceptos (?)', array($viatic));

        }
      }
      return json_encode($result);
    }
    public function find_concept (Request $request) {
      $concept = Viatic_state_concept::select('id', 'name')->get();
      return json_encode($concept);
    }

    public function history_two (Request $request) { /*Devuelve todas las solicitudes del usuario con estatus *Pendiente* para aprobar y denegar conceptos*/
      $user = Auth::user()->id;
      $email = Auth::user()->email;
      $find_gerente = DB::select('CALL find_email_jefe (?)', array($email));
      $result_find_gerente = $find_gerente[0]->respuesta;
      $estado = 2;
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
        if (auth()->user()->can('View level two notifications')){ /*Notificaciones del usuario, con estatus nuevo*/
          $result = DB::select('CALL history_viatic_user_solicitado_aprobado_status_jefe (?,?,?,?)', array($user, $date, $estado, $result_find_gerente));

        }
      }
      return json_encode($result);
    }
    public function pertain_viatic_two (Request $request) { /*Me pertenece el viatico. 0 Significa NO. 1 Significa SI*/
      $user = Auth::user()->id;
      $viatic_id= $request->get('viatic');
      $input_date_i= $request->get('date_to_search');
      if ($input_date_i != '') {
        $date = $input_date_i.'-01';
      }
      else {
        $date_current = date('Y-m');
        $date = $date_current.'-01';
      }

      $find_pertain_viatic = DB::select('CALL pertain_viatic_user_pendiente (?,?,?)', array($user, $viatic_id, $date));
      $result_find_pertain_viatic = $find_pertain_viatic[0]->respuesta;
      return $result_find_pertain_viatic;
    }
    public function edit_status_two (Request $request) {
      $viaticos_id = json_decode($request->idents);
      $user = Auth::user()->id;
      $valor= 'false';
      for ($i=0; $i <= (count($viaticos_id)-1); $i++) {
        $sql = DB::table('viatics')->where('id', '=', $viaticos_id[$i])->update(['state_id' => '3', 'updated_at' => Carbon::now()]);
        $new_reg_viatic = new viatic_user_status;
        $new_reg_viatic->viatic_id = $viaticos_id[$i];
        $new_reg_viatic->user_id = $user;
        $new_reg_viatic->status_id = '3';
        $new_reg_viatic->save();
        $valor= 'true';
      }
      return $valor;
    }

    public function history_three (Request $request) { /*Devuelve todas las solicitudes del usuario con estatus *Verifica* para aprobar y denegar conceptos*/
      $user = Auth::user()->id;
      $estado = 3;
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
        if (auth()->user()->can('View level three notifications')){ /*Notificaciones del usuario, con estatus nuevo*/
          $result = DB::select('CALL history_viatic_user_solicitado_aprobado_status_verifica (?,?,?)', array($user, $date, $estado));
        }
      }
      return json_encode($result);
    }
    public function pertain_viatic_three (Request $request) { /*Me pertenece el viatico. 0 Significa NO. 1 Significa SI*/
      $user = Auth::user()->id;
      $viatic_id= $request->get('viatic');
      $input_date_i= $request->get('date_to_search');
      if ($input_date_i != '') {
        $date = $input_date_i.'-01';
      }
      else {
        $date_current = date('Y-m');
        $date = $date_current.'-01';
      }

      $find_pertain_viatic = DB::select('CALL pertain_viatic_user_verifica (?,?,?)', array($user, $viatic_id, $date));
      $result_find_pertain_viatic = $find_pertain_viatic[0]->respuesta;
      return $result_find_pertain_viatic;
    }
    public function edit_status_three (Request $request) {
      $viaticos_id = json_decode($request->idents);
      $user = Auth::user()->id;
      $valor= 'false';
      for ($i=0; $i <= (count($viaticos_id)-1); $i++) {
        $sql = DB::table('viatics')->where('id', '=', $viaticos_id[$i])->update(['state_id' => '4', 'updated_at' => Carbon::now()]);
        $new_reg_viatic = new viatic_user_status;
        $new_reg_viatic->viatic_id = $viaticos_id[$i];
        $new_reg_viatic->user_id = $user;
        $new_reg_viatic->status_id = '4';
        $new_reg_viatic->save();
        $valor= 'true';
      }
      return $valor;
    }

    public function history_four (Request $request) { /*Devuelve todas las solicitudes del usuario con estatus *Verifica* para aprobar y denegar conceptos*/
      $user = Auth::user()->id;
      $estado = 4;
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
        if (auth()->user()->can('View level four notifications')){ /*Notificaciones del usuario, con estatus nuevo*/
          $result = DB::select('CALL history_viatic_user_solicitado_aprobado_status_verifica (?,?,?)', array($user, $date, $estado));
        }
      }
      return json_encode($result);
    }
    public function pertain_viatic_four (Request $request) { /*Me pertenece el viatico. 0 Significa NO. 1 Significa SI*/
      $user = Auth::user()->id;
      $viatic_id= $request->get('viatic');
      $input_date_i= $request->get('date_to_search');
      if ($input_date_i != '') {
        $date = $input_date_i.'-01';
      }
      else {
        $date_current = date('Y-m');
        $date = $date_current.'-01';
      }

      $find_pertain_viatic = DB::select('CALL pertain_viatic_user_aprueba (?,?,?)', array($user, $viatic_id, $date));
      $result_find_pertain_viatic = $find_pertain_viatic[0]->respuesta;
      return $result_find_pertain_viatic;
    }
    public function edit_status_four (Request $request) {
      $viaticos_id = json_decode($request->idents);
      $user = Auth::user()->id;
      $valor= 'false';
      for ($i=0; $i <= (count($viaticos_id)-1); $i++) {

        $sql = DB::table('viatics')->where('id', '=', $viaticos_id[$i])->update(['state_id' => '6', 'updated_at' => Carbon::now()]);
        $new_reg_viatic = new viatic_user_status;
        $new_reg_viatic->viatic_id = $viaticos_id[$i];
        $new_reg_viatic->user_id = $user;
        $new_reg_viatic->status_id = '6';
        $new_reg_viatic->save();
        $valor= 'true';

        $service = DB::table('viatics')->where('id',$viaticos_id[$i])->value('service_id');
        $gerente = DB::table('viatics')->where('id',$viaticos_id[$i])->value('jefedirecto_id');
        $beneficiary = DB::table('viatics')->where('id',$viaticos_id[$i])->value('beneficiary_id');
        $user_id = DB::table('viatics')->where('id',$viaticos_id[$i])->value('user_id');

        //email beneficiario
        $email_bene = DB::table('users')->select('email')->where('id', $beneficiary)->value('email');
        $email_bene = trim($email_bene);
        $user_email =  DB::table('users')->select('email')->where('id', $user_id)->value('email');
        $bene_nombre = DB::table('users')->select('name')->where('id', $user_id)->value('name');


        $service_name = Viatic_service::select('name')->where('id', $service)->value('name'); //Aqui esta el error
        $gerente_name = Jefedirecto::select('Nombre')->where('id', $gerente)->value('Nombre');
        $beneficiary_name= Viatic_beneficiary::select('name')->where('id', $beneficiary)->value('name');

        $folio = DB::table('viatics')->where('id',$viaticos_id[$i])->value('folio');
        $date_start = DB::table('viatics')->where('id',$viaticos_id[$i])->value('date_start');
        $date_end = DB::table('viatics')->where('id',$viaticos_id[$i])->value('date_end');
        $place_o = DB::table('viatics')->where('id',$viaticos_id[$i])->value('place_o');
        $place_d = DB::table('viatics')->where('id',$viaticos_id[$i])->value('place_d');
        $description = DB::table('viatics')->where('id',$viaticos_id[$i])->value('description');

        $result = DB::select('CALL history_viatic_user_conceptos (?)', array($viaticos_id[$i]));

        $parametros1 = [
          'servicio' => $service_name,
          'folio' => $folio,
          'gerente' => $gerente_name,
          'beneficiario' => $bene_nombre,
          'nombre_b' => $beneficiary_name,
          'fecha_inicio' => $date_start,
          'fecha_fin' => $date_end,
          'lugar_o' => $place_o,
          'lugar_d' => $place_d,
          'descripcion' => $description,
        ];

        $parametros2=[];

        for ($j=0; $j <= (count($result)-1); $j++) {
          array_push($parametros2, ['venue' => $result[$j]->Cadena,
                                    'hotel' => $result[$j]->Hotel,
                                    'concept' => $result[$j]->Concepto,
                                    'cantidad' => $result[$j]->cantidad,
                                    'costo' => $result[$j]->amount,
                                    'total' => $result[$j]->total]);
       }

       Mail::to($user_email)->send(new ConfirmacionV($parametros1, $parametros2));

       return $valor;

      }



    }

    public function insert_data_1(Request $request)
    {
      $result = 0;
      $id_viatic = $request->ident;
      $status = $request->status;
      $count_id = count($id_viatic);

      for ($i=0; $i < $count_id; $i++) {
        $cant = $request->{"c_cant_" . $i};
        $amount = $request->{"m_ind_" . $i};
        $total = $request->{"subt_" . $i};

        if ($cant == '' || $amount == '' || $total == '') {
          $result = 0;
        }else{
          $sql = DB::table('concepts')->where('id', $id_viatic[$i])->update([
            'cantidad' => $request->{"c_cant_" . $i},
            'amount' => $request->{"m_ind_" . $i},
            'total' => $request->{"subt_" . $i},
            'state_concept_id' => $status[$i],
          ]);
          $result = 1;
        }

      }

      return (string)$result;
    }



}
