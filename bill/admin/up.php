<?php
 define ("filesplace","./profile");

 if (is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {

 if (($_FILES['fileToUpload']['type'] == "image/png")||($_FILES['fileToUpload']['type'] == "image/jpeg")) {
 $name = "admin";
 $result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], filesplace."/$name.png");
 if ($result == 1)
	 echo file_get_contents("option.html");
 else echo "<p>Sorry, Error happened while uploading . </p>";
}
 
 }
 else{
 echo "<p>article must be uploaded in PDF format.</p>"; #endIF
 } #endIF
 
?>