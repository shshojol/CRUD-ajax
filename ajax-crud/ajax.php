<?php
    $con = mysqli_connect('localhost', 'root', '', 'ecom') or die('connection failed');
    $sql = 'select * from student';
    $table = mysqli_query($con, $sql);
    $a = "<table border='1' width='100%'>
            <tr>
                <th >ID</th>
                <th >First Name</th>
                <th>Last Name</th>
                <th >Edit</th>
                <th >Delete</th>
            </tr>";

    while($row = mysqli_fetch_assoc($table))
    {
        $a .= "<tr>";
        $a .= "<td>".$row['id']."</td>";
        $a .= "<td>".$row['fname']."</td>";
        $a .= "<td>".$row['lname']."</td>";
        $a .= "<td><button class='edit-btn' data-eid='".$row['id']."'>Edit</button></td>";
        $a .= "<td><button class='delete-btn' data-id='".$row['id']."'>Delete</button></td>";
        $a .= "</tr>";
    }
    $a .= "</table>";
    echo $a;
?>