<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Hotel;
use DB;
use Auth;
use Carbon\Carbon;
use App\Estado;
use Mail;
use App\Mail\MovimientosMail;

class MoveEquipmentController extends Controller
{
  /**
   * Show the application move equipment
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      $estados = Estado::select('id', 'Nombre_estado')->get();
      return view('permitted.equipment.move_equipment',compact('hotels', 'estados'));
  }

  public function sentMovements($email, $data, $data2)
  {
      //$email_test = ['aperez@sitwifi.com', 'marthaisabel@sitwifi.com'];
      Mail::to($email)->cc(['aperez@sitwifi.com', 'marthaisabel@sitwifi.com'])->send(new MovimientosMail($data, $data2));
  }

  public function getHotelName($id)
  {

    $valor = DB::select('CALL get_venue_id_device(?)', array($id));
    //$valor = DB::table('hotels')->select('Nombre_hotel')->where('id', $id)->value('Nombre_hotel');
    return $valor;
  }

  public function edit(Request $request)
  {
    $valor = 'false';
    $equipos = json_decode($request->idents);
    $origen_n = $request->origen;
    $destino_n = $request->destino;

    //$origen_ms = $this->getHotelName($equipos[0]);  
    $origen_t = $request->origen_t;

    $destino_t = $request->destino_t;
    $estatus_n = $request->estatus;
    $estatus_t = $request->estatus_t;

    $data_origin = [];
    $email_o = [];
    $email_d = [];

    $user_o = [];
    $user_d = [];


    if (empty($origen_n)) {
      //$origen_ms = $this->getHotelName($equipos[0]);
        $datos_o = $this->getHotelName($equipos[0]);

        $email_r = DB::select('CALL get_email_movimientos(?)', array($datos_o[0]->id));
        $email_r2 = DB::select('CALL get_email_movimientos(?)', array($destino_n));

        for ($j=0; $j < (count($email_r)); $j++) {
          array_push($user_o, $email_r[$j]->name);
          array_push($email_o, $email_r[$j]->email);
        }
        for ($k=0; $k < (count($email_r2)); $k++) {
          array_push($user_d, $email_r2[$k]->name);
          array_push($email_d, $email_r2[$k]->email);
        }
        if ($datos_o[0]->id === $destino_n) {
          for ($i=0; $i <= (count($equipos)-1); $i++) { 
            if ($estatus_n == '999') {
              $res = DB::select('CALL get_detail_register_inventory(?)', array($equipos[$i]));
              array_push($data_origin, ['cliente_o' => $datos_o[0]->Nombre_hotel, 'cliente_d' => $destino_t, 'equipo' => $res[0]->name,'marca' => $res[0]->Nombre_marca, 'mac' => $res[0]->MAC, 'serie' => $res[0]->Serie, 'modelo' => $res[0]->ModeloNombre,'estado_o' => $res[0]->Nombre_estado, 'estado_d' => $estatus_t]);
                $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'updated_at' => Carbon::now()]);
            }
            else {
              $res = DB::select('CALL get_detail_register_inventory(?)', array($equipos[$i]));
              array_push($data_origin, ['cliente_o' => $datos_o[0]->Nombre_hotel, 'cliente_d' => $destino_t, 'equipo' => $res[0]->name,'marca' => $res[0]->Nombre_marca, 'mac' => $res[0]->MAC, 'serie' => $res[0]->Serie, 'modelo' => $res[0]->ModeloNombre,'estado_o' => $res[0]->Nombre_estado, 'estado_d' => $estatus_t]);
                $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'estados_id' => $estatus_n, 'updated_at' => Carbon::now()]);
            }
            $valor= 'true';
          }
          //envio de correo.
          $this->sentMovements($email_d, $data_origin, $user_d);
        }else{
          for ($i=0; $i <= (count($equipos)-1); $i++) { 
            if ($estatus_n == '999') {
              $res = DB::select('CALL get_detail_register_inventory(?)', array($equipos[$i]));
              array_push($data_origin, ['cliente_o' => $datos_o[0]->Nombre_hotel, 'cliente_d' => $destino_t, 'equipo' => $res[0]->name,'marca' => $res[0]->Nombre_marca, 'mac' => $res[0]->MAC, 'serie' => $res[0]->Serie, 'modelo' => $res[0]->ModeloNombre,'estado_o' => $res[0]->Nombre_estado, 'estado_d' => $estatus_t]);
                $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'updated_at' => Carbon::now()]);
            }
            else {
              $res = DB::select('CALL get_detail_register_inventory(?)', array($equipos[$i]));
              array_push($data_origin, ['cliente_o' => $datos_o[0]->Nombre_hotel, 'cliente_d' => $destino_t, 'equipo' => $res[0]->name,'marca' => $res[0]->Nombre_marca, 'mac' => $res[0]->MAC, 'serie' => $res[0]->Serie, 'modelo' => $res[0]->ModeloNombre,'estado_o' => $res[0]->Nombre_estado, 'estado_d' => $estatus_t]);

                $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'estados_id' => $estatus_n, 'updated_at' => Carbon::now()]);
            }
            $valor= 'true';
          }
          $this->sentMovements($email_o, $data_origin, $user_o);
          $this->sentMovements($email_d, $data_origin, $user_d);
        }
    }else{
      $email_r = DB::select('CALL get_email_movimientos(?)', array($origen_n));
      $email_r2 = DB::select('CALL get_email_movimientos(?)', array($destino_n));

      for ($j=0; $j < (count($email_r)); $j++) {
        array_push($user_o, $email_r[$j]->name);
        array_push($email_o, $email_r[$j]->email);
      }
      for ($k=0; $k < (count($email_r2)); $k++) {
        array_push($user_d, $email_r2[$k]->name);
        array_push($email_d, $email_r2[$k]->email);
      }
      if ($origen_n === $destino_n) {      
        for ($i=0; $i <= (count($equipos)-1); $i++) { 
          if ($estatus_n == '999') {
            $res = DB::select('CALL get_detail_register_inventory(?)', array($equipos[$i]));
            array_push($data_origin, ['cliente_o' => $origen_t, 'cliente_d' => $destino_t, 'equipo' => $res[0]->name,'marca' => $res[0]->Nombre_marca, 'mac' => $res[0]->MAC, 'serie' => $res[0]->Serie, 'modelo' => $res[0]->ModeloNombre,'estado_o' => $res[0]->Nombre_estado, 'estado_d' => $estatus_t]);
              $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'updated_at' => Carbon::now()]);
          }
          else {
            $res = DB::select('CALL get_detail_register_inventory(?)', array($equipos[$i]));
            array_push($data_origin, ['cliente_o' => $origen_t, 'cliente_d' => $destino_t, 'equipo' => $res[0]->name,'marca' => $res[0]->Nombre_marca, 'mac' => $res[0]->MAC, 'serie' => $res[0]->Serie, 'modelo' => $res[0]->ModeloNombre,'estado_o' => $res[0]->Nombre_estado, 'estado_d' => $estatus_t]);
              $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'estados_id' => $estatus_n, 'updated_at' => Carbon::now()]);
          }
          $valor= 'true';
        }
        //envio de correo.
        $this->sentMovements($email_d, $data_origin, $user_d);
      }else{
        for ($i=0; $i <= (count($equipos)-1); $i++) { 
          if ($estatus_n == '999') {
            $res = DB::select('CALL get_detail_register_inventory(?)', array($equipos[$i]));
            array_push($data_origin, ['cliente_o' => $origen_t, 'cliente_d' => $destino_t, 'equipo' => $res[0]->name,'marca' => $res[0]->Nombre_marca, 'mac' => $res[0]->MAC, 'serie' => $res[0]->Serie, 'modelo' => $res[0]->ModeloNombre,'estado_o' => $res[0]->Nombre_estado, 'estado_d' => $estatus_t]);
              $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'updated_at' => Carbon::now()]);
          }
          else {
            $res = DB::select('CALL get_detail_register_inventory(?)', array($equipos[$i]));
            array_push($data_origin, ['cliente_o' => $origen_t, 'cliente_d' => $destino_t, 'equipo' => $res[0]->name,'marca' => $res[0]->Nombre_marca, 'mac' => $res[0]->MAC, 'serie' => $res[0]->Serie, 'modelo' => $res[0]->ModeloNombre,'estado_o' => $res[0]->Nombre_estado, 'estado_d' => $estatus_t]);

              $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'estados_id' => $estatus_n, 'updated_at' => Carbon::now()]);
          }
          $valor= 'true';
        }
        //envio de correos
        $this->sentMovements($email_o, $data_origin, $user_o);
        $this->sentMovements($email_d, $data_origin, $user_d);
      }
    }
    return $valor;
  }

  public function edit2(Request $request)
  {
    $equipos = json_decode($request->idents);
    $origen_n = $request->origen;
    $destino_n = $request->destino;
    $estatus_n = $request->estatus;

    $valor= 'false';
    for ($i=0; $i <= (count($equipos)-1); $i++) {
      if ($estatus_n == '999') {
        $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'updated_at' => Carbon::now()]);
      }
      else {
        $sql = DB::table('equipos')->where('id', '=', $equipos[$i])->update(['hotel_id' => $destino_n, 'estados_id' => $estatus_n, 'updated_at' => Carbon::now()]);
      }
      $valor= 'true';
    }
    return $valor;
  }
  public function descrip(Request $request)
  {
    $estatus_n = $request->sector;
    $result = DB::select('CALL get_descripcion (?)', array($estatus_n));

    $n_id=  Crypt::encryptString($result[0]->id);
    $array = [
        "id" => $n_id,
        "description" => $result[0]->Descripcion,
    ];
    return json_encode($array);
  }

  public function update(Request $request)
  {
    $id_equipo = Crypt::decryptString($request->tokensito);
    $description = $request->descript;
    $valor= 'false';

    if (strlen ($description) <= '150') {
      $sql = DB::table('equipos')->where('id', '=', $id_equipo)->update(['Descripcion' => $description, 'updated_at' => Carbon::now()]);
      $valor= 'true';
    }
    else {
      $valor= 'false';
    }
    return $valor;
  }
}
