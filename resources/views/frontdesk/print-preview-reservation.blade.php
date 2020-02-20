<head>
      <link href="{{url('assets/global/css/print.css')}}" rel="stylesheet">
</head>

<body>
  
<page size="A4">
    
                <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
                    <button id="print-button" onclick="printMe()" style="cursor:pointer;padding:5px;float:right;"><i class="fa fa-print"></i> Print</button>
                    <form type="GET" action="{{route('frontdesk.guestRegistration')}}">
                        <input type="hidden" name="reservID" value="{{$tDetails->code}}"/>
                        <button type="submit" style="cursor:pointer;padding:5px;margin-right:5px;">Back to page</button>
                    </form>
                    
                </div>
                <div id="header" style="text-align:center;">
                 
               <br/><br/><br/>
                <h2>RESERVATION SUMMARY</h2>
                </div>
               
                    <div class="header-two">
                 
                             <h4>RESERVATION ID: <strong><span id="res-reservId">{{$tDetails->code}}</span></strong></h4>
                            
                            <p class="f-10">DATE: <strong>{{date('F j, Y')}}</strong></p>
                            
                    </div>
                    
                  
                        <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;margin-bottom:10px;">
                            <div style="padding-left:10px;padding-right:10px;">
                                
                                
                             <table class="f-11" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:0px;">
                                <tbody>
                                    <td valign="top" style="width:20%;padding:10px;">
                                         <h3 class="f-12"><strong>Names of Guest/s:</strong></h3>
                                    <td style="padding:10px;">
                                        <ol>
                                            @foreach($guests as $g)
                                            <li style="padding:3px;">{{strtoupper($g->firstName.' '.$g->familyName)}}</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                </tbody>
                              
                            </table>
                                
                        </div>
                    </div>
                 
                    
                    <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;">
                        
                        <h3 class="m-l-20 f-12" style="margin-bottom: 0px;"><strong>RESERVATION DETAILS:</strong></h3>
                       
                       
                    
                    <div style="padding-left:20px;padding-right:10px;">
                    <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
                        <tr style="margin-bottom:10px;margin-top: 0px;">
                            <td valign="top"> 
                              <p class="f-11" style="margin-bottom:5px;">Arrival: <strong><span id="res-arrival">{{date("m/j/Y",strtotime($tDetails->arrivalDate))}}</span></strong></p>
                            </td>
                           
                            <td valign="top">
                               <p class="f-11" style="margin-bottom:5px;">ETA: <strong><span id="res-checkin">{{$tDetails->checkInTime}} PM</span></strong></p>
                            </td>
                            <td valign="top">
                                <p class="f-11" style="margin-bottom:0px;">Airline: <strong></strong></p> 
                            </td>
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                               <p class="f-11" style="margin-bottom:5px;">Departure: <strong><span id="res-depart">{{date("m/j/Y",strtotime($tDetails->depatureDate))}}</span></strong></p>
                            </td>
                             <td valign="top">
                                <p class="f-11" style="margin-bottom:5px;">ETD: <strong><span id="res-checkout">{{$tDetails->checkOutTime}} PM</span></strong></p> 
                            </td>
                            <td valign="top">
                                    <input type="text" style="border: 0;margin-top: 0px;
    border-bottom: 1px solid #000;text-align:center;font-size:12px;width:200px;font-weight:bold;"/>
                            </td>
                         
                     
                        </tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                        <tr>
                           <td valign="top">
                                  <p class="f-11">Made Thru: <strong><span id="res-madethru">{{$tDetails->madeThru}}</span></strong></p>
                            </td>   
                            <td valign="top">
                                <p class="f-11">Guaranteed: <strong><span id="res-guaranteed">{{$tDetails->guaranteed}}</span></strong></p>
                            </td>
                            <td valign="top">
                                <p class="f-11">Billing Arrangement: <strong><span id="res-billArrange">{{$tDetails->billingType.' - '.$tDetails->chargeType}}</span></strong></p> 
                            </td>
                        </tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr><tr></tr>
                        <tr>
                           <td valign="top" style="width:30%;">
                                  <p class="f-11" style="margin-bottom:5px;">Company: <strong><span id="res-madethru">{{$tDetails->instiName}}</span></strong></p>
                            </td>   
                            <td valign="top" style="width:60%;">
                                <p class="f-11" style="margin-bottom:5px;">Address: <strong><span id="res-guaranteed">{{$tDetails->instiAddress}} </span></strong></p>
                            </td>
                        </tr>
                        <tr>
                           <td valign="top" style="width:30%;">
                                  <p class="f-11" style="margin-bottom:5px;">Booking Person: <strong><span id="res-madethru">{{$tDetails->clientName}}</span></strong></p>
                            </td>   
                            <td valign="top" style="width:60%;">
                                <p class="f-11" style="margin-bottom:5px;">Contact: <strong><span id="res-guaranteed">{{$tDetails->clientContact.', '.$tDetails->instiContact}} </span></strong></p>
                            </td>
                        </tr>
                    

                        <br/>
                    </table>
                      
                    </div>
         
                    </div><br/>
                     <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;margin-bottom:10px;">
                            <div style="padding-left:10px;padding-right:10px;">
                                
                                
                             <table class="f-11" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:0px;">
                                <tbody>
                                    <td valign="top" style="width:20%;padding:10px;">
                                         <h3 class="f-12"><strong>Room List:</strong></h3>
                                    <td style="padding:10px;">
                                        <ol>
                                            @foreach($rooms as $r)
                                            <li style="padding:3px;">{{$r->roomName.' - '.$r->roomType}} ({{$r->discountName.' '.$r->discountValue}}&#37;)</li>
                                            @endforeach
                                        </ol>
                                    </td>
                                </tbody>
                              
                            </table>
                                
                        </div>
                    </div>
                        <br/>

                       <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;margin-bottom:10px;">
                        <table class="f-11" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:0px;">
                                <tbody>
                                    <td valign="top" style="width:20%;padding:10px;">
                                         <h3 class="f-12"><strong>Reservation Notes:</strong></h3>
                                    <td style="padding:10px;">
                                        <p>{{$tDetails->notes}}</p>
                                    </td>
                                </tbody>
                              
                            </table>

                       </div>
                  
                    
               <div style="float:right;">
               <p style="margin-top:0px;font-size:12px;">Date and Time Received:</p><center>
                <p style="margin-top:0px;font-size:11px;"><strong>{{date("m/d/Y h:i:s A",strtotime($tDetails->created_at))}}</strong></p></center>
               <p style="margin-top:0px;font-size:12px;">Booking received by:</p><br/>

                      <center>
                         <input type="text" style="border: 0;
    border-bottom: 1px solid #000;text-align:center;font-size:12px;width:200px;font-weight:bold;"  value="{{$tDetails->firstName.' '.$tDetails->lastName}}"/>
                      <p style="margin-top:0px;font-size:12px;">Front Desk Officer</p>
                      </center>
                   
                  </div>
                   
                  
    
    
                    <br/><br/><br/><br/><br/><br/><br/>
               
                   
         
    
</page>

                    
              <script>
               
            </script>      
           
     
     <script type="text/javascript">
         
 function printMe(){
      window.print();
 }
        
     </script>
</body> 