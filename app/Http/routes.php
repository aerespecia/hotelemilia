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
        return redirect('/home');
//if

});



Route::auth();
Route::group(['middleware'=>['admin','auth']],function(){
    Route::post('admin/guestUpdateAjax',['uses'=>'AdminController@guestUpdateAjax','as'=>'admin.guestUpdateAjax']);
    Route::post('admin/clientUpdateAjax',['uses'=>'AdminController@clientUpdateAjax','as'=>'admin.clientUpdateAjax']);
    Route::post('admin/institutionUpdateAjax',['uses'=>'AdminController@institutionUpdateAjax','as'=>'admin.institutionUpdateAjax']);
    Route::post('admin/transactionUpdateAjax',['uses'=>'AdminController@transactionUpdateAjax','as'=>'admin.transactionUpdateAjax']);

    Route::post('admin/roomUpdateAjax',['uses'=>'AdminController@roomUpdateAjax','as'=>'admin.roomUpdateAjax']);
    Route::post('admin/roomTypeUpdateAjax',['uses'=>'AdminController@roomTypeUpdateAjax','as'=>'admin.roomTypeUpdateAjax']);


    


    //Controller
    Route::get('admin/roomstatus',['uses' => 'AdminController@roomstatus','as' => 'admin.roomstatus']);
    Route::get('admin/roomManage',['uses' => 'AdminController@roomManage','as' => 'admin.roomManage']);
    Route::get('admin/guest',['uses' => 'AdminController@guest','as' => 'admin.guest']);
    Route::get('admin/booking',['uses' => 'AdminController@booking','as' => 'admin.booking']);
    Route::get('admin/institution',['uses' => 'AdminController@institution','as' => 'admin.institution']);
    Route::get('admin/staff',['uses' => 'AdminController@staff','as' => 'admin.staff']);
    Route::get('admin/activeReservation',['uses' => 'AdminController@activeReservation','as' => 'admin.activeReservation']);
    Route::get('admin/archiveReservation',['uses' => 'AdminController@archiveReservation','as' => 'admin.archiveReservation']);
    Route::get('admin/fnb',['uses' => 'AdminController@fnb','as' => 'admin.fnb']);
    Route::get('admin/shifts',['uses' => 'AdminController@shifts','as' => 'admin.shifts']);
    Route::get('admin/roomHistory',['uses' => 'AdminController@roomHistory','as' => 'admin.roomHistory']);
    Route::get('admin/discount',['uses' => 'AdminController@discount','as' => 'admin.discount']);
    Route::get('admin/transactions',['uses' => 'AdminController@transactions','as' => 'admin.transactions']);
    Route::get('admin/transactionsAnalysis',['uses' => 'AdminController@transactionsAnalysis','as' => 'admin.transactionsAnalysis']);
    Route::get('admin/roomPricing',['uses' => 'AdminController@roomPricing','as' => 'admin.roomPricing']);
    Route::get('admin/roomPricing',['uses' => 'AdminController@roomPricing','as' => 'admin.roomPricing']);
    Route::get('admin/roomCheckList',['uses' => 'AdminController@roomCheckList','as' => 'admin.roomCheckList']);

    Route::get('admin/guaranteedReservation',['uses' => 'AdminController@guaranteedReservation','as' => 'admin.guaranteedReservation']);
    Route::get('admin/checkInReservation',['uses' => 'AdminController@checkInReservation','as' => 'admin.checkInReservation']);


    Route::get('admin/roomIssue',['uses' => 'AdminController@roomIssue','as' => 'admin.roomIssue']);
    Route::get('admin/roomReplenishReport',['uses' => 'AdminController@roomReplenishReport','as' => 'admin.roomReplenishReport']);

    Route::get('admin/dailyCashReport',['uses' => 'AdminController@dailyCashReport','as' => 'admin.dailyCashReport']);
    Route::get('admin/dailySalesReport',['uses' => 'AdminController@dailySalesReport','as' => 'admin.dailySalesReport']);
    Route::get('admin/periodSalesReport',['uses' => 'AdminController@periodSalesReport','as' => 'admin.periodSalesReport']);
    Route::get('admin/shiftCashReport',['uses' => 'AdminController@shiftCashReport','as' => 'admin.shiftCashReport']);
    
    
    Route::post('admin/generatePeriodSalesReport',['uses' => 'AdminController@generatePeriodSalesReport','as' => 'admin.generatePeriodSalesReport']);
    Route::post('admin/shiftGenerateCashReport',['uses' => 'AdminController@shiftGenerateCashReport','as' => 'admin.shiftGenerateCashReport']);
        


    Route::post('admin/shiftsManage',['uses' => 'AdminController@shiftsManage','as' => 'admin.shiftsManage']);
    Route::post('admin/discountManage',['uses' => 'AdminController@discountManage','as' => 'admin.discountManage']);
    
    Route::post('admin/roomStatusSaves',['uses'=>'AdminController@roomStatusSaves','as'=>'admin.roomStatusSaves']);
    Route::post('admin/deleteDiscountAjax',['uses'=>'AdminController@deleteDiscountAjax','as'=>'admin.deleteDiscountAjax']);
    Route::post('admin/roomCheckListItemManage',['uses' => 'AdminController@roomCheckListItemManage','as' => 'admin.roomCheckListItemManage']);
    Route::post('admin/updateRoomCheckListAjax',['uses' => 'AdminController@updateRoomCheckListAjax','as' => 'admin.updateRoomCheckListAjax']);

    

    //datatables
    Route::get('admin/dataTablesGuestList',['uses' => 'AdminController@dataTablesGuestList','as'=>'admin.dataTablesGuestList']);
    Route::get('admin/dataTablesBookingList',['uses' => 'AdminController@dataTablesBookingList','as'=>'admin.dataTablesBookingList']);
    Route::get('admin/dataTablesRoomManage',['uses' => 'AdminController@dataTablesRoomManage','as'=>'admin.dataTablesRoomManage']);
    Route::get('admin/dataTablesInstitutionList',['uses' => 'AdminController@dataTablesInstitutionList','as'=>'admin.dataTablesInstitutionList']);
    Route::get('admin/dataTablesUsersList',['uses' => 'AdminController@dataTablesUsersList','as'=>'admin.dataTablesUsersList']);
    Route::get('admin/dataTablesDiscountsList',['uses' => 'AdminController@dataTablesDiscountsList','as'=>'admin.dataTablesDiscountsList']);
    Route::get('admin/dataTablesTransactions',['uses' => 'AdminController@dataTablesTransactions','as'=>'admin.dataTablesTransactions']);
    Route::get('admin/dataTablesRoomPricing',['uses' => 'AdminController@dataTablesRoomPricing','as'=>'admin.dataTablesRoomPricing']);
    Route::get('admin/dataTablesRoomCheckListItems',['uses' => 'AdminController@dataTablesRoomCheckListItems','as'=>'admin.dataTablesRoomCheckListItems']);
    Route::get('admin/dataTablesGuaranteedReservationList',['uses' => 'AdminController@dataTablesGuaranteedReservationList','as'=>'admin.dataTablesGuaranteedReservationList']);
    Route::get('admin/dataTablesCheckInReservationList',['uses' => 'AdminController@dataTablesCheckInReservationList','as'=>'admin.dataTablesCheckInReservationList']);
    Route::get('admin/dataTablesRoomItemReplenishList',['uses' => 'AdminController@dataTablesRoomItemReplenishList','as'=>'admin.dataTablesRoomItemReplenishList']);
    Route::get('admin/dataTablesItemReplenishList',['uses' => 'AdminController@dataTablesItemReplenishList','as'=>'admin.dataTablesItemReplenishList']);



    Route::get('admin/dataTablesRoomChargesByTransaction/{id}',['uses' => 'AdminController@dataTablesRoomChargesByTransaction','as'=>'admin.dataTablesRoomChargesByTransaction']);
    Route::get('admin/dataTablesDownpaymentByTransaction/{id}',['uses' => 'AdminController@dataTablesDownpaymentByTransaction','as'=>'admin.dataTablesDownpaymentByTransaction']);

    
    
    Route::get('admin/dataTablesGuestForReservationList/{id}',['uses' => 'AdminController@dataTablesGuestForReservationList','as'=>'admin.dataTablesGuestForReservationList']);
    


    Route::get('admin/dataTablesActiveReservationList',['uses' => 'AdminController@dataTablesActiveReservationList','as'=>'admin.dataTablesActiveReservationList']);
    Route::get('admin/dataTablesArchiveReservationList',['uses' => 'AdminController@dataTablesArchiveReservationList','as'=>'admin.dataTablesArchiveReservationList']);

    Route::get('admin/dataTablesArchiveReservationListByGuest/{id}',['uses' => 'AdminController@dataTablesArchiveReservationListByGuest','as'=>'admin.dataTablesArchiveReservationListByGuest']);
    Route::get('admin/dataTablesArchiveReservationListByClient/{id}',['uses' => 'AdminController@dataTablesArchiveReservationListByClient','as'=>'admin.dataTablesArchiveReservationListByClient']);
    Route::get('admin/dataTablesArchiveReservationListByInstitution/{id}',['uses' => 'AdminController@dataTablesArchiveReservationListByInstitution','as'=>'admin.dataTablesArchiveReservationListByInstitution']);
    Route::get('admin/dataTablesArchiveReservationListByTransaction/{id}',['uses' => 'AdminController@dataTablesArchiveReservationListByTransaction','as'=>'admin.dataTablesArchiveReservationListByTransaction']);

    

    Route::get('admin/dataTablesRoomList',['uses' => 'AdminController@dataTablesRoomList','as'=>'admin.dataTablesRoomList']);

    Route::get('admin/dataTablesHousekeepingHistory',['uses' => 'AdminController@dataTablesHousekeepingHistory','as'=>'admin.dataTablesHousekeepingHistory']);



    Route::get('admin/roomInfo/{id}',['uses'=>'AdminController@roomInfo','as'=>'admin.roomInfo']);




    //search
    Route::get('admin/userSearch',['uses'=>'AdminController@userSearch','as'=>'admin.userSearch']);


    //statistics
    Route::get('admin/reservationCalendar',['uses' => 'AdminController@reservationCalendar','as'=>'admin.reservationCalendar']);
    Route::get('admin/chartNewGuestCheckIn',['uses' => 'AdminController@chartNewGuestCheckIn','as'=>'admin.chartNewGuestCheckIn']);
    Route::get('admin/chartCheckInRoom',['uses' => 'AdminController@chartCheckInRoom','as'=>'admin.chartCheckInRoom']);
    Route::get('admin/chartNewGuestReservationCheckIn',['uses' => 'AdminController@chartNewGuestReservationCheckIn','as'=>'admin.chartNewGuestReservationCheckIn']);
    Route::get('admin/chartBilledTransaction',['uses' => 'AdminController@chartBilledTransaction','as'=>'admin.chartBilledTransaction']);
    
    Route::get('admin/chartBilledTransactionPerType',['uses' => 'AdminController@chartBilledTransactionPerType','as'=>'admin.chartBilledTransactionPerType']);
    Route::get('admin/fnbTransactions',['uses' => 'AdminController@fnbTransactions','as'=>'admin.fnbTransactions']);
    

    Route::get('admin/guestViewRegistration/{id}',['uses'=>'AdminController@guestViewRegistration','as'=>'admin.guestViewRegistration']);
    Route::get('admin/bookingViewRegistration/{id}',['uses'=>'AdminController@bookingViewRegistration','as'=>'admin.bookingViewRegistration']);
    Route::get('admin/institutionViewRegistration/{id}',['uses'=>'AdminController@institutionViewRegistration','as'=>'admin.institutionViewRegistration']);

    Route::get('admin/transactionViewRegistration/{id}',['uses'=>'AdminController@transactionViewRegistration','as'=>'admin.transactionViewRegistration']);
    Route::get('admin/roomViewRegistration/{id}',['uses'=>'AdminController@roomViewRegistration','as'=>'admin.roomViewRegistration']);
    Route::get('admin/roomTypeViewRegistration/{id}',['uses'=>'AdminController@roomTypeViewRegistration','as'=>'admin.roomTypeViewRegistration']);
    Route::get('admin/discountViewRegistration/{id}',['uses'=>'AdminController@discountViewRegistration','as'=>'admin.discountViewRegistration']);

    Route::get('admin/roomReservationViewRegistration/{id}',['uses'=>'AdminController@roomReservationViewRegistration','as'=>'admin.roomReservationViewRegistration']);
    Route::get('admin/roomCheckListViewRegistration/{id}',['uses'=>'AdminController@roomCheckListViewRegistration','as'=>'admin.roomCheckListViewRegistration']);

    Route::get('admin/reservationCalendarViewRegistration/{id}',['uses'=>'AdminController@reservationCalendarViewRegistration','as'=>'admin.reservationCalendarViewRegistration']);

            


    /////Housekeeping like
     Route::get('admin/history',['uses' => 'AdminController@history','as'=>'admin.history']);

    
    //datatables
    Route::get('admin/dataTablesRoomList',['uses' => 'AdminController@dataTablesRoomList','as'=>'admin.dataTablesRoomList']);
    Route::get('admin/dataTablesHousekeepingHistory',['uses' => 'AdminController@dataTablesHousekeepingHistory','as'=>'admin.dataTablesHousekeepingHistory']);


    Route::get('admin/dataTablesHousekeepingHistoryRoom/{id}',['uses' => 'AdminController@dataTablesHousekeepingHistoryRoom','as'=>'admin.dataTablesHousekeepingHistoryRoom']);
    Route::get('admin/dataTablesRoomIssuesHousekeeping/{id}',['uses' => 'AdminController@dataTablesRoomIssuesHousekeeping','as'=>'admin.dataTablesRoomIssuesHousekeeping']);


    Route::get('admin/dataTablesRoomIssues',['uses' => 'AdminController@dataTablesRoomIssues','as'=>'admin.dataTablesRoomIssues']);


    

    ////pop-out information
    Route::get('admin/roomInfo/{id}',['uses'=>'AdminController@roomInfo','as'=>'admin.roomInfo']);




    Route::post('admin/roomStatusSaves',['uses'=>'AdminController@roomStatusSaves','as'=>'admin.roomStatusSaves']);
    Route::post('admin/roomStatusSavesForAdmin',['uses'=>'AdminController@roomStatusSavesForAdmin','as'=>'admin.roomStatusSavesForAdmin']);
    Route::post('admin/retrieveGuestsTransaction',['uses'=>'AdminController@retrieveGuestsTransaction','as'=>'admin.retrieveGuestsTransaction']);
    Route::post('admin/deleteRoomChargeAjax',['uses'=>'AdminController@deleteRoomChargeAjax','as'=>'admin.deleteRoomChargeAjax']);
    Route::post('admin/deleteDownpaymentAjax',['uses'=>'AdminController@deleteDownpaymentAjax','as'=>'admin.deleteDownpaymentAjax']);
    
    Route::get('admin/roomChargeViewRegistration/{id}',['uses'=>'AdminController@roomChargeViewRegistration','as'=>'admin.roomChargeViewRegistration']);
    Route::get('admin/downpaymentViewRegistration/{id}',['uses'=>'AdminController@downpaymentViewRegistration','as'=>'admin.downpaymentViewRegistration']);

    
    
    Route::post('admin/issueStatusSaves',['uses'=>'AdminController@issueStatusSaves','as'=>'admin.issueStatusSaves']);
    



    Route::resource('admin','AdminController'); 

});



Route::group(['middleware'=>['housekeeping','auth']],function(){
    //Controller
    Route::get('housekeeping/history',['uses' => 'HousekeepingController@history','as'=>'housekeeping.history']);
    Route::get('housekeeping/checkInReservation',['uses' => 'HousekeepingController@checkInReservation','as'=>'housekeeping.checkInReservation']);

    

    
    //datatables
    Route::get('housekeeping/dataTablesRoomList',['uses' => 'HousekeepingController@dataTablesRoomList','as'=>'housekeeping.dataTablesRoomList']);
    Route::get('housekeeping/dataTablesHousekeepingHistory',['uses' => 'HousekeepingController@dataTablesHousekeepingHistory','as'=>'housekeeping.dataTablesHousekeepingHistory']);


    Route::get('housekeeping/dataTablesHousekeepingHistoryRoom/{id}',['uses' => 'HousekeepingController@dataTablesHousekeepingHistoryRoom','as'=>'housekeeping.dataTablesHousekeepingHistoryRoom']);
    Route::get('housekeeping/dataTablesRoomIssuesHousekeeping/{id}',['uses' => 'HousekeepingController@dataTablesRoomIssuesHousekeeping','as'=>'housekeeping.dataTablesRoomIssuesHousekeeping']);
    Route::get('housekeeping/dataTablesRoomCheckListItems',['uses' => 'HousekeepingController@dataTablesRoomCheckListItems','as'=>'housekeeping.dataTablesRoomCheckListItems']);

    Route::get('housekeeping/dataTablesCheckInReservationList',['uses' => 'HousekeepingController@dataTablesCheckInReservationList','as'=>'housekeeping.dataTablesCheckInReservationList']);


    
    ////pop-out information
    Route::get('housekeeping/roomInfo/{id}',['uses'=>'HousekeepingController@roomInfo','as'=>'housekeeping.roomInfo']);


    Route::post('housekeeping/roomStatusSaves',['uses'=>'HousekeepingController@roomStatusSaves','as'=>'housekeeping.roomStatusSaves']);
    Route::post('housekeeping/issueStatusSaves',['uses'=>'HousekeepingController@issueStatusSaves','as'=>'housekeeping.issueStatusSaves']);
    

    
    Route::resource('housekeeping','HousekeepingController'); 

});


Route::group(['middleware'=>['frontdesk','auth']],function(){


    Route::post('frontdesk/manager-check',['uses'=>'FrontDeskController@managerCheck','as'=>'frontdesk.managerCheck']);
    Route::get('frontdesk/getCalendarDetails',['uses'=>'FrontDeskController@getCalendarDetails','as'=>'frontdesk.getCalendarDetails']);


    Route::post('frontdesk/save-reservation-notes',['uses' => 'FrontDeskController@saveReservationNotes','as'=>'frontdesk.saveReservationNotes']);
    
    Route::get('frontdesk/reservationCalendar',['uses' => 'FrontDeskController@reservationCalendar','as'=>'frontdesk.reservationCalendar']);
    Route::get('frontdesk/reservationCalendarViewRegistration/{id}',['uses'=>'FrontDeskController@reservationCalendarViewRegistration','as'=>'frontdesk.reservationCalendarViewRegistration']);    
    
    Route::get('frontdesk/dataTablesGuestList',['uses' => 'FrontDeskController@dataTablesGuestList','as'=>'frontdesk.dataTablesGuestList']);
    Route::get('frontdesk/dataTablesAddGuest',['uses' => 'FrontDeskController@dataTablesAddGuest','as'=>'frontdesk.dataTablesAddGuest']);


    Route::get('frontdesk/dataTablesRoomList',['uses' => 'FrontDeskController@dataTablesRoomList','as'=>'frontdesk.dataTablesRoomList']);
    Route::get('frontdesk/dataTablesHousekeepingHistory',['uses' => 'FrontDeskController@dataTablesHousekeepingHistory','as'=>'frontdesk.dataTablesHousekeepingHistory']);


    Route::get('frontdesk/dataTablesHousekeepingHistoryRoom/{id}',['uses' => 'FrontDeskController@dataTablesHousekeepingHistoryRoom','as'=>'frontdesk.dataTablesHousekeepingHistoryRoom']);
    Route::get('frontdesk/dataTablesRoomIssuesHousekeeping/{id}',['uses' => 'FrontDeskController@dataTablesRoomIssuesHousekeeping','as'=>'frontdesk.dataTablesRoomIssuesHousekeeping']);


    Route::post('frontdesk/saveWithHoldingTax',['uses'=>'FrontDeskController@saveWithHoldingTax','as'=>'frontdesk.saveWithHoldingTax']);

//    Route::get('frontdesk/roomOccupancyReport')

    ////pop-out information
    Route::get('frontdesk/roomInfo/{id}',['uses'=>'FrontDeskController@roomInfo','as'=>'frontdesk.roomInfo']);




    Route::post('frontdesk/roomStatusSaves',['uses'=>'FrontDeskController@roomStatusSaves','as'=>'frontdesk.roomStatusSaves']);
    Route::post('frontdesk/issueStatusSaves',['uses'=>'FrontDeskController@issueStatusSaves','as'=>'frontdesk.issueStatusSaves']);

    Route::get('frontdesk/confirm-remove-guest/{id}',['uses'=>'FrontDeskController@confirmRemoveGuest','as'=>'frontdesk.confirmRemoveGuest']);

     Route::get('frontdesk/confirm-remove-room/{id}',['uses'=>'FrontDeskController@confirmRemoveRoom','as'=>'frontdesk.confirmRemoveRoom']);
    

    Route::get('frontdesk/remove-guest/{id}',['uses'=>'FrontDeskController@removeGuest','as'=>'frontdesk.removeGuest']);

    Route::get('frontdesk/remove-room/{id}',['uses'=>'FrontDeskController@removeRoom','as'=>'frontdesk.removeRoom']);
    
    Route::post('frontdesk/room-Reservation-update/{id}',['uses'=>'FrontDeskController@resUpdate','as'=>'frontdesk.resUpdate']);
    
    Route::post('frontdesk/add-guest-save',['uses'=>'FrontDeskController@addGuestSave','as'=>'frontdesk.addGuestSave']);
    
    Route::post('frontdesk/store-proceed',['uses'=>'FrontDeskController@storeProceed','as'=>'frontdesk.storeProceed']);
    
    //datatables
    Route::get('frontdesk/datatables-clients',['uses' => 'FrontDeskController@datatablesClients','as'=>'frontdesk.datatablesClients']);
    
    Route::get('frontdesk/datatables-institutions',['uses' => 'FrontDeskController@datatablesInstitutions','as'=>'frontdesk.datatablesInstitutions']);
    
    Route::get('frontdesk/datatables-active-reservation-list',['uses' => 'FrontDeskController@dataTablesActiveReservationList','as'=>'frontdesk.dataTablesActiveReservationList']);
    
    Route::get('frontdesk/datatables-guaranteed-reservation-list',['uses' => 'FrontDeskController@dataTablesGuaranteedReservationList','as'=>'frontdesk.dataTablesGuaranteedReservationList']);
    
    Route::get('frontdesk/datatables-guest-reservation-list/{id}',['uses' => 'FrontDeskController@dataTablesGuestReservationList','as'=>'frontdesk.dataTablesGuestReservationList']);
    
    Route::get('frontdesk/datatables-room-reservation-list/{id}',['uses' => 'FrontDeskController@dataTablesRoomReservationList','as'=>'frontdesk.dataTablesRoomReservationList']);
    
    
    Route::get('frontdesk/datatables-staying-reservation-list',['uses' => 'FrontDeskController@dataTablesStayingReservationList','as'=>'frontdesk.dataTablesStayingReservationList']);

     Route::get('frontdesk/datatables-checked-out-list',['uses' => 'FrontDeskController@dataTablesCheckedOutList','as'=>'frontdesk.dataTablesCheckedOutList']);
    
    
    Route::get('frontdesk/get-institution/{id}',['uses'=>'FrontDeskController@getInstitution','as'=>'frontdesk.getInstitution']);
    
    Route::get('frontdesk/get-client/{id}',['uses'=>'FrontDeskController@getClient','as'=>'frontdesk.getClient']);
    
    Route::put('frontdesk/add-downpayment',['uses'=>'FrontDeskController@addDownpayment','as'=>'frontdesk.addDownpayment']);

    Route::put('frontdesk/extend-stay',['uses'=>'FrontDeskController@extendStay','as'=>'frontdesk.extendStay']);

    Route::put('frontdesk/guarantee-downpayment',['uses'=>'FrontDeskController@guaranteeDownpayment','as'=>'frontdesk.guaranteeDownpayment']);
    
    Route::get('frontdesk/guest-edit/{id}',['uses'=>'GuestCrudController@guestEdit','as'=>'frontdesk.guestEdit']);
    
    Route::get('frontdesk/guest-folio-view/{id}',['uses'=>'GuestCrudController@guestFolioView','as'=>'folio.guestFolioView']);
    
    Route::get('frontdesk/room-bill-view/{id}',['uses'=>'FrontDeskController@roomBillView','as'=>'frontdesk.roomBillView']);
    
    Route::put('frontdesk/guest-folio',['uses'=>'FrontDeskController@checkOut','as'=>'frontdesk.checkOut']);

    Route::post('frontdesk/getCheckOutReport',['uses'=>'FrontDeskController@getCheckOutReport','as'=>'frontdesk.getCheckOutReport']);

    Route::put('frontdesk/check-out-all-rooms',['uses'=>'FrontDeskController@checkOutAllRooms','as'=>'frontdesk.checkOutAllRooms']);
    
    Route::put('frontdesk/bill-out',['uses'=>'FrontDeskController@billOut','as'=>'frontdesk.billOut']);
    
    Route::get('frontdesk/bill-statement-view/{id}',['uses'=>'FrontDeskController@billStatementView','as'=>'frontdesk.billStatementView']);
    
    Route::get('frontdesk/reservation-details/{id}',['uses'=>'FrontDeskController@reservationDetails','as'=>'frontdesk.reservationDetails']);

    Route::get('frontdesk/reservation-detailsTwo/{id}',['uses'=>'FrontDeskController@reservationDetailsTwo','as'=>'frontdesk.reservationDetailsTwo']);
    
    Route::post('frontdesk/addRoomTemp',['uses'=>'FrontDeskController@addRoomTemp','as'=>'frontdesk.addRoomTemp']);
    
    Route::get('frontdesk/pdf-test',['uses'=>'FrontDeskController@pdfTest','as'=>'frontdesk.pdfTest']);
    
    Route::get('frontdesk/transaction-summary/{id}',['uses'=>'FrontDeskController@transactionSummary','as'=>'frontdesk.transactionSummary']);

    //PRINT PREVIEWS
    Route::get('frontdesk/print-preview-reservation/{id}',['uses'=>'FrontDeskController@printPreviewReservation','as'=>'frontdesk.printPreviewReservation']);

    Route::get('frontdesk/print-room-status-report',['uses'=>'FrontDeskController@printRoomStatusReport','as'=>'frontdesk.printRoomStatusReport']);

    Route::get('frontdesk/print-daily-room-guest-report',['uses'=>'FrontDeskController@printDailyRoomGuestCount','as'=>'frontdesk.printDailyRoomGuestCount']);
    
    Route::get('frontdesk/print-preview-folio/{id}',['uses'=>'FrontDeskController@printPreviewFolio','as'=>'frontdesk.printPreviewFolio']);

    Route::get('frontdesk/print-preview-guest-registration/{id}',['uses'=>'FrontDeskController@printPreviewGuest','as'=>'frontdesk.printPreviewGuest']);
    
    Route::get('frontdesk/print-preview-roombill/{id}',['uses'=>'FrontDeskController@printPreviewRoombill','as'=>'frontdesk.printPreviewRoombill']);
    
    Route::get('frontdesk/print-preview-billstatement/{id}',['uses'=>'FrontDeskController@printPreviewBillstatement','as'=>'frontdesk.printPreviewBillstatement']);

    Route::get('frontdesk/print-preview-billstatement-modal/{id}',['uses'=>'FrontDeskController@printPreviewBillstatementModal','as'=>'frontdesk.printPreviewBillstatementModal']);

    Route::get('frontdesk/print-preview-transaction/{id}',['uses'=>'FrontDeskController@printPreviewTransaction','as'=>'frontdesk.printPreviewTransaction']);
    //
    
    Route::post('frontdesk/roomOccupancyReport',['uses'=>'FrontDeskController@roomOccupancyReport','as'=>'frontdesk.roomOccupancyReport']);

    Route::post('frontdesk/updateCheckOutTime',['uses'=>'FrontDeskController@updateCheckOutTime','as'=>'frontdesk.updateCheckOutTime']);
    
     Route::post('frontdesk/guest-update/',['uses'=>'GuestCrudController@guestUpdate','as'=>'frontdesk.guestUpdate']);
    
    Route::get('frontdesk/get-room-details/{id}',['uses'=>'FrontDeskController@getRoomDetails','as'=>'frontdesk.getRoomDetails']);
    Route::get('frontdesk/get-room-details-byroomid/{id}',['uses'=>'FrontDeskController@getRoomDetailsByRoomId','as'=>'frontdesk.getRoomDetailsByRoomId']);
    
    Route::get('frontdesk/room-modal-blocked/{id}',['uses'=>'FrontDeskController@modalBlocked','as'=>'frontdesk.modalBlocked']);

    Route::get('frontdesk/add-charge-booking/{id}',['uses'=>'FrontDeskController@addChargeBooking','as'=>'frontdesk.addChargeBooking']);
    
    
    
    Route::get('frontdesk/room-modal-view/{id}',['uses'=>'FrontDeskController@modalView','as'=>'frontdesk.modalView']);
    
    Route::get('frontdesk/room-modal-blocked-occ/{id}',['uses'=>'FrontDeskController@modalBlockedOcc','as'=>'frontdesk.modalBlockedOcc']);
    
    
    
    Route::get('frontdesk/guest-register-edit/{id}',['uses'=>'GuestCrudController@guestRegisterEdit','as'=>'frontdesk.guestRegisterEdit']);
    
    Route::get('frontdesk/blocked-view-guest/{id}',['uses'=>'FrontDeskController@blockedViewGuest','as'=>'frontdesk.blockedViewGuest']);
    
    Route::post('frontdesk/guest-register-update/{id}',['uses'=>'GuestCrudController@guestRegisterUpdate','as'=>'frontdesk.guestRegisterUpdate']);
    
    Route::put('frontdesk/check-in-guest',['uses'=>'FrontDeskController@checkInGuest','as'=>'frontdesk.checkInGuest']);
    Route::put('frontdesk/check-out-guest',['uses'=>'FrontDeskController@checkOutGuest','as'=>'frontdesk.checkOutGuest']);

    Route::put('frontdesk/check-in-all-guest',['uses'=>'FrontDeskController@checkInAllGuest','as'=>'frontdesk.checkInAllGuest']);

    Route::put('frontdesk/no-show',['uses'=>'FrontDeskController@noShow','as'=>'frontdesk.noShow']);
    
    Route::get('frontdesk/room-status-edit/{id}',['uses'=>'GuestCrudController@roomStatusEdit','as'=>'frontdesk.roomStatusEdit']);
    
    Route::post('frontdesk/room-status-save',['uses'=>'FrontDeskController@roomStatusSave','as'=>'frontdesk.roomStatusSave']);

    Route::post('frontdesk/close-transaction',['uses'=>'FrontDeskController@closeTransaction','as'=>'frontdesk.closeTransaction']);
    
    Route::post('frontdesk/add-charges',['uses'=>'FrontDeskController@addCharges','as'=>'frontdesk.addCharges']);

    Route::get('frontdesk/clientSearch',['uses'=>'SearchController@clientSearch','as'=>'frontdesk.clientSearch']);
    Route::get('frontdesk/instiSearch',['uses'=>'SearchController@instiSearch','as'=>'frontdesk.instiSearch']);
    Route::get('frontdesk/guestSearch',['uses'=>'SearchController@guestSearch','as'=>'frontdesk.guestSearch']);
    
    Route::get('frontdesk/guest-folio',['uses'=>'FrontDeskController@guestFolio','as'=>'frontdesk.guestFolio']);
    Route::get('frontdesk/night-audit',['uses'=>'FrontDeskController@nightAudit','as'=>'frontdesk.nightAudit']);
   // Route::get('frontdesk/amendments',['uses'=>'FrontDeskController@amendments','as'=>'frontdesk.amendments']);
    
    Route::get('frontdesk/amendments',['uses'=>'FrontDeskController@ammendmentRooms','as'=>'frontdesk.amendments']);
    
    Route::get('frontdesk/checkRoomAvailability',['uses'=>'FrontDeskController@checkRoomAvailability','as'=>'frontdesk.checkRoomAvailability']);
    
    Route::get('frontdesk/checkGuestRegistration',['uses'=>'FrontDeskController@checkGuestRegistration','as'=>'frontdesk.checkGuestRegistration']);
    
    Route::get('frontdesk/reservation',['uses'=>'FrontDeskController@reservation','as'=>'frontdesk.reservation']);
    Route::get('frontdesk/reservation-list',['uses'=>'FrontDeskController@reservationList','as'=>'frontdesk.reservationList']);
    Route::get('frontdesk/daily-guest-arrival',['uses'=>'FrontDeskController@dailyGuestArrival','as'=>'frontdesk.dailyGuestArrival']);
    Route::get('frontdesk/room-occupancy-bulletin',['uses'=>'FrontDeskController@roomOccupancyBulletin','as'=>'frontdesk.roomOccupancyBulletin']);
    Route::get('frontdesk/daily-departure-list',['uses'=>'FrontDeskController@dailyDepartureList','as'=>'frontdesk.dailyDepartureList']);
       
    Route::get('frontdesk/guest-registration',['uses'=>'FrontDeskController@guestRegistration','as'=>'frontdesk.guestRegistration']);


    Route::get('frontdesk/dataTables',['uses' => 'FrontDeskController@dataTables','as'=>'frontdesk.dataTables']);

    Route::get('frontdesk/dataTablesDailyArrivalList',['uses' => 'FrontDeskController@dataTablesDailyArrivalList','as'=>'frontdesk.dataTablesDailyArrivalList']);
    
     Route::get('frontdesk/dataTablesAmmendmentTables/{id}',['uses' => 'FrontDeskController@dataTablesAmmendmentTables','as'=>'frontdesk.dataTablesAmmendmentTables']);

    Route::get('frontdesk/dataTablesRoomOccupancyBulletinList',['uses' => 'FrontDeskController@dataTablesRoomOccupancyBulletinList','as'=>'frontdesk.dataTablesRoomOccupancyBulletinList']);

    
    Route::get('frontdesk/dataTablesDailyDepatureList',['uses' => 'FrontDeskController@dataTablesDailyDepatureList','as'=>'frontdesk.dataTablesDailyDepatureList']);
    
    Route::get('frontdesk/roomissue',['uses'=>'FrontDeskController@roomissue','as'=>'frontdesk.roomissue']);


    Route::get('frontdesk/get-discount/{id}',['uses'=>'FrontDeskController@getDiscount','as'=>'frontdesk.getDiscount']);
    Route::post('frontdesk/retrievePhotos',['uses'=>'FrontDeskController@retrievePhotos','as'=>'frontdesk.retrievePhotos']);

    Route::post('frontdesk/retrieve-id-front',['uses'=>'FrontDeskController@retrieveIdFront','as'=>'frontdesk.retrieveIdFront']);

    Route::post('frontdesk/retrieve-id-back',['uses'=>'FrontDeskController@retrieveIdBack','as'=>'frontdesk.retrieveIdBack']);

    Route::get('frontdesk/images/{file}','FrontDeskController@getImage');

     Route::get('frontdesk/guest-id-front/{file}','FrontDeskController@getImageIdFront');
    Route::get('frontdesk/guest-id-back/{file}','FrontDeskController@getImageIdBack');

      Route::get('frontdesk/datatables-special-request-list/{id}',['uses' => 'FrontDeskController@datatablesSpecialRequestList','as'=>'frontdesk.datatablesSpecialRequestList']);

     Route::post('frontdesk/saveSpecialRequest',['uses'=>'FrontDeskController@saveSpecialRequest','as'=>'frontdesk.saveSpecialRequest']);

//  Route::get('admin/{id}',['uses' => 'AdminUsersController@memberProfile','as' => 'admin.memberProfile']);

     Route::post('frontdesk/deleteSpecialRequestAjax',['uses'=>'FrontDeskController@deleteSpecialRequestAjax','as'=>'frontdesk.deleteSpecialRequestAjax']);

     Route::post('frontdesk/specialRequestList',['uses'=>'FrontDeskController@specialRequestList','as'=>'frontdesk.specialRequestList']);

      Route::post('frontdesk/retrieveRoomTransaction',['uses'=>'FrontDeskController@retrieveRoomTransaction','as'=>'frontdesk.retrieveRoomTransaction']);
    
    Route::post('frontdesk/make-downpayment',['uses'=>'FrontDeskController@makeDownpayment','as'=>'frontdesk.makeDownpayment']);

    Route::post('frontdesk/add-rooms-to-booking',['uses'=>'FrontDeskController@addRoomsToBooking','as'=>'frontdesk.addRoomsToBooking']);

    Route::post('frontdesk/change-transaction-status',['uses'=>'FrontDeskController@changeTransactionStatus','as'=>'frontdesk.changeTransactionStatus']);

    Route::post('frontdesk/api-onlinebooking',['uses'=>'FrontDeskController@apiOnlineReservation','as'=>'frontdesk.apiOnlineReservation']);

    Route::resource('frontdesk','FrontDeskController');

 
    

//  Route::get('admin/{id}',['uses' => 'AdminUsersController@memberProfile','as' => 'admin.memberProfile']);


});

Route::post('home/api-onlinebooking',['uses'=>'FrontDeskController@apiOnlineReservation','as'=>'frontdesk.apiOnlineReservation']);


Route::get('/home', 'HomeController@index');

Route::post('/api-hesm/save-booking',['uses'=>'ApiOnlineBookingController@apiSaveOnlineBooking','as'=>'api-hesm.apiSaveOnlineBooking']);

Route::resource('api-hesm','ApiOnlineBookingController');