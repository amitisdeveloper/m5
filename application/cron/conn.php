<?php
function OpenCon()
 {
 $dbhost = "localhost";
 $dbuser = "wwwdotgoogleduo_555";
 $dbpass = "Amit@123!@#";
 $db = "wwwdotgoogleduo_555";
 $conn = new mysqli($dbhost, $dbuser, $dbpass,$db) or die("Connect failed: %s\n". $conn -> error);
 
 return $conn;
 }
 
function CloseCon($conn)
 {
 $conn -> close();
 }
   
?>