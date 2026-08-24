<?php echo form_open('tbl_shift/edit/'.$tbl_shift['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="shift_name" class="col-md-4 control-label">Shift Name</label>
		<div class="col-md-8">
			<input type="text" name="shift_name" value="<?php echo ($this->input->post('shift_name') ? $this->input->post('shift_name') : $tbl_shift['shift_name']); ?>" class="form-control" id="shift_name" />
			<span class="text-danger"><?php echo form_error('shift_name');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="open_date" class="col-md-4 control-label">Open Date</label>
		<div class="col-md-8">
			<input type="text" name="open_date" value="<?php echo ($this->input->post('open_date') ? $this->input->post('open_date') : $tbl_shift['open_date']); ?>" class="form-control" id="open_date" />
		</div>
	</div>
	<div class="form-group">
		<label for="next_day" class="col-md-4 control-label">Next Day</label>
		<div class="col-md-8">
			<input type="text" name="next_day" value="<?php echo ($this->input->post('next_day') ? $this->input->post('next_day') : $tbl_shift['next_day']); ?>" class="form-control" id="next_day" />
			<span class="text-danger"><?php echo form_error('next_day');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="shift_working_for" class="col-md-4 control-label">Shift Working For</label>
		<div class="col-md-8">
			<input type="text" name="shift_working_for" value="<?php echo ($this->input->post('shift_working_for') ? $this->input->post('shift_working_for') : $tbl_shift['shift_working_for']); ?>" class="form-control" id="shift_working_for" />
			<span class="text-danger"><?php echo form_error('shift_working_for');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="owner" class="col-md-4 control-label">Owner</label>
		<div class="col-md-8">
			<input type="text" name="owner" value="<?php echo ($this->input->post('owner') ? $this->input->post('owner') : $tbl_shift['owner']); ?>" class="form-control" id="owner" />
		</div>
	</div>
	<div class="form-group">
		<label for="super_admin" class="col-md-4 control-label">Super Admin</label>
		<div class="col-md-8">
			<input type="text" name="super_admin" value="<?php echo ($this->input->post('super_admin') ? $this->input->post('super_admin') : $tbl_shift['super_admin']); ?>" class="form-control" id="super_admin" />
		</div>
	</div>
	<div class="form-group">
		<label for="fanter" class="col-md-4 control-label">Fanter</label>
		<div class="col-md-8">
			<input type="text" name="fanter" value="<?php echo ($this->input->post('fanter') ? $this->input->post('fanter') : $tbl_shift['fanter']); ?>" class="form-control" id="fanter" />
		</div>
	</div>
	<div class="form-group">
		<label for="cash_agent" class="col-md-4 control-label">Cash Agent</label>
		<div class="col-md-8">
			<input type="text" name="cash_agent" value="<?php echo ($this->input->post('cash_agent') ? $this->input->post('cash_agent') : $tbl_shift['cash_agent']); ?>" class="form-control" id="cash_agent" />
		</div>
	</div>
	<div class="form-group">
		<label for="admin" class="col-md-4 control-label">Admin</label>
		<div class="col-md-8">
			<input type="text" name="admin" value="<?php echo ($this->input->post('admin') ? $this->input->post('admin') : $tbl_shift['admin']); ?>" class="form-control" id="admin" />
		</div>
	</div>
	<div class="form-group">
		<label for="data_entry_operator" class="col-md-4 control-label">Data Entry Operator</label>
		<div class="col-md-8">
			<input type="text" name="data_entry_operator" value="<?php echo ($this->input->post('data_entry_operator') ? $this->input->post('data_entry_operator') : $tbl_shift['data_entry_operator']); ?>" class="form-control" id="data_entry_operator" />
		</div>
	</div>
	<div class="form-group">
		<label for="is_active" class="col-md-4 control-label">Is Active</label>
		<div class="col-md-8">
			<input type="text" name="is_active" value="<?php echo ($this->input->post('is_active') ? $this->input->post('is_active') : $tbl_shift['is_active']); ?>" class="form-control" id="is_active" />
			<span class="text-danger"><?php echo form_error('is_active');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="updated_by" class="col-md-4 control-label">Updated By</label>
		<div class="col-md-8">
			<input type="text" name="updated_by" value="<?php echo ($this->input->post('updated_by') ? $this->input->post('updated_by') : $tbl_shift['updated_by']); ?>" class="form-control" id="updated_by" />
			<span class="text-danger"><?php echo form_error('updated_by');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="updated_date" class="col-md-4 control-label">Updated Date</label>
		<div class="col-md-8">
			<input type="text" name="updated_date" value="<?php echo ($this->input->post('updated_date') ? $this->input->post('updated_date') : $tbl_shift['updated_date']); ?>" class="form-control" id="updated_date" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>