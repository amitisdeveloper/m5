<?php echo form_open('tbl_staff/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="password" class="col-md-4 control-label">Password</label>
		<div class="col-md-8">
			<input type="password" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control" id="password" />
			<span class="text-danger"><?php echo form_error('password');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="staff_name" class="col-md-4 control-label">Staff Name</label>
		<div class="col-md-8">
			<input type="text" name="staff_name" value="<?php echo $this->input->post('staff_name'); ?>" class="form-control" id="staff_name" />
			<span class="text-danger"><?php echo form_error('staff_name');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="role" class="col-md-4 control-label">Role</label>
		<div class="col-md-8">
			<input type="text" name="role" value="<?php echo $this->input->post('role'); ?>" class="form-control" id="role" />
			<span class="text-danger"><?php echo form_error('role');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="w_mode" class="col-md-4 control-label">W Mode</label>
		<div class="col-md-8">
			<input type="text" name="w_mode" value="<?php echo $this->input->post('w_mode'); ?>" class="form-control" id="w_mode" />
			<span class="text-danger"><?php echo form_error('w_mode');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="username" class="col-md-4 control-label">Username</label>
		<div class="col-md-8">
			<input type="text" name="username" value="<?php echo $this->input->post('username'); ?>" class="form-control" id="username" />
			<span class="text-danger"><?php echo form_error('username');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="cash_agent" class="col-md-4 control-label">Cash Agent</label>
		<div class="col-md-8">
			<input type="text" name="cash_agent" value="<?php echo $this->input->post('cash_agent'); ?>" class="form-control" id="cash_agent" />
			<span class="text-danger"><?php echo form_error('cash_agent');?></span>
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
		<label for="is_active" class="col-md-4 control-label">Is Active</label>
		<div class="col-md-8">
			<input type="text" name="is_active" value="<?php echo $this->input->post('is_active'); ?>" class="form-control" id="is_active" />
			<span class="text-danger"><?php echo form_error('is_active');?></span>
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