<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Crypt;

use DateTime;
use Carbon\Carbon;

use DB;

use Auth;

use Mail;

use App\Cadena;

use App\Hotel;

use App\Reference;

use App\Encuesta_user;
use App\Encuesta;
use App\Pregunta;
use App\Qualification_result;
use App\Comment;
class SurveyController extends Controller
{
  public function Name()
  {
    $encrypted1 = Crypt::encryptString('2018-01-01');
    return $encrypted1;
  }
  public function index($data, $status)
  {
    $encriptado_data = $data;
    $encriptado_status = $status;
    $enc_verificar = Encuesta_user::where('shell_data', '=', $encriptado_data)
    ->where('shell_status', '=', $encriptado_status)
    ->where('estatus_id', '=', 1)
    ->where('estatus_res', '=', 0)
    ->count();
    if ($enc_verificar == '1') {
      $encrypted1 = Crypt::decryptString($encriptado_data); // user, id_encuesta, mes a evaluar, fecha_fin
      $encrypted2 = Crypt::decryptString($encriptado_status);//estatus id
      $array_hotel = explode("/", $encrypted1);

      //dd($array_hotel);
      $id_user = $array_hotel[0];
      $id_survey = $array_hotel[1];
      $fecha_evaluar = $array_hotel[2];
      $fecha_fin = $array_hotel[3];

      $sacar_preg = Encuesta::find($id_survey)->preguntas()->where('encuesta_id', $id_survey)->get();
      $count_preg = $sacar_preg->count();
      $ident_preg = '';

      //ID DE Preguntas
      for ($k=0; $k <$count_preg; $k++) { $ident_preg = $ident_preg.$sacar_preg[$k]->id.'&'; }

      //ID De Registro de Encuesta
      $enc_data_s = Encuesta_user::select('id')->where('shell_data', '=', $encriptado_data)
      ->where('shell_status', '=', $encriptado_status)
      ->where('estatus_id', '=', 1)
      ->where('estatus_res', '=', 0)
      ->value('id');

      $id_reg_encuesta= $enc_data_s;
      $id_preguntas = trim($ident_preg, '&');
      $unir_form= $id_user.'/'.$id_reg_encuesta.'/'.$count_preg.'/'.$id_preguntas.'/'.$fecha_evaluar.'/'.$fecha_fin.'/'.$id_survey;
      $encrypted_form = Crypt::encryptString($unir_form);

      return view('permitted.qualification.view_survey',compact('fecha_fin', 'encrypted_form', 'sacar_preg'));
    }
    else {

      $enc_reevaluar = Encuesta_user::where('shell_data', '=', $encriptado_data)
      ->where('shell_status', '!=', $encriptado_status)
      ->where('estatus_id', '=', 2)
      ->where('estatus_res', '=', 1)
      ->count();

      if ($enc_reevaluar == '1') {
        $enc_data_s = Encuesta_user::select('fecha_fin')->where('shell_data', '=', $encriptado_data)
        ->where('shell_status', '!=', $encriptado_status)
        ->where('estatus_id', '=', 2)
        ->where('estatus_res', '=', 1)
        ->value('fecha_fin');

        $fecha_cancun = Carbon::now('America/Cancun')->format('Y-m-d');

        $date_register = strtotime($enc_data_s);
        $date_current = strtotime($fecha_cancun);
        if ($date_current >= $date_register) {
          $title = 'Finalizado';
          $message = 'Se completo la encuesta o finalizo el tiempo de valides de su enlace.! Nota: Se redireccionara a la pagina principal';
          return view('permitted.qualification.view_survey_rest', compact('title','message'));
        }
        else {
          $title = 'Registro completado';
          $message = 'Le encuesta se completo con exito. El enlace estara valido hasta '.$enc_data_s.'.! Nota: Se redireccionara a la pagina principal';
          return view('permitted.qualification.view_survey_rest', compact('title','message'));
        }
      }
      else {
        $title = 'Error encontrado';
        $message = 'La URL es incorrecta.!! Nota: Se redireccionara a la pagina principal';
        return view('permitted.qualification.view_survey_rest', compact('title','message'));
      }
    }
  }
  public function create(Request $request){
    $data_cifrada = $request->token_form;
    $data_comment= $request->message;

    $encrypted3 = Crypt::decryptString($data_cifrada);
    $array_data = explode("/", $encrypted3);
    //echo $encrypted3.'<br>';

              $id_usuario = $array_data[0];
    $id_registro_encuesta = $array_data[1];
      $cantidad_preguntas = $array_data[2];
            $id_preguntas = $array_data[3]; //Ejemplo : 1&2 separadas &
           $fecha_evaluar = $array_data[4];
               $fecha_fin = $array_data[5];
               $id_survey = $array_data[6];

        if($id_survey == '1'){
          //Encuesta NPS---------------------------------------------------------------------------------------------------------------------
          $sql_hotel = DB::table('hotel_user')->select('hotel_id')->where('user_id', '=', $id_usuario)->pluck('hotel_id');
          $result_hotel = $sql_hotel->toArray();

          $separar_ids = strpos($id_preguntas, '&');
          $array_id_preguntas = array();

          if ($separar_ids === false) { array_push($array_id_preguntas, $id_preguntas); }
          else { $array_id_preguntas= explode("&", $id_preguntas); }

          for ($i=0; $i < count($result_hotel); $i++) {
            echo 'Hotel='.$result_hotel[$i].'<br>';
            for ($j=0; $j < $cantidad_preguntas; $j++) {
              echo 'pregunta='.$array_id_preguntas[$j].'<br>';
              $input= $request->get('radio'.($j+1));
              echo 'respuesta='.$input.'<br>';

              $new_qualification = new Qualification_result;
              $new_qualification->fecha=$fecha_evaluar;
              $new_qualification->respuesta=$input;
              $new_qualification->preguntas_id=$array_id_preguntas[$j];
              $new_qualification->hotels_id=$result_hotel[$i];
              $new_qualification->user_id=$id_usuario;
              $new_qualification->save();
            }
            if (!empty($data_comment)) {
              $new_comment = new Comment;
              $new_comment->fecha=$fecha_evaluar;
              $new_comment->respuesta=$data_comment;
              $new_comment->hotels_id=$result_hotel[$i];
              $new_comment->users_id=$id_usuario;
              $new_comment->encuesta_id='1';
              $new_comment->save();
            }
          }
          //ACTUALIZAMOS ESTATUS
          $update_status = Encuesta_user::find($id_registro_encuesta);
          $update_status->estatus_id = '2';
          $update_status->estatus_res = '1';
          $update_status->shell_status = Crypt::encryptString('2');;
          $update_status->save();
          return back();
          //Encuesta NPS---------------------------------------------------------------------------------------------------------------------
        }
        else {
          //Encuesta distinta---------------------------------------------------------------------------------------------------------------------
          $separar_ids = strpos($id_preguntas, '&');
          $array_id_preguntas = array();

          if ($separar_ids === false) { array_push($array_id_preguntas, $id_preguntas); }
          else { $array_id_preguntas= explode("&", $id_preguntas); }

          for ($j=0; $j < $cantidad_preguntas; $j++) {
            echo 'pregunta='.$array_id_preguntas[$j].'<br>';
            $input= $request->get('radio'.($j+1));
            echo 'respuesta='.$input.'<br>';

            $new_qualification = new Qualification_result;
            $new_qualification->fecha=$fecha_evaluar;
            $new_qualification->respuesta=$input;
            $new_qualification->preguntas_id=$array_id_preguntas[$j];
            $new_qualification->user_id=$id_usuario;
            $new_qualification->save();
          }
          if (!empty($data_comment)) {
            $new_comment = new Comment;
            $new_comment->fecha=$fecha_evaluar;
            $new_comment->respuesta=$data_comment;
            $new_comment->users_id=$id_usuario;
            $new_comment->save();
          }
          //ACTUALIZAMOS ESTATUS
          $update_status = Encuesta_user::find($id_registro_encuesta);
          $update_status->estatus_id = '2';
          $update_status->estatus_res = '1';
          $update_status->shell_status = Crypt::encryptString('2');;
          $update_status->save();
          return back();
          //Encuesta distinta---------------------------------------------------------------------------------------------------------------------


        }


  }











  public function create2(Request $request){
    $data_cifrada = $request->token_form;
    $data_comment= $request->message;

    $encrypted3 = Crypt::decryptString($data_cifrada);
    $array_data = explode("/", $encrypted3);
    $send_user = $array_data[0];
    $reg_email = $array_data[1];
    $count_p = $array_data[2];
    $id_preguntas = $array_data[3];
    $mes_enc = $array_data[4];
    $hoteles = $array_data[5];

    //$reg_email;

    $pos = strpos($hoteles, '&');
    if ($pos === false) {
      //Unico de hotel
    }
    else{
      $array_hoteles = explode("&", $hoteles);
      $array_id_preguntas= explode("&", $id_preguntas);

      echo count($array_hoteles).'<br>';
      for ($i=0; $i < count($array_hoteles) ; $i++) {
        $hotel=$array_hoteles[$i];
        echo 'ID_HOTEL='.$array_hoteles[$i].'<br>';
        for ($j=1; $j <=$count_p; $j++) {
            echo 'id_pregunta='.$array_id_preguntas[$j-1].'<br>';
            $pregunta=$array_id_preguntas[$j-1];
            $input= $request->get('radio'.$j);
            echo $input.'<br>';

            $new_qualification = new Qualification_result;
            $new_qualification->fecha=$mes_enc;
            $new_qualification->respuesta=$input;
            $new_qualification->preguntas_id=$pregunta;
            $new_qualification->hotels_id=$hotel;
            $new_qualification->save();
        }

        //Registrar comments
        if (!empty($data_comment)) {
          echo $data_comment.'<br>';
          $new_comment = new Comment;
          $new_comment->fecha=$mes_enc;
          $new_comment->respuesta=$data_comment;
          $new_comment->hotels_id=$hotel;
          $new_comment->users_id=$send_user;
          $new_comment->save();
        }
      }
      //ACTUALIZAMOS ESTATUS
      $update_status = Encuesta_user::find($reg_email);
      $update_status->estatus_id = '2';
      $update_status->shell_estatus_id = Crypt::encryptString('2');;
      $update_status->save();
      return back();
    }
    //dd($array_data);
  }
}
