<?php echo form_open('tbl_agent/edit/'.$tbl_agent['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="agent_name" class="col-md-4 control-label">Agent Name</label>
		<div class="col-md-8">
			<input type="text" name="agent_name" value="<?php echo ($this->input->post('agent_name') ? $this->input->post('agent_name') : $tbl_agent['agent_name']); ?>" class="form-control" id="agent_name" />
			<span class="text-danger"><?php echo form_error('agent_name');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="main_agent_name" class="col-md-4 control-label">Main Agent Name</label>
		<div class="col-md-8">
			<input type="text" name="main_agent_name" value="<?php echo ($this->input->post('main_agent_name') ? $this->input->post('main_agent_name') : $tbl_agent['main_agent_name']); ?>" class="form-control" id="main_agent_name" />
			<span class="text-danger"><?php echo form_error('main_agent_name');?></span>
		</div>
	</div>
	
	<div class="form-group">
		<label for="updated_by" class="col-md-4 control-label">Updated By</label>
		<div class="col-md-8">
			<input type="text" name="updated_by" value="<?php echo ($this->input->post('updated_by') ? $this->input->post('updated_by') : $tbl_agent['updated_by']); ?>" class="form-control" id="updated_by" />
			<span class="text-danger"><?php echo form_error('updated_by');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="updated_date" class="col-md-4 control-label">Updated Date</label>
		<div class="col-md-8">
			<input type="text" name="updated_date" value="<?php echo ($this->input->post('updated_date') ? $this->input->post('updated_date') : $tbl_agent['updated_date']); ?>" class="form-control" id="updated_date" />
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?php echo form_close(); ?>