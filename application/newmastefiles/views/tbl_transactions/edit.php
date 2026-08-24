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
               <br />
               <div class="col-md-8 col-sm-12">
                  <?php echo form_open('tbl_ledger/edit/'.$tbl_ledger['id'],array("class"=>"form-horizontal")); ?>
                  <div class="col-md-6 col-sm-12  form-group">
                     <label>
                     Ledger Name  <span class="required">*</span>
                     </label>
                     <input required type="text" name="ledger_name" value="<?php echo ($this->input->post('ledger_name') ? $this->input->post('ledger_name') : $tbl_ledger['ledger_name']); ?>" class="form-control" id="ledger_name" />
                  </div>
                  <div class="col-md-3 col-sm-12  form-group">
                     <label>
                     Real Name
                     </label>
                     <input  type="text" name="real_name" value="<?php echo ($this->input->post('real_name') ? $this->input->post('real_name') : $tbl_ledger['real_name']); ?>" class="form-control" id="real_name" />
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
                                                <input value="<?php echo ($this->input->post('dara_rate') ? $this->input->post('dara_rate') : $tbl_ledger['dara_rate']); ?>" name="dara_rate" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> commission</label>
                                                <input value="<?php echo ($this->input->post('dara_commision') ? $this->input->post('dara_commision') : $tbl_ledger['dara_commision']); ?>" name="dara_commision" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> Akhar Rate </label>
                                                <input value="<?php echo ($this->input->post('akhar_rate') ? $this->input->post('akhar_rate') : $tbl_ledger['akhar_rate']); ?>" name="akhar_rate" type="text" class="form-control">
                                             </th>
                                             <th>
                                                <label> commission</label>
                                                <input value="<?php echo ($this->input->post('akhar_commission') ? $this->input->post('akhar_commission') : $tbl_ledger['akhar_commission']); ?>" type="text" name="akhar_commission" class="form-control">
                                             </th>
                                             <th>
                                                <label> TP common</label>
                                                <input value="<?php echo ($this->input->post('tp_commission') ? $this->input->post('tp_commission') : $tbl_ledger['tp_commission']); ?>" type="text" name="tp_commission" class="form-control" placeholder="No">
                                             </th>
                                             <th>
                                                <label> Rebate </label>
                                                <input type="text" name="rebate" value="<?php echo ($this->input->post('rebate') ? $this->input->post('rebate') : $tbl_ledger['rebate']); ?>" class="form-control">
                                             </th>
                                             <th>
                                                <label> TP </label>
                                                <input type="text" name="tp_r" value="<?php echo ($this->input->post('tp_r') ? $this->input->post('tp_r') : $tbl_ledger['tp_r']); ?>"  class="form-control" placeholder="No">
                                             </th>
                                             <th>
                                                <label> Hissa</label>
                                                <input type="text" name="hissa" value="<?php echo ($this->input->post('hissa') ? $this->input->post('hissa') : $tbl_ledger['hissa']); ?>" class="form-control" placeholder="No">
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
                        <input value="<?php echo ($this->input->post('owner_name') ? $this->input->post('owner_name') : $tbl_ledger['owner_name']); ?>" name="owner_name" type="text" class="form-control" >
                     </div>
                     <div class="col-md-4 col-sm-12  form-group">
                        <label>
                        Mobile 
                        </label>
                        <input value="<?php echo ($this->input->post('mobile') ? $this->input->post('mobile') : $tbl_ledger['mobile']); ?>" type="text" name="mobile" class="form-control" >
                     </div>
                     <div class="col-md-4 col-sm-12  form-group">
                        <label>
                        Address
                        </label>
                        <input type="text" value="<?php echo ($this->input->post('address') ? $this->input->post('address') : $tbl_ledger['address']); ?>" name="address" class="form-control" >
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
   
</div>