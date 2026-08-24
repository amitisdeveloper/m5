<div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel" style="width:101% !important;">
                                <div class="x_title">

                                    <div class="title_right">

                                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                                            <h5><u>Add Voucher</u></h5>
                                        </div>

                                    </div>

                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                    </ul>
                                   
                                    <div class="clearfix"></div>
                                </div>



                                <div class="x_content">
															<?php echo form_open('tbl_voucher/add'); ?>
<div class="row">
	<div class="col-md-4 col-sm-12  form-group">
		<label>Payment Collect : </label>
		<select class="form-control autoselected" name="PartyId">
			<option value="">---</option>
			<?php 
			foreach($all_tbl_ledger as $tbl_ledger)
			{
				$selected = ($tbl_ledger['id'] == $this->input->post('PartyId')) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_ledger['id'].'" '.$selected.'>'.$tbl_ledger['ledger_name'].'</option>';
			} 
			?>
		</select>
		<span class="text-danger"><?php echo form_error('PartyId');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<Label>Payment Deposite :</Label> 
		<select  class="form-control autoselected" name="Collect_By">
			<option value="">---</option>
			<?php 
			foreach($all_tbl_ledger as $tbl_ledger) 
			{
				$selected = ($tbl_ledger['id'] == $this->input->post('Collect_By')) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_ledger['id'].'" '.$selected.'>'.$tbl_ledger['ledger_name'].'</option>';
			} 
			?>
		</select>
		<span class="text-danger"><?php echo form_error('Collect_By');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<label>Date :</label> 
		<input id="birthday" class="form-control" type="text" name="Date" value="<?php echo $this->input->post('Date'); ?>" />
		<span class="text-danger"><?php echo form_error('Date');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<label>Amount :</label> 
		<input class="form-control" type="text" name="Amount" value="<?php echo $this->input->post('Amount'); ?>" />
		<span class="text-danger"><?php echo form_error('Amount');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<label>Remarks :</label> 
		<textarea class="form-control" name="Remarks"><?php echo $this->input->post('Remarks'); ?></textarea>
		<span class="text-danger"><?php echo form_error('Remarks');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group sbmtbtn" >
	<!--<div class="col-md-8 col-sm-12  form-group">
		<Label>Voucher Type :</Label> 
		<select  class="form-control" name="voucher_type">
			<option value="">---</option>
			<option value="c">Credit</option>
			<option value="d">Debit</option>
		</select>
		<span class="text-danger"><?php echo form_error('voucher_type');?></span>
	</div>-->
	<div class="col-md-4 col-sm-12  form-group">
	<button class="btn btn-success" style="padding: 0.345rem 1.75rem;margin-top: 26px;" type="submit">Save</button>
	</div>
</div>
</div>
<?php echo form_close(); ?>								</div>
                            </div>
                        </div>
                    </div>
					
					<table border="1" id="dtable" class="display" style="width:100%">
    <thead><tr>
		<th>ID</th>
		<th>PartyId</th>
		<th>Collect By</th>
		<th>Date</th>
		<th>Amount</th>
		<th>Remarks</th>
		<th>Actions</th>
    </tr></thead>
	<tbody>
	<?php foreach($tbl_voucher as $t){ 
	?>
    <tr>
		<td><?php echo $t['id']; ?></td>
		<td><?php echo $t['partyname']; ?></td>
		<td><?php echo $t['collectedby']; ?></td>
		<td><?php echo date('d-m-Y',strtotime($t['Date'])); ?></td>
		<td><?php echo $t['Amount']; ?></td>
		<td><?php echo $t['Remarks']; ?></td>
		<td>
            <a href="<?php echo site_url('tbl_voucher/edit/'.$t['id']); ?>">Edit</a> | 
            <a href="<?php echo site_url('tbl_voucher/remove/'.$t['id']); ?>" onclick="return confirm('Are you sure you want to delete this Voucher?');">Delete</a>
        </td>
    </tr>
	<?php } ?>
	</tbody>
	   <tfoot><tr>
		<th>ID</th>
		<th>PartyId</th>
		<th>Collect By</th>
		<th>Date</th>
		<th>Amount</th>
		<th>Remarks</th>
		<th>Actions</th>
    </tr></tfoot>
</table>
<div class="pull-right">
    <?php echo $this->pagination->create_links(); ?>    
</div>
					
					<style>
					.col-md-4.col-sm-12.form-group.sbmtbtn {
    display: flex;
    /* flex-direction: column; */
}
.sbmtbtn button.btn.btn-success{
	margin-top:auto;
}

					</style>
					<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
					<script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
					<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
					<script>
					jQuery(document).ready( function ($) {
						//$.noConflict();
    $('#dtable').DataTable();
} );
					</script>




