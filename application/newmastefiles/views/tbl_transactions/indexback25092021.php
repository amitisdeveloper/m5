<div class="">
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-12 col-sm-12 ">
         <div class="x_panel">
            <div class="x_title">
               <h2 style="text-decoration:underline;"><b>Live Transactions</b></h2>
               <ul class="nav navbar-right panel_toolbox">
                  <li>
                     <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
               </ul>
               <div class="nav navbar-right panel_toolbox">
                  <div class="form-group pull-right top_search">
                     <div class="input-group">
                       <h2 style="margin-right:10px;"><b>Date</b></h2>
                     <input id="birthday" class=" form-control" type="text" autocomplete="off" required="required"  >
                     <div class="alert" style="display:none">Please Select Shift First</div>
                     </div>
                  </div>
               </div>
               <div class="nav navbar-left panel_toolbox">
                  <h2 style="margin-right:10px;"><b>Shift</b></h2>
                  <!-- Split button -->
                  <div class="btn-group" style="height: 36px; margin-right: 10px;">
                     <!--<button type="button" class="btn btn-danger" style="padding: 0.375rem 18px; color: #73879c; background-color: #ffffff; border-color: #f2f2f2; ">  Choose</button>
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #73879c; background-color: #ffffff; border-color: #f2f2f2; ">
                            
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Choose</a>
                            <a class="dropdown-item" href="#">Punjab Day</a>
                            
                        </div>-->
                     <?php //echo '<pre>'; print_r($shifts); echo '</pre>'; ?>
                     <select name="shift" id="shift" onchange="selectshift(this)" class="form-control">
                        <option value="">Choose option</option>
                        <?php foreach($shifts as $key => $val){
                           ?>
                        <option value="<?=$val['id']?>"><?=$val['shift_name']?></option>
                        <?php	
                           } ?>
                     </select>
                     <div class="alert" style="display:none">Please Select Shift First</div>
                  </div>
				  <?php //echo '<pre>'; print_r($party); echo '</pre>'; ?>
				  <h2 style="margin-right:10px;"><b>Party</b></h2>
                  <div class="btn-group" style="height: 36px; margin-right: 10px;">
                      <select name="party" id="party"  class="form-control">
                        <option value="">Choose option</option>
                        <?php foreach($party as $key => $val){
                           ?>
                        <option value="<?=$val['id']?>"><?=$val['ledger_name']?></option>
                        <?php	
                           } ?>
                     </select>
					 
                     <!--<button type="button" class="btn btn-danger" style="padding: 0.375rem 18px; color: #73879c; background-color: #ffffff; border-color: #f2f2f2; "> All Staff</button>
                        <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #73879c; background-color: #ffffff; border-color: #f2f2f2; "></button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Choose</a>
                            <a class="dropdown-item" href="#">Punjab Day</a>
                        
                        </div>-->
                  </div>
                  <!--<div class="btn-group" style="height:36px;margin-right:10px;">
                     <button type="button" class="btn btn-danger" style="padding: 0.375rem 18px; color: #73879c; background-color: #ffffff; border-color: #f2f2f2; ">  All</button>
                     <button type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #73879c; background-color: #ffffff; border-color: #f2f2f2; "></button>
                     <div class="dropdown-menu">
                         <a class="dropdown-item" href="#">Choose</a>
                         <a class="dropdown-item" href="#">Punjab Day</a>
                     
                     </div>
                     </div>-->
                  <!-- Split button -->
               </div>
               <div class="clearfix"></div>
               <div class="col-md-12 col-sm-12  ">
                  <div class="x_content" >
                     <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Add(F2)</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Random(F4)</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="cross-tab" data-toggle="tab" href="#cross" role="tab" aria-controls="cross" aria-selected="false">Cross</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="From-To-tab" data-toggle="tab" href="#From-To" role="tab" aria-controls="From-To" aria-selected="false">From-To(F7)</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="Random-tab" data-toggle="tab" href="#Random" role="tab" aria-controls="Random" aria-selected="false">Random(F8)</a>
                        </li>
						<li class="nav-item">
                           <a class="nav-link" id="jantri" onclick="calljantri()" href="#" role="tab" aria-controls="Random" aria-selected="false">Jantri</a>
                        </li>
                     </ul>
                     <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                           <h2 style="text-decoration:underline;"><b>Party</b></h2>
                           <div class="x_content" style="background-color: #ededed;">
                              <br />
                              <div class="col-md-3 col-sm-12" style="margin-top:20px;">
                                 <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                       <div class="x_content">
                                          <div class="row">
                                             <div class="col-sm-12">
                                                <div class="card-box table-responsive">
												<?php if($this->session->flashdata('msg')): ?>
    <p class="flsh button-success"><?php echo $this->session->flashdata('msg'); ?></p>
<?php endif; ?><input type="hidden" name="is_filled" id="is_filled1" value="">
<input type="hidden" name="last_id1" id="last_id1" value="">
                                                   <table >
                                                      <thead>
                                                         <tr>
                                                            <th><input type="text" class="form-control" name="trn_number[]" maxlength="2" placeholder="Number" onfocus="checkshift()"></th>
                                                            <th><input type="text" class="form-control" name="trn_amount[]" maxlength="6" placeholder="Amount" onfocus="checkshift()" ></th>
                                                            
                                                         </tr>
                                                      </thead>
                                                   </table>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6 col-sm-12">
                                 <div class="tile_count">
                                    <div class="x_panel" style="border:none;">
                                       <div class="x_content">
                                          <div class="row">
                                             <div class="col-sm-12">
                                                <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                                   <h2 style="text-decoration:underline;"><b>Utar Mode Instructions</b></h2>
                                                   <tr>
                                                      <th>1. Dara Number should be 1 to 100</th>
                                                   </tr>
                                                   <tr>
                                                      <th>2. Bahar Akhar Number: should be 000 to 999</th>
                                                   </tr>
                                                   <tr>
                                                      <th>3.Andar Akhar Number: should be 0000 to 9999</th>
                                                   </tr>
                                                   <tr>
                                                      <th>4. press F12 for jantri view</th>
                                                   </tr>
                                                   <tr>
                                                      <th>5. Press- for Re-Focus</th>
                                                   </tr>
                                                   <tr style="font-size:17px; text-align:center;">
                                                      <th>Total Count: 0</th>
                                                   </tr>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-3 col-sm-12">
                                 <div class="tile_count">
                                    <div class="x_panel" style="border:none;">
                                       <div class="x_content">
                                          <div class="row">
                                             <div class="col-sm-12">
                                                <h2 style="text-decoration:underline;"><b class="shift_day">PUNJAB DAY [Live]</b></h2>
                                                <table class="table">
                                                   <tr style="background-color: #ededed;">
                                                      <th>Applied Narration</th>
                                                   </tr>
                                                   <table id="showaddtrn" style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;" border="1">
                                                      <tbody>
                                                         <tr id="addtrnhead">
                                                            <td>Number</td>
                                                            <td>Amount</td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                   <!-- DivTable.com -->
                                                </table>
                                                <table class="table" style="margin-top:184px;">
                                                   <tr style="background-color: #ededed;">
                                                      <th>Grand Total: <span id="gtotal">0</span></th>
                                                   </tr>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                           <h2 style="text-decoration:underline;"><b>Random</b></h2>
                           <div class="x_content">
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="card-box table-responsive" style="background-color: #ededed;">
									<div class="col-md-4 col-sm-12 x_panel" style="margin-top:20px;margin-left: 12px;padding-left: 0px;width: 32%;">
<?php if($this->session->flashdata('msg')): ?>
    <p class="flsh button-success"><?php echo $this->session->flashdata('msg'); ?></p>
<?php endif; ?>									
<input type="hidden" name="is_filled" id="is_filled2" value="">
									  <form id="demo-form2" method="post" action="add_randomf4" data-parsley-validate class="form-horizontal form-label-left">
                                          <div class="item form-group" style="margin-top:30px;">
                                             <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">
                                             Number<span class="required">*</span>
                                             </label>
                                             <div class="col-md-6 col-sm-6 ">
                                                <input type="number" name="number[]" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" id="first-name" required="required"   onchange="addrandomf4(this)"  class="form-control randomf4">
                                             </div>
                                          </div>
                                          <div class="item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">
                                             Amount <span class="required">*</span>
                                             </label>
                                             <div class="col-md-6 col-sm-6 ">
                                                <input type="number" id="amnt" name="amount" onchange="insertrandomf4(this)"  onkeyup="calcf4(this)" required="required" class="form-control">
                                             </div>
                                          </div>
                                          <div class="item form-group">
                                             <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">
                                             Total Amount <span class="required">*</span>
                                             </label>
                                             <div class="col-md-6 col-sm-6 ">
                                                <input type="text" id="tamount" name="tamount"  class="form-control" readonly>
                                                <input type="hidden" id="thamount" name="thamount">
                                             </div>
                                          </div>
                                          <div class="ln_solid"></div>
                                          <!--<div class="item form-group">
                                             <div class="col-md-6 col-sm-6 offset-md-3" >
                                                <button class="btn btn-primary" type="submit" style="padding: 0.375rem 2.75rem; ">Save</button>
                                                <button type="button" class="btn btn-success" style="padding: 0.375rem 2.75rem; ">Cancel</button>
                                             </div>
                                          </div>-->
                                       </form>
									   </div>
									   <div class="col-md-4 col-sm-12">
                                                                <div class="tile_count">
                                                                    <div class="x_panel" style="border:none;">
                                                                        <div class="x_content">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <h2 style="text-decoration:underline;"><b>Utar Mode Instructions</b></h2><table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                                                                        
                                                                                        <tbody><tr>
                                                                                            <th>1. Dara Number should be 1 to 100</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>2. Bahar Akhar Number: should be 000 to 999</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>3.Andar Akhar Number: should be 0000 to 9999</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>4. press F12 for jantri view</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>5. Press- for Re-Focus</th>
                                                                                        </tr>
                                                                                        <tr style="font-size:17px; text-align:center;">
                                                                                            <th>Total Count: 0</th>
                                                                                        </tr>
                                                                                    </tbody></table>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
															<div class="col-md-4 col-sm-12">
                                                                <div class="tile_count">
                                    <div class="x_panel" style="border:none;">
                                       <div class="x_content">
                                          <div class="row">
                                             <div class="col-sm-12">
                                                <h2 style="text-decoration:underline;"><b class="shift_day">PUNJAB DAY [Live]</b></h2>
                                                <table class="table">
                                                   <tr style="background-color: #ededed;">
                                                      <th>Applied Narration</th>
                                                   </tr>
                                                   <table id="showaddtrn" style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;" border="1">
                                                      <tbody>
                                                         <tr id="addtrnheadf4">
                                                            <td>Number</td>
                                                            <td>Amount</td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                   <!-- DivTable.com -->
                                                </table>
                                                <table class="table" style="margin-top:184px;">
                                                   <tr style="background-color: #ededed;">
                                                      <th>Grand Total: <span id="gtotal">0</span></th>
                                                   </tr>
                                                </table>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                                            </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="cross" role="tabpanel" aria-labelledby="cross-tab">
                           <div class="x_content">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel" style="margin-top:13px;">
                                       <h2 style="text-decoration:underline;"><b>Cross</b></h2>
                                       <div class="x_content">
									   <div class="x_content" style="background-color: #ededed;">
                                          <div class="row">
                                             <div class="col-md-4 col-sm-12">
                                                <div class="card-box table-responsive">
                                                   <?php if($this->session->flashdata('msg')): ?>
    <p class="flsh button-success"><?php echo $this->session->flashdata('msg'); ?></p>
<?php endif; ?>
<input type="hidden" name="is_filled" id="is_filled3" value="">
												   <form action="add_cross" method="post" >
                                                      <table id="datatable" class="table table-striped table-bordered" style="font-size: 12px; width: 99%; margin-bottom: 0rem; background-color: #ededed; ">
                                                         <thead>
                                                            <tr>
                                                               <th>
                                                                  <label>ANDER</label>
                                                                  <input type="text" onchange="checkcross()" maxLength='3' id="crossander" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="Ander" name="ander" required>
                                                               </th>
                                                               </tr>
															   <tr><th>
                                                                  <label> BAHAR</label>
                                                                  <input type="text" onchange="checkcross()" maxLength='3' id="crossbahar" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="bahar" placeholder="Bahar" required>
                                                               </th>
															   </tr>
															   <tr>
                                                               <th>
                                                                  <label> AMOUNT </label>
                                                                  <input type="text" name="amount" onchange="checkcross()" id="amntt" class="form-control" placeholder="AMT" required>
                                                               </th>
															   </tr>
															   <tr>
                                                               <th>
                                                                  <label>JODA</label>
                                                                  <select name ="joda" id="joda" onchange="checkcross()" class="form-control" required>
                                                                     <option value="" disabled>--Please Select--</option>
                                                                     <option value="Y">Y</option>
                                                                     <option value="N">N</option>
                                                                  </select>
                                                               </th>
                                                            </tr>
                                                         </thead>
                                                      </table>
                                                      <p style="font-size:17px;margin-top:19px;"><b>Total Cross Count: <span id="tcc">0</span></b></p>
                                                      <p style="font-size:17px;margin-top:19px;"><b>Total Amount: <span id="tamnt">0</span></b></p>
                                                      <input type="hidden" name="total_amount_cross" id="total_amount_cross" value="">
                                                      <input type="hidden" name="cross_count" id="cross_count" value="">
                                                      <!--<div class="col-md-6 col-sm-6 offset-md-3" style="margin-left:3px;">
                                                         <button class="btn btn-primary" type="submit" style="padding: 0.375rem 2.75rem; ">Save</button>
                                                         <button type="submit" class="btn btn-success" style="padding: 0.375rem 2.75rem; ">Cancel</button>
                                                      </div>-->
                                                   </form>
                                                </div>
                                             </div>
											 <div class="col-md-4 col-sm-12">
                                                                <div class="tile_count">
                                                                    <div class="x_panel" style="border:none;height:423px;">
                                                                        <div class="x_content">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <h2 style="text-decoration:underline;"><b>Utar Mode Instructions</b></h2><table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                                                                        
                                                                                        <tbody><tr>
                                                                                            <th>1. Dara Number should be 1 to 100</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>2. Bahar Akhar Number: should be 000 to 999</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>3.Andar Akhar Number: should be 0000 to 9999</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>4. press F12 for jantri view</th>
                                                                                        </tr>
                                                                                        <tr>
                                                                                            <th>5. Press- for Re-Focus</th>
                                                                                        </tr>
                                                                                        <tr style="font-size:17px; text-align:center;">
                                                                                            <th>Total Count: 0</th>
                                                                                        </tr>
                                                                                    </tbody></table>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
															<div class="col-md-4 col-sm-12">
                                                                <div class="tile_count">
                                                                    <div class="x_panel" style="border: none; height:423px;">
                                                                        <div class="x_content">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">

                                                                                    <h2 style="text-decoration:underline;"><b>PUNJAB DAY [Live]</b></h2>

                                                                                    <table class="table">


                                                                                        <tbody><tr style="background-color: #ededed;">
                                                                                            <th>Applied Narration</th>
                                                                                        </tr>
                                                                                    </tbody></table>
																					<table id="showaddcross" style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;" border="1">
                                                      <tbody>
                                                         <tr id="addtrnheadcross">
                                                            <td>Number</td>
                                                            <td>Amount</td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                                                    <table class="table" style="margin-top:184px;">


                                                                                        <tbody><tr style="background-color: #ededed;">
                                                                                            <th>Grand Total: 0</th>
                                                                                        </tr>
                                                                                    </tbody></table>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                          </div>
										  </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="From-To" role="tabpanel" aria-labelledby="From-To-tab">
                           <div class="x_content">
                              <div class="row">
                                 <div class="col-md-12 col-sm-12 ">
                                    <div class="x_panel">
                                       <h2 style="text-decoration:underline;"><b>From-To</b></h2>
                                       <div class="x_content" >
                                          <div class="x_content" style="background-color: #ededed;">
                                             <div class="col-md-4 col-sm-12">
                                                <div class="card-box table-responsive">
												<?php if($this->session->flashdata('msg')): ?>
    <p class="flsh button-success"><?php echo $this->session->flashdata('msg'); ?></p>
<?php endif; ?>
<input type="hidden" name="is_filled" id="is_filled4" value="">
                                                   <form name="trans_fromto" action="add_fromto" method="post">
                                                      <table id="datatable" class="table table-striped table-bordered" style="font-size: 12px; width: 99%; margin-bottom: 0rem; background-color: #ededed; ">
                                                         <thead>
                                                            <tr>
                                                               <th>
                                                                  <label>From</label>
                                                                  <input required type="number" onkeyup="calcfromto()" onchange="addfromto()" maxLength='3' id="fromto_from" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="fromto_from" placeholder="From">
                                                               </th>
                                                               <th>
                                                                  <label> To</label>
                                                                  <input required type="number" onkeyup="calcfromto()" onchange="addfromto()" maxLength='3' id="fromto_to" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" name="fromto_to" placeholder="To">
                                                               </th>
                                                               <th>
                                                                  <label> Amount</label>
                                                                  <input required type="text" value="0" onkeyup="calcfromto()" onchange="addfromto()" class="form-control" id="fromto_amount" name="fromto_amount" placeholder="Amount">
                                                               </th>
                                                            </tr>
                                                         </thead>
                                                      </table>
                                                      <p style="font-size:17px;margin-top:19px;"><b>Total Amount: <span id="fromto_total_amount">0</span></b></p>
                                                      <input type="hidden" name="total_amount_fromto" id="total_amount_fromto" value="">
                                                      <!--<div class="col-md-6 col-sm-6 offset-md-3" style="margin-left:3px;">
                                                         <button class="btn btn-primary" type="submit" style="padding: 0.375rem 2.75rem; ">Save</button>
                                                         <button type="submit" class="btn btn-success" style="padding: 0.375rem 2.75rem; ">Cancel</button>
                                                      </div>-->
                                                   </form>
                                                </div>
                                             </div>
											 <div class="col-md-4 col-sm-12">
                                                                    <div class="tile_count">
                                                                        <div class="x_panel" style="border:none;height:354px;">
                                                                            <div class="x_content">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">
                                                                                        <h2 style="text-decoration:underline;"><b>Utar Mode Instructions</b></h2><table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                                                                            
                                                                                            <tbody><tr>
                                                                                                <th>1. Dara Number should be 1 to 100</th>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>2. Bahar Akhar Number: should be 000 to 999</th>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>3.Andar Akhar Number: should be 0000 to 9999</th>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>4. press F12 for jantri view</th>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <th>5. Press- for Re-Focus</th>
                                                                                            </tr>
                                                                                            <tr style="font-size:17px; text-align:center;">
                                                                                                <th>Total Count: 0</th>
                                                                                            </tr>
                                                                                        </tbody></table>
                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
																<div class="col-md-4 col-sm-12">
                                                                    <div class="tile_count">
                                                                        <div class="x_panel" style="border: none; height:354px;">
                                                                            <div class="x_content">
                                                                                <div class="row">
                                                                                    <div class="col-sm-12">

                                                                                        <h2 style="text-decoration:underline;"><b>PUNJAB DAY [Live]</b></h2>

                                                                                        <table class="table">


                                                                                            <tbody><tr style="background-color: #ededed;">
                                                                                                <th>Applied Narration</th>
                                                                                            </tr>
                                                                                        </tbody></table>
																						<table id="showaddfromto" style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;" border="1">
                                                      <tbody>
                                                         <tr id="addtrnheadfromto">
                                                            <td>Number</td>
                                                            <td>Amount</td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                                                        <table class="table" style="margin-top:184px;">


                                                                                            <tbody><tr style="background-color: #ededed;">
                                                                                                <th>Grand Total: 0</th>
                                                                                            </tr>
                                                                                        </tbody></table>
                                                                                    </div>
                                                                                </div>


                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="Random" role="tabpanel" aria-labelledby="Random-tab">
                           <h2 style="text-decoration:underline;"><b>Random</b></h2>
                           <div class="x_content" >
                              <div class="x_content" style="background-color: #ededed;">
                                 <div class="col-md-8 col-sm-12" style=" margin-top: 19px; ">
								 <?php if($this->session->flashdata('msg')): ?>
    <p class="flsh button-success"><?php echo $this->session->flashdata('msg'); ?></p>
<?php endif; ?>
<input type="hidden" name="is_filled" id="is_filled5" value="">
                                    <form class="" action="random_f8" method="post" novalidate>
                                       <p style="font-size:14px;">
                                          <b> NOTE:</b> Dara number should be 2 digit without any separator.
                                       </p>
                                       <p style="font-size:14px;margin-bottom:28px;">
                                          <b> NOTE:</b> Akhar number should be 1 digit without any separator.
                                       </p>
                                       <div class="col-md-6 col-sm-12  form-group">
                                          <label>
                                          Dara  <span class="required">*</span>
                                          </label>
                                          <textarea onkeyup="daraspacef8()" onchange="adddaraspacef8()" required="required" id="dara_f8" name="dara_f8" placeholder="Number, EG 01 And 09 Like 0189"></textarea>
                                       </div>
                                       <div class="col-md-3 col-sm-12  form-group">
                                          <label>
                                          Amount<span class="required">*</span>
                                          </label>
                                          <label style="float:right;">
                                          <span id="amount_dara"></span>
                                          </label>				
                                          <input onkeyup="daraspacef8()" required type="number" onchange="adddaraspacef8()" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="dara_amount_f8"  id="dara_amount_f8" class="form-control" placeholder="Amount">
                                       </div>
                                       <div class="col-md-6 col-sm-12  form-group">
                                          <label>
                                          Akhar Bahar <span class="required">*</span>
                                          </label>
                                          <input required onkeyup="akahr_bahar_f8()" type="number" onchange="adddaraspacef8()" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="akhar_bahar_f8" id="akhar_bahar_f8" class="form-control" placeholder="Number,EG: 1 And 2 Like 12
                                             ">
                                       </div>
                                       <div class="col-md-3 col-sm-12  form-group">
                                          <label>
                                          Amount <span class="required">*</span>
                                          </label>
                                          <label style="float:right;">
                                          <span id="akbahar_dara"></span>
                                          </label>
                                          <input required onkeyup="akahr_bahar_f8()" onchange="adddaraspacef8()" type="text" name="amount_akahr_bahar_f8"  id="amount_akahr_bahar_f8" class="form-control" placeholder="Amount">
                                       </div>
                                       <div class="col-md-6 col-sm-12  form-group">
                                          <label>
                                          Akhar Andar  <span class="required">*</span>
                                          </label>
                                          <input required onkeyup="calc_akahr_andar_f8()" onchange="adddaraspacef8()" id="akahr_andar_f8" name="akahr_andar_f8" type="number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="Numbers, EG: 1 And 2 Like 12">
                                       </div>
                                       <div class="col-md-3 col-sm-12  form-group">
                                          <label>
                                          Amount <span class="required">*</span>
                                          </label>
                                          <label style="float:right;">
                                          <span id="akandar_dara"></span>
                                          </label>
                                          <input required onkeyup="calc_akahr_andar_f8()" onchange="adddaraspacef8()" id="amount_akahr_andar_f8" name="amount_akahr_andar_f8"   type="number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" class="form-control" placeholder="Amount">
                                       </div>
                                       <div class="col-md-6 col-sm-12  form-group">
                                          <p style="font-size:17px;">
                                             <b>Total Amount: <span id="f8_amount">0</span></b>
                                          </p>
                                          <input type="hidden" id="ranf8amt" name="ranf8amt" value="0">
                                       </div>
                                       <!--<div class="col-md-6 col-sm-6 offset-md-3" style="margin-left:3px;">
                                          <button class="btn btn-primary" type="submit" style="padding: 0.375rem 2.75rem; ">Save</button>
                                          <button type="submit" class="btn btn-success" style="padding: 0.375rem 2.75rem; ">Cancel</button>
                                       </div>-->
                                    </form>
                                 </div>
								 <div class="col-md-4 col-sm-12">
                                                                <div class="tile_count">
                                                                    <div class="x_panel" style="border: none; height:412px;">
                                                                        <div class="x_content">
                                                                            <div class="row">
                                                                                <div class="col-sm-12">

                                                                                    <h2 style="text-decoration:underline;"><b>PUNJAB DAY [Live]</b></h2>

                                                                                    <table class="table">


                                                                                        <tbody><tr style="background-color: #ededed;">
                                                                                            <th>Applied Narration</th>
                                                                                        </tr>
                                                                                    </tbody></table>
																					<table id="showaddf8" style="width: 100%; text-align:center; background-color: #ededed; margin-left: auto; margin-right: auto;" border="1">
                                                      <tbody>
                                                         <tr id="addtrnheadf8">
                                                            <td>Number</td>
                                                            <td>Amount</td>
                                                         </tr>
                                                      </tbody>
                                                   </table>
                                                                                    <table class="table" style="margin-top:248px;">


                                                                                        <tbody><tr style="background-color: #ededed;">
                                                                                            <th>Grand Total: 0</th>
                                                                                        </tr>
                                                                                    </tbody></table>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="x_content">
            <br />
            <div class="col-md-8 col-sm-12 ">
               <div class="x_panel">
                  <div style="margin-top: 13px; padding: 0 2px 0px;">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="card-box table-responsive">
                              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                 <thead>
                                    <tr style="background-color: #ededed;">
                                       <th>Sr</th>
                                       <th>D</th>
                                       <th>U/</th>
                                       <th>Party</th>
                                       <th>Rate</th>
                                       <th>Amount</th>
                                       <th>Added</th>
                                       <th>Updated</th>
                                       <th>Action </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>0</td>
                                       <td>D</td>
                                       <td>U/</td>
                                       <td>Party</td>
                                       <td>Rate</td>
                                       <td>0</td>
                                       <td>Added</td>
                                       <td>Updated</td>
                                       <td>Action</td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-4 col-sm-12 ">
               <div class="x_panel">
                  <div class="x_content" style="margin-top: 13px; padding: 0 2px 0px;">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="card-box table-responsive">
                              <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                                 <tr>
                                    <th colspan="6">Party</td>
                                 </tr>
                                 <tr style="background-color: #ededed;">
                                    <td>Number</td>
                                    <td>Amount</td>
                                 </tr>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script>


function calljantri(){
	 if(document.getElementById('shift').value==''){
   	alert('Please Select Shift First');
   	document.getElementById('shift').focus();
   	return false;
   }
   if(document.getElementById('party').value==''){
   	alert('Please Select Party First');
   	document.getElementById('party').focus();
   	return false;
   } 
   if(document.getElementById('birthday').value==''){
   	alert('Please Select Date');
   	document.getElementById('birthday').focus();
   	return false;
   }
	 var custurl = '?shift='+document.getElementById('shift').value+'&party='+document.getElementById('party').value;
        window.location.replace("/jantri"+custurl);
}
   function checkshift(){
	   if(document.getElementById('shift').value==''){
   	alert('Please Select Shift First');
   	document.getElementById('shift').focus();
   	return false;
   }
   if(document.getElementById('party').value==''){
   	alert('Please Select Party First');
   	document.getElementById('party').focus();
   	return false;
   } 
   if(document.getElementById('birthday').value==''){
   	alert('Please Select Date');
   	document.getElementById('birthday').focus();
   	return false;
   }
   }
   function addnumamount(elem){
   
   if(document.getElementById('shift').value==''){
   	alert('Please Select Shift First');
   	document.getElementById('shift').focus();
   	return false;
   }
   
if(document.getElementById('party').value==''){
   	alert('Please Select Party First');
   	document.getElementById('party').focus();
   	return false;
   }  
if(document.getElementById('birthday').value==''){
   	alert('Please Select Date First');
   	document.getElementById('birthday').focus();
   	return false;
   }   
   var master_id;
   //var num = $(elem).closest('th').prev().find('input').val();
   var numshow = $(elem).closest('th').prev().find('input').val();
   var num = $('input[name="trn_number[]"]').map(function(){ 
                    return this.value; 
                }).get();
   var amtshow = $(elem).val();
   var amt = $('input[name="trn_amount[]"]').map(function(){ 
                    return this.value; 
                }).get();
   var shift = document.getElementById('shift').value;
   var party = document.getElementById('party').value;
   var date = document.getElementById('birthday').value;
   var if_exist = document.getElementById('is_filled1').value;
   var last_id1='';
   var actionstr = '';
   if(if_exist){
	   actionstr = 'update_transactions';
	   master_id = if_exist;
	   last_id1=document.getElementById('last_id1').value;
   }
   else{
	   actionstr = 'add_transactions';
   }
  
    var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	   console.log("Transation Entered!!");
	   //console.log(JSON.parse(xhttp.responseText));
	   var obj = JSON.parse(xhttp.responseText);
	   //console.log(obj.master_id);
	   if(actionstr == 'add_transactions'){
	   document.getElementById('is_filled1').value = obj.master_id;
	   document.getElementById('is_filled2').value = obj.master_id;
	   document.getElementById('is_filled3').value = obj.master_id;
	   document.getElementById('is_filled4').value = obj.master_id;
	   document.getElementById('is_filled5').value = obj.master_id;
	   document.getElementById('last_id1').value = obj.last_id;
	   //last_id1 = obj.last_id;
	   }
	   document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+numshow+'</td><td>'+amtshow+'</td></tr>');
    
   elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" name="trn_number[]" placeholder="Number" onkeyup="checkshift()"></th> <th><input type="text" class="form-control" name="trn_amount[]" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
 var allSelects = document.getElementsByName("trn_number[]");
var lastSelect = allSelects[allSelects.length-1];
//alert(lastchildd.value)
   //var elemm = $('input[name="trn_number[]"]:last');
   setTimeout(function() { lastSelect.focus(); }, 50);
   }
   };
   xhttp.open("POST",actionstr, true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("number="+num+"&amount="+amt+"&shift="+shift+"&party="+party+"&date="+date+"&master_id="+master_id +"&last_id="+last_id1);			
   }
   
   function addrandomf4(elem){  	
   elem.parentNode.parentNode.insertAdjacentHTML('afterend','<div class="item form-group" > <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name"> Number </label> <div class="col-md-6 col-sm-6 "> <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="2" id="first-name" autofocus onchange="addrandomf4(this)" name="number[]" class="form-control randomf4"> </div> </div>');			
   //document.querySelectorAll("#profie .item.form-group:last-child").focus();
   //var len = document.querySelectorAll('.form-control .randomf4').length;
  // console.log(document.querySelectorAll('.form-control .randomf4')[len-1]);
   var someElementsItems = document.querySelectorAll(".randomf4");
//console.log(someElementsItems[someElementsItems.length -1])
someElementsItems[someElementsItems.length -1].focus();
   calcf4();
   } 
   function calcf4(elem){
   	//console.log(document.querySelectorAll('.randomf4').length)
   	var len =Array.from(document.querySelectorAll('.randomf4')).filter( input => input.value !== "").length;
   	
   	var amt = document.getElementById('amnt').value;
   	var tamnt =  len*amt;
   	document.getElementById('tamount').value = tamnt;
   	document.getElementById('thamount').value = tamnt;
	
   }
   function insertrandomf4(elem){
	   var tamnatt = document.getElementById('tamount').value;
	     var numb = $('input[name="number[]"]').map(function(){ 
                    return this.value; 
                }).get();
	   //var numb = document.querySelectorAll('.randomf4').serialize;
	 var shift = document.getElementById('shift').value;
   var party = document.getElementById('party').value;
   var date = document.getElementById('birthday').value;
   var master_id;
    var if_exist = document.getElementById('is_filled2').value;
   var actionstr = '';
   if(if_exist){
	   actionstr = 'update_randomf4';
	    master_id = if_exist;
   }
   else{
	   actionstr = 'add_randomf4';
   }
   
	var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	   console.log("Transation Entered!!");
	   console.log(JSON.parse(xhttp.responseText));
	   var obj = JSON.parse(xhttp.responseText);
	   console.log(actionstr);
	   if(actionstr == 'add_randomf4'){
	   document.getElementById('is_filled1').value = obj.trns_id;
	   document.getElementById('is_filled2').value = obj.trns_id;
	   document.getElementById('is_filled3').value = obj.trns_id;
	   document.getElementById('is_filled4').value = obj.trns_id;
	   document.getElementById('is_filled5').value = obj.trns_id;
	  
	   }
	   
	   
	   
	   //console.log(obj.number.split(","));
	   var objarrr = obj.number.split(",");
	   for (index = 0; index < objarrr.length; index++) {
    //console.log(objarrr[index]);
	if(objarrr[index]!=""){
		document.getElementById('addtrnheadf4').insertAdjacentHTML('afterend','<tr><td>'+objarrr[index]+'</td><td>'+obj.amount+'</td></tr>');
	}
}
	   //document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+obj.number+'</td><td>'+obj.Amount+'</td></tr>');
    
   //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift()"></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
   }
   };
   xhttp.open("POST", actionstr, true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("number="+numb+"&thamount="+tamnatt+"&amount="+elem.value+"&shift="+shift+"&party="+party+"&date="+date+"&master_id="+master_id);
	
   }
   
   /*function insertcross(elem){
	   var tamnatt = document.getElementById('tamount').value;
	     var numb = $('input[name="number[]"]').map(function(){ 
                    return this.value; 
                }).get();
	   //var numb = document.querySelectorAll('.randomf4').serialize;
	 var shift = document.getElementById('shift').value;
   var party = document.getElementById('party').value;
   var date = document.getElementById('birthday').value;
	var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	   alert("Transation Entered!!")
	   //console.log(JSON.parse(xhttp.responseText));
	   var obj = JSON.parse(xhttp.responseText);
	   //console.log(obj.number.split(","));
	   //var objarrr = obj.number.split(",");
	   //for (index = 0; index < objarrr.length; index++) {
    //console.log(objarrr[index]);
	//if(objarrr[index]!=""){
		document.getElementById('addtrnheadcross').insertAdjacentHTML('afterend','<tr><td>Ander</td><td>'+obj.ander+'</td></tr><tr><td>Bahar</td><td>'+obj.bahar+'</td></tr><tr><td>Amount</td><td>'+obj.amount+'</td></tr><tr><td>Joda</td><td>'+obj.joda+'</td></tr><tr><td>Total Cross Count</td><td>'+obj.cross_count+'</td></tr><tr><td>Total Amount</td><td>'+obj.amount+'</td></tr>');
	//}
//}
	   //document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+obj.number+'</td><td>'+obj.Amount+'</td></tr>');
    
   //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift()"></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
   }
   };
   xhttp.open("POST", "add_randomf4", true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("number="+numb+"&thamount="+tamnatt+"&amount="+elem.value+"&shift="+shift+"&party="+party+"&date="+date);
	
   }*/
   
   function checkcross(){
   	 ander = 1;
   	 if(document.getElementById('crossander').value){
   	 ander = document.getElementById('crossander').value;
   	 }
   	bahar = 1;
   if(document.getElementById('crossbahar').value){						
   	bahar = document.getElementById('crossbahar').value;
   }
   	 amountt = 1;
   	 if(document.getElementById('amntt').value ){
   	amountt = document.getElementById('amntt').value;
   	 }				
var master_id;
    var if_exist = document.getElementById('is_filled3').value;
   var actionstr = '';
   if(if_exist){
	   actionstr = 'update_cross';
	   master_id = if_exist;
   }
   else{
	   actionstr = 'add_cross';
   }	 
   	 joda = document.getElementById('joda').value;
   	 var shift = document.getElementById('shift').value;
   var party = document.getElementById('party').value;
   	 
   	 var items = [ander,bahar,amountt]; //only ex.:this array have many possibilities of length
   console.log(items);
   var product = 1;
   for( var i = 0; i < items.length; i++){
   product *= items[i]; 
   }
   //console.log(product);				 
   var tcc,ta;
   	 document.getElementById('tamnt').innerHTML= product;
   	 document.getElementById('total_amount_cross').value = product;
	 ta = product;
   	 if(document.getElementById('joda').value=='Y'){
   		 //tcc
   		 if(ander>=0 && ander <100){
   		 document.getElementById('tcc').innerHTML=4;
   		 document.getElementById('cross_count').value=4;
		 tcc = 4;
   	 }
   	 else if(ander>=100 && ander <1000){
   		 document.getElementById('tcc').innerHTML=9;
   		 document.getElementById('cross_count').value=9;
		 tcc = 9;
   	 }
   	 }
   	 else{
   		  if(ander>=0 && ander <100){
   		 document.getElementById('tcc').innerHTML=2;
   		 document.getElementById('cross_count').value=2;
		 tcc = 2
   		  }
   		  else if(ander>=100 && ander <1000){
   		document.getElementById('tcc').innerHTML=6;
   		 document.getElementById('cross_count').value=6;	
tcc = 6;		 
   		  }
   	 }
	 
	 
	 //alert(ander); alert(bahar); alert(amountt);
	 if((document.getElementById('crossander').value)&&(document.getElementById('crossbahar').value)&&(document.getElementById('amntt').value)){
	 var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	   console.log("Transation Entered!!")
	   //console.log(JSON.parse(xhttp.responseText));
	   var obj = JSON.parse(xhttp.responseText);
	   if(actionstr == 'add_cross'){
	   document.getElementById('is_filled1').value = obj.trns_id;
	   document.getElementById('is_filled2').value = obj.trns_id;
	   document.getElementById('is_filled3').value = obj.trns_id;
	   document.getElementById('is_filled4').value = obj.trns_id;
	   document.getElementById('is_filled5').value = obj.trns_id;
	   
	   }
	   //console.log(obj.number.split(","));
	   //var objarrr = obj.number.split(",");
	   console.log(obj);
	   document.getElementById('addtrnheadcross').insertAdjacentHTML('afterend','<tr><td>Ander</td><td>'+obj.ander+'</td></tr><tr><td>Bahar</td><td>'+obj.bahar+'</td></tr><tr><td>Amount</td><td>'+obj.amount+'</td></tr><tr><td>Joda</td><td>'+obj.joda+'</td></tr><tr><td>Total Cross Count</td><td>'+obj.cross_count+'</td></tr><tr><td>Total Amount</td><td>'+obj.all_commission+'</td></tr>');
	   //for (index = 0; index < objarrr.length; index++) {
    //console.log(objarrr[index]);
	//if(objarrr[index]!=""){
		//document.getElementById('addtrnheadf4').insertAdjacentHTML('afterend','<tr><td>'+objarrr[index]+'</td><td>'+obj.amount+'</td></tr>');
	//}
//}
	   //document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+obj.number+'</td><td>'+obj.Amount+'</td></tr>');
    
   //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift()"></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
   }
   };
   xhttp.open("POST", actionstr, true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("ander="+ander+"&bahar="+bahar+"&amount="+amountt+"&shift="+shift+"&party="+party+"&joda="+joda+"&total_cross_count="+tcc+"&total_amount="+ta+"&master_id="+master_id);
	 }
   }
   function calcfromto(){
   	var fromto_from = document.getElementById('fromto_from').value;
   	var fromto_to = document.getElementById('fromto_to').value;
   	var fromto_amnt = document.getElementById('fromto_amount').value;
   	
   var ranged = Math.abs(fromto_to-fromto_from);
   	var product =  ranged * fromto_amnt;
   	var fromto_tamount =  product;
   	document.getElementById('fromto_total_amount').innerHTML=product;
   	document.getElementById('total_amount_fromto').value=product;
   
   
   }
   function addfromto(){
	var fromto_from = document.getElementById('fromto_from').value;
   	var fromto_to = document.getElementById('fromto_to').value;
   	var fromto_amnt = document.getElementById('fromto_amount').value;
   	 var shift = document.getElementById('shift').value;
   var party = document.getElementById('party').value;
   var ranged = Math.abs(fromto_to-fromto_from);
   var master_id;
    var if_exist = document.getElementById('is_filled4').value;
   var actionstr = '';
   if(if_exist){
	   actionstr = 'update_fromto';
	   master_id = if_exist;
   }
   else{
	   actionstr = 'add_fromto';
   }
   	var product =  ranged * fromto_amnt;
	if((fromto_from)&&(fromto_to)&&(fromto_amnt!=0 && fromto_amnt!='')){
	 var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	   //alert("Transation Entered!!")
	   //console.log(JSON.parse(xhttp.responseText));
	   var obj = JSON.parse(xhttp.responseText);
	   //console.log(obj.number.split(","));
	   //var objarrr = obj.number.split(",");
	   if(actionstr == 'add_fromto'){
	   document.getElementById('is_filled1').value = obj.trns_id;
	   document.getElementById('is_filled2').value = obj.trns_id;
	   document.getElementById('is_filled3').value = obj.trns_id;
	   document.getElementById('is_filled4').value = obj.trns_id;
	   document.getElementById('is_filled5').value = obj.trns_id;
	   
	   }
	   console.log(obj);
	   document.getElementById('addtrnheadfromto').insertAdjacentHTML('afterend','<tr><td>From</td><td>'+obj.fromto_from+'</td></tr><tr><td>To</td><td>'+obj.fromto_to+'</td></tr><tr><td>Amount</td><td>'+obj.fromto_amount+'</td></tr><tr><td>Total Amount</td><td>'+obj.all_commission+'</td></tr>');
	   //for (index = 0; index < objarrr.length; index++) {
    //console.log(objarrr[index]);
	//if(objarrr[index]!=""){
		//document.getElementById('addtrnheadf4').insertAdjacentHTML('afterend','<tr><td>'+objarrr[index]+'</td><td>'+obj.amount+'</td></tr>');
	//}
//}
	   //document.getElementById('addtrnhead').insertAdjacentHTML('afterend','<tr><td>'+obj.number+'</td><td>'+obj.Amount+'</td></tr>');
    
   //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift()"></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
   }
   };
   xhttp.open("POST", actionstr, true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send("fromto_from="+fromto_from+"&fromto_to="+fromto_to+"&fromto_amount="+fromto_amnt+"&shift="+shift+"&party="+party+"&total_amount_fromto="+product+"&master_id="+master_id);
	 }   
   }
   
   function adddaraspacef8(){
	   var dara_f8 = document.getElementById('dara_f8').value;
   	var dara_amount_f8 = document.getElementById('dara_amount_f8').value;
   	var akhar_bahar_f8 = document.getElementById('akhar_bahar_f8').value;
	 var shift = document.getElementById('shift').value;
   var party = document.getElementById('party').value;
	   var amount_akahr_bahar_f8 = document.getElementById('amount_akahr_bahar_f8').value;
   	var akahr_andar_f8 = document.getElementById('akahr_andar_f8').value;
	var ranf8amt = document.getElementById('f8_amount').innerHTML;
   	var amount_akahr_andar_f8 = document.getElementById('amount_akahr_andar_f8').value;
	var master_id;
    var if_exist = document.getElementById('is_filled5').value;
   var actionstr = '';
   if(if_exist){
	   actionstr = 'update_random_f8';
	   master_id = if_exist;
   }
   else{
	   actionstr = 'random_f8';
   }
	if((dara_f8)&&(dara_amount_f8)&&(akhar_bahar_f8)&&(amount_akahr_bahar_f8)&&(akahr_andar_f8)&&(amount_akahr_andar_f8)){
	 var xhttp = new XMLHttpRequest();
   xhttp.onreadystatechange = function() {
   if (this.readyState == 4 && this.status == 200) {
	   //alert("Transation Entered!!")
	   //console.log(JSON.parse(xhttp.responseText));
	   var obj = JSON.parse(xhttp.responseText);
	   if(actionstr == 'random_f8'){
	   document.getElementById('is_filled1').value = obj.trns_id;
	   document.getElementById('is_filled2').value = obj.trns_id;
	   document.getElementById('is_filled3').value = obj.trns_id;
	   document.getElementById('is_filled4').value = obj.trns_id;
	   document.getElementById('is_filled5').value = obj.trns_id;
	   
	   }
	   //console.log(obj.number.split(","));
	   //var objarrr = obj.number.split(",");
	   console.log(obj);
	   document.getElementById('addtrnheadf8').insertAdjacentHTML('afterend','<tr><td>Dara</td><td>'+obj.dara_f8+'</td></tr><tr><td>Amount</td><td>'+obj.dara_amount_f8+'</td></tr><tr><td>Akhar Bahar</td><td>'+obj.akhar_bahar_f8+'</td></tr><tr><td>Amount</td><td>'+obj.amount_akahr_bahar_f8+'</td></tr><tr><td>Akhar Andar</td><td>'+obj.akahr_andar_f8+'</td></tr><tr><td>Amount</td><td>'+obj.amount_akahr_andar_f8+'</td></tr>');
	  
   //elem.parentNode.parentNode.insertAdjacentHTML('afterend','<tr><th><input type="text" class="form-control" placeholder="Number" onkeyup="checkshift()"></th> <th><input type="text" class="form-control" name="amount" placeholder=" Amount" onchange="addnumamount(this)"></th></tr>');
   }
   };
   xhttp.open("POST", actionstr, true);
   xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
   xhttp.send( "ranf8amt="+ranf8amt+"&dara_f8="+dara_f8+"&dara_amount_f8="+dara_amount_f8+"&shift="+shift+"&party="+party+"&akhar_bahar_f8="+akhar_bahar_f8+"&akahr_andar_f8="+akahr_andar_f8+"&amount_akahr_bahar_f8="+amount_akahr_bahar_f8+"&amount_akahr_andar_f8="+amount_akahr_andar_f8+"&master_id="+master_id);
	 }
   }
   
   function daraspacef8(){
   	document.getElementById('dara_f8').addEventListener('input', function (e) {
   e.target.value = e.target.value.replace(/[^\dA-Z]/g, '').replace(/(.{2})/g, '$1 ').trim();
   });
   var str = document.getElementById('dara_f8').value.split(" ");
   
   //console.log(str.length);
   var daraamnt = str.length * document.getElementById('dara_amount_f8').value;
   document.getElementById('amount_dara').innerHTML = daraamnt;
   //document.getElementById('ranf8amt').value = daraamnt;
   f8_tamount();
   }
   function akahr_bahar_f8(){
   	var str = document.getElementById('akhar_bahar_f8').value;
   	//console.log(str.toString().length);
   var akbahaamnt = str.length * document.getElementById('amount_akahr_bahar_f8').value;
   document.getElementById('akbahar_dara').innerHTML = akbahaamnt;
   //document.getElementById('ranf8amt').value = parseInt(document.getElementById('ranf8amt').value) + akbahaamnt;
   f8_tamount();
   }
   function calc_akahr_andar_f8(){
   	var str = document.getElementById('akahr_andar_f8').value;
   	//console.log(str.toString().length);
   var akbahaamnt = str.length * document.getElementById('amount_akahr_andar_f8').value;
   document.getElementById('akandar_dara').innerHTML = akbahaamnt;
   //document.getElementById('ranf8amt').value = parseInt(document.getElementById('ranf8amt').value) + akbahaamnt;
   f8_tamount();
   }
   function f8_tamount(){
   	
   	
   	 val1 = parseInt(document.getElementById("akandar_dara").innerHTML);
      if (isNaN(val1) == true) {
          val1 = 0;
      }
   
      var val2 = parseInt(document.getElementById("akbahar_dara").innerHTML);
      if (isNaN(val2) == true) {
          val2 = 0;
      }
   
      var val3 = parseInt(document.getElementById("amount_dara").innerHTML);
      if (isNaN(val3) == true) {
          val3 = 0;
      }
   
   	document.getElementById("f8_amount").innerHTML = val1 + val2 + val3;
   	document.getElementById("ranf8amt").value = val1 + val2 + val3;
   	//console.log(parseInt(str31));
   	//document.getElementById("txtTotal").innerHTML = 
   }
   function selectshift(val){
   	 var className = document.getElementsByClassName('shift_day');
   for(var index=0;index < className.length;index++){
      console.log(className[index].innerHTML);
	  className[index].innerHTML=val.options[val.selectedIndex].text;
   }
   	
   }
 
</script>
<script> 
        setTimeout(function() {
            $('.flsh').hide('slow');
        }, 1000000);
    </script>