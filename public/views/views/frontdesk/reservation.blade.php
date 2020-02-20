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
                      
                      {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@store','name'=>'formregis','id'=>'FrontDeskController','class'=>'wizard','data-style'=>'simple']) !!}
                        <fieldset class="withScroll show-scroll">
                          <legend>Reservation Details</legend>
                          <div class="row">
                              <div class="col-lg-6">
                              <div class="panel">
                <div class="panel-content">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                   
                      <h4><strong>CLIENT DETAILS</strong></h4>
                             <hr/>
                        <h3>Booking Person</h3>
                        <div class="row">
                           <div class="col-sm-12">
              
                            <div class="form-group">
                              
                              <div class="prepend-icon">
                                <input id="clientS" name="clientS" class="form-control sm" placeholder="Search ...." minlength="3" autocomplete="off">
                                <i class="fa fa-search"></i>
                              </div>
                            </div>
                          </div>
                            
                        </div>
                         <div class="row">
               
                          <div class="col-sm-6">
              
                            <div class="form-group">
                              <label>First Name</label>
                              <div class="append-icon">
                                <input type="text" name="firstName" id="fname" class="form-control" minlength="3" placeholder="Enter firstname..." disabled style="opacity:0.55;" autocomplete="off">
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Last Name</label>
                              <div class="append-icon">
                                <input type="text" name="lastName" id="lname" class="form-control" minlength="4" placeholder="Enter Lastname..." disabled style="opacity:0.55;">
                                <i class="icon-user"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label>Title</label>
                              
                                <input type="text" name="title" id="title" class="form-control" minlength="4" placeholder="Enter Title/Designation..." disabled style="opacity:0.55;" autocomplete="off">
                               
                            </div>
                            </div>
                          <div class="col-sm-6">
              
                            <div class="form-group">
                                <label>Mobile no.</label>
                              <div class="append-icon">
                                <input type="text" name="contactNo" id="contactNo" class="form-control" placeholder="Enter Contact No." disabled style="opacity:0.55;">
                                <i class="fa fa-mobile"></i>
                              </div>
                            </div>
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
                        <h3>INSTITUTION INFORMATION</h3>
                      <hr/>
                        
                        <div class="row">
                           <div class="col-sm-12">
              
                            <div class="form-group">
                              
                              <div class="prepend-icon">
                                <input type="text" name="insti" id="insti" class="form-control sm" placeholder="Search Company/Institution Name........" minlength="3">
                                <i class="fa fa-search"></i>
                              </div>
                            </div>
                          </div>
                            
                        </div>
               
                        <div class="row">
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Group Name</label>
                              <div class="append-icon">
                                <input type="text" name="institutionName" id="iName" class="form-control" placeholder="(e.g. DENR, Ateneo de Davao, Gensan Tours)" disabled style="opacity:0.55;">
                                <i class="fa fa-building-o"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-6">
                            <div class="form-group">
                              <label class="control-label">Type</label>
                              <select id="iType" name="institutionType" class="form-control" data-style="white" data-placeholder="Select Account Type..." disabled>
                                    <option value="0">Select Account Type</option>
                                    <option value="1">Student</option>
                                    <option value="2">Corporate</option>
                                    <option value="3">Travel Agency</option> 
                            </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-8">
                            <div class="form-group">
                              <label class="control-label">Address</label>
                              <div class="append-icon">
                                <input type="text" id="iAddress" name="institutionAddress" class="form-control" placeholder="Enter Address..." minlength="3" disabled style="opacity:0.55;">
                                <i class="fa fa-map-marker"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Contact No.</label>
                              <div class="append-icon">
                                <input type="text" id="iContact" name="institutionContactNo" class="form-control" placeholder="Enter Contact No." minlength="3" disabled style="opacity:0.55;">
                                <i class="fa fa-mobile"></i>
                              </div>
                            </div>
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
                              
                              </div>
                           
                            <div class="col-lg-6">
                              <div class="panel">
                <div class="panel-content">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                        <label class="form-label">Arrival and Departure</label>
                        <div class="input-daterange b-datepicker input-group" id="datepicker">
                            <input type="text" class="input-sm form-control" id="arrival" name="arrivalDate" placeholder="Arrival"/>
                            <span class="input-group-addon">to</span>
                            <input type="text" class="input-sm form-control" id="departure" name="departureDate" placeholder="Departure"/>
                        </div>
                      </div>
                        </div>
                        
                      </div>
            
                     <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Check In</label>
                            <div class="prepend-icon">
                              <input type="text" name="checkIntimepicker" value="2:00pm" class="timepicker form-control" placeholder="Choose a time...">
                              <i class="icon-clock"></i>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="form-label">Check Out</label>
                            <div class="prepend-icon">
                              <input type="text" name="checkOuttimepicker" value="12:00 pm" class="timepicker form-control" placeholder="Choose a time...">
                              <i class="icon-clock"></i>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      
                      <br>
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Made Thru
                          </label>
                          <div class="col-sm-9">
                           <div class="option-group">
                                <select id="madeThru" name="madeThru" style="width:250px;">
                                  <option value="0" selected>Walk In</option>
                                  <option value="1">Email</option>
                                  <option value="2">Phone</option>
                                
                                </select>
                              </div>
                          </div><br/><br/>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Applicable Discount
                          </label>
                          <div class="col-sm-9">
                           <div class="option-group">
                                <select id="discountType" name="discountType" style="width:250px;">
                                  <option value="0" selected>------- Discount Rates ------</option>
                                  <option value="1">Corporate (20%)</option>
                                  <option value="2">Travel Agency (25%)</option>
                                  <option value="3">Government (15%)</option>
                                  <option value="4">School/NGO</option>
                                  <option value="5">5-7 Days Stay Discount (20%)</option>
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
                               <label class="f-12"><input type="radio" name="billArrange" data-radio="iradio_minimal-blue"> Charge to company</label>
                                  <label class="f-12"><input type="radio" name="billArrange" checked data-radio="iradio_minimal-blue"> Guest Account</label>
                                </div>
                          </div>
                           <br/><br/>
                        </div>
                           <div class="form-group">
                          <label class="col-sm-3 control-label f-12">Charge Type:
                          </label>
                          <div class="col-sm-9">
                           <div class="icheck-inline">     
                               <label class="f-11"><input type="radio" name="chargeType" id="chargeType" data-radio="iradio_minimal-blue"> Cash</label>
                                  <label class="f-11"><input type="radio" name="chargeType" id="chargeType" checked data-radio="iradio_minimal-blue"> Credit Card</label>
                                </div>
                          </div>
                           
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
                      
                        <div class="panel panel-transparent p-15 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Guaranteed
                          </label>
                          <div class="col-sm-9">
                           <div class="icheck-inline">
                                  <label class="f-11"><input type="radio" name="guaranteed" data-radio="iradio_minimal-blue"> Yes</label>
                                  <label class="f-11"><input type="radio" name="guaranteed" checked data-radio="iradio_minimal-blue"> No</label>
                                </div>
                          </div>
                        </div>
                            <div class="row">
                                <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                 <div class="form-group">
                              <label class="f-11">By Company/Individual</label>
                             
                                 <textarea name="guaranteedArrangementsNotes" rows="3" class="form-control" placeholder="Enter Arrangements"></textarea>
                              
                            </div>
                                </div>
                            </div>
                            
                            
                           
                          </div>
                        
                        <div class="row">
                        <div class="col-md-12 col-sm-12">
                        <div class="form-group">
                          <label class="col-sm-3 control-label">Special Request/s
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
                <legend>Rooms and Guests</legend>
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
                        
                            
                               <div class="col-sm-2 border-right">
              
                              <label>Single Room</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="7" value="7" data-checkbox="icheckbox_square-blue"> 212</label>
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="8" value="8" data-checkbox="icheckbox_square-blue"> 312</label>
                                            <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="9" value="9" data-checkbox="icheckbox_square-blue"> 317</label>
                                            <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="10" value="10" data-checkbox="icheckbox_square-blue"> 318</label>
                                           
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            
                          </div>
                            <div class="col-sm-2 border-right">
              
                            <div class="form-group">
                              <label>Single Deluxe</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="40" value="40" data-checkbox="icheckbox_square-blue"> 313</label>
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="41" value="41" data-checkbox="icheckbox_square-blue"> 316</label>
                                       
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            </div>
                          </div>  
                              <div class="col-sm-2 border-right">
              
                            <div class="form-group">
                              <label>Double Standard</label>
                                 <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="11" value="11" data-checkbox="icheckbox_square-blue"> 204</label>
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="12" value="12" data-checkbox="icheckbox_square-blue"> 205</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="13" value="13" data-checkbox="icheckbox_square-blue"> 303</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="14" value="14"  data-checkbox="icheckbox_square-blue"> 304</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="15" value="15" data-checkbox="icheckbox_square-blue"> 307</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="16" value="16" data-checkbox="icheckbox_square-blue"> 403</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="17" value="17" data-checkbox="icheckbox_square-blue"> 404</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="18" value="18" data-checkbox="icheckbox_square-blue"> 407</label>
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                            <div class="col-sm-2 border-right">
              
                            <div class="form-group">
                              <label>Double Deluxe</label>
                               <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="19" value="19" data-checkbox="icheckbox_square-blue"> 203</label>
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="20" value="20" data-checkbox="icheckbox_square-blue"> 302</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="21" value="21" data-checkbox="icheckbox_square-blue"> 311</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="22" value="22" data-checkbox="icheckbox_square-blue"> 402</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="23" value="23" data-checkbox="icheckbox_square-blue"> 411</label>
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                              <div class="col-sm-2 border-right">
              
                            <div class="form-group">
                              <label>Twin Share</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="24" value="24" data-checkbox="icheckbox_square-blue"> 206</label>
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="25" value="25" data-checkbox="icheckbox_square-blue"> 207</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="26" value="26" data-checkbox="icheckbox_square-blue"> 209</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="27" value="27" data-checkbox="icheckbox_square-blue"> 305</label>
                                            <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="28" value="28" data-checkbox="icheckbox_square-blue"> 306</label>
                                            <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="29" value="29" data-checkbox="icheckbox_square-blue"> 309</label>
                                            <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="30" value="30" data-checkbox="icheckbox_square-blue"> 315</label>
                                            <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="31" value="31" data-checkbox="icheckbox_square-blue"> 405</label>
                                            <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="32" value="32" data-checkbox="icheckbox_square-blue"> 406</label>
                                            <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="33" value="33" data-checkbox="icheckbox_square-blue"> 409</label>
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                        <div class="col-sm-2">
              
                            <div class="form-group">
                              <label>Total No. of Rooms</label>
                    
                                 <input type="text" id="total-rooms" class="form-control input-lg" width="50%" value="0" disabled>
                            </div>
                                
                                </div>
                       
                             
                        </div>
                                
                        <div class="row">
                         <div class="col-sm-2 border-right border-top">
              
                            <div class="form-group m-t-10">
                              <label>Twin Deluxe</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="34" value="34" data-checkbox="icheckbox_square-blue"> 314</label>
                                       
                                      
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>
                            
                               <div class="col-sm-2 border-right border-top">
              
                            <div class="form-group m-t-10">
                              <label>Triple Sharing</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="35" value="35" data-checkbox="icheckbox_square-blue"> 210</label>
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="36" value="36" data-checkbox="icheckbox_square-blue"> 310</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" id="37" value="37" data-checkbox="icheckbox_square-blue"> 410</label>
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                            </div>
                          </div>
                            <div class="col-sm-2 border-right border-top">
              
                            <div class="form-group m-t-10">
                              <label>Family Suite</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" value="1" id="1" data-checkbox="icheckbox_square-blue"> 202</label>
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" value="2" id="2" data-checkbox="icheckbox_square-blue"> 208</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" value="3" id="3" data-checkbox="icheckbox_square-blue"> 301</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" value="4" id="4" data-checkbox="icheckbox_square-blue"> 308</label>
                                        <label class="f-10">
                                        <input type="checkbox" name="roomId[]" value="5" id="5" data-checkbox="icheckbox_square-blue"> 401</label>
                                            <label class="f-10">
                                        <input type="checkbox" name="roomId[]" value="6" id="6" data-checkbox="icheckbox_square-blue"> 408</label>
                                        </div>
                                    </div>
                                        </div>                                  
                                    </div>        
                                </div>
                             <br/>
                            </div>
                          </div>  
                              <div class="col-sm-2 border-right border-top">
              
                            <div class="form-group m-t-10">
                              <label>Hospitality Suite</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="38" value="38" data-checkbox="icheckbox_square-blue"> 201</label>
                                    
                                        </div>
                                    </div>
                                        </div>
                                   
                                        
                                    
                                    </div>
                                    
                                </div>
                             <br/>
                            </div>
                          </div>
                            <div class="col-sm-2 border-right border-top">
              
                            <div class="form-group m-t-10">
                              <label>PWD Room</label>
                               <div class="row">
                                    <div class="col-sm-12">
                                     <h6><strong>Rate:</strong> P 1,460.00 </h6>
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
                                        <label class="f-10">
                                            <input type="checkbox" name="roomId[]" id="39" value="39" data-checkbox="icheckbox_square-blue"> 211</label>
                                 
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
                        
                    <div class="row">
            <div class="col-lg-12 portlets">
              <div class="panel">
                <div class="panel-header">
                
                  <h4><strong>Initial Guest Listing</strong></h4>
                  <input type="hidden" name="guestNames" id="guestNames" value="">
                  <input type="hidden" name="guestNameListing" id="guestNameListing" value="">
                  <input type="hidden" name="guestLastNameListing" id="guestLastNameListing" value="">
                  <input type="hidden" name="guestContactListing" id="guestContactListing" value="">
                </div>
                 
                          <div class="panel-content pagination2 table-responsive" style="overflow-y:auto; height:300px;">
                 
                  <div class="m-b-20">
                    <div class="btn-group">
                      <button onclick="clearFunc()" id="table-edit_new" data-toggle="modal" data-target="#modal-select" class="btn btn-sm btn-dark"><i class="fa fa-plus"></i> Add Guest</button>
                    </div>
                  </div>
                  <table id="guestTable" class="table table-hover">
                    <thead>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Contact No</th>
                    
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
                                    <button type="button" data-toggle="modal" data-target="#modal-reg" class="btn btn-white">See here</button>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                         <h5>Check Reservation lists after making reservation</h5>
                                        <button type="submit" class="btn btn-hg btn-primary">Make Reservation</button>
                                        
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
                          <label>First Name</label>
                          <input type="text" id="firstN" name="firstN" class="form-control" minlength="3" placeholder="Enter firstname..." required>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" id="familyName" name="familyName" class="form-control" minlength="3" placeholder="Enter first name..." required>
                        </div>
                      </div>
                    </div>
                    <div class="row m-t-10">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>Contact</label>
                          <input type="text" id="contact" name="contact" class="form-control" minlength="3" placeholder="Enter address..." required>
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
                    <h4 class="f-14">Guaranteed: <strong>Yes</strong></h4>
                    </div>  
                </div>
                        <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Special Requests: <strong>N/A</strong></h4>
                    </div>  
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Billing Arrangement: <strong>Charge to company</strong></h4>
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
                  <button type="button" class="btn btn-primary btn-embossed" data-dismiss="modal"><i class="fa fa-print"></i> Print</button>
                </div>
              </div>
            </div>
          </div>
            
        <!--- PRINT MODAL -->
          
         
          
          <div class="footer">
            <div class="copyright">
              <p class="pull-left sm-pull-reset">
                <span>Copyright <span class="copyright">©</span> 2016 </span>
                <span>Q CITIPARK HOTEL</span>.
                <span>All rights reserved. </span>
              </p>
              <p class="pull-right sm-pull-reset">
                <span><a href="#" class="m-r-10">Support</a> | <a href="#" class="m-l-10 m-r-10">Terms of use</a> | <a href="#" class="m-l-10">Privacy Policy</a></span>
              </p>
            </div>
          </div>
 
    
                <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    
    
    <script>
    /*
  $(function() {
    $( "#clientS" ).autocomplete({
      source: "{{route('frontdesk.clientSearch')}}",
      autoFocus:true,
      select:function(e, ui){
          $("#fname").val(ui.item['fname']);
          $("#lname").val(ui.item['lname']);
          $("#contactNo").val(ui.item['contactNo']);
          $("#title").val(ui.item['title']);
      } 
    });  
  });
        
     $(function() {
    $( "#insti" ).autocomplete({
      source: "{{route('frontdesk.instiSearch')}}",
      autoFocus:true,
      select:function(e, ui){
          $("#iName").val(ui.item['name']);
          $("#iType").val(ui.item['type']);
          $("#iContact").val(ui.item['contactNo']);
          $("#iAddress").val(ui.item['address']);
      } 
    });  
  });
*/
  </script>
    
    <script>
        //START CLIENT JSCRIPT
  $(function() {
    $( "#newClient" ).click(function(){
          $("#fname").val('');
          $("#lname").val('');
          $("#contactNo").val('');
          $("#title").val('');
        
          $("#fname").attr('disabled',false);
          $("#lname").attr('disabled',false);
          $("#contactNo").attr('disabled',false);
          $("#title").attr('disabled',false);
        
          $("#fname").attr('style','opacity:1;');
          $("#lname").attr('style','opacity:1;');
          $("#contactNo").attr('style','opacity:1;');
          $("#title").attr('style','opacity:1;');
        
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
        
          $("#fname").attr('disabled',true);
          $("#lname").attr('disabled',true);
          $("#contactNo").attr('disabled',true);
          $("#title").attr('disabled',true);
        
          $("#fname").attr('style','opacity:0.55;');
          $("#lname").attr('style','opacity:0.55;');
          $("#contactNo").attr('style','opacity:0.55;');
          $("#title").attr('style','opacity:0.55;');
        
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
        
          $("#iName").attr('disabled',false);
          $("#iType").attr('disabled',false);
          $("#iAddress").attr('disabled',false);
          $("#iContact").attr('disabled',false);
        
          $("#iName").attr('style','opacity:1;');
      //    $("#iType").attr('style','opacity:1;');
          $("#iAddress").attr('style','opacity:1;');
          $("#iContact").attr('style','opacity:1;');
        
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

                  $("#iName").attr('disabled',true);
                  $("#iType").attr('disabled',true);
                  $("#iAddress").attr('disabled',true);
                  $("#iContact").attr('disabled',true);

                  $("#iName").attr('style','opacity:0.55;');
               //   $("#iType").attr('style','opacity:0.55;');
                  $("#iAddress").attr('style','opacity:0.55;');
                  $("#iContact").attr('style','opacity:0.55;');

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
  </script>
    
        
          <script>
function myFunction() {

      var first = document.getElementById("firstN").value;
      var last = document.getElementById("familyName").value;
      var phone = document.getElementById("contact").value;


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
        addedValueName = first+"#"+last+"#"+phone;

      }
      else
      {
        addedValueName = guestNames+"||"+first+"#"+last+"#"+phone;
        
      }

      document.getElementById("guestNames").value = addedValueName;      

      document.getElementById("guestNameListing").value = addedValueName;
      document.getElementById("guestLastNameListing").value = addedValueLastName;
      document.getElementById("guestContactListing").value = addedValueContact;


      alert(addedValueName);


  
    /*
    if(billA == 2)
    cell4.innerHTML = "Charge to Company";
    else if(billA == 1)
    cell4.innerHTML = "Guest Account"; */

/*
    var counter = document.getElementById(tableIndex).rows.length-2;

var inputFirst = document.createElement("input");

var dash='[]';

inputFirst.setAttribute("type", "hidden");

inputFirst.setAttribute("name", "guestFirstName[]");

inputFirst.setAttribute("value", first+"#"+last+"#"+phone);


cell1.appendChild(inputFirst);



var inputLast = document.createElement("input");

inputLast.setAttribute("type", "hidden");

inputLast.setAttribute("name", "guestLastName");

inputLast.setAttribute("value", last);


cell2.appendChild(inputLast);

var inputPhone = document.createElement("input");

inputPhone.setAttribute("type", "hidden");

inputPhone.setAttribute("name", "phone[]");

inputPhone.setAttribute("value", phone);

cell3.appendChild(inputPhone);

*/
}

function clearFunc(){
  document.getElementById("firstN").value = "";
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
/*
  var motherDiv = document.createElement("div");
  motherDiv.setAttribute("class", "panel panel-default no-bd");

  var panelHeader = document.createElement("div");
  panelHeader.setAttribute("class","panel-header");

  var head2 = document.createElement("h2");
  head2.innerHTML = "<strong>ROOM: "+roomNum+"</strong>";

  panelHeader.appendChild(head2);
  motherDiv.appendChild(panelHeader);

  var panelContentMain = document.createElement("div");
  panelContentMain.setAttribute("class","panel-content");

   var panelContent2 = document.createElement("div");
  panelContent2.setAttribute("class","panel-content");
  panelContent2.setAttribute("style","overflow-y:auto;height:200px;");

  var table = document.createElement("table");
  table.setAttribute("id","guestTable");
  table.setAttribute("class","table table-hover");

  var thead = document.createElement("thead");
  var trhead = document.createElement("tr");
  var th1 = document.createElement("th");
  th1.innerHTML = "First Name";
  var th2 = document.createElement("th");
  th2.innerHTML = "Last Name";
  var th3 = document.createElement("th");
  th3.innerHTML = "Phone";
  trhead.appendChild(th1);
  trhead.appendChild(th2);
  trhead.appendChild(th3);

  thhead.appendChild(trhead);

  table.appendChild(thhead);

  var tbody = document.createElement("tbody");
  var tr2 = document.createElement("tr");
  var td1 = document.createElement("td");
var td2 = document.createElement("td");
var td3 = document.createElement("td");
tr2.appendChild(td1);
tr2.appendChild(td2);
tr2.appendChild(td3);
tbody.appendChild(tr2);

table.appendChild(tbody);
panelContent2.appendChild(table);
panelContentMain.appendChild(panelContent2);

motherDiv.appendChild(panelContentMain);

  div.appendChild(motherDiv);


  var inputFirst = document.createElement("input");
  inputFirst.setAttribute("type", "text");

  inputFirst.setAttribute("name", "guestFirstName[]");

  inputFirst.setAttribute("value", "first");

  div2.appendChild(inputFirst);
  div.appendChild(div2);  */
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
         
        
        $("#checkAvail").click(function(){
            var dates1 = { arrival: $('#arrival2').val(),
                  departure: $('#departure2').val(),
                };
            
            
           $.get('route("frontdesk.checkRoomAvailability)',function(data){
               $.ajax({
                   type:"GET",
                   url: "{{route('frontdesk.checkRoomAvailability')}}",
                   data: dates1,
                   
                   success: function (data){
                       console.log(data);
                       
                       for(i=1;i<=41;i++){
                           var id = "#"+i;
                           if($.inArray(i,data) == -1)                          
                               $(id).attr('disabled', false);   
                           else{
                               $(id).attr('disabled', true);
                              
                           }   
                       }
                       
                   }
                  
               });
           }); 
            
        });
    });
</script>
           

              
        </div>
        <!-- END PAGE CONTENT -->
      </div>



@endsection