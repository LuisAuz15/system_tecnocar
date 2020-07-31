<?php 	

$localhost = "192.168.1.50";
$username = "root";
$password = "@Admin123";
$dbname = "stock";

// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>