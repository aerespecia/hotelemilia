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
                <li><a href="{{route('frontdesk.index')}}"><i class="fa fa-calendar-o"></i><span>Rooms</span></a></li>
                <li><a href="{{route('frontdesk.reservation')}}"><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
               <li class="nav-active active"><a href="{{route('frontdesk.guestRegistration')}}"><i class="fa fa-users"></i><span>Bookings</span></a></li>
              
                <li><a href="{{route('frontdesk.nightAudit')}}"><i class="icon-note"></i><span>FO Reports</span></a></li>
               
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

              <h2 class="text-center"><strong>BOOKINGS</h2>
             
          <hr class="m-b-0"/>
          </div>
            <div class="row">
                <div class="col-md-12">
                          <div class="panel">
                    <div class="panel-header bg-dark">
                    <h3>Reservation List</h3>
                        <div class="control-btn">
                                    <a href="#" class="panel-toggle"><i class="fa fa-angle-down"></i> Toggle View</a>
                                
                                  </div>
                    </div>
                    <div class="panel-content">
                      <ul class="nav nav-tabs">
                        <li id="active" class="tabsLi"><a href="#tab1_1" data-toggle="tab">Active Reservations</a></li>
                        <li id="guar" class="tabsLi"><a href="#tab1_2" data-toggle="tab">Guaranteed Reservations</a></li>
                        <li id="staying" class="tabsLi active"><a href="#tab1_3" data-toggle="tab">On-Going Bookings</a></li>
                        <li id="out" class="tabsLi"><a href="#tab1_5" data-toggle="tab">Daily Check Out </a></li>
                     
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
                <th>Date Created</th>
                <th>Booking person</th>
                <th>Institution</th>
                <th>Type</th>
                <th>Rooms</th>
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
        "scrollY":        "400px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        ajax: "{!! route('frontdesk.dataTablesActiveReservationList') !!}",
        columns: [
            { data: 'dateMade', name: 'dateMade' },
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionName', name: 'institutionName' },
            { data: 'institutionType', name: 'institutionType' },
            { data: 'roomNames', name: 'roomNames' },
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
                        <div class="tab-pane tabsPane fade" id="tab1_2">
                          <div class="panel bg-light">
                   <div class="panel-header bg-green">
                            <h3>Guaranteed Reservations</h3>
                    </div>
                            <div class="panel-content">
                                   <table id="gua-table" class="table table-striped f-12">
                    <thead>
                      <tr>
                <th>Date Created</th>
                <th>Booking person</th>
                <th>Institution</th>
                <th>Type</th>
                <th>Rooms</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
                <th>Status</th>
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
        "scrollY":        "400px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        ajax: "{!! route('frontdesk.dataTablesGuaranteedReservationList') !!}",
        columns: [
            { data: 'dateMade', name: 'dateMade' },
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionName', name: 'institutionName' },
            { data: 'institutionType', name: 'institutionType' },
            { data: 'roomNames', name: 'roomNames' },
            { data: 'arrivalDate', name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate'},
            { "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    var status=data.status;
                  
                 
                if(status==0)
                    return '<span class="label label-success">On Going</span>';
                else if(status==100)
                     return '<span class="label label-danger">Fully Paid</span>';
                else if(status==1000)
                     return '<span class="label label-dark">Partial Payment</span>';
                else if(status==2)
                     return '<span class="label label-dark">No Show</span>';
                else if(status==3)
                     return '<span class="label label-blue">House Use</span>';
                else if(status==999)
                     return '<span class="label label-dark">Send Bill</span>';

            }
            },
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
                       <div class="tab-pane tabsPane fade active in" id="tab1_3">
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
                <th>Rooms</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
                <th>Status</th>
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
        "scrollY":        "400px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        ajax: "{!! route('frontdesk.dataTablesStayingReservationList') !!}",
        columns: [
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionName', name: 'institutionName' },
            { data: 'institutionType', name: 'institutionType' },
            { data: 'roomNames', name: 'roomNames' },
            { data: 'arrivalDate', name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate'},
               { "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    var status=data.status;
                  
                 
                if(status==0)
                    return '<span class="label label-success">On Going</span>';
                else if(status==100)
                     return '<span class="label label-danger">Fully Paid</span>';
                else if(status==1000)
                     return '<span class="label label-dark">Partial Payment</span>';
                else if(status==2)
                     return '<span class="label label-dark">No Show</span>';
                else if(status==3)
                     return '<span class="label label-blue">House Use</span>';
                else if(status==999)
                     return '<span class="label label-dark">Send Bill</span>';

            }
            },
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

                          <div class="tab-pane tabsPane fade" id="tab1_5">
                          <div class="panel bg-light">
                   <div class="panel-header bg-red">
                            <h3>Checked Out Reservations</h3>
                    </div>
                            <div class="panel-content">
                                   <table id="checkOut-table" class="table table-striped f-12">
                    <thead>
                      <tr>
                <th>Booking person</th>
                <th>Institution</th>
                <th>Type</th>
                <th>Rooms</th>
                <th>Arrival Date</th>
                <th>Depature Date</th>
                <th>Status</th>
                <th></th>
                
                
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#checkOut-table').DataTable({
        processing: true,
        serverSide: false, 
        "scrollY":        "400px",
        "scrollCollapse": true,
        "ordering": false,
           "bLengthChange": false,
        ajax: "{!! route('frontdesk.dataTablesCheckedOutList') !!}",
        columns: [
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionName', name: 'institutionName' },
            { data: 'institutionType', name: 'institutionType' },
            { data: 'roomNames', name: 'roomNames' },
            { data: 'arrivalDate', name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate'},
               { "className":      'options',
              "data":           null,
              "render": function(data, type, full, meta){
                    var status=data.status;
                  
                 
                if(status==0)
                    return '<span class="label label-success">On Going</span>';
                else if(status==100)
                     return '<span class="label label-danger">Fully Paid</span>';
                else if(status==1000)
                     return '<span class="label label-dark">Partial Payment</span>';
                else if(status==2)
                     return '<span class="label label-dark">No Show</span>';
                else if(status==3)
                     return '<span class="label label-blue">House Use</span>';
                   else if(status==999)
                     return '<span class="label label-dark">Send Bill</span>';

            }
            },
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
                     <input type="hidden" value="{{$user->firstName.' '.$user->lastName}}" id="logInUserFullName">
                  <h4><strong>CODE </strong>LOOK UP</h4>
             <input type="hidden" value="{{$transactionId}}" id="transID"/>
                </div>
           <div class="panel-content">
                    <h3><strong>SEARCH:</strong></h3>           
  
                 
                            <div class="form-group">
                              <h5>RESERVATION ID/OS No/Guest Folio No.:</h5>
                                         
                                {!! Form::open(['method'=>'GET','action'=>'FrontDeskController@guestRegistration']) !!}
                                <div class="row">
                                    <div class="col-sm-6">
                                   
                                <input type="text" name="reservID" id="reservID" class="form-control f-20" minlength="3" style="letter-spacing: 8px;text-transform: uppercase;">
                                
                           
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

            @if($code)
            <h4>Status: 
                @if($transaction->status == 0)
                          <span class="label label-success">Ongoing</span>
                        @elseif($transaction->status ==100)
                          <span class="label label-danger">Fully Paid</span>
                        @elseif($transaction->status ==1000)
                          <span class="label label-dark">Partial Payment</span>
                        @elseif($transaction->status == 2)
                          <span class="label label-dark">No Show</span>
                        @elseif($transaction->status == 3)
                          <span class="label label-blue">House Use</span>
                        @elseif($transaction->status == 999)
                          <span class="label label-dark">Send Bill</span>
                        @endif

                        @if($transaction->guaranteed == 1)
                          <span class="label label-warning">Guaranteed</span>
                        @elseif($transaction->guaranteed == 2)
                          <span class="label label-default">Not Guaranteed</span>
                        @endif 

            </h4>
            @endif
            <button class="btn btn-sm btn-default btn-transparent"  data-toggle="modal" value="{{$transactionId}}" data-target="#modal-change-status">Change Status</button>
           <div class="panel">
            <div class="panel-header">

              @if($reservArriv)
              <div class="row">
                <div class="col-md-4">
                  <h5>Booking Person: <strong>{{$clientD->firstName.' '.$clientD->lastName}}</strong></h5>
                  <h5>Institution: <strong>{{$instiD->name}}</strong></h5>
                </div>
                <div class="col-md-4">
                    <h5>Arrival: <strong>{{date('F j, Y',strtotime($reservArriv))}}</strong></h5>
                    <h5>Departure: <strong>{{date('F j, Y',strtotime($reservDepart))}}</strong></h5> 
                </div>
              </div>
         
              @endif

            </div>
          
            <hr/>
           <div class="panel-content p-t-0">
               <a type="button" class="btn btn-default btn-embossed" href="{{route('frontdesk.printPreviewReservation',['id'=>$transactionId])}}">View Reservation Summary</a>
            <a class="btn btn-default btn-embossed" href="{{route('frontdesk.printPreviewBillstatement',['id'=>$transactionId])}}">Billing Statement</a>
            <button class="btn btn-default btn-embossed" data-toggle="modal" value="{{$transactionId}}" data-target="#modal-manage-downpayment">Payments</button>
            <button class="btn btn-default btn-embossed" data-toggle="modal" id="transWithHolding" value="{{$transactionId}}" data-target="#modal-manage-withholdingTax">Withholding Tax</button>
           </div>
           </div>
           
            
            <div class="row">
                <div class="col-md-6">
                      <div class="panel" id="registration-info">
                        <div class="panel-header">
                            <h4><i class="fa fa-users"></i> <strong>Reserved Guest/s</strong></h4>  
                            <button id="add-guest" data-toggle="modal" data-target="#modal-add-guest" class="btn btn-sm btn-primary">Add Guest</button>

                            <hr/>
                        </div>
                        <div class="panel-content p-t-0">
            <table id="guests-table" class="table table-bordered">
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
       "scrollY":        "400px",
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
                   return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-guest-edit" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button data-toggle="modal" data-target="" class="btn btn-sm btn-blue folio-modal" data-id="3" value="'+valueHere+'">View Folio</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-guest" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li></ul>';
            }
        }
        ]
    });
    }
    

    
    $('#guests-table tbody').on( 'click', 'button', function () {        
        
        var id = $(this).attr("data-id");
        
        if(id==1){
            var guestReservID = this.value;
                

                $("#guest-reg-print").attr('href','../frontdesk/print-preview-guest-registration/'+guestReservID);


                $.get("../frontdesk/guest-edit/"+guestReservID,function(data){
                    console.log(data);
                    $(".title-name").html(data.guest.firstName+" "+data.guest.familyName);
                    $("#guest-registration-no").html(data.guest.guestReservNoNF);
                    $("#guest-fname").val(data.guest.firstName);
                    $("#guest-mname").val(data.guest.middleName);
                    $("#guest-lname").val(data.guest.familyName);
                    $("#guest-housebldg").val(data.guest.houseNo);
                    $("#guest-brgy").val(data.guest.brgy);
                    $("#guest-city").val(data.guest.city);
                    $("#guest-country").val(data.guest.country);
                    $("#guest-postalcode").val(data.guest.postalCode);
                    $("#guest-nationality").val(data.guest.nationality);
                    $("#guest-contactNo").val(data.guest.contactNo);
                    $("#guest-email").val(data.guest.email);
                    $("#guest-dob").val(data.guest.dob);
                    $("#guest-designation").val(data.guest.designation);
                    $("#guest-passno").val(data.guest.passNo);
                    $("#guest-passexp").val(data.guest.passExpiry);
                    $("#guest-passissue").val(data.guest.passIssue);
                    $("#guest-otherid").val(data.guest.otherId);
                    $("#guest-idfront-btn").val(data.guest.id);
                    $("#guest-idback-btn").val(data.guest.id);
                    $("#guestTempId").val(data.guest.id);
                    $("#guest-id").val(data.guest.id);
                    $(".guest-edit-close").val(data.guest.id);
                    $("#guest-regId").val(guestReservID);
                    
                    if(data.account_id)
                        $("#account-id").html(data.guest.account_id);
                    else
                        $("#account-id").html("NEW GUEST");


                    if(data.idfront != ""){
                      $("#file-idfront").removeClass("fileinput-new").addClass("fileinput-exists");
                  
                      $("#idfront-filename").html("&nbsp;&nbsp;"+data.idfront);

                    }

                    if(data.idback != ""){
                      $("#file-idback").removeClass("fileinput-new").addClass("fileinput-exists");
                  
                      $("#idback-filename").html("&nbsp;&nbsp;"+data.idback);

                    }



                  //  alert(data.idfront);
                  
                });
            
                 $.get("../frontdesk/guest-register-edit/"+guestReservID,function(data){
                    console.log(data);
                   $("#guestReservationId").html(data.guest_registration_no);
                     if(data.guest_registration_no){
                      $("input[name=roomselect][value=" + data.roomReservId + "]").iCheck('check');
                
                      $("#assigned-room").html(data.roomName+" - "+data.roomType);
                   $("#guestfolio-numbers").val(data.folioNos);
                     }
                   
                    
                  
                });
            $("#assign-room-save").val(guestReservID);
        }
        

        if(id==3){
            var guestReservID = this.value;
            
            $("#folio-print").attr('href','../frontdesk/print-preview-folio/'+guestReservID);
                window.location.replace('../frontdesk/print-preview-folio/'+guestReservID);
         
            
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
                    $("#folio-billingType").html(data.guest[0]["billingType"]+" - "+data.guest[0]["chargeType"])
                    
                    $("#folio-address").html(data.guest[0]["houseNo"]+" "+data.guest[0]["brgy"]+" "+data.guest[0]["city"]+" "+data.guest[0]["country"]);
                    
                    $("#folio-mobile").html(data.guest[0]["contactNo"]);
                    $("#folio-room-type").html(data.guest[0]["name"]);
                    $("#folio-room-name").html(data.guest[0]["roomName"]);
                    
                   
                    var string = numeral(data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"])).format('0,0.00');
                    
                    var int = new Date(data.guest[0]["initialDepartureDate"]);
                    var intdate = int.getDate();
                    var intmonth = int.getMonth() + 1; //Months are zero based
                    var intyear = int.getFullYear();

                    $("#folio-guestremarks").html(data.guest[0]["transStatus"]);

                   
                    
                    
                    $("#folio-numguest").html(data.guestCount[0]["guestCount"]);
//                 
                    var amountTotal = 0;
                    var chargesTotal = 0;
                    var paymentsTotal = 0;
                    var balance = 0;
                   
                        
                    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
             //       var firstDate = new Date(2008,01,12);
             //       var secondDate = new Date(2008,01,22);

                    var diffDays = Math.round(Math.abs((dep.getTime() - arr.getTime())/(oneDay)));
                    
                    var createRoomReserv = new Date(data.guest[0]["roomReservUpdated"]);
                    var roomRD = createRoomReserv.getDate();
                    var roomRM = createRoomReserv.getMonth() + 1; //Months are zero based
                    var roomRY = createRoomReserv.getFullYear();
                    
                    

                               for(var i=0;i<data.amendments.length;i++){
                      
                                var arr2 = new Date(data.amendments[i]["amendDate"]);
                                var arrdate2 = arr2.getDate();
                            var arrmonth2 = arr2.getMonth() + 1; //Months are zero based
                            var arryear2 = arr2.getFullYear();

                              var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
             //       var firstDate = new Date(2008,01,12);
             //       var secondDate = new Date(2008,01,22);
                             var amendArriv = new Date(data.amendments[i]["amendArriv"]);
                             var amendDepart = new Date(data.amendments[i]["amendDepart"]);
                            

                            var diffDays2 = Math.round(Math.abs((amendDepart.getTime() - amendArriv.getTime())/(oneDay)));
                    
                               
                                  var roomRate2 = data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"]);
                          var rateDiscount2 = numeral(data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"])).format('0,0.00')+" ("+data.amendments[i]['discountNameAmend']+" "+data.amendments[i]["discountValueAmend"]*100+"%)";
                            var totalRoomRate2 = roomRate2 * data.amendments[i]["amendDays"];
                            var stringTotalRoomRate2 = numeral(totalRoomRate2).format('0,0.00');

                            if(data.amendments[i]["FinalRoomRate"] != 0){

                              if(data.amendments[i]["discountType"]==1){
                                  $('#charges-table > tbody:last-child').append('<tr><td>'+arrmonth2+"/"+arrdate2+"/"+arryear2+'</td><td>ROOM: '+data.amendments[i]["amendRoomName"]+' - '+data.amendments[i]["amendRoomType"]+' ('+diffDays2+') days -- Rate:'+numeral(data.amendments[i]["FinalRoomRate"]).format('0,0.00')+' ('+data.amendments[0]["discountValue"]*100+'% - '+data.amendments[i]["discountNameAmend"]+')</td><td class="text-right">&#8369; '+numeral(data.amendments[i]["FinalRoomRate"]*diffDays2).format('0,0.00')+' </td><td class="text-right"></td><td class="text-right">&#8369; '+numeral(data.amendments[i]["FinalRoomRate"]*diffDays2).format('0,0.00')+'</tr>');
                              }

                              if(data.amendments[i]["discountType"]==2){
                                $('#charges-table > tbody:last-child').append('<tr><td>'+arrmonth2+"/"+arrdate2+"/"+arryear2+'</td><td>ROOM: '+data.amendments[i]["amendRoomName"]+' - '+data.amendments[i]["amendRoomType"]+' ('+diffDays2+') days -- Rate:'+numeral(data.amendments[i]["FinalRoomRate"]).format('0,0.00')+' (Less: '+data.guest[0]["discountValue"]+' - '+data.amendments[i][discountNameAmend]+')</td><td class="text-right">&#8369; '+numeral(data.amendments[i]["FinalRoomRate"]*diffDays2).format('0,0.00')+' </td><td class="text-right"></td><td class="text-right">&#8369; '+numeral(data.amendments[i]["FinalRoomRate"]*diffDays2).format('0,0.00')+'</tr>');
                              }
                                  
                            }
                      
                        
                            amountTotal+=data.amendments[i]["FinalRoomRate"]*diffDays2;
                            chargesTotal+=data.amendments[i]["FinalRoomRate"]*diffDays2;          

                            }

                    if(data.guest[0]["discountType"]==1){
                        $('#charges-table > tbody:last-child').append('<tr><td>'+roomRM+"/"+roomRD+"/"+roomRY+'</td><td>ROOM: '+data.guest[0]["roomName"]+' - '+data.guest[0]["name"]+' ('+diffDays+') days -- Rate: '+numeral(data.guest[0]["FinalRoomRate"]).format('0,0.00')+' ('+data.guest[0]["discountValue"]*100+'% - '+data.guest[0]["discountName"]+')</td><td class="text-right">&#8369; '+numeral(data.guest[0]["FinalRoomRate"]*diffDays).format('0,0.00')+'</td><td class="text-right"></td><td class="text-right">&#8369; '+numeral(data.guest[0]["FinalRoomRate"]*diffDays).format('0,0.00')+'</tr>');

                         $("#folio-rate").html(numeral(data.guest[0]["FinalRoomRate"]).format('0,0.00')+" ("+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]*100+"%)");
                    }
                    

                    if(data.guest[0]["discountType"]==2){
                        $('#charges-table > tbody:last-child').append('<tr><td>'+roomRM+"/"+roomRD+"/"+roomRY+'</td><td>ROOM: '+data.guest[0]["roomName"]+' - '+data.guest[0]["name"]+' ('+diffDays+') days -- Rate: '+numeral(data.guest[0]["FinalRoomRate"]).format('0,0.00')+' (Less: '+data.guest[0]["discountValue"]+' - '+data.guest[0]["discountName"]+')</td><td class="text-right">&#8369; '+numeral(data.guest[0]["FinalRoomRate"]*diffDays).format('0,0.00')+'</td><td class="text-right"></td><td class="text-right">&#8369; '+numeral(data.guest[0]["FinalRoomRate"]*diffDays).format('0,0.00')+'</tr>');

                         $("#folio-rate").html(numeral(data.guest[0]["FinalRoomRate"]).format('0,0.00')+" (Less: "+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]+")");
                    }

                    
                    
                    amountTotal+=data.guest[0]["FinalRoomRate"]*diffDays;
                    chargesTotal+=data.guest[0]["FinalRoomRate"]*diffDays;


               //     paymentsTotal+=data.guest[0]["FinalRoomRate"];
               
//                    var test = [];
//                   
//                    var tempArray = [];
//                    
//          
//                    if(data[0]["amendId"]){

//                      

                       for(var k=0;k<data.downpayments.length;k++){
                   
                             
                            var cd = new Date(data.downpayments[k]["chargeCreated"]);
                        
                  
                        
                        var chargeday = cd.getDate();
                        var chargemonth = cd.getMonth() + 1;
                        var chargeyear = cd.getFullYear();
                        
                    
                        $('#charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.downpayments[k]["os_id"]+' - Downpayment</td><td></td><td class="text-right">&#8369; '+numeral(data.downpayments[k]["amount"]).format('0,0.00')+'</td><td class="text-right">&#8369; '+numeral(data.downpayments[k]["amount"]).format('0,0.00')+'</tr>');
                            
                            amountTotal+=data.downpayments[k]["amount"];
                            paymentsTotal+=data.downpayments[k]["amount"];
                                                    
                       }

                  
                    for(var j=0;j<data.charges.length;j++){
                   
                             
                            var cd = new Date(data.charges[j]["chargeCreated"]);
                        
                        var chargePrice = numeral(data.charges[j]["price"]).format('0,0.00');
                        
                        var chargeday = cd.getDate();
                        var chargemonth = cd.getMonth() + 1;
                        var chargeyear = cd.getFullYear();
                        
                        if(data.charges[j]["account_type"]==1){
                            $('#charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td class="text-right">&#8369; '+chargePrice+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</tr>');
                            
                            amountTotal+=data.charges[j]["price"];
                            chargesTotal+=data.charges[j]["price"];
                        }
                        
                        
                        if(data.charges[j]["account_type"]==2){
                            $('#charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</td><td class="text-right">&#8369; '+chargePrice+'</tr>');
                            
                            amountTotal+=data.charges[j]["price"];
                            paymentsTotal+=data.charges[j]["price"];
                        }
                             
                       }
//                 
                    
              
                   
                    balance = amountTotal - paymentsTotal;
//                  
                    chargesTotal = numeral(chargesTotal).format('0,0.00');
                    amountTotal = numeral(amountTotal).format('0,0.00');
                    paymentsTotal = numeral(paymentsTotal).format('0,0.00');
                    balance = numeral(balance).format('0,0.00');
                    
                     $('#charges-table > tbody:last-child').append('<tr><td colspan="2" class="text-right">Total</td><td class="text-right">&#8369; '+chargesTotal+'</td><td class="text-right">&#8369; '+paymentsTotal+'</td><td class="text-right">&#8369; '+amountTotal+'</td></tr><tr><td colspan="2" class="text-right">Balance/Amount Payable</td><td></td><td></td><td class="text-right">&#8369; '+balance+'</td></tr>');
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
                            <button id="add-room" data-toggle="modal" data-target="#modal-add-room" class="btn btn-sm btn-primary">Add Room</button> 
                            <button id="check-in-all-rooms" value="{{$transactionId}}" class="btn btn-sm btn-primary">Check In All Rooms</button>  
                            <button id="check-out-all-rooms" value="{{$transactionId}}" class="btn btn-sm btn-primary">Check Out All Rooms</button>   
                            <hr/>                                   
                        </div>
                        <div class="panel-content p-t-0">
            <table id="rooms-table" class="table table-bordered">
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
       "scrollY":        "400px",
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
                 else if(status==3)
                    return '<span class="label label-dark">No Show</span>';
                 else
                     return '<span class="label label-warning">Not Checked In</span>';
             }
            },
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                  var valueHere=data.id;
                   return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-room-register" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-room" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li><li><button data-toggle="modal" data-target="" class="btn btn-sm btn-blue folio-modal" data-id="3" value="'+valueHere+'">View Room Bill</button></li><li><button type="button" data-id="4" data-toggle="modal" data-target="#modal-blocked-occ" value="'+valueHere+'" class="btn btn-sm btn-warning">Add Charge</button></li></ul>';
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
                    
                    var arr = new Date(data.room[0]["arrivalDate"]);
                    var arrdate = arr.getDate();
                    var arrmonth = arr.getMonth() + 1; //Months are zero based
                    var arryear = arr.getFullYear();

                    var dep = new Date(data.room[0]["depatureDate"]);
                    var depdate = dep.getDate();
                    var depmonth = dep.getMonth() + 1; //Months are zero based
                    var depyear = dep.getFullYear();

                    var int = new Date(data.room[0]["initialDepartureDate"]);
                    var intdate = int.getDate();
                    var intmonth = int.getMonth() + 1; //Months are zero based
                    var intyear = int.getFullYear();


                    $("#room-title-name").html(data.room[0]["roomName"]+" - "+data.room[0]["roomType"]);

                    $("#guestSRRID").val(roomId);

                      $("#roomcheckOutTime").val(data.room[0]["checkOutTime"]);
                    $("#roomCheckInTime").val(data.room[0]["checkInTime"]);
                    $("#save-checkoutTime").val(data.room[0]["id"]);

                    $("#roomarrivalDate").val(data.room[0]["actualArrivalDate"]);
                    $("#roomdepartureDate").val(data.room[0]["actualDepartureDate"]);

                    $("#roomFinalRoomRate").val(data.room[0]["FinalRoomRate"]);
                    $("#roomDiscount").val(data.room[0]["discountId"]);
                    $('#roomDiscount').select2().trigger('change');

                  //  $("#roomDiscount").val(3);

                   // alert(data.room[0]["discountId"]);
                    $("#roomFinalRoomType").val(data.room[0]["roomTypeBill"]);

                    $(".add-date-extension").val(data.room[0]["id"]);

                    if(dep>int){
                      $("#room-register-ext").html(depmonth+"/"+depdate+"/"+depyear);
                      $("#ext-date").val(depmonth+"/"+depdate+"/"+depyear);
                    }
                    


                   // "#room-register-ext"
                       
                    $(".check-in-guest").val(data.room[0]["id"]);
                    $(".check-out-guest").val(data.room[0]["id"]);
                    $("#room-title-name2").html(data.room[0]["roomName"]+" - "+data.room[0]["roomType"]);
                    var guestListing = $("#reserved-guest");
                    
                    var occ_status = data.room[0]["occupied_status"];
                       
                    if(occ_status==1){
                        $("#room-status-checkin").html("Checked In");
                        $("#room-status-checkin").attr("class","label label-danger");
                    }
                    else{
                         $("#room-status-checkin").html("Not Checked In");
                        $("#room-status-checkin").attr("class","label label-warning");
                    }
                        
                        
                    for(var i=0; i < data.guest.length; i++){
                           guestListing.append("<li>"+data.guest[i]["firstName"]+" "+data.guest[i]["familyName"]+"</li>");
                       }
            
                });
            
              
            
            
        }

        if(id==3){

           var roomReservID = this.value;
            
         $("#room-bill-print").attr('href','../frontdesk/print-preview-roombill/'+roomReservID);
         window.location.replace('../frontdesk/print-preview-roombill/'+roomReservID);
         
            
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

        if(id==2){
             var roomReservID = this.value;
            
            $("#confirm-remove-room").val(roomReservID);
            
            $.get("../frontdesk/remove-room/"+roomReservID,function(data){
                $("#roomreserv-name").html(data.roomName+" - "+data.roomType);                    
            });
            

              $("#manager-access").show();
              $("#delete-info-body").hide();
              $("#delete-info-footer").hide();
              $("#delete-man-username").val('');
              $("#delete-man-password").val('');
        }

        if(id==4){

            var roomId = $(this).attr("value");
        
               var dateSelected = {
                
                  dateMain:  $("#date-main-hidden").val(),
                
            };
            
            var url = "{{route('frontdesk.addChargeBooking',['id' =>':id'])}}";
            var url2 = url.replace(":id",roomId);
            
             $.ajax({
                   type:"GET",
                   url: url2,
                   data: dateSelected,
                   
                   success: function (data){
                  
                       
                       var guestListing = $("#checked-in-guests");
                       
                    
                       
                   for(var i=0; i < data.info.length; i++){
                           guestListing.append("<label><input type='radio' id='occ-guest-radio' name='occ-guest-radio' class='occ-guest-radio' value="+data.info[i]['gReservId']+" data-radio='iradio_minimal-blue'> "+data.info[i]['firstName']+' '+data.info[i]['familyName']+"</label>");
                         
                     
                       }
                       
                       
                          var amountTotal = 0;
                    var paymentsTotal = 0;
                    var balance = 0;
                       
                        for(var j=0;j<data.charges.length;j++){
                   
                             
                            var cd = new Date(data.charges[j]["chargeCreated"]);
                        
                        var chargePrice = numeral(data.charges[j]["price"]).format('0,0.00');
                        
                        var chargeday = cd.getDate();
                        var chargemonth = cd.getMonth() + 1;
                        var chargeyear = cd.getFullYear();
                        
                        if(data.charges[j]["account_type"]==1){
                            $('#occ-charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td class="text-right">&#8369; '+chargePrice+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</tr>');
                            
                            amountTotal+=data.charges[j]["price"];
                        }
                        
                        
                        if(data.charges[j]["account_type"]==2){
                            $('#occ-charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</td><td class="text-right">&#8369; '+chargePrice+'</tr>');
                            
                            amountTotal+=data.charges[j]["price"];
                            paymentsTotal+=data.charges[j]["price"];
                        }
                             
                       }
                       
                         balance = amountTotal - paymentsTotal;
//                    
                    amountTotal = numeral(amountTotal).format('0,0.00');
                    paymentsTotal = numeral(paymentsTotal).format('0,0.00');
                    balance = numeral(balance).format('0,0.00');
                    
                     $('#occ-charges-table > tbody:last-child').append('<tr><td colspan="2" class="text-right">Total</td><td></td><td></td><td class="text-right">&#8369; '+amountTotal+'</td></tr><tr><td colspan="2" class="text-right">Payments</td><td></td><td class="text-right">&#8369; '+paymentsTotal+'</td><td></td></tr><tr><td colspan="2" class="text-right">Balance/Amount Payable</td><td></td><td></td><td class="text-right c-red f-20"><strong>&#8369; '+balance+'</strong></td></tr>');
                   
                   }
                   
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
                            <button id="edit-reservation-notes" class="btn btn-sm btn-light"><i class="fa fa-edit"></i> Edit</button>
                             <button id="save-reservation-notes" class="btn btn-sm btn-success" value="{{$transactionId}}" disabled>Save</button>

                        </div>
                      <div class="panel-content p-t-0">
                        <textarea class="form-control" id="reservation-notes-area" rows="5" disabled="">{{$notes}}</textarea>
                                           
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
              <div class="row">
              <div class="col-md-12">
                
            <div class="panel">
            <div class="panel-header">
              <h4><strong>Amendment History</strong></h4>  
                            <hr/>
            </div>
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="amend-table" class="table table-striped">
                    <thead>
                      <tr>

                <th>Names of Guest/s</th>
                <th>Reservation ID</th>
                <th>Institution</th>
                <th>From</th>
                <th>To</th>
                <th>Staff</th>
                <th>Remarks</th>
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {

  var transactionID = $("#transID").val();

    $('#amend-table').DataTable({

        processing: true,
        serverSide: false,
        ajax:"../frontdesk/dataTablesAmmendmentTables/"+transactionID,
        
        columns: [
            { data: 'guest', name: 'guest' },
            { data: 'code', name: 'code' },
            { data: 'instiName' , name: 'instiName' },
            { data: 'roomFroms', name: 'roomFroms' },
            { data: 'roomTo', name: 'roomTo' },
            { data: 'username' , name: 'username' },
            { data: 'notes' , name: 'notes' },
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
            </div>
              </div>
              </div>

            <!--- EDIT GUEST REGISTRATION BEGIN -->
            <!--- GUEST REGISTRATION MODAL BEGINS EDIT-GUEST -->    
        <div class="modal fade" id="modal-guest-edit" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">

         {!! Form::open(['method'=>'POST','action'=>'GuestCrudController@guestUpdate','name'=>'formregist','files'=>'true']) !!}


            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>GUEST REGISTRATION CARD:</strong> <span class="title-name"></span></h4>
                 
                </div>
                <div class="modal-body">
                 <div class="row">
                    <div class="col-md-6 line-separator">
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

                            <input type="hidden" id="guest-id" name="guest-id"/>
                            <input type="hidden" id="guest-regId" name="guest-regId"/>
                            <input type="hidden" id="guest-code" name="guest-code" value="{{$code}}"/>
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
                       <div class="col-md-8">
                        <h3><strong>SCANNED ID</strong></h3>
                       <div class="form-group">
                          <h5><strong>Front</strong>
                           </h5>
                            
                          <div id="file-idfront" class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                              <i class="fa fa-image fileinput-exists"></i><span class="fileinput-filename" id="idfront-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-dark btn-file"><span class="fileinput-new">Choose file</span><span class="fileinput-exists">Change</span>
                            <input type="file" accept="image/jpeg" name="guest-idfront" id="guest-idfront" placeholder="Select File...">
                            </span>
                         

                          </div>

                         
                        </div>  
                       </div>
                              
                </div>

                <div class="row">
                       <div class="col-md-8">
                       <div class="form-group">
                          <h5><strong>Back</strong>
                           </h5>
                            
                          <div id="file-idback" class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                              <i class="fa fa-image fileinput-exists"></i><span class="fileinput-filename" id="idback-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-dark btn-file"><span class="fileinput-new">Choose file</span><span class="fileinput-exists">Change</span>
                            <input type="file" accept="image/jpeg" name="guest-idback" id="guest-idback" placeholder="Select File...">
                            </span>
                         

                          </div>

                         
                        </div>  
                       </div>
                              
                </div>
                
                


                <hr/>
                        <div class="row">
                            <div class="pull-right m-r-10">
                                <a id="guest-reg-print" type="button" class="btn btn-dark btn-embossed m-r-20"<i class="fa fa-print"></i> PRINT</a>
                  <input type="submit" class="btn btn-success btn-embossed guest-edit-save" id="" value="SAVE"/>                            </div>
                             {!! Form::close() !!}
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
                                            <input type="radio" data-radio="iradio_square-blue" id="roomselect"  name="roomselect" value="{{$r->reserveid}}" > 


                                            {{$r->roomName.' -'.$r->roomType}} [                
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
                          <div class="col-sm-12">
                              <div class="form-group">
                              <label class="control-label f-12">Guest Folio Control Number/s:</label>
                             
                                <input type="text" id="guestfolio-numbers" name="guestfolio-numbers" class="form-control" placeholder="Ex. 002234, 001234" minlength="3" >
                              
                              </div>
                            </div>
                      </div>

                         <div class="row">
                            <div class="pull-right m-r-20">
                              <button type="button" class="btn btn-success btn-embossed guest-register-edit-save" id="assign-room-save" value=""> SAVE</button>
                             </div>
                         </div>
                         <hr/>
                         


                            <div class="row">

                              <div class="col-sm-12">
                              <h3><strong>View Uploaded Files</strong></h3>
                              <div class="btn-group">
                                  <button type="button" class="btn btn-sm btn-blue border-right" id="guest-idfront-btn">ID FRONT</button>
                              
                                  <button type="button" class="btn btn-sm btn-blue border-left" id="guest-idback-btn">ID BACK</button>
                                </div>
                                          <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                                          <div class="form-group">
                                            <img src="" id="previewImage" name="previewImage" style="width:100%">
                                          </div>
                                        </div>

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
                      
                      <h4 class="modal-title"><strong>Create Special Request Form:<span></span></strong> </h4>
                     
                    </div>
                     
                    <div class="modal-body" id="room-modal-register2">
                     <h2><strong>Create Special Request<span></span></strong></h2>
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


          <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-add-room" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-full">
                  <div class="modal-content">
                    <div class="modal-header bg-aero">
                    
                       
                      <h4 class="modal-title"><strong>Add Room<span></span></strong> </h4>
                      
                    </div>
                     
                    <div class="modal-body p-20">
                    <div class="panel">
                      
                      <div class="panel-content">
                             {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@addRoomsToBooking','name'=>'formregis','id'=>'FrontDeskController']) !!}
                                 <h2><strong>Available Rooms:  </strong></h2>
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                        <label class="form-label">Arrival and Departure</label>
                        <div class="input-daterange b-datepicker input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" id="arrival2" value="{{ date('m/d/Y',strtotime($reservArriv))}}" name="arrival2" placeholder="Arrival"/>
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control" value="{{ date('m/d/Y',strtotime($reservDepart))}}" id="departure2" name="departure2" placeholder="Departure"/>
                        </div>                                     
                      </div>
                        </div>
                        <div class="col-md-4">
                            
                             <a class="btn btn-success btn-transparent panel-reload m-t-20" id="checkAvail">Check Room Availability</a>               
                        </div>
                      </div><hr/>
                      
                      
                         <div class="row">
                        
                               <div class="col-sm-2">


                          <input type="hidden" name="checkInTime" value="{{$reservCheckIn}}"/>
                          <input type="hidden" name="checkOutTime" value="{{$reservCheckOut}}"/>
                          <input type="hidden" name="billingType" value="{{$reservBillArrange}}"/>
                          <input type="hidden" name="billingNote" value="{{$reservBillNote}}" />
                          <input type="hidden" name="transactionID" value="{{$transactionId}}" />
                          <input type="hidden" name="code" value="{{$code}}"/>
                  
                              <label>Hospitality Suite</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==1)
                                        @if(!$exist)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                        
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @foreach($roomsToAdd as $r)
                                            @if($r->type == 1)
                                        <label id="room{{$r->id}}" class="f-10">
                                            <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>
                            <div class="col-sm-2">
              
                              <label>Matrimonial Suite</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist1 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==2)
                                        @if(!$exist1)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist1 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                      
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @foreach($roomsToAdd as $r)
                                            @if($r->type == 2)
                                        <label class="f-10" id="room{{$r->id}}">
                                            <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>  
                             <div class="col-sm-2">
              
                              <label>Junior Suite/PWD</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist3 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==3)
                                        @if(!$exist3)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist3 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                      
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @foreach($roomsToAdd as $r)
                                            @if($r->type == 3)
                                        <label class="f-10" id="room{{$r->id}}">
                                            <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>
                            <div class="col-sm-2">
              
                              <label>Deluxe Family Room</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist4 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==4)
                                        @if(!$exist4)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist4 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                       
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @foreach($roomsToAdd as $r)
                                            @if($r->type == 4)
                                        <label class="f-10" id="room{{$r->id}}">
                                            <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>
                           
                        <div class="col-sm-2">
              
                              <label>Triple Sharing</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist6 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==6)
                                        @if(!$exist6)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist6 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                         
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @foreach($roomsToAdd as $r)
                                            @if($r->type == 6)
                                        <label class="f-10" id="room{{$r->id}}">
                                            <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>
                       
                             
                        </div>
                                
                        <div class="row">
                         <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Twin Sharing Deluxe</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist7 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==7)
                                        @if(!$exist7)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist7 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                       
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @foreach($roomsToAdd as $r)
                                            @if($r->type == 7)
                                        <label class="f-10" id="room{{$r->id}}">
                                            <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                           <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Standard Twin</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist8 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==8)
                                        @if(!$exist8)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist8 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                        
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @foreach($roomsToAdd as $r)
                                            @if($r->type == 8)
                                        <label class="f-10" id="room{{$r->id}}">
                                            <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                            <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Standard Double</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist9 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==9)
                                        @if(!$exist9)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist9 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                 
                                <div class="row">
                                      
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @foreach($roomsToAdd as $r)
                                            @if($r->type == 9)
                                        <label class="f-10" id="room{{$r->id}}">
                                            <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                             <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Single Deluxe</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist10 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==10)
                                        @if(!$exist10)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist10 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                      
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @foreach($roomsToAdd as $r)
                                            @if($r->type == 10)
                                        <label class="f-10" id="room{{$r->id}}">
                                            <input class="checkboxes" type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                            <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Standard Single</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist11 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==11)
                                        @if(!$exist11)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist11 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                        
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @foreach($roomsToAdd as $r)
                                            @if($r->type == 11)
                                        <label class="f-10 label-checkbox" id="room{{$r->id}}">
                                            <input type="checkbox" class="checkvox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>


                             <br/>
                            </div>
                          </div>

                            <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Junior Suite</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist11 = false; ?>
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==12)
                                        @if(!$exist11)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist11 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                    </div>
                                   
                                </div>
                      
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @foreach($roomsToAdd as $r)
                                            @if($r->type == 12)
                                        <label class="f-10" id="room{{$r->id}}">
                                            <input type="checkbox" name="roomId[]" class="roomcheckbox" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                        
                       
                             
                        </div>

                        <div class="row">
                                  <div class="col-md-8">
                                  <table id="room-reserv-table" class="table table-striped">
                                    <thead>
                                        <th>Room No.</th>
                                        <th>Room Type.</th>
                                        <th>Room Rate</th>
                                        <th>Discount</th>
                                        <th>Final Rate</th>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                                  </div>
                                <div class="col-md-4">
                                  <div class="panel bg-light p-20">
                                    <div class="panel-content">
                                      <h3 class="m-t-5"><strong>TOTAL:</strong></h3>
                                    <h2>&#8369; <span id="room-total-charge">0.00</span></h2>
                                    </div>
                                  </div>
                                    
                                  </div>
                                
                                </div>
                                <input type="submit" class="btn btn-success btn-embossed add-room-save" id="special-request-save" value="SAVE">
                      </div>
                       
                      
                      <hr/>

                    </div>
   
                      <br/>
                    <div class="modal-footer bg-dark">
                      <button type="button" class="btn btn-white btn-embossed" id="add-room-close" data-dismiss="modal" value="">CLOSE</button>
                     
                    </div>
                  </div>
                </div>
              </div>
                
            </div>
            {!! Form::close() !!}
            <!-- End of Special Request Modal -->





             <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-room-register" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  
                  <h4 class="modal-title"><strong>ROOM:<span id="room-title-name"></span></strong> </h4>
                 
                </div>
                 
                <div class="modal-body p-30" id="room-modal-register">
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
                        <button type="button" class="btn btn-hg btn-danger check-out-guest">CHECK OUT</button>
                        </div> 
                        </div>


                        <div class="col-md-6">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Arrival Date</label>
                        <div class="prepend-icon">
                          <input type="text" id="roomarrivalDate" name="date-main" autocomplete="off" class="b-datepicker form-control" placeholder="Select a date..." data-orientation="top" value="">

                          <i class="icon-calendar"></i>
                        </div>
                      </div>
                   
                      <div class="form-group">
                        <label>Departure Date</label>
                        <div class="prepend-icon">
                          <input type="text" id="roomdepartureDate" name="date-main" autocomplete="off" class="b-datepicker form-control" placeholder="Select a date..." data-orientation="top" value="">

                          <i class="icon-calendar"></i>
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Final Room Rate</label>
                      
                          <input type="text" id="roomFinalRoomRate" name="date-main" autocomplete="off" class="b-datepicker form-control" placeholder="Enter Room Rate" data-orientation="top" value="">

                     
                      </div>
                      <div class="form-group">
                        <label>Discount Type</label>
                      
                          <select id="roomDiscount" name="" class="form-control">
                          <option value="1">----SELECT----</option>
                                @foreach($discountDetails as $dd)
                                  <option value="{{$dd->id}}">{{$dd->name.' ('.($dd->discountValue*100).' %)'}}</option>
                                @endforeach
                              </select>
                     
                      </div>

                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Check In Time</label>

                        <div class="prepend-icon">

                          <input type="text" id="roomCheckInTime" name="roomCheckInTime" class="timepicker form-control" placeholder="Choose a time..." value="">
                          <i class="icon-clock"></i>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Check Out Time</label>

                        <div class="prepend-icon">

                          <input type="text" id="roomcheckOutTime" name="roomcheckOutTime" class="timepicker form-control" placeholder="Choose a time..." value="">
                          <i class="icon-clock"></i>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Custom Room Type</label>
                      
                          <input type="text" id="roomFinalRoomType" name="date-main" autocomplete="off" class="b-datepicker form-control" placeholder="Enter Room Rate" data-orientation="top" value="">

                     
                      </div>
                      <div class="form-group">
                      <label>&nbsp;</label><br/>
                        <button type="button" id="save-checkoutTime" class="btn btn-success">Save</button>
                      </div>

                    </div>
                  </div>
                </div>


                </div>

                
        
                     
                     </div>

                     </div>

                     <div class="panel">
                           <h3><strong>Room Amendment</strong></h3><hr/>
                                <div class="row">
                                <div class="col-sm-12">
                            <div class="form-group">
                              
                
                              <label class="control-label">Charge</label>
                                <select id="chargeRoom" name="chargeRoom" style="width:250px;">
                                  <option value="0" selected>No</option>
                                  <option value="1">Yes</option>
                                  
                                
                                  </select>
                                </div>
                            </div>
                          </div>

                          <div class="row">
                                <div class="col-sm-12">
                            <div class="form-group">
                              
                
                              <label class="control-label">Amendment Notes</label>
                                <textarea name="notes" id="amendnotes" rows="5" class="form-control" placeholder="Notes"></textarea>
                                </div>
                            </div>
                          </div>
                                <h4><strong>Room Availability</strong></h4>
                                  <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                        <label class="form-label">Arrival and Departure</label>
                        <div class="input-daterange b-datepicker input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" id="arrival21" name="arrival21" placeholder="Arrival"/>
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control" id="departure21" name="departure21" placeholder="Departure"/>
                        </div>                                     
                      </div>
                        </div>
                        <div class="col-md-4">
                            
                            <input type="hidden" id="guestSRRID"/>

                             <a class="btn btn-success btn-transparent panel-reload m-t-20" id="checkAvail2">Check Room Availability</a>               
                        </div>
                      </div>
            
                              
                              <div class="panel-content">
                                  
                      <hr class="m-t-10"/>
 
                            <div class="row">
                        
                            
                               <div class="col-sm-2">
              
                              <label>Hospitality Suite</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==1)
                                        @if(!$exist)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                              <div class="row">
                                    <div class="col-sm-12">
                                            
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 1)
                                        <label id="roomC{{$r->id}}" class="f-10">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>
                            <div class="col-sm-2">
              
                              <label>Matrimonial Suite</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist1 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==2)
                                        @if(!$exist1)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist1 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                              <div class="row">
                                    <div class="col-sm-12">
                                            
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 2)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>  
                             <div class="col-sm-2">
              
                              <label>Junior Suite</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist3 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==3)
                                        @if(!$exist3)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist3 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                              <div class="row">
                                    <div class="col-sm-12">
                                            
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 3)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>
                            <div class="col-sm-2">
              
                              <label>Deluxe Family Room</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist4 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==4)
                                        @if(!$exist4)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist4 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                        

                                    </div>
                                   
                                </div>
                              <div class="row">
                                    <div class="col-sm-12">
                                            
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 4)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>
                   

                        <div class="col-sm-2">
              
                              <label>Triple Sharing</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist6 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==6)
                                        @if(!$exist6)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist6 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                              <div class="row">
                                    <div class="col-sm-12">
                                            
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                      @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 6)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>
                       
                             
                        </div>
                                
                        <div class="row">
                         <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Twin Sharing Deluxe</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist7 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==7)
                                        @if(!$exist7)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist7 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                          
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 7)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                           <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Standard Twin</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist8 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==8)
                                        @if(!$exist8)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist8 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                       
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 8)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                            <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Standard Double</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist9 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==9)
                                        @if(!$exist9)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist9 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                   
                                <div class="row">
                                      
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 9)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                             <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Single Deluxe</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist10 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==10)
                                        @if(!$exist10)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist10 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                    
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 10)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                            <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>Standard Single</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist11 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==11)
                                        @if(!$exist11)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist11 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                     
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 11)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                               <div class="col-sm-2 border-top">
              
                            <div class="form-group m-t-10">
                              <label>PWD</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist11 = false; ?>
                                        @if($code)
                                        @foreach($roomsToAdd as $r)
                                        @if($r->type==12)
                                        @if(!$exist11)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist11 = true; ?>
                                        @endif
                                        @endif
                                        @endforeach
                                        @endif
                                    </div>
                                   
                                </div>
                     
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($roomsToAdd as $r)
                                            @if($r->type == 12)
                                        <label class="f-10" id="roomC{{$r->id}}">
                                            <input type="radio" name="roomIdc" id="roomIdc" value="{{$r->id}}" data-radio="iradio_square-blue"> {{$r->roomName}}</label>
                                            @endif
                                        @endforeach
                                        @endif
                                           
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                       
                             
                        </div>          

                                  
                        
                              </div>

                        
                            </div>
                  
                  <br/>
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed" id="room-register-close" data-dismiss="modal" value="">CLOSE</button>
                   
                  <button type="button" class="btn btn-success btn-embossed guest-room-edit-save" id="" value=""> SAVE</button>
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
         sScrollY: "280px",                
        paginate:false,
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
                   {!! Form::close() !!}
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
                  <button type="button" class="btn btn-danger btn-embossed" id="confirm-remove">Yes</button>
                </div>
              </div>
            </div>
          </div>

        <div class="modal fade" id="modal-change-status" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-dark">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Change</strong> Status</h4>
                </div>
                <div class="modal-body p-30">

                  
                  <input type="hidden" value="{{$transactionId}}" name="tID"/>
                  <div>
                        <div class="col-md-4">

                              <button type="button" value="0" class="btn btn-success change-status">Ongoing</button>
                        </div>
                        <div class="col-md-4">
                              <button type="button" value="2" class="btn btn-dark change-status">No Show</button>
                        </div>
                        <div class="col-md-4">
   
                              <button type="button" value="3" class="btn btn-blue change-status">House Use</button>
                         
                        </div>
                  </div>
                  
                    <br>
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="" id="exit-change-status">Exit</button>
                
                </div>
            
              </div>
            </div>
        </div>

<div class="modal fade" id="modal-remove-room" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-red">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Remove</strong> Room: <span></span></h4>
                </div>
                <div >
                  <div class="modal-body" id="manager-access">
                    <h3>Manager Access:</h3>
                      <br>
                      <div class="row">
                        <div class="col-md-4">
                          <input type="text" id="delete-man-username" class="form-control" placeholder="Enter Username..." />
                        </div>
                        <div class="col-md-4">
                          <input type="password" id="delete-man-password" class="form-control" placeholder="Enter Password..." />
                        </div>
                        <div class="col-md-4">
                          <button class="btn btn-success btn-embossed" id="btn-manager-delete">Submit</button>
                        </div>
                      </div>
                  </div>
                  <div class="modal-body" id="delete-info-body" style="display:none;">
                    <h3>Are you sure you want to remove <strong><span id="roomreserv-name"></span></strong> from list?</h3>
                      <br>
                  </div>
                  <div class="modal-footer" id="delete-info-footer" style="display:none;">
                    <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Exit</button>
                    <button type="button" class="btn btn-danger btn-embossed" data-dismiss="modal" id="confirm-remove-room">Yes</button>
                  </div>
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
                           <th style="width:95px">Charges</th>
                          <th style="width:95px">Payments</th>
                         
                        <th style="width:95px">Amount</th>
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
                   <h4 class="f-12 m-t-0" align="center">Billing Arrangement: <br class="m-b-5"/><strong><span id="folio-billingType"></span></strong></h4>    
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
                    <h4 class="f-12 m-t-5  m-b-0" align="center">No. of Guest: <br class="m-b-5"/><strong>1 of <span id="folio-numguest"></span></strong></h4>    
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
                        <th style="width:145px" align="center">Charges</th>
                        <th style="width:95px" align="center">Payments</th>
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
            <div class="modal-dialog modal-full">
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
                    
                        <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-transparent bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                            <div class="panel-content p-l-10 p-r-10">
                                 <h3 class="m-t-10"><strong>GUEST LIST</strong></h3><hr class="m-t-5"/>
                            <table id="res-guest-details" class="table table-bordered">
                                <thead class="f-12">
                                    <tr>
                                        <th>NAME</th>
                                        <th>CONTACT</th>
                                        <th>Assigned Room</th>
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
                                 <h3 class="m-t-10"><strong>ROOM LIST</strong></h3><hr class="m-t-5"/>
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
                                <p class="f-12">ETA: <strong><span id="res-checkin"></span></strong></p>
                            </div>  
                            <div class="col-md-3">
                                <p class="f-12">ETD: <strong><span id="res-checkout"></span></strong></p>   
                            </div> 
                    </div>
                    <div class="row">
                            <div class="col-md-3">
                                <p class="f-12">Made Thru: <strong><span id="res-madethru"></span></strong></p>
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

                    <div class="panel panel-transparent bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                    <h3 class="m-l-20"><strong>Reservation Notes:</strong></h3>
                    <div class="row">
                      <div class="col-md-3">
                      <p class="f-12"><span id="res-notes"></span></p>
                      </div>
                    </div>
                    </div>
                
                   
                    <hr/>
           
                    
                    
                    
                </div>
                <div class="modal-footer bg-dark">
                  <button type="button" id="res-close" class="btn btn-white btn-embossed" data-dismiss="modal">Close</button>
                  <a type="button" class="btn btn-primary btn-embossed" href="{{route('frontdesk.printPreviewReservation',['id'=>$transactionId])}}"><i class="fa fa-print"></i> Print</a>
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
                           <th style="width:95px">Charges</th>
                          <th style="width:95px">Payments</th>
                         
                        <th style="width:95px">Amount</th>
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

           {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@makeDownpayment']) !!}
         <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-manage-downpayment" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header bg-blue">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><strong>Payments</strong></h4>
                 
                </div>
                <div class="modal-body p-40">
                    
                        <h4 class="m-t-5"><strong>Rooms:</strong></h4><hr/>
                   
                    <table class="f-13 table table-bordered">
                    <thead>
                      <tr>
                        <th>Room No.</th>
                
                        <th>Balance</th>
                        <th>Enter Payment</th>
                        <th>Notes</th>
                        <th>Paid Thru</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $totalRateDown = 0; 
                            $balanceTotal = 0;?>

                        @if($code)
                      <?php $withHolding = $transaction->withHoldingTax; ?>
                       @else
                      <?php $withHolding = 0; ?>

                       @endif

                       <?php 

                          $roomsCounting = 0;
                       ?>

                      @if($sales)
                       @foreach($sales as $s)
                       <?php $roomsCounting++; ?>
                       @endforeach
                       @endif
                       
                       @if($roomsCounting == 0)
                        <?php $roomsCounting = 1;
                      ?>
                      @endif

                    @if($rooms and $sales)

                        @foreach($sales as $r)
                        <tr>
                          <td>{{$r->roomName}}</td>
                    
                      <?php $grandTotal = ($r->totalBill + $r->shuttleService) - $r->totalChargeDiscount;
                            $paymentsReceived = $r->creditCharges;
                       ?>

                       @foreach($downpayments as $dp)
                        @if($dp->roomReservationId == $r->reserveid)
                          <?php $paymentsReceived+=$dp->amount; ?>
                        @endif
                       @endforeach

                    
                          <td style="text-align:right;">{{number_format($grandTotal - $paymentsReceived - ($withHolding/$roomsCounting),2)}}</td>
                          
                              <?php $balanceTotal+=$grandTotal-$paymentsReceived; ?>
                      
                          <td>
                            <input type="text" id="numbersonly" class="form-control" name='payment[{{$r->reserveid}}]' placeholder="0,000.00" autocomplete="off" />
                          </td>
                           <td>
                            <input type="text" class="form-control" name='notes{{$r->reserveid}}' value="Payment Received" autocomplete="off" />
                          </td>
                          <td>
                              <select id="downpayment-paidThru" name="paidthru{{$r->reserveid}}" class="form-control">
                                    <option value="1">Cash</option>
                                    <option value="2">Credit Card</option>
                                    <option value="3">Cheque</option>
                                    <option value="4">Bank Deposit</option>
                                    
                                  </select>
                          </td>
                        </tr>
                        @endforeach
                    @endif
                          <tr>
                            <td style="text-align:right;">Total</td>
                            <td style="text-align:right;">{{number_format($balanceTotal - $withHolding,2)}}</td>

                          </tr>
                    </tbody>
               </table>
               
               <input type="hidden" id="numbersonly"/>
               <input type="hidden" value="{{$transactionId}}" name="transID"/>
              <input type="submit" id="" style="float:right;" value="Save Payments" class="btn btn-blue btn-embossed"/>
              </form>
              <div class="row vertical-align">
           
              <div class="col-md-12">
                  <h3><strong>Payments for this Booking</strong></h3>
                  <div class="panel">
                  <div class="panel-content">
                    <table id="downpayment-table" class="table table-bordered">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Paid Thru</th>
                        <th>Notes</th>
                        <th>Received by:</th>
                       
                     
                      </tr>
                    </thead>
                    <tbody>

                    @if($downpayments)
                        @foreach($downpayments as $dp)
                        <tr>
                          <td>{{date("n/d/Y",strtotime($dp->created_at))}}</td>
                          <td>{{number_format($dp->amount,2)}}</td>
                          <td style="word-wrap: break-word;width:20px;">{{$dp->paidThru}}</td>
                          @if($dp->roomReservationId == 0)
                          <td>{{$dp->notes}}</td>
                          @else
                            @foreach($rooms as $r)
                              @if($r->reserveid == $dp->roomReservationId)
                            <td>{{$dp->notes.' - '.$r->roomName.' ('.$r->roomType.')'}}</td>
                              @endif
                            @endforeach
                          @endif
                          <td>{{$dp->firstName.' '.$dp->lastName}}</td>
                         
                        </tr>
                        @endforeach
                    @endif
                    </tbody>
               </table>
                  </div>
                  </div>
              </div>
              </div>
             


                


                </div>
                  
                  
           
                <div class="modal-footer bg-dark">
              
                  <button type="button" id="" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     
                  
                </div>
              </div>
            </div>
            
        </div>

        <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-manage-withholdingTax" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header bg-blue">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><strong>Withholding Tax</strong></h4>
                 
                </div>
                <div class="modal-body p-40">
                    
                    
                <label>Amount:</label>
                
                <input type="text" id="withHoldingTax" class="form-control" value="@if($code){{round($transaction->withHoldingTax,2)}}@endif"/>

                </div>
                  
                  
           
                <div class="modal-footer bg-dark">
                  <button type="button" id="addWithHoldingTax" class="btn btn-embossed btn-success" data-dismiss="modal">SAVE</button>
                  <button type="button" id="" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     
                  
                </div>
              </div>
            </div>
            
        </div>


                 <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-blocked-occ" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header bg-red">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
              <h4 class="modal-title"><strong>ROOM <span id="occ-room-name"></span></strong></h4>
            </div>
            <div class="modal-body" id="modal-occ-content">
              <div class="row">
                      <div class="col-sm-12">
                        <h3><strong>GUEST/S IN THIS ROOM</strong></h3>
                            <div class="row">
                              <div class="col-sm-12">
                                <hr/>
                                <div class="form-group">
                                    <div class="icheck-list" id="checked-in-guests">               
                                  </div>
                                </div>
                              </div>
                            </div>

                        <div class="row">
                          <div class="col-sm-12">
                            <h3><strong>CHARGES</strong></h3>
                            <hr/>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>O.S Slip No.:</label>
                              <input type="text" id="occ-os" name="occ-os" class="form-control" minlength="3" width="200px" placeholder="Enter O.S slip..." required>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Item</label>
                              <input type="text" id="occ-item" name="occ-item" class="form-control" minlength="3" placeholder="Enter item...">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Price</label>
                              <input type="text" id="occ-price" name="occ-price" class="form-control" minlength="3" placeholder="Enter Price">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Less Discount</label>
                              <input type="text" id="occ-less" name="occ-less" class="form-control" minlength="3" placeholder="Enter Discount" value="0.00">
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <label>Type</label>
                                <select id="occ-type" name="occ-type" class="form-control">
                                  <option value="1" selected="">Food and Beverage</option>
                                  <option value="2">Room Service</option>
                                  <option value="3">Mini-Bar</option>
                                  <option value="4">Shuttle Service</option>
                                  <option value="5">Send Bill</option>                              
                                </select>
                            </div>
                          </div>
                        </div>

                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Entry Type</label>
                                  <label class = "form-control">
                                    <input type='radio' id='occ-accountType' name='occ-accountType' class="form-control occ-accountType" value="1" checked data-radio='iradio_minimal-blue'>Charge 
                                  </label>
                                  <label  class="form-control">
                                    <input type='radio' id='occ-accountType' name='occ-accountType' class="form-control occ-accountType" value="2" data-radio='iradio_minimal-blue'>Paid
                                  </label>
                              </div>
                          </div>

                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Charge Type</label>
                                  <label class = "form-control">
                                    <input type='radio' id='occ-chargeType' name='occ-chargeType' class="occ-chargeType form-control" value="1" checked data-radio='iradio_minimal-blue'>Cash 
                                  </label>
                                  <label class ="form-control">
                                    <input type='radio' id='occ-chargeType' name='occ-chargeType' class="occ-chargeType form-control" value="2" data-radio='iradio_minimal-blue'>Credit Card
                                  </label>
                            </div>
                          </div>

                        </div>

                        

                        <div class="row">
                          <div class="col-sm-12">
                            <div class="form-group">
                              <button id="add-charge-occ" class="btn btn-primary btn-transparent btn-lg">Add Charge</button>
                            </div>
                          </div>
                        </div>


                    </div>
                    
                        
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <h3><strong>ROOM CHARGES LIST:</strong></h3>
                        <hr/>
                        <table id="occ-charges-table" class="table table-bordered">
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
                    </div>
                </div>
                <div class="modal-footer bg-gray-light">
                 <button type="button" id="modal-occ-close" class="btn btn-default btn-embossed">Close</button>
                </div>
              </div>
            </div>
            
          </div>
        </div>
    <meta name="_token" content="{!! csrf_token() !!}" />
<script src="{{url('assets/jquery/jquery-1.12.4.js')}}"></script>
<script src="{{url('assets/jquery/jquery-ui-1.12.1/jquery-ui.js')}}"></script>

<script type="text/javascript">
//     $(document).ready(function(){
//         $(".modal-blocked-occ").click(function(){
     
                  
            
//             var roomId = $(this).attr("value");
        
//                var dateSelected = {
                
//                   dateMain:  $("#date-main-hidden").val(),
                
//             };
            
//             var url = "{{route('frontdesk.modalBlockedOcc',['id' =>':id'])}}";
//             var url2 = url.replace(":id",roomId);
            
//              $.ajax({
//                    type:"GET",
//                    url: url2,
//                    data: dateSelected,
                   
//                    success: function (data){
                      
                       
                       
//                           var amountTotal = 0;
//                     var paymentsTotal = 0;
//                     var balance = 0;
                       
//                         for(var j=0;j<data.charges.length;j++){
                   
                             
//                             var cd = new Date(data.charges[j]["chargeCreated"]);
                        
//                         var chargePrice = numeral(data.charges[j]["price"]).format('0,0.00');
                        
//                         var chargeday = cd.getDate();
//                         var chargemonth = cd.getMonth() + 1;
//                         var chargeyear = cd.getFullYear();
                        
//                         if(data.charges[j]["account_type"]==1){
//                             $('#charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td class="text-right">&#8369; '+chargePrice+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</tr>');
                            
//                             amountTotal+=data.charges[j]["price"];
//                         }
                        
                        
//                         if(data.charges[j]["account_type"]==2){
//                             $('#charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</td><td class="text-right">&#8369; '+chargePrice+'</tr>');
                            
//                             amountTotal+=data.charges[j]["price"];
//                             paymentsTotal+=data.charges[j]["price"];
//                         }
                             
//                        }
                       
//                          balance = amountTotal - paymentsTotal;
// //                    
//                     amountTotal = numeral(amountTotal).format('0,0.00');
//                     paymentsTotal = numeral(paymentsTotal).format('0,0.00');
//                     balance = numeral(balance).format('0,0.00');
                    
//                      $('#charges-table > tbody:last-child').append('<tr><td colspan="2" class="text-right">Total</td><td></td><td></td><td class="text-right">&#8369; '+amountTotal+'</td></tr><tr><td colspan="2" class="text-right">Payments</td><td></td><td class="text-right">&#8369; '+paymentsTotal+'</td><td></td></tr><tr><td colspan="2" class="text-right">Balance/Amount Payable</td><td></td><td></td><td class="text-right c-red f-20"><strong>&#8369; '+balance+'</strong></td></tr>');
                   
//                    }
                   
                          
//                });
//         });
//     });
    
    //CLOSE BLOCKED-OCC
    document.getElementById('numbersonly').addEventListener('keydown', function(e) {
    var key   = e.keyCode ? e.keyCode : e.which;
    
    if (!( [8, 9, 13, 27, 46, 110, 190].indexOf(key) !== -1 ||
         (key == 65 && ( e.ctrlKey || e.metaKey  ) ) || 
         (key >= 35 && key <= 40) ||
         (key >= 48 && key <= 57 && !(e.shiftKey || e.altKey)) ||
         (key >= 96 && key <= 105)
       )) e.preventDefault();

    });




    $(document).ready(function(){
        $("#numbersonly").keydown(function(){
            var num = $(this).val();

            $("#test").val(num - (num*0.1));
        });
    });


    $(document).ready(function(){
      $("#guest-idfront-btn").click(function(){


          var guestId ={
                  id:$(this).val(),
                };


          $.ajax({
                 type:"POST",
                 url: "{{route('frontdesk.retrieveIdFront')}}",
                 data: guestId,
                 headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                 success: function (datas){
                  //alert(datas);
                      //var rawData = btoa(unescape(encodeURIComponent(datas)));
                      var imagePath = "{{ url('frontdesk/guest-id-front') }}/"+datas;
                      $("#previewImage").attr("src",imagePath);
                     
                      //document.getElementById('previewImage').setAttribute( 'src', 'data:image/jpeg;base64,'+rawData );
                 }
             });
      });


      $("#addWithHoldingTax").click(function(){


          var info ={
                  transID:$("#transWithHolding").val(),
                  amount: $("#withHoldingTax").val(),
                };


          $.ajax({
                 type:"POST",
                 url: "{{route('frontdesk.saveWithHoldingTax')}}",
                 data: info,
                 headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                 success: function (datas){
                  //alert(datas);
                      //var rawData = btoa(unescape(encodeURIComponent(datas)));
                      $("#withHoldingTax").val(datas);
                     console.log(datas);
                      //document.getElementById('previewImage').setAttribute( 'src', 'data:image/jpeg;base64,'+rawData );
                 }
             });
      });
    });


    $(document).ready(function(){
      $("#guest-idback-btn").click(function(){


          var guestId ={
                  id:$(this).val(),
                };


          $.ajax({
                 type:"POST",
                 url: "{{route('frontdesk.retrieveIdBack')}}",
                 data: guestId,
                 headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                 success: function (datas){
                  //alert(datas);
                      //var rawData = btoa(unescape(encodeURIComponent(datas)));
                      var imagePath = "{{ url('frontdesk/guest-id-back') }}/"+datas;
                      $("#previewImage").attr("src",imagePath);
                     
                      //document.getElementById('previewImage').setAttribute( 'src', 'data:image/jpeg;base64,'+rawData );
                 }
             });
      });
    });

        $(document).ready(function(){
        $("#compute").click(function(){
          $("#totalRate").val($("#occ-hidden-rate").val()*$("#days-counter").val()); 
        });
    });
    //ADD CHARGE BLOCKED-OCC
     $(document).ready(function(){
        
         
        
        $("#add-charge-occ").click(function(){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

            
     //       var roomID = $(this).val();
      //      var to = $("#room-status-select").val();
                 
            var url = "{{route('frontdesk.addCharges')}}";
           
            var chargeDetails = {
                  guest: $('input[name=occ-guest-radio]:checked').val(),
                  os: $("#occ-os").val(),
                  item: $("#occ-item").val(),
                  accType: $("input[name=occ-accountType]:checked").val(),
                  price: $("#occ-price").val(),
                  less: $("#occ-less").val(),
                  type: $("#occ-type").val(),
                  chargeType: $("#occ-chargeType").val(),
                  
                  
                
            };
        
    
               $.ajax({
                   type:"POST",
                   url: url,
                   data: chargeDetails,
                   
                   success: function (data){
                       console.log(data);
                       
                       $("#occ-guest-radio").prop("checked",false);
                       $("#occ-os").val('');
                       $("#occ-item").val('');
                       $("#occ-accountType").prop("checked",false);
                       $("#occ-price").val('');
                       $("#occ-type").prop("selected",false);
                       location.reload();
                       
              
                   }
                   
                          
               });
      
                
        });
        
        
    });


       $(document).ready(function(){
          $("#modal-occ-close").click(function(){
                       $("#checked-in-guests").empty();
                        $('#charges-table > tbody:last-child').empty();
                        location.reload();
          });
      });

      $(document).ready(function(){
          $("#res-close").click(function(){
              $("#res-guest-details").empty();
              $("#res-room-details").empty();
          });
      });


    $(document).ready(function(){
        $("#exit-change-status").click(function(){
            location.reload();
        });
    });
    //GET ROOM DETAILS
    $(document).ready(function(){
        $("#view-transaction").click(function(){
           
            var transID = $(this).val();
        
              $.get("../frontdesk/transaction-summary/"+transID,function(data){
                  $("#res-reservId").html(data.transaction["code"]);


                  for(var i=0;i<data.guests.length;i++){
                    $("#res-guest-details > tbody:last-child").append('<tr><td>'+data.guests[i]["firstName"].toUpperCase()+" "+data.guests[i]["familyName"].toUpperCase()+'</td><td>'+data.guests[i]["contactNo"]+'</td><td>'+data.guests[i]["roomName"]+'</td></tr>');

                  }

                  for(var i=0;i<data.rooms.length;i++){

                    if(data.rooms[i]["discountType"]==1)
                      $("#res-room-details > tbody:last-child").append('<tr><td>'+data.rooms[i]["roomName"]+'</td><td>'+data.rooms[i]["roomType"]+'</td><td>'+numeral(data.rooms[i]["FinalRoomRate"]).format('0,0.00')+' ('+data.rooms[i]["discountName"].toUpperCase()+' '+data.rooms[i]["discountValue"]*100+'%)</td></tr>');

                    else if(data.rooms[i]["discountType"]==2)
                      $("#res-room-details > tbody:last-child").append('<tr><td>'+data.rooms[i]["roomName"]+'</td><td>'+data.rooms[i]["roomType"]+'</td><td>'+numeral(data.rooms[i]["FinalRoomRate"]).format('0,0.00')+' ('+data.rooms[i]["discountName"].toUpperCase()+' Less: '+data.rooms[i]["discountValue"]+')</td></tr>');

                  }

                  $("#res-booking-person").html(data.transaction["clientName"].toUpperCase());

                  $("#res-bookingP-contact").html(data.transaction["clientContact"].toUpperCase());

                  $("#res-bookingP-title").html(data.transaction["title"].toUpperCase());
                  $("#res-institution").html(data.transaction["instiName"].toUpperCase());
                  $("#res-insti-address").html(data.transaction["instiAddress"].toUpperCase());
                  $("#res-insti-type").html(data.transaction["accountType"].toUpperCase());

                  var arr = new Date(data.transaction["arrivalDate"]);
                  var arrdate = arr.getDate();
                  var arrmonth = arr.getMonth() + 1; //Months are zero based
                  var arryear = arr.getFullYear();

                  $("#res-arrival").html(arrmonth+"/"+arrdate+"/"+arryear);

                  var dep = new Date(data.transaction["depatureDate"]);
                  var depdate = dep.getDate();
                  var depmonth = dep.getMonth() + 1; //Months are zero based
                  var depyear = dep.getFullYear();

                  $("#res-depart").html(depmonth+"/"+depdate+"/"+depyear);

                  $("#res-checkin").html(data.transaction["checkInTime"]+" PM");
                  $("#res-checkout").html(data.transaction["checkOutTime"]+" PM");
                  $("#res-madethru").html(data.transaction["madeThru"]);

                  $("#res-guaranteed").html(data.transaction["guaranteed"]);
                  $("#res-notes").html(data.transaction["notes"]);

                  $("#res-billArrange").html(data.transaction["billingType"]+" - "+data.transaction["chargeType"]);
                 
          
            });
        });
        
    });
    //END GET ROOM DETAILS
    
    //EDIT GUEST ACCOUNT DETAILS
    $(document).ready(function(){
        
      $("#room-register-close").click(function(){
            $("#reserved-guest").empty();
        });
        
    });

    $(document).ready(function(){
        
      $("#downpayment-close").click(function(){
            $("#downpayment-amount").val('');
            $("#downpayment-paidThru").val(1).change();
            $("#downpayment-notes").val('');

            location.reload();
        });
        
    });
    //END EDIT GUEST ACCOUNT DETAILS
    
     $(document).ready(function(){
      $("#save-checkoutTime").click(function(e){
        var id = $(this).attr('value');



        var guestDetails = {
          rrID:  id,
          checkOutTime : $("#roomcheckOutTime").val(),
          checkInTime : $("#roomCheckInTime").val(),
          arrivalDate: $("#roomarrivalDate").val(),
          departureDate: $("#roomdepartureDate").val(),
          finalRoomRate: $("#roomFinalRoomRate").val(),
          finalRoomType: $("#roomFinalRoomType").val(),
          discountId: $("#roomDiscount").val(),

        };
        



        $.ajax({
         type:"POST",
         url: "{{route('frontdesk.updateCheckOutTime')}}",
         data: guestDetails,
         headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
         success: function (datas){
          console.log(datas);
          location.reload();
        }
      });
      });

    });
    
    //GUEST ACCOUNT DETAILS CLOSE
    $(document).ready(function(){
        $(".guest-edit-close").click(function(){

            $("#previewImage").attr("src","");

            $("#file-idfront").removeClass("fileinput-exists").addClass("fileinput-new");
                  
            $("#idfront-filename").html("");

            $("#file-idback").removeClass("fileinput-exists").addClass("fileinput-new");
                  
            $("#idback-filename").html("");
           
        });
    })
    //END GUEST ACCOUNT DETAILS CLOSE
    

    $(document).ready(function(){
        $("#add-room-close").click(function(){
            
          //  $("#room-total-charge").html('');
        });
    });
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
                  guestScan: $("#guest-scan-reg").val(),
                  id:  guestID,
                
            };
        
    
               $.ajax({
                   type:"POST",
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
       "scrollY":        "400px",
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
                   return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-guest-edit" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button data-toggle="modal" data-target="" class="btn btn-sm btn-blue folio-modal" data-id="3" value="'+valueHere+'">View Folio</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-guest" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li></ul>';
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
       "scrollY":        "400px",
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
              location.reload();
       }); 


    });


    $(document).ready(function(){
       $("#confirm-remove-room").click(function(){
           var roomReservID = $(this).val();
           
           $.get("../frontdesk/confirm-remove-room/"+roomReservID,function(data){
                console.log(data);                   
            });
           
           var transactionID = $("#transID").val();

              $('#guests-table').DataTable({
        processing: true,
        serverSide: false,
       "scrollY":        "400px",
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
           
               $('#rooms-table').DataTable({
        processing: true,
        serverSide: false,
       "scrollY":        "400px",
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
                    return '<span class="label label-success">Checked In</span>';
                 else if(status==2)
                    return '<span class="label label-danger">Checked Out</span>';
                 else if(status==3)
                    return '<span class="label label-dark">No Show</span>';
                 else
                     return '<span class="label label-warning">Not Checked In</span>';
             }
            },
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                  var valueHere=data.id;
                   return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-room-register" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-room" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li><li><button type="button" data-id="4" data-toggle="modal" data-target="#modal-blocked-occ" value="'+valueHere+'" class="btn btn-sm btn-warning modal-blocked-occ">Add Charge</button></li></ul>';
            }
        }
        ]
    });

 location.reload();
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
                  folioNos: $('#guestfolio-numbers').val(),
                  id:  guestReservID,
                
            };
        
    
               $.ajax({
                   type:"POST",
                   url: "../frontdesk/guest-register-update/"+guestReservID,
                   data: guestDetails,
                   
                   success: function (data){
                       console.log(data);
                        $("#guest-modal-body-register").fadeOut(300, function(){
                            $("#guest-modal-body-register").fadeIn().delay(3000);
                            $("#guestReservationId").html(data.guestReservID);
                            $("#guestfolio-numbers").val(data.folioNos);
                            $("#assigned-room").html(data.room);
                        });

                        location.reload();
                                     
                   }
                   
                          
               });
            
             $('#guests-table').DataTable({
                  processing: true,
                  serverSide: false,
                  "scrollY":        "400px",
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
                             return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-guest-edit" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button data-toggle="modal" data-target="" class="btn btn-sm btn-blue folio-modal" data-id="3" value="'+valueHere+'">View Folio</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-guest" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li></ul>';
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


      
    });

     $(document).ready(function(){
      $("#edit-reservation-notes").click(function(e){
          $("#save-reservation-notes").removeAttr("disabled");
          $("#reservation-notes-area").removeAttr("disabled");
          $("#reservation-notes-area").focus();

          $("#edit-reservation-notes").attr("disabled","disabled");
      });
     });



     $(document).ready(function(){
      $("#save-reservation-notes").click(function(e){

          var transID = $(this).val();

          var noteDetails = {
            transID: transID,
            notes: $("#reservation-notes-area").val(),
          }

          $("#edit-reservation-notes").removeAttr("disabled");
          
           $.ajax({
                   type:"POST",
                   url: "{{route('frontdesk.saveReservationNotes')}}",
                   data: noteDetails,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (datas){
                      console.log(datas);

                   }
          });

          $("#reservation-notes-area").attr("disabled","disabled");
          $("#save-reservation-notes").attr("disabled","disabled");
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


      
    });

     $(document).ready(function(){
        $(".check-out-guest").click(function(e){
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
                   url: "{{route('frontdesk.checkOutGuest')}}",
                   data: roomReserve,
                   
                   success: function (data){
                       console.log(data);
                       location.reload();
                   
                    
                   }
               });
      
        


        });
        
        
     });


     $(document).ready(function(){
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
                        location.reload();
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
       "scrollY":        "400px",
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
                    return '<span class="label label-success">Checked In</span>';
                 else if(status==2)
                    return '<span class="label label-danger">Checked Out</span>';
                 else if(status==3)
                    return '<span class="label label-dark">No Show</span>';
                 else
                     return '<span class="label label-warning">Not Checked In</span>';
             }
            },
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                  var valueHere=data.id;
                   return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-room-register" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-room" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li><li><button type="button" data-id="4" data-toggle="modal" data-target="#modal-blocked-occ" value="'+valueHere+'" class="btn btn-sm btn-warning">Add Charge</button></li></ul>';
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
                    var chargesTotal = 0;
                    var totalBalance = 0;
                    
                
                    var totalBalance = 0;
                    
                 
                    
                     var string = numeral(data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"])).format('0,0.00');
                    
                    var rateDiscount = string+" ("+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]*100+"%)";
                    
                    
                    
                      var roomRate = data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"]);
                   
                    
                         for(var i=0;i<data.amendments.length;i++){
                      
                                var arr2 = new Date(data.amendments[i]["amendDate"]);
                                var arrdate2 = arr2.getDate();
                            var arrmonth2 = arr2.getMonth() + 1; //Months are zero based
                            var arryear2 = arr2.getFullYear();

                              var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
             //       var firstDate = new Date(2008,01,12);
             //       var secondDate = new Date(2008,01,22);
                             var amendArriv = new Date(data.amendments[i]["amendArriv"]);
                             var amendDepart = new Date(data.amendments[i]["amendDepart"]);
                            

                            var diffDays2 = Math.round(Math.abs((amendDepart.getTime() - amendArriv.getTime())/(oneDay)));
                    
                               
                                  var roomRate2 = data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"]);
                          var rateDiscount2 = numeral(data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"])).format('0,0.00')+" ("+data.amendments[i]['discountNameAmend']+" "+data.amendments[i]["discountValueAmend"]*100+"%)";
                            var totalRoomRate2 = roomRate2 * data.amendments[i]["amendDays"];
                            var stringTotalRoomRate2 = numeral(totalRoomRate2).format('0,0.00');

                            if(data.amendments[i]["FinalRoomRate"] != 0){

                              if(data.amendments[i]["discountType"]==1){
                                  $('#charges-table > tbody:last-child').append('<tr><td>'+arrmonth2+"/"+arrdate2+"/"+arryear2+'</td><td>ROOM: '+data.amendments[i]["amendRoomName"]+' - '+data.amendments[i]["amendRoomType"]+' ('+diffDays2+') days -- Rate:'+numeral(data.amendments[i]["FinalRoomRate"]).format('0,0.00')+' ('+data.amendments[0]["discountValue"]*100+'% - '+data.amendments[i]["discountNameAmend"]+')</td><td class="text-right">&#8369; '+numeral(data.amendments[i]["FinalRoomRate"]).format('0,0.00')+' </td><td class="text-right"></td><td class="text-right">&#8369; '+numeral(data.amendments[i]["FinalRoomRate"]).format('0,0.00')+'</tr>');
                              }

                              if(data.amendments[i]["discountType"]==2){
                                $('#charges-table > tbody:last-child').append('<tr><td>'+arrmonth2+"/"+arrdate2+"/"+arryear2+'</td><td>ROOM: '+data.amendments[i]["amendRoomName"]+' - '+data.amendments[i]["amendRoomType"]+' ('+diffDays2+') days -- Rate:'+numeral(data.amendments[i]["FinalRoomRate"]).format('0,0.00')+' (Less: '+data.guest[0]["discountValue"]+' - '+data.amendments[i][discountNameAmend]+')</td><td class="text-right">&#8369; '+numeral(data.amendments[i]["FinalRoomRate"]).format('0,0.00')+' </td><td class="text-right"></td><td class="text-right">&#8369; '+numeral(data.amendments[i]["FinalRoomRate"]).format('0,0.00')+'</tr>');
                              }
                                  
                            }
                      
                        
                            amountTotal+=data.amendments[i]["FinalRoomRate"]*diffDays2;
                            chargesTotal+=data.amendments[i]["FinalRoomRate"]*diffDays2;          

                            }


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

    $(document).ready(function(){
        $('#downpayment-submit').click(function(e){
            var id = $(this).attr('value');


            var downpaymentInfo = {
                downAmount:$("#downpayment-amount").val(),
                downPaidThru:$('#downpayment-paidThru').val(),
                roomAssigned:$('#roomAssigned').val(),
                downNotes:$('#downpayment-notes').val(),
                transId: id
            };

                
              
              $.ajax({
                   type:"POST",
                   url: "{{route('frontdesk.makeDownpayment')}}",
                   data: downpaymentInfo,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (data){
                    console.log(data);

                      location.reload();

                      // var dpdate = new Date(data.created_at);

                      //   var dpday = dpdate.getDate();
                      //   var dpmonth = dpdate.getMonth() + 1;
                      //   var dpyear = dpdate.getFullYear();

                      //   if(data.paidThru == 1)
                      //     var paidThru= "Cash";
                      //   if(data.paidThru == 2)
                      //     var paidThru = "Credit Card";
                      //   if(data.paidThru == 3)
                      //     var paidThru = "Cheque";

                      //   if(data.roomReservationId == 0){
                      //      $('#downpayment-table > tbody:last-child').append('<tr><td>'+dpmonth+'/'+dpday+'/'+dpyear+'</td><td>'+data.amount+'</td><td>'+paidThru+'</td><td>'+data.notes+'</td><td>'+$("#logInUserFullName").val()+'</td></tr>');
                      //   }
                      //   else
                      //     $('#downpayment-table > tbody:last-child').append('<tr><td>'+dpmonth+'/'+dpday+'/'+dpyear+'</td><td>'+data.amount+'</td><td>'+paidThru+'</td><td>'+data.notes+' - '+data.roomName+' ('+data.roomType+')</td><td>'+$("#logInUserFullName").val()+'</td></tr>');

                      
                   }
               });
        });
      });
  
     $(document).ready(function(){
         
        
        $("#add-room").click(function(){
            var dates1 = { arrival: $('#arrival2').val(),
                  departure: $('#departure2').val(),
                };
            
            
           $.get('{{route("frontdesk.checkRoomAvailability")}}',function(data){
               $.ajax({
                   type:"GET",
                   url: "{{route('frontdesk.checkRoomAvailability')}}",
                   data: dates1,
                   
                   success: function (data){
                       console.log(data);
                       
                       for(i=1;i<=41;i++){
                           var id = "#room"+i;
                           if($.inArray(i,data) > -1)                          
                             $(id).hide(); 
                           else
                              
                             $(id).show();
                             
                       }
                       
                   }
                  
               });
           }); 
            
        });
    });
    

       $(document).ready(function(){
         
        
        $("#checkAvail").click(function(){
            var dates1 = { arrival: $('#arrival2').val(),
                  departure: $('#departure2').val(),
                };
            
            
           $.get('{{route("frontdesk.checkRoomAvailability")}}',function(data){
               $.ajax({
                   type:"GET",
                   url: "{{route('frontdesk.checkRoomAvailability')}}",
                   data: dates1,
                   
                   success: function (data){
                       console.log(data);
                       
                       for(i=1;i<=41;i++){
                           var id = "#room"+i;
                           if($.inArray(i,data.results) > -1)                          
                             $(id).hide(); 
                           else
                              
                             $(id).show();
                             
                       }
                       
                   }
                  
               });
           }); 
            
        });
    });

         $(document).ready(function(){
         
        
        $("#checkAvail2").click(function(){
            var dates1 = { arrival: $('#arrival21').val(),
                  departure: $('#departure21').val(),
                };
            
            
           $.get('{{route("frontdesk.checkRoomAvailability")}}',function(data){
               $.ajax({
                   type:"GET",
                   url: "{{route('frontdesk.checkRoomAvailability')}}",
                   data: dates1,
                   
                   success: function (data){
                       console.log(data);
                       
                       for(i=1;i<=41;i++){
                           var id = "#roomC"+i;
                           if($.inArray(i,data.results) > -1)                          
                             $(id).hide(); 
                           else
                              
                             $(id).show();
                             
                       }
                       
                   }
                  
               });
           }); 
            
        });
    });



$(document).ready(function(){
      $('input[type="checkbox"]').on('ifChecked', function(event){
        var roomId = $(this).val();

        
        $(".roomsArray").val(roomId);

              $.get("../frontdesk/get-room-details-byroomid/"+roomId,function(data){
                    console.log(data);

                    var selectStart = '<select class="form-control" name="discountType'+data.room[0]['id']+'" onchange="selectDiscount(this)" value="'+data.room[0]['id']+'" data-style="white">';

                    for(var i = 0 ; i<data.discounts.length;i++){
                      if(data.discounts[i]['status'] == 1){

                          if(data.discounts[i]['type'] == 1)
                            selectStart+='<option value="'+data.discounts[i]['id']+'">'+data.discounts[i]['discountName']+' ('+data.discounts[i]['discountValue'] * 100+'%)</option>';

                          if(data.discounts[i]['type'] == 2)
                            selectStart+='<option value="'+data.discounts[i]['id']+'">'+data.discounts[i]['discountName']+' (Less '+data.discounts[i]['discountValue']+')</option>';


                      }
                      
                    }

                    var discountDropdown = selectStart+"</select>";
                      


                     $('#room-reserv-table > tbody:last-child').append('<tr id="row'+data.room[0]['id']+'"><td>'+data.room[0]['roomName']+'</td><td>'+data.room[0]['roomType']+'</td><td id="rate'+data.room[0]['id']+'">'+numeral(data.room[0]['room_rate']).format('0,0.00')+'</td><td>'+discountDropdown+'</td><td id="totalRate'+data.room[0]['id']+'">'+numeral(data.room[0]['room_rate']).format('0,0.00')+'</td></tr>');

                       var roomTotal = parseFloat(numeral($("#room-total-charge").html()).format('0.00'));

                      $("#room-total-charge").html(numeral(roomTotal+ data.room[0]['room_rate']).format('0,0.00'));


        });
      });
   
    });


$(document).ready(function(){

    $('.change-status').click(function(){
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
          });

        
          var roomReserve = {
                  tID: $("#transID").val(),
                  status: $(this).val(),
              };
        
    
               $.ajax({
                   type:"POST",
                   url: "{{route('frontdesk.changeTransactionStatus')}}",
                   data: roomReserve,
                   
                   success: function (data){
                       console.log(data);
                       location.reload();
                           
                       }
                   
               });
    });
});


$(document).ready(function(){
      $('input[type="checkbox"]').on('ifUnchecked', function(event){
        var roomId = $(this).val();
        var totalRate = parseFloat(numeral($("#totalRate"+roomId).html()).format('0.00'));
        var roomTotal = parseFloat(numeral($("#room-total-charge").html()).format('0.00'));
        $("#room-total-charge").html(numeral(roomTotal-totalRate).format('0,0.00')); 
                  
                  $('table#room-reserv-table tr#row'+roomId).remove();
       
      });
   
    });

function selectDiscount(x){
  var rateCell = 'rate'+x.getAttribute("value");
  var rateCellFloat = parseFloat(numeral($("#"+rateCell).html()).format('0.00'));
 
  var roomTotal = parseFloat(numeral($("#room-total-charge").html()).format('0.00'));

  var roomTotalRate = 0;


  $.get("../frontdesk/get-discount/"+x.value,function(data){

    if(data.discounts[0]["type"]==2){
      $("#totalRate"+x.getAttribute("value")).html(numeral(rateCellFloat-data.discounts[0]['discountValue']).format('0,0.00'));
      
    }
    
    if(data.discounts[0]["type"]==1){
      $("#totalRate"+x.getAttribute("value")).html(numeral(rateCellFloat-(rateCellFloat*data.discounts[0]['discountValue'])).format('0,0.00'));
    }
    
    

    $("#room-reserv-table tr").each(function () {
    var totalDiscountRate = parseFloat(numeral($('td:last-child', this).html()).format('0.00'));

    roomTotalRate+=totalDiscountRate;


    });

    $("#room-total-charge").html(numeral(roomTotalRate).format('0,0.00'));

  });
}


$(document).ready(function(){

  $("#btn-manager-delete").click(function(){
    var managerCheck = {
      username: $("#delete-man-username").val(),
      password: $("#delete-man-password").val(),
    };

       $.ajax({
                   type:"POST",
                   url: "{{route('frontdesk.managerCheck')}}",
                   data: managerCheck,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (data){
                       if(data == 1){
                        $("#manager-access").hide(800);
                        $("#delete-info-body").show(1000);
                        $("#delete-info-footer").show(1000);
                       }
                       console.log(data)

                       
                   }
                   
                          
               });

  }); 
});

    $(document).ready(function(){
        
        
        $(".guest-room-edit-save").click(function(){
            
            var guestID = $(this).val();
           var valuesChecked= $('input[name=roomIdc]:checked').val();
            
            var guestDetails = {
                  guestSRRID: $("#guestSRRID").val(),
                
                  chargeRoom:$("#chargeRoom").val(),
                  roomId: valuesChecked,
                  notes: $("#amendnotes").val(),
                };
                
              
               $.ajax({
                   type:"POST",
                   url: "../frontdesk/room-Reservation-update/"+$("#guestSRRID").val(),
                   data: guestDetails,
                   headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') },
                   success: function (data){
                       console.log(data);
                       location.reload();
                       
                   }
                   
                          
               });

              
              
      //location.reload();
                
        });
        
        
    });

    $(document).ready(function(){
        $("#check-in-all-rooms").click(function(){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

            var transactionID = $("#transID").val(); 
        
            
            var roomReserve = {
                  transactionID: transactionID,  
            };
        
    
               $.ajax({
                   type:"PUT",
                   url: "{{route('frontdesk.checkInAllGuest')}}",
                   data: roomReserve,
                   
                   success: function (data){
                       console.log(data);
                       
                           location.reload();
                       }
                   
               });
      
   

    //         $('#active-table').DataTable({
    //     processing: true,
    //     serverSide: false,
    //     "scrollY":        "200px",
    //     "scrollCollapse": true,
    //     "ordering": false,
    //        "bLengthChange": false,
    //         "bDestroy": true,
    //     ajax: "{!! route('frontdesk.dataTablesActiveReservationList') !!}",
    //     columns: [
    //         { data: 'clientName', name: 'clientName' },
    //         { data: 'institutionName', name: 'institutionName' },
    //         { data: 'institutionType', name: 'institutionType' },
    //         { data: 'code', name: 'code' },
    //         { data: 'arrivalDate', name: 'arrivalDate' },
    //         { data: 'depatureDate' , name: 'depatureDate'},
    //         { "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var status=data.status;
                  
                 
    //             if(status==0)
    //                 return '<span class="label label-success">On Going</span>';
    //             else if(status==1)
    //                  return '<span class="label label-danger">Billed</span>';
    //             else if(status==2)
    //                  return '<span class="label label-dark">No Show</span>';
    //             else if(status==3)
    //                  return '<span class="label label-blue">House Use</span>';

    //         }
    //         },
    //         {
    //           "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var valueHere=data.code;
    //                  return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
    //           }
    //         }
    //     ],
        
    // });

    //         $('#gua-table').DataTable({
    //     processing: true,
    //     serverSide: false,
    //     "scrollY":        "200px",
    //     "scrollCollapse": true,
    //     "ordering": false,
    //        "bLengthChange": false,
    //         "bDestroy": true,
    //     ajax: "{!! route('frontdesk.dataTablesGuaranteedReservationList') !!}",
    //     columns: [
    //         { data: 'clientName', name: 'clientName' },
    //         { data: 'institutionName', name: 'institutionName' },
    //         { data: 'institutionType', name: 'institutionType' },
    //         { data: 'code', name: 'code' },
    //         { data: 'arrivalDate', name: 'arrivalDate' },
    //         { data: 'depatureDate' , name: 'depatureDate'},
    //         { "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var status=data.status;
                  
                 
    //             if(status==0)
    //                 return '<span class="label label-success">On Going</span>';
    //             else if(status==1)
    //                  return '<span class="label label-danger">Billed</span>';
    //             else if(status==2)
    //                  return '<span class="label label-dark">No Show</span>';
    //             else if(status==3)
    //                  return '<span class="label label-blue">House Use</span>';

    //         }
    //         },
    //         {
    //           "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var valueHere=data.code;
    //                  return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
    //           }
    //         }
       
    //     ],
        
    // });

    //          $('#check-table').DataTable({
    //     processing: true,
    //     serverSide: false,
    //     "scrollY":        "300px",
    //     "scrollCollapse": true,
    //     "ordering": false,
    //        "bLengthChange": false,
    //          "bDestroy": true,
    //     ajax: "{!! route('frontdesk.dataTablesStayingReservationList') !!}",
    //     columns: [
    //         { data: 'clientName', name: 'clientName' },
    //         { data: 'institutionName', name: 'institutionName' },
    //         { data: 'institutionType', name: 'institutionType' },
    //         { data: 'code', name: 'code' },
    //         { data: 'arrivalDate', name: 'arrivalDate' },
    //         { data: 'depatureDate' , name: 'depatureDate'},
    //            { "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var status=data.status;
                  
                 
    //             if(status==0)
    //                 return '<span class="label label-success">On Going</span>';
    //             else if(status==1)
    //                  return '<span class="label label-danger">Billed</span>';
    //             else if(status==2)
    //                  return '<span class="label label-dark">No Show</span>';
    //             else if(status==3)
    //                  return '<span class="label label-blue">House Use</span>';

    //         }
    //         },
    //         {
    //           "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var valueHere=data.code;
    //                  return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
    //           }
    //         }
       
    //     ],
        
    // });

    //                $('#checkOut-table').DataTable({
    //     processing: true,
    //     serverSide: false,
    //     "scrollY":        "300px",
    //     "scrollCollapse": true,
    //     "ordering": false,
    //        "bLengthChange": false,
    //          "bDestroy": true,
    //     ajax: "{!! route('frontdesk.dataTablesCheckedOutList') !!}",
    //     columns: [
    //         { data: 'clientName', name: 'clientName' },
    //         { data: 'institutionName', name: 'institutionName' },
    //         { data: 'institutionType', name: 'institutionType' },
    //         { data: 'code', name: 'code' },
    //         { data: 'arrivalDate', name: 'arrivalDate' },
    //         { data: 'depatureDate' , name: 'depatureDate'},
    //            { "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var status=data.status;
                  
                 
    //             if(status==0)
    //                 return '<span class="label label-success">On Going</span>';
    //             else if(status==1)
    //                  return '<span class="label label-danger">Billed</span>';
    //             else if(status==100)
    //                  return '<span class="label label-danger">Fully Paid</span>';
    //             else if(status==1000)
    //                  return '<span class="label label-danger">Partial</span>';
    //             else if(status==2)
    //                  return '<span class="label label-dark">No Show</span>';
    //             else if(status==3)
    //                  return '<span class="label label-blue">House Use</span>';

    //         }
    //         },
    //         {
    //           "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var valueHere=data.code;
    //                  return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
    //           }
    //         }
       
    //     ],
        
    // });
        });
  
});

     $(document).ready(function(){
         $("#check-out-all-rooms").click(function(){
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

            var transactionID = $("#transID").val(); 
        
            
            var roomReserve = {
                  transactionID: transactionID,  
            };
        
    
               $.ajax({
                   type:"PUT",
                   url: "{{route('frontdesk.checkOutAllRooms')}}",
                   data: roomReserve,
                   
                   success: function (data){
                       console.log(data);

                        location.reload();
                       }
                   
               });
      
            $('#rooms-table').DataTable({
        processing: true,
        serverSide: false,
       "scrollY":        "400px",
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
                    return '<span class="label label-success">Checked In</span>';
                 else if(status==2)
                    return '<span class="label label-danger">Checked Out</span>';
                 else if(status==3)
                    return '<span class="label label-dark">No Show</span>';
                 else
                     return '<span class="label label-warning">Not Checked In</span>';
             }
            },
            {
            "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
                  var valueHere=data.id;
                   return '<ul style="list-style: none;"><li><button type="button" data-id="1" data-toggle="modal" data-target="#modal-room-register" class="btn btn-sm btn-default edit-modal" id="edit-modal" onlick="buttonAppear()" value="'+valueHere+'">Manage</button></li><li><button type="button" data-id="2" data-toggle="modal" data-target="#modal-remove-room" value="'+valueHere+'" class="btn btn-sm btn-danger">Remove</button></li><li><button type="button" data-id="4" data-toggle="modal" data-target="#modal-blocked-occ" value="'+valueHere+'" class="btn btn-sm btn-warning">Add Charge</button></li></ul>';
            }
        }
        ]
    });

    //           $('#active-table').DataTable({
    //     processing: true,
    //     serverSide: false,
    //     "scrollY":        "200px",
    //     "scrollCollapse": true,
    //     "ordering": false,
    //        "bLengthChange": false,
    //         "bDestroy": true,
    //     ajax: "{!! route('frontdesk.dataTablesActiveReservationList') !!}",
    //     columns: [
    //         { data: 'clientName', name: 'clientName' },
    //         { data: 'institutionName', name: 'institutionName' },
    //         { data: 'institutionType', name: 'institutionType' },
    //         { data: 'code', name: 'code' },
    //         { data: 'arrivalDate', name: 'arrivalDate' },
    //         { data: 'depatureDate' , name: 'depatureDate'},
    //         { "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var status=data.status;
                  
                 
    //             if(status==0)
    //                 return '<span class="label label-success">On Going</span>';
    //             else if(status==1)
    //                  return '<span class="label label-danger">Billed</span>';
    //             else if(status==2)
    //                  return '<span class="label label-dark">No Show</span>';
    //             else if(status==3)
    //                  return '<span class="label label-blue">House Use</span>';

    //         }
    //         },
    //         {
    //           "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var valueHere=data.code;
    //                  return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
    //           }
    //         }
    //     ],
        
    // });

    //         $('#gua-table').DataTable({
    //     processing: true,
    //     serverSide: false,
    //     "scrollY":        "200px",
    //     "scrollCollapse": true,
    //     "ordering": false,
    //        "bLengthChange": false,
    //         "bDestroy": true,
    //     ajax: "{!! route('frontdesk.dataTablesGuaranteedReservationList') !!}",
    //     columns: [
    //         { data: 'clientName', name: 'clientName' },
    //         { data: 'institutionName', name: 'institutionName' },
    //         { data: 'institutionType', name: 'institutionType' },
    //         { data: 'code', name: 'code' },
    //         { data: 'arrivalDate', name: 'arrivalDate' },
    //         { data: 'depatureDate' , name: 'depatureDate'},
    //         { "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var status=data.status;
                  
                 
    //             if(status==0)
    //                 return '<span class="label label-success">On Going</span>';
    //             else if(status==1)
    //                  return '<span class="label label-danger">Billed</span>';
    //             else if(status==2)
    //                  return '<span class="label label-dark">No Show</span>';
    //             else if(status==3)
    //                  return '<span class="label label-blue">House Use</span>';

    //         }
    //         },
    //         {
    //           "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var valueHere=data.code;
    //                  return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
    //           }
    //         }
       
    //     ],
        
    // });
    //              $('#check-table').DataTable({
    //     processing: true,
    //     serverSide: false,
    //     "scrollY":        "300px",
    //     "scrollCollapse": true,
    //     "ordering": false,
    //        "bLengthChange": false,
    //          "bDestroy": true,
    //     ajax: "{!! route('frontdesk.dataTablesStayingReservationList') !!}",
    //     columns: [
    //         { data: 'clientName', name: 'clientName' },
    //         { data: 'institutionName', name: 'institutionName' },
    //         { data: 'institutionType', name: 'institutionType' },
    //         { data: 'code', name: 'code' },
    //         { data: 'arrivalDate', name: 'arrivalDate' },
    //         { data: 'depatureDate' , name: 'depatureDate'},
    //            { "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var status=data.status;
                  
                 
    //             if(status==0)
    //                 return '<span class="label label-success">On Going</span>';
    //             else if(status==1)
    //                  return '<span class="label label-danger">Billed</span>';
    //             else if(status==2)
    //                  return '<span class="label label-dark">No Show</span>';
    //             else if(status==3)
    //                  return '<span class="label label-blue">House Use</span>';

    //         }
    //         },
    //         {
    //           "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var valueHere=data.code;
    //                  return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
    //           }
    //         }
       
    //     ],
        
    // });

    //           $('#checkOut-table').DataTable({
    //     processing: true,
    //     serverSide: false,
    //     "scrollY":        "300px",
    //     "scrollCollapse": true,
    //     "ordering": false,
    //        "bLengthChange": false,
    //          "bDestroy": true,
    //     ajax: "{!! route('frontdesk.dataTablesCheckedOutList') !!}",
    //     columns: [
    //         { data: 'clientName', name: 'clientName' },
    //         { data: 'institutionName', name: 'institutionName' },
    //         { data: 'institutionType', name: 'institutionType' },
    //         { data: 'code', name: 'code' },
    //         { data: 'arrivalDate', name: 'arrivalDate' },
    //         { data: 'depatureDate' , name: 'depatureDate'},
    //            { "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var status=data.status;
                  
                 
    //             if(status==0)
    //                 return '<span class="label label-success">On Going</span>';
    //             else if(status==1)
    //                  return '<span class="label label-danger">Billed</span>';
    //             else if(status==100)
    //                  return '<span class="label label-danger">Fully Paid</span>';
    //             else if(status==1000)
    //                  return '<span class="label label-danger">Partial</span>';
    //             else if(status==2)
    //                  return '<span class="label label-dark">No Show</span>';
    //             else if(status==3)
    //                  return '<span class="label label-blue">House Use</span>';

    //         }
    //         },
    //         {
    //           "className":      'options',
    //           "data":           null,
    //           "render": function(data, type, full, meta){
    //                 var valueHere=data.code;
    //                  return '<form method="GET" action="../frontdesk/guest-registration"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
    //           }
    //         }
       
    //     ],
        
    // });

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