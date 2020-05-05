<?php
include'mid.html';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $prod = $_POST["parm"];
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




$sql = "update admin set $prod = '$new' where 1";

if (mysqli_query($conn, $sql)) {
    echo'.';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>
