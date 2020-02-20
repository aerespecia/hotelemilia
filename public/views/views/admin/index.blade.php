@extends('layouts.adminLayout')



@section('content')
 <div class="sidebar border-right">
        <div class="logopanel">
          <h1>
            QCITIPARK
          </h1>
        </div>
        <div class="sidebar-inner">

          <div class="sidebar-top">
          


         
          </div>
           <div class="menu-title border-bottom" style="color:white;">
            TODAY IS: <br/>{{date('F j, Y')}}
          <div id="clockbox"></div>
          </div>
          
          <ul class="nav nav-sidebar">
            <li class="nav-active active"><a href=""><i class="icon-home"></i><span>Dashboard</span></a></li>
            <li class="nav-parent">
              <a href="#"><i class="icon-user"></i><span>Profiling</span> <span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a target="_blank" href=""> Guests</a></li>
                <li><a href=""> Booking Persons</a></li>
                <li><a href=""> Institutions</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-bar-chart"></i><span>Sales </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href=""> Room Reservations</a></li>
                <li><a href="charts-finance.html"> FNB</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-layers"></i><span>Reservations</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href=""> Active</a></li>
                <li><a href=""> Archive</a></li>
              </ul>
            </li>
            <li class="nav-parent">
              <a href=""><i class="icon-note"></i><span>Item Management </span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href=""> Food Items</a></li>
                <li><a href=""> Room Details</a></li>
                <li><a href=""> Services</a></li>
              </ul>
            </li>   
            
            <li class="nav-parent">
              <a href=""><i class="fa fa-male"></i><span>Staff Management</span><span class="fa arrow"></span></a>
              <ul class="children collapse">
                <li><a href=""> Add Staff</a></li>
                <li><a href=""> Staff Transactions</a></li>
              
              </ul>
            </li>
       
       
          </ul>
          <!-- SIDEBAR WIDGET FOLDERS -->
         
          <div class="sidebar-footer clearfix">
            <a class="pull-left footer-settings" href="#" data-rel="tooltip" data-placement="top" data-original-title="Settings">
            <i class="icon-settings"></i></a>
            <a class="pull-left toggle_fullscreen" href="#" data-rel="tooltip" data-placement="top" data-original-title="Fullscreen">
            <i class="icon-size-fullscreen"></i></a>
            <a class="pull-left" href="user-lockscreen.html" data-rel="tooltip" data-placement="top" data-original-title="Lockscreen">
            <i class="icon-lock"></i></a>
            <a class="pull-left btn-effect" href="{{url('/logout')}}" data-modal="modal-1" data-rel="tooltip" data-placement="top" data-original-title="Logout">
            <i class="icon-power"></i></a>
          </div>
        </div>
      </div>



<div class="main-content m-t-0 p-t-0">
        <!-- BEGIN TOPBAR -->
        
        <!-- END TOPBAR -->
        <!-- BEGIN PAGE CONTENT -->
        <div class="page-content page-thin">
                    
          <div class="header">

              <h2><strong>Q CITIPARK</strong> DASHBOARD</h2>
              
          <hr class="m-b-0"/>
          </div>
     
   
           
        </div>
        <!-- END PAGE CONTENT -->
      </div>


@endsection