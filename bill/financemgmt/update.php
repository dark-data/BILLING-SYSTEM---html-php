<?php
 define ("filesplace","../financemgmt/profile");
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
  date_default_timezone_set("Asia/Calcutta"); $datew="hour minute : ";
  $hourMin = date('h:i');
  $dte=date('d-m-Y');
  $bil=date('d-m-Y_h-i');
  $dname = $_POST["dn"];
  $repayamt = $_POST["amt"];
  $netbal=0;
  $purchase=0;
  }


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

  $result = mysqli_query($conn,"SELECT * FROM dealer_cur_bal WHERE name='".$dname."'");
if($row = mysqli_fetch_array($result)){
 $cbal=$row['current_balance'];
}

if($cbal<$repayamt){
		echo"check the repay amount it shouldn't be less then the lianbility ";
		include'paybill.html';
}

else{
	if (is_uploaded_file($_FILES['fileToUpload']['tmp_name'])) {

		if (($_FILES['fileToUpload']['type'] == "image/png")||($_FILES['fileToUpload']['type'] == "image/jpeg")) {
			$result = move_uploaded_file($_FILES['fileToUpload']['tmp_name'], filesplace."/$bil.png");
			if ($result == 1)
			echo "file uploaded";
			else echo "<p>Sorry, Error happened while uploading . </p>";
		}
		else{
			echo "<p>article must be uploaded in PDF format.</p>";
		}
	}

	//error in sql syntax needed to be rectified
	$netbal=$cbal-$repayamt;
	$sql = "UPDATE dealer_cur_bal SET current_balance='".$netbal."' where name='".$dname."'";
	if ($conn->query($sql) === TRUE) {
		//need to modify for history_of transaction
		$sql2 = "INSERT INTO dealer_history_of_transaction(name,date,time,amount_paid,purchase_bill,liability_amount,bill) VALUES ('$dname', '$dte', '$hourMin', '$repayamt','$purchase', '$netbal','$imgloc')";
		if (mysqli_query($conn, $sql2)) {
			echo'.';
      	include'paybill.html';
			echo "amount has been uploaded";

		}
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	else {
		echo "Error updating record: " . $conn->error;
	}
}

?>
