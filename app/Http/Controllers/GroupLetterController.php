<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

class GroupLetterController extends Controller
{
    public function index()
    {
    	$grupos = DB::table('listar_grupos')->get();
    	return view('permitted.equipment.group_letter', compact('grupos'));
    }
}
