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
<h1>Period Sales Report</h1>
<h3>Period: {{$fromDate}} - {{$toDate}}</h3>
*T.R.A.C = Total Room Amend Charge
<table width="100%" border="1">
<tr>
	<th colspan="14"></th>
	<th colspan="3">Discounts (PWD & Senior)</th>
	<th colspan="3"></th>
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
	<th>FNB</th>
	<th>Room Service</th>
	<th>Minibar</th>
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

@foreach($sales as $t)
<tr>
	<td>{{$t->roomName}}</td>
	<td>{{$t->code}}</td>
	<td>{{$t->reservationPeriod}}</td>
	<td>{{$t->days}}</td>	
	<td>{{number_format($t->roomRate,2)}}</td>
	<td>{{number_format($t->ammendCharge,2)}}</td>

	<td>{{number_format($t->fnb,2)}}</td>
	<td>{{number_format($t->roomService,2)}}</td>
	<td>{{number_format($t->miniBar,2)}}</td>
	<td>{{number_format($t->totalBill,2)}}</td>

	<td>{{number_format($t->totalBill - ($t->totalBill/1.12),2)}}</td>
	<td>{{number_format($t->serviceCharge,2)}}</td>
	<td>{{number_format($t->shuttleService,2)}}</td>
	<td>{{number_format(($t->totalBill + $t->shuttleService),2)}}</td>

	<td>{{number_format($t->fnbDiscount,2)}}</td>
	<td>{{number_format($t->roomServiceDiscount,2)}}</td>
	<td>{{number_format($t->miniBarDiscount,2)}}</td>

		
	<th>{{number_format(($t->totalBill + $t->shuttleService) - $t->totalChargeDiscount,2)}}</th>
	<th>{{number_format($t->downpaymentsTotal,2)}}</th>

	<th>{{number_format(((($t->totalBill + $t->shuttleService) - $t->totalChargeDiscount)-$t->downpaymentsTotal),2)}}</th>


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

	$netIncome += (($t->totalBill + $t->shuttleService) - $t->totalChargeDiscount);

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
	<th>{{number_format($fnbTotalDiscount,2)}}</th>
	<th>{{number_format($roomServiceTotalDiscount,2)}}</th>
	<th>{{number_format($miniBarTotalDiscount,2)}}</th>
	<th>{{number_format($netIncome,2)}}</th>
	<th>{{number_format($downpaymentsOverallTotal,2)}}</th>
	<th>{{number_format($netIncome-$downpaymentsOverallTotal,2)}}</th>

	

</tr>
<tr>
	<th colspan="20" style="text-align:right">&nbsp;</th>
	
</tr>
<tr>
	<th colspan="17" style="text-align:right">TOTAL NET INCOME: </th>
	<th colspan="3" style="text-align:right">{{number_format($netIncome,2)}}</th>
</tr>
<tr>
	<th colspan="17" style="text-align:right">TOTAL CASH RECEIVED: </th>
	<th colspan="3" style="text-align:right">{{number_format($downpaymentsOverallTotal,2)}}</th>
</tr>
<tr>
	<th colspan="17" style="text-align:right">ACCOUNT RECEIVABLES: </th>
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


@foreach($ammendRoomsClose as $t)
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