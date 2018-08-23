<?php

namespace App;
use App\Reference;
use App\Typereport;
use App\Cadena;
use App\User;
use App\contract_contact;
use App\business_name;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    //
    public function references()
    {
      return $this->belongsToMany(Reference::class);
    }
    public function typereports()
    {
      return $this->belongsToMany(Typereport::class);
    }
    public function hotelCadena()
    {
    	return $this->belongsToMany(Cadena::class);
    }
    public function usuarios()
    {
      return $this->belongsToMany(User::class);
    }
    public function contactos()
    {
      return $this->belongsToMany(contract_contact::class);
    }
    public function razonsocials()
    {
      return $this->belongsToMany(business_name::class);
    }


}
