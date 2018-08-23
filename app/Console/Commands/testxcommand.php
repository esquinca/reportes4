<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

class testxcommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Encuestas clientes.
        //$sql = DB::table('encuesta_user_clientes')->get(); 
        // Encuestas personales (sitwifi).
        //$sql = DB::table('encuesta_user_sitwifi')->get();

        //$res1 = DB::table('encuesta_user_clientes')->select('email', 'Special')->where('id_eu', 2)->get();
        //$res2 = DB::table('encuesta_users')->select('user_id', 'estatus_res', 'shell_data', 'shell_status')->where('id', 2)->get();
        //$res3 = DB::table('encuesta_users')->where('id', 2)->get();

        //$res4 = DB::select('CALL buscar_venue_user(?)', array($res2[0]->user_id));
        $res5 = DB::select('CALL list_user_unanswer(?, ?)', array(2, '2018-04-01'));


        // $count = count($res4);
        // $string1 = "";

        // for ($i=0; $i < $count; $i++) { 
        //     $string1 = $string1 . $res4[$i]->Nombre_hotel . ", ";
        // }
        // $string1 = substr($string1, 0, -2);
        
        $res6= DB::select('CALL delivery_letter_venue_header(?)', array(4));
        $result = DB::select('CALL comments_table(?, ?)', array('2018-04-01', 2));
        $result1 = DB::select('CALL conteo_survey(?, ?)', array(2, '2018-04-01'));
        dd($res5);
    }
}
