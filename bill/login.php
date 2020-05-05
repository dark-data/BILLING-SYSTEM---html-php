<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $uname = $_POST["uname"];
  $pass = $_POST["psw"];
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



$sql = "select * from user_accounts where username= '$uname' ";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    if($row = $result->fetch_assoc()) {
        $type=$row['type'];
        $x=$row["password"];
		if($x == $pass){
      if($type=='admin'){
        include'admin/admin.html';
      }elseif ($type=='employee') {
        // code...
        date_default_timezone_set("Asia/Calcutta"); $datew="hour minute : ";
        $hourMin = date('h:i');
        $dte=date('d-m-Y');
        $profile="profile/".$uname.".png";
        $sql="SELECT MAX(sno)as sno FROM log";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sn=$row["sno"];

        	}
        }
        $sno=$sn+1;
        $sql = "INSERT INTO log (sno, user, profile, time, date, type)VALUES ('$sno', '$uname','$profile','$hourMin','$dte','$type')";
        if (mysqli_query($conn, $sql)) {
          $a="emp";
          include'staff/staff.php';
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }elseif ($type=='stock manager') {
        // code...date_default_timezone_set("Asia/Calcutta"); $datew="hour minute : ";
        $hourMin = date('h:i');
        $dte=date('d-m-Y');
        $profile="profile/".$uname.".png";
        $sql="SELECT MAX(sno)as sno FROM log";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $sn=$row["sno"];

        	}
        }
        $sno=$sn+1;
        $sql = "INSERT INTO log (sno, user, profile, time, date, type)VALUES ('$sno', '$uname','$profile','$hourMin','$dte','$type')";
        if (mysqli_query($conn, $sql)) {
          $a="stkmanager";
          include'staff/staff.php';
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
		}
		else{
			include'index.html';
			echo'password incorrect';
		}
	}
}
else{
		include'index.html';

  		echo'<div class="alert alert-danger"><strong>Error!</strong> invalid password</div>';
}
$conn->close();



?>
