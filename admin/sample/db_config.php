<?php
    $servername = 'localhost';
    $username   = 'root'; // Username
    $password   = ''; // Password
    $dbname     = "demo";
    $conn       = mysqli_connect($servername,$username,$password,"$dbname");
    
    if(!$conn){
        die('Could not Connect MySql Server:' .mysql_error());
    }
?>