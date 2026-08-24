<script>
function caldays(val) {
    var a = $("#datepicker_start").datepicker('getDate').getTime(),
        b = $("#datepicker_ends").datepicker('getDate').getTime(),
        c = 24*60*60*1000;
		if(a&b){
        diffDays = Math.round(Math.abs((a - b)/(c)));
    console.log(diffDays); //show difference
	$("#remdays").val(diffDays);
	var tvall = document.getElementById('totalamt').value;
	//alert(tvall);
	if(tvall){
		calckist(document.getElementById('totalamt'));
	}
}
}
function calckist(val){
	//alert(val.value);
	var tamnt = val.value;
	var nofdays = document.getElementById('remdays').value;
	document.getElementById('total_amnt').value = tamnt/nofdays;
}
</script>
<div class="row">
                        <div class="col-md-12 col-sm-12 ">
                            <div class="x_panel" style="width:101% !important;">
                                <div class="x_title">

                                    <div class="title_right">

                                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                                            <h5><u>Edit Kist</u></h5>
                                        </div>

                                    </div>

                                    <ul class="nav navbar-right panel_toolbox">
                                        <li>
                                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                        </li>


                                    </ul>
                                   
                                    <div class="clearfix"></div>
                                </div>



                                <div class="x_content">
															<?php echo form_open('tbl_kist/edit/'.$tbl_kist['id']); ?>
<div class="row">
	<div class="col-md-4 col-sm-12  form-group">
		<label>Select Party : </label>
		<select class="form-control" name="PartyId">
			<option value="">---</option>
			<?php 
			foreach($all_tbl_ledger as $tbl_ledger)
			{
				$selected = ($tbl_ledger['id'] == $tbl_kist['PartyId']) ? ' selected="selected"' : "";
				echo '<option value="'.$tbl_ledger['id'].'" '.$selected.'>'.$tbl_ledger['ledger_name'].'</option>';
			} 
			?>
		</select>
		<span class="text-danger"><?php echo form_error('PartyId');?></span>
	</div>
	
	<div class="col-md-4 col-sm-12  form-group">
		<Label>From Date :</Label>
		<input type="text" name="frdate" onchange="caldays(this)" id="datepicker_start" class="form-control birthday" value="<?php echo ($this->input->post('frdate') ? $this->input->post('frdate') : date('d-m-Y',strtotime($tbl_kist['frdate']))); ?>">
		<span class="text-danger"><?php echo form_error('Date');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<label>To Date :</label>
						<input 
						       class="form-control birthday"
							   id="datepicker_ends"
						       type="text"
						       name="todate"
							   onchange="caldays(this)"
						       value="<?php echo ($this->input->post('todate') ? $this->input->post('todate') : $tbl_kist['todate']); ?>"/><span class="text-danger"><?php echo form_error('Amount');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
		<label>Total Balance Amount :</label>
						<input class="form-control"								
						       type="text"
						       name="totalamt"
							   id="totalamt"
							   onkeyup="calckist(this)"
						       value="<?php echo ($this->input->post('totalamt') ? $this->input->post('totalamt') : $tbl_kist['totalamt']); ?>"/><span class="text-danger"><?php echo form_error('Remarks');?></span>
	</div>
	<div class="col-md-4 col-sm-12  form-group">
						<label>Total no of days :</label>
						<input class="form-control"
						       type="text"
						       name="days"
							   id="remdays"
							   readonly 
						       value="<?=$tbl_kist['days']?>"/>
						<span class="text-danger"><?php echo form_error('Amount');?>
						</span>
					</div>
					<div class="col-md-4 col-sm-12  form-group">
						<label>Kist Amount :</label>
						<input class="form-control"
						       type="text"
							   id="total_amnt"
						       name="kist"
							   readonly
						       value="<?=$tbl_kist['kist']?>"/>
						<span class="text-danger"><?php echo form_error('Remarks');?>
						</span>
					</div>
	<div class="col-md-4 col-sm-12  form-group sbmtbtn" >
	<button class="btn btn-success" style="padding: .375rem 2.75rem;" type="submit">Save</button>
</div>
</div>
<?php echo form_close(); ?>								</div>
                            </div>
                        </div>
                    </div>
					<style>
					.col-md-4.col-sm-12.form-group.sbmtbtn {
    display: flex;
    /* flex-direction: column; */
}
.sbmtbtn button.btn.btn-success{
	margin-top:auto;
}

					</style>
					




