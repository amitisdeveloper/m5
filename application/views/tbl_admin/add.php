<?php if ($this->session->userdata['userid'] == '1') {
    $title = 'Master';
} else {
    $title = 'Admin';
} ?>

<div class="">

    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel" style="width:101% !important;">
                <div class="x_title">

                    <div class="title_right">

                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                            <h5><u><?= $title ?></u></h5>
                        </div>

                    </div>

                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
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
                    <?php if ($error) { ?>
                        <div class="alert alert-danger alert-dismissible " role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong><?= $error ?></strong>
                        </div>
                    <?php } ?>
                    <?php echo form_open('tbl_admin/add', array("class" => "form-horizontal")); ?>
                    <div class="row">



                        <div class="col-md-6 col-sm-12  form-group">
                            <label>
                                <?= $title ?> Name <span class="required">*</span>
                            </label>
                            <input type="text" name="admin_name" value="<?php echo $this->input->post('admin_name'); ?>" class="form-control" id="admin_name" required />
                        </div>
                        <div class="col-md-3 col-sm-12  form-group" style="display:none">
                            <label>
                                Role <span class="required">*</span>
                            </label>


                            <select name="role" class="select2_single form-control" tabindex="-1" required>
                                <option value="2" selected><?= $title ?></option>
                                <!--<option value="4">DATA ENTRY OPERATOR </option>-->

                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12  form-group" style="display:none">
                            <label>
                                W-Mode <span class="required">*</span>
                            </label>


                            <select name="w_mode" class="select2_single form-control" tabindex="-1" required>
                                <option>Web</option>

                            </select>
                        </div>
                        <!--<div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                                Role <span class="required">*</span>
                                            </label>
                                            <input id="birthday" class="date-picker form-control" placeholder="dd-mm-yyyy" type="text" required="required" type="text" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
                                            <script>
                                                function timeFunctionLong(input) {
                                                    setTimeout(function () {
                                                        input.type = 'text';
                                                    }, 60000);
                                                }
                                            </script>
                                        </div>-->


                        <div class="col-md-3 col-sm-12  form-group">
                            <label>
                                UserName <span class="required">*</span>
                            </label>

                            <input type="text" name="username" value="<?php echo $this->input->post('username'); ?>" class="form-control" id="username" required="required" />
                        </div>
                        <div class="col-md-3 col-sm-12  form-group">
                            <label>Password <span class="required">*</span>
                            </label>
                            <input type="password" name="password" value="<?php echo $this->input->post('password'); ?>" class="form-control" id="password" required="required" />
                        </div>
                        <div style="display:none" class="col-md-3 col-sm-12  form-group">
                            <label>
                                Agent <span class="required">*</span>
                            </label>


                            <select name="cash_agent" class="select2_single form-control" tabindex="-1" required="required">
                                <option>Cash A/C</option>


                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12  form-group">
                            <label> Mobile
                            </label>
                            <input name="mobile" type="text" class="form-control">
                        </div>
                        <div class="col-md-3 col-sm-12  form-group">
                            <label> Address
                            </label>
                            <textarea name="address" class="form-control" id="address"><?php echo $this->input->post('address'); ?></textarea>
                        </div>
                        <div class="col-md-3 col-sm-12  form-group" style="margin-top: 45px;">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitches" name="is_active">
                                <label class="custom-control-label" for="customSwitches">Active</label>
                            </div> 
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitches">
                                <label class="custom-control-label" for="customSwitches">Lock Master</label>
                            </div>
                            <input type="checkbox" class="btn-check" id="btn-check-outlined" autocomplete="off">
                            <label class="btn btn-outline-primary" for="btn-check-outlined">Automatic Jantri</label><br>
                        </div>
                    </div>

                    <div class="col-md-3 col-sm-3 offset-md-3" style="margin-top: -108px;float: right;/* margin-left:27%; */">
                        <th>
                            <label> Patti</label>
                            <input type="text" name="hissa" class="form-control" autocomplete="off">

                        </th>
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
                            <th><?= $title ?> Name</th>
                            <th>User Name</th>
                            <th>Password</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tbl_admin as $key => $t) { 
						if($t['id']!='1'){?>
                            <tr>
                                <td><?php echo $key + 1; ?></td>

                                <td><?php echo $t['admin_name']; ?></td>
                                <td><?php echo $t['user_name']; ?></td>
                                <td><?php echo $t['password']; ?></td>
                                <td><?php echo $t['mobile']; ?></td>
                                <td><?php echo $t['address']; ?></td>

                                <td>
                                    <a href="<?php echo site_url('tbl_admin/edit/' . $t['id']); ?>" class="btn btn-info btn-xs">Edit</a>
                                    <a onclick="return confirm('Are you sure you want to delete?')" href="<?php echo site_url('tbl_admin/remove/' . $t['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
                                </td>
                            </tr>
                        <?php } 
						}?>

                    </tbody>
                </table>
                <div class="clearfix"></div>
            </div>

        </div>
    </div>

</div>