@extends('layouts.frontdeskLayout')



@section('content')






<div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar" style="background-color:white;">
          <div class="header-left">
            <div class="topnav">
            
              <ul class="nav nav-tabs no-border">
                <li><a href="{{route('frontdesk.index')}}"><i class="fa fa-calendar-o"></i><span>Rooms</span></a></li>
                <li class="nav-active active"><a href=""><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
               <li><a href="{{route('frontdesk.guestRegistration')}}"><i class="fa fa-users"></i><span>Guest Registration</span></a></li>
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
        <a class="btn btn-white" href="{{route('frontdesk.reservation')}}"><i class="fa fa-plus"></i>New Reservation</a>
                <a class="btn btn-white active"><i class="fa fa-list"></i>Reservation List</a>
             
    </div>
          <div class="header">

              <h2><strong>Reservation</strong> List</h2>
          <hr class="m-b-0"/>
          </div>
           
              <div class="panel">
                <div class="panel-header">
                  <h4><strong>ACTIVE RESERVATIONS </strong></h4>
                </div>
                <div class="panel-content f-13">
                  <table id="users-table" class="table table-hover table-dynamic filter-head ">
                    <thead>
                      <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Email</th>
                <th>Duration</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
        </thead>
                    <tbody>
                      @push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('frontdesk.dataTables') !!}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'firstname', name: 'firstname' },
            { data: 'guaranteedNote', name: 'guaranteedNote' },
            { data: 'instiName' , name: 'instiName' },
            { data: 'dateTransaction' , name: 'dateTransaction' },
            
            { data: 'created_at', name: 'created_at' },
            { data: 'updated_at', name: 'updated_at' }
        ]
    });
});
</script>
@endpush
            
                    </tbody>
                  </table>
                </div>
              </div>
            
            <div class="panel">
                <div class="panel-header">
                  <h4><strong>RESERVATION ARCHIVE</strong></h4>
                </div>
                <div class="panel-content f-13">
                  <table class="table table-hover table-dynamic filter-footer ">
                    <thead>
                      <tr>
                        <th>Booking Person</th>
                        <th>Dates</th>
                        <th>Institution</th>
                        <th>Date Reserved</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                     <tr>
                        <td>Jonathan Sison</td>
                        <td>Aug 26, 2016 - Aug 28, 2016</td>
                        <td>DSWD - Govt</td>
                        <td>Aug 22, 2016</td>
                       
                        <td>
                            <span class="label label-warning">Expired</span>     <button type="button" data-toggle="modal" data-target="#modal-reg" class="btn-sm btn-default btn-transparent">View Details</button></td>
                      </tr>
                      <tr>
                        <td>Juan Dela Cruz</td>
                        <td>Aug 25, 2016 - Aug 28, 2016</td>
                        <td>Individual</td>
                        <td>July 1, 2016</td>
                        <td><span class="label label-warning">Expired</span>     <a href="" class="btn-sm btn-default btn-transparent">View Detail</a></td>
                      </tr>
                    
                        <tr>
                        <td>Other browsers</td>
                        <td>Aug 25, 2016 - Aug 28, 2016</td>
                        <td>NDDU - School</td>
                        <td>June 23, 2016</td>
                        <td><span class="label label-warning">Expired</span>     <a href="" class="btn-sm btn-default btn-transparent">View Detail</a></td>
                      </tr>
                        <tr>
                        <td>Other browsers</td>
                        <td>Aug 25, 2016 - Aug 28, 2016</td>
                        <td>SPC - School</td>
                        <td>May 16, 2016</td>
                        <td><span class="label label-warning">Expired</span>     <a href="" class="btn-sm btn-default btn-transparent">View Detail</a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
           
        </div>
        <!-- END PAGE CONTENT -->
      </div>
<div class="modal fade" id="modal-reg" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>Reservation</strong> form</h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <div class="pull-right">
                             <p class="f-10 m-b-0">RESERVATION ID: <strong>261608-0001-F6BY</strong></p>
                            <p class="f-10 m-t-0">DATE: <strong>AUGUST 26, 2016</strong></p>
                            </div>
                       
                        </div>
                    </div>
                    
                    
                 
                    <div class="panel panel-transparent p-20 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                        <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Booking Person: <strong>Jonathan Sison</strong></h4>
                    </div>
                   
                        <div class="col-md-6">
                            
                    <h4 class="f-14">Contact: <strong>09324569215</strong></h4>
                   
                    </div>
                    
                </div>
                        </div>
                    </div>
                  <div class="panel panel-transparent p-20 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                <div class="row">
                    <div class="col-md-4">
                    <h4 class="f-14">Group Name: <strong>DSWD GENSAN</strong></h4>
                    </div>  
                    <div class="col-md-4">
                        <div class="pull-right">
                        <h4 class="f-14">Contact: <strong>559-8923</strong></h4>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="pull-right">
                    <h4 class="f-14">Account Type: <strong>Government</strong></h4>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Address: <strong>Roxas East, General Santos City</strong></h4>
                    </div>                    
                  
                </div>
                     
                     </div></div>
                    
                    <hr/>
                    <div class="p-20">
                    <div class="row">
                    <div class="col-md-4">
                    <h4 class="f-14">Arrival: <strong>September 6, 2016</strong></h4>
                    </div>  
                    <div class="col-md-4">
                       
                        <h4 class="f-14">Departure: <strong>September 10, 2016</strong></h4>
                    
                    </div> 
                 
                </div>
                        <div class="row">
                    <div class="col-md-4">
                    <h4 class="f-14">Check In Time: <strong>2:00 PM</strong></h4>
                    </div>  
                    <div class="col-md-4">
                  
                        <h4 class="f-14">Check Out Time: <strong>12:00 NN</strong></h4>
                       
                    </div> 
                 
                </div>
                 <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Reservation Made Thru: <strong>Walk-In</strong></h4>
                    </div>  
                </div>
                        
                <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Applicable Discount: <strong>15 % - Government Account</strong></h4>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Billing Arrangement: <strong>Charge to Company</strong></h4>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Guaranteed: <strong>Yes</strong></h4>
                    </div>  
                </div>
                        <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Special Requests: <strong>N/A</strong></h4>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-2">
                    <h4 class="f-14">Rooms: </h4>
                    </div>  
                    <div class="col-md-6">
                    <h4 class="f-14"><strong>(2) </strong>Standard Deluxe (1,241.00 php rate --Discounted)</h4>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-2">
                    <h4 class="f-14">Guests: </h4>
                    </div>  
                    <div class="col-md-6">
                        <h4 class="f-14"><strong>Melvin Cruz, Ian De Castro</strong></h4>
                    </div> 
                </div>
                        
                    </div>
                    
                    
                    
                </div>
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal">Proceed to Guest Registration</button>
                </div>
              </div>
            </div>
          </div>


@endsection