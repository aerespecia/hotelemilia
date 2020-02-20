<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
   

        
    if(!(Auth::check())){
		return view('auth.login');
	}
    else
        return view('/home');
//if

});



Route::auth();



Route::group(['middleware'=>['admin','auth']],function(){
    
   Route::resource('admin','AdminController'); 
});

Route::group(['middleware'=>['frontdesk','auth']],function(){

    Route::get('frontdesk/clientSearch',['uses'=>'SearchController@clientSearch','as'=>'frontdesk.clientSearch']);
    Route::get('frontdesk/instiSearch',['uses'=>'SearchController@instiSearch','as'=>'frontdesk.instiSearch']);
    
    Route::get('frontdesk/guest-folio',['uses'=>'FrontDeskController@guestFolio','as'=>'frontdesk.guestFolio']);
    Route::get('frontdesk/night-audit',['uses'=>'FrontDeskController@nightAudit','as'=>'frontdesk.nightAudit']);
    Route::get('frontdesk/amendments',['uses'=>'FrontDeskController@amendments','as'=>'frontdesk.amendments']);
    Route::get('frontdesk/checkRoomAvailability',['uses'=>'FrontDeskController@checkRoomAvailability','as'=>'frontdesk.checkRoomAvailability']);
    Route::get('frontdesk/reservation',['uses'=>'FrontDeskController@reservation','as'=>'frontdesk.reservation']);
    Route::get('frontdesk/reservation-list',['uses'=>'FrontDeskController@reservationList','as'=>'frontdesk.reservationList']);
    Route::get('frontdesk/daily-guest-arrival',['uses'=>'FrontDeskController@dailyGuestArrival','as'=>'frontdesk.dailyGuestArrival']);
    Route::get('frontdesk/room-occupancy-bulletin',['uses'=>'FrontDeskController@roomOccupancyBulletin','as'=>'frontdesk.roomOccupancyBulletin']);
    Route::get('frontdesk/daily-departure-list',['uses'=>'FrontDeskController@dailyDepartureList','as'=>'frontdesk.dailyDepartureList']);
       
    Route::get('frontdesk/guest-registration',['uses'=>'FrontDeskController@guestRegistration','as'=>'frontdesk.guestRegistration']);

    Route::get('frontdesk/dataTables',['uses' => 'FrontDeskController@dataTables','as'=>'frontdesk.dataTables']);

    Route::get('frontdesk/dataTablesDailyArrivalList',['uses' => 'FrontDeskController@dataTablesDailyArrivalList','as'=>'frontdesk.dataTablesDailyArrivalList']);

    Route::get('frontdesk/dataTablesRoomOccupancyBulletinList',['uses' => 'FrontDeskController@dataTablesRoomOccupancyBulletinList','as'=>'frontdesk.dataTablesRoomOccupancyBulletinList']);

    
    Route::get('frontdesk/dataTablesDailyDepatureList',['uses' => 'FrontDeskController@dataTablesDailyDepatureList','as'=>'frontdesk.dataTablesDailyDepatureList']);

	Route::resource('frontdesk','FrontDeskController');



//	Route::get('admin/{id}',['uses' => 'AdminUsersController@memberProfile','as' => 'admin.memberProfile']);


});


Route::get('/home', 'HomeController@index');
