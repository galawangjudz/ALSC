<?Php
$dbhost_name = DB_SERVER; 
$database = DB_NAME;     
$username = DB_USERNAME;         
$password = "";       


try {
$dbo = new PDO('mysql:host='.$dbhost_name.';dbname='.$database, $username, $password);
} catch (PDOException $e) {
print "Error!: " . $e->getMessage() . "<br/>";
die();
}
?> 