<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PayWeeklyController extends Controller
{
  public function index()
  {
      return view('permitted.payments.weekly_pay');
  }
}
