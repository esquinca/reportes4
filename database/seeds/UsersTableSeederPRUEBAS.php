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
class UsersTableSeederPRUEBAS extends Seeder
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
      // Proyecto::truncate();


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
        $inventoryviewdethotel2= Permission::create(['name' => 'View detailed for hotel with cost']);
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

        // $viewgeneralreport= Permission::create(['name' => 'View general report']);
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

      //Creamos los usuarios super admin
        $super_admin_a0 = new User;
        $super_admin_a0->name='SuperAdmin';
        $super_admin_a0->email='desarrollo@sitwifi.com';
        $super_admin_a0->city='Cancún, México';
        $super_admin_a0->password= bcrypt('123456');
        $super_admin_a0->avatar= 'dist/img/user.jpg';
        $super_admin_a0->save();
        $super_admin_a0->assignRole($superadminRole);
        //Permisos para el super usuario
          //- Dashboard
            $super_admin_a0->givePermissionTo('View dashboard pral');
          //- Inventario
            $super_admin_a0->givePermissionTo('View detailed for hotel');
            $super_admin_a0->givePermissionTo('View detailed for hotel with cost');
            $super_admin_a0->givePermissionTo('View detailed for proyect');
            $super_admin_a0->givePermissionTo('View cover');
            $super_admin_a0->givePermissionTo('View distribucion');
          //- Equipos
            $super_admin_a0->givePermissionTo('View add equipment');
            $super_admin_a0->givePermissionTo('Create equipment');
            $super_admin_a0->givePermissionTo('View removed equipment');
            $super_admin_a0->givePermissionTo('Removed equipment');
            $super_admin_a0->givePermissionTo('View search equipment');
            $super_admin_a0->givePermissionTo('View move equipment');
            $super_admin_a0->givePermissionTo('Move equipment');
            $super_admin_a0->givePermissionTo('View equipment group');
            $super_admin_a0->givePermissionTo('Add equipment group');
            $super_admin_a0->givePermissionTo('Removed equipment group');
            $super_admin_a0->givePermissionTo('View provider');
            $super_admin_a0->givePermissionTo('Create provider');
            $super_admin_a0->givePermissionTo('Edit provider');
            $super_admin_a0->givePermissionTo('Delete provider');
          //- Reportes
            $super_admin_a0->givePermissionTo('View assign report');
            $super_admin_a0->givePermissionTo('Create assign report');
            $super_admin_a0->givePermissionTo('Edit assign report');
            $super_admin_a0->givePermissionTo('Delete assign report');
            // $super_admin_a0->givePermissionTo('View general report');
            $super_admin_a0->givePermissionTo('Create general report');
            $super_admin_a0->givePermissionTo('View individual capture');
            $super_admin_a0->givePermissionTo('Create individual capture');
            $super_admin_a0->givePermissionTo('View individual general report');
            $super_admin_a0->givePermissionTo('Edit individual general report');
            $super_admin_a0->givePermissionTo('View concierge approval');
            $super_admin_a0->givePermissionTo('Create concierge approval');
            $super_admin_a0->givePermissionTo('Delete concierge approval');
            $super_admin_a0->givePermissionTo('View admin approval');
            $super_admin_a0->givePermissionTo('Option admin approval');
            $super_admin_a0->givePermissionTo('Notification admin approval');
            $super_admin_a0->givePermissionTo('View report');
            $super_admin_a0->givePermissionTo('View report concat');

          //Calificaciones
            $super_admin_a0->givePermissionTo('View dashboard survey nps');
            $super_admin_a0->givePermissionTo('View create survey');
            $super_admin_a0->givePermissionTo('Generate survey');
            $super_admin_a0->givePermissionTo('View capture survey');
            $super_admin_a0->givePermissionTo('Create survey');
            $super_admin_a0->givePermissionTo('View edit survey');
            $super_admin_a0->givePermissionTo('Edit survey');
            $super_admin_a0->givePermissionTo('View results survey');
            $super_admin_a0->givePermissionTo('View survey configuration');
            $super_admin_a0->givePermissionTo('Assign user survey');
            $super_admin_a0->givePermissionTo('Removed user survey');
            $super_admin_a0->givePermissionTo('Generate key user survey');
            $super_admin_a0->givePermissionTo('Send email user survey');
            $super_admin_a0->givePermissionTo('View key user survey');
            $super_admin_a0->givePermissionTo('View survey nps configuration');
          //NPS
            $super_admin_a0->givePermissionTo('View assign hotel user');
            $super_admin_a0->givePermissionTo('Create assign hotel user');
            $super_admin_a0->givePermissionTo('Delete assign hotel user');
            $super_admin_a0->givePermissionTo('View list assign hotel user');
            $super_admin_a0->givePermissionTo('View assign delete client');
            $super_admin_a0->givePermissionTo('View config nps automatic');
            $super_admin_a0->givePermissionTo('Create config nps automatic');
            $super_admin_a0->givePermissionTo('View config nps individual');
            $super_admin_a0->givePermissionTo('Create config nps individual');
          //-Encuesta Sitwifi
            $super_admin_a0->givePermissionTo('View dashboard sitwifi');
            $super_admin_a0->givePermissionTo('View config sitwifi');
            $super_admin_a0->givePermissionTo('Delete config sitwifi');
            $super_admin_a0->givePermissionTo('Send mail sitwifi');

          //- Herramientas
            $super_admin_a0->givePermissionTo('View guest review');
            $super_admin_a0->givePermissionTo('View server review');
            $super_admin_a0->givePermissionTo('View test zd');
          //- Configuración
            $super_admin_a0->givePermissionTo('Create user');
            $super_admin_a0->givePermissionTo('Edit user');
            $super_admin_a0->givePermissionTo('Delete user');
            $super_admin_a0->givePermissionTo('View Configuration');
            $super_admin_a0->givePermissionTo('Edit Configuration');


      //Creamos usuario 1
        $super_admin_a = new User;
        $super_admin_a->name='Alonso de Jesus Cauich Viana';
        $super_admin_a->email='acauich@sitwifi.com';
        $super_admin_a->city='Cancún, México';
        $super_admin_a->password= bcrypt('123456');
        $super_admin_a->avatar= 'dist/img/user.jpg';
        $super_admin_a->save();
        $super_admin_a->assignRole($superadminRole);
        //Permisos para el super usuario
          //- Dashboard
            $super_admin_a->givePermissionTo('View dashboard pral');
          //- Inventario
            $super_admin_a->givePermissionTo('View detailed for hotel');
            $super_admin_a->givePermissionTo('View detailed for hotel with cost');
            $super_admin_a->givePermissionTo('View detailed for proyect');
            $super_admin_a->givePermissionTo('View cover');
            $super_admin_a->givePermissionTo('View distribucion');
          //- Equipos
            $super_admin_a->givePermissionTo('View add equipment');
            $super_admin_a->givePermissionTo('Create equipment');
            $super_admin_a->givePermissionTo('View removed equipment');
            $super_admin_a->givePermissionTo('Removed equipment');
            $super_admin_a->givePermissionTo('View search equipment');
            $super_admin_a->givePermissionTo('View move equipment');
            $super_admin_a->givePermissionTo('Move equipment');
            $super_admin_a->givePermissionTo('View equipment group');
            $super_admin_a->givePermissionTo('Add equipment group');
            $super_admin_a->givePermissionTo('Removed equipment group');
            $super_admin_a->givePermissionTo('View provider');
            $super_admin_a->givePermissionTo('Create provider');
            $super_admin_a->givePermissionTo('Edit provider');
            $super_admin_a->givePermissionTo('Delete provider');
          //- Reportes
            $super_admin_a->givePermissionTo('View assign report');
            $super_admin_a->givePermissionTo('Create assign report');
            $super_admin_a->givePermissionTo('Edit assign report');
            $super_admin_a->givePermissionTo('Delete assign report');
            // $super_admin_a->givePermissionTo('View general report');
            $super_admin_a->givePermissionTo('Create general report');
            $super_admin_a->givePermissionTo('View individual capture');
            $super_admin_a->givePermissionTo('Create individual capture');
            $super_admin_a->givePermissionTo('View individual general report');
            $super_admin_a->givePermissionTo('Edit individual general report');
            $super_admin_a->givePermissionTo('View concierge approval');
            $super_admin_a->givePermissionTo('Create concierge approval');
            $super_admin_a->givePermissionTo('Delete concierge approval');
            $super_admin_a->givePermissionTo('View admin approval');
            $super_admin_a->givePermissionTo('Option admin approval');
            $super_admin_a->givePermissionTo('Notification admin approval');
            $super_admin_a->givePermissionTo('View report');
            $super_admin_a->givePermissionTo('View report concat');
          //Calificaciones
            $super_admin_a->givePermissionTo('View dashboard survey nps');
            $super_admin_a->givePermissionTo('View create survey');
            $super_admin_a->givePermissionTo('Generate survey');
            $super_admin_a->givePermissionTo('View capture survey');
            $super_admin_a->givePermissionTo('Create survey');
            $super_admin_a->givePermissionTo('View edit survey');
            $super_admin_a->givePermissionTo('Edit survey');
            $super_admin_a->givePermissionTo('View results survey');
            $super_admin_a->givePermissionTo('View survey configuration');
            $super_admin_a->givePermissionTo('Assign user survey');
            $super_admin_a->givePermissionTo('Removed user survey');
            $super_admin_a->givePermissionTo('Generate key user survey');
            $super_admin_a->givePermissionTo('Send email user survey');
            $super_admin_a->givePermissionTo('View key user survey');
            $super_admin_a->givePermissionTo('View survey nps configuration');
          //NPS
            $super_admin_a->givePermissionTo('View assign hotel user');
            $super_admin_a->givePermissionTo('Create assign hotel user');
            $super_admin_a->givePermissionTo('Delete assign hotel user');
            $super_admin_a->givePermissionTo('View list assign hotel user');
            $super_admin_a->givePermissionTo('View assign delete client');
            $super_admin_a->givePermissionTo('View config nps automatic');
            $super_admin_a->givePermissionTo('Create config nps automatic');
            $super_admin_a->givePermissionTo('View config nps individual');
            $super_admin_a->givePermissionTo('Create config nps individual');
          //-Encuesta Sitwifi
            $super_admin_a->givePermissionTo('View dashboard sitwifi');
            $super_admin_a->givePermissionTo('View config sitwifi');
            $super_admin_a->givePermissionTo('Delete config sitwifi');
            $super_admin_a->givePermissionTo('Send mail sitwifi');
          //- Herramientas
            $super_admin_a->givePermissionTo('View guest review');
            $super_admin_a->givePermissionTo('View server review');
            $super_admin_a->givePermissionTo('View test zd');
          //- Configuración
            $super_admin_a->givePermissionTo('Create user');
            $super_admin_a->givePermissionTo('Edit user');
            $super_admin_a->givePermissionTo('Delete user');
            $super_admin_a->givePermissionTo('View Configuration');
            $super_admin_a->givePermissionTo('Edit Configuration');
          //Actualizar la sell
            // $user_shell=User::where('id', '=', $super_admin_a->id)->first();
            // $user_shell->shell = Crypt::encrypt($super_admin_a->id);
            // $user_shell->save();

      //Creamos usuario 2
        $super_admin_b = new User;
        $super_admin_b->name='Jose Antonio Esquinca Bonilla';
        $super_admin_b->email='jesquinca@sitwifi.com';
        $super_admin_b->city='Cancún, México';
        $super_admin_b->password= bcrypt('123456');
        $super_admin_b->avatar= 'dist/img/user.jpg';
        $super_admin_b->save();
        $super_admin_b->assignRole($superadminRole);
        //Permisos para el super usuario
          //- Dashboard
          $super_admin_b->givePermissionTo('View dashboard pral');
          //- Inventario
          $super_admin_b->givePermissionTo('View detailed for hotel');
          $super_admin_b->givePermissionTo('View detailed for hotel with cost');
          $super_admin_b->givePermissionTo('View detailed for proyect');
          $super_admin_b->givePermissionTo('View cover');
          $super_admin_b->givePermissionTo('View distribucion');
          //- Equipos
          $super_admin_b->givePermissionTo('View add equipment');
          $super_admin_b->givePermissionTo('Create equipment');
          $super_admin_b->givePermissionTo('View removed equipment');
          $super_admin_b->givePermissionTo('Removed equipment');
          $super_admin_b->givePermissionTo('View search equipment');
          $super_admin_b->givePermissionTo('View move equipment');
          $super_admin_b->givePermissionTo('Move equipment');
          $super_admin_b->givePermissionTo('View equipment group');
          $super_admin_b->givePermissionTo('Add equipment group');
          $super_admin_b->givePermissionTo('Removed equipment group');
          //- Reportes
          $super_admin_b->givePermissionTo('View assign report');
          $super_admin_b->givePermissionTo('Create assign report');
          $super_admin_b->givePermissionTo('Edit assign report');
          $super_admin_b->givePermissionTo('Delete assign report');
          // $super_admin_b->givePermissionTo('View general report');
          $super_admin_b->givePermissionTo('Create general report');
          $super_admin_b->givePermissionTo('View individual capture');
          $super_admin_b->givePermissionTo('Create individual capture');
          $super_admin_b->givePermissionTo('View individual general report');
          $super_admin_b->givePermissionTo('Edit individual general report');
          $super_admin_b->givePermissionTo('View concierge approval');
          $super_admin_b->givePermissionTo('Create concierge approval');
          $super_admin_b->givePermissionTo('Delete concierge approval');
          $super_admin_b->givePermissionTo('View admin approval');
          $super_admin_b->givePermissionTo('Option admin approval');
          $super_admin_b->givePermissionTo('Notification admin approval');
          $super_admin_b->givePermissionTo('View report');
          $super_admin_b->givePermissionTo('View report concat');
          //Calificaciones
          $super_admin_b->givePermissionTo('View dashboard survey nps');
          $super_admin_b->givePermissionTo('View create survey');
          $super_admin_b->givePermissionTo('Generate survey');
          $super_admin_b->givePermissionTo('View capture survey');
          $super_admin_b->givePermissionTo('Create survey');
          $super_admin_b->givePermissionTo('View edit survey');
          $super_admin_b->givePermissionTo('Edit survey');
          $super_admin_b->givePermissionTo('View results survey');
          $super_admin_b->givePermissionTo('View survey configuration');
          $super_admin_b->givePermissionTo('Assign user survey');
          $super_admin_b->givePermissionTo('Removed user survey');
          $super_admin_b->givePermissionTo('Generate key user survey');
          $super_admin_b->givePermissionTo('Send email user survey');
          $super_admin_b->givePermissionTo('View key user survey');
          $super_admin_b->givePermissionTo('View survey nps configuration');
          //NPS
          $super_admin_b->givePermissionTo('View assign hotel user');
          $super_admin_b->givePermissionTo('Create assign hotel user');
          $super_admin_b->givePermissionTo('Delete assign hotel user');
          $super_admin_b->givePermissionTo('View list assign hotel user');
          $super_admin_b->givePermissionTo('View assign delete client');
          $super_admin_b->givePermissionTo('View config nps automatic');
          $super_admin_b->givePermissionTo('Create config nps automatic');
          $super_admin_b->givePermissionTo('View config nps individual');
          $super_admin_b->givePermissionTo('Create config nps individual');
        //-Encuesta Sitwifi
          $super_admin_b->givePermissionTo('View dashboard sitwifi');
          $super_admin_b->givePermissionTo('View config sitwifi');
          $super_admin_b->givePermissionTo('Delete config sitwifi');
          $super_admin_b->givePermissionTo('Send mail sitwifi');
          //- Herramientas
          $super_admin_b->givePermissionTo('View guest review');
          $super_admin_b->givePermissionTo('View server review');
          $super_admin_b->givePermissionTo('View test zd');
          //- Configuración
          $super_admin_b->givePermissionTo('Create user');
          $super_admin_b->givePermissionTo('Edit user');
          $super_admin_b->givePermissionTo('Delete user');
          $super_admin_b->givePermissionTo('View Configuration');
          $super_admin_b->givePermissionTo('Edit Configuration');

      //Creamos usuario 3
        $super_admin_c = new User;
        $super_admin_c->name='Angel Gabriel Ramirez Ruiz';
        $super_admin_c->email='gramirez@sitwifi.com';
        $super_admin_c->city='Cancún, México';
        $super_admin_c->password= bcrypt('123456');
        $super_admin_c->avatar= 'dist/img/user.jpg';
        $super_admin_c->save();
        $super_admin_c->assignRole($superadminRole);
        //Permisos para el super usuario
          //- Dashboard
          $super_admin_c->givePermissionTo('View dashboard pral');
          //- Inventario
          $super_admin_c->givePermissionTo('View detailed for hotel');
          $super_admin_c->givePermissionTo('View detailed for hotel with cost');
          $super_admin_c->givePermissionTo('View detailed for proyect');
          $super_admin_c->givePermissionTo('View cover');
          $super_admin_c->givePermissionTo('View distribucion');
          //- Equipos
          $super_admin_c->givePermissionTo('View add equipment');
          $super_admin_c->givePermissionTo('Create equipment');
          $super_admin_c->givePermissionTo('View removed equipment');
          $super_admin_c->givePermissionTo('Removed equipment');
          $super_admin_c->givePermissionTo('View search equipment');
          $super_admin_c->givePermissionTo('View move equipment');
          $super_admin_c->givePermissionTo('Move equipment');
          $super_admin_c->givePermissionTo('View equipment group');
          $super_admin_c->givePermissionTo('Add equipment group');
          $super_admin_c->givePermissionTo('Removed equipment group');
          //- Reportes
          $super_admin_c->givePermissionTo('View assign report');
          $super_admin_c->givePermissionTo('Create assign report');
          $super_admin_c->givePermissionTo('Edit assign report');
          $super_admin_c->givePermissionTo('Delete assign report');
          // $super_admin_c->givePermissionTo('View general report');
          $super_admin_c->givePermissionTo('Create general report');
          $super_admin_c->givePermissionTo('View individual capture');
          $super_admin_c->givePermissionTo('Create individual capture');
          $super_admin_c->givePermissionTo('View individual general report');
          $super_admin_c->givePermissionTo('Edit individual general report');
          $super_admin_c->givePermissionTo('View concierge approval');
          $super_admin_c->givePermissionTo('Create concierge approval');
          $super_admin_c->givePermissionTo('Delete concierge approval');
          $super_admin_c->givePermissionTo('View admin approval');
          $super_admin_c->givePermissionTo('Option admin approval');
          $super_admin_c->givePermissionTo('Notification admin approval');
          $super_admin_c->givePermissionTo('View report');
          $super_admin_c->givePermissionTo('View report concat');
          //Calificaciones
          $super_admin_c->givePermissionTo('View dashboard survey nps');
          $super_admin_c->givePermissionTo('View create survey');
          $super_admin_c->givePermissionTo('Generate survey');
          $super_admin_c->givePermissionTo('View capture survey');
          $super_admin_c->givePermissionTo('Create survey');
          $super_admin_c->givePermissionTo('View edit survey');
          $super_admin_c->givePermissionTo('Edit survey');
          $super_admin_c->givePermissionTo('View results survey');
          $super_admin_c->givePermissionTo('View survey configuration');
          $super_admin_c->givePermissionTo('Assign user survey');
          $super_admin_c->givePermissionTo('Removed user survey');
          $super_admin_c->givePermissionTo('Generate key user survey');
          $super_admin_c->givePermissionTo('Send email user survey');
          $super_admin_c->givePermissionTo('View key user survey');
          $super_admin_c->givePermissionTo('View survey nps configuration');
          //NPS
          $super_admin_c->givePermissionTo('View assign hotel user');
          $super_admin_c->givePermissionTo('Create assign hotel user');
          $super_admin_c->givePermissionTo('Delete assign hotel user');
          $super_admin_c->givePermissionTo('View list assign hotel user');
          $super_admin_c->givePermissionTo('View assign delete client');
          $super_admin_c->givePermissionTo('View config nps automatic');
          $super_admin_c->givePermissionTo('Create config nps automatic');
          $super_admin_c->givePermissionTo('View config nps individual');
          $super_admin_c->givePermissionTo('Create config nps individual');
        //-Encuesta Sitwifi
          $super_admin_c->givePermissionTo('View dashboard sitwifi');
          $super_admin_c->givePermissionTo('View config sitwifi');
          $super_admin_c->givePermissionTo('Delete config sitwifi');
          $super_admin_c->givePermissionTo('Send mail sitwifi');
          //- Herramientas
          $super_admin_c->givePermissionTo('View guest review');
          $super_admin_c->givePermissionTo('View server review');
          $super_admin_c->givePermissionTo('View test zd');
          //- Configuración
          $super_admin_c->givePermissionTo('Create user');
          $super_admin_c->givePermissionTo('Edit user');
          $super_admin_c->givePermissionTo('Delete user');
          $super_admin_c->givePermissionTo('View Configuration');
          $super_admin_c->givePermissionTo('Edit Configuration');

      //Creamos los usuarios por default
        $user_default_a = new User;
        $user_default_a->name='Default Admin User';
        $user_default_a->email='admin@sitwifi.com';
        $user_default_a->city='Cancún, México';
        $user_default_a->password= bcrypt('123456');
        $user_default_a->avatar= 'dist/img/user.jpg';
        $user_default_a->save();
        $user_default_a->assignRole($adminRole);
        //
        $user_default_b = new User;
        $user_default_b->name='Default Operator User';
        $user_default_b->email='operator@sitwifi.com';
        $user_default_b->city='Cancún, México';
        $user_default_b->password= bcrypt('123456');
        $user_default_b->avatar= 'dist/img/user.jpg';
        $user_default_b->save();
        $user_default_b->assignRole($operatorRole);
        //
        $user_default_c = new User;
        $user_default_c->name='Default User';
        $user_default_c->email='user@sitwifi.com';
        $user_default_c->city='Cancún, México';
        $user_default_c->password= bcrypt('123456');
        $user_default_c->avatar= 'dist/img/user.jpg';
        $user_default_c->save();
        $user_default_c->assignRole($userRole);
        //
        $user_default_d = new User;
        $user_default_d->name='Default Monitor User';
        $user_default_d->email='monitor@sitwifi.com';
        $user_default_d->password= bcrypt('123456');
        $user_default_d->save();
        $user_default_d->assignRole($monitorRole);

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
        $seccion_admin_c->display_name='Calificación';
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

      //Menu Inventario
        $menuAdminA0 = new Menu;
        $menuAdminA0->name='detailed_hotel';
        $menuAdminA0->display_name='Detallado por Hotel';
        $menuAdminA0->description='Permite visualizar el inventario actual de los sitios permitidos.';
        $menuAdminA0->url='detailed_hotel';
        $menuAdminA0->section_id=$seccion_admin_a->id;
        $menuAdminA0->icons='fa fa-circle-o';
        $menuAdminA0->save();
        $assigned_menu_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA0->id]);
        $assigned_menu_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA0->id]);
        $assigned_menu_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA0->id]);
        $assigned_menu_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA0->id]);

        // $menuAdminA1 = new Menu;
        // $menuAdminA1->name='detailed_hotels';
        // $menuAdminA1->display_name='Detallado por Hotel con precios';
        // $menuAdminA1->description='Permite visualizar el inventario actual de los sitios con precios permitidos.';
        // $menuAdminA1->url='detailed_hotels';
        // $menuAdminA1->section_id=$seccion_admin_a->id;
        // $menuAdminA1->icons='fa fa-circle-o';
        // $menuAdminA1->save();
        // $assigned_menu_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA1->id]);
        // $assigned_menu_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA1->id]);
        // $assigned_menu_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA1->id]);
        // $assigned_menu_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA1->id]);

        $menuAdminA2 = new Menu;
        $menuAdminA2->name='detailed_proyect';
        $menuAdminA2->display_name='Detallado por proyecto';
        $menuAdminA2->description='Permite visualizar el inventario actual en base a los proyectos.';
        $menuAdminA2->url='detailed_proyect';
        $menuAdminA2->section_id=$seccion_admin_a->id;
        $menuAdminA2->icons='fa fa-circle-o';
        $menuAdminA2->save();
        $assigned_menu_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA2->id]);
        $assigned_menu_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA2->id]);
        $assigned_menu_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA2->id]);
        $assigned_menu_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA2->id]);

        $menuAdminA3 = new Menu;
        $menuAdminA3->name='detailed_cover';
        $menuAdminA3->display_name='Carta de entrega';
        $menuAdminA3->description='Permite visualizar la carta de entrega.';
        $menuAdminA3->url='detailed_cover';
        $menuAdminA3->section_id=$seccion_admin_a->id;
        $menuAdminA3->icons='fa fa-circle-o';
        $menuAdminA3->save();
        $assigned_menu_d0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA3->id]);
        $assigned_menu_d1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA3->id]);
        $assigned_menu_d2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA3->id]);
        $assigned_menu_d3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA3->id]);

        $menuAdminA4 = new Menu;
        $menuAdminA4->name='detailed_distribution';
        $menuAdminA4->display_name='Distribucion';
        $menuAdminA4->description='Permite visualizar la distribución actual.';
        $menuAdminA4->url='detailed_distribution';
        $menuAdminA4->section_id=$seccion_admin_a->id;
        $menuAdminA4->icons='fa fa-circle-o';
        $menuAdminA4->save();
        $assigned_menu_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminA4->id]);
        $assigned_menu_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminA4->id]);
        $assigned_menu_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminA4->id]);
        $assigned_menu_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminA4->id]);

      //Menu Equipos

        $menuAdminB0 = new Menu;
        $menuAdminB0->name='up_equipment';
        $menuAdminB0->display_name='Altas';
        $menuAdminB0->description='Permite dar de altas nuevos equipos';
        $menuAdminB0->url='up_equipment';
        $menuAdminB0->section_id=$seccion_admin_d->id;
        $menuAdminB0->icons='fa fa-chevron-circle-up';
        $menuAdminB0->save();
        $assigned_menu_one_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB0->id]);
        $assigned_menu_one_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB0->id]);
        $assigned_menu_one_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB0->id]);
        $assigned_menu_one_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB0->id]);

        $menuAdminB1 = new Menu;
        $menuAdminB1->name='down_equipment';
        $menuAdminB1->display_name='Bajas';
        $menuAdminB1->description='Permite dar de baja equipos';
        $menuAdminB1->url='down_equipment';
        $menuAdminB1->section_id=$seccion_admin_d->id;
        $menuAdminB1->icons='fa fa-chevron-circle-down';
        $menuAdminB1->save();
        $assigned_menu_one_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB1->id]);
        $assigned_menu_one_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB1->id]);
        $assigned_menu_one_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB1->id]);
        $assigned_menu_one_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB1->id]);

        $menuAdminB2 = new Menu;
        $menuAdminB2->name='detailed_search';
        $menuAdminB2->display_name='Buscador';
        $menuAdminB2->description='Permite visualizar el buscador de equipos';
        $menuAdminB2->url='detailed_search';
        $menuAdminB2->section_id=$seccion_admin_d->id;
        $menuAdminB2->icons='fa fa-search';
        $menuAdminB2->save();
        $assigned_menu_one_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB2->id]);
        $assigned_menu_one_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB2->id]);
        $assigned_menu_one_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB2->id]);
        $assigned_menu_one_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB2->id]);

        $menuAdminB3 = new Menu;
        $menuAdminB3->name='move_equipment';
        $menuAdminB3->display_name='Movimientos';
        $menuAdminB3->description='Permite mover equipos';
        $menuAdminB3->url='move_equipment';
        $menuAdminB3->section_id=$seccion_admin_d->id;
        $menuAdminB3->icons='fa fa-arrows';
        $menuAdminB3->save();
        $assigned_menu_one_d0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB3->id]);
        $assigned_menu_one_d1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB3->id]);
        $assigned_menu_one_d2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB3->id]);
        $assigned_menu_one_d3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB3->id]);

        $menuAdminB4 = new Menu;
        $menuAdminB4->name='group_equipment';
        $menuAdminB4->display_name='Grupos';
        $menuAdminB4->description='Permite agrupar equipos';
        $menuAdminB4->url='group_equipment';
        $menuAdminB4->section_id=$seccion_admin_d->id;
        $menuAdminB4->icons='fa fa-object-group';
        $menuAdminB4->save();
        $assigned_menu_one_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB4->id]);
        $assigned_menu_one_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB4->id]);
        $assigned_menu_one_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB4->id]);
        $assigned_menu_one_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB4->id]);

        $menuAdminB5 = new Menu;
        $menuAdminB5->name='provider';
        $menuAdminB5->display_name='Proveedor';
        $menuAdminB5->description='Permite agregar los proveedores';
        $menuAdminB5->url='provider';
        $menuAdminB5->section_id=$seccion_admin_d->id;
        $menuAdminB5->icons='fa fa-handshake-o';
        $menuAdminB5->save();
        $assigned_menu_one_f0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminB5->id]);
        $assigned_menu_one_f1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminB5->id]);
        $assigned_menu_one_f2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminB5->id]);
        $assigned_menu_one_f3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminB5->id]);


      //Menu Reportes
        $menuAdminC0 = new Menu;
        $menuAdminC0->name='type_report';
        $menuAdminC0->display_name='Asignación de reporte';
        $menuAdminC0->description='Permite manipular y establecer los valor predeterminados para cada hotel.';
        $menuAdminC0->url='type_report';
        $menuAdminC0->section_id=$seccion_admin_b->id;
        $menuAdminC0->icons='fa fa-square-o';
        $menuAdminC0->save();

        $assigned_menu_two_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC0->id]);
        $assigned_menu_two_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC0->id]);
        $assigned_menu_two_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC0->id]);
        $assigned_menu_two_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC0->id]);

        // $menuAdminC1 = new Menu;
        // $menuAdminC1->name='generate';
        // $menuAdminC1->display_name='Generar Reporte';
        // $menuAdminC1->description='Permite capturar de manera generar el reporte diario del hotel asignado.';
        // $menuAdminC1->url='generate';
        // $menuAdminC1->section_id=$seccion_admin_b->id;
        // $menuAdminC1->icons='fa fa-square-o';
        // $menuAdminC1->save();
        //
        // $assigned_menu_two_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC1->id]);
        // $assigned_menu_two_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC1->id]);
        // $assigned_menu_two_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC1->id]);
        // $assigned_menu_two_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC1->id]);

        $menuAdminC2 = new Menu;
        $menuAdminC2->name='individual';
        $menuAdminC2->display_name='Captura reporte';
        $menuAdminC2->description='Permite realizar la captura individual de cada hotel asignado.';
        $menuAdminC2->url='individual';
        $menuAdminC2->section_id=$seccion_admin_b->id;
        $menuAdminC2->icons='fa fa-square-o';
        $menuAdminC2->save();

        $assigned_menu_two_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC2->id]);
        $assigned_menu_two_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC2->id]);
        $assigned_menu_two_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC2->id]);
        $assigned_menu_two_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC2->id]);

        $menuAdminC3 = new Menu;
        $menuAdminC3->name='edit_report';
        $menuAdminC3->display_name='Editar Reportes';
        $menuAdminC3->description='Permite editar el reporte capturado de cada hotel asignado.';
        $menuAdminC3->url='edit_report';
        $menuAdminC3->section_id=$seccion_admin_b->id;
        $menuAdminC3->icons='fa fa-square-o';
        $menuAdminC3->save();

        $assigned_menu_two_d0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC3->id]);
        $assigned_menu_two_d1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC3->id]);
        $assigned_menu_two_d2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC3->id]);
        $assigned_menu_two_d3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC3->id]);


        $menuAdminC4 = new Menu;
        $menuAdminC4->name='approval';
        $menuAdminC4->display_name='Aprobación Concierge';
        $menuAdminC4->description='Permite realizar la aprobación de concierge.';
        $menuAdminC4->url='approval';
        $menuAdminC4->section_id=$seccion_admin_b->id;
        $menuAdminC4->icons='fa fa-square-o';
        $menuAdminC4->save();

        $assigned_menu_two_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC4->id]);
        $assigned_menu_two_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC4->id]);
        $assigned_menu_two_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC4->id]);
        $assigned_menu_two_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC4->id]);

        $menuAdminC5 = new Menu;
        $menuAdminC5->name='approvals';
        $menuAdminC5->display_name='Aprobación Admin';
        $menuAdminC5->description='Permite verificar y aprobar reportes.';
        $menuAdminC5->url='approvals';
        $menuAdminC5->section_id=$seccion_admin_b->id;
        $menuAdminC5->icons='fa fa-square-o';
        $menuAdminC5->save();

        $assigned_menu_two_f0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC5->id]);
        $assigned_menu_two_f1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC5->id]);
        $assigned_menu_two_f2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC5->id]);
        $assigned_menu_two_f3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC5->id]);

        $menuAdminC6 = new Menu;
        $menuAdminC6->name='viewreports';
        $menuAdminC6->display_name='Ver Reportes';
        $menuAdminC6->description='Permite visualizar los reportes de cada hotel.';
        $menuAdminC6->url='viewreports';
        $menuAdminC6->section_id=$seccion_admin_b->id;
        $menuAdminC6->icons='fa fa-square-o';
        $menuAdminC6->save();

        $assigned_menu_two_g0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC6->id]);
        $assigned_menu_two_g1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC6->id]);
        $assigned_menu_two_g2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC6->id]);
        $assigned_menu_two_g3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC6->id]);

        $menuAdminC7 = new Menu;
        $menuAdminC7->name='viewreportscont';
        $menuAdminC7->display_name='Ver Reportes Cont';
        $menuAdminC7->description='Permite visualizar el reporte concatenado de cada cadena.';
        $menuAdminC7->url='viewreportscont';
        $menuAdminC7->section_id=$seccion_admin_b->id;
        $menuAdminC7->icons='fa fa-square-o';
        $menuAdminC7->save();

        $assigned_menu_two_g0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminC7->id]);
        $assigned_menu_two_g1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminC7->id]);
        $assigned_menu_two_g2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminC7->id]);
        $assigned_menu_two_g3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminC7->id]);


      //Menu Calificaciones
        $menuAdminD01 = new Menu;
        $menuAdminD01->name='view_dashboard_survey_nps';
        $menuAdminD01->display_name='Dashboard encuesta NPS';
        $menuAdminD01->description='Permite visualizar los resultados de la encuesta NPS.';
        $menuAdminD01->url='view_dashboard_survey_nps';
        $menuAdminD01->section_id=$seccion_admin_c->id;
        $menuAdminD01->icons='fa fa-tachometer';
        $menuAdminD01->save();
        $assigned_menu_three_a0A = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD01->id]);
        $assigned_menu_three_a1A = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD01->id]);
        $assigned_menu_three_a2A = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD01->id]);
        $assigned_menu_three_a3A = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD01->id]);

        $menuAdminD02 = new Menu;
        $menuAdminD02->name='view_dashboard_survey_sit';
        $menuAdminD02->display_name='Dashboard encuesta gral';
        $menuAdminD02->description='Permite visualizar los resultados de la encuesta Sitwfi.';
        $menuAdminD02->url='view_dashboard_survey_sit';
        $menuAdminD02->section_id=$seccion_admin_c->id;
        $menuAdminD02->icons='fa fa-tachometer';
        $menuAdminD02->save();
        $assigned_menu_three_a0B = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD02->id]);
        $assigned_menu_three_a1B = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD02->id]);
        $assigned_menu_three_a2B = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD02->id]);
        $assigned_menu_three_a3B = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD02->id]);

        $menuAdminD0 = new Menu;
        $menuAdminD0->name='create_survey_admin';
        $menuAdminD0->display_name='Crear encuesta';
        $menuAdminD0->description='Permite crear la encuesta mensual.';
        $menuAdminD0->url='create_survey_admin';
        $menuAdminD0->section_id=$seccion_admin_c->id;
        $menuAdminD0->icons='fa fa-plus-square-o';
        $menuAdminD0->save();
        $assigned_menu_three_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD0->id]);
        $assigned_menu_three_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD0->id]);
        $assigned_menu_three_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD0->id]);
        $assigned_menu_three_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD0->id]);

        // $menuAdminD1 = new Menu;
        // $menuAdminD1->name='fill_survey_admin';
        // $menuAdminD1->display_name='Llenar encuesta';
        // $menuAdminD1->description='Permite capturar la encuesta mensual de un hotel de manera manual.';
        // $menuAdminD1->url='fill_survey_admin';
        // $menuAdminD1->section_id=$seccion_admin_c->id;
        // $menuAdminD1->icons='fa fa-indent';
        // $menuAdminD1->save();
        // $assigned_menu_three_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD1->id]);
        // $assigned_menu_three_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD1->id]);
        // $assigned_menu_three_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD1->id]);
        // $assigned_menu_three_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD1->id]);

        // $menuAdminD2 = new Menu;
        // $menuAdminD2->name='edit_survey_admin';
        // $menuAdminD2->display_name='Editar encuesta';
        // $menuAdminD2->description='Permite editar una encuesta mensual capturada por un miembro de un hotel.';
        // $menuAdminD2->url='edit_survey_admin';
        // $menuAdminD2->section_id=$seccion_admin_c->id;
        // $menuAdminD2->icons='fa fa-inbox';
        // $menuAdminD2->save();
        // $assigned_menu_three_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD2->id]);
        // $assigned_menu_three_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD2->id]);
        // $assigned_menu_three_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD2->id]);
        // $assigned_menu_three_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD2->id]);

        $menuAdminD3 = new Menu;
        $menuAdminD3->name='survey_results';
        $menuAdminD3->display_name='Resultados encuesta NPS';
        $menuAdminD3->description='Permite visualizar las calificaciones de cada sitio.';
        $menuAdminD3->url='survey_results';
        $menuAdminD3->section_id=$seccion_admin_c->id;
        $menuAdminD3->icons='fa fa-info-circle';
        $menuAdminD3->save();
        $assigned_menu_three_d0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD3->id]);
        $assigned_menu_three_d1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD3->id]);
        $assigned_menu_three_d2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD3->id]);
        $assigned_menu_three_d3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD3->id]);

        // $menuAdminD4 = new Menu;
        // $menuAdminD4->name='configure_survey_admin';
        // $menuAdminD4->display_name='Configuración encuesta gral.';
        // $menuAdminD4->description='Permite configurar las encuestas de cada sitio.';
        // $menuAdminD4->url='configure_survey_admin';
        // $menuAdminD4->section_id=$seccion_admin_c->id;
        // $menuAdminD4->icons='fa fa-cog';
        // $menuAdminD4->save();
        // $assigned_menu_three_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD4->id]);
        // $assigned_menu_three_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD4->id]);
        // $assigned_menu_three_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD4->id]);
        // $assigned_menu_three_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD4->id]);

        $menuAdminD5 = new Menu;
        $menuAdminD5->name='configure_survey_admin_nps';
        $menuAdminD5->display_name='Configuración encuesta NPS.';
        $menuAdminD5->description='Permite configurar las encuestas NPS para los clientes.';
        $menuAdminD5->url='configure_survey_admin_nps';
        $menuAdminD5->section_id=$seccion_admin_c->id;
        $menuAdminD5->icons='fa fa-cog';
        $menuAdminD5->save();
        $assigned_menu_four_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD5->id]);
        $assigned_menu_four_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD5->id]);
        $assigned_menu_four_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD5->id]);
        $assigned_menu_four_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD5->id]);

        $menuAdminD6 = new Menu;
        $menuAdminD6->name='configure_survey_admin_sit';
        $menuAdminD6->display_name='Configuración encuesta gral.';
        $menuAdminD6->description='Permite configurar las encuestas sitwifi para el personal.';
        $menuAdminD6->url='configure_survey_admin_sit';
        $menuAdminD6->section_id=$seccion_admin_c->id;
        $menuAdminD6->icons='fa fa-cog';
        $menuAdminD6->save();
        $assigned_menu_five_e0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminD6->id]);
        $assigned_menu_five_e1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminD6->id]);
        $assigned_menu_five_e2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminD6->id]);
        $assigned_menu_five_e3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminD6->id]);
      //Menu Herramientas
        $menuAdminE0 = new Menu;
        $menuAdminE0->name='detailed_guest_review';
        $menuAdminE0->display_name='Diagnósticos huéspedes';
        $menuAdminE0->description='Permite visualizar el diagnósticos huéspedes';
        $menuAdminE0->url='detailed_guest_review';
        $menuAdminE0->section_id=$seccion_admin_e->id;
        $menuAdminE0->icons='fa fa-tag';
        $menuAdminE0->save();
        $assigned_menu_four_a0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminE0->id]);
        $assigned_menu_four_a1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminE0->id]);
        $assigned_menu_four_a2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminE0->id]);
        $assigned_menu_four_a3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminE0->id]);

        $menuAdminE1 = new Menu;
        $menuAdminE1->name='detailed_server_review';
        $menuAdminE1->display_name='Diagnósticos servidores';
        $menuAdminE1->description='Permite visualizar el diagnósticos servidores';
        $menuAdminE1->url='detailed_server_review';
        $menuAdminE1->section_id=$seccion_admin_e->id;
        $menuAdminE1->icons='fa fa-tag';
        $menuAdminE1->save();
        $assigned_menu_four_b0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminE1->id]);
        $assigned_menu_four_b1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminE1->id]);
        $assigned_menu_four_b2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminE1->id]);
        $assigned_menu_four_b3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminE1->id]);

        $menuAdminE2 = new Menu;
        $menuAdminE2->name='testzone';
        $menuAdminE2->display_name='Testeo ZD';
        $menuAdminE2->description='Permite realizar los testeos de direcciónes ip con puertos.';
        $menuAdminE2->url='testzone';
        $menuAdminE2->section_id=$seccion_admin_e->id;
        $menuAdminE2->icons='fa fa-tag';
        $menuAdminE2->save();
        $assigned_menu_two_c0 = DB::table('menu_user')->insert(['user_id' => $super_admin_a0->id ,'menu_id' => $menuAdminE2->id]);
        $assigned_menu_two_c1 = DB::table('menu_user')->insert(['user_id' => $super_admin_a->id ,'menu_id' => $menuAdminE2->id]);
        $assigned_menu_two_c2 = DB::table('menu_user')->insert(['user_id' => $super_admin_b->id ,'menu_id' => $menuAdminE2->id]);
        $assigned_menu_two_c3 = DB::table('menu_user')->insert(['user_id' => $super_admin_c->id ,'menu_id' => $menuAdminE2->id]);

        //Usuarios del sistema actual
        $user_1 = new User;
        $user_1->name='Oscar Chan';
        $user_1->email='ochan@sitwifi.com';
        $user_1->city='Cancún, México';
        $user_1->password= bcrypt('123456');
        $user_1->avatar= 'dist/img/user.jpg';
        $user_1->save();
        $user_1->assignRole($conciergeRole);

        $user_2 = new User;
        $user_2->name='David Tejero';
        $user_2->email='dtejero@sitwifi.com';
        $user_2->city='Cancún, México';
        $user_2->password= bcrypt('123456');
        $user_2->avatar= 'dist/img/user.jpg';
        $user_2->save();
        $user_2->assignRole($conciergeRole);

        $user_3 = new User;
        $user_3->name='Jose Luis Ortiz';
        $user_3->email='jortiz@sitwifi.com';
        $user_3->city='Cancún, México';
        $user_3->password= bcrypt('123456');
        $user_3->avatar= 'dist/img/user.jpg';
        $user_3->save();
        $user_3->assignRole($conciergeRole);

        $user_4 = new User;
        $user_4->name='Angel Lopez';
        $user_4->email='alopez@sitwifi.com';
        $user_4->city='Cancún, México';
        $user_4->password= bcrypt('123456');
        $user_4->avatar= 'dist/img/user.jpg';
        $user_4->save();
        $user_4->assignRole($conciergeRole);

        $user_5 = new User;
        $user_5->name='Jimmy Novelo';
        $user_5->email='jnovelo@sitwifi.com';
        $user_5->city='Cancún, México';
        $user_5->password= bcrypt('123456');
        $user_5->avatar= 'dist/img/user.jpg';
        $user_5->save();
        $user_5->assignRole($conciergeRole);

        $user_6 = new User;
        $user_6->name='Wilbert Manzanero';
        $user_6->email='wmanzanero@sitwifi.com';
        $user_6->city='Cancún, México';
        $user_6->password= bcrypt('123456');
        $user_6->avatar= 'dist/img/user.jpg';
        $user_6->save();
        $user_6->assignRole($conciergeRole);

        $user_7 = new User;
        $user_7->name='Edgar Miranda';
        $user_7->email='emiranda@sitwifi.com';
        $user_7->city='Cancún, México';
        $user_7->password= bcrypt('123456');
        $user_7->avatar= 'dist/img/user.jpg';
        $user_7->save();
        $user_7->assignRole($conciergeRole);

        $user_8 = new User;
        $user_8->name='Alfredo Lagunes';
        $user_8->email='alagunes@sitwifi.com';
        $user_8->city='Cancún, México';
        $user_8->password= bcrypt('123456');
        $user_8->avatar= 'dist/img/user.jpg';
        $user_8->save();
        $user_8->assignRole($conciergeRole);

        $user_9 = new User;
        $user_9->name='Romahn Gachuz';
        $user_9->email='rgachuz@sitwifi.com';
        $user_9->city='Cancún, México';
        $user_9->password= bcrypt('123456');
        $user_9->avatar= 'dist/img/user.jpg';
        $user_9->save();
        $user_9->assignRole($conciergeRole);

        $user_10 = new User;
        $user_10->name='Jose Luis Briceño';
        $user_10->email='jbriceno@sitwifi.com';
        $user_10->city='Cancún, México';
        $user_10->password= bcrypt('123456');
        $user_10->avatar= 'dist/img/user.jpg';
        $user_10->save();
        $user_10->assignRole($conciergeRole);

        $user_11 = new User;
        $user_11->name='Israel Ojeda';
        $user_11->email='iojeda@sitwifi.com';
        $user_11->city='Cancún, México';
        $user_11->password= bcrypt('123456');
        $user_11->avatar= 'dist/img/user.jpg';
        $user_11->save();
        $user_11->assignRole($conciergeRole);

        $user_12 = new User;
        $user_12->name='Ivan Jim';
        $user_12->email='ajim@sitwifi.com';
        $user_12->city='Cancún, México';
        $user_12->password= bcrypt('123456');
        $user_12->avatar= 'dist/img/user.jpg';
        $user_12->save();
        $user_12->assignRole($conciergeRole);

        $user_13 = new User;
        $user_13->name='Rene Sanchez';
        $user_13->email='fsanchez@sitwifi.com';
        $user_13->city='Cancún, México';
        $user_13->password= bcrypt('123456');
        $user_13->avatar= 'dist/img/user.jpg';
        $user_13->save();
        $user_13->assignRole($conciergeRole);

        $user_14 = new User;
        $user_14->name='Martha Isabel';
        $user_14->email='marthaisabel@sitwifi.com';
        $user_14->city='Cancún, México';
        $user_14->password= bcrypt('123456');
        $user_14->avatar= 'dist/img/user.jpg';
        $user_14->save();
        $user_14->assignRole($conciergeRole);

        $user_15 = new User;
        $user_15->name='Ricardo Nuñez';
        $user_15->email='rnunez@sitwifi.com';
        $user_15->city='Cancún, México';
        $user_15->password= bcrypt('123456');
        $user_15->avatar= 'dist/img/user.jpg';
        $user_15->save();
        $user_15->assignRole($conciergeRole);

        $user_16 = new User;
        $user_16->name='Kevin Perez';
        $user_16->email='kperez@sitwifi.com';
        $user_16->city='Cancún, México';
        $user_16->password= bcrypt('123456');
        $user_16->avatar= 'dist/img/user.jpg';
        $user_16->save();
        $user_16->assignRole($conciergeRole);

        $user_17 = new User;
        $user_17->name='José Jorge Medina';
        $user_17->email='jmedina@sitwifi.com';
        $user_17->city='Cancún, México';
        $user_17->password= bcrypt('123456');
        $user_17->avatar= 'dist/img/user.jpg';
        $user_17->save();
        $user_17->assignRole($conciergeRole);

        $user_18 = new User;
        $user_18->name='Maria del Jesús Ortiz';
        $user_18->email='mortiz@sitwifi.com';
        $user_18->city='Cancún, México';
        $user_18->password= bcrypt('123456');
        $user_18->avatar= 'dist/img/user.jpg';
        $user_18->save();
        $user_18->assignRole($conciergeRole);

        $user_19 = new User;
        $user_19->name='Eloir Bautista';
        $user_19->email='ebautista@sitwifi.com';
        $user_19->city='Cancún, México';
        $user_19->password= bcrypt('123456');
        $user_19->avatar= 'dist/img/user.jpg';
        $user_19->save();
        $user_19->assignRole($conciergeRole);

        $user_20 = new User;
        $user_20->name='Luis Gonzalez';
        $user_20->email='lgonzalez@sitwifi.com';
        $user_20->city='Cancún, México';
        $user_20->password= bcrypt('123456');
        $user_20->avatar= 'dist/img/user.jpg';
        $user_20->save();
        $user_20->assignRole($conciergeRole);

        $user_21 = new User;
        $user_21->name='Jorge Quintanar';
        $user_21->email='jquintanar@sitwifi.com';
        $user_21->city='Cancún, México';
        $user_21->password= bcrypt('123456');
        $user_21->avatar= 'dist/img/user.jpg';
        $user_21->save();
        $user_21->assignRole($conciergeRole);

        $user_22 = new User;
        $user_22->name='Alejandro Maldonado';
        $user_22->email='amaldonado@sitwifi.com';
        $user_22->city='Cancún, México';
        $user_22->password= bcrypt('123456');
        $user_22->avatar= 'dist/img/user.jpg';
        $user_22->save();
        $user_22->assignRole($conciergeRole);

        $user_23 = new User;
        $user_23->name='Omar Serrano';
        $user_23->email='oserrano@sitwifi.com';
        $user_23->city='Cancún, México';
        $user_23->password= bcrypt('123456');
        $user_23->avatar= 'dist/img/user.jpg';
        $user_23->save();
        $user_23->assignRole($conciergeRole);

        $user_24 = new User;
        $user_24->name='Johnny Segura';
        $user_24->email='jsegura@sitwifi.com';
        $user_24->city='Cancún, México';
        $user_24->password= bcrypt('123456');
        $user_24->avatar= 'dist/img/user.jpg';
        $user_24->save();
        $user_24->assignRole($conciergeRole);

        $user_25 = new User;
        $user_25->name='Jose Luis Muñoz';
        $user_25->email='jlmunoz@sitwifi.com';
        $user_25->city='Cancún, México';
        $user_25->password= bcrypt('123456');
        $user_25->avatar= 'dist/img/user.jpg';
        $user_25->save();
        $user_25->assignRole($conciergeRole);

        $user_26 = new User;
        $user_26->name='Miguel Aristides Mateo';
        $user_26->email='amateo@sitwifi.com';
        $user_26->city='Cancún, México';
        $user_26->password= bcrypt('123456');
        $user_26->avatar= 'dist/img/user.jpg';
        $user_26->save();
        $user_26->assignRole($conciergeRole);

        $user_27 = new User;
        $user_27->name='Leo Daniel Fernandez del Angel';
        $user_27->email='lfernandez@sitwifi.com';
        $user_27->city='Cancún, México';
        $user_27->password= bcrypt('123456');
        $user_27->avatar= 'dist/img/user.jpg';
        $user_27->save();
        $user_27->assignRole($conciergeRole);

        $user_28 = new User;
        $user_28->name='Juan Carlos May';
        $user_28->email='jcmay@sitwifi.com';
        $user_28->city='Cancún, México';
        $user_28->password= bcrypt('123456');
        $user_28->avatar= 'dist/img/user.jpg';
        $user_28->save();
        $user_28->assignRole($conciergeRole);

        $user_29 = new User;
        $user_29->name='Manuel Pech';
        $user_29->email='mpech@sitwifi.com';
        $user_29->city='Cancún, México';
        $user_29->password= bcrypt('123456');
        $user_29->avatar= 'dist/img/user.jpg';
        $user_29->save();
        $user_29->assignRole($conciergeRole);

        $user_30 = new User;
        $user_30->name='Miguel Angel Morin Ochoa';
        $user_30->email='morin@sitwifi.com';
        $user_30->city='Cancún, México';
        $user_30->password= bcrypt('123456');
        $user_30->avatar= 'dist/img/user.jpg';
        $user_30->save();
        $user_30->assignRole($conciergeRole);

        $user_31 = new User;
        $user_31->name='Oscar Montes';
        $user_31->email='omontes@sitwifi.com';
        $user_31->city='Cancún, México';
        $user_31->password= bcrypt('123456');
        $user_31->avatar= 'dist/img/user.jpg';
        $user_31->save();
        $user_31->assignRole($conciergeRole);

        $user_32 = new User;
        $user_32->name='Daniel Elena';
        $user_32->email='delena@sitwifi.com';
        $user_32->city='Cancún, México';
        $user_32->password= bcrypt('123456');
        $user_32->avatar= 'dist/img/user.jpg';
        $user_32->save();
        $user_32->assignRole($conciergeRole);

        $user_33 = new User;
        $user_33->name='Diego Orea';
        $user_33->email='dorea@sitwifi.com';
        $user_33->city='Cancún, México';
        $user_33->password= bcrypt('123456');
        $user_33->avatar= 'dist/img/user.jpg';
        $user_33->save();
        $user_33->assignRole($conciergeRole);

        $user_34 = new User;
        $user_34->name='Victor Perez';
        $user_34->email='vperez@sitwifi.com';
        $user_34->city='Cancún, México';
        $user_34->password= bcrypt('123456');
        $user_34->avatar= 'dist/img/user.jpg';
        $user_34->save();
        $user_34->assignRole($conciergeRole);

        $user_35 = new User;
        $user_35->name='Oliver Garcia';
        $user_35->email='ogarcia@sitwifi.com';
        $user_35->city='Cancún, México';
        $user_35->password= bcrypt('123456');
        $user_35->avatar= 'dist/img/user.jpg';
        $user_35->save();
        $user_35->assignRole($conciergeRole);

        $user_36 = new User;
        $user_36->name='Jesus Castillo';
        $user_36->email='jcastillo@sitwifi.com';
        $user_36->city='Cancún, México';
        $user_36->password= bcrypt('123456');
        $user_36->avatar= 'dist/img/user.jpg';
        $user_36->save();
        $user_36->assignRole($conciergeRole);

        $user_37 = new User;
        $user_37->name='Diego Angeles';
        $user_37->email='dangeles@sitwifi.com';
        $user_37->city='Cancún, México';
        $user_37->password= bcrypt('123456');
        $user_37->avatar= 'dist/img/user.jpg';
        $user_37->save();
        $user_37->assignRole($conciergeRole);
        //User admin
        $user_38 = new User;
        $user_38->name='Carlos Mata';
        $user_38->email='cmata@sitwifi.com';
        $user_38->city='Cancún, México';
        $user_38->password= bcrypt('123456');
        $user_38->avatar= 'dist/img/user.jpg';
        $user_38->save();
        $user_38->assignRole($adminRole);

        $user_39 = new User;
        $user_39->name='Ricardo Delgado';
        $user_39->email='rdelgado@sitwifi.com';
        $user_39->city='Cancún, México';
        $user_39->password= bcrypt('123456');
        $user_39->avatar= 'dist/img/user.jpg';
        $user_39->save();
        $user_39->assignRole($adminRole);

        $user_40 = new User;
        $user_40->name='Alejandro Espejo';
        $user_40->email='aespejob@sitwifi.com';
        $user_40->city='Cancún, México';
        $user_40->password= bcrypt('123456');
        $user_40->avatar= 'dist/img/user.jpg';
        $user_40->save();
        $user_40->assignRole($adminRole);

        $user_41 = new User;
        $user_41->name='John Walker';
        $user_41->email='jwalker@sitwifi.com';
        $user_41->city='Cancún, México';
        $user_41->password= bcrypt('123456');
        $user_41->avatar= 'dist/img/user.jpg';
        $user_41->save();
        $user_41->assignRole($adminRole);

        $user_42 = new User;
        $user_42->name='René González';
        $user_42->email='rgonzalez@sitwifi.com';
        $user_42->city='Cancún, México';
        $user_42->password= bcrypt('123456');
        $user_42->avatar= 'dist/img/user.jpg';
        $user_42->save();
        $user_42->assignRole($adminRole);

        $user_43 = new User;
        $user_43->name='Alejandro Espejo';
        $user_43->email='alejandro.espejo@fodeli.com.mx';
        $user_43->city='Cancún, México';
        $user_43->password= bcrypt('123456');
        $user_43->avatar= 'dist/img/user.jpg';
        $user_43->save();
        $user_43->assignRole($adminRole);

        $user_44 = new User;
        $user_44->name='Carlos Rangel';
        $user_44->email='crangel@sitwifi.com';
        $user_44->city='Cancún, México';
        $user_44->password= bcrypt('123456');
        $user_44->avatar= 'dist/img/user.jpg';
        $user_44->save();
        $user_44->assignRole($adminRole);

        $user_45 = new User;
        $user_45->name='Hector Tavera';
        $user_45->email='htavera@sitwifi.com';
        $user_45->city='Cancún, México';
        $user_45->password= bcrypt('123456');
        $user_45->avatar= 'dist/img/user.jpg';
        $user_45->save();
        $user_45->assignRole($adminRole);

        $user_46 = new User;
        $user_46->name='Javier Martinez';
        $user_46->email='jmartinez@sitwifi.com';
        $user_46->city='Cancún, México';
        $user_46->password= bcrypt('123456');
        $user_46->avatar= 'dist/img/user.jpg';
        $user_46->save();
        $user_46->assignRole($adminRole);

        $user_47 = new User;
        $user_47->name='Erick Mayorga';
        $user_47->email='emayorga@sitwifi.com';
        $user_47->city='Cancún, México';
        $user_47->password= bcrypt('123456');
        $user_47->avatar= 'dist/img/user.jpg';
        $user_47->save();
        $user_47->assignRole($adminRole);

        $user_48 = new User;
        $user_48->name='M Montiaga';
        $user_48->email='mmontiaga@sitwifi.com';
        $user_48->city='Cancún, México';
        $user_48->password= bcrypt('123456');
        $user_48->avatar= 'dist/img/user.jpg';
        $user_48->save();
        $user_48->assignRole($adminRole);

        $user_49 = new User;
        $user_49->name='Mariana	Presuel';
        $user_49->email='mariana@sitwifi.com';
        $user_49->city='Cancún, México';
        $user_49->password= bcrypt('123456');
        $user_49->avatar= 'dist/img/user.jpg';
        $user_49->save();
        $user_49->assignRole($adminRole);

        $user_50 = new User;
        $user_50->name='Alejandra Perez';
        $user_50->email='aperez@sitwifi.com';
        $user_50->city='Cancún, México';
        $user_50->password= bcrypt('123456');
        $user_50->avatar= 'dist/img/user.jpg';
        $user_50->save();
        $user_50->assignRole($adminRole);

        $user_51 = new User;
        $user_51->name='Aaron Arciga';
        $user_51->email='aarciga@sitwifi.com';
        $user_51->city='Cancún, México';
        $user_51->password= bcrypt('123456');
        $user_51->avatar= 'dist/img/user.jpg';
        $user_51->save();
        $user_51->assignRole($adminRole);
        //monitor
        $user_52 = new User;
        $user_52->name='Paola Ku';
        $user_52->email='pku@sitwifi.com';
        $user_52->city='Cancún, México';
        $user_52->password= bcrypt('123456');
        $user_52->avatar= 'dist/img/user.jpg';
        $user_52->save();
        $user_52->assignRole($monitorRole);

        $user_53 = new User;
        $user_53->name='Jessica Bernal';
        $user_53->email='jbernal@sitwifi.com';
        $user_53->city='Cancún, México';
        $user_53->password= bcrypt('123456');
        $user_53->avatar= 'dist/img/user.jpg';
        $user_53->save();
        $user_53->assignRole($monitorRole);

        $user_53 = new User;
        $user_53->name='Helpdesk';
        $user_53->email='helpdesk@sitwifi.com';
        $user_53->city='Cancún, México';
        $user_53->password= bcrypt('123456');
        $user_53->avatar= 'dist/img/user.jpg';
        $user_53->save();
        $user_53->assignRole($monitorRole);

      //Creamos las operaciones
        $operation_a = new Operacione;
        $operation_a->Nombre_operacion='Oficinas Sureste y Caribe';
        $operation_a->Descripcion='CUN';
        $operation_a->save();

        $operation_b = new Operacione;
        $operation_b->Nombre_operacion='Oficinas Centro y Norte';
        $operation_b->Descripcion='CDMX';
        $operation_b->save();
      //Creamos las Verticales
        $vertical_a = new Vertical;    $vertical_a->name='Aeropuerto';     $vertical_a->save();
        $vertical_b = new Vertical;    $vertical_b->name='Educación';      $vertical_b->save();
        $vertical_c = new Vertical;    $vertical_c->name='Eventos';        $vertical_c->save();
        $vertical_d = new Vertical;    $vertical_d->name='Hospitalidad';   $vertical_d->save();
        $vertical_e = new Vertical;    $vertical_e->name='MB';             $vertical_e->save();
        $vertical_f = new Vertical;    $vertical_f->name='Oficinas';       $vertical_f->save();
        $vertical_g = new Vertical;    $vertical_g->name='Parques';        $vertical_g->save();
        $vertical_h = new Vertical;    $vertical_h->name='Plaza';          $vertical_h->save();
        $vertical_i = new Vertical;    $vertical_i->name='Restaurantes';   $vertical_i->save();
        $vertical_j = new Vertical;    $vertical_j->name='Retail';         $vertical_j->save();
        $vertical_k = new Vertical;    $vertical_k->name='SITWIFI';        $vertical_k->save();
        $vertical_l = new Vertical;    $vertical_l->name='Transporte';     $vertical_l->save();
      //Creamos las Cadena
        $cadena_1 = new Cadena;    $cadena_1->name='No Aplica';     $cadena_1->save();
        $cadena_2 = new Cadena;    $cadena_2->name='Adamantine';     $cadena_2->save();
        $cadena_3 = new Cadena;    $cadena_3->name='ADO';     $cadena_3->save();
        $cadena_4 = new Cadena;    $cadena_4->name='Aldea Thai';     $cadena_4->save();
        $cadena_5 = new Cadena;    $cadena_5->name='Aliat Universidades';     $cadena_5->save();
        $cadena_6 = new Cadena;    $cadena_6->name='Aluxes';     $cadena_6->save();
        $cadena_7 = new Cadena;    $cadena_7->name='Aquamarina';     $cadena_7->save();
        $cadena_8 = new Cadena;    $cadena_8->name='ASUR';     $cadena_8->save();
        $cadena_9 = new Cadena;    $cadena_9->name='BestDay';     $cadena_9->save();
        $cadena_10 = new Cadena;    $cadena_10->name='Bluebay Resorts';     $cadena_10->save();
        $cadena_11 = new Cadena;    $cadena_11->name='CancunBay';     $cadena_11->save();
        $cadena_12 = new Cadena;    $cadena_12->name='Casa Maya';     $cadena_12->save();
        $cadena_13 = new Cadena;    $cadena_13->name='Colegio Americano de San Carlos';     $cadena_13->save();
        $cadena_14 = new Cadena;    $cadena_14->name='Colegio la Florida';     $cadena_14->save();
        $cadena_15 = new Cadena;    $cadena_15->name='EBC';     $cadena_15->save();
        $cadena_16 = new Cadena;    $cadena_16->name='Experiencias Xcaret';     $cadena_16->save();
        $cadena_17 = new Cadena;    $cadena_17->name='Fiesta Americana';     $cadena_17->save();
        $cadena_18 = new Cadena;    $cadena_18->name='Fontan';     $cadena_18->save();
        $cadena_19 = new Cadena;    $cadena_19->name='FourPoints';     $cadena_19->save();
        $cadena_20 = new Cadena;    $cadena_20->name='Galerias';     $cadena_20->save();
        $cadena_21 = new Cadena;    $cadena_21->name='GAP';     $cadena_21->save();
        $cadena_22 = new Cadena;    $cadena_22->name='H10';     $cadena_22->save();
        $cadena_23 = new Cadena;    $cadena_23->name='Hard Rock';     $cadena_23->save();
        $cadena_24 = new Cadena;    $cadena_24->name='Hostal de la Luz';     $cadena_24->save();
        $cadena_25 = new Cadena;    $cadena_25->name='Iberostar Hoteles';     $cadena_25->save();
        $cadena_26 = new Cadena;    $cadena_26->name='ISEC';     $cadena_26->save();
        $cadena_27 = new Cadena;    $cadena_27->name='ITEMS';     $cadena_27->save();
        $cadena_28 = new Cadena;    $cadena_28->name='Ixchel';     $cadena_28->save();
        $cadena_29 = new Cadena;    $cadena_29->name='Karisma';     $cadena_29->save();
        $cadena_30 = new Cadena;    $cadena_30->name='Kidzania';     $cadena_30->save();
        $cadena_31 = new Cadena;    $cadena_31->name='Laureate Universidades';     $cadena_31->save();
        $cadena_32 = new Cadena;    $cadena_32->name='Liverpool';     $cadena_32->save();
        $cadena_33 = new Cadena;    $cadena_33->name='Mayacobá';     $cadena_33->save();
        $cadena_34 = new Cadena;    $cadena_34->name='McDonalds';     $cadena_34->save();
        $cadena_35 = new Cadena;    $cadena_35->name='Melia hotels';     $cadena_35->save();
        $cadena_36 = new Cadena;    $cadena_36->name='Nuevo Continente';     $cadena_36->save();
        $cadena_37 = new Cadena;    $cadena_37->name='Numa';     $cadena_37->save();
        $cadena_38 = new Cadena;    $cadena_38->name='NYX';     $cadena_38->save();
        $cadena_39 = new Cadena;    $cadena_39->name='Ocean Dream';     $cadena_39->save();
        $cadena_40 = new Cadena;    $cadena_40->name='Okol';     $cadena_40->save();
        $cadena_41 = new Cadena;    $cadena_41->name='OMA';     $cadena_41->save();
        $cadena_42 = new Cadena;    $cadena_42->name='Orbis';     $cadena_42->save();
        $cadena_43 = new Cadena;    $cadena_43->name='Oxford';     $cadena_43->save();
        $cadena_44 = new Cadena;    $cadena_44->name='Palace Resorts';     $cadena_44->save();
        $cadena_45 = new Cadena;    $cadena_45->name='Parnassus Resorts';     $cadena_45->save();
        $cadena_46 = new Cadena;    $cadena_46->name='Patio Universidad';     $cadena_46->save();
        $cadena_47 = new Cadena;    $cadena_47->name='Real Resorts';     $cadena_47->save();
        $cadena_48 = new Cadena;    $cadena_48->name='Sirenis Resorts';     $cadena_48->save();
        $cadena_49 = new Cadena;    $cadena_49->name='Sunset World';     $cadena_49->save();
        $cadena_50 = new Cadena;    $cadena_50->name='UDLA';     $cadena_50->save();
        $cadena_51 = new Cadena;    $cadena_51->name='Unitec';     $cadena_51->save();
        $cadena_52 = new Cadena;    $cadena_52->name='UNLA';     $cadena_52->save();
        $cadena_53 = new Cadena;    $cadena_53->name='UVAQ';     $cadena_53->save();
        $cadena_54 = new Cadena;    $cadena_54->name='UVP';     $cadena_54->save();
        $cadena_55 = new Cadena;    $cadena_55->name='Volaris';     $cadena_55->save();
        $cadena_56 = new Cadena;    $cadena_56->name='WRK';     $cadena_56->save();
        $cadena_57 = new Cadena;    $cadena_57->name='Zentralia';     $cadena_57->save();
      //Creamos las referencias de los hoteles
        $reference_1 = new Reference;
        $reference_1->responsable='Eduardo Arzua';
        $reference_1->area='Gerente de Operaciones  ';
        $reference_1->telefono='(984) 803 14 00';
        $reference_1->correo='eduardo@rivieramanagement.mx';
        $reference_1->save();

        $reference_2 = new Reference;
        $reference_2->responsable='Arturo Sánchez';
        $reference_2->area='Sistemas';
        $reference_2->telefono='(52) 8728080 ext 4034';
        $reference_2->correo='asanchez@azulbeachresorts.com';
        $reference_2->save();

        $reference_3 = new Reference;
        $reference_3->responsable='Julio Ovando';
        $reference_3->area='Gerente de TI';
        $reference_3->telefono='9841278356';
        $reference_3->correo='jovando@azulfiveshotel.com';
        $reference_3->save();

        $reference_4 = new Reference;
        $reference_4->responsable='José Manuel Rivera';
        $reference_4->area='Jefe de Sistemas';
        $reference_4->telefono='9848078830';
        $reference_4->correo='jmrivera@soportech.com.mx';
        $reference_4->save();

        $reference_5 = new Reference;
        $reference_5->responsable='Jorge Pererira Ek';
        $reference_5->area='Gerente de Sistemas';
        $reference_5->telefono='9982243487';
        $reference_5->correo='jpereira@ixco.com.mx';
        $reference_5->save();

        $reference_6 = new Reference;
        $reference_6->responsable='Rigoberto Gomez';
        $reference_6->area='Jefe de Sistemas';
        $reference_6->telefono='9842063477';
        $reference_6->correo='rgomez@eldoradomaroma.com';
        $reference_6->save();

        $reference_7 = new Reference;
        $reference_7->responsable='Robert Juarez';
        $reference_7->area='Gerente de Sistemas';
        $reference_7->telefono='9981957946';
        $reference_7->correo='robert.juarez@oceanhotels.net';
        $reference_7->save();

        $reference_8 = new Reference;
        $reference_8->responsable='Robert Juárez';
        $reference_8->area='Gerente de sistemas';
        $reference_8->telefono='9982872484';
        $reference_8->correo='jlroberto@gmail.com';
        $reference_8->save();

        $reference_9 = new Reference;
        $reference_9->responsable='Hector Aguilera';
        $reference_9->area='Gerente de sistemas';
        $reference_9->telefono='9841697609';
        $reference_9->correo='hector.aguilera@iberostar.com.mx';
        $reference_9->save();

        $reference_10 = new Reference;
        $reference_10->responsable='Guadalupe Constantino';
        $reference_10->area='Gerente de Sistemas';
        $reference_10->telefono='8491047';
        $reference_10->correo='g.constantino@iberostar.com.mx';
        $reference_10->save();

        $reference_11 = new Reference;
        $reference_11->responsable='Lic. Luz del Carmen López';
        $reference_11->area='Operación';
        $reference_11->telefono='019989992010 ext. 5000';
        $reference_11->correo='operations@ixchelbeachhotel.com';
        $reference_11->save();

        $reference_12 = new Reference;
        $reference_12->responsable='Ing. Antonio Salinas';
        $reference_12->area='Sistemas informaticos';
        $reference_12->correo='antonio.salinas@rosewoodhotels.com';
        $reference_12->save();

        $reference_13 = new Reference;
        $reference_13->responsable='Luis Trejo Hurtado';
        $reference_13->area='Infraestructura Tecnológica';
        $reference_13->telefono='8814500';
        $reference_13->correo='ltrejo@sunset.com.mx';
        $reference_13->save();

        $reference_14 = new Reference;
        $reference_14->responsable='Guillermo Ojeda Valera';
        $reference_14->area='GTE Sistemas';
        $reference_14->telefono='3223563718';
        $reference_14->correo='sistemas@grandsirenismatlali.com';
        $reference_14->save();

        $reference_15 = new Reference;
        $reference_15->responsable='Ing Adiacna  Chuy Flores';
        $reference_15->area='Jefe de Mantenimiento';
        $reference_15->telefono='9386885131';
        $reference_15->correo='mantenimiento@zentraliacdcarmen.com';
        $reference_15->save();

        $reference_16 = new Reference;
        $reference_16->responsable='Israel Rivera';
        $reference_16->area='Gte. Sistemas';
        $reference_16->telefono='9848078831';
        $reference_16->correo='sistemas.bbdiamond@bluebayresorts.com';
        $reference_16->save();

        $reference_17 = new Reference;
        $reference_17->responsable='Ing Pedro Joaquin Ortiz Vales';
        $reference_17->area='Jefe de sistemas';
        $reference_17->telefono='9995763429';
        $reference_17->correo='pvales@asur.com.mx';
        $reference_17->save();

        $reference_18 = new Reference;
        $reference_18->responsable='Jimmy Alexis Huezo Garcia';
        $reference_18->area='Sistemas';
        $reference_18->telefono='987-872-0647 EXT 23117';
        $reference_18->correo='jhuezo@asur.com.mx';
        $reference_18->save();

        $reference_19 = new Reference;
        $reference_19->responsable='Salomon Groman';
        $reference_19->area='Gerente General';
        $reference_19->telefono='(987) 8720300 Ext.415';
        $reference_19->correo='gerencia@hotelbcozumel.com';

        $reference_20 = new Reference;
        $reference_20->responsable='Ing. Omar Luna Rodríguez';
        $reference_20->area='Jefe de mantenimiento';
        $reference_20->telefono='2299775354';
        $reference_20->correo='Negrito721ol@gmail.com';
        $reference_20->save();

        $reference_21 = new Reference;
        $reference_21->responsable='Ing. Felix Tapia';
        $reference_21->area='Sistemas';
        $reference_21->telefono='(755) 114 8586';
        $reference_21->correo='sistemasfi@hotelesfontan.com';
        $reference_21->save();

        $reference_22 = new Reference;
        $reference_22->responsable='Ing Enrique Sosa';
        $reference_22->area='Gte de sistemas';
        $reference_22->telefono='9981472112';
        $reference_22->correo='enrique.sosa@oceanhotel.com';
        $reference_22->save();

        $reference_23 = new Reference;
        $reference_23->responsable='Ing. Freddy Tun';
        $reference_23->area='Gte. Sistemas';
        $reference_23->telefono='01(52) 998 848 9334';
        $reference_23->correo='sistemas@nyxhotels.com';
        $reference_23->save();

        $reference_24 = new Reference;
        $reference_24->responsable='Ángel Castro';
        $reference_24->area='Mantenimiento';
        $reference_24->telefono='2292814512';
        $reference_24->save();

        $reference_25 = new Reference;
        $reference_25->responsable='Vucko Raskovic';
        $reference_25->area='IT Manager';
        $reference_25->telefono='+18766200100 Ext. 8026';
        $reference_25->correo='vraskovic@azulsensatorihoteljamaica.com';
        $reference_25->save();

        $reference_26 = new Reference;
        $reference_26->responsable='Jesus Yamanaka';
        $reference_26->area='Sistemas';
        $reference_26->save();

        $reference_27 = new Reference;
        $reference_27->responsable='Guillermo Vazquez Montes de Oca';
        $reference_27->save();

        $reference_28 = new Reference;
        $reference_28->responsable='Araceli Dorado';
        $reference_28->area='Sistemas';
        $reference_28->telefono='(55) 14438370';
        $reference_28->correo='araceli.dorado@laurete.mx';
        $reference_28->save();

        $reference_29 = new Reference;
        $reference_29->responsable='Ing. Carlos Pech';
        $reference_29->area='Gte. Sistemas';
        $reference_29->telefono='984 175 1813';
        $reference_29->correo='cpech@unicohotelrm.com';
        $reference_29->save();

        $reference_30 = new Reference;
        $reference_30->responsable='Itzel Servin Maravelez';
        $reference_30->area='Presidenta de la Liga de Football en Bikini';
        $reference_30->telefono='9982101476';
        $reference_30->correo='itzel@lfb.com.mx';
        $reference_30->save();

        $reference_31 = new Reference;
        $reference_31->responsable='Lorenzo Antonio Gonzalez Corona';
        $reference_31->area='Soporte Técnico';
        $reference_31->telefono='55 1865 8986';
        $reference_31->correo='antonio.gonzalez@laureate.mx';
        $reference_31->save();

        $reference_32 = new Reference;
        $reference_32->responsable='Héctor Gómez';
        $reference_32->area='Sistemas';
        $reference_32->telefono='5531969484';
        $reference_32->correo='hrgomez@itesm.mx';
        $reference_32->save();

        $reference_33 = new Reference;
        $reference_33->responsable='Christian Maya';
        $reference_33->area='Soporte Tecnico';
        $reference_33->telefono='442 1816 548';
        $reference_33->correo='cmayaabo@mail.unitec.mx';
        $reference_33->save();

        $reference_34 = new Reference;
        $reference_34->responsable='José Alvarado Torres';
        $reference_34->area='Sistemas';
        $reference_34->telefono='921 211 1860';
        $reference_34->correo='jose.alvarado@uvg.edu.mx';
        $reference_34->save();

        $reference_35 = new Reference;
        $reference_35->responsable='Roberto Crespo Schmidt';
        $reference_35->area='Director de Sistemas';
        $reference_35->telefono='5585037114';
        $reference_35->correo='roberto.crespo@gmd.com.mx';
        $reference_35->save();

        $reference_36 = new Reference;
        $reference_36->responsable='Ing. Erick Dueñas';
        $reference_36->area='Sistemas';
        $reference_36->telefono='(55) 7676 7700';
        $reference_36->save();

        $reference_37 = new Reference;
        $reference_37->responsable='Geovanys Leyva';
        $reference_37->save();

        $reference_38 = new Reference;
        $reference_38->responsable='Ing. Erick Boni';
        $reference_38->area='Sistemas';
        $reference_38->telefono='(558) 5716393';
        $reference_38->correo='erick.boni@mazenod.com';
        $reference_38->save();

        $reference_39 = new Reference;
        $reference_39->responsable='Ing. Erick Merino Merino';
        $reference_39->area='Sistemas';
        $reference_39->telefono='01 222 409 9777';
        $reference_39->correo='Sin información';
        $reference_39->save();

        $reference_40 = new Reference;
        $reference_40->responsable='Ing. Gualberto Marquez';
        $reference_40->area='Sistemas';
        $reference_40->telefono='01 55 5485 4988';
        $reference_40->save();
        //Creamos la sucursals
        $sucursal_01 = new Sucursal;
        $sucursal_01->name='SITWIFI';
        $sucursal_01->address='Av. Yachilan';
        $sucursal_01->correo='soporte@sitwifi.zendesk.com';
        $sucursal_01->phone='Sin informacion';
        $sucursal_01->save();
        //Creamos la Servicio
        $servicio_01 = new Servicio;
        $servicio_01->Nombre_servicio='Arrendamiento';
        $servicio_01->save();

        $servicio_02 = new Servicio;
        $servicio_02->Nombre_servicio='Venta';
        $servicio_02->save();

        $servicio_03 = new Servicio;
        $servicio_03->Nombre_servicio='Demo';
        $servicio_03->save();

        $servicio_04 = new Servicio;
        $servicio_04->Nombre_servicio='No aplica';
        $servicio_04->save();

        $servicio_05 = new Servicio;
        $servicio_05->Nombre_servicio='Prestamo';
        $servicio_05->save();

        //Creamos la Proyecto
        // $proyecto_01 = new Proyecto;
        // $proyecto_01->Nombre_proyecto='Aldea Thai Resorts';
        // $proyecto_01->Fecha_inicio='Sin informacion';
        // $proyecto_01->Fecha_termino='Sin informacion';
        // $proyecto_01->save();
        //
        // $proyecto_02 = new Proyecto;
        // $proyecto_02->Nombre_proyecto='Aluxes';
        // $proyecto_02->Fecha_inicio='Sin informacion';
        // $proyecto_02->Fecha_termino='Sin informacion';
        // $proyecto_02->save();

      //Creamos los hoteles
      $hotel_1 = new Hotel;
      $hotel_1->Nombre_hotel='Aldea Thai';
      $hotel_1->Direccion='Playa del Carmen Centro, 77710';
      $hotel_1->Telefono='Sin informacion';
      $hotel_1->cadena_id=$cadena_4->id;
      $hotel_1->Pais='México';
      $hotel_1->Estado='Quintana Roo';
      $hotel_1->vertical_id=$vertical_d->id;
      $hotel_1->dirlogo1='Aldea_Thai.svg';
      $hotel_1->operaciones_id=$operation_a->id;
      $hotel_1->Fecha_inicioP='Sin información';
      $hotel_1->Fecha_terminoP='Sin información';
      $hotel_1->Latitude='20.631871';
      $hotel_1->Longitude='-87.066404';
      $hotel_1->RM='58';
      $hotel_1->ActivarCalificacion='1';
      $hotel_1->ActivarReportes='1';
      $hotel_1->servicios_id =$servicio_01->id;
      // $hotel_1->proyectos_id =$proyecto_01->id;
      $hotel_1->sucursal_id =$sucursal_01->id;
      $hotel_1->save();

      $hotel_2 = new Hotel;
      $hotel_2->Nombre_hotel='Aluxes';
      $hotel_2->Direccion='Av. Adolfo Lopez Mateos S/N, Centro, 77400';
      $hotel_2->Telefono='Sin informacion';
      $hotel_2->cadena_id=$cadena_6->id;
      $hotel_2->Pais='México';
      $hotel_2->Estado='Quintana Roo';
      $hotel_2->vertical_id=$vertical_d->id;
      $hotel_2->dirlogo1='Aluxes.svg';
      $hotel_2->operaciones_id=$operation_a->id;
      $hotel_2->Fecha_inicioP='Sin información';
      $hotel_2->Fecha_terminoP='Sin información';
      $hotel_2->Latitude='21.257913';
      $hotel_2->Longitude='-86.750884';
      $hotel_2->RM='49';
      $hotel_2->ActivarCalificacion='1';
      $hotel_2->ActivarReportes='1';
      $hotel_2->servicios_id =$servicio_02->id;
      // $hotel_2->proyectos_id =$proyecto_01->id;
      $hotel_2->sucursal_id =$sucursal_01->id;
      $hotel_2->save();

      $hotel_3 = new Hotel;
      $hotel_3->Nombre_hotel='Azul Beach';
      $hotel_3->Direccion='Carretera Cancún – Puerto Morelos Km 27.5';
      $hotel_3->Telefono='Sin informacion';
      $hotel_3->cadena_id=$cadena_29->id;
      $hotel_3->Pais='México';
      $hotel_3->Estado='Quintana Roo';
      $hotel_3->vertical_id=$vertical_d->id;
      $hotel_3->dirlogo1='Azul_Beach.svg';
      $hotel_3->operaciones_id=$operation_a->id;
      $hotel_3->Fecha_inicioP='Sin información';
      $hotel_3->Fecha_terminoP='Sin información';
      $hotel_3->Latitude='20.905489';
      $hotel_3->Longitude='-86.847187';
      $hotel_3->RM='102';
      $hotel_3->ActivarCalificacion='1';
      $hotel_3->ActivarReportes='1';
      $hotel_3->servicios_id =$servicio_02->id;
      // $hotel_3->proyectos_id =$proyecto_01->id;
      $hotel_3->sucursal_id =$sucursal_01->id;
      $hotel_3->save();

      $hotel_4 = new Hotel;
      $hotel_4->Nombre_hotel='Azul Sensatori';
      $hotel_4->Direccion='Carretera Federal Cancún-Puerto Morelos';
      $hotel_4->Telefono='Sin informacion';
      $hotel_4->cadena_id=$cadena_29->id;
      $hotel_4->Pais='México';
      $hotel_4->Estado='Quintana Roo';
      $hotel_4->vertical_id=$vertical_d->id;
      $hotel_4->dirlogo1='Azul_Sensatori.svg';
      $hotel_4->operaciones_id=$operation_a->id;
      $hotel_4->Fecha_inicioP='Sin información';
      $hotel_4->Fecha_terminoP='Sin información';
      $hotel_4->Latitude='20.896263';
      $hotel_4->Longitude='-86.856488';
      $hotel_4->RM='153';
      $hotel_4->ActivarCalificacion='1';
      $hotel_4->ActivarReportes='1';
      $hotel_4->servicios_id =$servicio_02->id;
      // $hotel_4->proyectos_id =$proyecto_01->id;
      $hotel_4->sucursal_id =$sucursal_01->id;
      $hotel_4->save();

      $hotel_5 = new Hotel;
      $hotel_5->Nombre_hotel='Azul Five';
      $hotel_5->Direccion='El Limonar Fraccion 2, Acceso Xcalacoco, 7771';
      $hotel_5->Telefono='Sin informacion';
      $hotel_5->cadena_id=$cadena_29->id;
      $hotel_5->Pais='México';
      $hotel_5->Estado='Quintana Roo';
      $hotel_5->vertical_id=$vertical_d->id;
      $hotel_5->dirlogo1='Azul_Five.svg';
      $hotel_5->operaciones_id=$operation_a->id;
      $hotel_5->Fecha_inicioP='Sin información';
      $hotel_5->Fecha_terminoP='Sin información';
      $hotel_5->Latitude='20.665152';
      $hotel_5->Longitude='-87.03463';
      $hotel_5->RM='366';
      $hotel_5->ActivarCalificacion='1';
      $hotel_5->ActivarReportes='1';
      $hotel_5->servicios_id =$servicio_02->id;
      // $hotel_5->proyectos_id =$proyecto_01->id;
      $hotel_5->sucursal_id =$sucursal_01->id;
      $hotel_5->save();

      $hotel_6 = new Hotel;
      $hotel_6->Nombre_hotel='Beach Palace';
      $hotel_6->Direccion='Km 11.5, Blvd. Kukulcan, Zona Hotelera, 77500';
      $hotel_6->Telefono='Sin informacion';
      $hotel_6->cadena_id=$cadena_44->id;
      $hotel_6->Pais='México';
      $hotel_6->Estado='Quintana Roo';
      $hotel_6->vertical_id=$vertical_d->id;
      $hotel_6->dirlogo1='Beach_Palace.svg';
      $hotel_6->operaciones_id=$operation_a->id;
      $hotel_6->Fecha_inicioP='Sin información';
      $hotel_6->Fecha_terminoP='Sin información';
      $hotel_6->Latitude='21.114136';
      $hotel_6->Longitude='-86.759096';
      $hotel_6->RM='103';
      $hotel_6->ActivarCalificacion='1';
      $hotel_6->ActivarReportes='1';
      $hotel_6->servicios_id =$servicio_02->id;
      // $hotel_6->proyectos_id =$proyecto_01->id;
      $hotel_6->sucursal_id =$sucursal_01->id;
      $hotel_6->save();

      $hotel_7 = new Hotel;
      $hotel_7->Nombre_hotel='Bluebay';
      $hotel_7->Direccion='Carretera Chetumal-Puerto Juarez Km. 300';
      $hotel_7->Telefono='Sin informacion';
      $hotel_7->cadena_id=$cadena_10->id;
      $hotel_7->Pais='México';
      $hotel_7->Estado='Quintana Roo';
      $hotel_7->vertical_id=$vertical_d->id;
      $hotel_7->dirlogo1='Bluebay.svg';
      $hotel_7->operaciones_id=$operation_a->id;
      $hotel_7->Fecha_inicioP='Sin información';
      $hotel_7->Fecha_terminoP='Sin información';
      $hotel_7->Latitude='20.700463';
      $hotel_7->Longitude='-87.012931';
      $hotel_7->RM='95';
      $hotel_7->ActivarCalificacion='1';
      $hotel_7->ActivarReportes='1';
      $hotel_7->servicios_id =$servicio_02->id;
      // $hotel_7->proyectos_id =$proyecto_01->id;
      $hotel_7->sucursal_id =$sucursal_01->id;
      $hotel_7->save();

      $hotel_8 = new Hotel;
      $hotel_8->Nombre_hotel='Cancun Bay';
      $hotel_8->Direccion='Blvd. Kulkucan Km. 3.5, Zona Hotelera';
      $hotel_8->Telefono='Sin informacion';
      $hotel_8->cadena_id=$cadena_11->id;
      $hotel_8->Pais='México';
      $hotel_8->Estado='Quintana Roo';
      $hotel_8->vertical_id=$vertical_d->id;
      $hotel_8->dirlogo1='cancun_bay.svg';
      $hotel_8->operaciones_id=$operation_a->id;
      $hotel_8->Fecha_inicioP='Sin información';
      $hotel_8->Fecha_terminoP='Sin información';
      $hotel_8->Latitude='21.149924';
      $hotel_8->Longitude='-86.793257';
      $hotel_8->RM='0';
      $hotel_8->ActivarCalificacion='1';
      $hotel_8->ActivarReportes='1';
      $hotel_8->servicios_id =$servicio_02->id;
      // $hotel_8->proyectos_id =$proyecto_01->id;
      $hotel_8->sucursal_id =$sucursal_01->id;
      $hotel_8->save();

      $hotel_9 = new Hotel;
      $hotel_9->Nombre_hotel='Casa Maya';
      $hotel_9->Direccion='Blvd. Kukulcán Km. 5.5, Zona Hotelera';
      $hotel_9->Telefono='Sin informacion';
      $hotel_9->cadena_id=$cadena_12->id;
      $hotel_9->Pais='México';
      $hotel_9->Estado='Quintana Roo';
      $hotel_9->vertical_id=$vertical_d->id;
      $hotel_9->dirlogo1='casa_maya.svg';
      $hotel_9->operaciones_id=$operation_a->id;
      $hotel_9->Fecha_inicioP='Sin información';
      $hotel_9->Fecha_terminoP='Sin información';
      $hotel_9->Latitude='21.144984';
      $hotel_9->Longitude='-86.778898';
      $hotel_9->RM='108';
      $hotel_9->ActivarCalificacion='1';
      $hotel_9->ActivarReportes='1';
      $hotel_9->servicios_id =$servicio_02->id;
      // $hotel_9->proyectos_id =$proyecto_01->id;
      $hotel_9->sucursal_id =$sucursal_01->id;
      $hotel_9->save();

      $hotel_10 = new Hotel;
      $hotel_10->Nombre_hotel='Cozumel Palace';
      $hotel_10->Direccion='Av. Rafael E. Melgar Km 15, Zona Hotelera';
      $hotel_10->Telefono='Sin informacion';
      $hotel_10->cadena_id=$cadena_44->id;
      $hotel_10->Pais='México';
      $hotel_10->Estado='Quintana Roo';
      $hotel_10->vertical_id=$vertical_d->id;
      $hotel_10->dirlogo1='cozumel_palace.svg';
      $hotel_10->operaciones_id=$operation_a->id;
      $hotel_10->Fecha_inicioP='Sin información';
      $hotel_10->Fecha_terminoP='Sin información';
      $hotel_10->Latitude='20.503371';
      $hotel_10->Longitude='-86.959408';
      $hotel_10->RM='72';
      $hotel_10->ActivarCalificacion='1';
      $hotel_10->ActivarReportes='1';
      $hotel_10->servicios_id =$servicio_02->id;
      // $hotel_10->proyectos_id =$proyecto_01->id;
      $hotel_10->sucursal_id =$sucursal_01->id;
      $hotel_10->save();

      $hotel_11 = new Hotel;
      $hotel_11->Nombre_hotel='Dorado Maroma';
      $hotel_11->Direccion='Carretera Federal Cancun Tulum Km. 55.3';
      $hotel_11->Telefono='Sin informacion';
      $hotel_11->cadena_id=$cadena_29->id;
      $hotel_11->Pais='México';
      $hotel_11->Estado='Quintana Roo';
      $hotel_11->vertical_id=$vertical_d->id;
      $hotel_11->dirlogo1='dorado_maroma.svg';
      $hotel_11->operaciones_id=$operation_a->id;
      $hotel_11->Fecha_inicioP='Sin información';
      $hotel_11->Fecha_terminoP='Sin información';
      $hotel_11->Latitude='20.723633';
      $hotel_11->Longitude='-87.03463';
      $hotel_11->RM='119';
      $hotel_11->ActivarCalificacion='1';
      $hotel_11->ActivarReportes='1';
      $hotel_11->servicios_id =$servicio_02->id;
      // $hotel_11->proyectos_id =$proyecto_01->id;
      $hotel_11->sucursal_id =$sucursal_01->id;
      $hotel_11->save();

      $hotel_12 = new Hotel;
      $hotel_12->Nombre_hotel='Dorado Seaside';
      $hotel_12->Direccion='Carr Cancun-Tulum km 95, 77710 Kantenah, Q.R';
      $hotel_12->Telefono='Sin informacion';
      $hotel_12->cadena_id=$cadena_29->id;
      $hotel_12->Pais='México';
      $hotel_12->Estado='Quintana Roo';
      $hotel_12->vertical_id=$vertical_d->id;
      $hotel_12->dirlogo1='dorado_seaside.svg';
      $hotel_12->operaciones_id=$operation_a->id;
      $hotel_12->Fecha_inicioP='Sin información';
      $hotel_12->Fecha_terminoP='Sin información';
      $hotel_12->Latitude='20.454772';
      $hotel_12->Longitude='-87.272032';
      $hotel_12->RM='285';
      $hotel_12->ActivarCalificacion='1';
      $hotel_12->ActivarReportes='1';
      $hotel_12->servicios_id =$servicio_02->id;
      // $hotel_12->proyectos_id =$proyecto_01->id;
      $hotel_12->sucursal_id =$sucursal_01->id;
      $hotel_12->save();

      $hotel_13 = new Hotel;
      $hotel_13->Nombre_hotel='Dorado Royal';
      $hotel_13->Direccion='Carretera Cancún - Tulum Km. 45, 77710 Tulum';
      $hotel_13->Telefono='Sin informacion';
      $hotel_13->cadena_id=$cadena_44->id;
      $hotel_13->Pais='México';
      $hotel_13->Estado='Quintana Roo';
      $hotel_13->vertical_id=$vertical_d->id;
      $hotel_13->dirlogo1='dorado_royal.svg';
      $hotel_13->operaciones_id=$operation_a->id;
      $hotel_13->Fecha_inicioP='Sin información';
      $hotel_13->Fecha_terminoP='Sin información';
      $hotel_13->Latitude='20.787275';
      $hotel_13->Longitude='-86.939346';
      $hotel_13->RM='485';
      $hotel_13->ActivarCalificacion='1';
      $hotel_13->ActivarReportes='1';
      $hotel_13->servicios_id =$servicio_02->id;
      // $hotel_13->proyectos_id =$proyecto_01->id;
      $hotel_13->sucursal_id =$sucursal_01->id;
      $hotel_13->save();

      $hotel_14 = new Hotel;
      $hotel_14->Nombre_hotel='Gran Caribe Real';
      $hotel_14->Direccion='Blvd. Kukulcan Km. 11.5, Zona Hotelera, 77500';
      $hotel_14->Telefono='Sin informacion';
      $hotel_14->cadena_id=$cadena_47->id;
      $hotel_14->Pais='México';
      $hotel_14->Estado='Quintana Roo';
      $hotel_14->vertical_id=$vertical_d->id;
      $hotel_14->dirlogo1='caribe_real.svg';
      $hotel_14->operaciones_id=$operation_a->id;
      $hotel_14->Fecha_inicioP='Sin información';
      $hotel_14->Fecha_terminoP='Sin información';
      $hotel_14->Latitude='21.120755';
      $hotel_14->Longitude='-86.755327';
      $hotel_14->RM='172';
      $hotel_14->ActivarCalificacion='1';
      $hotel_14->ActivarReportes='1';
      $hotel_14->servicios_id =$servicio_02->id;
      // $hotel_14->proyectos_id =$proyecto_01->id;
      $hotel_14->sucursal_id =$sucursal_01->id;
      $hotel_14->save();

      $hotel_15 = new Hotel;
      $hotel_15->Nombre_hotel='Gran Porto';
      $hotel_15->Direccion='Av. Constituyentes 1 x 10 y 5ta';
      $hotel_15->Telefono='Sin informacion';
      $hotel_15->cadena_id=$cadena_47->id;
      $hotel_15->Pais='México';
      $hotel_15->Estado='Quintana Roo';
      $hotel_15->vertical_id=$vertical_d->id;
      $hotel_15->dirlogo1='gran_porto.svg';
      $hotel_15->operaciones_id=$operation_a->id;
      $hotel_15->Fecha_inicioP='Sin información';
      $hotel_15->Fecha_terminoP='Sin información';
      $hotel_15->Latitude='20.628532';
      $hotel_15->Longitude='-87.068487';
      $hotel_15->RM='114';
      $hotel_15->ActivarCalificacion='1';
      $hotel_15->ActivarReportes='1';
      $hotel_15->servicios_id =$servicio_02->id;
      // $hotel_15->proyectos_id =$proyecto_01->id;
      $hotel_15->sucursal_id =$sucursal_01->id;
      $hotel_15->save();

      $hotel_16 = new Hotel;
      $hotel_16->Nombre_hotel='H10 Ocean Coral Turqueza';
      $hotel_16->Direccion='Carretera Cancún - Playa del Carmen';
      $hotel_16->Telefono='Sin informacion';
      $hotel_16->cadena_id=$cadena_22->id;
      $hotel_16->Pais='México';
      $hotel_16->Estado='Quintana Roo';
      $hotel_16->vertical_id=$vertical_d->id;
      $hotel_16->dirlogo1='oct.svg';
      $hotel_16->operaciones_id=$operation_a->id;
      $hotel_16->Fecha_inicioP='Sin información';
      $hotel_16->Fecha_terminoP='Sin información';
      $hotel_16->Latitude='20.8842348';
      $hotel_16->Longitude='-86.8660951';
      $hotel_16->RM='251';
      $hotel_16->ActivarCalificacion='1';
      $hotel_16->ActivarReportes='1';
      $hotel_16->servicios_id =$servicio_02->id;
      // $hotel_16->proyectos_id =$proyecto_01->id;
      $hotel_16->sucursal_id =$sucursal_01->id;
      $hotel_16->save();

      $hotel_17 = new Hotel;
      $hotel_17->Nombre_hotel='H10 Ocean Maya Royale';
      $hotel_17->Direccion='Carretera Federal Chetumal Km. 299, 77710';
      $hotel_17->Telefono='Sin informacion';
      $hotel_17->cadena_id=$cadena_22->id;
      $hotel_17->Pais='México';
      $hotel_17->Estado='Quintana Roo';
      $hotel_17->vertical_id=$vertical_d->id;
      $hotel_17->dirlogo1='omr.svg';
      $hotel_17->operaciones_id=$operation_a->id;
      $hotel_17->Fecha_inicioP='Sin información';
      $hotel_17->Fecha_terminoP='Sin información';
      $hotel_17->Latitude='20.6989735';
      $hotel_17->Longitude='-87.0191677';
      $hotel_17->RM='118';
      $hotel_17->ActivarCalificacion='1';
      $hotel_17->ActivarReportes='1';
      $hotel_17->servicios_id =$servicio_02->id;
      // $hotel_17->proyectos_id =$proyecto_01->id;
      $hotel_17->sucursal_id =$sucursal_01->id;
      $hotel_17->save();

      $hotel_18 = new Hotel;
      $hotel_18->Nombre_hotel='Hard Rock Punta Cana';
      $hotel_18->Direccion='Bv. Turístico del Este Km. 28';
      $hotel_18->Telefono='Sin informacion';
      $hotel_18->cadena_id=$cadena_23->id;
      $hotel_18->Pais='México';
      $hotel_18->Estado='Quintana Roo';
      $hotel_18->vertical_id=$vertical_d->id;
      $hotel_18->dirlogo1='hr_punta_cana.svg';
      $hotel_18->operaciones_id=$operation_a->id;
      $hotel_18->Fecha_inicioP='Sin información';
      $hotel_18->Fecha_terminoP='Sin información';
      $hotel_18->Latitude='18.733323';
      $hotel_18->Longitude='-68.482971';
      $hotel_18->RM='753';
      $hotel_18->ActivarCalificacion='1';
      $hotel_18->ActivarReportes='1';
      $hotel_18->servicios_id =$servicio_02->id;
      // $hotel_18->proyectos_id =$proyecto_01->id;
      $hotel_18->sucursal_id =$sucursal_01->id;
      $hotel_18->save();

      $hotel_19 = new Hotel;
      $hotel_19->Nombre_hotel='Hacienda Tres Rios';
      $hotel_19->Direccion='Carretera Federal Cancún-Tulum Km. 54';
      $hotel_19->Telefono='Sin informacion';
      $hotel_19->cadena_id=$cadena_49->id;
      $hotel_19->Pais='México';
      $hotel_19->Estado='Quintana Roo';
      $hotel_19->vertical_id=$vertical_d->id;
      $hotel_19->dirlogo1='htr.svg';
      $hotel_19->operaciones_id=$operation_a->id;
      $hotel_19->Fecha_inicioP='Sin información';
      $hotel_19->Fecha_terminoP='Sin información';
      $hotel_19->Latitude='20.7050416';
      $hotel_19->Longitude='-87.0099105';
      $hotel_19->RM='99';
      $hotel_19->ActivarCalificacion='1';
      $hotel_19->ActivarReportes='1';
      $hotel_19->servicios_id =$servicio_02->id;
      // $hotel_19->proyectos_id =$proyecto_01->id;
      $hotel_19->sucursal_id =$sucursal_01->id;
      $hotel_19->save();

      $hotel_20 = new Hotel;
      $hotel_20->Nombre_hotel='Hyatt Zilara';
      $hotel_20->Direccion='Blvd.Kukulcan KM 11.5, Zona Hotelera, 77500';
      $hotel_20->Telefono='Sin informacion';
      $hotel_20->cadena_id=$cadena_47->id;
      $hotel_20->Pais='México';
      $hotel_20->Estado='Quintana Roo';
      $hotel_20->vertical_id=$vertical_d->id;
      $hotel_20->dirlogo1='hyatt_zilara.svg';
      $hotel_20->operaciones_id=$operation_a->id;
      $hotel_20->Fecha_inicioP='Sin información';
      $hotel_20->Fecha_terminoP='Sin información';
      $hotel_20->Latitude='21.118987';
      $hotel_20->Longitude='-86.756328';
      $hotel_20->RM='88';
      $hotel_20->ActivarCalificacion='1';
      $hotel_20->ActivarReportes='1';
      $hotel_20->servicios_id =$servicio_02->id;
      // $hotel_20->proyectos_id =$proyecto_01->id;
      $hotel_20->sucursal_id =$sucursal_01->id;
      $hotel_20->save();

      $hotel_21 = new Hotel;
      $hotel_21->Nombre_hotel='Iberostar Cancun';
      $hotel_21->Direccion='Blvd. Kukulcan, Zona Hotelera, 77500';
      $hotel_21->Telefono='Sin informacion';
      $hotel_21->cadena_id=$cadena_25->id;
      $hotel_21->Pais='México';
      $hotel_21->Estado='Quintana Roo';
      $hotel_21->vertical_id=$vertical_d->id;
      $hotel_21->dirlogo1='iberostar_cancun.svg';
      $hotel_21->operaciones_id=$operation_a->id;
      $hotel_21->Fecha_inicioP='Sin información';
      $hotel_21->Fecha_terminoP='Sin información';
      $hotel_21->Latitude='21.0671683';
      $hotel_21->Longitude='-86.7805068';
      $hotel_21->RM='197';
      $hotel_21->ActivarCalificacion='1';
      $hotel_21->ActivarReportes='1';
      $hotel_21->servicios_id =$servicio_02->id;
      // $hotel_21->proyectos_id =$proyecto_01->id;
      $hotel_21->sucursal_id =$sucursal_01->id;
      $hotel_21->save();

      $hotel_22 = new Hotel;
      $hotel_22->Nombre_hotel='Iberostar Cozumel';
      $hotel_22->Direccion='Carretera Costera Sur Km. 17782';
      $hotel_22->Telefono='Sin informacion';
      $hotel_22->cadena_id=$cadena_25->id;
      $hotel_22->Pais='México';
      $hotel_22->Estado='Quintana Roo';
      $hotel_22->vertical_id=$vertical_d->id;
      $hotel_22->dirlogo1='iberostar_cozumel.svg';
      $hotel_22->operaciones_id=$operation_a->id;
      $hotel_22->Fecha_inicioP='Sin información';
      $hotel_22->Fecha_terminoP='Sin información';
      $hotel_22->Latitude='20.370339';
      $hotel_22->Longitude='-87.0244907';
      $hotel_22->RM='55';
      $hotel_22->ActivarCalificacion='1';
      $hotel_22->ActivarReportes='1';
      $hotel_22->servicios_id =$servicio_02->id;
      // $hotel_22->proyectos_id =$proyecto_01->id;
      $hotel_22->sucursal_id =$sucursal_01->id;
      $hotel_22->save();

      $hotel_23 = new Hotel;
      $hotel_23->Nombre_hotel='Iberostar Paraiso';
      $hotel_23->Direccion='Blvd. Kukulkan Km 17, Zona Hotelera';
      $hotel_23->Telefono='Sin informacion';
      $hotel_23->cadena_id=$cadena_25->id;
      $hotel_23->Pais='México';
      $hotel_23->Estado='Quintana Roo';
      $hotel_23->vertical_id=$vertical_d->id;
      $hotel_23->dirlogo1='iberostar_paraiso.svg';
      $hotel_23->operaciones_id=$operation_a->id;
      $hotel_23->Fecha_inicioP='Sin información';
      $hotel_23->Fecha_terminoP='Sin información';
      $hotel_23->Latitude='20.7598856';
      $hotel_23->Longitude='-86.9648475';
      $hotel_23->RM='689';
      $hotel_23->ActivarCalificacion='1';
      $hotel_23->ActivarReportes='1';
      $hotel_23->servicios_id =$servicio_02->id;
      // $hotel_23->proyectos_id =$proyecto_01->id;
      $hotel_23->sucursal_id =$sucursal_01->id;
      $hotel_23->save();

      $hotel_24 = new Hotel;
      $hotel_24->Nombre_hotel='Iberostar Playacar';
      $hotel_24->Direccion='Av. Xaman-Ha Lote Hotelero 2';
      $hotel_24->Telefono='Sin informacion';
      $hotel_24->cadena_id=$cadena_25->id;
      $hotel_24->Pais='México';
      $hotel_24->Estado='Quintana Roo';
      $hotel_24->vertical_id=$vertical_d->id;
      $hotel_24->dirlogo1='iberostar_playacar.svg';
      $hotel_24->operaciones_id=$operation_a->id;
      $hotel_24->Fecha_inicioP='Sin información';
      $hotel_24->Fecha_terminoP='Sin información';
      $hotel_24->Latitude='20.60458';
      $hotel_24->Longitude='-87.0959475';
      $hotel_24->RM='243';
      $hotel_24->ActivarCalificacion='1';
      $hotel_24->ActivarReportes='1';
      $hotel_24->servicios_id =$servicio_02->id;
      // $hotel_24->proyectos_id =$proyecto_01->id;
      $hotel_24->sucursal_id =$sucursal_01->id;
      $hotel_24->save();

      $hotel_25 = new Hotel;
      $hotel_25->Nombre_hotel='Isla Palace';
      $hotel_25->Direccion='Blvd. Kukulcan Km. 11.5, Zona Hotelera, 77500';
      $hotel_25->Telefono='Sin informacion';
      $hotel_25->cadena_id=$cadena_44->id;
      $hotel_25->Pais='México';
      $hotel_25->Estado='Quintana Roo';
      $hotel_25->vertical_id=$vertical_d->id;
      $hotel_25->dirlogo1='cozumel_palace.svg';
      $hotel_25->operaciones_id=$operation_a->id;
      $hotel_25->Fecha_inicioP='Sin información';
      $hotel_25->Fecha_terminoP='Sin información';
      $hotel_25->Latitude='21.21928';
      $hotel_25->Longitude='-86.7306947';
      $hotel_25->RM='30';
      $hotel_25->ActivarCalificacion='1';
      $hotel_25->ActivarReportes='1';
      $hotel_25->servicios_id =$servicio_02->id;
      // $hotel_25->proyectos_id =$proyecto_01->id;
      $hotel_25->sucursal_id =$sucursal_01->id;
      $hotel_25->save();

      //Relacionaremos el hotel con su usuario
        $assigned_hotel_user_1 = DB::table('hotel_user')->insert(['user_id' => $user_26->id ,'hotel_id' => $hotel_1->id]);
        $assigned_hotel_user_121 = DB::table('hotel_user')->insert(['user_id' => $user_28->id ,'hotel_id' => $hotel_1->id]);

        $assigned_hotel_user_2 = DB::table('hotel_user')->insert(['user_id' => $user_28->id ,'hotel_id' => $hotel_2->id]);
        $assigned_hotel_user_3 = DB::table('hotel_user')->insert(['user_id' => $user_2->id ,'hotel_id' => $hotel_3->id]);
        $assigned_hotel_user_4 = DB::table('hotel_user')->insert(['user_id' => $user_2->id ,'hotel_id' => $hotel_4->id]);
        $assigned_hotel_user_5 = DB::table('hotel_user')->insert(['user_id' => $user_33->id ,'hotel_id' => $hotel_5->id]);
        $assigned_hotel_user_6 = DB::table('hotel_user')->insert(['user_id' => $user_29->id ,'hotel_id' => $hotel_6->id]);
        $assigned_hotel_user_7 = DB::table('hotel_user')->insert(['user_id' => $user_33->id ,'hotel_id' => $hotel_7->id]);
        $assigned_hotel_user_8 = DB::table('hotel_user')->insert(['user_id' => $user_29->id ,'hotel_id' => $hotel_8->id]);
        $assigned_hotel_user_9 = DB::table('hotel_user')->insert(['user_id' => $user_14->id ,'hotel_id' => $hotel_9->id]);
        $assigned_hotel_user_10 = DB::table('hotel_user')->insert(['user_id' => $user_26->id ,'hotel_id' => $hotel_10->id]);
        $assigned_hotel_user_11 = DB::table('hotel_user')->insert(['user_id' => $user_3->id ,'hotel_id' => $hotel_11->id]);
        $assigned_hotel_user_12 = DB::table('hotel_user')->insert(['user_id' => $user_5->id ,'hotel_id' => $hotel_12->id]);
        $assigned_hotel_user_13 = DB::table('hotel_user')->insert(['user_id' => $user_3->id ,'hotel_id' => $hotel_13->id]);
        $assigned_hotel_user_14 = DB::table('hotel_user')->insert(['user_id' => $user_14->id ,'hotel_id' => $hotel_14->id]);
        $assigned_hotel_user_15 = DB::table('hotel_user')->insert(['user_id' => $user_5->id ,'hotel_id' => $hotel_15->id]);
        $assigned_hotel_user_16 = DB::table('hotel_user')->insert(['user_id' => $user_2->id ,'hotel_id' => $hotel_16->id]);
        $assigned_hotel_user_17 = DB::table('hotel_user')->insert(['user_id' => $user_33->id ,'hotel_id' => $hotel_17->id]);
        $assigned_hotel_user_18 = DB::table('hotel_user')->insert(['user_id' => $user_3->id ,'hotel_id' => $hotel_18->id]);
        $assigned_hotel_user_19 = DB::table('hotel_user')->insert(['user_id' => $user_33->id ,'hotel_id' => $hotel_19->id]);
        $assigned_hotel_user_20 = DB::table('hotel_user')->insert(['user_id' => $user_14->id ,'hotel_id' => $hotel_20->id]);
        $assigned_hotel_user_21 = DB::table('hotel_user')->insert(['user_id' => $user_24->id ,'hotel_id' => $hotel_21->id]);
        $assigned_hotel_user_22 = DB::table('hotel_user')->insert(['user_id' => $user_26->id ,'hotel_id' => $hotel_22->id]);
        $assigned_hotel_user_23 = DB::table('hotel_user')->insert(['user_id' => $user_24->id ,'hotel_id' => $hotel_23->id]);
        $assigned_hotel_user_24 = DB::table('hotel_user')->insert(['user_id' => $user_26->id ,'hotel_id' => $hotel_24->id]);
        $assigned_hotel_user_25 = DB::table('hotel_user')->insert(['user_id' => $user_28->id ,'hotel_id' => $hotel_25->id]);

      //Relacionaremos la referencia_hotel
        $assigned_reference_hotel_1 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_1->id ,'reference_id' => $reference_1->id]);
        $assigned_reference_hotel_2 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_3->id ,'reference_id' => $reference_2->id]);
        $assigned_reference_hotel_3 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_5->id ,'reference_id' => $reference_3->id]);
        $assigned_reference_hotel_4 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_7->id ,'reference_id' => $reference_4->id]);
        $assigned_reference_hotel_5 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_9->id ,'reference_id' => $reference_5->id]);
        $assigned_reference_hotel_6 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_11->id ,'reference_id' => $reference_6->id]);
        $assigned_reference_hotel_7 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_16->id ,'reference_id' => $reference_7->id]);
        $assigned_reference_hotel_8 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_17->id ,'reference_id' => $reference_8->id]);
        $assigned_reference_hotel_9 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_23->id ,'reference_id' => $reference_9->id]);
       $assigned_reference_hotel_10 = DB::table('reference_hotel')->insert(['hotel_id' => $hotel_24->id ,'reference_id' => $reference_10->id]);
      //Creamos los oids
        $oid_1 = new Oid;
        $oid_1->name='ruckusZD1000';
        $oid_1->oid='1.3.6.1.4.1.25053.3.1.5.1.4';
        $oid_1->save();

        $oid_2 = new Oid;
        $oid_2->name='ruckusZD1100';
        $oid_2->oid='1.3.6.1.4.1.25053.3.1.5.2.4';
        $oid_2->save();

        $oid_3 = new Oid;
        $oid_3->name='ruckusZD3000';
        $oid_3->oid='1.3.6.1.4.1.25053.3.1.5.3.4';
        $oid_3->save();

        $oid_4 = new Oid;
        $oid_4->name='ruckusZD5000';
        $oid_4->oid='1.3.6.1.4.1.25053.3.1.5.8.4';
        $oid_4->save();

        $oid_5 = new Oid;
        $oid_5->name='ruckusZD1200 v10';
        $oid_5->oid='1.3.6.1.4.1.25053.3.1.5.15.4';
        $oid_5->save();
      //Creamos los tipos de reportes
        $typereport_1 = new Typereport;
        $typereport_1->name='Basico';
        $typereport_1->save();

        $typereport_2 = new Typereport;
        $typereport_2->name='Concatenado';
        $typereport_2->save();
      //Creamos las direcciones ip de cada Hotel
        $zd_1 = new Zonedirect_ip;
        $zd_1->hotel_id=$hotel_3->id;
        $zd_1->ip='187.157.165.6:1161';
        $zd_1->status='1';
        $zd_1->oid_id=$oid_3->id;
        $zd_1->save();

        $zd_2 = new Zonedirect_ip;
        $zd_2->hotel_id=$hotel_4->id;
        $zd_2->ip='187.141.65.236:1161';
        $zd_2->status='1';
        $zd_2->oid_id=$oid_3->id;
        $zd_2->save();

        $zd_3 = new Zonedirect_ip;
        $zd_3->hotel_id=$hotel_5->id;
        $zd_3->ip='187.157.183.71:1161';
        $zd_3->status='1';
        $zd_3->oid_id=$oid_3->id;
        $zd_3->save();

        $zd_4 = new Zonedirect_ip;
        $zd_4->hotel_id=$hotel_6->id;
        $zd_4->ip='187.237.104.164';
        $zd_4->status='1';
        $zd_4->oid_id=$oid_3->id;
        $zd_4->save();

        $zd_5 = new Zonedirect_ip;
        $zd_5->hotel_id=$hotel_7->id;
        $zd_5->ip='187.189.135.250';
        $zd_5->status='1';
        $zd_5->oid_id=$oid_3->id;
        $zd_5->save();

        $zd_6 = new Zonedirect_ip;
        $zd_6->hotel_id=$hotel_9->id;
        $zd_6->ip='187.189.63.69:161';
        $zd_6->status='1';
        $zd_6->oid_id=$oid_3->id;
        $zd_6->save();

        $zd_7 = new Zonedirect_ip;
        $zd_7->hotel_id=$hotel_10->id;
        $zd_7->ip='187.157.151.52';
        $zd_7->status='1';
        $zd_7->oid_id=$oid_3->id;
        $zd_7->save();

        $zd_8 = new Zonedirect_ip;
        $zd_8->hotel_id=$hotel_11->id;
        $zd_8->ip='189.240.197.4:1161';
        $zd_8->status='1';
        $zd_8->oid_id=$oid_3->id;
        $zd_8->save();

        $zd_9 = new Zonedirect_ip;
        $zd_9->hotel_id=$hotel_12->id;
        $zd_9->ip='187.217.120.133:1161';
        $zd_9->status='1';
        $zd_9->oid_id=$oid_3->id;
        $zd_9->save();

        $zd_10 = new Zonedirect_ip;
        $zd_10->hotel_id=$hotel_13->id;
        $zd_10->ip='187.217.115.165:1161';
        $zd_10->status='1';
        $zd_10->oid_id=$oid_3->id;
        $zd_10->save();

        $zd_11 = new Zonedirect_ip;
        $zd_11->hotel_id=$hotel_14->id;
        $zd_11->ip='201.140.181.201';
        $zd_11->status='1';
        $zd_11->oid_id=$oid_3->id;
        $zd_11->save();

        $zd_12 = new Zonedirect_ip;
        $zd_12->hotel_id=$hotel_15->id;
        $zd_12->ip='177.237.72.62:162';
        $zd_12->status='1';
        $zd_12->oid_id=$oid_3->id;
        $zd_12->save();

        $zd_13 = new Zonedirect_ip;
        $zd_13->hotel_id=$hotel_16->id;
        $zd_13->ip='187.189.195.200';
        $zd_13->status='1';
        $zd_13->oid_id=$oid_3->id;
        $zd_13->save();

        $zd_14 = new Zonedirect_ip;
        $zd_14->hotel_id=$hotel_17->id;
        $zd_14->ip='200.78.168.169';
        $zd_14->status='1';
        $zd_14->oid_id=$oid_3->id;
        $zd_14->save();

        $zd_15 = new Zonedirect_ip;
        $zd_15->hotel_id=$hotel_18->id;
        $zd_15->ip='179.51.74.43:1161';
        $zd_15->status='1';
        $zd_15->oid_id=$oid_3->id;
        $zd_15->save();

        $zd_16 = new Zonedirect_ip;
        $zd_16->hotel_id=$hotel_18->id;
        $zd_16->ip='179.51.74.43:2161';
        $zd_16->status='1';
        $zd_16->oid_id=$oid_3->id;
        $zd_16->save();

        $zd_17 = new Zonedirect_ip;
        $zd_17->hotel_id=$hotel_18->id;
        $zd_17->ip='179.51.74.43:4161';
        $zd_17->status='1';
        $zd_17->oid_id=$oid_3->id;
        $zd_17->save();

        $zd_18 = new Zonedirect_ip;
        $zd_18->hotel_id=$hotel_18->id;
        $zd_18->ip='179.51.74.43:3161';
        $zd_18->status='1';
        $zd_18->oid_id=$oid_3->id;
        $zd_18->save();

        $zd_19 = new Zonedirect_ip;
        $zd_19->hotel_id=$hotel_19->id;
        $zd_19->ip='187.210.92.67';
        $zd_19->status='1';
        $zd_19->oid_id=$oid_3->id;
        $zd_19->save();

        $zd_20 = new Zonedirect_ip;
        $zd_20->hotel_id=$hotel_20->id;
        $zd_20->ip='201.140.187.157';
        $zd_20->status='1';
        $zd_20->oid_id=$oid_3->id;
        $zd_20->save();

        $zd_21 = new Zonedirect_ip;
        $zd_21->hotel_id=$hotel_21->id;
        $zd_21->ip='189.206.2.209:1161';
        $zd_21->status='1';
        $zd_21->oid_id=$oid_3->id;
        $zd_21->save();

        $zd_22 = new Zonedirect_ip;
        $zd_22->hotel_id=$hotel_22->id;
        $zd_22->ip='187.157.233.30:1161';
        $zd_22->status='1';
        $zd_22->oid_id=$oid_3->id;
        $zd_22->save();

        $zd_23 = new Zonedirect_ip;
        $zd_23->hotel_id=$hotel_23->id;
        $zd_23->ip='177.237.78.100:1161';
        $zd_23->status='1';
        $zd_23->oid_id=$oid_3->id;
        $zd_23->save();

        $zd_24 = new Zonedirect_ip;
        $zd_24->hotel_id=$hotel_23->id;
        $zd_24->ip='177.237.78.98:1161';
        $zd_24->status='1';
        $zd_24->oid_id=$oid_3->id;
        $zd_24->save();

        $zd_25 = new Zonedirect_ip;
        $zd_25->hotel_id=$hotel_24->id;
        $zd_25->ip='177.237.79.186:1161';
        $zd_25->status='1';
        $zd_25->oid_id=$oid_3->id;
        $zd_25->save();

        $zd_26 = new Zonedirect_ip;
        $zd_26->hotel_id=$hotel_25->id;
        $zd_26->ip='187.210.77.197';
        $zd_26->status='1';
        $zd_26->oid_id=$oid_2->id;
        $zd_26->save();
      //Creamos hotel_typereport
        $hotel_typereport_1 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_3->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_2 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_4->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_3 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_5->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_4 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_6->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_5 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_7->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_6 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_9->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_7 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_10->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_8 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_11->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_9 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_12->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_10 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_13->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_11 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_14->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_12 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_15->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_13 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_16->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_14 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_17->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_15 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_18->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_16 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_19->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_17 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_20->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_18 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_21->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_19 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_22->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_20 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_23->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_21 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_24->id , 'typereport_id' => $typereport_1->id]);
        $hotel_typereport_22 = DB::table('hotel_typereport')->insert(['hotel_id' => $hotel_25->id , 'typereport_id' => $typereport_1->id]);

        //encuesta
        $estatus_1 = new Estatu;
        $estatus_1->name='Activo';
        $estatus_1->save();

        $estatus_2 = new Estatu;
        $estatus_2->name='Inactivo';
        $estatus_2->save();

        //name encuesta
        $encuesta_1 = new Encuesta;
        $encuesta_1->name='NPS';
        $encuesta_1->save();

        //name encuesta
        $pregunta_1 = new Pregunta;
        $pregunta_1->name='¿Recomendaría el producto o servicio a un familiar o amigo?';
        $pregunta_1->save();

        $encuesta_pregunt= DB::table('encuesta_pregunta')->insert(['encuesta_id' => $encuesta_1->id ,'pregunta_id' => $pregunta_1->id]);

        //Jefe Directo
        $jefedirecto_1 = new Jefedirecto;
        $jefedirecto_1->Nombre='Alejandro Espejo';
        $jefedirecto_1->AreaTrabajo='Director General';
        $jefedirecto_1->email='aespejob@sitwifi.com';
        $jefedirecto_1->save();

        $jefedirecto_2 = new Jefedirecto;
        $jefedirecto_2->Nombre='John Walker';
        $jefedirecto_2->AreaTrabajo='Director Comercial';
        $jefedirecto_2->email='jwalker@sitwifi.com';
        $jefedirecto_2->save();

        $jefedirecto_3 = new Jefedirecto;
        $jefedirecto_3->Nombre='René González';
        $jefedirecto_3->AreaTrabajo='Director Operativo';
        $jefedirecto_3->email='rgonzalez@sitwifi.com';
        $jefedirecto_3->save();

        $jefedirecto_4 = new Jefedirecto;
        $jefedirecto_4->Nombre='Ricardo Delgado';
        $jefedirecto_4->AreaTrabajo='Gerente Soporte Tecnico';
        $jefedirecto_4->email='rdelgado@sitwifi.com';
        $jefedirecto_4->save();

        $jefedirecto_5 = new Jefedirecto;
        $jefedirecto_5->Nombre='Mariana Presuel ';
        $jefedirecto_5->AreaTrabajo='Gerente Recursos Humanos';
        $jefedirecto_5->email='mariana@sitwifi.com';
        $jefedirecto_5->save();

        $jefedirecto_6 = new Jefedirecto;
        $jefedirecto_6->Nombre='Aaron Arciga';
        $jefedirecto_6->AreaTrabajo='Gerente Proyectos e Instalaciones';
        $jefedirecto_6->email='aarciga@sitwifi.com';
        $jefedirecto_6->save();

        //MARCAS Equipos
        $marcas_1 = new Marca;
        $marcas_1->Nombre_marca='ZYXEL';
        $marcas_1->Distribuidor='ZyXEL Communications Corp';
        $marcas_1->save();

        $marcas_2 = new Marca;
        $marcas_2->Nombre_marca='CISCO';
        $marcas_2->Distribuidor='Cisco Systems';
        $marcas_2->save();

        $marcas_3 = new Marca;
        $marcas_3->Nombre_marca='RUCKUS';
        $marcas_3->Distribuidor='Ruckus Wireless';
        $marcas_3->save();

        $marcas_4 = new Marca;
        $marcas_4->Nombre_marca='SonicWall';
        $marcas_4->Distribuidor='DELL';
        $marcas_4->save();

        $marcas_5 = new Marca;
        $marcas_5->Nombre_marca='BitRail';
        $marcas_5->Distribuidor='BITRAIL';
        $marcas_5->save();

        $marcas_6 = new Marca;
        $marcas_6->Nombre_marca='ZEQUENZE';
        $marcas_6->Distribuidor='ZEQUENZE';
        $marcas_6->save();

        $marcas_7 = new Marca;
        $marcas_7->Nombre_marca='RUCKUS Zone Director';
        $marcas_7->Distribuidor='Ruckus Wireless';
        $marcas_7->save();

        $marcas_8 = new Marca;
        $marcas_8->Nombre_marca='Gigabyte';
        $marcas_8->Distribuidor='Gigabyte';
        $marcas_8->save();

        $marcas_9 = new Marca;
        $marcas_9->Nombre_marca='Xi3 Corporation';
        $marcas_9->Distribuidor='Xi3 Corporation';
        $marcas_9->save();

        $marcas_10 = new Marca;
        $marcas_10->Nombre_marca='DELL';
        $marcas_10->Distribuidor='Inc. NASDAQ';
        $marcas_10->save();

        $marcas_11 = new Marca;
        $marcas_11->Nombre_marca='Lenovo';
        $marcas_11->Distribuidor='Lenovo';
        $marcas_11->save();

        $marcas_12 = new Marca;
        $marcas_12->Nombre_marca='Toshiba';
        $marcas_12->Distribuidor='Toshiba';
        $marcas_12->save();

        $marcas_13 = new Marca;
        $marcas_13->Nombre_marca='APC';
        $marcas_13->Distribuidor='American Power Conversion';
        $marcas_13->save();

        $marcas_14 = new Marca;
        $marcas_14->Nombre_marca='MAC';
        $marcas_14->Distribuidor='Apple';
        $marcas_14->save();

        $marcas_15 = new Marca;
        $marcas_15->Nombre_marca='HP';
        $marcas_15->Distribuidor='Hewlett-Packard';
        $marcas_15->save();

        $marcas_16 = new Marca;
        $marcas_16->Nombre_marca='Meraki Cisco';
        $marcas_16->Distribuidor='Cisco Systems';
        $marcas_16->save();

        $marcas_17 = new Marca;
        $marcas_17->Nombre_marca='Icomera';
        $marcas_17->Distribuidor='Icomera AB';
        $marcas_17->save();

        $marcas_18 = new Marca;
        $marcas_18->Nombre_marca='ASUS';
        $marcas_18->Distribuidor='ASUS';
        $marcas_18->save();

        $marcas_19 = new Marca;
        $marcas_19->Nombre_marca='Ruckus Smart Zone';
        $marcas_19->Distribuidor='Ruckus Wireless';
        $marcas_19->save();

        $marcas_20 = new Marca;
        $marcas_20->Nombre_marca='3COM';
        $marcas_20->Distribuidor='3COM';
        $marcas_20->save();

        $marcas_21 = new Marca;
        $marcas_21->Nombre_marca='Cyber Energy';
        $marcas_21->Distribuidor='Cyber Energy';
        $marcas_21->save();

        //Modelos equipos
        $modelo_1 = new Modelo;
        $modelo_1->ModeloNombre = 'BR700G';
        $modelo_1->Costo= '365';
        $modelo_1->save();

        $modelo_2 = new Modelo;
        $modelo_2->ModeloNombre = 'Dell Inspiron 5447';
        $modelo_2->Costo= '365';
        $modelo_2->save();

        $modelo_3 = new Modelo;
        $modelo_3->ModeloNombre = 'Dell Inspiron 5458';
        $modelo_3->Costo= '365';
        $modelo_3->save();

        $modelo_4 = new Modelo;
        $modelo_4->ModeloNombre = 'Dell Inspiton 3442';
        $modelo_4->Costo= '365';
        $modelo_4->save();

        $modelo_5 = new Modelo;
        $modelo_5->ModeloNombre = 'FW7541D-NG1';
        $modelo_5->Costo= '365';
        $modelo_5->save();

        $modelo_6 = new Modelo;
        $modelo_6->ModeloNombre = 'GIGABYTE';
        $modelo_6->Costo= '365';
        $modelo_6->save();

        $modelo_7 = new Modelo;
        $modelo_7->ModeloNombre = 'GS1910-48HP';
        $modelo_7->Costo= '365';
        $modelo_7->save();

        $modelo_8 = new Modelo;
        $modelo_8->ModeloNombre = 'GS1910-8HP';
        $modelo_8->Costo= '365';
        $modelo_8->save();

        $modelo_9 = new Modelo;
        $modelo_9->ModeloNombre = 'GS2200-8HP';
        $modelo_9->Costo= '365';
        $modelo_9->save();

        $modelo_10 = new Modelo;
        $modelo_10->ModeloNombre =  'GS2210-24HP';
        $modelo_10->Costo= '365';
        $modelo_10->save();

        $modelo_11 = new Modelo;
        $modelo_11->ModeloNombre =  'GS2210-48HP';
        $modelo_11->Costo= '365';
        $modelo_11->save();

        $modelo_12 = new Modelo;
        $modelo_12->ModeloNombre =  'GS2210-8';
        $modelo_12->Costo= '365';
        $modelo_12->save();

        $modelo_13 = new Modelo;
        $modelo_13->ModeloNombre =  'GS2210-8HP';
        $modelo_13->Costo= '365';
        $modelo_13->save();

        $modelo_14 = new Modelo;
        $modelo_14->ModeloNombre =  'h500';
        $modelo_14->Costo= '365';
        $modelo_14->save();

        $modelo_15 = new Modelo;
        $modelo_15->ModeloNombre =  'Macbook Pro';
        $modelo_15->Costo= '365';
        $modelo_15->save();

        $modelo_16 = new Modelo;
        $modelo_16->ModeloNombre = 'NSA 250 M';
        $modelo_16->Costo= '365';
        $modelo_16->save();

        $modelo_17 = new Modelo;
        $modelo_17->ModeloNombre = 'NSA 2600';
        $modelo_17->Costo= '365';
        $modelo_17->save();

        $modelo_18 = new Modelo;
        $modelo_18->ModeloNombre = 'NSA 3600';
        $modelo_18->Costo= '365';
        $modelo_18->save();

        $modelo_19 = new Modelo;
        $modelo_19->ModeloNombre = 'p300';
        $modelo_19->Costo= '365';
        $modelo_19->save();

        $modelo_20 = new Modelo;
        $modelo_20->ModeloNombre = 'PRO700';
        $modelo_20->Costo= '365';
        $modelo_20->save();

        $modelo_21 = new Modelo;
        $modelo_21->ModeloNombre = 'r300';
        $modelo_21->Costo= '365';
        $modelo_21->save();

        $modelo_22 = new Modelo;
        $modelo_22->ModeloNombre = 'r600';
        $modelo_22->Costo= '365';
        $modelo_22->save();

        $modelo_23 = new Modelo;
        $modelo_23->ModeloNombre = 'r710';
        $modelo_23->Costo= '365';
        $modelo_23->save();

        $modelo_24 = new Modelo;
        $modelo_24->ModeloNombre = 'Satellite P855-S5312';
        $modelo_24->Costo= '365';
        $modelo_24->save();

        $modelo_25 = new Modelo;
        $modelo_25->ModeloNombre = 'SF200-24P';
        $modelo_25->Costo= '365';
        $modelo_25->save();

        $modelo_26 = new Modelo;
        $modelo_26->ModeloNombre = 'SF300-08';
        $modelo_26->Costo= '365';
        $modelo_26->save();

        $modelo_27 = new Modelo;
        $modelo_27->ModeloNombre = 'SF300-10P';
        $modelo_27->Costo= '365';
        $modelo_27->save();

        $modelo_28 = new Modelo;
        $modelo_28->ModeloNombre = 'SF300-24MP';
        $modelo_28->Costo= '365';
        $modelo_28->save();

        $modelo_29 = new Modelo;
        $modelo_29->ModeloNombre = 'SF300-24P';
        $modelo_29->Costo= '365';
        $modelo_29->save();

        $modelo_30 = new Modelo;
        $modelo_30->ModeloNombre = 'SF300-24PP';
        $modelo_30->Costo= '365';
        $modelo_30->save();

        $modelo_31 = new Modelo;
        $modelo_31->ModeloNombre = 'SF300-48P';
        $modelo_31->Costo= '365';
        $modelo_31->save();

        $modelo_32 = new Modelo;
        $modelo_32->ModeloNombre = 'SF300-8P';
        $modelo_32->Costo= '365';
        $modelo_32->save();

        $modelo_33 = new Modelo;
        $modelo_33->ModeloNombre = 'SF302-08';
        $modelo_33->Costo= '365';
        $modelo_33->save();

        $modelo_34 = new Modelo;
        $modelo_34->ModeloNombre = 'SF302-08M';
        $modelo_34->Costo= '365';
        $modelo_34->save();

        $modelo_35 = new Modelo;
        $modelo_35->ModeloNombre = 'SF302-08MP';
        $modelo_35->Costo= '365';
        $modelo_35->save();

        $modelo_36 = new Modelo;
        $modelo_36->ModeloNombre = 'SF302-08P';
        $modelo_36->Costo= '365';
        $modelo_36->save();

        $modelo_37 = new Modelo;
        $modelo_37->ModeloNombre = 'SG200-26P';
        $modelo_37->Costo= '365';
        $modelo_37->save();

        $modelo_38 = new Modelo;
        $modelo_38->ModeloNombre = 'SG300-10';
        $modelo_38->Costo= '365';
        $modelo_38->save();

        $modelo_39 = new Modelo;
        $modelo_39->ModeloNombre = 'SG300-10MP';
        $modelo_39->Costo= '365';
        $modelo_39->save();

        $modelo_40 = new Modelo;
        $modelo_40->ModeloNombre = 'SG300-10P';
        $modelo_40->Costo= '365';
        $modelo_40->save();

        $modelo_41 = new Modelo;
        $modelo_41->ModeloNombre = 'SG300-24MP';
        $modelo_41->Costo= '365';
        $modelo_41->save();

        $modelo_42 = new Modelo;
        $modelo_42->ModeloNombre = 'SG300-28MP';
        $modelo_42->Costo= '365';
        $modelo_42->save();

        $modelo_43 = new Modelo;
        $modelo_43->ModeloNombre = 'SG300-28P';
        $modelo_43->Costo= '365';
        $modelo_43->save();

        $modelo_44 = new Modelo;
        $modelo_44->ModeloNombre = 'SG300-28PP';
        $modelo_44->Costo= '365';
        $modelo_44->save();

        $modelo_45 = new Modelo;
        $modelo_45->ModeloNombre = 'SG300-52MP';
        $modelo_45->Costo= '365';
        $modelo_45->save();

        $modelo_46 = new Modelo;
        $modelo_46->ModeloNombre = 'SG500-28';
        $modelo_46->Costo= '365';
        $modelo_46->save();

        $modelo_47 = new Modelo;
        $modelo_47->ModeloNombre = 'SG500-28P';
        $modelo_47->Costo= '365';
        $modelo_47->save();

        $modelo_48 = new Modelo;
        $modelo_48->ModeloNombre = 'SG500-52MP';
        $modelo_48->Costo= '365';
        $modelo_48->save();

        $modelo_49 = new Modelo;
        $modelo_49->ModeloNombre = 'SG500X-24';
        $modelo_49->Costo= '365';
        $modelo_49->save();

        $modelo_50 = new Modelo;
        $modelo_50->ModeloNombre = 't300';
        $modelo_50->Costo= '1295';
        $modelo_50->save();

        $modelo_51 = new Modelo;
        $modelo_51->ModeloNombre = 'WS-C2960S-24PS-L';
        $modelo_51->Costo= '365';
        $modelo_51->save();


        $modelo_52 = new Modelo;
        $modelo_52->ModeloNombre = 'Xi3 Corporation';
        $modelo_52->Costo= '365';
        $modelo_52->save();

        $modelo_53 = new Modelo;
        $modelo_53->ModeloNombre = 'z40-70';
        $modelo_53->Costo= '365';
        $modelo_53->save();

        $modelo_54 = new Modelo;
        $modelo_54->ModeloNombre = 'ZD1050';
        $modelo_54->Costo= '365';
        $modelo_54->save();

        $modelo_55 = new Modelo;
        $modelo_55->ModeloNombre = 'ZD1106';
        $modelo_55->Costo= '1200';
        $modelo_55->save();

        $modelo_56 = new Modelo;
        $modelo_56->ModeloNombre = 'ZD1112';
        $modelo_56->Costo= '2000';
        $modelo_56->save();

        $modelo_57 = new Modelo;
        $modelo_57->ModeloNombre = 'ZD1150';
        $modelo_57->Costo= '7000';
        $modelo_57->save();

        $modelo_58 = new Modelo;
        $modelo_58->ModeloNombre = 'ZD1200';
        $modelo_58->Costo= '365';
        $modelo_58->save();

        $modelo_59 = new Modelo;
        $modelo_59->ModeloNombre = 'ZD3025';
        $modelo_59->Costo= '6000';
        $modelo_59->save();

        $modelo_60 = new Modelo;
        $modelo_60->ModeloNombre = 'ZD3050';
        $modelo_60->Costo= '9000';
        $modelo_60->save();

        $modelo_61 = new Modelo;
        $modelo_61->ModeloNombre = 'zf2741';
        $modelo_61->Costo= '1095';
        $modelo_61->save();

        $modelo_62 = new Modelo;
        $modelo_62->ModeloNombre = 'zf2942';
        $modelo_62->Costo= '365';
        $modelo_62->save();

        $modelo_63 = new Modelo;
        $modelo_63->ModeloNombre = 'zf7025';
        $modelo_63->Costo= '249';
        $modelo_63->save();

        $modelo_64 = new Modelo;
        $modelo_64->ModeloNombre = 'zf7055';
        $modelo_64->Costo= '379';
        $modelo_64->save();

        $modelo_65 = new Modelo;
        $modelo_65->ModeloNombre = 'zf7321';
        $modelo_65->Costo= '349';
        $modelo_65->save();

        $modelo_66 = new Modelo;
        $modelo_66->ModeloNombre = 'zf7341';
        $modelo_66->Costo= '399';
        $modelo_66->save();

        $modelo_67 = new Modelo;
        $modelo_67->ModeloNombre = 'zf7352';
        $modelo_67->Costo= '449';
        $modelo_67->save();

        $modelo_68 = new Modelo;
        $modelo_68->ModeloNombre = 'zf7363';
        $modelo_68->Costo= '599';
        $modelo_68->save();

        $modelo_69 = new Modelo;
        $modelo_69->ModeloNombre = 'zf7372';
        $modelo_69->Costo= '649';
        $modelo_69->save();

        $modelo_70 = new Modelo;
        $modelo_70->ModeloNombre = 'zf7731';
        $modelo_70->Costo= '365';
        $modelo_70->save();

        $modelo_71 = new Modelo;
        $modelo_71->ModeloNombre = 'zf7762';
        $modelo_71->Costo= '1999';
        $modelo_71->save();

        $modelo_72 = new Modelo;
        $modelo_72->ModeloNombre = 'zf7782';
        $modelo_72->Costo= '2999';
        $modelo_72->save();

        $modelo_73 = new Modelo;
        $modelo_73->ModeloNombre = 'zf7942';
        $modelo_73->Costo= '365';
        $modelo_73->save();

        $modelo_74 = new Modelo;
        $modelo_74->ModeloNombre = 'zf7962';
        $modelo_74->Costo= '365';
        $modelo_74->save();

        $modelo_75 = new Modelo;
        $modelo_75->ModeloNombre = 'zf7982';
        $modelo_75->Costo= '995';
        $modelo_75->save();

        //Estado
        $estado_1 = new Estado;
        $estado_1->Nombre_estado = 'Activo';
        $estado_1->Descripcion_estado ='EQUIPO EN PRODUCCION';
        $estado_1->save();

        $estado_2 = new Estado;
        $estado_2->Nombre_estado = 'Baja';
        $estado_2->Descripcion_estado = 'EQUIPO NO FUNCIONAL';
        $estado_2->save();

        $estado_3 = new Estado;
        $estado_3->Nombre_estado = 'Bodega';
        $estado_3->Descripcion_estado = 'EQUIPO NO FUNCIONAL';
        $estado_3->save();

        $estado_4 = new Estado;
        $estado_4->Nombre_estado = 'Stock';
        $estado_4->Descripcion_estado = 'EQUIPO DISPONIBLE';
        $estado_4->save();

        $estado_5 = new Estado;
        $estado_5->Nombre_estado = 'Prestamo';
        $estado_5->Descripcion_estado = 'EQUIPO EN CALIDAD DE PRESTAMO';
        $estado_5->save();

        $estado_6 = new Estado;
        $estado_6->Nombre_estado = 'Verificar';
        $estado_6->Descripcion_estado = 'EQUIPO NO IDENTIFICADO O LOCALIZADO';
        $estado_6->save();

        $estado_7 = new Estado;
        $estado_7->Nombre_estado = 'Desconectado';
        $estado_7->Descripcion_estado = 'NO ACTIVO';
        $estado_7->save();

        $estado_8 = new Estado;
        $estado_8->Nombre_estado = 'Stock en sitio';
        $estado_8->Descripcion_estado = 'EQUIPO EN SITIO NO ACTIVO';
        $estado_8->save();

        $estado_9 = new Estado;
        $estado_9->Nombre_estado = 'Cambio';
        $estado_9->Descripcion_estado = 'Equipo cambiado';
        $estado_9->save();

        $estado_10 = new Estado;
        $estado_10->Nombre_estado = 'Venta';
        $estado_10->Descripcion_estado ='Equipo vendido';
        $estado_10->save();

        $estado_11 = new Estado;
        $estado_11->Nombre_estado = 'Garantia';
        $estado_11->Descripcion_estado = 'Equipo en garantía';
        $estado_11->save();

        $estado_12 = new Estado;
        $estado_12->Nombre_estado = 'Missing Inventory';
        $estado_12->Descripcion_estado = 'Equipo extraviado';
        $estado_12->save();

        $estado_13 = new Estado;
        $estado_13->Nombre_estado = 'Propiedad del hotel';
        $estado_13->save();

        $estado_14 = new Estado;
        $estado_14->Nombre_estado = 'Demo';
        $estado_14->save();

        $estado_15 = new Estado;
        $estado_15->Nombre_estado = 'Envio';
        $estado_15->save();





    }
}
