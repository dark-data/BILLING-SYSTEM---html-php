<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["uname"];
}
 define ("filesplace","./profile");

 if (is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {

 if (($_FILES['fileToUpload']['type'] == "image/png")||($_FILES['fileToUpload']['type'] == "image/jpeg")) {
 
 $result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], filesplace."/$name.png");
 if ($result == 1){
	 echo file_get_contents("testaddstaff.html");
	 
 }
 else{
	echo "<p>Sorry, Error happened while uploading . </p>";
	echo file_get_contents("testaddstaff.html");
 }
}
 
 }
 else{
 echo "<p>article must be uploaded in PDF format.</p>"; #endIF
 } #endIF
 
?>