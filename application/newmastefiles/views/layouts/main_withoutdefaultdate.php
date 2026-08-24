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
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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
                          <li>
                              <a>Master <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
                                  <li><a href="<?php echo base_url(); ?>shift_master">Shift</a></li>
                                  <li><a href="<?php echo base_url(); ?>ledger_master">Ledgers</a></li>
                                  <li><a href="<?php echo base_url(); ?>staff_master">Staffs</a></li>
                                  <li><a href="<?php echo base_url(); ?>agent_master">Agents</a></li>

                              </ul>
                          </li>
						  <li>
                              <a>Transactions <span class="fa fa-chevron-down"></span></a>
                              <ul class="nav child_menu">
							  <li><a href="<?php echo base_url(); ?>transactions">Add Transactions</a></li>
                                  <li><a href="<?php echo base_url(); ?>view_transactions">View Transactions</a></li>
								  </ul>
                          </li>
                         
                          <li>
                              <a href="<?php echo base_url(); ?>voucher">Vouchers <!--<span class="fa fa-chevron-down"></span>--></a>
                              
                          </li>
                          <li>
                              <a href="<?php echo base_url(); ?>openno">Result</a>
                              
                          </li>
                          <li>
                              <a>Reports<!--<span class="fa fa-chevron-down"></span>--></a>
                              
                          </li>
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
                  <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                    <i class="fa fa-users"></i> Admin
                  </a>
                  <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                    
                    <a class="dropdown-item" href="<?php echo base_url(); ?>logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                  </div>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
	
	<?php	if(isset($_view) && $_view)
	    $this->load->view($_view);
	?>
	
	</div>
         </div>
       </div>
            
          <!-- /top tiles -->
     

        <!-- footer content -->
        <footer>
         
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

   
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
    if (e.keyCode==38) {
		 e.preventDefault();
        navigate(e.target, -1);
    }
    if (e.keyCode==40) {
		 e.preventDefault(); 
        navigate(e.target, 1);
    }
});
	//var inputs = $(':input').keypress(function(e){  alert($(this).attr("name"));
var inputs = $(document).on('keypress','input, select',function(e){  //alert($(this).attr("name"));
    if (e.which == 13) {
		if($(this).attr("name") == 'trn_amount[]' && $(this).val() !='' ){ //alert($(this).val())
			addnumamount(this);
		}
       e.preventDefault();
       /*var nextI = $("input").index(this)+1,
      next=$("input").eq(nextI);
next.focus();*/

 var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
        focusable = form.find('input,a,select,button,textarea').filter(':visible');
        next = focusable.eq(focusable.index(this)+1);
        if (next.length) {
            next.focus();
        } 

      // }
    }
});
 $(function () {
	 Date.prototype.addHours= function(h){
    this.setHours(this.getHours()+h);
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
				 defaultDate:dateNow
             });
			
			 
			
         });
		 function findbTotal(){
    //var arr = document.getElementsByClassName('meddb')[0];
	var arr = document.querySelectorAll('.meddb');
    var tot=0;
    for(var i=0;i<arr.length;i++){ //alert(parseInt(arr[i].value))
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('total_b').value = tot;
	var utotal = $('input[name=total_all]').val();
	document.getElementById('gtotal').innerHTML =parseInt(tot)+parseInt(utotal);
}
	function findaTotal(){
    //var arr = document.getElementsByClassName('medda')[0];
	var arrr = document.querySelectorAll('.medda');
    var tott=0;
    for(var i=0;i<arrr.length;i++){ 
        if(parseInt(arrr[i].value))
            tott += parseInt(arrr[i].value);
    }
    document.getElementById('total_a').value = tott;
	var utotal = $('input[name=total_all]').val();
	document.getElementById('gtotal').innerHTML =parseInt(tott)+parseInt(utotal);
}
</script>
  </body>
</html>
