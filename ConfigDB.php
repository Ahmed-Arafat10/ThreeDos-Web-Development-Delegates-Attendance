<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "web_dev_attend_threedos";
$ConnectToDatabase = mysqli_connect($host,$username,$password,$database);
// if($ConnectToDatabase) echo "Done";
// else echo "Failed";

function Print_Message($text,$state){
    if($state == 'normal')
    echo "<div style='text-align:center' class = 'alert alert-primary' role = 'alert' >". $text . "</div>";
    else if($state == 'danger')
    echo "<div style='text-align:center;' class = 'alert alert-danger' role = 'alert' >". $text . "</div>";
    
    }
    
?>
 