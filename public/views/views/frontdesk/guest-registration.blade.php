@extends('layouts.frontdeskLayout')



@section('content')



<div class="main-content">
        <!-- BEGIN TOPBAR -->
        <div class="topbar" style="background-color:white;">
          <div class="header-left">
            <div class="topnav">
            
              <ul class="nav nav-tabs no-border">
                <li><a href="{{route('frontdesk.index')}}"><i class="fa fa-calendar-o"></i><span>ROOMS</span></a></li>
                <li><a href="{{route('frontdesk.reservation')}}"><i class="fa fa-calendar-o"></i><span>Reservations</span></a></li>
               <li class="nav-active active"><a href=""><i class="fa fa-users"></i><span>Guest Registration</span></a></li>
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
                <img src="{{url('assets/global/images/avatars/avatar11_big.png')}}" alt="user image">
                    <!-- Calling $user as defined in reservation function in FrontDeskController -->
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
        <div class="page-content">
                    
          <div class="header">

              <h2><strong>GUEST</strong> REGISTRATION</h2>
              
          <hr class="m-b-0"/>
          </div>
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
                                <div class="row">
                                    <div class="col-sm-6">
                                   
                                <input type="text" name="firstName" id="firstName" data-mask="wwwwww-wwww-wwww" class="form-control f-20" minlength="3" style="letter-spacing: 8px;" placeholder="XXXXXX-XXXX-XXXX">
                                
                           
                                    </div>
                                    <div class="col-sm-4">
                                     <button type="button" class="btn btn-lg btn-dark">Search</button>
                                    </div>
                                </div>
                              
                            </div>
                                </div>
                             
                                
                            </div>
                        </div>
                    <hr/>
                        <div class="panel-header">
                            <h3><i class="fa fa-bell-o"></i> <strong>Active Reservations</strong></h3>
                            
                </div>
                        <div class="panel-content">
                            <div class="panel panel-transparent">
                
                <div class="panel-content" style="height:200px;overflow-y:scroll;">
                  <table class="table table-hover f-12">
                    <thead>
                      <tr>
                        <th>Guest/s</th>
                        <th>Room</th>
                        <th>Institution</th>
                        <th>Arrival - Departure</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Jonathan Sison</td>
                        <td>DSDW - Gov't</td>
                        <td>08/26/16 - 08/28/16</td>
                        <td><span class="label label-danger">Unconfirmed</span>  <button type="button" class="btn-sm btn-default btn-transparent">Select</button></td>
                      </tr>
                    
                    </tbody>
                  </table>
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
    
            
            <div class="row">
                <div class="col-md-7">
                
                
                      <div class="panel">
                        <div class="panel-header">
                            <h4><i class="fa fa-users"></i> <strong>GUEST REGISTRATION</strong></h4>
                            <h3>RESERVATION ID: <strong>261608-0001-F6BY</strong></h3>
                            <hr/>
                           
                            
                           
                </div>
                        <div class="panel-content">
                             
                            <div class="panel panel-transparent">
                
                <div class="panel-content" style="height:200px;overflow-y:scroll;">
                  <table class="table table-hover f-12">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Guest Reg. No.</th>
                        <th>Room</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Melvin Cruz</td>
                        <td>n/a</td>
                        <td>201</td>
                        <td><span class="label label-danger">Unregistered</span><button type="button" data-toggle="modal" data-target="#modal-guest-edit" class="btn-sm btn-default btn-transparent">Edit</button>  <button type="button" data-toggle="modal" data-target="#modal-guest" class="btn-sm btn-default btn-transparent">View</button></td>
                      </tr>
                     <tr>
                        <td>Ian De Castro</td>
                        <td>GC-0001-XG8Y3008</td>
                        <td>202</td>
                        <td><span class="label label-success">Registered</span>  <button type="button"  class="btn-sm btn-default btn-transparent">View</button></td>
                      </tr>
                      
                       
                    </tbody>
                  </table>
                </div>
              </div>
                        </div>
                    </div>
                </div>
                  <div class="col-md-5">
                
                <div class="panel">
                    <div class="panel-header">
                            <h4><i class="fa fa-users"></i> <strong>RESERVATION SUMMARY</strong></h4>
                        
                           
                            
                           
                </div>
                <div class="panel-content">
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-8">
                            <p class="f-10 m-b-0 pull-right">RESERVATION ID: <strong>261608-0001-F6BY</strong></p>
                            <div class="pull-right">
                             
                            <p class="f-10 m-t-0">DATE CREATED: <strong>AUGUST 26, 2016</strong></p>
                                
                            </div>
                       
                        </div>
                    </div>
                    
                    
                 
                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                        <div class="row">
                    <div class="col-md-7">
                    <h4 class="f-13">Booking Person: <strong>Jonathan Sison</strong></h4>
                    </div>
                   
                        <div class="col-md-5">
                            
                    <h4 class="f-13">Status: <strong><span class="label label-danger">Unconfirmed</span></strong></h4>
                   
                    </div>
                    
                </div>
                        </div>
                    </div>
                  <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                <div class="row">
                    <div class="col-md-4">
                    <h4 class="f-13">Group Name: <strong>DSWD GENSAN</strong></h4>
                    </div>  
                    <div class="col-md-4">
                        <div class="pull-right">
                        <h4 class="f-13">No. of Guest/s: <br/><strong>2</strong></h4>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="pull-right">
                    <h4 class="f-13">Account Type: <strong>Government</strong></h4>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-13">Arrival: <strong>09/16/16</strong></h4>
                    </div>  
                    <div class="col-md-6">
                       
                        <h4 class="f-13">Departure: <strong>09/19/16</strong></h4>
                    
                    </div> 
                 
                </div>
                     
                     </div></div>
                    
              <div class="row">
               
                    <div class="col-md-4">
                   <button class="btn btn-primary" data-toggle="modal" data-target="#modal-reg">View Details</button>
                  </div>
                     <div class="col-md-6">
                   <button class="btn btn-primary" data-toggle="modal" data-target="">Edit</button>
                  </div>
                   
                            </div>
                    
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
                  <h4 class="modal-title"><strong>EDIT GUEST REGISTRATION CARD:</strong> MELVIN CRUZ</h4>
                 
                </div>
                <div class="modal-body">
                    <p class="c-red f-12">NOTE: Don't forget to save edited guest registration card. Also, validate information with checking in guest/s.</p>
                    <div class="row"><br/>
                        <h2 align="center"><strong>EDIT GUEST REGISTRATION CARD</strong></h2><hr/>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="f-10 m-t-0 m-b-0">GUEST REGISTRATION NO: <i><strong>GC-0002-XG8Y3008</strong>-not final until registered</i></p>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                             <p class="f-10 m-b-0">RESERVATION ID: <strong>261608-0001-F6BY</strong></p>
                           
                            <p class="f-10 m-t-0">DATE TODAY: <strong>AUGUST 30, 2016</strong></p>
                            </div>
                       
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <h3>GUEST ACCOUNT ID: <span class="label label-danger">NOT REGISTERED</span></h3>
                        </div>
                    </div>
                    
                    
                    <div class="panel panel-transparent p-10 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                       <div class="row">
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">First Name</label>
                             
                                <input type="text" name="address" class="form-control" placeholder="Enter First Name..." minlength="3" value="Melvin">
                              
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Middle Name</label>
                         
                                <input type="text" name="contactNo" class="form-control" placeholder="Enter Middle Name..." minlength="3">
                              
                            </div>
                          </div>
                           <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label">Last Name</label>
                             
                                <input type="text" name="contactNo" class="form-control" placeholder="Enter Last Name..." minlength="3">
                             
                            </div>
                          </div>
                        </div><br/><br/>
                            <div class="row border-top">
                            <h3 class="col-sm-6 m-t-10"><strong>Complete Address</strong></h3>
                            </div>
                            
                            <div class="row">
                                 
                          <div class="col-sm-4">
                              
                            <div class="form-group">
                               
                              <label class="control-label f-12">House/Bldg No. and Street</label>
                             
                                <input type="text" name="address" class="form-control" placeholder="House/Bldg No. and Street..." minlength="3" >
                              
                            </div>
                          </div>
                          <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Barangay/Village</label>
                         
                                <input type="text" name="brgy" class="form-control" placeholder="Brgy./Village..." minlength="3">
                              
                            </div>
                          </div>
                           <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">City/Town/Province/State</label>
                             
                                <input type="text" name="city" class="form-control" placeholder="City/Town/Province/State..." minlength="3">
                             
                            </div>
                          </div>
                                
                        </div>
                            <div class="row border-bottom">
                                <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Country</label>
                             
                                <input type="text" name="city" class="form-control" placeholder="Country.." minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Postal Code</label>
                             
                                <input type="text" name="contactNo" class="form-control" placeholder="Postal Code" minlength="3">
                             
                            </div>
                          </div>
                                <div class="col-sm-4">
                            <div class="form-group">
                              <label class="control-label f-12">Nationality</label>
                             
                                <input type="text" name="city" class="form-control" placeholder="Nationality" minlength="3">
                             
                            </div>
                          </div>
                            </div><br/><br/>
                         <div class="row border-bottom">
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Contact No.</label>
                             
                                <input type="text" name="contactNo" class="form-control" placeholder="Contact No..." minlength="3" >
                              
                            </div>
                          </div>
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Email</label>
                             
                                <input type="text" name="city" class="form-control" placeholder="Email" minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Date of Birth</label>
                             
                                <input type="text" name="city" class="form-control" data-mask="99-99-9999" placeholder="MM/DD/YYYY" minlength="3">
                             
                            </div>
                          </div>
                             <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Designation</label>
                             
                                <input type="text" name="" class="form-control" placeholder="Title/Designation" minlength="3">
                             
                            </div>
                          </div>
                             
                     
                        </div><br/><br/>
                        <div class="row">
                        
                          <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Passport No./ID</label>
                             
                                <input type="text" name="city" class="form-control" placeholder="Passport no." minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Passport Expiry Date</label>
                             
                                <input type="text" name="city" class="form-control"  placeholder="Passport Expiry" minlength="3">
                             
                            </div>
                          </div>
                             <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Passport Date of Issue</label>
                             
                                <input type="text" name="" class="form-control" placeholder="Passport Date of Issue" minlength="3">
                             
                            </div>
                          </div>
                              <div class="col-sm-3">
                            <div class="form-group">
                              <label class="control-label f-12">Other ID Presented</label>
                             
                                <input type="text" name="contactNo" class="form-control" placeholder="ID presented" minlength="3" >
                              
                            </div>
                          </div>
                             
                     
                        </div>
                            
                        </div>
                    </div>
                    <div class="row m-b-10">
                        <div class="col-md-6">
                           <strong>RESERVATION INFORMATION</strong> 
                        </div>
                    </div>
                  <div class="panel panel-transparent p-15 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                <div class="row">
                    <div class="col-md-6 border-right">
                        <p class="c-red f-11">*Inform guest when changing billing arrangement for particular guest.</p><br/>
                    <div class="form-group">
                          <label class="col-sm-3 control-label f-12">Billing Arrangement:
                          </label>
                          <div class="col-sm-9">
                           <div class="icheck-inline">
                                  
                               <label class="f-11"><input type="radio" name="radio3" data-radio="iradio_minimal-blue"> Charge to company</label>
                                  <label class="f-11"><input type="radio" name="radio3" checked data-radio="iradio_minimal-blue"> Guest Account</label>
                                </div>
                          </div>
                           <br/><br/>
                        </div>
                         <div class="form-group">
                          <label class="col-sm-3 control-label f-10">Charge Type:
                          </label>
                          <div class="col-sm-9">
                           <div class="icheck-inline">
                                  
                               <label class="f-11"><input type="radio" name="radio2" data-radio="iradio_minimal-blue"> Cash</label>
                                  <label class="f-11"><input type="radio" name="radio2" checked data-radio="iradio_minimal-blue"> Credit Card</label>
                                </div>
                          </div>
                           
                        </div>
                           <div class="row">
                                <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                 <div class="form-group">
                              <label class="f-11">Billing Arrangements</label>
                             
                                <textarea name="billingArrangements" rows="3" class="form-control" placeholder="Enter Arrangements" minlength="30"></textarea>
                              
                            </div>
                                </div>
                            </div>
                    </div>  
                    
                    <div class="col-md-6">
                     
                        <div class="row">
                            <div class="col-md-4 f-12">
                                <p>Daily Rate: <br/><strong>P 1, 640</strong></p>
                            </div>
                            <div class="col-md-4 f-12">
                                <p>Applicable Discount: <br/><strong>20 % - Gov't</strong></p>
                            </div>
                            <div class="col-md-4 f-12">
                                <p class="f-11">Advance Deposit: <br/><strong>P 1,640 - This Account</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 f-12">
                                <p>Arrival Date: <br/><strong>09-09-16</strong></p>
                            </div>
                            <div class="col-md-4 f-12">
                                <p>Departure Date: <br/><strong>09-12-16</strong></p>
                            </div>
                            <div class="col-md-4 f-12">
                                <p>Extension Date: <br/><strong>N/A</strong></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 f-12">
                                <p>Room Type: <br/><strong>Single Deluxe</strong></p>
                            </div>
                            <div class="col-md-6 f-12">
                                <p class="m-b-0">Room No: </p>
                                <div class="form-group">
                                <div class="option-group">
                                <select id="institutionType" name="institutionType">
                                  <option value="0" selected>---</option>
                                  <option value="1">201 - Single Deluxe</option>
                                  <option value="2">202 - Single Deluxe</option>
                                  <option value="3">203 - PWD Room</option>
                          
                                </select>
                              </div>
                                </div>
                                
                                
                            </div>
                            
                            
                        </div>
                        <div class="row">
                            <div class="col-md-6 f-12">
                                <p>Guest Remarks: <br/><strong>N/A</strong></p>
                            </div>
                            </div>
                    </div>
                    
                    <div class="row  p-10">
                       <div class="col-md-12">
                          <p class="pull-right c-red f-11">*Please see guest reservation to make changes on this part</p>
                        </div>
                  
             
                    </div>
                   
                </div>
                
        
                     
                     </div></div>
                  
                   <div class="row">
                       <div class="col-md-6">
                       <div class="form-group">
                          <h5><strong>Scanned Registration Form</strong>
                           </h5>
                          <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                            <div class="form-control" data-trigger="fileinput">
                              <i class="glyphicon glyphicon-file fileinput-exists"></i><span class="fileinput-filename"></span>
                            </div>
                            <span class="input-group-addon btn btn-dark btn-file"><span class="fileinput-new">Choose file</span><span class="fileinput-exists">Change</span>
                            <input type="file" name="...">
                            </span>
                            <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                        </div>  
                       </div>
                              
                </div><br/>
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     <button type="button" class="btn btn-white btn-embossed" data-toggle="modal" data-target="#modal-guest"><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-success btn-embossed"> SAVE</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>
            <!--- END EDIT GUEST REGISTRATION -->
        <!--- GUEST REGISTRATION MODAL ENDS -->
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
          
            <!--- GUEST REGISTRATION MODAL BEGINS -->    
       <div class="modal fade" id="modal-guest" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>GUEST REGISTRATION CARD:</strong> MELVIN CRUZ</h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>GUEST REGISTRATION CARD</strong></h2><hr/>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="f-10 m-t-0 m-b-0">GUEST REGISTRATION NO: <i><strong>GC-0002-XG8Y3008</strong>-not final until saved</i></p>
                        </div>
                        <div class="col-md-6">
                            <div class="pull-right">
                             <p class="f-10 m-b-0">RESERVATION ID: <strong>261608-0001-F6BY</strong></p>
                           
                            <p class="f-10 m-t-0">DATE: <strong>AUGUST 30, 2016</strong></p>
                            </div>
                       
                        </div>
                    </div>
                    
                    
                 
                    <div class="panel panel-transparent p-5 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                        <div class="row">
                    <div class="col-md-2 border-right">                   
                            <h4 class="f-12 m-t-0" align="center">Daily Rate: <br class="m-b-5"/><strong>P 1,460</strong></h4>        
                    </div>
                            <div class="col-md-2 border-right">
                   <h4 class="f-12 m-t-0" align="center">Arrival Date: <br class="m-b-5"/><strong>Sep. 16, 2016</strong></h4>    
                    </div>
                            <div class="col-md-2 border-right">
                    <h4 class="f-12 m-t-0" align="center">Departure Date: <br class="m-b-5"/><strong>Sep. 18, 2016</strong></h4>    
                    </div>
                             <div class="col-md-2 border-right">
                    <h4 class="f-12 m-t-0" align="center">Extension Date: <br class="m-b-5"/><strong>n/a</strong></h4>    
                    </div>
                            <div class="col-md-2 border-right">
                   <h4 class="f-12 m-t-0" align="center">Room Type: <br class="m-b-5"/><strong>SD</strong></h4>    
                    </div>
                            <div class="col-md-2">
                     <h4 class="f-12 m-t-0" align="center">Room No.: <br class="m-b-5"/><strong>201</strong></h4>    
                    </div>
                           
                  
                                </div>
                            <div class="row">
                    <div class="col-md-3 border-right border-top">                   
                            <h4 class="f-12 m-t-5  m-b-0" align="center">Account No.: <br class="m-b-5"/><strong>8Y3008</strong></h4>        
                    </div>
                            <div class="col-md-3 border-right border-top">
                   <h4 class="f-12 m-t-5  m-b-0" align="center">Advanced Deposit: <br class="m-b-5"/><strong>P 1,460</strong></h4>    
                    </div>
                            <div class="col-md-3 border-right border-top">
                    <h4 class="f-12 m-t-5  m-b-0" align="center">No. of Guest: <br class="m-b-5"/><strong>1 of 2</strong></h4>    
                    </div>
                             <div class="col-md-3 border-right border-top">
                    <h4 class="f-12 m-t-5  m-b-0" align="center">Rate Subject to Applicable Local Tax & Service Charge: <br class="m-b-5"/><strong>n/a</strong></h4>    
                    </div>
                        
                           
                  
                                </div>
                            
                        </div>
                    </div>
                  <div class="panel panel-transparent p-15 bd-6" style="border-width:1px;border-color:#b6b6b6;border-style:dashed;">
                        <div class="panel-content">
                <div class="row">
                    <div class="col-md-4">
                    <h5>LAST NAME:</h5> <h4><strong>CRUZ</strong></h4>
                    </div>  
                    <div class="col-md-4">
                       
                           <h5>FIRST NAME:</h5> <h4><strong>MELVIN</strong></h4>
                     
                    </div> 
                    <div class="col-md-4">
                       
                    <h5>MIDDLE NAME:</h5> <h4><strong>GIRON</strong></h4>
              
                    </div>
                </div>
        
                     
                     </div></div>
                  
                    <div class="p-20">
                    <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">Address: <strong>Roxas Street, General Santos City</strong></h4>
                    </div>  
                   
                </div>
                        
                 <div class="row">
                    <div class="col-md-6">
                    <h4 class="f-14">My Account will be settled by: <strong>Guest Account - Cash</strong></h4>
                    </div>  
                </div>
            
                </div>
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal" disabled><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-success btn-embossed" data-dismiss="modal"> REGISTER</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>
        <!-- END PAGE CONTENT -->
      </div>

 

@endsection