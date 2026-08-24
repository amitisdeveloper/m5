<div class="">

                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel" style="width:101% !important;">
                                <div class="x_title">

                                    <div class="title_right">

                                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                                            <h5><u>Add Shift</u></h5>
                                        </div>

                                    </div>

                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                    </ul>
                                    <div class="nav navbar-right panel_toolbox  form-group pull-right top_search">
                                        <div class="input-group" style="width:98%;">
                                            <input type="text" class="form-control" placeholder="Search for...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Go!</button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>



                                <div class="x_content">
								<?php if($error){ ?>
									<div class="alert alert-danger alert-dismissible " role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<strong><?=$error?></strong>
</div>
								<?php }?>
								<?php echo form_open('tbl_shift/add',array("class"=>"form-horizontal")); ?>
                                    <div class="row">



                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                               Shift Name<span class="required">*</span>
                                            </label>
                                            <input name="shift_name" type="text" class="form-control" required>
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Open Date <span class="required">*</span>
                                            </label>
                                            <input id="birthday" name="open_date" class="form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" >
                                            <script>
                                                function timeFunctionLong(input) {
                                                    setTimeout(function () {
                                                        input.type = 'text';
                                                    }, 60000);
                                                }
                                            </script>
                                        </div>

                                        <!--<div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Next Day <span class="required">*</span>
                                            </label>
                                            <input name="next_day" type="text" class="form-control" required>
                                        </div>-->
                                        <!-- <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Shift Working For <span class="required">*</span>
                                            </label>


                                            <select name="shift_working_for" class="select2_single form-control" tabindex="-1">
                                                <option value="Web Panel">Web Panel </option>
                                            </select>
                                        </div> -->
                                        <!--<div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Owner <span class="required">*</span>
                                            </label>
											<div class="input-group date datetimepicker3">
                                            <input name="owner" type="text" class="form-control ">
											<span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
			   </div>
                                        </div>-->
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Master <span class="required">*</span>
                                            </label>
                                         <div class="input-group date datetimepicker3">
                                            <input name="master" type="text" class="form-control ">
											<span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
			   </div>
                                        </div>
										<!--
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Fanter <span class="required">*</span>
                                            </label>
                                            <div class="input-group date datetimepicker3">
                                            <input name="fanter" type="text" class="form-control ">
											<span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
			   </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Cash Agent <span class="required">*</span>
                                            </label>
                                            <div class="input-group date datetimepicker3">
                                            <input name="cash_agent" type="text" class="form-control ">
											<span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
			   </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Admin <span class="required">*</span>
                                            </label>
                                           <div class="input-group date datetimepicker3">
                                            <input name="admin" type="text" class="form-control ">
											<span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
			   </div>
                                        </div>-->
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                App Timing <span class="required">*</span>
                                            </label>
                                            <div class="input-group date datetimepicker3">
                                            <input name="app_time" type="text" class="form-control ">
											<span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
			   </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Data Entry Operator<span class="required">*</span>
                                            </label>
                                            <div class="input-group date datetimepicker3">
                                            <input name="data_entry_operator" type="text" class="form-control ">
											<span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
			   </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 offset-md-3" style="margin-top:39px;">
                                        
                                        <button type="submit" class="btn btn-success" style="padding: .375rem 2.75rem;">Submit</button>
                                    </div>
                                <?php echo form_close(); ?>
								</div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel" style="width:101%;">
                            <div class="x_title">

                                <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size:12px;">
                                    <thead>
									
                                        <tr>
                                            <th>Sr</th>
                                            <th>Shift name</th>
                                            <th>Open Date</th>
                                            <th>Updated Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($tbl_shift as $key => $t){ //echo '<pre>'; print_r($t);//die; ?>
                                        <tr>
										
		<td><?php echo $key+1; ?></td>
		<td><?php echo $t['shift_name']; ?></td>
		<td><?php echo date($t['open_date']); ?></td>
		<td><?php echo $t['updated_date']; ?></td>
		<?php 
		
		/*if($_SESSION['role']=='Master' && ($t['updated_by'] == 1)){
            ?>
        <td id="here">
            <a href="<?php echo site_url('tbl_shift/edit/'.$t['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <!-- <a href="#" class="btn btn-danger btn-xs">N/A</a> -->
        </td>
        <?php
        }
        else */
        //if($_SESSION['role']=='Master' && ($t['updated_by'] != 1)){
            ?>
            <td id="there">
                <?php if($t['id']) { ?>
                    <a href="<?php echo site_url('tbl_shift/edit/'.$t['id']) ?>" class="btn btn-info btn-xs">Edit</a> 
               <?php }
               else{
                ?>
                <a href="<?php echo site_url('tbl_shift/add_master/'.$t['shift_name'].'/'.$t['tbl_shift_id']) ?>" class="btn btn-info btn-xs">Edit</a> 
                <?php
               } 
               ?>
                
                <!-- <a href="<?php echo site_url('tbl_shift/remove/'.$t['id']); ?>" class="btn btn-danger btn-xs">N/A</a> -->
            </td>
            <?php
        //} ?>
            </tr>
									<?php } ?>

                                    </tbody>
                                </table>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                    </div>

                </div>


<?php /* echo form_open('tbl_shift/add',array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="shift_name" class="col-md-4 control-label">Shift Name</label>
		<div class="col-md-8">
			<input type="text" name="shift_name" value="<?php echo $this->input->post('shift_name'); ?>" class="form-control" id="shift_name" />
			<span class="text-danger"><?php echo form_error('shift_name');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="open_date" class="col-md-4 control-label">Open Date</label>
		<div class="col-md-8">
			<input type="text" name="open_date" value="<?php echo $this->input->post('open_date'); ?>" class="form-control" id="open_date" />
		</div>
	</div>
	<div class="form-group">
		<label for="next_day" class="col-md-4 control-label">Next Day</label>
		<div class="col-md-8">
			<input type="text" name="next_day" value="<?php echo $this->input->post('next_day'); ?>" class="form-control" id="next_day" />
			<span class="text-danger"><?php echo form_error('next_day');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="shift_working_for" class="col-md-4 control-label">Shift Working For</label>
		<div class="col-md-8">
			<input type="text" name="shift_working_for" value="<?php echo $this->input->post('shift_working_for'); ?>" class="form-control" id="shift_working_for" />
			<span class="text-danger"><?php echo form_error('shift_working_for');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="owner" class="col-md-4 control-label">Owner</label>
		<div class="col-md-8">
			<input type="text" name="owner" value="<?php echo $this->input->post('owner'); ?>" class="form-control datetimepicker3" id="owner" />
			<span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
		</div>
	</div>
	<div class="form-group">
		<label for="super_admin" class="col-md-4 control-label">Super Admin</label>
		<div class="col-md-8">
			<input type="text" name="super_admin" value="<?php echo $this->input->post('super_admin'); ?>" class="form-control datetimepicker3" id="super_admin" />
		</div>
	</div>
	<div class="form-group">
		<label for="fanter" class="col-md-4 control-label">Fanter</label>
		<div class="col-md-8">
			<input type="text" name="fanter" value="<?php echo $this->input->post('fanter'); ?>" class="form-control datetimepicker3" id="fanter" />
		</div>
	</div>
	<div class="form-group">
		<label for="cash_agent" class="col-md-4 control-label">Cash Agent</label>
		<div class="col-md-8">
			<input type="text" name="cash_agent" value="<?php echo $this->input->post('cash_agent'); ?>" class="form-control datetimepicker3" id="cash_agent" />
		</div>
	</div>
	<div class="form-group">
		<label for="admin" class="col-md-4 control-label">Admin</label>
		<div class="col-md-8">
			<input type="text" name="admin" value="<?php echo $this->input->post('admin'); ?>" class="form-control datetimepicker3" id="admin" />
		</div>
	</div>
	<div class="form-group">
		<label for="data_entry_operator" class="col-md-4 control-label">Data Entry Operator</label>
		<div class="col-md-8">
			<input type="text" name="data_entry_operator" value="<?php echo $this->input->post('data_entry_operator'); ?>" class="form-control datetimepicker3" id="data_entry_operator" />
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
		<div class="col-sm-offset-4 col-sm-8">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>

<?php echo form_close(); */?>
