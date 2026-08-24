<script>
function activeTab(tab) {
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};

function insertf4tof2() {

    var tamnatt = document.getElementById('tamount').value;
    var objarrr = $('input[name="number[]"]').map(function() {
        return this.value;
    }).get();
    //console.log(tamnatt);
    //console.log(objarrr);
    var elem = document.getElementById("amnt");
    //var objarrr = obj.number.split(",");
    for (index = 0; index < objarrr.length; index++) {

        if (objarrr[index] != "") {
            //document.getElementById('addtrnheadf4').insertAdjacentHTML('afterend','<tr><td>'+objarrr[index]+'</td><td>'+elem.value+'</td></tr>');
            // console.log(objarrr[index]);
            var xTable = document.getElementById('addtrn');
            var index1 = xTable.rows.length - 1;
            var tr = xTable.insertRow(index1);
            //tr.innerHTML = '<tr><td>'+objarrr[index]+'</td><td>'+elem.value+'</td></tr>' ;
            tr.innerHTML = '<tr><th><input type="text" class="form-control" name="trn_number[]" value="' + objarrr[
                    index] +
                '" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  autocomplete="off"></th> <th><input type="text" class="form-control" value="' +
                elem.value +
                '" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" autocomplete="off"></th><td><button tabindex="-1" class="delete" onClick="$(this).parent().parent().remove();"> X </span></td></tr>';
        }

    }
    //alert(parseInt(tamnatt)); 
    document.getElementById('gtotal').innerHTML = tamnatt + '<tr><th><input type="hidden" name="randf4amount" value="' +
        elem.value + '"></th></tr>';
    var oldval = document.getElementById('ttamntt').value;
    document.getElementById('ttamntt').value= parseInt(oldval)+parseInt(tamnatt);
    $('input[name="number[]"]').val('');
    $('input[name="randf4amountold"]').val('');
    activeTab('home');


    return false;
}

function numtoarr(number) {
    //var number = 12354987,
    output = [],
        sNumber = number.toString();

    for (var i = 0, len = sNumber.length; i < len; i += 1) {
        output.push(+sNumber.charAt(i));
    }
    return output;
}

function permutations(array1, array2) {
    //console.log(array1);console.log(array2); return;
    combos = [] //or combos = new Array(2);

    for (var i = 0; i < array1.length; i++) {
        for (var j = 0; j < array2.length; j++) {
            //you would access the element of the array as array1[i] and array2[j]
            //create and array with as many elements as the number of arrays you are to combine
            //add them in
            //you could have as many dimensions as you need
            //console.log("" +array1[i]+array2[j])      
            combos.push("" + array1[i] + array2[j])
        }
    }
    return combos;
}

function crtof8() {

    var dararate = document.getElementById('dara_f8').value;
    var daraamnt = document.getElementById('dara_amount_f8').value;
    var dararatearr = dararate.split(' ');
    for (var i = 0; i < dararatearr.length; i++) {
        //  console.log('<tr><td>'+trn_idarrr[i]+'</td><td>'+trn_amnt+'</td></tr>');
        //document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>'+dararatearr[i]+'</td><td>'+daraamnt+'</td></tr>');
        var xTable = document.getElementById('addtrn');
        var index1 = xTable.rows.length - 1;
        var tr = xTable.insertRow(index1);
        tr.innerHTML = '<tr><th><input type="text" class="form-control" name="trn_number[]" value="' + dararatearr[i] +
            '" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  autocomplete="off" ></th> <th><input type="text" class="form-control" value="' +
            daraamnt +
            '" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" autocomplete="off" ></th><td><span class="delete" onClick="$(this).parent().parent().remove();"> X </span></td></tr>';

    }
    var amount_akahr_andar_f8 = document.getElementById('amount_akahr_andar_f8').value;
    var amount_akahr_bahar_f8 = document.getElementById('amount_akahr_bahar_f8').value;
    var akahr_andar_f8 = numtoarr(document.getElementById('akahr_andar_f8').value);
    var akhar_bahar_f8 = numtoarr(document.getElementById('akhar_bahar_f8').value);
    for (var i = 0; i < akahr_andar_f8.length; i++) {
        //akhr_ander_str = "" +akahr_andar_f8[i] + akahr_andar_f8[i];
        //  console.log('<tr><td>'+trn_idarrr[i]+'</td><td>'+trn_amnt+'</td></tr>');
        //document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>' +"" +akahr_andar_f8[i]+akahr_andar_f8[i]+akahr_andar_f8[i]+akahr_andar_f8[i]+'</td><td>'+amount_akahr_andar_f8+'</td></tr>');
        var xTable = document.getElementById('addtrn');
        var index1 = xTable.rows.length - 1;
        var tr = xTable.insertRow(index1);
        tr.innerHTML = '<tr><th><input type="text" class="form-control" name="trn_number[]" value="' + akahr_andar_f8[
            i] + akahr_andar_f8[i] + akahr_andar_f8[i] + akahr_andar_f8[i] +
            '" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  autocomplete="off"></th> <th><input type="text" class="form-control" value="' +
            amount_akahr_andar_f8 +
            '" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" autocomplete="off"></th><td><span class="delete" onClick="$(this).parent().parent().remove();"> X </span></td></tr>';

    }
    for (var i = 0; i < akhar_bahar_f8.length; i++) {
        //akhr_ander_str = "" +akahr_andar_f8[i] + akahr_andar_f8[i];
        //  console.log('<tr><td>'+trn_idarrr[i]+'</td><td>'+trn_amnt+'</td></tr>');
        //document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>' +"" +akhar_bahar_f8[i]+akhar_bahar_f8[i]+akhar_bahar_f8[i]+'</td><td>'+amount_akahr_bahar_f8+'</td></tr>');
        var xTable = document.getElementById('addtrn');
        var index1 = xTable.rows.length - 1;
        var tr = xTable.insertRow(index1);
        tr.innerHTML = '<tr><th><input type="text" class="form-control" name="trn_number[]" value="' + akhar_bahar_f8[
            i] + akhar_bahar_f8[i] + akhar_bahar_f8[i] +
            '" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  autocomplete="off"></th> <th><input type="text" class="form-control" value="' +
            amount_akahr_bahar_f8 +
            '" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" autocomplete="off"></th><td><span class="delete" onClick="$(this).parent().parent().remove();"> X </span></td></tr>';
    }


    var oldval = document.getElementById('ttamntt').value;
    document.getElementById('ttamntt').value= parseInt(oldval)+parseInt(document.getElementById('f8_amount').textContent);
    //alert(parseInt(tamnatt));
    //document.getElementById('gtotal').innerHTML = tamnatt;
    activeTab('home');


    return false;
}

function crtof7() {

    var fromfrom = document.getElementById('fromto_from').value;
    var frmto = document.getElementById('fromto_to').value;
    var frmamnt = document.getElementById('fromto_amount').value;

    for (var i = fromfrom; i <= frmto; i++) {
        var xTable = document.getElementById('addtrn');
        var index1 = xTable.rows.length - 1;
        var tr = xTable.insertRow(index1);
        tr.innerHTML = '<tr><th><input type="text" class="form-control" name="trn_number[]" value="' + i +
            '" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  autocomplete="off"></th> <th><input type="text" class="form-control" value="' +
            frmamnt +
            '" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" autocomplete="off"></th><td><span class="delete" onClick="$(this).parent().parent().remove();"> X </span></td></tr>';

    }
    //alert(parseInt(tamnatt));
    //document.getElementById('gtotal').innerHTML = tamnatt;
    var oldval = document.getElementById('ttamntt').value;
    document.getElementById('ttamntt').value= parseInt(oldval)+parseInt(document.getElementById('fromto_total_amount').textContent);
    activeTab('home');


    return false;
}
function test_same_digit(N) {
	return /^\D*(\d)(?:\D*|\1)*$/.test(N);
}
function crtof2() {

    var cander = numtoarr(document.getElementById('crossander').value);
    var cbahar = numtoarr(document.getElementById('crossbahar').value);
	var joda = document.getElementById('joda').value;
	//console.log(joda)
    var cramnt = document.getElementById('amntt').value;
    var perm = permutations(cander, cbahar);
    for (var i = 0; i < perm.length; i++) {
		if(joda == 'Y'){
			 var xTable = document.getElementById('addtrn');
        var index1 = xTable.rows.length - 1;
        var tr = xTable.insertRow(index1);
        //tr.innerHTML = '<tr><td>'+objarrr[index]+'</td><td>'+elem.value+'</td></tr>' ;
        tr.innerHTML = '<tr><th><input type="text" class="form-control" name="trn_number[]" value="' + perm[i] +
            '" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" autocomplete="off" ></th> <th><input type="text" class="form-control" value="' +
            cramnt +
            '" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" autocomplete="off" ></th><td><span class="delete" onClick="$(this).parent().parent().remove();"> X </span></td></tr>';
        // document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>'+perm[i]+'</td><td>'+cramnt+'</td></tr>');
        // ttamnt = parseInt(ttamnt) + parseInt(cramnt);
		}
		else{
			var njoda = test_same_digit(perm[i]);
			if(!njoda){
			 var xTable = document.getElementById('addtrn');
        var index1 = xTable.rows.length - 1;
        var tr = xTable.insertRow(index1);
        //tr.innerHTML = '<tr><td>'+objarrr[index]+'</td><td>'+elem.value+'</td></tr>' ;
        tr.innerHTML = '<tr><th><input type="text" class="form-control" name="trn_number[]" value="' + perm[i] +
            '" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" autocomplete="off" ></th> <th><input type="text" class="form-control" value="' +
            cramnt +
            '" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" autocomplete="off" ></th><td><span class="delete" onClick="$(this).parent().parent().remove();"> X </span></td></tr>';
        // document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>'+perm[i]+'</td><td>'+cramnt+'</td></tr>');
        // ttamnt = parseInt(ttamnt) + parseInt(cramnt);
		}
		}
    }


    var xTable = document.getElementById('addtrn');
    var index1 = xTable.rows.length - 1;
    var tr = xTable.insertRow(index1);
    //tr.innerHTML = '<tr><td>'+objarrr[index]+'</td><td>'+elem.value+'</td></tr>' ;
    tr.innerHTML = '<input type="hidden" class="form-control" name="ander" value="' + document.getElementById(
            'crossander').value +
        '" ><input type="hidden" class="form-control" value="' +
        document.getElementById('crossbahar').value +
        '" name="bahar" ><input type="hidden" class="form-control" value="' +
        cramnt + '" name="total_amount_cross" >';

    //alert(parseInt(tamnatt));
    //document.getElementById('gtotal').innerHTML = tamnatt;
    //console.log(document.getElementById('tamnt').textContent);
    //return false;
    var oldval = document.getElementById('ttamntt').value;
    document.getElementById('ttamntt').value= parseInt(oldval)+parseInt(document.getElementById('tamnt').textContent);
    $('tbody#addtrn tr:last td:first input').focus();
    activeTab('home');
    $('tbody#addtrn tr:last td:first input').focus();
    //document.getElementById("lastrn").focus();
    
  
    //return false;
}
</script>
<div class="">
    <div class="clearfix"></div>
    <form id="demo-form2" method="post" action="/tbl_transactions/edit_transaction_final/<?=$tbl_transactions[0]['id']?>" data-parsley-validate
        class="form-horizontal form-label-left" onsubmit="checkFields(event)">

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2 style="text-decoration:underline;"><b>Live Transactions</b></h2>
                        <ul class="nav navbar-right panel_toolbox">
                            <li>
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul>
                        <div class="nav navbar-right panel_toolbox">
                            <div class="form-group pull-right top_search">
                                <div class="input-group">
                                    <h2 style="margin-right:10px;"><b>Date</b></h2>
                                    <input  name="dateoftrnval" value="<?=date('d-m-Y',strtotime($tbl_transactions[0]['t_date']))?>" class=" form-control" type="text"
                                        autocomplete="off" disabled>
                                        <input type="hidden" id="birthdayy" name="dateoftrn" value="<?=date('d-m-Y',strtotime($tbl_transactions[0]['t_date']))?>">
                                    <div class="alert" style="display:none">Please Select Shift First</div>
                                </div>
                            </div>
                        </div>
                        <div class="nav navbar-left panel_toolbox">
                            <h2 style="margin-right:10px;"><b>Shift</b></h2>
                            <!-- Split button -->
                            <div class="btn-group" style="height: 36px; margin-right: 10px;">
                                <input type="text" name="shift_name_val" value="<?php echo ($this->input->post('shift_name') ? $this->input->post('shift_name') : $tbl_transactions[0]['shift_name']); ?>" class="form-control" id="ledger_name" readonly/>
                                <input type="hidden" name="shift" value="<?php echo ($this->input->post('shift_name') ? $this->input->post('shift_name') : $tbl_transactions[0]['shiftid']); ?>" class="form-control" id="shift" />    
                            </div>
                            <h2 style="margin-right:10px;"><b>Party</b></h2>
                            <div class="btn-group" style="height: 36px; margin-right: 10px;">
                            <input type="text" name="ledger_name_val" value="<?php echo ($this->input->post('ledger_name') ? $this->input->post('ledger_name') : $tbl_transactions[0]['ledger_name']); ?>" class="form-control" id="ledger_name" readonly/>
                            <input type="hidden" name="party" value="<?php echo ($this->input->post('ledger_name') ? $this->input->post('ledger_name') : $tbl_transactions[0]['ledgerid']); ?>" class="form-control" id="party"/>
                            </div>
                        
                        </div>


                        <div class="clearfix"></div>
                        <div class="col-md-12 col-sm-12  ">
                            <div class="x_content">
                                <?php  if($this->session->flashdata('message')){ ?>
                                <div class="alert alert-success " role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                            aria-hidden="true">×</span>
                                    </button>
                                    <strong><?php echo @$this->session->flashdata('message');?></strong>
                                </div>
                                <?php 
                            unset($_SESSION['message']);
                            }?>
                                <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                            role="tab" aria-controls="home" aria-selected="true">Add(F2)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                            role="tab" aria-controls="profile" aria-selected="false">Random(F4)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="cross-tab" data-toggle="tab" href="#cross" role="tab"
                                            aria-controls="cross" aria-selected="false">Cross</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="From-To-tab" data-toggle="tab" href="#From-To"
                                            role="tab" aria-controls="From-To" aria-selected="false">From-To(F7)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="Random-tab" data-toggle="tab" href="#Random" role="tab"
                                            aria-controls="Random" aria-selected="false">Random(F8)</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="jantri" onclick="calljantri()" href="#" role="tab"
                                            aria-controls="Random" aria-selected="false">Jantri</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel"
                                        aria-labelledby="home-tab">
                                        <h2 style="text-decoration:underline;"><b>Party</b></h2>
                                        <div class="x_content" style="background-color: #ededed;">
                                            <br>
                                            <?php /* ?><div class="col-md-4 col-sm-12" style="margin-top:20px;">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="x_panel" style="max-height: 263px;">
                                                        <div class="x_content">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <h2 style="text-decoration:underline;"><b>Whatsapp
                                                                            Number Entry</b></h2>
                                                                    <textarea name="bulkins" id="bulkins"
                                                                        onkeyup="enablewassap()"></textarea>
                                                                    <input type="button" id="bulkinsbtn" name="insert"
                                                                        value="insert" onclick="return bulkinss()"
                                                                        autocomplete="off" disabled>
                                                                    <table id="datatable"
                                                                        class="table table-striped table-bordered"
                                                                        style="width:100%">
                                                                        <tbody>
                                                                            <tr>

                                                                            </tr>
                                                                            <tr>

                                                                            </tr>
                                                                            <tr>

                                                                            </tr>
                                                                            <tr></tr>
                                                                            <!--<tr style="font-size:17px; text-align:center;">
                                                                                            <th>Total Amount: <span id="tf2amt" style="color:#000">0</span></th>
                                                                                        </tr>-->
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                              
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> <?php */ ?>
                                            <?php 
                                            $trno = explode(',',$tbl_transactions[0]['trnno']);
                                            $trn_amt = explode(',',$tbl_transactions[0]['trn_amt']);
                                            ?>
                                            <div class="col-md-7 col-sm-12" style="margin-top:20px;">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="x_panel" style="height: 394px;">
                                                        <div class="x_content">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <table id="datatable"
                                                                        class="table table-striped table-bordered"
                                                                        style="width:100%">
                                                                        <!--<tr>
                                                                                            <h2 style="text-decoration:underline;"><b>Whatsapp Number Entry</b></h2>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <textarea name="bulkins" id="bulkins" onkeyup="enablewassap()"></textarea>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <input type="button" id="bulkinsbtn" name="insert" value="insert" onclick="return bulkinss()" disabled>
                                                                                        </tr>
                                                                                        <tr></tr>-->
                                                                        <tbody>
                                                                            <tr
                                                                                style="font-size:17px; text-align:center;">
                                                                                <th>Total Amount: <span id="tf2amt"
                                                                                        style="color:#000"><input
                                                                                            type="text" name="ttamntt"
                                                                                            value="<?=array_sum($trn_amt)?>" id="ttamntt"
                                                                                            readonly style="background: #eee;border: none;"></span></th>
                                                                            <th><input class="btn btn-success" style="float:right" type="submit" name="submit" value="submit" autocomplete="off"></th>
																			</tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <div class="card-box table-responsive"
                                                                        style="max-height: 220px;">

                                                                        <input type="hidden" name="is_filled"
                                                                            id="is_filled1" value="" autocomplete="off">
                                                                        <input type="hidden" name="last_id1"
                                                                            id="last_id1" value="" autocomplete="off">
                                                                        <table id="addtrn">                                                                            
                                                                            <thead>
                                                                                <?php 
                                                                                
                                                                                for($i=0; $i<count($trno); $i++){ ?>
                                                                                <tr>

                                                                                    <th><input type="text" value="<?=$trno[$i]?>" class="form-control" name="trn_number[]" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  autocomplete="off"></th>
                                                                                    <th><input type="text" value="<?=$trn_amt[$i]?>" class="form-control" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" autocomplete="off"></th>
                                                                                    <td><span class="delete" onClick="$(this).parent().parent().remove();"> X </span></td>
                                                                                </tr>
                                                                                <?php } ?>
                                                                                <tr><th><input type="text" class="form-control" name="trn_number[]" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  autofocus></th> <th><input type="text" class="form-control" name="trn_amount[]" trn_amount[] placeholder="Amount" ></th></tr>
                                                                            </thead>
                                                                        </table>
                                                                        <!--</form>-->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--<div class="col-md-4 col-sm-12">
                                                                <div class="tile_count">
                                                                    <div class="x_panel" style="border:none;">
                                                                        <div class="x_content">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <h2 style="text-decoration:underline;"><b class="shift_day">DL</b></h2>
                                                                                    <table class="table">
                                                                                        <tbody><tr style="background-color: #ededed;">
                                                                                            <th>Applied Narration</th>
                                                                                        </tr>
                                                                                        </tbody></table><table id="showaddtrn" style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;" border="1">
                                                                                            <tbody>
                                                                                                <tr id="addtrnhead">
                                                                                                    <td>Number</td>
                                                                                                    <td>Amount</td>
                                                                                                </tr>
                                                                                             </tbody>
                                                                                        </table>
                                                                                    
                                                                                    <table class="table" style="margin-top:184px;">
                                                                                        <tbody><tr style="background-color: #ededed;">
                                                                                            <th>Grand Total: <span id="gtotalf2"></span></th>
                                                                                        </tr>
                                                                                    </tbody></table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>-->
                                            <!--<div class="col-md-6 col-sm-12">
                                                                <div class="tile_count">
                                                                    <div class="x_panel" style="border:none;">
                                                                        <div class="x_content">
                                                                            <div class="row">

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>-->
                                            <script type="text/javascript">
                                            function enablewassap() {
                                                var vall = document.getElementById('bulkins').value;
                                                if (vall) {
                                                    document.getElementById("bulkinsbtn").disabled = false;
                                                }
                                                //if();
                                            }

                                            function bulkinss() {
                                                var bval = document.getElementById('bulkins').value;

                                                const numberList = (bval
                                                        .split(
                                                            /\-\d+/
                                                            ) // - split at "'$' followed by one or more numbers".
                                                        .join('') // - join array of split results into string again.
                                                        .match(/\d+/g) || []
                                                    ) // - match any number-sequence or fall back to empty array.
                                                    .map(str => +str); // - typecast string into number.
                                                //.map(str => parseInt(str, 10)); // parse string into integer.
                                                var elem = document.getElementById
                                                console.log('numberList : ', numberList);
                                                document.getElementById("addtrn").deleteRow(0);
                                                var ttotal = 0;
                                                for (var i = 0; i < numberList.length; i = i + 2) {
                                                    var newRow = document.getElementById('addtrn').insertRow();
                                                    newRow.innerHTML =
                                                        '<tr><th><input type="text" class="form-control" name="trn_number[]" value="' +
                                                        numberList[i] +
                                                        '" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" ></th> <th><input type="text" class="form-control" value="' +
                                                        numberList[i + 1] +
                                                        '" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" ></th><td><span class="delete" onClick="$(this).parent().parent().remove();"> X </span></td></tr>';
                                                    console.log(numberList[i]);
                                                    //.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" name="trn_number[]" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" ></th> <th><input type="text" class="form-control" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" ></th></tr>');
                                                    ttotal = ttotal+ numberList[i + 1];
                                                }
                                                var oldval =  document.getElementById('ttamntt').value;
                                                document.getElementById('ttamntt').value = parseInt(oldval)+parseInt(ttotal);
                                                var newRow = document.getElementById('addtrn').insertRow();
                                                newRow.innerHTML =
                                                    '<tr> <th><input type="text" class="form-control" name="trn_number[]" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  autocomplete="off"></th><th><input type="text" class="form-control" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" autocomplete="off"></th></tr>';
                                                //  document.getElementById('addtrnhead').insertAdjacentHTML('afterend',
                                                //    document.getElementById('addtrn').innerHTML);
                                                //  var matches = bval.match(/\((.*?)\)/);
                                                /*	 var regExp = /^[^-]*[^ -]a/g;
                                                                         let regex = /^\d0-\(10\),$/i;
                                            console.log( regex.test(bval));
                                        var matches = bval.split("-");
                                        //console.log(matches);
                                        for (var i = 0; i < matches.length; i++) {
                                            var str = matches[i];
                                           console.log(str.substring(1, str.length - 1));
                                        }

                                                                         var regExp = /\(([^)]+)\)/g;
                                        var matches = bval.match(regExp);
                                        for (var i = 0; i < matches.length; i++) {
                                            var str = matches[i];
                                           // console.log(str.substring(1, str.length - 1));
                                        } */
                                        document.getElementById('bulkins').value = '';
                                            }
                                            </script>
                                            <!--<div class="col-md-3 col-sm-12">
                                                                <div class="tile_count">
                                                                    <div class="x_panel" style="border:none;">
                                                                        <div class="x_content">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <h2 style="text-decoration:underline;"><b class="shift_day">PUNJAB DAY [Live]</b></h2>
                                                                                    <table class="table">
                                                                                        <tr style="background-color: #ededed;">
                                                                                            <th>Applied Narration</th>
                                                                                        </tr>
                                                                                        <table id="showaddtrn" style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;" border="1">
                                                                                            <tbody>
                                                                                                <tr id="addtrnhead">
                                                                                                    <td>Number</td>
                                                                                                    <td>Amount</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                         
                                                                                    </table>
                                                                                    <table class="table" style="margin-top:184px;">
                                                                                        <tr style="background-color: #ededed;">
                                                                                            <th>Grand Total: <span id="gtotalf2"></span></th>
                                                                                        </tr>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>-->
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel"
                                        aria-labelledby="profile-tab">
                                        <h2 style="text-decoration:underline;"><b>Random</b></h2>
                                        <div class="x_content">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="card-box table-responsive"
                                                        style="background-color: #ededed;">
                                                        <div class="col-md-8 col-sm-12 x_panel"
                                                            style="margin-top:20px;margin-left: 12px;padding-left: 0px;width: 65%;">
                                                            <?php if($this->session->flashdata('msg')): ?>
                                                            <p class="flsh button-success">
                                                                <?php echo $this->session->flashdata('msg'); ?></p>
                                                            <?php endif; ?>
                                                            <input type="hidden" name="is_filled" id="is_filled2"
                                                                value="">
                                                            <!-- <form id="demo-form2" method="post" action="add_randomf4" data-parsley-validate class="form-horizontal form-label-left">-->
                                                            <div class="item form-group" style="margin-top:30px;">
                                                                <label
                                                                    class="col-form-label col-md-3 col-sm-3 label-align"
                                                                    for="first-name">
                                                                    Number<span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 ">
                                                                    <input type="text" name="number[]"
                                                                        oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                        maxlength="2" id="first-name"
                                                                        onchange="addrandomf4(this)"
                                                                        class="form-control randomf4">
                                                                </div>
                                                            </div>
                                                            <div class="item form-group">
                                                                <label
                                                                    class="col-form-label col-md-3 col-sm-3 label-align"
                                                                    for="last-name">
                                                                    Amount <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 ">
                                                                    <input type="number" id="amnt"
                                                                        name="randf4amountold"
                                                                        onchange="insertrandomf4(this)"
                                                                        onkeyup="calcf4(this)" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="item form-group">
                                                                <label
                                                                    class="col-form-label col-md-3 col-sm-3 label-align"
                                                                    for="last-name">
                                                                    Total Amount <span class="required">*</span>
                                                                </label>
                                                                <div class="col-md-6 col-sm-6 ">
                                                                    <input type="text" id="tamount" name="tamount"
                                                                        class="form-control" readonly>
                                                                    <input type="hidden" id="thamount" name="thamount">
                                                                </div>

                                                            </div>
                                                            <div class="item form-group">
                                                                <label
                                                                    class="col-form-label col-md-3 col-sm-3 label-align"
                                                                    for="last-name">

                                                                </label>
                                                                <div class="col-md-6 col-sm-6 ">
                                                                    <input type="button" value="Save" name="save_f4"
                                                                        onclick="insertf4tof2()">
                                                                </div>

                                                            </div>

                                                            <div class="ln_solid"></div>
                                                            <!--<div class="item form-group">
                                             <div class="col-md-6 col-sm-6 offset-md-3" >
                                                <button class="btn btn-primary" type="submit" style="padding: 0.375rem 2.75rem; ">Save</button>
                                                <button type="button" class="btn btn-success" style="padding: 0.375rem 2.75rem; ">Cancel</button>
                                             </div>
                                          </div>-->
                                                            <!--</form>-->
                                                        </div>

                                                        <div class="col-md-4 col-sm-12">
                                                            <div class="tile_count">
                                                                <div class="x_panel" style="border:none;">
                                                                    <div class="x_content">
                                                                        <div class="row">
                                                                            <div class="col-sm-12">
                                                                                <h2 style="text-decoration:underline;">
                                                                                    <b class="shift_day">PUNJAB DAY
                                                                                        [Live]</b>
                                                                                </h2>
                                                                                <table class="table">
                                                                                    <tr
                                                                                        style="background-color: #ededed;">
                                                                                        <th>Applied Narration</th>
                                                                                    </tr>
                                                                                    <table id="showaddtrn"
                                                                                        style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;"
                                                                                        border="1">
                                                                                        <tbody>
                                                                                            <tr id="addtrnheadf4">
                                                                                                <td>Number</td>
                                                                                                <td>Amount</td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <!-- DivTable.com -->
                                                                                </table>
                                                                                <table class="table"
                                                                                    style="margin-top:184px;">
                                                                                    <tr
                                                                                        style="background-color: #ededed;">
                                                                                        <th>Grand Total: <span
                                                                                                id="gtotal">0</span>
                                                                                        </th>
                                                                                    </tr>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="cross" role="tabpanel" aria-labelledby="cross-tab">
                                        <div class="x_content">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="x_panel" style="margin-top:13px;">
                                                        <h2 style="text-decoration:underline;"><b>Cross</b></h2>
                                                        <div class="x_content">
                                                            <div class="x_content" style="background-color: #ededed;">
                                                                <div class="row">
                                                                    <div class="col-md-8 col-sm-12 x_panel">
                                                                        <div class="card-box table-responsive">
                                                                            <?php if($this->session->flashdata('msg')): ?>
                                                                            <p class="flsh button-success">
                                                                                <?php echo $this->session->flashdata('msg'); ?>
                                                                            </p>
                                                                            <?php endif; ?>
                                                                            <input type="hidden" name="is_filled"
                                                                                id="is_filled3" value="">
                                                                            <!--<form action="add_cross" method="post" >-->
                                                                            <table id="datatable"
                                                                                class="table table-striped table-bordered"
                                                                                style="font-size: 12px; width: 99%; margin-bottom: 0rem; background-color: #ededed; ">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <label>ANDER</label>
                                                                                            <input type="text"
                                                                                                onchange="checkcross()"
                                                                                                maxLength='10'
                                                                                                id="crossander"
                                                                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                                                class="form-control"
                                                                                                placeholder="Ander"
                                                                                                name="ander">
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <label> BAHAR</label>
                                                                                            <input type="text"
                                                                                                onchange="checkcross()"
                                                                                                maxLength='10'
                                                                                                id="crossbahar"
                                                                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                                                class="form-control"
                                                                                                name="bahar"
                                                                                                placeholder="Bahar">
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <label> AMOUNT </label>
                                                                                            <input type="text"
                                                                                                name="amount"
                                                                                                onchange="checkcross()"
                                                                                                id="amntt"
                                                                                                class="form-control"
                                                                                                placeholder="AMT">
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <label>JODA</label>
                                                                                            <select name="joda"
                                                                                                id="joda"
                                                                                                onchange="checkcross()"
                                                                                                class="form-control">
                                                                                                <option value=""
                                                                                                    selected>--Please
                                                                                                    Select--</option>
                                                                                                <option value="Y">Y
                                                                                                </option>
                                                                                                <option value="N">N
                                                                                                </option>
                                                                                            </select>
                                                                                        </th>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <th>
                                                                                            <input type="button"
                                                                                                name="crsave"
                                                                                                value="Save"
                                                                                                onClick="crtof2()">
                                                                                        </th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                            <p style="font-size:17px;margin-top:19px;">
                                                                                <b>Total Cross Count: <span
                                                                                        id="tcc">0</span></b>
                                                                            </p>
                                                                            <p style="font-size:17px;margin-top:19px;">
                                                                                <b>Total Amount: <span
                                                                                        id="tamnt">0</span></b>
                                                                            </p>
                                                                            <input type="hidden"
                                                                                name="total_amount_cross"
                                                                                id="total_amount_cross" value="">
                                                                            <input type="hidden" name="cross_count"
                                                                                id="cross_count" value="">
                                                                            <!--<div class="col-md-6 col-sm-6 offset-md-3" style="margin-left:3px;">
                                                         <button class="btn btn-primary" type="submit" style="padding: 0.375rem 2.75rem; ">Save</button>
                                                         <button type="submit" class="btn btn-success" style="padding: 0.375rem 2.75rem; ">Cancel</button>
                                                      </div>-->
                                                                            <!-- </form>-->
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-4 col-sm-12">
                                                                        <div class="tile_count">
                                                                            <div class="x_panel"
                                                                                style="border: none; height:423px;">
                                                                                <div class="x_content">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">

                                                                                            <h2
                                                                                                style="text-decoration:underline;">
                                                                                                <b>PUNJAB DAY [Live]</b>
                                                                                            </h2>

                                                                                            <table class="table">


                                                                                                <tbody>
                                                                                                    <tr
                                                                                                        style="background-color: #ededed;">
                                                                                                        <th>Applied
                                                                                                            Narration
                                                                                                        </th>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                            <table id="showaddcross"
                                                                                                style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;"
                                                                                                border="1">
                                                                                                <tbody>
                                                                                                    <tr
                                                                                                        id="addtrnheadcross">
                                                                                                        <td>Number</td>
                                                                                                        <td>Amount</td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                            <table class="table"
                                                                                                style="margin-top:184px;">


                                                                                                <tbody>
                                                                                                    <tr
                                                                                                        style="background-color: #ededed;">
                                                                                                        <th>Grand Total:
                                                                                                            0</th>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>
                                                                                        </div>
                                                                                    </div>


                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="From-To" role="tabpanel"
                                        aria-labelledby="From-To-tab">
                                        <div class="x_content">
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 ">
                                                    <div class="x_panel">
                                                        <h2 style="text-decoration:underline;"><b>From-To</b></h2>
                                                        <div class="x_content">
                                                            <div class="x_content" style="background-color: #ededed;">
                                                                <div class="col-md-8 col-sm-12 x_panel">
                                                                    <div class="card-box table-responsive">
                                                                        <?php if($this->session->flashdata('msg')): ?>
                                                                        <p class="flsh button-success">
                                                                            <?php echo $this->session->flashdata('msg'); ?>
                                                                        </p>
                                                                        <?php endif; ?>
                                                                        <input type="hidden" name="is_filled"
                                                                            id="is_filled4" value="">
                                                                        <!--<form name="trans_fromto" action="add_fromto" method="post">-->
                                                                        <table id="datatable"
                                                                            class="table table-striped table-bordered"
                                                                            style="font-size: 12px; width: 99%; margin-bottom: 0rem; background-color: #ededed; ">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th>
                                                                                        <label>From</label>
                                                                                        <input type="number"
                                                                                            onkeyup="calcfromto()"
                                                                                            onchange="addfromto()"
                                                                                            maxLength='3'
                                                                                            id="fromto_from"
                                                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                                            class="form-control"
                                                                                            name="fromto_from"
                                                                                            placeholder="From">
                                                                                    </th>
                                                                                    <th>
                                                                                        <label> To</label>
                                                                                        <input type="number"
                                                                                            onkeyup="calcfromto()"
                                                                                            onchange="addfromto()"
                                                                                            maxLength='3' id="fromto_to"
                                                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                                                            class="form-control"
                                                                                            name="fromto_to"
                                                                                            placeholder="To">
                                                                                    </th>
                                                                                    <th>
                                                                                        <label> Amount</label>
                                                                                        <input type="text"
                                                                                            onkeyup="calcfromto()"
                                                                                            onchange="addfromto()"
                                                                                            class="form-control"
                                                                                            id="fromto_amount"
                                                                                            name="fromto_amount"
                                                                                            placeholder="Amount">
                                                                                    </th>
                                                                                </tr>
                                                                            </thead>
                                                                        </table>
                                                                        <p
                                                                            style="font-size:17px;margin-top:19px;float: left;">
                                                                            <b>Total Amount: <span
                                                                                    id="fromto_total_amount">0</span></b>
                                                                        </p>
                                                                        <p
                                                                            style="font-size:17px;margin-top:19px;float: right;">
                                                                            <input type="button" name="save"
                                                                                value="Save" onclick="crtof7()">
                                                                        </p>
                                                                        <input type="hidden" name="total_amount_fromto"
                                                                            id="total_amount_fromto" value="">
                                                                        <!--<div class="col-md-6 col-sm-6 offset-md-3" style="margin-left:3px;">
                                                         <button class="btn btn-primary" type="submit" style="padding: 0.375rem 2.75rem; ">Save</button>
                                                         <button type="submit" class="btn btn-success" style="padding: 0.375rem 2.75rem; ">Cancel</button>
                                                      </div>-->
                                                                        <!--</form>-->
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 col-sm-12">
                                                                    <div class="tile_count">
                                                                        <div class="x_panel"
                                                                            style="border: none; height:354px;">
                                                                            <div class="x_content">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">

                                                                                        <h2
                                                                                            style="text-decoration:underline;">
                                                                                            <b>PUNJAB DAY [Live]</b>
                                                                                        </h2>

                                                                                        <table class="table">


                                                                                            <tbody>
                                                                                                <tr
                                                                                                    style="background-color: #ededed;">
                                                                                                    <th>Applied
                                                                                                        Narration</th>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <table id="showaddfromto"
                                                                                            style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;"
                                                                                            border="1">
                                                                                            <tbody>
                                                                                                <tr
                                                                                                    id="addtrnheadfromto">
                                                                                                    <td>Number</td>
                                                                                                    <td>Amount</td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <table class="table"
                                                                                            style="margin-top:184px;">


                                                                                            <tbody>
                                                                                                <tr
                                                                                                    style="background-color: #ededed;">
                                                                                                    <th>Grand Total: 0
                                                                                                    </th>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="Random" role="tabpanel" aria-labelledby="Random-tab">
                                        <h2 style="text-decoration:underline;"><b>Random</b></h2>
                                        <div class="x_content">
                                            <div class="x_content" style="background-color: #ededed;">
                                                <div class="col-md-8 col-sm-12 x_panel" style=" margin-top: 19px; ">
                                                    <?php if($this->session->flashdata('msg')): ?>
                                                    <p class="flsh button-success">
                                                        <?php echo $this->session->flashdata('msg'); ?></p>
                                                    <?php endif; ?>
                                                    <input type="hidden" name="is_filled" id="is_filled5" value="">
                                                    <!--<form class="" action="random_f8" method="post" novalidate>-->
                                                    <p style="font-size:14px;">
                                                        <b> NOTE:</b> Dara number should be 2 digit without any
                                                        separator.
                                                    </p>
                                                    <p style="font-size:14px;margin-bottom:28px;">
                                                        <b> NOTE:</b> Akhar number should be 1 digit without any
                                                        separator.
                                                    </p>
                                                    <div class="col-md-6 col-sm-12  form-group">
                                                        <label>
                                                            Dara <span class="required">*</span>
                                                        </label>
                                                        <textarea onkeyup="daraspacef8()" onchange="adddaraspacef8()"
                                                            id="dara_f8" name="dara_f8"
                                                            placeholder="Number, EG 01 And 09 Like 0189"></textarea>
                                                        <!--<input type="text" class="form-control" onkeyup="daraspacef8()" onchange="adddaraspacef8()"  id="dara_f8" name="dara_f8" placeholder="Number, EG 01 And 09 Like 0189"> -->
                                                    </div>
                                                    <div class="col-md-3 col-sm-12  form-group">
                                                        <label>
                                                            Amount<span class="required">*</span>
                                                        </label>
                                                        <label style="float:right;">
                                                            <span id="amount_dara"></span>
                                                        </label>
                                                        <input onkeyup="daraspacef8()" type="number"
                                                            onchange="adddaraspacef8()" maxlength="10"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            name="dara_amount_f8" id="dara_amount_f8"
                                                            class="form-control" placeholder="Amount">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12  form-group">
                                                        <label>
                                                            Akhar Bahar <span class="required">*</span>
                                                        </label>
                                                        <input onkeyup="akahr_bahar_f8()" type="number"
                                                            onchange="adddaraspacef8()" maxlength="10"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            name="akhar_bahar_f8" id="akhar_bahar_f8"
                                                            class="form-control" placeholder="Number,EG: 1 And 2 Like 12
                                             ">
                                                    </div>
                                                    <div class="col-md-3 col-sm-12  form-group">
                                                        <label>
                                                            Amount <span class="required">*</span>
                                                        </label>
                                                        <label style="float:right;">
                                                            <span id="akbahar_dara"></span>
                                                        </label>
                                                        <input onkeyup="akahr_bahar_f8()" onchange="adddaraspacef8()"
                                                            type="text" name="amount_akahr_bahar_f8"
                                                            id="amount_akahr_bahar_f8" class="form-control"
                                                            placeholder="Amount">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12  form-group">
                                                        <label>
                                                            Akhar Andar <span class="required">*</span>
                                                        </label>
                                                        <input onkeyup="calc_akahr_andar_f8()"
                                                            onchange="adddaraspacef8()" id="akahr_andar_f8"
                                                            name="akahr_andar_f8" type="number" maxlength="10"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            class="form-control"
                                                            placeholder="Numbers, EG: 1 And 2 Like 12">
                                                    </div>
                                                    <div class="col-md-3 col-sm-12  form-group">
                                                        <label>
                                                            Amount <span class="required">*</span>
                                                        </label>
                                                        <label style="float:right;">
                                                            <span id="akandar_dara"></span>
                                                        </label>
                                                        <input onkeyup="calc_akahr_andar_f8()"
                                                            onchange="adddaraspacef8()" id="amount_akahr_andar_f8"
                                                            name="amount_akahr_andar_f8" type="number" maxlength="10"
                                                            oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                                                            class="form-control" placeholder="Amount">
                                                    </div>
                                                    <div class="col-md-6 col-sm-12  form-group">
                                                        <p style="font-size:17px;">
                                                            <b>Total Amount: <span id="f8_amount">0</span></b>
                                                        </p>
                                                        <input type="hidden" id="ranf8amt" name="ranf8amt" value="0">
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 offset-md-3" style="margin-left:3px;">
                                                        <button class="btn btn-primary" onclick="crtof8()" type="button"
                                                            style="padding: 0.375rem 2.75rem; ">Save</button>

                                                    </div>

                                                </div>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="tile_count">
                                                        <div class="x_panel" style="border: none; height:412px;">
                                                            <div class="x_content">
                                                                <div class="row">
                                                                    <div class="col-sm-12">

                                                                        <h2 style="text-decoration:underline;"><b>PUNJAB
                                                                                DAY [Live]</b></h2>

                                                                        <table class="table">


                                                                            <tbody>
                                                                                <tr style="background-color: #ededed;">
                                                                                    <th>Applied Narration</th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table id="showaddf8"
                                                                            style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;"
                                                                            border="1">
                                                                            <tbody>
                                                                                <tr id="addtrnheadf8">
                                                                                    <td>Number</td>
                                                                                    <td>Amount</td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                        <table class="table" style="margin-top:248px;">


                                                                            <tbody>
                                                                                <tr style="background-color: #ededed;">
                                                                                    <th>Grand Total: 0</th>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>


                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <input class="btn btn-success" style="float:right" type="submit" name="submit"
                                        value="submit">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x_content">
                    <br />
                    <div class="col-md-8 col-sm-12 ">
                        <div class="x_panel">
                            <div style="margin-top: 13px; padding: 0 2px 0px;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                                            <table id="datatable" class="table table-striped table-bordered"
                                                style="width:100%">
                                                <thead>
                                                    <tr style="background-color: #ededed;">
                                                        <th>Sr</th>
                                                        <th>D</th>
                                                        <th>U/</th>
                                                        <th>Party</th>
                                                        <th>Rate</th>
                                                        <th>Amount</th>
                                                        <th>Added</th>
                                                        <th>Updated</th>
                                                        <th>Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>0</td>
                                                        <td>D</td>
                                                        <td>U/</td>
                                                        <td>Party</td>
                                                        <td>Rate</td>
                                                        <td>0</td>
                                                        <td>Added</td>
                                                        <td>Updated</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 ">
                        <div class="x_panel">
                            <div class="x_content" style="margin-top: 13px; padding: 0 2px 0px;">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card-box table-responsive">
                                            <table id="datatable" class="table table-striped table-bordered"
                                                style="width:100%">
                                                <tr>
                                                    <th colspan="6">Party</td>
                                                </tr>
                                                <tr style="background-color: #ededed;">
                                                    <td>Number</td>
                                                    <td>Amount</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
function calljantri() {
    if (document.getElementById('shift').value == '') {
        alert('Please Select Shift First');
        document.getElementById('shift').focus();
        return false;
    }
    if (document.getElementById('party').value == '') {
        alert('Please Select Party First');
        document.getElementById('party').focus();
        return false;
    }
    if (document.getElementById('birthdayy').value == '') {
        alert('Please Select Date');
        document.getElementById('birthdayy').focus();
        return false;
    }
    var custurl = '?shift=' + document.getElementById('shift').value + '&party=' + document.getElementById('party')
        .value + '&tdate=' + document.getElementById('birthdayy').value;
    window.location.replace("/jantri" + custurl);
}

function checkshift(elem) {
    if (document.getElementById('shift').value == '') {
        alert('Please Select Shift First');
        document.getElementById('shift').focus();
        return false;
    }
    if (document.getElementById('party').value == '') {
        alert('Please Select Party First');
        document.getElementById('party').focus();
        return false;
    }
    if (document.getElementById('birthdayy').value == '') {
        alert('Please Select Date');
        document.getElementById('birthdayy').focus();
        return false;
    }
	if(elem.value.length){
		elem.required = true;
		elem.parentElement.nextElementSibling.children[0].required = true;
		//console.log(elem.parentElement.nextElementSibling.children[0]);
	}
    return true;
}



function addnumamount(elem) {

    if (document.getElementById('shift').value == '') {
        alert('Please Select Shift First');
        document.getElementById('shift').focus();
        return false;
    }

    if (document.getElementById('party').value == '') {
        alert('Please Select Party First');
        document.getElementById('party').focus();
        return false;
    }
    if (document.getElementById('birthdayy').value == '') {
        alert('Please Select Date First');
        document.getElementById('birthdayy').focus();
        return false;
    }
    var master_id;
    //var num = $(elem).closest('th').prev().find('input').val();
    var numshow = $(elem).closest('th').prev().find('input').val();
    var num = $('input[name="trn_number[]"]').map(function() {
        return this.value;
    }).get();
    var amtshow = $(elem).val();
    var amt = $('input[name="trn_amount[]"]').map(function() {
        return this.value;
    }).get();
    var arr = document.getElementsByName('trn_amount[]');
    var tot = 0;
    for (var i = 0; i < arr.length; i++) {
        if (parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    var oldval =  document.getElementById('ttamntt').value;
    //document.getElementById('ttamntt').value = parseInt(tot)+parseInt(oldval);
    document.getElementById('ttamntt').value = tot;
    //alert(tot)
    var shift = document.getElementById('shift').value;
    var party = document.getElementById('party').value;
    var date = document.getElementById('birthdayy').value;
    console.log(shift);
    console.log(party);
    console.log(date);
    var if_exist = document.getElementById('is_filled1').value;
    var last_id1 = '';
    var actionstr = '';
    if (if_exist) {
        actionstr = 'update_transactions';
        master_id = if_exist;
        last_id1 = document.getElementById('last_id1').value;
    } else {
        actionstr = 'add_transactions';
    }
    //console.log(document.getElementById('addtrn').innerHTML);
    //return false;
    /* var total = $('#addtrn th').length;
$(elem).each(function(index) {
	alert(index); 
alert(total); 
    if (index === total - 1) {
		   
    // this is the last one
    }
	
});*/
    //console.log(elem);

    elem.parentNode.parentNode.insertAdjacentHTML('afterend',
        '<tr><th><input type="text" class="form-control" name="trn_number[]" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))"  autofocus></th> <th><input type="text" class="form-control" name="trn_amount[]" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" placeholder="Amount" ></th></tr>'
    );
    elem.parentNode.insertAdjacentHTML('afterend',
        '<td><span class="delete" onClick="$(this).parent().parent().remove();"> X </span></td>'
    );
    // document.getElementById('addtrnhead').insertAdjacentHTML('afterend', '<tr><td>' + numshow + '</td><td>' + amtshow +
    //   '</td></tr>');

    //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" name="trn_number[]" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" ></th> <th><input type="text" class="form-control" name="trn_amount[]" placeholder="Amount" ></th></tr>');
    var allSelects = document.getElementsByName("trn_number[]");
    var lastSelect = allSelects[allSelects.length - 1];
    console.log(lastSelect);
    //alert(lastchildd.value)
    //var elemm = $('input[name="trn_number[]"]:last');
    //setTimeout(function() {
    setTimeout(function() {
        lastSelect.focus();
        $('input[name="trn_number[]"]:last').focus();
    });

    return false;
    //}, 50);
    /*var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	   console.log("Transation Entered!!");
	   //console.log(JSON.parse(xhttp.responseText));
	   var obj = JSON.parse(xhttp.responseText);
	   //console.log(obj.master_id);
	   if(actionstr == 'add_transactions'){
	   document.getElementById('is_filled1').value = obj.master_id;
	   document.getElementById('is_filled2').value = obj.master_id;
	   document.getElementById('is_filled3').value = obj.master_id;
	   document.getElementById('is_filled4').value = obj.master_id;
	   document.getElementById('is_filled5').value = obj.master_id;
	   document.getElementById('last_id1').value = obj.last_id;
	   //last_id1 = obj.last_id;
	   }
	   document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+numshow+'</td><td>'+amtshow+'</td></tr>');
    
   //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" name="trn_number[]" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" ></th> <th><input type="text" class="form-control" name="trn_amount[]" placeholder="Amount" ></th></tr>');
 var allSelects = document.getElementsByName("trn_number[]");
var lastSelect = allSelects[allSelects.length-1];
//alert(lastchildd.value)
   //var elemm = $('input[name="trn_number[]"]:last');
   setTimeout(function() { lastSelect.focus(); }, 50);
   }
   };
   xhttp.open("POST",actionstr, true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("number="+num+"&amount="+amt+"&shift="+shift+"&party="+party+"&date="+date+"&master_id="+master_id +"&last_id="+last_id1);			
   */

}

function addrandomf4(elem) { //alert(elem.value)
    if (elem.value != '' && elem.value != '1' && elem.value != '-1') {
        //alert($(this).next().find("input").val());
        elem.parentNode.insertAdjacentHTML('afterend',
            '<div class="col-form-label col-md-3 col-sm-3"><button tabindex="-1" class="delete" onClick="$(this).parent().parent().remove();"> X </span> </div>'
        );
        elem.parentNode.parentNode.insertAdjacentHTML('afterend',
            '<div class="item form-group" > <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Number </label> <div class="col-md-6 col-sm-6 "> <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" id="first-name" autofocus onchange="addrandomf4(this)" name="number[]" class="form-control randomf4"> </div> </div>'
        );
        //document.querySelectorAll("#profie .item.form-group:last-child").focus();
        //var len = document.querySelectorAll('.form-control .randomf4').length;
        // console.log(document.querySelectorAll('.form-control .randomf4')[len-1]);
        var someElementsItems = document.querySelectorAll(".randomf4");
        //console.log(someElementsItems[someElementsItems.length -1])
        someElementsItems[someElementsItems.length - 1].focus();
        calcf4();
    }
}

function calcf4(elem) {
    //console.log(document.querySelectorAll('.randomf4').length)
    var len = Array.from(document.querySelectorAll('.randomf4')).filter(input => input.value !== "").length;

    var amt = document.getElementById('amnt').value;
    var tamnt = len * amt;
    document.getElementById('tamount').value = tamnt;
    document.getElementById('thamount').value = tamnt;

}

function insertrandomf4(elem) {
    var tamnatt = document.getElementById('tamount').value;
    var objarrr = $('input[name="number[]"]').map(function() {
        return this.value;
    }).get();
    //console.log(tamnatt);
    //console.log(numb);

    //var objarrr = obj.number.split(",");
    for (index = 0; index < objarrr.length; index++) {
        console.log(objarrr[index]);
        if (objarrr[index] != "") {
            document.getElementById('addtrnheadf4').insertAdjacentHTML('afterend', '<tr><td>' + objarrr[index] +
                '</td><td>' + elem.value + '</td></tr>');
        }

    }
    //alert(parseInt(tamnatt));
    document.getElementById('gtotal').innerHTML = tamnatt;
    return false;
}

function insertrandomf44(elem) {
    var tamnatt = document.getElementById('tamount').value;
    var numb = $('input[name="number[]"]').map(function() {
        return this.value;
    }).get();
    //var numb = document.querySelectorAll('.randomf4').serialize;
    var shift = document.getElementById('shift').value;
    var party = document.getElementById('party').value;
    var date = document.getElementById('birthdayy').value;
    var master_id;
    var if_exist = document.getElementById('is_filled2').value;
    var actionstr = '';
    if (if_exist) {
        actionstr = 'update_randomf4';
        master_id = if_exist;
    } else {
        actionstr = 'add_randomf4';
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Transation Entered!!");
            console.log(JSON.parse(xhttp.responseText));
            var obj = JSON.parse(xhttp.responseText);
            console.log(actionstr);
            if (actionstr == 'add_randomf4') {
                document.getElementById('is_filled1').value = obj.trns_id;
                document.getElementById('is_filled2').value = obj.trns_id;
                document.getElementById('is_filled3').value = obj.trns_id;
                document.getElementById('is_filled4').value = obj.trns_id;
                document.getElementById('is_filled5').value = obj.trns_id;

            }



            //console.log(obj.number.split(","));
            var objarrr = obj.number.split(",");
            for (index = 0; index < objarrr.length; index++) {
                //console.log(objarrr[index]);
                if (objarrr[index] != "") {
                    document.getElementById('addtrnheadf4').insertAdjacentHTML('afterend', '<tr><td>' + objarrr[
                        index] + '</td><td>' + obj.amount + '</td></tr>');
                }
            }
            //document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+obj.number+'</td><td>'+obj.Amount+'</td></tr>');

            //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" ></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
        }
    };
    xhttp.open("POST", actionstr, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("number=" + numb + "&thamount=" + tamnatt + "&amount=" + elem.value + "&shift=" + shift + "&party=" +
        party + "&date=" + date + "&master_id=" + master_id);

}

/*function insertcross(elem){
	   var tamnatt = document.getElementById('tamount').value;
	     var numb = $('input[name="number[]"]').map(function(){ 
                    return this.value; 
                }).get();
	   //var numb = document.querySelectorAll('.randomf4').serialize;
	 var shift = document.getElementById('shift').value;
   var party = document.getElementById('party').value;
   var date = document.getElementById('birthdayy').value;
	var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	   alert("Transation Entered!!")
	   //console.log(JSON.parse(xhttp.responseText));
	   var obj = JSON.parse(xhttp.responseText);
	   //console.log(obj.number.split(","));
	   //var objarrr = obj.number.split(",");
	   //for (index = 0; index < objarrr.length; index++) {
    //console.log(objarrr[index]);
	//if(objarrr[index]!=""){
		document.getElementById('addtrnheadcross').insertAdjacentHTML('afterend','<tr><td>Ander</td><td>'+obj.ander+'</td></tr><tr><td>Bahar</td><td>'+obj.bahar+'</td></tr><tr><td>Amount</td><td>'+obj.amount+'</td></tr><tr><td>Joda</td><td>'+obj.joda+'</td></tr><tr><td>Total Cross Count</td><td>'+obj.cross_count+'</td></tr><tr><td>Total Amount</td><td>'+obj.amount+'</td></tr>');
	//}
//}
	   //document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+obj.number+'</td><td>'+obj.Amount+'</td></tr>');
    
   //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" ></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
   }
   };
   xhttp.open("POST", "add_randomf4", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("number="+numb+"&thamount="+tamnatt+"&amount="+elem.value+"&shift="+shift+"&party="+party+"&date="+date);
	
   }*/

function checkcross() {
    ander = 1;
    if (document.getElementById('crossander').value) {
        ander = document.getElementById('crossander').value;
    }
    bahar = 1;
    if (document.getElementById('crossbahar').value) {
        bahar = document.getElementById('crossbahar').value;
    }
    amountt = 1;
    if (document.getElementById('amntt').value) {
        amountt = document.getElementById('amntt').value;
    }
    var master_id;
    var if_exist = document.getElementById('is_filled3').value;
    var actionstr = '';
    if (if_exist) {
        actionstr = 'update_cross';
        master_id = if_exist;
    } else {
        actionstr = 'add_cross';
    }
    joda = document.getElementById('joda').value;
    var shift = document.getElementById('shift').value;
    var party = document.getElementById('party').value;

    var items = [ander, bahar, amountt]; //only ex.:this array have many possibilities of length
    //console.log((ander.length));

    //console.log((ander.length*(bahar.length)*(amountt)));
    var product = 1;
    /*for( var i = 0; i < items.length; i++){
    product *= items[i]; 
    }*/
    product = (ander.length * (bahar.length) * (amountt));
    //console.log(product);				 
    var tcc, ta;

    // document.getElementById('tamnt').innerHTML= product;
    //document.getElementById('total_amount_cross').value = product;
    ta = product;
    anderarr = Array.from(ander.toString()).map(Number);
    bahararr = Array.from(bahar.toString()).map(Number);

    //var number = 12354987,
    output = [],
        aNumber = ander.toString();
    bNumber = bahar.toString();
    //console.log('length '+anderarr.length);
    var count = tcc = tamnt = 0;
    for (var i = 0; i < anderarr.length; i += 1) {
        //output.push(+sNumber.charAt(i));
        //console.log(' akhar '+aNumber[i]);
        //console.log(' akhar '+anderarr.length)
        for (var j = 0; j < bahararr.length; j += 1) {
            //console.log(' bahar '+bNumber[j]);
            //console.log(' bahar '+bahararr.length)
            if (document.getElementById('joda').value == 'N') {
                //console.log('ander '+anderarr[i]); console.log('bahar '+bahararr[j]);

                if (anderarr[i] != bahararr[j]) {
                    tcc++;
                    // console.log('tcc '+tcc+' amount '+amountt);
                    document.getElementById('total_amount_cross').value = tcc * amountt;
                    document.getElementById('tamnt').innerHTML = tcc * amountt;
                    document.getElementById('tcc').innerHTML = tcc;
                    document.getElementById('cross_count').value = tcc;
                }
            } else {
                tcc++;
                //console.log('tcc '+tcc+' amount '+amountt);
                document.getElementById('total_amount_cross').value = tcc * amountt;
                document.getElementById('tamnt').innerHTML = tcc * amountt;
                document.getElementById('tcc').innerHTML = tcc;
                document.getElementById('cross_count').value = tcc;
            }
        }
    }
    //console.log(ander);
    //console.log(Array.from(ander.toString()).map(Number));
    // foreach()
    /*if(document.getElementById('joda').value=='Y'){
   		 //tcc
   		 if(ander>=0 && ander <100){
   		 document.getElementById('tcc').innerHTML=4;
   		 document.getElementById('cross_count').value=4;
		 tcc = 4;
   	 }
   	 else if(ander>=100 && ander <1000){
   		 document.getElementById('tcc').innerHTML=9;
   		 document.getElementById('cross_count').value=9;
		 tcc = 9;
   	 }
   	 }
   	 else{
   		  if(ander>=0 && ander <100){
   		 document.getElementById('tcc').innerHTML=2;
   		 document.getElementById('cross_count').value=2;
		 tcc = 2
   		  }
   		  else if(ander>=100 && ander <1000){
   		document.getElementById('tcc').innerHTML=6;
   		 document.getElementById('cross_count').value=6;	
tcc = 6;		 
   		  }
   	 }*/


    //alert(ander); alert(bahar); alert(amountt);
    /* if((document.getElementById('crossander').value)&&(document.getElementById('crossbahar').value)&&(document.getElementById('amntt').value)){
	 var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	   console.log("Transation Entered!!")
	   //console.log(JSON.parse(xhttp.responseText));
	   var obj = JSON.parse(xhttp.responseText);
	   if(actionstr == 'add_cross'){
	   document.getElementById('is_filled1').value = obj.trns_id;
	   document.getElementById('is_filled2').value = obj.trns_id;
	   document.getElementById('is_filled3').value = obj.trns_id;
	   document.getElementById('is_filled4').value = obj.trns_id;
	   document.getElementById('is_filled5').value = obj.trns_id;
	   
	   }
	   //console.log(obj.number.split(","));
	   //var objarrr = obj.number.split(",");
	   console.log(obj);
	   document.getElementById('addtrnheadcross').insertAdjacentHTML('afterend','<tr><td>Ander</td><td>'+obj.ander+'</td></tr><tr><td>Bahar</td><td>'+obj.bahar+'</td></tr><tr><td>Amount</td><td>'+obj.amount+'</td></tr><tr><td>Joda</td><td>'+obj.joda+'</td></tr><tr><td>Total Cross Count</td><td>'+obj.cross_count+'</td></tr><tr><td>Total Amount</td><td>'+obj.all_commission+'</td></tr>');
	   //for (index = 0; index < objarrr.length; index++) {
    //console.log(objarrr[index]);
	//if(objarrr[index]!=""){
		//document.getElementById('addtrnheadf4').insertAdjacentHTML('afterend','<tr><td>'+objarrr[index]+'</td><td>'+obj.amount+'</td></tr>');
	//}
//}
	   //document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+obj.number+'</td><td>'+obj.Amount+'</td></tr>');
    
   //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" ></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
   }
   };
   xhttp.open("POST", actionstr, true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("ander="+ander+"&bahar="+bahar+"&amount="+amountt+"&shift="+shift+"&party="+party+"&joda="+joda+"&total_cross_count="+tcc+"&total_amount="+ta+"&master_id="+master_id);
	 }*/
}

function calcfromto() {
    var fromto_from = document.getElementById('fromto_from').value;
    var fromto_to = document.getElementById('fromto_to').value;
    var fromto_amnt = document.getElementById('fromto_amount').value;

    var ranged = Math.abs(fromto_to - fromto_from);
    var product = (ranged + 1) * fromto_amnt;
    var fromto_tamount = product;
    document.getElementById('fromto_total_amount').innerHTML = product;
    document.getElementById('total_amount_fromto').value = product;


}

function addfromto() {
    var fromto_from = document.getElementById('fromto_from').value;
    var fromto_to = document.getElementById('fromto_to').value;
    var fromto_amnt = document.getElementById('fromto_amount').value;
    var shift = document.getElementById('shift').value;
    var party = document.getElementById('party').value;
    var ranged = Math.abs(fromto_to - fromto_from);
    var master_id;
    var if_exist = document.getElementById('is_filled4').value;
    var actionstr = '';
    if (if_exist) {
        actionstr = 'update_fromto';
        master_id = if_exist;
    } else {
        actionstr = 'add_fromto';
    }
    var product = ranged * fromto_amnt;
    if ((fromto_from) && (fromto_to) && (fromto_amnt != 0 && fromto_amnt != '')) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert("Transation Entered!!")
                //console.log(JSON.parse(xhttp.responseText));
                var obj = JSON.parse(xhttp.responseText);
                //console.log(obj.number.split(","));
                //var objarrr = obj.number.split(",");
                if (actionstr == 'add_fromto') {
                    document.getElementById('is_filled1').value = obj.trns_id;
                    document.getElementById('is_filled2').value = obj.trns_id;
                    document.getElementById('is_filled3').value = obj.trns_id;
                    document.getElementById('is_filled4').value = obj.trns_id;
                    document.getElementById('is_filled5').value = obj.trns_id;

                }
                console.log(obj);
                document.getElementById('addtrnheadfromto').insertAdjacentHTML('afterend', '<tr><td>From</td><td>' +
                    obj.fromto_from + '</td></tr><tr><td>To</td><td>' + obj.fromto_to +
                    '</td></tr><tr><td>Amount</td><td>' + obj.fromto_amount +
                    '</td></tr><tr><td>Total Amount</td><td>' + obj.all_commission + '</td></tr>');
                //for (index = 0; index < objarrr.length; index++) {
                //console.log(objarrr[index]);
                //if(objarrr[index]!=""){
                //document.getElementById('addtrnheadf4').insertAdjacentHTML('afterend','<tr><td>'+objarrr[index]+'</td><td>'+obj.amount+'</td></tr>');
                //}
                //}
                //document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+obj.number+'</td><td>'+obj.Amount+'</td></tr>');

                //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" ></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
            }
        };
        xhttp.open("POST", actionstr, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("fromto_from=" + fromto_from + "&fromto_to=" + fromto_to + "&fromto_amount=" + fromto_amnt +
            "&shift=" + shift + "&party=" + party + "&total_amount_fromto=" + product + "&master_id=" + master_id);
    }
}

function adddaraspacef8() {
    var dara_f8 = document.getElementById('dara_f8').value;
    var dara_amount_f8 = document.getElementById('dara_amount_f8').value;
    var akhar_bahar_f8 = document.getElementById('akhar_bahar_f8').value;
    var shift = document.getElementById('shift').value;
    var party = document.getElementById('party').value;
    var amount_akahr_bahar_f8 = document.getElementById('amount_akahr_bahar_f8').value;
    var akahr_andar_f8 = document.getElementById('akahr_andar_f8').value;
    var ranf8amt = document.getElementById('f8_amount').innerHTML;
    var amount_akahr_andar_f8 = document.getElementById('amount_akahr_andar_f8').value;
    var master_id;
    var if_exist = document.getElementById('is_filled5').value;
    var actionstr = '';
    if (if_exist) {
        actionstr = 'update_random_f8';
        master_id = if_exist;
    } else {
        actionstr = 'random_f8';
    }
    if ((dara_f8) && (dara_amount_f8) && (akhar_bahar_f8) && (amount_akahr_bahar_f8) && (akahr_andar_f8) && (
            amount_akahr_andar_f8)) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //alert("Transation Entered!!")
                //console.log(JSON.parse(xhttp.responseText));
                var obj = JSON.parse(xhttp.responseText);
                if (actionstr == 'random_f8') {
                    document.getElementById('is_filled1').value = obj.trns_id;
                    document.getElementById('is_filled2').value = obj.trns_id;
                    document.getElementById('is_filled3').value = obj.trns_id;
                    document.getElementById('is_filled4').value = obj.trns_id;
                    document.getElementByIaddnumamountd('is_filled5').value = obj.trns_id;

                }
                //console.log(obj.number.split(","));
                //var objarrr = obj.number.split(",");
                console.log(obj);
                document.getElementById('addtrnheadf8').insertAdjacentHTML('afterend', '<tr><td>Dara</td><td>' + obj
                    .dara_f8 + '</td></tr><tr><td>Amount</td><td>' + obj.dara_amount_f8 +
                    '</td></tr><tr><td>Akhar Bahar</td><td>' + obj.akhar_bahar_f8 +
                    '</td></tr><tr><td>Amount</td><td>' + obj.amount_akahr_bahar_f8 +
                    '</td></tr><tr><td>Akhar Andar</td><td>' + obj.akahr_andar_f8 +
                    '</td></tr><tr><td>Amount</td><td>' + obj.amount_akahr_andar_f8 + '</td></tr>');

                //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift(this)" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" ></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
            }
        };
        xhttp.open("POST", actionstr, true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("ranf8amt=" + ranf8amt + "&dara_f8=" + dara_f8 + "&dara_amount_f8=" + dara_amount_f8 + "&shift=" +
            shift + "&party=" + party + "&akhar_bahar_f8=" + akhar_bahar_f8 + "&akahr_andar_f8=" + akahr_andar_f8 +
            "&amount_akahr_bahar_f8=" + amount_akahr_bahar_f8 + "&amount_akahr_andar_f8=" + amount_akahr_andar_f8 +
            "&master_id=" + master_id);
    }
}

function daraspacef8() {
    document.getElementById('dara_f8').addEventListener('input', function(e) {
        e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{2})/g, '$1 ').trim();
    });
    var str = document.getElementById('dara_f8').value.split(" ");

    //console.log(str.length);
    var daraamnt = str.length * document.getElementById('dara_amount_f8').value;
    document.getElementById('amount_dara').innerHTML = daraamnt;
    //document.getElementById('ranf8amt').value = daraamnt;
    f8_tamount();
}

function akahr_bahar_f8() {
    var str = document.getElementById('akhar_bahar_f8').value;
    //console.log(str.toString().length);
    var akbahaamnt = str.length * document.getElementById('amount_akahr_bahar_f8').value;
    document.getElementById('akbahar_dara').innerHTML = akbahaamnt;
    //document.getElementById('ranf8amt').value = parseInt(document.getElementById('ranf8amt').value) + akbahaamnt;
    f8_tamount();
}

function calc_akahr_andar_f8() {
    var str = document.getElementById('akahr_andar_f8').value;
    //console.log(str.toString().length);
    var akbahaamnt = str.length * document.getElementById('amount_akahr_andar_f8').value;
    document.getElementById('akandar_dara').innerHTML = akbahaamnt;
    //document.getElementById('ranf8amt').value = parseInt(document.getElementById('ranf8amt').value) + akbahaamnt;
    f8_tamount();
}

function f8_tamount() {


    val1 = parseInt(document.getElementById("akandar_dara").innerHTML);
    if (isNaN(val1) == true) {
        val1 = 0;
    }

    var val2 = parseInt(document.getElementById("akbahar_dara").innerHTML);
    if (isNaN(val2) == true) {
        val2 = 0;
    }

    var val3 = parseInt(document.getElementById("amount_dara").innerHTML);
    if (isNaN(val3) == true) {
        val3 = 0;
    }

    document.getElementById("f8_amount").innerHTML = val1 + val2 + val3;
    document.getElementById("ranf8amt").value = val1 + val2 + val3;
    //console.log(parseInt(str31));
    //document.getElementById("txtTotal").innerHTML = 
}

function selectshift(val) {
    var className = document.getElementsByClassName('shift_day');
    for (var index = 0; index < className.length; index++) {
        console.log(className[index].innerHTML);
        className[index].innerHTML = val.options[val.selectedIndex].text;
    }

}

/* var form = document.getElementById('demo-form2');
form.onsubmit = function (e) {
	if(checkshift()){
	return true;	
	}
	else{
		e.stopPropagation()
		return false;
	}
	
};
   function myFunction(){
	   return false;
   } */
function checkFields(e) {
    var found = false;
    $('#myTabContent input').each(function() {
        if (($(this).val()) && ($(this).attr("id") != "ranf8amt") && ($(this).val() !=
                "submit")) { //alert($(this).val())
            found = true;
            return false;
        }
    });

    if (found == true) {
        //alert("at least one field has value");
        return true;
    } else {
        alert("Fill atleast one section");
        e.preventDefault();
        return false;
    }

}
</script>
<script>
setTimeout(function() {
    $('.flsh').hide('slow');
}, 1000000);
</script>