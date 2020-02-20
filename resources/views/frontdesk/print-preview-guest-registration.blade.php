<head>
      <link href="{{url('assets/global/css/print.css')}}" rel="stylesheet">
</head>

<body>
 
<page size="A4">

                <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
                    <button id="print-button" onclick="printMe()" style="cursor:pointer;padding:5px;float:right;"><i class="fa fa-print"></i> Print</button>
                    <form type="GET" action="{{route('frontdesk.guestRegistration')}}">
                        <input type="hidden" name="reservID" value="{{$g->code}}"/>
                        <button type="submit" style="cursor:pointer;padding:5px;margin-right:5px;">Back to page</button>
                    </form>
                    
                </div>
           
                <div id="header" style="text-align:center;">
                 
             <br/><br/><br/><br/><br/>
                <h3>GUEST REGISTRATION</h3>
                </div>
                      <div class="pull-right">
                      <p class="f-10">GUEST FOLIO NO./S: <strong>{{$g->folioNos}}</strong>
                    </div>
                      <div class="header-two">
                 
                             <h5 style="margin-bottom:3px;"><span style="font-weight:lighter;">RESERVATION ID:</span> <strong>{{$g->code}}</strong></h5>
                            
                          <h5 style="margin-top:5px;margin-bottom:3px;"><span style="font-weight:lighter;">GUEST REGISTRATION ID:</span> <strong><span id="res-reservId">{{$g->guest_registration_no}}</span></strong></h5>
                          
                            <p style="margin-top:5px;" class="f-10">DATE: <strong>{{date('F j, Y')}}</strong></p>
                            
                    </div>

                    
                
                    
                    
                 
                    <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;">
                        
                         <div style="padding-left:10px;padding-right:10px;padding-top:10px;">
                    <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
                        <tr style="margin-bottom:10px;">
                            <td style="border-bottom: 1px solid #ddd;" valign="top"> 
                                <p class="f-10" style="margin-bottom:3px;">Daily Rate:</p>
                                @if($g->discountType == 1)
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">&#8369; {{number_format($g->FinalRoomRate,2).' ('.$g->discountName.' '.$g->discountValue*100}}&#37;)</p>
                                @elseif($g->discountType == 2)
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">&#8369; {{number_format($g->FinalRoomRate,2).' (Less: '.$g->discountName.' '.$g->discountValue.')'}}</p>
                                @endif
                            </td>
                            <td style="border-bottom: 1px solid #ddd;" valign="top">
                               <p class="f-10" style="margin-bottom:3px;">Arrival Date:</p>
                                <p style="margin-top:5px;word-wrap:break-word;padding:5px;">{{date('m/d/Y',strtotime($g->initialArrivalDate))}}</p>
                            </td>
                            <td style="border-bottom: 1px solid #ddd;" valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Departure Date</p>
                                <p style="margin-top:5px;text-align:right;padding:5px;">{{date('m/d/Y',strtotime($g->initialDepartureDate))}}</p>
                            </td>
                            <td style="border-bottom: 1px solid #ddd;" valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Extension Date:</p>
                                @if(strtotime($g->depatureDate) > strtotime($g->initialDepartureDate))
                                <p style="margin-top:5px;text-align:right;padding:5px;">{{date('m/d/Y',strtotime($g->depatureDate))}}</p>
                                @endif
                            </td>
                            <td style="border-bottom: 1px solid #ddd;" valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Room Type:</p>
                                <p style="margin-top:5px;text-align:right;padding:5px;">{{$g->roomType}}</p>
                                
                            </td>
                            <td style="border-bottom: 1px solid #ddd;" valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Room No:</p>
                                
                                <p style="margin-top:5px;text-align:right;padding:5px;">{{$g->roomName}}</p>
                                
                            </td>
                            <td style="border-bottom: 1px solid #ddd;" valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Remarks:</p>
                              
                                <p style="margin-top:5px;text-align:right;padding:5px;">{{$g->transStatus}}</p>
                              
                            </td>
                        </tr>
                      
                    
                        <tr>
                            <td style="" valign="top"> 
                                <p class="f-10" style="margin-bottom:3px;margin-top:7px;">Acc. No:</p>
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;"> {{$g->account_id}}</p>
                            </td>
                            <td valign="top">
                               <p class="f-10" style="margin-bottom:3px;margin-top:7px;">Advanced Deposit:</p>@if($firstDown)
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">&#8369;  {{number_format($firstDown->amount,2)}}</p>@endif
                            </td>
                            <td valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;margin-top:7px;">No. of Guests:</p>
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;">1 of {{$guestCount->count}}</p>
                            </td>
                            <td valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;margin-top:7px;">No. of Rooms</p>
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;">{{$roomCount->count}}</p>
                            </td>
                            <td valign="top" colspan="3">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;margin-top:7px;">**Rate subject to applicable local tax and service charge.</p>
                              
                            </td>
                        </tr>
                    </table>    
                    </div>
    </div> <br/>
                        
                      <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;">
                            <div style="padding-left:10px;padding-right:10px;">
                                
                            <table class="f-10" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
                                    <tr>
                                        <td valign="top" colspan="3">
                                            <p class="f-11" style="margin-bottom:3px;text-align:left;margin-top:7px;"><strong>LAST NAME</strong></p>
                                            <p class="f-14" style="margin-top:5px;text-align:left;padding:5px;">{{strtoupper($g->familyName)}}</p>
                                        </td>
                                        <td valign="top" colspan="3">
                                            <p class="f-11" style="margin-bottom:3px;text-align:left;margin-top:7px;"><strong>FIRST NAME</strong></p>
                                            <p class="f-14" style="margin-top:5px;text-align:left;padding:5px;">{{strtoupper($g->firstName)}}</p>
                                        </td>
                                        <td valign="top" colspan="3">
                                            <p class="f-11" style="margin-bottom:3px;text-align:left;margin-top:7px;"><strong>MIDDLE NAME</strong></p>
                                            <p class="f-14" style="margin-top:5px;text-align:left;padding:5px;">{{strtoupper($g->middleName)}}</p>
                                        </td>
                                 
                                    </tr>
                            
                            </table>     
                        </div>
                </div>

               <br/>
                <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;">
                            <div style="padding-left:10px;padding-right:10px;">
                                
                            <table class="f-10" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
                                    <tr>
                                        <td style="padding-top:10px;" valign="top" colspan="3">
                                             <h5 class="f-11"><strong>Address:</strong></h5>
                                             <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">No. & Street Name: <strong>{{strtoupper($g->houseNo).' '.strtoupper($g->brgy)}}</strong></p>
                                             <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">City and State: <strong>{{strtoupper($g->city)}}</strong></p>
                                             <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Postal Code: <strong>{{strtoupper($g->postalCode)}}</strong></p>
                                             <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Country: <strong>{{strtoupper($g->country)}}</strong></p>
                                             <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Company: <strong>{{strtoupper($g->instiName)}}</strong></p>
                                             <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Contact No: <strong>{{strtoupper($g->contactNo)}}</strong></p>
                                             
                                             <h3 class="f-11"><strong>My Account will be settled through:</strong></h3>
                                             <p class="f-10" style="margin-bottom:1px;margin-left:10px;text-align:left;margin-top:8px;"><strong><i>{{strtoupper($g->billingType.' - '.$g->chargeType)}}</i></strong></p>

                                             <p class="f-10" style="margin-bottom:1px;margin-left:10px;text-align:left;margin-top:10px;">Others:</p>                                             <input type="text" style="border: 0;
    border-bottom: 1px solid #000;margin-left:10px;font-size:12px;width:200px;font-weight:bold;"  value=""/>

                                            <br/><br/>
                                             <p class="f-10" style="margin-bottom:1px;margin-left:10px;text-align:left;margin-top:10px;">CC Details:</p>                                             <input type="text" style="border: 0;
    border-bottom: 1px solid #000;margin-left:10px;font-size:12px;width:200px;font-weight:bold;"  value=""/>
                                              <p class="f-9" style="margin-bottom:1px;margin-left:10px;text-align:left;margin-top:10px;">**Note: This is to authorize the hotel to charge the credit card indicated herein in case of self check-out</p>

                                              <br/>
                                              <p class="f-9" style="margin-bottom:1px;margin-left:10px;text-align:left;margin-top:10px;">I/We agree to conform with the house rules of the hotel.</p>
                                                <br/>
                                              <center>
                                                <input type="text" style="border: 0;
    border-bottom: 1px solid #000;text-align:center;font-size:12px;width:300px;font-weight:bold;"  value="{{$g->firstName.' '.$g->familyName}}"/>
                      <p style="margin-top:0px;font-size:12px;">Guest Printed Name and Signature</p>
                      </center>


                                        </td>
                                        <td style="padding-top:10px;padding-left: 50px;" valign="top" colspan="3">
                                        <h4 class="f-11"><strong>Other details:</strong></h4>
                                            <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Passport/ID No: <strong>{{strtoupper($g->passNo)}}</strong></p>
                                             <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Expiry date: <strong>{{strtoupper($g->passExpiry)}}</strong></p>
                                            <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Date of Issue: <strong>{{strtoupper($g->passIssue)}}</strong></p>
                                             <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Nationality: <strong>{{strtoupper($g->nationality)}}</strong></p>
                                              <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Designation: <strong>{{strtoupper($g->designation)}}</strong></p>
                                               <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Email: <strong>{{strtolower($g->email)}}</strong></p>

                                               <br/>
                                                <p class="f-10" style="margin-bottom:4px;text-align:left;margin-top:7px;">Other ID: <strong>{{strtoupper($g->otherId)}}</strong></p>
                                                <br/>
                                                <p class="f-10" style="margin-bottom:1px;margin-left:10px;text-align:left;margin-top:10px;">LOA:</p>                                             <input type="text" style="border: 0;
    border-bottom: 1px solid #000;margin-left:10px;font-size:12px;width:200px;font-weight:bold;"  value=""/>
                                                <p class="f-10" style="margin-bottom:1px;margin-left:10px;text-align:left;margin-top:10px;">SC Disc:</p>                                             <input type="text" style="border: 0;
    border-bottom: 1px solid #000;margin-left:10px;font-size:12px;width:200px;font-weight:bold;"  value=""/>
                                                <p class="f-10" style="margin-bottom:1px;margin-left:10px;text-align:left;margin-top:10px;">ID No.:</p>                                             <input type="text" style="border: 0;
    border-bottom: 1px solid #000;margin-left:10px;font-size:12px;width:200px;font-weight:bold;"  value=""/><br/><br/><br/>
                                              <center>
                          <input type="text" style="border: 0;
    border-bottom: 1px solid #000;text-align:center;font-size:12px;width:300px;font-weight:bold;"  value="{{$user->firstName.' '.$user->lastName}}"/>
                      <p style="margin-top:0px;font-size:12px;">Receptionist:</p>
                      </center>
                    <p style="margin-top:0px;font-size:12px;">Checked by:</p>
                 
                                        </td>
                                       
                                    </tr>
                            
                            </table>     
                        </div>
                </div>
    
                  
                <br/><br/>
                
                
                    
                 
 <div style="float:right;">
                     


<br/><br/><br/><br/>
               
           
            
    
        
</page>

                    
              <script>
              
            </script>      
           
     
     <script type="text/javascript">
         
 function printMe(){
      window.print();
 }
        
     </script>
</body> 