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
<?php
$master_id = $this->session->userdata('id');
$master_balance = get_master_coin_balance($master_id);
?>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      

      <!-- top navigation -->
      <div class="top_nav">
      
        <div class="nav_menu">
        <div class="navbar nav_title" style="border: 0; width:150px;">
            <a href="index.html" class="site_title text-3d"><i class="fa fa-users"></i> <span>555xch</span></a>
          </div>  
        <!-- <div class="nav toggle" style="margin-top:-11px;">
            <a id="menu_toggle"><i class="fa fa-bars" style="font-size:18px;"></i></a>
          </div> -->
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <!-- Coin Balance -->
                <?php if ($this->session->userdata('role') !== 'Super Admin'): ?>
                    <span class="coin-balance" style="margin-right: 10px; font-weight: bold; color: #007bff;">
                        Balance: <?= $master_balance ?> coins
                    </span>
                <?php endif; ?>
        <div style="float:right">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
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
      <nav class="navbar navbar-expand-lg navbar-light">
        <!-- Toggle Button -->
    <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button> -->
    <div class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav justify-content-center">
            <li class="menu-item">
                <a class="nav-link" href="<?php echo base_url(); ?>dashboard">Dashboard</a>
            </li>
            <li class="menu-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="featuresDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Master
                </a>
                <div class="dropdown-menu" aria-labelledby="featuresDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>shift_master">Shift</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>ledger">Ledgers</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>staff_master">Staff</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>agent_master">Agents</a>
                </div>
            </li>
            <li class="menu-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="componentsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Transactions
                </a>
                <div class="dropdown-menu" aria-labelledby="componentsDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>transactions">Add Transaction</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>view_transactions">View Transactions</a>
                </div>
            </li>
            <!-- <li class="menu-item">
                <a class="nav-link" href="#">Forms</a>
            </li>
            <li class="menu-item">
                <a class="nav-link" href="#">Tables</a>
            </li> -->
            <li class="menu-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="chartsDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Jantri
                </a>
                <div class="dropdown-menu" aria-labelledby="chartsDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>cutjantri">Cutting Jantri</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>partyjantri">Party Jantri</a>
                </div>
            </li>
            <!-- <li class="menu-item">
                <a class="nav-link" href="#">Maps</a>
            </li> -->
            <li class="menu-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Results
                </a>
                <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                    <a class="dropdown-item" href="<?php echo base_url(); ?>openno">Result</a>
                    <a class="dropdown-item" href="<?php echo base_url(); ?>updateopening">Update Opening</a>
                </div>
            </li>
            <li class="menu-item">
                <a class="nav-link" href="<?php echo base_url(); ?>voucher">Voucher</a>
            </li>
            <li class="menu-item">
                <a class="nav-link" href="<?php echo base_url(); ?>master_commission">Master Commission</a>
            </li>
            <li class="menu-item">
                <a class="nav-link" href="<?php echo base_url(); ?>user_hisab_agent">Hisab</a>
            </li>
            <!-- <li class="menu-item">
                <a class="nav-link" href="#">Statement</a>
            </li> -->
        </ul>
    </div>
</nav>
      <div class="right_col"  role="main" style="padding-top:0px">
      <div id="main_wrap">
<style>
  body {
  font-size: 13px !important;
}
  .navbar-nav {
  display: flex;
  /* flex-direction: row; */
  flex-wrap: nowrap;         /* stay on one line */
  justify-content: space-between;
  /* width: 100%; */
}

.menu-item {
  flex: 1 1 auto;             /* allow items to shrink evenly */
  text-align: center;         /* center text in each item */
}

.navbar-nav .nav-link {
  font-size: 12px;            /* smaller text for mobile */
  padding: 6px 4px;           /* tighter spacing */
  white-space: nowrap;        /* keep text in one line */
  overflow: hidden;
  text-overflow: ellipsis;    /* add ... if it’s too long */
}

@media (min-width: 769px) {
  .navbar-nav .nav-link {
    font-size: 13px;
    padding: 10px 12px;
  }
}




 .dropdown-menu .dropdown-item {
  border-bottom: 1px solid #dee2e6;
  transition: all 0.2s ease;
}

.dropdown-menu .dropdown-item:last-child {
  border-bottom: none;
}

.dropdown-menu .dropdown-item:hover {
  background-color: #2A3F54; /* Light gray bg on hover */
  font-weight: 500; /* Slightly bold */
  color: #000; /* Ensure text stays readable */
}
  .main_container .top_nav{
    margin-left: 0px !important;
  }
  .right_col{
    margin-left: 0px !important;
  }
  .mt-5, .my-5 {
    margin-top: 1rem !important;
}
.nav_menu{
  margin-bottom: 0px !important;
}
        .navbar-nav .menu-item {
            position: relative;
        }
        .navbar-nav .menu-item .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            margin-top: 0px;
        }
        .navbar-nav .menu-item:hover .dropdown-menu {
            display: block;
            transition: opacity 0.2s ease;
        }
        .dropdown-item:focus, .dropdown-item:hover, .navbar-nav .open .dropdown-menu {
            background-color: #2A3F54;
            color: white !important;
        }
        .nav_title{
          background-color: #2A3F54 !important;
        }
        .navbar {
            background-color: #2A3F54;
            justify-content: center;
            width: 100%;
            padding: 0;
        }
        .nav-link {
            /* color: white !important; */
            border-left: 2px solid white;
            border-top: none;
            border-bottom: none;
            border-right: none;
            padding: 0.5rem 1rem;
            margin: 0 0;
        }
        .navbar-nav .menu-item:first-child .nav-link {
            border-left: none;
        }
        .dropdown-menu {
            background-color: #2A3F54;
        }
        .dropdown-item {
            color: white !important;
        }
        .text-3d {
  color: white;
  font-weight: bold;
  text-shadow:
    1px 1px 0 #000,
    2px 2px 0 #333,
    3px 3px 0 #666;
}
#main_wrap{
  /* max-width: 1200px;
    margin: 0px auto;
    padding: 30px;
    padding-top: 0px;
    padding-bottom: 0px;
    background-color: #fff;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); */
}

@media (max-width: 768px) {
  /* Remove outer spacing on mobile */
  .navbar {
    padding: 0;
    margin: 0;
  }

  .navbar-nav {
    display: flex;
    flex-direction: row;
    flex-wrap: nowrap;
    justify-content: space-between;
    /* width: 100%; */
    padding: 0;
    margin: 0;
  }

  .menu-item {
    flex: 1 1 0;
    text-align: center;
  }

  .navbar-nav .nav-link {
    font-size: 11px; /* smaller font for mobile */
    padding: 6px 3px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    display: block;
  }

  .dropdown-menu {
    position: static;
    float: none;
    background-color: #2A3F54;
    width: 100%;
  }

  .dropdown-item {
    color: white !important;
    padding-left: 1.5rem;
  }
}

    </style>
        <?php if (isset($_view) && $_view)
          $this->load->view($_view);
        ?>

      </div>
      </div>
    </div>
  </div>

  <!-- /top tiles -->


  <!-- footer content -->
  <!-- <footer >

    <div class="clearfix"></div>
  </footer> -->
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
  <script>
// Disable autocomplete for all inputs on page load
document.addEventListener('DOMContentLoaded', function () {
    disableAutocomplete(document);

    // Also watch for dynamically added inputs
    const observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            mutation.addedNodes.forEach(function (node) {
                if (node.nodeType === 1) { // element
                    if (node.matches('input, textarea')) {
                        node.setAttribute('autocomplete', 'off');
                    }
                    // Also handle inputs inside newly added containers
                    node.querySelectorAll && node.querySelectorAll('input, textarea').forEach(function (input) {
                        input.setAttribute('autocomplete', 'off');
                    });
                }
            });
        });
    });

    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
});

function disableAutocomplete(root) {
    root.querySelectorAll('input, textarea').forEach(function (el) {
        el.setAttribute('autocomplete', 'off');
    });
}
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