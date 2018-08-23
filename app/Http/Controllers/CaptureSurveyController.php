<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaptureSurveyController extends Controller
{
  /**
   * Show the application capture survey
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.qualification.capture_survey');
  }
}
