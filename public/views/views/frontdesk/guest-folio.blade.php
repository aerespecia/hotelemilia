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
               <li class="nav-active"><a href="{{route('frontdesk.guestRegistration')}}"><i class="fa fa-users"></i><span>Guest Registration</span></a></li>
                   <li class="nav-active active"><a href=""><i class="icon-note"></i><span>Guest Folio</span></a></li>
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

              <h2><i class="icon-note"></i> <strong>GUEST</strong> FOLIO</h2>
              
          <hr class="m-b-0"/>
          </div>
            <div class="row">
            <div class="col-md-12">
                    <div class="panel">
                     <div class="panel-header bg-white">
                  <h4><strong>RESERVATION </strong>LOOK UP</h4>
                  <div class="control-btn">
                    <a href="#" class="panel-toggle"><i class="fa fa-eye"></i> Show/Hide</a>
                
                  </div>
                </div>
           <div class="panel-content">
           <div class="row">
             <div class="col-md-12 portlets">
                 
                    <div class="panel">
               
                        <div class="panel-header">
                            <h3><i class="fa fa-bell-o"></i> <strong>Confirmed Reservations (Staying/Departure)</strong></h3>
                            
                </div>
                        <div class="panel-content">
                            <div class="panel panel-transparent">
                
                <div class="panel-content" style="height:200px;overflow-y:scroll;">
                  <table class="table table-hover f-12">
                    <thead>
                      <tr>
                        <th>Guest/s</th>
                        <th>Room</th>
                        <th>Dates</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Jonathan Sison</td>
                        <td>DSDW - Gov't</td>
                        <td>08/26/16 - 08/28/16</td>
                        <td><span class="label label-success">Confirmed</span>  <button type="button" class="btn-sm btn-default btn-transparent">Select</button></td>
                      </tr>
                     <tr>
                        <td>Jonathan Sison</td>
                        <td>DSDW - Gov't</td>
                        <td>08/26/16 - 08/28/16</td>
                        <td><span class="label label-success">Confirmed</span>  <button type="button" class="btn-sm btn-default btn-transparent">Select</button></td>
                      </tr>
                       <tr>
                        <td>Jonathan Sison</td>
                        <td>DSDW - Gov't</td>
                        <td>08/26/16 - 08/28/16</td>
                        <td><span class="label label-success">Confirmed</span>  <button type="button" class="btn-sm btn-default btn-transparent">Select</button></td>
                      </tr>
                        <tr>
                        <td>Jonathan Sison</td>
                        <td>DSDW - Gov't</td>
                        <td>08/26/16 - 08/28/16</td>
                        <td><span class="label label-success">Confirmed</span>  <button type="button" class="btn-sm btn-default btn-transparent">Select</button></td>
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
                        <div class="panel-header bg-green">
                            <h4><i class="fa fa-users"></i> <strong>GUEST FOLIO</strong></h4>
                            <h3>RESERVATION ID: <strong>261608-0001-F6BY</strong></h3>
                            
                           
                            
                           
                </div>
                        <div class="panel-content">
                             
                            <div class="panel panel-transparent">
                
                <div class="panel-content" style="height:200px;overflow-y:scroll;">
                  <table class="table table-hover f-12">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Guest No.</th>
                        <th>Room</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>Melvin Cruz</td>
                        <td>GC-0002-XG8Y3108</td>
                        <td>201</td>
                        <td><span class="label label-success">Full Paid</span>  
                            <button type="button" data-toggle="modal" data-target="#modal-edit" class="btn-sm btn-default btn-transparent">Edit</button>
                            <button type="button" data-toggle="modal" data-target="#modal-guest" class="btn-sm btn-default btn-transparent">View</button>
                           
                          </td>
                      </tr>
                     <tr>
                        <td>Ian De Castro</td>
                        <td>GC-0001-XG8Y3008</td>
                        <td>202</td>
                        <td><span class="label label-danger">Not Paid</span>  <button type="button"  class="btn-sm btn-default btn-transparent">View</button></td>
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
                            
                    <h4 class="f-13">Status: <strong><span class="label label-success">Confirmed</span></strong></h4>
                   
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
                     <div class="col-md-4">
                   <button class="btn btn-primary" data-toggle="modal" data-target="">Edit</button>
                  </div>
                  <div class="col-md-4">
                   <button class="btn btn-primary f-10" data-toggle="modal" data-target="#modal-bill">Billing Statement</button>
                  </div>
                   
                            </div>
                    
                </div>
                </div>
            </div> 
            </div>

            
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
          
        
            <!--- GUEST FOLIO VIEW MODAL BEGINS -->    
       <div class="modal fade" id="modal-guest" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>GUEST FOLIO:</strong> MELVIN CRUZ</h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>GUEST FOLIO</strong></h2><hr/>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="f-10 m-t-0 m-b-0">GUEST REGISTRATION NO: <strong>GC-0002-XG8Y3008</strong></p>
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
                    <div class="col-md-3 border-right">                   
                            <h4 class="f-12 m-t-0">Name: <br class="m-b-5"/><strong class="f-16">Melvin Cruz</strong></h4>        
                    </div>
                    <div class="col-md-3 border-right">                   
                            <h4 class="f-12 m-t-0">Institution: <br class="m-b-5"/><strong class="f-16">DSWD</strong></h4>        
                    </div>
                            <div class="col-md-3 border-right">
                   <h4 class="f-12 m-t-0" align="center">Arrival Date: <br class="m-b-5"/><strong>Sep. 16, 2016</strong></h4>    
                    </div>
                            <div class="col-md-3 border-right">
                    <h4 class="f-12 m-t-0" align="center">Departure Date: <br class="m-b-5"/><strong>Sep. 18, 2016</strong></h4>    
                    </div>
                                </div>
                            
                            <div class="row">
                    <div class="col-md-3 border-right">                   
                            <h4 class="f-12 m-t-0">Address: <br class="m-b-5"/><strong>P. Sherman, Wallaby Way, San Isidro, GSC</strong></h4>        
                    </div>
                    <div class="col-md-3 border-right">                   
                            <h4 class="f-12 m-t-0">Contact No: <br class="m-b-5"/><strong>09392514687</strong></h4>        
                    </div>
                            <div class="col-md-3 border-right">
                   <h4 class="f-12 m-t-0" align="center">Billing Arrangement: <br class="m-b-5"/><strong>Guaranteed by Magnolia</strong></h4>    
                    </div>
                            <div class="col-md-3 border-right">
                    <h4 class="f-12 m-t-0" align="center">Remarks: <br class="m-b-5"/><strong>n/a</strong></h4>    
                    </div>
                                </div>
                            
                            <div class="row">
                    <div class="col-md-3 border-right border-top">                   
                            <h4 class="f-12 m-t-5  m-b-0" align="center">Room Rate: <br class="m-b-5"/><strong>&#8369; 1,500</strong></h4>        
                    </div>
                            <div class="col-md-3 border-right border-top">
                   <h4 class="f-12 m-t-0" align="center">Room Type: <br class="m-b-5"/><strong>Standard Double</strong></h4>       
                    </div>
                                  <div class="col-md-3 border-right border-top">
                  <h4 class="f-12 m-t-0" align="center">Room No.: <br class="m-b-5"/><strong>201</strong></h4>  
                    </div>
                            <div class="col-md-3 border-right border-top">
                    <h4 class="f-12 m-t-5  m-b-0" align="center">No. of Guest: <br class="m-b-5"/><strong>1 of 2</strong></h4>    
                    </div>
                                </div>
                            
                        </div>
                    </div>
         
                  
                    <div class="p-20">
                 <div class="row">
                <div class="col-md-12">
                
                  <table class="table table-bordered">
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
                      <tr>
                        <td>09/14/16</td>
                        <td>Room Charge (1) One Night - 201 Standard Double</td>
                        <td class="text-right"></td>
                        <td class="text-right">&#8369; 1,500</td>
                        <td class="text-right">&#8369; 1,500</td>
                      </tr>
                      <tr>
                        <td>09/14/16</td>
                        <td>OS No. 1234 - Capareda Coffee</td>
                        <td class="text-right">&#8369; 550</td>
                        <td></td>
                        <td class="text-right">&#8369; 550</td>
                      </tr>
                     <tr>
                        <td>09/14/16</td>
                        <td>OS No. 5678 - Cake</td>
                        <td class="text-right"></td>
                        <td class="text-right">&#8369; 250</td>
                        <td class="text-right">&#8369; 250</td>
                      </tr>
                        <tr>
                        <td>09/14/16</td>
                        <td>OS No. 7528 - The Shake</td>
                        <td class="text-right"></td>
                        <td class="text-right">&#8369; 150</td>
                        <td class="text-right">&#8369; 150</td>
                      </tr>
                        <tr>
                     
                        <td colspan="2" class="text-right">Total</td>
                        <td></td>
                        <td></td>
                        <td class="text-right">&#8369; 2,450</td>
                      </tr>
                      <tr>
                        <td colspan="2" class="text-right">Payments</td>
                        <td></td>
                        <td class="text-right">&#8369; 1,900</td>
                          <td></td>
                      </tr>
                        <tr>
                        <td colspan="2" class="text-right">Balance/Amount Payable</td>
                        <td></td>
                        <td></td>
                        <td class="text-right f-20"><strong>&#8369; 550</strong></td>
                      </tr>
                   
                     
                    
                    </tbody>
                  </table>
                  <div class="well bg-white">
                    I agree that my liability for this bill is not waived and that I will be personally liable in the even that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct. 
                  </div>
                </div>
              </div>
           
            
                </div>
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal"><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-success btn-embossed" data-dismiss="modal"> EDIT</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>
<!--- GUEST FOLIO VIEW MODA ENDS -->

 <!--- GUEST FOLIO VIEW MODAL BEGINS -->    
       <div class="modal fade" id="modal-bill" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-primary">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                    <h4 class="modal-title"><strong>BILLING STATEMENT</strong></h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>BILLING STATEMENT</strong></h2><hr/>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                        </div>
                         <div class="col-md-6">
                            <div class="pull-right">
                             <p class="f-10 m-b-0">RESERVATION ID: <strong>261608-0001-F6BY</strong></p>
                           
                            <p class="f-10 m-t-0">DATE: <strong>AUGUST 30, 2016</strong></p>
                            </div>
                       
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="f-12 m-t-0 m-b-0">Date: </p>
                                    <p class="f-12 m-t-0 m-b-0">Guest Name/s: </p>
                                    <p class="f-12 m-t-0 m-b-0">Room rate: </p>
                                    <p class="f-12 m-t-0 m-b-0">Arrival date: </p>
                                    <p class="f-12 m-t-0 m-b-0">Charge to: </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="f-12 m-t-0 m-b-0"><strong>09/20/2016</strong></p>
                                    <p class="f-12 m-t-0 m-b-0"><strong>Melvin Cruz</strong></p>
                                    <p class="f-12 m-t-0 m-b-0"><strong>&#8369; 1,500</strong></p>
                                    <p class="f-12 m-t-0 m-b-0"><strong>September 12, 2016</strong></p>
                                    <p class="f-12 m-t-0 m-b-0"><strong>DSWD</strong></p>
                                </div>
                            </div> 
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="f-12 m-t-0 m-b-0">&nbsp;</p>
                                    <p class="f-12 m-t-0 m-b-0">Room No./s: </p>
                                    <p class="f-12 m-t-0 m-b-0">Deposit: </p>
                                    <p class="f-12 m-t-0 m-b-0">Departure date: </p>
                                    <p class="f-12 m-t-0 m-b-0">Address: </p>
                                </div>
                                <div class="col-md-6">
                                    <p class="f-12 m-t-0 m-b-0"><strong>&nbsp;</strong></p>
                                    <p class="f-12 m-t-0 m-b-0"><strong>201</strong></p>
                                    <p class="f-12 m-t-0 m-b-0"><strong>&#8369; 1,500 (Cash)</strong></p>
                                    <p class="f-12 m-t-0 m-b-0"><strong>September 13, 2016</strong></p>
                                    <p class="f-12 m-t-0 m-b-0"><strong>P. Sherman Wallaby Way, GSC</strong></p>
                                </div>
                            </div>
                       
                        </div>
                    </div>
                    
                    
                 
         
                  
                    <div class="p-20">
                 <div class="row">
                <div class="col-md-12">
                
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th style="width:65px" class="unseen text-center">Date</th>
                        <th class="text-left">Reference/Particulars</th>
                        <th align="center">QTY</th>
                        <th style="width:95px" align="center">Amount</th>
                        <th style="width:95px">Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>09/14/16</td>
                        <td>Room Charge (1) One Night - 201 Standard Double</td>
                        <td class="text-right">1</td>
                        <td class="text-right">&#8369; 1,500</td>
                        <td class="text-right">&#8369; 1,500</td>
                      </tr>
                      <tr>
                        <td>09/14/16</td>
                        <td>OS No. 1234 - Capareda Coffee</td>
                        <td class="text-right">1</td>
                        <td class="text-right">&#8369; 550</td>
                        <td class="text-right">&#8369; 550</td>
                      </tr>
                     <tr>
                        <td>09/14/16</td>
                        <td>OS No. 5678 - Cake</td>
                        <td class="text-right">1</td>
                        <td class="text-right">&#8369; 250</td>
                        <td class="text-right">&#8369; 250</td>
                      </tr>
                        <tr>
                        <td>09/14/16</td>
                        <td>OS No. 7528 - The Shake</td>
                        <td class="text-right">1</td>
                        <td class="text-right">&#8369; 150</td>
                        <td class="text-right">&#8369; 150</td>
                      </tr>
                        <tr>
                     
                        <td colspan="2" class="text-right no border">Total</td>
                        <td class="no border"></td>
                        <td class="no border"></td>
                        <td class="text-right no border">&#8369; 2,450</td>
                      </tr>
                      <tr>
                        <td colspan="2" class="text-right no border">Plus VAT (12%)</td>
                        <td class="no border"></td>
                        <td class="no border"></td>
                          <td class="text-right no border">&#8369; 294</td>
                      </tr>
                        <tr>
                        <td colspan="2" class="text-right no border">GRAND TOTAL</td>
                        <td class="no border"></td>
                        <td class="no border"></td>
                        <td class="text-right f-20 no border"><strong>&#8369; 2,774</strong></td>
                      </tr>
                        <tr>
                        <td colspan="2" class="text-right no border">Less Deposits OR no. 1234</td>
                        <td class="no border"></td>
                        <td class="no border"></td>
                          <td class="text-right no border">&#8369; 1,900</td>
                      </tr>
                       <tr>
                        <td colspan="2" class="text-right no border f-14">Balance</td>
                        <td class="no border"></td>
                        <td class="no border"></td>
                        <td class="text-right no border f-14">&#8369; 874</td>
                      </tr>
                   
                     
                    
                    </tbody>
                  </table>
                  <div class="well bg-white">
                    I agree that my liability for this bill is not waived and that I will be personally liable in the even that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct. 
                  </div>
                </div>
              </div>
           
            
                </div>
                <div class="modal-footer bg-dark">
                  <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal">CLOSE</button>
                     <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal"><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-success btn-embossed" data-dismiss="modal"> EDIT</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>
<!--- GUEST FOLIO VIEW MODA ENDS -->

            
  <!--- GUEST FOLIO EDIT MODAL BEGINS -->    
       <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header bg-aero">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icons-office-52"></i></button>
                  <h4 class="modal-title"><strong>GUEST FOLIO EDIT:</strong> MELVIN CRUZ</h4>
                 
                </div>
                <div class="modal-body">
                    <div class="row"><br/>
                        <h2 align="center"><strong>GUEST FOLIO</strong></h2><hr/>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="f-10 m-t-0 m-b-0">GUEST REGISTRATION NO: <strong>GC-0002-XG8Y3008</strong></p>
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
                    <div class="col-md-6 border-right">                   
                            <h4 class="f-12 m-t-0 p-10">Name: <br class="m-b-5"/><strong class="f-16">Melvin Cruz</strong></h4>        
                    </div>
                            <div class="col-md-3 border-right">
                   <h4 class="f-12 m-t-0" align="center">Arrival Date: <br class="m-b-5"/><strong>Sep. 16, 2016</strong></h4>    
                    </div>
                            <div class="col-md-3 border-right">
                    <h4 class="f-12 m-t-0" align="center">Departure Date: <br class="m-b-5"/><strong>Sep. 18, 2016</strong></h4>    
                    </div>
                            
                        
                           
                  
                                </div>
                            <div class="row">
                    <div class="col-md-6 border-right border-top">                   
                            <h4 class="f-12 m-t-5  m-b-0" align="center">Account No.: <br class="m-b-5"/><strong>8Y3008</strong></h4>        
                    </div>
                            <div class="col-md-2 border-right border-top">
                   <h4 class="f-12 m-t-0" align="center">Room Type: <br class="m-b-5"/><strong>SD</strong></h4>       
                    </div>
                                  <div class="col-md-2 border-right border-top">
                  <h4 class="f-12 m-t-0" align="center">Room No.: <br class="m-b-5"/><strong>201</strong></h4>  
                    </div>
                            <div class="col-md-2 border-right border-top">
                    <h4 class="f-12 m-t-5  m-b-0" align="center">No. of Guest: <br class="m-b-5"/><strong>1 of 2</strong></h4>    
                    </div>
                           
                        
                           
                  
                                </div>
                            
                        </div>
                    </div>
         
                  
                    <div class="p-20">
                 <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12 m-t-20 m-b-20">
                      <p><strong>Invoice Date:</strong> <span>May 4, 2014</span></p>
                      <p><strong>Due Date:</strong> <span>Mai 16, 2014</span></p>
                    </div>
                  </div>
                  <table class="table">
                    <thead>
                      <tr>
                        <th style="width:65px" class="unseen text-center">QTY</th>
                        <th class="text-left">DESCRIPTION</th>
                        <th style="width:145px" class="text-right">UNIT PRICE</th>
                        <th style="width:95px" class="text-right">TOTAL</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="item-row">
                        <td class="delete-wpr">
                          <p class="qty text-center">1</p>
                        </td>
                        <td>
                          <div class="text-primary">
                            <p><strong>Coffee</strong></p>
                          </div>
                          <p class="width-100p"><small></small></p>
                        </td>
                        <td>
                          <p class="text-right cost">P 79.00</p>
                        </td>
                        <td class="text-right price">P 79.00</td>
                      </tr>
                      <tr class="item-row">
                        <td class="delete-wpr">
                          <p class="qty text-center">2</p>
                        </td>
                        <td>
                          <div class="text-primary">
                            <p><strong>Another Coffee</strong></p>
                          </div>
                          <p class="width-100p"><small></small></p>
                        </td>
                        <td class="text-right">P 150.00</td>
                        <td class="text-right price">P 300.00</td>
                      </tr>
                      <tr class="item-row">
                        <td class="delete-wpr">
                          <p class="qty text-center">1</p>
                        </td>
                        <td>
                          <div class="text-primary">
                            <p><strong>Extra Bed</strong></p>
                          </div>
                          <p class="width-100p"><small></small></p>
                        </td>
                        <td class="text-right">P 85.00</td>
                        <td class="text-right price">P 85.00</td>
                      </tr>
                      <tr>
                        <td colspan="2" rowspan="4"></td>
                        <td class="text-right"><strong>Subtotal</strong></td>
                        <td class="text-right" id="subtotal">P 464.00</td>
                      </tr>
                    
                        <td class="text-right no-border">
                          <div><strong>Total</strong></div>
                        </td>
                        <td class="text-right" id="total">P 464.00</td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="well bg-white">
                    I agree that my liability for this bill is not waived and that I will be personally liable in the even that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct. 
                  </div>
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
                     <button type="button" class="btn btn-white btn-embossed" data-dismiss="modal"><i class="fa fa-print"></i> PRINT</button>
                  <button type="button" class="btn btn-success btn-embossed" data-dismiss="modal"> EDIT</button>
                </div>
              </div>
            </div>
          </div>
            
        </div>
<!-- GUEST FOLIO EDIT END --->
        <!-- END PAGE CONTENT -->


      </div>

 

@endsection