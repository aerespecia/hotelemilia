<style>
td{
	text-align:center;
}
table { page-break-inside:auto; border-collapse: collapse; }
   tr    { page-break-inside:avoid; page-break-after:auto; }
	table, th, td {
	    border: 2px solid black;
	}

</style>
<h1>Room Occupancy Report</h1>



<table width="100%" border="1">
<tr>
	<th colspan="7">DAILY ROOM AND GUEST COUNT REPORT DATE FROM</th>
	<th colspan="2">TOTAL SUMMARY</th> 
</tr>
<tr>
	<th>DATE</th>
	<th>ROOMS CHECK-IN</th>
	<th>PAX CHECK-IN</th>
	<th>ROOMS CHECK-OUT</th>
	<th>PAX CHECK-OUT</th>
	<th>ROOMS ARRIVAL</th>
	<th>PAX ARRIVAL</th>
	<th>ROOMS</th>
	<th>GUESTS CHECK-IN</th>
</tr>
@for($i=0;$i < count($dates);$i++)	
</tr>
	
	<td>{{$dates[$i]}}</td>
	<?php 
		  $tempRoomsCheckIn = 0;
		  $tempGuestsCheckIn = 0;
		  $tempRoomsArrival = 0;
		  $tempGuestsArrival = 0;
		  $tempRoomsDeparture = 0;
		  $tempGuestsDeparture = 0;
		  $tempRoomsArray = [];
	?>
	@foreach($roomsCheckIn as $rc)

		@if($rc->arrivalDate < $dates[$i] && $rc->depatureDate >= $dates[$i])
		 <?php $tempRoomsCheckIn++; 
		       $tempGuestsCheckIn+=$rc->numGuests;
		 ?>
		 @endif

		 @if($rc->arrivalDate == $dates[$i])
		 <?php $tempRoomsArrival++; 
		       $tempGuestsArrival+=$rc->numGuests;
		 ?>
		 @endif

		 @if($rc->depatureDate == $dates[$i])
		 <?php $tempRoomsDeparture++; 
		       $tempGuestsDeparture+=$rc->numGuests;
		 ?>
		 @endif

		

	@endforeach

	@if($i == 0)
		<td>{{$tempRoomsCheckIn}}</td>
		<td>{{$tempGuestsCheckIn}}</td>
		<td>{{$tempRoomsDeparture}}</td>
		<td>{{$tempGuestsDeparture}}</td>
		<td>{{$tempRoomsArrival}}</td>
		<td>{{$tempGuestsArrival}}</td>
		<td>{{$tempRoomsCheckIn + $tempRoomsDeparture + $tempRoomsArrival}}</td>
		<td>{{$tempGuestsCheckIn + $tempGuestsDeparture + $tempGuestsArrival}}</td>
	@else
		<td>{{$tempRoomsCheckIn}}</td>
		<td>{{$tempGuestsCheckIn}}</td>
		<td>{{$tempRoomsDeparture}}</td>
		<td>{{$tempGuestsDeparture}}</td>
		<td>{{$tempRoomsArrival}}</td>
		<td>{{$tempGuestsArrival}}</td>
		<td>{{$tempRoomsCheckIn - $tempRoomsDeparture + $tempRoomsArrival}}</td>
		<td>{{$tempGuestsCheckIn - $tempGuestsDeparture + $tempGuestsArrival}}</td>
	@endif
</tr>
@endfor

</table>