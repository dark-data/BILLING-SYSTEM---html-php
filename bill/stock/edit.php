<?php
include'midviewstock.html';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$search =  $_POST["parm"];
  $prod = $_POST["dnam"];
  $new = $_POST["new"];
}


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}




$sql = "update product_details set $search = '$new' where product_name='$prod'";

if (mysqli_query($conn, $sql)) {
    echo'.';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>
