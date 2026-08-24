<div style="overflow-x:scroll;width:100%">
<style>
div.paleBlueRows {
  font-family: "Times New Roman", Times, serif;
  border: 1px solid #FFFFFF;
  width: 100%;
  height: 200px;
  text-align: center;
  border-collapse: collapse;
}
.divTable.paleBlueRows .divTableCell, .divTable.paleBlueRows .divTableHead {
  border: 1px solid #FFFFFF;
color:#fff;
  padding: 2px 2px;
}
.divTable.paleBlueRows .divTableBody .divTableCell {
  font-size: 13px;
}
.divTable.paleBlueRows .divTableRow:nth-child(even) {
  background: #D0E4F5;
}
.divTable.paleBlueRows .divTableHeading {
  background: #0B6FA4;
  border-bottom: 5px solid #FFFFFF;
}
.divTable.paleBlueRows .divTableHeading .divTableHead {
  font-size: 17px;
  font-weight: bold;
  color: #FFFFFF;
  text-align: center;
  border-left: 2px solid #FFFFFF;
}
.divTable.paleBlueRows .divTableHeading .divTableHead:first-child {
  border-left: none;
}

.paleBlueRows .tableFootStyle {
  font-size: 14px;
  font-weight: bold;
  color: #333333;
  background: #0B6FA4;
  border-top: 3px solid #444444;
}
.paleBlueRows .tableFootStyle {
  font-size: 14px;
}
/* DivTable.com */
.divTable{ display: table; }
.divTableRow { display: table-row; }
.divTableHeading { display: table-header-group;}
.divTableCell, .divTableHead { display: table-cell;}
.divTableHeading { display: table-header-group;}
.divTableFoot { display: table-footer-group;}
.divTableBody { display: table-row-group;}
input[type="text"] {
    width: 100%;
}
::placeholder {
  color: black;
  opacity: 1; /* Firefox */
background-color: orange;
width:20%
}
</style>
<div class="divTable paleBlueRows">
<div class="divTableHeading">
<div class="divTableRow">
<div class="divTableHead">1</div>
<div class="divTableHead">2</div>
<div class="divTableHead">3</div>
<div class="divTableHead">4</div>
<div class="divTableHead">5</div>
<div class="divTableHead">6</div>
<div class="divTableHead">7</div>
<div class="divTableHead">8</div>
<div class="divTableHead">9</div>
<div class="divTableHead">10</div>
<div class="divTableHead">Total</div>
</div>
</div>
<div class="divTableBody">
<?php 
$x=1;
for($i=0;$i<=9;$i++){
	?>
<div class="divTableRow">
<?php for ($j=0;$j<=9;$j++){
	?>
<div class="divTableCell"><input type="text" name="inptval[]" placeholder="<?=$x?>" value=""><input type="hidden" name="rowval[]" value="<?=$i.'_'.$j?>"> </div>	
	<?php
	if(($j+1)%10==0){
		?>
	<div class="divTableCell"><input type="text" name="inptval[]" placeholder="0" value=""><input type="hidden" name="rowval[]" value="<?=$i.'_'.$j?>"> </div>		
		<?php
	}
	$x++;
} ?>
</div>	
	<?php
} ?>
</div>
<div class="divTableFoot tableFootStyle">
<div class="divTableRow">
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
<div class="divTableCell">0</div>
</div>
</div>
</div>
</div>
