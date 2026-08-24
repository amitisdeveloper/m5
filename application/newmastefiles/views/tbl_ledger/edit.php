<?php //echo '<pre>'; print_r($tbl_ledger); echo '</pre>'; 
?>
<div class="">
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-12 col-sm-12 ">
         <div class="x_panel">
            <div class="x_title">
               <h2 style="text-decoration:underline;"><b>Ledger</b></h2>
               <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                  </li>
               </ul>
               <div class="nav navbar-right panel_toolbox">
                  <div class="form-group pull-right top_search">
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                           <button class="btn btn-default" type="button">Go!</button>
                        </span>
                     </div>
                  </div>
               </div>
               <div class="clearfix"></div>
            </div>
            <div class="x_content">
               <?php if (validation_errors()): ?>
                  <div style="color: red;">
                     <?php echo validation_errors(); ?>
                  </div>
               <?php endif; ?>
               <br />
               <?php echo form_open('tbl_ledger/edit/' . $tbl_ledger['id'], array("class" => "form-horizontal")); ?>
               <div class="col-md-7 col-sm-12">

                  <div class="col-md-3 col-sm-12  form-group">
                     <label>
                        Ledger Name <span class="required">*</span>
                     </label>
                     <input required type="text" name="ledger_name" value="<?php echo ($this->input->post('ledger_name') ? $this->input->post('ledger_name') : $tbl_ledger['ledger_name']); ?>" class="form-control" id="ledger_name" />
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label> App Parent ID </label>
                     <!--<input type="text" onkeyup="checktpval(this)" name="tp_r"  class="form-control" placeholder="No">-->
                     <select name="parent_id" onchange="checktpval(this)" class="form-control">
                        <option value="" disbaled>---</option>
                        <?php foreach ($tbl_ledgers as $key => $val) {
                           if (!is_array($val)) {
                              $val = (array)$val;
                           }
                        ?>
                           <option value="<?= $val['id'] ?>" <?= ($tbl_ledger['parent_id'] == $val['id']) ? 'selected' : '' ?>><?= $val['ledger_name'] ?></option>
                        <?php
                        } ?>
                     </select>
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label>
                        Real Name
                     </label>
                     <input type="text" name="real_name" value="<?php echo ($this->input->post('real_name') ? $this->input->post('real_name') : $tbl_ledger['real_name']); ?>" class="form-control" id="real_name" />
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label> AGENT </label>
                     <!--<input type="text" onkeyup="checktpval(this)" name="tp_r"  class="form-control" placeholder="No">-->
                     <select name="tp_r" onchange="checktpval(this)" class="form-control">
                        <option value="" disbaled selected>---</option>
                        <?php foreach ($agent as $key => $val) {
                        ?>
                           <option value="<?= $val['id'] ?>" <?= ($tbl_ledger['agent_id'] == $val['id']) ? 'selected' : '' ?>><?= $val['agent_name'] ?></option>
                        <?php
                        } ?>
                     </select>
                  </div>
                  <div class="col-md-12 col-sm-12 ">
                     <div class="x_panel">
                        <div class="x_content">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="font-size: 12px; width: 99%; margin-bottom: 0rem; background-color: #ededed; ">
                                       <thead>
                                          <tr style="vertical-align: top;">

                                             <!-- Group 1: Dara -->
                                             <th style="width: 33%;">
                                                <div><strong>Dara Details</strong></div>

                                                <label>Dara Rate</label>
                                                <input name="dara_rate" value="<?= $tbl_ledger['dara_rate'] ?>" onkeyup="calcdaracommissionn(this)" maxlength="5" type="text" class="form-control mb-1">

                                                <div class="d-flex gap-2">
                                                   <div style="flex: 1;">
                                                      <label style="font-size: 11px;">Party Comm</label>
                                                      <input name="dara_commision" value="<?= $tbl_ledger['dara_commision'] ?>" id="dara_commision" maxlength="5" type="text" class="form-control">
                                                   </div>
                                                   <div style="flex: 1;">
                                                      <label style="font-size: 11px;">Master Comm</label>
                                                      <input name="dara__master_commision" value="<?= $tbl_ledger['dara__master_commision'] ?>" id="dara__master_commision" maxlength="5" type="text" class="form-control">
                                                   </div>
                                                </div>
                                             </th>

                                             <!-- Group 2: Akhar -->
                                             <th style="width: 33%;">
                                                <div><strong>Akhar Details</strong></div>

                                                <label>Akhar Rate</label>
                                                <input name="akhar_rate" value="<?= $tbl_ledger['akhar_rate'] ?>" type="text" class="form-control mb-1">

                                                <div class="d-flex gap-2">
                                                   <div style="flex: 1;">
                                                      <label style="font-size: 11px;">Party Comm</label>
                                                      <input name="akhar_commission" value="<?= $tbl_ledger['akhar_commission'] ?>" id="akhar_commission" maxlength="5" type="text" class="form-control">
                                                   </div>
                                                   <div style="flex: 1;">
                                                      <label style="font-size: 11px;">Master Comm</label>
                                                      <input name="akhar__master_commision" value="<?= $tbl_ledger['akhar__master_commision'] ?>" id="akhar__master_commision" maxlength="5" type="text" class="form-control">
                                                   </div>
                                                </div>
                                             </th>

                                             <!-- Group 3: Final (Opening + Patti + Hisab) -->
                                             <th style="width: 33%;">
                                                <div><strong>Final Section</strong></div>

                                                <!-- Opening Balance -->
                                                <label>Opening Bal.</label>
                                                <input type="text" name="openingbalance" value="<?= $tbl_ledger['openingbalance'] ?>" class="form-control mb-2">

                                                <!-- Patti & Hisab in one row -->
                                                <div class="d-flex gap-2">
                                                   <div style="flex: 1;">
                                                      <label>Patti</label>
                                                      <input type="text" name="hissa" value="<?= $tbl_ledger['hissa'] ?>" class="form-control">
                                                   </div>
                                                   <div style="flex: 1;">
                                                      <label>Hisab</label>
                                                      <select name="hissa_select" onchange="checkhissaval(this)" class="form-control">
                                                         <option <?= ($tbl_ledger['hissa_select'] == 'y') ? 'selected' : '' ?> value="y">Yes</option>
                                                         <option <?= ($tbl_ledger['hissa_select'] == 'n') ? 'selected' : '' ?> value="n">No</option>
                                                      </select>
                                                   </div>
                                                </div>
                                             </th>

                                          </tr>
                                       </thead>



                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

                  <!-- <div class="col-md-4 col-sm-12  form-group">
                        <label>
                        Owner Name  
                        </label>
                        <input name="owner_name" value="<?= $tbl_ledger['owner_name'] ?>" type="text" class="form-control" >
                     </div>
                     <div class="col-md-4 col-sm-12  form-group">
                        <label>
                        Mobile 
                        </label>
                        <input type="text" value="<?= $tbl_ledger['mobile'] ?>" name="mobile" class="form-control" >
                     </div>
                     <div class="col-md-4 col-sm-12  form-group">
                        <label>
                        Address
                        </label>
                        <input type="text" value="<?= $tbl_ledger['address'] ?>" name="address" class="form-control" >
                     </div> -->
                  <div class="col-md-8 col-sm-6 offset-md-3" style="margin-top:25px;">
                     <button type="submit" class="btn btn-success" style="padding: .375rem 2.75rem;">Submit</button>
                  </div>

               </div>
               <div class="col-md-5 col-sm-12">
                  <div class="tile_count">
                     <div class="x_panel" style="border:none;">
                        <div class="x_content">
                           <!--<div class="row">
                              <div class="col-sm-12">
                                 <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 12px; margin-bottom: 1rem; background-color: #ededed; ">
                                    <thead>
                                       <tr>
                                          <th>3rd Party </th>
                                          <th>D-common</th>
                                          <th>A-common</th>
                                       </tr>
                                    </thead>
									<tbody>
									<tr id="tp3rd" style="display:none">
                                          <td>
                      <select name="tpparty" id="tpparty"  class="form-control">
                        <option value="">--</option>
                        
                     </select>					 
                  </td>
                                          <td><input type="text" class="form-control" name="dcommm" placeholder="D Commission"></td>
                                          <td><input type="text" class="form-control" name="akcommm" placeholder="A Commission"></td>
                                       </tr>
									</tbody>
                                 </table>
                              </div>
                           </div>-->
                           <div class="row">
                              <div class="col-sm-12">
                                 <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 12px; margin-bottom: 1rem; background-color: #ededed; ">
                                    <thead>
                                       <tr>
                                          <th>Tp Person</th>
                                          <th>Percentage</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr id="reb3rd">
                                          <td>

                                             <div class="btn-group" style="height: 36px; margin-right: 10px;">
                                                <select name="tpparty" id="tpparty" class="form-control autosel">
                                                   <option value="">--</option>
                                                   <option value="001">Self</option>
                                                   <?php foreach ($party as $key => $val) {
                                                      $val = (array)$val;
                                                   ?>
                                                      <option value="<?= $val['id'] ?>" <?= ($tbl_ledger['tp_party_id'] == $val['id']) ? 'selected' : '' ?>><?= $val['ledger_name'] ?></option>
                                                   <?php
                                                   } ?>
                                                </select>
                                             </div>
                                          </td>
                                          <td><input type="text" value="<?= $tbl_ledger['tppercentage'] ?>" class="form-control" name="tppercentage"></td>
                                       </tr>
                                       <tr>
                                          <td>Is Master</td>
                                          <td><input type="checkbox" name="ismaster" <?= ($tbl_ledger['is_master']) ? 'checked' : '' ?>></td>
                                       </tr>
                                       <tr>
                                          <td>Active</td>
                                          <td><input type="checkbox" name="isactive" <?= ($tbl_ledger['status']) ? 'checked' : '' ?>></td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                              <div class="col-md-6 col-sm-12  form-group"><label>
                                    Username <span class="required">*</span>
                                 </label>
                                 <input required="" type="text" name="username" value="<?= $tbl_ledger['username'] ?>" class="form-control" id="username" autocomplete="off">
                              </div>
                              <div class="col-md-6 col-sm-12  form-group"><label>
                                    Password <span class="required">*</span>
                                 </label>
                                 <input required="" type="text" name="password" value="<?= (!empty($tbl_ledger['password'])) ? $tbl_ledger['password'] : '' ?>" class="form-control" id="password" autocomplete="off">
                              </div>
                           </div>

                        </div>
                     </div>
                  </div>
               </div>
               <?php form_close(); ?>
            </div>
         </div>
      </div>
   </div>

</div>
<script>
   function calcdaracommissionn(input) {
      // Get the value of dara_rate
      var daraRate = parseFloat(input.value);

      // Check if the value is a valid number and between 0 and 100
      if (!isNaN(daraRate) && daraRate >= 0 && daraRate <= 100) {
         // Calculate the corresponding commission value
         var daraCommission = 100 - daraRate;

         // If dara_rate is an integer, display the commission without decimals
         if (daraRate % 1 === 0) {
            // Round to a whole number if dara_rate is an integer
            daraCommission = Math.round(daraCommission);
         } else {
            // Keep two decimal places if dara_rate is not an integer
            daraCommission = daraCommission.toFixed(2);
         }

         // Set the value of the dara_commision input field
         document.getElementById('dara_commision').value = daraCommission;
      } else {
         // If the value entered is invalid, reset the commission field
         document.getElementById('dara_commision').value = '';
      }
   }

   function checktpcmn(obj) {
      if (obj.value == 'n') {
         document.getElementById("tp3rd").style.display = "none";
      } else {
         document.getElementById("tp3rd").style.display = "contents";
      }
   }

   function checktpval(obj) {
      if (obj.value == 'n') {
         document.getElementById("reb3rd").style.display = "none";
      } else {
         document.getElementById("reb3rd").style.display = "contents";
      }
   }

   function checkhissaval(obj) {
      if (obj.value == 'n') {
         document.getElementById("hissapartyy").style.display = "none";
      } else {
         document.getElementById("hissapartyy").style.display = "contents";
      }
   }
</script>
<style>
   .table-bordered {
      border: 1px solid #dee2e6;
      text-align: center;
   }
</style>