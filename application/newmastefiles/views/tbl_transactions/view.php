<script src="https://555xch.live//assets/js/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
function matchStart(params, data) {
    params.term = params.term || '';
    if (data.text.toUpperCase().indexOf(params.term.toUpperCase()) == 0) {
        return data;
    }
    return false;
}

jQuery(document).ready(function($) {
    
	$('.autosel').select2({
    matcher: function(params, data) {
        return matchStart(params, data);
    },
});
} );
</script>
<?php //echo '<pre>';print_r($tbl_transactions);echo '</pre>'; die; ?>
<div class="">
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-12 col-sm-12 ">
         <div class="x_panel">
            <div class="x_title">
              
               <ul class="nav navbar-right panel_toolbox">
                  <li>
                     <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
               </ul>
              
               <?php /* ?><div class="nav navbar-left ">
                  <h2 style="margin-right:10px;"><b>Shift</b></h2>
                  <!-- Split button -->
                  <div class="btn-group" style="height: 36px; margin-right: 10px;">
                      
                     <?php //echo '<pre>'; print_r($shifts); echo '</pre>'; ?>
                     <select name="shift" id="shift" onchange="selectshift(this)" class="form-control">
                        <option value="">Choose option</option>
                        <?php foreach($shifts as $key => $val){
                           ?>
                        <option value="<?=$val['id']?>"><?=$val['shift_name']?></option>
                        <?php	
                           } ?>
                     </select>
                     <div class="alert" style="display:none">Please Select Shift First</div>
                    
                  </div>
				  <h2 style="margin-right:10px;"><b>Party</b></h2>
                  <div class="btn-group" style="height: 36px; margin-right: 10px;">
                      
                  </div>
                 <div class="btn-group" style="height: 36px; margin-right: 10px;">
                   <h2 style="margin-right:10px;">
                     <b>Date</b>
                   </h2>
                   <input id="birthday" class="form-control" type="text" required="required"  >
                     
                  </div>
                 
                 
                 
                  
                  <!-- Split button -->
               </div> <?php */?>
               <div class="clearfix"></div>
               <div class="col-md-8  col-sm-12  ">
                  <div class="x_content" >
                    <div class="card-box table-responsive" style="padding:22px 0px 6px; width:104%;margin-left:-20px;">
<form action="" name="search_final_result" method="post">
<div class="col-sm-12 col-md-12">
<div class="col-md-2 col-sm-12  form-group"><label>Select Shift :</label>
<select name="shift_name" class="form-control" >
<option value="">-Please Select-</option>
<?php foreach($shifts as $key => $val){
	echo '<option value="'.$val['id'].'" '.(($this->input->post('shift_name')==$val['id']) ? 'selected' :'').'>'.$val['shift_name'].'</option>';
}?>
</select>
</div>
<div class="col-md-2 col-sm-12  form-group"><label>Select Ledger :</label>
<select name="search_party" class="form-control autoselected" >
<option value="">-Please Select-</option>
<?php foreach($party as $key => $val){ $val = (array)$val; 
	echo '<option value="'.$val['id'].'" '.(($this->input->post('search_party')==$val['id']) ? 'selected' :'').'>'.$val['ledger_name'].'</option>';
}?>
</select>
</div>
<!--<div class="col-md-3 col-sm-12  form-group"><label>From Date :</label><input id="fromdate" class="birthday form-control" type="text" name="fromdate" value="<?php echo ($this->input->post('fromdate') ? date('Y-m-d',strtotime($this->input->post('fromdate'))) :'')?>" placeholder="From Date"></div>-->
<div class="col-md-2 col-sm-12  form-group"><label> Date :</label><input id="todate" class="birthday form-control" type="text" name="todate" value="<?php echo ($this->input->post('todate') ? date('Y-m-d',strtotime($this->input->post('todate'))) :'')?>" placeholder="To Date"></div>
<div class="col-md-4 col-sm-12  form-group"><label>Select Agent :</label>
<select name="agent_name" class="form-control autoselected" >
<option value="">-Please Select-</option>
<?php foreach($agent as $key => $val){
	echo '<option value="'.$val['id'].'" '.(($this->input->post('agent_name')==$val['id']) ? 'selected' :'').'>'.$val['agent_name'].'</option>';
}
date_default_timezone_set('Asia/Kolkata');
								$ttime = time();
?>
</select>
</div>
<input type="submit" name="Search" Value="Search" class="btn btn-success" style="float: right;">
</div>
</form>
                      <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                          <tr>
                            <th>S No </th>
                            <th>Party Name</th>
							<th>Shift Name</th>
              <!-- <th>Staff Name</th> -->
                            <!--<th>Rate</th>
                            <th>Amount</th>-->
                            <th>Amount</th>
                            <th>Entered By</th>
							<th>Entry/ Modified Date</th>							
                            <th>Force/Action</th>
                          </tr>
                        </thead>
                        <tbody>
						<?php 
            if(is_array($tbl_transactions)&& (!empty($tbl_transactions))){
							foreach($tbl_transactions as $key => $val){
								
								if($_SESSION['role']=='Super Admin' || $_SESSION['role']=='Master'){
											//echo $val['open_date'].' '.date("H:i", strtotime($val['super_admin'])); //die;
											$time = strtotime(date('d-m-Y',strtotime($val['open_date'])).' '.date("H:i", strtotime($val['super_admin'])));
										}
								if($_SESSION['role']=='Data Entry Operator' || $_SESSION['role']=='Staff' || $_SESSION['role']=='staff'){
									//echo $val['open_date'].' '.date("H:i", strtotime($val['super_admin']));
											$time = strtotime(date('d-m-Y',strtotime($val['open_date'])).' '.date("H:i", strtotime($val['data_entry_operator'])));
										}
										//echo $ttime.'      '.$time.'<br>';
										$hourdiff = round(($ttime - $time)/3600, 1);
										//$hourdiff = gmdate("H:00", time());
										//echo $hourdiff.' <br>';
                $tamnt = explode(',',$val['trn_amt']);
							?>
							<tr>
							<td><?=$key+1?> </td>
							<td><?=$val['ledger_name']?></td>
							<td><?=$val['shift_name']?></td>
              <!-- <td><?=($val['staff_name'])?$val['staff_name']:'Super Admin'?></td> -->
							<!--<td width="20%"><?=$val['trnno']?></td>
							<td width="20%"><?=$val['trn_amt']?></td>-->
							<td width="20%"><?=array_sum($tamnt);?></td>
							<td><?=($val['modifieddate'])?date('d/m/Y h:i:s',strtotime($val['modifieddate'])).'(M)':date('d/m/Y h:i:s',strtotime($val['createddate'])).'(E)';?></td>
							<td>
                              <i class="fa fa-eye" aria-hidden="true" data-id="<?=$key?>" onclick="popdata(<?=$key?>)" style="font-size:20px;"></i>
                              <?php if($hourdiff <= '12' || $_SESSION['role']=='Super Admin' || $_SESSION['role']=='Master'){ ?>
							  <a href="/tbl_transactions/edit_trn/<?=$val['id']?>"><i class="fa fa-pencil" aria-hidden="true" style="font-size:20px;"></i></a>
                              <a href="/tbl_transactions/remove/<?=$val['id']?>" onclick="return confirm('Are you sure you want to delete this Entry?');"><i class="fa fa-minus-circle" aria-hidden="true" style="font-size:20px;"></i></a>
                              <?php } ?>
							</td>
							</tr>
							<?php
							foreach($val as $keyy => $vall){
								//if($vall!=0){
								?>
								<input type="hidden" name="<?=$keyy?>" id="<?=$keyy.'_'.$key?>" value="<?=$vall?>">
								<?php
							}
							//}
							}
						} ?>
                        <!--<tr>
                            <td>1.</td>
                            <td>kanika</td>
                            <td>10</td>
                            <td>10,000</td>
                            <td>7-sep-2021</td>
                            <td>
                              <i class="fa fa-eye" aria-hidden="true" style="font-size:20px;"></i>
                              <i class="fa fa-pencil" aria-hidden="true" style="font-size:20px;"></i>
                              <i class="fa fa-minus-circle" aria-hidden="true" style="font-size:20px;"></i>
                            </td>
                          </tr>-->
                          
                        </tbody>
                              
                      </table>
                    </div>
                     </div>
                  </div>
              <div class="col-md-4  col-sm-12  ">
                <div class="x_content" >
                  <div class="card-box table-responsive" style="padding:22px 0px 6px; ">
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                      <thead>
					  
                        <tr>
                          <th colspan="2">View Data</th>
                          <th id="jview"></th>
                        </tr>
						 <tr>
						 <th colspan="2">Total Amount</th>
                          <th id="ttamnt"></th>
                         </tr>
                      </thead>
                      <tbody id="tinsrt">
					 
                        <!--<tr>
                          <td>
                            <input type="text" class="form-control" placeholder=" Number">
                          </td>
                          <td>
                            <input type="text" class="form-control" placeholder=" Amount">
                          </td>
                         
                        </tr>-->
                       
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
<script>
function popdata(id){
	document.getElementById('tinsrt').innerHTML='';
	var trn_id=document.getElementById('trnno_'+id).value;
	var trn_amnt = document.getElementById('trn_amt_'+id).value;
	let ttamnt = 0;
	//var str = 'Hello, World, etc';
var trn_idarr = trn_id.split(',');
var trn_amtarr = trn_amnt.split(','); 
//console.log(trn_idarr)
for(var i = 0; i < trn_idarr.length; i++)
{
  // console.log('<tr><td>'+trn_idarr[i]+'</td><td>'+trn_amtarr[i]+'</td></tr>');
   document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>'+trn_idarr[i]+'</td><td>'+trn_amtarr[i]+'</td></tr>');
if(trn_amtarr[i]){
ttamnt = parseInt(ttamnt) + parseInt(trn_amtarr[i]);
}
}
console.log(ttamnt)
var trn_id=document.getElementById('number_'+id).value;
	var trn_amnt = document.getElementById('amount_'+id).value;
	//var str = 'Hello, World, etc';
var trn_idarrr = trn_id.split(',');
//var trn_amtarr = trn_amnt.split(','); 
//console.log(trn_idarr)
for(var i = 0; i < trn_idarrr.length-1; i++)
{//console.log('<tr><td>'+trn_idarrr[i]+'</td><td>'+trn_amnt+'</td></tr>');
	if(trn_idarrr[i]!=''){
 //  console.log('<tr><td>'+trn_idarrr[i]+'</td><td>'+trn_amnt+'</td></tr>');
   document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>'+trn_idarrr[i]+'</td><td>'+trn_amnt+'</td></tr>');
ttamnt = parseInt(ttamnt) + parseInt(trn_amnt);
}
}
var cander=numtoarr(document.getElementById('ander_'+id).value);
	var cbahar = numtoarr(document.getElementById('bahar_'+id).value);
	var cramnt = document.getElementById('trncrs_amt_'+id).value;
	var perm = permutations(cander,cbahar);
	for(var i = 0; i < perm.length; i++)
{
   document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>'+perm[i]+'</td><td>'+cramnt+'</td></tr>');
   ttamnt = parseInt(ttamnt) + parseInt(cramnt);
}
 var fromfrom = document.getElementById('fromto_from_'+id).value;
var frmto = document.getElementById('fromto_to_'+id).value;
var frmamnt = document.getElementById('fromto_amount_'+id).value;
for(var i = fromfrom; i <= frmto; i++)
{
   document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>'+i+'</td><td>'+frmamnt+'</td></tr>');
    ttamnt = parseInt(ttamnt) + parseInt(frmamnt);
}
 var dararate = document.getElementById('dara_f8_'+id).value;
var daraamnt = document.getElementById('dara_amount_f8_'+id).value;
var dararatearr = dararate.split(' ');
for(var i = 0; i < dararatearr.length; i++)
{
 //  console.log('<tr><td>'+trn_idarrr[i]+'</td><td>'+trn_amnt+'</td></tr>');
   document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>'+dararatearr[i]+'</td><td>'+daraamnt+'</td></tr>');
    ttamnt = parseInt(ttamnt) + parseInt(daraamnt);
}
var amount_akahr_andar_f8 = document.getElementById('amount_akahr_andar_f8_'+id).value;
var amount_akahr_bahar_f8 = document.getElementById('amount_akahr_bahar_f8_'+id).value;
var akahr_andar_f8 = numtoarr(document.getElementById('akahr_andar_f8_'+id).value);
var akhar_bahar_f8 = numtoarr(document.getElementById('akhar_bahar_f8_'+id).value);
for(var i = 0; i < akahr_andar_f8.length; i++)
{
	//akhr_ander_str = "" +akahr_andar_f8[i] + akahr_andar_f8[i];
 //  console.log('<tr><td>'+trn_idarrr[i]+'</td><td>'+trn_amnt+'</td></tr>');
   document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>' +"" +akahr_andar_f8[i]+akahr_andar_f8[i]+akahr_andar_f8[i]+akahr_andar_f8[i]+'</td><td>'+amount_akahr_andar_f8+'</td></tr>');
ttamnt = parseInt(ttamnt) + parseInt(amount_akahr_andar_f8);
}
for(var i = 0; i < akhar_bahar_f8.length; i++)
{
	//akhr_ander_str = "" +akahr_andar_f8[i] + akahr_andar_f8[i];
 //  console.log('<tr><td>'+trn_idarrr[i]+'</td><td>'+trn_amnt+'</td></tr>');
   document.getElementById('tinsrt').insertAdjacentHTML('beforeend','<tr><td>' +"" +akhar_bahar_f8[i]+akhar_bahar_f8[i]+akhar_bahar_f8[i]+'</td><td>'+amount_akahr_bahar_f8+'</td></tr>');
ttamnt = parseInt(ttamnt) + parseInt(amount_akahr_bahar_f8);
}
var jviewval = document.getElementById('id_'+id).value; 
var pidviewval = document.getElementById('party_id_'+id).value;
var shiftid = document.getElementById('shift_id_'+id).value;
var jt_dateval = document.getElementById('t_date_'+id).value;
document.getElementById('jview').innerHTML='<a href="/viewjantri?id='+jviewval+'">Jantri View</a> | <a href="/view_jantri_total?pid='+shiftid+'&date='+jt_dateval+'">Total Jantri View</a>';

//alert(ttamnt);
document.getElementById('ttamnt').innerHTML= ttamnt; 
document.getElementById('jview').show();
}

function numtoarr(number){
		//var number = 12354987,
    output = [],
    sNumber = number.toString();

for (var i = 0, len = sNumber.length; i < len; i += 1) {
    output.push(+sNumber.charAt(i));
}
return output;
}
 function permutations(array1, array2){
	 //console.log(array1);console.log(array2); return;
	   combos = [] //or combos = new Array(2);

for(var i = 0; i < array1.length; i++)
{
     for(var j = 0; j < array2.length; j++)
     {
        //you would access the element of the array as array1[i] and array2[j]
        //create and array with as many elements as the number of arrays you are to combine
        //add them in
        //you could have as many dimensions as you need
      //console.log("" +array1[i]+array2[j])      
	  combos.push("" +array1[i] + array2[j])
     }
}
return combos;
   }
</script>