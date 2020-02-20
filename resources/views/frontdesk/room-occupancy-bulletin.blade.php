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
            <div class="btn-group">
              <a class="btn btn-white" href="{{route('frontdesk.dailyGuestArrival')}}"><i class="fa fa-plus"></i>Daily Arrival List</a>
                <a type="button" class="btn btn-white active" href="{{route('frontdesk.roomOccupancyBulletin')}}"><i class="fa fa-list"></i>Room Occupancy Bulletin</a>
        <a type="button" class="btn btn-white" href="{{route('frontdesk.dailyDepartureList')}}"><i class="fa fa-list"></i>Daily Departure List</a>
             
    </div>
            
           
          <hr class="m-t-5 c-red"/>
          <div class="header">
            <h2><strong>ROOM OCCUPANCY BULLETIN</strong></h2>
          </div>
           
           <div class="panel">
               <div class="panel-header">
                <h3>Date Today: September 1, 2016</h3>
               </div>
            <div class="panel-content">
                <div class="row">
            <div class="col-md-12">
             <table id="users-table" class="table table-bordered">
                    <thead class="f-10">
                      <tr>
                        
                        <th rowspan="2">Rm. No.</th>
                        <th rowspan="2">Room Type</th>
                        <th rowspan="2">Room Status</th>
                        <th colspan="5" style="text-align:center;">Arrivals</th>
                        <th colspan="4" style="text-align:center;">Staying</th>
                        <th colspan="4" style="text-align:center;">Departure</th>
                      </tr>
                    <tr>
                        
                        <th>Names of Arriving Guests</th>
                        <th>Billing Status</th>
                        <th>Rate</th>
                        <th>Arrival Time</th>
                        <th>Departure</th>
                        <th>Name/s of Guests</th>
                        <th>Rate</th>
                        <th>Departure date/time</th>
                        <th>Billing Status</th>
                         <th>Name/s of Guests</th>
                        <th>Rate</th>
                        <th>Billing Status</th>
                        <th>Departure Time</th>
                        </tr>
                    </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: false,
        serverSide: true,
        ajax: '{!! route('frontdesk.dataTablesRoomOccupancyBulletinList') !!}',
        columns: [
            
            { data: 'roomName' , name: 'roomName' },
            { data: 'RoomType' , name: 'RoomType' },
            { data: 'blanks' , name: 'blanks' },

            { data: 'guestNamesArrival', name: 'guestNamesArrival' },
            { data: 'billingTypeArival', name: 'billingTypeArival' },
            { data: 'RoomTypeRateArival', name: 'RoomTypeRateArival' },
            { data: 'arrivalDateArival' , name: 'arrivalDateArival' },
            { data: 'depatureDateArival' , name: 'depatureDateArival' },

            { data: 'guestNamesStaying', name: 'guestNamesStaying' },
            { data: 'RoomTypeRateStaying', name: 'RoomTypeRateStaying' },
            { data: 'depatureDateStaying' , name: 'depatureDateStaying' },
            { data: 'billingTypeStaying', name: 'billingTypeStaying' },
            
            { data: 'guestNamesDepature', name: 'guestNamesDepature' },
            { data: 'RoomTypeRateDepature', name: 'RoomTypeRateDepature' },
            { data: 'depatureDateDepature' , name: 'depatureDateDepature' },
            { data: 'billingTypeDepature', name: 'billingTypeDepature' },



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