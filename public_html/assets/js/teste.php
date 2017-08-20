<?php
$host = "database";
$user = "root";
$password = "password";
$database = "olx_challenge";
$port = "3306";

$mysqli = new mysqli($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

//$sql = "SELECT * FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA LIKE '$database';";
$sql = "show tables;";
$rs = $mysqli->query($sql);
$result = mysqli_fetch_assoc($rs);
echo "<pre>";
print_r($result);

