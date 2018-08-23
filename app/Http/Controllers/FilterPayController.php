<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cadena;
use App\Hotel;
use App\Proveedor;
use App\Reference;
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
use DB;

class FilterPayController extends Controller
{
  public function index()
  {
      // $cadena = Hotel::select('id', 'Nombre_hotel')->get()->sortBy('Nombre_hotel');
      $cadena = DB::table('listarhoteles_noasignar')->select('id', 'hotel')->get();
      $folio = Payments::select('id','folio')->get()->sortBy('folio');
      $proveedor = Proveedor::select('id', 'nombre')->get();
      $vertical = Payments_verticals::pluck('name', 'id');
      $currency = Currency::select('id','name')->get();
      $way = Payments_way_pay::select('id','name')->get();
      $area = Payments_area::pluck('name', 'id');
      $application = Payments_application::pluck('name', 'id');
      $options = Payments_project_options::pluck('name', 'id');
      $classification =Payments_classification::select('id','name')->get();
      $financing = Payments_financing::pluck('name', 'id');
      return view('permitted.payments.filter_proy_pay',compact('cadena','folio', 'proveedor','vertical', 'currency', 'way', 'area', 'application', 'options', 'classification', 'financing'));
  }

  public function get_proyecto(Request $request)
  {
    $id = $request->data_one;
    $proyecto = DB::select('CALL get_proyecto_hotel(?)', array($id));
    return json_encode($proyecto);
  }

  public function get_folios(Request $request)
  {
    $id = $request->id;
    $res =  DB::select('CALL payments_hotel_folio(?)', array($id));
    return json_encode($res);
  }

  public function autocomplete_folio(Request $request)
  {
      $term =$request->data_one;

      $results = array();
      $folioData = DB::select('CALL payments_filter_folio(?)', array($term));
      $queries = DB::table('payments')
        ->select('id','folio')
        ->where('folio', 'LIKE', '%'.$term.'%')
        ->take(5)->get();

      foreach ($queries as $query)
      {
          $results[] = [ 'id' => $query->id, 'folio' => $query->folio];
      }
      return json_encode(compact('results','folioData'));
  }

  public function get_payment_by_folio(Request $request)
  {
    $id = $request->data_one;
    $payment = DB::select('CALL payments_filter_id(?)', array($id));
    return json_encode($payment);
  }

  public function get_paymentId(Request $request)
  {
    $id = $request->data_one;
    $payment = DB::select('CALL payments_filter_id(?)', array($id));

    return json_encode($payment);

  }


}
