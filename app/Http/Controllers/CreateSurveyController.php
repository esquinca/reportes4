<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Encuesta;
use App\Pregunta;
use DB;
class CreateSurveyController extends Controller
{
  /**
   * Show the application create survey
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      return view('permitted.qualification.create_survey');
  }
  public function create(Request $request)
  {
    $titulo = $request->title;

    $new_title = new Encuesta;
    $new_title->name=$titulo;
    $new_title->save();

    $cont_option =$request->option;
    $tamano = count($cont_option);

    //echo $titulo.'<br>';
    for ($i=0; $i < $tamano; $i++) {
      // echo $i.'<br>';
      if ( !empty($cont_option[$i]) ) {
        //echo $cont_option[$i].'<br>';
        $new_question = new Pregunta;
        $new_question->name=$cont_option[$i];
        $new_question->save();

        DB::table('encuesta_pregunta')->insertGetId([
              'encuesta_id' => $new_title->id,'pregunta_id' => $new_question->id
            ]);
      }
    }
    return back()->with('status', 'Operation complete!');

   //dd($tamano);
  }
}
