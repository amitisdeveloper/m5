<?php //echo '<pre>'; print_r($tbl_openno); echo '</pre>'; ?>

	<div class="">
					
					<div class="clearfix"></div>
					
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel" style="width:101% !important;">
								<div class="x_title">
									
                                    <div class="title_right">
                                       
                                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                                            <h5><u>Open Number</u></h5>
                                        </div>
                                        
                                    </div>
                                    
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										
										
									</ul>
                                   
									<div class="clearfix"></div>
								</div>

								
                                <div class="x_content">
								<?php if($error){ ?>
									<div class="alert alert-danger alert-dismissible " role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<strong><?=$error?></strong>
</div>
								<?php }
								if($this->session->flashdata('message')){ ?>
									<div class="alert alert-success " role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
</button>
<strong><?php echo @$this->session->flashdata('message');?></strong>
</div>
								<?php }
                               // echo '<pre>'; print_r($tbl_openno); die;
								?>
								<?php echo form_open('tbl_openno/edit/'.$tbl_openno['id'],array("class"=>"form-horizontal")); ?>
                                    <div class="row">
                                      

                                       
                                        <div class="col-md-6 col-sm-12  form-group">
                                            <label >
                                               Shift <span class="required">*</span>
                                            </label>
										<input type="text"  value="<?=$shift_name['shift_name']?>" class="form-control" id="username" readonly>	
                                           <input type="hidden" name="shift" value="<?=$tbl_openno['shift_id']?>">
                                        </div>
                                        <div class="col-md-6 col-sm-12  form-group">
                                            <label>
                                              Date <span class="required">*</span>
                                            </label>
									<input type="text"  value="<?=$tbl_openno['date']?>" class="form-control" id="username" readonly>	
									<input type="hidden" name="date" value="<?=$tbl_openno['date']?>" >
										</div>
                                        
                            

                                        
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                              Number <span class="required">*</span>
                                            </label>                                        
                                           
                                            <input type="number" name="number" value="<?=$tbl_openno['number']?>" class="form-control" id="username" required="required"/>
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

