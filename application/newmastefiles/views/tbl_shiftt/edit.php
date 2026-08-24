<div class="">

                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel" style="width:101% !important;">
                                <div class="x_title">

                                    <div class="title_right">

                                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                                            <h5><u>Edit Shift</u></h5>
                                        </div>

                                    </div>

                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                    </ul>
                                    <!-- <div class="nav navbar-right panel_toolbox  form-group pull-right top_search">
                                        <div class="input-group" style="width:98%;">
                                            <input type="text" class="form-control" placeholder="Search for...">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Go!</button>
                                            </span>
                                        </div>
                                    </div> -->
                                    <div class="clearfix"></div>
                                </div>

<?php //print_r($tbl_shift_time) ?>

                                <div class="x_content">
								<?php if($error){ ?>
									<div class="alert alert-danger alert-dismissible " role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<strong><?=$error?></strong>
</div>
								<?php }?>
								<?php 
                                $shift_id = (isset($tbl_shift_time['shift_id']))?$tbl_shift_time['shift_id']:$tbl_shift_time['id'];
                                $updatedby = (isset($tbl_shift_time['shift_id']))?'shift_id':'id';
                                echo form_open('tbl_shift/edit/'.$tbl_shift_time['id'],array("class"=>"form-horizontal")); ?>
                                <input type="hidden" name="updated_by" value="<?=$updatedby?>">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                               Shift Name<span class="required">*</span>
                                            </label>
                                            <input name="shift_name" type="text" value="<?php echo ($this->input->post('shift_name') ? $this->input->post('shift_name') : $tbl_shift_time['shift_name']); ?>" class="form-control" required>
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Open Date <span class="required">*</span>
                                            </label>
                                            <input id="birthday" name="open_date" value="<?php echo ($this->input->post('open_date') ? $this->input->post('open_date') : date('d-m-Y',strtotime($tbl_shift_time['open_date']))); ?>" class="form-control"  type="text" required="required" >
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
                                            <input name="next_day" type="text" value="<?php echo ($this->input->post('next_day') ? $this->input->post('next_day') : $tbl_shift_time['next_day']); ?>" class="form-control" required>
                                        </div>-->
                                        <div class="col-md-3 col-sm-12  form-group" style="display:none">
                                            <label>
                                                Shift Working For <span class="required">*</span>
                                            </label>


                                            <select name="shift_working_for" class="select2_single form-control" tabindex="-1">
                                                <option value="Web Panel">Web Panel </option>
                                            </select>
                                        </div>
                                       <!-- <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Owner <span class="required">*</span>
                                            </label>
											<div class="input-group date datetimepicker3">
                                            <input name="owner" type="text" value="<?php echo ($this->input->post('owner') ? $this->input->post('owner') : $tbl_shift_time['owner']); ?>" class="form-control ">
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
                                            <input name="master" type="text" value="<?php echo ($this->input->post('master') ? $this->input->post('master') : $tbl_shift_time['master']); ?>" class="form-control ">
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
                                            <input name="fanter" type="text" value="<?php echo ($this->input->post('fanter') ? $this->input->post('fanter') : $tbl_shift_time['fanter']); ?>" class="form-control ">
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
                                            <input name="cash_agent" value="<?php echo ($this->input->post('cash_agent') ? $this->input->post('cash_agent') : $tbl_shift_time['cash_agent']); ?>" type="text" class="form-control ">
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
                                            <input name="admin" type="text" value="<?php echo ($this->input->post('admin') ? $this->input->post('admin') : $tbl_shift_time['admin']); ?>" class="form-control ">
											<span class="input-group-addon">
               <span class="glyphicon glyphicon-time"></span>
               </span>
			   </div>
                                        </div>-->
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                App Time<span class="required">*</span>
                                            </label>
                                            <div class="input-group date datetimepicker3">
                                            <input name="app_time" type="text" value="<?php echo ((!empty($this->input->post('app_time'))) ? $this->input->post('app_time') : $tbl_shift_time['app_time']); ?>" class="form-control ">
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
                                            <input name="data_entry_operator" type="text" value="<?php echo ($this->input->post('data_entry_operator') ? $this->input->post('data_entry_operator') : $tbl_shift_time['data_entry_operator']); ?>" class="form-control ">
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


                    

                </div>
				

