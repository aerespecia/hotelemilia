@extends('layouts.frontdeskLayout')

@section('content')
 
<div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar" style="background-color:white;">
          <div class="header-left">
            <div class="topnav">
            
              <ul class="nav nav-tabs no-border">
                <li><a href="{{route('frontdesk.index')}}"><i class="fa fa-calendar-o"></i><span>Rooms</span></a></li>
                <li><a href="{{route('frontdesk.reservation')}}"><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
               <li><a href="{{route('frontdesk.guestRegistration')}}"><i class="fa fa-users"></i><span>Guest Registration</span></a></li>
               <li><a href="{{route('frontdesk.guestFolio')}}"><i class="icon-note"></i><span>Guest Folio</span></a></li>
                <li class="nav-active active"><a href="{{route('frontdesk.nightAudit')}}"><i class="icon-note"></i><span>Night Audit</span></a></li>
                 
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
        <div class="page-content p-l-25 p-r-20 p-t-10">
            
            <div class="btn-group">
        <a class="btn btn-white" href="{{route('frontdesk.dailyGuestArrival')}}"><i class="fa fa-plus"></i>Daily Arrival List</a>
                <a type="button" class="btn btn-white" href="{{route('frontdesk.roomOccupancyBulletin')}}"><i class="fa fa-list"></i>Room Occupancy Bulletin</a>
        <a type="button" class="btn btn-white" href="{{route('frontdesk.dailyDepartureList')}}"><i class="fa fa-list"></i>Daily Departure List</a>
             
    </div>
            <hr class="m-t-5 c-red"/>
          <div class="panel-header">
            <h2><strong>NIGH AUDIT</strong></h2>
              {!! Form::open(['method'=>'GET','action'=>'FrontDeskController@nightAudit','name'=>'formregis','id'=>'FrontDeskController','class'=>'wizard','data-style'=>'simple']) !!}
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
               
              
          </div>
            <?php $occupiedRoomsTotal = 0; 
                  $arrivalTotal = 0;
                  $stayingTotal = 0;
                  $departureTotal = 0;
            ?>
            
            
           <div class="panel">
               <div class="panel-header">
               <h4>ROOM REVENUES/CHARGES</h4>
      
               </div>
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
                <div class="nav-tabs2">
                        <ul class="nav nav-tabs nav-red">
                          <li class="active"><a href="#tab5_1" data-toggle="tab"> ARRIVALS</a></li>
                          <li><a href="#tab5_2" data-toggle="tab">STAYING</a></li>
                          <li><a href="#tab5_3" data-toggle="tab">DEPARTURES</a></li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane active" id="tab5_1">
            
<!--            ARRIVALS-->
            <table class="table table-bordered bg-white">
                    <thead class="f-12">
                      <tr>
                        <th>Room No.</th>
                        <th>Room Type</th>
                        <th>Names of Guests</th>
                        <th>PAX</th>
                        <th>Departure Date</th>
                        <th>Room Rate</th>
                        <th>Discount</th>
                        <th>Total Room Charge</th>
                        <th>DP Settled Thru</th>
                        <th>Status</th>
                       
                      </tr>
                      
                    </thead>
                    <tbody class="f-12">
                       <?php $totalChargeCheckIn = 0; ?>
                        @foreach($roomsArrivals as $r)
                       <?php $occupiedRoomsTotal++; 
                             $arrivalTotal++;
                        ?>
                      <tr>
                        <td>{{$r->roomNo}}</td>
                        <td>{{$r->roomType}}</td>
                        <td valign="top">
                          
                             <?php $guestCount = 0; ?>
                            @foreach($guestsArrivals as $g)
                               
                            <?php $firstName = $g->firstName;
                                ?>
                            @if($g->roomId == $r->id)
                               
                               
                                <ul style="margin-left:20px;">
                                    <li>{{$firstName[0].'. '.$g->familyName}}</li>
                                </ul>
                                <?php $guestCount++; ?>
                            @endif
                                
                            @endforeach 
                        </td>
                        <td>@if($guestCount != 0)
                            {{$guestCount}}
                            @endif
                        </td>
                        <td>{{$r->depatureDate}}</td>
                        <td>&#8369; {{number_format($r->rate,2)}}</td>
                        
                        <td>{{sprintf("%.1f%%", $r->discountValue * 100)}}</td>
                        <td align="right">&#8369; {{number_format($r->rate - ($r->rate * $r->discountValue),2)}}
                          <?php $totalChargeCheckIn+=$r->rate - ($r->rate * $r->discountValue); ?>
                          </td>
                        <td>{{$r->billingType.' - '.$r->chargeType}}</td>
                        <td></td>
                      </tr> 
                        <?php $guestCount=0; ?>
                        @endforeach
                    </tbody>
                  </table>
                        <h4 align="right"><span style="font-weight:normal;">TOTAL:</span> <span style="font-weight:bold;">&#8369; {{number_format($totalChargeCheckIn,2)}} </span> </h4>
                          </div>
                          <div class="tab-pane" id="tab5_2">
                              
<!--     STAYING-->
                     
                <table class="table table-bordered bg-white">
                    <thead class="f-12">
                      <tr>
                        <th>Room No.</th>
                        <th>Room Type</th>
                        <th>Names of Guests</th>
                        <th>PAX</th>
                        <th>Departure Date</th>
                        <th>Room Rate</th>
                        <th>Discount</th>
                        <th>Total Room Charge</th>
                        <th>DP Settled Thru</th>
                        <th>Status</th>
                       
                      </tr>
                      
                    </thead>
                    <tbody class="f-12">
                       <?php $totalChargeStaying = 0; 
                             
                        ?>
                        @foreach($roomsStaying as $rs)
                       <?php $occupiedRoomsTotal++; 
                            $stayingTotal++;
                        ?>
                      <tr>
                        <td>{{$rs->roomNo}}</td>
                        <td>{{$rs->roomType}}</td>
                        <td valign="top">
                          
                             <?php $guestCount = 0; ?>
                            @foreach($guestsArrivals as $g)
                               
                            <?php $firstName = $g->firstName;
                                ?>
                            @if($g->roomId == $rs->id)
                               
                               
                                <ul style="margin-left:20px;">
                                    <li>{{$firstName[0].'. '.$g->familyName}}</li>
                                </ul>
                                <?php $guestCount++; ?>
                            @endif
                                
                            @endforeach 
                        </td>
                        <td>@if($guestCount != 0)
                            {{$guestCount}}
                            @endif
                        </td>
                        <td>{{$rs->depatureDate}}</td>
                        <td>&#8369; {{number_format($rs->rate,2)}}</td>
                        
                        <td>{{sprintf("%.1f%%", $rs->discountValue * 100)}}</td>
                        <td align="right">&#8369; {{number_format($rs->rate - ($rs->rate * $rs->discountValue),2)}}
                          <?php $totalChargeStaying+=$rs->rate - ($rs->rate * $rs->discountValue); ?>
                          </td>
                        <td>{{$rs->billingType.' - '.$rs->chargeType}}</td>
                        <td></td>
                      </tr> 
                        <?php $guestCount=0; ?>
                        @endforeach
                    </tbody>
                  </table>
                        <h4 align="right"><span style="font-weight:normal;">TOTAL:</span> <span style="font-weight:bold;">&#8369; {{number_format($totalChargeStaying,2)}} </span> </h4>
                          </div>
                          <div class="tab-pane" id="tab5_3">
                              
                              <!--DEPARTURE-->
                           <table class="table table-bordered bg-white">
                    <thead class="f-12">
                      <tr>
                        <th>Room No.</th>
                        <th>Room Type</th>
                        <th>Names of Guests</th>
                        <th>PAX</th>
                        <th>Departure Date</th>
                        <th>Room Rate</th>
                        <th>Discount</th>
                        <th>Total Room Charge</th>
                        <th>DP Settled Thru</th>
                        <th>Status</th>
                       
                      </tr>
                      
                    </thead>
                    <tbody class="f-12">
                       <?php $totalChargeDepart = 0; ?>
                        @foreach($roomsDepart as $rd)
                       <?php $occupiedRoomsTotal++; 
                             $departureTotal++;
                        ?>
                      <tr>
                        <td>{{$rd->roomNo}}</td>
                        <td>{{$rd->roomType}}</td>
                        <td valign="top">
                          
                             <?php $guestCount = 0; ?>
                            @foreach($guestsArrivals as $g)
                               
                            <?php $firstName = $g->firstName;
                                ?>
                            @if($g->roomId == $rd->id)
                               
                               
                                <ul style="margin-left:20px;">
                                    <li>{{$firstName[0].'. '.$g->familyName}}</li>
                                </ul>
                                <?php $guestCount++; ?>
                            @endif
                                
                            @endforeach 
                        </td>
                        <td>@if($guestCount != 0)
                            {{$guestCount}}
                            @endif
                        </td>
                        <td>{{$rd->depatureDate}}</td>
                        <td>&#8369; {{number_format($rd->rate,2)}}</td>
                        
                        <td>{{sprintf("%.1f%%", $rd->discountValue * 100)}}</td>
                        <td align="right">&#8369; {{number_format($rd->rate - ($rd->rate * $rd->discountValue),2)}}
                          <?php $totalChargeDepart+=$rd->rate - ($rd->rate * $rd->discountValue); ?>
                          </td>
                        <td>{{$rd->billingType.' - '.$rd->chargeType}}</td>
                        <td></td>
                      </tr> 
                        <?php $guestCount=0; ?>
                        @endforeach
                    </tbody>
                  </table>
                        <h4 align="right"><span style="font-weight:normal;">TOTAL:</span> <span style="font-weight:bold;">&#8369; {{number_format($totalChargeDepart,2)}} </span> </h4>
                          </div>
                        </div>
                      </div>
             
            </div>
          </div>
               
                
       <br/>
                <div class="row">
                   
                        
                                        <h4 class="col-md-6"><strong>Summary</strong></h4>
                                   
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php $percentage = ($occupiedRoomsTotal/41)*100; ?>
                                    <h5 style="font-weight:bold;">Occupancy Rate:</h5> <h2>{{$occupiedRoomsTotal}}/41 ({{sprintf("%.0f%%",$percentage)}})</h2>
                                        
                                            <div class="progress progress-bar-large" style="width:60%;">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: {{$percentage}}%">
                         
                        </div>
                      </div>
                                     
                                        
                                    <?php
                                        $vacant = 41-$occupiedRoomsTotal;
                                       // $
                                    ?>
                                   
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h5 style="font-weight:bold;">Vacant: <strong>{{$vacant}}</strong></h5>
                                  
                                            <h5 style="font-weight:bold;">House Use: <strong></strong></h5>
                                  
                                            <h5 style="font-weight:bold;">Out of Order: <strong></strong></h5>
                                        </div>
                                        <div class="col-md-6">
                                            <h5 style="font-weight:bold;">Arrivals: <strong>{{$arrivalTotal}}</strong></h5>
                                            <h5 style="font-weight:bold;">Staying: <strong>{{$stayingTotal}}</strong></h5>
                                            <h5 style="font-weight:bold;">Departures: <strong>{{$departureTotal}}</strong></h5>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            
                            </div>
                            
                        </div>
                   
                
                </div>
               </div>
            </div>
          <hr/>
         
          <!-- BEGIN MODALS -->
          <div class="modal fade" id="modal-basic" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>ROOM</strong> STATUS</h4>
                </div>
                <div class="modal-body">
                  My content...<br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modal-large" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Large width</strong> modal</h4>
                </div>
                <div class="modal-body">
                  My content...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modal-full" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Fullwidth</strong> modal</h4>
                </div>
                <div class="modal-body">
                  Resize your window to see fullwidth resizing.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modal-responsive" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Responsive</strong> modal</h4>
                </div>
                <div class="modal-body">
                  <p>Change screen size to see responsive behaviour.</p>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-1" class="control-label">Name</label>
                        <input type="text" class="form-control" id="field-1" placeholder="Steve">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="field-2" class="control-label">Surname</label>
                        <input type="text" class="form-control" id="field-2" placeholder="Winston">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="field-3" class="control-label">Address</label>
                        <input type="text" class="form-control" id="field-3" placeholder="Address">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="field-4" class="control-label">City</label>
                        <input type="text" class="form-control" id="field-4" placeholder="New York">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="field-5" class="control-label">Country</label>
                        <input type="text" class="form-control" id="field-5" placeholder="USA">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="field-6" class="control-label">Zip</label>
                        <input type="text" class="form-control" id="field-6" placeholder="24587">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer text-center">
                  <button type="button" class="btn btn-primary btn-embossed bnt-square" data-dismiss="modal"><i class="fa fa-check"></i> Validate</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade modal-topfull" id="modal-topfull" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-topfull">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Top Fullwidth</strong> modal</h4>
                </div>
                <div class="modal-body">
                  My content...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade modal-bottomfull" id="modal-bottomfull" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Bottom Fullwidth</strong> modal</h4>
                </div>
                <div class="modal-body">
                  My content...
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade modal-slideright" id="modal-slideright" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="c-primary m-b-30">Are you sure you want to proceed?</h2>
                      <button type="button" class="btn btn-primary btn-embossed btn-block" data-dismiss="modal">Yes, I'm sure</button>
                      <button type="button" data-dismiss="modal" class="btn btn-white btn-block">Oops, I prefer not!</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade modal-slideleft" id="modal-slideleft" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                      <h2 class="c-primary m-b-30">Are you sure you want to proceed?</h2>
                      <button type="button" class="btn btn-primary btn-embossed btn-block" data-dismiss="modal">Yes, I'm sure</button>
                      <button type="button" data-dismiss="modal" class="btn btn-white btn-block">Oops, I prefer not!</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade modal-image" id="modal-image" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                </div>
                <div class="modal-body">
                  <img src=" assets/global/images/gallery/transport3.jpg" alt="picture 1" class="img-responsive">
                </div>
                <div class="modal-footer">
                  <p>Title of your image</p>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="colored-header" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Colored</strong> Header</h4>
                </div>
                <div class="modal-body">
                  <p>Want colors? Click on a color to switch header look:</p>
                  <div class="p-t-20 m-b-20 p-l-40">
                    <ul class="colors-list color-header">
                      <li class="dark"></li>
                      <li class="red"></li>
                      <li class="green"></li>
                      <li class="blue active"></li>
                      <li class="aero"></li>
                      <li class="gray"></li>
                      <li class="orange"></li>
                      <li class="pink"></li>
                      <li class="purple"></li>
                    </ul>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="modal-footer" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Colored</strong> Footer</h4>
                </div>
                <div class="modal-body">
                  <p class="m-t-40">Like for header, you can add colors. Click on a color to switch header look:</p>
                  <div class="p-t-20 m-b-20 p-l-40">
                    <ul class="colors-list color-footer">
                      <li class="dark active"></li>
                      <li class="red"></li>
                      <li class="green"></li>
                      <li class="gray-light"></li>
                      <li class="blue"></li>
                      <li class="aero"></li>
                      <li class="gray"></li>
                      <li class="orange"></li>
                      <li class="pink"></li>
                      <li class="purple"></li>
                    </ul>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Save changes</button>
                </div>
              </div>
            </div>
          </div>
          <div class="modal fade" id="full-colored" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content bg-primary">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title">Full <strong>Colored</strong></h4>
                </div>
                <div class="modal-body">
                  <p class="m-t-40">Like for header, you can add colors. Click on a color to switch header look:</p>
                  <div class="p-t-20 m-b-20 p-l-40">
                    <ul class="colors-list color-full">
                      <li class="dark active"></li>
                      <li class="red"></li>
                      <li class="green"></li>
                      <li class="gray-light"></li>
                      <li class="blue"></li>
                      <li class="aero"></li>
                      <li class="gray"></li>
                      <li class="orange"></li>
                      <li class="pink"></li>
                      <li class="purple"></li>
                    </ul>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-dark" data-dismiss="modal">Save changes</button>
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
      </div>


@endsection