<?php
use App\User;
use App\Section;
use App\Menu;
use App\Operacione;
use App\Vertical;
use App\Cadena;
use App\Reference;
use App\Hotel;
use App\Oid;
use App\Typereport;
use App\Zonedirect_ip;

use App\Sucursal;
use App\Servicio;
use App\Grupo;
// use App\Proyecto;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Crypt;

use App\Estatu;
use App\Encuesta;
use App\Pregunta;
use App\Jefedirecto;

use App\Marca;
use App\Modelo;
use App\Estado;

use App\Viatic_service;
use App\Viatic_state;
use App\Viatic_beneficiary;
use App\Viatic_list_concept;

use App\Banco;
use App\Currency;
use App\Prov_bco_cta;
use App\Pay_status_user;

use App\Payments_application;
use App\Payments_area;
use App\Payments_classification;
use App\Payments_comment;
use App\Payments_financing;
use App\Payments_project_options;
use App\Payments_states;
use App\Payments_verticals;
use App\Payments_way_pay;
use App\Payments;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //Truncamos las tablas principales
      Role::truncate();
      User::truncate();
      Section::truncate();
      Operacione::truncate();
      Vertical::truncate();
      Cadena::truncate();
      Reference::truncate();
      Hotel::truncate();
      Oid::truncate();
      Typereport::truncate();
      Zonedirect_ip::truncate();

      Sucursal::truncate();
      Servicio::truncate();
      Estatu::truncate();
      Encuesta::truncate();
      Pregunta::truncate();
      Jefedirecto::truncate();

      Marca::truncate();
      Modelo::truncate();
      Estado::truncate();

      Viatic_service::truncate();
      Viatic_state::truncate();
      Viatic_beneficiary::truncate();
      Viatic_list_concept::truncate();

//Creamos los roles predeterminados
$superadminRole = Role::create(['name' => 'SuperAdmin']);
     $adminRole = Role::create(['name' => 'Admin']);
  $operatorRole = Role::create(['name' => 'Operator']);
      $userRole = Role::create(['name' => 'UserRole']);
   $monitorRole = Role::create(['name' => 'Monitor']);
  $surveyedRole = Role::create(['name' => 'Surveyed']);
 $conciergeRole = Role::create(['name' => 'Itconcierge']);

 //Creamos los permisos predeterminados
   //- Dashboard principal
   $viewdashboardpral= Permission::create(['name' => 'View dashboard pral']);
   //- Inventario
   $inventoryviewdethotel= Permission::create(['name' => 'View detailed for hotel']);
   $inventoryviewdethotel3= Permission::create(['name' => 'View detailed for proyect']);
   $inventoryviewdethotel4= Permission::create(['name' => 'View cover']);
   $inventoryviewdethotel5= Permission::create(['name' => 'View distribucion']);
   //- Equipos
   $equipmentview= Permission::create(['name' => 'View add equipment']);
   $equipmentviewadd= Permission::create(['name' => 'Create equipment']);
   $equipmentviewremoved= Permission::create(['name' => 'View removed equipment']);
   $equipmentremoved= Permission::create(['name' => 'Removed equipment']);
   $equipmentviewsearch= Permission::create(['name' => 'View search equipment']);
   $equipmentviewmove= Permission::create(['name' => 'View move equipment']);
   $equipmentmove= Permission::create(['name' => 'Move equipment']);
   $equipmentviewgroup= Permission::create(['name' => 'View equipment group']);
   $equipmentviewgroupadd= Permission::create(['name' => 'Add equipment group']);
   $equipmentviewgroupremoved= Permission::create(['name' => 'Removed equipment group']);
   //- Reportes
   $viewassignreport= Permission::create(['name' => 'View assign report']);
   $viewcreatassignreport= Permission::create(['name' => 'Create assign report']);
   $vieweditreport= Permission::create(['name' => 'Edit assign report']);
   $viewdeletereport= Permission::create(['name' => 'Delete assign report']);
   $viewcreatgeneralreport= Permission::create(['name' => 'Create general report']);
   $viewindividualreport= Permission::create(['name' => 'View individual capture']);
   $viewcreatindividualreport= Permission::create(['name' => 'Create individual capture']);
   $viewviewgeneratereport= Permission::create(['name' => 'View individual general report']);
   $vieweditgeneratereport= Permission::create(['name' => 'Edit individual general report']);
   $viewconciergeapproval= Permission::create(['name' => 'View concierge approval']);
   $viewcreatconciergeapproval= Permission::create(['name' => 'Create concierge approval']);
   $viewdeletconciergeapproval= Permission::create(['name' => 'Delete concierge approval']);
   $viewadminapproval = Permission::create(['name' => 'View admin approval']);
   $viewacceptadminapproval = Permission::create(['name' => 'Option admin approval']);
   $viewnotificationadminapproval = Permission::create(['name' => 'Notification admin approval']);
   $viewreport = Permission::create(['name' => 'View report']);
   $viewreport2 = Permission::create(['name' => 'View report concat']);
   $viewprovider = Permission::create(['name' => 'View provider']);
   $viewcreatprovider= Permission::create(['name' => 'Create provider']);
   $viewcreatprovider= Permission::create(['name' => 'Edit provider']);
   $viewdeletprovider= Permission::create(['name' => 'Delete provider']);
   //Calificaciones
   $viewdashboardsurveynps = Permission::create(['name' => 'View dashboard survey nps']);
   $viewaddsurvey = Permission::create(['name' => 'View create survey']);
   $viewgeneratesurvey = Permission::create(['name' => 'Generate survey']);
   $viewcapturesurvey = Permission::create(['name' => 'View capture survey']);
   $viewcreatsurvey = Permission::create(['name' => 'Create survey']);
   $vieweditsurvey = Permission::create(['name' => 'View edit survey']);
   $vieweditsurvey = Permission::create(['name' => 'Edit survey']);
   $viewresultsurvey = Permission::create(['name' => 'View results survey']);
   $viewconfigsurvey = Permission::create(['name' => 'View survey configuration']);
   $viewconfigaddsurvey = Permission::create(['name' => 'Assign user survey']);
   $viewconfigremovedsurvey = Permission::create(['name' => 'Removed user survey']);
   $viewconfiggeneratekeysurvey = Permission::create(['name' => 'Generate key user survey']);
   $viewconfigsendkeysurvey = Permission::create(['name' => 'Send email user survey']);
   $viewconfigviewkeysurvey = Permission::create(['name' => 'View key user survey']);
   $viewconfigsurveynps = Permission::create(['name' => 'View survey nps configuration']);
   //Asignacion
   $viewcaptureassignuser = Permission::create(['name' => 'View assign hotel user']);
   $viewcreatsassignuser= Permission::create(['name' => 'Create assign hotel user']);
   $viewdeletesassignuser= Permission::create(['name' => 'Delete assign hotel user']);
   $viewcaptureassignlistuser = Permission::create(['name' => 'View list assign hotel user']);
   $viewdeletassignuser = Permission::create(['name' => 'View assign delete client']);
   $viewnpsconfigautomatic = Permission::create(['name' => 'View config nps automatic']);
   $createnpsconfigautomatic = Permission::create(['name' => 'Create config nps automatic']);
   $viewnpsconfigindividual = Permission::create(['name' => 'View config nps individual']);
   $createnpsconfigindividual = Permission::create(['name' => 'Create config nps individual']);
   //- Herramientas
   $toolsviewdiagnostic1= Permission::create(['name' => 'View guest review']);
   $toolsviewdiagnostic2= Permission::create(['name' => 'View server review']);
   $toolsviewtest = Permission::create(['name' => 'View test zd']);
   //- Configuración
   $viewcreatuserconfiguration = Permission::create(['name' => 'Create user']);
   $viewedituserconfiguration = Permission::create(['name' => 'Edit user']);
   $viewdeleteuserconfiguration = Permission::create(['name' => 'Delete user']);
   $viewconfiguration = Permission::create(['name' => 'View Configuration']);
   $vieweditconfiguration = Permission::create(['name' => 'Edit Configuration']);
   //Encuesta sitwifi
   $encuestasitwifidashboard= Permission::create(['name' => 'View dashboard sitwifi']);
   $encuestasitwifivconfig= Permission::create(['name' => 'View config sitwifi']);
   $encuestasitwifidconfig= Permission::create(['name' => 'Delete config sitwifi']);
   $encuestasitwifisend= Permission::create(['name' => 'Send mail sitwifi']);

   $vcreatmodel= Permission::create(['name' => 'Create model']);
   $vcreatmarcas= Permission::create(['name' => 'Create marcas']);
   //- Viaticos
   $vcreatviatic1= Permission::create(['name' => 'View dashboard travel expenses']);
   $vcreatviatic2= Permission::create(['name' => 'View add request of travel expenses']);
   $vcreatviatic3= Permission::create(['name' => 'View history travel requests']);
   $viaticoperm1= Permission::create(['name' => 'Create add request of travel expenses']);
   $viaticoperm2= Permission::create(['name' => 'Edit request of travel expenses']);
   $viaticoperm3= Permission::create(['name' => 'Checking request of travel expenses']);
   $viaticoperm4= Permission::create(['name' => 'Reuse request of travel expenses']);
   $viaticoperm5= Permission::create(['name' => 'Approve request of travel expenses']);
   //-Viaticos notifications
   $viaticoperm6= Permission::create(['name' => 'Travel allowance notification']);
   $viaticolevel0= Permission::create(['name' => 'View level zero notifications']);
   $viaticolevel1= Permission::create(['name' => 'View level one notifications']);
   $viaticolevel2= Permission::create(['name' => 'View level two notifications']);
   $viaticolevel3= Permission::create(['name' => 'View level three notifications']);
   $viaticolevel4= Permission::create(['name' => 'View level four notifications']);

   $vcreatgroup= Permission::create(['name' => 'Create grupos']);
   $vcreatgroup2= Permission::create(['name' => 'View group letter']);

   $vcoverdelivery1= Permission::create(['name' => 'View cover delivery']);

   $vcoverdelivery2= Permission::create(['name' => 'View add request of payment']);
   $vcoverdelivery3= Permission::create(['name' => 'View history of payment']);
   $vcoverdelivery4= Permission::create(['name' => 'View requests via']);

   $vcoverdelivery5= Permission::create(['name' => 'View history all viatic']);
   $vcoverdelivery6= Permission::create(['name' => 'Deny travel allowance request']);

   $vcoverdelivery10= Permission::create(['name' => 'View filter proyect viatic']);

   //-Payment notification
   $pagospermition= Permission::create(['name' => 'Payment notification']);
   $pagosperm0= Permission::create(['name' => 'View level zero payment notification']);
   $pagosperm1= Permission::create(['name' => 'View level one payment notification']);
   $pagosperm2= Permission::create(['name' => 'View level two payment notification']);
   $pagosperm2= Permission::create(['name' => 'View level three payment notification']);

   $pagosperm_d= Permission::create(['name' => 'View dashboard payment notification']);
   $pagosperm_h= Permission::create(['name' => 'View history payment notification']);
   $pagosperm_h_a= Permission::create(['name' => 'View history all payment notification']);
   $pagosperm_f_p= Permission::create(['name' => 'View filter proyect payment']);

   //Creamos los usuarios por default
     $user_default_0 = new User;
     $user_default_0->name='SuperAdmin';
     $user_default_0->email='desarrollo@sitwifi.com';
     $user_default_0->city='Cancún, México';
     $user_default_0->password= bcrypt('123456');
     $user_default_0->avatar= 'dist/img/user.jpg';
     $user_default_0->save();
     $user_default_0->assignRole($superadminRole);

     $user_default_1 = new User;
     $user_default_1->name='Default Admin User';
     $user_default_1->email='default_admin@sitwifi.com';
     $user_default_1->city='Cancún, México';
     $user_default_1->password= bcrypt('123456');
     $user_default_1->avatar= 'dist/img/user.jpg';
     $user_default_1->save();
     $user_default_1->assignRole($adminRole);
     //
     $user_default_2 = new User;
     $user_default_2->name='Default Operator User';
     $user_default_2->email='operator@sitwifi.com';
     $user_default_2->city='Cancún, México';
     $user_default_2->password= bcrypt('123456');
     $user_default_2->avatar= 'dist/img/user.jpg';
     $user_default_2->save();
     $user_default_2->assignRole($operatorRole);
     //
     $user_default_3 = new User;
     $user_default_3->name='Default User';
     $user_default_3->email='user@sitwifi.com';
     $user_default_3->city='Cancún, México';
     $user_default_3->password= bcrypt('123456');
     $user_default_3->avatar= 'dist/img/user.jpg';
     $user_default_3->save();
     $user_default_3->assignRole($userRole);
     //
     $user_default_4 = new User;
     $user_default_4->name='Default Monitor User';
     $user_default_4->email='monitor@sitwifi.com';
     $user_default_4->city='Cancún, México';
     $user_default_4->password= bcrypt('123456');
     $user_default_4->avatar= 'dist/img/user.jpg';
     $user_default_4->save();
     $user_default_4->assignRole($monitorRole);

    //Usuarios de desarrollo e investigación sitwifi
     $super_admin_a1 = new User;
     $super_admin_a1->name='Alonso de Jesus Cauich Viana';
     $super_admin_a1->email='acauich@sitwifi.com';
     $super_admin_a1->city='Cancún, México';
     $super_admin_a1->password= bcrypt('123456');
     $super_admin_a1->avatar= 'dist/img/user.jpg';
     $super_admin_a1->save();
     $super_admin_a1->assignRole($superadminRole);

     $super_admin_a2 = new User;
     $super_admin_a2->name='Jose Antonio Esquinca Bonilla';
     $super_admin_a2->email='jesquinca@sitwifi.com';
     $super_admin_a2->city='Cancún, México';
     $super_admin_a2->password= bcrypt('123456');
     $super_admin_a2->avatar= 'dist/img/user.jpg';
     $super_admin_a2->save();
     $super_admin_a2->assignRole($superadminRole);

     $super_admin_a3 = new User;
     $super_admin_a3->name='Angel Gabriel Ramirez Ruiz';
     $super_admin_a3->email='gramirez@sitwifi.com';
     $super_admin_a3->city='Cancún, México';
     $super_admin_a3->password= bcrypt('123456');
     $super_admin_a3->avatar= 'dist/img/user.jpg';
     $super_admin_a3->save();
     $super_admin_a3->assignRole($superadminRole);

     $super_admin_a4 = new User;
     $super_admin_a4->name='Oscar Chan';
     $super_admin_a4->email='ochan@sitwifi.com';
     $super_admin_a4->city='Cancún, México';
     $super_admin_a4->password= bcrypt('123456');
     $super_admin_a4->avatar= 'dist/img/user.jpg';
     $super_admin_a4->save();
     $super_admin_a4->assignRole($superadminRole);

     $super_admin_a5 = new User;
     $super_admin_a5->name='Edgar Miranda';
     $super_admin_a5->email='emiranda@sitwifi.com';
     $super_admin_a5->city='Cancún, México';
     $super_admin_a5->password= bcrypt('123456');
     $super_admin_a5->avatar= 'dist/img/user.jpg';
     $super_admin_a5->save();
     $super_admin_a5->assignRole($superadminRole);

    //Usuarios Jefes sitwifi
      $user_000 = new User;
      $user_000->name='Alejandro	Espejo';
      $user_000->email='aespejo@sitwifi.com';
      $user_000->city='Cancún, México';
      $user_000->password= bcrypt('123456');
      $user_000->avatar= 'dist/img/user.jpg';
      $user_000->save();
      $user_000->assignRole($monitorRole);

      $user_001 = new User;
      $user_001->name='Alejandro Espejo Bartra';
      $user_001->email='aespejob@sitwifi.com';
      $user_001->city='Cancún, México';
      $user_001->password= bcrypt('123456');
      $user_001->avatar= 'dist/img/user.jpg';
      $user_001->save();
      $user_001->assignRole($adminRole);

      $user_002 = new User;
      $user_002->name='John Walker';
      $user_002->email='jwalker@sitwifi.com';
      $user_002->city='Cancún, México';
      $user_002->password= bcrypt('123456');
      $user_002->avatar= 'dist/img/user.jpg';
      $user_002->save();
      $user_002->assignRole($adminRole);

      $user_003 = new User;
      $user_003->name='René González';
      $user_003->email='rgonzalez@sitwifi.com';
      $user_003->city='Cancún, México';
      $user_003->password= bcrypt('123456');
      $user_003->avatar= 'dist/img/user.jpg';
      $user_003->save();
      $user_003->assignRole($adminRole);

      $user_004 = new User;
      $user_004->name='Mariana Presuel';
      $user_004->email='mariana@sitwifi.com';
      $user_004->city='Cancún, México';
      $user_004->password= bcrypt('123456');
      $user_004->avatar= 'dist/img/user.jpg';
      $user_004->save();
      $user_004->assignRole($adminRole);

      $user_005 = new User;
      $user_005->name='Ricardo Delgado';
      $user_005->email='rdelgado@sitwifi.com';
      $user_005->city='Cancún, México';
      $user_005->password= bcrypt('123456');
      $user_005->avatar= 'dist/img/user.jpg';
      $user_005->save();
      $user_005->assignRole($adminRole);

      $user_006 = new User;
      $user_006->name='Carlos Mata';
      $user_006->email='cmata@sitwifi.com';
      $user_006->city='Cancún, México';
      $user_006->password= bcrypt('123456');
      $user_006->avatar= 'dist/img/user.jpg';
      $user_006->save();
      $user_006->assignRole($adminRole);

      $user_007 = new User;
      $user_007->name='Aaron Arciga';
      $user_007->email='aarciga@sitwifi.com';
      $user_007->city='Cancún, México';
      $user_007->password= bcrypt('123456');
      $user_007->avatar= 'dist/img/user.jpg';
      $user_007->save();
      $user_007->assignRole($adminRole);

      $user_008 = new User;
      $user_008->name='Alejandra Pérez García';
      $user_008->email='aperez@sitwifi.com';
      $user_008->city='Cancún, México';
      $user_008->password= bcrypt('123456');
      $user_008->avatar= 'dist/img/user.jpg';
      $user_008->save();
      $user_008->assignRole($adminRole);

      $user_009 = new User;
      $user_009->name='Carlos Rangel';
      $user_009->email='crangel@sitwifi.com';
      $user_009->city='Cancún, México';
      $user_009->password= bcrypt('123456');
      $user_009->avatar= 'dist/img/user.jpg';
      $user_009->save();
      $user_009->assignRole($monitorRole);

      $user_010 = new User;
      $user_010->name='Sandra Cruz';
      $user_010->email='admin@sitwifi.com';
      $user_010->city='Cancún, México';
      $user_010->password= bcrypt('123456');
      $user_010->avatar= 'dist/img/user.jpg';
      $user_010->save();
      $user_010->assignRole($monitorRole);

      $user_011 = new User;
      $user_011->name='Arturo Caballero';
      $user_011->email='acaballero@sitwifi.com';
      $user_011->city='Cancún, México';
      $user_011->password= bcrypt('123456');
      $user_011->avatar= 'dist/img/user.jpg';
      $user_011->save();
      $user_011->assignRole($conciergeRole);

      $user_012 = new User;
      $user_012->name='Abraham	Calderón';
      $user_012->email='acalderon@sitwifi.com';
      $user_012->city='Cancún, México';
      $user_012->password= bcrypt('123456');
      $user_012->avatar= 'dist/img/user.jpg';
      $user_012->save();
      $user_012->assignRole($conciergeRole);

      $user_013 = new User;
      $user_013->name='David Tejero';
      $user_013->email='dtejero@sitwifi.com';
      $user_013->city='Cancún, México';
      $user_013->password= bcrypt('123456');
      $user_013->avatar= 'dist/img/user.jpg';
      $user_013->save();
      $user_013->assignRole($conciergeRole);

      $user_014 = new User;
      $user_014->name='Jose Luis Ortiz';
      $user_014->email='jortiz@sitwifi.com';
      $user_014->city='Cancún, México';
      $user_014->password= bcrypt('123456');
      $user_014->avatar= 'dist/img/user.jpg';
      $user_014->save();
      $user_014->assignRole($conciergeRole);

      $user_015 = new User;
      $user_015->name='Angel Lopez';
      $user_015->email='alopez@sitwifi.com';
      $user_015->city='Cancún, México';
      $user_015->password= bcrypt('123456');
      $user_015->avatar= 'dist/img/user.jpg';
      $user_015->save();
      $user_015->assignRole($conciergeRole);

      $user_016 = new User;
      $user_016->name='Jimmy Novelo';
      $user_016->email='jnovelo@sitwifi.com';
      $user_016->city='Cancún, México';
      $user_016->password= bcrypt('123456');
      $user_016->avatar= 'dist/img/user.jpg';
      $user_016->save();
      $user_016->assignRole($conciergeRole);

      $user_017 = new User;
      $user_017->name='Wilbert Manzanero';
      $user_017->email='wmanzanero@sitwifi.com';
      $user_017->city='Cancún, México';
      $user_017->password= bcrypt('123456');
      $user_017->avatar= 'dist/img/user.jpg';
      $user_017->save();
      $user_017->assignRole($conciergeRole);

      $user_018 = new User;
      $user_018->name='Alfredo Lagunes';
      $user_018->email='alagunes@sitwifi.com';
      $user_018->city='Cancún, México';
      $user_018->password= bcrypt('123456');
      $user_018->avatar= 'dist/img/user.jpg';
      $user_018->save();
      $user_018->assignRole($conciergeRole);

      $user_019 = new User;
      $user_019->name='Israel Ojeda';
      $user_019->email='iojeda@sitwifi.com';
      $user_019->city='Cancún, México';
      $user_019->password= bcrypt('123456');
      $user_019->avatar= 'dist/img/user.jpg';
      $user_019->save();
      $user_019->assignRole($conciergeRole);

      $user_020 = new User;
      $user_020->name='Ivan Jim';
      $user_020->email='ajim@sitwifi.com';
      $user_020->city='Cancún, México';
      $user_020->password= bcrypt('123456');
      $user_020->avatar= 'dist/img/user.jpg';
      $user_020->save();
      $user_020->assignRole($conciergeRole);

      $user_021 = new User;
      $user_021->name='Francisco René	Sánchez';
      $user_021->email='fsanchez@sitwifi.com';
      $user_021->city='Cancún, México';
      $user_021->password= bcrypt('123456');
      $user_021->avatar= 'dist/img/user.jpg';
      $user_021->save();
      $user_021->assignRole($conciergeRole);

      $user_022 = new User;
      $user_022->name='Martha Isabel Uh Poot';
      $user_022->email='marthaisabel@sitwifi.com';
      $user_022->city='Cancún, México';
      $user_022->password= bcrypt('123456');
      $user_022->avatar= 'dist/img/user.jpg';
      $user_022->save();
      $user_022->assignRole($conciergeRole);

      $user_023 = new User;
      $user_023->name='Ricardo Nuñez';
      $user_023->email='rnunez@sitwifi.com';
      $user_023->city='Cancún, México';
      $user_023->password= bcrypt('123456');
      $user_023->avatar= 'dist/img/user.jpg';
      $user_023->save();
      $user_023->assignRole($conciergeRole);

      $user_024 = new User;
      $user_024->name='Kevin Pérez';
      $user_024->email='kperez@sitwifi.com';
      $user_024->city='Cancún, México';
      $user_024->password= bcrypt('123456');
      $user_024->avatar= 'dist/img/user.jpg';
      $user_024->save();
      $user_024->assignRole($conciergeRole);

      $user_025 = new User;
      $user_025->name='Maria del Jesús Ortiz';
      $user_025->email='mortiz@sitwifi.com';
      $user_025->city='Cancún, México';
      $user_025->password= bcrypt('123456');
      $user_025->avatar= 'dist/img/user.jpg';
      $user_025->save();
      $user_025->assignRole($conciergeRole);

      $user_026 = new User;
      $user_026->name='Luis Gonzalez';
      $user_026->email='lgonzalez@sitwifi.com';
      $user_026->city='Cancún, México';
      $user_026->password= bcrypt('123456');
      $user_026->avatar= 'dist/img/user.jpg';
      $user_026->save();
      $user_026->assignRole($conciergeRole);

      $user_027 = new User;
      $user_027->name='Jorge Ángel Quintanar';
      $user_027->email='jquintanar@sitwifi.com';
      $user_027->city='Cancún, México';
      $user_027->password= bcrypt('123456');
      $user_027->avatar= 'dist/img/user.jpg';
      $user_027->save();
      $user_027->assignRole($conciergeRole);

      $user_028 = new User;
      $user_028->name='Omar Serrano';
      $user_028->email='oserrano@sitwifi.com';
      $user_028->city='Cancún, México';
      $user_028->password= bcrypt('123456');
      $user_028->avatar= 'dist/img/user.jpg';
      $user_028->save();
      $user_028->assignRole($conciergeRole);

      $user_029 = new User;
      $user_029->name='Johnny Segura';
      $user_029->email='jsegura@sitwifi.com';
      $user_029->city='Cancún, México';
      $user_029->password= bcrypt('123456');
      $user_029->avatar= 'dist/img/user.jpg';
      $user_029->save();
      $user_029->assignRole($conciergeRole);

      $user_030 = new User;
      $user_030->name='José Luis Muñoz Lozano';
      $user_030->email='jlmunoz@sitwifi.com';
      $user_030->city='Cancún, México';
      $user_030->password= bcrypt('123456');
      $user_030->avatar= 'dist/img/user.jpg';
      $user_030->save();
      $user_030->assignRole($conciergeRole);

      $user_031 = new User;
      $user_031->name='Miguel Aristides Mateo';
      $user_031->email='amateo@sitwifi.com';
      $user_031->city='Cancún, México';
      $user_031->password= bcrypt('123456');
      $user_031->avatar= 'dist/img/user.jpg';
      $user_031->save();
      $user_031->assignRole($conciergeRole);

      $user_032 = new User;
      $user_032->name='Leo Daniel Fernandez del Angel';
      $user_032->email='lfernandez@sitwifi.com';
      $user_032->city='Cancún, México';
      $user_032->password= bcrypt('123456');
      $user_032->avatar= 'dist/img/user.jpg';
      $user_032->save();
      $user_032->assignRole($conciergeRole);

      $user_033 = new User;
      $user_033->name='Juan Carlos May Muñoz';
      $user_033->email='jcmay@sitwifi.com';
      $user_033->city='Cancún, México';
      $user_033->password= bcrypt('123456');
      $user_033->avatar= 'dist/img/user.jpg';
      $user_033->save();
      $user_033->assignRole($conciergeRole);

      $user_034 = new User;
      $user_034->name='Manuel Jesús	Pech Chan';
      $user_034->email='mpech@sitwifi.com';
      $user_034->city='Cancún, México';
      $user_034->password= bcrypt('123456');
      $user_034->avatar= 'dist/img/user.jpg';
      $user_034->save();
      $user_034->assignRole($conciergeRole);

      $user_035 = new User;
      $user_035->name='Miguel Angel Morin Ochoa';
      $user_035->email='morin@sitwifi.com';
      $user_035->city='Cancún, México';
      $user_035->password= bcrypt('123456');
      $user_035->avatar= 'dist/img/user.jpg';
      $user_035->save();
      $user_035->assignRole($conciergeRole);

      $user_036 = new User;
      $user_036->name='Oscar Alejandro Montes Alvarado';
      $user_036->email='omontes@sitwifi.com';
      $user_036->city='Cancún, México';
      $user_036->password= bcrypt('123456');
      $user_036->avatar= 'dist/img/user.jpg';
      $user_036->save();
      $user_036->assignRole($conciergeRole);

      $user_037 = new User;
      $user_037->name='Daniel	Elena Ramirez';
      $user_037->email='delena@sitwifi.com';
      $user_037->city='Cancún, México';
      $user_037->password= bcrypt('123456');
      $user_037->avatar= 'dist/img/user.jpg';
      $user_037->save();
      $user_037->assignRole($conciergeRole);

       $user_038 = new User;
       $user_038->name='Diego Edmundo Oréa Campos';
       $user_038->email='dorea@sitwifi.com';
       $user_038->city='Cancún, México';
       $user_038->password= bcrypt('123456');
       $user_038->avatar= 'dist/img/user.jpg';
       $user_038->save();
       $user_038->assignRole($conciergeRole);

       $user_039 = new User;
       $user_039->name='Victor Perez';
       $user_039->email='vperez@sitwifi.com';
       $user_039->city='Cancún, México';
       $user_039->password= bcrypt('123456');
       $user_039->avatar= 'dist/img/user.jpg';
       $user_039->save();
       $user_039->assignRole($conciergeRole);

       $user_040 = new User;
       $user_040->name='Oliver Fernando Garcia Uc';
       $user_040->email='ogarcia@sitwifi.com';
       $user_040->city='Cancún, México';
       $user_040->password= bcrypt('123456');
       $user_040->avatar= 'dist/img/user.jpg';
       $user_040->save();
       $user_040->assignRole($conciergeRole);

       $user_041 = new User;
       $user_041->name='Jesus Castillo';
       $user_041->email='jcastillo@sitwifi.com';
       $user_041->city='Cancún, México';
       $user_041->password= bcrypt('123456');
       $user_041->avatar= 'dist/img/user.jpg';
       $user_041->save();
       $user_041->assignRole($conciergeRole);

       $user_042 = new User;
       $user_042->name='Diego Angeles';
       $user_042->email='dangeles@sitwifi.com';
       $user_042->city='Cancún, México';
       $user_042->password= bcrypt('123456');
       $user_042->avatar= 'dist/img/user.jpg';
       $user_042->save();
       $user_042->assignRole($conciergeRole);

       //Otros usuarios
       $user_043 = new User;
       $user_043->name='Hector Tavera';
       $user_043->email='htavera@sitwifi.com';
       $user_043->city='Cancún, México';
       $user_043->password= bcrypt('123456');
       $user_043->avatar= 'dist/img/user.jpg';
       $user_043->save();
       $user_043->assignRole($monitorRole);

       $user_044 = new User;
       $user_044->name='Javier Martinez';
       $user_044->email='jmartinez@sitwifi.com';
       $user_044->city='Cancún, México';
       $user_044->password= bcrypt('123456');
       $user_044->avatar= 'dist/img/user.jpg';
       $user_044->save();
       $user_044->assignRole($monitorRole);

       $user_045 = new User;
       $user_045->name='Paola Ku';
       $user_045->email='pku@sitwifi.com';
       $user_045->city='Cancún, México';
       $user_045->password= bcrypt('123456');
       $user_045->avatar= 'dist/img/user.jpg';
       $user_045->save();
       $user_045->assignRole($monitorRole);

       $user_046 = new User;
       $user_046->name='Jessica Bernal';
       $user_046->email='jbernal@sitwifi.com';
       $user_046->city='Cancún, México';
       $user_046->password= bcrypt('123456');
       $user_046->avatar= 'dist/img/user.jpg';
       $user_046->save();
       $user_046->assignRole($monitorRole);

       $user_047 = new User;
       $user_047->name='Help desk Caribe';
       $user_047->email='helpdesk@sitwifi.com';
       $user_047->city='Cancún, México';
       $user_047->password= bcrypt('123456');
       $user_047->avatar= 'dist/img/user.jpg';
       $user_047->save();
       $user_047->assignRole($monitorRole);

       $user_048 = new User;
       $user_048->name='Alfredo	López';
       $user_048->email='alfredolopez@sitwifi.com';
       $user_048->city='Cancún, México';
       $user_048->password= bcrypt('123456');
       $user_048->avatar= 'dist/img/user.jpg';
       $user_048->save();
       $user_048->assignRole($monitorRole);

       $user_049 = new User;
       $user_049->name='Angie	Mendoza';
       $user_049->email='amendoza@sitwifi.com';
       $user_049->city='Cancún, México';
       $user_049->password= bcrypt('123456');
       $user_049->avatar= 'dist/img/user.jpg';
       $user_049->save();
       $user_049->assignRole($monitorRole);

       $user_050 = new User;
       $user_050->name='Alejandro	Padilla Gil';
       $user_050->email='apadilla@sitwifi.com';
       $user_050->city='Cancún, México';
       $user_050->password= bcrypt('123456');
       $user_050->avatar= 'dist/img/user.jpg';
       $user_050->save();
       $user_050->assignRole($monitorRole);

       $user_051 = new User;
       $user_051->name='Ana Lilia	Ríos';
       $user_051->email='arios@sitwifi.com';
       $user_051->city='Cancún, México';
       $user_051->password= bcrypt('123456');
       $user_051->avatar= 'dist/img/user.jpg';
       $user_051->save();
       $user_051->assignRole($monitorRole);

       $user_052 = new User;
       $user_052->name='Alejandro	Rojas Páez';
       $user_052->email='arojas@sitwifi.com';
       $user_052->city='Cancún, México';
       $user_052->password= bcrypt('123456');
       $user_052->avatar= 'dist/img/user.jpg';
       $user_052->save();
       $user_052->assignRole($monitorRole);

       $user_053 = new User;
       $user_053->name='Berenice	de Jesús';
       $user_053->email='bdejesus@sitwifi.com';
       $user_053->city='Cancún, México';
       $user_053->password= bcrypt('123456');
       $user_053->avatar= 'dist/img/user.jpg';
       $user_053->save();
       $user_053->assignRole($monitorRole);

       $user_054 = new User;
       $user_054->name='Guadalupe	Margarito';
       $user_054->email='conta@sitwifi.com';
       $user_054->city='Cancún, México';
       $user_054->password= bcrypt('123456');
       $user_054->avatar= 'dist/img/user.jpg';
       $user_054->save();
       $user_054->assignRole($monitorRole);

       $user_055 = new User;
       $user_055->name='César	Sánchez';
       $user_055->email='csanchez@sitwifi.com';
       $user_055->city='Cancún, México';
       $user_055->password= bcrypt('123456');
       $user_055->avatar= 'dist/img/user.jpg';
       $user_055->save();
       $user_055->assignRole($monitorRole);

       $user_056 = new User;
       $user_056->name='Diana	Márquez';
       $user_056->email='dmarquez@sitwifi.com';
       $user_056->city='Cancún, México';
       $user_056->password= bcrypt('123456');
       $user_056->avatar= 'dist/img/user.jpg';
       $user_056->save();
       $user_056->assignRole($monitorRole);

       $user_057 = new User;
       $user_057->name='David	Santander Gallardo';
       $user_057->email='dsantander@sitwifi.com';
       $user_057->city='Cancún, México';
       $user_057->password= bcrypt('123456');
       $user_057->avatar= 'dist/img/user.jpg';
       $user_057->save();
       $user_057->assignRole($monitorRole);

       $user_058 = new User;
       $user_058->name='Elizabeth	López';
       $user_058->email='elopez@sitwifi.com';
       $user_058->city='Cancún, México';
       $user_058->password= bcrypt('123456');
       $user_058->avatar= 'dist/img/user.jpg';
       $user_058->save();
       $user_058->assignRole($monitorRole);

       $user_059 = new User;
       $user_059->name='Salvador Márquez';
       $user_059->email='smarquez@sitwifi.com';
       $user_059->city='Cancún, México';
       $user_059->password= bcrypt('123456');
       $user_059->avatar= 'dist/img/user.jpg';
       $user_059->save();
       $user_059->assignRole($monitorRole);

       $user_060 = new User;
       $user_060->name='Erick	Tamay';
       $user_060->email='etamay@sitwifi.com';
       $user_060->city='Cancún, México';
       $user_060->password= bcrypt('123456');
       $user_060->avatar= 'dist/img/user.jpg';
       $user_060->save();
       $user_060->assignRole($conciergeRole);

       $user_061 = new User;
       $user_061->name='Fernanda	Del Toro';
       $user_061->email='fdeltoro@sitwifi.com';
       $user_061->city='Cancún, México';
       $user_061->password= bcrypt('123456');
       $user_061->avatar= 'dist/img/user.jpg';
       $user_061->save();
       $user_061->assignRole($monitorRole);

       $user_062 = new User;
       $user_062->name='Gerardo	Martínez';
       $user_062->email='gmartinez@sitwifi.com';
       $user_062->city='Cancún, México';
       $user_062->password= bcrypt('123456');
       $user_062->avatar= 'dist/img/user.jpg';
       $user_062->save();
       $user_062->assignRole($monitorRole);

       $user_063 = new User;
       $user_063->name='Gabriel Omar	Rosas Castañon';
       $user_063->email='grosas@sitwifi.com';
       $user_063->city='Cancún, México';
       $user_063->password= bcrypt('123456');
       $user_063->avatar= 'dist/img/user.jpg';
       $user_063->save();
       $user_063->assignRole($monitorRole);

       $user_064 = new User;
       $user_064->name='Julio Ernesto	Díaz ';
       $user_064->email='jdiaz@sitwifi.com';
       $user_064->city='Cancún, México';
       $user_064->password= bcrypt('123456');
       $user_064->avatar= 'dist/img/user.jpg';
       $user_064->save();
       $user_064->assignRole($monitorRole);

       $user_065 = new User;
       $user_065->name='Jesús Alfredo	Galván González';
       $user_065->email='jgalvan@sitwifi.com';
       $user_065->city='Cancún, México';
       $user_065->password= bcrypt('123456');
       $user_065->avatar= 'dist/img/user.jpg';
       $user_065->save();
       $user_065->assignRole($monitorRole);

       $user_066 = new User;
       $user_066->name='José Juan	Gil';
       $user_066->email='jgil@sitwifi.com';
       $user_066->city='Cancún, México';
       $user_066->password= bcrypt('123456');
       $user_066->avatar= 'dist/img/user.jpg';
       $user_066->save();
       $user_066->assignRole($monitorRole);

       $user_067 = new User;
       $user_067->name='Jessica	González';
       $user_067->email='jgonzalez@sitwifi.com';
       $user_067->city='Cancún, México';
       $user_067->password= bcrypt('123456');
       $user_067->avatar= 'dist/img/user.jpg';
       $user_067->save();
       $user_067->assignRole($monitorRole);

       $user_068 = new User;
       $user_068->name='Rocío Jacqueline Ramírez Hernández';
       $user_068->email='jramirez@sitwifi.com';
       $user_068->city='Cancún, México';
       $user_068->password= bcrypt('123456');
       $user_068->avatar= 'dist/img/user.jpg';
       $user_068->save();
       $user_068->assignRole($monitorRole);

       $user_069 = new User;
       $user_069->name='Jonathan Vargas';
       $user_069->email='jvargas@sitwifi.com';
       $user_069->city='Cancún, México';
       $user_069->password= bcrypt('123456');
       $user_069->avatar= 'dist/img/user.jpg';
       $user_069->save();
       $user_069->assignRole($monitorRole);

       $user_070 = new User;
       $user_070->name='Javier Zambrano';
       $user_070->email='jzambrano@sitwifi.com';
       $user_070->city='Cancún, México';
       $user_070->password= bcrypt('123456');
       $user_070->avatar= 'dist/img/user.jpg';
       $user_070->save();
       $user_070->assignRole($monitorRole);

       $user_071 = new User;
       $user_071->name='Karina Sebastián';
       $user_071->email='ksebastian@sitwifi.com';
       $user_071->city='Cancún, México';
       $user_071->password= bcrypt('123456');
       $user_071->avatar= 'dist/img/user.jpg';
       $user_071->save();
       $user_071->assignRole($monitorRole);

       $user_072 = new User;
       $user_072->name='Lorena Castilla Badillo';
       $user_072->email='lcastilla@sitwifi.com';
       $user_072->city='Cancún, México';
       $user_072->password= bcrypt('123456');
       $user_072->avatar= 'dist/img/user.jpg';
       $user_072->save();
       $user_072->assignRole($monitorRole);

       $user_073 = new User;
       $user_073->name='Mauricio	Cárdenas';
       $user_073->email='mcardenas@sitwifi.com';
       $user_073->city='Cancún, México';
       $user_073->password= bcrypt('123456');
       $user_073->avatar= 'dist/img/user.jpg';
       $user_073->save();
       $user_073->assignRole($conciergeRole);

       $user_074 = new User;
       $user_074->name='Mizael Cienfuegoz';
       $user_074->email='mizael@sitwifi.com';
       $user_074->city='Cancún, México';
       $user_074->password= bcrypt('123456');
       $user_074->avatar= 'dist/img/user.jpg';
       $user_074->save();
       $user_074->assignRole($monitorRole);

       $user_075 = new User;
       $user_075->name='Mario Herón	Lara Suárez';
       $user_075->email='mlara@sitwifi.com';
       $user_075->city='Cancún, México';
       $user_075->password= bcrypt('123456');
       $user_075->avatar= 'dist/img/user.jpg';
       $user_075->save();
       $user_075->assignRole($monitorRole);

       $user_076 = new User;
       $user_076->name='Manuel Felipe	Moreno Fuentes';
       $user_076->email='mmoreno@sitwifi.com';
       $user_076->city='Cancún, México';
       $user_076->password= bcrypt('123456');
       $user_076->avatar= 'dist/img/user.jpg';
       $user_076->save();
       $user_076->assignRole($monitorRole);

       $user_077 = new User;
       $user_077->name='Mauricio Pacheco';
       $user_077->email='mpacheco@sitwifi.com';
       $user_077->city='Cancún, México';
       $user_077->password= bcrypt('123456');
       $user_077->avatar= 'dist/img/user.jpg';
       $user_077->save();
       $user_077->assignRole($monitorRole);

       $user_078 = new User;
       $user_078->name='María	Paniagua';
       $user_078->email='mpaniagua@sitwifi.com';
       $user_078->city='Cancún, México';
       $user_078->password= bcrypt('123456');
       $user_078->avatar= 'dist/img/user.jpg';
       $user_078->save();
       $user_078->assignRole($monitorRole);

       $user_079 = new User;
       $user_079->name='Marinaty Tagano';
       $user_079->email='mtagano@sitwifi.com';
       $user_079->city='Cancún, México';
       $user_079->password= bcrypt('123456');
       $user_079->avatar= 'dist/img/user.jpg';
       $user_079->save();
       $user_079->assignRole($monitorRole);

       $user_080 = new User;
       $user_080->name='Omar Flores';
       $user_080->email='oflores@sitwifi.com';
       $user_080->city='Cancún, México';
       $user_080->password= bcrypt('123456');
       $user_080->avatar= 'dist/img/user.jpg';
       $user_080->save();
       $user_080->assignRole($monitorRole);

       $user_081 = new User;
       $user_081->name='Omar López';
       $user_081->email='olopez@sitwifi.com';
       $user_081->city='Cancún, México';
       $user_081->password= bcrypt('123456');
       $user_081->avatar= 'dist/img/user.jpg';
       $user_081->save();
       $user_081->assignRole($monitorRole);

       $user_082 = new User;
       $user_082->name='Oliver Eduardo Olvera Carrillo';
       $user_082->email='oolvera@sitwifi.com';
       $user_082->city='Cancún, México';
       $user_082->password= bcrypt('123456');
       $user_082->avatar= 'dist/img/user.jpg';
       $user_082->save();
       $user_082->assignRole($monitorRole);

       $user_083 = new User;
       $user_083->name='Oscar	Sampedro';
       $user_083->email='osampedro@sitwifi.com';
       $user_083->city='Cancún, México';
       $user_083->password= bcrypt('123456');
       $user_083->avatar= 'dist/img/user.jpg';
       $user_083->save();
       $user_083->assignRole($monitorRole);

       $user_084 = new User;
       $user_084->name='Oscar	Velázquez';
       $user_084->email='ovelazquez@sitwifi.com';
       $user_084->city='Cancún, México';
       $user_084->password= bcrypt('123456');
       $user_084->avatar= 'dist/img/user.jpg';
       $user_084->save();
       $user_084->assignRole($monitorRole);

       $user_085 = new User;
       $user_085->name='Pavel Michel Delgado';
       $user_085->email='pavel@sitwifi.com';
       $user_085->city='Cancún, México';
       $user_085->password= bcrypt('123456');
       $user_085->avatar= 'dist/img/user.jpg';
       $user_085->save();
       $user_085->assignRole($monitorRole);

       $user_086 = new User;
       $user_086->name='Paola	García-Luna';
       $user_086->email='polagalu@sitwifi.com';
       $user_086->city='Cancún, México';
       $user_086->password= bcrypt('123456');
       $user_086->avatar= 'dist/img/user.jpg';
       $user_086->save();
       $user_086->assignRole($monitorRole);

       $user_087 = new User;
       $user_087->name='Philip Walker';
       $user_087->email='pwalker@sitwifi.com';
       $user_087->city='Cancún, México';
       $user_087->password= bcrypt('123456');
       $user_087->avatar= 'dist/img/user.jpg';
       $user_087->save();
       $user_087->assignRole($monitorRole);

      //  $user_089 = new User;
      //  $user_089->name='Luis Ramos';
      //  $user_089->email='proyectos3@sitwifi.com';
      //  $user_089->city='Cancún, México';
      //  $user_089->password= bcrypt('123456');
      //  $user_089->avatar= 'dist/img/user.jpg';
      //  $user_089->save();
      //  $user_089->assignRole($monitorRole);

      //  $user_090 = new User;
      //  $user_090->name='Víctor Abaunza';
      //  $user_090->email='proyectos@sitwifi.com';
      //  $user_090->city='Cancún, México';
      //  $user_090->password= bcrypt('123456');
      //  $user_090->avatar= 'dist/img/user.jpg';
      //  $user_090->save();
      //  $user_090->assignRole($monitorRole);

    //Clientes nps
       $surveyed_000 = new User;
       $surveyed_000->name='Francisco Zumaya (fzumaya)';
       $surveyed_000->email='fzumaya@aeropuertosgap.com.mx';
       $surveyed_000->password= bcrypt('543210');
       $surveyed_000->avatar= 'dist/img/user.jpg';
       $surveyed_000->save();
       $surveyed_000->assignRole($surveyedRole);

       $surveyed_001 = new User;
       $surveyed_001->name='Erick Enrique Jimenez (ejimenezv)';
       $surveyed_001->email='ejimenezv@aeropuertosgap.com.mx';
       $surveyed_001->password= bcrypt('543210');
       $surveyed_001->avatar= 'dist/img/user.jpg';
       $surveyed_001->save();
       $surveyed_001->assignRole($surveyedRole);

       $surveyed_002 = new User;
       $surveyed_002->name='Jorge Calderón (mmvazquezs)';
       $surveyed_002->email='mmvazquezs@liverpool.com.mx';
       $surveyed_002->password= bcrypt('543210');
       $surveyed_002->avatar= 'dist/img/user.jpg';
       $surveyed_002->save();
       $surveyed_002->assignRole($surveyedRole);

       $surveyed_003 = new User;
       $surveyed_003->name='Martha L. Calderon (mlcalderonq)';
       $surveyed_003->email='mlcalderonq@liverpool.com.mx';
       $surveyed_003->password= bcrypt('543210');
       $surveyed_003->avatar= 'dist/img/user.jpg';
       $surveyed_003->save();
       $surveyed_003->assignRole($surveyedRole);

       $surveyed_004 = new User;
       $surveyed_004->name='Alfredo Lopez  (alopezn)';
       $surveyed_004->email='alopezn@liverpool.com.mx';
       $surveyed_004->password= bcrypt('543210');
       $surveyed_004->avatar= 'dist/img/user.jpg';
       $surveyed_004->save();
       $surveyed_004->assignRole($surveyedRole);

       $surveyed_005 = new User;
       $surveyed_005->name='Ana Zepeda';
       $surveyed_005->email='ascepedav@liverpool.com.mx';
       $surveyed_005->password= bcrypt('543210');
       $surveyed_005->avatar= 'dist/img/user.jpg';
       $surveyed_005->save();
       $surveyed_005->assignRole($surveyedRole);

       $surveyed_006 = new User;
       $surveyed_006->name='Cristian Flores';
       $surveyed_006->email='cflores@azulbeachresort.com';
       $surveyed_006->password= bcrypt('543210');
       $surveyed_006->avatar= 'dist/img/user.jpg';
       $surveyed_006->save();
       $surveyed_006->assignRole($surveyedRole);

       $surveyed_007 = new User;
       $surveyed_007->name='Miguel Leyva';
       $surveyed_007->email='mleyva@azulsensatori.com';
       $surveyed_007->password= bcrypt('543210');
       $surveyed_007->avatar= 'dist/img/user.jpg';
       $surveyed_007->save();
       $surveyed_007->assignRole($surveyedRole);

       $surveyed_008 = new User;
       $surveyed_008->name='Robert Juárez';
       $surveyed_008->email='robert.juarez@oceanhotels.net';
       $surveyed_008->password= bcrypt('543210');
       $surveyed_008->avatar= 'dist/img/user.jpg';
       $surveyed_008->save();
       $surveyed_008->assignRole($surveyedRole);

       $surveyed_009 = new User;
       $surveyed_009->name='Felix Tapia';
       $surveyed_009->email='sistemas@hotelfontanixtapa.com';
       $surveyed_009->password= bcrypt('543210');
       $surveyed_009->avatar= 'dist/img/user.jpg';
       $surveyed_009->save();
       $surveyed_009->assignRole($surveyedRole);

       $surveyed_010 = new User;
       $surveyed_010->name='Antonio Rios';
       $surveyed_010->email='arios@hrhcancun.com';
       $surveyed_010->password= bcrypt('543210');
       $surveyed_010->avatar= 'dist/img/user.jpg';
       $surveyed_010->save();
       $surveyed_010->assignRole($surveyedRole);

       $surveyed_011 = new User;
       $surveyed_011->name='Yonathan Chalas';
       $surveyed_011->email='yonathan.chalas@melia.com';
       $surveyed_011->password= bcrypt('543210');
       $surveyed_011->avatar= 'dist/img/user.jpg';
       $surveyed_011->save();
       $surveyed_011->assignRole($surveyedRole);

       $surveyed_012 = new User;
       $surveyed_012->name='Mariana Sosa';
       $surveyed_012->email='okol@rivieramanagement.mx';
       $surveyed_012->password= bcrypt('543210');
       $surveyed_012->avatar= 'dist/img/user.jpg';
       $surveyed_012->save();
       $surveyed_012->assignRole($surveyedRole);

       $surveyed_013 = new User;
       $surveyed_013->name='Antonio Suárez';
       $surveyed_013->email='antonio.suarez@uneg.edu.mx';
       $surveyed_013->password= bcrypt('543210');
       $surveyed_013->avatar= 'dist/img/user.jpg';
       $surveyed_013->save();
       $surveyed_013->assignRole($surveyedRole);

       $surveyed_014 = new User;
       $surveyed_014->name='Rodrigo Sánchez';
       $surveyed_014->email='rodrigo.sanchez@universidadetac.edu.mx';
       $surveyed_014->password= bcrypt('543210');
       $surveyed_014->avatar= 'dist/img/user.jpg';
       $surveyed_014->save();
       $surveyed_014->assignRole($surveyedRole);

       $surveyed_015 = new User;
       $surveyed_015->name='Eder';
       $surveyed_015->email='ederj@lafloridastj.edu.mx';
       $surveyed_015->password= bcrypt('543210');
       $surveyed_015->avatar= 'dist/img/user.jpg';
       $surveyed_015->save();
       $surveyed_015->assignRole($surveyedRole);

       $surveyed_016 = new User;
       $surveyed_016->name='Oscar Vega';
       $surveyed_016->email='direccioncalidad@hostaldelaluz.mx';
       $surveyed_016->password= bcrypt('543210');
       $surveyed_016->avatar= 'dist/img/user.jpg';
       $surveyed_016->save();
       $surveyed_016->assignRole($surveyedRole);

       $surveyed_017 = new User;
       $surveyed_017->name='Joel García';
       $surveyed_017->email='sistemas@fourpointsmexicoroma.com';
       $surveyed_017->password= bcrypt('543210');
       $surveyed_017->avatar= 'dist/img/user.jpg';
       $surveyed_017->save();
       $surveyed_017->assignRole($surveyedRole);

       $surveyed_018 = new User;
       $surveyed_018->name='Eduardo Urzua';
       $surveyed_018->email='eduardo@rivieramanagement.mx';
       $surveyed_018->password= bcrypt('543210');
       $surveyed_018->avatar= 'dist/img/user.jpg';
       $surveyed_018->save();
       $surveyed_018->assignRole($surveyedRole);

       $surveyed_019 = new User;
       $surveyed_019->name='Guadalupe Constantino';
       $surveyed_019->email='g.constantino@iberostar.com.mx';
       $surveyed_019->password= bcrypt('543210');
       $surveyed_019->avatar= 'dist/img/user.jpg';
       $surveyed_019->save();
       $surveyed_019->assignRole($surveyedRole);

       $surveyed_020 = new User;
       $surveyed_020->name='Armando Pascual (it.cozumel)';
       $surveyed_020->email='it.cozumel@iberostar.com.mx';
       $surveyed_020->password= bcrypt('543210');
       $surveyed_020->avatar= 'dist/img/user.jpg';
       $surveyed_020->save();
       $surveyed_020->assignRole($surveyedRole);

       $surveyed_021 = new User;
       $surveyed_021->name='Alexis Márquez';
       $surveyed_021->email='gerencia@hotelbcozumel.com';
       $surveyed_021->password= bcrypt('543210');
       $surveyed_021->avatar= 'dist/img/user.jpg';
       $surveyed_021->save();
       $surveyed_021->assignRole($surveyedRole);

       $surveyed_022 = new User;
       $surveyed_022->name='Damián Domínguez';
       $surveyed_022->email='damian.dominguez@unea.edu.mx';
       $surveyed_022->password= bcrypt('543210');
       $surveyed_022->avatar= 'dist/img/user.jpg';
       $surveyed_022->save();
       $surveyed_022->assignRole($surveyedRole);

       $surveyed_023 = new User;
       $surveyed_023->name='Benito Hernandez';
       $surveyed_023->email='bhernandez@unla.edu.mx';
       $surveyed_023->password= bcrypt('543210');
       $surveyed_023->avatar= 'dist/img/user.jpg';
       $surveyed_023->save();
       $surveyed_023->assignRole($surveyedRole);

       $surveyed_024 = new User;
       $surveyed_024->name='Claudia Galindo';
       $surveyed_024->email='claudia.galindo@itesm.mx';
       $surveyed_024->password= bcrypt('543210');
       $surveyed_024->avatar= 'dist/img/user.jpg';
       $surveyed_024->save();
       $surveyed_024->assignRole($surveyedRole);

       $surveyed_025 = new User;
       $surveyed_025->name='César Mendoza';
       $surveyed_025->email='cmendoza@uvaq.edu.mx';
       $surveyed_025->password= bcrypt('543210');
       $surveyed_025->avatar= 'dist/img/user.jpg';
       $surveyed_025->save();
       $surveyed_025->assignRole($surveyedRole);

       $surveyed_026 = new User;
       $surveyed_026->name='Constanza Riveros';
       $surveyed_026->email='coni.r@numa.co';
       $surveyed_026->password= bcrypt('543210');
       $surveyed_026->avatar= 'dist/img/user.jpg';
       $surveyed_026->save();
       $surveyed_026->assignRole($surveyedRole);

       $surveyed_027 = new User;
       $surveyed_027->name='Karla González';
       $surveyed_027->email='mercadotecnia@galerias-pachuca.com';
       $surveyed_027->password= bcrypt('543210');
       $surveyed_027->avatar= 'dist/img/user.jpg';
       $surveyed_027->save();
       $surveyed_027->assignRole($surveyedRole);

       $surveyed_028 = new User;
       $surveyed_028->name='Rosy Salazar';
       $surveyed_028->email='resalazarv@liverpool.com.mx';
       $surveyed_028->password= bcrypt('543210');
       $surveyed_028->avatar= 'dist/img/user.jpg';
       $surveyed_028->save();
       $surveyed_028->assignRole($surveyedRole);

       $surveyed_029 = new User;
       $surveyed_029->name='Kenia García';
       $surveyed_029->email='kgarciah@liverpool.com.mx';
       $surveyed_029->password= bcrypt('543210');
       $surveyed_029->avatar= 'dist/img/user.jpg';
       $surveyed_029->save();
       $surveyed_029->assignRole($surveyedRole);

       $surveyed_030 = new User;
       $surveyed_030->name='Omar Torres / Alma Salinas ';
       $surveyed_030->email='acaotorres@oma.aero';
       $surveyed_030->password= bcrypt('543210');
       $surveyed_030->avatar= 'dist/img/user.jpg';
       $surveyed_030->save();
       $surveyed_030->assignRole($surveyedRole);

       $surveyed_031 = new User;
       $surveyed_031->name='Elvira Baca';
       $surveyed_031->email='cuuebaca@oma.aero';
       $surveyed_031->password= bcrypt('543210');
       $surveyed_031->avatar= 'dist/img/user.jpg';
       $surveyed_031->save();
       $surveyed_031->assignRole($surveyedRole);

       $surveyed_032 = new User;
       $surveyed_032->name='Wendy Holguin';
       $surveyed_032->email='cjswholguin@oma.aero';
       $surveyed_032->password= bcrypt('543210');
       $surveyed_032->avatar= 'dist/img/user.jpg';
       $surveyed_032->save();
       $surveyed_032->assignRole($surveyedRole);

       $surveyed_033 = new User;
       $surveyed_033->name='Sandra Rivera';
       $surveyed_033->email='zihsrivera@oma.aero';
       $surveyed_033->password= bcrypt('543210');
       $surveyed_033->avatar= 'dist/img/user.jpg';
       $surveyed_033->save();
       $surveyed_033->assignRole($surveyedRole);

       $surveyed_034 = new User;
       $surveyed_034->name='Julio Cesar Ovando';
       $surveyed_034->email='jovando@azulfiveshotel.com';
       $surveyed_034->password= bcrypt('543210');
       $surveyed_034->avatar= 'dist/img/user.jpg';
       $surveyed_034->save();
       $surveyed_034->assignRole($surveyedRole);

       $surveyed_035 = new User;
       $surveyed_035->name='Enrique Sosa';
       $surveyed_035->email='enrique.sosa@oceanhotels.net';
       $surveyed_035->password= bcrypt('543210');
       $surveyed_035->avatar= 'dist/img/user.jpg';
       $surveyed_035->save();
       $surveyed_035->assignRole($surveyedRole);

       $surveyed_036 = new User;
       $surveyed_036->name='Luis Trejo';
       $surveyed_036->email='ltrejo@sunset.com.mx';
       $surveyed_036->password= bcrypt('543210');
       $surveyed_036->avatar= 'dist/img/user.jpg';
       $surveyed_036->save();
       $surveyed_036->assignRole($surveyedRole);

       $surveyed_037 = new User;
       $surveyed_037->name='Hugo García / Yonathan Mendoza';
       $surveyed_037->email='sistemas.esmeralda3@buelbayresorts.com';
       $surveyed_037->password= bcrypt('543210');
       $surveyed_037->avatar= 'dist/img/user.jpg';
       $surveyed_037->save();
       $surveyed_037->assignRole($surveyedRole);

       $surveyed_038 = new User;
       $surveyed_038->name='Antonio Salinas';
       $surveyed_038->email='antonio.salinas@rosewoodhotels.com';
       $surveyed_038->password= bcrypt('543210');
       $surveyed_038->avatar= 'dist/img/user.jpg';
       $surveyed_038->save();
       $surveyed_038->assignRole($surveyedRole);

       $surveyed_039 = new User;
       $surveyed_039->name='Alejandra Dominguez';
       $surveyed_039->email='adominguezs@liverpool.com.mx';
       $surveyed_039->password= bcrypt('543210');
       $surveyed_039->avatar= 'dist/img/user.jpg';
       $surveyed_039->save();
       $surveyed_039->assignRole($surveyedRole);

       $surveyed_040 = new User;
       $surveyed_040->name='Elsa Viviana Gonzalez';
       $surveyed_040->email='evgonzaleze@liverpool.com.mx';
       $surveyed_040->password= bcrypt('543210');
       $surveyed_040->avatar= 'dist/img/user.jpg';
       $surveyed_040->save();
       $surveyed_040->assignRole($surveyedRole);

       $surveyed_041 = new User;
       $surveyed_041->name='Zoraya Cortés';
       $surveyed_041->email='mtyzcortes@oma.aero';
       $surveyed_041->password= bcrypt('543210');
       $surveyed_041->avatar= 'dist/img/user.jpg';
       $surveyed_041->save();
       $surveyed_041->assignRole($surveyedRole);

       $surveyed_042 = new User;
       $surveyed_042->name='Ariana Moreno';
       $surveyed_042->email='rexamoreno@oma.aero';
       $surveyed_042->password= bcrypt('543210');
       $surveyed_042->avatar= 'dist/img/user.jpg';
       $surveyed_042->save();
       $surveyed_042->assignRole($surveyedRole);

       $surveyed_043 = new User;
       $surveyed_043->name='Lourdes Medina';
       $surveyed_043->email='tamlmedina@oma.aero';
       $surveyed_043->password= bcrypt('543210');
       $surveyed_043->avatar= 'dist/img/user.jpg';
       $surveyed_043->save();
       $surveyed_043->assignRole($surveyedRole);

       $surveyed_044 = new User;
       $surveyed_044->name='Carlos Magaña';
       $surveyed_044->email='cmagana@altariacomercial.com.mx';
       $surveyed_044->password= bcrypt('543210');
       $surveyed_044->avatar= 'dist/img/user.jpg';
       $surveyed_044->save();
       $surveyed_044->assignRole($surveyedRole);

       $surveyed_045 = new User;
       $surveyed_045->name='Alicia López';
       $surveyed_045->email='aclopezr@liverpool.com.mx';
       $surveyed_045->password= bcrypt('543210');
       $surveyed_045->avatar= 'dist/img/user.jpg';
       $surveyed_045->save();
       $surveyed_045->assignRole($surveyedRole);

       $surveyed_046 = new User;
       $surveyed_046->name='Azul Maya';
       $surveyed_046->email='amayao@liverpool.com.mx';
       $surveyed_046->password= bcrypt('543210');
       $surveyed_046->avatar= 'dist/img/user.jpg';
       $surveyed_046->save();
       $surveyed_046->assignRole($surveyedRole);

       $surveyed_047 = new User;
       $surveyed_047->name='Martín Ortiz (mortiz)';
       $surveyed_047->email='mortiz@aeropuertosgap.com.mx';
       $surveyed_047->password= bcrypt('543210');
       $surveyed_047->avatar= 'dist/img/user.jpg';
       $surveyed_047->save();
       $surveyed_047->assignRole($surveyedRole);

       $surveyed_048 = new User;
       $surveyed_048->name='Javier  Rodriguez (jrodriguez)';
       $surveyed_048->email='jrodriguez@aeropuertosgap.com.mx';
       $surveyed_048->password= bcrypt('543210');
       $surveyed_048->avatar= 'dist/img/user.jpg';
       $surveyed_048->save();
       $surveyed_048->assignRole($surveyedRole);

       $surveyed_049 = new User;
       $surveyed_049->name='Victor Garcia (vigarcia)';
       $surveyed_049->email='vigarcia@aeropuertosgap.com.mx';
       $surveyed_049->password= bcrypt('543210');
       $surveyed_049->avatar= 'dist/img/user.jpg';
       $surveyed_049->save();
       $surveyed_049->assignRole($surveyedRole);

       $surveyed_050 = new User;
       $surveyed_050->name='Jose Luis Lopez (jlopezm)';
       $surveyed_050->email='jlopezm@aeropuertosgap.com.mx';
       $surveyed_050->password= bcrypt('543210');
       $surveyed_050->avatar= 'dist/img/user.jpg';
       $surveyed_050->save();
       $surveyed_050->assignRole($surveyedRole);

       $surveyed_051 = new User;
       $surveyed_051->name='Luz Silva';
       $surveyed_051->email='trclsilva@oma.aero';
       $surveyed_051->password= bcrypt('543210');
       $surveyed_051->avatar= 'dist/img/user.jpg';
       $surveyed_051->save();
       $surveyed_051->assignRole($surveyedRole);

       $surveyed_052 = new User;
       $surveyed_052->name='Clitlalitl Armienta';
       $surveyed_052->email='culcarmienta@oma.aero';
       $surveyed_052->password= bcrypt('543210');
       $surveyed_052->avatar= 'dist/img/user.jpg';
       $surveyed_052->save();
       $surveyed_052->assignRole($surveyedRole);

       $surveyed_053 = new User;
       $surveyed_053->name='Jovita Rodríguez';
       $surveyed_053->email='dgojrodriguez@oma.aero';
       $surveyed_053->password= bcrypt('543210');
       $surveyed_053->avatar= 'dist/img/user.jpg';
       $surveyed_053->save();
       $surveyed_053->assignRole($surveyedRole);

       $surveyed_054 = new User;
       $surveyed_054->name='Cecilia Fletes';
       $surveyed_054->email='mztcfletes@oma.aero';
       $surveyed_054->password= bcrypt('543210');
       $surveyed_054->avatar= 'dist/img/user.jpg';
       $surveyed_054->save();
       $surveyed_054->assignRole($surveyedRole);

       $surveyed_055 = new User;
       $surveyed_055->name='Nancy Márquez';
       $surveyed_055->email='zclnmarquez@oma.aero';
       $surveyed_055->password= bcrypt('543210');
       $surveyed_055->avatar= 'dist/img/user.jpg';
       $surveyed_055->save();
       $surveyed_055->assignRole($surveyedRole);

       $surveyed_056 = new User;
       $surveyed_056->name='André Rosas';
       $surveyed_056->email='oceandream.sup.frontdesk@gmail.com';
       $surveyed_056->password= bcrypt('543210');
       $surveyed_056->avatar= 'dist/img/user.jpg';
       $surveyed_056->save();
       $surveyed_056->assignRole($surveyedRole);

       $surveyed_057 = new User;
       $surveyed_057->name='Jaime Pérez Vazquez';
       $surveyed_057->email='j,perez@iberostar.com.mx';
       $surveyed_057->password= bcrypt('543210');
       $surveyed_057->avatar= 'dist/img/user.jpg';
       $surveyed_057->save();
       $surveyed_057->assignRole($surveyedRole);

       $surveyed_058 = new User;
       $surveyed_058->name='Héctor Aguilera';
       $surveyed_058->email='hector.aguilera@iberostar.com.mx';
       $surveyed_058->password= bcrypt('543210');
       $surveyed_058->avatar= 'dist/img/user.jpg';
       $surveyed_058->save();
       $surveyed_058->assignRole($surveyedRole);

       $surveyed_059 = new User;
       $surveyed_059->name='Martin Del Moral.';
       $surveyed_059->email='mdelmoral@bestday.com';
       $surveyed_059->password= bcrypt('543210');
       $surveyed_059->avatar= 'dist/img/user.jpg';
       $surveyed_059->save();
       $surveyed_059->assignRole($surveyedRole);

       $surveyed_060 = new User;
       $surveyed_060->name='Heriberto Martinez (hmartinez)';
       $surveyed_060->email='hmartinez@aeropuertosgap.com.mx';
       $surveyed_060->password= bcrypt('543210');
       $surveyed_060->avatar= 'dist/img/user.jpg';
       $surveyed_060->save();
       $surveyed_060->assignRole($surveyedRole);

       $surveyed_061 = new User;
       $surveyed_061->name='Salvador Vargas (svargar)';
       $surveyed_061->email='svargar@aeropuertosgap.com.mx';
       $surveyed_061->password= bcrypt('543210');
       $surveyed_061->avatar= 'dist/img/user.jpg';
       $surveyed_061->save();
       $surveyed_061->assignRole($surveyedRole);

       $surveyed_062 = new User;
       $surveyed_062->name='Virginia Guzmán';
       $surveyed_062->email='slpvguzman@oma.aero';
       $surveyed_062->password= bcrypt('543210');
       $surveyed_062->avatar= 'dist/img/user.jpg';
       $surveyed_062->save();
       $surveyed_062->assignRole($surveyedRole);

       $surveyed_063 = new User;
       $surveyed_063->name='Armando Ruiz';
       $surveyed_063->email='aruiz@aryba.com.mx';
       $surveyed_063->password= bcrypt('543210');
       $surveyed_063->avatar= 'dist/img/user.jpg';
       $surveyed_063->save();
       $surveyed_063->assignRole($surveyedRole);

       $surveyed_064 = new User;
       $surveyed_064->name='Flor del Rocio Martínez';
       $surveyed_064->email='frmartinezj@liverpool.com.mx';
       $surveyed_064->password= bcrypt('543210');
       $surveyed_064->avatar= 'dist/img/user.jpg';
       $surveyed_064->save();
       $surveyed_064->assignRole($surveyedRole);

       $surveyed_065 = new User;
       $surveyed_065->name='Paulina Hernández';
       $surveyed_065->email='pehernandez@liverpool.com.mx';
       $surveyed_065->password= bcrypt('543210');
       $surveyed_065->avatar= 'dist/img/user.jpg';
       $surveyed_065->save();
       $surveyed_065->assignRole($surveyedRole);

       $surveyed_066 = new User;
       $surveyed_066->name='Jessica González';
       $surveyed_066->email='jgonzalezd01@liverpool.com.mx';
       $surveyed_066->password= bcrypt('543210');
       $surveyed_066->avatar= 'dist/img/user.jpg';
       $surveyed_066->save();
       $surveyed_066->assignRole($surveyedRole);

       $surveyed_067 = new User;
       $surveyed_067->name='David Ayala';
       $surveyed_067->email='dayala@aryba.com.mx';
       $surveyed_067->password= bcrypt('543210');
       $surveyed_067->avatar= 'dist/img/user.jpg';
       $surveyed_067->save();
       $surveyed_067->assignRole($surveyedRole);

       $surveyed_068 = new User;
       $surveyed_068->name='Amalia Martinez';
       $surveyed_068->email='amartinezj01@liverpool.com.mx';
       $surveyed_068->password= bcrypt('543210');
       $surveyed_068->avatar= 'dist/img/user.jpg';
       $surveyed_068->save();
       $surveyed_068->assignRole($surveyedRole);

       $surveyed_069 = new User;
       $surveyed_069->name='Monserrat Sánchez';
       $surveyed_069->email='msanchezy@liverpool.com.mx';
       $surveyed_069->password= bcrypt('543210');
       $surveyed_069->avatar= 'dist/img/user.jpg';
       $surveyed_069->save();
       $surveyed_069->assignRole($surveyedRole);

       $surveyed_070 = new User;
       $surveyed_070->name='Lizette Montaño';
       $surveyed_070->email='almontanob@liverpool.com.mx';
       $surveyed_070->password= bcrypt('543210');
       $surveyed_070->avatar= 'dist/img/user.jpg';
       $surveyed_070->save();
       $surveyed_070->assignRole($surveyedRole);

       $surveyed_071 = new User;
       $surveyed_071->name='Palmira Gamboa';
       $surveyed_071->email='pgamboal@liverpool.com.mx';
       $surveyed_071->password= bcrypt('543210');
       $surveyed_071->avatar= 'dist/img/user.jpg';
       $surveyed_071->save();
       $surveyed_071->assignRole($surveyedRole);

       $surveyed_072 = new User;
       $surveyed_072->name='Angélica Sánchez';
       $surveyed_072->email='angelica.sanchez@copri.com.mx';
       $surveyed_072->password= bcrypt('543210');
       $surveyed_072->avatar= 'dist/img/user.jpg';
       $surveyed_072->save();
       $surveyed_072->assignRole($surveyedRole);

       $surveyed_073 = new User;
       $surveyed_073->name='Karla González / Ezequiel Carrillo ';
       $surveyed_073->email='gte_universidad@fibrauno.mx';
       $surveyed_073->password= bcrypt('543210');
       $surveyed_073->avatar= 'dist/img/user.jpg';
       $surveyed_073->save();
       $surveyed_073->assignRole($surveyedRole);

       $surveyed_074 = new User;
       $surveyed_074->name='Silvia Bocanegra';
       $surveyed_074->email='sbocanegra@oasiscoyoacan.com';
       $surveyed_074->password= bcrypt('543210');
       $surveyed_074->avatar= 'dist/img/user.jpg';
       $surveyed_074->save();
       $surveyed_074->assignRole($surveyedRole);

       $surveyed_075 = new User;
       $surveyed_075->name='Blanca Gomez Lomelí';
       $surveyed_075->email='bpgomezl@liverpool.com.mx';
       $surveyed_075->password= bcrypt('543210');
       $surveyed_075->avatar= 'dist/img/user.jpg';
       $surveyed_075->save();
       $surveyed_075->assignRole($surveyedRole);

       $surveyed_076 = new User;
       $surveyed_076->name='Rubén Mora';
       $surveyed_076->email='rmoram@innovacionydiseno.com.mx';
       $surveyed_076->password= bcrypt('543210');
       $surveyed_076->avatar= 'dist/img/user.jpg';
       $surveyed_076->save();
       $surveyed_076->assignRole($surveyedRole);

       $surveyed_077 = new User;
       $surveyed_077->name='Francisco González';
       $surveyed_077->email='francisco.gonzalez@playaresorts.com';
       $surveyed_077->password= bcrypt('543210');
       $surveyed_077->avatar= 'dist/img/user.jpg';
       $surveyed_077->save();
       $surveyed_077->assignRole($surveyedRole);

       $surveyed_078 = new User;
       $surveyed_078->name='Omar Caballero / Juan Carlos  Tolentino';
       $surveyed_078->email='ocaballero@eldoradoseasidesuites.com.mx';
       $surveyed_078->password= bcrypt('543210');
       $surveyed_078->avatar= 'dist/img/user.jpg';
       $surveyed_078->save();
       $surveyed_078->assignRole($surveyedRole);

       $surveyed_079 = new User;
       $surveyed_079->name='Carlos Pech';
       $surveyed_079->email='cpech@unicohotelrm.com';
       $surveyed_079->password= bcrypt('543210');
       $surveyed_079->avatar= 'dist/img/user.jpg';
       $surveyed_079->save();
       $surveyed_079->assignRole($surveyedRole);

       $surveyed_080 = new User;
       $surveyed_080->name='Octavio Valenzuela';
       $surveyed_080->email='ovalenzuela@sirenishotels.com';
       $surveyed_080->password= bcrypt('543210');
       $surveyed_080->avatar= 'dist/img/user.jpg';
       $surveyed_080->save();
       $surveyed_080->assignRole($surveyedRole);

       $surveyed_081 = new User;
       $surveyed_081->name='Enrique Camacho';
       $surveyed_081->email='ecamacho@parnassusresorts.com';
       $surveyed_081->password= bcrypt('543210');
       $surveyed_081->avatar= 'dist/img/user.jpg';
       $surveyed_081->save();
       $surveyed_081->assignRole($surveyedRole);

       $surveyed_082 = new User;
       $surveyed_082->name='Ulises Nuñez';
       $surveyed_082->email='ununez@hrhrivieramaya.com';
       $surveyed_082->password= bcrypt('543210');
       $surveyed_082->avatar= 'dist/img/user.jpg';
       $surveyed_082->save();
       $surveyed_082->assignRole($surveyedRole);

       $surveyed_083 = new User;
       $surveyed_083->name='Melina Martinez';
       $surveyed_083->email='gmmartineze@liverpool.com.mx';
       $surveyed_083->password= bcrypt('543210');
       $surveyed_083->avatar= 'dist/img/user.jpg';
       $surveyed_083->save();
       $surveyed_083->assignRole($surveyedRole);

       $surveyed_084 = new User;
       $surveyed_084->name='Ingrid Kaiser';
       $surveyed_084->email='ikaisero@liverpool.com.mx';
       $surveyed_084->password= bcrypt('543210');
       $surveyed_084->avatar= 'dist/img/user.jpg';
       $surveyed_084->save();
       $surveyed_084->assignRole($surveyedRole);

       $surveyed_085 = new User;
       $surveyed_085->name='Daniela Eli Diaz';
       $surveyed_085->email='dediazv@liverpool.com.mx';
       $surveyed_085->password= bcrypt('543210');
       $surveyed_085->avatar= 'dist/img/user.jpg';
       $surveyed_085->save();
       $surveyed_085->assignRole($surveyedRole);

       $surveyed_086 = new User;
       $surveyed_086->name='Luis Vizcaino';
       $surveyed_086->email='lvizcaino@sirenishotels.com';
       $surveyed_086->password= bcrypt('543210');
       $surveyed_086->avatar= 'dist/img/user.jpg';
       $surveyed_086->save();
       $surveyed_086->assignRole($surveyedRole);

       $surveyed_087 = new User;
       $surveyed_087->name='Juan Ciriaco';
       $surveyed_087->email='jciriaco@hrhcpuntacana.com';
       $surveyed_087->password= bcrypt('543210');
       $surveyed_087->avatar= 'dist/img/user.jpg';
       $surveyed_087->save();
       $surveyed_087->assignRole($surveyedRole);

       $surveyed_088 = new User;
       $surveyed_088->name='Guillermo Ojeda';
       $surveyed_088->email='sistemas@grandsirenismatlali.com';
       $surveyed_088->password= bcrypt('543210');
       $surveyed_088->avatar= 'dist/img/user.jpg';
       $surveyed_088->save();
       $surveyed_088->assignRole($surveyedRole);

       $surveyed_089 = new User;
       $surveyed_089->name='Edwgar Zarate';
       $surveyed_089->email='ezarate@hrhvallarta.com';
       $surveyed_089->password= bcrypt('543210');
       $surveyed_089->avatar= 'dist/img/user.jpg';
       $surveyed_089->save();
       $surveyed_089->assignRole($surveyedRole);

       $surveyed_090 = new User;
       $surveyed_090->name='Marco Cauich';
       $surveyed_090->email='mcauich@eldoradoroyale.com.mx';
       $surveyed_090->password= bcrypt('543210');
       $surveyed_090->avatar= 'dist/img/user.jpg';
       $surveyed_090->save();
       $surveyed_090->assignRole($surveyedRole);

       $surveyed_091 = new User;
       $surveyed_091->name='Jhonny Tun';
       $surveyed_091->email='jtun@eldoradomaroma.com';
       $surveyed_091->password= bcrypt('543210');
       $surveyed_091->avatar= 'dist/img/user.jpg';
       $surveyed_091->save();
       $surveyed_091->assignRole($surveyedRole);

       $surveyed_092 = new User;
       $surveyed_092->name='Gaby Rojas';
       $surveyed_092->email='gabriela@wrk.com.mx';
       $surveyed_092->password= bcrypt('543210');
       $surveyed_092->avatar= 'dist/img/user.jpg';
       $surveyed_092->save();
       $surveyed_092->assignRole($surveyedRole);

       $surveyed_093 = new User;
       $surveyed_093->name='Tomás Rios';
       $surveyed_093->email='soporte.uvg@uvg.edu.mx';
       $surveyed_093->password= bcrypt('543210');
       $surveyed_093->avatar= 'dist/img/user.jpg';
       $surveyed_093->save();
       $surveyed_093->assignRole($surveyedRole);

       $surveyed_094 = new User;
       $surveyed_094->name='Kevin Cabrera';
       $surveyed_094->email='kevin.cabrera@universidadetac.edu.mx';
       $surveyed_094->password= bcrypt('543210');
       $surveyed_094->avatar= 'dist/img/user.jpg';
       $surveyed_094->save();
       $surveyed_094->assignRole($surveyedRole);

       $surveyed_095 = new User;
       $surveyed_095->name='Edwin Carranza';
       $surveyed_095->email='edwin.carranza@universidadetac.edu.mx';
       $surveyed_095->password= bcrypt('543210');
       $surveyed_095->avatar= 'dist/img/user.jpg';
       $surveyed_095->save();
       $surveyed_095->assignRole($surveyedRole);

       $surveyed_096 = new User;
       $surveyed_096->name='Jesica Alcalá';
       $surveyed_096->email='jalcala@nuevocontinente.edu.mx';
       $surveyed_096->password= bcrypt('543210');
       $surveyed_096->avatar= 'dist/img/user.jpg';
       $surveyed_096->save();
       $surveyed_096->assignRole($surveyedRole);

       $surveyed_097 = new User;
       $surveyed_097->name='Alejandra Jiménez';
       $surveyed_097->email='a.jimenez@colegioxford.edu.mx';
       $surveyed_097->password= bcrypt('543210');
       $surveyed_097->avatar= 'dist/img/user.jpg';
       $surveyed_097->save();
       $surveyed_097->assignRole($surveyedRole);

       $surveyed_098 = new User;
       $surveyed_098->name='Gerardo Castilla';
       $surveyed_098->email='gcastilla@oxfordmexicomasc.com';
       $surveyed_098->password= bcrypt('543210');
       $surveyed_098->avatar= 'dist/img/user.jpg';
       $surveyed_098->save();
       $surveyed_098->assignRole($surveyedRole);

       $surveyed_099 = new User;
       $surveyed_099->name='Andres Tejeda';
       $surveyed_099->email='atejeda@cancunbayresort.com';
       $surveyed_099->password= bcrypt('543210');
       $surveyed_099->avatar= 'dist/img/user.jpg';
       $surveyed_099->save();
       $surveyed_099->assignRole($surveyedRole);

       $surveyed_100 = new User;
       $surveyed_100->name='Julio Carillo';
       $surveyed_100->email='sstt.aluxes@privilegehotels.com';
       $surveyed_100->password= bcrypt('543210');
       $surveyed_100->avatar= 'dist/img/user.jpg';
       $surveyed_100->save();
       $surveyed_100->assignRole($surveyedRole);

       $surveyed_101 = new User;
       $surveyed_101->name='Ricardo Javier Pech Pech';
       $surveyed_101->email='sistemas@izlahotel.com';
       $surveyed_101->password= bcrypt('543210');
       $surveyed_101->avatar= 'dist/img/user.jpg';
       $surveyed_101->save();
       $surveyed_101->assignRole($surveyedRole);

       $surveyed_102 = new User;
       $surveyed_102->name='Oscar Condado';
       $surveyed_102->email='sistemas@aquamarinabeach.com';
       $surveyed_102->password= bcrypt('543210');
       $surveyed_102->avatar= 'dist/img/user.jpg';
       $surveyed_102->save();
       $surveyed_102->assignRole($surveyedRole);

       $surveyed_103 = new User;
       $surveyed_103->name='Fredy Tun';
       $surveyed_103->email='sistemas@nyxhotels.com';
       $surveyed_103->password= bcrypt('543210');
       $surveyed_103->avatar= 'dist/img/user.jpg';
       $surveyed_103->save();
       $surveyed_103->assignRole($surveyedRole);

       $surveyed_104 = new User;
       $surveyed_104->name=' Jorge Pereira';
       $surveyed_104->email='jpereira@ixco.com.mx';
       $surveyed_104->password= bcrypt('543210');
       $surveyed_104->avatar= 'dist/img/user.jpg';
       $surveyed_104->save();
       $surveyed_104->assignRole($surveyedRole);

       $surveyed_105 = new User;
       $surveyed_105->name='Jaime Arrieta';
       $surveyed_105->email='sistemas@parnassusresorts.com.mx';
       $surveyed_105->password= bcrypt('543210');
       $surveyed_105->avatar= 'dist/img/user.jpg';
       $surveyed_105->save();
       $surveyed_105->assignRole($surveyedRole);

       $surveyed_106 = new User;
       $surveyed_106->name='Luis Orozco';
       $surveyed_106->email='luis.orozco@kidzania.com';
       $surveyed_106->password= bcrypt('543210');
       $surveyed_106->avatar= 'dist/img/user.jpg';
       $surveyed_106->save();
       $surveyed_106->assignRole($surveyedRole);

       $surveyed_107 = new User;
       $surveyed_107->name='Gonzalo Izaguirre';
       $surveyed_107->email='gizaguirre@realresorts.com';
       $surveyed_107->password= bcrypt('543210');
       $surveyed_107->avatar= 'dist/img/user.jpg';
       $surveyed_107->save();
       $surveyed_107->assignRole($surveyedRole);

       $surveyed_108 = new User;
       $surveyed_108->name='Freddy Velázquez';
       $surveyed_108->email='fvelazquez@experienciasxcaret.com.mx';
       $surveyed_108->password= bcrypt('543210');
       $surveyed_108->avatar= 'dist/img/user.jpg';
       $surveyed_108->save();
       $surveyed_108->assignRole($surveyedRole);

       $surveyed_109 = new User;
       $surveyed_109->name='Abel Suarez';
       $surveyed_109->email='ba.suarez@ebc.edu.mx';
       $surveyed_109->password= bcrypt('543210');
       $surveyed_109->avatar= 'dist/img/user.jpg';
       $surveyed_109->save();
       $surveyed_109->assignRole($surveyedRole);

       $surveyed_110 = new User;
       $surveyed_110->name='Hector Gómez';
       $surveyed_110->email='hrgomez@itesm.mx';
       $surveyed_110->password= bcrypt('543210');
       $surveyed_110->avatar= 'dist/img/user.jpg';
       $surveyed_110->save();
       $surveyed_110->assignRole($surveyedRole);

       $surveyed_111 = new User;
       $surveyed_111->name='Aldo Toledo';
       $surveyed_111->email='aldo.toledo@uvg.edu.mx';
       $surveyed_111->password= bcrypt('543210');
       $surveyed_111->avatar= 'dist/img/user.jpg';
       $surveyed_111->save();
       $surveyed_111->assignRole($surveyedRole);

       $surveyed_112 = new User;
       $surveyed_112->name='Santos Ortiz';
       $surveyed_112->email='isc.santos11@gmail.com';
       $surveyed_112->password= bcrypt('543210');
       $surveyed_112->avatar= 'dist/img/user.jpg';
       $surveyed_112->save();
       $surveyed_112->assignRole($surveyedRole);

       $surveyed_113 = new User;
       $surveyed_113->name='Alberto Sánchez';
       $surveyed_113->email='asanchezo@unea.edu.mx';
       $surveyed_113->password= bcrypt('543210');
       $surveyed_113->avatar= 'dist/img/user.jpg';
       $surveyed_113->save();
       $surveyed_113->assignRole($surveyedRole);

       $surveyed_114 = new User;
       $surveyed_114->name='Rodrigo Gutierrez o Fred';
       $surveyed_114->email='rodrigo.gutierrez@universidadlaconcordia.edu.mx';
       $surveyed_114->password= bcrypt('543210');
       $surveyed_114->avatar= 'dist/img/user.jpg';
       $surveyed_114->save();
       $surveyed_114->assignRole($surveyedRole);

       $surveyed_115 = new User;
       $surveyed_115->name='Ernesto Moncivais';
       $surveyed_115->email='emoncivais@utan.edu.mx';
       $surveyed_115->password= bcrypt('543210');
       $surveyed_115->avatar= 'dist/img/user.jpg';
       $surveyed_115->save();
       $surveyed_115->assignRole($surveyedRole);

       $surveyed_116 = new User;
       $surveyed_116->name='Luis Enrique Monreal (lmonreal) ';
       $surveyed_116->email='lmonreal@utan.edu.mx';
       $surveyed_116->password= bcrypt('543210');
       $surveyed_116->avatar= 'dist/img/user.jpg';
       $surveyed_116->save();
       $surveyed_116->assignRole($surveyedRole);

       $surveyed_117 = new User;
       $surveyed_117->name='Héctor Romero';
       $surveyed_117->email='hromero@utan.edu.mx';
       $surveyed_117->password= bcrypt('543210');
       $surveyed_117->avatar= 'dist/img/user.jpg';
       $surveyed_117->save();
       $surveyed_117->assignRole($surveyedRole);

       $surveyed_118 = new User;
       $surveyed_118->name='Jose Luis Maqueda';
       $surveyed_118->email='jmaqueda@utan.edu.mx';
       $surveyed_118->password= bcrypt('543210');
       $surveyed_118->avatar= 'dist/img/user.jpg';
       $surveyed_118->save();
       $surveyed_118->assignRole($surveyedRole);

       $surveyed_119 = new User;
       $surveyed_119->name='Lorena Irigoyen';
       $surveyed_119->email='lirigoyen@colegioamericano-sonora.com';
       $surveyed_119->password= bcrypt('543210');
       $surveyed_119->avatar= 'dist/img/user.jpg';
       $surveyed_119->save();
       $surveyed_119->assignRole($surveyedRole);

       $surveyed_120 = new User;
       $surveyed_120->name='Lidia Paola Borbolla (lborbolla)';
       $surveyed_120->email='lborbolla@aeropuertosgap.com.mx';
       $surveyed_120->password= bcrypt('543210');
       $surveyed_120->avatar= 'dist/img/user.jpg';
       $surveyed_120->save();
       $surveyed_120->assignRole($surveyedRole);

       $surveyed_121 = new User;
       $surveyed_121->name='Jonas Leonel Urias (lurias)';
       $surveyed_121->email='lurias@aeropuertosgap.com.mx';
       $surveyed_121->password= bcrypt('543210');
       $surveyed_121->avatar= 'dist/img/user.jpg';
       $surveyed_121->save();
       $surveyed_121->assignRole($surveyedRole);

       $surveyed_122 = new User;
       $surveyed_122->name='Edgar Rivera';
       $surveyed_122->email='eriverao@aeropuertosgap.com.mx';
       $surveyed_122->password= bcrypt('543210');
       $surveyed_122->avatar= 'dist/img/user.jpg';
       $surveyed_122->save();
       $surveyed_122->assignRole($surveyedRole);

       $surveyed_123 = new User;
       $surveyed_123->name='Julio Cesar García';
       $surveyed_123->email='julio.garcia@universidadetac.edu.mx';
       $surveyed_123->password= bcrypt('543210');
       $surveyed_123->avatar= 'dist/img/user.jpg';
       $surveyed_123->save();
       $surveyed_123->assignRole($surveyedRole);

       $surveyed_124 = new User;
       $surveyed_124->name='Salvador Ayala';
       $surveyed_124->email='sayala@udla.mx';
       $surveyed_124->password= bcrypt('543210');
       $surveyed_124->avatar= 'dist/img/user.jpg';
       $surveyed_124->save();
       $surveyed_124->assignRole($surveyedRole);




    //Permisos para super admin
       //Usuario Desarrollo
       //- Dashboard
       $user_default_0->givePermissionTo('View dashboard pral');
       //- Inventario
       $user_default_0->givePermissionTo('View detailed for hotel');
       $user_default_0->givePermissionTo('View detailed for proyect');
       $user_default_0->givePermissionTo('View cover');
       $user_default_0->givePermissionTo('View distribucion');
       //- Equipos
       $user_default_0->givePermissionTo('View add equipment');
       $user_default_0->givePermissionTo('Create equipment');
       $user_default_0->givePermissionTo('View removed equipment');
       $user_default_0->givePermissionTo('Removed equipment');
       $user_default_0->givePermissionTo('View search equipment');
       $user_default_0->givePermissionTo('View move equipment');
       $user_default_0->givePermissionTo('Move equipment');
       $user_default_0->givePermissionTo('View equipment group');
       $user_default_0->givePermissionTo('Add equipment group');
       $user_default_0->givePermissionTo('Removed equipment group');
       $user_default_0->givePermissionTo('View provider');
       $user_default_0->givePermissionTo('Create provider');
       $user_default_0->givePermissionTo('Edit provider');
       $user_default_0->givePermissionTo('Delete provider');
       //- Reportes
       $user_default_0->givePermissionTo('View assign report');
       $user_default_0->givePermissionTo('Create assign report');
       $user_default_0->givePermissionTo('Edit assign report');
       $user_default_0->givePermissionTo('Delete assign report');

       $user_default_0->givePermissionTo('Create general report');
       $user_default_0->givePermissionTo('View individual capture');
       $user_default_0->givePermissionTo('Create individual capture');
       $user_default_0->givePermissionTo('View individual general report');
       $user_default_0->givePermissionTo('Edit individual general report');
       $user_default_0->givePermissionTo('View concierge approval');
       $user_default_0->givePermissionTo('Create concierge approval');
       $user_default_0->givePermissionTo('Delete concierge approval');
       $user_default_0->givePermissionTo('View admin approval');
       $user_default_0->givePermissionTo('Option admin approval');
       $user_default_0->givePermissionTo('Notification admin approval');
       $user_default_0->givePermissionTo('View report');
       $user_default_0->givePermissionTo('View report concat');
       //Calificaciones
       $user_default_0->givePermissionTo('View dashboard survey nps');
       $user_default_0->givePermissionTo('View create survey');
       $user_default_0->givePermissionTo('Generate survey');
       $user_default_0->givePermissionTo('View capture survey');
       $user_default_0->givePermissionTo('Create survey');
       $user_default_0->givePermissionTo('View edit survey');
       $user_default_0->givePermissionTo('Edit survey');
       $user_default_0->givePermissionTo('View results survey');
       $user_default_0->givePermissionTo('View survey configuration');
       $user_default_0->givePermissionTo('Assign user survey');
       $user_default_0->givePermissionTo('Removed user survey');
       $user_default_0->givePermissionTo('Generate key user survey');
       $user_default_0->givePermissionTo('Send email user survey');
       $user_default_0->givePermissionTo('View key user survey');
       $user_default_0->givePermissionTo('View survey nps configuration');
       //NPS
       $user_default_0->givePermissionTo('View assign hotel user');
       $user_default_0->givePermissionTo('Create assign hotel user');
       $user_default_0->givePermissionTo('Delete assign hotel user');
       $user_default_0->givePermissionTo('View list assign hotel user');
       $user_default_0->givePermissionTo('View assign delete client');
       $user_default_0->givePermissionTo('View config nps automatic');
       $user_default_0->givePermissionTo('Create config nps automatic');
       $user_default_0->givePermissionTo('View config nps individual');
       $user_default_0->givePermissionTo('Create config nps individual');
       //-Encuesta Sitwifi
       $user_default_0->givePermissionTo('View dashboard sitwifi');
       $user_default_0->givePermissionTo('View config sitwifi');
       $user_default_0->givePermissionTo('Delete config sitwifi');
       $user_default_0->givePermissionTo('Send mail sitwifi');
       //- Herramientas
       $user_default_0->givePermissionTo('View guest review');
       $user_default_0->givePermissionTo('View server review');
       $user_default_0->givePermissionTo('View test zd');
       //- Configuración
       $user_default_0->givePermissionTo('Create user');
       $user_default_0->givePermissionTo('Edit user');
       $user_default_0->givePermissionTo('Delete user');
       $user_default_0->givePermissionTo('View Configuration');
       $user_default_0->givePermissionTo('Edit Configuration');

       //Usuario Desarrollo- Alonso
       //- Dashboard
       $super_admin_a1->givePermissionTo('View dashboard pral');
       //- Inventario
       $super_admin_a1->givePermissionTo('View detailed for hotel');
       $super_admin_a1->givePermissionTo('View detailed for proyect');
       $super_admin_a1->givePermissionTo('View cover');
       $super_admin_a1->givePermissionTo('View distribucion');
       //- Equipos
       $super_admin_a1->givePermissionTo('View add equipment');
       $super_admin_a1->givePermissionTo('Create equipment');
       $super_admin_a1->givePermissionTo('View removed equipment');
       $super_admin_a1->givePermissionTo('Removed equipment');
       $super_admin_a1->givePermissionTo('View search equipment');
       $super_admin_a1->givePermissionTo('View move equipment');
       $super_admin_a1->givePermissionTo('Move equipment');
       $super_admin_a1->givePermissionTo('View equipment group');
       $super_admin_a1->givePermissionTo('Add equipment group');
       $super_admin_a1->givePermissionTo('Removed equipment group');
       $super_admin_a1->givePermissionTo('View provider');
       $super_admin_a1->givePermissionTo('Create provider');
       $super_admin_a1->givePermissionTo('Edit provider');
       $super_admin_a1->givePermissionTo('Delete provider');
       //- Reportes
       $super_admin_a1->givePermissionTo('View assign report');
       $super_admin_a1->givePermissionTo('Create assign report');
       $super_admin_a1->givePermissionTo('Edit assign report');
       $super_admin_a1->givePermissionTo('Delete assign report');
       $super_admin_a1->givePermissionTo('Create general report');
       $super_admin_a1->givePermissionTo('View individual capture');
       $super_admin_a1->givePermissionTo('Create individual capture');
       $super_admin_a1->givePermissionTo('View individual general report');
       $super_admin_a1->givePermissionTo('Edit individual general report');
       $super_admin_a1->givePermissionTo('View concierge approval');
       $super_admin_a1->givePermissionTo('Create concierge approval');
       $super_admin_a1->givePermissionTo('Delete concierge approval');
       $super_admin_a1->givePermissionTo('View admin approval');
       $super_admin_a1->givePermissionTo('Option admin approval');
       $super_admin_a1->givePermissionTo('Notification admin approval');
       $super_admin_a1->givePermissionTo('View report');
       $super_admin_a1->givePermissionTo('View report concat');
       //Calificaciones
       $super_admin_a1->givePermissionTo('View dashboard survey nps');
       $super_admin_a1->givePermissionTo('View create survey');
       $super_admin_a1->givePermissionTo('Generate survey');
       $super_admin_a1->givePermissionTo('View capture survey');
       $super_admin_a1->givePermissionTo('Create survey');
       $super_admin_a1->givePermissionTo('View edit survey');
       $super_admin_a1->givePermissionTo('Edit survey');
       $super_admin_a1->givePermissionTo('View results survey');
       $super_admin_a1->givePermissionTo('View survey configuration');
       $super_admin_a1->givePermissionTo('Assign user survey');
       $super_admin_a1->givePermissionTo('Removed user survey');
       $super_admin_a1->givePermissionTo('Generate key user survey');
       $super_admin_a1->givePermissionTo('Send email user survey');
       $super_admin_a1->givePermissionTo('View key user survey');
       $super_admin_a1->givePermissionTo('View survey nps configuration');
       //NPS
       $super_admin_a1->givePermissionTo('View assign hotel user');
       $super_admin_a1->givePermissionTo('Create assign hotel user');
       $super_admin_a1->givePermissionTo('Delete assign hotel user');
       $super_admin_a1->givePermissionTo('View list assign hotel user');
       $super_admin_a1->givePermissionTo('View assign delete client');
       $super_admin_a1->givePermissionTo('View config nps automatic');
       $super_admin_a1->givePermissionTo('Create config nps automatic');
       $super_admin_a1->givePermissionTo('View config nps individual');
       $super_admin_a1->givePermissionTo('Create config nps individual');
       //-Encuesta Sitwifi
       $super_admin_a1->givePermissionTo('View dashboard sitwifi');
       $super_admin_a1->givePermissionTo('View config sitwifi');
       $super_admin_a1->givePermissionTo('Delete config sitwifi');
       $super_admin_a1->givePermissionTo('Send mail sitwifi');
       //- Herramientas
       $super_admin_a1->givePermissionTo('View guest review');
       $super_admin_a1->givePermissionTo('View server review');
       $super_admin_a1->givePermissionTo('View test zd');
       //- Configuración
       $super_admin_a1->givePermissionTo('Create user');
       $super_admin_a1->givePermissionTo('Edit user');
       $super_admin_a1->givePermissionTo('Delete user');
       $super_admin_a1->givePermissionTo('View Configuration');
       $super_admin_a1->givePermissionTo('Edit Configuration');

       //Usuario Desarrollo- Esquinca
       //- Dashboard
       $super_admin_a2->givePermissionTo('View dashboard pral');
       //- Inventario
       $super_admin_a2->givePermissionTo('View detailed for hotel');
       $super_admin_a2->givePermissionTo('View detailed for proyect');
       $super_admin_a2->givePermissionTo('View cover');
       $super_admin_a2->givePermissionTo('View distribucion');
       //- Equipos
       $super_admin_a2->givePermissionTo('View add equipment');
       $super_admin_a2->givePermissionTo('Create equipment');
       $super_admin_a2->givePermissionTo('View removed equipment');
       $super_admin_a2->givePermissionTo('Removed equipment');
       $super_admin_a2->givePermissionTo('View search equipment');
       $super_admin_a2->givePermissionTo('View move equipment');
       $super_admin_a2->givePermissionTo('Move equipment');
       $super_admin_a2->givePermissionTo('View equipment group');
       $super_admin_a2->givePermissionTo('Add equipment group');
       $super_admin_a2->givePermissionTo('Removed equipment group');
       $super_admin_a2->givePermissionTo('View provider');
       $super_admin_a2->givePermissionTo('Create provider');
       $super_admin_a2->givePermissionTo('Edit provider');
       $super_admin_a2->givePermissionTo('Delete provider');
       //- Reportes
       $super_admin_a2->givePermissionTo('View assign report');
       $super_admin_a2->givePermissionTo('Create assign report');
       $super_admin_a2->givePermissionTo('Edit assign report');
       $super_admin_a2->givePermissionTo('Delete assign report');
       $super_admin_a2->givePermissionTo('Create general report');
       $super_admin_a2->givePermissionTo('View individual capture');
       $super_admin_a2->givePermissionTo('Create individual capture');
       $super_admin_a2->givePermissionTo('View individual general report');
       $super_admin_a2->givePermissionTo('Edit individual general report');
       $super_admin_a2->givePermissionTo('View concierge approval');
       $super_admin_a2->givePermissionTo('Create concierge approval');
       $super_admin_a2->givePermissionTo('Delete concierge approval');
       $super_admin_a2->givePermissionTo('View admin approval');
       $super_admin_a2->givePermissionTo('Option admin approval');
       $super_admin_a2->givePermissionTo('Notification admin approval');
       $super_admin_a2->givePermissionTo('View report');
       $super_admin_a2->givePermissionTo('View report concat');
       //Calificaciones
       $super_admin_a2->givePermissionTo('View dashboard survey nps');
       $super_admin_a2->givePermissionTo('View create survey');
       $super_admin_a2->givePermissionTo('Generate survey');
       $super_admin_a2->givePermissionTo('View capture survey');
       $super_admin_a2->givePermissionTo('Create survey');
       $super_admin_a2->givePermissionTo('View edit survey');
       $super_admin_a2->givePermissionTo('Edit survey');
       $super_admin_a2->givePermissionTo('View results survey');
       $super_admin_a2->givePermissionTo('View survey configuration');
       $super_admin_a2->givePermissionTo('Assign user survey');
       $super_admin_a2->givePermissionTo('Removed user survey');
       $super_admin_a2->givePermissionTo('Generate key user survey');
       $super_admin_a2->givePermissionTo('Send email user survey');
       $super_admin_a2->givePermissionTo('View key user survey');
       $super_admin_a2->givePermissionTo('View survey nps configuration');
       //NPS
       $super_admin_a2->givePermissionTo('View assign hotel user');
       $super_admin_a2->givePermissionTo('Create assign hotel user');
       $super_admin_a2->givePermissionTo('Delete assign hotel user');
       $super_admin_a2->givePermissionTo('View list assign hotel user');
       $super_admin_a2->givePermissionTo('View assign delete client');
       $super_admin_a2->givePermissionTo('View config nps automatic');
       $super_admin_a2->givePermissionTo('Create config nps automatic');
       $super_admin_a2->givePermissionTo('View config nps individual');
       $super_admin_a2->givePermissionTo('Create config nps individual');
       //-Encuesta Sitwifi
       $super_admin_a2->givePermissionTo('View dashboard sitwifi');
       $super_admin_a2->givePermissionTo('View config sitwifi');
       $super_admin_a2->givePermissionTo('Delete config sitwifi');
       $super_admin_a2->givePermissionTo('Send mail sitwifi');
       //- Herramientas
       $super_admin_a2->givePermissionTo('View guest review');
       $super_admin_a2->givePermissionTo('View server review');
       $super_admin_a2->givePermissionTo('View test zd');
       //- Configuración
       $super_admin_a2->givePermissionTo('Create user');
       $super_admin_a2->givePermissionTo('Edit user');
       $super_admin_a2->givePermissionTo('Delete user');
       $super_admin_a2->givePermissionTo('View Configuration');
       $super_admin_a2->givePermissionTo('Edit Configuration');

       //Usuario Desarrollo- Angel Gabriel
       //- Dashboard
       $super_admin_a3->givePermissionTo('View dashboard pral');
       //- Inventario
       $super_admin_a3->givePermissionTo('View detailed for hotel');
       $super_admin_a3->givePermissionTo('View detailed for proyect');
       $super_admin_a3->givePermissionTo('View cover');
       $super_admin_a3->givePermissionTo('View distribucion');
       //- Equipos
       $super_admin_a3->givePermissionTo('View add equipment');
       $super_admin_a3->givePermissionTo('Create equipment');
       $super_admin_a3->givePermissionTo('View removed equipment');
       $super_admin_a3->givePermissionTo('Removed equipment');
       $super_admin_a3->givePermissionTo('View search equipment');
       $super_admin_a3->givePermissionTo('View move equipment');
       $super_admin_a3->givePermissionTo('Move equipment');
       $super_admin_a3->givePermissionTo('View equipment group');
       $super_admin_a3->givePermissionTo('Add equipment group');
       $super_admin_a3->givePermissionTo('Removed equipment group');
       $super_admin_a3->givePermissionTo('View provider');
       $super_admin_a3->givePermissionTo('Create provider');
       $super_admin_a3->givePermissionTo('Edit provider');
       $super_admin_a3->givePermissionTo('Delete provider');
       //- Reportes
       $super_admin_a3->givePermissionTo('View assign report');
       $super_admin_a3->givePermissionTo('Create assign report');
       $super_admin_a3->givePermissionTo('Edit assign report');
       $super_admin_a3->givePermissionTo('Delete assign report');
       $super_admin_a3->givePermissionTo('Create general report');
       $super_admin_a3->givePermissionTo('View individual capture');
       $super_admin_a3->givePermissionTo('Create individual capture');
       $super_admin_a3->givePermissionTo('View individual general report');
       $super_admin_a3->givePermissionTo('Edit individual general report');
       $super_admin_a3->givePermissionTo('View concierge approval');
       $super_admin_a3->givePermissionTo('Create concierge approval');
       $super_admin_a3->givePermissionTo('Delete concierge approval');
       $super_admin_a3->givePermissionTo('View admin approval');
       $super_admin_a3->givePermissionTo('Option admin approval');
       $super_admin_a3->givePermissionTo('Notification admin approval');
       $super_admin_a3->givePermissionTo('View report');
       $super_admin_a3->givePermissionTo('View report concat');
       //Calificaciones
       $super_admin_a3->givePermissionTo('View dashboard survey nps');
       $super_admin_a3->givePermissionTo('View create survey');
       $super_admin_a3->givePermissionTo('Generate survey');
       $super_admin_a3->givePermissionTo('View capture survey');
       $super_admin_a3->givePermissionTo('Create survey');
       $super_admin_a3->givePermissionTo('View edit survey');
       $super_admin_a3->givePermissionTo('Edit survey');
       $super_admin_a3->givePermissionTo('View results survey');
       $super_admin_a3->givePermissionTo('View survey configuration');
       $super_admin_a3->givePermissionTo('Assign user survey');
       $super_admin_a3->givePermissionTo('Removed user survey');
       $super_admin_a3->givePermissionTo('Generate key user survey');
       $super_admin_a3->givePermissionTo('Send email user survey');
       $super_admin_a3->givePermissionTo('View key user survey');
       $super_admin_a3->givePermissionTo('View survey nps configuration');
       //NPS
       $super_admin_a3->givePermissionTo('View assign hotel user');
       $super_admin_a3->givePermissionTo('Create assign hotel user');
       $super_admin_a3->givePermissionTo('Delete assign hotel user');
       $super_admin_a3->givePermissionTo('View list assign hotel user');
       $super_admin_a3->givePermissionTo('View assign delete client');
       $super_admin_a3->givePermissionTo('View config nps automatic');
       $super_admin_a3->givePermissionTo('Create config nps automatic');
       $super_admin_a3->givePermissionTo('View config nps individual');
       $super_admin_a3->givePermissionTo('Create config nps individual');
       //-Encuesta Sitwifi
       $super_admin_a3->givePermissionTo('View dashboard sitwifi');
       $super_admin_a3->givePermissionTo('View config sitwifi');
       $super_admin_a3->givePermissionTo('Delete config sitwifi');
       $super_admin_a3->givePermissionTo('Send mail sitwifi');
       //- Herramientas
       $super_admin_a3->givePermissionTo('View guest review');
       $super_admin_a3->givePermissionTo('View server review');
       $super_admin_a3->givePermissionTo('View test zd');
       //- Configuración
       $super_admin_a3->givePermissionTo('Create user');
       $super_admin_a3->givePermissionTo('Edit user');
       $super_admin_a3->givePermissionTo('Delete user');
       $super_admin_a3->givePermissionTo('View Configuration');
       $super_admin_a3->givePermissionTo('Edit Configuration');

       //Usuario Desarrollo- Oscar
       //- Dashboard
       $super_admin_a4->givePermissionTo('View dashboard pral');
       //- Inventario
       $super_admin_a4->givePermissionTo('View detailed for hotel');
       $super_admin_a4->givePermissionTo('View detailed for proyect');
       $super_admin_a4->givePermissionTo('View cover');
       $super_admin_a4->givePermissionTo('View distribucion');
       //- Equipos
       $super_admin_a4->givePermissionTo('View add equipment');
       $super_admin_a4->givePermissionTo('Create equipment');
       $super_admin_a4->givePermissionTo('View removed equipment');
       $super_admin_a4->givePermissionTo('Removed equipment');
       $super_admin_a4->givePermissionTo('View search equipment');
       $super_admin_a4->givePermissionTo('View move equipment');
       $super_admin_a4->givePermissionTo('Move equipment');
       $super_admin_a4->givePermissionTo('View equipment group');
       $super_admin_a4->givePermissionTo('Add equipment group');
       $super_admin_a4->givePermissionTo('Removed equipment group');
       $super_admin_a4->givePermissionTo('View provider');
       $super_admin_a4->givePermissionTo('Create provider');
       $super_admin_a4->givePermissionTo('Edit provider');
       $super_admin_a4->givePermissionTo('Delete provider');
       //- Reportes
       $super_admin_a4->givePermissionTo('View assign report');
       $super_admin_a4->givePermissionTo('Create assign report');
       $super_admin_a4->givePermissionTo('Edit assign report');
       $super_admin_a4->givePermissionTo('Delete assign report');
       $super_admin_a4->givePermissionTo('Create general report');
       $super_admin_a4->givePermissionTo('View individual capture');
       $super_admin_a4->givePermissionTo('Create individual capture');
       $super_admin_a4->givePermissionTo('View individual general report');
       $super_admin_a4->givePermissionTo('Edit individual general report');
       $super_admin_a4->givePermissionTo('View concierge approval');
       $super_admin_a4->givePermissionTo('Create concierge approval');
       $super_admin_a4->givePermissionTo('Delete concierge approval');
       $super_admin_a4->givePermissionTo('View admin approval');
       $super_admin_a4->givePermissionTo('Option admin approval');
       $super_admin_a4->givePermissionTo('Notification admin approval');
       $super_admin_a4->givePermissionTo('View report');
       $super_admin_a4->givePermissionTo('View report concat');
       //Calificaciones
       $super_admin_a4->givePermissionTo('View dashboard survey nps');
       $super_admin_a4->givePermissionTo('View create survey');
       $super_admin_a4->givePermissionTo('Generate survey');
       $super_admin_a4->givePermissionTo('View capture survey');
       $super_admin_a4->givePermissionTo('Create survey');
       $super_admin_a4->givePermissionTo('View edit survey');
       $super_admin_a4->givePermissionTo('Edit survey');
       $super_admin_a4->givePermissionTo('View results survey');
       $super_admin_a4->givePermissionTo('View survey configuration');
       $super_admin_a4->givePermissionTo('Assign user survey');
       $super_admin_a4->givePermissionTo('Removed user survey');
       $super_admin_a4->givePermissionTo('Generate key user survey');
       $super_admin_a4->givePermissionTo('Send email user survey');
       $super_admin_a4->givePermissionTo('View key user survey');
       $super_admin_a4->givePermissionTo('View survey nps configuration');
       //NPS
       $super_admin_a4->givePermissionTo('View assign hotel user');
       $super_admin_a4->givePermissionTo('Create assign hotel user');
       $super_admin_a4->givePermissionTo('Delete assign hotel user');
       $super_admin_a4->givePermissionTo('View list assign hotel user');
       $super_admin_a4->givePermissionTo('View assign delete client');
       $super_admin_a4->givePermissionTo('View config nps automatic');
       $super_admin_a4->givePermissionTo('Create config nps automatic');
       $super_admin_a4->givePermissionTo('View config nps individual');
       $super_admin_a4->givePermissionTo('Create config nps individual');
       //-Encuesta Sitwifi
       $super_admin_a4->givePermissionTo('View dashboard sitwifi');
       $super_admin_a4->givePermissionTo('View config sitwifi');
       $super_admin_a4->givePermissionTo('Delete config sitwifi');
       $super_admin_a4->givePermissionTo('Send mail sitwifi');
       //- Herramientas
       $super_admin_a4->givePermissionTo('View guest review');
       $super_admin_a4->givePermissionTo('View server review');
       $super_admin_a4->givePermissionTo('View test zd');
       //- Configuración
       $super_admin_a4->givePermissionTo('Create user');
       $super_admin_a4->givePermissionTo('Edit user');
       $super_admin_a4->givePermissionTo('Delete user');
       $super_admin_a4->givePermissionTo('View Configuration');
       $super_admin_a4->givePermissionTo('Edit Configuration');

       //Usuario Desarrollo- Edgar
       //- Dashboard
       $super_admin_a5->givePermissionTo('View dashboard pral');
       //- Inventario
       $super_admin_a5->givePermissionTo('View detailed for hotel');
       $super_admin_a5->givePermissionTo('View detailed for proyect');
       $super_admin_a5->givePermissionTo('View cover');
       $super_admin_a5->givePermissionTo('View distribucion');
       //- Equipos
       $super_admin_a5->givePermissionTo('View add equipment');
       $super_admin_a5->givePermissionTo('Create equipment');
       $super_admin_a5->givePermissionTo('View removed equipment');
       $super_admin_a5->givePermissionTo('Removed equipment');
       $super_admin_a5->givePermissionTo('View search equipment');
       $super_admin_a5->givePermissionTo('View move equipment');
       $super_admin_a5->givePermissionTo('Move equipment');
       $super_admin_a5->givePermissionTo('View equipment group');
       $super_admin_a5->givePermissionTo('Add equipment group');
       $super_admin_a5->givePermissionTo('Removed equipment group');
       $super_admin_a5->givePermissionTo('View provider');
       $super_admin_a5->givePermissionTo('Create provider');
       $super_admin_a5->givePermissionTo('Edit provider');
       $super_admin_a5->givePermissionTo('Delete provider');
       //- Reportes
       $super_admin_a5->givePermissionTo('View assign report');
       $super_admin_a5->givePermissionTo('Create assign report');
       $super_admin_a5->givePermissionTo('Edit assign report');
       $super_admin_a5->givePermissionTo('Delete assign report');
       $super_admin_a5->givePermissionTo('Create general report');
       $super_admin_a5->givePermissionTo('View individual capture');
       $super_admin_a5->givePermissionTo('Create individual capture');
       $super_admin_a5->givePermissionTo('View individual general report');
       $super_admin_a5->givePermissionTo('Edit individual general report');
       $super_admin_a5->givePermissionTo('View concierge approval');
       $super_admin_a5->givePermissionTo('Create concierge approval');
       $super_admin_a5->givePermissionTo('Delete concierge approval');
       $super_admin_a5->givePermissionTo('View admin approval');
       $super_admin_a5->givePermissionTo('Option admin approval');
       $super_admin_a5->givePermissionTo('Notification admin approval');
       $super_admin_a5->givePermissionTo('View report');
       $super_admin_a5->givePermissionTo('View report concat');
       //Calificaciones
       $super_admin_a5->givePermissionTo('View dashboard survey nps');
       $super_admin_a5->givePermissionTo('View create survey');
       $super_admin_a5->givePermissionTo('Generate survey');
       $super_admin_a5->givePermissionTo('View capture survey');
       $super_admin_a5->givePermissionTo('Create survey');
       $super_admin_a5->givePermissionTo('View edit survey');
       $super_admin_a5->givePermissionTo('Edit survey');
       $super_admin_a5->givePermissionTo('View results survey');
       $super_admin_a5->givePermissionTo('View survey configuration');
       $super_admin_a5->givePermissionTo('Assign user survey');
       $super_admin_a5->givePermissionTo('Removed user survey');
       $super_admin_a5->givePermissionTo('Generate key user survey');
       $super_admin_a5->givePermissionTo('Send email user survey');
       $super_admin_a5->givePermissionTo('View key user survey');
       $super_admin_a5->givePermissionTo('View survey nps configuration');
       //NPS
       $super_admin_a5->givePermissionTo('View assign hotel user');
       $super_admin_a5->givePermissionTo('Create assign hotel user');
       $super_admin_a5->givePermissionTo('Delete assign hotel user');
       $super_admin_a5->givePermissionTo('View list assign hotel user');
       $super_admin_a5->givePermissionTo('View assign delete client');
       $super_admin_a5->givePermissionTo('View config nps automatic');
       $super_admin_a5->givePermissionTo('Create config nps automatic');
       $super_admin_a5->givePermissionTo('View config nps individual');
       $super_admin_a5->givePermissionTo('Create config nps individual');
       //-Encuesta Sitwifi
       $super_admin_a5->givePermissionTo('View dashboard sitwifi');
       $super_admin_a5->givePermissionTo('View config sitwifi');
       $super_admin_a5->givePermissionTo('Delete config sitwifi');
       $super_admin_a5->givePermissionTo('Send mail sitwifi');
       //- Herramientas
       $super_admin_a5->givePermissionTo('View guest review');
       $super_admin_a5->givePermissionTo('View server review');
       $super_admin_a5->givePermissionTo('View test zd');
       //- Configuración
       $super_admin_a5->givePermissionTo('Create user');
       $super_admin_a5->givePermissionTo('Edit user');
       $super_admin_a5->givePermissionTo('Delete user');
       $super_admin_a5->givePermissionTo('View Configuration');
       $super_admin_a5->givePermissionTo('Edit Configuration');

       //Creamos las categorias de los menus
         $seccion_admin_a = new Section;
         $seccion_admin_a->name='inventory';
         $seccion_admin_a->display_name='Inventario';
         $seccion_admin_a->icons='fa fa-archive';
         $seccion_admin_a->save();

         $seccion_admin_b = new Section;
         $seccion_admin_b->name='report';
         $seccion_admin_b->display_name='Reportes';
         $seccion_admin_b->icons='fa fa-check-square-o';
         $seccion_admin_b->save();

         $seccion_admin_c = new Section;
         $seccion_admin_c->name='qualification';
         $seccion_admin_c->display_name='Encuesta';
         $seccion_admin_c->icons='fa fa-calendar-plus-o';
         $seccion_admin_c->save();

         $seccion_admin_d = new Section;
         $seccion_admin_d->name='equipment';
         $seccion_admin_d->display_name='Equipos';
         $seccion_admin_d->icons='fa fa-briefcase';
         $seccion_admin_d->save();

         $seccion_admin_e = new Section;
         $seccion_admin_e->name='tools';
         $seccion_admin_e->display_name='Herramientas';
         $seccion_admin_e->icons='fa fa-wrench';
         $seccion_admin_e->save();

         $seccion_admin_f = new Section;
         $seccion_admin_f->name='viaticos';
         $seccion_admin_f->display_name='Viáticos';
         $seccion_admin_f->icons='fa fa-suitcase';
         $seccion_admin_f->save();

         $seccion_admin_g = new Section;
         $seccion_admin_g->name='payments';
         $seccion_admin_g->display_name='Pagos';
         $seccion_admin_g->icons='fa fa-gavel';
         $seccion_admin_g->save();


       //Menu Inventario
         $menu_inv_000 = new Menu;
         $menu_inv_000->name='detailed_hotel';
         $menu_inv_000->display_name='Detallado por Hotel';
         $menu_inv_000->description='Permite visualizar el inventario actual de los sitios permitidos.';
         $menu_inv_000->url='detailed_hotel';
         $menu_inv_000->section_id=$seccion_admin_a->id;
         $menu_inv_000->icons='fa fa-circle-o';
         $menu_inv_000->save();
         $assigned_menu_inv_0_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_inv_000->id]);
         $assigned_menu_inv_0_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_inv_000->id]);
         $assigned_menu_inv_0_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_inv_000->id]);
         $assigned_menu_inv_0_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_inv_000->id]);
         $assigned_menu_inv_0_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_inv_000->id]);
         $assigned_menu_inv_0_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_inv_000->id]);

         $menu_inv_001 = new Menu;
         $menu_inv_001->name='detailed_proyect';
         $menu_inv_001->display_name='Detallado por proyecto';
         $menu_inv_001->description='Permite visualizar el inventario actual en base a los proyectos.';
         $menu_inv_001->url='detailed_proyect';
         $menu_inv_001->section_id=$seccion_admin_a->id;
         $menu_inv_001->icons='fa fa-circle-o';
         $menu_inv_001->save();
         $assigned_menu_inv_1_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_inv_001->id]);
         $assigned_menu_inv_1_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_inv_001->id]);
         $assigned_menu_inv_1_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_inv_001->id]);
         $assigned_menu_inv_1_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_inv_001->id]);
         $assigned_menu_inv_1_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_inv_001->id]);
         $assigned_menu_inv_1_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_inv_001->id]);

         $menu_inv_002 = new Menu;
         $menu_inv_002->name='detailed_cover';
         $menu_inv_002->display_name='Carta de entrega';
         $menu_inv_002->description='Permite visualizar la carta de entrega.';
         $menu_inv_002->url='detailed_cover';
         $menu_inv_002->section_id=$seccion_admin_a->id;
         $menu_inv_002->icons='fa fa-circle-o';
         $menu_inv_002->save();
         $assigned_menu_inv_2_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_inv_002->id]);
         $assigned_menu_inv_2_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_inv_002->id]);
         $assigned_menu_inv_2_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_inv_002->id]);
         $assigned_menu_inv_2_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_inv_002->id]);
         $assigned_menu_inv_2_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_inv_002->id]);
         $assigned_menu_inv_2_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_inv_002->id]);

         $menu_inv_003 = new Menu;
         $menu_inv_003->name='detailed_distribution';
         $menu_inv_003->display_name='Distribucion';
         $menu_inv_003->description='Permite visualizar la distribución actual.';
         $menu_inv_003->url='detailed_distribution';
         $menu_inv_003->section_id=$seccion_admin_a->id;
         $menu_inv_003->icons='fa fa-circle-o';
         $menu_inv_003->save();
         $assigned_menu_inv_3_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_inv_003->id]);
         $assigned_menu_inv_3_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_inv_003->id]);
         $assigned_menu_inv_3_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_inv_003->id]);
         $assigned_menu_inv_3_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_inv_003->id]);
         $assigned_menu_inv_3_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_inv_003->id]);
         $assigned_menu_inv_3_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_inv_003->id]);

       //Menu Equipos
         $menu_eqp_000 = new Menu;
         $menu_eqp_000->name='up_equipment';
         $menu_eqp_000->display_name='Altas';
         $menu_eqp_000->description='Permite dar de altas nuevos equipos';
         $menu_eqp_000->url='up_equipment';
         $menu_eqp_000->section_id=$seccion_admin_d->id;
         $menu_eqp_000->icons='fa fa-chevron-circle-up';
         $menu_eqp_000->save();
         $assigned_menu_eqp_0_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_eqp_000->id]);
         $assigned_menu_eqp_0_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_eqp_000->id]);
         $assigned_menu_eqp_0_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_eqp_000->id]);
         $assigned_menu_eqp_0_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_eqp_000->id]);
         $assigned_menu_eqp_0_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_eqp_000->id]);
         $assigned_menu_eqp_0_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_eqp_000->id]);

         $menu_eqp_001 = new Menu;
         $menu_eqp_001->name='down_equipment';
         $menu_eqp_001->display_name='Bajas';
         $menu_eqp_001->description='Permite dar de baja equipos';
         $menu_eqp_001->url='down_equipment';
         $menu_eqp_001->section_id=$seccion_admin_d->id;
         $menu_eqp_001->icons='fa fa-chevron-circle-down';
         $menu_eqp_001->save();
         $assigned_menu_eqp_1_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_eqp_001->id]);
         $assigned_menu_eqp_1_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_eqp_001->id]);
         $assigned_menu_eqp_1_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_eqp_001->id]);
         $assigned_menu_eqp_1_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_eqp_001->id]);
         $assigned_menu_eqp_1_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_eqp_001->id]);
         $assigned_menu_eqp_1_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_eqp_001->id]);

         $menu_eqp_002 = new Menu;
         $menu_eqp_002->name='detailed_search';
         $menu_eqp_002->display_name='Buscador';
         $menu_eqp_002->description='Permite visualizar el buscador de equipos';
         $menu_eqp_002->url='detailed_search';
         $menu_eqp_002->section_id=$seccion_admin_d->id;
         $menu_eqp_002->icons='fa fa-search';
         $menu_eqp_002->save();
         $assigned_menu_eqp_2_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_eqp_002->id]);
         $assigned_menu_eqp_2_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_eqp_002->id]);
         $assigned_menu_eqp_2_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_eqp_002->id]);
         $assigned_menu_eqp_2_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_eqp_002->id]);
         $assigned_menu_eqp_2_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_eqp_002->id]);
         $assigned_menu_eqp_2_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_eqp_002->id]);

         $menu_eqp_003 = new Menu;
         $menu_eqp_003->name='move_equipment';
         $menu_eqp_003->display_name='Movimientos';
         $menu_eqp_003->description='Permite mover equipos';
         $menu_eqp_003->url='move_equipment';
         $menu_eqp_003->section_id=$seccion_admin_d->id;
         $menu_eqp_003->icons='fa fa-arrows';
         $menu_eqp_003->save();
         $assigned_menu_eqp_3_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_eqp_003->id]);
         $assigned_menu_eqp_3_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_eqp_003->id]);
         $assigned_menu_eqp_3_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_eqp_003->id]);
         $assigned_menu_eqp_3_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_eqp_003->id]);
         $assigned_menu_eqp_3_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_eqp_003->id]);
         $assigned_menu_eqp_3_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_eqp_003->id]);

         $menu_eqp_004 = new Menu;
         $menu_eqp_004->name='group_equipment';
         $menu_eqp_004->display_name='Grupos';
         $menu_eqp_004->description='Permite agrupar equipos';
         $menu_eqp_004->url='group_equipment';
         $menu_eqp_004->section_id=$seccion_admin_d->id;
         $menu_eqp_004->icons='fa fa-object-group';
         $menu_eqp_004->save();
         $assigned_menu_eqp_4_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_eqp_004->id]);
         $assigned_menu_eqp_4_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_eqp_004->id]);
         $assigned_menu_eqp_4_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_eqp_004->id]);
         $assigned_menu_eqp_4_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_eqp_004->id]);
         $assigned_menu_eqp_4_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_eqp_004->id]);
         $assigned_menu_eqp_4_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_eqp_004->id]);

         $menu_eqp_005 = new Menu;
         $menu_eqp_005->name='provider';
         $menu_eqp_005->display_name='Proveedor';
         $menu_eqp_005->description='Permite agregar los proveedores';
         $menu_eqp_005->url='provider';
         $menu_eqp_005->section_id=$seccion_admin_d->id;
         $menu_eqp_005->icons='fa fa-handshake-o';
         $menu_eqp_005->save();
         $assigned_menu_eqp_5_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_eqp_005->id]);
         $assigned_menu_eqp_5_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_eqp_005->id]);
         $assigned_menu_eqp_5_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_eqp_005->id]);
         $assigned_menu_eqp_5_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_eqp_005->id]);
         $assigned_menu_eqp_5_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_eqp_005->id]);
         $assigned_menu_eqp_5_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_eqp_005->id]);

       //Menu Reportes
         $menu_rep_000 = new Menu;
         $menu_rep_000->name='type_report';
         $menu_rep_000->display_name='Asignación de reporte';
         $menu_rep_000->description='Permite manipular y establecer los valor predeterminados para cada hotel.';
         $menu_rep_000->url='type_report';
         $menu_rep_000->section_id=$seccion_admin_b->id;
         $menu_rep_000->icons='fa fa-square-o';
         $menu_rep_000->save();
         $assigned_menu_rep_0_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_rep_000->id]);
         $assigned_menu_rep_0_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_rep_000->id]);
         $assigned_menu_rep_0_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_rep_000->id]);
         $assigned_menu_rep_0_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_rep_000->id]);
         $assigned_menu_rep_0_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_rep_000->id]);
         $assigned_menu_rep_0_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_rep_000->id]);

         $menu_rep_001 = new Menu;
         $menu_rep_001->name='individual';
         $menu_rep_001->display_name='Captura reporte';
         $menu_rep_001->description='Permite realizar la captura individual de cada hotel asignado.';
         $menu_rep_001->url='individual';
         $menu_rep_001->section_id=$seccion_admin_b->id;
         $menu_rep_001->icons='fa fa-square-o';
         $menu_rep_001->save();
         $assigned_menu_rep_1_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_rep_001->id]);
         $assigned_menu_rep_1_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_rep_001->id]);
         $assigned_menu_rep_1_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_rep_001->id]);
         $assigned_menu_rep_1_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_rep_001->id]);
         $assigned_menu_rep_1_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_rep_001->id]);
         $assigned_menu_rep_1_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_rep_001->id]);

         $menu_rep_002 = new Menu;
         $menu_rep_002->name='edit_report';
         $menu_rep_002->display_name='Editar Reportes';
         $menu_rep_002->description='Permite editar el reporte capturado de cada hotel asignado.';
         $menu_rep_002->url='edit_report';
         $menu_rep_002->section_id=$seccion_admin_b->id;
         $menu_rep_002->icons='fa fa-square-o';
         $menu_rep_002->save();
         $assigned_menu_rep_2_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_rep_002->id]);
         $assigned_menu_rep_2_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_rep_002->id]);
         $assigned_menu_rep_2_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_rep_002->id]);
         $assigned_menu_rep_2_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_rep_002->id]);
         $assigned_menu_rep_2_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_rep_002->id]);
         $assigned_menu_rep_2_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_rep_002->id]);

         $menu_rep_003 = new Menu;
         $menu_rep_003->name='approval';
         $menu_rep_003->display_name='Aprobación Concierge';
         $menu_rep_003->description='Permite realizar la aprobación de concierge.';
         $menu_rep_003->url='approval';
         $menu_rep_003->section_id=$seccion_admin_b->id;
         $menu_rep_003->icons='fa fa-square-o';
         $menu_rep_003->save();
         $assigned_menu_rep_3_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_rep_003->id]);
         $assigned_menu_rep_3_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_rep_003->id]);
         $assigned_menu_rep_3_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_rep_003->id]);
         $assigned_menu_rep_3_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_rep_003->id]);
         $assigned_menu_rep_3_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_rep_003->id]);
         $assigned_menu_rep_3_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_rep_003->id]);

         $menu_rep_004 = new Menu;
         $menu_rep_004->name='approvals';
         $menu_rep_004->display_name='Aprobación Admin';
         $menu_rep_004->description='Permite verificar y aprobar reportes.';
         $menu_rep_004->url='approvals';
         $menu_rep_004->section_id=$seccion_admin_b->id;
         $menu_rep_004->icons='fa fa-square-o';
         $menu_rep_004->save();
         $assigned_menu_rep_4_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_rep_004->id]);
         $assigned_menu_rep_4_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_rep_004->id]);
         $assigned_menu_rep_4_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_rep_004->id]);
         $assigned_menu_rep_4_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_rep_004->id]);
         $assigned_menu_rep_4_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_rep_004->id]);
         $assigned_menu_rep_4_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_rep_004->id]);

         $menu_rep_005 = new Menu;
         $menu_rep_005->name='viewreports';
         $menu_rep_005->display_name='Ver Reportes';
         $menu_rep_005->description='Permite visualizar los reportes de cada hotel.';
         $menu_rep_005->url='viewreports';
         $menu_rep_005->section_id=$seccion_admin_b->id;
         $menu_rep_005->icons='fa fa-square-o';
         $menu_rep_005->save();
         $assigned_menu_rep_5_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_rep_005->id]);
         $assigned_menu_rep_5_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_rep_005->id]);
         $assigned_menu_rep_5_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_rep_005->id]);
         $assigned_menu_rep_5_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_rep_005->id]);
         $assigned_menu_rep_5_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_rep_005->id]);
         $assigned_menu_rep_5_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_rep_005->id]);

         $menu_rep_006 = new Menu;
         $menu_rep_006->name='viewreportscont';
         $menu_rep_006->display_name='Ver Reportes Cont';
         $menu_rep_006->description='Permite visualizar el reporte concatenado de cada cadena.';
         $menu_rep_006->url='viewreportscont';
         $menu_rep_006->section_id=$seccion_admin_b->id;
         $menu_rep_006->icons='fa fa-square-o';
         $menu_rep_006->save();
         $assigned_menu_rep_6_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_rep_006->id]);
         $assigned_menu_rep_6_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_rep_006->id]);
         $assigned_menu_rep_6_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_rep_006->id]);
         $assigned_menu_rep_6_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_rep_006->id]);
         $assigned_menu_rep_6_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_rep_006->id]);
         $assigned_menu_rep_6_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_rep_006->id]);


       //Menu Calificaciones
         $menu_cal_000 = new Menu;
         $menu_cal_000->name='view_dashboard_survey_nps';
         $menu_cal_000->display_name='Dashboard NPS';
         $menu_cal_000->description='Permite visualizar los resultados de la encuesta NPS.';
         $menu_cal_000->url='view_dashboard_survey_nps';
         $menu_cal_000->section_id=$seccion_admin_c->id;
         $menu_cal_000->icons='fa fa-tachometer';
         $menu_cal_000->save();
         $assigned_menu_cal_0_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_cal_000->id]);
         $assigned_menu_cal_0_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_cal_000->id]);
         $assigned_menu_cal_0_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_cal_000->id]);
         $assigned_menu_cal_0_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_cal_000->id]);
         $assigned_menu_cal_0_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_cal_000->id]);
         $assigned_menu_cal_0_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_cal_000->id]);

         $menu_cal_001 = new Menu;
         $menu_cal_001->name='view_dashboard_survey_sit';
         $menu_cal_001->display_name='Dashboard gral';
         $menu_cal_001->description='Permite visualizar los resultados de la encuesta Sitwfi.';
         $menu_cal_001->url='view_dashboard_survey_sit';
         $menu_cal_001->section_id=$seccion_admin_c->id;
         $menu_cal_001->icons='fa fa-tachometer';
         $menu_cal_001->save();
         $assigned_menu_cal_1_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_cal_001->id]);
         $assigned_menu_cal_1_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_cal_001->id]);
         $assigned_menu_cal_1_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_cal_001->id]);
         $assigned_menu_cal_1_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_cal_001->id]);
         $assigned_menu_cal_1_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_cal_001->id]);
         $assigned_menu_cal_1_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_cal_001->id]);

         $menu_cal_002 = new Menu;
         $menu_cal_002->name='create_survey_admin';
         $menu_cal_002->display_name='Crear encuesta';
         $menu_cal_002->description='Permite crear la encuesta mensual.';
         $menu_cal_002->url='create_survey_admin';
         $menu_cal_002->section_id=$seccion_admin_c->id;
         $menu_cal_002->icons='fa fa-plus-square-o';
         $menu_cal_002->save();
         $assigned_menu_cal_2_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_cal_002->id]);
         $assigned_menu_cal_2_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_cal_002->id]);
         $assigned_menu_cal_2_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_cal_002->id]);
         $assigned_menu_cal_2_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_cal_002->id]);
         $assigned_menu_cal_2_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_cal_002->id]);
         $assigned_menu_cal_2_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_cal_002->id]);

         $menu_cal_003 = new Menu;
         $menu_cal_003->name='survey_results';
         $menu_cal_003->display_name='Resultados NPS';
         $menu_cal_003->description='Permite visualizar las calificaciones de cada sitio.';
         $menu_cal_003->url='survey_results';
         $menu_cal_003->section_id=$seccion_admin_c->id;
         $menu_cal_003->icons='fa fa-info-circle';
         $menu_cal_003->save();
         $assigned_menu_cal_3_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_cal_003->id]);
         $assigned_menu_cal_3_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_cal_003->id]);
         $assigned_menu_cal_3_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_cal_003->id]);
         $assigned_menu_cal_3_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_cal_003->id]);
         $assigned_menu_cal_3_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_cal_003->id]);
         $assigned_menu_cal_3_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_cal_003->id]);

         $menu_cal_004 = new Menu;
         $menu_cal_004->name='configure_survey_admin_nps';
         $menu_cal_004->display_name='Configuración NPS.';
         $menu_cal_004->description='Permite configurar las encuestas NPS para los clientes.';
         $menu_cal_004->url='configure_survey_admin_nps';
         $menu_cal_004->section_id=$seccion_admin_c->id;
         $menu_cal_004->icons='fa fa-cog';
         $menu_cal_004->save();
         $assigned_menu_cal_4_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_cal_004->id]);
         $assigned_menu_cal_4_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_cal_004->id]);
         $assigned_menu_cal_4_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_cal_004->id]);
         $assigned_menu_cal_4_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_cal_004->id]);
         $assigned_menu_cal_4_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_cal_004->id]);
         $assigned_menu_cal_4_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_cal_004->id]);

         $menu_cal_005 = new Menu;
         $menu_cal_005->name='configure_survey_admin_sit';
         $menu_cal_005->display_name='Configuración gral.';
         $menu_cal_005->description='Permite configurar las encuestas sitwifi para el personal.';
         $menu_cal_005->url='configure_survey_admin_sit';
         $menu_cal_005->section_id=$seccion_admin_c->id;
         $menu_cal_005->icons='fa fa-cog';
         $menu_cal_005->save();
         $assigned_menu_cal_5_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_cal_005->id]);
         $assigned_menu_cal_5_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_cal_005->id]);
         $assigned_menu_cal_5_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_cal_005->id]);
         $assigned_menu_cal_5_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_cal_005->id]);
         $assigned_menu_cal_5_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_cal_005->id]);
         $assigned_menu_cal_5_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_cal_005->id]);

       //Menu Herramientas
         $menu_her_000 = new Menu;
         $menu_her_000->name='detailed_guest_review';
         $menu_her_000->display_name='Diagnósticos huéspedes';
         $menu_her_000->description='Permite visualizar el diagnósticos huéspedes';
         $menu_her_000->url='detailed_guest_review';
         $menu_her_000->section_id=$seccion_admin_e->id;
         $menu_her_000->icons='fa fa-tag';
         $menu_her_000->save();
         $assigned_menu_her_0_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_her_000->id]);
         $assigned_menu_her_0_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_her_000->id]);
         $assigned_menu_her_0_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_her_000->id]);
         $assigned_menu_her_0_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_her_000->id]);
         $assigned_menu_her_0_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_her_000->id]);
         $assigned_menu_her_0_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_her_000->id]);

         $menu_her_001 = new Menu;
         $menu_her_001->name='detailed_server_review';
         $menu_her_001->display_name='Diagnósticos servidores';
         $menu_her_001->description='Permite visualizar el diagnósticos servidores';
         $menu_her_001->url='detailed_server_review';
         $menu_her_001->section_id=$seccion_admin_e->id;
         $menu_her_001->icons='fa fa-tag';
         $menu_her_001->save();
         $assigned_menu_her_1_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_her_001->id]);
         $assigned_menu_her_1_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_her_001->id]);
         $assigned_menu_her_1_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_her_001->id]);
         $assigned_menu_her_1_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_her_001->id]);
         $assigned_menu_her_1_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_her_001->id]);
         $assigned_menu_her_1_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_her_001->id]);

         $menu_her_002 = new Menu;
         $menu_her_002->name='testzone';
         $menu_her_002->display_name='Testeo ZD';
         $menu_her_002->description='Permite realizar los testeos de direcciónes ip con puertos.';
         $menu_her_002->url='testzone';
         $menu_her_002->section_id=$seccion_admin_e->id;
         $menu_her_002->icons='fa fa-tag';
         $menu_her_002->save();
         $assigned_menu_her_2_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_her_002->id]);
         $assigned_menu_her_2_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_her_002->id]);
         $assigned_menu_her_2_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_her_002->id]);
         $assigned_menu_her_2_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_her_002->id]);
         $assigned_menu_her_2_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_her_002->id]);
         $assigned_menu_her_2_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_her_002->id]);

         $menu_equips_001 = new Menu;
         $menu_equips_001->name='group_equipment_letter';
         $menu_equips_001->display_name='Carta de Grupos';
         $menu_equips_001->description='Carta de entrega en base a grupos.';
         $menu_equips_001->url='group_equipment_letter';
         $menu_equips_001->section_id=$seccion_admin_d->id;
         $menu_equips_001->icons='fa fa-tasks';
         $menu_equips_001->save();

         $menu_equips_002 = new Menu;
         $menu_equips_002->name='cover_equipment_delivery';
         $menu_equips_002->display_name='Caratula de entrega';
         $menu_equips_002->description='Caratula de entrega de equipos';
         $menu_equips_002->url='cover_equipment_delivery';
         $menu_equips_002->section_id=$seccion_admin_d->id;
         $menu_equips_002->icons='fa fa-tasks';
         $menu_equips_002->save();

       //Menu Viaticos
         $menu_via_000 = new Menu;
         $menu_via_000->name='dashboard_viaticos';
         $menu_via_000->display_name='Dashboard Viaticos';
         $menu_via_000->description='Permite visualizar el dashboard de viaticos anual';
         $menu_via_000->url='dashboard_viaticos';
         $menu_via_000->section_id=$seccion_admin_f->id;
         $menu_via_000->icons='fa fa-gg-circle';
         $menu_via_000->save();
         $assigned_menu_via_0_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_via_000->id]);
         $assigned_menu_via_0_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_via_000->id]);
         $assigned_menu_via_0_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_via_000->id]);
         $assigned_menu_via_0_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_via_000->id]);
         $assigned_menu_via_0_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_via_000->id]);
         $assigned_menu_via_0_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_via_000->id]);

         $menu_via_001 = new Menu;
         $menu_via_001->name='add_request_via';
         $menu_via_001->display_name='Solicitud Viaticos';
         $menu_via_001->description='Permite solicitar viaticos';
         $menu_via_001->url='add_request_via';
         $menu_via_001->section_id=$seccion_admin_f->id;
         $menu_via_001->icons='fa fa-angle-double-right';
         $menu_via_001->save();
         $assigned_menu_via_1_000 = DB::table('menu_user')->insert(['user_id' => $user_default_0->id ,'menu_id' => $menu_via_001->id]);
         $assigned_menu_via_1_001 = DB::table('menu_user')->insert(['user_id' => $super_admin_a1->id ,'menu_id' => $menu_via_001->id]);
         $assigned_menu_via_1_002 = DB::table('menu_user')->insert(['user_id' => $super_admin_a2->id ,'menu_id' => $menu_via_001->id]);
         $assigned_menu_via_1_003 = DB::table('menu_user')->insert(['user_id' => $super_admin_a3->id ,'menu_id' => $menu_via_001->id]);
         $assigned_menu_via_1_004 = DB::table('menu_user')->insert(['user_id' => $super_admin_a4->id ,'menu_id' => $menu_via_001->id]);
         $assigned_menu_via_1_005 = DB::table('menu_user')->insert(['user_id' => $super_admin_a5->id ,'menu_id' => $menu_via_001->id]);

         $menu_via_003 = new Menu;
         $menu_via_003->name='view_request_via';
         $menu_via_003->display_name='Historial de viaticos';
         $menu_via_003->description='Permite ver sus viaticos asignados';
         $menu_via_003->url='view_request_via';
         $menu_via_003->section_id=$seccion_admin_f->id;
         $menu_via_003->icons='fa fa-circle-thin';
         $menu_via_003->save();

         $menu_via_004 = new Menu;
         $menu_via_004->name='view_request_all_via';
         $menu_via_004->display_name='Todos los viaticos';
         $menu_via_004->description='Permite ver todos viaticos del personal por mes';
         $menu_via_004->url='view_request_all_via';
         $menu_via_004->section_id=$seccion_admin_f->id;
         $menu_via_004->icons='fa fa-circle-thin';
         $menu_via_004->save();

         $menu_via_005 = new Menu;
         $menu_via_005->name='view_request_filter_proy_via';
         $menu_via_005->display_name='Filtro por proyecto - viaticos';
         $menu_via_005->description='Permite filtrar por proyecto todos viaticos del personal';
         $menu_via_005->url='view_request_filter_proy_via';
         $menu_via_005->section_id=$seccion_admin_f->id;
         $menu_via_005->icons='fa fa-circle-thin';
         $menu_via_005->save();

         //Solicitud de Pagos
         $menu_equips_p_000 = new Menu;
         $menu_equips_p_000->name='view_dashboard_req_pay';
         $menu_equips_p_000->display_name='Dashboard de pagos';
         $menu_equips_p_000->description='Dashboard de pagos';
         $menu_equips_p_000->url='view_dashboard_req_pay';
         $menu_equips_p_000->section_id=$seccion_admin_g->id;
         $menu_equips_p_000->icons='fa fa-circle-thin';
         $menu_equips_p_000->save();

         $menu_equips_p_001 = new Menu;
         $menu_equips_p_001->name='view_add_req_pay';
         $menu_equips_p_001->display_name='Solicitud de pagos';
         $menu_equips_p_001->description='Solicitud de pagos';
         $menu_equips_p_001->url='view_add_req_pay';
         $menu_equips_p_001->section_id=$seccion_admin_g->id;
         $menu_equips_p_001->icons='fa fa-circle-thin';
         $menu_equips_p_001->save();

         $menu_equips_p_002 = new Menu;
         $menu_equips_p_002->name='view_history_req_pay';
         $menu_equips_p_002->display_name='Historial de pagos';
         $menu_equips_p_002->description='Historial de pagos';
         $menu_equips_p_002->url='view_history_req_pay';
         $menu_equips_p_002->section_id=$seccion_admin_g->id;
         $menu_equips_p_002->icons='fa fa-circle-thin';
         $menu_equips_p_002->save();

         $menu_equips_p_003 = new Menu;
         $menu_equips_p_003->name='view_history_all_req_pay';
         $menu_equips_p_003->display_name='Historico mensual de pagos';
         $menu_equips_p_003->description='Historico mensual de pagos';
         $menu_equips_p_003->url='view_history_all_req_pay';
         $menu_equips_p_003->section_id=$seccion_admin_g->id;
         $menu_equips_p_003->icons='fa fa-circle-thin';
         $menu_equips_p_003->save();

         $menu_equips_p_004 = new Menu;
         $menu_equips_p_004->name='view_filter_req_pay';
         $menu_equips_p_004->display_name='Filtro por proyecto - Pagos';
         $menu_equips_p_004->description='Permite filtrar por proyecto todos los pagos';
         $menu_equips_p_004->url='view_filter_req_pay';
         $menu_equips_p_004->section_id=$seccion_admin_g->id;
         $menu_equips_p_004->icons='fa fa-circle-thin';
         $menu_equips_p_004->save();

         //Viaticos - Servicio
         $viatic_service_001 = new Viatic_service;
         $viatic_service_001->name='Levantamiento';
         $viatic_service_001->save();

         $viatic_service_002 = new Viatic_service;
         $viatic_service_002->name='Instalación';
         $viatic_service_002->save();

         $viatic_service_003 = new Viatic_service;
         $viatic_service_003->name='Mantenimiento';
         $viatic_service_003->save();

         $viatic_service_004 = new Viatic_service;
         $viatic_service_004->name='Prospección';
         $viatic_service_004->save();

         $viatic_service_005 = new Viatic_service;
         $viatic_service_005->name='Gastos de representación';
         $viatic_service_005->save();

         $viatic_service_001 = new Viatic_service;
         $viatic_service_001->name='Levantamiento';
         $viatic_service_001->save();

         //Viaticos - Estatus
         $viatic_status_001 = new Viatic_state;
         $viatic_status_001->name='Nuevo';
         $viatic_status_001->description='Todas las solicitudes nuevas';
         $viatic_status_001->save();

         $viatic_status_002 = new Viatic_state;
         $viatic_status_002->name='Pendiente';
         $viatic_status_002->description='Cuando viaticos se aprueben';
         $viatic_status_002->save();

         $viatic_status_003 = new Viatic_state;
         $viatic_status_003->name='Verifica';
         $viatic_status_003->description='Todo lo aprobado por viaticos - operacion';
         $viatic_status_003->save();

         $viatic_status_004 = new Viatic_state;
         $viatic_status_004->name='Aprueba';
         $viatic_status_004->description='Todo lo verificado por operacion - gerente';
         $viatic_status_004->save();

         $viatic_status_005 = new Viatic_state;
         $viatic_status_005->name='Declina';
         $viatic_status_005->description='Cuando no se aprueba un gasto';
         $viatic_status_005->save();

         $viatic_status_006 = new Viatic_state;
         $viatic_status_006->name='Pagado';
         $viatic_status_006->description='Cuando se notifica del deposito del viatico y ha sido aprobado por direccion';
         $viatic_status_006->save();

         //Viaticos - Beneficiarios
         $viatic_beneficiary_001 = new Viatic_beneficiary;
         $viatic_beneficiary_001->name='Empleado(s)';
         $viatic_beneficiary_001->save();

         $viatic_beneficiary_002 = new Viatic_beneficiary;
         $viatic_beneficiary_002->name='Profesionista(s)';
         $viatic_beneficiary_002->save();

         $viatic_beneficiary_003 = new Viatic_beneficiary;
         $viatic_beneficiary_003->name='Socio(s)';
         $viatic_beneficiary_003->save();

         //Viaticos - Conceptos
         $viatic_list_concep_001 = new Viatic_list_concept;
         $viatic_list_concep_001->name='Transportación Aerea';
         $viatic_list_concep_001->activar_monto= '1';
         $viatic_list_concep_001->save();

         $viatic_list_concep_002 = new Viatic_list_concept;
         $viatic_list_concep_002->name='Transportación Terrestre';
         $viatic_list_concep_002->activar_monto= '1';
         $viatic_list_concep_002->save();

         $viatic_list_concep_003 = new Viatic_list_concept;
         $viatic_list_concep_003->name='Hospedaje';
         $viatic_list_concep_003->activar_monto= '1';
         $viatic_list_concep_003->save();

         $viatic_list_concep_004 = new Viatic_list_concept;
         $viatic_list_concep_004->name='Alimentación';
         $viatic_list_concep_004->activar_monto= '1';
         $viatic_list_concep_004->save();

         $viatic_list_concep_005 = new Viatic_list_concept;
         $viatic_list_concep_005->name='Renta de autos';
         $viatic_list_concep_005->activar_monto= '1';
         $viatic_list_concep_005->save();

         $viatic_list_concep_006 = new Viatic_list_concept;
         $viatic_list_concep_006->name='Transportes menores';
         $viatic_list_concep_006->activar_monto= '1';
         $viatic_list_concep_006->save();

         $viatic_list_concep_007 = new Viatic_list_concept;
         $viatic_list_concep_007->name='Otros gastos';
         $viatic_list_concep_007->activar_monto= '1';
         $viatic_list_concep_007->save();

         $viatic_list_concep_008 = new Viatic_list_concept;
         $viatic_list_concep_008->name='Gasolina';
         $viatic_list_concep_008->activar_monto= '1';
         $viatic_list_concep_008->save();

         //--- Solicitud de pago ----

         //Forma de pago
         $way_pay_000 = new Payments_way_pay;
         $way_pay_000->name='Transferencia electrónica';
         $way_pay_000->save();

         $way_pay_001 = new Payments_way_pay;
         $way_pay_001->name='Cheque';
         $way_pay_001->save();

         //Area
         $area_pay_000 = new Payments_area;
         $area_pay_000->name='Wifimedia';
         $area_pay_000->save();

         $area_pay_001 = new Payments_area;
         $area_pay_001->name='Servicio administrado';
         $area_pay_001->save();

         $area_pay_002 = new Payments_area;
         $area_pay_002->name='General';
         $area_pay_002->save();

         //Application
         $application_pay_000 = new Payments_application;
         $application_pay_000->name='Proyecto de venta';
         $application_pay_000->save();

         $application_pay_001 = new Payments_application;
         $application_pay_001->name='Proyecto de renta';
         $application_pay_001->save();

         $application_pay_002 = new Payments_application;
         $application_pay_002->name='Gasto general';
         $application_pay_002->save();

         //Classification;
         $classification_pay_000 = new Payments_classification;
         $classification_pay_000->name='Servicios (LUZ, MTTO OFICINA, AGUA, RENTA, TELEFONO, ETC)';
         $classification_pay_000->save();

         $classification_pay_001 = new Payments_classification;
         $classification_pay_001->name='Gasto corriente';
         $classification_pay_001->save();

         $classification_pay_002 = new Payments_classification;
         $classification_pay_002->name='Nomina';
         $classification_pay_002->save();

         $classification_pay_003 = new Payments_classification;
         $classification_pay_003->name='Enlaces';
         $classification_pay_003->save();

         $classification_pay_004 = new Payments_classification;
         $classification_pay_004->name='Equipo activo';
         $classification_pay_004->save();

         $classification_pay_005 = new Payments_classification;
         $classification_pay_005->name='Mano de obra';
         $classification_pay_005->save();

         $classification_pay_006 = new Payments_classification;
         $classification_pay_006->name='Materiales';
         $classification_pay_006->save();

         $classification_pay_007 = new Payments_classification;
         $classification_pay_007->name='Mensajeria y/o envios';
         $classification_pay_007->save();

         $classification_pay_008 = new Payments_classification;
         $classification_pay_008->name='Viaticos y/o gastos de representación publicidad';
         $classification_pay_008->save();

         $classification_pay_009 = new Payments_classification;
         $classification_pay_009->name='Comision agencias';
         $classification_pay_009->save();

         $classification_pay_010 = new Payments_classification;
         $classification_pay_010->name='Comision ventas';
         $classification_pay_010->save();

         $classification_pay_011 = new Payments_classification;
         $classification_pay_011->name='Arrendamiento galerias - aeropuertos';
         $classification_pay_011->save();

         $classification_pay_012 = new Payments_classification;
         $classification_pay_012->name='Arrendamiento autos';
         $classification_pay_012->save();

         $classification_pay_013 = new Payments_classification;
         $classification_pay_013->name='Servicios profesionales externos';
         $classification_pay_013->save();

         $classification_pay_014 = new Payments_classification;
         $classification_pay_014->name='Otros';
         $classification_pay_014->save();

         //Verticals;
         $verticals_pay_000 = new Payments_verticals;
         $verticals_pay_000->name='Aeropuertos';
         $verticals_pay_000->save();

         $verticals_pay_001 = new Payments_verticals;
         $verticals_pay_001->name='Centro comercial';
         $verticals_pay_001->save();

         $verticals_pay_002 = new Payments_verticals;
         $verticals_pay_002->name='Corporativo';
         $verticals_pay_002->save();

         $verticals_pay_003 = new Payments_verticals;
         $verticals_pay_003->name='Escuelas';
         $verticals_pay_003->save();

         $verticals_pay_004 = new Payments_verticals;
         $verticals_pay_004->name='Hospitales';
         $verticals_pay_004->save();

         $verticals_pay_005 = new Payments_verticals;
         $verticals_pay_005->name='Hoteleria';
         $verticals_pay_005->save();

         $verticals_pay_006 = new Payments_verticals;
         $verticals_pay_006->name='Restaurantes';
         $verticals_pay_006->save();

         $verticals_pay_007 = new Payments_verticals;
         $verticals_pay_007->name='Terminal de autobuses';
         $verticals_pay_007->save();

         $verticals_pay_008 = new Payments_verticals;
         $verticals_pay_008->name='Otros';
         $verticals_pay_008->save();

         //Verticals;
         $financing_pay_000 = new Payments_financing;
         $financing_pay_000->name='Capital creditos bancarios';
         $financing_pay_000->save();

         $financing_pay_001 = new Payments_financing;
         $financing_pay_001->name='Arrendamiento financiero';
         $financing_pay_001->save();

         $financing_pay_002 = new Payments_financing;
         $financing_pay_002->name='Arrendamiento de equipos';
         $financing_pay_002->save();

         $financing_pay_003 = new Payments_financing;
         $financing_pay_003->name='Intereses';
         $financing_pay_003->save();

         //Opciones del proyecto;
         $options_pay_000 = new Payments_project_options;
         $options_pay_000->name='Instalación';
         $options_pay_000->save();

         $options_pay_001 = new Payments_project_options;
         $options_pay_001->name='Operación';
         $options_pay_001->save();




  }
}
