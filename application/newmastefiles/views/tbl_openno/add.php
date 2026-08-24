<?php //echo '<pre>'; print_r($this->session); echo '</pre>'; ?>

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
								?>
								<?php echo form_open('tbl_openno/add',array("class"=>"form-horizontal")); ?>
                                    <div class="row">
                                      

                                       
                                        <div class="col-md-6 col-sm-12  form-group">
                                            <label >
                                               Shift <span class="required">*</span>
                                            </label>
											<select name="shift" id="shift"  class="form-control" required>
                        <option value="" disabled selected>Choose option</option>
                        <?php foreach($shifts as $key => $val){
                           ?>
                        <option value="<?=$val['id']?>"><?=$val['shift_name']?></option>
                        <?php	
                           } ?>
                     </select>
                                           
                                        </div>
                                        <div class="col-md-6 col-sm-12  form-group">
                                            <label>
                                              Date <span class="required">*</span>
                                            </label>


                                            <input id="birthday" class=" form-control" name="date" type="text" autocomplete="off" required="required"  >
                                        </div>
                                        
                            

                                        
                                        <div class="col-md-3 col-sm-12  form-group">
                                            <label>
                                              Number <span class="required">*</span>
                                            </label>                                        
                                           
                                            <input type="number" name="number" value="" class="form-control" id="username" required="required"/>
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
                  
                    
                    <div class="col-md-12 col-sm-12 ">
                        <div class="x_panel" style="width:101%;">
                            <div class="x_title"><table  id="dtable" class="display table table-striped table-bordered" style="width:100%;font-size:12px;">
                               <!-- <table id="dtable" class="table table-striped table-bordered" style="font-size:12px;">-->
                                    <thead>
                                        <tr>
                                            <th>Sr</th>
                                            <th>Shift Selected</th>
                                            <th>Date</th>
                                            <th>Number</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
											<th>View</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php foreach($tbl_openno as $key => $t){ ?>
                                         <tr>
		<td><?php echo $key+1; ?></td>
		
		<td><?php echo $t['shift_name']; ?></td>
		<td><?php echo $t['date']; ?></td>
		<td><?php echo $t['number']; ?></td>
		<td><?php echo $t['created_at']; ?></td>
		<!--<td><a href="<?php echo site_url('tbl_openno/view_result/'.$t['id']); ?>" class="btn btn-info btn-xs">View Result</a></td>-->
		<td>
            <a href="<?php echo site_url('tbl_openno/edit/'.$t['id']); ?>" class="btn btn-info btn-xs">Edit</a></td> 
		<td><a href="#" class="btn btn-info btn-xs">View Result</a></td>
		<!--<td>
            <a href="<?php echo site_url('tbl_openno/edit/'.$t['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('tbl_openno/remove/'.$t['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>-->
    </tr>
									<?php }?>
                                      
                                    </tbody>
									 <tfoot> <tr>
                                            <th>Sr</th>
                                            <th>Shift Selected</th>
                                            <th>Date</th>
                                            <th>Number</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
											<th>View</th>
                                        </tr></tfoot>
                                </table>
                                <div class="clearfix"></div>
                            </div>
                            
                        </div>
                    </div>
                    
                    </div>
					
					<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
					<script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
					<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
					<script>
					jQuery(document).ready( function ($) {
						//$.noConflict();
    $('#dtable').DataTable();
} );
					</script>

