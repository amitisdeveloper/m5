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
<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#example').DataTable( {
        dom: 'Bfrtip',
		"scrollX": true,
        buttons: [
            'csv', 'excel', 'pdf' 
        ]
    } );
} );
</script>
<div class="row" style="display:block">
<form action="view_all_result" name="search_final_result" method="post">
<div class="col-sm-12 col-md-12">
<div class="col-md-3 col-sm-12  form-group"><label>Select Shift :</label>
<select name="shift_name" class="form-control" >
<option value="">-Please Select-</option>
<?php foreach($tbl_shift as $key => $val){
	echo '<option value="'.$val['id'].'" '.(($this->input->post('shift_name')==$val['id']) ? 'selected' :'').'>'.$val['shift_name'].'</option>';
}?>
</select>
</div>
<div class="col-md-3 col-sm-12  form-group"><label>Select Ledger :</label>
<select name="search_party" class="form-control" >
<option value="">-Please Select-</option>
<?php foreach($tbl_ledger as $key => $val){
	echo '<option value="'.$val['id'].'" '.(($this->input->post('search_party')==$val['id']) ? 'selected' :'').'>'.$val['ledger_name'].'</option>';
}?>
</select>
</div>
<div class="col-md-3 col-sm-12  form-group"><label>From Date :</label><input id="fromdate" class="birthday form-control" type="text" name="fromdate" value="<?php echo ($this->input->post('fromdate') ? date('Y-m-d',strtotime($this->input->post('fromdate'))) :'')?>" placeholder="From Date"></div>
<div class="col-md-3 col-sm-12  form-group"><label>To Date :</label><input id="todate" class="birthday form-control" type="text" name="todate" value="<?php echo ($this->input->post('todate') ? date('Y-m-d',strtotime($this->input->post('todate'))) :'')?>" placeholder="To Date"></div>

<input type="submit" name="Search" Value="Search" class="btn btn-success" style="float: right;">
</div>
</form>
<table id="example" class="ui celled table" style="width:100%">
        <thead>
            <?php 
			//echo '<pre>';print_r($tbl_openno);echo '<pre>';
			foreach($tbl_openno as  $key=> $val){
			   if($key==0){
			   ?>
			   <tr>
			   <?php unset($val['id']); unset($val['TP_person']);unset($val['ShiftId']); unset($val['ProfiteAfterRebate']); unset($val['PartyId']); unset($val['Rebait']);unset($val['RebateAmount']); 
			  // list($val['TP_person'], $val['thirdperson_name']) = [$val['thirdperson_name'], $val['TP_person']];
			   foreach($val as $keyy => $vall){
				   
				   ?>
				   <th><?=$keyy?></th>
				   <?php
			   }?>
			   </tr>
			<?php 
			   }
			} ?>
        </thead>
        <tbody>
           <?php foreach($tbl_openno as  $key=> $val){
			   ?>
			   <tr>
			   <?php unset($val['id']); unset($val['TP_person']); unset($val['ShiftId']); unset($val['ProfiteAfterRebate']); unset($val['PartyId']); unset($val['Rebait']);unset($val['RebateAmount']); 
			   foreach($val as $keyy => $vall){
				   
				   ?>
				   <td><?=$vall?></td>
				   <?php
			   }
			   ?>
			   </tr>
			   <?php
		   } ?>
			</tbody>
			<tfoot>
             <?php foreach($tbl_openno as  $key=> $val){
			   if($key==0){
			   ?>
			   <tr>
			   <?php unset($val['id']); unset($val['TP_person']); unset($val['ShiftId']); unset($val['ProfiteAfterRebate']); unset($val['PartyId']); unset($val['Rebait']);unset($val['RebateAmount']);
			   foreach($val as $keyy => $vall){
				   ?>
				   <th><?=$keyy?></th>
				   <?php
			   }?>
			   </tr>
			<?php 
			   }
			} ?>
        </tfoot>
    </table>

</div>

<?php // echo '<pre>'; print_r($tbl_openno); echo '</pre>';?>