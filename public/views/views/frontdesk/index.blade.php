@extends('layouts.frontdeskLayout')

@section('content')
 
<div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar" style="background-color:white;">
          <div class="header-left">
            <div class="topnav">
            
              <ul class="nav nav-tabs no-border">
                <li class="nav-active active"><a href=""><i class="fa fa-calendar-o"></i><span>Rooms</span></a></li>
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
            <div class="btn-group">
        <a class="btn btn-white" href="{{route('frontdesk.dailyGuestArrival')}}"><i class="fa fa-plus"></i>Daily Arrival List</a>
                <a type="button" class="btn btn-white" href="{{route('frontdesk.roomOccupancyBulletin')}}"><i class="fa fa-list"></i>Room Occupancy Bulletin</a>
        <a type="button" class="btn btn-white" href="{{route('frontdesk.dailyDepartureList')}}"><i class="fa fa-list"></i>Daily Departure List</a>
             
    </div>
            
            <hr class="m-t-5 c-red"/>
          <div class="header">
              <h2><strong>ROOM STATUS: </strong></h2>
              <h4><strong>DATE:</strong><strong class="c-red"> Tuesday - September 13, 2016</strong></h4>
          </div>
            <!-- 
           <div class="panel panel-transparent p-10">
                <div class="panel-content p-10">
               
              
            <div class="row">
            <div class="col-md-12">
             <div class="row">
              <div class="widget-infobox">
               <div class="infobox bg-blue">
                <div class="txt"><h5>TOTAL ROOMS</h5></div> 
                  <div class="right">
                    <div>
                      <span data-from="0" data-to="41" class="number countup pull-left m-l-30" style="color:white;font-size:25px;">0</span>
                    </div>     
                  </div>
                </div> <div class="infobox bg-green">
                <div class="txt"><h5 style="color:white;">VACANT</h5></div> 
                  <div class="right">
                    <div>
                      <span data-from="0" data-to="30" class="number countup c-dark pull-left m-l-30" style="color:white;font-size:25px;">0</span> 
                    </div>     
                  </div>
                </div>
              <div class="infobox bg-orange">
                <div class="txt"><h5 style="color:white;">OCCUPIED</h5></div> 
                  <div class="right">
                    <div>
                      <span data-from="0" data-to="5" class="number countup c-dark pull-left m-l-30" style="color:white;font-size:25px;">0</span> 
                    </div>     
                  </div>
                </div>
                <div class="infobox bg-red">
                <div class="txt"><h5 style="color:white;">BOOKED</h5></div> 
                  <div class="right">
                    <div>
                      <span data-from="0" data-to="21" class="number countup c-dark pull-left m-l-30" style="color:white;font-size:25px;">0</span> 
                    </div>     
                  </div>
                </div>
               <div class="infobox bg-purple">
                <div class="txt"><h5 style="color:white;">DIRTY</h5></div> 
                  <div class="right">
                    <div>
                      <span data-from="0" data-to="3" class="number countup c-dark pull-left m-l-30" style="color:white;font-size:25px;">0</span> 
                    </div>     
                  </div>
                </div>
                <div class="infobox bg-gray">
                <div class="txt"><h5 style="color:white;">OUT OF ORDER</h5></div> 

                  <div class="right">
                    <div>
                      <span data-from="" data-to="" class="number c-dark pull-left m-l-30" style="color:white;font-size:25px;">0</span> 
                    </div>     
                  </div>
                </div>
            </div>
            </div>
            </div>
          </div>
       
            </div>
            </div>
            <hr/>   -->
          <div class="panel bg-white">
          <div class="panel-header">
            <h3><strong>ROOM STATUS BOARD</strong></h3>
              <h4>{{$date}}</h4>
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
                                <h5>OOO - Out of Order</h5>
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
              <div class="col-md-12">
                  <div class="col-md-8">
                      
                      <div class="panel p-5">
                        <div class="panel-content">
                          
                          
                      <div class="row">
                          <div class="col-md-2">
                      <h5 class="f-11" align="center"><strong>ROOM TYPES</strong></h5>
                </div>
                    <div class="col-md-10">
                               
                    <h5 class="f-20" align="center"><strong>ROOMS</strong></h5>
                </div>
                      </div>
                      
                      <div class="row border-bottom ">
                          
                          <div class="col-md-2">
                               <h5 align="center"><strong>Standard Single</strong></h5>
                         </div>
                        
                            <div class="col-md-2 p-0">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-yellow bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;cursor:pointer;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>212</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VD</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                          <div class="col-md-2 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-yellow bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;cursor:pointer;" data-toggle="modal" data-target="#modal-two">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong><span class="bg-orange p-5 bd-6">312</span></strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VD</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                       
                         <div class="col-md-2 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-red bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;cursor:pointer;" data-toggle="modal" data-target="#modal-three">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong><span class="bg-red p-5 bd-6">317</span></strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>OCC</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                        
                         <div class="col-md-2 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>318</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                       
                      
                        </div>
                        
                      <div class="row border-bottom ">
                          
                          <div class="col-md-2 p-0">
                               <h5 align="center"><strong>Family Suite</strong></h5>
                         </div>
                        
                            <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>202</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         

                         <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>316</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>202</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         

                         <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>316</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>202</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         

                         <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>316</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
       
                        </div>
                        
                      <div class="row border-bottom">
                          
                          <div class="col-md-2 p-0">
                               <h5 align="center"><strong>Double Standard Room</strong></h5>
                         </div>
                        
                            <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>204</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>

                         <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>205</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                       
                         <div class="col-md-1 p-0 border-left border-right">
                                <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>303</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                        
                         <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>304</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                       
                         <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>307</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>403</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>404</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>407</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                        </div>
                        
                      <div class="row border-bottom ">
                          
                          <div class="col-md-2 p-0">
                               <h5 align="center"><strong>Double Deluxe</strong></h5>
                         </div>
                        
                            <div class="col-md-2 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-20"><strong>203</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         

                         <div class="col-md-2 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-20"><strong>302</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                       
                         <div class="col-md-2 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-20"><strong>311</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                        
                         <div class="col-md-2 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-20"><strong>402</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                       
                         <div class="col-md-2 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-20"><strong>411</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                        </div>
                        
                      <div class="row border-bottom">
                          
                          <div class="col-md-2 p-0">
                               <h5 align="center"><strong>Twin Share</strong></h5>
                         </div>
                        
                            <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>206</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         

                         <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>207</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                       
                         <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>209</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                        
                         <div class="col-md-1 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>305</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                       
                         <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>306</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>309</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>315</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>405</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>406</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          <div class="col-md-1 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-13"><strong>409</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-11" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                        </div>
                    </div>
                      </div>
                      </div>
                  
                  <div class="col-md-4">
                       <div class="panel p-5">
                        <div class="panel-content">
                <div class="row">
                          <div class="col-md-3">
                      <h5 class="f-10" align="center"><strong>ROOM TYPES</strong></h5>
                </div>
                    <div class="col-md-9">
                               
                    <h5 class="f-19" align="center"><strong>ROOMS</strong></h5>
                </div>
                      </div>
                      
                      <div class="row">
                          
                          <div class="col-md-3">
                               <h5 align="center" class="f-12"><strong>Twin Share Deluxe</strong></h5>
                         </div>
                        
                            <div class="col-md-3 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>314</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                          
                      
                        </div>
                        <div class="row">
                          
                          <div class="col-md-3">
                               <h5 align="center" class="f-12"><strong>Triple Sharing</strong></h5>
                         </div>
                        
                            <div class="col-md-3 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>210</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                            <div class="col-md-3 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>310</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                            <div class="col-md-3 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>410</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                          
                      
                        </div>
                            <div class="row">
                          
                          <div class="col-md-3">
                               <h5 align="center" class="f-12"><strong>Hospitality Suite</strong></h5>
                         </div>
                        
                            <div class="col-md-3 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>201</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                          
                      
                        </div>
                            <div class="row">
                          
                          <div class="col-md-3">
                               <h5 align="center" class="f-12"><strong>PWD Room</strong></h5>
                         </div>
                        
                            <div class="col-md-3 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>211</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                         
                          
                      
                        </div>
                            <div class="row">
                          
                          <div class="col-md-3">
                               <h5 align="center" class="f-12"><strong>Single Deluxe</strong></h5>
                         </div>
                        
                            <div class="col-md-3 p-0 border-left border-right">
                                  <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>313</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
                                    </div>
                            </div>
                            <div class="col-md-3 p-0 border-left border-right">
                                 <div class="panel p-0 m-b-0 m-t-0 bg-green bd-3"  style="border-style:solid;border-width:2px;border-color:#2B2E33;" data-toggle="modal" data-target="#modal-basic">
                                        <div class="panel-header bg-white">
                                            <h3 align="center" class="f-15"><strong>316</strong></h3>
                                        </div>
                                      <center>
                                      <h3 class="f-10" style="margin-top:5px;margin-bottom:5px;"><strong>VR</strong></h3>
                                      </center>
                                        
                                    
                                    
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
          <div class="modal fade" id="modal-basic" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>ROOM:</strong> 212</h4>
                </div>
                <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                        <h5>No reservations for this day</h5> 
                        <h5 class="c-red">*Just checked out</h5>
                     </div>
                     <div class="col-md-6 border-left">
                         <h5><strong>Change Room Status</strong></h5><hr/>
                         <div class="row m-b-10">
                             
                                <h5 class="col-md-4">From: </h5>
                                 <div class="col-md-8">
                                 <h5><span class="bg-yellow p-5 bd-6">Vacant Dirty</span></h5>
                                 </div>
                             
                            
                         </div>
                         <div class="row">
                         <div class="form-group">
                          <h5 class="col-md-4">To
                          </h5>
                          <div class="col-md-8">
                           <div class="option-group f-11">
                                <select id="madeThru" name="madeThru">
                                  <option value="0" selected>Vacant Ready</option>
                                  <option value="1">Out of order</option>
                                  
                                
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
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Save changes</button>
               
              </div>
            </div>
          </div>
    </div>
    
    <div class="modal fade" id="modal-two" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-orange">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>ROOM:</strong> 312 - BLO</h4>
                </div>
                <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                         
                                <h5><strong>Reservation Details</strong></h5><hr/>
                         
                        <div class="row">
                            <h6 class="col-md-5">Reservation ID:</h6>
                            <div class="col-md-7">
                                <h6><strong>261608-0001-F6BY</strong></h6>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class="col-md-5">Arriving Guests:</h6>
                            <div class="col-md-7">
                                <h6><strong>Melvin Cruz, Juan Dela Cruz</strong></h6>
                            </div>
                        </div>
                        <div class="row">
                            <h6 class="col-md-5">Date of Departure:</h6>
                            <div class="col-md-7">
                                <h6><strong>September 16, 2016</strong></h6>
                            </div>
                        </div>
                        
                     </div>
                     <div class="col-md-6 border-left">
                         <h5><strong>Change Room Status</strong></h5><hr/>
                         <div class="row m-b-10">
                             
                                <h6 class="col-md-4">From: </h6>
                                 <div class="col-md-8">
                                 <h5><span class="bg-yellow p-5 bd-6">Vacant Dirty</span></h5>
                                 </div>
                             
                            
                         </div>
                         <div class="row">
                         <div class="form-group">
                          <h6 class="col-md-4">To
                          </h6>
                          <div class="col-md-8">
                           <div class="option-group f-11">
                                <select id="madeThru" name="madeThru">
                                  <option value="0" selected>Vacant Ready</option>
                                  <option value="1">No Show</option>
                                  
                                
                                </select>
                              </div>
                          </div><br/><br/>
                        </div>
                         </div>
                         <div class="row m-b-20">
                            <div class="form-group">
                          <h6 class="col-md-4">Housekeeping Remarks
                          </h6>
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
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Save changes</button>
               
              </div>
            </div>
          </div>
    </div>
    
     <div class="modal fade" id="modal-three" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-red">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>ROOM:</strong> 312 - OCC</h4>
                </div>
                <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-9 border-right">
                         
                                <h5><strong>Food and Room Charges</strong></h5><hr/>
                        <div class="panel-content pagination2 table-responsive" style="overflow-y:auto; height:300px;">
                 
                  <div class="m-b-20">
                    <div class="btn-group">
                      <button onclick="clearFunc()" id="table-edit_new" data-toggle="modal" data-target="#modal-select" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add</button>
                    </div>
                  </div>
                  <table id="guestTable" class="table table-hover">
                    <thead>
                      <tr>
                        <th>Date</th>
                        <th>OR No./Slip No.</th>
                        <th>Guest Name</th>
                        <th>Item</th>
                        <th>Type</th>
                    
                      </tr>
                    </thead>
                    <tbody>
                    
                   <tr>
                    <td></td>
                       <td></td>   
                       <td></td>   
                   
                </tr>
                    
                     
                    </tbody>
                  </table>
                </div>
                        
                     </div>
                     <div class="col-md-3">
                         <h5><strong>Change Room Status</strong></h5><hr/>
                         <div class="row m-b-10">
                             
                                <h6 class="col-md-4">Slept Out: </h6>
                                 <div class="col-md-8">
                                 <div class="icheck-inline">
                                  <label class="f-11"><input type="radio" name="guaranteed" data-radio="iradio_minimal-blue"> Yes</label>
                                  <label class="f-11"><input type="radio" name="guaranteed" checked data-radio="iradio_minimal-blue"> No</label>
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
    
         <div class="modal fade" id="modal-select" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
              <h4 class="modal-title"><strong>ADD GUEST</strong> details</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Guest/s</label>
                          <div class="icheck-inline">
                                        <label class="f-10">
                                            <input type="checkbox" data-checkbox="icheckbox_square-blue"> Melvin Cruz</label>
                                        <label class="f-10">
                                            <input type="checkbox" data-checkbox="icheckbox_square-blue"> Juan Dela Cruz</label>
                                        
                                        </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Item</label>
                          <input type="text" id="familyName" name="familyName" class="form-control" minlength="3" placeholder="Enter item..." required>
                        </div>
                          <div class="form-group">
                          <h6 class="col-md-4">Type
                          </h6>
                          <div class="col-md-8">
                           <div class="option-group f-11">
                                <select id="madeThru" name="madeThru">
                                  <option value="0" selected>---Select Type---</option>
                                  <option value="1">Food and Beverage</option>
                                  <option value="1">Room Service</option>
                                  
                                
                                </select>
                              </div>
                          </div><br/><br/>
                        </div>
                      </div>
                    </div>
                    <div class="row m-t-10">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>OR No.</label>
                          <input type="text" id="contact" name="contact" class="form-control" minlength="3" placeholder="Enter OR No." required>
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
  


@endsection