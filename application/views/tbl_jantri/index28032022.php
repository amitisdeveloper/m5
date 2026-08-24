<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
$(function(){
	 
     $('.med').on('change', function(){

     	  var colIndex = $(this).parent().prevAll().length;
   		  var rowIndex = $(this).closest('tr').prevAll().length;

          var columns = $(this).closest('tr').children('td');
          var colMax = columns.length - 1;
          var rowTotal = 0;

          for (var col = 1; col < colMax; col++) {
              var colData = columns.eq(col).find('input').val();
              if (colData === undefined) {
              	rowTotal += 0;
              } else {
                rowTotal += (1 * colData);
              }
          }


          var rows = $(this).closest('tbody').children('tr');
          var rowMax = rows.length - 1;
          var colTotal = 0;

          for (var row = 0; row < rowMax; row++) {
              var rowData = rows.eq(row).children('td').eq(colIndex).find('input').val();
              if (rowData === undefined) {
                    colTotal += 0;
              } else {
                    colTotal += (1 * rowData);
              }
          }
          $('input[name=total_p' + rowIndex + ']').val(rowTotal);
          $('input[name=total_h' + (colIndex-1) + ']').val(colTotal);

          var totalHead = 0;
          var totalP = 0;
          $('input[name^=total_h]').each(function(){
                var data = isNaN($(this).val())?0:($(this).val() *1);
                totalHead += data;
          });

          $('input[name^=total_p]').each(function(){
                var data = isNaN($(this).val())?0:($(this).val() *1);
                totalP += data;
          });

          var totalall = totalHead + totalP;
          $('input[name=total_all]').val(totalHead);
          console.log('total heading = ' + totalHead);
          console.log('total P = ' + totalP);
          console.log('total all = ' + totalall);
     });
});
function submitjantri(){
	let params = (new URL(document.location)).searchParams;
let shift = params.get("shift");
    let tdate = params.get("tdate");
    let party = params.get("party");
    let tamnt = document.getElementById('gtotal').innerHTML;
	var arrr = {};
	var inputs = document.getElementsByTagName('input');
for (var i = 0; i < inputs.length; i += 1) {
    //inputs[i].value = '';
	if(((inputs[i].value)!="") && ((inputs[i].value)!="0")){
	dindex = inputs[i].getAttribute('name');
			 elemval = inputs[i].value;
			arrr[dindex] = elemval;
		
	}
}
//console.log(JSON.stringify(arrr)); return;
			var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		
     console.log("Jantri Recorded!!")
    }
  };
  xhttp.open("POST", "add_jantri", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("dindex="+JSON.stringify(arrr)+"&shift="+shift+"&party="+party+"&tdate="+tdate+"&tamnt="+parseInt(tamnt));
}
</script>
<style>
table {
    table-layout: fixed;
    width: 100%;   
}
th,td {
    border-style: solid;
    border-width: 5px;
    border-color: #BCBCBC;
    word-wrap: break-word;
}
button, input {
    overflow: visible;
    width: 100%;
}
.thead td{
	color:#fff
}
/* DivTable.com */
.divTable{
	display: table;
	width: 100%;
}
.divTableRow {
	display: table-row;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
}
.divTableCell, .divTableHead {
	border: 1px solid #999999;
	display: table-cell;
	padding: 3px 10px;
}
.divTableHeading {
	background-color: #EEE;
	display: table-header-group;
	font-weight: bold;
}
.divTableFoot {
	background-color: #EEE;
	display: table-footer-group;
	font-weight: bold;
}
.divTableBody {
	display: table-row-group;
}
  #loadingmsg {
      color: black;
      background: #fff; 
      padding: 10px;
      position: fixed;
      top: 50%;
      left: 50%;
      z-index: 100;
      margin-right: -25%;
      margin-bottom: -25%;
      }
      #loadingover {
      background: black;
      z-index: 99;
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
      filter: alpha(opacity=80);
      -moz-opacity: 0.8;
      -khtml-opacity: 0.8;
      opacity: 0.8;
    }
</style>
<div id='loadingmsg' style='display: none;'>Saving, please wait...</div>
<div id='loadingover' style='display: none;'></div>
<form>
<table class="table table-bordered table-hover">
    <thead>
        <tr class="thead" style="background:#0B6FA4; ">
            <td>Sr. No.</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
			<td>6</td>
            <td>7</td>
            <td>8</td>
            <td>9</td>
            <td>10</td>
			<td>Total</td>
        </tr>
    </thead>
    <tbody>
	<?php for($i=0;$i<10;$i++){ ?>
	<tr><td><?=$i+1?></td>
	<?php for($j=0;$j<10;$j++){ ?>
        
            
            <td>
                <input type="text" name="sr_<?=(($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1))?>" id="<?=$i.$j?>" tabindex="<?=(($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1))?>" placeholder="<?=(($j+1)%10==0)?(($j+1)*($i+1)):($i.($j+1))?>" class="med" onkeyup="findnTotal()">
            </td>
           
            
        
	<?php }?>
	<td>
                <!--<div class="total_p<?=$i?>">-->
                    <input type="text" tabindex="total_p<?=$i?>" name="total_p<?=$i?>" value="0" readonly>
                <!--</div>-->
            </td>
	</tr>
	<?php }?>
        <tr>
		 <td>Total</td>
		<?php for($x=0;$x<10;$x++){ ?>
           
            <td>
                <input type="text" name="total_h<?=$x?>" value="0" readonly>
            </td>
           
		<?php }?>
        

            <td>
                <input type="text" name="total_all" value="0" placeholder="All Total">
            </td>
		</tr>
	
	
    </tbody>
</table>
<table class="table table-bordered table-hover">
<tbody>
<tr><td>B</td>
<?php for($ii=1;$ii<11;$ii++){ ?>
<td><input type="text" name="b[<?=$ii?>]" onkeyup="findbTotal()" id="<?=$ii?>" placeholder="b<?=$ii?>" class="meddb" ></td>
<?php }?>
<td><input type="text" id="total_b" name="total_b" value="0"></td>
</tr>
<tr><td>A</td>
<?php for($ii=1;$ii<11;$ii++){ ?>
<td><input type="text" name="a[<?=$ii?>]" onkeyup="findaTotal()" id="<?=$ii?>" placeholder="a<?=$ii?>" class="medda"></td>
<?php }?>
<td>
<input type="text" id="total_a" name="total_a" value="0"></td>
</tr>
<tr>
<td colspan="10">Grand Total : <span id="gtotal"></span>&nbsp;</td>
<td colspan="2"><button type="button" onclick="submitjantri()" class="btn btn-success" style="padding: .375rem 2.75rem;">Submit</button></td>
</tr>
</tbody>
</table>
</form>
<!-- DivTable.com -->
<!-- DivTable.com 
<script>
var arr = [];
document.addEventListener('click', function(e) {
    e = e || window.event;
    var target = e.target || e.srcElement,
        text = target.textContent || target.innerText;   
		//console.log(target.previousElementSibling);
		//var elem = target.nextElementSibling;
		console.log(target.type);
		
			//console.log(elem.value);
			
var inputs = document.getElementsByTagName('input');
for (var i = 0; i < inputs.length; i += 1) {
    //inputs[i].value = '';
	if(((inputs[i].value)!="") && ((inputs[i].value)!="0")){
	dindex = inputs[i].getAttribute('name');
			 elemval = inputs[i].value;
			arr[dindex] = elemval;
	}
}
console.log(arr); return;
			var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
		
     console.log("Entry Recorded!!")
    }
  };
  xhttp.open("POST", "add_jantri", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("dindex="+JSON.stringify(arr));		
}, false); </script>-->