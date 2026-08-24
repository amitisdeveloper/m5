<script>
function caldays(val) {
    var a = $("#datepicker_start").datepicker('getDate').getTime(),
        b = $("#datepicker_ends").datepicker('getDate').getTime(),
        c = 24*60*60*1000;
		if(a&b){
        diffDays = Math.round(Math.abs((a - b)/(c)));
    console.log(diffDays); //show difference
	$("#remdays").val(diffDays);
}
}
function calckist(val){
	//alert(val.value);
	var tamnt = val.value;
	var nofdays = document.getElementById('remdays').value;
	document.getElementById('total_amnt').value = tamnt/nofdays;
}
</script>
<div class="row">
	<div class="col-md-12 col-sm-12 ">
		<div class="x_panel"
		     style="width:101% !important;">
			<div class="x_title">
				<div class="title_right">
					<div class="col-md-5 col-sm-5  form-group pull-right top_search"
					     style="margin-top:10px;">
						<h5>
							<u>Add kist</u>
						</h5>
					</div>
				</div>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
<?php echo form_open('tbl_kist/add'); ?>
				<div class="row">
					<div class="col-md-4 col-sm-12  form-group">
						<label>Select Party :</label>
						<select class="form-control"
						        name="PartyId">
							<option value="">---</option>
<?php
			foreach($all_tbl_ledger as $tbl_ledger)
			{
				$selected = ($tbl_ledger['id'] == $this->input->post('PartyId')) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_ledger['id'].'" '.$selected.'>'.$tbl_ledger['ledger_name'].'</option>';
			}
			?>
						</select>
						<span class="text-danger"><?php echo form_error('PartyId');?>
						</span>
					</div>
					<div class="col-md-4 col-sm-12  form-group">
						<Label>From Date :</Label>
						<input type="text" name="frdate" onchange="caldays(this)" id="datepicker_start" class="form-control birthday" value="">
						<span class="text-danger"><?php echo form_error('Collect_By');?>
						</span>
					</div>
					<div class="col-md-4 col-sm-12  form-group">
						<label>To Date :</label>
						<input 
						       class="form-control birthday"
							   id="datepicker_ends"
						       type="text"
						       name="todate"
							   onchange="caldays(this)"
						       value="<?php echo $this->input->post('Date'); ?>"/>
						<span class="text-danger"><?php echo form_error('Date');?>
						</span>
					</div>
					<div class="col-md-4 col-sm-12  form-group">
						<label>Total Balance Amount :</label>
						<input class="form-control"								
						       type="text"
						       name="totalamt"
							   onkeyup="calckist(this)"
						       value="<?php echo $this->input->post('Amount'); ?>"/>
						<span class="text-danger"><?php echo form_error('Amount');?>
						</span>
					</div>
					<!--<div class="col-md-4 col-sm-12  form-group">
						<label>Total Paid Amount :</label>
						<input class="form-control"
						       type="text"
						       name="paid"
						       value="<?php echo $this->input->post('Amount'); ?>"/>
						<span class="text-danger"><?php echo form_error('Amount');?>
						</span>
					</div>
					<div class="col-md-4 col-sm-12  form-group">
						<label>Total Remaining Amount :</label>
						<input class="form-control"
						       type="text"
						       name="remain"
						       value="<?php echo $this->input->post('Amount'); ?>"/>
						<span class="text-danger"><?php echo form_error('Amount');?>
						</span>
					</div>-->
					<div class="col-md-4 col-sm-12  form-group">
						<label>Total no of days :</label>
						<input class="form-control"
						       type="text"
						       name="days"
							   id="remdays"
							   readonly 
						       value=""/>
						<span class="text-danger"><?php echo form_error('Amount');?>
						</span>
					</div>
					<div class="col-md-4 col-sm-12  form-group">
						<label>Kist Amount :</label>
						<input class="form-control"
						       type="text"
							   id="total_amnt"
						       name="kist"
							   readonly
						       value="<?php echo $this->input->post('Amount'); ?>"/>
						<span class="text-danger"><?php echo form_error('Remarks');?>
						</span>
					</div>
					<div class="col-md-4 col-sm-12  form-group sbmtbtn">
						<button class="btn btn-success"
						        style="padding: .375rem 2.75rem;"
						        type="submit">Save</button>
					</div>
				</div>
<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<table border="1"
       id="dtable"
       class="display"
       style="width:100%">
	<thead>
		<tr>
			<th>ID</th>
			<th>PartyId</th>
			<th>From Date</th>
			<th>To Date</th>
			<th>Total Amount</th>
			<th>No Of Days</th>
			<th>Kist Amount</th>
			<th>Actions</th>
		</tr>
	</thead>
	<tbody>
<?php foreach($tbl_kist as $t){
	?>
		<tr>
			<td><?php echo $t['id']; ?>
			</td>
			<td><?php echo $t['partyname']; ?>
			</td>
			
			<td><?php echo date('d-m-Y',strtotime($t['frdate'])); ?>
			</td>
			<td><?php echo date('d-m-Y',strtotime($t['todate'])); ?>
			</td>
			<td><?php echo $t['totalamt']; ?>
			</td>
			
			<td><?php echo $t['days']; ?>
			</td>
			<td><?php echo $t['kist']; ?>
			</td>
			<td>
				<a href="<?php echo site_url('tbl_kist/edit/'.$t['id']); ?>">Edit</a>|
				<a href="<?php echo site_url('tbl_kist/remove/'.$t['id']); ?>">Delete</a>
			</td>
		</tr>
<?php } ?>
	</tbody>
	<tfoot>
		<tr>
			<th>ID</th>
			<th>PartyId</th>
			<th>Collect By</th>
			<th>Date</th>
			<th>Amount</th>
			<th>Remarks</th>
			<th>Actions</th>
		</tr>
	</tfoot>
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
<link rel="stylesheet"
      href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"/>
	<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"/>
	<script>
					jQuery(document).ready( function ($) {
						//$.noConflict();
    $('#dtable').DataTable();
} );

	</script>




