<?php

namespace App\Http\Controllers;
use App\Hotel;
use App\Typereport;
use Illuminate\Http\Request;

class ApprovalConciergeController extends Controller
{
  public function index()
  {
    if (auth()->user()->hasanyrole('SuperAdmin|Admin')) {
      $hotels = Hotel::select('id', 'Nombre_hotel')->get();
      $types = Typereport::all();
      return view('permitted.report.view_approval_concierge',compact('hotels', 'types'));
    }
    else {
      $hotels = auth()->user()->hotels;
      $types = Typereport::all();
      return view('permitted.report.view_approval_concierge',compact('hotels', 'types'));
    }
  }
}
