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
<h1>Daily Report</h1>


<h3>Date and Shift: {{$dateFilter}}</h3>
<h3>Cash Sales</h3>
*T.R.A.C = Total Room Amend Charge
<table width="100%" border="1">
<tr>
	<th colspan="12"></th>
	
	<th colspan="2">Daily</th>
	<th colspan="3">Overall</th>
</tr>
<tr> 
	<th>Room No.</th>
	<th>Code</th>	
	<th>Arrival & Depature</th>
	
	<th>Room Rate</th>
	
	<th>FNB</th>
	<th>Room Service</th>
	<th>Minibar</th>
	<th>Total Bill</th>
	<th>12% VAT</th>
	<th>5% SC</th>
	<th>Shuttle Service</th>
	<th>Grand Total</th>

	<th>Daily Net Income</th>
	<th>Daily Cash Received</th>
	<th>Total Net Income</th>
	<th>Total Cash Received</th>
	<th>Net Balance</th>
</tr>
<?php
	$fnbTotal=0;
	$roomServiceTotal=0;
	$miniBarTotal=0;
	$shuttleServiceTotal=0;
	$totalBillTotal=0;
	$VATTotal=0;
	$serviceChargeTotal=0;
	$GrandTotal=0;
	$fnbTotalDiscount=0;
	$roomServiceTotalDiscount=0;
	$miniBarTotalDiscount=0;
	$netIncome=0;
	$downpaymentsOverallTotal=0;
	$overallDownpaymentsNetTotal=0;
	$overallNetIncome=0;
	$overallNetIncomeNetTotal=0;
?>

@foreach($salesCash as $t)


@if($t->downpaymentsTotal != 0)


<tr>
	<td>{{$t->roomName}}</td>

	<td>{{$t->code}}</td>

	<td>{{$t->reservationPeriod}}</td>
	
	<td>{{$t->roomRate}}</td>
	

	<td>{{number_format($t->fnb,2)}}</td>
	<td>{{number_format($t->roomService,2)}}</td>
	<td>{{number_format($t->miniBar,2)}}</td>
	<td>{{number_format($t->totalBill,2)}}</td>

	<td>{{number_format($t->totalBill - (($t->totalBill/1.19)*0.12),2)}}</td>
	<td>{{number_format($t->serviceCharge,2)}}</td>
	<td>{{number_format($t->shuttleService,2)}}</td>
	
	<td>{{number_format(($t->totalBill + $t->shuttleService),2)}}</td>


		
	<th>{{number_format(($t->totalBill + $t->shuttleService) - $t->totalChargeDiscount,2)}}</th>

	<th>{{number_format($t->downpaymentsTotal,2)}}</th>

	<th>{{number_format((($t->overallTotalBill + $t->netShuttleService) - $t->netTotalDiscount),2)}}</th>
	<th>{{number_format($t->overallDownpaymentsNet,2)}}</th>

	<th>{{number_format(($t->overallTotalBill + $t->netShuttleService - $t->netTotalDiscount - $t->overallDownpaymentsNet),2)}}</th>
	

</tr>
<?php
	$fnbTotal+= $t->fnb;
	$roomServiceTotal+= $t->roomService;
	$miniBarTotal+= $t->miniBar;
	$shuttleServiceTotal+= $t->shuttleService;
	$totalBillTotal+= $t->totalBill;
	$VATTotal+= $t->totalBill - ($t->totalBill/1.12);
	$serviceChargeTotal+= $t->serviceCharge;
	$GrandTotal+=($t->totalBill + $t->shuttleService);

	$fnbTotalDiscount+= $t->fnbDiscount;
	$roomServiceTotalDiscount+= $t->roomServiceDiscount;
	$miniBarTotalDiscount+= $t->miniBarDiscount;

	$downpaymentsOverallTotal +=$t->downpaymentsTotal;


	
	$overallNetIncome += $t->overallTotalBill + $t->netShuttleService - $t->netTotalDiscount;
	$overallDownpaymentsNetTotal += $t->overallDownpaymentsNet;

	$overallNetIncomeNetTotal += (($t->overallTotalBill + $t->netShuttleService) - $t->netTotalDiscount)- $t->overallDownpaymentsNet;
	

	$netIncome += (($t->totalBill + $t->shuttleService) - $t->totalChargeDiscount);

?>
@endif

@endforeach
<tr>
	<th colspan="4" style="text-align:right;">Total:</th>
	
	<th>{{number_format($fnbTotal,2)}}</th>
	<th>{{number_format($roomServiceTotal,2)}}</th>
	<th>{{number_format($miniBarTotal,2)}}</th>
	<th>{{number_format($totalBillTotal,2)}}</th>
	<th>{{number_format($VATTotal,2)}}</th>
	<th>{{number_format($serviceChargeTotal,2)}}</th>
	<th>{{$shuttleServiceTotal}}</th>	
	<th>{{number_format($GrandTotal,2)}}</th>

	<th>{{number_format($netIncome,2)}}</th>
	<th>{{number_format($downpaymentsOverallTotal,2)}}</th>
    <th>{{number_format($overallNetIncome,2)}}</th>
    <th>{{number_format($overallDownpaymentsNetTotal,2)}}</th>
    <th>{{number_format($overallNetIncomeNetTotal,2)}}</th>
	

</tr>
<tr>
	<th colspan="17" style="text-align:right">&nbsp;</th>
	
</tr>
<tr>
	<th colspan="14" style="text-align:right">TOTAL NET INCOME: </th>
	<th colspan="3" style="text-align:right">{{number_format($netIncome,2)}}</th>
</tr>
<tr>
	<th colspan="14" style="text-align:right">CASH ON HAND: </th>
	<th colspan="3" style="text-align:right">{{number_format($downpaymentsOverallTotal,2)}}</th>
</tr>
<tr>
	<th colspan="14" style="text-align:right">ACCOUNT RECEIVABLES: </th>
	<th colspan="3" style="text-align:right">{{number_format($overallNetIncomeNetTotal,2)}}</th>
</tr>
</table>
<h5>*Other discount such as Employee, Government and other discounts is not included </h5>

<h3>Credit Card Sales</h3>
*T.R.A.C = Total Room Amend Charge
<table width="100%" border="1">
<tr>
	<th colspan="12"></th>
	
	<th colspan="2">Daily</th>
	<th colspan="3">Overall</th>
</tr>
<tr> 
	<th>Room No.</th>
	<th>Code</th>	
	<th>Arrival & Depature</th>
	
	<th>Room Rate</th>
	
	<th>FNB</th>
	<th>Room Service</th>
	<th>Minibar</th>
	<th>Total Bill</th>
	<th>12% VAT</th>
	<th>5% SC</th>
	<th>Shuttle Service</th>
	<th>Grand Total</th>

	<th>Daily Net Income</th>
	<th>Daily Cash Received</th>
	<th>Total Net Income</th>
	<th>Total Cash Received</th>
	<th>Net Balance</th>
</tr>
<?php
	$fnbTotal=0;
	$roomServiceTotal=0;
	$miniBarTotal=0;
	$shuttleServiceTotal=0;
	$totalBillTotal=0;
	$VATTotal=0;
	$serviceChargeTotal=0;
	$GrandTotal=0;
	$fnbTotalDiscount=0;
	$roomServiceTotalDiscount=0;
	$miniBarTotalDiscount=0;
	$netIncome=0;
	$downpaymentsOverallTotal=0;
	$overallDownpaymentsNetTotal=0;
	$overallNetIncome=0;
	$overallNetIncomeNetTotal=0;
?>

@foreach($salesCard as $t)

@if($t->downpaymentsTotal != 0)



<tr>
	<td>{{$t->roomName}}</td>

	<td>{{$t->code}}</td>

	<td>{{$t->reservationPeriod}}</td>
	
	<td>{{$t->roomRate}}</td>
	

	<td>{{number_format($t->fnb,2)}}</td>
	<td>{{number_format($t->roomService,2)}}</td>
	<td>{{number_format($t->miniBar,2)}}</td>
	<td>{{number_format($t->totalBill,2)}}</td>

	<td>{{number_format($t->totalBill - ($t->totalBill/1.12),2)}}</td>
	<td>{{number_format($t->serviceCharge,2)}}</td>
	<td>{{number_format($t->shuttleService,2)}}</td>
	
	<td>{{number_format(($t->totalBill + $t->shuttleService),2)}}</td>


		
	<th>{{number_format(($t->totalBill + $t->shuttleService) - $t->totalChargeDiscount,2)}}</th>

	<th>{{number_format($t->downpaymentsTotal,2)}}</th>

	<th>{{number_format((($t->overallTotalBill + $t->netShuttleService) - $t->netTotalDiscount),2)}}</th>
	<th>{{number_format($t->overallDownpaymentsNet,2)}}</th>

	<th>{{number_format(($t->overallTotalBill + $t->netShuttleService - $t->netTotalDiscount - $t->overallDownpaymentsNet),2)}}</th>
	

</tr>
<?php
	$fnbTotal+= $t->fnb;
	$roomServiceTotal+= $t->roomService;
	$miniBarTotal+= $t->miniBar;
	$shuttleServiceTotal+= $t->shuttleService;
	$totalBillTotal+= $t->totalBill;
	$VATTotal+= $t->totalBill - ($t->totalBill/1.12);
	$serviceChargeTotal+= $t->serviceCharge;
	$GrandTotal+=($t->totalBill + $t->shuttleService);

	$fnbTotalDiscount+= $t->fnbDiscount;
	$roomServiceTotalDiscount+= $t->roomServiceDiscount;
	$miniBarTotalDiscount+= $t->miniBarDiscount;

	$downpaymentsOverallTotal +=$t->downpaymentsTotal;


	
	$overallNetIncome += $t->overallTotalBill + $t->netShuttleService - $t->netTotalDiscount;
	$overallDownpaymentsNetTotal += $t->overallDownpaymentsNet;

	$overallNetIncomeNetTotal += (($t->overallTotalBill + $t->netShuttleService) - $t->netTotalDiscount)- $t->overallDownpaymentsNet;
	

	$netIncome += (($t->totalBill + $t->shuttleService) - $t->totalChargeDiscount);

?>
@endif

@endforeach
<tr>
	<th colspan="4" style="text-align:right;">Total:</th>
	
	<th>{{number_format($fnbTotal,2)}}</th>
	<th>{{number_format($roomServiceTotal,2)}}</th>
	<th>{{number_format($miniBarTotal,2)}}</th>
	<th>{{number_format($totalBillTotal,2)}}</th>
	<th>{{number_format($VATTotal,2)}}</th>
	<th>{{number_format($serviceChargeTotal,2)}}</th>
	<th>{{$shuttleServiceTotal}}</th>	
	<th>{{number_format($GrandTotal,2)}}</th>

	<th>{{number_format($netIncome,2)}}</th>
	<th>{{number_format($downpaymentsOverallTotal,2)}}</th>
    <th>{{number_format($overallNetIncome,2)}}</th>
    <th>{{number_format($overallDownpaymentsNetTotal,2)}}</th>
    <th>{{number_format($overallNetIncomeNetTotal,2)}}</th>
	

</tr>
<tr>
	<th colspan="17" style="text-align:right">&nbsp;</th>
	
</tr>
<tr>
	<th colspan="14" style="text-align:right">TOTAL NET INCOME: </th>
	<th colspan="3" style="text-align:right">{{number_format($netIncome,2)}}</th>
</tr>
<tr>
	<th colspan="14" style="text-align:right">CASH ON HAND: </th>
	<th colspan="3" style="text-align:right">{{number_format($downpaymentsOverallTotal,2)}}</th>
</tr>
<tr>
	<th colspan="14" style="text-align:right">ACCOUNT RECEIVABLES: </th>
	<th colspan="3" style="text-align:right">{{number_format($overallNetIncomeNetTotal,2)}}</th>
</tr>
</table>
<h5>*Other discount such as Employee, Government and other discounts is not included </h5>

<h3>Cheque Sales</h3>
*T.R.A.C = Total Room Amend Charge
<table width="100%" border="1">
<tr>
	<th colspan="12"></th>
	
	<th colspan="2">Daily</th>
	<th colspan="3">Overall</th>
</tr>
<tr> 
	<th>Room No.</th>
	<th>Code</th>	
	<th>Arrival & Depature</th>
	
	<th>Room Rate</th>
	
	<th>FNB</th>
	<th>Room Service</th>
	<th>Minibar</th>
	<th>Total Bill</th>
	<th>12% VAT</th>
	<th>5% SC</th>
	<th>Shuttle Service</th>
	<th>Grand Total</th>

	<th>Daily Net Income</th>
	<th>Daily Cash Received</th>
	<th>Total Net Income</th>
	<th>Total Cash Received</th>
	<th>Net Balance</th>
</tr>
<?php
	$fnbTotal=0;
	$roomServiceTotal=0;
	$miniBarTotal=0;
	$shuttleServiceTotal=0;
	$totalBillTotal=0;
	$VATTotal=0;
	$serviceChargeTotal=0;
	$GrandTotal=0;
	$fnbTotalDiscount=0;
	$roomServiceTotalDiscount=0;
	$miniBarTotalDiscount=0;
	$netIncome=0;
	$downpaymentsOverallTotal=0;
	$overallDownpaymentsNetTotal=0;
	$overallNetIncome=0;
	$overallNetIncomeNetTotal=0;
?>

@foreach($salesCheque as $t)

@if($t->downpaymentsTotal != 0)



<tr>
	<td>{{$t->roomName}}</td>

	<td>{{$t->code}}</td>

	<td>{{$t->reservationPeriod}}</td>
	
	<td>{{$t->roomRate}}</td>
	

	<td>{{number_format($t->fnb,2)}}</td>
	<td>{{number_format($t->roomService,2)}}</td>
	<td>{{number_format($t->miniBar,2)}}</td>
	<td>{{number_format($t->totalBill,2)}}</td>

	<td>{{number_format($t->totalBill - ($t->totalBill/1.12),2)}}</td>
	<td>{{number_format($t->serviceCharge,2)}}</td>
	<td>{{number_format($t->shuttleService,2)}}</td>
	
	<td>{{number_format(($t->totalBill + $t->shuttleService),2)}}</td>


		
	<th>{{number_format(($t->totalBill + $t->shuttleService) - $t->totalChargeDiscount,2)}}</th>

	<th>{{number_format($t->downpaymentsTotal,2)}}</th>

	<th>{{number_format((($t->overallTotalBill + $t->netShuttleService) - $t->netTotalDiscount),2)}}</th>
	<th>{{number_format($t->overallDownpaymentsNet,2)}}</th>

	<th>{{number_format(($t->overallTotalBill + $t->netShuttleService - $t->netTotalDiscount - $t->overallDownpaymentsNet),2)}}</th>
	

</tr>
<?php
	$fnbTotal+= $t->fnb;
	$roomServiceTotal+= $t->roomService;
	$miniBarTotal+= $t->miniBar;
	$shuttleServiceTotal+= $t->shuttleService;
	$totalBillTotal+= $t->totalBill;
	$VATTotal+= $t->totalBill - ($t->totalBill/1.12);
	$serviceChargeTotal+= $t->serviceCharge;
	$GrandTotal+=($t->totalBill + $t->shuttleService);

	$fnbTotalDiscount+= $t->fnbDiscount;
	$roomServiceTotalDiscount+= $t->roomServiceDiscount;
	$miniBarTotalDiscount+= $t->miniBarDiscount;

	$downpaymentsOverallTotal +=$t->downpaymentsTotal;


	
	$overallNetIncome += $t->overallTotalBill + $t->netShuttleService - $t->netTotalDiscount;
	$overallDownpaymentsNetTotal += $t->overallDownpaymentsNet;

	$overallNetIncomeNetTotal += (($t->overallTotalBill + $t->netShuttleService) - $t->netTotalDiscount)- $t->overallDownpaymentsNet;
	

	$netIncome += (($t->totalBill + $t->shuttleService) - $t->totalChargeDiscount);

?>
@endif

@endforeach
<tr>
	<th colspan="4" style="text-align:right;">Total:</th>
	
	<th>{{number_format($fnbTotal,2)}}</th>
	<th>{{number_format($roomServiceTotal,2)}}</th>
	<th>{{number_format($miniBarTotal,2)}}</th>
	<th>{{number_format($totalBillTotal,2)}}</th>
	<th>{{number_format($VATTotal,2)}}</th>
	<th>{{number_format($serviceChargeTotal,2)}}</th>
	<th>{{$shuttleServiceTotal}}</th>	
	<th>{{number_format($GrandTotal,2)}}</th>

	<th>{{number_format($netIncome,2)}}</th>
	<th>{{number_format($downpaymentsOverallTotal,2)}}</th>
    <th>{{number_format($overallNetIncome,2)}}</th>
    <th>{{number_format($overallDownpaymentsNetTotal,2)}}</th>
    <th>{{number_format($overallNetIncomeNetTotal,2)}}</th>
	

</tr>
<tr>
	<th colspan="17" style="text-align:right">&nbsp;</th>
	
</tr>
<tr>
	<th colspan="14" style="text-align:right">TOTAL NET INCOME: </th>
	<th colspan="3" style="text-align:right">{{number_format($netIncome,2)}}</th>
</tr>
<tr>
	<th colspan="14" style="text-align:right">CASH ON HAND: </th>
	<th colspan="3" style="text-align:right">{{number_format($downpaymentsOverallTotal,2)}}</th>
</tr>
<tr>
	<th colspan="14" style="text-align:right">ACCOUNT RECEIVABLES: </th>
	<th colspan="3" style="text-align:right">{{number_format($overallNetIncomeNetTotal,2)}}</th>
</tr>
</table>
<h5>*Other discount such as Employee, Government and other discounts is not included </h5>

<h2>Ammended Rooms Attached w/ Charge</h2>
<table width="100%" border="1">
<tr>
	<th>Code</th>
	<th>Room No.</th>
	<th>Arrival & Depature</th>
	<th>Day/s</th>
	<th>Room Rate</th>
	<th>Total</th>
	<th>Remarks</th>
</tr>


@foreach($ammendRooms as $t)
<tr>
	<td>{{$t->code}}</td>

	<td>{{$t->roomName}}</td>
	<td>{{$t->reservationPeriod}}</td>
	<td>{{$t->days}}</td>
	<td>{{number_format($t->roomRate,2)}}</td>
	<td>{{number_format($t->totalAmmendRoom,2)}}</td>
	<td>{{$t->notes}}</td>
	
	
</tr>
@endforeach
</table>
<br>
<br>

<h2>Transaction Status</h2>
<table width="100%" border="1">
<tr>


</tr>
<tr>
	<th>Room No.</th>
	<th>Code</th>	
	<th>Arrival & Depature</th>
	<th>Day/s</th>
	<th>Room Rate</th>
	<th>T.R.A.C.</th>
	<th>FNB</th>
	<th>Room Service</th>
	<th>Minibar</th>
	<th>Total Bill</th>
	<th>12% VAT</th>
	<th>5% SC</th>
	<th>Shuttle Service</th>
	<th>Grand Total</th>

	<th>Net Income</th>
	<th>Cash Received</th>
	<th>Net Balance</th>
</tr>
<?php
	$fnbTotal=0;
	$roomServiceTotal=0;
	$miniBarTotal=0;
	$shuttleServiceTotal=0;
	$totalBillTotal=0;
	$VATTotal=0;
	$serviceChargeTotal=0;
	$GrandTotal=0;
	$fnbTotalDiscount=0;
	$roomServiceTotalDiscount=0;
	$miniBarTotalDiscount=0;
	$netIncome=0;
	$downpaymentsOverallTotal=0;
?>

@foreach($salesTotal as $tt)
<tr>
	<td>{{$tt->roomName}}</td>
	<td>{{$tt->code}}</td>
	<td>{{$tt->reservationPeriod}}</td>
	<td>{{$tt->days}}</td>	
	<td>{{number_format($tt->roomRate,2)}}</td>
	<td>{{number_format($tt->ammendCharge,2)}}</td>

	<td>{{number_format($tt->fnb,2)}}</td>
	<td>{{number_format($tt->roomService,2)}}</td>
	<td>{{number_format($tt->miniBar,2)}}</td>
	<td>{{number_format($tt->totalBill,2)}}</td>

	<td>{{number_format($tt->totalBill - ($tt->totalBill/1.12),2)}}</td>
	<td>{{number_format($tt->serviceCharge,2)}}</td>
	<td>{{number_format($tt->shuttleService,2)}}</td>
	<td>{{number_format(($tt->totalBill + $tt->shuttleService),2)}}</td>

	
	<th>{{number_format(($tt->totalBill + $tt->shuttleService) - $tt->totalChargeDiscount,2)}}</th>
	<th>{{number_format($tt->downpaymentsTotal,2)}}</th>

	<th>{{number_format(((($tt->totalBill + $tt->shuttleService) - $tt->totalChargeDiscount)-$tt->downpaymentsTotal),2)}}</th>


</tr>
<?php
	$fnbTotal+= $tt->fnb;
	$roomServiceTotal+= $tt->roomService;
	$miniBarTotal+= $tt->miniBar;
	$shuttleServiceTotal+= $tt->shuttleService;
	$totalBillTotal+= $tt->totalBill;
	$VATTotal+= $tt->totalBill - ($tt->totalBill/1.12);
	$serviceChargeTotal+= $tt->serviceCharge;
	$GrandTotal+=($tt->totalBill + $tt->shuttleService);

	$fnbTotalDiscount+= $tt->fnbDiscount;
	$roomServiceTotalDiscount+= $tt->roomServiceDiscount;
	$miniBarTotalDiscount+= $tt->miniBarDiscount;

	$downpaymentsOverallTotal +=$tt->downpaymentsTotal;

	$netIncome += (($tt->totalBill + $tt->shuttleService) - $tt->totalChargeDiscount);

?>
@endforeach
<tr>
	<th colspan="6" style="text-align:right;">Total:</th>
	
	<th>{{number_format($fnbTotal,2)}}</th>
	<th>{{number_format($roomServiceTotal,2)}}</th>
	<th>{{number_format($miniBarTotal,2)}}</th>
	<th>{{number_format($totalBillTotal,2)}}</th>
	<th>{{number_format($VATTotal,2)}}</th>
	<th>{{number_format($serviceChargeTotal,2)}}</th>
	<th>{{number_format($shuttleServiceTotal,2)}}</th>
	<th>{{number_format($GrandTotal,2)}}</th>

	<th>{{number_format($netIncome,2)}}</th>
	<th>{{number_format($downpaymentsOverallTotal,2)}}</th>
	<th>{{number_format($netIncome-$downpaymentsOverallTotal,2)}}</th>

	

</tr>
<tr>
	<th colspan="17" style="text-align:right">&nbsp;</th>
	
</tr>
<tr>
	<th colspan="14" style="text-align:right">TOTAL NET INCOME: </th>
	<th colspan="3" style="text-align:right">{{number_format($netIncome,2)}}</th>
</tr>
<tr>
	<th colspan="14" style="text-align:right">TOTAL CASH RECEIVED: </th>
	<th colspan="3" style="text-align:right">{{number_format($downpaymentsOverallTotal,2)}}</th>
</tr>
<tr>
	<th colspan="14" style="text-align:right">ACCOUNT RECEIVABLES: </th>
	<th colspan="3" style="text-align:right">{{number_format($netIncome-$downpaymentsOverallTotal,2)}}</th>
</tr>
</table>
<h5>*Other discount such as Employee, Government and other discounts is not included </h5>


<h2>Ammended Rooms Attached w/ Charge</h2>
<table width="100%" border="1">
<tr>
	<th>Code</th>
	<th>Room No.</th>
	<th>Arrival & Depature</th>
	<th>Day/s</th>
	<th>Room Rate</th>
	<th>Total</th>
	<th>Remarks</th>
</tr>


@foreach($ammendRoomsClose as $tt)
<tr>
	<td>{{$tt->code}}</td>

	<td>{{$tt->roomName}}</td>
	<td>{{$tt->reservationPeriod}}</td>
	<td>{{$tt->days}}</td>
	<td>{{number_format($tt->roomRate,2)}}</td>
	<td>{{number_format($tt->totalAmmendRoom,2)}}</td>
	<td>{{$tt->notes}}</td>
	
	
</tr>
@endforeach
</table>