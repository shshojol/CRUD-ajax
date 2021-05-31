<?php

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];


$con = mysqli_connect('localhost', 'root', '', 'ecom') or die('connection failed');
$sql = "insert into student (fname, lname) values('{$first_name}', '{$last_name}') ";
if(mysqli_query($con, $sql))
{
    echo  1;
}else{
    echo  0;
}