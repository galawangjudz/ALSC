<?php
echo "PHP Timezone: " . date_default_timezone_get() . "<br>";
echo "Current Time (PHP): " . date("Y-m-d H:i:s") . "<br>";
echo "Current Time (MySQL): " . mysqli_query($conn, "SELECT NOW()")->fetch_assoc()['NOW()'] . "<br>";
?>
