<?php echo form_open('tbl_ledger/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="ledger_name" class="col-md-4 control-label">Ledger Name</label>
		<div class="col-md-8">
			<input type="text" name="ledger_name" value="<?php echo $this->input->post('ledger_name'); ?>" class="form-control" id="ledger_name" />
			<span class="text-danger"><?php echo form_error('ledger_name');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="real_name" class="col-md-4 control-label">Real Name</label>
		<div class="col-md-8">
			<input type="text" name="real_name" value="<?php echo $this->input->post('real_name'); ?>" class="form-control" id="real_name" />
			<span class="text-danger"><?php echo form_error('real_name');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="group" class="col-md-4 control-label">Group</label>
		<div class="col-md-8">
			<input type="text" name="group" value="<?php echo $this->input->post('group'); ?>" class="form-control" id="group" />
			<span class="text-danger"><?php echo form_error('group');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="dara_rate" class="col-md-4 control-label">Dara Rate</label>
		<div class="col-md-8">
			<input type="text" name="dara_rate" value="<?php echo $this->input->post('dara_rate'); ?>" class="form-control" id="dara_rate" />
			<span class="text-danger"><?php echo form_error('dara_rate');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="akhar_rate" class="col-md-4 control-label">Akhar Rate</label>
		<div class="col-md-8">
			<input type="text" name="akhar_rate" value="<?php echo $this->input->post('akhar_rate'); ?>" class="form-control" id="akhar_rate" />
			<span class="text-danger"><?php echo form_error('akhar_rate');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="grp_name" class="col-md-4 control-label">Grp Name</label>
		<div class="col-md-8">
			<input type="text" name="grp_name" value="<?php echo $this->input->post('grp_name'); ?>" class="form-control" id="grp_name" />
			<span class="text-danger"><?php echo form_error('grp_name');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="mobile" class="col-md-4 control-label">Mobile</label>
		<div class="col-md-8">
			<input type="text" name="mobile" value="<?php echo $this->input->post('mobile'); ?>" class="form-control" id="mobile" />
			<span class="text-danger"><?php echo form_error('mobile');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="updated_by" class="col-md-4 control-label">Updated By</label>
		<div class="col-md-8">
			<input type="text" name="updated_by" value="<?php echo $this->input->post('updated_by'); ?>" class="form-control" id="updated_by" />
			<span class="text-danger"><?php echo form_error('updated_by');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="updated_date" class="col-md-4 control-label">Updated Date</label>
		<div class="col-md-8">
			<input type="text" name="updated_date" value="<?php echo $this->input->post('updated_date'); ?>" class="form-control" id="updated_date" />
		</div>
	</div>
	<div class="form-group">
		<label for="commision" class="col-md-4 control-label">Commision</label>
		<div class="col-md-8">
			<textarea name="commision" class="form-control" id="commision"><?php echo $this->input->post('commision'); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="commission" class="col-md-4 control-label">Commission</label>
		<div class="col-md-8">
			<textarea name="commission" class="form-control" id="commission"><?php echo $this->input->post('commission'); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="tp_commission" class="col-md-4 control-label">Tp Commission</label>
		<div class="col-md-8">
			<textarea name="tp_commission" class="form-control" id="tp_commission"><?php echo $this->input->post('tp_commission'); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="rebate" class="col-md-4 control-label">Rebate</label>
		<div class="col-md-8">
			<textarea name="rebate" class="form-control" id="rebate"><?php echo $this->input->post('rebate'); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="tp_r" class="col-md-4 control-label">Tp R</label>
		<div class="col-md-8">
			<textarea name="tp_r" class="form-control" id="tp_r"><?php echo $this->input->post('tp_r'); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="hissa" class="col-md-4 control-label">Hissa</label>
		<div class="col-md-8">
			<textarea name="hissa" class="form-control" id="hissa"><?php echo $this->input->post('hissa'); ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="col-md-4 control-label">Address</label>
		<div class="col-md-8">
			<textarea name="address" class="form-control" id="address"><?php echo $this->input->post('address'); ?></textarea>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); ?>