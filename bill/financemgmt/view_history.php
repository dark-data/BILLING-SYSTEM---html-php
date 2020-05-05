<?php
if(isset($_POST['submit'])){
// As output of $_POST['Color'] is an array we have to use foreach Loop to display individual value
$staff= $_POST['a'];
$s=$staff;
}
echo $staff;
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

echo'<table cellspacing="0" cellpadding="0" border="0" width="325"><tr><td><table cellspacing="0" cellpadding="1" border="1" width="300" ><tr style="color:white;background-color:grey">        <th style="width:55%;">Staff</th>        <th style="style="width:100%;">Login Time</th>     </tr>   </table>  </td> </tr><tr><td>';
echo'<div style="background-color:#FDFAFE;width:102%; height:120px; overflow:auto;"><table cellspacing="0" cellpadding="1" border="1" width="320">';
$result = mysqli_query($conn,"SELECT * FROM log WHERE date='".$s."'");
while($row = mysqli_fetch_array($result))
{
 echo'<tr><td style="width=50%">'.$row['user'].'</td><td style="width=100%">'.$row['time'].'</td></tr>';
}
echo'</table>   </div>  </td> </tr></table>';






?>
