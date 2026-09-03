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
                    <div class="clearfix"></div>
                </div>

                <?php //print_r($tbl_shift) 
                ?>

                <div class="x_content">
                    <?php if ($error) { ?>
                        <div class="alert alert-danger alert-dismissible " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong><?= $error ?></strong>
                        </div>
                    <?php } ?>
                    <?php echo form_open('tbl_shift/edit_admin/' . $tbl_shift['id'], array("class" => "form-horizontal")); ?>
                    <div class="row">

<?php //echo '<pre>'; print_r($tbl_shift); die; ?>

                        <div class="col-md-3 col-sm-12  form-group">
                            <label>
                                Shift Name<span class="required">*</span>
                            </label>
                            <input name="shift_name" type="text" value="<?php echo ($this->input->post('shift_name') ? $this->input->post('shift_name') : $tbl_shift['shift_name']); ?>" class="form-control" required>
                        </div>
                        <div class="col-md-3 col-sm-12  form-group">
                            <label>
                                Open Date <span class="required">*</span>
                            </label>
                            <input id="birthday" name="open_date" value="<?php echo ($this->input->post('open_date') ? $this->input->post('open_date') : date('d-m-Y', strtotime($tbl_shift['open_date']))); ?>" class="form-control" type="text" required="required">
                            <script>
                                function timeFunctionLong(input) {
                                    setTimeout(function() {
                                        input.type = 'text';
                                    }, 60000);
                                }
                            </script>
                        </div>
                        <div class="col-md-3 col-sm-12  form-group">
                            <label>
                                Master <span class="required">*</span>
                            </label>
                            <div class="input-group date datetimepicker3">
                                <input name="super_admin" type="text" value="<?php echo ($this->input->post('super_admin') ? $this->input->post('super_admin') : $tbl_shift['super_admin']); ?>" class="form-control ">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12  form-group">
                            <label>
                                App Result Time <span class="required">*</span>
                            </label>
                            <?php $app_result_time_value = $this->input->post('app_result_time') ? $this->input->post('app_result_time') : (!empty($tbl_shift['app_result_time']) ? date('h:i A', strtotime($tbl_shift['app_result_time'])) : ''); ?>
                            <div class="input-group date datetimepicker3">
                                <input name="app_result_time" type="text" value="<?php echo $app_result_time_value; ?>" class="form-control " required>
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
