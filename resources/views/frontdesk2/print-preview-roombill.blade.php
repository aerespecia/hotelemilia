<head>
      <link href="{{url('assets/global/css/print.css')}}" rel="stylesheet">
</head>

<body>
 
<page size="A4">

                 <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
                    <button id="print-button" onclick="print()" style="cursor:pointer;padding:5px;float:right;"><i class="fa fa-print"></i> Print</button>
                    <form type="GET" action="{{route('frontdesk.guestFolio')}}">
                        <input type="hidden" name="reservID" value="{{$roomDetails->code}}"/>
                        <button type="submit" style="cursor:pointer;padding:5px;margin-right:5px;">Back to page</button>
                    </form>
                    
                </div>
           
                <div id="header" style="text-align:center;">
                 
                <img src="{{url('assets/global/images/logo/q-emblem-final.png')}}" />
                 <h4 style="margin-top:5px;margin-bottom:5px;"><strong>Q CITIPARK HOTEL</strong></h4>
                <p style="margin-top:2px;font-size:10pt;">Roxas Avenue corner JP Laurel Avenue, General Santos City, South Cotabato, 9500</p>
                <h2>ROOM BILL: {{$roomDetails->roomNo.' - '.$roomDetails->roomType}}</h2>
                </div>
                <br/>
           
            <div style="padding-left:10px;padding-right:10px;padding-top:10px;">
                <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
                        <tr style="margin-bottom:10px;">
                            <td valign="top"> 
                               <p class="f-10">Date:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10">{{date('m/d/Y')}}</p>
                            </td>
                            <td valign="top">
                              <p class="f-10">Room Rate:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10">&#8369; {{number_format($roomDetails->rate-($roomDetails->rate * $roomDetails->discountValue),2).' ('.$roomDetails->discountName.' '.($roomDetails->discountValue * 100).'%)'}}</p>
                            </td>
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                             <p class="f-10">Reservation ID:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10">{{$roomDetails->code}}</p>
                            </td>
                            <td valign="top">
                              <p class="f-10">Room Type: </p>
                            </td>
                            <td valign="top">
                              <p class="f-10">{{$roomDetails->roomType}}</p>
                            </td>
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                             <p class="f-10">Guest Names/s:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10">
                                  <?php $count = 1; ?>
                                @foreach($roomCharges as $rc)
                                  <?php $firstName = $rc->firstName; ?>
                                  @if($count != count($roomCharges))
                                  {{$firstName[0].'. '.$rc->familyName.', '}}
                                  <?php $count++ ?>
                                  @else
                                  {{$firstName[0].'. '.$rc->familyName}}
                                  @endif
                                @endforeach
                                </p>
                            </td>
                            <td valign="top">
                              <p class="f-10">Arrival Date:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10">{{date('m/d/Y',strtotime($roomDetails->arrivalDate))}}</p>
                            </td>
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                             <p class="f-10">Charge to:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10">{{$roomDetails->instiName}}</p>
                            </td>
                            <td valign="top">
                              <p class="f-10">Departure Date:</p>
                            </td>
                            <td valign="top">
                            <p class="f-10">{{date('m/d/Y',strtotime($roomDetails->depatureDate))}}</p>
                            </td>
                        </tr>
                </table> 
           </div><br/>
           
           <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;">
                            <div style="padding-left:10px;padding-right:10px;">
                                
                                 <h3 class="f-12"><strong>CHARGES</strong></h3><hr class="m-t-5"/>
                            <table class="f-10" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
                                <thead>
                                    <tr>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;">DATE</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;">OS/OR No.</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;width:40%;">REFERENCE/PARTICULARS</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">AMOUNT</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">PAYMENTS</th>
                                        <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">BALANCE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                      <?php $amountTotal = 0;
                                          $paymentsTotal = 0;
                                          $balanceTotal = 0;
                                    
                                    ?>
                                    <tr>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            {{date('m/d/Y',strtotime($roomDetails->arrivalDate))}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;"></td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            ROOM: {{$roomDetails->roomName.' - '.$roomDetails->roomType.' ('.$roomDetails->noOfDays.') days -- Rate: '.number_format($roomDetails->rate -($roomDetails->rate*$roomDetails->discountValue),2).' ('.$roomDetails->discountName.' '.($roomDetails->discountValue * 100).'%)'}}
                                        </td>
                                        
                                    
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                             &#8369; {{number_format(($roomDetails->rate -($roomDetails->rate*$roomDetails->discountValue))*$roomDetails->noOfDays,2)}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format(($roomDetails->rate -($roomDetails->rate*$roomDetails->discountValue))*$roomDetails->noOfDays,2)}} 
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                          
                                        </td>
                                    </tr>
                                                <?php $paymentsTotal+=($roomDetails->rate -($roomDetails->rate*$roomDetails->discountValue)) * $roomDetails->noOfDays; 
                                                      $amountTotal+=($roomDetails->rate -($roomDetails->rate*$roomDetails->discountValue)) * $roomDetails->noOfDays;
                                                ?>
                                    
                                      @foreach($amendments as $a)
                                    <tr>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            {{date('m/d/Y',strtotime($a->amendDate))}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;"></td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                            ROOM: {{$a->amendRoomName.' - '.$a->amendRoomType.' ('.$a->amendDays.') days -- Rate: '.number_format($a->amendRate -($a->amendRate*$a->discountValueAmend),2).' ('.$a->discountNameAmend.' '.($a->discountValueAmend * 100).'%)'}}
                                        </td>
                                        
                                    
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                             &#8369; {{number_format(($a->amendRate -($a->amendRate*$a->discountValueAmend))*$a->amendDays,2)}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                            &#8369; {{number_format(($a->amendRate -($a->amendRate*$a->discountValueAmend))*$a->amendDays,2)}} 
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                          
                                        </td>
                                    </tr>
                                                <?php $paymentsTotal+=($a->amendRate -($a->amendRate*$a->discountValueAmend)) * $a->amendDays; 
                                                      $amountTotal+=($a->amendRate -($a->amendRate*$a->discountValueAmend)) * $a->amendDays;
                                                ?>
                                    @endforeach
                                    
                                    
                                    
                                    
                                    
                                   @foreach($roomCharges as $rc)
                                    <tr>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                          {{date('m/d/Y',strtotime($rc->chargeCreated))}}
                                        </td>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;word-wrap:break-word;">
                                            {{$rc->os_id}}
                                        </td>
                                        
                                        
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:left;">
                                           {{$rc->item_name}}
                                        </td>
                                        <?php $tempAmount = 0;
                                              $tempPayment = 0;
                                            ?>
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                           &#8369; {{number_format($rc->price,2)}}
                                            <?php $amountTotal+=$rc->price; $tempAmount = $rc->price;?>
                                        </td>   
                                      
                                        @if($rc->account_type == 2)
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                          &#8369;  {{number_format($rc->price,2)}}
                                            
                                            <?php $paymentsTotal+=$rc->price; $tempPayment=$rc->price; ?>
                                        </td>
                                        @else
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;"></td>
                                        @endif
                                        
                                        <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                                          &#8369;  {{number_format($tempAmount - $tempPayment,2)}}
                                            <?php $balanceTotal+=($tempAmount - $tempPayment); ?>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    <tr>
                                        <td colspan="3" style="text-align:right;padding: 8px;">TOTAL:</td>
                                        
                                        <td valign="top" style="padding: 8px;text-align:right;">&#8369; {{number_format($amountTotal,2)}}</td>
                                        <td valign="top" style="padding: 8px;text-align:right;"> &#8369; {{number_format($paymentsTotal,2)}} </td>
                                        <td valign="top" style="padding: 8px;text-align:right;"> &#8369; {{number_format($balanceTotal,2)}}</td>
                                    </tr>
                                
                                </tbody>
                            </table>     
                        </div>
                </div>
                    <br/><br/>
                  
                    I agree that my liability for this bill is not waived and that I will be personally liable in the even that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct. 
                
                   <br/><br/><br/>
                    
                  <div style="float:left;">
                      <center>
                         <input type="text" style="border: 0;
    border-bottom: 1px solid #000;text-align:center;font-size:12px;width:200px;font-weight:bold;"/>
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
//                window.print();
            </script>      
           
     
     <script type="text/javascript">
         
 function print(){
     location.reload();
 }
        
     </script>
</body> 