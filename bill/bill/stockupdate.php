<?php
date_default_timezone_set("Asia/Calcutta");
$month=date('F');
$hourMin = date('h:i');
$dte=date('d-m-Y');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
}
$d=0;//discount
$day=date('D');
$q=0;
$qt="";
$amount="";
$prodid="";
$tot=0;
$result = mysqli_query($conn,"SELECT * FROM bil_temp");
while($row = mysqli_fetch_array($result)){
	if($prodid==""){
		$p=$row['p_id'];
		$qsingle=$row['qty'];
		$qt=$row['qty'];
		$billno=$row['bill_no'];
		$prodid=$row['p_id'];
		$pro=$row['p_id'];
		$amount=$row['price'];
		$q+=$row['qty'];
		$pid='p '.$row['p_id'];
		$tot+=$row['total_price'];
		$d=$row['discount'];


		$result1 = mysqli_query($conn,"SELECT * FROM product_details where pid = '$prodid'");
		if($row1 = mysqli_fetch_array($result1)){
	    $pname=$row1['product_name'];
	  }


		$sql = "update product_details set quantity = quantity-'$qsingle' where pid='$p'";

		if (mysqli_query($conn, $sql)) {
		    //echo'.';
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

	}else{
		$p=$row['p_id'];
		$qsingle=$row['qty'];
	$pro=$row['p_id'];
	$prodid.=','.$row['p_id'];
  $amount.=','.$row['price'];
	$q.=','.$row['qty'];
  $qt+=$row['qty'];
  $pid='p '.$row['p_id'];
  $tot+=$row['total_price'];
  $d=$row['discount'];
	$result1 = mysqli_query($conn,"SELECT * FROM product_details where pid = '$pro'");
	if($row1 = mysqli_fetch_array($result1)){
		$pname.=','.$row1['product_name'];
		$oq=$row1['quantity']-$row['qty'];//quantity to be updated
	}
	$sql = "update product_details set quantity = quantity-'$qsingle' where pid='$p'";

	if (mysqli_query($conn, $sql)) {
			//echo'.';
	} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}

}
$fin=$tot-$tot*($d/100);//final amount
// echo $prodid;//pid , seperation
// echo "<br>".$amount;// price of all products , seperation
// echo "<br>".$qt;//need to do
// echo "<br>".$tot;//total amount
// echo "<br>".$d;//discount
// echo '<br>'.round($fin);//final amount
// echo '<br>'.$pname;//products
// echo '<br>'.$dte;//date
// echo '<br>'.$hourMin;//hour minutes time
// echo '<br>'.$billno;//bill Number
$f=round($fin);
$sql = "INSERT INTO bill_records ( pid, total_amount, discout, qty, date, time, final_amount, product_name, product_price)VALUES ('$prodid','$tot','$d','$q','$dte', '$hourMin', '$f','$pname', '$amount')";

if (mysqli_query($conn, $sql)) {
    //echo'success';
}
else {
	 echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}//echo $month;
$year=date("Y");

$sql1 = "INSERT INTO sales (month, year, time, date, quantity, amount, bill_no, day) VALUES ('$month', '$year', '$hourMin', '$dte', '$qt', '$f', '$billno','$day')";
if (mysqli_query($conn, $sql1)) {
	//trunc
	$sql = "DELETE FROM bil_temp";

	if ($conn->query($sql) === TRUE) {
		include'bpreview.html';
	} else {
			echo "Error deleting record: " . $conn->error;
	}
//trunc
}
else {
	 echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

























// $result = mysqli_query($conn,"SELECT * FROM bil_temp ");
// if($r = mysqli_fetch_array($result)){
// $billno=$r['bill_no'];
// $discount=$r['discount'];
// }else{echo"problem";}
// while($row = mysqli_fetch_array($result)){
// 	if(($t=="")||($qt=="")){
// 		$prodid=$row['p_id'];
// 		$t=$row['total_price'];
// 		$to=$row['total_price'];
// 		$qt=$row['qty'];
// 		$sum+=$to;
// 	}else{
// 		$prodid=$row['p_id'];
// 	  $qt=$row['qty'];
// 		$to=$row['total_price'];
// 		$t=$t.','.$r['total_price'];
// 		$sum+=$to;
// 	}
// }
// echo $billno.'   '.$prodid.'	'.$qt.'	'.$to.'	'.$sum;
// echo '<br>'.$to;
// $bill_record = mysqli_query($conn,"INSERT INTO bill_records (bill_no, pid, total_amount, discout, qty, date, time, final_amount) VALUES ('$billno', '$prodid','$t','$discount','$qt','$dte','$hourMin','$sum')");
// if($row1 = mysqli_fetch_array($bill_record)){
// 	echo "test passed: bill record";
// }
// else{
// 	echo("Error description: " . mysqli_error($bill_record));
// }
?>
