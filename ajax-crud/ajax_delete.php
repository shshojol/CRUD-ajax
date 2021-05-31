<?php

$student_id = $_POST['id'];



$con = mysqli_connect('localhost', 'root', '', 'ecom') or die('connection failed');
$sql = "delete from student where id = {$student_id}";
if(mysqli_query($con, $sql))
{
    echo  1;
}else{
    echo  0;
}