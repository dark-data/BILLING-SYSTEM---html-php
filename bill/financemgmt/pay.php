<?php

include'pay.html';

if($_POST["trans"]) {
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$dname = $_POST["a"];
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

	echo'<style>.fixed_header{    table-layout: fixed;    border-collapse: collapse;}.fixed_header tbody{  display:block;  width: 100%;  overflow: auto;  height: 200px;}.fixed_header thead tr {   display: block;}.fixed_header thead {  background: black;  color:#fff;}.fixed_header th, .fixed_header td {  padding: 5px;  text-align: left;  width: 122px;}</style><table cellspacing="0" cellpadding="0" border="0" border="1" width="100%" style="border-radius: 5px 5px 5px 5px;" class="fixed_header"><thead><tr><th>dealer name</th><th>company</th><th>date</th><th>time</th><th>amount paid</th><th>purchase amount</th><th>liablity amount</th><th>view bill</th></tr></thead>';

	$result = mysqli_query($conn,"SELECT dealer_history_of_transaction.date,dealer_history_of_transaction.time,dealer_history_of_transaction.amount_paid,dealer_history_of_transaction.purchase_bill,dealer_history_of_transaction.liability_amount,dealer_history_of_transaction.name,dealer_history_of_transaction.bill, dealer_contact.company FROM dealer_history_of_transaction  INNER JOIN dealer_contact ON dealer_contact.name ='".$dname."' AND dealer_history_of_transaction.name='".$dname."'" );
	while($row = mysqli_fetch_array($result))
	{
	 echo'<tr><td>'.$row['name'].'</td><td>'.$row['company'].'</td><td>'.$row['date'].'</td><td>'.$row['time'].'</td><td>'.$row['amount_paid'].'</td><td>'.$row['purchase_bill'].'</td><td>'.$row['liability_amount'].'</td><td><a href="/bill/financemgmt'.$row['bill'].'" target="popup">view bill</a></td><tr>';
	}
	echo'</table>';



}








else{
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $dname = $_POST["a"];
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

echo'<style>.fixed_header{    table-layout: fixed;    border-collapse: collapse;}.fixed_header tbody{  display:block;  width: 100%;  overflow: auto;  height: 200px;}.fixed_header thead tr {   display: block;}.fixed_header thead {  background: black;  color:#fff;}.fixed_header th, .fixed_header td {  padding: 10px;  text-align: left;  width: 200px;}</style><table cellspacing="0" cellpadding="0" border="0" border="1" width="50%" class="fixed_header"><thead><tr><th></th><th>dealer dealer</th><th>amount pending</th></tr></thead>';
$result = mysqli_query($conn,"SELECT * FROM dealer_cur_bal WHERE name='".$dname."'");
while($row = mysqli_fetch_array($result))
{
 echo'<tr><td></td><td>'.$row['name'].'</td><td>'.$row['current_balance'].'</td></tr>';
}
echo'</table>';


}


?>
