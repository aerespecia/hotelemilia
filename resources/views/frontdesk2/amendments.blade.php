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
                <li><a href="{{route('frontdesk.nightAudit')}}"><i class="icon-note"></i><span>Night Audit</span></a></li>
                <li class="nav-active active"><a href="{{route('frontdesk.amendments')}}"><i class="icon-note"></i><span>Amendments</span></a></li>
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
        <div class="page-content p-l-40 p-r-40 p-t-10">
            
            
            <hr class="m-t-5 c-red"/>
          <div class="header">
            <h2><strong>AMENDMENTS</strong></h2>
          </div>

          <div class="header">

              
              
          <hr class="m-b-0"/>
          </div>
            @if(!$registExist)
            <div class="row">
            <div class="col-md-12">
                    <div class="panel">
                     <div class="panel-header bg-dark">
                  <h4><strong>RESERVATION </strong>LOOK UP</h4>
                  <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-eye"></i> Show/Hide</a>
                
                  </div>
                </div>
           <div class="panel-content">
           <div class="row">
             <div class="col-md-12 portlets">
                    <h3><strong>SEARCH:</strong></h3>
                    <div class="panel">
                 
                        <div class="panel-content m-b-0">
                            <div class="row">
                                <div class="col-md-12">
                                     <div class="form-group">
                              <h5>RESERVATION ID:</h5>
                                         
                                {!! Form::open(['method'=>'GET','action'=>'FrontDeskController@ammendmentRooms']) !!}
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
                    <hr/>
                        
                    </div>
          

            
            </div>
            
            
            </div>
            </div>            
            </div>
                
            </div>
            </div>
        @endif
            
            @if($registExist)
            <div class="row">
                <div class="col-md-12">
                
                
                      <div class="panel">
                        <div class="panel-header">
                            <h4><i class="fa fa-users"></i> <strong>Guest List</strong></h4>
                           
                            <hr/>
                           
                            
                           
                </div>
                        <div class="panel-content">
                             
                            <div class="panel panel-transparent">
                
                <div class="panel-content" style="height:200px;overflow-y:scroll;">
                  <table class="table table-hover f-12">
                    <thead>
                      <tr>
                        <th>Name</th>
                        
                        <th>Room</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                        @if($guests)
                    <tbody>
                      
                         @foreach($guests as $g)
                      <tr>
                        <td>{{$g->guestNamesGroup}}</td>
                          <input type="hidden" id="{{'grId'.$g->id}}" name="{{'grId'.$g->id}}" value="{{$g->grId}}"/>

                          <td>
                            {{$g->roomName}}<input type="hidden" id="{{'guestRM'.$g->id}}" value="{{$g->roomName}}"/>

                          <input type="hidden" id="{{'guestDateAr'.$g->id}}" value="{{$g->arrivalDate}}"/>
                          <input type="hidden" id="{{'guestDateDe'.$g->id}}" value="{{$g->depatureDate}}"/>

                          <input type="hidden" id="{{'guestrrId'.$g->id}}" value="{{$g->rrId}}"/>
                      </td>
                        
                        
                        <td><button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-transparent edit-modal" id="edit-modal" value="{{$g->id}}">Edit</button></td>
                        
                        
                        
                        
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
                 
@endif
<hr>


            <div class="panel">
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="users-table" class="table table-striped">
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
    $('#users-table').DataTable({

        processing: true,
        serverSide: false,
        ajax: '{!! route('frontdesk.dataTablesAmmendmentTables') !!}',
        
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
            <!--- EDIT GUEST REGISTRATION BEGIN -->
        
            
        <!--- PRINT MODAL -->
          
            <!--- GUEST REGISTRATION MODAL BEGINS -->    
        <div class="modal fade" id="modal-guest-edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Change Room:</strong> <span id="title-name"></span></h4>
                 
                </div>
                <div class="modal-body" id="guest-modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>UPDATE GUEST ROOM:</strong></h2><hr/>
                    </div>
                    
                    
                    
                    
                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
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
                        </div>
                        <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Current Room</label>
                             
                                <input type="text" name="room-exist" id="room-exist" class="form-control" value="">
                                <input type="hidden" name="guestSRRID" id="guestSRRID" class="form-control" value="">
                                <input type="hidden" name="currentUserId" id="currentUserId" class="form-control" value="{{$user->id}}">
                                
                                
                            </div>
                          </div>

                          
                            
                        </div>
                      </div>

                      </div>
                             
                          <div class="panel">
                              <div class="panel-header">
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
                              
                
                              <label class="control-label">Notes</label>
                                <textarea name="notes" id="notes" rows="5" class="form-control" placeholder="Notes"></textarea>
                                </div>
                            </div>
                          </div>
                                <h4><strong>Room Availability</strong></h4>
                                  <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                        <label class="form-label">Arrival and Departure</label>
                        <div class="input-daterange b-datepicker input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" id="arrival2" name="arrival2" placeholder="Arrival"/>
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control" id="departures2" name="departures2" placeholder="Departure"/>
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
                                        @if($code)
                                        @foreach($rooms as $r)
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
                                        @foreach($rooms as $r)
                                            @if($r->type == 1)
                                        <label id="{{$r->id}}" class="f-10">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
                                        @foreach($rooms as $r)
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
                                        @foreach($rooms as $r)
                                            @if($r->type == 2)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
              
                              <label>Junior Suite/PWD</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist3 = false; ?>
                                        @if($code)
                                        @foreach($rooms as $r)
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
                                        @foreach($rooms as $r)
                                            @if($r->type == 3)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
                                        @foreach($rooms as $r)
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
                                        @foreach($rooms as $r)
                                            @if($r->type == 4)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
              
                              <label>Standard Family Room</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     
                                        <?php $exist5 = false; ?>
                                        @if($code)
                                        @foreach($rooms as $r)
                                        @if($r->type==5)
                                        @if(!$exist5)
                                     <h6><strong>Rate:</strong> &#x20b1; {{number_format($r->rate,2)}} </h6>
                                            <?php $exist5 = true; ?>
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
                                        @foreach($rooms as $r)
                                            @if($r->type == 5)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
                                        @foreach($rooms as $r)
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
                                        @foreach($rooms as $r)
                                            @if($r->type == 6)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
                                        @foreach($rooms as $r)
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
                                        <h6 class="m-t-0"><strong>Available: <span class="c-red">5</span></strong></h6>    
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($rooms as $r)
                                            @if($r->type == 7)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
                                        @foreach($rooms as $r)
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
                                        <h6 class="m-t-0"><strong>Available: <span class="c-red">5</span></strong></h6>    
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($rooms as $r)
                                            @if($r->type == 8)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
                                        @foreach($rooms as $r)
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
                                        <h6 class="m-t-0"><strong>Available: <span class="c-red">5</span></strong></h6>    
                                    </div>
                                 
                                </div>
                                <div class="row">
                                      
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($rooms as $r)
                                            @if($r->type == 9)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
                                        @foreach($rooms as $r)
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
                                        <h6 class="m-t-0"><strong>Available: <span class="c-red">5</span></strong></h6>    
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($rooms as $r)
                                            @if($r->type == 10)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
                                        @foreach($rooms as $r)
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
                                        <h6 class="m-t-0"><strong>Available: <span class="c-red">5</span></strong></h6>    
                                    </div>
                                 
                                </div>
                                <div class="row">
                                    
                                    <div class="col-sm-12">
                                       
                                        <div class="form-group">
                                        <h6 class="m-t-0"><strong>Rooms: </strong></h6>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                          @if($code)
                                        @foreach($rooms as $r)
                                            @if($r->type == 11)
                                        <label class="f-10" id="{{$r->id}}">
                                            <input type="radio" name="roomId" id="roomId" value="{{$r->id}}" data-checkbox="icheckbox_square-blue"> {{$r->roomName}}</label>
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
                    </div>
                    
                  
                 
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed"  id="close">CLOSE</button>
                    
                  <button type="button" class="btn btn-success btn-embossed guest-room-edit-save" id="" value=""> SAVE</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>
            
       
            
      
          
            <!--- GUEST REGISTRATION MODAL BEGINS -->    
       
        <!-- END PAGE CONTENT -->
      </div>

    
    <meta name="_token" content="{!! csrf_token() !!}" />
<script src="{{url('assets/jquery/jquery-1.12.4.js')}}"></script>
<script src="{{url('assets/jquery/jquery-ui-1.12.1/jquery-ui.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        
        $(".edit-modal").click(function(){
            var guestID = $(this).val();
        
                $.get("../frontdesk/guest-edit/"+guestID,function(data){
                    console.log(data);
                    $("#title-name").html(data.firstName+" "+data.familyName);
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
                    $(".guest-edit-save").val(data.id);
                    $("#guestReservID").val($("#grId"+guestID).val());
                    $("#room-exist").val($("#guestRM"+guestID).val());

                    $("#arrival2").val($("#guestDateAr"+guestID).val());
                    $("#departures2").val($("#guestDateDe"+guestID).val());

                    
                    $("#guestSRRID").val($("#guestrrId"+guestID).val());


                });
        });
        
        
    });
    
    $(document).ready(function(){
        $("#close").click(function(){
            location.reload();
        });
    });
    $(document).ready(function(){
        
        
        $(".guest-room-edit-save").click(function(){
            
            //var guestID = $(this).val();
           var valuesChecked= $('input[name=roomId]:checked').val();
            
            var guestDetails = {
                  guestSRRID: $("#guestSRRID").val(),
                  currentUserId: $("#currentUserId").val(),
                  chargeRoom:$("#chargeRoom").val(),
                  roomId: valuesChecked,
                  notes: $("#notes").val(),
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


         
          <!-- BEGIN MODALS -->
         
         
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

<script type="text/javascript">
   
    
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
                       
                       for(i=125;i<=165;i++){
                           var id = "#"+i;
                           if($.inArray(i,data) == -1)                          
                               $(id).attr('style','display:block;');  
                           else{
                               $(id).attr('style','display:none;'); 
  
                           }   
                       }
                       
                   }
                  
               });
           }); 
            
        });
    });
</script>
@endsection