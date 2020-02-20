@extends('layouts.frontdeskLayout')

@section('content')

<div class="main-content">
  <!-- BEGIN TOPBAR -->
  <div class="topbar" style="background-color:white;">
    <div class="header-left">
      <div class="topnav">

        <ul class="nav nav-tabs no-border">
          <li class="nav-active active"><a href="{{route('frontdesk.index')}}"><i class="fa fa-calendar-o"></i><span>Rooms</span></a></li>
          <li><a href="{{route('frontdesk.reservation')}}"><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
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
            <img src=" assets/global/images/avatars/avatar11_big.png" alt="user image">
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
  <div class="page-content p-l-20 p-r-20 p-t-10">
   <div class="panel">
    <div class="panel-content">

      <div class="nav-tabs2">
        <ul class="nav nav-tabs nav-red">

          <li class="active"><a href="#tab5_1" data-toggle="tab"><i class="icon-home"></i> Rooms</a></li>
          <li><a href="#tab5_3" data-toggle="tab"><i class="icon-user"></i> Check Room Availability</a></li>
          
          <li><a href="#tab5_4" data-toggle="tab"><i class="icon-user"></i> Calendar</a></li>
          
          
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade in active" id="tab5_1">
           <div class="panel bg-white">
            <div class="panel-header">





            </div>
            
            
              
            
            <div class="panel-content p-l-0 p-r-0">



             <script>
              $.get("../frontdesk/getCalendarDetails/",function(data){

               document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar1');

                var bookings = [];

                console.log(data);

                for(var i = 0; i < data.length; i++){
                  var bgColor = "";

                  if(data[i]["occupied_status"] != 0){
                   if(data[i]["occupied_status"] == 1){
                    
                    bgColor = "#18a689";
                  }
                  else if(data[i]["occupied_status"] == 2){
                    bgColor = "#C9625F";
                  }
                }
                else{
                  if(data[i]["guaranteed"] == 1){
                    if(data[i]["reserveType"] == 1)
                      bgColor = "#A58BD3";
                    else
                    bgColor = "#F2A057";
                  }
                  else
                  {

                      bgColor = "#4584D1";
                  }
                }


                

                bookings.push({ id: data[i]["riId"], resourceId: data[i]["roomId"], start: data[i]["arrivalDate"]+"T"+data[i]["checkInTime"], end: data[i]["depatureDate"]+"T"+data[i]["checkOutTime"], title: data[i]["lastName"]+" - "+data[i]["institutionName"]+" - "+data[i]["code"], backgroundColor: bgColor},);
                
              }

              console.log(bookings);
              var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'resourceTimeline' ],
                schedulerLicenseKey: 'GPL-My-Project-Is-Open-Source',
                now: '{{date("Y-m-d")}}',
                editable: false,
                aspectRatio: 1.8,
                scrollTime: '00:00',
                header: {
                  left: 'today, prev,next',
                  center: 'title',
                  right: 'resourceTimelineDay,resourceTimelineMonth,resourceTimelineYear'
                },
                disableDragging: true,
                defaultView: 'resourceTimelineMonth',
      // views: {

      //   resourceTimelineTenDay: {
      //     type: 'resourceTimeline',
      //     duration: { days: 10 },
      //     buttonText: '10 days'
      //   }
      // },
      navLinks: true,
      resourceAreaWidth: '15%',
      resourceLabelText: 'Rooms',
      resources: [
      { id: 'a1', title: 'Standard Single',children: [
      { id: '27', title: '201' },
      { id: '1', title: '209' },
      { id: '2', title: '301' },
      { id: '3', title: '309' },
      { id: '4', title: '401' },
      { id: '5', title: '409' }
      ] },
      { id: 'a2', title: 'Double De Luxe', children: [
      { id: '6', title: '207' },
      { id: '7', title: '307' },
      { id: '8', title: '407' },
      { id: '9', title: '203' },
      { id: '10', title: '205' },
      { id: '11', title: '303' },
      { id: '12', title: '305' },
      { id: '13', title: '403' },
      { id: '14', title: '405' },
      { id: '15', title: '202' },
      { id: '16', title: '302' },
      { id: '17', title: '402' }
      ] },
      { id: 'a4', title: 'Standard Twin', children: [
      { id: '18', title: '208' },
      { id: '19', title: '308' },
      { id: '20', title: '408' },
      { id: '21', title: '204' }
      
      ] },
      { id: 'a5', title: 'Family Room', children: [
      { id: '22', title: '206' },
      { id: '23', title: '304' },
      { id: '24', title: '404' },
      { id: '25', title: '406' },
      { id: '26', title: '306' }
      ] },
      
      ],




      events: bookings,

      eventClick: function(info){
       $.get("../frontdesk/reservation-detailsTwo/"+info.event.id,function(data){
        console.log(data);

        $("#res-reservId").html(data.tDetails.code);
        $("#res-createdAt").html(data.tDetails.formatCreatedAt);
        $("#res-booking-person").html(data.tDetails.clientName);
        $("#res-bookingP-contact").html(data.tDetails.clientContact);
        $("#res-bookingP-title").html(data.tDetails.title);
        $("#res-institution").html(data.tDetails.instiName);
        $("#res-insti-type").html(data.tDetails.accountType);
        $("#res-insti-address").html(data.tDetails.instiAddress);

        $("#res-arrival").html(data.tDetails.arrivalDate);
        $("#res-depart").html(data.tDetails.depatureDate);
        $("#res-checkin").html(data.tDetails.checkInTime);
        $("#res-checkout").html(data.tDetails.checkOutTime);
        $("#res-madethru").html(data.tDetails.madeThru);
        $("#res-guaranteed").html(data.tDetails.guaranteed);
        $("#res-billArrange").html(data.tDetails.billingType);


        for(var i = 0 ; i < data.rooms.length ; i++){
          $("#res-room-details").append("<tr><td>"+data.rooms[i]["roomName"]+"</td><td>"+data.rooms[i]["roomType"]+"</td><td>"+data.rooms[i]["FinalRoomRate"]+"</td></tr>");
        }

        for(var j = 0 ; j < data.guests.length ; j++){
          $("#res-guest-details").append("<tr><td>"+data.guests[j]["guestName"]+"</td><td>"+data.guests[j]["contactNo"]+"</td><td>"+data.guests[j]["roomName"]+"</td></tr>");
        }

        $("#res-specialRequest").html(data.tDetails.notes);
        $("#seeMoreDetails").attr("href",'/frontdesk/guest-registration?reservID='+data.tDetails.code);
      });

       $("#modal-room-info").modal("show");
       

     }
   });

              calendar.render();
            });
})


</script>

<style>


#calendar1 {
  max-width: 1500px;
  margin: 10px auto;
}

</style>
<div class="panel panel-transparent p-t-5 bd-6 p-b-10 m-l-20 m-r-20" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
  <div class="panel-header">
    <h5 class="m-b-0">Legend:</h5>

  </div>
  <div class="panel-content">

   <div class="row">
     <div class="col-md-12">
      <div class="col-md-2">
        <h5><span class="bg-blue p-5 bd-6">Blocked</span></h5>
      </div>
      <div class="col-md-2">
        <h5><span class="bg-green p-5 bd-6">Checked In</span></h5>
      </div>
      <div class="col-md-2">
        <h5><span class="bg-red p-5 bd-6">Checked Out</span></h5>
      </div>
      <div class="col-md-3">
        <h5><span class="bg-orange p-5 bd-6">Guaranteed/Confirmed</span></h5>
      </div>
      <div class="col-md-3">
        <h5><span class="bg-purple p-5 bd-6">Booked Online</span></h5>
      </div>
    </div>
  </div>
 



</div>
</div>
<div id='calendar1'> </div>




<div class="panel">
 
  <div class="panel-header">
   <div class = "row">
    <div class="col-md-12">
      {!! Form::open(['method'=>'GET','action'=>'FrontDeskController@index','name'=>'formregis','id'=>'FrontDeskController','class'=>'wizard','data-style'=>'simple']) !!}
      <div class="row">
        <div class="col-md-3 m-t-10">
          <div class="prepend-icon">
            <input type="text" id="date-main" name="date-main" autocomplete="off" class="b-datepicker form-control" placeholder="Select a date..." data-orientation="top">
            
            <i class="icon-calendar"></i>
          </div>
          
        </div>
        <div class="col-md-1 m-t-10">
         <input type="submit" class="btn btn-primary" value="Search"/>  
       </div>
     </div>
     
     
     <input type="hidden" id="date-main-hidden" value="{{$hiddenDate}}" />
   </div>
 </div>
</div>
</div>
<div class="panel panel-transparent p-t-5 bd-6 p-b-10 m-l-20 m-r-20" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
  <div class="panel-header">
    <h3 class="m-b-0">ROOM STATUS CODES:</h3>

  </div>
  <div class="panel-content">

   <div class="row">
     <div class="col-md-12">
      <div class="col-md-3">
        <h5><span class="bg-red p-5 bd-6">OCC</span> - Occupied</h5>
      </div>
      <div class="col-md-3">
        <h5><span class="bg-green p-5 bd-6">VR</span> - Vacant Ready</h5>
      </div>
      <div class="col-md-3">
        <h5><span class="bg-yellow p-5 bd-6">VD</span> - Vacant Dirty</h5>
      </div>
      <div class="col-md-3">
        <h5><span class="bg-white p-5 bd-6">OOO</span>- Out of Order</h5>
      </div>
    </div>
  </div>
  <div class="row">
   <div class="col-md-12">
    <div class="col-md-3">
      <h5><span class="bg-orange p-5 bd-6">BLO</span> - Blocked</h5>
    </div>
    <div class="col-md-3">
      <h5><span class="bg-dark p-5 bd-6">NS</span> - No Show</h5>
    </div>
    <div class="col-md-3">
      <h5><span class="bg-light p-5 bd-6">SO</span> - Slept Out</h5>
    </div>
    <div class="col-md-3">
      <h5><span class="bg-blue p-5 bd-6">HU</span> - House Use</h5>
    </div>
  </div>
</div>



</div>
</div>

<div class="row">
  <div class="panel-content">
    <div class="tab_left">
      <ul  class="nav nav-tabs nav-red">

        <li class="active"><a href="#tab3_1" data-toggle="tab"><i class="icon-home"></i> 2nd Floor</a></li>
        <li><a href="#tab3_2" data-toggle="tab"><i class="icon-home"></i> 3rd Floor</a></li>
        <li><a href="#tab3_3" data-toggle="tab"><i class="icon-home"></i> 4th Floor</a></li>
        
      </ul>
      <div class="tab-content">

        <div class="tab-pane fade active in" id="tab3_1">
         <div class="row p-10">


          @foreach($rooms2 as $r)
          
          
          @if(in_array($r->id,$blockedRooms))
          @if($r->status == 0)
          <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$r->statusColor2}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="" value="{{$r->id}}">
            @else
            <div class="col-md-3  {{$r->statusColor2}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$r->statusColor2}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="" value="{{$r->id}}">
              @endif
              @else
              <div class="col-md-3  {{$r->statusColor2}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$r->statusColor2}} bd-3"  style="" data-toggle="modal" value="{{$r->id}}">
                @endif
                <div class="panel-header bg-white">
                  <h3 align="center" class="f-18"><strong>
                    @if(in_array($r->id,$blockedRooms))
                    @if($r->status == 1)
                    <span class="bg-red p-5 bd-6">
                      @elseif($r->status == 2)
                      <span class="bg-orange p-5 bd-6">
                        @elseif($r->status == 3)
                        <span class="bg-orange p-5 bd-6">
                          @elseif($r->status == 4)
                          <span class="bg-white p-5 bd-6">
                            @elseif($r->status == 7)
                            <span class="bg-blue p-5 bd-6">
                              @elseif($r->status == 0)
                              <span class="bg-orange p-5 bd-6">
                                @endif
                                @else
                                <span class="bg-white p-5 bd-6">  
                                  @endif
                                  {{$r->roomName}}
                                </span>
                              </strong></h3>
                            </div>
                            <center>
                              <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>

                                @if(in_array($r->id,$blockedRooms))
                                @if($r->status!=1)
                                BLO / {{$roomStatus[$r->status]}}
                                @else
                                OCC
                                @endif
                                @else
                                {{$roomStatus[$r->status]}}
                                @endif
                              </strong></h3>
                            </center>
                          </div>
                          
                          @endforeach   
                        </div>
                      </div>
                      <div class="tab-pane fade" id="tab3_2">
                       <div class="row p-10">
                        @foreach($rooms3 as $r)
                        
                        
                        @if(in_array($r->id,$blockedRooms))
                        @if($r->status == 0)
                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$r->statusColor2}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="" value="{{$r->id}}">
                          @else
                          <div class="col-md-3  {{$r->statusColor2}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$r->statusColor2}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="" value="{{$r->id}}">
                            @endif
                            @else
                            <div class="col-md-3  {{$r->statusColor2}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$r->statusColor2}} bd-3"  style="" data-toggle="modal" value="{{$r->id}}">
                              @endif
                              <div class="panel-header bg-white">
                                <h3 align="center" class="f-18"><strong>
                                 @if(in_array($r->id,$blockedRooms))
                                 @if($r->status == 1)
                                 <span class="bg-red p-5 bd-6">
                                  @elseif($r->status == 2)
                                  <span class="bg-orange p-5 bd-6">
                                    @elseif($r->status == 3)
                                    <span class="bg-orange p-5 bd-6">
                                      @elseif($r->status == 4)
                                      <span class="bg-white p-5 bd-6">
                                        @elseif($r->status == 7)
                                        <span class="bg-blue p-5 bd-6">
                                          @elseif($r->status == 0)
                                          <span class="bg-orange p-5 bd-6">
                                            @endif
                                            @else
                                            <span class="bg-white p-5 bd-6">  
                                              @endif
                                              {{$r->roomName}}
                                            </span>
                                          </strong></h3>
                                        </div>
                                        <center>
                                          <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>

                                            @if(in_array($r->id,$blockedRooms))
                                            @if($r->status!=1)
                                            BLO / {{$roomStatus[$r->status]}}
                                            @else
                                            OCC
                                            @endif
                                            @else
                                            {{$roomStatus[$r->status]}}
                                            @endif
                                          </strong></h3>
                                        </center>
                                      </div>
                                      
                                      @endforeach   
                                    </div>
                                  </div>
                                  <div class="tab-pane fade" id="tab3_3">
                                   <div class="row p-10">
                                    @foreach($rooms4 as $r)
                                    
                                    
                                    @if(in_array($r->id,$blockedRooms))
                                    @if($r->status == 0)
                                    <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$r->statusColor2}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="" value="{{$r->id}}">
                                      @else
                                      <div class="col-md-3  {{$r->statusColor2}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$r->statusColor2}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="" value="{{$r->id}}">
                                        @endif
                                        @else
                                        <div class="col-md-3  {{$r->statusColor2}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$r->statusColor2}} bd-3"  style="" data-toggle="modal" value="{{$r->id}}">
                                          @endif
                                          <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                             @if(in_array($r->id,$blockedRooms))
                                             @if($r->status == 1)
                                             <span class="bg-red p-5 bd-6">
                                              @elseif($r->status == 2)
                                              <span class="bg-orange p-5 bd-6">
                                                @elseif($r->status == 3)
                                                <span class="bg-orange p-5 bd-6">
                                                  @elseif($r->status == 4)
                                                  <span class="bg-white p-5 bd-6">
                                                    @elseif($r->status == 7)
                                                    <span class="bg-blue p-5 bd-6">
                                                      @elseif($r->status == 0)
                                                      <span class="bg-orange p-5 bd-6">
                                                        @endif
                                                        @else
                                                        <span class="bg-white p-5 bd-6">  
                                                          @endif
                                                          {{$r->roomName}}
                                                        </span>
                                                      </strong></h3>
                                                    </div>
                                                    <center>
                                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>

                                                        @if(in_array($r->id,$blockedRooms))
                                                        @if($r->status!=1)
                                                        BLO / {{$roomStatus[$r->status]}}
                                                        @else
                                                        OCC
                                                        @endif
                                                        @else
                                                        {{$roomStatus[$r->status]}}
                                                        @endif
                                                      </strong></h3>
                                                    </center>
                                                  </div>
                                                  
                                                  @endforeach   
                                                </div>
                                              </div>
                                              



                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      

                                      
                                    </div>
                                  </div>
                                </div>
                                
                                
                                <!-- For Calendar -->
                                <div class="tab-pane" id="tab5_4">
                                 <div class="panel">
                                  <div class="panel-header">
                                    <h4><strong>Room Calendar</strong></h4>
                                    <div class="row">
                                      <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div id="fullcalendar"></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="tab-pane" id="tab5_3">
                               <div class="panel">
                                <div class="panel-header">
                                  <h4><strong>Room Availability</strong></h4>
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="form-label">Arrival and Departure</label>
                                        <div class="input-daterange b-datepicker input-group" id="datepicker">
                                          <input type="text" class="input-sm form-control" id="arrival2" name="arrival2" placeholder="Arrival"/>
                                          <span class="input-group-addon">to</span>
                                          <input type="text" class="input-sm form-control" id="departure2" name="departure2" placeholder="Departure"/>
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
                                        @foreach($roomsCheck as $r)
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
                                              @foreach($roomsCheck as $r)
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
                                          @foreach($roomsCheck as $r)
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
                                                @foreach($roomsCheck as $r)
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
                                            @foreach($roomsCheck as $r)
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
                                                  @foreach($roomsCheck as $r)
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
                                                @foreach($roomsCheck as $r)
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
                                                      @foreach($roomsCheck as $r)
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
                                      
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        <!--        RESERVATION DETAIL--->
                        <div class="modal fade" id="modal-room-info"  data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                              <div class="modal-header bg-primary">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                                <h5 class="modal-title"><strong>Reservation</strong> Info</h5>
                              </div>
                              <div id="print-reservation-details" class="modal-body">
                                <div class="row">

                                  <div class="col-md-6">

                                   <h3 class="m-b-0">RESERVATION ID: <strong><span id="res-reservId"></span></strong></h3>
                                   <p class="f-10 m-t-0">Date Booked: <strong><span id="res-createdAt"></strong></p>


                                   </div>
                                 </div>
                                 
                                 
                                 
                                 <div class="panel panel-transparent bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">

                                  <h5 class="m-l-20"><strong>BOOKING PERSON/INSTITUTION DETAILS:</strong></h5>
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

                                  <h5 class="m-l-20"><strong>RESERVATION DETAILS:</strong></h5>
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
                                     <h5 class="m-t-10"><strong>ROOM DETAILS</strong></h5><hr class="m-t-5"/>
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
                                   <h5 class="m-t-10"><strong>GUEST DETAILS</strong></h5><hr class="m-t-5"/>
                                   <table id="res-guest-details" class="table table-bordered">
                                    <thead class="f-12">
                                      <tr>

                                        <th>NAME</th>
                                        <th>CONTACT</th>
                                        <th>ROOM ASSIGNED</th>
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

                            <h5 class="m-l-20"><strong>Reservation Notes:</strong></h5>
                            <hr class="m-b-10"/>
                            <div class="panel-content p-l-20 p-r-20">
                              <div class="row">

                                <div class="col-md-12">
                                  <p class="f-12"><span id="res-specialRequest"></span></p>
                                </div>
                                
                              </div>
                              
                            </div>
                            

                            
                          </div>
                          <div class="modal-footer bg-dark">
                            <button type="button" id="res-close" class="btn btn-white btn-embossed" data-dismiss="modal">Close</button>
                            <a type="button" id="seeMoreDetails" href="" class="btn btn-primary btn-embossed"> SEE MORE DETAILS</a>
                            <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
                          </div>
                          
                        </div>
                        
                      </div>
                    </div>
                  </div>

                  <!--                                            END RESERVATION DETAIL-->
                  
                  <div class="footer">
                    <div class="copyright">
                      <p class="pull-left sm-pull-reset">
                        <span>Copyright <span class="copyright">©</span> 2015 </span>
                        <span>THEMES LAB</span>.
                        <span>All rights reserved. </span>
                      </p>
                      <p class="pull-right sm-pull-reset">
                        <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
                      </p>
                    </div>
                  </div>
                </div>
                <!-- END PAGE CONTENT -->


                <meta name="_token" content="{!! csrf_token() !!}" />
                <script src="{{url('assets/jquery/jquery-1.12.4.js')}}"></script>
                <script src="{{url('assets/jquery/jquery-ui-1.12.1/jquery-ui.js')}}"></script>


                <script type="text/javascript">
                 $(document).ready(function(){

                  $.ajax({
                    url: "{!! route('frontdesk.reservationCalendar') !!}",
                    dataType: "JSON",
                    success: function(data){

                     $('#fullcalendar').fullCalendar({

                      header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'timeline,agendaWeek,agendaDay'
                      },

                      events: data,

                    });

                   }    

                 });



                  $("#no-show").click(function(){
                    $.ajaxSetup({
                      headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                      }
                    })

                    var transId = {

                      transId: $(this).val(),

                    };

                    $.ajax({
                     type:"PUT",
                     url: "{{route('frontdesk.noShow')}}",
                     data: transId,

                     success: function (data){
                       console.log(data);

                       $("#no-show-status").show();


                     }

                   });
                    $('#users-table').DataTable({
                      processing: true,
                      serverSide: false,
                      "scrollY":        "400px",
                      "scrollCollapse": true,
                      "ordering": false,
                      "bLengthChange": false,
                      "bDestroy": true,
                      ajax: "{!! route('frontdesk.dataTablesActiveReservationList') !!}",
                      columns: [
                      { data: 'clientName', name: 'clientName' },
                      { data: 'institutionName', name: 'institutionName' },
                      { data: 'institutionType', name: 'institutionType' },
                      { data: 'code', name: 'code' },
                      { data: 'arrivalDate', name: 'arrivalDate' },
                      { data: 'depatureDate' , name: 'depatureDate'},
                      { "className":      'options',
                      "data":           null,
                      "render": function(data, type, full, meta){
                        var status=data.status;


                        if(status==2)
                          return '<span class="label label-default">No Show</span>';
                        else
                         return '<span class="label label-warning">Pending Arrival</span>';
                     }
                   },
                   {
                    "className":      'options',
                    "data":           null,
                    "render": function(data, type, full, meta){
                      var valueHere=data.id;
                      return '<button type="button" value="'+valueHere+'" class="btn-sm btn-default btn-transparent" data-toggle="modal" data-target="#modal-reservation-detail">Manage</button>';
                    }
                  }
                  ],

                });

                    $('#gua-table').DataTable({
                      processing: true,
                      serverSide: false,
                      "scrollY":        "400px",
                      "scrollCollapse": true,
                      "ordering": false,
                      "bLengthChange": false,
                      "bDestroy": true,
                      ajax: "{!! route('frontdesk.dataTablesGuaranteedReservationList') !!}",
                      columns: [
                      { data: 'clientName', name: 'clientName' },
                      { data: 'institutionName', name: 'institutionName' },
                      { data: 'institutionType', name: 'institutionType' },
                      { data: 'code', name: 'code' },
                      { data: 'arrivalDate', name: 'arrivalDate' },
                      { data: 'depatureDate' , name: 'depatureDate'},
                      { "className":      'options',
                      "data":           null,
                      "render": function(data, type, full, meta){
                        var status=data.status;


                        if(status==2)
                          return '<span class="label label-default">No Show</span>';
                        else
                         return '<span class="label label-warning">Pending Arrival</span>';
                     }
                   },
                   {
                    "className":      'options',
                    "data":           null,
                    "render": function(data, type, full, meta){
                      var valueHere=data.id;
                      return '<button type="button" value="'+valueHere+'" class="btn-sm btn-default btn-transparent" data-toggle="modal" data-target="#modal-reservation-detail">Manage</button>';
                    }
                  }
                  ],

                });


                  });


});

$(document).ready(function(){
 $("#guarantee").change(function(){
   $("#downpayment").attr('disabled',false);
   $("#downpayment").attr('style','opacity:1;');
 }); 
});

$(document).ready(function(){
  $(".modal-select").click(function(){


    var roomId = $(this).attr("value");
    
    var dateSelected = {

      dateMain:  $("#date-main-hidden").val(),
      
    };
    
    var url = "{{route('frontdesk.modalView',['id' =>':id'])}}";
    var url2 = url.replace(":id",roomId);
    
    $.ajax({
     type:"GET",
     url: url2,
     data: dateSelected,
     
     success: function (data){

      if(data.departure)
        $("#departure-div").show();
      
      
      $("#modal-room").html(data.roomInfo["roomName"]+" - "+data.roomInfo["roomType"]);
      
      var guestNames = "";
      
      var account_ids = [];
      
      for(var j=0;j<data.departure.length;j++){

        if(account_ids.indexOf(data.departure[j]["account_id"])== -1){
          var firstName = data.departure[j]["firstName"]
          guestNames+=firstName[0]+". "+data.departure[j]["familyName"];
          
          account_ids.push(data.departure[j]["account_id"]);
          
          if((j+2)!=data.departure.length)
            guestNames+=", ";
        }
        
        $("#basic-guestNames").html(guestNames);
        
        
        
      }
      
      
    }
    
  });
  });
});

$(document).ready(function(){
  $("#modal-basic-close").click(function(){
   $("#departure-div").hide();
   
 });
});
    //BLOCKED MODAL
    $(document).ready(function(){
      $(".modal-blocked-select").click(function(){
       $("#arriving-guest").empty();
       $("#arriving-guest-panel").attr('style','display:none');
       $("#blocked-view-guests").show();
       
       var roomId = $(this).attr("value");
       
       var dateSelected = {

        dateMain:  $("#date-main-hidden").val(),
        
      };
      
      var url = "{{route('frontdesk.modalBlocked',['id' =>':id'])}}";
      var url2 = url.replace(":id",roomId);
      
      $.ajax({
       type:"GET",
       url: url2,
       data: dateSelected,
       
       success: function (data){



         $("#blocked-room-name").html(data.roomName +" - "+ data.name);
         var reservID = ""+data.code;
         
         
         $("#blocked-trans-id").val(data.id);
         $("#blocked-room-reservId").html(data.code);
         $("#reservID").val(data.code);
         $("#blocked-arrival").html(data.arrivalDate);
         $("#blocked-departure").html(data.depatureDate);
         $("#blocked-booker").html(data.clientFirstName+" "+data.clientLastName);
         $("#blocked-institution").html(data.groupName);
         
         
         
         
         
         
       }
       
       
     });
    });
    });
    
    $(document).ready(function(){


      $(".add-down").click(function(e){


        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });

        
        var roomReserveID = $(this).val();
        
        var roomReserve = {
          noOfdays: $("#days-counter").val(),
          roomReserveId:  roomReserveID,
          dateMain:  $("#date-main-hidden").val(),
          
        };
        
        
        $.ajax({
         type:"PUT",
         url: "{{route('frontdesk.addDownpayment')}}",
         data: roomReserve,
         
         success: function (data){
           console.log(data);
           $("#modal-occ-content").fadeOut(500, function(){



             var arr = new Date(data[0]["arrivalDate"]);
             var arrdate = arr.getDate();
             var arrmonth = arr.getMonth() + 1; 
             var arryear = arr.getFullYear();
             
             $("#occ-arrival").html(arrmonth+'/'+arrdate+'/'+arryear);
             
             var dep = new Date(data[0]["depatureDate"]);
             var depdate = dep.getDate();
             var depmonth = dep.getMonth() + 1; 
             var depyear = dep.getFullYear();
             
             $("#occ-depart").html(depmonth+'/'+depdate+'/'+depyear);
             
             var roomRate = numeral(data[0]["rate"]).format('0,0.00');
             
             $("#occ-rate").html(roomRate);
             
             $(".add-down").attr('value',data[0]["roomReservId"]);
             
                    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
             //       var firstDate = new Date(2008,01,12);
             //       var secondDate = new Date(2008,01,22);

             var diffDays = Math.round(Math.abs((dep.getTime() - arr.getTime())/(oneDay)));
             
             if(data[0]['discountType'] == 1)
              var discountVal = (data[0]['discountValue'] * 100) + '%';
            else
              var discountVal = data[0]['discountValue'];
            
            $("#occ-discount").html(data[0]['discountName']+" - "+ discountVal);
            
            $("#occ-dayspaid").html(data[0]['noOfDays']);
            
            $("#occ-totaldays").html(diffDays);
            
            var computeRate =data[0]["rate"] - (data[0]["rate"] * data[0]['discountValue']);
            
            $("#occ-hidden-rate").val(computeRate);
            
            var guestListing = $("#checked-in-guests");
            
            $("#occ-room-name").html(data[0]['roomName']+' - '+data[0]['name']);
            
            
            
            $("#modal-occ-content").fadeIn().delay(500);
            
          });   
           
           
           
           
           
           
           
           
           
         }
         
         
       });
        
        
      });
      
      
    });
    
    //BLOCKED MODAL OCC
    $(document).ready(function(){
      $(".modal-blocked-occ").click(function(){



        var roomId = $(this).attr("value");
        
        var dateSelected = {

          dateMain:  $("#date-main-hidden").val(),
          
        };
        
        var url = "{{route('frontdesk.modalBlockedOcc',['id' =>':id'])}}";
        var url2 = url.replace(":id",roomId);
        
        $.ajax({
         type:"GET",
         url: url2,
         data: dateSelected,
         
         success: function (data){
          var arr = new Date(data.info[0]["arrivalDate"]);
          var arrdate = arr.getDate();
          var arrmonth = arr.getMonth() + 1; 
          var arryear = arr.getFullYear();
          
          $("#occ-arrival").html(arrmonth+'/'+arrdate+'/'+arryear);
          
          var dep = new Date(data.info[0]["depatureDate"]);
          var depdate = dep.getDate();
          var depmonth = dep.getMonth() + 1; 
          var depyear = dep.getFullYear();
          
          $("#occ-depart").html(depmonth+'/'+depdate+'/'+depyear);
          
          var roomRate = numeral(data.info[0]["rate"]).format('0,0.00');
          
          $("#occ-reservID").html(data.info[0]["code"]);
          $("#occ-rate").html(roomRate);
          
          $(".add-down").attr('value',data.info[0]["roomReservId"]);
          
                    var oneDay = 24*60*60*1000; // hours*minutes*seconds*milliseconds
             //       var firstDate = new Date(2008,01,12);
             //       var secondDate = new Date(2008,01,22);

             var diffDays = Math.round(Math.abs((dep.getTime() - arr.getTime())/(oneDay)));
             
             if(data.info[0]['discountType'] == 1)
              var discountVal = (data.info[0]['discountValue'] * 100) + '%';
            else
              var discountVal = data.info[0]['discountValue'];
            
            $("#occ-discount").html(data.info[0]['discountName']+" - "+ discountVal);
            
            $("#occ-dayspaid").html(data.info[0]['noOfDays']);
            
            $("#occ-totaldays").html(diffDays);
            
            var computeRate =data.info[0]["rate"] - (data.info[0]["rate"] * data.info[0]['discountValue']);
//                       alert(data[0]["rate"] * data[0]['discountValue']);
$("#occ-hidden-rate").val(computeRate);

var guestListing = $("#checked-in-guests");

$("#occ-room-name").html(data.info[0]['roomName']+' - '+data.info[0]['name']);

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
    $('#charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td class="text-right">&#8369; '+chargePrice+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</tr>');
    
    amountTotal+=data.charges[j]["price"];
  }
  
  
  if(data.charges[j]["account_type"]==2){
    $('#charges-table > tbody:last-child').append('<tr><td>'+chargemonth+'/'+chargeday+'/'+chargeyear+'</td><td>OS/OR No.'+data.charges[j]["os_id"]+" - "+data.charges[j]["item_name"]+'</td><td></td><td class="text-right">&#8369; '+chargePrice+'</td><td class="text-right">&#8369; '+chargePrice+'</tr>');
    
    amountTotal+=data.charges[j]["price"];
    paymentsTotal+=data.charges[j]["price"];
  }
  
}

balance = amountTotal - paymentsTotal;
//                    
amountTotal = numeral(amountTotal).format('0,0.00');
paymentsTotal = numeral(paymentsTotal).format('0,0.00');
balance = numeral(balance).format('0,0.00');

$('#charges-table > tbody:last-child').append('<tr><td colspan="2" class="text-right">Total</td><td></td><td></td><td class="text-right">&#8369; '+amountTotal+'</td></tr><tr><td colspan="2" class="text-right">Payments</td><td></td><td class="text-right">&#8369; '+paymentsTotal+'</td><td></td></tr><tr><td colspan="2" class="text-right">Balance/Amount Payable</td><td></td><td></td><td class="text-right c-red f-20"><strong>&#8369; '+balance+'</strong></td></tr>');

}


});
});
});

    //CLOSE BLOCKED-OCC
    $(document).ready(function(){
      $("#modal-occ-close").click(function(){
       $("#checked-in-guests").empty();
       $('#charges-table > tbody:last-child').empty();
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
    
    //SHOW ARRIVING GUEST/S ON MODAL
    $(document).ready(function(){

      $("#blocked-view-guests").click(function(){
        var transactionID = $("#blocked-trans-id").val();
        
        var url = "{{route('frontdesk.blockedViewGuest',['id' =>':id'])}}";
        var url2 = url.replace(":id",transactionID);
        
        $.ajax({
         type:"GET",
         url: url2,
         
         
         success: function (data){
           var guestListing = $("#arriving-guest");
           
           for(var i=0; i < data.length; i++){
             guestListing.append("<li>"+data[i]["firstName"]+" "+data[i]["familyName"]+" ("+data[i]["contactNo"]+")</li>");
           }
           
           $("#blocked-view-guests").fadeOut(300, function(){
            $("#arriving-guest-panel").fadeIn().delay(3000);
            
          });
           
           
           
           
                 //  alert('yes');
               }
               
               
             });
                /*
       
 
        //Add the data rows.
        for (var i = 1; i < customers.length; i++) {
            row = $(table[0].insertRow(-1));
            for (var j = 0; j < columnCount; j++) {
                var cell = $("<td />");
                cell.html(customers[i][j]);
                row.append(cell);
            }
        }
        */
        
      }); 
      
      
    });
    
    $(document).ready(function(){


      $(".no-reserv").click(function(){
        var roomID = $(this).attr('value');
        
        
        var url = "{{route('frontdesk.roomStatusEdit',['id' =>':id'])}}";
        var url2 = url.replace(":id",roomID);
        
        $.get(url2,function(data){
          console.log(data);
          
          if(data.status == 0){
           $("#change-room-status").append("Vacant Ready");
           $("#change-room-status").attr("class","bg-green p-5 bd-6");
         }
         if(data.status == 1){
           $("#change-room-status").append("Occupied");
           $("#change-room-status").attr("class","bg-red p-5 bd-6");
         }
         if(data.status == 2){
           $("#change-room-status").append("Vacant Dirty");
           $("#change-room-status").attr("class","bg-yellow p-5 bd-6");
         }
         if(data.status == 3){
           $("#change-room-status").append("Blocked");
           $("#change-room-status").attr("class","bg-orange p-5 bd-6");
         }
         if(data.status == 4){
           $("#change-room-status").append("Out of Order");
           $("#change-room-status").attr("class","bg-white p-5 bd-6");
         }
         if(data.status == 5){
           $("#change-room-status").append("No Show");
           $("#change-room-status").attr("class","bg-dark p-5 bd-6");
         }
         if(data.status == 6){
           $("#change-room-status").append("Slept Out");
           $("#change-room-status").attr("class","bg-light p-5 bd-6");
         }
         if(data.status == 7){
           $("#change-room-status").append("House Use");
           $("#change-room-status").attr("class","bg-blue p-5 bd-6");
         }
         
         
         $("#room-status-close").val(data.id);
         $("#room-status-save").val(data.id);
         $("#modal-room").append(data.roomName);
         
         
       });
      });
      
      
    });
    $('#gua-table tbody').on( 'click', 'button', function () {
     var transID = $(this).val();
     $("#no-show").val(transID);
     
     $.get("frontdesk/reservation-details/"+transID,function(data){
      console.log(data);
      
      $("#res-reservId").html(data.transaction["code"]);
      $("#res-booking-person").html(data.transaction["clientFirstName"].toUpperCase()+" "+data.transaction["clientLastName"].toUpperCase());
      $("#res-bookingP-contact").html(data.transaction["clientContact"]);
      $("#res-bookingP-title").html(data.transaction["clientTitle"].toUpperCase());
      $("#res-institution").html(data.transaction["instiName"].toUpperCase());
      $("#res-insti-type").html(data.transaction["accountType"].toUpperCase());
      $("#res-insti-address").html(data.transaction["instiAddress"].toUpperCase());
      
      
      var arr = new Date(data.transaction["arrivalDate"]);
      var arrdate = arr.getDate();
      var arrmonth = arr.getMonth() + 1; 
      var arryear = arr.getFullYear();
      
      $("#res-arrival").html(arrmonth+"/"+arrdate+"/"+arryear);
      
      var dep = new Date(data.transaction["depatureDate"]);
      var depdate = dep.getDate();
      var depmonth = dep.getMonth() + 1; 
      var depyear = dep.getFullYear();

      $("#res-depart").html(depmonth+"/"+depdate+"/"+depyear);
      
      $("#res-checkin").html(data.transaction["checkInTime"]);
      $("#res-checkout").html(data.transaction["checkOutTime"]);
      
      $("#res-madethru").html(data.transaction["madeThru"]);
      
      $("#res-discount").html(data.transaction["discountName"]+" ("+data.transaction["discountValue"] * 100+"%)");
      
      $("#res-guaranteed").html(data.transaction["guaranteed"]);
      
      $("#res-billArrange").html(data.transaction["billingType"]);
      
      $("#guarantee-down").val(data.transaction["transID"]);
      
      
      for(var k=0;k<data.rooms.length;k++){


        $('#res-room-details > tbody:last-child').append('<tr><td>'+data.rooms[k]["roomNo"]+'</td><td>'+data.rooms[k]["roomType"]+'</td><td>'+numeral(data.rooms[k]["rate"]-(data.rooms[k]["rate"]*data.transaction["discountValue"])).format('0,0.00')+'</td></tr>');
        
      }
      
      
      
      for(var j=0;j<data.guests.length;j++){

        $('#res-guest-details > tbody:last-child').append('<tr><td>'+data.guests[j]["account_id"]+'</td><td>'+data.guests[j]["firstName"]+' '+data.guests[j]["familyName"]+'</td><td>'+data.guests[j]["contactNo"]+'</td></tr>');
        
        
        
      }
      
      
    });
     
   });
    $('#users-table tbody').on( 'click', 'button', function () {
     var transID = $(this).val();
     $("#no-show").val(transID);
     
     $.get("frontdesk/reservation-details/"+transID,function(data){
      console.log(data);
      
      $("#res-reservId").html(data.transaction["code"]);
      $("#res-booking-person").html(data.transaction["clientFirstName"].toUpperCase()+" "+data.transaction["clientLastName"].toUpperCase());
      $("#res-bookingP-contact").html(data.transaction["clientContact"]);
      $("#res-bookingP-title").html(data.transaction["clientTitle"].toUpperCase());
      $("#res-institution").html(data.transaction["instiName"].toUpperCase());
      $("#res-insti-type").html(data.transaction["accountType"].toUpperCase());
      $("#res-insti-address").html(data.transaction["instiAddress"].toUpperCase());
      
      
      var arr = new Date(data.transaction["arrivalDate"]);
      var arrdate = arr.getDate();
      var arrmonth = arr.getMonth() + 1; 
      var arryear = arr.getFullYear();
      
      $("#res-arrival").html(arrmonth+"/"+arrdate+"/"+arryear);
      
      var dep = new Date(data.transaction["depatureDate"]);
      var depdate = dep.getDate();
      var depmonth = dep.getMonth() + 1; 
      var depyear = dep.getFullYear();

      $("#res-depart").html(depmonth+"/"+depdate+"/"+depyear);
      
      $("#res-checkin").html(data.transaction["checkInTime"]);
      $("#res-checkout").html(data.transaction["checkOutTime"]);
      
      $("#res-madethru").html(data.transaction["madeThru"]);
      
      $("#res-discount").html(data.transaction["discountName"]+" ("+data.transaction["discountValue"] * 100+"%)");
      
      $("#res-guaranteed").html(data.transaction["guaranteed"]);
      
      $("#res-billArrange").html(data.transaction["billingType"]);
      
      $("#guarantee-down").val(data.transaction["transID"]);
      
      
      for(var k=0;k<data.rooms.length;k++){


        $('#res-room-details > tbody:last-child').append('<tr><td>'+data.rooms[k]["roomNo"]+'</td><td>'+data.rooms[k]["roomType"]+'</td><td>'+numeral(data.rooms[k]["rate"]-(data.rooms[k]["rate"]*data.transaction["discountValue"])).format('0,0.00')+'</td></tr>');
        
      }
      
      
      
      for(var j=0;j<data.guests.length;j++){

        $('#res-guest-details > tbody:last-child').append('<tr><td>'+data.guests[j]["account_id"]+'</td><td>'+data.guests[j]["firstName"]+' '+data.guests[j]["familyName"]+'</td><td>'+data.guests[j]["contactNo"]+'</td></tr>');
        
        
        
      }
      
      
    });
     
   });
    
    $(document).ready(function(){
      $("#res-close").click(function(){

        $("#downpayment").val();
        
        $('#res-room-details > tbody:last-child').empty();
        $('#res-guest-details > tbody:last-child').empty();
      });
    });
    
    $(document).ready(function(){


      $("#guarantee-down").click(function(e){


        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });

        
        var roomReserveID = $(this).val();
        
        var fields = {
          downpayment: $("#downpayment").val(),
          transID: $(this).val(),
          
        };
        
        
        $.ajax({
         type:"PUT",
         url: "{{route('frontdesk.guaranteeDownpayment')}}",
         data: fields,
         
         success: function (data){
           console.log(data);
           $("#downpayment").val('');
           
           $('#gua-table').DataTable({
            processing: true,
            serverSide: false,
            "scrollY":        "400px",
            "scrollCollapse": true,
            "ordering": false,
            "bLengthChange": false,
            "bDestroy": true,
            ajax: "{!! route('frontdesk.dataTablesGuaranteedReservationList') !!}",
            columns: [
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionName', name: 'institutionName' },
            { data: 'institutionType', name: 'institutionType' },
            { data: 'code', name: 'code' },
            { data: 'arrivalDate', name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate'},
            { "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
              var status=data.status;
              
              
              if(status==2)
                return '<span class="label label-default">No Show</span>';
              else
               return '<span class="label label-warning">Pending Arrival</span>';
           }
         },
         {
          "className":      'options',
          "data":           null,
          "render": function(data, type, full, meta){
            var valueHere=data.id;
            return '<button type="button" value="'+valueHere+'" class="btn-sm btn-default btn-transparent" data-toggle="modal" data-target="#modal-reservation-detail">Manage</button>';
          }
        }
        ],
        
      });
           
           $('#users-table').DataTable({
            processing: true,
            serverSide: false,
            "scrollY":        "400px",
            "scrollCollapse": true,
            "ordering": false,
            "bLengthChange": false,
            "bDestroy": true,
            ajax: "{!! route('frontdesk.dataTablesActiveReservationList') !!}",
            columns: [
            { data: 'clientName', name: 'clientName' },
            { data: 'institutionName', name: 'institutionName' },
            { data: 'institutionType', name: 'institutionType' },
            { data: 'code', name: 'code' },
            { data: 'arrivalDate', name: 'arrivalDate' },
            { data: 'depatureDate' , name: 'depatureDate'},
            { "className":      'options',
            "data":           null,
            "render": function(data, type, full, meta){
              var status=data.status;
              
              
              if(status==2)
                return '<span class="label label-default">No Show</span>';
              else
               return '<span class="label label-warning">Pending Arrival</span>';
           }
         },
         {
          "className":      'options',
          "data":           null,
          "render": function(data, type, full, meta){
            var valueHere=data.id;
            return '<button type="button" value="'+valueHere+'" class="btn-sm btn-default btn-transparent" data-toggle="modal" data-target="#modal-reservation-detail">Manage</button>';
          }
        }
        ],
        
      });
           
           
           $(".tabsLi").removeClass('active');
           $("#guar").addClass('active');
           
           $(".tabsPane").removeClass('active in');
           $("#tab1_2").addClass('active in');
           
         }
         
       });
        
        
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
                
                console.log(data.arrivingRooms);
                console.log(data.departingRooms);
                
                if(data.arrivingRooms.length != 0){
                 $("#arrival-date").html(data.arrivingRooms[0]["arrivalDate"]);
                       // var roomListing = $("#depart-rooms");
                       
                       

                       for(var k=0; k < data.arrivingRooms.length; k++){
                        $('#arrival-rooms > tbody:last-child').append('<tr><td>'+data.arrivingRooms[k]["roomName"]+'</td><td>'+data.arrivingRooms[k]["roomType"]+'</td><td>'+data.arrivingRooms[k]["status"]+'</td><td>'+data.arrivingRooms[k]["remarks"]+'</td><td><input id="check'+data.arrivingRooms[k]["roomId"]+'" type="checkbox" name="roomId[]" class="roomcheckbox" value="'+data.arrivingRooms[k]["roomId"]+'"></td></tr>');

                        
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




$(document).ready(function(){
  $('input').on('ifChecked', function(event){
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

  
  
});


$(document).ready(function(){
  $('input').on('ifUnchecked', function(event){
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


</script>

@endsection