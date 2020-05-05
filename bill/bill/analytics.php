

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
}//& password='$pass'
if(isset($_POST['formaction'])){//1             2 loop open
	if($_POST['formaction'] == 'typesubmit'){
    if($_POST['report']=="year"){
        include'analytics.html';
        echo"<tr><form method='post' action='analytics.php'><td align='center'> select year </td><td>  <br> <select name='years' class='container' onchange='this.form.submit()'>";
        $result = mysqli_query($conn,"SELECT DISTINCT year FROM sales");

        echo "<option value='null' selected>--select--</option>";
        while($row = mysqli_fetch_array($result))
        {

        echo "<option value='".$row['year']."'>".$row['year']."</option>";

       }
       echo'</select><td><input type="hidden" name="formaction" value="year"><button type="submit" style="visibility: hidden;">view report</button></td><br><br></td><td></td></tr><td>.</td><tr></tr></form>';
     }
     else if($_POST['report']=="month"){
         include'analytics.html';
         echo"<tr><form method='post' action='analytics.php'><td align='center'> select month </td><td>  <br> <select name='month' class='container' onchange='this.form.submit()'>";
         $result = mysqli_query($conn,"SELECT DISTINCT month FROM sales");

         echo "<option value='null' selected>--select--</option>";
         while($row = mysqli_fetch_array($result))
         {

         echo "<option value='".$row['month']."'>".$row['month']."</option>";

        }
        echo'</select><td><input type="hidden" name="formaction" value="month"><button type="submit" style="visibility: hidden;">view report</button></td><br><br></td><td></td></tr><tr><td>.</td></tr></form>';
      }
      else if($_POST['report']=="date"){

          include'analytics.html';
          echo"<tr><form method='post' action='analytics.php'><td align='center'> from date  <br> <br> <select name='fromdate' class='container' onchange='this.form.submit()'>";
          $result = mysqli_query($conn,"SELECT DISTINCT date FROM sales");
          $result1 = mysqli_query($conn,"SELECT DISTINCT date FROM sales");
          while($row = mysqli_fetch_array($result))
          {

          echo "<option value='".$row['date']."'>".$row['date']."</option>";

          }
          echo"</select><td align='center'>to date   <br><br> <select name='todate' class='container' onchange='this.form.submit()'>";

          while($row1 = mysqli_fetch_array($result1))
          {
            echo "<option value='".$row1['date']."'>".$row1['date']."</option>";
          }
          echo'</select><td><input type="hidden" name="formaction" value="daterep"><button type="submit" style="width: 100%;background-color: #4CAF50;color: white;padding: 5px 3px;margin: 8px 0;border: none;border-radius: 4px;cursor: pointer;">view report</button></td><br><br></td><td></td></tr><tr><td>.</td></tr></form>';
       }
     }
     else if($_POST['formaction'] == 'year'){

       //graph.php start
       //index.php
       $years=$_POST['years'];
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
       echo'<style>html, body, #container {  width: 100%;  height: 90%;  margin: 0;  padding: 0;}</style>';
       include'analytics.html';
       echo'<head><script src="anychartcore.js"></script><script src="anychartpie.js"></script>  </head>  <body>    <div id="container" ></div>    ';
       echo'<script>
	   anychart.onDocumentReady(function() {
	   var data = '.$chart1.';
	   var chart = anychart.pie();    chart.title("sales report for the year '.$years.'");  chart.data(data);  chart.legend().position("right");  chart.legend().itemsLayout("vertical");  chart.container("container");  chart.draw(); });    </script>';


       echo'  </body></html>';





       //graph.php ends
     }
     else if($_POST['formaction'] == 'month'){
       include'analytics.html';
       //graph.php start
       //index.php
       $year=date("Y");
       $month=$_POST['month'];
       $dateuniq="";
       $result = mysqli_query($conn, "SELECT DISTINCT date FROM sales where month='$month' and year ='$year'");
       //test passed
       $chart="[";
       while($row = mysqli_fetch_array($result))
       {
        $dateuniq=$row['date'];
        $result1 = mysqli_query($conn, "SELECT sum(amount) as tot FROM sales where date='$dateuniq'");
        while($row1 = mysqli_fetch_array($result1))
        {
          $chart.='{x: "'.$dateuniq.'", value: '.$row1['tot'].'},';
        }
       }$chart1=mb_substr($chart, 0, -1);
       $chart1.="]";
       echo'<style>html, body, #container {  width: 100%;  height: 90%;  margin: 0;  padding: 0;}</style>';
       include'analytics.html';
       echo'<head><script src="anychartcore.js"></script><script src="anychartpie.js"></script>  </head>  <body>    <div id="container" ></div>    ';
       echo'<script>
	   anychart.onDocumentReady(function() {
	   var data = '.$chart1.';
	   var chart = anychart.pie();    chart.title("sales report for the year '.$years.'");  chart.data(data);  chart.legend().position("right");  chart.legend().itemsLayout("vertical");  chart.container("container");  chart.draw(); });    </script>';


       echo'  </body></html>';


       //graph.php ends
     }
     else if($_POST['formaction'] == 'daterep'){
       include'analytics.html';
       //graph.php start
       //index.php
       $year=date("Y");
       $start=$_POST['fromdate'];
       $end=$_POST['todate'];
       $dateuniq="";
       $result = mysqli_query($conn, "SELECT DISTINCT date FROM sales where date between '$start' AND '$end'");
       //test passed
       $chart="[";
       while($row = mysqli_fetch_array($result))
       {
        $dateuniq=$row['date'];
        $result1 = mysqli_query($conn, "SELECT sum(amount) as tot FROM sales where date='$dateuniq'");
        while($row1 = mysqli_fetch_array($result1))
        {
          $chart.='{x: "'.$dateuniq.'", value: '.$row1['tot'].'},';
        }
       }$chart1=mb_substr($chart, 0, -1);
       $chart1.="]";
       //echo $chart1;
       echo'<style>html, body, #container {  width: 100%;  height: 90%;  margin: 0;  padding: 0;}</style>';
       include'analytics.html';
       echo'<head><script src="anychartcore.js"></script><script src="anychartpie.js"></script>  </head>  <body>    <div id="container" ></div>    ';
       echo'<script>
	   anychart.onDocumentReady(function() {
	   var data = '.$chart1.';
	   var chart = anychart.pie();    chart.title("sales report for the year '.$year.'");  chart.data(data);  chart.legend().position("right");  chart.legend().itemsLayout("vertical");  chart.container("container");  chart.draw(); });    </script>';


       echo'  </body></html>';


       //graph.php ends
     }
   }
echo'</table><br><br>';
mysqli_close($conn);
?>
