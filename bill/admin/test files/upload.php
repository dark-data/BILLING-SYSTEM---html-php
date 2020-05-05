<?php
define ("filesplace","./profile");
$target_dir = "profile/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
		$name ="admin";
		$result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], filesplace."/$name.png");
		if ($result == 1)
		echo "option.html";
		else{ 
		echo"<script type='text/javascript'>alert('error in uploading');</script>";
		 echo "option.html";}
    } else {
         echo "option.html";
		echo "<script type='text/javascript'>alert('file is not an image');</script>";
        $uploadOk = 0;
    }

?>
