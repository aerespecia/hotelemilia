
<head>
      <link href="{{url('assets/global/css/print.css')}}" rel="stylesheet">
</head>

<body>
 
<page size="A4">

                <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
                    <button id="print-button" onclick="printMe()" style="cursor:pointer;padding:5px;float:right;"><i class="fa fa-print"></i> Print</button>
                    <form type="GET" action="{{route('frontdesk.guestRegistration')}}">
                        <input type="hidden" name="reservID" value="{{$guestResInfo->code}}"/>
                        <button type="submit" style="cursor:pointer;padding:5px;margin-right:5px;">Back to page</button>
                    </form>
                    
                </div>
           
                <div id="header" style="text-align:center;">
                 
               <br/><br/>
                 <div id="header" style="text-align:center;">
                 <img src="{{url('assets/global/images/logo/hotel-shadow.png')}}" width="215px" height="80px"/>
                 <h4 style="margin-bottom:5px;">Owned and Managed by:</h4>
                 <h4 style="margin-top:0px;">HEAVENBOUNT REALTY CORPORATION</h4>
               
                <h2>GUEST FOLIO</h2><br/>
                </div> 
                </div>
                    
                      <div class="header-two">
                 
                             <h4 style="margin-bottom:3px;"><span style="font-weight:lighter;">RESERVATION ID:</span> <strong>{{$guestResInfo->code}}</strong></h4>
                            
                          <h4 style="margin-top:5px;margin-bottom:3px;"><span style="font-weight:lighter;">GUEST REGISTRATION ID:</span> <strong><span id="res-reservId">{{$guestResInfo->guest_registration_no}}</span></strong></h4>
                          
                            <p style="margin-top:5px;" class="f-10">DATE: <strong>{{date('F j, Y')}}</strong></p>
                            
                    </div>
                
                    
                    
                 
                    <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;">
                        
                         <div style="padding-left:10px;padding-right:10px;padding-top:10px;">
                    <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
                        <tr style="margin-bottom:10px;">
                            <td style="width:40%;border-bottom: 1px solid #ddd;" valign="top"> 
                                <p class="f-10" style="margin-bottom:3px;">Name:</p>
                                <p style="margin-top:5px;word-wrap:break-word;padding:5px;">{{$guestResInfo->firstName.' '.$guestResInfo->familyName}}</p>
                            </td>
                            <td style="border-bottom: 1px solid #ddd;" valign="top">
                               <p class="f-10" style="margin-bottom:3px;">Institution:</p>
                                <p style="margin-top:5px;word-wrap:break-word;padding:5px;">{{$guestResInfo->instiName}}</p>
                            </td>
                            <td style="border-bottom: 1px solid #ddd;" valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Arrival Date</p>
                                <p style="margin-top:5px;text-align:right;padding:5px;">{{date('m/d/Y',strtotime($guestResInfo->initialArrivalDate))}}</p>
                            </td>
                            <td style="border-bottom: 1px solid #ddd;" valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Departure Date:</p>
                                <p style="margin-top:5px;text-align:right;padding:5px;">{{date('m/d/Y',strtotime($guestResInfo->depatureDate))}}</p>
                            </td>
                        </tr>
                        <tr><td><td></td></td></tr>
                        <tr>
                            <td style="width:40%;border-bottom: 1px solid #ddd;" valign="top"> 
                                <p class="f-10" style="margin-bottom:3px;">Address:</p>
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">{{$guestResInfo->houseNo.' '.$guestResInfo->brgy.' '.$guestResInfo->city.' '.$guestResInfo->country}}</p>
                            </td>
                            <td valign="top" style="border-bottom: 1px solid #ddd;">
                               <p class="f-10" style="margin-bottom:3px;">Contact No:</p>
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">{{$guestResInfo->contactNo}}</p>
                            </td>
                            <td valign="top" style="border-bottom: 1px solid #ddd;">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Billing Arrangement:</p>
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;">{{$guestResInfo->billingType.' - '.$guestResInfo->chargeType}}</p>
                            </td>
                            <td valign="top" style="border-bottom: 1px solid #ddd;">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Remarks</p>
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;">{{$guestResInfo->transStatus}}</p>
                            </td>
                        </tr>
                        <tr>
                            <td style="" valign="top"> 
                                <p class="f-10" style="margin-bottom:3px;margin-top:7px;">Room Rate:</p>
                                 @if($guestResInfo->discountType == 1)
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">&#8369; {{number_format($guestResInfo->FinalRoomRate,2).' ('.$guestResInfo->discountName.' '.$guestResInfo->discountValue*100}}&#37;)</p>
                                @elseif($guestResInfo->discountType == 2)
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">&#8369; {{number_format($guestResInfo->FinalRoomRate,2).' (Less: '.$guestResInfo->discountName.' '.$guestResInfo->discountValue.')'}}</p>
                                @endif

                            </td>
                            <td valign="top">
                               <p class="f-10" style="margin-bottom:3px;margin-top:7px;">Room Type:</p>
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">{{($guestResInfo->roomTypeBill  ? $guestResInfo->roomTypeBill : $guestResInfo->roomType)}}</p>
                            </td>
                            <td valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;margin-top:7px;">Room No.:</p>
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;">{{$guestResInfo->roomName}}</p>
                            </td>
                            <td valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;margin-top:7px;">No. of Guest</p>
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;">1 of {{$guestCount->count}}</p>
                            </td>
                        </tr>
                    </table>    
                    </div>
    </div> <br/>
                        
                      <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;">
                            <div style="padding-left:10px;padding-right:10px;">
                                
                                
                            <table class="f-10" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
                                <thead>
                                    <tr>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;">DATE</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;width:50%;">REFERENCE/PARTICULARS</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">CHARGES</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">PAYMENTS</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="5" style="border-bottom: 1px solid #ddd;">
                                        <p class="f-10" style="padding:6px;font-weight: bold;">ROOM CHARGES:</p>
                                        </td>
                                    </tr>
                                    <?php $amountTotal = 0;
                                          $chargesTotal = 0;
                                          $paymentTotal = 0;
                                     
                                    ?> 
                                    @foreach($amendments as $a)

                                    <?php $datediff2 = strtotime($a->amendDepart) - strtotime($a->amendArriv);
                                                $days2 = floor($datediff2 / (60 * 60 * 24));?>
                                    <tr>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            {{date('m/d/Y',strtotime($a->amendDate))}}
                                        </td>
                                        
                                        @if($a->discountType==1)
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            ROOM: {{($a->finalRoomNo  ? $a->finalRoomNo : $a->amendRoomName).' - '.($a->roomTypeBill  ? $a->roomTypeBill : $a->amendRoomType).' ('.$days2.') days -- Rate: '.number_format($a->amendRate -($a->amendRate*$a->discountValueAmend),2).' ('.$a->discountNameAmend.' '.($a->discountValueAmend * 100)}}&#37;)
                                        </td>
                                        @elseif($a->discountType==2)
                                         <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            ROOM: {{$a->amendRoomName.' - '.$a->amendRoomType.' ('.$days2.') days -- Rate: '.number_format($a->amendRate -($a->amendRate*$a->discountValueAmend),2).' (Less: '.$a->discountNameAmend.' '.($a->discountValueAmend)}})
                                        </td>
                                        @endif
                                        
                                       
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format($a->FinalRoomRate*$days2,2)}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                             
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                           &#8369; {{number_format($a->FinalRoomRate*$days2,2)}} 
                                        </td> 
                                    </tr>

                                                <?php $amountTotal+=$a->FinalRoomRate*$days2;
                                                      $chargesTotal+=$a->FinalRoomRate*$days2;
                                                ?>
                                    @endforeach

                                    <tr>
                                        <?php $datediff = strtotime($guestResInfo->depatureDate) - strtotime($guestResInfo->arrivalDate);
                                                $days = floor($datediff / (60 * 60 * 24));?>


                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            {{date('m/d/Y',strtotime($guestResInfo->roomUpdatedAt))}}
                                        </td>
                                        
                                        @if($guestResInfo->discountType==1)
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            ROOM: {{$guestResInfo->roomName.' - '.($guestResInfo->roomTypeBill  ? $guestResInfo->roomTypeBill : $guestResInfo->roomType).' ('.$days.') days -- Rate: '.number_format($guestResInfo->FinalRoomRate,2).' ('.$guestResInfo->discountName.' '.($guestResInfo->discountValue * 100)}}&#37;)
                                        </td>
                                        @elseif($guestResInfo->discountType == 2)
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            ROOM: {{$guestResInfo->roomName.' - '.$guestResInfo->roomType.' ('.$days.') days -- Rate: '.number_format($guestResInfo->FinalRoomRate,2).' (Less: '.$guestResInfo->discountName.' '.($guestResInfo->discountValue)}})
                                        </td>
                                        @endif
                                        
                                       
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format($guestResInfo->FinalRoomRate*$days,2)}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                              
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format($guestResInfo->FinalRoomRate*$days,2)}}
                                        </td> 
                                    </tr>
                                             <?php $amountTotal+=$guestResInfo->FinalRoomRate*$days;
                                                      $chargesTotal+=$guestResInfo->FinalRoomRate*$days;
                                                ?>
                                    <tr>
                                        <td colspan="5" style="border-bottom: 1px solid #ddd;">
                                        <p class="f-10" style="padding:6px;font-weight: bold;">OTHER CHARGES:</p>
                                        </td>
                                    </tr>
                                    @foreach($guestCharges as $gc)
                                    <tr>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            {{date('m/d/Y',strtotime($gc->chargeCreated))}}
                                        </td>
                                        
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            OS/OR No. {{$gc->os_id.' - '.$gc->item_name}}
                                        </td>
                                        
                                       @if($gc->account_type == 1)
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                             &#8369; {{number_format($gc->price,2)}} <?php  $chargesTotal+=$gc->price; ?>
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;"></td>
                                        @elseif($gc->account_type == 2)
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;"></td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format($gc->price,2)}} <?php  $paymentTotal+=$gc->price; ?>
                                        </td>
                                        @endif
                                        
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format($gc->price,2)}} 
                                        </td> 
                                    </tr>
                                                <?php

                                                      $amountTotal+=$gc->price;
                                                ?>
                                    @endforeach

                             


                                    
                                    
                                    
                                    <tr>
                                       
                                        <td colspan="2" style="text-align:right;padding: 8px;">TOTAL:</td>
                                        <td valign="top" style="padding: 8px;text-align:right;">&#8369; {{number_format($chargesTotal,2)}}</td>
                                        <td valign="top" style="padding: 8px;text-align:right;">&#8369; {{number_format($paymentTotal,2)}}</td>
                                        <td valign="top" style="padding: 8px;text-align:right;"> &#8369; {{number_format($amountTotal,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" style="border-bottom: 3px solid black;"></td>
                                    </tr>
                             
                               
                                    <tr>
                                       
                                        <td></td>
                                        <td colspan="3" style="text-align:right;padding: 4px;font-weight:bold;"><p class="f-13">GRAND TOTAL:</p></td>
                
                                        <td valign="top" class="f-13" style="padding: 4px;text-align:right;font-weight:bold;"> &#8369; {{number_format($amountTotal,2)}}</td></td>
                                    </tr>


                                  
                                    <?php $balance = ($amountTotal) - $paymentTotal; 
                                            if($balance < 0)
                                                $balance = 0;
                                    ?>


                                    <tr>
                                       
                                        <td colspan="2" style="text-align:right;padding: 5px;"></td>
                                        
                                        <td valign="top" colspan="2" style="padding: 4px;text-align:right;"> Balance:</td>
                                        <td valign="top" style="padding: 4px;text-align:right;font-style:italic;"> &#8369; {{number_format($balance,2)}}</td></td>
                                    </tr>

                                </tbody>
                            </table>     
                        </div>
                                </div>
    
                  
                <br/><br/>
                
                
                  <div class="well bg-white">
                    I agree that my liability for this bill is not waived and that I will be personally liable in the event that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct. 
                  </div><br/>
                    <br/><br/>

               
                    
                  <div style="float:left;">
                  
                      <center>
                         <input type="text" style="border: 0;
    border-bottom: 1px solid #000;text-align:center;font-size:12px;width:200px;font-weight:bold;"  value="{{$guestResInfo->firstName.' '.$guestResInfo->familyName}}"/>
                      <p style="margin-top:0px;font-size:12px;">Guest Signature</p>
                      </center>
                   
                  </div>

 <div style="float:right;">
                      <center>
                         <input type="text" style="border: 0;
    border-bottom: 1px solid #000;text-align:center;font-size:12px;width:200px;font-weight:bold;"  value="{{$user->firstName.' '.$user->lastName}}"/>
                      <p style="margin-top:0px;font-size:12px;">F.O Cashier</p>
                      </center>
                   
                  </div>


<br/><br/>
               
           
            
    
        
</page>

                    
              <script>
              
            </script>      
           
     
     <script type="text/javascript">
         
 function printMe(){
     window.print();
 }
        
     </script>
</body> 