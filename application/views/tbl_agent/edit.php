<div class="">

                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel" style="width:101% !important;">
                                <div class="x_title">

                                    <div class="title_right">

                                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                                            <h5><u>Agent</u></h5>
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
                                            <!--<span class="input-group-btn">
                                                <button class="btn btn-default" type="button">Go!</button>
                                            </span>-->
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>


<?php echo form_open('tbl_agent/edit/'.$tbl_agent['id'],array("class"=>"form-horizontal")); ?>
                                <div class="x_content">
								<?php if($error){ ?>
									<div class="alert alert-danger alert-dismissible " role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<strong><?=$error?></strong>
</div>
								<?php }?>
                                    <div class="row">
                                       <div class="col-md-6 col-sm-12  form-group">
                                            <label>
                                               Agent Name <span class="required">*</span>
                                            </label>
                                            <input type="text" name="agent_name" value="<?php echo ($this->input->post('agent_name') ? $this->input->post('agent_name') : $tbl_agent['agent_name']); ?>" class="form-control" id="agent_name" required />
			<span class="text-danger"><?php echo form_error('agent_name');?></span>
                                        </div>
                                        <div class="col-md-6 col-sm-12  form-group">
                                            <label>
                                                Main  Agent Name<span class="required">*</span>
                                            </label>
<select class="select2_single form-control" name="main_agent_name" tabindex="-1">
                                                <option selected>Cash A/C</option>
                                               
                                                

                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="col-md-6 col-sm-6 offset-md-3" style="margin-top:39px;">
                                        <!--<button class="btn btn-primary" type="button" style="padding: .375rem 2.75rem;">Cancel</button>
                                        <button class="btn btn-primary" type="reset" style="padding: .375rem 2.75rem;">Reset</button>-->
                                        <button type="submit" class="btn btn-success" style="padding: .375rem 2.75rem;">Submit</button>
                                    
									</div>
                                </div>
								<?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>


                    

                </div>



