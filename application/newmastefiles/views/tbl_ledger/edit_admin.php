<?php //echo '<pre>'; print_r($tbl_ledger); echo '</pre>'; 

?>

<div class="">

   <div class="clearfix"></div>

   <div class="row">

      <div class="col-md-12 col-sm-12 ">

         <div class="x_panel">

            <div class="x_title">

               <h2 style="text-decoration:underline;"><b>Master</b></h2>

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

               <br />

               <?php echo form_open('tbl_ledger/edit_admin?id=' . $tbl_ledger['id'], array("class" => "form-horizontal")); ?>

               <div class="col-md-7 col-sm-12">



                  <div class="col-md-6 col-sm-12  form-group">

                     <label>

                         Name <span class="required">*</span>

                     </label>

                     <input required type="text" name="ledger_name" value="<?php echo ($this->input->post('ledger_name') ? $this->input->post('ledger_name') : $tbl_ledger['ledger_name']); ?>" class="form-control" id="ledger_name" />

                  </div>

                  <div class="col-md-3 col-sm-12  form-group">

                     <label>

                        Real Name

                     </label>

                     <input type="text" name="real_name" value="<?php echo ($this->input->post('real_name') ? $this->input->post('real_name') : $tbl_ledger['real_name']); ?>" class="form-control" id="real_name" />

                  </div>

                  <!-- <div class="col-md-3 col-sm-12  form-group">

                     <label> AGENT </label>

                                             <select name="tp_r" onchange="checktpval(this)" class="form-control">

												<option value="" disbaled selected>---</option>

												<?php foreach ($agent as $key => $val) {

                                    ?>

													<option value="<?= $val['id'] ?>" <?= ($tbl_ledger['agent_id'] == $val['id']) ? 'selected' : '' ?>><?= $val['agent_name'] ?></option>

													<?php

                                    } ?>

												</select>

                  </div> -->

                  <div class="col-md-12 col-sm-12 ">

                     <div class="x_panel">

                        <div class="x_content">

                           <div class="row">

                              <div class="col-sm-12">

                                 <div class="card-box table-responsive">

                                    <table id="datatable" class="table table-striped table-bordered" style="font-size: 12px; width: 99%; margin-bottom: 0rem; background-color: #ededed; ">

                                       <thead>

                                          <tr>

                                             <th>

                                                <label> Dara Rate</label>

                                                <input name="dara_rate" value="<?= $tbl_ledger['dara_rate'] ?>" onkeyup="calcdaracommission(this)" maxlength="2" type="text" class="form-control">

                                             </th>

                                             <th>

                                                <label> commission</label>

                                                <input name="dara_commision" value="<?= $tbl_ledger['dara_commision'] ?>" id="dara_commision" maxlength="2" type="text" class="form-control">

                                             </th>

                                             <th>

                                                <label> Akhar Rate </label>

                                                <input name="akhar_rate" value="<?= $tbl_ledger['akhar_rate'] ?>" type="text" class="form-control">

                                             </th>

                                             <th>

                                                <label> commission</label>

                                                <input type="text" value="<?= $tbl_ledger['akhar_commission'] ?>" name="akhar_commission" class="form-control">

                                             </th>



                                          </tr>

                                          <tr>

                                             <!--<th>

                                                <label> TPP</label>

                                                <input type="text"  name="tp_commission" class="form-control" placeholder="">

                                             <select name="tp_commission" onchange="checktpcmn(this)" class="form-control">

												<option value="" disbaled selected>---</option>

												<option value="y">Yes</option>

												<option value="n">No</option>

												</select>

											 </th>-->

                                             <th>

                                                <label> Rebate </label>

                                                <input type="text" name="rebate" value="<?= $tbl_ledger['rebate'] ?>" class="form-control">

                                             </th>



                                             <!--<th id="tpparty" style="display:none">

											 <label style="margin-right:10px;">TP Party</label>

                  <div class="btn-group" style="height: 36px; margin-right: 10px;">

                      <select name="tpparty" id="tpparty"  class="form-control">

                        <option value="">--</option>

                        <?php foreach ($party as $key => $val) {

                        ?>

                        <option value="<?= $val['id'] ?>"><?= $val['ledger_name'] ?></option>

                        <?php

                        } ?>

                     </select>

					 

                  </div>

											 </th>-->

                                             <th>

                                                <label> Opening Bal.</label>

                                                <input type="text" name="openingbalance" value="<?= $tbl_ledger['openingbalance'] ?>" class="form-control">

                                             </th>

                                             <th>

                                                <label> Patti</label>

                                                <input type="text" name="hissa" value="<?= $tbl_ledger['hissa'] ?>" class="form-control">

                                                <!--<select name="hissa" onchange="checkhissaval(this)" class="form-control">

												<option value="" disbaled selected>--Please Select--</option>

												<option value="y">Yes</option>

												<option value="n">No</option>

												</select>-->

                                             </th>

                                             <th>

                                                <label> Hisab</label>

                                                <select name="hissa_select" onchange="checkhissaval(this)" class="form-control">

                                                   <!--<option value="" disbaled selected>---</option>-->

                                                   <option <?= ($tbl_ledger['hissa_select'] == 'y') ? 'selected' : '' ?> value="y">Yes</option>

                                                   <option <?= ($tbl_ledger['hissa_select'] == 'n') ? 'selected' : '' ?> value="n">No</option>

                                                </select>

                                             </th>

                                             <!--<th id="hissaparty" style="display:none">

											 <label style="margin-right:10px;">Hissa Party</label>

                  <div class="btn-group" style="height: 36px; margin-right: 10px;">

                      <select name="hissaparty" id="hissaparty"  class="form-control">

                        <option value="">--</option>

                        <?php foreach ($party as $key => $val) {

                        ?>

                        <option value="<?= $val['id'] ?>"><?= $val['ledger_name'] ?></option>

                        <?php

                        } ?>

                     </select>

					 

                  </div>

											 </th>-->

                                          </tr>

                                       </thead>

                                    </table>

                                 </div>

                              </div>

                           </div>

                        </div>

                     </div>

                  </div>



                  <div class="col-md-4 col-sm-12  form-group">

                     <label>

                        Owner Name

                     </label>

                     <input name="owner_name" value="<?= $tbl_ledger['owner_name'] ?>" type="text" class="form-control">

                  </div>

                  <div class="col-md-4 col-sm-12  form-group">

                     <label>

                        Mobile

                     </label>

                     <input type="text" value="<?= $tbl_ledger['mobile'] ?>" name="mobile" class="form-control">

                  </div>

                  <div class="col-md-4 col-sm-12  form-group">

                     <label>

                        Address

                     </label>

                     <input type="text" value="<?= $tbl_ledger['address'] ?>" name="address" class="form-control">

                  </div>

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

                        <?php foreach ($party as $key => $val) {

                        ?>

                        <option value="<?= $val['id'] ?>"><?= $val['ledger_name'] ?></option>

                        <?php

                        } ?>

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

                                    <!-- <thead>

                                       <tr>

                                          <th>Tp Person</th>

                                          <th>Percentage</th>

                                       </tr>

                                    </thead> -->

                                    <tbody>

                                       <!-- <tr id="reb3rd">

                                          <td>



                                             <div class="btn-group" style="height: 36px; margin-right: 10px;">

                                                <select name="tpparty" id="tpparty" class="form-control">

                                                   <option value="">--</option>

                                                   <option value="001">Self</option>

                                                   <?php foreach ($party as $key => $val) {

                                                   ?>

                                                      <option value="<?= $val['id'] ?>"><?= $val['ledger_name'] ?></option>

                                                   <?php

                                                   } ?>

                                                </select>

                                             </div>

                                          </td>

                                          <td><input type="text" class="form-control" name="tppercentage"></td>

                                       </tr> -->

                                       <tr>

                                          <td>Is Active</td>

                                          <td><input type="checkbox" name="isactive" <?= ($tbl_ledger['status']) ? 'checked' : '' ?>></td>

                                       </tr>
                                       <tr><td>Automatic Jantri</td><td><input type="checkbox" name="automatic_jantri" ></td></tr>
                                       <tr><td>Lock Master</td><td><input type="checkbox" <?= ($tbl_ledger['is_locked']) ? 'checked' : '' ?> name="is_locked"></td></tr>

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

                                 <input required="" type="text" name="password" value="<?= $tbl_ledger['password'] ?>" class="form-control" id="password" autocomplete="off">

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

   function calcdaracommission(num) {

      document.getElementById('dara_commision').value = 100 - (num.value);

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