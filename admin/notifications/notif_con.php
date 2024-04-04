<?php
$server = DB_SERVER; 
$database = DB_NAME;     
$user = DB_USERNAME;         
$pass = "";         

$pdo = new PDO('mysql:host='.$server.';dbname='.$database, $user, $pass);

?> 