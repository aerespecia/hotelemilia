@extends('layouts.frontdeskLayout')

@section('content')
 
<div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar" style="background-color:white;">
          <div class="header-left">
            <div class="topnav">
            
              <ul class="nav nav-tabs no-border">
                <li class="nav-active active"><a href=""><i class="fa fa-calendar-o"></i><span>Home</span></a></li>
                <li><a href="{{route('frontdesk.reservation')}}"><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
               <li><a href="{{route('frontdesk.guestRegistration')}}"><i class="fa fa-users"></i><span>Guest Registration</span></a></li>
               <li class="nav-active"><a href="{{route('frontdesk.guestFolio')}}"><i class="icon-note"></i><span>Guest Folio</span></a></li>
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
                          <li><a href="#tab5_2" data-toggle="tab"><i class="icon-user"></i> Reservation Lists</a></li>
                          <li><a href="#tab5_4" data-toggle="tab"><i class="icon-user"></i> Calendar</a></li>
                          
                       
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane fade in active" id="tab5_1">
                             <div class="panel bg-white">
          <div class="panel-header">
          
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
                {!! Form::close() !!}
                   
                    <h4><strong>Date:</strong> {{$date}}</h4>
               
                <input type="hidden" id="date-main-hidden" value="{{$hiddenDate}}" />
              
              
              
          </div>
            
        
   
              
          <div class="panel-content p-l-0 p-r-0">
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
                          
                          <li class="active"><a href="#tab3_1" data-toggle="tab"><i class="icon-home"></i> Hospitality Suite</a></li>
                          <li><a href="#tab3_2" data-toggle="tab"><i class="icon-home"></i> Matrimonial Suite</a></li>
                          <li><a href="#tab3_3" data-toggle="tab"><i class="icon-home"></i> JR Suite/PWD</a></li>
                          <li><a href="#tab3_4" data-toggle="tab"><i class="icon-home"></i> Deluxe Family Room</a></li>
                          <li><a href="#tab3_5" data-toggle="tab"><i class="icon-home"></i> Standard Family Room</a></li>
                        <li><a href="#tab3_6" data-toggle="tab"><i class="icon-home"></i> Triple Sharing</a></li>
                            <li><a href="#tab3_7" data-toggle="tab"><i class="icon-home"></i> Twin Sharing Deluxe</a></li>
                            <li><a href="#tab3_8" data-toggle="tab"><i class="icon-home"></i> Standard Twin Room</a></li>
                            <li><a href="#tab3_9" data-toggle="tab"><i class="icon-home"></i> Standard Double Room</a></li>
                            <li><a href="#tab3_10" data-toggle="tab"><i class="icon-home"></i> Single Deluxe</a></li>
                            <li><a href="#tab3_11" data-toggle="tab"><i class="icon-home"></i> Standard Single</a></li>
                        </ul>
                        <div class="tab-content">
                         
                          <div class="tab-pane fade active in" id="tab3_1">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '1')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>
                          <div class="tab-pane fade" id="tab3_2">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '2')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>
                          <div class="tab-pane fade" id="tab3_3">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '3')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>
                         <div class="tab-pane fade" id="tab3_4">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '4')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>
                        <div class="tab-pane fade" id="tab3_5">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '5')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>
                        <div class="tab-pane fade" id="tab3_6">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '6')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>
                        <div class="tab-pane fade" id="tab3_7">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '7')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>             
                               <div class="tab-pane fade" id="tab3_8">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '8')
                     
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-select"  style="" data-toggle="modal"  value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>             
                                <div class="tab-pane fade" id="tab3_9">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '9')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 m-b-10 m-t-10 m-l-10 m-r-10 orange-box p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>            
                            <div class="tab-pane fade" id="tab3_10">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '10')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
                            @endforeach   
                            </div>
                          </div>
                              <div class="tab-pane fade" id="tab3_11">
                           <div class="row p-10">
                              @foreach($rooms as $r)
                                  @if($r['room_typeId']== '11')
                      
                                  @if(in_array($r['id'],$blockedRooms))
                                         @if($r['occupied_status'] != 1)
                                        <div class="col-md-3 orange-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3 modal-blocked-select"  style="" data-toggle="modal" data-target="#modal-blocked" value="{{$r['id']}}">
                                    @else
                                        <div class="col-md-3  {{$roomStatusColor[$r['occupied_status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['occupied_status']]}} bd-3 modal-blocked-occ"  style="" data-toggle="modal" data-target="#modal-blocked-occ" value="{{$r['id']}}">
                                    @endif
                                    @else
                                        <div class="col-md-3 {{$roomStatusColor[$r['status']]}}-box m-b-10 m-t-10 m-l-10 m-r-10 p-0 bg-{{$roomStatusColor[$r['status']]}} bd-3"  style="" data-toggle="modal" data-target="" value="{{$r['id']}}">
                                    @endif
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-18"><strong>
                                                @if(in_array($r['id'],$blockedRooms))
                                                    @if($r['occupied_status'] != 1)
                                                    <span class="bg-orange p-5 bd-6">
                                                    @else
                                                    <span class="bg-red p-5 bd-6">
                                                    @endif
                                                @else
                                                  <span class="bg-white p-5 bd-6">  
                                                @endif
                                                      {{$r['roomName']}}
                                                </span>
                                                </strong></h3>
                                      </div>
                                      <center>
                                      <h3 class="f-14" style="margin-top:5px;margin-bottom:5px;"><strong>
                                          
                                          @if(in_array($r['id'],$blockedRooms))
                                                @if($r['occupied_status']!=1)
                                                BLO / {{$roomStatus[$r['status']]}}
                                                @else
                                                OCC
                                                @endif
                                          @else
                                                {{$roomStatus[$r['status']]}}
                                          @endif
                                          </strong></h3>
                                      </center>
                                    </div>
                                    @endif
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
                                
                                
                          <div class="tab-pane" id="tab5_2">
                             <div class="panel">
              
                    <div class="panel-content">
                      <ul class="nav nav-tabs">
                        <li id="active" class="tabsLi active"><a href="#tab1_1" data-toggle="tab">Active Reservations</a></li>
                        <li id="guar" class="tabsLi"><a href="#tab1_2" data-toggle="tab">Guaranteed Reservations</a></li>
                      </ul>
                      <div class="tab-content">
                        <div class="tab-pane tabsPane fade active in" id="tab1_1">
                           <div class="panel bg-light">
                   <div class="panel-header bg-red">
                            <h3>Active Reservations (Not Guaranteed)</h3>
                    </div>
                            <div class="panel-content">
                                   <table id="users-table" class="table table-striped f-12">
                    <thead>
                      <tr>
                <th>Booking person</th>
                <th>Institution</th>
                <th>Type</th>
                <th>Code</th>
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
    $('#users-table').DataTable({
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
                        
                            
                               <div class="col-sm-2">
              
                              <label>Hospitality Suite</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist = false; ?>
                                        @foreach($roomsCheck as $r)
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
                                      @foreach($roomsCheck as $r)
                                            @if($r->type == 1)
                                        <label id="{{$r->id}}" class="f-10">
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
                                        @foreach($roomsCheck as $r)
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
                             <br/>
                            
                          </div>  
                             <div class="col-sm-2">
              
                              <label>Junior Suite/PWD</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist3 = false; ?>
                                        @foreach($roomsCheck as $r)
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
                             <br/>
                            
                          </div>
                            <div class="col-sm-2">
              
                              <label>Deluxe Family Room</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist4 = false; ?>
                                        @foreach($roomsCheck as $r)
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
                                      @foreach($roomsCheck as $r)
                                            @if($r->type == 4)
                                        <label class="f-10" id="{{$r->id}}">
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
              
                              <label>Standard Family Room</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist5 = false; ?>
                                        @foreach($roomsCheck as $r)
                                        @if($r->type==5)
                                        @if(!$exist5)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist5 = true; ?>
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
                             <br/>
                            
                          </div>
                        <div class="col-sm-2">
              
                              <label>Triple Sharing</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist6 = false; ?>
                                        @foreach($roomsCheck as $r)
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
                                      @foreach($roomsCheck as $r)
                                            @if($r->type == 6)
                                        <label class="f-10" id="{{$r->id}}">
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
                                        @foreach($roomsCheck as $r)
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
                                          @foreach($roomsCheck as $r)
                                            @if($r->type == 7)
                                        <label class="f-10" id="{{$r->id}}">
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
                                        @foreach($roomsCheck as $r)
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
                                          @foreach($roomsCheck as $r)
                                            @if($r->type == 8)
                                        <label class="f-10" id="{{$r->id}}">
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
                                        @foreach($roomsCheck as $r)
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
                                          @foreach($roomsCheck as $r)
                                            @if($r->type == 9)
                                        <label class="f-10" id="{{$r->id}}">
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
                                        @foreach($roomsCheck as $r)
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
                                          @foreach($roomsCheck as $r)
                                            @if($r->type == 10)
                                        <label class="f-10" id="{{$r->id}}">
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
                              <label>Standard Single</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist11 = false; ?>
                                        @foreach($roomsCheck as $r)
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
                                          @foreach($roomsCheck as $r)
                                            @if($r->type == 11)
                                        <label class="f-10" id="{{$r->id}}">
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
              
              
              
              
              
              
              
              
        
          <!-- BEGIN MODALS -->
          <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-basic" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog  modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                   
                    
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>ROOM: </strong><span id="modal-room"></span> </h4>
                </div>
                <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="departure-div">
                                <h5><strong>RECENT DEPARTURE INFO:</strong></h5>
                                <hr/>
                                  <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
                        <tr>
                        <td valign="top">
                        
                            <h5><strong>Guest/s:</strong></h5>
                        </td>
                        <td valign="top">
                           <h5 id="basic-guestNames"></h5>
                        </td>
                        </tr>
                    </table>
                            
                            </div>
                      
   
                     </div>
                     <div class="col-md-6 border-left">
                         <h5><strong>Change Room Status</strong></h5><hr/>
                         <div class="row m-b-10">
                             
                                <h5 class="col-md-4">From: </h5>
                                 <div class="col-md-8">
                                 <h5><span id="change-room-status"></span></h5>
                                 </div>
                             
                            
                         </div>
                         <div class="row">
                         <div class="form-group">
                          <h5 class="col-md-4">To
                          </h5>
                          <div class="col-md-8">
                           <div class="option-group f-11">
                                <select id="room-status-select" name="room-status-select">
                                  <option value="" selected>---Change Room Status---</option>
                                  <option value="0">Vacant Ready</option>
                                    <option value="2">Vacant Dirty</option>
                                    <option value="4">Out of Order</option>
                                    <option value="7">House Use</option>
                                  
                                
                                </select>
                              </div>
                          </div><br/><br/>
                        </div>
                         </div>
                         <div class="row m-b-20">
                            <div class="form-group">
                          <h5 class="col-md-4 f-13">Housekeeping Remarks
                          </h5>
                          <div class="col-md-8">
                           <textarea name="" rows="3" class="form-control" placeholder="Enter Housekeeping Remarks"></textarea>
                          </div><br/><br/>
                        </div>
                         </div>
                         
                    </div>
                    </div>
                    
                </div>
                     
                    </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" id="room-status-close" id="modal-basic-close" data-dismiss="modal">Close</button>
             
               
              </div>
            </div>
          </div>
    </div>
    
<!--        RESERVATION DETAIL--->
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

<!--                                            END RESERVATION DETAIL-->
                <!-- MODAL-BLOCKED ---->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-blocked" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-orange">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>ROOM:</strong> <span id="blocked-room-name"></span></h4>
                </div>
                <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-12 border-right">
                         
                                <h3>Reservation Details</h3><hr/>
                         
                        <div class="row">
                            <h5 class="col-md-6">Reservation ID: <strong><span id="blocked-room-reservId"></span></strong></h5>
                            <h5 class="col-md-6">Institution: <strong><span id="blocked-institution"></span></strong></h5>
                           
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Arrival: <strong><span id="blocked-arrival"></span></strong></h5>
                            </div>
                            <div class="col-md-6">
                                <h5>Departure: <strong><span id="blocked-departure"></span></strong></h5>
                            </div>
                            <input type="hidden" id="blocked-trans-id" value=""/>
                        </div>
                        <div class="row">
                            <h5 class="col-md-12">Booking Person: <strong><span id="blocked-booker"></span></strong></h5>    
                        </div>         
                            <hr/>
                              <button type="button" id="blocked-view-guests" class="btn btn-default btn-transparent">View Arriving Guest/s</button>
                        <div class="row">
                        <div class="col-md-12">
                            
                                <div id="arriving-guest-panel" class="panel bg-light p-10">
                                   
                                        <h3 id="blocked-guests-title" class=""><strong>ARRIVING GUEST/S</strong></h3>
                                        <p class="c-red f-14 p-b-0">*Not registered or assigned to any room</p>
                                        <hr/>
                              
                                    <div class="panel-content p-b-10">
                                        
                            <ul class="m-l-30" id="arriving-guest">
                               
                            </ul>
                                    </div>
                                <br/>
                                    
                                            
                                 
                                        
                                </div>
                           
                           
                        </div>
                            </div>
                        
                     </div>
              
                    </div>
                    
                </div>
                     
                    </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Save changes</button>
               
              </div>
            </div>
          </div>
    </div>
    
     <!---MODAL-OCC-BLOCKED-->
         <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal-blocked-occ" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-full">
          <div class="modal-content">
            <div class="modal-header bg-red">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
              <h4 class="modal-title"><strong>ROOM <span id="occ-room-name"></span></strong></h4>
            </div>
            <div class="modal-body" id="modal-occ-content">
              <div class="row">
                <div class="col-md-12">
                    
                    <div class="row">
                      <div class="col-md-6 p-l-30">
                        
                         
                          <h3><strong>ROOM DOWNPAYMENTS</strong></h3><hr/>
                            <div class="row">
                                <h4 class="col-md-6">Reservation ID: <strong><span id="occ-reservID"></span></strong></h4>
                            </div>
                            <div class="row">
                            <h4 class="col-md-6">Arrival Date: <strong><span id="occ-arrival"></span></strong></h4>
                                <h4 class="col-md-6">Departure Date: <strong><span id="occ-depart"></span></strong></h4>
                                
                                <input type="hidden" id="occ-hidden-rate" />
                          </div>
                           <div class="row">
                            <h4 class="col-md-6">Room Rate: <strong><span id="occ-rate"></span></strong></h4>
                                <h4 class="col-md-6">Days Paid: <strong><span id="occ-dayspaid"></span></strong></h4>
                          </div>
                          <div class="row">
                            <h4 class="col-md-6">Discount Rate: <strong><span id="occ-discount"></span></strong></h4>
                                <h4 class="col-md-6">Total Days: <strong><span id="occ-totaldays"></span></strong> </h4>
                          </div>
                          
                          <div class="row"> <h3>Add Downpayment</h3>
                          <div class="col-md-2">
                          
                              <div class="form-group">
                        <label class="form-label">Days to pay</label>
                        <input id="days-counter" type="text" data-vertical="true" value="1" data-step="1" class="numeric-stepper form-control" />
                      </div>      
                        </div>
                        <div class="col-md-2">
                         <label>&nbsp;</label>
                            <button id="compute" class="btn btn-blue">Compute</button>     
                        </div>
                        <div class="col-md-4" style="margin-left:80px;">
                            <label>Total</label>
                           = <input id="totalRate" class="form-control" disabled>
                        </div>
                          </div>
                          <div class="row">
                              <div class="col-md-10">
                              <button id="add-down" style="float:right;margin-right:10px;" class="btn btn-success add-down">Add Downpayment</button>
                              </div>
                              
                            </div>
                      </div>
                       
                            
                       
                      <div class="col-md-6 border-left">
                            <h3><strong>GUEST/S IN THIS ROOM</strong></h3>
                          <hr/>
                        <div class="form-group">
                          
                          <div class="icheck-list" id="checked-in-guests">               
                          </div>
                        </div>
                      
                        <h3><strong>CHARGES</strong></h3>
                          <hr/>
                        <div class="form-group">
                          <label>O.S Slip No.:</label>
                          <input type="text" id="occ-os" name="occ-os" class="form-control" minlength="3" width="200px" placeholder="Enter O.S slip..." required>
                        </div>
                        <div class="form-group">
                          <label>Item</label>
                          <input type="text" id="occ-item" name="occ-item" class="form-control" minlength="3" placeholder="Enter item...">
                        </div>
                        <div class="form-group">
                          <label>Price</label>
                          <input type="text" id="occ-price" name="occ-price" class="form-control" minlength="3" placeholder="Enter item...">
                        </div>
                          <div class="form-group">
                          <label>Type</label>
                          
                          <div>
                                <select id="occ-type" name="occ-type">
                                  <option value="0" selected>---Select Type---</option>
                                  <option value="1">Food and Beverage</option>
                                  <option value="2">Room Service</option>                              
                                </select>
                          </div>
                        </div>
                          <div class="form-group">
                          <label>Entry Type</label>
                          <div class="icheck-inline" id="checked-in-guests">
                                
                                <label>
                                    <input type='radio' id='occ-accountType' name='occ-accountType' class="occ-accountType" value="1" data-radio='iradio_minimal-blue'>Debit 
                              </label>
                                <label>
                                    <input type='radio' id='occ-accountType' name='occ-accountType' class="occ-accountType" value="2" data-radio='iradio_minimal-blue'>Credit
                              </label>
                                        
                          </div>
                        </div><br/><br/>
                          <div class="form-group">
                            <button id="add-charge-occ" class="btn btn-primary btn-transparent">Add Charge</button>
                          </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h3><strong>ROOM CHARGES LIST:</strong></h3>
                            <hr/>
                            
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
                        </div>
                    </div>
               
                    
               
                </div>
              </div>
            </div>
            <div class="modal-footer bg-gray-light">
             <button type="button" id="modal-occ-close" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
            
              
            
            </div>
          </div>
        </div>
      </div>
         
          <!-- END MODALS -->
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
                right: 'month,agendaWeek,agendaDay'
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
            
            
           $.get('{{route("frontdesk.checkRoomAvailability")}}',function(data){
               $.ajax({
                   type:"GET",
                   url: "{{route('frontdesk.checkRoomAvailability')}}",
                   data: dates1,
                   
                   success: function (data){
                       console.log(data);
                       
                       
                       for(var i=1;i<=41;i++){
                           var id = "#"+i;
                           if($.inArray(i,data) > -1)                          
                             $(id).attr('style','display:none');
                           else
                             $(id).attr('style','display:inline');
                             
                       }
                       
                   }
                  
               });
           }); 
            
        });
    });
    


$(document).on("click", ".roomcheckbox", function () {
    alert('yes');
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