<?php
$id = $_POST['id'];
$firstname = $_POST['first_name'];
$lastname = $_POST['last_name'];


$con = mysqli_connect('localhost', 'root', '', 'ecom') or die('connection failed');
$sql = "update student set fname='{$firstname}', lname='{$lastname}' where id = '{$id}'";
if(mysqli_query($con, $sql))
{
    echo  1;
}else{
    echo  0;
}