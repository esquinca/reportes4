<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
Route::get('/', function () {
	return View::make('auth.login');
});
Route::get('/', function () {
return view('welcome');
});
*/

Route::get('/', function () {
	return View::make('auth.login');
});



 // Route::get('/{user}/{venium}/{survey}/{month}/{end}/{status}','SurveyController@index');
Route::get('/{data}/{status}','SurveyController@index');
Route::post('/create_record','SurveyController@create');

Route::get('sit/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('sit/login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
		Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('404', ['as' => '404', 'uses' => 'ErrorController@notfound']);
    Route::get('500', ['as' => '500', 'uses' => 'ErrorController@fatal']);
  //Inventario
    Route::get('/detailed_hotel', 'HotelDController@index');
    //posts detailed_hotel
    Route::post('/detailed_hotel_head','HotelDController@getHeaders');
    Route::post('/detailed_hotel_sum','HotelDController@getSummary');
    Route::post('/detailed_hotel_sw','HotelDController@getSwitch');
    Route::post('/detailed_hotel_zd','HotelDController@getZone');
    Route::post('/detailed_hotel_pie','HotelDController@getSummaryPie');
    Route::post('/detailed_hotel_disqn','HotelDController@getDristributionQuantitys');
    Route::post('/detailed_hotel_models','HotelDController@getEquipmentModels');
    Route::post('/detailed_hotel_table','HotelDController@getDetailedEquipment');
    //**********//
    Route::get('/detailed_hotels', 'HotelCController@index');
    Route::get('/detailed_proyect', 'HotelPController@index');
    //posts detailed_proyect
    Route::post('detailed_pro_head', 'HotelPController@getHeaderProject');
    Route::post('detailed_pro_stat', 'HotelPController@getStatusProject');
    Route::post('detailed_pro_ap', 'HotelPController@getGraphAPS');
    Route::post('detailed_pro_sw', 'HotelPController@getGraphSWS');
    Route::post('detailed_pro_dispro', 'HotelPController@getDispProject');
    Route::post('detailed_pro_modpro', 'HotelPController@getModelProject');
    Route::post('detailed_pro_tab', 'HotelPController@getProjectTable');
		Route::post('detailed_pro_gen', 'HotelPController@getProjectTableGen');
    //**********//

    Route::get('/detailed_cover', 'CoverController@index');
    //posts detailed_proyect
    Route::post('/cover_header', 'CoverController@getHeader');
    Route::post('/cover_dist_equipos', 'CoverController@getCoverDistEquipos');
    Route::post('/cover_dist_modelos', 'CoverController@getCoverDistModelos');

    Route::post('/hotel_cadena', 'HotelDController@hotel_cadena');
    /*Distribution*/
    Route::get('/detailed_distribution', 'DistributionController@index');
    Route::post('/geoHotel', 'DistributionController@show');
    Route::post('/detailed_equipament_all', 'DistributionController@show_device');
  //- Equipos
    Route::get('/up_equipment', 'AddEquipmentController@index');
    Route::post('/search_key_group', 'AddEquipmentController@search');
    Route::post('/search_provider', 'AddEquipmentController@search_provider');
    Route::post('/insertModel', 'AddEquipmentController@create_Model');
    Route::post('/search_modelo', 'AddEquipmentController@search_modelo');

    Route::post('/create_equipament_n', 'AddEquipmentController@create_equipament_n');
    Route::post('/create_equipament_nd', 'AddEquipmentController@create_equipament_nd');


    Route::post('/insertMarca', 'AddEquipmentController@create_marca');
    Route::post('/search_marcas', 'AddEquipmentController@search_marca');
    Route::post('/search_marca_all', 'AddEquipmentController@search_marca_all');

    Route::get('/down_equipment', 'RemovedEquipmentController@index');
    Route::get('/detailed_search', 'SearchEquipmentController@index');

    Route::post('/insertGrupo', 'AddEquipmentController@create_group');
    Route::post('/search_grupo', 'AddEquipmentController@search_grupo');

    Route::get('/move_equipment', 'MoveEquipmentController@index');
    Route::post('/send_item_move_hotels', 'MoveEquipmentController@edit');
    Route::post('/search_item_descript_hotels', 'MoveEquipmentController@descrip');
    Route::post('/save_description_move_hotels', 'MoveEquipmentController@update');
    Route::post('/search_range_equipament_all', 'SearchEquipmentController@search_range');
    Route::post('/get_mac_res', 'SearchEquipmentController@search_mac');

    Route::get('/group_equipment', 'GroupEquipmentController@index');
    Route::get('/group_equipment_letter', 'GroupLetterController@index');
    Route::get('/provider', 'ProviderController@index');

    Route::post('/move_group', 'GroupEquipmentController@update_move_group');

    Route::post('/search_rem_equipament_hotel', 'RemovedEquipmentController@show');
    Route::post('/send_item_drops_hotels', 'RemovedEquipmentController@edit');

    Route::post('/update_group_equipment', 'GroupEquipmentController@update_group');
    Route::post('/get_table_group', 'GroupEquipmentController@table_group');
    Route::post('/get_new_groups', 'GroupEquipmentController@update_select');
    Route::post('/group_insert', 'GroupEquipmentController@insertNewGroup');
    Route::post('/insertProveedor', 'ProviderController@insertnewprovider');
    Route::post('/getTableProvider', 'ProviderController@getTableProviders');
    Route::post('/show_updateinfo', 'ProviderController@showUpdate');
    Route::post('/update_provider', 'ProviderController@updateprov');
    Route::post('/delete_provider', 'ProviderController@deleteprov');

  //- Reportes
    Route::get('/type_report' , 'AssignTypeController@index');
    Route::post('/data_type_report' , 'AssignTypeController@show');
    Route::post('/show_edit_type_report' , 'AssignTypeController@edit');

    Route::post('/get_user_type' , 'AssignTypeController@table');
    Route::post('/reg_user_type' , 'AssignTypeController@create_rel_user');
    Route::post('/delete_assign_hotel_cl' , 'AssignTypeController@delete_rel_user');

    Route::get('/viewreports' , 'ViewReportsController@index');
    Route::post('/typereport','ViewReportsController@typerep');
    Route::post('/view_reports_header', 'ViewReportsController@report_header');
    Route::post('/get_client_wlan', 'ViewReportsController@graph_client_wlan');
    Route::post('/get_client_wlan_top', 'ViewReportsController@client_wlan_top');
    Route::post('/get_user_month', 'ViewReportsController@user_month');
    Route::post('/get_gb_month', 'ViewReportsController@gb_month');
    Route::post('/get_mostAP_top5', 'ViewReportsController@mostAP_top5');
    Route::post('/get_comparative', 'ViewReportsController@tab_comparativa');

    Route::post('/view_reports_band' , 'ViewReportsController@view_band');
    Route::post('/view_reports_device' , 'ViewReportsController@view_device');

  //Reporte concatenado
    Route::get('/viewreportscont', 'ViewReportContController@index');
    Route::post('/get_user_cont', 'ViewReportContController@table_user');
    Route::post('/get_gb_cont', 'ViewReportContController@table_gb');
    Route::post('/get_device_cont', 'ViewReportContController@table_device');
  //Calificaciones
    Route::get('/view_dashboard_survey_nps' , 'ViewDashNPSController@index');
    Route::get('/create_survey_admin' , 'CreateSurveyController@index');
    Route::post('create_survey_record', 'CreateSurveyController@create'); //Record survey
    Route::get('/fill_survey_admin' , 'CaptureSurveyController@index');
    Route::get('/edit_survey_admin' , 'EditSurveyController@index');
    Route::get('/survey_results' , 'ResultsSurveyController@index');
  //Post Survey_results.
    Route::post('/survey_viewresults' , 'ResultsSurveyController@result_survey');
    Route::post('/get_modal_comments' , 'ResultsSurveyController@comment_survey');
    Route::get('/configure_survey_admin' , 'ConfigurationSurveyController@index');
    Route::post('/assign_survey' , 'ConfigurationSurveyController@create');
  //Configuracion nps
    Route::get('/configure_survey_admin_nps' , 'ConfigurationSurveyController@index_nps');
    Route::post('/user_vertical' , 'ConfigurationSurveyController@show_nps');
    Route::post('/user_client' , 'ConfigurationSurveyController@show_client');
    Route::post('/data_create_client_config', 'ConfigurationSurveyController@create_client_nps');
    Route::post('/show_assign_surveyed', 'ConfigurationSurveyController@show_assign_client_nps');
    Route::post('/creat_assign_surveyed', 'ConfigurationSurveyController@creat_assign_client_ht');
    Route::post('/data_delete_client_config', 'ConfigurationSurveyController@delete_client_nps');
    Route::post('/delete_assign_surveyed', 'ConfigurationSurveyController@delete_assign_client_nps');
    Route::post('/create_data_client', 'ConfigurationSurveyController@capture_individual');
    Route::post('/create_data_auto_client', 'ConfigurationSurveyController@capture_auto');
    Route::post('/show_survey_table', 'ConfigurationSurveyController@user_surveys_table');
    Route::post('/show_survey_table_month', 'ConfigurationSurveyController@user_surveys_table_filter_month');

  //Dashboard nps
    Route::post('/summary_info_nps' , 'ViewDashNPSController@show_summary_info_nps');
    Route::post('/show_comparative_year' , 'ViewDashNPSController@compare_year');
    Route::post('/get_graph_nps' , 'ViewDashNPSController@percent_graph_nps');
    Route::post('/get_graph_ppd' , 'ViewDashNPSController@cant_graph_ppd');
    Route::post('get_graph_week','ViewDashNPSController@cant_graph_week');
    Route::post('/get_graph_uvsr' , 'ViewDashNPSController@graph_uvsr');
    Route::post('/get_graph_avgcal' , 'ViewDashNPSController@graph_avgcal');
    Route::post('/get_table_vert' , 'ViewDashNPSController@table_vert');
    Route::post('/get_table_results', 'ViewDashNPSController@table_results_full');
    Route::post('/get_table_comments_nps', 'ViewDashNPSController@table_comments_nps');
    Route::post('/get_table_comments_nps_full', 'ViewDashNPSController@table_commentsNPS_full');
    Route::post('/box_total', 'ViewDashNPSController@box_total');
    Route::post('/box_con', 'ViewDashNPSController@box_contestadas');
    Route::post('/box_sin', 'ViewDashNPSController@box_sin_contestar');
    Route::post('/box_promo', 'ViewDashNPSController@box_promotor');
    Route::post('/box_pas', 'ViewDashNPSController@box_pasivo');
    Route::post('/box_detra', 'ViewDashNPSController@box_detractor');

  //Dashboard Sitwifi
    Route::get('/view_dashboard_survey_sit' , 'ViewDashSitController@index');
    Route::get('/configure_survey_admin_sit' , 'ConfigurationSitController@index');
    Route::post('/get_data_survey_ys', 'ViewDashSitController@show_q');
    Route::post('/get_data_result_q', 'ViewDashSitController@show_result_q');
    Route::post('/search_user_domain', 'ViewDashSitController@show_user');
    Route::post('/create_manual_survey_record', 'ViewDashSitController@survey_record');
    Route::post('/show_survey_table_sit', 'ViewDashSitController@user_surveys_sitwifi');
    Route::post('/get_table_comments_gnrl', 'ViewDashSitController@table_comments');
    Route::post('/get_table_comments_gnrl_nps', 'ViewDashSitController@table_comments_nps');
    Route::post('/get_count_enc', 'ViewDashSitController@conteoEncuestas');

  //- Herramientas
    Route::get('/detailed_guest_review', 'GuestToolsController@index');
    Route::get('/detailed_server_review', 'ServerToolsController@index');
    Route::get('/testzone', 'ZoneToolsController@index');
    Route::post('/getInfoZD', 'ZoneToolsController@getInfo');
    Route::post('/testzonedir', 'ZoneToolsController@testRequest');

    Route::post('/existenceUsers', 'GuestToolsController@getUsersHC');
    Route::post('/existenceUsersAll', 'GuestToolsController@getPortalUsers');

    Route::get('/DiagHuespedAjax','GuestToolsController@checkGuest');
    Route::post('/DiagHuespedAjax2', 'GuestToolsController@checkWebSer');

    Route::get('/DiagServidorAjax', 'ServerToolsController@checkRad');
    Route::get('/DiagServidorAjax2','ServerToolsController@checkWB');

    Route::get('/testWebSer', 'GuestToolsController@checkWebSer');
  //- Perfil
    Route::get('/profile', 'ProfileController@index')->name('profile');
    Route::post('/data_config', 'ProfileController@show');
    Route::post('/profile_up', 'ProfileController@update');
    Route::post('/profile_up_pass', 'ProfileController@updatepass');

  //- Configuración
    Route::get('/Configuration', 'ConfigurationController@index')->name('Configuration');
    Route::post('/data_edit_config', 'ConfigurationController@store');
    Route::post('/data_menu_config', 'ConfigurationController@showMenu');
    Route::post('/data_create_user_config', 'ConfigurationController@create');
    Route::post('/data_edit_user_config', 'ConfigurationController@edit');

    Route::post('/data_edit_priv_config', 'ConfigurationController@update_priv');
    Route::post('/data_edit_menu_config', 'ConfigurationController@update_menu');
    Route::post('/data_delete_config', 'ConfigurationController@destroy');

  //- individual
    Route::get('/individual', 'IndividualController@index');
    Route::post('/get_zd_hotel', 'IndividualController@get_zd_hotel');

    Route::post('/upload_client', 'IndividualController@upload_client');
    Route::post('/upload_banda', 'IndividualController@upload_banda');
    Route::post('/upload_gigs', 'IndividualController@upload_gigs');
    Route::post('/upload_users', 'IndividualController@upload_users');
    Route::post('/upload_comments', 'IndividualController@upload_comments');
    Route::post('/upload_mostap', 'IndividualController@upload_mostap');
    Route::post('/upload_mostwlan', 'IndividualController@upload_mostwlan');
  //- Editar individual
    Route::get('/edit_report', 'EditReportController@index');
    Route::post('/search_info_zdhtl', 'EditReportController@search_zd');
    Route::post('/search_infogb', 'EditReportController@search_gb');
    Route::post('/update_infogb', 'EditReportController@update_gb');

    Route::post('/search_info_user', 'EditReportController@search_user');
    Route::post('/update_infouser', 'EditReportController@update_user');

    Route::post('/reupload_client', 'EditReportController@reupload_client');
    Route::post('/reupload_banda', 'EditReportController@reupload_banda');

		Route::post('/search_comment_hotel', 'EditReportController@search_comment');
		Route::post('/update_comment_hotel', 'EditReportController@update_comment');

  //- Aproval concierge
    Route::get('/approval', 'ApprovalConciergeController@index');
  //- Aproval admin
    Route::get('/approvals', 'ApprovalAdminController@index');
    //Send Mail
    Route::post('/send_mail_nps' , 'ConfigurationSurveyController@send_mail');
    Route::post('/send_mail_sit' , 'ConfigurationSitController@send_mail');
    Route::post('/search_hotel_u' , 'ConfigurationSurveyController@search_hotel_user');
    Route::post('/send_unanswer', 'ConfigurationSurveyController@send_correo_unanswer');
    Route::post('/send_unanswer_sit', 'ConfigurationSitController@send_correo_unanswer_sit');


    Route::get('mailable', function(){
        //$data = [];
        // array_push($data, ['cliente_o' => 'Aldea Thai', 'cliente_d' => 'Aluxes', 'equipo' => 'Antena', 'marca' => 'RUCKUS', 'mac' => 'D8:38:FC:0A:2A:30', 'serie' => '441602403933', 'modelo' => 'r300', 'estado_o' => 'baja', 'estado_d' => 'activo', 'origen' => '3', 'destino' => '4']);
        // $data2 = ['Jose Esquinca', 'Alonso cauich'];
        // array_push($data, ['cliente_o' => 'coño', 'cliente_d' => 'vergbghjjmhd', 'equipo' => 'Antena', 'marca' => 'RUCKUS', 'mac' => 'D8:38:FC:0A:2A:30', 'serie' => '441602403933', 'modelo' => 'r300', 'estado_o' => 'baja', 'estado_d' => 'activo', 'origen' => '3', 'destino' => '4']);

        // $data_emails = [
        // 'nombre' => 'Mario olarte',
        // 'shell_data' => 'linksafhasfasfasf',
        // 'shell_status' => 'ashsfhdh',
        // 'string' => 'lololol'
        // ];
        // $params = [
        //     'hotel' => 'hola',
        //     'asunto' => 'algo',
        //     'nombre' => 'jose',
        //     'ip' => '171.15.15.15',
        //     'fecha' => 'junio',
        //     'mensaje' => 'askdaskdjasf',
        // ];
        $params = [
          'servicio' => 'Arrendamiento',
          'gerente' => 'Ricardo',
          'beneficiario' => 'Empleado',
          'nombre_b' => 'Alonso',
          'fecha_inicio' => '27/06/2018',
          'fecha_fin' => '30/06/2018',
          'lugar_o' => 'prueba',
          'lugar_d' => 'pruebas',
          'descripcion' => 'juejuejeu'
        ];
        $params1 = [];
        //return new App\Mail\CmdAlerts($params);
        //return new App\Mail\Sentsurveyrangelmail($data_emails);
        //return new App\Mail\Sentsurveynpsmail($data_emails);
        //return new App\Mail\MovimientosMail($data, $data2);
        return new App\Mail\SolicitudesV($params, $params1);
        //return Auth::user()->email;
    });

    //- Viaticos Dashboard
    Route::get('/dashboard_viaticos', 'DashboardViaticController@index');
    Route::post('/search_info_dash_viat', 'DashboardViaticController@info');
    //- Viaticos Solicitud
    Route::get('/add_request_via', 'AddViaticController@index');
    Route::post('/viat_find_hotel', 'AddViaticController@find_hotel');
    Route::post('/create_viatic_new', 'AddViaticController@create_viatic');
    Route::post('/search_beneficiary', 'AddViaticController@find_user');
    Route::post('/viat_find_concept', 'AddViaticController@find_concept');
    // Route::get('/add_request_via2', 'AddViaticController@index2');//<-Pruebas
    //Denegar viatico
    Route::post('/deny_viatic', 'RequestsViaticController@deny_viatic');
    //- Viaticos Firma.
    Route::get('/signature_v', 'SignatureController@index');
    Route::post('/upload_sign', 'SignatureController@upload_signature');
    //- Viaticos Historial N0
    Route::get('/view_request_via', 'RequestsViaticController@index');
    Route::post('/view_request_via_zero', 'RequestsViaticController@history_zero');
    Route::post('/view_request_show_viatic_up', 'RequestsViaticController@show_viatic_up');
    Route::post('/view_request_show_viatic_down', 'RequestsViaticController@show_viatic_down');

    //- Viaticos Historial N1
    Route::post('/view_request_via_one', 'RequestsViaticController@history_one');
    Route::post('/view_pertain_viatic_ur', 'RequestsViaticController@pertain_viatic');
    Route::post('/send_item_nuevo', 'RequestsViaticController@edit_status_one');
    Route::post('/view_concept_via_one', 'RequestsViaticController@find_concept_all');
    Route::post('/search_all_status_concep', 'RequestsViaticController@find_concept');
    Route::post('/insert_request_1_data', 'RequestsViaticController@insert_data_1');

    //- Viaticos Historial N2
    Route::post('/view_request_via_two', 'RequestsViaticController@history_two');
    Route::post('/view_pertain_viatic_ur_n2', 'RequestsViaticController@pertain_viatic_two');
    Route::post('/send_item_pendientes', 'RequestsViaticController@edit_status_two');

    //- Viaticos Historial N3
    Route::post('/view_request_via_three', 'RequestsViaticController@history_three');
    Route::post('/view_pertain_viatic_ur_n3', 'RequestsViaticController@pertain_viatic_three');
    Route::post('/send_item_verifica', 'RequestsViaticController@edit_status_three');

    //- Viaticos Historial N4
    Route::post('/view_request_via_four', 'RequestsViaticController@history_four');
    Route::post('/view_pertain_viatic_ur_n4', 'RequestsViaticController@pertain_viatic_four');
    Route::post('/send_item_aprueba', 'RequestsViaticController@edit_status_four');

    //- Todos los vitaticos
    Route::get('/view_request_all_via', 'RequestViaticAllController@index');
    Route::post('/view_request_via_all', 'RequestViaticAllController@history_all');
		//Viaticos semanal
		Route::post('/view_request_via_weekly', 'ViaticWeeklyController@viatic_historic_weekly');
    //Timeline Viaticos
    Route::post('/search_data_timeline', 'RequestViaticAllController@timeline');
    Route::post('/view_request_total_concept_viatic', 'RequestViaticAllController@totales');

    Route::get('/view_history_notf', 'RequestsViaticController@index2');
    //- Notification Viaticos
    Route::post('statuses', 'ViaticNotificationController@index')->name('statuses.store');
    Route::post('notification_s', 'ViaticNotificationController@show');
    //- Notification Pagos
    Route::post('notification_p', 'ViaticNotificationController@show_two');
    //- Dashboard pagos
    Route::get('/view_dashboard_req_pay', 'DashboardPayController@index');
    Route::post('/search_data_payment_genral' , 'DashboardPayController@data_header');
    Route::post('/search_data_payment_applicat' , 'DashboardPayController@data_application');
    Route::post('/search_data_payment_waypay' , 'DashboardPayController@data_waypay');
    Route::post('/search_data_payment_current' , 'DashboardPayController@data_current');
    Route::post('/search_data_payment_classifications' , 'DashboardPayController@data_classifications');
    Route::post('/search_data_payment_options' , 'DashboardPayController@data_options');
    Route::post('/search_data_payment_six_months' , 'DashboardPayController@data_month');


    //- Pagos Solicitud
    Route::get('/view_add_req_pay', 'PayAddController@index');
    Route::post('get_data_accw', 'PayAddController@info_account');
    //- Pagos Historial
    Route::get('/view_history_req_pay', 'PayHistoryController@index');
    //- Pagos Historial N0
    Route::post('/view_request_pay_zero', 'PayHistoryController@history_zero');
    Route::post('/view_gen_sol_pay', 'PayHistoryController@data_basic');
    Route::post('/view_gen_sol_pay_area', 'PayHistoryController@data_basic_area');
    Route::post('/view_gen_sol_pay_type', 'PayHistoryController@data_basic_type');
    Route::post('/view_gen_sol_pay_financing', 'PayHistoryController@data_basic_financing');
    Route::post('/view_gen_sol_pay_comments', 'PayHistoryController@data_basic_comments');
    Route::post('/view_gen_sol_pay_firmas', 'PayHistoryController@data_basic_firmas');
    Route::post('/view_gen_sol_pay_bank', 'PayHistoryController@data_basic_bank');
    Route::post('/deny_payment', 'PayHistoryController@deny_payment_act');
    //- Pagos Historial N1
    Route::post('/send_item_pay_new', 'PayHistoryController@approval_one');
    //- Pagos Historial N2
    Route::post('/send_item_pay_revised', 'PayHistoryController@approval_two');
    //- Pagos Historial N3
    Route::post('/send_item_pay_authorized', 'PayHistoryController@approval_three');
		Route::post('/send_item_pay_authorized_indv', 'PayHistoryController@approval_three_ind');
    //- Pagos Historial All
    Route::get('/view_history_all_req_pay', 'PayHistoryAllController@index');
    Route::post('/history_all_filter', 'PayHistoryAllController@solicitudes_historic');
    //- Filter pagos
    Route::get('/view_filter_req_pay', 'FilterPayController@index');


    //Función para tests.
    Route::get('/acm1pt', 'GroupEquipmentController@test');
    Route::get('/ahhh', 'RequestsViaticController@history_three');
    //Caratula entregas
    Route::get('/cover_equipment_delivery', 'CoverDeliveryEquipmentController@index');
    Route::post('/cover_delivery_header', 'CoverDeliveryEquipmentController@getHeader');
    Route::post('/cover_delivery_groups', 'CoverDeliveryEquipmentController@table_group');
    Route::post('/update_infouser', 'CoverDeliveryEquipmentController@getCoverDistEquipos');
    Route::post('/cover_dist_groups_models', 'CoverDeliveryEquipmentController@getCoverDistModelos');

    //Solicitud de pagos
    Route::post('/get_hotel_cadena', 'PayAddController@hotel_cadena');
    Route::post('/get_proyecto_hotel', 'PayAddController@get_proyecto');
    Route::post('/get_proveedor', 'PayAddController@get_proveedor');
    Route::post('/get_data_bank', 'PayAddController@get_bank');
    Route::post('/get_account_clabe', 'PayAddController@get_data_account');

    //Crear pagos
    Route::post('/create_one_payment', 'PayAddController@create');

    //Filtros Pagos
    Route::post('/get_payment_by_folio', 'FilterPayController@get_payment_by_folio');
    Route::post('/search_folio', 'FilterPayController@autocomplete_folio');
    Route::post('/get_payment_by_id', 'FilterPayController@get_paymentId');
    Route::post('/get_payment_folios', 'FilterPayController@get_folios');

		//- Pagos confirmados
    Route::get('/view_history_all_status_paid', 'PayHistoryPaidController@index');
		Route::post('/history_status_paid_month', 'PayHistoryPaidController@payments_paid');

		//Alta datos bancarios
		Route::post('/setdata_bank', 'PayAddController@set_data_bank');
		// download pdf invoice payments_states_id
		Route::post('/downloadInvoicePay', 'PayHistoryController@getInvoice');

		//- Reporte semanal pagos
    Route::get('/view_pay_weekly', 'PayWeeklyController@index');
		//- Reporte semanal viaticos
		Route::get('/view_viatic_weekly', 'ViaticWeeklyController@index');

});
