<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bill";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}//& 

$years=2018;
       $monthuniq="";
       $result = mysqli_query($conn, "SELECT DISTINCT month FROM sales where year='$years'");
       //test passed
       $chart="[";
       while($row = mysqli_fetch_array($result))
       {
        $monthuniq=$row['month'];
        $result1 = mysqli_query($conn, "SELECT sum(amount) as tot FROM sales where year='$years' AND month='$monthuniq'");
        while($row1 = mysqli_fetch_array($result1))
        {
          $chart.='{x: "'.$monthuniq.'", value: '.$row1['tot'].'},';
        }
       }$chart1=mb_substr($chart, 0, -1);
       $chart1.="]";
	   echo'<style>html, body, #container {  width: 100%;  height: 100%;  margin: 0;  padding: 0;}</style>';
       echo'<head><script src="anychartcore.js"></script><script src="anychartpie.js"></script>  </head>  <body>    <div id="container" ></div>    ';
       echo'<script>
	   anychart.onDocumentReady(function() {  
	   var data = '.$chart1.';  
	   var chart = anychart.pie();    chart.title("Population by Race for the United States: 2010 Census");  chart.data(data);  chart.legend().position("right");  chart.legend().itemsLayout("vertical");  chart.container("container");  chart.draw(); });    </script>';
       echo'  </body></html>';
	   
       echo $chart1;
?>