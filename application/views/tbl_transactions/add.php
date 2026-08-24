<div class="">
   <div class="clearfix"></div>
   <div class="row">
      <div class="col-md-12 col-sm-12 ">
         <div class="x_panel">
            <div class="x_title">
               <h2 style="text-decoration:underline;"><b>Ledgerr</b></h2>
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
               <div class="col-md-8 col-sm-12">
                  <?php echo form_open('tbl_ledger/add',array("class"=>"form-horizontal")); ?>
                  <div class="col-md-6 col-sm-12  form-group">
                     <label>
                     Ledger Name  <span class="required">*</span>
                     </label>
                     <input required type="text" name="ledger_name" value="<?php echo $this->input->post('ledger_name'); ?>" class="form-control" id="ledger_name" />
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label>
                     Real Name
                     </label>
                     <input  type="text" name="real_name" value="<?php echo $this->input->post('real_name'); ?>" class="form-control" id="real_name" />
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label>
                     Group<span class="required">*</span>
                     </label>
                     <select name="group" class="select2_single form-control" tabindex="-1">
                        <option>Fanter</option>
                        <!--<option value="DATA Entry Operator">DATA ENTRY OPERATOR </option>-->
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
                                                <input name="dara_rate" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> commission</label>
                                                <input name="dara_commision" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> Akhar Rate </label>
                                                <input name="akhar_rate" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> commission</label>
                                                <input type="text" name="akhar_commission" class="form-control">
                                             </th>
                                             <th>
                                                <label> TP common</label>
                                                <input type="text" name="tp_commission" class="form-control" placeholder="No">
                                             </th>
                                             <th>
                                                <label> Rebate </label>
                                                <input type="text" name="rebate" class="form-control">
                                             </th>
                                             <th>
                                                <label> TP </label>
                                                <input type="text" name="tp_r"  class="form-control" placeholder="No">
                                             </th>
                                             <th>
                                                <label> Hissa</label>
                                                <input type="text" name="hissa" class="form-control" placeholder="No">
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
                  <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                     <div class="col-md-4 col-sm-12  form-group">
                        <label>
                        Owner Name  
                        </label>
                        <input name="owner_name" type="text" class="form-control" >
                     </div>
                     <div class="col-md-4 col-sm-12  form-group">
                        <label>
                        Mobile 
                        </label>
                        <input type="text" name="mobile" class="form-control" >
                     </div>
                     <div class="col-md-4 col-sm-12  form-group">
                        <label>
                        Address
                        </label>
                        <input type="text" name="address" class="form-control" >
                     </div>
                     <div class="col-md-8 col-sm-6 offset-md-3" style="margin-top:25px;">
                        <button type="submit" class="btn btn-success" style="padding: .375rem 2.75rem;">Submit</button>
                     </div>
                  </form>
               </div>
               <div class="col-md-4 col-sm-12">
                  <div class="tile_count">
                     <div class="x_panel" style="border:none;">
                        <div class="x_content">
                           <div class="row">
                              <div class="col-sm-12">
                                 <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 12px; margin-bottom: 4rem; background-color: #ededed; ">
                                    <thead>
                                       <tr>
                                          <th>3rd Party </th>
                                          <th>D-common</th>
                                          <th>A-common</th>
                                       </tr>
                                    </thead>
                                 </table>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 12px; margin-bottom: 4rem; background-color: #ededed; ">
                                    <thead>
                                       <tr>
                                          <th>3rd Party </th>
                                          <th>Rebate</th>
                                       </tr>
                                    </thead>
                                 </table>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-sm-12">
                                 <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size: 12px; margin-bottom: 4rem; background-color: #ededed; ">
                                    <thead>
                                       <tr>
                                          <th>Party </th>
                                          <th>Hissa</th>
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
                        <table id="datatable" class="table table-striped table-bordered" style="width:100%">
                           <thead>
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
                           </thead>
                           <tbody>
						   <?php foreach($tbl_ledger as $key => $t){ ?>
                              <tr>
		<td><?php echo $key+1; ?></td>
		<td><?php echo $t['ledger_name']; ?></td>
		<td><?php echo $t['real_name']; ?></td>
		<td><?php echo $t['dara_rate']; ?></td>
		<td><?php echo $t['akhar_rate']; ?></td>
		<td><?php echo $t['mobile']; ?></td>
		<td><?php echo $t['user_name']; ?></td>
		<td><?php echo $t['updated_date']; ?></td>
		<td><?php echo $t['dara_commision']; ?></td>
		<td><?php echo $t['akhar_commission']; ?></td>
		
		<td><?php echo $t['tp_r']; ?></td>
		<td><?php echo $t['hissa']; ?></td>
		<td><?php echo $t['address']; ?></td>
		<td>
            <a href="<?php echo site_url('tbl_ledger/edit/'.$t['id']); ?>" class="btn btn-info btn-xs">Edit</a> 
            <a href="<?php echo site_url('tbl_ledger/remove/'.$t['id']); ?>" class="btn btn-danger btn-xs">Delete</a>
        </td>
    </tr>
						   <?php }?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>