<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill";
$bcode="";
$billno="";
$pid="";
$qty="";
$amount="";
$qt=0;
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
}//& password='$pass'


if(isset($_POST['act'])){//1             2 loop open



		if($_POST['act'] == 'addone'){//2
			$bcode=$_POST['pid'];
			$qty=$_POST['qt'];

			if($qty==''){//3
				$qty=1;
			}//3

    	$result = mysqli_query($conn,"SELECT * FROM product_details where barcode = '$bcode'");

			while($row = mysqli_fetch_array($result)){//4
				$pname=$row['product_name'];
				$amount=$row['amount'];
				$qt=$row['quantity'];
				//$pid='p '.$row['pid'];
				$pid=$row['pid'];
			}//4

			if($qty<=$qt){//5
				//validation of product already been added or not if yes then increase the quantity
				$result1 = mysqli_query($conn,"SELECT * FROM bil_temp where p_id = '$pid'");
				if($row1 = mysqli_fetch_array($result1)){//6
					$qt1 = $qty+$row1['qty'];
					$amount*=$qt1;
					$sql = "update bil_temp set qty = '$qt1',total_price='$amount' where p_id = '$pid'";
					if (mysqli_query($conn, $sql)) {//7
						include'bmid.html';
					}else{
						echo"error";
						include'bmid.html';
					}
				}

				else{
					$sql = "select MAX(bill_no)as bill FROM bill_records";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						if($row = $result->fetch_assoc()) {
							$billno=$row['bill']+1;
						}
					}

					$tot=$amount * $qty;
					$sql = "INSERT INTO bil_temp (bill_no, p_id, qty, price, total_price) VALUES ('$billno', '$pid','$qty','$amount','$tot')";

					if (mysqli_query($conn, $sql)) {//11
						echo' ';
					}//11
					include'bmid.html';
					}
				}
				else{
					include'bmid.html';
					echo'<script>alert("stock not available");</script>';
				}
			}
//

	else if($_POST['act'] == 'addtwo'){
			$prod=$_POST['dnam'];
			$qty=$_POST['qty'];
			$result = mysqli_query($conn,"SELECT * FROM product_details where product_name = '$prod'");
			while($row = mysqli_fetch_array($result)){
				$pname=$row['product_name'];
				$amount=$row['amount'];
				$qt=$row['quantity'];
				//$pid='p '.$row['pid'];
				$pid=$row['pid'];
			}
			if($qty<=$qt){
				$result1 = mysqli_query($conn,"SELECT * FROM bil_temp where p_id = '$pid'");

				if($row1 = mysqli_fetch_array($result1)){//6
					$qt1 = $qty+$row1['qty'];
					$amount*=$qt1;
					$sql = "update bil_temp set qty = '$qt1',total_price='$amount' where p_id = '$pid'";
					if (mysqli_query($conn, $sql)) {//7
						include'bmid.html';
					}else{
						echo"error";
						include'bmid.html';
					}
				}else{
					$sql = "select MAX(bill_no)as bill FROM bill_records";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
						if($row = $result->fetch_assoc()) {
							$billno=$row['bill']+1;
						}
					}
					$tot=$amount * $qty;
					$sql = "INSERT INTO bil_temp (bill_no, p_id, qty, price, total_price) VALUES ('$billno', '$pid','$qty','$amount','$tot')";
					if (mysqli_query($conn, $sql)) {
						echo' ';
					}
					include'bmid.html';
				}

				}else{
					include'bmid.html';
					echo'<script>alert("stock not available");</script>';
				}
  }

  else if($_POST['act'] == 'discount'){
				$dcount=$_POST['dis'];
				$sql = "update bil_temp set discount='$dcount'";
				if (mysqli_query($conn, $sql)) {
					echo' ';
				}
				include'bmid.html';
    }else{
		echo'error';
	}
}//1
?>
