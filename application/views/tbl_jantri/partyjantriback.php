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
                } else if (famnt < 25 && famnt > 0) {
                    famnt = 25;
                    $(this).val(famnt);
                } else {

                    famnt = 0;
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
                } else if (famnt < 25 && famnt > 0) {
                    famnt = 25;
                    $(this).val(famnt);
                } else {

                    famnt = 0;
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
                } else if (famnt < 25 && famnt > 0) {
                    famnt = 25;
                    $(this).val(famnt);
                } else {

                    famnt = 0;
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
                } else if (famnt < 25 && famnt > 0) {
                    famnt = 25;
                    $(this).val(famnt);
                } else {
                    famnt = 0;
                    $(this).val(famnt);
                }
                // alert($(this).val())

                //  tamnt = tamnt + parseInt($(this).val());

            });
            // alert(tamnt)
        }
        var countt = 0;
        $(".med").each(function() {
            var val = $(this).val();

            // alert($(this).val())           
            tamnt = tamnt + parseInt($(this).val());
            countt = countt + 1;
        });
        //alert(tamnt)

        document.getElementById('tamnt').value = tamnt;
        var rowtotal = 0;
        for (i = 1; i < 101; i++) {
            if (i.toString().length == 1) {
                i = '0' + i;
            }
            rowtotal = rowtotal + parseInt(document.getElementsByName("sr_" + i)[0].value);

            if (i % 10 === 0) {
                var frow = (i / 10) - 1;
                //console.log('row_'+(frow));
                document.getElementsByName('row_' + (frow))[0].value = rowtotal;
                rowtotal = 0;
            }
        }

        /* for(i=0;i<10;i++){
        	var rowtotal = 0;
        	for(j=0;j<10;++j){
        		
        		//document.getElementsByName("acc")[0].value
        		//console.log(document.getElementsByName("sr"+i+j)[0].value)
        	
        	if(i+j !='00'){
        	//console.log(document.getElementsByName("sr_"+i+j)[0].value)
        	rowtotal = rowtotal + parseInt(document.getElementsByName("sr_"+i+j)[0].value);
        	console.log('sr_'+i+j);
        	console.log(rowtotal);
        	}
        	else{
        		rowtotal = rowtotal + parseInt(document.getElementsByName("sr_100")[0].value);
        	}
        	}
        	document.getElementsByName("row_"+i)[0].value = rowtotal;
        } */
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

    .x_panel {
        position: relative;
        width: 100%;
        margin-bottom: 0px;
        padding: 0px;
        display: inline-block;
        background: #fff;
        border: 1px solid #E6E9ED;
        -webkit-column-break-inside: avoid;
        -moz-column-break-inside: avoid;
        column-break-inside: avoid;
        opacity: 1;
        -webkit-transition: all .2s ease;
        transition: all .2s ease;
    }

    .input-group {
        margin-bottom: 0px;
    }

    .table td,
    .table th {
        padding: 0;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }
</style>
<div id='loadingmsg' style='display: none;'>Saving, please wait...</div>
<div id='loadingover' style='display: none;'></div>
<?php
/* $tamnt = 0;
foreach($tbl_transactions as $key => $val){
	$tamnt += $val['ttamnt'];
} */
?>

<div class="x_panel">
    <div class="x_title">
        <h2 style="text-decoration:underline;"><b>Party Jantri</b></h2>
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
                        <input name="date" class="birthday form-control" type="text" autocomplete="off" required="">
                        <div class="alert" style="display:none">Please Select Shift First</div>
                        <input type="submit" name="submit" value="Submit" autocomplete="off" onclick="" style="width: 20%;margin-left: 20px;">
                    </div>
                </div>
            </div>
            <div class="nav navbar-left panel_toolbox">
                <h2 style="margin-right:10px;"><b>Party</b></h2>
                <!-- Split button -->
                <div class="btn-group" style="height: 36px; margin-right: 10px;">
                    <select name="partyid" id="party" class="form-control autoseljantri" required>
                        <option value="">Choose option</option>
                        <?php foreach ($party as $key => $val) {
                        ?>
                            <option value="<?= $val['id'] ?>"><?= $val['ledger_name'] ?></option>
                        <?php
                        } ?>
                    </select>
                    <div class="alert" style="display:none">Please Select Shift First</div>
                </div>
            </div>
            <div class="nav navbar-left panel_toolbox">
                <h2 style="margin-right:10px;"><b>Shift</b></h2>
                <!-- Split button -->
                <div class="btn-group" style="height: 36px; margin-right: 10px;">
                    <select name="pid" id="shift" class="form-control" required>
                        <option value="">Choose option</option>
                        <?php foreach ($shifts as $key => $val) {
                        ?>
                            <option value="<?= $val['id'] ?>"><?= $val['shift_name'] ?></option>
                        <?php
                        } ?>
                    </select>
                    <div class="alert" style="display:none">Please Select Shift First</div>
                </div>
            </div>
        </form>

        <div class="clearfix"></div>

    </div>

    <!-- <div class="x_content">
        <table class="table table-bordered table-hover">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <td style="visibility:hidden">A-Percentage</td>
                    <td style="visibility:hidden"><input id="aperc" type="text" name="perc"></td>

                    <td>Total Amount</td>
                    <td style="visibility:hidden">A-Amount</td>
                    <td style="visibility:hidden"><input id="aamnt" type="text" name="amt" value=""></td>
                    <td></td>
                </tr>
                <tr>
                    <td>D-Percentage</td>
                    <td><input id="dperc" type="text" name="perc"></td>
                    <td><input id="tamnt" name="total_amount" value="" readonly></td>

                    <td>D-Amount</td>
                    <td><input id="damnt" type="text" name="amt"></td>
                    <td><input type="button" class="form-success" id="calcbtn" onclick="calccutting(this)" name="Submit" value="Submit"></td>
                </tr>
            </tbody>
        </table>
    </div> -->
</div>
<form>
    <?php
    function combinations($arrays, $i = 0)
    {
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
                $result[] = implode('', is_array($t) ?
                    array_merge(array($v), $t) :
                    array($v, $t));
            }
        }
        //print_r($result); die;
        // $resultstr =  implode(',',$result);
        return $result;
    }
    //echo '<pre>'; print_r($tbl_transactions); echo '</pre>'; die; 
    $tnumber = $taknumber = array();
    $akandar = $akbahar = array();
    $tamount = $takamount = array();
    $totalamnt = 0;
    foreach ($tbl_transactions as $k => $val) {
        $tnumber[$k] = $tamount[$k] = [];
        $totalamnt = $totalamnt + $val['ttamnt'];
        $trno = explode(',', rtrim($val['trnno'], ','));
        $trn_amount = explode(',', rtrim($val['trn_amt'], ','));
        //echo '<pre>'; print_r(count($trno));echo '<br>'; print_r(count($trn_amount)); echo '</pre>';//die;
        $last = count($trno);
        for ($i = 0; $i < (count($trno)); $i++) {
            if ($trno[$i] != '') {
                if ((strlen($trno[$i]) == 1)) {
                    $trno[$i] = sprintf("%02d", $trno[$i]);
                }
                if ((strlen($trno[$i]) == 2)) {
                    //array_push($tnumber,$trno[$i]);
                    //echo $k.'<br>';
                    //if(!$trn_amount[$i]){
                    //echo $k.' ttp '.$i.'<br>';
                    //} 
                    //echo $k.'  '.$trno[$i].' '.$trn_amount[$i].'<br>';
                    $tnumber[$k][$i] = $trno[$i];
                    $tamount[$k][$i] = $trn_amount[$i];
                }
                if (strlen($trno[$i]) == 3 && $trno[$i] != '100') {
                    $count = 0;
                    $akamount = $trn_amount[$i];
                    for ($j = 0; $j <= 99; $j++) {
                        $ju = sprintf("%02d", $j);
                        $n = (string)$ju;
                        $a = (string)$trno[$i];
                        if ($j != '100') {
                            if ($a[0] == $n[1]) {
                                //						$tnumber[$i]=$ju;
                                //$tamount[$i]=$trn_amount[$i];	

                                array_push($tnumber[$k], $ju);
                                //array_push($tamount,$trn_amount[$i]);
                                $count++;
                            }
                        }
                    }

                    $akamnt = ceil($akamount / $count);
                    for ($t = 0; $t < $count; $t++) {
                        array_push($tamount[$k], $akamnt);
                    }
                }
                //echo '<pre>'; print_r($trno[$i]); echo '</pre>';
                if (strlen($trno[$i]) == 4) {
                    $count = 0;
                    for ($j = 0; $j <= 99; $j++) {
                        $ju = sprintf("%02d", $j);
                        $n = (string)$ju;
                        $a = (string)$trno[$i];
                        if ($j != '100') {
                            if ($a[0] == $n[0]) {
                                //						$tnumber[$i]=$ju;
                                //$tamount[$i]=$trn_amount[$i];	
                                array_push($tnumber[$k], $ju);
                                //array_push($tamount,$trn_amount[$i]);
                                $count++;
                            }
                        }
                    }
                    //echo '<pre>';  print_r($tbl_transactions[$k]); echo '</pre>'; //die;
                    $akamnt = ceil($trn_amount[$i] / $count);
                    for ($t = 0; $t < $count; $t++) {
                        array_push($tamount[$k], $akamnt);
                    }

                    ///echo '<pre>'; print_r($n); echo '</pre>';

                }
                if ($trno[$i] == '100') {
                    $tnumber[$k][] = $trno[$i];
                    $tamount[$k][] = $trn_amount[$i];
                }
            }
        }
        /* foreach($tbl_transactions as $k => $val){
	$tnumber[$k] = $tamount[$k] = [];
	
	$trno = explode(',',rtrim($val['trnno'],','));
$trn_amount = explode(',',rtrim($val['trn_amt'],','));
$last = count($trno);
for($i=0;$i<(count($trno));$i++){
if($trno[$i]=='100' && $i==($last-1)){
				$tnumber[$k][$i]=$trno[$i];
			$tamount[$k][$i]=$trn_amount[$i];
		}
}
} */
        //echo '<pre>'; print_r($val['dcomm']); echo '</pre>';
        //echo '<pre>'; print_r($val['dhissa']); echo '</pre>';		
        // echo '<pre>'; print_r($tnumber); echo '</pre>';
        //echo '<pre>'; print_r($tamount); echo '</pre>';  //die;
        // for ($x = 0; $x < count($tamount[$k]); $x++) {
        //     //echo $tamount[$k][$x].'  '.$k.'<br>';//die;
        //     if (isset($val['dcomm'])) {
        //         //echo '<pre>'; print_r($tnumber); echo '</pre>';
        //         //echo '<pre>'; print_r($tamount); echo '</pre>'; 
        //         //echo ' '.$k;
        //         $tamount[$k][$x] = $tamount[$k][$x] - ($tamount[$k][$x] * $val['dcomm'] / 100);
        //     }
        //     if (isset($val['dhissa'])) {
        //         $tamount[$k][$x] = $tamount[$k][$x] - ($tamount[$k][$x] * $val['dhissa'] / 100);
        //     }
        //     if (isset($val['tppercentage'])) {
        //         $tamount[$k][$x] = $tamount[$k][$x] - ($tamount[$k][$x] * $val['tppercentage'] / 100);
        //     }
        // }
        //echo '<pre>'; print_r($val['ledger_name']); echo '</pre>';
        //echo '<pre>'; print_r($tnumber); echo '</pre>';
        //echo '<pre>'; print_r($tamount); echo '</pre>'; //die;

    }
    /*if(strlen($trno[$i])==3){
		for($j=1;$j<101;$j++){
		$ju = sprintf("%02d", $j);
		$n = (string)$ju;
		$a = (string)$trno[$i];
		if($a[0]==$n[1]){
								$tnumber[$i]=$ju;
	$tamount[$i]=$trn_amount[$i];	
							}
		}
					
							///echo '<pre>'; print_r($n); echo '</pre>';
							 
	}*/
    //echo '<pre>'; print_r($tamount); echo '</pre>';
    /*foreach($tbl_transactions as $k => $val){
	$tnumber[$k] = $tamount[$k] = [];
if(isset($val['trnno'])){
	//echo '<pre>'; print_r(var_dump($val['dcomm'])); echo '</pre>'; die;
	
$trno = explode(',',rtrim($val['trnno'],','));
//echo '<pre>'; print_r($trno); echo '</pre>'; die;
$trn_amount = explode(',',rtrim($val['trn_amt'],','));
//echo '<pre>'; print_r($k); echo '</pre>'; 
//echo '<pre>'; print_r(count($trno)); echo '</pre>'; //die;
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
array_push($tnumber[$k],$trnumber[$i]);
array_push($tamount[$k],$tramount);
}
}
}
	if($val['dcomm']){
		

    if (!is_array($tnumber[$k]))
    {
		$tamount[$k] = $tamount[$k]-(($val['dcomm']*$tamount[$k])/100);
	
    }
    else
    {
       foreach ($tnumber[$k] as $key4 => $value2)
       { 
         $tamount[$k][$key4] = ($tamount[$k][$key4]-(($val['dcomm']*$tamount[$k][$key4])/100));
		 }
		 }
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
	}
		//$tamount[$k] = ($tamount[$k]-($tamount[$k]*($val['dhissa']/100)));
	}
//echo '<pre>'; print_r($tnumber); echo '</pre>';
//echo '<pre>'; print_r($tamount); echo '</pre>';	
//}
}*/

    //die;
    //echo '<pre>'; print_r($taknumber); echo '</pre>';
    //echo '<pre>'; print_r($takamount); echo '</pre>';
    //echo '<pre>'; print_r($tnumber);echo 'num'; echo '</pre>';
    //echo '<pre>'; print_r($tamount); echo '</pre>'; die;	
    $ntnumber = $namount = [];
    foreach ($tnumber as $key => $val) {
        foreach ($val as $keyy => $vall) {
            if ($vall == '100') {
                $vall = '00';
            }
            array_push($ntnumber, $vall);
        }
    }
    foreach ($tamount as $key => $val) {
        foreach ($val as $keyy => $vall) {
            array_push($namount, $vall);
        }
    }
    //echo '<pre>'; print_r($ntnumber); echo '</pre>'; die;
    ?>
    <table class="table table-bordered table-hover" style="
    line-height: 14px;
">
        <thead>
            <!--<tr class="thead" style="background:#0B6FA4; ">
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
                <td>Total</td>
            </tr>-->
        </thead>
        <tbody>
            <?php
            //echo '<pre>'; print_r($namount); echo '</pre>'; die;
            $nnarr = $akeyy = array();
            for ($d = 0; $d <= 99; $d++) {
                $tamn = 0;
                if ($d == '99') {
                    $du = '00';
                } else {
                    $du = sprintf("%02d", ($d + 1));
                }

                $ke = array_keys($ntnumber, $du);

                foreach ($ke as $vall) {
                    $tamn += $namount[$vall];
                }
                //echo '<pre>'; print_r($tamn); die;

                $nnarr[$d + 1] = $tamn;
            }
            //echo '<pre>'; print_r($nnarr); echo '</pre>';
            for ($t = 0; $t < count($ntnumber); $t++) {
                $akey = array_keys($ntnumber, $ntnumber[$t]);
                //for($x=0;$x<count($akey);$x++)
                array_push($akeyy, $akey);
            }
            //echo '<pre>'; print_r($akeyy); echo '</pre>';
            $nkeyy = array_intersect_key($akeyy, array_unique(array_map('serialize', $akeyy)));
            //echo '<pre>'; print_r($nkeyy); echo '</pre>';
            /* for($w=0;$w<=count($nkeyy);$w++){ 
			if(isset($nkeyy[$w])){
			echo '<pre>';print_r($nkeyy[$w]);echo '</pre>';
			}
			} */
            foreach ($nkeyy as $nkey => $nval) {
                $narr[$nkey] = 0;
                foreach ($nval as $nnkey => $nnval) {
                    $narr[$nkey] += $namount[$nnval];
                }
            }
            for ($w = 0; $w <= count($nkeyy); $w++) {
                $sum = 0;
                if (isset($nkeyy[$w])) {
                    for ($y = 0; $y < count($nkeyy[$w]); $y++) {
                        $num = $ntnumber[$nkeyy[$w][$y]];
                        $sum += $namount[$nkeyy[$w][$y]];
                    }

                    //$narr[$num]=$sum;
                }
            }
            /* for($w=0;$w<count($nkeyy);$w++){
				for($y=0;$y<count($nkeyy[$w]);$y++){
					array_push($narr,$nkeyy[$w][$y]);
				}
			} */

            //echo '<pre>'; print_r($narr); echo '</pre>';
            //$arkeys = array_keys($tnumber);
            //echo '<pre>'; print_r($tnumber); echo '</pre>';
            //echo '<pre>'; print_r($tamount); echo '</pre>';
            $ftamnt = '';
            $ttamntt = $keyy = 0;
            $kval = '';
            for ($i = 0; $i < 10; $i++) { ?>
                <tr>
                    <?php
                    for ($j = 1; $j < 12; $j++) {
                        $keyz = (($j) % 10 == 0) ? (($j) * ($i + 1)) : ($i . ($j));
                        $key = ltrim($keyz, '0');
                        if (isset($nnarr[$key]) && $j != '11') {
                    ?>
                            <td>
                                <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;"><?= ($key == '100') ? '00' : $key ?></span>
                                <input type="text" value="<?= $nnarr[$key] ?>" name="sr_<?= (($j) % 10 == 0) ? (($j) * ($i + 1)) : ($i . ($j)) ?>" id="<?= $i . $j ?>" tabindex="<?= (($j) % 10 == 0) ? (($j) * ($i + 1)) : ($i . ($j)) ?>" style="width: 65%;" class="med">
                            </td>
                            <?php
                            $ttamntt += $nnarr[$key];
                        } else {
                            if ($j == '11') { ?>
                                <td style="text-align: center;">
                                    <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;"></span>
                                    <input type="text" value="" name="row_<?= $i ?>" id="<?= $i . $j ?>" tabindex="<?= (($j) % 10 == 0) ? (($j) * ($i + 1)) : ($i . ($j)) ?>" style="width: 65%;" class="medrow">
                                </td>
                            <?php
                            } else {
                            ?>
                                <td>
                                    <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;"><?= $key ?></span>
                                    <input type="text" value="" name="sr_<?= (($j) % 10 == 0) ? (($j) * ($i + 1)) : ($i . ($j)) ?>" id="<?= $i . $j ?>" tabindex="<?= (($j) % 10 == 0) ? (($j) * ($i + 1)) : ($i . ($j)) ?>" style="width: 65%;" class="med">
                                </td>
                    <?php
                            }
                        }
                        /* 
	$key = (($j)%10==0)?(($j)*($i+1)):($i.($j));
	$str = ltrim($key, '0');
	$kval = array_search($key,$tnumber);
//echo $kval; die;	
	if($kval!='')
	{ 
?>
	<td>
                <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;"><?=$key?></span>
                    <input type="text" value="<?=$tamount[$kval]?>"
                        name="sr_<?=(($j)%10==0)?(($j)*($i+1)):($i.($j))?>" id="<?=$i.$j?>"
                        tabindex="<?=(($j)%10==0)?(($j)*($i+1)):($i.($j))?>"  style="width: 65%;" class="med">
                </td>
	<?php 
}
else{
	?>
	<td>
                <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;"><?=$key?></span>
                    <input type="text" value=""
                        name="sr_<?=(($j)%10==0)?(($j)*($i+1)):($i.($j))?>" id="<?=$i.$j?>"
                        tabindex="<?=(($j)%10==0)?(($j)*($i+1)):($i.($j))?>"  style="width: 65%;" class="med">
                </td>
	<?php
}
	$keyy++; */
                    }
                    /*for($j=0;$j<10;$j++){ 
	$data = (($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1));
	//echo '<pre>';echo $data.' tt '; print_r($tnumber); //die;
	//$key = array_search($data,$tnumber);
	//echo $key; //die;
	if($data == '100'){
		$data = '00';
	}
	$ftamnt = "0";
	foreach($tnumber as $key => $value)
{
	echo '<pre>'; print_r($tnumber); echo '</pre>';
	echo '<pre>'; print_r($tamount); echo '</pre>'; die;
	$arr = $value;
			$amt = $tamount[$key];
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
       { //echo '<pre>'; print_r($value); echo '</pre>'; die;
				$numm = sprintf("%02d", $value2);
			$a = (string)$numm;
         if($value2 == $data){
			//$fkey = $key2;
			$ftamnt = $ftamnt + $tamount[$key][$key2];
		}
		else{
		if(strlen($value2) == '3'){ 
		$nu = sprintf("%02d", $value2);
			$n = (string)$nu;
			if($a[1]==$n[0]){
			$ftamnt = $ftamnt + $tamount[$key][$key2];	
			}
		}
		if(strlen($value2) == '4'){ 		
					$nu1 = sprintf("%02d", $value2);
			$n1 = (string)$nu1;
					//$ind1 = in_array($a[0],$n1[0]);
					if($a[0]==$n1[0]){
						$ftamnt = $ftamnt + $tamount[$key][$key2];	
						//echo $a[0].' aa '.$amt[$i];
						//echo ' index '.$i.' andar '.$a[0].' amnt '.$amt[$i].'<br>';
						//echo '<pre>'; print_r($akmnt); echo '</pre>'; 
					} 
		}
		}
       }

       //echo ")";
    }
}
//echo $ftamnt;
$narr = sprintf("%02d", $value);
$dkey = (($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1));
	?>


                <td>
                <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;"><?=(($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1))?></span>
                    <input type="text" value="<?=($arr==$narr)?$amt:''?>"
                        name="sr_<?=(($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1))?>" id="<?=$i.$j?>"
                        tabindex="<?=(($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1))?>"  style="width: 65%;" class="med">
                </td>



                <?php }*/ ?>
                    <?php /* ?><td>
                <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;">&nbsp;</span>
                  <input type="text" style="width:65%" tabindex="total_p<?=$i?>" name="total_p<?=$i?>" value="0" readonly>
				<!--<span class="ftotal" id="total_p<?=$i?>" tabindex="total_p<?=$i?>">0</span>-->
            </td><?php */ ?>
                </tr>

            <?php

            } ?>
            <input type="hidden" name="ttamntt" id="ttamntt" value="<?= $ttamntt ?>">
            <!--<tr bgcolor="green">
		 
		<?php for ($x = 0; $x < 10; $x++) { ?>
           
            <td>
                <input type="text" name="total_h<?= $x ?>" value="0" readonly>
            </td>
           
		<?php } ?>
        

            <td>
                <input type="text" name="total_all" value="0" placeholder="All Total">
            </td>
		</tr>-->
            <?php if (!empty($tbl_transactions)) {
            ?>
                <tr>
                    <td>&nbsp;</td>
                </tr>
                <tr>
                    <th colspan="3">
                        Total Amount
                    </th>
                    <th colspan="3">
                        <?= $totalamnt ?>
                    </th>
                </tr>
            <?php
            } ?>


        </tbody>
    </table>
    <?php  //var_dump($tnumber); die; ?>
    <table class="table table-bordered table-hover">
        <tbody>
            <tr>
                <?php for($ii=1;$ii<11;$ii++){ ?>
                <td><input type="text" name="b[<?=$ii?>]" value="<?=(in_array($ii,$akbahar))?$bhamaount:''?>"
                        onkeyup="findbTotal()" id="<?=$ii?>" placeholder="b<?=$ii?>" class="meddb"></td>
                <?php }?>
                <td><input type="text" id="total_b" name="total_b" value="0"></td>
            </tr>
            <tr>
                <?php for($ii=1;$ii<11;$ii++){ ?>
                <td><input type="text" name="a[<?=$ii?>]" value="<?=(in_array($ii,$akandar))?$akamount:''?>"
                        onkeyup="findaTotal()" id="<?=$ii?>" placeholder="a<?=$ii?>" class="medda"></td>
                <?php }?>
                <td>
<input type="text" id="total_a" name="total_a" value="0"></td>
            </tr>
            <!--<tr>
<td colspan="10">Grand Total : <span id="gtotal"></span>&nbsp;</td>
<!--<td colspan="2"><button type="button" onclick="submitjantri()" class="btn btn-success" style="padding: .375rem 2.75rem;">Submit</button></td></tr>-->

        </tbody>
    </table> <?php  ?>
</form>
<script>
    document.getElementById('tamnt').value = document.getElementById('ttamntt').value;
</script>