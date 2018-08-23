<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

use Mail;
use App\Mail\Sentsurveynpsmail;
use Illuminate\Support\Facades\Crypt;

class sentsurveyxnps extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'survey:nps';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia correo a todos los usuarios con rol survey al inicio de cada mes.';

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
        $data_emails = [];
        $data_insert = [];
        // $fechaini = "2018-04-01";
        // $fechafin = "2018-04-30";
        // $fecha_cur = "2018-04-01";
        // $mesanteriorfull = "2018-03-01";

        $fechaini = date('Y-m-01');
        $fechafin = date('Y-m-t');
        $fecha_cur = date('Y-m');

        $mesanterior = strtotime ( '-1 month' , strtotime ( $fecha_cur ) ) ;
        $mesanterior = date ( 'Y-m' , $mesanterior );

        $mesanteriorfull = $mesanterior . '-01';


        $sql = DB::select('CALL List_User_NPS(?)', array(6));
        //$sql2 = DB::select('CALL Survey_Question_1(?,?)', array('2018-03-01', 2));
        $sql_count = count($sql);
        
        
        for ($i=0; $i < $sql_count; $i++) {
            $this->line('Current Iteration: ' . $i);
            $nuevolink = $sql[$i]->id.'/'.'1'.'/'.$mesanteriorfull.'/'.$fechafin;
            $encriptodata= Crypt::encryptString($nuevolink);
            $encriptostatus= Crypt::encryptString('1');

            $data_emails = [
                'nombre' => $sql[$i]->name, 
                'shell_data' => $encriptodata, 
                'shell_status' => $encriptostatus
            ];

            $data_insert = [
                'user_id' => $sql[$i]->id,
                'encuesta_id' => 1,
                'estatus_id' => 1,
                'estatus_res' => 0,
                'fecha_inicial' => $fechaini,
                'fecha_corresponde' => $mesanteriorfull,
                'fecha_fin' => $fechafin,
                'shell_data' => $encriptodata,
                'shell_status' => $encriptostatus
            ];

            $this->line('email: ' . $sql[$i]->email);
            $this->line('nombre: ' . $sql[$i]->name);
            $res = DB::table('encuesta_users')->insert($data_insert);
            if ($res) {
                $this->line('Datos Insertados.');
            }else{
                $this->error('no se insertaron datos.');
            }
            $this->line('http://sitwifi.com:8006/'.$encriptodata.'/'.$encriptostatus);
            $this->sentSurveyEmail($sql[$i]->email, $data_emails);
        }


        
        //dd($sql);
        $this->info('Command Completed.');
        //dd($sql2);
    }

    public function sentSurveyEmail($correo, $data)
    {
        //$this->line('Current Iteration: ' . $i);
        //dd($data[0]['email']);

        // $data_count = count($data);
        // for ($i=0; $i < $data_count; $i++) { 
        //     $nombre = $data[$i]['name'];
        //     $correo = $data[$i]['email'];
        //     $shell1 = $data[$i]['shelldata'];
        //     $shell2= $data[$i]['shellstatus'];

        //     $datos = [
        //         'nombre' => $nombre,
        //         'shell_data' => $shell1,
        //         'shell_status' => $shell2,
        //     ];
            $this->line('Sending Email to: ' . $data['nombre'] . ', ' . $correo);
            //Mail::to('jesquinca@sitwifi.com')->send(new Sentsurveynpsmail($datos));
            Mail::to($correo)->send(new Sentsurveynpsmail($data));
        //}
    }

}
