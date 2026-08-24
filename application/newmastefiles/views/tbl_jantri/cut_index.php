    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(function() {

    $('.med').on('change', function() {

        var colIndex = $(this).parent().prevAll().length;
        var rowIndex = $(this).closest('tr').prevAll().length;

        var columns = $(this).closest('tr').children('td');
        var colMax = columns.length - 1;
        var rowTotal = 0;

        for (var col = 0; col < colMax; col++) {
            var colData = columns.eq(col).find('input').val();
            if (colData === undefined) {
                rowTotal += 0;
            } else {
                rowTotal += (1 * colData);
            }
        }


        var rows = $(this).closest('tbody').children('tr');
        var rowMax = rows.length - 1;
        var colTotal = 0;

        for (var row = 0; row < rowMax; row++) {
            var rowData = rows.eq(row).children('td').eq(colIndex).find('input').val();
            if (rowData === undefined) {
                colTotal += 0;
            } else {
                colTotal += (1 * rowData);
            }
        }
        $('input[name=total_p' + rowIndex + ']').val(rowTotal);
        $('input[name=total_h' + (colIndex) + ']').val(colTotal);

        var totalHead = 0;
        var totalP = 0;
        $('input[name^=total_h]').each(function() {
            var data = isNaN($(this).val()) ? 0 : ($(this).val() * 1);
            totalHead += data;
        });

        $('input[name^=total_p]').each(function() {
            var data = isNaN($(this).val()) ? 0 : ($(this).val() * 1);
            totalP += data;
        });

        var totalall = totalHead + totalP;
        $('input[name=total_all]').val(totalHead);
        console.log('total heading = ' + totalHead);
        console.log('total P = ' + totalP);
        console.log('total all = ' + totalall);
    });
});

function submitjantri() {
    let params = (new URL(document.location)).searchParams;
    let shift = params.get("shift");
    let tdate = params.get("tdate");
    let party = params.get("party");
    let tamnt = document.getElementById('gtotal').innerHTML;
    var arrr = {};
    var inputs = document.getElementsByTagName('input');
    for (var i = 0; i < inputs.length; i += 1) {
        //inputs[i].value = '';
        if (((inputs[i].value) != "") && ((inputs[i].value) != "0")) {
            dindex = inputs[i].getAttribute('name');
            elemval = inputs[i].value;
            arrr[dindex] = elemval;

        }
    }
    //console.log(JSON.stringify(arrr)); return;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {

            console.log("Jantri Recorded!!")
        }
    };
    xhttp.open("POST", "add_jantri", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("dindex=" + JSON.stringify(arrr) + "&shift=" + shift + "&party=" + party + "&tdate=" + tdate +
        "&tamnt=" + parseInt(tamnt));
}

function calccutting(valbtn) {
    valbtn.disabled = true;
    var aamnt = '';
    var aperc = '';
    var damnt = '';
    var dperc = '';
    var tamnt = 0;
    aamnt = document.getElementById('aamnt').value;
    aperc = document.getElementById('aperc').value;
    damnt = document.getElementById('damnt').value;
    dperc = document.getElementById('dperc').value;


    if (aamnt) {
        //alert(aamnt);
        $(".med").each(function() {
            var val = $(this).val();
            var famnt = val - aamnt;
            //alert(famnt)
            if (famnt > 24) {
                famnt = Math.round(famnt / 50) * 50;
                //alert(famnt)
                $(this).val(famnt);
            } else if (famnt > 0) {
                famnt = 25;
                $(this).val(famnt);
            }
           // tamnt = tamnt + parseInt($(this).val());
        });
    }
    if (damnt) {
        $(".med").each(function() {
            var val = $(this).val();
            var famnt = val - damnt;
            if (famnt > 24) {
                famnt = Math.round(famnt / 50) * 50;
                $(this).val(famnt);
            } else if (famnt > 0) {
                famnt = 25;
                $(this).val(famnt);
            }
          //  tamnt = tamnt + parseInt($(this).val());
        });
    }
    if (aperc) {
        $(".med").each(function() {
            var val = $(this).val();
            var famnt = val - (val * (aperc / 100));
            if (famnt > 24) {
                famnt = Math.round(famnt / 50) * 50;
                $(this).val(famnt);
            } else if (famnt) {
                famnt = 25;
                $(this).val(famnt);
            }
         //   tamnt = tamnt + parseInt($(this).val());

        });

    }
    if (dperc) {
        $(".med").each(function() {
            var val = $(this).val();
            var famnt = val - (val * (dperc / 100));
            if (famnt > 24) {
                famnt = Math.round(famnt / 50) * 50;
                $(this).val(famnt);
            } else if (famnt) {
                famnt = 25;
                $(this).val(famnt);
            }
           // alert($(this).val())
           
          //  tamnt = tamnt + parseInt($(this).val());
            
        });
       // alert(tamnt)
    }
    $(".med").each(function() {
            var val = $(this).val();
           
           // alert($(this).val())
           
            tamnt = tamnt + parseInt($(this).val());
            
        });
    //alert(tamnt)
    document.getElementById('tamnt').value = tamnt;
}
</script>
<style>
.ftotal {
    width: 72%;
}

table {
    table-layout: fixed;
    width: 100%;
}

th,
td {
    border-style: solid;
    border-width: 5px;
    border-color: #BCBCBC;
    word-wrap: break-word;
}

button,
input {
    overflow: visible;
    width: 100%;
}

.thead td {
    color: #fff
}

/* DivTable.com */
.divTable {
    display: table;
    width: 100%;
}

.divTableRow {
    display: table-row;
}

.divTableHeading {
    background-color: #EEE;
    display: table-header-group;
}

.divTableCell,
.divTableHead {
    border: 1px solid #999999;
    display: table-cell;
    padding: 3px 10px;
}

.divTableHeading {
    background-color: #EEE;
    display: table-header-group;
    font-weight: bold;
}

.divTableFoot {
    background-color: #EEE;
    display: table-footer-group;
    font-weight: bold;
}

.divTableBody {
    display: table-row-group;
}

#loadingmsg {
    color: black;
    background: #fff;
    padding: 10px;
    position: fixed;
    top: 50%;
    left: 50%;
    z-index: 100;
    margin-right: -25%;
    margin-bottom: -25%;
}

#loadingover {
    background: black;
    z-index: 99;
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    left: 0;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
    filter: alpha(opacity=80);
    -moz-opacity: 0.8;
    -khtml-opacity: 0.8;
    opacity: 0.8;
}
</style>
<div id='loadingmsg' style='display: none;'>Saving, please wait...</div>
<div id='loadingover' style='display: none;'></div>
<table class="table table-bordered table-hover">
    <thead>

        <div class="x_panel">
            <div class="x_title">
                <h2 style="text-decoration:underline;"><b>Jantri Filters</b></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li>
                        <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <form name="custom" action="" method="GET">
                    <div class="nav navbar-right panel_toolbox">
                        <div class="form-group pull-right top_search">
                            <div class="input-group">
                                <h2 style="margin-right:10px;"><b>Date</b></h2>
                                <input name="date" class="birthday form-control" type="text" autocomplete="off"
                                    required="">
                                <div class="alert" style="display:none">Please Select Shift First</div>
                                <input type="submit" name="submit" value="Submit" autocomplete="off" onclick=""
                                    style="width: 20%;margin-left: 20px;">
                            </div>
                        </div>
                    </div>
                    <div class="nav navbar-left panel_toolbox">
                        <h2 style="margin-right:10px;"><b>Shift</b></h2>
                        <!-- Split button -->
                        <div class="btn-group" style="height: 36px; margin-right: 10px;">
                            <select name="pid" id="shift" class="form-control" required>
                                <option value="">Choose option</option>
                                <?php foreach($shifts as $key => $val){
                           ?>
                                <option value="<?=$val['id']?>"><?=$val['shift_name']?></option>
                                <?php	
                           } ?>
                            </select>
                            <div class="alert" style="display:none">Please Select Shift First</div>
                        </div>
                    </div>
                </form>

                <div class="clearfix"></div>

            </div>
        </div>
    </thead>
    <tbody>
        <tr>
            <td>A-Percentage</td>
            <td><input id="aperc" type="text" name="perc"></td>

            <td>Total Amount</td>
            <td>A-Amount</td>
            <td><input id="aamnt" type="text" name="amt" value=""></td>
            <td></td>
        </tr>
        <tr>
            <td>D-Percentage</td>
            <td><input id="dperc" type="text" name="perc"></td>
            <td><input id="tamnt" name="total_amount" value="<?=(isset($tbl_transactions[0]['ttamnt'])?$tbl_transactions[0]['ttamnt']:'')?>" readonly></td>

            <td>D-Amount</td>
            <td><input id="damnt" type="text" name="amt"></td>
            <td><input type="button" class="form-success" id="calcbtn" onclick="calccutting(this)" name="Submit"
                    value="Submit"></td>
        </tr>
    </tbody>
</table>
<form>
    <?php 
function combinations($arrays, $i = 0) {
    if (!isset($arrays[$i])) {
        return array();
    }
    if ($i == count($arrays) - 1) {
        return $arrays[$i];
    }

    // get combinations from subsequent arrays
    $tmp = combinations($arrays, $i + 1);

    $result = array();

    // concat each array from tmp with each element from $arrays[$i]
    foreach ($arrays[$i] as $v) {
        foreach ($tmp as $t) {
            $result[] = implode('',is_array($t) ? 
                array_merge(array($v), $t) :
                array($v, $t));
        }
    }
//print_r($result); die;
   // $resultstr =  implode(',',$result);
	return $result;
}
//echo '<pre>'; print_r($tbl_transactions); echo '</pre>'; //die;
$tnumber=$taknumber=array();
$akandar = $akbahar=array();
$tamount= $takamount =array();
foreach($tbl_transactions as $k => $val){
	$tnumber[$k] = $tamount[$k] = [];
if(isset($val['trnno'])){
	//echo '<pre>'; print_r(var_dump($val['dcomm'])); echo '</pre>'; die;
	
$trno = explode(',',rtrim($val['trnno'],','));
//echo '<pre>'; print_r($trno); echo '</pre>'; die;
$trn_amount = explode(',',rtrim($val['trn_amt'],','));
if(isset($trno) && (!empty($trno))){
for($i=0;$i<count($trno);$i++){
if($trno[$i]!=''){
    array_push($tnumber[$k],$trno[$i]);
    array_push($tamount[$k],$trn_amount[$i]);
}
}
}
}
//echo '<pre>'; print_r($tnumber); echo '</pre>';
//echo '<pre>'; print_r($tamount); echo '</pre>'; die;

 //die;
if(isset($val['number'])&& (!empty($val['number']))){
$trnumber = explode(',',rtrim($val['number'],','));
 $tramount = $val['amount'];
if(!empty($trnumber)){
for($i=0;$i<count($trnumber);$i++){
//$tnumber[$i]= $trnumber[$i];
//$tamount[$i]= $tramount; 
//echo '<pre>'; print_r($tnumber[$k]); echo '</pre>'; //die;	
array_push($tnumber[$k],$trnumber[$i]);
array_push($tamount[$k],$tramount);
}
}
}


if(isset($val['ander'])&& $val['ander']!=0){
$cross = combinations(
   array( str_split($val['ander']),
    str_split($val['bahar']))
);
//echo '<pre>'; print_r($cross); echo '</pre>';
if(!empty($cross)){
for($i=0;$i<count($cross);$i++){
//$tnumber[$i]= $trnumber[$i];
//$tamount[$i]= $tramount;
//$keyval =$k+$i;
//echo  	$keyval;
array_push($tnumber[$k],$cross[$i]);
array_push($tamount[$k],$val['trncrs_amt']);
}
}
}

if(isset($val['fromto_from'])&&$val['fromto_from']!=0){
for($i=$val['fromto_from'];$i<=$val['fromto_to'];$i++){
//$tnumber[$i]= $trnumber[$i];
//$tamount[$i]= $tramount; 	
array_push($tnumber[$k],$i);
array_push($tamount[$k],$val['fromto_amount']);
}
}


if(isset($val['dara_f8'])&&$val['dara_f8']!=''&&$val['dara_f8']!='0'){
	$daraf8 = explode(" ",$val['dara_f8']);
for($i=0;$i<count($daraf8);$i++){
//$tnumber[$i]= $trnumber[$i];
//$tamount[$i]= $tramount; 	
array_push($tnumber[$k],$daraf8[$i]);
array_push($tamount[$k],$val['dara_amount_f8']);
}
}//die;
//echo $val['trn_amt'].'ttpt ';
$taknumber[$k] = $takamount[$k] =[];
	//print_r($taknumber[$k]); die;
if(isset($val['amount_akahr_andar_f8'])&&$val['amount_akahr_andar_f8']!=''){
	$akandar = str_split($val['akahr_andar_f8']);
	$akbahar = str_split($val['akhar_bahar_f8']);
	$akamount = $val['amount_akahr_andar_f8'];
	$bhamaount = $val['amount_akahr_bahar_f8'];
	//echo '<pre>';print_r($akandar); print_r($akbahar); die;
	for($i=0;$i<count($akandar);$i++){
		$and = $akandar[$i].$akandar[$i].$akandar[$i].$akandar[$i];
		array_push($taknumber[$k],$and);
array_push($takamount[$k],$akamount);
	}
	for($i=0;$i<count($akbahar);$i++){
		$and = $akbahar[$i].$akbahar[$i].$akbahar[$i];
		array_push($taknumber[$k],$and);
array_push($takamount[$k],$bhamaount);
	}
}
 //die;
//if($k == 0){
	
	//echo $val['dcomm'].'  fft '.$val['dcomm'];
	//echo var_dump($val['dcomm']); //die;
	if($val['dcomm']){
		

    if (!is_array($tnumber[$k]))
    {
		$tamount[$k] = $tamount[$k]-(($val['dcomm']*$tamount[$k])/100);
	
    }
    else
    {
       //echo $key ." => array( \r\n";
		//echo '<pre>'; print_r($tnumber[$k]); echo '</pre>';
       foreach ($tnumber[$k] as $key4 => $value2)
       { 
         $tamount[$k][$key4] = ((int)$tamount[$k][$key4]-(((int)$val['dcomm']*(int)$tamount[$k][$key4])/100));
		// echo $tamount[$key3][$key4].' ttr ';
       }

       //echo ")";
    }

		
		
		/*
		//echo '<pre>'; print_r($tamount); echo '</pre>';
	foreach($tamount as $keyy => $vall){
		$tamount[$keyy] = ($tamount[$keyy]-(($val['dcomm']*$tamount[$keyy])/100));
	}*/
	//$tamount[$k] = ($tamount[$k]-$val['dcomm']);
	}
	if($val['dhissa']){
		//echo $key.' ttkey ';
		
	
    if (!is_array($tnumber[$k]))
    {
		$tamount[$k] = ($tamount[$k]-(($val['dhissa']*$tamount[$k])/100));
	
    }
    else
    {
       //echo $key ." => array( \r\n";
		
       foreach ($tnumber[$k] as $key4 => $value2)
       {
         $tamount[$k][$key4] = $tamount[$k][$key4]-(($val['dhissa']*$tamount[$k][$key4])/100);
		 
       }

       //echo ")";
    }

		
		
		
		/*foreach($tamount as $keyy => $vall){
		$tamount[$keyy] = ($tamount[$keyy]-$val['dhissa']);
	}*/
		//$tamount[$k] = ($tamount[$k]-($tamount[$k]*($val['dhissa']/100)));
	}
//echo '<pre>'; print_r($tnumber); echo '</pre>';
//echo '<pre>'; print_r($tamount); echo '</pre>';	
//}
}

//echo '<pre>'; print_r($taknumber); echo '</pre>';
//echo '<pre>'; print_r($takamount); echo '</pre>';
?>
    <table class="table table-bordered table-hover">
        <thead>
            <tr class="thead" style="background:#0B6FA4; ">
                <td>Sr. No.</td>
                <td>1</td>
                <td>2</td>
                <td>3</td>
                <td>4</td>
                <td>5</td>
                <td>6</td>
                <td>7</td>
                <td>8</td>
                <td>9</td>
                <td>10</td>
                <!--<td>Total</td>-->
            </tr>
        </thead>
        <tbody>
            <?php 
	$ftamnt = '';
	for($i=0;$i<10;$i++){ ?>
            <tr>
                <td><?=$i+1?></td>
                <?php for($j=0;$j<10;$j++){ 
	$data = (($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1));
	////echo '<pre>';echo $data.' tt '; print_r($tnumber); die;
	//$key = array_search($data,$tnumber);
	//echo $key; //die;
	if($data == '100'){
		$data = '00';
	}
	$ftamnt = "0";
	foreach($tnumber as $key => $value)
{
    if (!is_array($value))
    {
		if($value == $data){
			//$fkey = $key;
		$ftamnt = $ftamnt + $tamount[$key];
		}
        //echo $key ." => ". $value ."\r\n" ;
		
    }
    else
    {
       //echo $key ." => array( \r\n";

       foreach ($value as $key2 => $value2)
       {
         if($value2 == $data){
			//$fkey = $key2;
			$ftamnt = $ftamnt + $tamount[$key][$key2];
		}
       }

       //echo ")";
    }
}
//echo $ftamnt;
	?>


                <td>
                    <input type="text" value="<?=ceil($ftamnt)?>"
                        name="sr_<?=(($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1))?>" id="<?=$i.$j?>"
                        tabindex="<?=(($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1))?>" placeholder="<?=$data?>" class="med">
                </td>



                <?php }?>
                <!--<td>
                  <input type="text" tabindex="total_p<?=$i?>" name="total_p<?=$i?>" value="0" readonly>
 
            </td>-->
            </tr>
            <?php }?>
            <!--<tr>
		 <td>Total</td>
		<?php for($x=0;$x<10;$x++){ ?>
           
            <td>
                <input type="text" name="total_h<?=$x?>" value="0" readonly>
            </td>
           
		<?php }?>
        

            <td>
                <input type="text" name="total_all" value="0" placeholder="All Total">
            </td>
		</tr>-->


        </tbody>
    </table>
    <?php //var_dump($tnumber); die; ?>
    <table class="table table-bordered table-hover">
        <tbody>
            <tr>
                <td>B</td>
                <?php for($ii=1;$ii<11;$ii++){ ?>
                <td><input type="text" name="b[<?=$ii?>]" value="<?=(in_array($ii,$akbahar))?$bhamaount:''?>"
                        onkeyup="findbTotal()" id="<?=$ii?>" placeholder="b<?=$ii?>" class="meddb"></td>
                <?php }?>
                <!--<td><input type="text" id="total_b" name="total_b" value="0"></td>-->
            </tr>
            <tr>
                <td>A</td>
                <?php for($ii=1;$ii<11;$ii++){ ?>
                <td><input type="text" name="a[<?=$ii?>]" value="<?=(in_array($ii,$akandar))?$akamount:''?>"
                        onkeyup="findaTotal()" id="<?=$ii?>" placeholder="a<?=$ii?>" class="medda"></td>
                <?php }?>
                <!--<td>
<input type="text" id="total_a" name="total_a" value="0"></td>-->
            </tr>
            <!--<tr>
<td colspan="10">Grand Total : <span id="gtotal"></span>&nbsp;</td>
<td colspan="2"><button type="button" onclick="submitjantri()" class="btn btn-success" style="padding: .375rem 2.75rem;">Submit</button></td>
</tr>-->
        </tbody>
    </table>
</form>
<!-- DivTable.com -->
<!-- DivTable.com 
<script>
var arr = [];
document.addEventListener('click', function(e) {
    e = e || window.event;
    var target = e.target || e.srcElement,
        text = target.textContent || target.innerText;   
		//console.log(target.previousElementSibling);
		//var elem = target.nextElementSibling;
		console.log(target.type);
		
			//console.log(elem.value);
			
var inputs = document.getElementsByTagName('input');
for (var i = 0; i < inputs.length; i += 1) {
    //inputs[i].value = '';
	if(((inputs[i].value)!="") && ((inputs[i].value)!="0")){
	dindex = inputs[i].getAttribute('name');
			 elemval = inputs[i].value;
			arr[dindex] = elemval;
	}
}
console.log(arr); return;
			var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		
     console.log("Entry Recorded!!")
    }
  };
  xhttp.open("POST", "add_jantri", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("dindex="+JSON.stringify(arr));		
}, false); </script>-->