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
          <li><a href="{{route('frontdesk.guestRegistration')}}"><i class="fa fa-users"></i><span>Bookings</span></a></li>

          <li class="nav-active active"><a href="{{route('frontdesk.nightAudit')}}"><i class="icon-note"></i><span>FO Reports</span></a></li>

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


    </div>


    <script language="javascript" type="text/javascript">
      function printDiv(divID) {
            //Get the HTML of div
            var divElements = document.getElementById(divID).innerHTML;
            //Get the HTML of whole page
            var oldPage = document.body.innerHTML;

            //Reset the page's HTML with div's HTML only
            document.body.innerHTML = 
            "<html><head><title></title></head><body>" + 
            divElements + "</body>";

            //Print Page
            window.print();

            //Restore orignal HTML
            document.body.innerHTML = oldPage;


          }
        </script>
      
       <div class="panel">
       
         <div class="panel-content">

<div class="row">
 <div class="col-md-12">

  <div class="row">
    <div class="col-md-6">
      <?php $percentage = ($totalRooms/26)*100; ?>
      <h5 style="font-weight:bold;">Occupancy Rate:</h5> <h2>{{$totalRooms}}/26 ({{sprintf("%.0f%%",$percentage)}})</h2>

      <div class="progress progress-bar-large" style="width:60%;">
        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="1" aria-valuemin="1" aria-valuemax="100" style="width: {{$percentage}}%">

        </div>
      </div>
    </div>
  </div>
</div>
</div>

<div class="row">
  <div class="col-md-12">
    <h5><strong>Generate Check Out Report</strong></h5>
  </div>
  {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@getCheckOutReport','name'=>'formregis','id'=>'frontdeskcontroller']) !!}
  <div class="col-md-3 m-t-10">
    <div class="prepend-icon">
      <input type="text" id="date-main" name="date-checkOut" autocomplete="off" class="b-datepicker form-control" placeholder="Select a date..." data-orientation="top">
      <i class="icon-calendar"></i>
    </div>

  </div>
  <div class="col-md-1 m-t-10">
   <input type="submit" class="btn btn-default btn-embossed" value="Search"/>  
 </div>
{!! Form::close() !!}


</div>
 <hr/>

<div class="row">
  <div class="col-md-4">
    <a class="btn btn-default btn-embossed" href="{{route('frontdesk.printRoomStatusReport')}}">Generate Room Status Report</a>
  </div>
</div><hr/>
<div class="row">
  <div class="col-md-4">
    <h5><strong>Daily Room and Guest Count Report</strong></h5>

    <a class="btn btn-default btn-embossed" href="{{route('frontdesk.printDailyRoomGuestCount')}}">Generate Room and Guest Report</a>

  </div>
</div>
<br/>

<div class="row">
  <div class="col-md-6">
    <div class="form-group">
      <label class="form-label">Room Occupancy Report</label>
      {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@roomOccupancyReport','name'=>'formregis','id'=>'frontdeskcontroller']) !!}
      <div class="input-daterange b-datepicker input-group" id="datepicker">
        <input type="text" class="input-sm form-control" id="arrival2" name="dateStart" placeholder="Date Start" autocomplete="off" />
        <span class="input-group-addon">to</span>
        <input type="text" class="input-sm form-control" id="departure2" name="dateEnd" placeholder="Date End" autocomplete="off"/>
      </div>                                     
    </div>
  </div>
  <div class="col-md-4">

   <input type="submit" class="btn btn-default btn-embossed m-t-20" id="checkRoomOccupancyReport" value="Check Room Occupancy Report"/>             
 </div>
</div>
{!! Form::close() !!}

<br/>


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