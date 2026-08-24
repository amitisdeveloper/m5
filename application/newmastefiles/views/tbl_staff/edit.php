

	<div class="">
					
					<div class="clearfix"></div>
					
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel" style="width:101% !important;">
								<div class="x_title">
									
                                    <div class="title_right">
                                       
                                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                                            <h5><u>Staff</u></h5>
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
								<?php if($error){ ?>
									<div class="alert alert-danger alert-dismissible " role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<strong><?=$error?></strong>
</div>
								<?php }?>
								<?php echo form_open('tbl_staff/edit/'.$tbl_staff['id'],array("class"=>"form-horizontal")); ?>
                                    <div class="row">
                                      

                                       
                                        <div class="col-md-6 col-sm-12  form-group">
                                            <label >
                                                Staff Name  <span class="required">*</span>
                                            </label>
                                            <input type="text" name="staff_name" value="<?php echo ($this->input->post('staff_name') ? $this->input->post('staff_name') : $tbl_staff['staff_name']); ?>" class="form-control" id="staff_name" required />
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                              Role <span class="required">*</span>
                                            </label>


                                            <select name="role" class="select2_single form-control" tabindex="-1" required>                                                
                                                <option value="2" <?=($tbl_staff['user_role']==2)?'selected':''?>>Admin</option>
                                                <option value="4" <?=($tbl_staff['user_role']==4)?'selected':''?>>DATA ENTRY OPERATOR </option>
                                              
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
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
                                           
                                            <input type="text" name="username" value="<?php echo ($this->input->post('username') ? $this->input->post('username') : $tbl_staff['user_name']); ?>" class="form-control" id="username" required="required"/>
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>Password <span class="required">*</span>
                                            </label>
                                            <input type="password" name="password" value="<?php echo ($this->input->post('password') ? $this->input->post('password') : $tbl_staff['password']); ?>" class="form-control" id="password" required="required"/>
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
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
                                            <input name="mobile" type="text" class="form-control" value="<?php echo ($this->input->post('mobile') ? $this->input->post('mobile') : $tbl_staff['mobile']); ?>" >
                                        </div>
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label> Address 
                                            </label>
                                           <textarea name="address" class="form-control"  id="address"><?php echo ($this->input->post('address') ? $this->input->post('address') : $tbl_staff['address']); ?></textarea>
                                        </div>
                                         
                                     </div>
									
                                    <div class="col-md-6 col-sm-6 offset-md-3" style="margin-top:-47px;margin-left:27%;">
                                       
                                        <button type="submit" class="btn btn-success" style="padding: .375rem 2.75rem;">Submit</button>
                                    </div>
									<?php echo form_close(); ?>
                                </div>
							</div>
						</div>
					</div>
                  
                   
                    
                    </div>

