<?php
$servername = "localhost";
$username = "root";
$password = "";
$databaseName = "amuletdb";

$conn = mysqli_connect($servername, $username, $password, $databaseName);
mysqli_query($conn, "SET CHARACTER SET 'utf8'");
mysqli_query($conn, "SET SESSION collation_connection = 'utf8_unicode_ci'");

if($conn->connect_error){
    die("Connect Error : ".$conn->connect_error);
}else{
    // echo "connect database success!!!";
}

?>
