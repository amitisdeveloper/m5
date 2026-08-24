<?php //echo '<pre>'; print_r($tbl_openno); echo '</pre>';?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
table {
    table-layout:fixed;
}
td{
    overflow:hidden;
    text-overflow: ellipsis;
}
table.dataTable td {
    padding: 3px !important;
}
/* #example td:nth-of-type(2) {
  background-color:#e1e176de;
}
#example td:nth-of-type(1) {
  background-color:#d6b091;
}
#example td:nth-of-type(3) {
  background-color:#afd8d1;
}
#example td:nth-of-type(4) {
  background-color:#c4a3d5;
} */
</style>
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#example').DataTable( {
        dom: 'Bfrtip',
		"scrollX": true,
        buttons: [
            'csv', 'excel', 'pdf'
        ],
		"order": []
    } );
   // $('.autosel').select2();

} );
</script>
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
<div class="row" style="display:block">
<h2><label>Search Here :</label></h2>
<form action="" name="search_final_ledger" method="post">
<div class="col-sm-12 col-md-12">
<!--<div class="col-md-2 col-sm-12  form-group"><label>From Date :</label><input id="fromdate" class="birthday form-control" type="text" name="fromdate" value="<?php echo ($this->input->post('fromdate') ? date('Y-m-d',strtotime($this->input->post('fromdate'))) :'')?>" placeholder="From Date"></div>-->
<div class="col-md-2 col-sm-12  form-group"><label>Hisab Date :</label><input id="todate" class="birthday form-control" type="text" name="todate" value="<?php echo ($this->input->post('todate') ? date('Y-m-d',strtotime($this->input->post('todate'))) :'')?>" placeholder="Date"></div>
<div class="col-md-3 col-sm-12  form-group"><label>Select Ledger :</label>
<select name="search_party" class="form-control autosel" >
<option value="">-Please Select-</option>
<?php foreach($tbl_ledger as $key => $val){
	echo '<option value="'.$val['id'].'" '.(($this->input->post('search_party')==$val['id']) ? 'selected' :'').'>'.$val['ledger_name'].'</option>';
}?>
</select>
</div>
<!--<div class="col-md-3 col-sm-12  form-group"><label>Select Agent :</label>
<select name="agent_name" class="form-control" >
<option value="">-Please Select-</option>
<?php foreach($agent as $key => $val){
	echo '<option value="'.$val['id'].'" '.(($this->input->post('agent_name')==$val['id']) ? 'selected' :'').'>'.$val['agent_name'].'</option>';
}?>
</select>
</div>--> 
<div class="col-md-2 col-sm-12  form-group">
<label>&nbsp;</label>
<input type="submit" name="Search" Value="Search" class="btn btn-success form-control" style="float: right;">
</div>
</div>
</form>
<div class="col-md-6 col-sm-6 offset-md-3">
</div>
<p>&nbsp;</p>
<table id="example" class="ui celled table cell-border" style="width:100%">
        <thead>
            
			<tr>
			<th>Sr. No</th>	
			<th>Ledger Name</th>
			<th>Date</th>
			<th>Opening Balance</th>
			<th>Today's Hisab</th>
			<th>Payment</th>
			<th>Final Hisab</th>
			<th>Action</th>
			</tr>
			<?php  /* foreach($tbl_openno as  $key=> $val){
			   if($key==0){
			   ?>
			   <tr>
			   <?php unset($val['id']); unset($val['ShiftId']); unset($val['PartyId']);unset($val['Op_Balance']);
			   unset($val['CrAmount']); unset($val['DrAmount']);unset($val['Closing']);unset($val['updated_at']);
			   foreach($val as $keyy => $vall){
				   ?>
				   <th><?=$keyy?></th>
				   <?php
			   }?>
			   <th>Action</th>
			   </tr>
			<?php 
			   }
			} */?>
        </thead>
        <tbody>
           <?php foreach($tbl_openno as  $key=> $val){ //echo '<pre>'; print_r($val); echo '</pre>'; die;
			
		
			 ?>
			    <td><?=$key+1?></td>
			   <td><?=$val['ledger_name']?></td>
			   <td><?=$val['date']?></td>
			  
			  <td><?=$val['opening_bal']?></td>
				
				<!--<td><?=$val['hisab']?></td>-->
				 <td><?=$val['today_hisab']?></td>
				 <td><?=$val['voucher']?></td>
				 <td><?=$val['final_hisab']?></td>
				 <!--<td><?=$ttoday ?>-->
			   <td>
			   <form action="ledger_till_date_reports" name="tdreport" method="post">
			   <input type="hidden" value="<?=$val['ledger_id']?>" name="ledger_id">
			   <input type="hidden" value="<?=$val['date']?>" name="date">
			   <input type="submit" name="view" value="View">
			   </form>
			   </td>
			   </tr>
			   <?php
			//}
		   } ?>
			</tbody>
			<tfoot>
			<tr>
			<th>Sr. No</th>	
			<th>Ledger Name</th>
			<th>Date</th>
			<th>Opening Balance</th>
			<th>Today's Hisab</th>
			<th>Payment</th>
			<!--<th>Final Hisab</th>-->
			<th>Action</th>
			</tr>
             <?php foreach($tbl_openno as  $key=> $val){
			  /* if($key==0){
			   ?>
			   <tr>
			   <?php unset($val['id']); unset($val['ShiftId']); unset($val['PartyId']);unset($val['Op_Balance']);
			   unset($val['CrAmount']); unset($val['DrAmount']);unset($val['Closing']);unset($val['updated_at']);
			   foreach($val as $keyy => $vall){
				   ?>
				   <th><?=$keyy?></th>
				   <?php
			   }?>
			   </tr>
			<?php 
			   }*/
			} ?>
        </tfoot>
    </table>

</div>

<?php // echo '<pre>'; print_r($tbl_openno); echo '</pre>';?>
