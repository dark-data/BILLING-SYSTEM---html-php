<?php
 define ("filesplace","./profile");

 if (is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {

 if (($_FILES['fileToUpload']['type'] == "image/png")||($_FILES['fileToUpload']['type'] == "image/jpeg")) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = $_POST["sname"];
  $address = $_POST["addr"];
  $mobile = $_POST["mob"];
  $user = $_POST["uname"];
  $pass = $_POST["psw"];
}
 $result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], filesplace."/$user.png");
 if ($result == 1)
	 echo "file uploaded";
 else echo "<p>Sorry, Error happened while uploading . </p>";
}
 
 }
 else{
 echo "<p>article must be uploaded in PDF format.</p>"; #endIF
 } #endIF
 


$imgloc="./profile/$user.png";
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
$sql = "INSERT INTO staff_acc (username, password, name, address, phone, profile) 
VALUES ('$user', '$pass','$fname','$address','$mobile','$imgloc')";

if (mysqli_query($conn, $sql)) {
    include"addstaff.html";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>