<?php
session_start();
$servername = null;//"localhost";
$username = "root";
$password = "";
$dbname = "auction_system";
$port = null;
$socket = "/cloudsql/test-data-temp-003:test-cloud-data-0034";
$conn = new mysqli($servername,$username,$password,$dbname,$port,$socket) or die("Connection Failed");
//$conn = new mysqli($servername,$username,$password,$dbname) or die("Connection Failed");
//Checking Connection
if($conn->connect_error){
	die("Connection Failed :" .$conn->connect_error);
}

?>
