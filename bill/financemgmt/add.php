<?php
 define ("filesplace","../financemgmt/profile");

 if (is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {

 if (($_FILES['fileToUpload']['type'] == "image/png")||($_FILES['fileToUpload']['type'] == "image/jpeg")) {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  date_default_timezone_set("Asia/Calcutta"); $datew="hour minute : ";
  $hourMin = date('h:i');
  $dte=date('d-m-Y');
  $bil=date('d-m-Y_h-i');
  $dname = $_POST["dname"];
  $comp = $_POST["company"];
  $address = $_POST["addr"];
  $mobile = $_POST["mob"];
  $additional = $_POST["adinfo"];
  $amount = $_POST["amt"];
  $stat = $_POST["status"];
  $cur=0;
}
 $result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], filesplace."/$bil.png");
 if ($result == 1)
	 echo "file uploaded";
 else echo "<p>Sorry, Error happened while uploading . </p>";
}

 }
 else{
 echo "<p>article must be uploaded in PDF format.</p>"; #endIF
 } #endIF



$imgloc="/profile/$bil.png";
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



if($stat=="paid"){
$sql = "INSERT INTO dealer_contact(name, company, address, mobile_no, additional_info) VALUES ('$dname', '$comp','$address','$mobile','$additional')";

if (mysqli_query($conn, $sql)) {
    echo'.';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

$sql1 = "INSERT INTO dealer_cur_bal(name, current_balance) VALUES ('$dname', '$cur')";
if (mysqli_query($conn, $sql1)) {
	echo'.';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
//need to modify for history_of transaction
$sql2 = "INSERT INTO dealer_history_of_transaction(name,date,time,amount_paid,liability_amount,bill) VALUES ('$dname', '$dte', '$hourMin', '$amount', '$cur','$imgloc')";
if (mysqli_query($conn, $sql2)) {
	echo'.';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}




}
else{


$sql = "INSERT INTO dealer_contact(name, company, address, mobile_no, additional_info) VALUES ('$dname', '$comp','$address','$mobile','$additional')";
if (mysqli_query($conn, $sql)) {
	echo'.';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$sql1 = "INSERT INTO dealer_cur_bal(name, current_balance) VALUES ('$dname', '$amount')";
if (mysqli_query($conn, $sql1)) {
	echo'.';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
$sql2 = "INSERT INTO dealer_history_of_transaction(name,date,time,amount_paid,liability_amount,purchase_bill,bill) VALUES ('$dname', '$dte', '$hourMin', '$cur','$cur', '$amount','$imgloc')";
if (mysqli_query($conn, $sql2)) {
	echo'.';
  include'adddealer.html';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


}
mysqli_close($conn);
?>
