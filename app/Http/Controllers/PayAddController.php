<?php

namespace App\Http\Controllers;
use App\Cadena;
use App\Proveedor;
use App\Vertical;
use App\Reference;
use App\Hotel;
use DB;
use Illuminate\Http\Request;

use App\Banco;
use App\Currency;
use App\Prov_bco_cta;
use App\Pay_status_user;
use App\Pay_factura;

use App\Payments_application;
use App\Payments_area;
use App\Payments_classification;
use App\Payments_comment;
use App\Payments_financing;
use App\Payments_project_options;
use App\Payments_states;
use App\Payments_verticals;
use App\Payments_way_pay;
use App\Payments_priority;
use App\Payments;
use Auth;
use Mail;
use App\Mail\SolicitudesP;
use App\Mail\CambioCuentaPago;
use File;
use Storage;
class PayAddController extends Controller
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
      $priority = Payments_priority::select('id', 'name')->get();
      $banquitos = Banco::select('id', 'nombre')->get();
      return view('permitted.payments.add_request_pay',compact('cadena','proveedor','vertical', 'currency', 'way', 'area', 'application', 'options', 'classification', 'financing', 'priority', 'banquitos'));
  }

  public function hotel_cadena(Request $request)
  {
      $id = $request->data_one;
      $hotel = DB::select('CALL get_hotel_cadena(?)', array($id));
      return json_encode($hotel);
  }

  public function get_proyecto(Request $request)
  {
    $id = $request->data_one;
    $proyecto = DB::select('CALL get_proyecto_hotel(?)', array($id));
    return json_encode($proyecto);
  }

  public function get_bank(Request $request)
  {
    $id_customer = $request->data_one;
    $id_prov = $request->data_two;
    $data_bank = DB::select('CALL get_banco_prov(?)', array($id_prov));
    return json_encode($data_bank);
  }

  public function get_proveedor(Request $request)
  {
    $id_customer = $request->data_one;
    $proveedor = DB::select('CALL get_proveedor_hotel(?)', array($id_customer));
    return json_encode($proveedor);
  }

  public function get_data_account(Request $request)
  {
    $id_proveedor = $request->data_one;
    $id_bank = $request->data_two;
    $proveedor = DB::select('CALL get_ctabco_prov(?,?)', array($id_proveedor,$id_bank));
    return json_encode($proveedor);
  }
  public function info_account(Request $request)
  {
    $id_account = $request->data_one;
    $result = DB::select('CALL get_ctabco_data(?)', array($id_account));
    return json_encode($result);
  }
  public function set_data_bank(Request $request)
  {
    $id_proveedor = $request->identificador;
    $id_bank = $request->reg_bancos;
    $id_coin = $request->reg_coins;
    $clabe = $request->reg_clabe;
    $verf_cuenta = $request->reg_cuenta; //opcional
    $verf_referencia = $request->reg_reference; //opcional
    $flag = 0;

    if (isset($cuenta)) { $cuenta = $verf_cuenta; }
    else { $cuenta = ''; }

    if (isset($verf_referencia)) { $referencia = $verf_referencia; }
    else { $referencia = ''; }

    //Pregunto si existe proveedor y banco en prov_bco_ctas
    $count_bk = Prov_bco_cta::where('prov_id', $id_proveedor)->count();
    // $count_bk = DB::select('CALL px_prov_bco_ctas_exist(?,?)', array($id_proveedor,$id_bank));

    //Datos para correo.
    $proveedor_n = DB::table('proveedors')->select('nombre')->where('id', $id_proveedor)->value('nombre');
    $banco_n = DB::table('bancos')->select('nombre')->where('id', $id_bank)->value('nombre');
    $moneda_n = DB::table('currencies')->select('name')->where('id', $id_coin)->value('name');

    $data = [
      'proveedor' => $proveedor_n,
      'banco' => $banco_n,
      'moneda' => $moneda_n,
      'cuenta' => $cuenta,
      'clabe' => $clabe,
      'referencia' => $referencia
    ];

    // if($count_bk[0]->existe == '1'){
    if($count_bk == '1') {
      $new_reg_bco_cta = new Prov_bco_cta;
      $new_reg_bco_cta->prov_id = $id_proveedor;
      $new_reg_bco_cta->banco_id = $id_bank;
      $new_reg_bco_cta->cuenta = $cuenta;
      $new_reg_bco_cta->clabe = $clabe;
      $new_reg_bco_cta->referencia = $referencia;
      $new_reg_bco_cta->currency_id = $id_coin;
      $new_reg_bco_cta->status_id ='2' ;
      $new_reg_bco_cta->save();

      Mail::to(['mortiz@sitwifi.com','elopez@sitwifi.com'])->send(new CambioCuentaPago($data));

      $flag = 1;
    }
    else {
      $new_reg_bco_cta = new Prov_bco_cta;
      $new_reg_bco_cta->prov_id = $id_proveedor;
      $new_reg_bco_cta->banco_id = $id_bank;
      $new_reg_bco_cta->cuenta = $cuenta;
      $new_reg_bco_cta->clabe = $clabe;
      $new_reg_bco_cta->referencia = $referencia;
      $new_reg_bco_cta->currency_id = $id_coin;
      $new_reg_bco_cta->status_id ='1' ;
      $new_reg_bco_cta->save();

      Mail::to(['mortiz@sitwifi.com','elopez@sitwifi.com'])->send(new CambioCuentaPago($data));

      $flag = 1;
    }
    return $flag;

  }
  public function create(Request $request)
  {
    $id_priority = $request->priority_viat;
    $id_proyecto = $request->project;
    $id_sitio = $request->customer;
    $id_proveedor = $request->provider;
    $monto = $request->amount;
    $moneda = $request->coin;
    $concepto_pago = $request->description;
    $forma_pago = $request->methodPay;
    $id_application = $request->opt_application;
    $id_instalacion = $request->installation;
    $clasification = $request->classification_pay;
    $name_proyect = $request->projectName;
    $observacion = $request->observaciones;
    $banco = $request->bank;
    $account = $request->account;

    $email_actual = Auth::user()->email;
    $email_actual = trim($email_actual);
    $proyecto_n = DB::table('cadenas')->select('name')->where('id', $id_proyecto)->value('name');
    $sitio_n = DB::table('hotels')->select('Nombre_hotel')->where('id', $id_sitio)->value('Nombre_hotel');
    $proveedor_n = DB::table('proveedors')->select('nombre')->where('id', $id_proveedor)->value('nombre');
    $moneda_n = DB::table('currencies')->select('name')->where('id', $moneda)->value('name');
    $forma_pago_n = DB::table('payments_way_pays')->select('name')->where('id', $forma_pago)->value('name');
    $application_n = DB::table('payments_applications')->select('name')->where('id', $id_application)->value('name');
    $installation_n = DB::table('payments_project_options')->select('name')->where('id', $id_instalacion)->value('name');
    $classification_n = DB::table('payments_classifications')->select('name')->where('id', $clasification)->value('name');
    $banco_n = DB::table('bancos')->select('nombre')->where('id', $banco)->value('nombre');

    //Comprobar factura
    $factura = $request->factura;
    $exist_fact = DB::select('CALL px_payments_fact_exist(?)', array($factura));
    if($exist_fact[0]->resp == '1'){
      $folioxdX= 'La factura '.$factura.', ya se encuentra registrada';
      return back()->with('abort', $folioxdX);
    }
    else{
      $array_data1 = $request->areas;
      $array_data2 = $request->verticals;
      $array_data3 = $request->financings;
      $tamanodata1 = count($array_data1);
      $tamanodata2 = count($array_data2);
      $tamanodata3 = count($array_data3);

      $folio_new = $this->createFolio();
      //
      $new_reg_pay = new Payments;
      $new_reg_pay->folio = $folio_new;
      $new_reg_pay->cadena_id = $id_proyecto;
      $new_reg_pay->hotel_id = $id_sitio;
      $new_reg_pay->proveedor_id = $id_proveedor;
      $new_reg_pay->amount = $monto;
      $new_reg_pay->currency_id = $moneda;
      $new_reg_pay->concept_pay = $concepto_pago;
      $new_reg_pay->way_pay_id = $forma_pago;
      $new_reg_pay->applications_id = $id_application;
      $new_reg_pay->options_id = $id_instalacion;
      $new_reg_pay->classification_id = $clasification;
      $new_reg_pay->name = $name_proyect;
      $new_reg_pay->payments_states_id = '1';
      $new_reg_pay->date_solicitude = date('Y-m-d');
      $new_reg_pay->factura =$factura;
      $new_reg_pay->prov_bco_ctas_id =$account;
      $new_reg_pay->priority_id =$id_priority;
      $new_reg_pay->save();

      $new_reg_pay_comment = new Payments_comment;
      $new_reg_pay_comment->name = $observacion;
      $new_reg_pay_comment->payment_id = $new_reg_pay->id;
      $new_reg_pay_comment->save();
      //Factura pdf
      $pdf= $request->file('fileInput')->store('factura/'.date('Y-m'));
      $new_reg_pay_pdf_fact= new Pay_factura;
      $new_reg_pay_pdf_fact->payment_id = $new_reg_pay->id;
      $new_reg_pay_pdf_fact->name = $pdf;
      $new_reg_pay_pdf_fact->save();

      $parametros2 = [];
      $data1 = [];
      $data2 = [];
      $data3 = [];

      for ($i=0; $i < $tamanodata1; $i++) {
        ${"rest_area".$i} = DB::table('pay_areas')->insertGetId([
                           'area_id' => $array_data1[$i],
                           'payment_id' => $new_reg_pay->id,
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                        ]);
        $area_name = DB::table('payments_areas')->select('name')->where('id', $array_data1[$i])->value('name');
        array_push($data1, $area_name);
      }
      for ($j=0; $j < $tamanodata2; $j++) {
        ${"rest_verticals".$j} = DB::table('pay_projects')->insertGetId([
                           'verticals_id' => $array_data2[$j],
                           'payment_id' => $new_reg_pay->id,
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                        ]);
        $project_name = DB::table('payments_verticals')->select('name')->where('id', $array_data2[$j])->value('name');
        array_push($data2, $project_name);
      }
      for ($k=0; $k < $tamanodata3; $k++) {
        ${"rest_financing".$k} = DB::table('pay_financings')->insertGetId([
                           'financings_id' => $array_data3[$k],
                           'payment_id' => $new_reg_pay->id,
                           'created_at' => \Carbon\Carbon::now(),
                           'updated_at' => \Carbon\Carbon::now()
                        ]);
        $finance_name = DB::table('payments_financings')->select('name')->where('id', $array_data3[$k])->value('name');
        array_push($data3, $finance_name);
      }
      $user_actual = Auth::user()->id;
      $data_rest = DB::table('pay_status_users')->insertGetId([
                         'payment_id' => $new_reg_pay->id,
                         'user_id' => $user_actual,
                         'status_id' => '1',
                         'created_at' => \Carbon\Carbon::now(),
                         'updated_at' => \Carbon\Carbon::now()
                      ]);
      $parametros1 = [
        'folio' => $folio_new,
        'proyecto' => $proyecto_n,
        'sitio' => $sitio_n,
        'proveedor' => $proveedor_n,
        'monto' => $monto,
        'moneda' => $moneda_n,
        'concepto' => $concepto_pago,
        'forma_pago' => $forma_pago_n,
        'aplicacion' => $application_n,
        'instalacion' => $installation_n,
        'clasificacion' => $classification_n,
        'proyecto_nombre' => $name_proyect,
        'observaciones' => $observacion,
        'banco' => $banco_n
      ];
      array_push($parametros2, $data1);
      array_push($parametros2, $data2);
      array_push($parametros2, $data3);

      Mail::to($email_actual)->send(new SolicitudesP($parametros1, $parametros2));
      $folioxd = 'Operation complete! - Folio: '. $folio_new;
      return back()->with('status', $folioxd);

    }
  }
  public function create2(Request $request)
  {
    $id_priority = $request->priority_viat;
    $id_proyecto = $request->project;
    $id_sitio = $request->customer;
    $id_proveedor = $request->provider;
    $monto = $request->amount;
    $moneda = $request->coin;
    $factura = $request->factura;
    $concepto_pago = $request->description;
    $forma_pago = $request->methodPay;
    $id_application = $request->opt_application;
    $id_instalacion = $request->installation;
    $clasification = $request->classification_pay;
    $name_proyect = $request->projectName;
    $observacion = $request->observaciones;
    $banco = $request->bank;
    $account = $request->account;

    $email_actual = Auth::user()->email;
    $email_actual = trim($email_actual);
    $proyecto_n = DB::table('cadenas')->select('name')->where('id', $id_proyecto)->value('name');
    $sitio_n = DB::table('hotels')->select('Nombre_hotel')->where('id', $id_sitio)->value('Nombre_hotel');
    $proveedor_n = DB::table('proveedors')->select('nombre')->where('id', $id_proveedor)->value('nombre');
    $moneda_n = DB::table('currencies')->select('name')->where('id', $moneda)->value('name');
    $forma_pago_n = DB::table('payments_way_pays')->select('name')->where('id', $forma_pago)->value('name');
    $application_n = DB::table('payments_applications')->select('name')->where('id', $id_application)->value('name');
    $installation_n = DB::table('payments_project_options')->select('name')->where('id', $id_instalacion)->value('name');
    $classification_n = DB::table('payments_classifications')->select('name')->where('id', $clasification)->value('name');
    $banco_n = DB::table('bancos')->select('nombre')->where('id', $banco)->value('nombre');


    $array_data1 = $request->areas;
    $array_data2 = $request->verticals;
    $array_data3 = $request->financings;
    $tamanodata1 = count($array_data1);
    $tamanodata2 = count($array_data2);
    $tamanodata3 = count($array_data3);

    $folio_new = $this->createFolio();

    $new_reg_pay = new Payments;
    $new_reg_pay->folio = $folio_new;
    $new_reg_pay->cadena_id = $id_proyecto;
    $new_reg_pay->hotel_id = $id_sitio;
    $new_reg_pay->proveedor_id = $id_proveedor;
    $new_reg_pay->amount = $monto;
    $new_reg_pay->currency_id = $moneda;
    $new_reg_pay->concept_pay = $concepto_pago;
    $new_reg_pay->way_pay_id = $forma_pago;
    $new_reg_pay->applications_id = $id_application;
    $new_reg_pay->options_id = $id_instalacion;
    $new_reg_pay->classification_id = $clasification;
    $new_reg_pay->name = $name_proyect;
    $new_reg_pay->payments_states_id = '1';
    $new_reg_pay->date_solicitude = date('Y-m-d');
    $new_reg_pay->factura =$factura;
    $new_reg_pay->prov_bco_ctas_id =$account;
    $new_reg_pay->priority_id =$id_priority;
    $new_reg_pay->save();

    $new_reg_pay_comment = new Payments_comment;
    $new_reg_pay_comment->name = $observacion;
    $new_reg_pay_comment->payment_id = $new_reg_pay->id;
    $new_reg_pay_comment->save();

    $parametros2 = [];
    $data1 = [];
    $data2 = [];
    $data3 = [];
    // array_push($parametros2, $array_data1);
    // array_push($parametros2, $array_data2);
    // array_push($parametros2, $array_data3);


    for ($i=0; $i < $tamanodata1; $i++) {
      ${"rest_area".$i} = DB::table('pay_areas')->insertGetId([
                         'area_id' => $array_data1[$i],
                         'payment_id' => $new_reg_pay->id,
                         'created_at' => \Carbon\Carbon::now(),
                         'updated_at' => \Carbon\Carbon::now()
                      ]);
      $area_name = DB::table('payments_areas')->select('name')->where('id', $array_data1[$i])->value('name');
      array_push($data1, $area_name);
    }
    for ($j=0; $j < $tamanodata2; $j++) {
      ${"rest_verticals".$j} = DB::table('pay_projects')->insertGetId([
                         'verticals_id' => $array_data2[$j],
                         'payment_id' => $new_reg_pay->id,
                         'created_at' => \Carbon\Carbon::now(),
                         'updated_at' => \Carbon\Carbon::now()
                      ]);
      $project_name = DB::table('payments_verticals')->select('name')->where('id', $array_data2[$j])->value('name');
      array_push($data2, $project_name);
    }
    for ($k=0; $k < $tamanodata3; $k++) {
      ${"rest_financing".$k} = DB::table('pay_financings')->insertGetId([
                         'financings_id' => $array_data3[$k],
                         'payment_id' => $new_reg_pay->id,
                         'created_at' => \Carbon\Carbon::now(),
                         'updated_at' => \Carbon\Carbon::now()
                      ]);
      $finance_name = DB::table('payments_financings')->select('name')->where('id', $array_data3[$k])->value('name');
      array_push($data3, $finance_name);
    }
    $user_actual = Auth::user()->id;
    $data_rest = DB::table('pay_status_users')->insertGetId([
                       'payment_id' => $new_reg_pay->id,
                       'user_id' => $user_actual,
                       'status_id' => '1',
                       'created_at' => \Carbon\Carbon::now(),
                       'updated_at' => \Carbon\Carbon::now()
                    ]);
    $parametros1 = [
      'folio' => $folio_new,
      'proyecto' => $proyecto_n,
      'sitio' => $sitio_n,
      'proveedor' => $proveedor_n,
      'monto' => $monto,
      'moneda' => $moneda_n,
      'concepto' => $concepto_pago,
      'forma_pago' => $forma_pago_n,
      'aplicacion' => $application_n,
      'instalacion' => $installation_n,
      'clasificacion' => $classification_n,
      'proyecto_nombre' => $name_proyect,
      'observaciones' => $observacion,
      'banco' => $banco_n
    ];
    array_push($parametros2, $data1);
    array_push($parametros2, $data2);
    array_push($parametros2, $data3);

    Mail::to($email_actual)->send(new SolicitudesP($parametros1, $parametros2));
    $folioxd = 'Operation complete! - Folio: '. $folio_new;
    return back()->with('status', $folioxd);
  }

  public function createFolio()
  {
    $nomenclatura = "SP-";
    $res = DB::table('payments')->latest()->first();
    if (empty($res)) {
      $nomenclatura = $nomenclatura . "000001";
      return $nomenclatura;
    }else{
      $folio_latest = $res->folio;

      if (empty($folio_latest)) {
        $nomenclatura = $nomenclatura . "000001";
        return $nomenclatura;
      }else{
        $explode = explode('-', $folio_latest);
        $num_folio = (int)$explode[1];
        $num_folio = $num_folio + 1;
        $digits = strlen($num_folio);

        switch ($digits) {
          case 1:
            $num_folio = (string)$nomenclatura . "00000" . $num_folio;
            break;
          case 2:
            $num_folio = (string)$nomenclatura . "0000" . $num_folio;
            break;
          case 3:
            $num_folio = (string)$nomenclatura . "000" . $num_folio;
            break;
          case 4:
            $num_folio = (string)$nomenclatura . "00" . $num_folio;
            break;
          case 5:
            $num_folio = (string)$nomenclatura . "0" . $num_folio;
            break;
          default:
            $num_folio = (string)$nomenclatura . $num_folio;
            break;
        }
        return (string)$num_folio;
      }
    }
  }

  public function test()
  {
    $algo = $this->createFolio();
    dd($algo);
  }

}
