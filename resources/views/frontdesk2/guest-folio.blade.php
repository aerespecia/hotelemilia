@extends('layouts.frontdeskLayout')



@section('content') 

<script>
           
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML= document.getElementById(divId).innerHTML;
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();
            }
</script>

<div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar" style="background-color:white;">
          <div class="header-left">
            <div class="topnav">
            
              <ul class="nav nav-tabs no-border">
                <li><a href="{{route('frontdesk.index')}}"><i class="fa fa-calendar-o"></i><span>ROOMS</span></a></li>
                <li><a href="{{route('frontdesk.reservation')}}"><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
               <li class="nav-active"><a href="{{route('frontdesk.guestRegistration')}}"><i class="fa fa-users"></i><span>Guest Registration</span></a></li>
                   <li class="nav-active active"><a href=""><i class="icon-note"></i><span>Guest Folio</span></a></li>
                  <li><a href="{{route('frontdesk.nightAudit')}}"><i class="icon-note"></i><span>Night Audit</span></a></li>
                   <li><a href="{{route('frontdesk.amendments')}}"><i class="icon-note"></i><span>Amendments</span></a></li>
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

              <h1 class="text-center"><strong>GUEST</strong> FOLIO</h1>
              
          <hr class="m-b-0"/>
          </div>
           
      <div class="row">
              <div class="col-md-8">
                          <div class="panel">
              
                    <div class="panel-content">
                      <ul class="nav nav-tabs">
                        <li id="active" class="tabsLi active"><a href="#tab1_1" data-toggle="tab">Active Reservations</a></li>
                        <li id="guar" class="tabsLi"><a href="#tab1_2" data-toggle="tab">Guaranteed Reservations</a></li>
                        <li id="staying" class="tabsLi"><a href="#tab1_3" data-toggle="tab">Checked In Reservations</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane tabsPane fade active in" id="tab1_1">
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
        "scrollY":        "400px",
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
                     return '<form method="GET" action="../frontdesk/guest-folio"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
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
        "scrollY":        "400px",
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
                     return '<form method="GET" action="../frontdesk/guest-folio"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
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
                     return '<form method="GET" action="../frontdesk/guest-folio"><input type="hidden" name="reservID" value="'+valueHere+'"/><button type="submit" class="btn-sm btn-default btn-transparent">Select</button></form>';
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
                      </div>
                    </div>
                  </div>
                </div>
            <div class="col-md-4">
                    <div class="panel">
                     <div class="panel-header bg-dark">
                  <h4><strong>RESERVATION </strong>LOOK UP</h4>
             
                </div>
           <div class="panel-content">
                    <h3><strong>SEARCH:</strong></h3>           
  
                 
                            <div class="form-group">
                              <h5>RESERVATION ID:</h5>
                                         
                                {!! Form::open(['method'=>'GET','action'=>'FrontDeskController@guestFolio']) !!}
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
 
            <h2><strong>RESERVATION ID: </strong>{{$code}}</h2>
            <div class="row">
                <div class="col-md-12">
                
                
                      <div class="panel" id="">
                        <div class="panel-header bg-green">
                            <h4><i class="fa fa-users"></i> <strong>GUEST FOLIO</strong></h4>  
                                                        
                        </div>
                        <div class="panel-content p-t-0">
                       
            
             <h3 class="f-18 p-t-0"><strong>ROOM LIST</strong></h3>
                          
                            <div class="panel panel-transparent m-t-0" id="room-list">
                
                <div class="panel-content" style="height:200px;overflow-y:scroll;">
                  <table class="table table-hover f-14" id="">
                    <thead>
                      <tr>
                        <th>Room No.</th>
                        <th>Guests</th>
                        <th>Status</th>
                        <th>Action</th>
                        
                       
                      </tr>
                    </thead>
                        @if($rooms)
                    <tbody>
                        @foreach($bookedRooms as $r)
                        <tr>
                            <td>{{$r}}</td>
                           
                            
                            <td>
                                <strong>
                                    
                                <ul>
                                    @foreach($rooms as $rm)
                                    
                             
                                    
                                @if($rm->roomName==$r and $rm->guest_status!=3)
                                    <li>{{$rm->firstName." ".$rm->lastName}} <button data-toggle="modal" data-target="#modal-guest-folio" class="btn btn-sm btn-success btn-transparent folio-modal" value="{{$rm->gReservId}}">View Folio</button></a></li>
                                    
                                      @endif
                                    @endforeach
                                </ul>
                                
                                   
                                </strong>
                            </td>
                            <td>
                                 <?php $rmTemp2=0; ?>
                                @foreach($rooms as $rm)
                                @if($rm->roomName==$r and $rm->reserveid!=$rmTemp2)
                                
                                @if($rm->guest_status==2)
                                    <p id="{{'check-in-status'.$rm->reserveid}}">Checked In</p>
                                @elseif($rm->guest_status==4)
                                  <span class="label label-danger f-12">Checked Out</span>
                                @else
                                   <span class="label-danger"> <p id="{{'check-in-status'.$rm->reserveid}}">Not yet Checked In</p></span>
                                @endif
                                
                                <?php $rmTemp2 = $rm->reserveid; ?>
                                @endif
                                @endforeach
                            </td>
                            <td>
                                 <?php $rmTemp=0; ?>
                                @foreach($rooms as $rm)
                                @if($rm->roomName==$r and $rm->reserveid!=$rmTemp)
                                <input type="hidden" name="roomReserveId" id="roomReserveId" class="check-in-guest" value="{{$rm->reserveid}}"/>
                                
                                
                                @if($rm->guest_status != 3)
                                <button data-toggle="modal" data-target="#modal-room-bill" class="btn btn-sm btn-blue room-modal" value="{{$rm->reserveid}}">View Bill</button>
                                {!! Form::open(['method'=>'PUT','action'=>'FrontDeskController@checkOut']) !!}
                                <input type="hidden" value="{{$rm->reserveid}}" name="reserveId"/>
                                <input type="hidden" value="{{$code}}" name="reservID"/>
                                <button class="btn btn-sm btn-danger room-modal" value="{{$rm->reserveid}}">Check Out</button>
                                {!! Form::close() !!}
                                @endif
                                
                                <?php $rmTemp = $rm->reserveid; ?>
                                @endif
                                @endforeach
                                
                            </td>
                         
                        </tr>
                               
                       @endforeach
                    </tbody>
                      @else
                         No Guest/s Found
                        @endif
                  </table>
                </div>
              </div>
                            
                            
                        </div>
                    </div>
                </div>
          
            </div>
            <div class="row">
                        <div class="col-md-12">
                
                <div class="panel">
                    <div class="panel-header">
                            <h4><i class="fa fa-users"></i> <strong>RESERVATION SUMMARY</strong></h4>
                        
                           
                            
                           
                </div>
                <div class="panel-content">
        
   
   
                    
              <div class="row">
               
                    <div class="col-md-12">
                   <button class="btn btn-sm btn-primary bill-statement" data-toggle="modal" value="{{$transactionId}}" data-target="#modal-bill-statement">Billing Statement</button>
                 
                    
                   <button id="reservation-summary" class="btn btn-sm btn-primary" value="{{$transactionId}}" data-toggle="modal" data-target="#modal-reservation-detail">View Details</button>
                 
                  </div>
                            </div>
                    
                </div>
                </div>
            </div> 
</div>

    
            
        

        
        <!--- GUEST REGISTRATION MODAL ENDS -->
       <!--- PRINT REGISTRATION MODAL -->    
       <!--- PRINT MODAL -->
          
        
            <!--- GUEST FOLIO VIEW MODAL BEGINS -->    
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
<!--- GUEST FOLIO VIEW MODA ENDS -->

 <!--- ROOM BILL VIEW MODAL BEGINS -->    
       <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-room-bill" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-blue">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><strong>ROOM: <span id="room-title-name"></span> - <span id="room-title-type"></span></strong></h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>ROOM BILL: <span id="room-title2-name"></span> - <span id="room-title2-type"></span></strong></h2><hr/>
                    </div>
                 
               
                    <div class="row">
                        <div class="col-md-6">
                           
                            
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Date: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong>{{date('F j, Y')}}</strong></p>
                                    </div>
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Reservation ID:</p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-modal-reservID"></span></strong></p>
                                    </div>
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Guest Name/s: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-modal-guests"></span>
                                          </strong></p>
                                    </div>
                                    
                                    <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Charge to: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-modal-institution"></span></strong></p>
                                    </div>
                                    
                              
                          
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Room rate: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong>&#8369; <span id="room-modal-rate"></span></strong></p>
                            </div>
                            <div class="row">
                                    <p class="col-md-6 f-12 m-t-0 m-b-0">Room Type: </p>
                                    <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-modal-roomType"</strong></p>
                            </div>
                            <div class="row">
                                        <p class="col-md-6 f-12 m-t-0 m-b-0">Arrival date: </p>
                                        <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-modal-arrival"></span></strong></p>
                            </div>
                            <div class="row">
                                    <p class="col-md-6 f-12 m-t-0 m-b-0">Departure date: </p>
                                    <p class="col-md-6 f-12 m-t-0 m-b-0"><strong><span id="room-modal-depart"</strong></p>
                            </div>
                         
                            </div>
                       
                        </div>
                    </div>
                    
                  
                    <div class="p-20">
                 <div class="row">
                <div class="col-md-12">
                
                  <table id="room-charges-table" class="table table-bordered">
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
                  <button type="button" id="room-close" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     <a id="room-bill-print" type="button" class="btn btn-white btn-embossed"><i class="fa fa-print"></i> PRINT</a>
                
                </div>
              </div>
            </div>
      
            
        </div>
<!--- GUEST FOLIO VIEW MODA ENDS -->

            
  <!--- GUEST FOLIO EDIT MODAL BEGINS -->    
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
<!-- GUEST FOLIO EDIT END --->
        <!-- END PAGE CONTENT -->
           
<div class="modal fade" id="modal-reservation-detail" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Reservation</strong> form</h4>
                 
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
                   
                    
                
                    
                    
                    
                </div>
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal">Close</button>
                  <a type="button" href="{{route('frontdesk.printPreviewReservation',['id'=>$transactionId])}}" class="btn btn-primary btn-embossed"><i class="fa fa-print"></i> Print</a>
                      <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
                </div>
              </div>
            </div>
         

      </div>

 </div>   

<meta name="_token" content="{!! csrf_token() !!}" />
<script src="{{url('assets/jquery/jquery-1.12.4.js')}}"></script>
<script src="{{url('assets/jquery/jquery-ui-1.12.1/jquery-ui.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        
        $(".folio-modal").click(function(){
            var guestReservID = $(this).val();
            
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
        });
        
        
    });
    
    $(document).ready(function(){
        $("#folio-close").click(function(){
       
                    $('#charges-table > tbody:last-child').empty();
                    
        });
    });
    

    
      $(document).ready(function(){
        $("#room-close").click(function(){
       
                    $('#room-charges-table > tbody:last-child').empty();
                    
        });
    });
    
          $(document).ready(function(){
        $("#bill-close").click(function(){
       
                    $('#bill-charges-table > tbody:last-child').empty();
                    
        });
    });
    
    $(document).ready(function(){
        $(".room-modal").click(function(){
            var roomReservID = $(this).val();
            
         $("#room-bill-print").attr('href','../frontdesk/print-preview-roombill/'+roomReservID);
            
                $.get("../frontdesk/room-bill-view/"+roomReservID,function(data){
                    console.log(data);
                    
           //         for(var i=0; i<data.length;i++)
                 $("#room-title-name").html(data.guest[0]["roomName"]);
                 $("#room-title-type").html(data.guest[0]["roomType"]);
                $("#room-title2-name").html(data.guest[0]["roomName"]);
                 $("#room-title2-type").html(data.guest[0]["roomType"]);
                $("#room-modal-reservID").html(data.guest[0]["code"]);
                    var roomRate = numeral(data.guest[0]["rate"]).format('0,0.00');
                    
//                $("#room-modal-rate").html(roomRate);
                $("#room-modal-institution").html(data.guest[0]["instiName"]);
                $("#room-modal-roomType").html(data.guest[0]["roomType"]);
               
                $("#room-modal-depart").html(data.guest[0]["depatureDate"]);
                  
                 var arr = new Date(data.guest[0]["arrivalDate"]);
                    var arrdate = arr.getDate();
                    var arrmonth = arr.getMonth() + 1; 
                    var arryear = arr.getFullYear();
                    
                $("#room-modal-arrival").html(arrmonth+"/"+arrdate+"/"+arryear);
                    
                    var dep = new Date(data.guest[0]["depatureDate"]);
                    var depdate = dep.getDate();
                    var depmonth = dep.getMonth() + 1; 
                    var depyear = dep.getFullYear();

                $("#room-modal-depart").html(depmonth+"/"+depdate+"/"+depyear);
                
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
                    
                $("#room-modal-guests").html(guestNames);
                
                     var amountTotal = 0;
                    var paymentsTotal = 0;
                    var totalBalance = 0;
                    
                 
                    
                     var string = numeral(data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"])).format('0,0.00');
                    
                    var rateDiscount = string+" ("+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]*100+"%)";
                    
                    
                    $("#room-modal-rate").html(string+" ("+data.guest[0]["discountName"]+" "+data.guest[0]["discountValue"]*100+"%)");
                    
                      var roomRate = data.guest[0]["rate"]-(data.guest[0]["rate"]*data.guest[0]["discountValue"]);
                   
                    
                    //Show Ammendments
//                    
//                      var chargesList = [];
//                    
//                for(var j=0;j<data.length;j++){
//                    
//                    if(chargesList.indexOf(data[j]["amendId"])== -1){
//                      
//                       chargesList.push(data[j]["amendId"]);
//                    }
//                  }
//                
//                    var test = [];
//                   
//                    var tempArray = [];
                    
                    for(var i=0;i<data.amendments.length;i++){
                                 
                    var arr2 = new Date(data.amendments[i]["amendDate"]);
                    var arrdate2 = arr2.getDate();
                    var arrmonth2 = arr2.getMonth() + 1; //Months are zero based
                    var arryear2 = arr2.getFullYear();
                               
                                  var roomRate2 = data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"]);
                          var rateDiscount2 = numeral(data.amendments[i]["amendRate"]-(data.amendments[i]["amendRate"]*data.amendments[i]["discountValueAmend"])).format('0,0.00')+" ("+data.amendments[i]['discountNameAmend']+" "+data.amendments[i]["discountValueAmend"]*100+"%)";
                            var totalRoomRate2 = roomRate2 * data.amendments[i]["amendDays"];
                            var stringTotalRoomRate2 = numeral(totalRoomRate2).format('0,0.00');

                            $('#room-charges-table > tbody:last-child').append('<tr><td>'+arrmonth2+"/"+arrdate2+"/"+arryear2+'</td><td></td><<td>ROOM: '+data.amendments[i]["amendRoomName"]+' - '+data.amendments[i]["amendRoomType"]+' ('+data.amendments[i]["amendDays"]+') days -- Rate:'+rateDiscount2+'</td><td class="text-right">&#8369; '+stringTotalRoomRate2+'</td><td class="text-right">&#8369; '+stringTotalRoomRate2+'<td class="text-right"></td></tr>');
                        
                            amountTotal+=totalRoomRate2;
                            paymentsTotal+=totalRoomRate2;
                           
                           
                           
                           }
                        
                    
                    var totalRoomRate = roomRate * data.guest[0]["noOfDays"];
                    var stringTotalRoomRate = numeral(totalRoomRate).format('0,0.00');
                    
                    
                    
                    $('#room-charges-table > tbody:last-child').append('<tr><td>'+arrmonth+"/"+arrdate+"/"+arryear+'</td><td></td><td>ROOM: '+data.guest[0]["roomName"]+' - '+data.guest[0]["roomType"]+' ('+data.guest[0]["noOfDays"]+') days -- Rate:'+rateDiscount+'</td><td class="text-right">&#8369; '+stringTotalRoomRate+'</td><td class="text-right">&#8369; '+stringTotalRoomRate+'<td></td></tr>');
                    
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
           
                            $('#room-charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>'+data.charges[i]["os_id"]+'</td><td>'+data.charges[i]["item_name"]+'</td><td class="text-right">&#8369; '+numeral(amount).format('0,0.00')+'</td><td class="text-right"></td><td class="text-right">&#8369; '+numeral(balance).format('0,0.00')+'</td></tr>');
     
                        }
                        
                        
                        if(data.charges[i]["account_type"]==2){
                            var payment = data.charges[i]["price"];
                            var amount = data.charges[i]["price"];
                            var balance = amount - payment;
                            totalBalance+=balance;
                            amountTotal+=amount;
                            paymentsTotal+=payment;
                            
                            $('#room-charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>'+data.charges[i]["os_id"]+'</td><td>'+data.charges[i]["item_name"]+'</td><td class="text-right">&#8369; '+numeral(amount).format('0,0.00')+'</td><td class="text-right">&#8369; '+numeral(payment).format('0,0.00')+' </td><td class="text-right">&#8369; '+numeral(balance).format('0,0.00')+'</td></tr>');
                            
                         
                        }
           
                        
                        
                    }
                    
                 
                    
                    
                    totalBalance = numeral(totalBalance).format('0,0.00');
                    
                    amountTotal = numeral(amountTotal).format('0,0.00');
                    paymentsTotal = numeral(paymentsTotal).format('0,0.00');
                    
                      $('#room-charges-table > tbody:last-child').append('<tr style="border-top: 2px solid;"><td colspan="3" class="text-right">TOTALS:</td><td class="text-right">&#8369; '+amountTotal+'</td><td class="text-right">'+paymentsTotal+'</td><td class="text-right">'+totalBalance+'</td></tr>');
           
              
               
                         
                });
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
       $("#reservation-summary").click(function(){
            var transID = $(this).val();
        
                $.get("../frontdesk/reservation-details/"+transID,function(data){
                    console.log(data);
                    
                    $("#res-reservId").html(data[0]["code"]);
                    $("#res-booking-person").html(data[0]["clientFirstName"].toUpperCase()+" "+data[0]["clientLastName"].toUpperCase());
                    $("#res-bookingP-contact").html(data[0]["clientContact"]);
                    $("#res-bookingP-title").html(data[0]["clientTitle"].toUpperCase());
                    $("#res-institution").html(data[0]["instiName"].toUpperCase());
                    $("#res-insti-type").html(data[0]["accountType"].toUpperCase());
                    $("#res-insti-address").html(data[0]["instiAddress"].toUpperCase());
                    
                     var arr = new Date(data[0]["arrivalDate"]);
                    var arrdate = arr.getDate();
                    var arrmonth = arr.getMonth() + 1; 
                    var arryear = arr.getFullYear();
                    
                $("#res-arrival").html(arrmonth+"/"+arrdate+"/"+arryear);
                    
                    var dep = new Date(data[0]["depatureDate"]);
                    var depdate = dep.getDate();
                    var depmonth = dep.getMonth() + 1; 
                    var depyear = dep.getFullYear();

                $("#res-depart").html(depmonth+"/"+depdate+"/"+depyear);
                
                $("#res-checkin").html(data[0]["checkInTime"]);
                $("#res-checkout").html(data[0]["checkOutTime"]);
                    
                
                 var roomNos = [];
                    
                for(var k=0;k<data.length;k++){
                    
                    if(roomNos.indexOf(data[k]["roomNo"])== -1){
                        $('#res-room-details > tbody:last-child').append('<tr><td>'+data[k]["roomNo"]+'</td><td>'+data[k]["roomType"]+'</td><td>'+data[k]["rate"]+'</td></tr>');
                        
                       roomNos.push(data[k]["roomNo"]);
                        
                       
                    }
       
                }
                    
                            
                 var account_ids = [];
                    
                for(var j=0;j<data.length;j++){
                    
                    if(account_ids.indexOf(data[j]["account_id"])== -1){
                        $('#res-guest-details > tbody:last-child').append('<tr><td>'+data[j]["account_id"]+'</td><td>'+data[j]["firstName"]+' '+data[j]["familyName"]+'</td><td>'+data[j]["contactNo"]+'</td></tr>');
                        
                       account_ids.push(data[j]["account_id"]);
                        
                       
                    }
                    
                        
                  
                }
                    
                    
                });
           
           
       }); 
    });
</script>

<script type="text/javascript">
    function PrintElem(elem)
    {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(elem).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<script>
            
            printDivCSS = new String ('<link href="../assets/global/css/print.css" rel="stylesheet" type="text/css">');
            function printDiv(divId) {
                window.frames["print_frame"].document.body.innerHTML=printDivCSS + document.getElementById(divId).innerHTML;
                window.frames["print_frame"].window.focus();
                window.frames["print_frame"].window.print();
            }
</script>

@endsection