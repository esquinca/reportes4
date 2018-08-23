<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;
use App\User;
use DateTime;
use DB;
use Auth;
use Mail;
use App\Mail\Sentsurveysitwifimail;
use App\Hotel;
use App\Encuesta;
use App\Encuesta_user;
use App\Pregunta;
use App\Qualification_result;
use App\Vertical;

use Illuminate\Support\Facades\Redirect;

class ViewDashSitController extends Controller
{
  public function index()
  {
    $surveys = Encuesta::select('id', 'name')->get();
    return view('permitted.qualification.dashboard_sit',compact( 'surveys'));
  }
  public function show_q(Request $request)
  {
    $input_survey= $request->get('select_surveys');
    $sacar_preg = Encuesta::find($input_survey)->preguntas()->where('encuesta_id', $input_survey)->get();
    return $sacar_preg;
  }
  public function show_result_q(Request $request)
  {
    $input_date_0= $request->get('date');
    $input_q= $request->get('question');
    $input_date_1 = $input_date_0.'-01';
    $result = DB::select('CALL Survey_Question (?, ?)', array($input_date_1, $input_q));
    return json_encode($result);
  }
  public function show_user(Request $request)
  {
    $input_domain= $request->get('domain');
    // $result = User::select('id', 'name')->get();
    $result = DB::select('CALL get_domain_user (?)', array($input_domain));
    return json_encode($result);
  }
  public function survey_record(Request $request)
  {
    $input_domain = $request->get('select_ind_one');
    $input_emails = $request->get('select_ind_two');
    $input_survey = $request->get('select_idsurvey');
    $input_date_1 = $request->get('date_start');
    $input_date_2 = $request->get('date_end');
    $input_date_e = $request->get('month_evaluate');
    $operacion='0';

    if ($input_emails == "" || $input_survey == "" || $input_date_1 == "" || $input_date_2 == "" || $input_date_e == "") {
      $operacion = '4';
    }else{
      for ($i=0; $i < count($input_emails); $i++) {
        $month=$input_date_e.'-01';
        $pregunto_a = DB::table('encuesta_users')
                              ->where('user_id', $input_emails[$i])
                              ->where('encuesta_id', $input_survey) // id encuesta
                              ->where('estatus_id', '1') //Activa
                              ->where('estatus_res', '0') //NO CONTESTADA
                              ->where('fecha_corresponde', $month)
                              ->count();

        if ($pregunto_a == '0') {
          //Pregunto b- Puede existir pero estar deshabilitada
          $pregunto_b = DB::table('encuesta_users')
                                ->where('user_id', $input_emails[$i])
                                ->where('encuesta_id', $input_survey) // id encuesta
                                ->where('estatus_id', '2') //deshabilitada
                                ->where('estatus_res', '1') //CONTESTADA
                                ->where('fecha_corresponde', $month)
                                ->count();
          if ($pregunto_b == '0') {
            #ENTONCES VOLVEMOS A PREGUNTAR
            $pregunto_c = DB::table('encuesta_users')
                                  ->where('user_id', $input_emails[$i])
                                  ->where('encuesta_id', $input_survey) // id encuesta
                                  ->where('estatus_id', '2') //deshabilitada
                                  ->where('estatus_res', '0') //NO CONTESTADA
                                  ->where('fecha_corresponde', $month)
                                  ->count();
            if ($pregunto_c == '1') {
              #ESTA DESHABILITADA PERO NO SE CONTESTO EN ESE PERIODO REGISTRO DE NUEVO
              $nuevolink = $input_emails[$i].'/'.$input_survey.'/'.$month.'/'.$input_date_2;
              $encriptodata= Crypt::encryptString($nuevolink);
              $encriptostatus= Crypt::encryptString('1');

              $new_survey_individual = new Encuesta_user;
              $new_survey_individual->user_id=$input_emails[$i];
              $new_survey_individual->encuesta_id=$input_survey;
              $new_survey_individual->estatus_id='1';
              $new_survey_individual->estatus_res='0';
              $new_survey_individual->fecha_inicial=$input_date_1;
              $new_survey_individual->fecha_corresponde=$month;
              $new_survey_individual->fecha_fin=$input_date_2;
              $new_survey_individual->shell_data=$encriptodata;
              $new_survey_individual->shell_status=$encriptostatus;
              $new_survey_individual->save();

              $sql = DB::table('users')->select('email', 'name')->where('id', $input_emails[$i])->get();

              $datos = [
                 'nombre' => $sql[0]->name,
                 'shell_data' => $encriptodata,
                 'shell_status' => $encriptostatus
              ];
              $this->sentSurveyEmail($sql[0]->email, $datos);
              $operacion='1';
            }
            else{
              #De plano no existe
              $nuevolink = $input_emails[$i].'/'.$input_survey.'/'.$month.'/'.$input_date_2;
              $encriptodata= Crypt::encryptString($nuevolink);
              $encriptostatus= Crypt::encryptString('1');

              $new_survey_individual = new Encuesta_user;
              $new_survey_individual->user_id=$input_emails[$i];
              $new_survey_individual->encuesta_id=$input_survey;
              $new_survey_individual->estatus_id='1';
              $new_survey_individual->estatus_res='0';
              $new_survey_individual->fecha_inicial=$input_date_1;
              $new_survey_individual->fecha_corresponde=$month;
              $new_survey_individual->fecha_fin=$input_date_2;
              $new_survey_individual->shell_data=$encriptodata;
              $new_survey_individual->shell_status=$encriptostatus;
              $new_survey_individual->save();

              $sql = DB::table('users')->select('email', 'name')->where('id', $input_emails[$i])->get();

              $datos = [
                 'nombre' => $sql[0]->name,
                 'shell_data' => $encriptodata,
                 'shell_status' => $encriptostatus
              ];
              $this->sentSurveyEmail($sql[0]->email, $datos);
              $operacion='1';
            }
          }
          else {
            #OPERACION ABORTADA POR QUE SE CONTESTO ESTE MES
            $operacion='3';
          }
        }
        else {
          //Existe enlace -> Reenvio el link
          $sql = DB::table('users')->select('email', 'name')->where('id', $input_emails[$i])->get();
          $data_pregunta = DB::table('encuesta_users')
                                ->where('user_id', $input_emails[$i])
                                ->where('encuesta_id', $input_survey) // id encuesta
                                ->where('estatus_id', '1') //Activa
                                ->where('estatus_res', '0') //NO CONTESTADA
                                ->where('fecha_corresponde', $month)
                                ->get();
          $datos = [
             'nombre' => $sql[0]->name,
             'shell_data' => $data_pregunta[0]->shell_data,
             'shell_status' => $data_pregunta[0]->shell_status
          ];
          $this->sentSurveyEmail($sql[0]->email, $datos);
          $operacion='2';
        }
      }// end for
    }//end else

    if ($operacion == '4') {
      notificationMsg('danger', 'Favor de llenar todos los campos!');
      return Redirect::back();
    }
    if ($operacion == '3') {
        notificationMsg('danger', 'Mes, ya evaluado!');
        return Redirect::back();
    }
    if ($operacion == '2') {
        notificationMsg('success', 'Se reenvio el enlace activo!');
        return Redirect::back();
    }
    if ($operacion == '1') {
        notificationMsg('success', 'Operation complete!');
        return Redirect::back();
    }
    if ($operacion == '0') {
        notificationMsg('danger', 'Operation Abort!');
        return Redirect::back();
    }

  }

  public function user_surveys_sitwifi(Request $request)
  {
    $input_domain = $request->domain;
    $input_survey = $request->enc;
    $result = DB::select('CALL encuesta_user_dominio (?, ?)', array($input_domain, $input_survey));
    return json_encode($result);

    // $result = DB::table('encuesta_user_sitwifi')->get();
    // return json_encode($result);
  }

  public function table_comments(Request $request)
  {
    $id_enc = $request->select_surveys;
    $date = $request->date_to_search;
    $date_full = $date . '-01';
    //$result = DB::select('CALL comments_table(?, ?)', array('2018-04-01', '2'));
    $result = DB::select('CALL comments_table(?, ?)', array($date_full, 2));
    return json_encode($result);
  }

  public function table_comments_nps(Request $request)
  {
    $id_enc = $request->select_surveys;
    $date = $request->date_to_search;
    $date_full = $date . '-01';
    //$result = DB::select('CALL comments_table(?, ?)', array('2018-04-01', '2'));
    $result = DB::select('CALL comments_table_nps(?, ?)', array($date_full, 1));
    return json_encode($result);
  }

  public function conteoEncuestas(Request $request)
  {
    $id_enc = $request->select_surveys;
    $date = $request->date_to_search;
    $date_full = $date . '-01';
    //$result = DB::select('CALL comments_table(?, ?)', array('2018-04-01', '2'));
    $result = DB::select('CALL conteo_survey(?, ?)', array($id_enc, $date_full));
    return json_encode($result);
  }

  public function sentSurveyEmail($email, $data)
  {

      // $nombre = $data[$i]['name'];
      // $correo = $data[$i]['email'];
      // $shell1 = $data[$i]['shelldata'];
      // $shell2= $data[$i]['shellstatus'];


      Mail::to($email)->send(new Sentsurveysitwifimail($data));

  }



}
