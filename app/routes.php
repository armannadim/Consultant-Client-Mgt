<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the Closure to execute when that URI is requested.
  |
 */

/* * *****************************************
 * ################ VIEWS ################ *
 * ***************************************** */
// Shows login page
Route::get('/', array('as' => '/', 'uses' => 'HomeController@viewLogin')); 
// After succesfull login it appears dashboard
Route::get('dashboard', array('as' => 'dashboard', 'before'=>'auth', 'uses' => 'HomeController@viewDashboard'));

// Shows client list. Also on the client list table user can edit client data by double click on the editable cell.
Route::get('client', array('as' => 'client', 'before'=>'auth', 'uses' => 'HomeController@viewClient'));
// to add new client
Route::get('addclient', array('as' => 'addclient', 'before'=>'auth', 'uses' => 'HomeController@viewAddClient'));
// Show all past and future appointments of a specific client
Route::get('show-client/{id?}', array('as' => 'show-client', 'before'=>'auth', 'uses' => 'HomeController@viewClientSingle'));

Route::get('staff', array('as' => 'staff', 'before'=>'auth', 'uses' => 'HomeController@viewStaff'));
Route::get('addstaff', array('as' => 'addstaff', 'before'=>'auth', 'uses' => 'HomeController@viewAddStaff'));
Route::get('show-staff/{id?}', array('as' => 'show-staff', 'before'=>'auth', 'uses' => 'HomeController@viewClientSingle'));



Route::get('visit', array('as' => 'visit', 'uses' => 'HomeController@viewVisit'));
Route::get('addappointment', array('as' => 'addappointment', 'before'=>'auth', 'uses' => 'HomeController@ViewAddAppointment'));




/* * *****************************************
 * ################ POSTs ################ *
 * ***************************************** */
Route::post('login', array('as' => 'login', 'uses' => 'HomeController@loginAction'));
Route::get('logout', array('as' => 'logout', 'uses' => 'HomeController@logoutAction'));

/* Appointment Management */
Route::post('addVisit', array('as' => 'addVisit', 'before'=>'auth', 'uses' => 'AppController@CreateAppointmentAction'));
Route::post('modifyVisit/{id?}', array('as' => 'modifyVisit', 'before'=>'auth', 'uses' => 'AppController@UpdateAppointmentAction'));
Route::get('removeVisit/{id?}', array('as' => 'removeVisit', 'before'=>'auth', 'uses' => 'AppController@DeleteAppointmentAction'));

/* CLIENT Management */
Route::post('addClient', array('as' => 'addClient', 'before'=>'auth', 'uses' => 'AppController@CreateClientAction'));
Route::post('modifyClient/{id?}', array('as' => 'modifyClient', 'before'=>'auth', 'uses' => 'AppController@UpdateClientAction'));
Route::post('remove-client/{id?}', array('as' => 'remove-client', 'before'=>'auth', 'uses' => 'AppController@DeleteClientAction'));

/* STAFF Management */
Route::post('addStaff', array('as' => 'addStaff', 'before' => 'csrf', 'uses' => 'AppController@CreateUserAction'));
Route::post('modifyStaff/{id?}', array('as' => 'modifyStaff', 'before'=>'auth', 'uses' => 'AppController@UpdateUserAction'));
Route::post('remove-staff/{id?}', array('as' => 'remove-staff', 'before'=>'auth', 'uses' => 'AppController@DeleteUserAction'));

Route::post('send-mail', array('as' => 'send-mail', 'before'=>'auth', 'uses' => 'AppController@SendMailAction'));


////////////////////////////
/* NOT IMPLEMENTED YET */

Route::post('appconfig', array('as' => 'appconfig', 'before'=>'auth', 'uses' => 'HomeController@loginAction'));
Route::get('appmgt', array('as' => 'appmgt', 'before'=>'auth', 'uses' => 'HomeController@viewAppManagement'));
Route::get('userconfig', array('as' => 'userconfig', 'before'=>'auth', 'uses' => 'HomeController@viewUserConfig'));
Route::get('mail', array('as' => 'mail', 'before'=>'auth', 'uses' => 'HomeController@viewMail'));

/* USER CONFIGURATION */
Route::post('addUserConfig', array('as' => 'addUserConfig', 'before'=>'auth', 'uses' => 'HomeController@addUserConfig'));
Route::post('removeUserConfig/{id}', array('as' => 'removeUserConfig', 'before'=>'auth', 'uses' => 'HomeController@removeUserConfig'));
Route::post('modifyUserConfig/{id}', array('as' => 'modifyUserConfig', 'before'=>'auth', 'uses' => 'HomeController@modifyUserConfig'));

/* APP Management Variables */
Route::post('addAppMgtVar', array('as' => 'addAppMgtVar', 'before'=>'auth', 'uses' => 'HomeController@addAppMgtVar'));
Route::post('removeAppMgtVar/{id}', array('as' => 'removeAppMgtVar', 'before'=>'auth', 'uses' => 'HomeController@removeAppMgtVar'));
Route::post('modifyAppMgtVar/{id}', array('as' => 'modifyAppMgtVar', 'before'=>'auth', 'uses' => 'HomeController@modifyAppMgtVar'));

/* MAIL Management */
Route::post('markAsRead/{id}', array('as' => 'markAsRead', 'before'=>'auth', 'uses' => 'HomeController@markAsRead'));
Route::post('markAsUnread/{id}', array('as' => 'markAsUnread', 'before'=>'auth', 'uses' => 'HomeController@markAsUnread'));
Route::post('deleteMail/{id}', array('as' => 'deleteMail', 'before'=>'auth', 'uses' => 'HomeController@deleteMail'));
Route::post('replyMail/{id}', array('as' => 'replyMail', 'before'=>'auth', 'uses' => 'HomeController@replyMail')); /* Will redirect to the reply mail page to write something */
Route::post('replyMailSend', array('as' => 'replyMailSend', 'before'=>'auth', 'uses' => 'HomeController@replyMailSend')); /* Mail sending after writing the reply */
/* END NOT IMPLEMENTED */
//////////////////////////////

/* DATATABLES */
Route::get('visits/{client?}', array('as' => 'visits', 'uses' => 'AppController@getAppointmentAction'));
Route::get('users', array('as' => 'users', 'uses' => 'AppController@getUserAction'));
Route::get('selectRoles', array('as' => 'selectRoles', 'uses' => 'AppController@getAllRoles'));
Route::get('clients', array('as' => 'clients', 'uses' => 'AppController@getClientAction'));

/* GetHTML */
Route::post('getVisitsOfDay/{date}', array('as' => 'getVisitsOfDay', 'uses' => 'BaseController@getVisitsOfDay'));

/* GetJSON */
Route::get('appointment/{id}', array('as' => 'appointment', 'uses' => 'AppController@ReadAppointmentAction'));

Route::get('getAllVisit/{id?}', array('as' => 'getAllVisit', 'uses' => 'BaseController@getAllVisit'));
Route::get('getAllDocType', array('as' => 'getAllDocType', 'uses' => 'BaseController@getAllDocType'));



/* ARTISAN COMMANDS ROUTE TO INSTALL APP FOR THE FIRST TIME */
//Setup route example
Route::get('/install/{key?}', array('as' => 'install', function($key = null) {
if ($key == "appSetup_key") {
    try {
        //echo '<br>init migrate:install...';
        Artisan::call('migrate:install');
        echo '<br>done migrate:install';
    } catch (Exception $e) {
        echo '<br>init migrate...';
        Artisan::call('migrate', array('--force' => true));
        echo '<br>done migrate';
        echo '<br>init tables seeder...';
        Artisan::call('db:seed', array('--force' => true));
        echo '<br>done tables seader';
        Response::make($e->getMessage(), 500);
    }
} else {
    App::abort(404);
}
}));
