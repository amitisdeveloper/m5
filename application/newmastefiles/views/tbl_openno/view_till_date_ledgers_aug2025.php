<?php //echo '<pre>'; print_r($tdledger); echo '</pre>'; //die; 

if((isset($kist)&& (!empty($kist)))){

$date1 = new DateTime(date('Y-m-d',strtotime($kist[0]['frdate'])));

$date2 = new DateTime(date('Y-m-d',strtotime($tdledger['today'][0]['Date'])));

$interval = $date1->diff($date2);

//echo "difference " . $interval->y . " years, " . $interval->m." months, ".$interval->d." days "; 



// shows the total amount of days (not divided into years, months and days like above)

//echo "difference " . $interval->days . " days ";

if($interval->days) {

//$kamnt = ($interval->days)*($kist[0]['kist']);

$kamnt = 1*($kist[0]['kist']);

}

else{

$kamnt = 0;	

}

}

else{

$kamnt = 0;	

}

//echo $kamnt;

?>





<style>

table {border: 1px solid #000000;border-collapse: collapse; margin: 0 auto;  padding: 0px;table-layout: fixed;min-width: 100%;}

tr.noBorder td {

  border: 0;

}

table th {text-align: center;padding: 8px;border: 1px solid #000000;background:#1b90bb;color:#FFFFFF;font-weight:bold;text-align:center}table td{padding: 8px;border: 1px solid #000000;}table tr{background-color: #dddddd;color:#000000;text-align:center;}table .mobile-head {display:none;}table .show-on-mobile {display:none;}@media screen and (max-width: 600px) {table {border: 1px solid #000000;border-collapse: collapse; margin: 0 auto;  padding: 0px;table-layout: fixed;min-width: 100%;}table td{padding: 8px;border: 1px solid #000000;display: block;text-align: right;width: 100%\9;  float: left\9;}table tr{background-color: #dddddd;color:#000000;text-align:right;margin:8px}table tr:first-child {display:none;}table tr{display: block;}table td:not(:first-child){border-top:0px;}table .mobile-head{font-weight:bold;color:#000000;float:left;text-align:left;display:block}table .show-on-mobile {display:block;}}

</style>

<?php if(isset($tdledger['today'])&& !empty($tdledger['today'])){?>

<table>

<tr class="noBorder">

	<th colspan='2' >PartyName</th>

	<th colspan='3' ><?=$tdledger['today'][0]['ledger_name']?></th>

</tr>

<tr>

	<th colspan='2' >Detail Of Date</th>

	<th colspan='3' ><?=date('d-m-Y',strtotime($tdledger['today'][0]['Date']))?></th>

</tr>

<tr>

	<th><span class='mobile-head'>Head1</span>Khaber</th>

	<th><span class='mobile-head'>Head1</span>Game</th>

	<th><span class='mobile-head'>Head3</span>Total</th>

	<th><span class='mobile-head'>Head3</span>D-Amount</th>

	<th><span class='mobile-head'>Head3</span>A-Amount</th>

</tr>

<?php 

$tamount=$btamount=0;

$ta=$bta=0;

$tb=$btb=0;

$pattiamnt =$bpattiamnt = 0;

 $nbopening =$bopening = 0;

//echo '<pre>'; print_r($opening); echo '</pre>'; die;

if(!empty($tdledger['today'][0]['openingbalance'])){

	$bopening = $tdledger['today'][0]['openingbalance'];

}

$nbopening = $opening;

/*if(!empty($tdledger['before'][0]['openingbalance'])){

	$bopening = $tdledger['before'][0]['openingbalance'];

}

else{

	$bopening = $tdledger['today'][0]['openingbalance']; 

}*/

//echo $bopening.' ttp ';



/*foreach($tdledger['before'] as $key => $vall){

	$btamount = $btamount+ $vall['finalsum'];

	$bta = $bta + $vall['oamnt'];

	$btb = $btb + $vall['akmnt'];

	$bcommission = ceil($btamount*($vall['ledgerdara_commision']/100));



$bdamount = ceil($bta*$vall['ledgerdara_rate']);

$baamount = ceil($btb*$vall['ledgerakhar_rate']);

if($vall['hissa_select']=='y'){

	$bpattiamnt = (($btamount-($bcommission+$baamount+$bdamount))*$vall['pattiperc'])/100;

	}

	else{

	$bpattiamnt = 0 ;	 

	}

	//echo 'Date '.$vall['Date'].' btamount '.$btamount.' bcommission '.$bcommission.' baamount '.$baamount.' bdamount '.$bdamount.' bpattiamnt '.$bpattiamnt.'<br>';

	//die;

	$nbopening = ($btamount-($bcommission+$baamount+$bdamount+$bpattiamnt));

//echo $vall['Date'].'Date '.$nbopening.' nopening '; echo $bopening.' bopening ';echo $backvoucher.' backvoucher <br>'; 

}*/

//if($_POST['ledger_id']=='9'){

	//	echo $nbopening.' nopening '; echo $bopening.' bopening ';echo $backvoucher.' backvoucher ';

		//}

//echo $nbopening.' nopening '; echo $bopening.' bopening ';echo $backvoucher.' backvoucher ';   //die;



//$backvoucher

//echo '<pre>'; print_r($tdledger); echo '</pre>'; die;

 //$bopening = $nbopening+$bopening+$backvoucher; //die;

 $first_day_this_month = date('Y-m-01');

 $today = date('Y-m-d',strtotime($tdledger['today'][0]['Date']));

if($today == $first_day_this_month){

	$bopening = $bopening;

}

else{

$bopening = $nbopening+$bopening;	

}



foreach($tdledger['today'] as $key => $val){ //echo $ta.' ';
	
	if($val['finalsum']!='0'){//echo $val['oamnt'].' ';

	?><tr>

		<td><span class='mobile-head'>Head1</span><?=($val['number'])?$val['number']:'No Result'?></td>

	<td><span class='mobile-head'>Head1</span><?=$val['shift_name']?></td>

	<td><span class='mobile-head'>Head3</span><?=$val['finalsum']?></td>

	<td><span class='mobile-head'>Head3</span><?=$val['oamnt']?></td>

	<td><span class='mobile-head'>Head3</span><?=$val['akmnt']?></td>

		</tr><?php

	}
if($val['status'] != 0){
$tamount = $tamount+ $val['finalsum'];
}


$ta = $ta + $val['oamnt'];

$tb = $tb + $val['akmnt'];



//$pattiamnt = $pattiamnt+$val['Hissa_Amount'];

}

?>

<tr class="noBorder">

<td></td>

<td></td>

<td><?=$tamount?></td>

<td><?=$ta?></td>

<td><?=$tb?></td>

</tr>

<?php //echo '<pre>'; print_r($val); echo '</pre>'; //die;

$commission = ceil($tamount*($val['ledgerdara_commision']/100));

//$opening = $val['openingbalance'];

$damount = ceil($ta*$val['ledgerdara_rate']);

$aamount = ceil($tb*$val['ledgerakhar_rate']);

if($val['hissa_select']=='y'){

$pattiamnt = (($tamount-($commission+$aamount+$damount))*$val['pattiperc'])/100;

}

else{

$pattiamnt = 0 ;	

}

//echo $val['Hissa_Amount'].'';

//echo ($tamount-($commission+$aamount+$damount))*$val['pattiperc']; die;

//echo $pattiamnt;

$bopening = $opening;

?>

<tr class="noBorder" style="border-top: 1px solid #000">

<td>Commission</td>

<td colspan="2"><?=$commission?></td>

<td>Balance</td>

<td><?=$opening?></td>

 </tr>

 <tr class="noBorder">

<td>D-Amount</td>

<td colspan="2"><?=$damount?></td>

<td>Total Today</td>

<!--<td><?=$tamount-($commission+$aamount+$damount+$pattiamnt).' '.$tamount.'tamount '.$commission.'comm '.$aamount.'akharmount '.$damount.'dharaamnt '.$pattiamnt.'pattiamnt'?></td>-->

<td><?=$today_hisab?></td>

</tr>

<tr class="noBorder">

<td>A-Amount</td>

<td colspan="2"><?=$aamount?></td>

<td> Payment</td>

<td colspan="2"><?=$ob?></td>



</tr>

<tr class="noBorder" style="border-top: 1px solid #000">

<td>Total</td>

<td colspan="2"><?=$commission+$aamount+$damount?></td>

<td></td>

<td></td>

</tr>

<tr class="noBorder">

<td>Patti AMT.</td>

<td colspan="2"><?=$pattiamnt?></td>

<?php //echo 'ob '.$ob.' bopeing '.$bopening.'<br> tamount '.$tamount.' commission '.$commission.' aamount '.$aamount.' damount '.$damount.' pattiamnt '.$pattiamnt;

	//die; 

	

	$finalt = ($bopening)?($bopening+($tamount-($commission+$aamount+$damount+$pattiamnt))):($tamount-($commission+$aamount+$damount+$pattiamnt));

	?>

<td>Closing</td>



<td><?=$final_hisab ?></td>

</tr>

<tr class="noBorder">

<td> Kisht</td>

<td colspan="2"><?=$kamnt?></td>

<td></td>

<td></td>

</tr>

<tr class="noBorder" style="border-top: 1px solid #000">

<td>Final Total</td>

<?php /*if($kamnt!=0){

?>

<td colspan="2"><?=(($tamount-$kist[0]['totalamt']+$kamnt)-($commission+$aamount+$damount))-$pattiamnt?></td>

<?php	

} 

else{ */

	?>

<td colspan="2"><?=$today_hisab?></td>

	<?php

//}?>

</tr>

</table>

<?php }

else{

	?>

<table>

<tr><td>No Results found</td></tr>

</table>	

	<?php

}

?>

