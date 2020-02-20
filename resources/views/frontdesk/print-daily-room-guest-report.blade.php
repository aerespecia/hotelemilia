<head>
      <link href="{{url('assets/global/css/print.css')}}" rel="stylesheet">
</head>

<body>
 
<page size="A4">

       <div class="modal-content">
                <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
                    <a href="{{route('frontdesk.nightAudit')}}"><< Back</a>
                    <button id="print-button" onclick="printMe()" style="cursor:pointer;padding:5px;float:right;"><i class="fa fa-print"></i> Print</button>
               
                    
                </div>
           
                <div id="header" style="text-align:center;">
                 
                <br/>
                <h2>Daily Room and Guest Count Report</h2>
                <h4>Date: {{date('F j, Y h:i:s A')}}</h4>
                </div>

                <?php $roomsUnique = array(); ?>
                
                <h3 align="center">ARRIVALS</h3>
                <table style="margin-bottom:10px;width:100%;table-layout:fixed; border-collapse: collapse;">
                    
                        <tr class="f-11" style="margin-top:10px;padding: 0px;">
                            <td valign="top" style="border: solid 1px black;text-align:center;width:30%;">
                                <strong>Guest Name/s</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Room No.</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;width:15%;">
                                <strong>Room Type</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;width:10%;">
                                <strong>Arrival Date</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;width:10%;">
                                <strong>Departure Date</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>No. of Pax w/ inclusive BF</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>No. of Pax Add-on BF</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Remarks</strong>
                            </td>
                         
                        </tr>

                        <?php $totalGuestCount = 0;
                              $arrivalsGuestCount = 0;
                              $stayingGuestCount = 0;
                              $departureGuestCount = 0;
                              $roomArrival = 0;
                              $roomStaying = 0;
                              $roomOccupancy = 0;
                              $roomsDepart = 0;

                              ?>
                        @foreach($rooms as $r)
                        @if($r->arrivalDate == date('Y-m-d') and !in_array($r->roomReservationId,$roomsUnique))
                            <?php $tempGuestCount = 0; ?>
                           <tr class="f-11" style="margin-top:10px;padding: 0px;">
                            <td valign="top" style="border: solid 1px black;text-align:left;padding: 8px;word-wrap:break-word;">
                                <ul>
                                @foreach($guestList as $g)
                                  @if($g->roomReservationId == $r->roomReservationId)
                                    <li class="f-11" style="margin-top:1px;margin-bottom: 0px;">{{$g->firstName.' '.$g->familyName}}</li>

                                    <?php $tempGuestCount++;
                                          $totalGuestCount++;
                                          $arrivalsGuestCount++;

                                     ?>
                                  @endif
                                @endforeach
                                </ul>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;padding: 8px;">
                                {{$r->roomName}}
                                <?php $roomArrival++; ?>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;padding: 8px;">
                                {{$r->roomType}}
                            </td>
                          
                            <td valign="top" style="border: solid 1px black;text-align:left;padding: 8px;">
                                {{date('n/j/Y',strtotime($r->arrivalDate))}}
                            </td>
                             <td valign="top" style="border: solid 1px black;text-align:left;padding: 8px;">
                                {{date('n/j/Y',strtotime($r->depatureDate))}}
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;padding: 8px;">
                                {{$tempGuestCount}}
                            </td>
                            <td style="border: solid 1px black;text-align:center;">
                            </td>
                             <td class="f-10" style="border: solid 1px black;text-align:center;word-wrap: break-word;">
                                {{$r->remarks}}

                                 @if($r->remarks == "Checked In")
                                  <?php $roomOccupancy++; ?>
                                @endif
                            </td>
                        </tr>

                        <?php array_push($roomsUnique,$r->roomReservationId); ?>
                        @endif
                        @endforeach
                        <tr>
                            <td valign="top" style="text-align:left;padding: 8px;font-weight: bold;">
                                TOTAL:
                            </td>
                              <td valign="top" style="text-align:center;padding: 8px;font-weight: bold;">
                                {{$roomArrival}}
                            </td>
                            <td valign="top">
                                
                            </td>
                            <td valign="top">
                                
                            </td>
                          
                            <td valign="top">
                                
                            </td>
                           
                            <td valign="top" style="text-align:center;padding: 8px;font-weight: bold;">
                                {{$arrivalsGuestCount}}
                            </td>
                            <td>
                            </td>
                             <td class="f-10">

                            </td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                      
                       
                </table> 


                <h3 align="center">STAYING</h3>
                <table style="margin-bottom:10px;width:100%;table-layout:fixed; border-collapse: collapse;">
                    
                        <tr class="f-11" style="margin-top:10px;padding: 0px;">
                            <td valign="top" style="border: solid 1px black;text-align:center;width:30%;">
                                <strong>Guest Name/s</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Room No.</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;width:15%;">
                                <strong>Room Type</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;width:10%;">
                                <strong>Arrival Date</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;width:10%;">
                                <strong>Departure Date</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>No. of Pax w/ inclusive BF</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>No. of Pax Add-on BF</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Remarks</strong>
                            </td>
                        </tr>

                    
                        @foreach($rooms as $r)
                        @if($r->arrivalDate < date('Y-m-d') and $r->depatureDate > date('Y-m-d') and !in_array($r->roomReservationId,$roomsUnique))
                            <?php $tempGuestCount = 0; ?>
                           <tr class="f-11" style="margin-top:10px;padding: 0px;">
                            <td valign="top" style="border: solid 1px black;text-align:left;padding: 8px;word-wrap:break-word;">
                                <ul>
                                @foreach($guestList as $g)
                                  @if($g->roomReservationId == $r->roomReservationId)
                                    <li class="f-11" style="margin-top:1px;margin-bottom: 0px;">{{$g->firstName.' '.$g->familyName}}</li>

                                    <?php $tempGuestCount++;
                                          $totalGuestCount++;
                                          $stayingGuestCount++;
                                     ?>
                                  @endif
                                @endforeach
                                </ul>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;padding: 8px;">
                                {{$r->roomName}} <?php $roomStaying++; ?>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;padding: 8px;">
                                {{$r->roomType}}
                            </td>
                          
                            <td valign="top" style="border: solid 1px black;text-align:left;padding: 8px;">
                                {{date('n/j/Y',strtotime($r->arrivalDate))}}
                            </td>
                             <td valign="top" style="border: solid 1px black;text-align:left;padding: 8px;">
                                {{date('n/j/Y',strtotime($r->depatureDate))}}
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;padding: 8px;">
                                {{$tempGuestCount}}
                            </td>
                            <td style="border: solid 1px black;text-align:center;">
                            </td>
                             <td class="f-10" style="border: solid 1px black;text-align:center;word-wrap: break-word;">
                                {{$r->remarks}}

                                @if($r->remarks == "Checked In")
                                  <?php $roomOccupancy++; ?>
                                @endif
                            </td>
                        </tr>
                        <?php array_push($roomsUnique, $r->roomReservationId); ?>
                        @endif
                        @endforeach
                            <tr>
                            <td valign="top" style="text-align:left;padding: 8px;font-weight: bold;">
                                TOTAL:
                            </td>
                              
                            <td valign="top" style="text-align:center;padding: 8px;font-weight: bold;">
                                {{$roomStaying}}
                            </td>
                            <td valign="top">
                                
                            </td>
                            <td valign="top">
                                
                            </td>
                          
                            <td valign="top">
                                
                            </td>
                           
                            <td valign="top" style="text-align:center;padding: 8px;font-weight: bold;">
                                {{$stayingGuestCount}}
                            </td>
                            <td>
                            </td>
                             <td class="f-10">

                            </td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                      
                       
                </table> 


                <h3 align="center">DEPARTURES</h3>
                <table style="margin-bottom:10px;width:100%;table-layout:fixed; border-collapse: collapse;">
                    
                        <tr class="f-11" style="margin-top:10px;padding: 0px;">
                            <td valign="top" style="border: solid 1px black;text-align:center;width:30%;">
                                <strong>Guest Name/s</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Room No.</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;width:15%;">
                                <strong>Room Type</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;width:10%;">
                                <strong>Arrival Date</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;width:10%;">
                                <strong>Departure Date</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>No. of Pax w/ inclusive BF</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>No. of Pax Add-on BF</strong>
                            </td>
                      
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Remarks</strong>
                            </td>
                        </tr>

                        @foreach($rooms as $r)
                        @if($r->depatureDate == date('Y-m-d') and !in_array($r->roomReservationId,$roomsUnique))
                            <?php $tempGuestCount = 0; ?>
                           <tr class="f-11" style="margin-top:10px;padding: 0px;">
                            <td valign="top" style="border: solid 1px black;text-align:left;padding: 8px;word-wrap:break-word;">
                                <ul>
                                @foreach($guestList as $g)
                                  @if($g->roomReservationId == $r->roomReservationId)
                                    <li class="f-11" style="margin-top:1px;margin-bottom: 0px;">{{$g->firstName.' '.$g->familyName}}</li>

                                    <?php $tempGuestCount++;
                                          $totalGuestCount++;
                                          $departureGuestCount++;
                                     ?>
                                  @endif
                                @endforeach
                                </ul>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;padding: 8px;">
                                {{$r->roomName}} <?php $roomsDepart++; ?>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;padding: 8px;">
                                {{$r->roomType}}
                            </td>
                          
                            <td valign="top" style="border: solid 1px black;text-align:left;padding: 8px;">
                                {{date('n/j/Y',strtotime($r->arrivalDate))}}
                            </td>
                             <td valign="top" style="border: solid 1px black;text-align:left;padding: 8px;">
                                {{date('n/j/Y',strtotime($r->depatureDate))}}
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;padding: 8px;">
                                {{$tempGuestCount}}
                            </td>
                            <td style="border: solid 1px black;text-align:center;">
                            </td>
                            <td class="f-10" style="border: solid 1px black;text-align:center;word-wrap: break-word;">
                                {{$r->remarks}}

                                 @if($r->remarks == "Checked In")
                                  <?php $roomOccupancy++; ?>
                                @endif
                            </td>
                        </tr>
                        <?php array_push($roomsUnique, $r->roomReservationId); ?>
                        @endif
                        @endforeach
                            <tr>
                              <td valign="top" style="text-align:left;padding: 8px;font-weight: bold;">
                                TOTAL:
                            </td>
                              <td valign="top" style="text-align:center;padding: 8px;font-weight: bold;">
                                {{$roomsDepart}}
                            </td>
                            <td valign="top">
                                
                            </td>
                            <td valign="top">
                                
                            </td>
                          
                            <td valign="top">
                                
                            </td>
                           
                            <td valign="top" style="text-align:center;padding: 8px;font-weight: bold;">
                                {{$departureGuestCount}}
                            </td>
                            <td>
                            </td>
                             <td class="f-10">

                            </td>
                        </tr>
                        <tr><td>&nbsp;</td></tr>
                      
                       
                </table> 
              
        <br/>

 
        <?php $percentage = ($roomOccupancy/41)*100; ?>
        <h5>Room Occupancy Rate: {{$roomOccupancy}}/41 ({{sprintf("%.0f%%",$percentage)}})</h5>
      
        <h5>Total Registered Guests: {{$arrivalsGuestCount+$stayingGuestCount+$departureGuestCount}}</h5>
             
              
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