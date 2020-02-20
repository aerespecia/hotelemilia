<head>
  <link href="{{url('assets/global/css/print.css')}}" rel="stylesheet">
</head>

<body>

  <page size="A4">

    <div id="header-1" align="right" style="border-bottom:1px solid dashed;border-color:#b6b6b6;">
      <button id="print-button" onclick="printMe()" style="cursor:pointer;padding:5px;float:right;"><i class="fa fa-print"></i> Print</button>
  

    </div><br/><br/>
    <div id="header" style="text-align:center;">

   
     <h2>CHECKED OUT REPORT - <span>{{date('F j, Y',strtotime($checkOutDate))}}</span></h2>
     <small>Date Printed: {{date('F j, Y h:i a')}}</small>
   </div>
  <br/>

   <div style="border-width:1px;border-color:#b6b6b6;border-style:dashed;border-radius:6px;">




    <table class="f-10" style="width:100%;table-layout:fixed;text-align:left;margin-bottom:10px;">
      <thead>
        <tr>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;">ROOM</th>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;">Booking Person</th>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;">FROM</th>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;">TO</th>
          <th style="border-bottom: 1px solid #ddd;padding: 8px;text-align:right;">OCCUPIED STATUS</th>

        </tr>
      </thead>
      <tbody>

        @foreach($roomReservations as $rr)
        <tr>
         
          <td style="text-align:left;padding: 8px;">{{$rr->room}}</td>
          <td valign="top" style="padding: 8px;text-align:left;">{{$rr->bookingPerson}}</td>
          <td valign="top" style="padding: 8px;text-align:right;">{{$rr->arrivalDate." - ".$rr->checkInTime}}</td>
          <td valign="top" style="padding: 8px;text-align:right;">{{$rr->depatureDate." - ".$rr->checkOutTime}}</td>
          <td valign="top" style="padding: 8px;text-align:right;">{{$rr->status}}</td>

         
        </tr>
        @endforeach


      </tbody>
    </table> 
    

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