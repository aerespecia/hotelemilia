<head>
      <link href="{{url('assets/global/css/print.css')}}" rel="stylesheet">
</head>

<body>
 
<page size="A4">
    
                <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
                    <button id="print-button" onclick="print()" style="cursor:pointer;padding:5px;float:right;"><i class="fa fa-print"></i> Print</button>
                    <form type="GET" action="{{route('frontdesk.guestFolio')}}">
                        <input type="hidden" name="reservID" value="{{$tDetails->code}}"/>
                        <button type="submit" style="cursor:pointer;padding:5px;margin-right:5px;">Back to page</button>
                    </form>
                    
                </div>
                <div id="header" style="text-align:center;">
                 
                <img src="{{url('assets/global/images/logo/q-emblem-final.png')}}" />
                 <h4 style="margin-top:5px;margin-bottom:5px;"><strong>Q CITIPARK HOTEL</strong></h4>
                <p style="margin-top:2px;font-size:10pt;">Roxas Avenue corner JP Laurel Avenue, General Santos City, South Cotabato, 9500</p>
                <h2>RESERVATION SUMMARY</h2>
                </div>
               
                    <div class="header-two">
                 
                             <h4>RESERVATION ID: <strong><span id="res-reservId">{{$tDetails->code}}</span></strong></h4>
                            
                            <p class="f-10">DATE: <strong>{{date('F j, Y')}}</strong></p>
                            
                    </div>
                    
                    
                 
                    <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;">
                        
                        <h3 class="m-l-20 f-12"><strong>BOOKING PERSON/INSTITUTION DETAILS:</strong></h3>
                        <hr class="m-b-10"/>
                       
                    
                    <div style="padding-left:10px;padding-right:10px;">
                    <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
                        <tr style="margin-bottom:10px;">
                            <td valign="top"> 
                                <p class="f-10">Booking Person: <strong><span id="res-booking-person">{{$tDetails->clientFirstName.' '.$tDetails->clientLastName}}</span></strong>
                                </p>
                            </td>
                            <td valign="top">
                                <p class="f-10">Contact: <strong><span id="res-bookingP-contact">{{$tDetails->clientContact}}</span></strong></p>
                            </td>
                            <td valign="top">
                                <p class="f-10">Title/Designation: <strong><span id="res-bookingP-title">{{$tDetails->clientTitle}}</span></strong></p>
                            </td>
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                                <p class="f-10">Company/Institution: <strong><span id="res-institution">{{$tDetails->instiName}}</span></strong></p>
                            </td>
                            <td valign="top">
                                <p class="f-10">Account Type: <strong><span id="res-insti-type">{{$tDetails->accountType}}</span></strong></p>
                            </td>
                            <td valign="top" style="word-wrap:break-word;">
                                <p class="f-10">Address: <strong><span id="res-insti-address">{{$tDetails->instiAddress}}asfsfsfsfdsfsdfsfad</span></strong></p>
                            </td>
                        </tr>
                    </table>    
                    </div>
         
                    </div>
                        <br/>
                  <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;">
                        
                        <h3 class="m-l-20 f-12"><strong>RESERVATION DETAILS:</strong></h3>
                        <hr class="m-b-10"/>
                       
                    
                    <div style="padding-left:10px;padding-right:10px;">
                    <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
                        <tr style="margin-bottom:10px;">
                            <td valign="top"> 
                              <p class="f-10">Arrival: <strong><span id="res-arrival">{{date("m/j/Y",strtotime($tDetails->arrivalDate))}}</span></strong></p>
                            </td>
                            <td valign="top">
                               <p class="f-10">Departure: <strong><span id="res-depart">{{date("m/j/Y",strtotime($tDetails->depatureDate))}}</span></strong></p>
                            </td>
                            <td valign="top">
                               <p class="f-10">Check In Time: <strong><span id="res-checkin"></span></strong></p>
                            </td>
                            <td valign="top">
                                <p class="f-10">Check Out Time: <strong><span id="res-checkout"></span></strong></p> 
                            </td>
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                                  <p class="f-10">Made Thru: <strong><span id="res-madethru"></span></strong></p>
                            </td>   
                            <td valign="top">
                                <p class="f-10">Applicable Discount: <strong><span id="res-discount"></span></strong></p>
                            </td>
                            <td valign="top">
                                <p class="f-10">Guaranteed: <strong><span id="res-guaranteed"></span></strong></p>
                            </td>
                            <td valign="top">
                                <p class="f-10">Billing Arrangement: <strong><span id="res-billArrange"></span></strong></p> 
                            </td>
                     
                        </tr>
                    </table>    
                    </div>
         
                    </div><br/>
                    
               
                    <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
                        <tr>
                            <td valign="top">
                                <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;">
                            <div style="padding-left:10px;padding-right:10px;">
                                
                                 <h3 class="f-12"><strong>ROOM DETAILS</strong></h3><hr class="m-t-5"/>
                            <table class="f-10" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
                                <thead>
                                    <tr>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;">ROOM NO.</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;">ROOM TYPE</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;">ROOM RATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $roomNames = array(); ?>
                                    @foreach($roomsAndGuests as $rg)
                                    @if(!in_array($rg->roomNo,$roomNames))
                                    <tr>
                                        <td style="border-bottom: 1px solid #ddd;padding: 8px;">{{$rg->roomNo}}</td>
                                        <td style="border-bottom: 1px solid #ddd;padding: 8px;">{{$rg->roomType}}</td>
                                        <td style="border-bottom: 1px solid #ddd;padding: 8px;">{{$rg->rate}}</td>
                                        
                                        <?php array_push($roomNames, $rg->roomNo); ?>
                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>     
                        </div>
                                </div>
                 
                        </td>
                        <td valign="top">
                                <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;margin-left:5px;border-radius:6px;">
                            <div style="padding-left:10px;padding-right:10px;">
                                 <h3 class="f-12"><strong>GUEST/S LISTING</strong></h3><hr class="m-t-5"/>
                           <table class="f-10" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
                                <thead>
                                    <tr>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;">NAME</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;width:30%;">CONTACT</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;width:20%;">ROOM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $guestIds = array(); ?>
                                    @foreach($roomsAndGuests as $rg)
                                    @if(!in_array($rg->guestId,$guestIds))
                                    @if($rg->firstName != NULL)
                                    <tr>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;word-wrap:break-word;">{{$rg->firstName.' '.$rg->familyName}}</td>
                                        <td style="border-bottom: 1px solid #ddd;padding: 8px;">{{$rg->contactNo}}</td>
                                        <td style="border-bottom: 1px solid #ddd;padding: 8px;">{{$rg->roomNo}}</td>
                                        
                                        <?php array_push($guestIds, $rg->roomNo); ?>
                                    </tr>
                                    @endif
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>    
                                    </div>
                                    </div>
                            </td>
                        </tr>
                    </table>
                  
    
    
                    <br/><br/><br/>
               
                   
         
    
</page>

                    
              <script>
                window.print();
            </script>      
           
     
     <script type="text/javascript">
         
 function print(){
     location.reload();
 }
        
     </script>
</body> 