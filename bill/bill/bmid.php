///under testing unknown data or code

<?php

if(isset($_POST['get_values'])) {
    $data = array();
    $selected = $_POST['value'];
    $host = "localhost";
    $mysql_db = "bill";
    $mysql_u = "root";
    $mysql_p = "";
    $con = new mysqli($host, $mysql_u, $mysql_p, $mysql_db);
    $stmt = $con->prepare('SELECT Dept_Name FROM dept_mast WHERE Deg_Type = ?');
    $stmt->bind_param('s', $selected);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()){
        $data[] = $row;
    }

    // return value as json
    echo json_encode($result);
    exit;
}

?>

<select id="Select3" name="deg">
    <option value="UG">UG</option>
    <option value="PG">PG</option>
</select>
<div id="second_select"></div>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<!-- <script src="jquery.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function(){

    $('#Select3').on('change', function(){
    // when user selects a value
        var selected = $(this).val(); // get the value
            // request to server
        $.ajax({
            url: document.URL, // same page process
            type: 'POST',
            data: {get_values: true, value: selected},
            dataType: 'JSON',
            success: function(response) {
                        // get the response of the server, and put it inside a new select box
                $('#second_select').html('<select name="userst"></select>');
                var options = '';
                $.each(response, function(index, element){
                    options += '<option value="'+element.Dept_Name+'">'+element.Dept_Name+'</option>';
                });
                $('select[name="userst"]').html(options);
            }
        });
    });


});
</script>
