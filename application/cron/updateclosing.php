<?php
include 'conn.php';
$mysqli = OpenCon();
$offsql = "SELECT offset FROM `cron_offset`";



$resultoff = $mysqli -> query($offsql);

while($offrow = $resultoff->fetch_assoc()) {
    //echo '<pre>'; print_r($offrow); echo '</pre>';
  $offset = $offrow['offset'];
  }
$sql = "SELECT * FROM `tbl_opening` WHERE `dated` = '2023-02-11' LIMIT ".$offset." , 10";
$result = $mysqli -> query($sql);
// Associative array
while($row = $result->fetch_assoc())
{
   echo '<pre>'; print_r($row); echo '</pre>';
}

// Free result set
$result -> free_result();

CloseCon($conn);


?>