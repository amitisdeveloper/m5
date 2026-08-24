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
        ],
		"order": []
    } );
} );
</script>
<div class="row" style="display:block">
<h2><label>Search Here :</label></h2>
<form action="" name="search_final_ledger" method="post">
<div class="col-sm-12 col-md-12">
<div class="col-md-2 col-sm-12  form-group"><label>From Date :</label><input id="fromdate" class="birthday form-control" type="text" name="fromdate" value="<?php echo ($this->input->post('fromdate') ? date('Y-m-d',strtotime($this->input->post('fromdate'))) :'')?>" placeholder="From Date"></div>
<div class="col-md-2 col-sm-12  form-group"><label>To Date :</label><input id="todate" class="birthday form-control" type="text" name="todate" value="<?php echo ($this->input->post('todate') ? date('Y-m-d',strtotime($this->input->post('todate'))) :'')?>" placeholder="Date"></div>

<div class="col-md-3 col-sm-12  form-group"><label>Select Agent :</label>
<select name="agent_name" class="form-control" >
<option value="">-Please Select-</option>
<?php foreach($agent as $key => $val){
	echo '<option value="'.$val['id'].'" '.(($this->input->post('agent_name')==$val['id']) ? 'selected' :'').'>'.$val['agent_name'].'</option>';
}?>
</select>
</div>
<div class="col-md-2 col-sm-12  form-group">
<label>&nbsp;</label>
<input type="submit" name="Search" Value="Search" class="btn btn-success form-control" style="float: right;">
</div>
</div>
</form>
<div class="col-md-6 col-sm-6 offset-md-3">
</div>
<p>&nbsp;</p>
<table id="example" class="ui celled table" style="width:100%">
        <thead>
            <?php foreach($tbl_openno as  $key=> $val){
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
			} ?>
        </thead>
        <tbody>
           <?php foreach($tbl_openno as  $key=> $val){
			   ?>
			   <tr>
			   <?php 
			   $ledger_id=$val['PartyId'];
			   $date = $val['Date'];
			   unset($val['id']); unset($val['ShiftId']); unset($val['PartyId']);unset($val['Op_Balance']);
			   unset($val['CrAmount']); unset($val['DrAmount']);unset($val['Closing']);unset($val['updated_at']);
			   foreach($val as $keyy => $vall){
				   
				   ?>
				   <td><?=$vall?></td>
				   <?php
			   }
			   ?>
			   <td>
			   <form action="ledger_till_date_report" name="tdreport" method="post">
			   <input type="hidden" value="<?=$ledger_id?>" name="ledger_id">
			   <input type="hidden" value="<?=$date?>" name="date">
			   <input type="submit" name="view" value="View">
			   </form>
			   </td>
			   </tr>
			   <?php
		   } ?>
			</tbody>
			<tfoot>
             <?php foreach($tbl_openno as  $key=> $val){
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
			   </tr>
			<?php 
			   }
			} ?>
        </tfoot>
    </table>

</div>

<?php // echo '<pre>'; print_r($tbl_openno); echo '</pre>';?>
