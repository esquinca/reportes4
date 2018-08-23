<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditSurveyController extends Controller
{
  /**
   * Show the application edit survey
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.qualification.edit_survey');
  }
}
