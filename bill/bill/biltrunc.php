<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}//& password='$pass'
$sql = "DELETE FROM bil_temp";

if ($conn->query($sql) === TRUE) {
	include'bmid.html';
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
