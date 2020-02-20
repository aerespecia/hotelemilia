<head>
      <link href="{{url('assets/global/css/print.css')}}" rel="stylesheet">
</head>

<body>
 
<page size="A4">

                <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
                    <button id="print-button" onclick="print()" style="cursor:pointer;padding:5px;float:right;"><i class="fa fa-print"></i> Print</button>
                    <form type="GET" action="{{route('frontdesk.guestFolio')}}">
                        <input type="hidden" name="reservID" value="{{$guestResInfo->code}}"/>
                        <button type="submit" style="cursor:pointer;padding:5px;margin-right:5px;">Back to page</button>
                    </form>
                    
                </div>
           
                <div id="header" style="text-align:center;">
                 
                <img src="{{url('assets/global/images/logo/q-emblem-final.png')}}" />
                 <h4 style="margin-top:5px;margin-bottom:5px;"><strong>Q CITIPARK HOTEL</strong></h4>
                <p style="margin-top:2px;font-size:10pt;">Roxas Avenue corner JP Laurel Avenue, General Santos City, South Cotabato, 9500</p>
                <h2>GUEST FOLIO</h2>
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
                                <p style="margin-top:5px;text-align:right;padding:5px;">{{date('m/d/Y',strtotime($guestResInfo->arrivalDate))}}</p>
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
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;"></p>
                            </td>
                            <td valign="top" style="border-bottom: 1px solid #ddd;">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;">Remarks</p>
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;"></p>
                            </td>
                        </tr>
                        <tr>
                            <td style="" valign="top"> 
                                <p class="f-10" style="margin-bottom:3px;margin-top:7px;">Room Rate:</p>
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">&#8369; {{number_format($roomRate,2).' ('.$guestResInfo->discountName.' '.($guestResInfo->discountValue * 100).'%)'}}</p>
                            </td>
                            <td valign="top">
                               <p class="f-10" style="margin-bottom:3px;margin-top:7px;">Room Type:</p>
                                <p class="f-11" style="margin-top:5px;word-wrap:break-word;padding:5px;">{{$guestResInfo->roomType}}</p>
                            </td>
                            <td valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;margin-top:7px;">Room No.:</p>
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;">{{$guestResInfo->roomName}}</p>
                            </td>
                            <td valign="top">
                                <p class="f-10" style="margin-bottom:3px;text-align:right;margin-top:7px;">No. of Guest</p>
                                <p class="f-11" style="margin-top:5px;text-align:right;padding:5px;">-</p>
                            </td>
                        </tr>
                    </table>    
                    </div>
    </div> <br/>
                        
                      <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;">
                            <div style="padding-left:10px;padding-right:10px;">
                                
                                 <h3 class="f-12"><strong>CHARGES</strong></h3><hr class="m-t-5"/>
                            <table class="f-10" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
                                <thead>
                                    <tr>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;">DATE</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;width:50%;">REFERENCE/PARTICULARS</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">DEBIT</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">CREDIT</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $amountTotal = 0;
                                          $debitTotal = 0;
                                          $creditTotal = 0;
                                    
                                    ?>
                                      
                                    <tr>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            {{date('m/d/Y',strtotime($guestResInfo->arrivalDate))}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            ROOM: {{$guestResInfo->roomName.' - '.$guestResInfo->roomType.' ('.$guestResInfo->noOfDays.') days -- Rate: '.number_format($roomRate,2).' ('.$guestResInfo->discountName.' '.($guestResInfo->discountValue * 100).'%)'}}
                                        </td>
                                        
                                       
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                        
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                             &#8369; {{number_format($roomRate * $guestResInfo->noOfDays,2)}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format($roomRate * $guestResInfo->noOfDays,2)}} 
                                        </td> 
                                    </tr>
                                                <?php $creditTotal+=$roomRate * $guestResInfo->noOfDays; 
                                                      $amountTotal+=$roomRate * $guestResInfo->noOfDays;
                                                ?>
                                    
                                    @foreach($amendments as $a)
                                    <tr>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            {{date('m/d/Y',strtotime($a->amendDate))}}
                                        </td>
                                        
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            ROOM: {{$a->amendRoomName.' - '.$a->amendRoomType.' ('.$a->amendDays.') days -- Rate: '.number_format($a->amendRate -($a->amendRate*$a->discountValueAmend),2).' ('.$a->discountNameAmend.' '.($a->discountValueAmend * 100).'%)'}}
                                        </td>
                                        
                                       
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                        
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                             &#8369; {{number_format($a->amendRate -($a->amendRate*$a->discountValueAmend),2)}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format($a->amendRate -($a->amendRate*$a->discountValueAmend),2)}} 
                                        </td> 
                                    </tr>
                                                <?php $creditTotal+=($a->amendRate -($a->amendRate*$a->discountValueAmend)) * $a->amendDays; 
                                                      $amountTotal+=($a->amendRate -($a->amendRate*$a->discountValueAmend)) * $a->amendDays;
                                                ?>
                                    @endforeach
                                  

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
                                            
                                        </td>
                                        <td></td>
                                        @elseif($gc->account_type == 2)
                                        <td></td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format($gc->price,2)}} <?php  $creditTotal+=$gc->price; ?>
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
                                        <td valign="top" style="padding: 8px;text-align:right;"></td>
                                        <td valign="top" style="padding: 8px;text-align:right;"></td>
                                        <td valign="top" style="padding: 8px;text-align:right;"> &#8369; {{number_format($amountTotal,2)}}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:right;padding: 8px;">PAYMENTS:</td>
                                        <td></td>
                                        <td valign="top" style="padding: 8px;text-align:right;"> &#8369; {{number_format($creditTotal,2)}}</td>
                                        <td valign="top" style="padding: 8px;text-align:right;"> </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:right;padding: 8px;">BALANCE:</td>
                                        <td></td>
                                        <td valign="top" style="padding: 8px;text-align:right;"> 
                                        <td valign="top" style="padding: 8px;text-align:right;font-weight:bold;"> &#8369; {{number_format($amountTotal-$creditTotal,2)}}</td></td>
                                    </tr>
                                </tbody>
                            </table>     
                        </div>
                                </div>
    
                  
                <br/><br/>
                
                
                  <div class="well bg-white">
                    I agree that my liability for this bill is not waived and that I will be personally liable in the even that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct. 
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
                window.print();
            </script>      
           
     
     <script type="text/javascript">
         
 function print(){
     location.reload();
 }
        
     </script>
</body> 