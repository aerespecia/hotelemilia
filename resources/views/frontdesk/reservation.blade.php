@extends('layouts.frontdeskLayout')



@section('content')



<div class="main-content">
  <!-- BEGIN TOPBAR -->
  <div class="topbar" style="background-color:white;">
    <div class="header-left">
      <div class="topnav">
 
        <ul class="nav nav-tabs no-border">
          <li><a href="{{route('frontdesk.index')}}"><i class="fa fa-calendar-o"></i><span>Rooms</span></a></li>
          <li class="nav-active active"><a href="{{route('frontdesk.reservation')}}"><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
          <li><a href="{{route('frontdesk.guestRegistration')}}"><i class="fa fa-users"></i><span>Bookings</span></a></li>

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
            <img src="{{url('assets/global/images/avatars/user1.png')}}" alt="user image">
            <!-- Calling $user as defined in reservation function in FrontDeskController -->
            <span class="username">Hi, {{$user->name}}</span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a href="#"><i class="icon-user"></i><span>My Profile</span></a>
            </li>
            <li>
              <a href="#"><i class="icon-calendar"></i><span>My Calendar</span></a>
            </li>
            <li>
              <a href="#"><i class="icon-settings"></i><span>Account Settings</span></a>
            </li>
            <li>
              <a href="#"><i class="icon-logout"></i><span>Logout</span></a>
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
  <div class="page-content">


    <div class="btn-group">
      <a class="btn btn-white active"><i class="fa fa-plus"></i>New Reservation</a>
      <a type="button" class="btn btn-white" href="{{route('frontdesk.reservationList')}}"><i class="fa fa-list"></i>Reservation List</a>

    </div>           <div class="header">

      <h2>New <strong>Reservation</strong></h2>
      <hr class="m-b-0"/>
    </div>
    <div class="row">
      <div class="col-lg-12">


        <div class="wizard-div current wizard-simple">

          {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@storeProceed','name'=>'formregis','id'=>'FrontDeskController','class'=>'wizard','data-style'=>'simple']) !!}
          <fieldset class="withScroll show-scroll">
  <legend>Rooms and Guests</legend>
  <div class="panel">
    <div class="panel-header">
      <h4><strong>Room Availability</strong></h4>
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label class="form-label">Arrival and Departure</label>
            <div class="input-daterange b-datepicker input-group" id="datepicker">
              <input type="text" class="input-sm form-control" id="arrival2" name="arrivalDate" placeholder="Arrival" autocomplete="off" onchange="autoRoomAvailabilityFilter()"/>
              <span class="input-group-addon">to</span>
              <input type="text" class="input-sm form-control" id="departure2" name="departureDate" placeholder="Departure" autocomplete="off" onchange="autoRoomAvailabilityFilter()"/>
            </div>                                     
          </div>
        </div>
        <div class="col-md-4">

         <a class="btn btn-success btn-transparent panel-reload m-t-20" id="checkAvail">Check Room Availability</a>               
       </div>
     </div>
   </div> 

   <div class="panel-content">


    <hr class="m-t-10"/>
    <div class="row">
      <div class="col-md-6">
        <label>Single De Luxe</label>
        <div class="row">
          <div class="col-sm-12">

            <?php $exist9 = false; ?>
            @foreach($rooms as $r)
            @if($r->type==1)
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
                  @foreach($rooms as $r)
                  @if($r->type == 1)
                  <label class="f-10" id="{{$r->id}}">
                    <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                    @endif
                    @endforeach
                  </div>
                </div>
              </div>                                  
            </div>        
          </div>

          <label>Double De Luxe</label>
          <div class="row">
            <div class="col-sm-12">

              <?php $exist10 = false; ?>
              @foreach($rooms as $r)
              @if($r->type==2)
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
                    @foreach($rooms as $r)
                    @if($r->type == 2)
                    <label class="f-10" id="{{$r->id}}">
                      <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                      @endif
                      @endforeach



                    </div>
                  </div>
                </div>                                  
              </div>        
            </div>

         

              </div>
              <div class="col-md-6">
                <label>Standard Twin</label>
                <div class="row">
                  <div class="col-sm-12">

                    <?php $exist8 = false; ?>
                    @foreach($rooms as $r)
                    @if($r->type==3)
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
                          @foreach($rooms as $r)
                          @if($r->type == 3)
                          <label class="f-10" id="{{$r->id}}">
                            <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                            @endif
                            @endforeach



                          </div>
                        </div>
                      </div>                                  
                    </div>        
                  </div>

          

                    <label>Family Room</label>
                    <div class="row">
                      <div class="col-sm-12">

                        <?php $exist1 = false; ?>
                        @foreach($rooms as $r)
                        @if($r->type==5)
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
                              @foreach($rooms as $r)
                              @if($r->type == 5)
                              <label class="f-10" id="{{$r->id}}">
                                <input type="checkbox" name="roomId[]" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
                                @endif
                                @endforeach 


                              </div>
                            </div>
                          </div>



                        </div>

                      </div>
                 

                        </div>

                      </div>


                      <div class="row">
                        <div class="col-md-12">
                          <h3><strong>Departures on: <span id="depart-date"></span></strong></h3>
                          <hr/>
                          <table id="depart-rooms" class="table table-striped">
                            <thead>
                              <tr>
                                <th>Room No.</th>
                                <th>Room Type.</th>
                                <th>Room Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>
                        </div>
                      </div><br/>

                      <div class="row">
                        <div class="col-md-12">
                          <h3><strong>Arrivals on: <span id="arrival-date"></span></strong></h3>
                          <hr/>
                          <table id="arrival-rooms" class="table table-striped">
                            <thead>
                              <tr>
                                <th>Room No.</th>
                                <th>Room Type.</th>
                                <th>Room Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>
                        </div>
                      </div><br/>


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
                          <div class="panel bg-light">
                            <div class="panel-content">
                              <h3 class="m-t-5"><strong>TOTAL:</strong></h3>
                              <h2>&#8369; <span id="room-total-charge">0.00</span></h2>
                            </div>
                          </div>

                        </div>

                      </div> 


                    </div>     

                  </div>


                  <div class="row">
                    <div class="col-lg-12 portlets">

                      <div class="panel">
                        <div class="panel-header">
                          <h2><strong>Initial Guest Listing</strong></h2>

                        </div>

                        <div class="panel-content" style="min-height:500px;">       
                          <div class="row">
                            <div class="col-md-6">                 

                              <div class="panel-content">
                                <ul  class="nav nav-tabs nav-tabs2">

                                  <li><a href="#tab3_1" data-toggle="tab"><i class="icon-home"></i> Retrieve Guest</a></li>
                                  <li><a href="#tab3_2" data-toggle="tab"><i class="icon-home"></i> New Guest</a></li>
                                </ul>
                                <div class="tab-content">

                                  <div class="tab-pane fade active in" id="tab3_1">
                                    <table id="guestsRecord-table" class="table table-striped">
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

                                              ajax: "{!! route('frontdesk.dataTablesGuestList') !!}",
                                              columns: [
                                              { data: 'name', name: 'name' },
                                              { data: 'contactNo' , name: 'contactNo' },

                                              {
                                                "className":      'options',
                                                "data":           null,
                                                "render": function(data, type, full, meta){
                                                  var valueHere=data.id+'#'+data.name+'#'+data.firstname+'#'+data.lastname+'#'+data.contactNo;
                                                  return '<button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" value="'+valueHere+'">Add</button>';
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
                                      sScrollY: "500px",
                                      sScrollX: "100%",
                                      sScrollXInner: "150%",

                                      bPaginate: false,
                                      columns: [
                                      {
                                        "className":      'options',
                                        "data":           null,
                                        "render": function(data, type, full, meta){
                                          var valueHere=data.id+'#'+data.name+'#'+data.firstname+'#'+data.lastname+'#'+data.contactNo;
                                          return '<input type="checkbox" id="guestNamesListed" name="guestNamesListed[]" value="'+valueHere+'" checked onclick="return false;">';
                                        }
                                      },
                                      { data: 'name'},
                                      { data: 'contactNo'},
                                      {"render": function(data, type, full, meta){

                                        return '<button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal">Remove</button>';
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




              </fieldset>
          <fieldset class="withScroll show-scroll p-l-0 p-r-0">
            <legend>Booking Person/Institution</legend>

            <h3 class="m-t-10"><strong>BOOKING PERSON DETAILS</strong></h3><hr/>
            <div class="row">
             <div class="col-lg-6 p-l-15 p-r-5">
              <div id="clientDiv" class="panel" style="">
                <div class="panel-content">


                 <table id="clients-table" class="table table-hover f-12">
                  <thead>
                    <tr>

                      <th>Name</th>
                      <th>Contact</th>
                      <th>Title</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @push('scripts')
                    <script>
                      $(function() {
                        $('#clients-table').DataTable({
                         processing: true,
                         serverSide: false,
                         "scrollY":        "200px",
                         "scrollCollapse": true,
                         "ordering": false,
                         "bLengthChange": false,
                         ajax: "{!! route('frontdesk.datatablesClients') !!}",
                         columns: [

                         { data: 'name', name: 'name', },
                         { data: 'contactNo' , name: 'contactNo', },
                         { data: 'title', name: 'title', },
                         {
                          "className":      'options',
                          "data":           null,
                          "render": function(data, type, full, meta){
                            var valueHere=data.id;
                            return '<button type="button" class="btn-sm btn-default btn-transparent select-client" id="edit-modal"  value="'+valueHere+'">Select</button>';
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


          <div class="col-lg-6 p-l-5 p-r-15">
            <div class="panel">
              <div class="panel-content">

                <input id="clientID" name="clientID" type="hidden"/>
                <input id="instiID" name="instiID" value="1" type="hidden"/>
                <div class="row">

                  <div class="col-sm-6">

                    <div class="form-group">
                      <label>First Name</label>
                      <div class="append-icon">
                        <input type="text" name="firstName" id="fname" class="form-control" placeholder="Enter firstname..." disabled style="opacity:0.55;" autocomplete="off">
                        <i class="icon-user"></i>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Last Name</label>
                      <div class="append-icon">
                        <input type="text" name="lastName" id="lname" class="form-control" placeholder="Enter Lastname..." disabled style="opacity:0.55;">
                        <i class="icon-user"></i>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Title</label>

                      <input type="text" name="title" id="title" class="form-control" placeholder="Enter Title/Designation..." disabled style="opacity:0.55;" autocomplete="off">

                    </div>
                  </div>
                  <div class="col-sm-6">

                    <div class="form-group">
                      <label>Mobile no.</label>
                      <div class="append-icon">
                        <input type="text" name="contactNo" id="contactNo" class="form-control" placeholder="Enter Contact No." disabled autocomplete="off" style="opacity:0.55;">
                        <i class="fa fa-mobile"></i>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email</label>
                      <div class="append-icon">
                        <input type="text" name="clientEmail" id="clientEmail" class="form-control" placeholder="Enter Email" autocomplete="off" disabled style="opacity:0.55;">

                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">

                  </div>
                  <div class="col-sm-6">

                    <div class="row">
                      <div class="col-sm-4">
                        <a id="newClient" class="btn btn-transparent btn-primary">New</a>
                      </div> 
                      <div class="col-sm-6">
                        <a id="clientExist" class="btn btn-transparent btn-primary" style="opacity:0.5;" disabled>Search Existing</a>
                      </div> 
                    </div>
                  </div>

                </div>      
              </div>
            </div>
          </div>

        </div>

        <h3 class="m-t-5"><strong>INSTITUTION DETAILS</strong></h3><hr/>
        <div class="row">
          <div class="col-lg-6 p-l-15 p-r-5">
            <div id="instiDiv" class="panel">
              <div class="panel-content">
               <table id="institutions-table" class="table table-hover f-12">
                <thead>
                  <tr>

                    <th>Name</th>
                    <th>Type</th>
                    <th>Contact No</th>
                    <th></th>


                  </tr>
                </thead>
                <tbody>
                  @push('scripts')
                  <script>
                    $(function() {
                      $('#institutions-table').DataTable({
                        processing: true,
                        serverSide: false,
                        "scrollY":        "200px",
                        "scrollCollapse": true,
                        "ordering": false,
                        "bLengthChange": false,

                        ajax: "{!! route('frontdesk.datatablesInstitutions') !!}",
                        columns: [

                        { data: 'name', name: 'name', "defaultContent": "" },
                        { data: 'type', name: 'type', "defaultContent": "" },
                        { data: 'contactNo' , name: 'contactNo', "defaultContent": "" },
                        {
                          "className":      'options',
                          "data":           null,
                          "render": function(data, type, full, meta){
                            var valueHere=data.id;
                            return '<button type="button" class="btn-sm btn-default btn-transparent select-institution" id="edit-modal"  value="'+valueHere+'">Select</button>';
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
        <div class="col-lg-6 p-l-5 p-r-15">

          <div class="panel">
            <div class="panel-content">




              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Group Name</label>
                    <div class="append-icon">
                      <input type="text" name="institutionName" id="iName" class="form-control" value="INDIVIDUAL" disabled autocomplete="off" style="opacity:0.55;">
                      <i class="fa fa-building-o"></i>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Type</label>
                    <select id="iType" name="institutionType" class="form-control" disabled>

                      @foreach($accTypes as $acc)
                      <option value="{{$acc->id}}">{{$acc->name}}</option>
                      @endforeach

                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-8">
                  <div class="form-group">
                    <label class="control-label">Address</label>
                    <div class="append-icon">
                      <input type="text" id="iAddress" name="institutionAddress" class="form-control" autocomplete="off" placeholder="Enter Address..." minlength="3" disabled style="opacity:0.55;">
                      <i class="fa fa-map-marker"></i>
                    </div>
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Contact No.</label>
                    <div class="append-icon">
                      <input type="text" id="iContact" name="institutionContactNo" class="form-control" autocomplete="off" placeholder="Enter Contact No." minlength="3" disabled style="opacity:0.55;">
                      <i class="fa fa-mobile"></i>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Email</label>
                    <div class="append-icon">
                      <input type="text" id="instiEmail" name="instiEmail" class="form-control" placeholder="Enter Company Email" autocomplete="off" minlength="3" disabled style="opacity:0.55;">

                    </div>
                  </div>
                </div>
                <div class="col-sm-6">


                </div>

              </div>

              <div class="row">
                <div class="col-sm-6">

                </div>
                <div class="col-sm-6">

                  <div class="row">
                    <div class="col-sm-4">
                      <a id="newInsti" class="btn btn-transparent btn-primary">New</a>
                    </div> 
                    <div class="col-sm-6">
                      <a id="iExist" class="btn btn-transparent btn-primary" style="opacity:0.5;" disabled>Search Existing</a>
                    </div> 
                  </div>
                </div>

              </div>
            </div>    
          </div>
        </div>
      </div>


    </fieldset>
    <fieldset class="withScroll show-scroll">
     <legend>Reservation Information</legend>
     <div class="row">


      <div class="col-lg-12">
        <div class="panel">
          <div class="panel-content">




            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">

                <br>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Estimated Time Arrival</label>
                  <div class="col-sm-4">
                    <div class="prepend-icon">
                      <input type="text" name="checkInTime" class="timepicker form-control" placeholder="Choose a time..." value="02:00 pm">
                      <i class="icon-clock"></i>
                    </div>
                  </div>

                </div>

                <br/><br/>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Estimated Time Departure</label>
                  <div class="col-sm-4">
                    <div class="prepend-icon">
                      <input type="text" name="checkOutTime" class="timepicker form-control" placeholder="Choose a time..." value="12:00 pm">
                      <i class="icon-clock"></i>
                    </div>
                  </div>

                </div>

                <br/><br/>

                <div class="form-group">
                  <label class="col-sm-3 control-label">Made Thru
                  </label>
                  <div class="col-sm-9">
                   <div class="option-group">
                    <select id="madeThru" name="madeThru" style="width:250px;">
                      <option value="1" selected>Walk In</option>
                      <option value="2">Email</option>
                      <option value="3">Phone</option>

                    </select>
                  </div>
                </div><br/><br/>
              </div>


              <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
               <div class="form-group">
                <label class="col-sm-3 control-label">Billing Arrangement:
                </label>
                <div class="col-sm-9">
                 <div class="icheck-inline">     
                   <label class="f-12"><input type="radio" id="billArrange" name="billArrange" data-radio="iradio_minimal-blue" value="1"> Charge to company</label>
                   <label class="f-12"><input id="billArrange" type="radio" name="billArrange" checked data-radio="iradio_minimal-blue" value="2"> Guest Account</label>
                 </div>
               </div>
               <br/><br/>
             </div>

             <div class="form-group">
              <label class="col-sm-3 control-label">Charge Type:
              </label>
              <div class="col-sm-9">
               <div class="icheck-inline">     
                 <label class="f-12"><input type="radio" id="chargeType" name="chargeType" checked data-radio="iradio_minimal-blue" value="1"> Cash</label>
                 <label class="f-12"><input id="chargeType" type="radio" name="chargeType" data-radio="iradio_minimal-blue" value="2"> Debit/Credit Card</label>
                 <label class="f-12"><input id="chargeType" type="radio" name="chargeType" data-radio="iradio_minimal-blue" value="3"> Cheque</label>
               </div>
             </div>
             <br/><br/>
           </div>

           <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
             <div class="form-group">
              <label class="f-11">Billing Arrangements</label>

              <textarea name="billingArrangementsNotes" rows="3" class="form-control" placeholder="Enter Arrangements"></textarea>

            </div>
          </div>
        </div>
      </div>



      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="form-group">
            <label class="col-sm-3 control-label">Reservation Notes
            </label>
            <div class="col-sm-9">
              <textarea name="specialRequest" rows="5" class="form-control" id="specialReq" placeholder="Write Requests..."></textarea>
            </div>


          </div>
        </div>
      </div>

      <br/><br/>


    </div>
  </div> 

</div>
</div>
</div>

</div>


</fieldset>


              <fieldset class="withScroll show-scroll">
                <legend>Confirmation</legend>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel">
                      <div class="panel-content">

                        <h4>Check Registration Summary</h4>
                        <button type="button" id="see-reservation" data-toggle="modal" data-target="#modal-reg" class="btn btn-white">See here</button>
                        <hr>
                        <div class="row">
                          <div class="col-md-12">
                           <h5>Check Reservation lists after making reservation</h5>
                           <button type="submit" class="btn btn-hg btn-primary">Make Reservation</button>
                           {!! Form::close() !!}
                         </div>

                       </div>
                     </div>

                   </div>
                 </div>

                 <noscript>
                  <input class="nocsript-finish-btn sf-right nocsript-sf-btn"
                  name="no-js-clicked" value="finish" disabled/>
                </noscript>
              </div>
            </fieldset>
          </form>
        </div>
      </div>
    </div>

    <!--- START ADD GUEST MODAL -->
    <div class="modal fade" id="modal-select" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content" id="addguest">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
            <h4 class="modal-title"><strong>ADD GUEST</strong> details</h4>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">

                      <div class="prepend-icon" id="guestSearchs">
                        <input type="text" name="guestS" id="guestS" class="form-control sm" placeholder="Search Existing Guest..." minlength="3">
                        <i class="fa fa-search"></i>
                      </div>
                    </div>
                  </div>
                  <input id="guestID" name="guestID" type="hidden" value="0"/>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" id="firstN" name="firstN" class="form-control" minlength="3" placeholder="Enter firstname..." disabled style="opacity:0.55;">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Last Name</label>
                      <input type="text" id="familyName" name="familyName" class="form-control" minlength="3" placeholder="Enter first name..." disabled style="opacity:0.55;">
                    </div>
                  </div>
                </div>
                <div class="row m-t-10">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Contact</label>
                      <input type="text" id="contact" name="contact" class="form-control" minlength="3" placeholder="Enter address..." disabled style="opacity:0.55;">
                    </div>
                  </div>
                  
                </div>
                <div class="row">
                  <div class="col-sm-6">

                  </div>
                  <div class="col-sm-6">

                    <div class="row">
                      <div class="col-sm-4">
                        <a id="newGuest" class="btn btn-transparent btn-primary">New</a>
                      </div> 
                      <div class="col-sm-6">
                        <a id="iGuest" class="btn btn-transparent btn-primary" style="opacity:0.5;" disabled>Search Existing</a>
                      </div> 
                    </div>
                  </div>

                </div>


              </div>
            </div>
          </div>
          <div class="modal-footer bg-gray-light">
            <button onclick="myFunction()" type="button" class="btn btn-primary btn-embossed" data-dismiss="modal"><i class="fa fa-plus"></i> Add</button>
            <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
            
          </div>
        </div>
      </div>
    </div>
    <!--- END ADD GUEST MODAL -->
    <!--- PRINT REGISTRATION MODAL -->    
    <div data-backdrop="static" data-keyboard="false" class="modal fade" id="modal-reg" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
            <h4 class="modal-title"><strong>Reservation</strong> form</h4>

          </div>
          <div id="print-reservation-details" class="modal-body">
            <div class="row">

              <div class="col-md-6">

               <h3 class="m-b-0">RESERVATION ID: <strong><span id="res-reservId">N/A </span></strong></h3>
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

                  <p class="f-12">Account Type: <strong><span id="res-insti-type">fdgf</span></strong></p>

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
    <a type="button" href="" class="btn btn-primary btn-embossed"><i class="fa fa-print"></i> Print</a>
    <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
  </div>
</div>
</div>


</div>    
<!--- PRINT MODAL -->



<div class="footer">
  <div class="copyright">
    <p class="pull-left sm-pull-reset">
      <span>Copyright <span class="copyright">©</span> 2016 </span>
      <span>Hawd Co</span>.
      <span>All rights reserved. </span>
    </p>
    <p class="pull-right sm-pull-reset">
      <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
    </p>
  </div>
</div>


<script src="{{url('assets/jquery/jquery-1.12.4.js')}}"></script>
<script src="{{url('assets/jquery/jquery-ui-1.12.1/jquery-ui.js')}}"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<!-- AUTOCOMPLETE -->
<script>
  $(function() {

    $( "#clientS" ).autocomplete({
      source: "{{route('frontdesk.clientSearch')}}",
      autoFocus:true,
      select:function(e, ui){
        $("#fname").val(ui.item['fname']);
        $("#lname").val(ui.item['lname']);
        $("#contactNo").val(ui.item['contactNo']);
        $("#title").val(ui.item['title']); 
        $("#clientID").val(ui.item['clientID']);

      } 
    });  
  });
</script> 

<script>
  $(function() {
    $( "#insti" ).autocomplete({
      source: "{{route('frontdesk.instiSearch')}}",
      autoFocus:true,
      select:function(e, ui){
        $("#iName").val(ui.item['name']);
        $("#iType").val(ui.item['type']);
        $("#iContact").val(ui.item['contactNo']);
        $("#iAddress").val(ui.item['address']);
        $("#instiID").val(ui.item['instiID']);
      } 
    });  
  });
</script>



<script>
  $(function() {
    $( "#guestS" ).autocomplete({
      source: "{{route('frontdesk.guestSearch')}}",
      autoFocus:true,
      select:function(e, ui){
        $("#firstN").val(ui.item['fname']);
        $("#familyName").val(ui.item['lname']);
        $("#contact").val(ui.item['contactNo']);
        $("#guestID").val(ui.item['guestID']);


      },
      appendTo: "#addguest"
    }); 

  });
</script>







<script>
        //START CLIENT JSCRIPT
        $(function() {
          $( "#newClient" ).click(function(){
            $("#fname").val('');
            $("#lname").val('');
            $("#contactNo").val('');
            $("#title").val('');
            $("#clientEmail").val('');

            $("#clientID").val(0);

            $("#clientDiv").attr('style','pointer-events:none;opacity:0.55;');

            $("#fname").attr('disabled',false);
            $("#lname").attr('disabled',false);
            $("#contactNo").attr('disabled',false);
            $("#title").attr('disabled',false);
            $("#clientEmail").attr('disabled',false);

            $("#fname").attr('style','opacity:1;');
            $("#lname").attr('style','opacity:1;');
            $("#contactNo").attr('style','opacity:1;');
            $("#title").attr('style','opacity:1;');
            $("#clientEmail").attr('style','opacity:1;');

            $("#clientS").attr('style','opacity:0.55;');
            $("#clientS").attr('disabled',true);
            $("#clientS").val('');
            
            $("#newClient").attr('disabled',true);
            $("#newClient").attr('style','opacity:0.55;');

            $("#clientExist").attr('style','opacity:1;');
            $("#clientExist").attr('disabled',false);
          });


        });
        
        $(function(){
          $("#clientExist").click(function(){
            $("#fname").val('');
            $("#lname").val('');
            $("#contactNo").val('');
            $("#title").val('');
            $("#clientEmail").val('');

            $("#clientDiv").attr('style','pointer-events:active;opacity:1;');


            $("#fname").attr('disabled',true);
            $("#lname").attr('disabled',true);
            $("#contactNo").attr('disabled',true);
            $("#title").attr('disabled',true);
            $("#clientEmail").attr('disabled',true);

            $("#fname").attr('style','opacity:0.55;');
            $("#lname").attr('style','opacity:0.55;');
            $("#contactNo").attr('style','opacity:0.55;');
            $("#title").attr('style','opacity:0.55;');
            $("#clientEmail").attr('style','opacity:0.55;');

            $("#clientS").attr('style','opacity:1;');
            $("#clientS").attr('disabled',false);
            $("#clientS").val('');
            
            $("#newClient").attr('disabled',false);
            $("#newClient").attr('style','opacity:1;');

            $("#clientExist").attr('style','opacity:0.55;');
            $("#clientExist").attr('disabled',true);
          });
        });        
        //END CLIENT JSCRIPT

        
        //START INSTI JSCRIPT
        $(function() {
          $( "#newInsti" ).click(function(){
            $("#iName").val('');
         // $("#iType").val(0);
         $("#iAddress").val('');
         $("#iContact").val('');
         $("#instiEmail").val('');
         $("#instiID").val(0);

         $("#instiDiv").attr('style','pointer-events:none;opacity:0.5;');


         $("#iName").attr('disabled',false);
         $("#iType").attr('disabled',false);
         $("#iAddress").attr('disabled',false);
         $("#iContact").attr('disabled',false);
         $("#instiEmail").attr('disabled',false);

         $("#iName").attr('style','opacity:1;');
      //    $("#iType").attr('style','opacity:1;');
      $("#iAddress").attr('style','opacity:1;');
      $("#iContact").attr('style','opacity:1;');
      $("#instiEmail").attr('style','opacity:1;');

      $("#insti").attr('style','opacity:0.55;');
      $("#insti").attr('disabled',true);
      $("#insti").val('');

      $("#newInsti").attr('disabled',true);
      $("#newInsti").attr('style','opacity:0.55;');

      $("#iExist").attr('style','opacity:1;');
      $("#iExist").attr('disabled',false);
    });


        });
        
        $(function(){
          $("#iExist").click(function(){
            $("#iName").val('');
            $("#iType").val('');
            $("#iAddress").val('');
            $("#iContact").val('');
            $("#instiEmail").val('');

            $("#instiDiv").attr('style','pointer-events:active;opacity:1;');


            $("#iName").attr('disabled',true);
            $("#iType").attr('disabled',true);
            $("#iAddress").attr('disabled',true);
            $("#iContact").attr('disabled',true);
            $("#instiEmail").attr('disabled',true);

            $("#iName").attr('style','opacity:0.55;');
               //   $("#iType").attr('style','opacity:0.55;');
               $("#iAddress").attr('style','opacity:0.55;');
               $("#iContact").attr('style','opacity:0.55;');
               $("#instiEmail").attr('style','opacity:0.55;');

               $("#insti").attr('style','opacity:1;');
               $("#insti").attr('disabled',false);
               $("#insti").val('');

               $("#newInsti").attr('disabled',false);
               $("#newInsti").attr('style','opacity:1;');

               $("#iExist").attr('style','opacity:0.55;');
               $("#iExist").attr('disabled',true);
             });
        });       
            //END INSTI JSCRIPT


            //START GUEST JSCRIPT
            $(function() {
              $( "#newGuest" ).click(function(){
                $("#firstN").val('');
                $("#familyName").val('');
                $("#contact").val('');

                $("#firstN").attr('disabled',false);
                $("#familyName").attr('disabled',false);
                $("#contact").attr('disabled',false);

                $("#guestID").val(0);

                $("#firstN").attr('style','opacity:1;');
                $("#familyName").attr('style','opacity:1;');
                $("#contact").attr('style','opacity:1;');

                $("#guestS").attr('style','opacity:0.55;');
                $("#guestS").attr('disabled',true);
                $("#guestS").val('');

                $("#newGuest").attr('disabled',true);
                $("#newGuest").attr('style','opacity:0.55;');

                $("#iGuest").attr('style','opacity:1;');
                $("#iGuest").attr('disabled',false);
              });


            });

            $(function(){
              $("#iGuest").click(function(){
                $("#firstN").val('');
                $("#familyName").val('');
                $("#contact").val('');


                $("#firstN").attr('disabled',true);
                $("#familyName").attr('disabled',true);
                $("#contact").attr('disabled',true);
                

                $("#firstN").attr('style','opacity:0.55;');
                $("#familyName").attr('style','opacity:0.55;');
                $("#contact").attr('style','opacity:0.55;');

                $("#guestS").attr('style','opacity:1;');
                $("#guestS").attr('disabled',false);
                $("#guestS").val('');

                $("#newGuest").attr('disabled',false);
                $("#newGuest").attr('style','opacity:1;');

                $("#iGuest").attr('style','opacity:0.55;');
                $("#iGuest").attr('disabled',true);
              });
            });
        //END GUEST JSCRIPT
      </script>


      <script>
        function myFunction() {

          var first = document.getElementById("firstN").value;
          var last = document.getElementById("familyName").value;
          var phone = document.getElementById("contact").value;
          var id = document.getElementById("guestID").value;


          var table = document.getElementById("guestTable");
          var row = table.insertRow(1);
          var cell1 = row.insertCell(0);
          var cell2 = row.insertCell(1);
          var cell3 = row.insertCell(2);

          cell1.innerHTML = first;
          cell2.innerHTML = last;
          cell3.innerHTML = phone;

          var valuesGuestName = document.getElementById("guestNameListing").value;
          var valuesGuestLastName = document.getElementById("guestLastNameListing").value;
          var valuesGuestContact = document.getElementById("guestContactListing").value;



          var guestNames = document.getElementById("guestNames").value;


          var addedValueName = "";
          var addedValueLastName = "";
          var addedValueContact = "";



          if(guestNames=="")
          {
            addedValueName = first+"#"+last+"#"+phone+"#"+id;

          }
          else
          {
            addedValueName = guestNames+"||"+first+"#"+last+"#"+phone+"#"+id;

          }

          document.getElementById("guestNames").value = addedValueName;      

          document.getElementById("guestNameListing").value = addedValueName;
          document.getElementById("guestLastNameListing").value = addedValueLastName;
          document.getElementById("guestContactListing").value = addedValueContact;


        }

        function clearFunc(){
          document.getElementById("firstN").value = "";
          document.getElementById("guestID").value= 0;
          document.getElementById("familyName").value = "";
          document.getElementById("contact").value = "";
          document.getElementById("billArrangement").selectedIndex = 0;



        }

        function addRoom(){

          var roomNum = document.getElementById("roomNum").value;
          var x = document.getElementById("roomNum");


          var div = document.getElementById("roomsPanel");
          var string = '<div class="panel panel-default no-bd"><div class="panel-header"><h2 class="panel-title"><strong>ROOM: </strong>'+roomNum+' </h2></div><div class="panel-content"><input type="hidden" id="guestTableIndex" value="guestTable'+x.selectedIndex+'"/>  <div class="panel-content" style="overflow-y:auto;height:200px;"> <table id="guestTable'+x.selectedIndex+'" class="table table-hover"><thead><tr><th>First Name</th> <th>Last Name</th> <th>Phone</th> </tr> </thead> <tbody>  <tr><td></td><td></td> <td></td> </tr> </tbody> </table> </div>  </div> <hr/> <div class="text-center  m-t-20">  <button class="btn btn-embossed btn-primary" data-toggle="modal" data-target="#modal-select" onclick="clearFunc()"><i class="fa fa-plus"></i> Add Guest</button></div></div>';

          div.innerHTML +=string; 


          x.remove(x.selectedIndex);

        }
      </script>



      <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>





      <script type="text/javascript">
        $("#stdsgl-plus").click(function(){
          var x = parseInt(document.getElementById("total-rooms").value);
          $("#std-sgl").val(parseInt(document.getElementById("#std-sgl").value) + 1);
          $("#total-rooms").val(parseInt(document.getElementById("total-rooms").value) + 1);
        });


        $("#std-sgl").change(function() {
         var x = parseInt(document.getElementById("total-rooms").value);
         
         $("#total-rooms").val(parseInt($("#std-sgl").val()) + x);
       });            

        $("#departure").focus(function() {
          $("#depart").val($("#departure").val());
        });  


        $("#specialReq").focus(function(){

         $("#arrival2").val($("#arrival").val()); 
         $("#departure2").val($("#departure").val()); 
       });




     </script>



     <script type="text/javascript">

      $(document).ready(function(){
       $("#see-reservation").click(function(){

         $("#res-booking-person").html($("input[name=firstName]").val()+" "+$("input[name=lastName]").val());
         $("#res-bookingP-contact").html($("input[name=contactNo]").val());
         $("#res-bookingP-title").html($("input[name=title]").val());
         $("#res-institution").html($("input[name=institutionName]").val());


         $("#res-insti-type").html($("#iType option:selected").text());


         $("#res-insti-address").html($("input[name=institutionAddress]").val());

         $("#res-arrival").html($("input[name=arrivalDate]").val());
         $("#res-depart").html($("input[name=departureDate]").val());
         $("#res-checkin").html($("input[name=checkIntimepicker]").val());
         $("#res-checkout").html($("input[name=checkOuttimepicker]").val());


         $("#res-madethru").html($("#madeThru option:selected").text());



         $("#res-discount").html($("#discountType option:selected").text());

         var billArrange = $("input[name=billArrange]:checked").val();
         if(billArrange == 1)
          $("#res-billArrange").html('CTC');
        if(billArrange == 2)
          $("#res-billArrange").html('GA');

        var guaranteed = $("input[name=guaranteed]:checked").val();

        if(guaranteed == 1)
          $("#res-guaranteed").html('Yes');
        if(guaranteed == 2)
          $("#res-guaranteed").html('No');





        
      }); 
     });

      $('#institutions-table tbody').on( 'click', 'button', function () {
       var instiID = $(this).val();

       $.get("../frontdesk/get-institution/"+instiID,function(data){
        console.log(data);
        $("#iName").val(data.name);
        $("#iType").val(data.type).change();
        $("#iContact").val(data.contactNo);
        $("#iAddress").val(data.address);
        $("#instiEmail").val(data.email);
        $("#instiID").val(data.id);

        $("#institutionType").val(data.type);
      });
     });

      $('#clients-table tbody').on( 'click', 'button', function () {
       var clientID = $(this).val();

       $.get("../frontdesk/get-client/"+clientID,function(data){
        console.log(data);
        $("#fname").val(data.firstname);
        $("#lname").val(data.lastName);
        $("#contactNo").val(data.contactNo);
        $("#title").val(data.title);
        $("#clientEmail").val(data.email);
        $("#clientID").val(data.id);
      });
     });

      $(document).ready(function(){


        $("#checkAvail").click(function(){
          var dates1 = { arrival: $('#arrival2').val(),
          departure: $('#departure2').val(),
        };
        $("#depart-rooms > tbody").empty();
        $("#arrival-rooms > tbody").empty();

        $.get('{{route("frontdesk.checkRoomAvailability")}}',function(data){
         $.ajax({
           type:"GET",
           url: "{{route('frontdesk.checkRoomAvailability')}}",
           data: dates1,

           success: function (data){
             console.log(data);

                  //    

                  for(var i=1;i<=42;i++){
                   var id = "#"+i;
                   if($.inArray(i,data.results) > -1)                          
                     $(id).hide();
                   else
                     $(id).show();

                 }

                 if(data.departingRooms.length != 0){
                  $("#depart-date").html(data.departingRooms[0]["depatureDate"]);
                  for(var i=0; i < data.departingRooms.length; i++){
                    $('#depart-rooms > tbody:last-child').append('<tr><td>'+data.departingRooms[i]["roomName"]+'</td><td>'+data.departingRooms[i]["roomType"]+'</td><td>'+data.departingRooms[i]["status"]+'</td><td>'+data.departingRooms[i]["remarks"]+'</td><td><input id="check'+data.departingRooms[i]["roomId"]+'" type="checkbox" name="roomId[]" class="roomcheckbox" data-checkbox="icheckbox_square-blue" value="'+data.departingRooms[i]["roomId"]+'"></td></tr>');



                  }




                }


                if(data.arrivingRooms.length != 0){
                 $("#arrival-date").html(data.arrivingRooms[0]["arrivalDate"]);
                       // var roomListing = $("#depart-rooms");
                       


                       for(var i=0; i < data.arrivingRooms.length; i++){
                        $('#arrival-rooms > tbody:last-child').append('<tr><td>'+data.arrivingRooms[i]["roomName"]+'</td><td>'+data.arrivingRooms[i]["roomType"]+'</td><td>'+data.arrivingRooms[i]["status"]+'</td><td>'+data.arrivingRooms[i]["remarks"]+'</td><td><input id="check'+data.arrivingRooms[i]["roomId"]+'" type="checkbox" name="roomId[]" class="roomcheckbox" value="'+data.arrivingRooms[i]["roomId"]+'"></td></tr>');


                      }
                    }

                    $(".roomcheckbox").iCheck({
                      checkboxClass: 'icheckbox_square-blue',
                      checkedClass: 'checked',
                      enabledClass: 'true',
                    });

                    $('.roomcheckbox').on('ifChecked', function(event){
                      var roomId = $(this).val();

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


                    $('.roomcheckbox').on('ifUnchecked', function(event){
                      var roomId = $(this).val();
                      var totalRate = parseFloat(numeral($("#totalRate"+roomId).html()).format('0.00'));
                      var roomTotal = parseFloat(numeral($("#room-total-charge").html()).format('0.00'));
                      $("#room-total-charge").html(numeral(roomTotal-totalRate).format('0,0.00')); 

                      $('table#room-reserv-table tr#row'+roomId).remove();

                    });


                  }
                  
                });
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
} );

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
  $('input[type="checkbox"]').on('ifChecked', function(event){
    var roomId = $(this).val();

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

      $("#finalRoomRates").append('<input type="hidden" id="finalRoomRate'+data.room[0]['id']+' value="'+numeral(data.room[0]['room_rate']).format('0,0.00')+'"/>');


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
  var roomUnitPrice = rateCellFloat/1.19;
  var roomTotal = parseFloat(numeral($("#room-total-charge").html()).format('0.00'));

  var roomTotalRate = 0;


  $.get("../frontdesk/get-discount/"+x.value,function(data){

    if(data.discounts[0]["type"]==2){
      $("#totalRate"+x.getAttribute("value")).html(numeral(rateCellFloat-data.discounts[0]['discountValue']).format('0,0.00'));
      $("#finalRoomRate"+x.getAttribute("value")).val(numeral(rateCellFloat-data.discounts[0]['discountValue']).format('0,0.00'));
    }
    
   if(data.discounts[0]["type"]==1 && data.discounts[0]["id"] == 2){
      $("#totalRate"+x.getAttribute("value")).html(numeral(rateCellFloat-((rateCellFloat/1.19)*data.discounts[0]['discountValue'])).format('0,0.00'));
      $("#finalRoomRate"+x.getAttribute("value")).val(numeral(rateCellFloat-((rateCellFloat/1.19)*data.discounts[0]['discountValue'])).format('0,0.00'));
    }
    
    if(data.discounts[0]["type"]==1 && data.discounts[0]["id"] > 2){

        var rate = (rateCellFloat/1.19) - ((rateCellFloat/1.19)*data.discounts[0]['discountValue']);
        var calculation = numeral(rate*1.19).format('0,0.00');

        $("#totalRate"+x.getAttribute("value")).html(calculation);
        $("#finalRoomRate"+x.getAttribute("value")).val(calculation);
    }
    
    
    
    

    $("#room-reserv-table tr").each(function () {
      var totalDiscountRate = parseFloat(numeral($('td:last-child', this).html()).format('0.00'));

      roomTotalRate+=totalDiscountRate;


    });

    $("#room-total-charge").html(numeral(roomTotalRate).format('0,0.00'));

  });
}

function autoRoomAvailabilityFilter() {

  var dates1 = { arrival: $('#arrival2').val(),
          departure: $('#departure2').val(),
        };
        $("#depart-rooms > tbody").empty();
        $("#arrival-rooms > tbody").empty();

        $.get('{{route("frontdesk.checkRoomAvailability")}}',function(data){
         $.ajax({
           type:"GET",
           url: "{{route('frontdesk.checkRoomAvailability')}}",
           data: dates1,

           success: function (data){
             console.log(data);

                  //    

                  for(var i=1;i<=42;i++){
                   var id = "#"+i;
                   if($.inArray(i,data.results) > -1)                          
                     $(id).hide();
                   else
                     $(id).show();

                 }

                 if(data.departingRooms.length != 0){
                  $("#depart-date").html(data.departingRooms[0]["depatureDate"]);
                  for(var i=0; i < data.departingRooms.length; i++){
                    $('#depart-rooms > tbody:last-child').append('<tr><td>'+data.departingRooms[i]["roomName"]+'</td><td>'+data.departingRooms[i]["roomType"]+'</td><td>'+data.departingRooms[i]["status"]+'</td><td>'+data.departingRooms[i]["remarks"]+'</td><td><input id="check'+data.departingRooms[i]["roomId"]+'" type="checkbox" name="roomId[]" class="roomcheckbox" data-checkbox="icheckbox_square-blue" value="'+data.departingRooms[i]["roomId"]+'"></td></tr>');



                  }




                }


                if(data.arrivingRooms.length != 0){
                 $("#arrival-date").html(data.arrivingRooms[0]["arrivalDate"]);
                       // var roomListing = $("#depart-rooms");
                       


                       for(var i=0; i < data.arrivingRooms.length; i++){
                        $('#arrival-rooms > tbody:last-child').append('<tr><td>'+data.arrivingRooms[i]["roomName"]+'</td><td>'+data.arrivingRooms[i]["roomType"]+'</td><td>'+data.arrivingRooms[i]["status"]+'</td><td>'+data.arrivingRooms[i]["remarks"]+'</td><td><input id="check'+data.arrivingRooms[i]["roomId"]+'" type="checkbox" name="roomId[]" class="roomcheckbox" value="'+data.arrivingRooms[i]["roomId"]+'"></td></tr>');


                      }
                    }

                    $(".roomcheckbox").iCheck({
                      checkboxClass: 'icheckbox_square-blue',
                      checkedClass: 'checked',
                      enabledClass: 'true',
                    });

                    $('.roomcheckbox').on('ifChecked', function(event){
                      var roomId = $(this).val();

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


                    $('.roomcheckbox').on('ifUnchecked', function(event){
                      var roomId = $(this).val();
                      var totalRate = parseFloat(numeral($("#totalRate"+roomId).html()).format('0.00'));
                      var roomTotal = parseFloat(numeral($("#room-total-charge").html()).format('0.00'));
                      $("#room-total-charge").html(numeral(roomTotal-totalRate).format('0,0.00')); 

                      $('table#room-reserv-table tr#row'+roomId).remove();

                    });


                  }
                  
                });
}); 
}


</script>





</div>
<!-- END PAGE CONTENT -->
</div>



@endsection