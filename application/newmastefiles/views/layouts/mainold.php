<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="<?php echo base_url(); ?>images/favicon.ico" type="image/ico" />

  <title> 555xch </title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="<?php echo base_url(); ?>assets/css/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="<?php echo base_url(); ?>assets/css/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="<?php echo base_url(); ?>assets/skins/flat/green.css" rel="stylesheet">
  <link href="<?php echo base_url(); ?>assets/css/bootstrap-datetimepicker.css" rel="stylesheet">
  <!-- bootstrap-progressbar 
    <link href="vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap 
    <link href="vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/> -->
  <!-- bootstrap-daterangepicker -->
  <link href="<?php echo base_url(); ?>assets/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="<?php echo base_url(); ?>assets/css/custom.min.css" rel="stylesheet">
</head>
<?php //echo '<pre>'; print_r($this->session->userdata); echo '</pre>'; 
?>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><i class="fa fa-users"></i> <span>555xch</span></a>
          </div>

          <div class="clearfix"></div>


          <br />
          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li class="current-page">
                  <a href="<?php echo base_url(); ?>dashboard"> Dashboard <!--<span class="fa fa-chevron-down"></span>--></a>

                </li>
                <?php if ($this->session->userdata['role'] == 'Super Admin') { ?>
                  <li>
                    <a> Admin<span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url(); ?>shift_master_admin">Shift</a></li>
                      <li><a href="<?php echo base_url(); ?>ledger">Ledger</a></li>
                      <li><a href="<?php echo base_url(); ?>admin">Master</a></li>
                      <!-- <li><a href="<?php echo base_url(); ?>admin_master">Master</a></li> -->
                      <li><a href="<?php echo base_url(); ?>agent_master">Agents</a></li>

                    </ul>
                  </li>
                  <li>
                    <a href="<?php echo base_url(); ?>coins/allocate"> Coin Management</a>
                    </li>
                <?php }
                if ($this->session->userdata['role'] == 'Master') {
                ?>
                  <li>
                    <a>Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url(); ?>shift_master">Shift</a></li>
                      <li><a href="<?php echo base_url(); ?>ledger">Ledgers</a></li>
                      
                      <li><a href="<?php echo base_url(); ?>staff_master">Staffs</a></li>
                      <li><a href="<?php echo base_url(); ?>agent_master">Agents</a></li>

                    </ul>
                  </li>
                  <li>
                    <a href="<?php echo base_url(); ?>coins/allocate"> Coin Management</a>
                    </li>
                <?php
                }
                ?>
                <li>
                  <a>Transactions <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <?php if($this->session->userdata['role']!='Super Admin'){
                      ?>
                    <li><a href="<?php echo base_url(); ?>transactions">Add Transactions</a></li>  
                      <?php
                    } ?>
                    
                    <li><a href="<?php echo base_url(); ?>view_transactions">View Transactions</a></li>
                    <li><a href="<?php echo base_url(); ?>view_jantri">View Jantri</a></li>
                  </ul>
                </li>
                <?php if($this->session->userdata['role']=='Super Admin' || $this->session->userdata['role']=='Master'){ 
                ?>

                <li>
                  <a href="<?php echo base_url(); ?>kist">Kist <!--<span class="fa fa-chevron-down"></span>--></a>

                </li>

                <li>
                  <a href="<?php echo base_url(); ?>cutjantri">Cutting Jantri <!--<span class="fa fa-chevron-down"></span>--></a>

                </li>
                <?php if($this->session->userdata['role']=='Master'){
                  ?>
                <li>
                              <a href="<?php echo base_url(); ?>partyjantri">Party Jantri <!--<span class="fa fa-chevron-down"></span>--></a>
                              
                          </li>  
                  <?php
                } ?>
                
                <li>
                  <a href="<?php echo base_url(); ?>voucher">Vouchers <!--<span class="fa fa-chevron-down"></span>--></a>

                </li>
                <?php //if ($this->session->userdata['role'] == 'Super Admin' || $this->session->userdata['role'] == 'Master') { 
                  if($this->session->userdata['id'] == '1'){
                    ?>
                  <li>
                    <a href="<?php echo base_url(); ?>openno_admin">Result</a>

                  </li>  
                    <?php
                  }
                  else {?>
                  <li>
                    <a href="<?php echo base_url(); ?>openno">Result</a>

                  </li>
                <?php } ?>
                <li>
                  <a>Reports<span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <!--<li><a href="<?php echo base_url(); ?>view_all_result">Open No Report</a></li>-->
                    <!--<li><a href="<?php echo base_url(); ?>user_hisab">User Hisab</a></li>
				<li><a href="<?php echo base_url(); ?>users_hisab">New User Hisab</a></li>-->
                    <?php if ($this->session->userdata['role'] == 'Super Admin') { ?>
                      <li><a href="<?php echo base_url(); ?>user_hisab_master">Master Hisab</a></li>
                    <?php } else {
                    ?>
                      <li><a href="<?php echo base_url(); ?>user_hisab_agent">Hisab</a></li>
                    <?php
                    }
                    ?>

                  </ul>

                </li>
                <?php //if($this->session->userdata['role']=='Super Admin'){ 
                ?>
                <li>
                  <a href="/updateopening">Update Opening</a>
                </li>
                <?php
                //}
                }
                ?>
              </ul>
            </div>

          </div>
          <!-- /sidebar menu -->


          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" data-placement="top" title="Settings">
              <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="FullScreen">
              <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Lock">
              <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="Logout" href="/logout">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">

        <div class="nav_menu">
          <div class="nav toggle" style="margin-top:-11px;">
            <a id="menu_toggle"><i class="fa fa-bars" style="font-size:18px;"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <!-- Coin Balance -->
                <?php if ($this->session->userdata('role') !== 'Super Admin'): ?>
                    <span class="coin-balance" style="margin-right: 10px; font-weight: bold; color: #007bff;">
                        Balance: <?= $this->session->userdata('coin_balance') ?> coins
                    </span>
                <?php endif; ?>
        <div style="float:right">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-users"></i> <?= $this->session->userdata['first_name'] ?>
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">

                  <a class="dropdown-item" href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                </div>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

      <!-- page content -->
      <div class="right_col" role="main">

        <?php if (isset($_view) && $_view)
          $this->load->view($_view);
        ?>

      </div>
    </div>
  </div>

  <!-- /top tiles -->


  <!-- footer content -->
  <footer >

    <div class="clearfix"></div>
  </footer>
  <!-- /footer content -->
  </div>
  </div>

  <!-- jQuery -->
  <script src="<?php echo base_url(); ?>/assets/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="<?php echo base_url(); ?>/assets/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <?php /* ?><!-- FastClick -->
    <script src="vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="vendors/Flot/jquery.flot.js"></script>
    <script src="vendors/Flot/jquery.flot.pie.js"></script>
    <script src="vendors/Flot/jquery.flot.time.js"></script>
    <script src="vendors/Flot/jquery.flot.stack.js"></script>
    <script src="vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script><?php */ ?>
  <!-- bootstrap-daterangepicker -->
  <script src="<?php echo base_url(); ?>/assets/js/moment.min.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?php echo base_url(); ?>/assets/js/bootstrap-datetimepicker.min.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="<?php echo base_url(); ?>/assets/js/custom.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script>
    function navigate(origin, sens) {
      var inputs = $("input");
      var index = inputs.index(origin);
      index += sens;
      if (index < 0) {
        index = inputs.length - 1;
      }
      if (index > inputs.length - 1) {
        index = 0;
      }
      inputs.eq(index).focus();
    }
    $("input").attr("autocomplete", "off");
    $('input').keydown(function(e) { //console.log(e.keyCode);
      if (e.keyCode == 38) {
        e.preventDefault();
        navigate(e.target, -1);
      }
      if (e.keyCode == 40) {
        e.preventDefault();
        navigate(e.target, 1);
      }
    });
    //var inputs = $(':input').keypress(function(e){  alert($(this).attr("name"));
    var inputs = $(document).on('keypress', 'input, select', function(e) { //alert($(this).attr("name"));
      if (e.which == 13) { //console.log($(this).parent().parent().next('tr').length); 
        if ($(this).attr("name") == 'trn_amount[]' && $(this).val() != '' && ($(this).parent().parent().next('tr').length == 0)) { //alert($(this).val())
          addnumamount(this);
        }
        e.preventDefault();
        /*var nextI = $("input").index(this)+1,
      next=$("input").eq(nextI);
next.focus();*/

        var self = $(this),
          form = self.parents('form:eq(0)'),
          focusable, next;
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this) + 1);
        if (next.length) {
          next.focus();
        }

        // }
      }
    });
    $(function() {
      $('.autoselected').select2({
        tags: true,
      });
      Date.prototype.addHours = function(h) {
        this.setHours(this.getHours() + h);
        return this;
      }
      /*var inputss = $("input[name='trn_amount[]']").keypress(function(event) {
   addnumamount(this);
});*/





      /*var inputs = $(':input').keypress(function (e) { //alert(e.which);
             if (e.which == 13) {
				  addnumamount(this);
                 e.preventDefault();
                 var nextInput = inputs.get(inputs.index(this) + 1);
                 //if (nextInput) {
                     nextInput.focus();
                // }
             }
         });*/
      var dateNow = new Date();
      $('.datetimepicker3').datetimepicker({
        format: 'LT',
        defaultDate: dateNow
      });
      var myDate = new Date();
      myDate.setHours(myDate.getHours() - 12);

      $('#birthday').datepicker().datepicker('setDate', new Date().addHours(-12));
      $('#birthday').datepicker().datepicker("option", "dateFormat", 'dd-mm-yy');
    });

    function findbTotal() {
      //var arr = document.getElementsByClassName('meddb')[0];
      var arr = document.querySelectorAll('.meddb');
      var tot = 0;
      for (var i = 0; i < arr.length; i++) { //alert(parseInt(arr[i].value))
        if (parseInt(arr[i].value))
          tot += parseInt(arr[i].value);
      }
      document.getElementById('total_b').value = tot;
      var utotal = $('input[name=total_all]').val();
      var atotal = $('input[name=total_a]').val();
      document.getElementById('gtotal').innerHTML = parseInt(tot) + parseInt(utotal) + parseInt(atotal);
    }

    function findaTotal() {
      //var arr = document.getElementsByClassName('medda')[0];
      var arrr = document.querySelectorAll('.medda');
      var tott = 0;
      for (var i = 0; i < arrr.length; i++) {
        if (parseInt(arrr[i].value))
          tott += parseInt(arrr[i].value);
      }
      document.getElementById('total_a').value = tott;
      var utotal = $('input[name=total_all]').val();
      var btotal = $('input[name=total_b]').val();
      document.getElementById('gtotal').innerHTML = parseInt(tott) + parseInt(utotal) + parseInt(btotal);
    }

    function addtrnjan(elem) { //alert(elem.tabIndex);
      if (elem.value != '') {
        document.getElementById('trn_number').innerHTML += '<input type="hidden" name="trn_number[]" value="' + elem.tabIndex + '" >';
      }
    }

    function findnTotal() {
      //var arr = document.getElementsByClassName('medda')[0];

      var utotal = $('input[name=total_all]').val();
      var atotal = $('input[name=total_a]').val();
      var btotal = $('input[name=total_b]').val();
      document.getElementById('gtotal').innerHTML = parseInt(atotal) + parseInt(utotal) + parseInt(btotal);
    }
  </script>
  <script>
    function checkSameDigits(N) {

      // Find the last digit
      var digit = N % 10;

      while (N != 0) {

        // Find the current last digit
        var current_digit = N % 10;

        // Update the value of N
        N = parseInt(N / 10);

        // If there exists any distinct
        // digit, then return No
        if (current_digit != digit) {
          return "0";
        }
      }

      // Otherwise, return Yes
      return "1";
    }
  </script>
  <script>
    $('.birthday').datepicker().datepicker('setDate', new Date());
    $('.birthday').datepicker().datepicker("option", "dateFormat", 'dd-mm-yy');
    //$('input[name="trn_number[]"]').unbind('keyup change input paste').bind('keyup change input paste',function(e){
    $(document).on('keyup change input paste', 'input[name="trn_number[]"]', function() {
      var $this = $(this);
      var val = $this.val();
      var valLength = val.length;
      var maxCount = '2';
      if (val == '100' || val == '1000') {
        maxCount = '3';
      }
      if (valLength >= 3 && valLength <= 5) {
        console.log(checkSameDigits(val))
        if (checkSameDigits(val) == '1') {
          maxCount = '4';
        }
      }
      if (valLength > maxCount) {
        //if(val != '1000'){ 
        $this.val($this.val().substring(0, maxCount));
        //}
      }
    });
  </script>
  <?php
  if (isset($_POST['fromdate']) && !empty($_POST['fromdate'])) {
  ?>
    <script>
      $('#fromdate').datepicker().datepicker('setDate', "<?= date('d-m-Y', strtotime($_POST['fromdate'])) ?>");
    </script>

  <?php
  }
  if (isset($_POST['todate']) && !empty($_POST['todate'])) {
  ?>
    <script>
      $('#todate').datepicker().datepicker('setDate', "<?= date('d-m-Y', strtotime($_POST['todate'])) ?>");
    </script>
  <?php
  }
  ?>
  <?php
  if (isset($tbl_kist['frdate']) && (!empty($tbl_kist['frdate']))) {
    //echo date('d-m-Y',strtotime($tbl_kist['frdate'])); 
  ?>
    <script>
      $('#datepicker_start').datepicker().datepicker('setDate', "<?php echo date('d-m-Y', strtotime($tbl_kist['frdate'])); ?>");
      $('#datepicker_ends').datepicker().datepicker('setDate', "<?php echo date('d-m-Y', strtotime($tbl_kist['todate'])); ?>");
    </script>
  <?php }
  if ($this->session->userdata['role'] == 'Super Admin' || $this->session->userdata['role'] == 'Master') {
  ?>
    <script>
      $(function() {
        Date.prototype.addHours = function(h) {
          this.setHours(this.getHours() + h);
          return this;
        }
        //$( ".datepicker" ).datepicker({ minDate: 0});
        $('#birthday').datepicker({
          // numberOfMonths: 2,
          // showButtonPanel: true,
          minDate: new Date().addHours(-12) // minDate: '0' would work too
        });
        //$('.autosel').select2({
        //tags: true,
      //});
      });
      // Function to compare only the dates from two timestamps
function compareDatesOnly(timestamp1, timestamp2) {
    // Convert timestamps to Date objects
    var date1 = new Date(timestamp1);
    var date2 = new Date(timestamp2);

    // Get the year, month, and day components of the dates
    var year1 = date1.getFullYear();
    var month1 = date1.getMonth();
    var day1 = date1.getDate();

    var year2 = date2.getFullYear();
    var month2 = date2.getMonth();
    var day2 = date2.getDate();

    // Compare the year, month, and day components
    if (year1 === year2 && month1 === month2 && day1 === day2) {
        return 0; // Dates are equal
    } else if (year1 > year2 || (year1 === year2 && month1 > month2) || (year1 === year2 && month1 === month2 && day1 > day2)) {
        return 1; // Date1 is later than Date2
    } else {
        return -1; // Date1 is earlier than Date2
    }
}
      function parseDate(dateString) {
    var parts = dateString.split('-');
    // Create a new Date object with year, month (zero-based), and day
    return new Date(parts[2], parts[1] - 1, parts[0]);
}
      $(document).ready(function() {
         // Get the URLSearchParams object
// var urlParams = new URLSearchParams(window.location.search);

// // Get the value of the 'parameter' parameter from the URL
// var parameterValue = urlParams.get('date');

// // Use the parameter value in JavaScript
// //console.log('Parameter value:', parameterValue);

// // Convert selected date to JavaScript Date object
// if(parameterValue != null){
//   var selectedDate = new Date(parseDate(parameterValue));
// }
// else{
//   var selectedDate = new Date();
// }

//             // Get current date
//             var currentDate = new Date().getTime();
//             // Subtract 12 hours from current date
//             // Subtract 12 hours (12 * 60 * 60 * 1000 milliseconds)
//             var twelveHoursAgoTimestamp = currentDate - (12 * 60 * 60 * 1000);

//             // Create a new Date object with the resulting timestamp
//             var twelveHoursAgoDate = new Date(twelveHoursAgoTimestamp);
//             // Compare selected date with current date - 12 hours
//             var comparisonResult = compareDatesOnly(selectedDate.getTime(), twelveHoursAgoTimestamp);
//             // console.log(selectedDate);
//             // console.log(twelveHoursAgoDate);
//             // console.log(comparisonResult);
//             if (comparisonResult == '0') {
//                 // Enable the button if selected date is within the specified range
//                 $("#btnFetch").prop("disabled", false);
//             } else {
//                 // Disable the button if selected date is outside the specified range
//                 $("#btnFetch").prop("disabled", true);
//             }

// $('.birthdaymaster').datepicker({
//           // numberOfMonths: 2,
//           // showButtonPanel: true,
//         //  minDate: new Date().addHours(-12), // minDate: '0' would work too
//         onSelect: function(dateText) {
         
//             // Convert selected date to JavaScript Date object
//             var selectedDate = new Date(parseDate(dateText));
//             // Get current date
//             var currentDate = new Date().getTime();
//             // Subtract 12 hours from current date
//             // Subtract 12 hours (12 * 60 * 60 * 1000 milliseconds)
//             var twelveHoursAgoTimestamp = currentDate - (12 * 60 * 60 * 1000);

//             // Create a new Date object with the resulting timestamp
//             var twelveHoursAgoDate = new Date(twelveHoursAgoTimestamp);
//             // Compare selected date with current date - 12 hours
//             var comparisonResult = compareDatesOnly(selectedDate.getTime(), twelveHoursAgoTimestamp);
//             // console.log(selectedDate);
//             // console.log(twelveHoursAgoDate);
//             // console.log(comparisonResult);
//             if (comparisonResult == '0') {
//                 // Enable the button if selected date is within the specified range
//                 $("#btnFetch").prop("disabled", false);
//             } else {
//                 // Disable the button if selected date is outside the specified range
//                 $("#btnFetch").prop("disabled", true);
//             }
//         }
//         });
       
          $('.birthdaymaster').datepicker().datepicker('setDate', new Date());
        //}
        
    $('.birthdaymaster').datepicker().datepicker("option", "dateFormat", 'dd-mm-yy');
    });
    </script>
  <?php
  }
  ?>
  <?php /*if(isset($tbl_transactions[0]['t_date'])&&(!empty(($tbl_transactions[0]['t_date'])))){
?>
<script>
 $('#edittrndate').datepicker().datepicker('setDate', "<?php echo date('d-m-Y',strtotime($tbl_transactions[0]['t_date'])); ?>").attr('readonly','readonly');;	
 </script>
<?php	 	 
 } */ ?>
</body>

</html>