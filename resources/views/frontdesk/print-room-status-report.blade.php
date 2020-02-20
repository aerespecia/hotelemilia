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
                <h2>Room Status Report</h2>
                <h4>Date: {{date('F j, Y h:i:s A')}}</h4>
                </div>
                
           
                <table style="margin-bottom:10px;width:100%;table-layout:fixed; border-collapse: collapse;">
                    
                        <tr style="margin-top:10px;padding: 0px;">
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Room Name</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Type</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Status</strong>
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                <strong>Legend</strong>
                            </td>
                        </tr>


                        @foreach($rooms as $r)
                           <tr style="margin-top:10px;padding: 0px;">
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                {{$r->roomName}}
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                                {{$r->type}}
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">
                              @if($r->status=="Occupied")
                                <strong><span style="color:#D3321F;">{{$r->status}}</span></strong>
                              @elseif(in_array($r->id,$blockedRooms))
                                <span style="color:#FFA500;">Blocked/{{$r->status}}</span>
                              @else
                                {{$r->status}}
                              @endif
                            </td>
                            <td valign="top" style="border: solid 1px black;text-align:center;">

                              @if((in_array($r->id,$blockedRooms) and $r->status=="Vacant Ready") or (in_array($r->id,$blockedRooms) and $r->status=="Vacant Dirty") )
                              <span style="background-color:#FFA500;border-radius: 15px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              @elseif($r->status=="Occupied")
                                <span style="background-color:#D3321F;border-radius: 15px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              @elseif($r->status=="Vacant Ready")
                                <span style="background-color:#16A73B;border-radius: 15px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              @elseif($r->status=="Vacant Dirty")
                                <span style="background-color:#F4FA20;border-radius: 15px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                              @endif
                            

                            </td>
                        </tr>
                        @endforeach
                        <tr><td>&nbsp;</td></tr>
                      
                       
                </table> 
                <table style="margin-bottom:10px;width:100%;table-layout:fixed; border-collapse: collapse;">
                    <tr>
                          <td>Legend:</td>
                          <td>   <span style="background-color:#D3321F;border-radius: 15px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Occupied
                          </td>
                          <td>
                              <span style="background-color:#16A73B;border-radius: 15px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Vacant Ready
                          </td>
                          <td>
                        <span style="background-color:#F4FA20;border-radius: 15px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Vacant Dirty
                          </td>
                           <td>
                        <span style="background-color:#FFA500;border-radius: 15px;">&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Blocked
                          </td>
                        </tr>
                </table>
        <br/>
             
              
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