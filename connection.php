<?php

//create a connection 
$conn = mysqli_connect("localhost","root", "","image_manager_system");

//DIE IF CONNECTION WAS NOT SUCCESS

if (!$conn)
{
    die("sorry we faield to connect: ". mysqli_connect_error());
}
// else
// {
//     echo "success";
// }
?>