<?php
include'update.html';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$stock =  $_POST["stk"];
	$prod = $_POST["dnam"];
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




$sql = "update product_details set quantity = quantity+'$stock' where product_name='$prod'";

if (mysqli_query($conn, $sql)) {
    echo'.';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>