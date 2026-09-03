<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
    // A browser reload should start a fresh Jantri instead of replaying the last GET request.
    (function resetJantriOnReload() {
        const navigation = performance.getEntriesByType('navigation')[0];
        if (navigation && navigation.type === 'reload' && window.location.search) {
            window.location.replace(window.location.pathname);
        }
    }());

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
            recalculateJantriTotals();
        });

    });

    function recalculateJantriTotals() {
        var grandTotal = 0;

        $('.jantri-grid tbody tr').each(function () {
            var rowTotal = 0;
            $(this).find('.med').each(function () {
                rowTotal += Number($(this).val()) || 0;
            });

            $(this).find('.medrow').val(rowTotal);
            grandTotal += rowTotal;
        });

        $('#ttamntt').val(grandTotal);
        $('#tamnt').val(grandTotal);
    }

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

    .jantri-control-grid {
        display: flex;
        gap: 16px;
        align-items: stretch;
        flex-wrap: wrap;
    }

    .jantri-main-panel {
        flex: 3 1 0;
        min-width: 360px;
    }

    .jantri-d-panel {
        flex: 1 1 260px;
        min-width: 260px;
    }

    .jantri-control-card {
        border: 1px solid #E6E9ED;
        border-radius: 4px;
        background: #fff;
        padding: 12px 14px;
    }

    .jantri-control-row {
        display: flex;
        flex-wrap: nowrap;
        gap: 12px;
        align-items: flex-end;
    }

    .jantri-field {
        flex: 1 1 170px;
        min-width: 170px;
    }

    .jantri-field label,
    .jantri-option-group label,
    .jantri-submit-label {
        display: block;
        margin-bottom: 5px;
        font-weight: 600;
    }

    .jantri-option-group {
        flex: 1 1 240px;
        min-width: 220px;
    }

    .jantri-options {
        display: flex;
        flex-wrap: wrap;
        gap: 12px 18px;
        align-items: center;
    }

    .jantri-option {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        white-space: nowrap;
        font-weight: 600;
    }

    .jantri-option input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin: 0;
    }

    .jantri-submit {
        flex: 0 0 140px;
    }

    .jantri-submit .btn {
        width: 100%;
    }

    .jantri-main-panel .jantri-field {
        min-width: 130px;
    }

    .jantri-main-panel .jantri-total {
        flex: 0 1 120px;
        min-width: 120px;
    }

    .jantri-main-panel .jantri-option-group {
        flex: 1 1 210px;
        min-width: 210px;
    }

    .jantri-main-panel .jantri-submit {
        flex: 0 0 110px;
    }

    .jantri-d-panel .jantri-field {
        flex: 0 1 105px;
        min-width: 0 !important;
    }

    .jantri-d-panel .jantri-submit {
        flex: 0 0 112px;
    }

    .jantri-table-wrap {
        width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .jantri-grid {
        min-width: 980px;
    }

    .table td,
    .table th {
        padding: 0;
        vertical-align: top;
        border-top: 1px solid #dee2e6;
    }

    @media (max-width: 767px) {
        .jantri-control-grid {
            flex-direction: column;
        }

        .jantri-control-row {
            flex-wrap: wrap;
        }

        .jantri-main-panel,
        .jantri-d-panel {
            min-width: 100%;
        }

        .jantri-field,
        .jantri-option-group,
        .jantri-submit {
            width: 100%;
            min-width: 100%;
        }

        .jantri-main-panel .jantri-field,
        .jantri-main-panel .jantri-option-group,
        .jantri-main-panel .jantri-submit,
        .jantri-d-panel .jantri-field,
        .jantri-d-panel .jantri-submit {
            min-width: 100% !important;
        }

        .jantri-options {
            justify-content: flex-start;
        }

        .x_panel {
            overflow: hidden;
        }
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
        <div class="jantri-control-grid">
            <form name="custom-main" action="" method="GET" class="jantri-control-card jantri-main-panel">
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
                <div class="jantri-control-row">
                    <div class="form-group jantri-field">
                        <label for="shift">Shift</label>
                        <select name="pid" id="shift" class="form-control" required>
                            <option value="">Choose option</option>
                            <?php foreach ($shifts as $key => $val) { ?>
                                <option value="<?= $val['id'] ?>" <?= ((string) $selected_shift_id === (string) $val['id']) ? 'selected' : '' ?>><?= html_escape($val['shift_name']) ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group jantri-field">
                        <label for="jantri-date">Date</label>
                        <input id="jantri-date" name="date" class="birthdaymaster form-control" type="text" value="<?= isset($_GET['date']) ? html_escape($_GET['date']) : '' ?>" autocomplete="off" required>
                    </div>
                    <div class="jantri-option-group">
                        <label>Amount Adjustments</label>
                        <div class="jantri-options" aria-label="Amount adjustments">
                            <label class="jantri-option" for="apply-commission">
                                <input id="apply-commission" type="checkbox" name="apply_commission" value="1" <?= $apply_commission ? 'checked' : '' ?>>
                                Commission
                            </label>
                            <label class="jantri-option" for="apply-patti">
                                <input type="hidden" name="apply_patti" value="0">
                                <input id="apply-patti" type="checkbox" name="apply_patti" value="1" <?= $apply_patti ? 'checked' : '' ?>>
                                Patti
                            </label>
                            <label class="jantri-option" for="convert-to-50" title="Rounds values to 50-step buckets: 0-24 -> 0, 25-74 -> 50, 75-100 -> 100.">
                                <input id="convert-to-50" type="checkbox" name="round_to_50" value="1" <?= $round_to_50 ? 'checked' : '' ?>>
                                Convert into 50 and 100
                            </label>
                        </div>
                    </div>
                    <div class="jantri-field jantri-total">
                        <label for="tamnt">Total Amount</label>
                        <input id="tamnt" class="form-control" value="0" readonly>
                    </div>
                    <div class="jantri-submit">
                        <label class="jantri-submit-label">&nbsp;</label>
                        <button type="submit" name="submit" value="main" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <input type="hidden" name="d_percentage" value="<?= isset($_GET['d_percentage']) ? html_escape($_GET['d_percentage']) : '' ?>">
                <input type="hidden" name="d_amount" value="<?= isset($_GET['d_amount']) ? html_escape($_GET['d_amount']) : '' ?>">
            </form>
            <form name="custom-d" action="" method="GET" class="jantri-control-card jantri-d-panel">
                <div class="jantri-control-row">
                    <div class="jantri-field">
                        <label for="d-percentage">D-Percentage</label>
                        <input id="d-percentage" name="d_percentage" type="number" min="0" max="100" step="any" class="form-control" value="<?= isset($_GET['d_percentage']) ? html_escape($_GET['d_percentage']) : '' ?>">
                    </div>
                    <div class="jantri-field">
                        <label for="d-amount">D-Amount</label>
                        <input id="d-amount" name="d_amount" type="number" min="0" step="any" class="form-control" value="<?= isset($_GET['d_amount']) ? html_escape($_GET['d_amount']) : '' ?>">
                    </div>
                    <div class="jantri-submit">
                        <label class="jantri-submit-label">&nbsp;</label>
                        <button type="submit" name="submit" value="d" class="btn btn-success">D Submit</button>
                    </div>
                </div>
                <input type="hidden" name="pid" value="<?= isset($_GET['pid']) ? html_escape($_GET['pid']) : '' ?>">
                <input type="hidden" name="date" value="<?= isset($_GET['date']) ? html_escape($_GET['date']) : '' ?>">
                <input type="hidden" name="apply_commission" value="<?= $apply_commission ? '1' : '' ?>">
                <input type="hidden" name="apply_patti" value="<?= $apply_patti ? '1' : '' ?>">
                <input type="hidden" name="round_to_50" value="<?= $round_to_50 ? '1' : '' ?>">
            </form>
        </div>
    </div>

    <form action="tbl_transactions/sendjantri" method="post" style="">

        <?php
        if (!function_exists('jantri_round_amount')) {
            function jantri_round_amount($rawValue, $roundToFifty = false)
            {
                $value = max(0, (float)$rawValue);

                if ($roundToFifty) {
                    return round($value / 50) * 50;
                }

                return round(floor($value) / 5) * 5;
            }
        }

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
function distributeAmount($number, $amount, &$table, $applyCommission, $applyPatti, $dcomm = 0, $dmcomm = 0, $dhissa = 0, $tppercentage = 0)
{
    // ---------- 1) Normalize / sanitize all numeric inputs ----------
    // Handles: "", null, "  ", "1,000", "5%", "₹100", tabs/newlines, etc.
    $toFloat = function ($v) {
        $s = (string)($v ?? '0');
        $s = trim($s);

        // Treat empty as 0
        if ($s === '') return 0.0;

        // Remove common non-numeric characters
        $s = str_replace([',', '₹', '%', "\n", "\r", "\t", ' '], '', $s);

        // If still not numeric, default to 0 (defensive)
        return is_numeric($s) ? (float)$s : 0.0;
    };

    $numberStr = trim((string)$number);
    $numberInt = (int)$numberStr;

    $amount       = $toFloat($amount);
    $dcomm        = $toFloat($dcomm);
    $dmcomm       = $toFloat($dmcomm);
    $dhissa       = $toFloat($dhissa);
    $tppercentage = $toFloat($tppercentage);

    // ---------- 2) Apply percentage deductions safely ----------
    $adjustedAmount = $amount;

    // Distributor commission (dcomm + dmcomm)
    if ($applyCommission && ($dcomm > 0 || $dmcomm > 0)) {
        $adjustedAmount -= (($dcomm + $dmcomm) * $adjustedAmount / 100);
    }

    // Share amount (dhissa)
    if ($applyPatti && $dhissa > 0) {
        $adjustedAmount -= ($dhissa * $adjustedAmount / 100);
    }

    // Top percentage (tppercentage)
    if ($applyPatti && $tppercentage > 0) {
        $adjustedAmount -= ($tppercentage * $adjustedAmount / 100);
    }

    // Optional: avoid negative due to deductions > 100%
    if ($adjustedAmount < 0) $adjustedAmount = 0.0;

    // ---------- 3) Distribute into $table ----------
    // 1–2 digits: direct assignment
    if (strlen($numberStr) === 1 || strlen($numberStr) === 2) {
        if ($numberInt === 0) $numberInt = 100;

        if (!isset($table[$numberInt])) $table[$numberInt] = 0;
        $table[$numberInt] += $adjustedAmount;
        return;
    }

    // 3 digits like 222, 333 (all same)
    if (strlen($numberStr) === 3 && $numberStr[0] === $numberStr[1] && $numberStr[1] === $numberStr[2]) {
        $digit = $numberStr[0];
        $matches = [];

        // Collect numbers ending in that digit (e.g. 02,12,...,92)
        for ($i = 0; $i <= 9; $i++) {
            $matches[] = (int)($i . $digit);
        }

        $count = count($matches);
        if ($count > 0) {
            $splitAmount = $adjustedAmount / $count;
            foreach ($matches as $match) {
                if ($match === 0) $match = 100;
                if (!isset($table[$match])) $table[$match] = 0;
                $table[$match] += $splitAmount;
            }
        }
        return;
    }

    // 4 digits like 1111, 2222 (all same)
    if (
        strlen($numberStr) === 4 &&
        $numberStr[0] === $numberStr[1] &&
        $numberStr[1] === $numberStr[2] &&
        $numberStr[2] === $numberStr[3]
    ) {
        $digit = $numberStr[0];
        $matches = [];

        // Collect numbers starting with that digit (e.g. 10,11,...,19 if digit=1)
        for ($i = 0; $i <= 9; $i++) {
            $matches[] = (int)($digit . $i);
        }

        $count = count($matches);
        if ($count > 0) {
            $splitAmount = $adjustedAmount / $count;
            foreach ($matches as $match) {
                if ($match === 0) $match = 100;
                if (!isset($table[$match])) $table[$match] = 0;
                $table[$match] += $splitAmount;
            }
        }
        return;
    }

    // If number pattern doesn't match any supported rule, do nothing (or log if you want)
    // log_message('debug', 'distributeAmount skipped unsupported pattern: '.$numberStr);
}


$numbers = [];
$amounts = [];
$table = [];  // Initialize the table to store distributed amounts

if (!empty($tbl_transactions)) {
    // Loop through the data and distribute amounts
    foreach ($tbl_transactions as $entry) { //print_r($entry); die;
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
                distributeAmount(
                    $number,
                    $amount,
                    $table,
                    $apply_commission,
                    $apply_patti,
                    $entry['dcomm'] ?? 0,
                    $entry['dmcomm'] ?? 0,
                    $entry['dhissa'] ?? 0,
                    $entry['tppercentage'] ?? 0
                );
            }
        }
    }
}

// D adjustments are applied once to each final Jantri cell after all
// transaction amounts have been distributed and combined.
$dPercentage = isset($_GET['d_percentage']) && is_numeric($_GET['d_percentage'])
    ? min(100, max(0, (float)$_GET['d_percentage']))
    : 0;
$dAmount = isset($_GET['d_amount']) && is_numeric($_GET['d_amount'])
    ? max(0, (float)$_GET['d_amount'])
    : 0;

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
                        if($count){
                            //var_dump($akamount);
                            $akamnt = ceil((int)$akamount / $count);
                            
                        }
                        else
                        $akamnt = 0;
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
            if(count($tamount[$k])>0){
           $toFloat = function ($v) {
    $s = (string)($v ?? '0');
    $s = trim($s);
    if ($s === '') return 0.0;

    // remove common junk
    $s = str_replace([',', '₹', '%', "\n", "\r", "\t", ' '], '', $s);

    return is_numeric($s) ? (float)$s : 0.0;
};

for ($x = 0; $x < count($tamount[$k]); $x++) {

    // normalize current amount cell
    $cellAmount = $toFloat($tamount[$k][$x]);

    // normalize percentage fields (empty string => 0)
    $dcomm      = $toFloat($val['dcomm'] ?? 0);
    $dmcomm     = $toFloat($val['dmcomm'] ?? 0);
    $dhissa     = $toFloat($val['dhissa'] ?? 0);
    $tppercent  = $toFloat($val['tppercentage'] ?? 0);

    // apply commission (only if > 0)
    $totalComm = $dcomm + $dmcomm;
    if ($totalComm > 0) {
        $cellAmount -= ($cellAmount * $totalComm / 100);
    }

    // apply hissa
    if ($dhissa > 0) {
        $cellAmount -= ($cellAmount * $dhissa / 100);
    }

    // apply top percentage
    if ($tppercent > 0) {
        $cellAmount -= ($cellAmount * $tppercent / 100);
    }

    // optional safety
    if ($cellAmount < 0) $cellAmount = 0.0;

    // write back
    $tamount[$k][$x] = $cellAmount;
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
        <div class="jantri-table-wrap">
        <table class="table table-bordered table-hover jantri-grid" style="
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
                // echo '<pre>'; print_r($tnumber); echo '</pre>';
                //echo '<pre>'; print_r($table); echo '</pre>'; die;
                $ftamnt = '';
                $ttamntt = $keyy = 0;
                $roundToFifty = !empty($round_to_50);
                $kval = '';
                $rowCount = 0;
                $rowSum = 0; // Initialize variable to hold the sum of each row
                $totalSum = 0; // Initialize variable to hold the total sum across all rows
                $rowTotalCounter = 0; // Counter for row total names
                for ($i = 1; $i <= 100; $i++) {
                    // Start a new row for every 10 numbers
                    if ($rowCount % 10 == 0) {
                        echo "<tr>";
                    }
                
                    // Output the number and its corresponding amount in a box
                    //echo "<td><strong>$i</strong><br>" . $table[$i] . "</td>";
                      // Check if the value exists in $table, otherwise default to 0
                        $rawValue = isset($table[$i]) ? max(0, (float)$table[$i]) : 0;
                        if ($dAmount > 0) {
                            $rawValue = max(0, $rawValue - $dAmount);
                        }
                        if ($dPercentage > 0) {
                            $rawValue -= ($rawValue * $dPercentage / 100);
                        }
                        // Match the requested buckets: 7.888 -> 5 and 8.6 -> 10.
                        $value = jantri_round_amount($rawValue, $roundToFifty);
                     // Accumulate the row sum
                     $rowSum += $value;
    ?>
    <td>
        <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;"><?= ($i == 100) ? '00' : $i ?></span>
        <input type="text" value="<?= $value ?>" name="sr_<?= sprintf('%02d', $i) ?>" id="<?= $i ?>" style="width: 65%;" class="med">
    </td>
                    <?php
                    $rowCount++;
                
                    // Close the row after every 10 cells
                    if ($rowCount % 10 == 0) {
                        echo '<td style="text-align: center;">
                                        <span style="text-align:center;float: left;margin-right: 10px;margin-left: 5px;"></span>
                                        <input type="text" value="'.jantri_round_amount($rowSum, $roundToFifty).'" name="row_'.($rowTotalCounter).'" id="011" tabindex="011" style="width: 65%;" class="medrow" autocomplete="off">
                                    </td></tr>';
                        
                        // Add the row sum to the total sum
                        $ttamntt += jantri_round_amount($rowSum, $roundToFifty);
                        
                        // Reset the row sum for the next row
                        $rowSum = 0;
                        $rowTotalCounter++;
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
        </div>
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
<script>
document.addEventListener("DOMContentLoaded", function () {

    // get the URL parameter "date"
    const params = new URLSearchParams(window.location.search);
    let dateParam = params.get("date");

    // hide button by default
    const btn = document.getElementById("btnFetch");
    if (!btn) {
        return;
    }
    btn.style.display = "none";

    if (dateParam) {

        // convert dd-mm-yyyy → yyyy-mm-dd
        let parts = dateParam.split("-");
        if (parts.length === 3) {
            dateParam = `${parts[2]}-${parts[1]}-${parts[0]}`; 
        }

        // today's date in yyyy-mm-dd format
        const today = new Date().toISOString().split("T")[0];

        // compare
        if (dateParam === today) {
            btn.style.display = "block";  // show button
        } else {
            btn.style.display = "none";   // hide button
        }
    } else {
        // if no date param in URL, hide button
        btn.style.display = "none";
    }

});
</script>
