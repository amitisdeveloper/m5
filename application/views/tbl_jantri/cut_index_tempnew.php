<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    $(function () {

        $('.med').on('change', function () {

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
            $('input[name^=total_h]').each(function () {
                var data = isNaN($(this).val()) ? 0 : ($(this).val() * 1);
                totalHead += data;
            });

            $('input[name^=total_p]').each(function () {
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
        xhttp.onreadystatechange = function () {
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
            $(".med").each(function () {
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
            $(".med").each(function () {
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
            $(".med").each(function () {
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
            $(".med").each(function () {
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
        $(".med").each(function () {
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
// $sendjantri = 0;
// if ($this->session->userdata['userid'] != '1' &&!empty($tbl_transactions)) {
//     foreach ($tbl_transactions as $key => $val) {
//         if ($val['show_to_admin'] == '0') {
//             $sendjantri = 1;
//             break;
//         }
//     }
// }
?>

<div class="x_panel">
    <div class="x_title">
        <h2 style="text-decoration:underline;"><b>Jantri Filters</b></h2>
        <?php if ($this->session->userdata['userid'] != '1' && !empty($_GET)) { ?>
            <!-- <form action="tbl_transactions/sendjantri" method="post" style="position: absolute;right: 0;">
                
            </form> -->
        <?php } ?>
        <form name="custom" action="" method="GET" style="margin-right: 93px;">
            <div class="nav navbar-right panel_toolbox">
                <div class="form-group pull-right top_search">
                    <div class="input-group">
                        <h2 style="margin-right:10px;"><b>Date</b></h2>
                        <input name="date" class="birthdaymaster form-control" type="text" value="<?=(isset($_GET['date']))?$_GET['date']:''?>" autocomplete="off" required="">
                        <div class="alert" style="display:none">Please Select Shift First</div>
                        <input type="submit" name="submit" value="Submit" autocomplete="off" onclick=""
                            style="width: 20%;margin-left: 20px;margin-right: 20px;">
                    </div>
                </div>
            </div>
            <div class="nav navbar-left panel_toolbox">
                <h2 style="margin-right:10px;"><b>Shift</b></h2>
                <!-- Split button -->
                <div class="btn-group" style="height: 36px; margin-right: 10px;">
                    <?php
                    date_default_timezone_set('Asia/Kolkata');
                    $ttime = time();
                    $nearest_time = PHP_INT_MAX;
                    $nearest_shift_id = null;

                    foreach ($shifts as $key => $shift) {
                        if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Super Admin' || $_SESSION['role'] == 'Master') {
                            $role_time = isset($shift['master']) ? $shift['master'] : '00:00 AM';
                        } elseif ($_SESSION['role'] == 'Data Entry Operator' || $_SESSION['role'] == 'Staff') {
                            $role_time = isset($shift['data_entry_operator']) ? $shift['data_entry_operator'] : '00:00 AM';
                        } else {
                            $role_time = isset($shift['master']) ? $shift['master'] : '00:00 AM';
                        }

                        $time = strtotime(date('Y-m-d', strtotime($shift['open_date'])) . ' ' . date('H:i', strtotime($role_time)));

                        if ($ttime < $time && $time < $nearest_time) {
                            $nearest_time = $time;
                            $nearest_shift_id = $shift['id'];
                        }
                    }

                    $selected_shift_id = isset($_GET['pid']) ? $_GET['pid'] : $nearest_shift_id;
                    ?>
                    <select name="pid" id="shift" class="form-control" required>
                        <option value="">Choose option</option>
                        <?php foreach ($shifts as $key => $val) { ?>
                            <option value="<?= $val['id'] ?>" <?= ((string) $selected_shift_id === (string) $val['id']) ? 'selected' : '' ?>><?= $val['shift_name'] ?></option>
                        <?php } ?>
                    </select>
                    <div class="alert" style="display:none">Please Select Shift First</div>
                </div>
            </div>
        </form>

        <div class="clearfix"></div>

    </div>

    <div class="x_content">
        <table class="table table-bordered table-hover">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <?php if ($this->session->userdata['userid'] != '1') { ?>
                        <td>Self Patti in Percentage</td>
                        <td><input id="aperc" type="text" name="perc"></td>
                    <?php } ?>
                    <td>Total Amount</td>
                    <td style="visibility:hidden">A-Amount</td>
                    <td style="visibility:hidden"><input id="aamnt" type="text" name="amt" value=""></td>
                    <td style="visibility:hidden">A-Percentage</td>
            <td style="visibility:hidden"><input id="aperc" type="text" name="perc"></td>
            <td style="visibility:hidden">A-Amount</td>
            <td style="visibility:hidden"><input id="aamnt" type="text" name="amt" value=""></td>
                </tr>
                <tr>
                    <td>D-Percentage</td>
                    <td><input id="dperc" type="text" name="perc"></td>
                    <td><input id="tamnt" name="total_amount" value="" readonly></td>

                    <td>D-Amount</td>
                    <td><input id="damnt" type="text" name="amt"></td>
                    <td><input type="button" class="form-success" id="calcbtn" onclick="calccutting(this)" name="Submit"
                            value="Submit"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <form action="tbl_transactions/sendjantri" method="post" style="position: absolute;right: 0;margin-top : 85px">

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
        // Initialize the table (1 to 100) with zero amounts
$table = array_fill(1, 100, 0);

// Function to distribute amounts according to the rules
function distributeAmount($number, $amount, &$table, $dcomm = 0, $dhissa = 0, $tppercentage = 0) {
    $numberInt = (int)$number;
    $numberStr = (string)$number;

    // Apply percentage deductions
    $adjustedAmount = $amount;
    
    // Deduct distributor commission (dcomm)
    if ($dcomm > 0) {
        $adjustedAmount -= ($dcomm * $adjustedAmount / 100);
    }

    // Deduct share amount (dhissa)
    if ($dhissa > 0) {
        $adjustedAmount -= ($dhissa * $adjustedAmount / 100);
    }

    // Deduct top percentage (tppercentage)
    if ($tppercentage > 0) {
        $adjustedAmount -= ($tppercentage * $adjustedAmount / 100);
    }

    // Two-digit numbers: direct assignment
    if (strlen($numberStr) == 2) {
        if ($numberInt == 0) {
            $numberInt = 100;
        }
        // Initialize the array key if not set
        if (!isset($table[$numberInt])) {
            $table[$numberInt] = 0;
        }
        $table[$numberInt] += $adjustedAmount;
    }

    // Three-digit number: numbers like 222, 333, etc.
    elseif (strlen($numberStr) == 3 && $numberStr[0] == $numberStr[1] && $numberStr[1] == $numberStr[2]) {
        $digit = $numberStr[0];
        $matches = [];

        // Collect numbers ending in that digit
        for ($i = 0; $i <= 9; $i++) {
            $match = (int)($i . $digit);
            $matches[] = $match;
        }

        if (count($matches) > 0) {
            $splitAmount = $adjustedAmount / count($matches);
            foreach ($matches as $match) {
                if ($match == 0) {
                    $match = 100; 
                }
                // Initialize the array key if not set
                if (!isset($table[$match])) {
                    $table[$match] = 0;
                }
                $table[$match] += $splitAmount;
            }
        }
    }

    // Four-digit numbers: match numbers starting with that digit
    elseif (strlen($numberStr) == 4 && $numberStr[0] == $numberStr[1] && $numberStr[1] == $numberStr[2] && $numberStr[2] == $numberStr[3]) {
        $digit = $numberStr[0];
        $matches = [];

        // Collect numbers starting with that digit
        for ($i = 0; $i <= 9; $i++) {
            $match = (int)($digit . $i);
            $matches[] = $match;
        }

        if (count($matches) > 0) {
            $splitAmount = $adjustedAmount / count($matches);
            foreach ($matches as $match) {
                if ($match == 0) {
                    $match = 100; 
                }
                // Initialize the array key if not set
                if (!isset($table[$match])) {
                    $table[$match] = 0;
                }
                $table[$match] += $splitAmount;
            }
        }
    }
}

$numbers = [];
$amounts = [];
$table = [];  // Initialize the table to store distributed amounts

if (!empty($tbl_transactions)) {
    // Loop through the data and distribute amounts
    foreach ($tbl_transactions as $entry) {
        $numbers = explode(',', $entry['trnno']);
        $amounts = explode(',', $entry['trn_amt']);

        // Validate that the number of amounts matches the number of transaction numbers
        if (count($numbers) != count($amounts)) {
            echo "Mismatch in transaction numbers and amounts for entry ID: " . $entry['id'] . "\n";
            continue; // Skip this entry if there is a mismatch
        }

        foreach ($numbers as $index => $number) {
            if (isset($amounts[$index])) {
                $amount = $amounts[$index];
                distributeAmount($number, $amount, $table, $entry['dcomm'], $entry['dhissa'], $entry['tppercentage']);
            }
        }
    }
}

// Print the final table of distributed amounts
//print_r($table); die;

        
        $tnumber = $taknumber = array();
        $akandar = $akbahar = array();
        $tamount = $takamount = array();

        foreach ($tbl_transactions as $k => $val) { //echo '<pre>'; print_r($val); die;
            $tnumber[$k] = $tamount[$k] = [];

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
                            $n = (string) $ju;
                            $a = (string) $trno[$i];
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
                            $n = (string) $ju;
                            $a = (string) $trno[$i];
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
            for ($x = 0; $x < count($tamount[$k]); $x++) {
                //echo $tamount[$k][$x].'  '.$k.'<br>';//die;
                if (isset($val['dcomm'])) {
                    //echo '<pre>'; print_r($tnumber); echo '</pre>';
                    //echo '<pre>'; print_r($tamount); echo '</pre>'; 
                    //echo ' '.$k;
                    $tamount[$k][$x] = $tamount[$k][$x] - ($tamount[$k][$x] * $val['dcomm'] / 100);
                }
                if (isset($val['dhissa'])) {
                    $tamount[$k][$x] = $tamount[$k][$x] - ($tamount[$k][$x] * $val['dhissa'] / 100);
                }
                if (isset($val['tppercentage'])) {
                    $tamount[$k][$x] = $tamount[$k][$x] - ($tamount[$k][$x] * $val['tppercentage'] / 100);
                }
            }
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
                //echo '<pre>'; print_r($ntnumber); echo '</pre>';
               // echo '<pre>'; print_r($namount); echo '</pre>';
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
                $rowCount = 0;

                for ($i = 1; $i <= 100; $i++) {
                    // Start a new row for every 10 numbers
                    if ($rowCount % 10 == 0) {
                        echo "<tr>";
                    }
                
                    // Output the number and its corresponding amount in a box
                    //echo "<td><strong>$i</strong><br>" . $table[$i] . "</td>";
                      // Check if the value exists in $table, otherwise default to 0
    $value = isset($table[$i]) ? $table[$i] : 0;
    
    ?>
    <td>
        <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;"><?= ($i == 100) ? '00' : $i ?></span>
        <input type="text" value="<?= $value ?>" name="sr_<?= $i ?>" id="<?= $i ?>" style="width: 65%;" class="med">
    </td>
                    <?php
                    $rowCount++;
                
                    // Close the row after every 10 cells
                    if ($rowCount % 10 == 0) {
                        echo "</tr>";
                    }
                }
                ?>
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


            </tbody>
        </table>
        <?php /* //var_dump($tnumber); die; ?>
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
</table> <?php */

?>
        <input type="hidden" id="dateofjantri" name="dateoftrn" value="<?= (!empty($_GET['date'])) ? $_GET['date'] : '' ?>">
        <input type="hidden" id="pid" name="shift" value="<?= (!empty($_GET['pid'])) ? $_GET['pid'] : '' ?>">
        <?php if($this->session->userdata['userid'] != '1' &&!$ledger['is_locked']){ ?>
        <ul class="nav navbar-right panel_toolbox">
        <button id="btnFetch" type="submit" class="btn btn-primary" <?= ($sendjantri == 0 ? 'disabled' : '') ?>>Send Jantri</button>
        </ul>
        <?php } ?>
    </form>
</div>
<!-- <script>
  // Get references to the input field and button
  const amountInput = document.getElementById('tamnt');
  const submitBtn = document.getElementById('btnFetch');

  // Function to check input value and enable/disable button
  function checkInput() {
    // Check if the input field is empty or contains only spaces
    
    if (amountInput.value.trim() === '') { 
      // Disable the button if input is empty
      submitBtn.disabled = true;
    } else {
      // Enable the button if input is not empty
      submitBtn.disabled = false;
    }
  }

  // Call checkInput function on page load
  checkInput();

  // Add event listener to input field to check on input change
  amountInput.addEventListener('input', checkInput);
</script> -->
<script>
    
    // $(document).ready(function() {
    //     var fewSeconds = 2;
    //     $("#btnFetch").click(function() {
    //         if ($(this).hasClass("btn-primary")) {
    //             var btn = $(this);
    //             btn.html(
    //                 '<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait...'
    //             );
    //             btn.prop('disabled', true);
    //             var dateofjantri = $('#dateofjantri').val();
    //             var pid = $('#pid').val();
    //             setTimeout(function() {
    //                 $.ajax({
    //                     type: "POST",
    //                     url: "tbl_transactions/sendjantri",
    //                     data: {
    //                         pid: pid,
    //                         dateofjantri: dateofjantri
    //                     },
    //                    // dataType: 'json',
    //                     success: function(res) {
    //                         btn.removeClass('btn-primary').addClass('btn-success');
    //                         btn.html(
    //                             'Jantri Sent'
    //                         );
    //                     }
    //                 });
    //             }, fewSeconds * 1000);

    //             // Ajax request
    //             // var btn = $(this);
    //             // btn.html(
    //             //     '<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait...'
    //             // );
    //             // btn.prop('disabled', true);
    //             // setTimeout(function() {
    //             //     btn.removeClass('btn-primary').addClass('btn-success');
    //             //     btn.prop('disabled', false);
    //             //     btn.html(
    //             //         'Jantri Sent'
    //             //     );
    //             // }, fewSeconds * 1000);
    //             // add spinner to button
    //             // $(this).html(
    //             // '<i class="fa fa-circle-o-notch fa-spin"></i> Please Wait...'
    //             //);
    //         }
    //     });
    // });
    document.getElementById('tamnt').value = document.getElementById('ttamntt').value;
</script>