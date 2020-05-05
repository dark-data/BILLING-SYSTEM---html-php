<?php
 define ("filesplace","./profile");

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $staffname = $_POST["fname"];
  $address = $_POST["addr"];
  $mobile = $_POST["pnum"];
  $uname = $_POST["uname"];
  $pass = $_POST["psw"];
  
}
 

 

$imgloc="./prof/$uname.png";
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
VALUES ('$uname', '$pass','$staffname','$address','$mobile','$imgloc')";

if (mysqli_query($conn, $sql)) {
	
	
	
	
	
	   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 11097152){
         $errors[]='File size must be less than 10 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,filesplace."/$file_name.png");
         echo "Success";
      }else{
         print_r($errors);
      }
   }
	
	
	
	echo "New record created successfully";

	
	
	
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>