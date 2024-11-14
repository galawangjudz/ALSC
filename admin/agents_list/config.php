<?Php
$dbhost_name = "localhost"; 
$database = "alscdb";     
$username = "root";         
$password = "";         


try {
$dbo = new PDO('mysql:host='.$dbhost_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?> 