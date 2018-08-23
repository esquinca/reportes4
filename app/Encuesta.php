<?php
use App\Pregunta;
namespace App;

use Illuminate\Database\Eloquent\Model;

class Encuesta extends Model
{
  public function preguntas()
  {
    return $this->belongsToMany(Pregunta::class);
  }
}
