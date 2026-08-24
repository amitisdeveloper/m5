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
								<?php echo form_open('tbl_shift/add_master_submit',array("class"=>"form-horizontal")); ?>
                                    <div class="row">
                                    <input type="hidden" name="shift_id" value="<?=$shift_id?>">
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                               Shift Name<span class="required">*</span>
                                            </label>
                                            <input name="shift_name" type="text" value="<?=$shift_name?>" class="form-control" required>
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


                    

                </div>
				

