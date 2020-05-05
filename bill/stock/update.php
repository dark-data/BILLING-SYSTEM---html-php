<?php
include'midviewstock.html';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$search =  $_POST["search"];
}
echo'<style>button:hover {opacity: 0.4;}.container {  width: 80%;padding: 5px 5px;display: inline-block;border: 1px solid #ccc;border-radius: 4px;box-sizing: border-box;}html { overflow-y: hidden; }table{   width:98%;   height: 20%;   border-radius: 5px;   background-color: #f2f2f2;   padding: 5px;}.div{  align: center;border-radius: 4px;width:100%;height:7%;   background-color: #504d4c;}</style>';
echo'<br><br><form name="up" method="POST" action="update.php">  <table align="center"><tr>    <td align="center">Update Stock:</td>    <td><input type="text" style="width: 80%;    padding: 12px 20px;    margin: 8px 0;    display: inline-block;    border: 1px solid #ccc;    border-radius: 4px;    box-sizing: border-box;"placeholder="    enter the key word for the product looking for " name="search" required></td>    <td><button type="submit" style="width: 80%;background-color: #4CAF50;color:white;padding: 14px 20px;margin: 8px 0;border: none;border-radius: 4px;cursor: pointer;">view</button></td></form></tr><tr><form method="post" action="updatedata.php"><td></td><td>  <br> <select name="dnam" class="container">';



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



$result = mysqli_query($conn,"SELECT * FROM product_details where product_name like '$search%'");


while($row = mysqli_fetch_array($result))
{

echo "<option value='".$row['product_name']."'>".$row['product_name']."</option>";

}
echo'</select><br><br></td><td></td></tr><tr><td></td><td><input type="text" style="width: 50%;    padding: 12px 20px;    margin: 8px 0;    display: inline-block;    border: 1px solid #ccc;    border-radius: 4px;    box-sizing: border-box;"placeholder="    enter stock value " name="stk" required></td><td><button type="submit" style="width: 100%;background-color: #4CAF50;color: white;padding: 5px 3px;margin: 8px 0;border: none;border-radius: 4px;cursor: pointer;">update stock</button></td></tr></table><br><br></form></html>';


mysqli_close($conn);
?>
