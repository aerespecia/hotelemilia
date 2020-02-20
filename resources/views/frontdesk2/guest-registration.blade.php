@extends('layouts.frontdeskLayout')



@section('content')


@if (session()->has('flash_notification.message'))
    <div class="alert media fade in alert-{{ session('flash_notification.level') }}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

        {!! session('flash_notification.message') !!}
    </div>
@endif

<div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar" style="background-color:white;">
          <div class="header-left">
            <div class="topnav">
            
              <ul class="nav nav-tabs no-border">
                <li><a href="{{route('frontdesk.index')}}"><i class="fa fa-calendar-o"></i><span>ROOMS</span></a></li>
                <li><a href="{{route('frontdesk.reservation')}}"><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
               <li class="nav-active active"><a href=""><i class="fa fa-users"></i><span>Guest Registration</span></a></li>
                  <li class="nav-active"><a href="{{route('frontdesk.guestFolio')}}"><i class="icon-note"></i><span>Guest Folio</span></a></li>
                  <li><a href="{{route('frontdesk.nightAudit')}}"><i class="icon-note"></i><span>Night Audit</span></a></li>
                   <li><a href="{{route('frontdesk.amendments')}}"><i class="icon-note"></i><span>Amendments</span></a></li>
                   <li><a href="{{route('frontdesk.roomissue')}}"><i class="icon-note"></i><span>Issues</span></a></li>
              </ul>
                
            </div>
             
          </div>
            
          <div class="header-right">
            <ul class="header-menu nav navbar-nav">
              <!-- BEGIN USER DROPDOWN -->
             
              <!-- END USER DROPDOWN -->
              <!-- BEGIN NOTIFICATION DROPDOWN -->
            
              <!-- END NOTIFICATION DROPDOWN -->
              <!-- BEGIN MESSAGES DROPDOWN -->
              
              <!-- END MESSAGES DROPDOWN -->
              <!-- BEGIN USER DROPDOWN -->
              <li class="dropdown" id="user-header">
                <a href="#" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                <img src="{{url('assets/global/images/avatars/avatar11_big.png')}}" alt="user image">
                    <!-- Calling $user as defined in reservation function in FrontDeskController -->
                <span class="username">Hi, {{$user->name}}</span>
                </a>
                <ul class="dropdown-menu">
                
                  <li>
                    <a href="{{url('/logout')}}"><i class="icon-logout"></i><span>Logout</span></a>
                  </li>
                </ul>
              </li>
              <!-- END USER DROPDOWN -->
              <!-- CHAT BAR ICON -->
             
            </ul>
          </div>
          <!-- header-right -->
            
        </div>
  
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
    
    
        <div class="page-content p-l-10 p-r-10">
                    
          <div class="header">

              <h1 class="text-center"><strong>GUEST</strong> REGISTRATION</h1>
              
          <hr class="m-b-0"/>
          </div>
            <div class="row">
                <div class="col-md-12">
                          <div class="panel">
              
                    <div class="panel-content">
                      <ul class="nav nav-tabs">
                        <li id="active" class="tabsLi"><a href="#tab1_1" data-toggle="tab">Active Reservations</a></li>
                        <li id="guar" class="tabsLi active"><a href="#tab1_2" data-toggle="tab">Guaranteed Reservations</a></li>
                        <li id="staying" class="tabsLi"><a href="#tab1_3" data-toggle="tab">Checked In Reservations</a></li>
                           <li id="code" class="tabsLi"><a href="#tab1_4" data-toggle="tab">Search Thru Code</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane tabsPane fade" id="tab1_1">
                           <div class="panel bg-light">
                   <div class="panel-header bg-red">
                            <h3>Active Reservations (Not Guaranteed)</h3>
                    </div>
                            <div class="panel-content">
                                   <table id="active-table" class="table table-striped f-12">
                    <thead>
                      <tr>
                <th>Booking person</th>
                <th>Institution</th>
                <th>Type</th>
                <th>Code</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
                <th></th>
                
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#active-table').DataTable({
        processing: true,
        serverSide: false,
        "scrollY":        "200px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        ajax: "{!! route('frontdesk.dataTablesActiveReservationList') !!}",
        columns: [
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionName', name: 'institutionName' },
            { data: 'institutionType', name: 'institutionType' },
            { data: 'code', name: 'code' },
            { data: 'arrivalDate', name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate'},
            {
              "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    var valueHere=data.code;
                     return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
              }
            }
        ],
        
    });
    $("#users-table tbody .test").click(function(){
        alert('Hehe');
    } );
});
    
</script>
@endpush
            
                    </tbody>
                  </table>
                            </div>
                        </div>
                        </div>
                        <div class="tab-pane tabsPane fade active in" id="tab1_2">
                          <div class="panel bg-light">
                   <div class="panel-header bg-green">
                            <h3>Guaranteed Reservations</h3>
                    </div>
                            <div class="panel-content">
                                   <table id="gua-table" class="table table-striped f-12">
                    <thead>
                      <tr>
                <th>Booking person</th>
                <th>Institution</th>
                <th>Type</th>
                <th>Code</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
                <th></th>
                
                
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#gua-table').DataTable({
        processing: true,
        serverSide: false,
        "scrollY":        "200px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        ajax: "{!! route('frontdesk.dataTablesGuaranteedReservationList') !!}",
        columns: [
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionName', name: 'institutionName' },
            { data: 'institutionType', name: 'institutionType' },
            { data: 'code', name: 'code' },
            { data: 'arrivalDate', name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate'},
            {
              "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    var valueHere=data.code;
                     return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
              }
            }
       
        ],
        
    });
 
});
    
</script>
@endpush
            
                    </tbody>
                  </table>
                            </div>
                        </div>
                        </div>
                       <div class="tab-pane tabsPane fade" id="tab1_3">
                          <div class="panel bg-light">
                   <div class="panel-header bg-green">
                            <h3>Checked In Reservations</h3>
                    </div>
                            <div class="panel-content">
                                   <table id="check-table" class="table table-striped f-12">
                    <thead>
                      <tr>
                <th>Booking person</th>
                <th>Institution</th>
                <th>Type</th>
                <th>Code</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
                <th></th>
                
                
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#check-table').DataTable({
        processing: true,
        serverSide: false,
        "scrollY":        "200px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        ajax: "{!! route('frontdesk.dataTablesStayingReservationList') !!}",
        columns: [
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionName', name: 'institutionName' },
            { data: 'institutionType', name: 'institutionType' },
            { data: 'code', name: 'code' },
            { data: 'arrivalDate', name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate'},
            {
              "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    var valueHere=data.code;
                     return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
              }
            }
       
        ],
        
    });
 
});
    
</script>
@endpush
            
                    </tbody>
                  </table>
                            </div>
                        </div>
                        </div>
                          <div class="tab-pane tabsPane fade" id="tab1_4">
                               <div class="panel">
                     <div class="panel-header bg-dark">
                  <h4><strong>RESERVATION </strong>LOOK UP</h4>
             <input type="hidden" value="{{$transactionId}}" id="transID"/>
                </div>
           <div class="panel-content">
                    <h3><strong>SEARCH:</strong></h3>           
  
                 
                            <div class="form-group">
                              <h5>RESERVATION ID:</h5>
                                         
                                {!! Form::open(['method'=>'GET','action'=>'FrontDeskController@guestRegistration']) !!}
                                <div class="row">
                                    <div class="col-sm-6">
                                   
                                <input type="text" name="reservID" id="reservID" data-mask="wwwww" class="form-control f-20" minlength="3" style="letter-spacing: 8px;" placeholder="XXXXX">
                                
                           
                                    </div>
                                    <div class="col-sm-4">
                                     <button type="submit" id="reserv-search-btn" class="btn btn-lg btn-dark">Search</button>
                                    </div>
                                </div>
                              {!! Form::close() !!}
                            </div>
        

            </div>            
            </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>
       
            </div>
            
     
            <hr style="border-size:3px;"/>
         
            <h2><strong>RESERVATION ID: </strong>{{$code}}</h2>
           
            <button type="button" class="btn btn-default btn-transparent" data-toggle="modal" data-target="#modal-reservation-detail" value="{{$transactionId}}" id="view-transaction">View Reservation Summary</button>
            <button class="btn btn-sm btn-primary bill-statement" data-toggle="modal" value="{{$transactionId}}" data-target="#modal-bill-statement">Billing Statement</button>
            <button class="btn btn-sm btn-primary" data-toggle="modal" value="{{$transactionId}}" data-target="#modal-manage-downpayment">Manage Downpayments</button>
            
            <div class="row">
                <div class="col-md-6">
                      <div class="panel" id="registration-info">
                        <div class="panel-header">
                            <h4><i class="fa fa-users"></i> <strong>Reserved Guest/s</strong></h4>  
                            <button id="add-guest" data-toggle="modal" data-target="#modal-add-guest" class="btn btn-sm btn-primary">Add Guest</button>

                            <hr/>
                        </div>
                        <div class="panel-content p-t-0">
            <table id="guests-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Name</th>
                <th>Account ID</th>
                <th>Room</th>
                <th>Action</th>
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    
    var transactionID = $("#transID").val();
    
//    var url = "{{route('frontdesk.dataTablesGuestReservationList',['id' =>':id'])}}";
//    
//    var url2 = url.replace(":id",roomID);
//    
    if(transactionID!=''){
        $('#guests-table').DataTable({
        processing: true,
        serverSide: false,
       "scrollY":        "200px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        ajax: "../frontdesk/datatables-guest-reservation-list/"+transactionID,
        columns: [
           
            { data: 'name', name: 'name' },
            { data: 'account_id', name: 'account_id' },
            { data: 'roomName', name: 'roomName' },
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                  var valueHere=data.id;
                   return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-guest-edit" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button data-toggle="modal" data-target="#modal-guest-folio" class="btn btn-sm btn-blue folio-modal" data-id="3" value="'+valueHere+'">View Folio</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-guest" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li></ul>';
            }
        }
        ]
    });
    }
    

    
    $('#guests-table tbody').on( 'click', 'button', function () {        
        
        var id = $(this).attr("data-id");
        
        if(id==1){
            var guestReservID = this.value;
        
                $.get("../frontdesk/guest-edit/"+guestReservID,function(data){
                    console.log(data);
                    $(".title-name").html(data.firstName+" "+data.familyName);
                    $("#guest-registration-no").html(data.guestReservNoNF);
                    $("#guest-fname").val(data.firstName);
                    $("#guest-mname").val(data.middleName);
                    $("#guest-lname").val(data.familyName);
                    $("#guest-housebldg").val(data.houseNo);
                    $("#guest-brgy").val(data.brgy);
                    $("#guest-city").val(data.city);
                    $("#guest-country").val(data.country);
                    $("#guest-postalcode").val(data.postalCode);
                    $("#guest-nationality").val(data.nationality);
                    $("#guest-contactNo").val(data.contactNo);
                    $("#guest-email").val(data.email);
                    $("#guest-dob").val(data.dob);
                    $("#guest-designation").val(data.designation);
                    $("#guest-passno").val(data.passNo);
                    $("#guest-passexp").val(data.passExpiry);
                    $("#guest-passissue").val(data.passIssue);
                    $("#guest-otherid").val(data.otherId);
                    $("#guestTempId").val(data.id);
                    $(".guest-edit-save").val(data.id);
                    $(".guest-edit-close").val(data.id);
                    
                    
                    if(data.account_id)
                        $("#account-id").html(data.account_id);
                    else
                        $("#account-id").html("NEW GUEST");
                  
                });
            
                 $.get("../frontdesk/guest-register-edit/"+guestReservID,function(data){
                    console.log(data);
                   $("#guestReservationId").html(data.guest_registration_no);
                     if(data.guest_registration_no)
                   $("#assigned-room").html(data.roomName+" - "+data.roomType);
                   
                    
                  
                });
            $("#assign-room-save").val(guestReservID);
        }
        

        if(id==3){
            var guestReservID = this.value;
            
            $("#folio-print").attr('href','../frontdesk/print-preview-folio/'+guestReservID);
            
         
            
                $.get("../frontdesk/guest-folio-view/"+guestReservID,function(data){
                    console.log(data);
                    
           //         for(var i=0; i<data.length;i++)
                   $("#folio-title-name").html(data.guest[0]["firstName"]+" "+data.guest[0]["familyName"]);
                    
                    $("#folio-gRegId").html(data.guest[0]["guest_registration_no"]);
                    
                    $("#folio-reservId").html(data.guest[0]["code"]);
                    
                    $("#folio-name").html(data.guest[0]["firstName"]+" "+data.guest[0]["familyName"]);
                    
                    $("#folio-institution").html(data.guest[0]["instiName"]);
                    var arr = new Date(data.guest[0]["arrivalDate"]);
                    var arrdate = arr.getDate();
                    var arrmonth = arr.getMonth() + 1; //Months are zero based
                    var arryear = arr.getFullYear();
                    
                    $("#folio-arrival").html(arrmonth+"/"+arrdate+"/"+arryear);
                    
                    var dep = new Date(data.guest[0]["depatureDate"]);
                    var depdate = dep.getDate();
                    var depmonth = dep.getMonth() + 1; //Months are zero based
                    var depyear = dep.getFullYear();
                    
                    
                    $("#folio-depature").html(depmonth+"/"+depdate+"/"+depyear);
                    
                    $("#folio-address").html(data.guest[0]["houseNo"]+" "+data.guest[0]["brgy"]+" "+data.guest[0]["city"]+" "+data.guest[0]["country"]);
                    
                    $("#folio-mobile").html(data.guest[0]["contactNo"]);
                    $("#folio-room-type").html(data.guest[0]["name"]);
                    $("#folio-room-name").html(data.guest[0]["roomName"]);
                    
                   
                    var string = numeral(data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"])).format('0,0.00');
                    
                    
                    
//                    alert(data[0]["rate"]);
                    var rateDiscount = string+" ("+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]*100+"%)";
                    
                    
                    $("#folio-rate").html(string+" ("+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]*100+"%)");
        
//                     var amendList = [];
//                    
//                for(var j=0;j<data.length;j++){
//                    
//                    if(amendList.indexOf(data[j]["amendId"])== -1){
//                      
//                       amendList.push(data[j]["amendId"]);
//                    }
//                  }
//                 
                    var amountTotal = 0;
                    var paymentsTotal = 0;
                    var balance = 0;
                    
                     var roomRate = data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"]);
                    
                    var totalRoomRate = roomRate * data.guest[0]["noOfDays"];
                    var stringTotalRoomRate = numeral(totalRoomRate).format('0,0.00');
                        
                    
                    
                    
                    $('#charges-table > tbody:last-child').append('<tr><td>'+arrmonth+"/"+arrdate+"/"+arryear+'</td><td>ROOM: '+data.guest[0]["roomName"]+' - '+data.guest[0]["name"]+' ('+data.guest[0]["noOfDays"]+') days -- Rate:'+rateDiscount+'</td><td class="text-right"></td><td class="text-right">&#8369; '+stringTotalRoomRate+'</td><td class="text-right">&#8369; '+stringTotalRoomRate+'</tr>');
                    
                    
                    amountTotal+=totalRoomRate;
                    paymentsTotal+=totalRoomRate;
               
//                    var test = [];
//                   
//                    var tempArray = [];
//                    
//          
//                    if(data[0]["amendId"]){
                        for(var i=0;i<data.amendments.length;i++){
                      
                                var arr2 = new Date(data.amendments[i]["amendDate"]);
                                var arrdate2 = arr2.getDate();
                            var arrmonth2 = arr2.getMonth() + 1; //Months are zero based
                            var arryear2 = arr2.getFullYear();
                               
                                  var roomRate2 = data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"]);
                          var rateDiscount2 = numeral(data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"])).format('0,0.00')+" ("+data.amendments[i]['discountNameAmend']+" "+data.amendments[i]["discountValueAmend"]*100+"%)";
                            var totalRoomRate2 = roomRate2 * data.amendments[i]["amendDays"];
                            var stringTotalRoomRate2 = numeral(totalRoomRate2).format('0,0.00');

                            $('#charges-table > tbody:last-child').append('<tr><td>'+arrmonth2+"/"+arrdate2+"/"+arryear2+'</td><td>ROOM: '+data.amendments[i]["amendRoomName"]+' - '+data.amendments[i]["amendRoomType"]+' ('+data.amendments[i]["amendDays"]+') days -- Rate:'+rateDiscount2+'</td><td class="text-right"></td><td class="text-right">&#8369; '+stringTotalRoomRate2+'</td><td class="text-right">&#8369; '+stringTotalRoomRate2+'</tr>');
                        
                            amountTotal+=totalRoomRate2;
                            paymentsTotal+=totalRoomRate2;          

                            }
//                                     
                  
                    for(var j=0;j<data.charges.length;j++){
                   
                             
                            var cd = new Date(data.charges[j]["chargeCreated"]);
                        
                        var chargePrice = numeral(data.charges[j]["price"]).format('0,0.00');
                        
                        var chargeday = cd.getDate();
                        var chargemonth = cd.getMonth() + 1;
                        var chargeyear = cd.getFullYear();
                        
                        if(data.charges[j]["account_type"]==1){
                            $('#charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td class="text-right">&#8369; '+chargePrice+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</tr>');
                            
                            amountTotal+=data.charges[j]["price"];
                        }
                        
                        
                        if(data.charges[j]["account_type"]==2){
                            $('#charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</td><td class="text-right">&#8369; '+chargePrice+'</tr>');
                            
                            amountTotal+=data.charges[j]["price"];
                            paymentsTotal+=data.charges[j]["price"];
                        }
                             
                       }
//                 
                    
                    downpayment = data.guest[0]["downpayment"];
                    paymentsTotal+=downpayment;
                    balance = amountTotal - paymentsTotal;
//                    
                    amountTotal = numeral(amountTotal).format('0,0.00');
                    paymentsTotal = numeral(paymentsTotal).format('0,0.00');
                    balance = numeral(balance).format('0,0.00');
                    
                     $('#charges-table > tbody:last-child').append('<tr><td colspan="2" class="text-right">Downpayment</td><td></td><td></td><td class="text-right">&#8369; '+numeral(downpayment).format('0,0.00')+'</td></tr><tr><td colspan="2" class="text-right">Total</td><td></td><td></td><td class="text-right">&#8369; '+amountTotal+'</td></tr><tr><td colspan="2" class="text-right">Payments</td><td></td><td class="text-right">&#8369; '+paymentsTotal+'</td><td></td></tr><tr><td colspan="2" class="text-right">Balance/Amount Payable</td><td></td><td></td><td class="text-right c-red f-20"><strong>&#8369; '+balance+'</strong></td></tr>');
//                  
                });
        }

        if(id==2){
             var guestReservID = this.value;
            
            $("#confirm-remove").val(guestReservID);
            
            $.get("../frontdesk/remove-guest/"+guestReservID,function(data){
                $("#guestreserv-name").html(data.firstName+" "+data.familyName);                    
            });
            
        }
     

    } );
    
});


  
</script>


@endpush
            
                    </tbody>
                  </table>
                            
                            
                        </div>
                    </div>
                </div>
            <div class="col-md-6">
                
                
                      <div class="panel" id="registration-info">
                        <div class="panel-header">
                            <h4><i class="fa fa-home"></i> <strong>Reserved Room/s</strong></h4>  
                            <hr/>                                   
                        </div>
                        <div class="panel-content p-t-0">
            <table id="rooms-table" class="table table-striped">
                    <thead>
                      <tr>
                <th>Room No</th>
                <th>Room Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
                
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    
    var transactionID = $("#transID").val();
    
//    var url = "{{route('frontdesk.dataTablesGuestReservationList',['id' =>':id'])}}";
//    
//    var url2 = url.replace(":id",roomID);
//   
    if(transactionID!=''){
        $('#rooms-table').DataTable({
        processing: true,
        serverSide: false,
       "scrollY":        "200px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        ajax: "../frontdesk/datatables-room-reservation-list/"+transactionID,
        columns: [
           
            { data: 'roomName', name: 'roomName' },
            { data: 'roomType', name: 'roomType' },
            {data: null,
             "className": 'options',
             "render": function(data,type,full,meta){
                 var status = data.occupied_status;
                 
                 if(status==1)
                    return '<span class="label label-success">Checked In</span>';
                 else if(status==2)
                    return '<span class="label label-danger">Checked Out</span>';
                 else
                     return '<span class="label label-warning">Not Checked In</span>';
             }
            },
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                  var valueHere=data.id;
                   return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-room-register" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button data-toggle="modal" data-target="#modal-room-bill" class="btn btn-sm btn-blue room-bill-view" data-id="3" value="'+valueHere+'">View Bill</button></li><li><button type="button" data-id="2" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li></ul>';
            }
        }
        ]
    });
    }
    
    

    
    $('#rooms-table tbody').on( 'click', 'button', function () {        
        
        var id = $(this).attr("data-id");
        
        if(id==1){
            var roomId = this.value;
                   $.get("../frontdesk/get-room-details/"+roomId,function(data){
                    console.log(data);
                    
                    var arr = new Date(data[0]["arrivalDate"]);
                    var arrdate = arr.getDate();
                    var arrmonth = arr.getMonth() + 1; //Months are zero based
                    var arryear = arr.getFullYear();

                    var dep = new Date(data[0]["depatureDate"]);
                    var depdate = dep.getDate();
                    var depmonth = dep.getMonth() + 1; //Months are zero based
                    var depyear = dep.getFullYear();

                    var int = new Date(data[0]["initialDepartureDate"]);
                    var intdate = int.getDate();
                    var intmonth = int.getMonth() + 1; //Months are zero based
                    var intyear = int.getFullYear();


                    $("#room-title-name").html(data[0]["roomName"]+" - "+data[0]["roomType"]);

                    $("#room-register-arrival").html(arrmonth+"/"+arrdate+"/"+arryear);
                    $("#room-register-departure").html(intmonth+"/"+intdate+"/"+intyear);
                    $(".add-date-extension").val(data[0]["id"]);

                    if(dep>int){
                      $("#room-register-ext").html(depmonth+"/"+depdate+"/"+depyear);
                      $("#ext-date").val(depmonth+"/"+depdate+"/"+depyear);
                    }
                    


                   // "#room-register-ext"
                       
                    $(".check-in-guest").val(data[0]["id"]);
                    $("#room-title-name2").html(data[0]["roomName"]+" - "+data[0]["roomType"]);
                    var guestListing = $("#reserved-guest");
                    
                    var occ_status = data[0]["occupied_status"];
                       
                    if(occ_status==1){
                        $("#room-status-checkin").html("Checked In");
                        $("#room-status-checkin").attr("class","label label-danger");
                    }
                    else{
                         $("#room-status-checkin").html("Not Checked In");
                        $("#room-status-checkin").attr("class","label label-warning");
                    }
                        
                        
                    for(var i=0; i < data.length; i++){
                           guestListing.append("<li>"+data[i]["firstName"]+" "+data[i]["familyName"]+"</li>");
                       }
            
                });
            
              
            
            
        }

        if(id==3){

           var roomReservID = this.value;
            
         $("#room-bill-print").attr('href','../frontdesk/print-preview-roombill/'+roomReservID);
            
                $.get("../frontdesk/room-bill-view/"+roomReservID,function(data){
                    console.log(data);
                    
           //         for(var i=0; i<data.length;i++)
                 $("#room-bill-title-name").html(data.guest[0]["roomName"]);
                 $("#room-bill-title-type").html(data.guest[0]["roomType"]);
                $("#room-bill-title2-name").html(data.guest[0]["roomName"]);
                 $("#room-bill-title2-type").html(data.guest[0]["roomType"]);
                $("#room-bill-modal-reservID").html(data.guest[0]["code"]);
                    var roomRate = numeral(data.guest[0]["rate"]).format('0,0.00');
                    
//                $("#room-modal-rate").html(roomRate);
                $("#room-bill-modal-institution").html(data.guest[0]["instiName"]);
                $("#room-bill-modal-roomType").html(data.guest[0]["roomType"]);
               
                $("#room-bill-modal-depart").html(data.guest[0]["depatureDate"]);
                  
                 var arr = new Date(data.guest[0]["arrivalDate"]);
                    var arrdate = arr.getDate();
                    var arrmonth = arr.getMonth() + 1; 
                    var arryear = arr.getFullYear();
                    
                $("#room-bill-modal-arrival").html(arrmonth+"/"+arrdate+"/"+arryear);
                    
                    var dep = new Date(data.guest[0]["depatureDate"]);
                    var depdate = dep.getDate();
                    var depmonth = dep.getMonth() + 1; 
                    var depyear = dep.getFullYear();

                $("#room-bill-modal-depart").html(depmonth+"/"+depdate+"/"+depyear);
                
                var guestNames = "";
                    
                var account_ids = [];
                    
                for(var j=0;j<data.guest.length;j++){
                    
                    if(account_ids.indexOf(data.guest[j]["account_id"])== -1){
                        var firstName = data.guest[j]["firstName"]
                        guestNames+=firstName[0]+". "+data.guest[j]["familyName"];
                        
                       account_ids.push(data.guest[j]["account_id"]);
                        
                        if((j+2)!=data.guest.length)
                            guestNames+=", ";
                    }
                    
                        
                  
                }
                    
                $("#room-bill-modal-guests").html(guestNames);
                
                     var amountTotal = 0;
                    var paymentsTotal = 0;
                    var totalBalance = 0;
                    
                 
                    
                     var string = numeral(data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"])).format('0,0.00');
                    
                    var rateDiscount = string+" ("+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]*100+"%)";
                    
                    
                    $("#room-bill-modal-rate").html(string+" ("+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]*100+"%)");
                    
                      var roomRate = data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"]);
                   
            
                    
                    for(var i=0;i<data.amendments.length;i++){
                                 
                    var arr2 = new Date(data.amendments[i]["amendDate"]);
                    var arrdate2 = arr2.getDate();
                    var arrmonth2 = arr2.getMonth() + 1; //Months are zero based
                    var arryear2 = arr2.getFullYear();
                               
                                  var roomRate2 = data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"]);
                          var rateDiscount2 = numeral(data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"])).format('0,0.00')+" ("+data.amendments[i]['discountNameAmend']+" "+data.amendments[i]["discountValueAmend"]*100+"%)";
                            var totalRoomRate2 = roomRate2 * data.amendments[i]["amendDays"];
                            var stringTotalRoomRate2 = numeral(totalRoomRate2).format('0,0.00');

                            $('#room-bill-charges-table > tbody:last-child').append('<tr><td>'+arrmonth2+"/"+arrdate2+"/"+arryear2+'</td><td></td><<td>ROOM: '+data.amendments[i]["amendRoomName"]+' - '+data.amendments[i]["amendRoomType"]+' ('+data.amendments[i]["amendDays"]+') days -- Rate:'+rateDiscount2+'</td><td class="text-right">&#8369; '+stringTotalRoomRate2+'</td><td class="text-right">&#8369; '+stringTotalRoomRate2+'<td class="text-right"></td></tr>');
                        
                            amountTotal+=totalRoomRate2;
                            paymentsTotal+=totalRoomRate2;
                           
                           
                           
                           }
                        
                    
                    var totalRoomRate = roomRate * data.guest[0]["noOfDays"];
                    var stringTotalRoomRate = numeral(totalRoomRate).format('0,0.00');
                    
                    
                    
                    $('#room-bill-charges-table > tbody:last-child').append('<tr><td>'+arrmonth+"/"+arrdate+"/"+arryear+'</td><td></td><td>ROOM: '+data.guest[0]["roomName"]+' - '+data.guest[0]["roomType"]+' ('+data.guest[0]["noOfDays"]+') days -- Rate:'+rateDiscount+'</td><td class="text-right">&#8369; '+stringTotalRoomRate+'</td><td class="text-right">&#8369; '+stringTotalRoomRate+'<td></td></tr>');
                    
                    amountTotal+=totalRoomRate;
                    paymentsTotal+=totalRoomRate;
                    
                   
                    var tempArr2 = [];
                    
            
                        
                   
                             
                    for(var i=0;i<data.charges.length;i++){
                      
                        var cd = new Date(data.charges[i]["chargeCreated"]);

                        var chargeday = cd.getDate();
                        var chargemonth = cd.getMonth() + 1;
                        var chargeyear = cd.getFullYear();
        
                      
                        if(data.charges[i]["account_type"]==1){
     
                            
                            var payment = 0;
                            var amount = data.charges[i]["price"];
                            var balance = amount - payment;
                            
                            totalBalance+=balance;
                            amountTotal+=amount;
                            paymentsTotal+=payment;
           
                            $('#room-bill-charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>'+data.charges[i]["os_id"]+'</td><td>'+data.charges[i]["item_name"]+'</td><td class="text-right">&#8369; '+numeral(amount).format('0,0.00')+'</td><td class="text-right"></td><td class="text-right">&#8369; '+numeral(balance).format('0,0.00')+'</td></tr>');
     
                        }
                        
                        
                        if(data.charges[i]["account_type"]==2){
                            var payment = data.charges[i]["price"];
                            var amount = data.charges[i]["price"];
                            var balance = amount - payment;
                            totalBalance+=balance;
                            amountTotal+=amount;
                            paymentsTotal+=payment;
                            
                            $('#room-bill-charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>'+data.charges[i]["os_id"]+'</td><td>'+data.charges[i]["item_name"]+'</td><td class="text-right">&#8369; '+numeral(amount).format('0,0.00')+'</td><td class="text-right">&#8369; '+numeral(payment).format('0,0.00')+' </td><td class="text-right">&#8369; '+numeral(balance).format('0,0.00')+'</td></tr>');
                            
                         
                        }
           
                        
                        
                    }
                    
                 
                    
                    
                    totalBalance = numeral(totalBalance).format('0,0.00');
                    
                    amountTotal = numeral(amountTotal).format('0,0.00');
                    paymentsTotal = numeral(paymentsTotal).format('0,0.00');
                    
                      $('#room-bill-charges-table > tbody:last-child').append('<tr style="border-top: 2px solid;"><td colspan="3" class="text-right">TOTALS:</td><td class="text-right">&#8369; '+amountTotal+'</td><td class="text-right">'+paymentsTotal+'</td><td class="text-right">'+totalBalance+'</td></tr>');
           
              
               
                         
                });
  
        }
        

    });
    
});


  
</script>


@endpush
            
                    </tbody>
                  </table>
                            
                            
                        </div>
                    </div>
                </div>
            </div>
             <div class="row">
                <div class="col-md-12">
                  <div class="panel" id="registration-info">
                      <div class="panel-header">
                            <h4><i class="fa fa-users"></i> <strong>Reservation Notes</strong></h4>  
                            <hr/>
                        </div>
                      <div class="panel-content p-t-0">
                        <h3><strong>{{$notes}}</strong></h3>                        
                      </div>
                      <div class="panel-header">
                            <h4><i class="fa fa-users"></i> <strong>Scheduled Special Request</strong></h4>  
                            
                            <hr/>
                            <button id="add-special-request" data-toggle="modal" data-target="#modal-special-request" class="btn btn-sm btn-primary" value="{{$transactionId}}">Add Special Rquest</button>
                        </div>
                      <div class="panel-content p-t-0">
                          <table id="specialRequest-table" width="100%" class="table table-striped">
                            <thead>
                              <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Room Name</th>
                        
                        <th>Note</th>
                        <th>Action</th>
                    </tr>
                </thead>
                            <tbody>
                              @push('scripts')
        <script>
        $(function() {
          var transactionID = $("#transID").val();
          
            $('#specialRequest-table').DataTable({
                processing: true,
                serverSide: false,
                "bDestroy": true,
                ajax:"../frontdesk/datatables-special-request-list/"+transactionID,
                columns: [
                  { data: 'requestDate' , name: 'requestDate' },
                    { data: 'requestTime' , name: 'requestTime' },
                    { data: 'roomName', name: 'roomName' },
                    
                    { data: 'note' , name: 'note' },
                    
                    {
                    "className":      'options',
                    "data":           null,
                    "render": function(data, type, full, meta){
                            var valueHere=data.id+'#'+data.name+'#'+data.firstname+'#'+data.lastname+'#'+data.contactNo;
                            return '<button type="button" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" value="'+valueHere+'">Delete</button>';
                      }
                  }
                ]
            });

            

        });


        </script>


        @endpush
                    
                            </tbody>
                          </table>
                      </div>
                  </div>
                </div>
              </div>

            <!--- EDIT GUEST REGISTRATION BEGIN -->
            <!--- GUEST REGISTRATION MODAL BEGINS EDIT-GUEST -->    
        <div class="modal fade" id="modal-guest-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>GUEST REGISTRATION CARD:</strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body">
                 <div class="row">
                    <div class="col-md-6">
                    <div class="row">
                        <h2 align="center"><strong>EDIT GUEST INFORMATION</strong></h2>
                    </div>
                 
                    <div class="row">
                    <div class="col-md-6">
                        <h3>GUEST ACCOUNT ID: 
                            
                            <strong><span id="account-id"></span></strong></h3>
                        </div>
                    </div>
                    <div id="guest-modal-body" class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                       <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">First Name</label>
                             
                                <input type="text" name="guest-fname" id="guest-fname" class="form-control" placeholder="Enter First Name..." minlength="3" value="">
                              
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Middle Name</label>
                         
                                <input type="text" name="guest-mname" id="guest-mname" class="form-control" placeholder="Enter Middle Name..." minlength="3">
                              
                            </div>
                          </div>
                           <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Last Name</label>
                             
                                <input type="text" name="guest-lname" id="guest-lname" class="form-control" placeholder="Enter Last Name..." minlength="3">
                             
                            </div>
                          </div>
                        </div><br/><br/>
                            <div class="row border-top">
                            <h3 class="col-sm-6 m-t-10"><strong>Complete Address</strong></h3>
                            </div>
                            
                            <div class="row">
                                 
                          <div class="col-sm-4">
                              
                            <div class="form-group">
                               
                              <label class="control-label f-12">House/Bldg No. and Street</label>
                             
                                <input type="text" name="guest-housebldg" id="guest-housebldg" class="form-control" placeholder="House/Bldg No. and Street..." minlength="3" >
                              
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Barangay/Village</label>
                         
                                <input type="text" name="guest-brgy" id="guest-brgy" class="form-control" placeholder="Brgy./Village..." minlength="3">
                              
                            </div>
                          </div>
                           <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">City/Town/Province/State</label>
                             
                                <input type="text" name="guest-city" id="guest-city" class="form-control" placeholder="City/Town/Province/State..." minlength="3">
                             
                            </div>
                          </div>
                                
                        </div>
                            <div class="row border-bottom">
                                <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Country</label>
                             
                                <input type="text" name="guest-country" id="guest-country" class="form-control" placeholder="Country.." minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Postal Code</label>
                             
                                <input type="text" name="guest-postalcode" id="guest-postalcode" class="form-control" placeholder="Postal Code" minlength="3">
                             
                            </div>
                          </div>
                                <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Nationality</label>
                             
                                <input type="text" name="guest-nationality" id="guest-nationality" class="form-control" placeholder="Nationality" minlength="3">
                             
                            </div>
                          </div>
                            </div><br/><br/>
                         <div class="row border-bottom">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Contact No.</label>
                             
                                <input type="text" name="guest-contactNo" id="guest-contactNo" class="form-control" placeholder="Contact No..." minlength="3">
                              
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Email</label>
                             
                                <input type="text" name="guest-email" id="guest-email" class="form-control" placeholder="Email" minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Date of Birth</label>
                             
                                <input type="text" name="guest-dob" id="guest-dob" class="form-control" data-mask="99-99-9999" placeholder="MM/DD/YYYY" minlength="3">
                             
                            </div>
                          </div>
                             <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Designation</label>
                             
                                <input type="text" name="guest-designation" id="guest-designation" class="form-control" placeholder="Title/Designation" minlength="3">
                             
                            </div>
                          </div>
                             
                     
                        </div><br/><br/>
                        <div class="row">
                        
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Passport No./ID</label>
                             
                                <input type="text" name="guest-passno" id="guest-passno" class="form-control" placeholder="Passport no." minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Passport Expiry Date</label>
                             
                                <input type="text" name="guest-passexp" id="guest-passexp" class="form-control"  placeholder="Passport Expiry" minlength="3">
                             
                            </div>
                          </div>
                             <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Passport Date of Issue</label>
                             
                                <input type="text" name="guest-passissue" id="guest-passissue" class="form-control" placeholder="Passport Date of Issue" minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Other ID Presented</label>
                             
                                <input type="text" name="guest-otherid" id="guest-otherid" class="form-control" placeholder="ID presented" minlength="3" >
                              
                            </div>
                          </div>
                             
                     
                        </div>
                            
                        </div>
                    </div>
                  
                  
                   <div class="row">
                       <div class="col-md-6">
                       <div class="form-group">
                          <h5><strong>Scanned Registration Form</strong>
                           </h5>
                          <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                              <i class="glyphicon glyphicon-file fileinput-exists"></i><span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-dark btn-file"><span class="fileinput-new">Choose file</span><span class="fileinput-exists">Change</span>
                            <input type="file" name="...">
                            </span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>  
                       </div>
                              
                </div><hr/>
                        <div class="row">
                            <div class="pull-right m-r-10">
                                <button type="button" class="btn btn-dark btn-embossed m-r-20" data-toggle="modal" data-target=""><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-success btn-embossed guest-edit-save" id="" value=""> SAVE</button>
                            </div>
                            
                        </div>
                    </div>    
                     <div class="col-md-6">
                         
                        <div class="row">
                        <h2 align="center"><strong>ROOM ASSIGNMENT</strong></h2>
                        </div>
                         <div class="row">
                    <div class="col-md-6">
                        <h3>GUEST REGISTRATION ID: 
                            
                            <strong><span id="guestReservationId">N/A</span></strong></h3>
                        </div>
                    </div>
                         <div id="guest-modal-body-register" class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                         <div class="row">
                            <div class="col-md-12 f-12">
                                     <h5><strong>ASSIGNED ROOM: <span id="assigned-room"></span></strong></h5>
                                <br/><br/>
                                     <div class="form-group">
                                        <h5><strong>Transfer/Assign Room: </strong></h5>
                                    <div class="input-group">
                                        <div class="icheck-list" id="room-list">
                                           <?php $roomTemp = ""; ?>
                                  @if($rooms)
                                    @foreach($rooms as $r)
                                    @if($r->roomName!=$roomTemp)

                                    <?php $totalGuests = 0;?>
                                        <label class="f-12" id="{{$r->id}}">
                                            <input type="radio" data-radio="iradio_square-blue" id="roomselect" name="roomselect" value="{{$r->reserveid}}"> {{$r->roomName.' -'.$r->roomType}} [                
                                            @foreach($guests as $g)
                                            @if($g->roomReservationId == $r->reserveid)
                                            {{$g->firstName.' '.$g->familyName.', '}} <?php $totalGuests++; ?>
                                            @endif
                                            @endforeach] ({{$totalGuests}})
                                            </label>
                                         <?php $roomTemp = $r->roomName; ?>
                                    @endif
                                @endforeach
                                    @endif
                                           
                                       
                                      
                                        </div>
                                    </div>
                                         
                                        </div> 
                         
                                    <input type="hidden" id="guestReservID" name="guestReservID" value=""/>
                                </div>
                                <h3 id="test"></h3>
                                
                            </div>
                            
                             </div>
                         <div class="row">
                            <div class="pull-right m-r-20">
                              <button type="button" class="btn btn-success btn-embossed guest-register-edit-save" id="assign-room-save" value=""> SAVE</button>
                             </div>
                         </div>
                         </div>
                     
                    </div>
                </div>
                    
                    <br/>
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed guest-edit-close" data-dismiss="modal" value="">CLOSE</button>
                     
                </div>
              </div>
            </div>
          </div>
            
        </div>
            <!-- Special Request Modal -->

            <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-special-request" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header bg-aero">
                      
                      <h4 class="modal-title"><strong>Create Special Request Form:<span id="room-title-name"></span></strong> </h4>
                     
                    </div>
                     
                    <div class="modal-body" id="room-modal-register2">
                     <h2><strong>Create Special Request<span id="room-title-name2"></span></strong></h2>
                      <div class="panel panel-transparent p-15 bd-6" id="guest-register-info" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label class="control-label f-12">Duration</label>
                                  <select id="durationRequest" name="durationRequest" class="form-control">
                                        <option value="0">Once</option>
                                        <option value="1">Whole Reservation</option>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label class="control-label f-12">Room:</label>
                                  <select id="roomRequest" name="roomRequest" class="form-control">
                                    <option value="0">All Room Reserved</option>
                                    <span id="roomListReserved"></span>
                                  </select>
                                </div>
                              </div>

                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label class="control-label f-12">Date</label>
                                      <input type="text" class="b-datepicker form-control" id="dateRequest" name="dateRequest" placeholder="Date of Request"/>
                                </div>
                              </div>
                              <div class="col-sm-4">
                                <div class="form-group">
                                  <label class="control-label f-12">Time</label>
                                      <div class="prepend-icon">
                                        <input type="text" name="timeRequest" id="timeRequest" class="timepicker form-control" placeholder="Choose a time..." readonly>
                                        <i class="icon-clock"></i>
                                      </div>
                                </div>
                              </div>
                            </div>

                            <div class="row">
                              <div class="col-sm-12">
                                <div class="form-group">
                                  <label class="control-label f-12">Notes</label>
                                  <textarea rows="10" class="form-control" name="noteRequest" id="noteRequest"></textarea>
                                </div>
                              </div>
                            </div>
                        </div>
                      </div>
                      
                      <br/>
                    <div class="modal-footer bg-dark">
                      <button type="button" class="btn btn-white btn-embossed" id="special-request-close" data-dismiss="modal" value="">CLOSE</button>
                      <button type="button" class="btn btn-success btn-embossed special-request-save" id="special-request-save" value=""> SAVE</button>
                    </div>
                  </div>
                </div>
              </div>
                
            </div>




            <!-- End of Special Request Modal -->





             <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-room-register" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  
                  <h4 class="modal-title"><strong>ROOM:<span id="room-title-name"></span></strong> </h4>
                 
                </div>
                 
                <div class="modal-body" id="room-modal-register">
                 <h2><strong>ROOM <span id="room-title-name2"></span></strong></h2>
                <div class="row">
                    <div class="col-md-6">
                        
                        <h2 class="m-b-20"><span id="room-status-checkin"></span></h2>
                    </div>
                    <div class="col-md-6">

                    </div>
                        
                    </div>
                    
                  <div class="panel panel-transparent p-15 bd-6" id="guest-register-info" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                   
                      
                        <div class="panel-content">
                <div class="row">
                       <div class="col-md-6 line-separator">
                       <h5><strong>Guest/s in room:</strong></h5>
                          <div class="col-md-6">
                               
                           <ul class="m-l-30" id="reserved-guest">
                               
                           </ul>
                          </div>
                          <div class="col-md-6">
                        <button type="button" class="btn btn-hg btn-danger check-in-guest">CHECK IN</button>
                        </div> 
                        </div>
                        <div class="col-md-6">
                         <h5><strong>Arrival Date: <span id="room-register-arrival"></span></strong></h5>
                         <h5><strong>Departure Date: <span id="room-register-departure"></span></strong></h5>
                         <h5><strong>Extension Date: <span id="room-register-ext">n/a</span></strong></h5>
                         <hr/>
                         <h5><strong>Edit/Add Extension of Stay:</strong></h5>
                         <div class="row">
                      <div class="col-md-5 m-t-10">
                      <div class="prepend-icon">
                      <input type="text" id="ext-date" name="ext-date" autocomplete="off" class="b-datepicker form-control" placeholder="Select a date..." data-orientation="top">
                    
                      <i class="icon-calendar"></i>
                    </div>
                          
                      </div>
                    <div class="col-md-1 m-t-10">
                         <button type="button" class="btn btn-primary add-date-extension">Submit</button>  
                    </div>
                 </div>
                        </div>
                </div>
                
        
                     
                     </div>

                     </div>
                  
                  <br/>
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed" id="room-register-close" data-dismiss="modal" value="">CLOSE</button>
                     <button type="button" class="btn btn-white btn-embossed" data-toggle="modal" data-target="#modal-guest"><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-success btn-embossed guest-register-edit-save" id="" value=""> SAVE</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>
        
    
   <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-add-guest" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  
                  <h4 class="modal-title"><strong>ADD GUEST</strong> </h4>
                 
                </div>
                 
                <div class="modal-body" id="add-guest-modal">
                        <div class="panel">
                        
                            <div class="row">
            <div class="col-lg-12 portlets">

                          <div class="panel">
                <div class="panel-header">
                  <h2><strong>Guest Listing</strong></h2>
                  
                </div>
                 
                   <div class="panel-content" style="min-height:500px;">       
                <div class="row">
              <div class="col-md-6">                 
                  
                  <div class="panel-content">
                        <ul  class="nav nav-tabs nav-tabs2">
                          
                          <li class="active"><a href="#tab3_1" data-toggle="tab"><i class="icon-home"></i> Retrieve Guest</a></li>
                          <li><a href="#tab3_2" data-toggle="tab"><i class="icon-home"></i> New Guest</a></li>
                        </ul>
                        <div class="tab-content">
                         
                          <div class="tab-pane fade active in" id="tab3_1">
                            <table id="guestsRecord-table" width="100%" class="table table-striped">
                    <thead>
                      <tr>
                
                <th>Name</th>
                <th>Contact No</th>
                <th>Action</th>
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#guestsRecord-table').DataTable({
        processing: true,
        serverSide: false,
       "scrollY":        "200px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        
        ajax: '{!! route('frontdesk.dataTablesGuestList') !!}',
        columns: [
            { data: 'name', name: 'name' },
            { data: 'contactNo' , name: 'contactNo' },
            
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                    var valueHere=data.id+'#'+data.name+'#'+data.firstname+'#'+data.lastname+'#'+data.contactNo;
                    return '<button type="button" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" value="'+valueHere+'">Add</button>';
              }
          }
        ]
    });



});


</script>


@endpush
            
                    </tbody>
                  </table>
                          </div>
                          <div class="tab-pane fade" id="tab3_2">
                             <div class="row">
                <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>First Name</label>
                          <input type="text" id="newFirstname" name="newFirstname" class="form-control" minlength="3" placeholder="Enter firstname...">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" id="newFamilyName" name="newFamilyName" class="form-control" minlength="3" placeholder="Enter first name...">
                        </div>
                      </div>
                    </div>
                    <div class="row m-t-10">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Contact</label>
                          <input type="text" id="newContact" name="newContact" class="form-control" minlength="3" placeholder="Enter address...">
                        </div>
                      </div>
                  
                    </div>
                    <div class="row">
                          <div class="col-sm-6">
                           
                            </div>
                          <div class="col-sm-6">
                            
                                <div class="row">
                                    
                                    <div class="col-sm-6">
                                        <a id="addGuestToList" class="btn btn-transparent btn-primary">Add Guest</a>
                                    </div> 
                                </div>
                          </div>
                     
                        </div>
                    
               
                </div>
              </div>
                          </div>
                          
                        </div>
                      </div>
              </div>
  {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@addGuestSave']) !!}
              <div class="col-md-6">                 
                  <h4><strong>Added Guest List</strong></h4>
                  <table id="guestsList-table" class="table table-striped">
                    <thead>
                      <tr>
                <th></th>
                <th>Name</th>
                <th>Contact No</th>
                <th></th>
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
var tempGuestList;

$(function() {
    tempGuestList = $('#guestsList-table').DataTable({
        processing: true,
        serverSide: false,
        columns: [
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                    var valueHere=data.id+'#'+data.name+'#'+data.firstname+'#'+data.lastname+'#'+data.contactNo;
                   return '<input type="checkbox" id="guestNamesListed" name="guestNamesListed[]" value="'+valueHere+'" checked onclick="return false;">';
            }},
            { data: 'name'},
            { data: 'contactNo'},
            {"render": function(data, type, full, meta){
                    
                    return '<button type="button" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal">Remove</button>';
              }
            }
        ]

    });

    

});

   

  
</script>


@endpush
            
                    </tbody>
                  </table>
              </div>

                </div>
                </div>

                          





                      </div>
                   
                  </div>
                  </div>
               
          

                      </div>
              
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed" id="room-register-close" data-dismiss="modal" value="">CLOSE</button>
                     <button type="button" class="btn btn-white btn-embossed" data-toggle="modal" data-target="#modal-guest"><i class="fa fa-print"></i> PRINT</button>
                    <input type="hidden" name="transID" class="add-guest-save"/>
                  <button type="submit" class="btn btn-success btn-embossed" id="" value=""> SAVE</button>
                    </form>
                </div>
              
            </div>
          </div>
            
        </div>  
            
      
          
            <!--- GUEST REGISTRATION MODAL BEGINS -->    
       
        <!-- END PAGE CONTENT -->
      </div>

<div class="modal fade" id="modal-remove-guest" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-red">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Remove</strong> Guest</h4>
                </div>
                <div class="modal-body">
                  <h3>Are you sure you want to remove <strong><span id="guestreserv-name"></span></strong> from list?</h3>
                    <br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Exit</button>
                  <button type="button" class="btn btn-danger btn-embossed" data-dismiss="modal" id="confirm-remove">Yes</button>
                </div>
              </div>
            </div>
          </div>

       <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-room-bill" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-blue">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><strong>ROOM: <span id="room-bill-title-name"></span> - <span id="room-bill-title-type"></span></strong></h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>ROOM BILL: <span id="room-bill-title2-name"></span> - <span id="room-bill-title2-type"></span></strong></h2><hr/>
                    </div>
                 
               
                    <div class="row">
                        <div class="col-md-6">
                           
                            
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Date: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong>{{date('F j, Y')}}</strong></p>
                                    </div>
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Reservation ID:</p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-bill-modal-reservID"></span></strong></p>
                                    </div>
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Guest Name/s: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-bill-modal-guests"></span>
                                          </strong></p>
                                    </div>
                                    
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Charge to: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-bill-modal-institution"></span></strong></p>
                                    </div>
                                    
                              
                          
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Room rate: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong>&#8369; <span id="room-bill-modal-rate"></span></strong></p>
                            </div>
                            <div class="row">
                                    <p class="col-md-6 f-12 m-t-0 m-b-0">Room Type: </p>
                                    <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-bill-modal-roomType"</strong></p>
                            </div>
                            <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Arrival date: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-bill-modal-arrival"></span></strong></p>
                            </div>
                            <div class="row">
                                    <p class="col-md-6 f-12 m-t-0 m-b-0">Departure date: </p>
                                    <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-bill-modal-depart"</strong></p>
                            </div>
                         
                            </div>
                       
                        </div>
                    </div>
                    
                  
                    <div class="p-20">
                 <div class="row">
                <div class="col-md-12">
                
                  <table id="room-bill-charges-table" class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width:65px" class="unseen text-center">Date</th>
                        <th class="text-left" style="width:65px">OS/OR No.</th>
                        <th>Reference/Particulars</th>
                           <th style="width:95px">Amount</th>
                          <th style="width:95px">Payments</th>
                         
                        <th style="width:95px">Balance</th>
                      </tr>
                    </thead>
                    <tbody id="room-tbody">                    
                    </tbody>
                  </table>
                    
                  <div class="well bg-white">
                    I agree that my liability for this bill is not waived and that I will be personally liable in the even that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct. 
                  </div>
                </div>
              </div>
           
            
                </div>
                <div class="modal-footer bg-dark">
                  <button type="button" id="room-bill-close" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     <a id="room-bill-print" type="button" class="btn btn-white btn-embossed"><i class="fa fa-print"></i> PRINT</a>
                
                </div>
              </div>
            </div>
      
            
        </div>


    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-guest-folio" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-green">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>GUEST FOLIO:</strong> <span id="folio-title-name"></span></h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>GUEST FOLIO</strong></h2><hr/>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="f-10 m-t-0 m-b-0">GUEST REGISTRATION NO: <strong><span id="folio-gRegId"></span></strong></p>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                             <p class="f-10 m-b-0">RESERVATION ID: <strong><span id="folio-reservId"></span></strong></p>
                           
                            <p class="f-10 m-t-0">DATE: <strong>{{date("F j, Y")}}</strong></p>
                            </div>
                       
                        </div>
                    </div>
                    
                    
                 
                    <div class="panel panel-transparent p-5 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                            
                        <div class="row">
                    <div class="col-md-3 border-right">                   
                            <h4 class="f-12 m-t-0">Name: <br class="m-b-5"/><strong class="f-16"><span id="folio-name"></span></strong></h4>        
                    </div>
                    <div class="col-md-3 border-right">                   
                            <h4 class="f-12 m-t-0">Institution: <br class="m-b-5"/><strong class="f-16"><span id="folio-institution"></span></strong></h4>        
                    </div>
                            <div class="col-md-3 border-right">
                   <h4 class="f-12 m-t-0" align="center">Arrival Date: <br class="m-b-5"/><strong><span id="folio-arrival"></span></strong></h4>    
                    </div>
                            <div class="col-md-3 border-right">
                    <h4 class="f-12 m-t-0" align="center">Departure Date: <br class="m-b-5"/><strong><span id="folio-depature"></span></strong></h4>    
                    </div>
                                </div>
                            
                            <div class="row">
                    <div class="col-md-3 border-right">                   
                            <h4 class="f-12 m-t-0">Address: <br class="m-b-5"/><strong><span id="folio-address"></span></strong></h4>        
                    </div>
                    <div class="col-md-3 border-right">                   
                            <h4 class="f-12 m-t-0">Contact No: <br class="m-b-5"/><strong><span id="folio-mobile"></span></strong></h4>        
                    </div>
                            <div class="col-md-3 border-right">
                   <h4 class="f-12 m-t-0" align="center">Billing Arrangement: <br class="m-b-5"/><strong></strong></h4>    
                    </div>
                            <div class="col-md-3 border-right">
                    <h4 class="f-12 m-t-0" align="center">Remarks: <br class="m-b-5"/><strong><span id="folio-guestremarks"></span></strong></h4>    
                    </div>
                                </div>
                            
                            <div class="row">
                    <div class="col-md-3 border-right border-top">                   
                            <h4 class="f-12 m-t-5  m-b-0" align="center">Room Rate: <br class="m-b-5"/><strong>&#8369; <span id="folio-rate"</strong></h4>        
                    </div>
                            <div class="col-md-3 border-right border-top">
                   <h4 class="f-12 m-t-0" align="center">Room Type: <br class="m-b-5"/><strong><span id="folio-room-type"></span></strong></h4>       
                    </div>
                                  <div class="col-md-3 border-right border-top">
                  <h4 class="f-12 m-t-0" align="center">Room No.: <br class="m-b-5"/><strong><span id="folio-room-name"></span></strong></h4>  
                    </div>
                            <div class="col-md-3 border-right border-top">
                    <h4 class="f-12 m-t-5  m-b-0" align="center">No. of Guest: <br class="m-b-5"/><strong>1 of 2</strong></h4>    
                    </div>
                                </div>
                            
                        </div>
                    </div>
         
                  
                    <div class="p-20">
                 <div class="row">
                <div class="col-md-12">
                
                  <table id="charges-table" class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width:65px" class="unseen text-center">Date</th>
                        <th class="text-left">Reference/Particulars</th>
                        <th style="width:145px" align="center">Debit</th>
                        <th style="width:95px" align="center">Credit</th>
                        <th style="width:95px">Amount</th>
                      </tr>
                    </thead>
                    <tbody>                    
                    </tbody>
                  </table>
                  <div class="well bg-white">
                    I agree that my liability for this bill is not waived and that I will be personally liable in the even that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct. 
                  </div>
                </div>
              </div>
           
            
                </div>
                <div class="modal-footer bg-dark">
                  <button type="button" id="folio-close" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     <a type="button" id="folio-print" class="btn btn-white btn-embossed" data-dismiss=""><i class="fa fa-print"></i> PRINT</a>
               
                </div>
              </div>
            </div>
          </div>
            
        </div>


    <div class="modal fade" id="modal-reservation-detail"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Reservation</strong> Info</h4>
                 
                </div>
                <div id="print-reservation-details" class="modal-body">
                    <div class="row">
                        
                        <div class="col-md-6">
                           
                             <h3 class="m-b-0">RESERVATION ID: <strong><span id="res-reservId"></span></strong></h3>
                            <p class="f-10 m-t-0">DATE: <strong>{{date('F j, Y')}}</strong></p>
                          
                       
                        </div>
                    </div>
                    
                    
                 
                    <div class="panel panel-transparent bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        
                        <h3 class="m-l-20"><strong>BOOKING PERSON/INSTITUTION DETAILS:</strong></h3>
                        <hr class="m-b-10"/>
                        <div class="panel-content p-l-20 p-r-20">
                <div class="row">
                    
                    <div class="col-md-4">
                        <p class="f-12">Booking Person: <strong><span id="res-booking-person"></span></strong></p>
                    </div>
                    <div class="col-md-4">
                        <p class="f-12">Contact: <strong><span id="res-bookingP-contact"></span></strong></p>
                    </div>
                     <div class="col-md-4">
                        <p class="f-12">Title/Designation: <strong><span id="res-bookingP-title"></span></strong></p>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-4">
                    <p class="f-12">Company/Institution: <strong><span id="res-institution"></span></strong></p>
                    </div>  
                    <div class="col-md-4">
                       
                    <p class="f-12">Account Type: <strong><span id="res-insti-type"></span></strong></p>
            
                    </div>
                    <div class="col-md-4">
                    <p class="f-12">Address: <strong><span id="res-insti-address"></span></strong></p>
                    </div> 
                </div>
                    </div>
                    </div>
                        
                  <div class="panel panel-transparent bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                       
                        <h3 class="m-l-20"><strong>RESERVATION DETAILS:</strong></h3>
                        <hr class="m-b-10"/>
                        <div class="panel-content p-l-20 p-r-20"> 
                        <div class="row">
                            <div class="col-md-3">
                                <p class="f-12">Arrival: <strong><span id="res-arrival"></span></strong></p>
                            </div>  
                            <div class="col-md-3">
                                <p class="f-12">Departure: <strong><span id="res-depart"></span></strong></p>
                            </div>
                            <div class="col-md-3">
                                <p class="f-12">Check In Time: <strong><span id="res-checkin"></span></strong></p>
                            </div>  
                            <div class="col-md-3">
                                <p class="f-12">Check Out Time: <strong><span id="res-checkout"></span></strong></p>   
                            </div> 
                    </div>
                    <div class="row">
                            <div class="col-md-3">
                                <p class="f-12">Made Thru: <strong><span id="res-madethru"></span></strong></p>
                            </div>  
                            <div class="col-md-3">
                                 <p class="f-12">Applicable Discount: <strong><span id="res-discount"></span></strong></p>
                            </div>
                            <div class="col-md-3">
                                <p class="f-12">Guaranteed: <strong><span id="res-guaranteed"></span></strong></p>
                            </div>  
                            <div class="col-md-3">
                                <p class="f-12">Billing Arrangement: <strong><span id="res-billArrange"></span></strong></p>  
                            </div> 
                    </div>
                     </div>
                      
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-transparent bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                            <div class="panel-content p-l-10 p-r-10">
                                 <h3 class="m-t-10"><strong>ROOM DETAILS</strong></h3><hr class="m-t-5"/>
                            <table id="res-room-details" class="table table-bordered">
                                <thead class="f-12">
                                    <tr>
                                        <th>ROOM NO.</th>
                                        <th>ROOM TYPE</th>
                                        <th>ROOM RATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>    
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-transparent bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                            <div class="panel-content p-l-10 p-r-10">
                                 <h3 class="m-t-10"><strong>GUEST DETAILS</strong></h3><hr class="m-t-5"/>
                            <table id="res-guest-details" class="table table-bordered">
                                <thead class="f-12">
                                    <tr>
                                        <th>ACC. NO.</th>
                                        <th>NAME</th>
                                        <th>CONTACT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>    
                            </div>
                        </div>
                        </div>
                   
                    </div>
                   
                    <hr/>
                <div class="row">
                    <div class="col-md-6">
                        <h4><strong>Guarantee Reservation</strong></h4><br/>
                
                <div class="row m-l-10">
                    <div class="col-md-4">
                        <p id="guaranteed-status" class="f-14 c-red" style="display:none;"><strong>Reservation Guaranteed</strong></p>
                    </div>    
                </div>
                <div class="row m-l-10">
                    <div class="col-md-8">
                        <div class="form-group">
                              <label>Enter Downpayment</label>
                              
                                <input type="text" name="downpayment" id="downpayment" class="form-control" placeholder="Enter Downpayment..." autocomplete="off">
                               
                            </div>
                    </div>    
                </div>
                <div class="row m-l-10">
                  
                    <div class="col-md-4">
                        <button type="button" id="guarantee-down" class="btn btn-primary btn-transparent" data-dismiss="modal">Add Downpayment</button>
                    </div>
                </div>
                    </div>
                    <div class="col-md-6">
                        <h4><strong>Room Cancellation</strong></h4><br/>
                        <button id="no-show" type="button" class="btn btn-hg btn-dark">No Show</button>
                        <div class="row m-l-10">
                    <div class="col-md-4">
                        <p id="no-show-status" class="f-14 c-red" style="display:none;"><strong>Reservation Status: No Show</strong></p>
                    </div>    
                </div>
                    </div>
                </div>
                    
                    
                    
                </div>
                <div class="modal-footer bg-dark">
                  <button type="button" id="res-close" class="btn btn-white btn-embossed" data-dismiss="modal">Close</button>
                  <a type="button" class="btn btn-primary btn-embossed"><i class="fa fa-print"></i> Print</a>
                      <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
                </div>
              </div>
            </div>
         

      </div>

      <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-bill-statement" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-blue">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><strong>BILLING STATEMENT</strong></h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>BILLING STATEMENT</strong></h2><hr/>
                    </div>
                 
               
                    <div class="row">
                        <div class="col-md-6">
                           
                            
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Date: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong>{{date('F j, Y')}}</strong></p>
                                    </div>
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Reservation ID:</p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="bill-modal-reservID"></span></strong></p>
                                    </div>
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Guest Name/s: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="bill-modal-guests"></span>
                                          </strong></p>
                                    </div>
                                    
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Charge to: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="bill-modal-institution"></span></strong></p>
                                    </div>
                                    
                              
                          
                        </div>
                        <div class="col-md-6">
                       
                            <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Arrival date: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="bill-modal-arrival"></span></strong></p>
                            </div>
                            <div class="row">
                                    <p class="col-md-6 f-12 m-t-0 m-b-0">Departure date: </p>
                                    <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="bill-modal-depart"></span></strong></p>
                            </div>
                            <div class="row">
                                    <p class="col-md-6 f-12 m-t-0 m-b-0">Remarks: </p>
                                    <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="bill-modal-remarks"></span></strong></p>
                            </div>
                         
                            </div>
                       
                        </div>
                    </div>
                    
                  
                    <div class="p-20">
                 <div class="row">
                <div class="col-md-12">
                
                  <table id="bill-charges-table" class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width:65px" class="unseen text-center">Date</th>
                        <th class="text-left" style="width:65px">OS/OR No.</th>
                        <th>Reference/Particulars</th>
                           <th style="width:95px">Amount</th>
                          <th style="width:95px">Payments</th>
                         
                        <th style="width:95px">Balance</th>
                      </tr>
                    </thead>
                    <tbody id="room-tbody">                    
                    </tbody>
                  </table>
                    
                  <div class="well bg-white">
                    I agree that my liability for this bill is not waived and that I will be personally liable in the even that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct. 
                  </div>
                </div>
              </div>
           
            
                </div>
                <div class="modal-footer bg-dark">
                    {!! Form::open(['method'=>'PUT','action'=>'FrontDeskController@billOut']) !!}
                                <input type="hidden" value="" id="totalBill" name="totalBill"/>
                                <input type="hidden" value="{{$code}}" name="reservID"/>
                              
                               
                    <button type="submit" id="bill-out" class="btn btn-danger btn-embossed" style="float:right">Bill Out</button> 
                     {!! Form::close() !!}
                  <button type="button" id="bill-close" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     <a type="button" href="{{route('frontdesk.printPreviewBillstatement',['id'=>$transactionId])}}" class="btn btn-white btn-embossed"><i class="fa fa-print"></i> PRINT</a>
                  
                </div>
              </div>
            </div>
            
        </div>

         <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-manage-downpayment" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-blue">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><strong>Manage Downpayments</strong></h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>DOWNPAYMENTS</strong></h2><hr/>
                    </div>
                    <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Room No.</th>
                        <th>Room Type</th>
                        <th>Room Rate</th>
                        <th>Discount</th>
                        <th>Total Rate</th>
                      </tr>
                    </thead>
                    <tbody>

                    @if($rooms)
                        @foreach($rooms as $r)
                        <tr>
                          <td>{{$r->roomName}}</td>
                          <td>{{$r->roomType}}</td>
                          <td>{{number_format($r->roomRate,2)}}</td>
                          @if($r->discountType == 1)
                          <td>{{$r->discountName.' ('.$r->discountValue*100}}%)</td>
                          @elseif($r->discountType == 2)
                          <td>{{$r->discountName.' (Less '.$r->discountValue.')'}}</td>
                          @endif
                          
                          @if($r->discountType == 1)
                          <td>{{number_format($r->roomRate-($r->roomRate*$r->discountValue),2)}}</td>
                          @elseif($r->discountType == 2)
                          <td>{{number_format($r->roomRate-$r->discountValue,2)}}</td>
                          @endif

                        </tr>
                        @endforeach
                    @endif
                    </tbody>
               </table>
                </div>
                    
                  
           
                <div class="modal-footer bg-dark">
              
                  <button type="button" id="bill-close" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     
                  
                </div>
              </div>
            </div>
            
        </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
<script src="{{url('assets/jquery/jquery-1.12.4.js')}}"></script>
<script src="{{url('assets/jquery/jquery-ui-1.12.1/jquery-ui.js')}}"></script>

<script type="text/javascript">
    
    //GET ROOM DETAILS
    $(document).ready(function(){
        $("#view-transaction").click(function(){
            
        });
        
    });
    //END GET ROOM DETAILS
    
    //EDIT GUEST ACCOUNT DETAILS
    $(document).ready(function(){
        
      $("#room-register-close").click(function(){
            $("#reserved-guest").empty();
        });
        
    });
    //END EDIT GUEST ACCOUNT DETAILS
    
    
    //GUEST ACCOUNT DETAILS CLOSE
    $(document).ready(function(){
        $(".guest-edit-close").click(function(){
           
        });
    });
    //END GUEST ACCOUNT DETAILS CLOSE
    
    //SAVE GUEST ACCOUNT DETAILS
    $(document).ready(function(){
        
        
        $(".guest-edit-save").click(function(){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

            var transactionID = $("#transID").val();
            
            var guestID = $(this).val();
            
            var guestDetails = {
                  firstName:  $("#guest-fname").val(),
                  middleName: $("#guest-mname").val(),
                  familyName: $("#guest-lname").val(),
                  room: $("#guest-room").val(),
                  guestReserv: $("#guestReservID").val(),
                  houseNo:    $("#guest-housebldg").val(),
                  brgy:    $("#guest-brgy").val(),
                  city:  $("#guest-city").val(),
                  country:    $("#guest-country").val(),
                  postalCode:  $("#guest-postalcode").val(),
                  nationality:  $("#guest-nationality").val(),
                  contactNo:  $("#guest-contactNo").val(),
                  email:  $("#guest-email").val(),
                  dob:  $("#guest-dob").val(),
                  designation:  $("#guest-designation").val(),
                  passNo:  $("#guest-passno").val(),
                  passExpiry:  $("#guest-passexp").val(),
                  passIssue: $("#guest-passissue").val(),
                  otherId:    $("#guest-otherid").val(),
                  id:  guestID,
                
            };
        
    
               $.ajax({
                   type:"PUT",
                   url: "../frontdesk/guest-update/"+guestID,
                   data: guestDetails,
                   
                   success: function (data){
                       console.log(data);
                        $("#guest-modal-body").fadeOut(300, function(){
                            $("#guest-modal-body").fadeIn().delay(2000);

                        });
                    $("#guest-fname").val(data.firstName);
                    $("#guest-mname").val(data.middleName);
                    $("#guest-lname").val(data.familyName);
                    $("#guest-housebldg").val(data.houseNo);
                    $("#guest-brgy").val(data.brgy);
                    $("#guest-city").val(data.city);
                    $("#guest-country").val(data.country);
                    $("#guest-postalcode").val(data.postalCode);
                    $("#guest-nationality").val(data.nationality);
                    $("#guest-contactNo").val(data.contactNo);
                    $("#guest-email").val(data.email);
                    $("#guest-dob").val(data.dob);
                    $("#guest-designation").val(data.designation);
                    $("#guest-passno").val(data.passNo);
                    $("#guest-passexp").val(data.passExpiry);
                    $("#guest-passissue").val(data.passIssue);
                    $("#guest-otherid").val(data.otherId);
                    $("#account-id").html(data.account_id);
                    $(".guest-edit-save").val(data.id);
                    
                       
                     
        
                   }
                   
                          
               });
      
               
             $('#guests-table').DataTable({
        processing: true,
        serverSide: false,
       "scrollY":        "200px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
            "bDestroy": true,
        ajax: "../frontdesk/datatables-guest-reservation-list/"+transactionID,
        columns: [
           
            { data: 'name', name: 'name' },
            { data: 'account_id', name: 'account_id' },
            { data: 'roomName', name: 'roomName' },
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                  var valueHere=data.id;
                   return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-guest-edit" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button data-toggle="modal" data-target="#modal-guest-folio" class="btn btn-sm btn-blue folio-modal" data-id="3" value="'+valueHere+'">View Folio</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-guest" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li></ul>';
            }
        }
        ]
    });
        });
        
        
    });
    
    //END SAVE GUEST ACCOUNT DETAILS
    
    
    //REGISTER GUEST MODAL
     $(document).ready(function(){
        
        
        $(".edit-modal-register").click(function(){
            var guestReservID = $(this).val();
        
                $.get("../frontdesk/guest-register-edit/"+guestReservID,function(data){
                    console.log(data);
                    
                    
                    $("#register-title-name").html(data.firstname+" "+data.lastname);
                    
                    if(data.account_id == ""){
                       $("#guest-register-info").attr('style','opacity:0.35;');
                        $("#register-header").append("<h2><strong>*NEW GUEST! Please edit guest information before room registration.</strong></h2>");
                        $(".guest-register-edit-save").attr('disabled',true);
                    }
                    else{
                        $(".guest-register-edit-save").attr('disabled',false);
                        
                        if(data.billingType==1)
                            $("#guestBill").html("Charge to company");
                        else if(data.billingType==2)
                            $("#guestBill").html("Guest Account");
                    
                        if(data.chargeType==1)
                            $("#guestCharge").html("Cash");
                        else if(data.chargeType==2)
                            $("#guestCharge").html("Credit");
                  
                        $(".guest-register-edit-save").val(data.grId);
                        $(".guest-register-edit-close").val(data.grId);   
                    }
                    
               //     $("#foo").append("<div>hello world</div>")
                    
                    
                                     
                });
        });
        
    });
    //END REGISTER GUEST MODAL
    
    $(document).ready(function(){
       $("#confirm-remove").click(function(){
           var guestReservID = $(this).val();
           
           $.get("../frontdesk/confirm-remove-guest/"+guestReservID,function(data){
                console.log(data);                   
            });
           
           var transactionID = $("#transID").val();
           
             $('#guests-table').DataTable({
        processing: true,
        serverSide: false,
       "scrollY":        "200px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
            "bDestroy": true,
        ajax: "../frontdesk/datatables-guest-reservation-list/"+transactionID,
        columns: [
           
            { data: 'name', name: 'name' },
            { data: 'account_id', name: 'account_id' },
            { data: 'roomName', name: 'roomName' },
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                  var valueHere=data.id;
                   return '<button type="button" data-id="1" data-toggle="modal" data-target="#modal-guest-edit" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-guest" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button>';
            }
        }
        ]
    });
       }); 
    });
    
    
    
    $(document).ready(function(){
        $(".guest-register-edit-close").click(function(){
            location.reload();
        });
        
    });

    $(document).ready(function(){
      $(".add-date-extension").click(function(e){
         $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
           }
       });

          var dateExtend = $("#ext-date").val();
          var roomReserve = $(this).val();

           var extendStay = { 
                 dateExtend: dateExtend,
                 roomReserve: roomReserve,
                 
           };
       
                  $.ajax({
                   type:"PUT",
                   url: "{{route('frontdesk.extendStay')}}",
                   data: extendStay,
                   
                   success: function (data){
               
                       console.log(data);
                       var dep = new Date(data["depatureDate"]);
                    var depdate = dep.getDate();
                    var depmonth = dep.getMonth() + 1; //Months are zero based
                    var depyear = dep.getFullYear();

                         $("#room-register-ext").html(depmonth+"/"+depdate+"/"+depyear);

                   }
                   
                          
               });
    
      });
});
    
    $(document).ready(function(){
        $("#add-guest").click(function(){
            setTimeout(
            function() {
                
            },
            5000);
            $(".add-guest-save").val($("#transID").val());
        });
        
        
    });
    
    
//    $(document).ready(function(){
//       $("#add-guest-save").click(function(){
//            $.ajaxSetup({
//            headers: {
//                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//            }
//        });
//
//            var transactionID = $(this).val();
//            var guest = [];
//            
//            var guestDetails = { 
//                  transId:  transactionID,
//                  guestNames: $("input[name=guestNamesListed]").val(),
//                
//            };
//        
//    
//               $.ajax({
//                   type:"POST",
//                   url: "../frontdesk/add-guest-save/"+transactionID,
//                   data: guestDetails,
//                   
//                   success: function (data){
//                       console.log(data);
//                        $("#add-guest-modal").fadeOut(300, function(){
//                           alert('success');
//                            console.log(data);
//                        });
//                                     
//                   }
//                   
//                          
//               });
//            
//             $('#guests-table').DataTable({
//        processing: true,
//        serverSide: false,
//       "scrollY":        "200px",
//        "scrollCollapse": true,
//        "ordering": false,
//           "bLengthChange": false,
//            "bDestroy": true,
//        ajax: "../frontdesk/datatables-guest-reservation-list/"+transactionID,
//        columns: [
//           
//            { data: 'name', name: 'name' },
//            { data: 'account_id', name: 'account_id' },
//            { data: 'roomName', name: 'roomName' },
//            {
//            "className":      'options',
//            "data":           null,
//            "render": function(data, type, full, meta){
//                  var valueHere=data.id;
//                   return '<button type="button" data-id="1" data-toggle="modal" data-target="#modal-guest-edit" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button><button type="button" data-id="2" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button>';
//            }
//        }
//        ]
//    });
//      
//       }); 
//    });
     
    $(document).ready(function(){
        
    
        $("#assign-room-save").click(function(){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

            var transactionID = $("#transID").val(); 
            var guestReservID = $(this).val();
            
            var guestDetails = {
                  room: $('input[name=roomselect]:checked').val(),
                  id:  guestReservID,
                
            };
        
    
               $.ajax({
                   type:"PUT",
                   url: "../frontdesk/guest-register-update/"+guestReservID,
                   data: guestDetails,
                   
                   success: function (data){
                       console.log(data);
                        $("#guest-modal-body-register").fadeOut(300, function(){
                            $("#guest-modal-body-register").fadeIn().delay(3000);
                            $("#guestReservationId").html(data.guestReservID);
                            
                            $("#assigned-room").html(data.room);
                        });

                        location.reload();
                                     
                   }
                   
                          
               });
            
             $('#guests-table').DataTable({
                  processing: true,
                  serverSide: false,
                  "scrollY":        "200px",
                  "scrollCollapse": true,
                  "ordering": false,
                  "bLengthChange": false,
                  "bDestroy": true,
                  ajax: "../frontdesk/datatables-guest-reservation-list/"+transactionID,
                  columns: [
                     
                      { data: 'name', name: 'name' },
                      { data: 'account_id', name: 'account_id' },
                      { data: 'roomName', name: 'roomName' },
                      {
                      "className":      'options',
                      "data":           null,
                      "render": function(data, type, full, meta){
                            var valueHere=data.id;
                             return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-guest-edit" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button data-toggle="modal" data-target="#modal-guest-folio" class="btn btn-sm btn-blue folio-modal" data-id="3" value="'+valueHere+'">View Folio</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-guest" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li></ul>';
                      }
                  }
                  ]
              });
      
                
        });
        
        
    });
    
     $(document).ready(function(){
        $('#special-request-save').click(function(e){
            var id = $(this).attr('value');


            var specialRequestInfo = {
                roomRequest:$('select[name="roomRequest"]').val(),
                durationRequest:$('#durationRequest').val(),
                dateRequest:$('#dateRequest').val(),
                timeRequest:$('#timeRequest').val(),
                noteRequest:$('#noteRequest').val(),
                id: id
            };

                
              
              $.ajax({
                   type:"POST",
                   url: "{{route('frontdesk.saveSpecialRequest')}}",
                   data: specialRequestInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                    alert(datas);

                   }
               });
        });
        

        $("#add-special-request").click(function(e){
            $('#roomRequest').find('option').remove().end().append('<option value="0">All Room Reserved</option>').val(0).change();
            $('#durationRequest').val(0).change();
            $('#dateRequest').val('');
            $('#timeRequest').val('');
            $('textarea#noteRequest').val('');
            

            var id = $(this).attr('value');

            $('#special-request-save').val(id);

            var trasactionInfo = {
                'id':id,
            };

                
              
              $.ajax({
                   type:"POST",
                   url: "{{route('frontdesk.retrieveRoomTransaction')}}",
                   data: trasactionInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                      $.each(datas, function (i, item) {
                          $('#roomRequest').append($('<option>', { 
                              value: item.id,
                              text : item.name 
                          }));
                      });

                   }
               });

        });
        $(".check-in-guest").click(function(e){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

            var transactionID = $("#transID").val(); 
            var roomReserveID = $(this).val();
            
            var roomReserve = {
              
                  roomReserveId:  roomReserveID,
                
            };
        
    
               $.ajax({
                   type:"PUT",
                   url: "{{route('frontdesk.checkInGuest')}}",
                   data: roomReserve,
                   
                   success: function (data){
                       console.log(data);
                        $("#room-modal-register").fadeOut(300, function(){
                           $("#room-status-checkin").html("Checked In");
                        $("#room-status-checkin").attr("class","label label-danger");
                            $("#room-modal-register").fadeIn().delay(300);
                           
                        });
                   }
               });
      
            $('#rooms-table').DataTable({
                processing: true,
                serverSide: false,
               "scrollY":        "200px",
                "scrollCollapse": true,
                "ordering": false,
                   "bLengthChange": false,
                "bDestroy": true,
                ajax: "../frontdesk/datatables-room-reservation-list/"+transactionID,
                columns: [
                   
                    { data: 'roomName', name: 'roomName' },
                    { data: 'roomType', name: 'roomType' },
                    {data: null,
                     "className": 'options',
                     "render": function(data,type,full,meta){
                         var status = data.occupied_status;
                         
                         if(status==1)
                            return '<span class="label label-danger">Checked In</span>';
                         else
                             return '<span class="label label-warning">Not Checked In</span>';
                     }
                    },
                    {
                    "className":      'options',
                    "data":           null,
                    "render": function(data, type, full, meta){
                          var valueHere=data.id;
                          return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-room-register" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button data-toggle="modal" data-target="#modal-room-bill" class="btn btn-sm btn-blue room-bill-view" data-id="3" value="'+valueHere+'">View Bill</button></li><li><button type="button" data-id="2" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li></ul>';
                    }
                }
                ]
            });     
        });
        
        
    });
    
    $('#guestsRecord-table tbody').on( 'click', 'button', function () {        
            var guestReservID = this.value;
            var infoGuest = guestReservID.split('#');
            tempGuestList.row.add( {
                "id":   infoGuest[0], 
                "name":       infoGuest[1],
                "firstname":  infoGuest[2],
                "lastname":  infoGuest[3],
                "contactNo":   infoGuest[4],
            } ).draw();
    });



    $('#specialRequest-table tbody').on( 'click', 'button', function () {        
        var specialRequestId = this.value;

        var id = $(this).attr('value');


            var specialRequestInfo = {
                id: specialRequestId
            };

              var result = confirm("Want to delete?");
              if (result) {
                  $.ajax({
                   type:"POST",
                   url: "{{route('frontdesk.deleteSpecialRequestAjax')}}",
                   data: specialRequestInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                    var transactionID = $("#transID").val();
                    $('#specialRequest-table').DataTable({
                        processing: true,
                        serverSide: false,
                        "bDestroy": true,
                        ajax:"../frontdesk/datatables-special-request-list/"+transactionID,
                        columns: [
                          { data: 'requestDate' , name: 'requestDate' },
                            { data: 'requestTime' , name: 'requestTime' },
                            { data: 'roomName', name: 'roomName' },
                            
                            { data: 'note' , name: 'note' },
                            
                            {
                            "className":      'options',
                            "data":           null,
                            "render": function(data, type, full, meta){
                                    var valueHere=data.id+'#'+data.name+'#'+data.firstname+'#'+data.lastname+'#'+data.contactNo;
                                    return '<button type="button" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" value="'+valueHere+'">Delete</button>';
                              }
                          }
                        ]
                    });

                   }
               });
              }
              
              

          



    });

$('#guestsList-table tbody').on( 'click', 'tr', function () {
  
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            tempGuestList.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
        
    } );

 
    $('#guestsList-table tbody').on( 'click', 'button', function () {

      tempGuestList.row('.selected').remove().draw( false );
        
    } );

    $("#addGuestToList").click(function(){
        var newfirstname = $("#newFirstname").val();
        var newlastname = $("#newFamilyName").val();
        var newcontact = $("#newContact").val();



        var newfullname = newfirstname+" "+newlastname;

        tempGuestList.row.add( {
                "id":   0, 
                "name":       newfullname,
                "firstname":  newfirstname,
                "lastname":  newlastname,
                "contactNo":   newcontact,
            } ).draw();
        $("#newFirstname").val('');
        $("#newFamilyName").val('');
        $("#newContact").val('');

    });

   $(document).ready(function(){
        $("#room-bill-close").click(function(){
       
                    $('#room-bill-charges-table > tbody:last-child').empty();
                    
        });
    });
  
     $(document).ready(function(){
        $("#folio-close").click(function(){
       
                    $('#charges-table > tbody:last-child').empty();
                    
        });
    });



     $(document).ready(function(){
        $(".bill-statement").click(function(){
            var transID = $(this).val();
        
                $.get("../frontdesk/bill-statement-view/"+transID,function(data){
                    console.log(data);
                    
           //         for(var i=0; i<data.length;i++)

                $("#bill-modal-reservID").html(data.guest[0]["code"]);
                    var roomRate = numeral(data.guest[0]["rate"]).format('0,0.00');
                    
                $("#bill-modal-rate").html(roomRate);
                $("#bill-modal-institution").html(data.guest[0]["instiName"]);
                $("#bill-modal-roomType").html(data.guest[0]["roomType"]);
               
                $("#bill-modal-depart").html(data.guest[0]["depatureDate"]);
                  
                 var arr = new Date(data.guest[0]["arrivalDate"]);
                    var arrdate = arr.getDate();
                    var arrmonth = arr.getMonth() + 1; 
                    var arryear = arr.getFullYear();
                    
                $("#bill-modal-arrival").html(arrmonth+"/"+arrdate+"/"+arryear);
                    
                    var dep = new Date(data.guest[0]["depatureDate"]);
                    var depdate = dep.getDate();
                    var depmonth = dep.getMonth() + 1; 
                    var depyear = dep.getFullYear();

                $("#bill-modal-depart").html(depmonth+"/"+depdate+"/"+depyear);
                
                var guestNames = "";
                    
                var account_ids = [];
                    
                for(var j=0;j<data.charges.length;j++){
                    
                    if(account_ids.indexOf(data.charges[j]["account_id"])== -1){
                        var firstName = data.charges[j]["firstName"]
                        guestNames+=firstName[0]+". "+data.charges[j]["familyName"];
                        
                       account_ids.push(data.charges[j]["account_id"]);
                        
                        if((j+2)!=data.charges.length)
                            guestNames+=", ";
                    }
                    
                        
                  
                }
                    
                $("#bill-modal-guests").html(guestNames);
                
                     var amountTotal = 0;
                    var paymentsTotal = 0;
                    var totalBalance = 0;
                    
                
                    var totalBalance = 0;
                    
                 
                    
                     var string = numeral(data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"])).format('0,0.00');
                    
                    var rateDiscount = string+" ("+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]*100+"%)";
                    
                    
                    
                      var roomRate = data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"]);
                   
                    
                    //Show Ammendments
                    
                    for(var k=0;k<data.guest.length;k++){
                        
                         var arr3 = new Date(data.guest[k]["arrivalDate"]);
                    var arrdate3 = arr3.getDate();
                    var arrmonth3 = arr3.getMonth() + 1; //Months are zero based
                    var arryear3 = arr3.getFullYear();
                        
                        var roomRate3 = data.guest[k]["rate"]-(data.guest[k]["rate"]*data.guest[k]["discountValue"]);
                        
                        var rateDiscount3 = numeral(data.guest[k]["rate"]-(data.guest[k]["rate"]*data.guest[k]["discountValue"])).format('0,0.00')+" ("+data.guest[k]['discountName']+" "+data.guest[k]["discountValue"]*100+"%)";
                        
                        
                        var totalRoomRate3 = roomRate3 * data.guest[k]["noOfDays"];
                        var stringTotalRoomRate3 = numeral(totalRoomRate3).format('0,0.00');
                    
                     $('#bill-charges-table > tbody:last-child').append('<tr><td>'+arrmonth3+"/"+arrdate3+"/"+arryear3+'</td><td></td><<td>ROOM: '+data.guest[k]["roomName"]+' - '+data.guest[k]["roomType"]+' ('+data.guest[k]["noOfDays"]+') days -- Rate:'+rateDiscount3+'</td><td class="text-right">&#8369; '+stringTotalRoomRate3+'</td><td class="text-right">&#8369; '+stringTotalRoomRate3+'<td class="text-right"></td></tr>');
                    
                        amountTotal+=totalRoomRate3;
                        paymentsTotal+=totalRoomRate3;
                    }
                
                    
                    
                    for(var i=0;i<data.amendments.length;i++){
 
                               var arr2 = new Date(data.amendments[i]["amendDate"]);
                    var arrdate2 = arr2.getDate();
                    var arrmonth2 = arr2.getMonth() + 1; //Months are zero based
                    var arryear2 = arr2.getFullYear();
                               
                                  var roomRate2 = data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"]);
                          var rateDiscount2 = numeral(data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"])).format('0,0.00')+" ("+data.amendments[i]['discountNameAmend']+" "+data.amendments[i]["discountValueAmend"]*100+"%)";
                            var totalRoomRate2 = roomRate2 * data.amendments[i]["amendDays"];
                            var stringTotalRoomRate2 = numeral(totalRoomRate2).format('0,0.00');

                            $('#bill-charges-table > tbody:last-child').append('<tr><td>'+arrmonth2+"/"+arrdate2+"/"+arryear2+'</td><td></td><<td>ROOM: '+data.amendments[i]["amendRoomName"]+' - '+data.amendments[i]["amendRoomType"]+' ('+data.amendments[i]["amendDays"]+') days -- Rate:'+rateDiscount2+'</td><td class="text-right">&#8369; '+stringTotalRoomRate2+'</td><td class="text-right">&#8369; '+stringTotalRoomRate2+'<td class="text-right"></td></tr>');
                        
                            amountTotal+=totalRoomRate2;
                            paymentsTotal+=totalRoomRate2;
            
                           }
      
                    
                    for(var i=0;i<data.charges.length;i++){

                        var cd = new Date(data.charges[i]["chargeCreated"]);

                        var chargeday = cd.getDate();
                        var chargemonth = cd.getMonth() + 1;
                        var chargeyear = cd.getFullYear();
        
                      
                        if(data.charges[i]["account_type"]==1){
                       
                            
                            var payment = 0;
                            var amount = data.charges[i]["price"];
                            var balance = amount - payment;
                            
                            totalBalance+=balance;
                            amountTotal+=amount;
                            paymentsTotal+=payment;
                            
                            
                            $('#bill-charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>'+data.charges[i]["os_id"]+'</td><td>'+data.charges[i]["item_name"]+'</td><td class="text-right">&#8369; '+numeral(amount).format('0,0.00')+'</td><td class="text-right"></td><td class="text-right">&#8369; '+numeral(balance).format('0,0.00')+'</td></tr>');
                            
                            
                           
                        }
                        
                        
                        if(data.charges[i]["account_type"]==2){
                            var payment = data.charges[i]["price"];
                            var amount = data.charges[i]["price"];
                            var balance = amount - payment;
                            totalBalance+=balance;
                            amountTotal+=amount;
                            paymentsTotal+=payment;
                            
                            $('#bill-charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>'+data.charges[i]["os_id"]+'</td><td>'+data.charges[i]["item_name"]+'</td><td class="text-right">&#8369; '+numeral(amount).format('0,0.00')+'</td><td class="text-right">&#8369; '+numeral(payment).format('0,0.00')+' </td><td class="text-right">&#8369; '+numeral(balance).format('0,0.00')+'</td></tr>');
                        }
             
                    }
                    
                    if(data.guest[0]["transStatus"]==1)
                        $("#bill-modal-remarks").html('BILLED OUT');
                    else
                        $("#bill-modal-remarks").html('ON GOING');
                    
                    $("#totalBill").val(amountTotal);
                    totalBalance = numeral(totalBalance).format('0,0.00');
                    
                    amountTotal = numeral(amountTotal).format('0,0.00');
                    paymentsTotal = numeral(paymentsTotal).format('0,0.00');
                    
                      $('#bill-charges-table > tbody:last-child').append('<tr style="border-top: 2px solid;"><td colspan="3" class="text-right">TOTALS:</td><td class="text-right">&#8369; '+amountTotal+'</td><td class="text-right">'+paymentsTotal+'</td><td class="text-right">'+totalBalance+'</td></tr>');
           
              
                     
                         
                });
        });
    });

       $(document).ready(function(){
        $("#bill-close").click(function(){
       
                    $('#bill-charges-table > tbody:last-child').empty();
                    
        });
    }); 
</script>
    
  
    <!--
<script type="text/javascript">
   
    
    $(document).ready(function(){
         
        
        $("#reserv-search-btn").click(function(){
            var dates1 = { id: $('#reservID').val(),
                };
            
            
           $.get('route("frontdesk.checkGuestRegistration)',function(data){
               $.ajax({
                   type:"GET",
                   url: "{{route('frontdesk.checkGuestRegistration')}}",
                   data: dates1,
                   
                   success: function (data){
                       console.log(data);
                
                       
                   }
                  
               });
           }); 
            
        });
    });
</script>

-->

@endsection