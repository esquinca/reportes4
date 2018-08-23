<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

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

class PayHistoryPaidController extends Controller
{
  public function index() {
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
    return view('permitted.payments.status_paid',compact('cadena','proveedor','vertical', 'currency', 'way', 'area', 'application', 'options', 'classification', 'financing'));
  }
  public function payments_paid (Request $request) {
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
    if (auth()->user()->can('View history all payments status paid')) {
      $result = DB::select('CALL  get_payments_mes_pagado (?)', array($date));
    }
    return json_encode($result);
  }

}
