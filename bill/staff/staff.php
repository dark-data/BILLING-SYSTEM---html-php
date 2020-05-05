<?php
// $result1 = mysqli_query($conn,"select * from product_details where quantity<=10");
// while($row = mysqli_fetch_array($result))
//
// if ($result1->num_rows > 0) {
//
// 	$result = mysqli_query($conn,"select * from product_details where quantity<=10");
// 	echo'<script type="text/javascript"> alert("please make order for the following products ';
//
// 	while($row = mysqli_fetch_array($result)){
// 		echo '1. '.$row['product_name'].' stock: '.$row['quantity'];
// 	}
// 	echo '"); </script>';
// }else{
// 	echo'
// <script>
//     alert("Hello! I am an alert box!");
// </script>';
// }
if($a=="emp"){
echo'<html><frameset cols="16%,*,23%" noresize border="0" ><frame src="staff/employee_feature.html" scrolling="no"><frame src="staff/mid.html"name="mid">  <frame src="staff/last.html"name="last"></frameset></html>';
}elseif($a=="stkmanager"){
	echo'<html><frameset cols="16%,*,23%" noresize border="0" ><frame src="staff/stock_manager_feature.html" scrolling="no"><frame src="staff/mid.html"name="mid">  <frame src="staff/last.html"name="last"></frameset></html>';
}
?>
