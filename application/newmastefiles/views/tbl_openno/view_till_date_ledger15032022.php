<?php //echo '<pre>'; print_r($tdledger); echo '</pre>'; //die;?>


<style>
table {border: 1px solid #000000;border-collapse: collapse; margin: 0 auto;  padding: 0px;table-layout: fixed;min-width: 100%;}
tr.noBorder td {
  border: 0;
}
table th {text-align: center;padding: 8px;border: 1px solid #000000;background:#1b90bb;color:#FFFFFF;font-weight:bold;text-align:center}table td{padding: 8px;border: 1px solid #000000;}table tr{background-color: #dddddd;color:#000000;text-align:center;}table .mobile-head {display:none;}table .show-on-mobile {display:none;}@media screen and (max-width: 600px) {table {border: 1px solid #000000;border-collapse: collapse; margin: 0 auto;  padding: 0px;table-layout: fixed;min-width: 100%;}table td{padding: 8px;border: 1px solid #000000;display: block;text-align: right;width: 100%\9;  float: left\9;}table tr{background-color: #dddddd;color:#000000;text-align:right;margin:8px}table tr:first-child {display:none;}table tr{display: block;}table td:not(:first-child){border-top:0px;}table .mobile-head{font-weight:bold;color:#000000;float:left;text-align:left;display:block}table .show-on-mobile {display:block;}}
</style>
<?php if(isset($tdledger)&& !empty($tdledger)){?>
<table>
<tr class="noBorder">
	<th colspan='2' >PartyName</th>
	<th colspan='3' ><?=$tdledger[0]['ledger_name']?></th>
</tr>
<tr>
	<th colspan='2' >Detail Of Date</th>
	<th colspan='3' ><?=date('d-m-Y',strtotime($tdledger[0]['Date']))?></th>
</tr>
<tr>
	<th><span class='mobile-head'>Head1</span>Khaber</th>
	<th><span class='mobile-head'>Head1</span>Game</th>
	<th><span class='mobile-head'>Head3</span>Total</th>
	<th><span class='mobile-head'>Head3</span>D-Amount</th>
	<th><span class='mobile-head'>Head3</span>A-Amount</th>
</tr>
<?php 
$tamount=0;
$ta=0;
$tb=0;
$pattiamnt = 0;
foreach($tdledger as $key => $val){
	
	?><tr>
		<td><span class='mobile-head'>Head1</span><?=$val['number']?></td>
	<td><span class='mobile-head'>Head1</span><?=$val['shift_name']?></td>
	<td><span class='mobile-head'>Head3</span><?=$val['Total_amount']?></td>
	<td><span class='mobile-head'>Head3</span><?=$val['oamnt']?></td>
	<td><span class='mobile-head'>Head3</span><?=$val['akmnt']?></td>
		</tr><?php
$tamount = $tamount+ $val['Total_amount'];
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
<?php 
$commission = ceil($tamount*($val['Commision']/100));
$opening = $ob;
$damount = ceil($ta*$val['DaraRate']);
$aamount = ceil($tb*$val['AkarRate']);
$pattiamnt = (($tamount-($commission+$aamount+$damount))*$val['pattiperc'])/100;
//echo $val['Hissa_Amount'].'';
//echo ($tamount-($commission+$aamount+$damount))*$val['pattiperc']; die;
//echo $pattiamnt;
?>
<tr class="noBorder" style="border-top: 1px solid #000">
<td>Commission</td>
<td colspan="2"><?=$commission?></td>
<td>Opening</td>
<td><?=$opening?></td>
 </tr>
 <tr class="noBorder">
<td>D-Amount</td>
<td colspan="2"><?=$damount?></td>
<td>Total Today</td>
<td><?=$tamount-($commission+$aamount+$damount+$pattiamnt)?></td>
</tr>
<tr class="noBorder">
<td>A-Amount</td>
<td colspan="2"><?=$aamount?></td>
<td>Payment Kisht</td>
<td></td>
</tr>
<tr class="noBorder" style="border-top: 1px solid #000">
<td>Total</td>
<td colspan="2"><?=$commission+$aamount+$damount?></td>
<td>Closing</td>
<td><?=-($opening-($tamount-($commission+$aamount+$damount+$pattiamnt)))?></td>
</tr>
<tr class="noBorder">
<td>Patti AMT.</td>
<td colspan="2"><?=$pattiamnt?></td>
<td></td>
<td></td>
</tr>
<tr class="noBorder" style="border-top: 1px solid #000">
<td>Final Total</td>
<td colspan="2"><?=($tamount-($commission+$aamount+$damount))-$pattiamnt?></td>
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
