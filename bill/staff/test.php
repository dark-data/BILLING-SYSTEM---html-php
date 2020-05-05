<?php

session_start();

$regValue=$_SESSION['regName'];

?>

<form method="get" action="o.php">
    <input type="text" name="regName" value=" ">
    <input type="submit">
</form>