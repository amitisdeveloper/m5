
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<div class="">
					
					<div class="clearfix"></div>
					
					<div class="row">
						<div class="col-md-12 col-sm-12 ">
							<div class="x_panel" style="width:101% !important;">
								<div class="x_title">
									
                                    <div class="title_right">
                                       
                                        <div class="col-md-5 col-sm-5  form-group pull-right top_search" style="margin-top:10px;">
                                            <h5><u>Allocate Coins</u></h5>
                                        </div>
                                        
                                    </div>
                                    
									<ul class="nav navbar-right panel_toolbox">
										<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
										</li>
										
										
									</ul>
                                   
									<div class="clearfix"></div>
								</div>

								
                                <div class="x_content">
<!-- Success Message -->
<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- Error Message -->
<?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo $this->session->flashdata('error'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>

<!-- Auto-hide Script -->
<script>
    // Automatically hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').alert('close'); // Close all alerts
    }, 5000);
</script>



<form method="POST" action="<?= base_url('coins/allocate/process') ?>" class="allocation-form">
    <div class="form-group">
        <label for="receiver_id">Select Master:</label>
        <select name="receiver_id" id="receiver_id" class="form-control autoselected">
            <?php foreach ($users as $user): ?>
                <option value="<?= $user['id'] ?>"><?= $user['ledger_name'] ?> </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Allocate</button>
</form>

<style>
    /* General form styling */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .allocation-form {
        width: 100%;
        max-width: 500px;
        /* To keep the form at a reasonable width */
        margin: 0 auto;
        /* Centers the form */
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .allocation-form .form-group {
        margin-bottom: 20px;
        /* Space between form elements */
    }

    .allocation-form .form-group label {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 8px;
        display: block;
        /* Ensures the label is on its own line */
    }

    .allocation-form .form-control {
        width: 100%;
        /* Ensures inputs and selects span the full width */
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }

    .allocation-form .form-control:focus {
        border-color: #5cb85c;
        /* Green border on focus */
        outline: none;
    }

    .allocation-form button {
        padding: 12px 20px;
        background-color: #28a745;
        /* Green background */
        color: white;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        display: inline-block;
        margin-top: 10px;
        /* Adds space above button */
    }

    .allocation-form button:hover {
        background-color: #218838;
        /* Darker green on hover */
    }

    .allocation-form button:disabled {
        background-color: #d6d6d6;
        /* Greyed out button when disabled */
        cursor: not-allowed;
    }

    /* Add responsiveness for smaller screens */
    @media (max-width: 768px) {
        .allocation-form {
            padding: 15px;
        }

        .allocation-form .form-group {
            margin-bottom: 15px;
            /* Reduced margin for smaller screens */
        }
    }
</style>
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
                                                <!-- <th>Sender Name</th> -->
                                                <th>Receiver Name</th>

                                                <th>Amount</ht>
                                                <th>Transaction type</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody id="trledger">
                                            <?php
                                            if (!empty($transactions)) { //echo '<pre>'; print_r($transactions); die;
                                                foreach ($transactions as $key => $t) {
                                            ?>
                                                        <tr>
                                                            <td><?php echo $key + 1; ?></td>
                                                            <!-- <td><?php echo $t['sender_name']; ?></td> -->
                                                            <td>
                                                                <?php /* echo $t['receiver_name']; */?>
                                                            <?php 
                                                            if($t['sender_id']=='1' && $this->session->userdata('id') == '1'){
                                                                echo $t['receiver_name'];
                                                            }
                                                            else{
                                                                if($t['sender_id']=='1'){
                                                                  echo  'Super Admin';
                                                                }   
                                                                else{
                                                                   echo $t['receiver_name'];
                                                                }
                                                            }
                                                            ?>
                                                            </td>
                                                            <td><?php echo $t['amount']; ?></td>
                                                            <td><?php 
                                                            if($t['sender_id']=='1' && $this->session->userdata('id') == '1'){
                                                                echo 'Spend';
                                                            }
                                                            else{
                                                                if($t['sender_id']=='1'){
                                                                    echo 'Received';
                                                                }   
                                                                else{
                                                                    echo 'Spend';
                                                                } 
                                                            }
                                                            ?></td>
                                                            <!-- <td>
                                                                <a href="<?php echo site_url('tbl_ledger/edit/' . $t['id']); ?>" class="btn btn-info btn-xs">Edit</a>
                                                                
                                                            </td> -->
                                                        </tr>
                                            <?php 
                                                }
                                            }
                                            ?>
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
</div>
</div>