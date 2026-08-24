<div class="">
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-12 col-sm-12 ">
         <div class="x_panel" style="height: auto;">
            <?php if ($this->session->flashdata('success')): ?>
               <div class="alert alert-success" id="successMessage"><?= $this->session->flashdata('success') ?></div>
            <?php
               $this->session->unset_userdata('success');

            endif; ?>

            <div class="x_title">
               <h2 style="text-decoration:underline;"><a class="collapse-link" style="cursor: pointer;"><b>Add New Party</b><i class="fa fa-chevron-down"></i></a></h2>
               <!-- <ul class="nav navbar-right panel_toolbox">
                  <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                  </li>
               </ul> -->
               <!-- <div class="nav navbar-right panel_toolbox">
                  <div class="form-group pull-right top_search">
                     <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                           <button class="btn btn-default" type="button">Go!</button>
                        </span>
                     </div>
                  </div>
               </div> -->
               <div class="clearfix"></div>
            </div>
            <div class="x_content" style="display:none">
               <?php if (validation_errors()): ?>
                  <div style="color: red;">
                     <?php echo validation_errors(); ?>
                  </div>
               <?php endif; ?>
               <br />
               <?php
               $data = array('onsubmit' => "document.getElementById('submitledger').disabled=true;");
               echo form_open('tbl_ledger/add', array("class" => "form-horizontal", 'onsubmit' => "document.getElementById('submitledger').disabled=true;")); ?>
               <div class="col-md-7 col-sm-12">

                  <div class="col-md-3 col-sm-12  form-group">
                     <label>
                        Account Name <span class="required">*</span>
                     </label>
                     <input required type="text" name="ledger_name" value="<?php echo $this->input->post('ledger_name'); ?>" class="form-control" id="ledger_name" />
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label> App Parent ID </label>
                     <!--<input type="text" onkeyup="checktpval(this)" name="tp_r"  class="form-control" placeholder="No">-->
                     <select name="parent_id" onchange="checktpval(this)" class="form-control">
                        <option value="" disbaled selected>---</option>
                        <?php foreach ($tbl_ledger as $key => $val) {
                           if (!is_array($val)) {
                              $val = (array)$val;
                           }
                        ?>
                           <option value="<?= $val['id'] ?>"><?= $val['ledger_name'] ?></option>
                        <?php
                        } ?>
                     </select>
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label>
                        Real Name
                     </label>
                     <input type="text" name="real_name" value="<?php echo $this->input->post('real_name'); ?>" class="form-control" id="real_name" />
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label> AGENT </label>
                     <!--<input type="text" onkeyup="checktpval(this)" name="tp_r"  class="form-control" placeholder="No">-->
                     <select name="tp_r" onchange="checktpval(this)" class="form-control">
                        <option value="" disbaled selected>---</option>
                        <?php foreach ($agent as $key => $val) {
                        ?>
                           <option value="<?= $val['id'] ?>"><?= $val['agent_name'] ?></option>
                        <?php
                        } ?>
                     </select>
                  </div>
                  <div class="col-md-12 col-sm-12 ">
                     <div class="x_panel">
                        <div class="x_content" style="display:none">
                           <div class="row">
                              <div class="col-sm-12">
                                 <div class="card-box table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered" style="font-size: 12px; width: 99%; margin-bottom: 0rem; background-color: #ededed; ">
                                       <thead>
                                          <tr>
                                             <th>
                                                <label> Dara Rate</label>
                                                <input name="dara_rate" onkeyup="calcdaracommissionn(this)" maxlength="5" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> commission</label>
                                                <input name="dara_commision" id="dara_commision" maxlength="5" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> Akhar Rate </label>
                                                <input name="akhar_rate" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> commission</label>
                                                <input type="text" name="akhar_commission" class="form-control">
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
                                             <!-- <th>
                              <label> Vapsi </label>
                              <input type="text" name="rebate" class="form-control">
                           </th> -->

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
                                                <label> Coin Balance</label>
                                                <input type="number" min="1" step="1" oninput="validity.valid||(value='');" name="coin_balance" class="form-control">
                                             </th>
                                             <th>
                                                <label> Patti</label>
                                                <input type="text" name="hissa" class="form-control">

                                             </th>
                                             <th>
                                                <label> Hisab</label>
                                                <select name="hissa_select" onchange="checkhissaval(this)" class="form-control">
                                                   <!--<option value="" disbaled selected>---</option>-->
                                                   <option value="y">Yes</option>
                                                   <option value="n">No</option>
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

                  <!-- <div class="col-md-4 col-sm-12  form-group">
   <label>
      Owner Name
   </label>
   <input name="owner_name" type="text" class="form-control">
</div>

<div class="col-md-4 col-sm-12  form-group">
   <label>
      Address
   </label>
   <input type="text" name="address" class="form-control">
</div> -->
                  <div class="col-md-4 col-sm-12  form-group">
                     <label>
                        Mobile
                     </label>
                     <input type="text" name="mobile" class="form-control">
                  </div>
                  <div class="col-md-8 col-sm-6 offset-md-3" style="margin-top:25px;">
                     <button type="submit" class="btn btn-success" id="submitledger" style="padding: .375rem 2.75rem;">Submit</button>
                  </div>

               </div>
               <div class="col-md-5 col-sm-12">
                  <div class="tile_count">
                     <div class="x_panel" style="border:none;">
                        <div class="x_content" style="display:none">
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
                                       </tr>
                                       <!-- <tr><td>Is Master</td><td><input type="checkbox" name="ismaster" ></td></tr> -->
                                    </tbody>

                                 </table>

                              </div>
                              <div class="col-md-6 col-sm-12  form-group"><label>
                                    Username <span class="required">*</span>
                                 </label>
                                 <input required="" type="text" name="username" value="" class="form-control" id="username" autocomplete="off">
                              </div>
                              <div class="col-md-6 col-sm-12  form-group"><label>
                                    Password <span class="required">*</span>
                                 </label>
                                 <input required="" type="text" name="password" value="<?= $password ?>" class="form-control" id="password" autocomplete="off">
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
   <div class="row">
      <div class="col-md-12 col-sm-12 ">
         <div class="x_panel">
            <div class="x_content" style="">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="card-box table-responsive">
                        <!--<table id="datatable" class="table table-striped table-bordered" style="width:100%">
                           <tbody>
                              <tr><td>Agent List</td>
                              <td><select onchange="changeledger(this.value)" name="agent" class="form-control" >
                              <option>--</option>
                              <?php
                              foreach ($agent as $k => $age) {
                              ?>
                                 <option value="<?= $age['id'] ?>"><?= $age['agent_name'] ?></option>
                                 <?php
                              }
                                 ?>

                              </select></td>
                           </tr>
                        </tbody>
                           </table>-->
                        <?php //echo '<pre>'; print_r($allparty); die; 
                        ?>
                        <div>
                           <div class="card-box table-responsive">
                              <!-- <div class="totals">
        <span class="total-credit">Total Lena: <span id="totalCredit">0.00</span></span>
        <span class="total-debit">Total Dena: <span id="totalDebit">0.00</span></span>
    </div>    -->
                              <table id="example" class="table table-striped responsive table-bordered" style="width:100%">
                                 <thead>
                                    <tr>
                                       <th>Account Name</th>
                                       <th>Transaction Date</th>
                                       <th>Credit</th>
                                       <th>Avail. Balance</th>
                                       <th>P/L</th>

                                       <th>Action</th>
                                       <!-- <th>Party Name</th> -->

                                       <!-- <th>Dara Rate</ht>
                                       <th>Akhar Rate</th>
                                       <th>Mobile</th>
                                       <th>Agent</th>
                                       <th>Updated Date</th>
                                       <th>Akhar Commmission</th>
                                       <th>Dara Commission</th>
                                       <th>Hissa</th> -->
                                       <!-- <th>Address</th> -->
                                       <!-- <th>Action</th> -->
                                    </tr>
                                 </thead>
                                 <tbody id="trledger1">
                                    <?php
                                    if (!empty($allparty)) {
                                       foreach ($allparty as $val) {
                                          if ($val['ledger_id'] == '295') {
                                             //echo '<pre'; print_r($val); die;
                                          }
                                          $avl_bal = $val['coin_balance'];
                                          $pnl = $val['credit_balance'] - ($val['coin_balance']);
                                          //$pnl = $val['today_hisab'];
                                          $user_id = $val['ledger_id'];
                                          $start_date = date('Y-m-01'); // 1st of current month
                                          $end_date = date('Y-m-d');    // today's date
                                          $url = base_url("statement/$user_id?start_date=$start_date&end_date=$end_date");
                                          $commurl = base_url("master_comm_till_date/$user_id?start_date=$start_date&end_date=$end_date");
                                    ?>
                                          <tr>
                                             <td><?= $val['ledger_name'] ?></td>
                                             <td><?= date('d-m-Y', strtotime($val['last_transaction_date'])); ?></td>
                                             <td><?= $val['credit_balance'] ?>
                                                <a href="#"
                                                   class="edit-credit-btn"
                                                   data-ledger-id="<?= $val['ledger_id'] ?>"
                                                   data-ledger-name="<?= $val['ledger_name'] ?>"
                                                   data-credit="<?= $val['credit_balance'] ?>"
                                                   data-toggle="modal"
                                                   data-target="#allocateCreditModal">
                                                   <i class="fa fa-pencil" aria-hidden="true"></i>
                                                </a>
                                             </td>
                                             <td>
                                                <?= $avl_bal ?>
                                             </td>
                                             <td class="<?= $val['coin_balance'] ?>">
                                                <span style="color: <?= $pnl < 0 ? 'red' : 'inherit' ?>">
                                                   <?= $pnl < 0 ? number_format(abs($pnl), 2) : number_format($pnl, 2) ?>
                                                </span>
                                             </td>
                                             <td>
                                                <div class="d-inline-flex flex-wrap gap-1">
                                                   <!-- Deposit -->
                                                   <a href="#"
                                                      class="btn btn-success btn-sm action-btn"
                                                      data-toggle="modal"
                                                      data-target="#viewModal"
                                                      data-action="Deposite"
                                                      title="Deposite"
                                                      data-ledger-id="<?= $val['ledger_name'] ?>"
                                                      data-ledger-idd="<?= $val['ledger_id'] ?>"
                                                      data-row='<?= json_encode($val) ?>'>
                                                      D
                                                   </a>

                                                   <!-- Withdraw -->
                                                   <a href="#"
                                                      class="btn btn-danger btn-sm action-btn"
                                                      data-toggle="modal"
                                                      data-target="#actionModal"
                                                      data-action="Withdraw"
                                                      title="Withdraw"
                                                      data-ledger-id="<?= $val['ledger_name'] ?>"
                                                      data-ledger-idd="<?= $val['ledger_id'] ?>">
                                                      W
                                                   </a>

                                                   <!-- Edit -->
                                                   <a href="<?= site_url('tbl_ledger/edit/') . $val['ledger_id']; ?>"
                                                      class="btn btn-warning btn-sm"
                                                      data-action="Edit"
                                                      data-ledger-id="<?= $val['ledger_id'] ?>">
                                                      Edit
                                                   </a>

                                                   <!-- Statement -->
                                                   <a href="<?= $url ?>"
                                                      class="btn btn-primary btn-sm"
                                                      data-action="Statement"
                                                      data-ledger-id="<?= $val['ledger_id'] ?>">
                                                      Statement
                                                   </a>

                                                   <!-- Master Commission -->
                                                   <a href="<?= $commurl ?>"
                                                      class="btn btn-info btn-sm"
                                                      data-action="M Commision"
                                                      data-ledger-id="<?= $val['ledger_id'] ?>">
                                                      M Commision
                                                   </a>

                                                   <!-- Hisab (JS POST) -->
                                                   <a href="#"
                                                      class="btn btn-secondary btn-sm"
                                                      onclick="submitHisab(<?= $val['ledger_id'] ?>, '<?= date('Y-m-d', strtotime($val['last_transaction_date'])); ?>')">
                                                      Hisab
                                                   </a>
                                                </div>
                                             </td>



                                          </tr>

                                    <?php
                                       }
                                    }
                                    ?>
                                 </tbody>
                                 <!-- <tfoot>
                                    <tr>
                                       <th>Sr</th>
                                       <th>Ledger Name</th>
                                       <th>Party Name</th>

                                       <th>Dara Rate</ht>
                                       <th>Akhar Rate</th>
                                       <th>Mobile</th>
                                       <th>Updated BY</th>
                                       <th>Updated Date</th>
                                       <th>Akhar Commmission</th>
                                       <th>Dara Commission</th>
                                       <th>Vapsi|TPR</th>
                                       <th>Hissa</th>
                                       <th>Address</th>
                                       <th>Action</th>
                                    </tr>
                                 </tfoot> -->
                              </table>
                              <div id="loading">Please wait...</div>
                           </div>
                           <button type="button" class="btn btn-info" data-toggle="collapse" style="display:none" data-target="#demo">Inactive Ledgers</button>
                           <div id="demo" class="collapse">
                              <table id="example1" class="table table-striped table-bordered" style="width:100%">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Ledger Name</th>
                                       <th>Party Name</th>

                                       <th>Dara Rate</ht>
                                       <th>Akhar Rate</th>
                                       <th>Mobile</th>
                                       <th>Updated BY</th>
                                       <th>Updated Date</th>
                                       <th>Akhar Commmission</th>
                                       <th>Dara Commission</th>
                                       <th>Hissa</th>
                                       <th>Address</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                    if (!empty($tbl_ledger)) {
                                       foreach ($tbl_ledger as $key => $t) {
                                          if ($t->status == 0) { ?>
                                             <tr>
                                                <td>
                                                   <button class="btn dropdown-toggle">▼</button>
                                                   <div class="dropdown-menu">
                                                      <a href="#">Deposit</a>
                                                      <a href="#">Withdrawn</a>
                                                      <a href="#">Inactive</a>
                                                      <a href="#">Block Betting</a>
                                                      <a href="#">UnBlock Casino</a>
                                                      <a href="#"><b>Edit</b></a>
                                                      <a href="#"><b>Statement</b></a>
                                                      <a href="#"><b>Account Operations</b></a>
                                                      <a href="#"><b>Login Report</b></a>
                                                      <a href="#">Reset Password</a>
                                                   </div>
                                                </td>
                                                <td><?php echo $t->ledger_name; ?></td>
                                                <td><?php echo $t->real_name; ?></td>
                                                <td><?php echo $t->dara_rate; ?></td>
                                                <td><?php echo $t->akhar_rate; ?></td>
                                                <td><?php echo $t->mobile; ?></td>
                                                <td><?php echo $t->user_name; ?></td>
                                                <td><?php echo $t->updated_date; ?></td>
                                                <td><?php echo $t->dara_commision; ?></td>
                                                <td><?php echo $t->akhar_commission; ?></td>

                                                <td><?php echo $t->tp_r; ?></td>
                                                <td><?php echo $t->hissa; ?></td>
                                                <td><?php echo $t->address; ?></td>
                                                <td>
                                                   <a href="<?php echo site_url('tbl_ledger/edit/' . $t->id); ?>" class="btn btn-info btn-xs">Edit</a>
                                                   <a href="<?php echo site_url('tbl_ledger/remove/' . $t->id); ?>" class="btn btn-danger btn-xs">Delete</a>
                                                </td>
                                             </tr>
                                    <?php }
                                       }
                                    }
                                    ?>
                                 </tbody>
                                 <!-- <tfoot>
                                    <tr>
                                       <th>Sr</th>
                                       <th>Ledger Name</th>
                                       <th>Party Name</th>

                                       <th>Dara Rate</ht>
                                       <th>Akhar Rate</th>
                                       <th>Mobile</th>
                                       <th>Updated BY</th>
                                       <th>Updated Date</th>
                                       <th>Akhar Commmission</th>
                                       <th>Dara Commission</th>
                                       <th>Vapsi|TPR</th>
                                       <th>Hissa</th>
                                       <th>Address</th>
                                       <th>Action</th>
                                    </tr>
                                 </tfoot> -->
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>



         <!-- Deposite Modal -->
         <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content deposite">
                  <div class="modal-header">
                     <h5 class="modal-title" id="actionModalLabel1">Action</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body" id="actionFormDBody">

                     <form id="actionFormdw" name="wform">

                     </form>
                     <form id="actionFormD" method="post" action="<?= base_url('coins/allocate/processmaster') ?>" data-ledger-id="" name="dform">
                        <div class="form-group p-4 shadow-sm">
                           <div class="row align-items-center">
                              <div class="col-sm-5 d-flex align-items-center">
                                 <label for="actionInput" class="mb-0">
                                    <h6 class="mb-0">Balance:</h6>
                                 </label>
                              </div>
                              <div class="col-sm-7">
                                 <input type="number" step="1" min="0" class="form-control" id="actionInput" name="amount" placeholder="Enter number of coins">
                                 <input type="hidden" name="receiver_id" id="ledger_id1" value="">
                                 <input type="hidden" name="transactiontype" value="D">
                              </div>
                           </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>

         <!-- Withdraw Modal -->
         <div class="modal fade" id="actionModal" tabindex="-1" role="dialog" aria-labelledby="actionModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content withdraw">
                  <div class="modal-header">
                     <h5 class="modal-title" id="actionModalLabel2">Action</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <form id="actionFormW" method="post" action="<?= base_url('coins/allocate/processmaster') ?>" name="wform">
                        <div class="form-group row p-4 shadow-sm">
                           <!-- <h6 class="modal-title" for="actionInput">Number Of Coins : </h6>
                            <input type="number" step="1" min="0" class="form-control" id="actionInput" name="comment" placeholder="Enter number of coins">
                            <input type="hidden" name="transactiontype" value="withdraw"> -->

                           <h6 class="modal-title" for="actionInput">Balance : </h6>
                           <div class="col-sm-6">
                              <input type="number" step="1" min="0" class="form-control" id="actionInput" name="amount" placeholder="Enter number of coins">
                              <input type="hidden" name="receiver_id" id="ledger_id2" value="">
                              <input type="hidden" name="transactiontype" value="W">
                           </div>

                        </div>
                        <button type="submit" class="btn-danger btn">Submit</button>
                     </form>
                  </div>
               </div>
            </div>
         </div>
         <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
         <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
         <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
         <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
         <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
         <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
         <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
         <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
         <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
         <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
         <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
         <script src="https://cdn.datatables.net/plug-ins/1.13.3/api/sum().js"></script>
         <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
         <script>
            function submitHisab(ledgerId, date) {
               const form = document.createElement('form');
               form.method = 'POST';
               form.action = 'ledger_till_date_reports';

               const ledgerInput = document.createElement('input');
               ledgerInput.type = 'hidden';
               ledgerInput.name = 'ledger_id';
               ledgerInput.value = ledgerId;
               form.appendChild(ledgerInput);

               const dateInput = document.createElement('input');
               dateInput.type = 'hidden';
               dateInput.name = 'date';
               dateInput.value = date;
               form.appendChild(dateInput);

               document.body.appendChild(form);
               form.submit();
            }
         </script>

         <script>
            $(document).ready(function() {
               $(document).on('click', '.action-btn', function(e) {
                  e.preventDefault(); // Prevent default link behavior
                  const action = $(this).data('action');
                  const ledgerId = $(this).data('ledger-id');
                  $('#ledger_id1').val($(this).data('ledger-idd'));
                  $('#ledger_id2').val($(this).data('ledger-idd'));
                  // Update modal title
                  $('#actionModalLabel1').html(`<span class="credit highlight-green">${action}</span> for : <span class="account-name-highlight">${ledgerId}</span>`);
                  $('#actionModalLabel2').html(`<span class="debit highlight-red">${action}</span> for : <span class="account-name-highlight">${ledgerId}</span>`);
                  // Configure form submission
                  //  $('#actionForm').off('submit').on('submit', function(e) {
                  //      e.preventDefault();
                  //      const comment = $('#actionInput').val();
                  //      console.log(`Action: ${action}, Ledger ID: ${ledgerId}, Comment: ${comment}`);
                  //      // Replace console.log with actual form submission logic (e.g., AJAX)
                  //      $('#actionModal').modal('hide');
                  //      $('#actionForm')[0].reset();
                  //  });
               });
               $(document).on('click', '.edit-credit-btn', function() {
                  var ledgerId = $(this).data('ledger-id');
                  var ledgerName = $(this).data('ledger-name');
                  var credit = $(this).data('credit');

                  $('#modal_ledger_id').val(ledgerId);
                  $('#modal_ledger_name').val(ledgerName);
                  $('#modal_credit').val(credit);
               });





               // Dropdown toggle logic using event delegation
               $(document).on('click', '.dropdown-toggle', function(e) {
                  e.stopPropagation();
                  var menu = $(this).next('.dropdown-menu');
                  $('.dropdown-menu').not(menu).hide(); // Hide all others
                  menu.toggle();
               });

               // Hide dropdowns when clicking outside
               $(document).on('click', function() {
                  $('.dropdown-menu').hide();
               });
            });

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

            function changeledger(val) {
               // trledger
               var http = new XMLHttpRequest();
               var url = '/getagentledger';
               var params = 'ageid=' + val;
               http.open('POST', url, true);

               //Send the proper header information along with the request
               http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

               http.onreadystatechange = function() { //Call a function when the state changes.
                  if (http.readyState == 4 && http.status == 200) {
                     //console.log(http.responseText);
                     document.getElementById('trledger').innerHTML = http.responseText;
                  }
               }
               http.send(params);
            }
            jQuery(document).ready(function($) {
               $('#example').DataTable({
                  dom: 'Bfrtip',
                  "scrollX": true,
                  buttons: [
                     'csv', 'excel', 'pdf'
                  ],
                  scrollY: '300px',
                  scrollCollapse: true,
                  paging: true,
                  drawCallback: function() {
                     var api = this.api();
                     var sum = 0;
                     var formated = 0;
                     //to show first th
                     $(api.column(0).footer()).html('Total');
                     $(api.column(7).footer()).html('Total');
                     for (var i = 3; i <= 6; i++) {
                        sum = api.column(i, {
                           page: 'current'
                        }).data().sum();

                        //to format this sum
                        formated = parseFloat(sum).toLocaleString(undefined, {
                           minimumFractionDigits: 2
                        });
                        $(api.column(i).footer()).html('₹' + formated);
                     }


                  },
                  "order": []
               });
               // $('.autosel').select2();

            });
         </script>
         <!-- <script>
        // Sample JSON data (replace with your actual data)
        const ledgerData = <?= $allparty ?>

       // Function to calculate balances per ledger_id and month
       function calculateBalances(data) {
            // Group data by ledger_id and month
            const groupedByLedgerAndMonth = {};
            data.forEach(entry => {
                const date = new Date(entry.transaction_date);
                const yearMonth = `${date.getFullYear()}-${date.getMonth() + 1}`; // e.g., "2025-5"
                const key = `${entry.ledger_id}-${yearMonth}`;
                if (!groupedByLedgerAndMonth[key]) {
                    groupedByLedgerAndMonth[key] = [];
                }
                groupedByLedgerAndMonth[key].push(entry);
            });

            // Calculate balance for each ledger_id and month
            const result = [];
            for (const key in groupedByLedgerAndMonth) {
                // Sort transactions by date within each group
                const transactions = groupedByLedgerAndMonth[key].sort(
                    (a, b) => new Date(a.transaction_date) - new Date(b.transaction_date)
                );

                let balance = 0;
                transactions.forEach((entry, index) => {
                    const credit = parseFloat(entry.credit) || 0;
                    const withdraw = parseFloat(entry.withdraw) || 0;
                    if (index === 0) {
                        // First transaction of the month: balance = credit - withdraw
                        balance = credit - withdraw;
                    } else {
                        // Subsequent transactions: update balance
                        balance = balance + credit - withdraw;
                    }
                    result.push({
                        ...entry,
                        balance: balance.toFixed(2)
                    });
                });
            }

            // Sort by transaction_date for display
            return result.sort((a, b) => new Date(a.transaction_date) - new Date(b.transaction_date));
        }

        // Function to calculate total credit and debit
        function calculateTotals(data) {
            let totalCredit = 0;
            let totalDebit = 0;
            data.forEach(entry => {
                totalCredit += parseFloat(entry.credit) || 0;
                totalDebit += parseFloat(entry.withdraw) || 0;
            });
            return { totalCredit: totalCredit.toFixed(2), totalDebit: totalDebit.toFixed(2) };
        }

        // Initialize DataTable and totals
        jQuery(document).ready(function($) {
            // Calculate and display totals
            const totals = calculateTotals(ledgerData);
            $('#totalCredit').text(totals.totalCredit);
            $('#totalDebit').text(totals.totalDebit);

            const dataWithBalance = calculateBalances(ledgerData);
            $('#ledgerTable').DataTable({
                data: dataWithBalance,
                columns: [
                    { data: 'account_name' },
                    { data: 'transaction_date' },
                    { data: 'credit' },
                    { data: 'withdraw' },
                    { data: 'balance' },
                    {
                        data: 'ledger_id',
                        render: function(data, type, row) {
                            if (type === 'display') {
                                return `
                                    <div class="action-buttons">
                                        <a href="#" class="btn-sm btn-success action-btn" data-toggle="modal" data-target="#viewModal" data-action="Deposite" title="Deposite" data-ledger-id="${row.account_name}" data-ledger-idd="${row.ledger_id}"  data-row='${JSON.stringify(row)}'>D</a>
                                        <a href="#" class="btn-sm btn-danger action-btn" data-toggle="modal" data-target="#actionModal" data-action="Withdraw" title="Withdraw" data-ledger-id="${row.account_name}" data-ledger-idd="${row.ledger_id}">W</a>
                                        <a href="<?php echo site_url('tbl_ledger/edit/'); ?>${row.ledger_id}" class="btn btn-sm btn-primary" data-action="Edit" data-ledger-id="${row.ledger_id}">Edit</a>
                                        
                                        <a href="<?php echo site_url('user_hisab_agent'); ?>" class="btn btn-sm btn-primary" data-action="Edit" data-ledger-id="${row.ledger_id}">View</a>
                                    </div>
                                `;
                            }
                            return data;
                        }
                    }
                ],
                columnDefs: [
                    {
                        targets: 2, // Credit column
                        render: function(data, type, row) {
                            const value = parseFloat(data) || 0;
                            if (type === 'display' && value !== 0) {
                                return `<span class="credit highlight-green">${data}</span>`;
                            }
                            return data;
                        }
                    },
                    {
                        targets: 3, // Withdraw column
                        render: function(data, type, row) {
                            const value = parseFloat(data) || 0;
                            if (type === 'display' && value !== 0) {
                                return `<span class="debit highlight-red">${data}</span>`;
                            }
                            return data;
                        }
                    },
                    {
                        targets: 4, // Balance column
                        render: function(data, type, row) {
                            const value = parseFloat(data) || 0;
                            if (type === 'display') {
                                if (value >= 0) {
                                    return `<span class="credit highlight-green">${data}</span>`;
                                } else {
                                    return `<span class="debit highlight-red">${data}</span>`;
                                }
                            }
                            return data;
                        }
                    },
                    {
                        targets: 5, // Action column
                        orderable: false // Disable sorting on Action column
                    }
                ],
                pageLength: 10,
                order: [[1, 'desc']] // Sort by transaction_date
            });
             // Handle action button clicks to update modal
            $(document).on('click', '.action-btn', function(e) {
                e.preventDefault(); // Prevent default link behavior
                const action = $(this).data('action');
                const ledgerId = $(this).data('ledger-id');
                alert('test');
                $('#ledger_id1').val($(this).data('ledger-idd'));
                $('#ledger_id2').val($(this).data('ledger-idd'));
                // Update modal title
                $('#actionModalLabel1').html(`<span class="credit highlight-green">${action}</span> for : <span class="account-name-highlight">${ledgerId}</span>`);
                $('#actionModalLabel2').html(`<span class="debit highlight-red">${action}</span> for : <span class="account-name-highlight">${ledgerId}</span>`);
                // Configure form submission
                $('#actionForm').off('submit').on('submit', function(e) {
                    e.preventDefault();
                    const comment = $('#actionInput').val();
                    console.log(`Action: ${action}, Ledger ID: ${ledgerId}, Comment: ${comment}`);
                    // Replace console.log with actual form submission logic (e.g., AJAX)
                    $('#actionModal').modal('hide');
                    $('#actionForm')[0].reset();
                });
            });
           
        });
    </script> -->
         <script>
            // Auto-hide after 3 seconds (3000 ms)
            setTimeout(function() {
               $('#successMessage').fadeOut('slow');
            }, 3000);
         </script>
         <style>
            .btn-group form {
               margin: 0;
            }

            .btn-group form input[type="submit"] {
               height: 100%;
            }

            #loading {
               display: none;
               position: fixed;
               top: 40%;
               left: 50%;
               transform: translate(-50%, -50%);
               background: #000;
               color: #fff;
               padding: 15px 30px;
               border-radius: 8px;
               font-weight: bold;
               z-index: 9999;
            }

            .account-name-highlight {
               background-color: #fffccc;
               /* Light yellow background */
               padding: 2px 5px;
               border-radius: 3px;
               text-decoration: underline;
            }

            .highlight-red {
               background-color: #ffcccc;
               padding: 2px 5px;
               border-radius: 3px;
            }

            .highlight-green {
               background-color: #ccffcc;
               padding: 2px 5px;
               border-radius: 3px;
            }

            .modal-content.deposite {
               background-color: #fff;
               color: #000;
            }

            .modal-content.withdraw {
               background-color: #fff;
               color: #000000;
            }

            .credit {
               color: green;
               font-weight: bold;
            }

            .debit {
               color: darkred;
               font-weight: bold;
            }

            .totals {
               margin-bottom: 20px;
               font-size: 16px;
            }

            .total-credit {
               color: green;
               margin-right: 20px;
            }

            .total-debit {
               color: red;
            }

            table.dataTable thead th {
               background-color: #2A3F54 !important;
               color: white !important;
            }

            table.dataTable tbody td {
               padding: 8px;
               position: relative;
            }

            /* .btn {
               background-color: #00aaff;
               color: white;
               padding: 5px 8px;
               border: none;
               cursor: pointer;
               font-size: 16px;
               border-radius: 4px;
            } */

            #trledger .dropdown-menu {
               display: none;
               position: absolute;
               top: 35px;
               left: 0;
               background: white;
               border: 1px solid #ccc;
               box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
               z-index: 10;
               width: 180px;
            }

            .dropdown-menu a {
               display: block;
               padding: 8px 12px;
               text-decoration: none;
               color: black;
               font-size: 14px;
            }

            .dropdown-menu a:hover {
               background-color: #f0f0f0;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button {
               background-color: #00aaff !important;
               color: white !important;
               border: none;
               padding: 5px 10px;
               margin: 2px;
               border-radius: 4px;
            }

            .dataTables_wrapper .dataTables_paginate .paginate_button.current {
               background-color: #0077cc !important;
            }

            .table-bordered {
               border: 1px solid #dee2e6;
               text-align: center;
            }
         </style>
         <!-- Credit Edit Modal -->
         <div class="modal fade" id="allocateCreditModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
               <form id="creditEditForm" method="post" action="<?= site_url('allocate_credit') ?>">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Allocate Credit</h5>
                        <button type="button" class="close" data-dismiss="modal">
                           <span>&times;</span>
                        </button>
                     </div>
                     <div class="modal-body">
                        <input type="hidden" name="ledger_id" id="modal_ledger_id">
                        <div class="form-group">
                           <label for="modal_ledger_name">Ledger Name</label>
                           <input type="text" id="modal_ledger_name" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                           <label for="modal_credit">Credit Amount</label>
                           <input type="number" name="credit_balance" id="modal_credit" class="form-control" required>
                        </div>
                     </div>
                     <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>