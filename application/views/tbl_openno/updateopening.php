<div class="row">
	<div class="col-md-12 col-sm-12 ">
		<div class="x_panel" style="width:101% !important;">
			<div class="x_title">
				<div class="title_right">
					<div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
						<h5>
							<u>Update Opening</u>
						</h5>
					</div>
				</div>
				<ul class="nav navbar-right panel_toolbox">
					<li>
						<a class="collapse-link">
							<i class="fa fa-chevron-up"></i>
						</a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
			<?php if($msg){
				echo '<div class="alert alert-success">'.$msg.'</div>';
			} ?>
<?php echo form_open('');?>
				<div class="row">
					
					<div class="col-md-4 col-sm-12  form-group">
						<Label>From Date :</Label>
						<input type="text" name="frdate" onchange="caldays(this)" id="datepicker_start" class="form-control birthday" value="">
						<span class="text-danger"><?php echo form_error('Collect_By');?>
						</span>
					</div>
					<!--<div class="col-md-4 col-sm-12  form-group">
						<label>Total Paid Amount :</label>
						<input class="form-control"
						       type="text"
						       name="paid"
						       value=""/>
						<span class="text-danger">						</span>
					</div>
					<div class="col-md-4 col-sm-12  form-group">
						<label>Total Remaining Amount :</label>
						<input class="form-control"
						       type="text"
						       name="remain"
						       value=""/>
						<span class="text-danger">						</span>
					</div>-->
					<div class="col-md-4 col-sm-12  form-group sbmtbtn">
					<label>&nbsp;</label>
						<button class="btn btn-success form-control" style="padding: .375rem 2.75rem;" type="submit">Update</button>
					</div>
				</div>
<?php echo form_close(); ?>		</div>
		</div>
	</div>
</div>