<head>
  <link href="{{url('assets/global/css/print.css')}}" rel="stylesheet">
</head>

<body>

  <page size="A4">

   <div class="modal-content">
    <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
      <button id="print-button" onclick="printMe()" style="cursor:pointer;padding:5px;float:right;"><i class="fa fa-print"></i> Print</button>
      <form type="GET" action="{{route('frontdesk.guestRegistration')}}">
        <input type="hidden" name="reservID" value="{{$transDetails->code}}"/>
        <button type="submit" style="cursor:pointer;padding:5px;margin-right:5px;">Back to page</button>
      </form>

    </div>

    <div id="header" style="text-align:center;">
      <img src="{{url('assets/global/images/logo/hotel-shadow.png')}}" width="215px" height="80px"/>
      <h4 style="margin-bottom:5px;">Owned and Managed by:</h4>
      <h4 style="margin-top:0px;">HEAVENBOUNT REALTY CORPORATION</h4>

      <h2>{{$transDetails->roomName}} - BILLING STATEMENT</h2><br/>


    </div>


    <div style="padding-left:10px;padding-right:10px;padding-top:10px;">
      <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
        <tr style="margin-bottom:10px;">
          <td valign="top"> 
           <p class="f-10">Booking Person:</p> 
         </td>
         <td valign="top">
          <p class="f-10" style="font-weight:bold;">{{$transDetails->clientName}}</p>
        </td>
        <td valign="top">
         <p class="f-10">Reservation ID:</p>
       </td>
       <td valign="top">
        <p class="f-10" style="font-weight:bold;">{{$transDetails->code}}</p>
      </td>
    </tr>
    <tr style="margin-bottom:10px;">
     <td valign="top">
       <p class="f-10">Institution:</p>
     </td>
     <td valign="top">
      <p class="f-10" style="font-weight:bold;">
       {{$transDetails->instiName}}
     </p>
   </td>
   <td valign="top">
    <p class="f-10">Arrival Date:</p>
  </td>
  <td valign="top">
    <p class="f-10" style="font-weight:bold;">{{date('m/d/Y',strtotime($transDetails->arrivalDate))}}</p>
  </td>
</tr>
<tr style="margin-top:10px;">
 <td valign="top">
   <p class="f-10">Company Address:</p>
 </td>
 <td valign="top">
  <p class="f-10">{{$transDetails->instiAddress}}</p>
</td>
<td valign="top">
  <p class="f-10">Departure Date: </p>
</td>
<td valign="top">
  <p class="f-10" style="font-weight:bold;">{{date('m/d/Y',strtotime($transDetails->depatureDate))}}</p>
</td>
</tr>
<tr style="margin-top:10px;">
  <td valign="top">
   <p class="f-10">Guest/s:</p>
 </td>
 <td valign="top">
  <p class="f-10" style="font-weight:bold;">
   @foreach($guests as $g)
   {{$g->guestName.', '}}
   @endforeach
 </p>
</td>

</tr>

</table> 
</div><br/>
<div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;">
  <div style="padding-left:10px;padding-right:10px;">


    <table class="f-10" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
      <thead>
        <tr>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;">DATE</th>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;">OS/OR No.</th>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;width:40%;">REFERENCE/PARTICULARS</th>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">CHARGES</th>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">PAYMENTS</th>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">AMOUNT</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td colspan="6" style="border-bottom: 1px solid #ddd;">
            <p class="f-10" style="padding:6px;font-weight: bold;">ROOM CHARGES:</p>
          </td>
        </tr>
        <?php $amountTotal = 0;
        $chargesTotal = 0;
        $paymentTotal = 0;
        $discountsTotal = 0;

        ?>
        @foreach($amendments as $a)

        <?php $datediff2 = strtotime($a->amendDepart) - strtotime($a->amendArriv);
        $days2 = floor($datediff2 / (60 * 60 * 24));?>
        <tr>
          <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
            {{date('m/d/Y',strtotime($a->amendDate))}}
          </td>
          <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">

          </td>
          @if($a->discountType==1)
          <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
           <p style="margin-bottom:0px;">ROOM: {{($a->finalRoomNo  ? $a->finalRoomNo : $a->amendRoomName).' - '.($a->roomTypeBill  ? $a->roomTypeBill : $a->amendRoomType).' ('.$days2}}) days</p>
           <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
            {{date("M. d, Y",strtotime($a->amendArriv))}} to {{date("M. d, Y",strtotime($a->amendDepart))}}</p>
            <p style="margin-top:1px;margin-bottom: 0px;font-weight: bold;">
            **ROOM CHANGE**</p>
            <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
              Full Rack Rate: {{number_format($a->amendRate,2)}}</p>
              <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                Less: ({{$a->discountValueAmend*100}}&#37; - {{$a->discountNameAmend}}) -- {{number_format($a->amendRate*$a->discountValueAmend,2)}} </p>
                <p style="margin-top:1px;font-style: italic;font-weight: bold;">
                  Daily Rate: {{number_format($a->FinalRoomRate,2)}}</p>
                </td>
                @elseif($a->discountType==2)

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




             @foreach($rooms as $td)
             <tr>
              <?php $datediff = strtotime($td->depatureDate) - strtotime($td->arrivalDate);
              $days = floor($datediff / (60 * 60 * 24));?>


              <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                {{date('m/d/Y',strtotime($td->roomUpdatedAt))}}
              </td>
              <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;"></td>
              @if($transDetails->discountType==1)
              <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">

                <p style="margin-bottom:0px;">ROOM: {{$td->roomName.' - '.($td->roomTypeBill  ? $td->roomTypeBill : $td->roomType).' ('.$days}}) days</p>
                <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                  {{date("M. d, Y",strtotime($td->arrivalDate))}} to {{date("M. d, Y",strtotime($td->depatureDate))}}</p>
                  <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                    Full Rack Rate: {{number_format($td->roomRate,2)}}</p>
                    <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                     Less: ({{$td->discountValue*100}}&#37; - {{$td->discountName}}) -- {{number_format(($td->roomRate/1.19)*$td->discountValue,2)}}</p>
                      <p style="margin-top:1px;font-style: italic;font-weight: bold;">
                        Daily Rate: {{number_format($td->FinalRoomRate,2)}}</p>

                      </td>
                      @elseif($td->discountType == 2)
                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                        ROOM: {{$td->roomName.' - '.$td->roomType.' ('.$days.') days -- Rate: '.number_format($td->FinalRoomRate,2).' (Less: '.$td->discountName.' '.($td->discountValue)}})
                      </td>
                      @endif


                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                        &#8369; {{number_format($td->FinalRoomRate*$days,2)}}
                      </td>
                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">

                      </td>
                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                        &#8369; {{number_format($td->FinalRoomRate*$days,2)}}
                      </td> 
                    </tr>
                    <?php $amountTotal+=$td->FinalRoomRate*$days;
                    $chargesTotal+=$td->FinalRoomRate*$days;
                    ?>
                    @endforeach


                    @foreach($downpayments as $d)
                    @if($d->roomReservationId == $transDetails->roomReservationId)
                    <tr>
                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                        {{date('m/d/Y',strtotime($d->chargeCreated))}}
                      </td>
                      <td valing="top" style="border-bottom: 1px solid #ddd;padding: 8px;">

                      </td>




                      @foreach($rooms as $r)
                      @if($d->roomReservationId == $r->roomReservationId)
                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                        {{$d->notes.' - '.$r->roomName.' ('.($r->roomTypeBill  ? $r->roomTypeBill : $r->roomType).') - '.$d->paidThru}}
                      </td>
                      @endif
                      @endforeach



                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;"></td>
                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">
                        &#8369; {{number_format($d->amount,2)}} <?php  $paymentTotal+=$d->amount; ?>
                      </td>


                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">

                      </td> 
                    </tr>
                    <?php


                    ?>
                    @endif
                    @endforeach


                    <tr>
                      <td colspan="6" style="border-bottom: 1px solid #ddd;">
                        <p class="f-10" style="padding:6px;font-weight: bold;">F&B CHARGES:</p>
                      </td>
                    </tr>

                    @foreach($guestCharges as $gc)
                    @if($gc->type == 1)
                    <tr>
                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                        {{date('m/d/Y',strtotime($gc->chargeCreated))}}
                      </td>

                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                        {{$gc->os_id}}
                      </td>
                      <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">

                        @if($gc->lessDiscount != 0)
                        <p style="margin-bottom:0px;">{{$gc->item_name}}</p>
                        <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                          Guest: {{$gc->guestName}}</p>
                          <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                            Actual Price: {{number_format($gc->price,2)}}</p>
                            <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                              W/ Less: {{number_format($gc->lessDiscount,2)}}</p>

                              @else
                              <p style="margin-bottom:0px;">{{$gc->item_name}}</p>
                              <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                                Guest: {{$gc->guestName}}</p>
                                @endif

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
                          $discountsTotal+=$gc->lessDiscount;
                          ?>
                          @endif
                          @endforeach
                     

                                <tr>
                                  <td colspan="6" style="border-bottom: 1px solid #ddd;">
                                    <p class="f-10" style="padding:6px;font-weight: bold;">OTHER CHARGES:</p>
                                  </td>
                                </tr>

                                @foreach($guestCharges as $gc)
                                @if($gc->type == 2)
                                <tr>
                                  <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                    {{date('m/d/Y',strtotime($gc->chargeCreated))}}
                                  </td>

                                  <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">
                                    {{$gc->os_id}}
                                  </td>
                                  <td valign="top" style="border-bottom: 1px solid #ddd;padding: 8px;">

                                    @if($gc->lessDiscount != 0)
                                    <p style="margin-bottom:0px;">{{$gc->item_name}}</p>
                                    <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                                      Guest: {{$gc->guestName}}</p>
                                      <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                                        Actual Price: {{number_format($gc->price,2)}}</p>
                                        <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                                          W/ Less: {{number_format($gc->lessDiscount,2)}}</p>

                                          @else
                                          <p style="margin-bottom:0px;">{{$gc->item_name}}</p>
                                          <p style="margin-top:1px;margin-bottom:0px;font-style: italic;">
                                            Guest: {{$gc->guestName}}</p>
                                            @endif

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
                                      $discountsTotal+=$gc->lessDiscount;
                                      $amountTotal+=$gc->price;
                                      ?>
                                      @endif
                                      @endforeach

                                      <tr>
                                        <td colspan="6" style="border-bottom: 3px solid black;"></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td colspan="2" style="text-align:right;padding: 8px;">TOTAL:</td>
                                        <td valign="top" style="padding: 8px;text-align:right;">&#8369; {{number_format($chargesTotal,2)}}</td>
                                        <td valign="top" style="padding: 8px;text-align:right;">&#8369; {{number_format($paymentTotal,2)}}</td>
                                        <td valign="top" style="padding: 8px;text-align:right;"> &#8369; {{number_format($amountTotal,2)}}</td>
                                      </tr>

                                      <?php $shuttleServiceTotal = 0;
                                      $shuttleServiceCount = 0;
                                      ?>

                                      @foreach($guestCharges as $gc)
                                      @if($gc->type == 4)
                                      <?php $shuttleServiceTotal+=$gc->price;
                                      $shuttleServiceCount++;
                                      ?>
                                      @endif
                                      @endforeach





                                      @if($shuttleServiceCount != 0)
                                      <tr>
                                        <td valign="top">   
                                        </td>                           
                                        <td valign="top">
                                        </td>
                                        <td colspan="3" style="text-align:right;padding: 4px;">

                                          <p style="margin-bottom:0px;">Shuttle Service ({{$shuttleServiceCount}})</p>


                                        </td>

                                        
                                        <td valign="top" style="padding: 4px;text-align:right;">
                                          &#8369; {{number_format($shuttleServiceTotal,2)}} 
                                        </td> 
                                      </tr>
                                      @endif
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3" style="text-align:right;padding: 4px;font-weight:bold;"><p class="f-13">TOTAL BILL:</p></td>

                                        <td valign="top" class="f-13" style="padding: 4px;text-align:right;font-weight:bold;"> &#8369; {{number_format($amountTotal+$shuttleServiceTotal,2)}}</td></td>
                                      </tr>


                                      <?php $balance = ($amountTotal+$shuttleServiceTotal) - ($paymentTotal+($withHoldingTax/$finalRoomCount)); 

                                      ?>

                                  <!--     <tr>
                                        <td></td>
                                        <td colspan="2" style="text-align:right;padding: 5px;"></td>
                                        
                                        <td valign="top" colspan="2" style="padding: 4px;text-align:right;"> Total Discounts:</td>
                                        <td valign="top" style="padding: 4px;text-align:right;font-style:italic;">({{number_format($discountsTotal,2)}})</td>
                                      </tr> -->
                                      <tr>
                                        <td></td>
                                        <td colspan="2" style="text-align:right;padding: 5px;"></td>
                                        <td valign="top" colspan="2" style="padding: 4px;text-align:right;"> Withholding Tax:</td>
                                        <td valign="top" style="padding: 4px;text-align:right;font-style:italic;">({{number_format($withHoldingTax/$finalRoomCount,2)}})</td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td></td>
                                        <td colspan="3" style="text-align:right;padding: 4px;font-weight:bold;"><p class="f-13">GRAND TOTAL:</p></td>

                                        <td valign="top" class="f-13" style="padding: 4px;text-align:right;font-weight:bold;"> &#8369; {{number_format(($amountTotal+$shuttleServiceTotal)-($withHoldingTax/$finalRoomCount),2)}}</td></td>
                                      </tr>
                                      <tr>
                                        <td></td>
                                        <td colspan="2" style="text-align:right;padding: 5px;"></td>
                                        
                                        <td valign="top" colspan="2" style="padding: 4px;text-align:right;"> Balance (Less Payments):</td>
                                        <td valign="top" style="padding: 4px;text-align:right;font-style:italic;"> &#8369; {{number_format($balance,2)}}</td></td>
                                      </tr>
                                    </tbody>
                                  </table>     
                                </div>
                              </div>
                              <br/>

                                   <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;margin-right:5px;padding:6px;">
                    <table style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
                        <tr>
                            
                            <td style="width:40%;padding-right: 10px;">
                                <table style="margin-bottom:10px;width:100%;table-layout:fixed;">
                        <tr style="margin-bottom:10px;">
                            <td valign="top" style="width:50%;"> 
                               <p class="f-10">Sub Total:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10" style="font-style:italic;text-align:right;"> {{number_format($amountTotal-(($amountTotal/1.19)*0.12)-(($amountTotal/1.19)*0.07),2)}}</p>
                            </td>
                           
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                             <p class="f-10">VAT Exempt Sales:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10" style="text-align:right;font-style: italic;">{{number_format(0,2)}}</p>
                            </td>
                          
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                             <p class="f-10">Zero Rate Sales:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10" style="text-align:right;font-style: italic;">{{number_format(0,2)}}</p>
                            </td>
                          
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                             <p class="f-10" style="font-weight: bold;">TOTAL VAT:</p>
                            </td>
                            <td valign="top">
                              <p class="f-10" style="text-align:right;font-style: italic;font-weight:bold;"> {{number_format(($amountTotal/1.19)*0.12,2)}}</p>
                            </td>
                          
                        </tr>
                        <tr style="margin-top:10px;">
                            <td valign="top">
                             <p class="f-10" style="font-weight: bold;">TOTAL SC (7% VAT SALES):</p>
                            </td>
                            <td valign="top">
                              <p class="f-10" style="text-align:right;font-style: italic;font-weight:bold;">
                               {{number_format(($amountTotal/1.19)*0.07,2)}}
                                </p>
                            </td>
                          
                        </tr>
                      
                </table> 
                            </td>
                   
                            <td valign="top" style="border-left: 1px solid #ddd;padding-left: 10px;">
                                
                                    <p class="f-10" style="font-style: italic;">*Note: Room rates and other charges are inclusive of 12% VAT and 7% SC</p>
                                    <p class="f-10" style="bottom:0px;">I agree that my liability for this bill is not waived and that I will be personally liable in the event that the indicated person, company or association fails to pay for any or the full amount of these charges. I also agree that all charges contained in this account are correct.</p>
                               
                            </td>
                        </tr>
                    </table>
           </div>
                  <br/> 


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

               </div><br/><br/><br/><br/>
               <p style="margin-top:1px;margin-bottom:0px;font-size:11px;text-align: center;">
                F. Torres Street, Davao City 8000 Philippines
               </p>
               <p style="margin-top:1px;margin-bottom:0px;font-size:11px;text-align: center;">
                Tel. Nos. +63(82) 295-7053; +(82) 295-7393 | Telefax No. +63 (82) 295-7389
               </p>


               <br/><br/><br/><br/>
               <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
                {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@closeTransaction']) !!}
                <input type="hidden" name="transID" value="{{$transDetails->transID}}"/>
                <input type="hidden" name="status" value="1000"/>
                <input type="hidden" name="grandTotal" value="{{$amountTotal+($amountTotal*.1)}}"/>
                <input type="submit" style="cursor:pointer;padding:10px;margin-right:5px;float:right;" onclick="return confirm('This will close the transaction and will be marked as Partial Payment. Make sure all payments are settled/arranged. Are you sure you want to continue?')" value="Partial Payment"/>
                {!! Form::close() !!}
                {!! Form::open(['method'=>'POST','action'=>'FrontDeskController@closeTransaction']) !!}
                <input type="hidden" name="transID" value="{{$transDetails->transID}}"/>
                <input type="hidden" name="status" value="100"/>
                <input type="hidden" name="grandTotal" value="{{$amountTotal+($amountTotal*.1)}}"/>
                <input type="submit" style="cursor:pointer;padding:10px;margin-right:5px;" onclick="return confirm('This will close the transaction and will be marked as Fully Paid. Make sure all payments are settled. Are you sure you want to continue?')" value="Fully Paid"/>
                {!! Form::close() !!}

              </div>

            </page>


            <script>
              //  window.print();
            </script>      


            <script type="text/javascript">

             function printMe(){
               window.print();
             }

           </script>
         </body> 