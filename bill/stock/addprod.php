<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $dname = $_POST["dnam"];
  $pid = $_POST["pid"];
  $prod = $_POST["pname"];
  $info = $_POST["detail"];
  $stok = $_POST["stock"];
  $amt = $_POST["amount"];
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
}





$sql = "INSERT INTO product_details (product_name, details, amount, quantity, dealer,barcode)VALUES ('$prod', '$info','$amt','$stok','$dname','$pid')";

if (mysqli_query($conn, $sql)) {
  echo'.';
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}





$sql = "INSERT INTO dealer_product (name, product, product_details,pid)VALUES ('$dname', '$prod','$info','$pid')";

if (mysqli_query($conn, $sql)) {
    include"lastaddstock.html";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}





?>
