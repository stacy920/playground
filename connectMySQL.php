<?php
$servername = "localhost";
$username = "root";
$password = "123456";
$dbname = "playground";

$db = new mysqli($servername, $username, $password, $dbname);
$db->set_charset("UTF8");

if($db->connect_error){
  die("Connection Failed:" . $db->connect_error);
}
?>
