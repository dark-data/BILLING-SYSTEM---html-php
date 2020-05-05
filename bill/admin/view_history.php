<?php
if(isset($_POST['submit'])){
// As output of $_POST['Color'] is an array we have to use foreach Loop to display individual value
$staff= $_POST['a'];
$s=$staff;
}
// echo $staff;
include'viewlogin_history.html';
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
$result = mysqli_query($conn,"SELECT * FROM log WHERE date='".$s."'");
echo'<style>.fixed_header{    table-layout: fixed;    border-collapse: collapse;}.fixed_header tbody{  display:block;  width: 100%;  overflow: auto;  height: 200px;}.fixed_header thead tr {   display: block;}.fixed_header thead {  background: black;  color:#fff;}.fixed_header th, .fixed_header td {  padding: 10px;  text-align: left;  width: 250px;}</style><table cellspacing="0" cellpadding="0" border="0" border="1" width="50%" class="fixed_header"><thead><tr><th>user</th><th>login time </th><th>role</th></thead>';
while($row = mysqli_fetch_array($result))
{
  echo'<tr><td>'.$row['user'].'</td><td>'.$row['time'].'</td><td>'.$row['type'].'</td></tr>';
}
echo'</table></html>';
?>
