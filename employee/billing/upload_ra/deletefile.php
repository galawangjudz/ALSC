<?php
require_once('../config.php');
?>

<html>
<head>
<script type="text/javascript">
function jsFunction(){
    window.history.back();
}
</script>
</head>

<?php
$a_name = $_GET['name'];
$resp = 0;

$path = "upload_ra/uploads/$a_name";

unlink($path);
echo '<script type="text/javascript">jsFunction();</script>';
echo "YES";

?>
</html>
