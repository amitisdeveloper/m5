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
               <?php
               $data = array('onsubmit' => "document.getElementById('submitledger').disabled=true;");
               echo form_open('tbl_ledger/add_admin', array("class" => "form-horizontal", 'onsubmit' => "document.getElementById('submitledger').disabled=true;")); ?>
               <div class="col-md-7 col-sm-12">

                  <div class="col-md-6 col-sm-12  form-group">
                     <label>
                        Name <span class="required">*</span>
                     </label>
                     <input required type="text" name="ledger_name" value="<?php echo $this->input->post('ledger_name'); ?>" class="form-control" id="ledger_name" />
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label>
                        Real Name
                     </label>
                     <input type="text" name="real_name" value="<?php echo $this->input->post('real_name'); ?>" class="form-control" id="real_name" />
                  </div>
                  <div class="col-md-3 col-sm-12  form-group" style="display:none">
                     <label> AGENT </label>
                     <!--<input type="text" onkeyup="checktpval(this)" name="tp_r"  class="form-control" placeholder="No">-->
                     <select name="tp_r" onchange="checktpval(this)" class="form-control">
                        <option value="" disbaled selected>---</option>
                        <?php foreach ($agent as $key => $val) {
                        ?>
                           <option value="<?= $val['id'] ?>" selected><?= $val['admin_name'] ?></option>
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
                                          <tr>
                                             <th>
                                                <label> Dara Rate</label>
                                                <input name="dara_rate" onkeyup="calcdaracommission(this)" maxlength="2" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> commission</label>
                                                <input name="dara_commision" id="dara_commision" maxlength="2" type="text" class="form-control">
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
                                             <th>
                                                <label> Vapsi </label>
                                                <input type="text" name="rebate" class="form-control">
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
                                                <input type="text" name="openingbalance" class="form-control">
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

                  <div class="col-md-4 col-sm-12  form-group">
                     <label>
                        Owner Name
                     </label>
                     <input name="owner_name" type="text" class="form-control">
                  </div>
                  <div class="col-md-4 col-sm-12  form-group">
                     <label>
                        Mobile
                     </label>
                     <input type="text" name="mobile" class="form-control">
                  </div>
                  <div class="col-md-4 col-sm-12  form-group">
                     <label>
                        Address
                     </label>
                     <input type="text" name="address" class="form-control">
                  </div>
                  <div class="col-md-8 col-sm-6 offset-md-3" style="margin-top:25px;">
                     <button type="submit" class="btn btn-success" id="submitledger" style="padding: .375rem 2.75rem;">Submit</button>
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
                                       <tr><td>Is Active</td><td><input type="checkbox" name="isactive" checked></td></tr>
                                       <tr><td>Automatic Jantri</td><td><input type="checkbox" name="automatic_jantri" ></td></tr>
                                       <tr><td>Lock Master</td><td><input type="checkbox" name="is_locked"></td></tr>
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
            <div class="x_content">
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
                        <div>
                           <div class="card-box table-responsive">
                              <table id="example" class="table table-striped table-bordered" style="width:100%">
                                 <thead>
                                    <tr>
                                       <th>Sr</th>
                                       <th>Master Name</th>
                                       <th>Dara Rate</ht>
                                       <th>Akhar Rate</th>
                                       <th>Akhar Commmission</th>
                                       <th>Dara Commission</th>  
                                       <th>User Name</th>
                                       <th>Password</th>                                     
                                       <th>Updated Date</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody id="trledger">
                                    <?php
                                    if (!empty($tbl_admin)) { //echo '<pre>'; print_r($tbl_ledger); die;
                                       foreach ($tbl_admin as $key => $t) {
                                          //if ($t->status == 1) {
                                    ?>
                                             <tr>
                                                <td><?php echo $key + 1; ?></td>
                                                <td><?php echo $t->ledger_name; ?></td>
                                                <td><?php echo $t->dara_rate; ?></td>
                                                <td><?php echo $t->akhar_rate; ?></td>
                                                <td><?php echo $t->dara_commision; ?></td>
                                                <td><?php echo $t->akhar_commission; ?></td>
                                                <td><?php echo $t->username; ?></td>
                                                <td><?php echo $t->password; ?></td>                                                
                                                <td><?php echo $t->updated_date; ?></td>
                                                <td>
                                                   <a href="<?php echo site_url('edit_admin?id=' . $t->id); ?>" class="btn btn-info btn-xs">Edit</a>
                                                   <!--<a href="<?php echo site_url('tbl_ledger/remove/' . $t->id); ?>" class="btn btn-danger btn-xs">Delete</a>-->
                                                </td>
                                             </tr>
                                    <?php }
                                     //  }
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
                           <!-- <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Inactive Ledgers</button> -->
                           <div id="demo" class="collapse">
                              <table id="example1" class="table table-striped table-bordered" style="width:100%">
                                 <thead>
                                    <tr>
                                       <th>Sr</th>
                                       <th>Master Name</th>
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
                                 </thead>
                                 <tbody>
                                    <?php
                                    if (!empty($tbl_ledger)) {
                                       foreach ($tbl_ledger as $key => $t) {
                                          if ($t->status == 0) { ?>
                                             <tr>
                                                <td><?php echo $key + 1; ?></td>
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
         <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
         <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

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
                  paging: false,
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
         <style>
            .table-bordered {
               border: 1px solid #dee2e6;
               text-align: center;
            }
         </style>