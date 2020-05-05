<?php
if(isset($_POST['submit'])){
// As output of $_POST['Color'] is an array we have to use foreach Loop to display individual value
$staff=$_POST['val'];
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
}//& password='$pass'
$result = mysqli_query($conn,"SELECT * FROM staff_acc where username='".$staff."'");
 while($row = mysqli_fetch_array($result))
   {
$profile="C:\wamp\www\bill\staff".$row['profile'];
unlink($profile);
   }
   
$sql = "DELETE FROM staff_acc WHERE username='".$staff."'";

if ($conn->query($sql) === TRUE) {
    echo "account named  '".$staff."'  deleted successfully";
	include'delete_staff.html';
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>