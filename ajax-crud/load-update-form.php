<?php
$studentid = $_POST['id'];
$con = mysqli_connect('localhost', 'root', '', 'ecom') or die('connection failed');
$sql = "select * from student where id={$studentid}";
$table = mysqli_query($con, $sql) or die('sql falied');
$output = "";

if(mysqli_num_rows($table) > 0)
{
        while($row = mysqli_fetch_assoc($table))
        {
        $output .= "<label>First  Name</label>
            <input type='text' id='up-fname' value='{$row["fname"]}'><br>
            <input type='text' id='up-id' hidden value='{$row["id"]}'><br>
            <label>Last  Name</label>
            <input type='text' id='up-lname' value='{$row["lname"]}'><br>
            <input type='submit' value='update' id='update'><br>";
        }
        mysqli_close($con);
        echo $output;
}else{
    echo "No Record found";
}


