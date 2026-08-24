<div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel" style="width:101% !important;">
                                <div class="x_title">

                                    <div class="title_right">

                                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                                            <h5><u>Edit Voucher</u></h5>
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
															<?php echo form_open('tbl_voucher/edit/'.$tbl_voucher['id']); ?>
<div class="row">
	<div class="col-md-4 col-sm-12  form-group">
		<label>Select Party : </label>
		<select class="form-control" name="PartyId">
			<option value="">---</option>
			<?php 
			foreach($all_tbl_ledger as $tbl_ledger)
			{
				$selected = ($tbl_ledger['id'] == $tbl_voucher['PartyId']) ? ' selected="selected"' : "";
				echo '<option value="'.$tbl_ledger['id'].'" '.$selected.'>'.$tbl_ledger['ledger_name'].'</option>';
			} 
			?>
		</select>
		<span class="text-danger"><?php echo form_error('PartyId');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<Label>Collected By :</Label> 
		<select  class="form-control" name="Collect_By">
			<option value="">---</option>
			<?php 
			foreach($all_tbl_ledger as $tbl_ledger)
			{
				$selected = ($tbl_ledger['id'] == $tbl_voucher['Collect_By']) ? ' selected="selected"' : "";

				echo '<option value="'.$tbl_ledger['id'].'" '.$selected.'>'.$tbl_ledger['ledger_name'].'</option>';
			} 
			?>
		</select>
		<span class="text-danger"><?php echo form_error('Collect_By');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<label>Date :</label> 
		<input id="birthday" class="form-control" type="text" name="Date" value="<?php echo ($this->input->post('Date') ? $this->input->post('Date') : $tbl_voucher['Date']); ?>" />
		<span class="text-danger"><?php echo form_error('Date');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<label>Amount :</label> 
		<input class="form-control" type="text" name="Amount" value="<?php echo ($this->input->post('Amount') ? $this->input->post('Amount') : $tbl_voucher['Amount']); ?>" />
		<span class="text-danger"><?php echo form_error('Amount');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<label>Remarks :</label> 
		<textarea class="form-control" name="Remarks"><?php echo ($this->input->post('Remarks') ? $this->input->post('Remarks') : $tbl_voucher['Remarks']); ?></textarea>
		<span class="text-danger"><?php echo form_error('Remarks');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group sbmtbtn" >
	<div class="col-md-8 col-sm-12  form-group">
		<Label>Voucher Type :</Label> 
		<select  class="form-control" name="voucher_type">
			<option value="">---</option>
			<option value="c">Credit</option>
			<option value="d">Debit</option>
		</select>
		<span class="text-danger"><?php echo form_error('voucher_type');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
	<button class="btn btn-success" style="padding: 0.345rem 1.75rem;margin-top: 26px;" type="submit">Save</button>
	</div>
</div>
</div>
<?php echo form_close(); ?>								</div>
                            </div>
                        </div>
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




