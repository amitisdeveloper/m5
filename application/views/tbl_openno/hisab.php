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
<form action="" name="search_final_result" method="get">
<div class="col-sm-12 col-md-12">

<div class="col-md-4 col-sm-12  form-group"><label>Select Ledger :</label>
<select name="search_party" class="form-control" >
<option value="">-Please Select-</option>
<?php foreach($tbl_ledger as $key => $val){
	echo '<option value="'.$val['id'].'" '.(($this->input->post('search_party')==$val['id']) ? 'selected' :'').'>'.$val['ledger_name'].'</option>';
}?>
</select>
</div>
<div class="col-md-4 col-sm-12  form-group"><label>Hisab Till Date :</label><input id="fromdate" class="birthday form-control" type="text" name="fromdate" value="" placeholder="Hisab Till Date"></div>
<div class="col-md-4 col-sm-12  form-group"><label> &nbsp;</label><input type="submit" name="Search" Value="Search" class="btn form-control btn-success"></div>


</div>
</form>
<?php //echo '<pre>'; print_r($tbl_openno); echo '</pre>'; //die;?>
<table id="example" class="ui celled table" style="width:100%">
        <thead>
            <?php foreach($tbl_openno as  $key=> $val){
			   if($key==0){
			   ?>
			   <tr>
			   <?php unset($val['id']); unset($val['ShiftId']); unset($val['PartyId']); 
			   ?><th>Date</th>
			   <th>Till Date Amount</th>
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
			  // $date = $val['Date'];
			   unset($val['id']); unset($val['ShiftId']); unset($val['PartyId']); 
			   ?><td><?=$_GET['fromdate']?></td><?php
			   foreach($val as $keyy => $vall){
				   
				   ?>
				   <td><?=$vall?></td>
				   <?php
			   }
			   ?>
			   <td>
			   <form action="ledger_till_date_report" name="tdreport" method="get">
			   <input type="hidden" value="<?=$ledger_id?>" name="ledger_id">
			   <input type="hidden" value="<?=$_GET['fromdate']?>" name="date">
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
			   <th>Date</th>
			   <th>Till Date Amount</th>
			   <th>Action</th>
			   </tr>
			<?php 
			   }
			} ?>
        </tfoot>
    </table>

</div>

<?php // echo '<pre>'; print_r($tbl_openno); echo '</pre>';?>