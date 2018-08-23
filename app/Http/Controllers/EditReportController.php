<?php

namespace App\Http\Controllers;
use App\Hotel;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use File;
use Storage;
class EditReportController extends Controller
{
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      return view('permitted.report.edit_reports',compact('hotels'));
    }
    else {
      $hotels = auth()->user()->hotels;
      return view('permitted.report.edit_reports',compact('hotels'));
    }
  }
  public function search_zd(Request $request)
  {
    $hotel = $request->numero;
    $result = DB::select('CALL get_zd_venue (?)', array($hotel));
    return json_encode($result);
  }
  public function search_gb(Request $request)
  {
    $hotel = $request->htl;
    $date = $request->dt;
    $ip = $request->zd;

    $result = DB::select('CALL get_gb_venue_edit (?,?,?)', array($hotel, $date, $ip));
    return json_encode($result);
  }
  public function update_gb(Request $request)
  {
    $hotel = $request->htl;
    $date = $request->dt;
    $ip = $request->zd;
    $giga = $request->gb;
    // $bytes = ((($giga * 1024) * 1024) * 1024);
    $bytes = $giga * 1000000000;

    $res = DB::table('gbxdias')
           ->where('Fecha', '=', $date)
           ->where('hotels_id', '=', $hotel)
           ->where('ZD', '=', $ip)
           ->update(
            [
              'CantidadBytes' => $bytes,
              'ConsumoReal' => $bytes,
              'updated_at' => \Carbon\Carbon::now()
            ]);
    return $res;
  }
  public function search_user(Request $request)
  {
    $hotel = $request->htl;
    $date = $request->dt;

    $result = DB::select('CALL get_user_venue (?,?)', array($hotel, $date));
    return json_encode($result);
  }

  public function search_comment(Request $request)
  {
    $hotel = $request->htl;
    $date = $request->dt;
    $date_format = $date.'-01';
    $month = date("n", strtotime($date_format));

    $result = DB::table('report_comment_months')
                        ->where('hotels_id',$hotel)
                        ->whereMonth('fecha', $month)->get();

    return json_encode($result);
  }

  public function update_user(Request $request){
    $hotel = $request->htl;
    $date = $request->dt;
    $user = $request->user;

    $sql = DB::table('usuariosxdias')
    ->select('id')
    ->where('Fecha', $date)
    ->where('hotels_id', $hotel)
    ->get();
    $flag = '0';
    $total_id = count($sql);
    $nueva_cant = ($user / $total_id);
    for ($i=0; $i <= ($total_id-1) ; $i++) {
      $id = $sql[$i]->id;
      $res = DB::table('usuariosxdias')
          ->where('id', '=', $id)
          ->where('Fecha', '=', $date)
          ->where('hotels_id', '=', $hotel)
          ->update(
          [
            'NumClientes' => $nueva_cant,
            'updated_at' => \Carbon\Carbon::now()
          ]);
      $flag = '1';
    }
    return $flag;
  }

  public function update_comment(Request $request)
  {
    $hotel = $request->htl;
    $date = $request->dt;
    $new_comment = $request->com;

    $sql = DB::table('report_comment_months')
    ->select('id')
    ->where('fecha','=' ,$date)
    ->where('hotels_id', '=' ,$hotel)
    ->get();
    $id_report_com = $sql[0]->id;
    $flag = '0';

     $res = DB::table('report_comment_months')
          ->where('id', $id_report_com)
          ->update(
          [
            'comentario' => $new_comment,
            'updated_at' => \Carbon\Carbon::now()
          ]);
      $flag = '1';
    return $flag;
  }

  public function reupload_client(Request $request)
  {
    $flag = 0;
    $hotel = $request->select_one_type;
    $months = $request->date_type_device;
    $date = $months.'-01';
    $photo = $request->file('phone_client');

    $find = DB::table('report_hotel_bandas')->where([
          ['hotels_id', '=' , $hotel],
          ['type', '=' , '0'],
          ['Fecha', '=' , $date]
        ])->count();

    if ($find != '0') {
      $val_exist = DB::table('report_hotel_bandas')->select('img')
      ->where('hotels_id', '=', $hotel)
      ->where('type', '=', '0')
      ->where('Fecha', '=', $date)
      ->value('img');
      $file = public_path('images/storage/' . $val_exist);

      if (File::exists($file)) {
        File::delete($file);
        $almacenar_store = $photo[0]->store('device');
        $sql = DB::table('report_hotel_bandas')
        ->where('hotels_id', '=', $hotel)
        ->where('type', '=', '0')
        ->where('Fecha','=',  $date)
        ->update(['img' => $almacenar_store]);
        $flag =1;
      }
    }
    return $flag;
  }

  public function reupload_banda(Request $request)
  {
    $flag = 0;
    $hotel = $request->select_one_band;
    $months = $request->date_type_banda;
    $date = $months.'-01';
    $photo = $request->file('phone_band');

    $find = DB::table('report_hotel_bandas')->where([
          ['hotels_id', '=' , $hotel],
          ['type', '=' , '1'],
          ['Fecha', '=' , $date]
        ])->count();
    if ($find != '0') {
      $val_exist = DB::table('report_hotel_bandas')->select('img')
      ->where('hotels_id', '=', $hotel)
      ->where('type', '=', '1')
      ->where('Fecha', '=', $date)
      ->value('img');
      $file = public_path('images/storage/' . $val_exist);
      if (File::exists($file)) {
        File::delete($file);
        $almacenar_store = $photo[0]->store('band');
        $sql = DB::table('report_hotel_bandas')
        ->where('hotels_id', '=', $hotel)
        ->where('type', '=', '1')
        ->where('Fecha','=',  $date)
        ->update(['img' => $almacenar_store]);
        $flag =1;
      }

    }
    return $flag;
  }
}
