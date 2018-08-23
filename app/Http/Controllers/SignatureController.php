<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use File;

class SignatureController extends Controller
{
    public function index()
    {
    	$jefes = DB::table('jefedirectos')->select('id','Nombre')->get();
    	return view('permitted.viaticos.signatures', compact('jefes'));
    }

    public function upload_signature(Request $request)
    {
		$flag = 0;
		$jefe_id = $request->select_one_type;
		$photo = $request->file('signature_boss');

		$find = DB::table('jefedirectos')->select('signature')
			->where('id', '=' , $jefe_id)
			->get();
		$sign = $find[0]->signature;

		if (!empty($sign)) {
			//Ya existe una url de firma.
			$val_exist = DB::table('jefedirectos')->select('signature')
			->where('id', $jefe_id)
			->value('signature');
			$file = public_path('images/storage/' . $val_exist);
			if (File::exists($file)) {
				File::delete($file);
				$almacenar_store = $photo[0]->store('signature');

				$sql = DB::table('jefedirectos')
				->where('id', '=', $jefe_id)
				->update(['signature' => $almacenar_store]);

				$flag = 1;
			}
		}else{
			//NO existe, insertar.
			$almacenar_store = $photo[0]->store('signature');
			$result = DB::table('jefedirectos')->where('id', $jefe_id)->update([
				'signature' => $almacenar_store,
			]);
			if ($result != 0) {
				$flag = 1;
			}
		}
    	return $flag;
    }

	public function reupload_client(Request $request)
	{
		$flag = 0;
		$hotel = $request->select_one_type;
		$months = $request->date_type_device;
		$date = $months.'-01';
		$photo = $request->file('signature_boss');

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
}
