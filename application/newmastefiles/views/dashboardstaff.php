
            
            <div class="row">
                <div class="col-md-7 col-sm-12">
                    <div class="tile_count">
					<?php foreach($shifts as $key => $val){ ?>
						<div class="col-md-4 col-sm-4  tile_stats_count">
                            <span class="count_top"> DATE:<?=$val['open_date']?></span>
                            <div class="count" style="font-size:17px;"><?=$val['shift_name']?></div>
                            <!--<span class="count_bottom"><i class="green">RESULT: </i> 09</span>-->
                        </div>
					<?php } ?>
                        
                        
                        <!-- <div class="col-md-12 col-sm-4 ">

                            <div class="tile_count">
                                <div class="x_panel"style="width:102%;">
                                    <div class="x_content">
                                        <div class="row">
                                            <div class="col-sm-12" style="height:40px;">
                                                <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size:12px;">
                                                   
                                                    <tr>
                                                        <th>SR</th>
                                                        <th>DECLARE NEEDED</th>
                                                        <th>UPDATE-BY</th>
                                                        <th>UPDATE-TIME </th>
                                                        <th>ACTION </th>
                                                    </tr>
                                                   
                                                    
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                        </div> -->
                     </div>
                  </div>
                <div class="col-md-5 col-sm-12">
                    <div class="tile_count">
                            <div class="x_panel">
                                <div class="x_content">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size:12px;">
                                                <thead>
                                                    <tr>
                                                        <th>SR</th>
                                                        <th>NEW LEDGER</th>
                                                        <th>ADD-BY</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php foreach($ledger as $key => $val){
                                                    if($key<10){
													?>
													<tr>
                                                        <td><?=$key+1?>.</td>
                                                        <td><?=$val['ledger_name']?></td>
                                                        <td><?=$val['ledger_name']?> <br /><?=$val['updated_date']?></td>

                                                    </tr>
													<?php
                                                    }
												} ?>
                                                    
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
