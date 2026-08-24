<style>
    .box {
        border: 1px solid #ccc;
        background-color: #f8f9fa;
        padding: 30px;
        text-align: center;
        margin-bottom: 15px;
    }

    .inner-box {
        border: 1px solid #aaa;
        background-color: #e9ecef;
        padding: 20px;
        margin: 10px;
        text-align: center;
        border-radius: 4px;
        flex: 1 1 30%;
        min-width: 150px;
    }

    .marquee-wrapper {
      overflow: hidden;
      position: relative;
      white-space: nowrap;
      font-size: 1rem;
      font-weight: 500;
      letter-spacing: 1px;
      border-top: 2px solid #0dcaf0;
      border-bottom: 2px solid #0dcaf0;
      background-color: #2A3F54;
    }

    .marquee-content {
      display: inline-block;
      padding-left: 100%;
      animation: scroll-left 20s linear infinite;
      color: #fff;
    }

    @keyframes scroll-left {
      0% {
        transform: translateX(0%);
      }
      100% {
        transform: translateX(-100%);
      }
    }

    /* Pause on hover */
    .marquee-wrapper:hover .marquee-content {
      animation-play-state: paused;
    }
</style>
<div class="marquee-wrapper py-2" style="
    margin-left: -1.2em;
    margin-right: -1.2em;
">
      <div class="marquee-content">
        🔥 Welcome to 555xch 🙏. Current Active Shift is Delhi Bazaar | 🚀 Stay Tuned for Upcoming Updates!
      </div>
    
  </div>
<div class="container mt-5">
    <!-- <marquee class="" style="min-height: 28px;color: #2a4066;font-weight: bold;">Welcome to 555xch 🙏. Current Active Shift is Delhi Bazaar</marquee> -->
    
    
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="p-3 dashboard-tile dashboard-section" data-bs-toggle="modal" data-bs-target="#ledgerModal" style="
    padding-bottom: 0.1rem !important;
">
                        <h6><i class="fas fa-book me-2">&nbsp;</i>Account</h6>
                    </div>
                    <a class="stretched-link" href="<?php echo base_url(); ?>ledger"></a>
                </div>
                <div class="col-md-6 col-12">
                    <div class="p-3 dashboard-tile dashboard-section" data-bs-toggle="modal" data-bs-target="#ledgerModal" style="
    padding-bottom: 0.1rem !important;
">
                        <h6><i class="fas fa-book me-2">&nbsp;</i>Manage Coin</h6>
                    </div>
                    <a class="stretched-link" href="<?php echo base_url(); ?>coins/allocate"></a>
                </div>
            </div>
            <div class="row mt-4">
                <?php foreach ($tbl_openno as $key => $val) { ?>
                    <div class="col-sm-4 mb-3">
                        <div class="p-3 text-white rounded dashboard-tile dashboard-section" data-bs-toggle="modal" data-bs-target="#ledgerModal">
                            <h6 class="text-3d"><i class="fas fa-book me-2">&nbsp;</i><?= $val['shift_name'] ?></h6>
                            <h6>Date : <?= $val['date'] ?></h6>
                            <h6>Last Result: <?= ($val['number'])?$val['number']:'--' ?></h6>
                            <!-- <a class="stretched-link" href="https://master.bull99exch.com/ledger"></a> -->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php //echo '<pre>'; print_r($tbl_transactions); die; ?>
        <div class="col-md-6 col-12">
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12" style="max-height: 450px; overflow-y: auto; padding: 20px; background-color: #f9f9f9;">
                        <h6 class="dashboard-section p-3">Last 20 Entries</h6>
                        <table id="datatable-buttons" class="table table-striped table-bordered" style="font-size:12px;">
                            <thead>
                                <tr>
                                <th>S No </th>
                            <th>Party Name</th>
							<th>Shift Name</th>
                            <th>Amount</th>
                            <th>Entry/ Modified Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($tbl_transactions)&& (!empty($tbl_transactions))){
							foreach($tbl_transactions as $key => $val){
                                    if ($key < 20) {
                                
                                        $tamnt = explode(',',$val['trn_amt']);
                                        ?>
                                        <tr>
                                        <td><?=$key+1?> </td>
                                        <td><?=$val['ledger_name']?></td>
                                        <td><?=$val['shift_name']?></td>
                          <!-- <td><?=($val['staff_name'])?$val['staff_name']:'Super Admin'?></td> -->
                                        <!--<td width="20%"><?=$val['trnno']?></td>
                                        <td width="20%"><?=$val['trn_amt']?></td>-->
                                        <td width="20%"><?=array_sum($tamnt);?></td>
                                        <td><?=($val['modifieddate'])?date('d/m/Y h:i:s',strtotime($val['modifieddate'])).'(M)':date('d/m/Y h:i:s',strtotime($val['createddate'])).'(E)';?></td>
                                        
                                        </tr>
                                <?php
                                    }
                                }
                                } ?>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row mt-4">
        <div class="col-md-9 col-12">
            <div class="row">
                <?php foreach ($shifts as $key => $val) { ?>
                    <div class="col-sm-4 mb-3">
                        <div class="p-3 text-white rounded dashboard-tile dashboard-section" data-bs-toggle="modal" data-bs-target="#ledgerModal">
                            <h6 class="text-3d"><i class="fas fa-book me-2">&nbsp;</i><?= $val['shift_name'] ?></h6>
                            <h6>Date : <?= $val['open_date'] ?></h6>
                            <h6>Last Result: --</h6>
                            <a class="stretched-link" href="https://master.bull99exch.com/ledger"></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>


    </div> -->


</div>

<!-- <div class="container mt-5">
    <marquee class="" style="min-height: 28px;color: #2a4066;font-weight: bold;">Welcome to 555xch 🙏. Current Active Shift is Delhi Bazaar</marquee>
    <div class="row">
        <div class="col-md-3">
            
                <div class="dashboard-tile dashboard-section">
                   <h6><i class="fas fa-user-clock me-2">&nbsp;</i>Shifts</h6>
                   <a class="stretched-link" href="<?php echo base_url(); ?>shift_master"></a>
            </div>
            
        </div>
        <div class="col-md-3">
        
            <div class="dashboard-tile dashboard-section">
                <h6><i class="fas fa-user-tie me-2">&nbsp;</i>Agents</h6>
            </div>
            <a class="stretched-link" href="<?php echo base_url(); ?>agent_master"></a>
        </div>
        <div class="col-md-3">
        
            <div class="dashboard-tile dashboard-section" data-bs-toggle="modal" data-bs-target="#ledgerModal">
                <h6><i class="fas fa-book me-2">&nbsp;</i>Ledgers</h6>
            </div>
            <a class="stretched-link" href="<?php echo base_url(); ?>ledger"></a>
        </div>
        <div class="col-md-3">
            <div class="dashboard-tile">
             <h7><i class="fas fa-clock me-2">&nbsp;</i>Delhi Bazaar</h7>
                <div id="remainingTime" class="display-4 text-center">Calculating...</div>
                <div id="endTime" class="text-muted text-center">End Time: 12:00:00 PM</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="dashboard-tile dashboard-section">
                <h6><i class="fas fa-users-cog me-2">&nbsp;</i>Staff List</h6>
                <a class="stretched-link" href="<?php echo base_url(); ?>staff_master"></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-tile dashboard-section">
                <h6><i class="fas fa-exchange-alt me-2">&nbsp;</i>Transactions</h6>
                <a class="stretched-link" href="<?php echo base_url(); ?>transactions"></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-tile dashboard-section" data-bs-toggle="modal" data-bs-target="#ledgerModal">
                <h6><i class="fas fa-eye me-2">&nbsp;</i>Open Result</h6>
                <a class="stretched-link" href="<?php echo base_url(); ?>openno"></a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-tile dashboard-section">
                <h6><i class="fas fa-balance-scale me-2">&nbsp;</i>Hisab</h6>
                <a class="stretched-link" href="<?php echo base_url(); ?>user_hisab_agent"></a>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="rounded-4 shadow-sm p-4 mb-4" style="background: linear-gradient(135deg, #2A4066, #4facfe);color: white;border-radius: 10px;margin-top: 50px;">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">
                    <i class="bi bi-person-lines-fill me-2"></i> Coin Details
                </h6>
                <button class="btn btn-light fw-semibold px-4 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#">
                    <i class="bi bi-plus-circle me-1"></i> Create
                </button>
            </div>
        </div>


        <div class="table-responsive">
            <table id="dtable" class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Ledger Name</th>
                        <th>Debit (₹)</th>
                        <th>Credit (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($coins)): ?>
                        <?php $i = 1;
                        foreach ($coins as $txn): ?>
                            <?php if (!empty($txn['ledger_name'])): // Ignore blank ledger names 
                            ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= date('d-m-Y', strtotime($txn['date'])) ?></td>
                                    <td><?= $txn['ledger_name'] ?></td>
                                    <td><?= number_format($txn['debit'], 2) ?></td>
                                    <td><?= number_format($txn['credit'], 2) ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No transactions found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div> -->
<style>
    .col-md-4.col-sm-12.form-group.sbmtbtn {
        display: flex;
        /* flex-direction: column; */
    }

    .sbmtbtn button.btn.btn-success {
        margin-top: auto;
    }

    .title-box {
        background-color: #f8f9fa;
        padding: 15px;
        border: 1px solid #dee2e6;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        margin-bottom: 20px;
    }
</style>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<script>
    jQuery(document).ready(function($) {
        //$.noConflict();
        $('#dtable').DataTable();
    });
</script>
<!-- Modals -->
<div class="modal fade" id="agentModal" tabindex="-1" aria-labelledby="agentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="agentModalLabel">Agent</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item bg-dark text-white">Agent Details 1</li>
                    <li class="list-group-item bg-dark text-white">Agent Details 2</li>
                    <li class="list-group-item bg-dark text-white">Agent Details 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="membersModal" tabindex="-1" aria-labelledby="membersModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="membersModalLabel">Members</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item bg-dark text-white">Member 1</li>
                    <li class="list-group-item bg-dark text-white">Member 2</li>
                    <li class="list-group-item bg-dark text-white">Member 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="idModal" tabindex="-1" aria-labelledby="idModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="idModalLabel">2904</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item bg-dark text-white">ID Info 1</li>
                    <li class="list-group-item bg-dark text-white">ID Info 2</li>
                    <li class="list-group-item bg-dark text-white">ID Info 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="chipsModal" tabindex="-1" aria-labelledby="chipsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="chipsModalLabel">Chips</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item bg-dark text-white">Chips Info 1</li>
                    <li class="list-group-item bg-dark text-white">Chips Info 2</li>
                    <li class="list-group-item bg-dark text-white">Chips Info 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="shareModalLabel">Company Share</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item bg-dark text-white">Share Info 1</li>
                    <li class="list-group-item bg-dark text-white">Share Info 2</li>
                    <li class="list-group-item bg-dark text-white">Share Info 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="casinoModal" tabindex="-1" aria-labelledby="casinoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="casinoModalLabel">Casino</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item bg-dark text-white">Casino Info 1</li>
                    <li class="list-group-item bg-dark text-white">Casino Info 2</li>
                    <li class="list-group-item bg-dark text-white">Casino Info 3</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- <div class="modal fade" id="ledgerModal" tabindex="-1" aria-labelledby="ledgerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="ledgerModalLabel">Ledger</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item bg-dark text-white">Ledger Info 1</li>
                    <li class="list-group-item bg-dark text-white">Ledger Info 2</li>
                    <li class="list-group-item bg-dark text-white">Ledger Info 3</li>
                </ul>
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="createModalLabel">Create</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item bg-dark text-white">Create Item 1</li>
                    <li class="list-group-item bg-dark text-white">Create Item 2</li>
                    <li class="list-group-item bg-dark text-white">Create Item 3</li>
                </ul>
            </div>
        </div>
    </div>
    <?php //print_r($coins); 
    ?>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const remainingTimeElement = document.getElementById('remainingTime');
            const endTimeElement = document.getElementById('endTime');

            // Set initial end time (current time + 5 hours)
            let endTime = new Date();
            endTime.setTime(endTime.getTime() + 5 * 60 * 60 * 1000);

            function updateClock() {
                const now = new Date();

                // Update end time display (remains constant after initial set)
                endTimeElement.textContent = `End Time: ${endTime.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true })}`;

                // Calculate remaining time
                const timeDiff = Math.max(0, endTime - now); // Ensure no negative time
                if (timeDiff <= 0) {
                    remainingTimeElement.textContent = "Time's up!";
                } else {
                    const totalSeconds = Math.floor(timeDiff / 1000);
                    const hours = Math.floor(totalSeconds / 3600);
                    const minutes = Math.floor((totalSeconds % 3600) / 60);
                    const seconds = totalSeconds % 60;
                    remainingTimeElement.textContent = `${hours}h ${minutes}m ${seconds}s`;
                }
            }

            // Update clock every second
            setInterval(updateClock, 1000);
            updateClock(); // Initial call
        });
    </script>
    <script>
        // Example: Fetch end time from database (replace with your actual data source)
        let endTimeFromDB = "12:00:00 PM"; // Format: HH:MM:SS AM/PM (no date)
        // For demonstration, replace with your database fetch logic
        /*
        $.ajax({
            url: '/getEndTime',
            method: 'GET',
            success: function(data) {
                endTimeFromDB = data.endTime; // Ensure format is HH:MM:SS AM/PM
                startClock();
            },
            error: function(error) {
                console.error('Error fetching end time:', error);
            }
        });
        */

        const clockElement = $('#digital-clock');
        const endTimeElement = $('#end-time');

        function startClock() {
            endTimeElement.text('End Time: ' + endTimeFromDB);
            const endTimeStr = endTimeFromDB.split(' ')[0]; // Extract HH:MM:SS
            const endPeriod = endTimeFromDB.split(' ')[1]; // Extract AM/PM
            const [endHours, endMinutes, endSeconds] = endTimeStr.split(':').map(Number);

            function updateClock() {
                const now = new Date();
                let hours = now.getHours();
                let minutes = now.getMinutes();
                let seconds = now.getSeconds();
                const period = hours >= 12 ? 'PM' : 'AM';

                // Convert to 12-hour format
                hours = hours % 12 || 12;

                // Calculate time difference (simplified for AM/PM comparison)
                let targetHours = endPeriod === 'PM' ? (endHours % 12 || 12) + 12 : endHours % 12 || 12;
                let timeLeftHours = targetHours - hours;
                let timeLeftMinutes = endMinutes - minutes;
                let timeLeftSeconds = endSeconds - seconds;

                // Adjust for negative values and carry over
                if (timeLeftSeconds < 0) {
                    timeLeftSeconds += 60;
                    timeLeftMinutes--;
                }
                if (timeLeftMinutes < 0) {
                    timeLeftMinutes += 60;
                    timeLeftHours--;
                }
                if (timeLeftHours < 0) {
                    timeLeftHours += 12; // Wrap around to next AM/PM cycle if needed
                }

                // Stop if time is up or negative
                if (timeLeftHours < 0 || (timeLeftHours === 0 && timeLeftMinutes < 0 && timeLeftSeconds <= 0)) {
                    clearInterval(timer);
                    clockElement.text('12:00:00 AM');
                    return;
                }

                clockElement.text(`${String(timeLeftHours).padStart(2, '0')}:${String(timeLeftMinutes).padStart(2, '0')}:${String(timeLeftSeconds).padStart(2, '0')} ${period}`);
            }

            const timer = setInterval(updateClock, 1000);
            updateClock(); // Initial call
        }

        // Start the clock with the database end time
        startClock();

        // Removed Chart.js script as requested
    </script>
    <script>
        (function() {
            function c() {
                var b = a.contentDocument || a.contentWindow.document;
                if (b) {
                    var d = b.createElement('script');
                    d.innerHTML = "window.__CF$cv$params={r:'92f22df52ff2bfd3',t:'MTc0NDQ1NTIwMi4wMDAwMDA='};var a=document.createElement('script');a.nonce='';a.src='/cdn-cgi/challenge-platform/scripts/jsd/main.js';document.getElementsByTagName('head')[0].appendChild(a);";
                    b.getElementsByTagName('head')[0].appendChild(d)
                }
            }
            if (document.body) {
                var a = document.createElement('iframe');
                a.height = 1;
                a.width = 1;
                a.style.position = 'absolute';
                a.style.top = 0;
                a.style.left = 0;
                a.style.border = 'none';
                a.style.visibility = 'hidden';
                document.body.appendChild(a);
                if ('loading' !== document.readyState) c();
                else if (window.addEventListener) document.addEventListener('DOMContentLoaded', c);
                else {
                    var e = document.onreadystatechange || function() {};
                    document.onreadystatechange = function(b) {
                        e(b);
                        'loading' !== document.readyState && (document.onreadystatechange = e, c())
                    }
                }
            }
        })();
    </script>
    <!-- Add this in the <head> section if not already included -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <style>
        body {
            color: #fff;
        }

        .dashboard-tile {
            background-color: #2A4066;
            border-radius: 10px;
            padding: 15px;
            margin: 10px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .dashboard-tile:hover {
            background-color: #3A5A88;
        }

        .dashboard-tile i {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .dashboard-section {
            background-color: #2A4066;
            border-radius: 10px;
            padding: 1px;
            margin: 8px;
        }

        .create-btn {
            float: right;
            background-color: #2A4066;
            border: none;
            color: white;
        }

        .modal-content {
            background-color: #2A4066;
            color: white;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        /* Clock Styles */
        .clock-block {
            background-color: #2A4066;
            /* Match dashboard theme */
            color: #73879C;
            /* Sober slate gray text */
            padding: 20px;
            border-radius: 10px;
            margin: 10px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            height: calc(100vh - 80px);
            /* Adjust height to fill the column */
            overflow-y: auto;
            /* Add scroll if content overflows */
        }

        #digital-clock,
        #remainingTime {
            font-size: 1em;
            font-weight: bold;
        }

        .end-time {
            font-size: 1em;
            color: #A0A0A0;
            /* Lighter gray for end time */

        }

        .dashboard-section h5 {
            margin-bottom: 30px;
            margin-top: 30px;
        }
    </style>