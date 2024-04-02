<?php
header('Content-Type: application/json');
require('notif_con.php');

$usertype = $_GET['user_type']; 

$query = "SELECT COUNT(*) FROM message_tbl WHERE seen = 0 and user_to_be_notified = :usertype";
$stm = $pdo->prepare($query);
$stm->bindParam(':usertype', $usertype);
$stm->execute();

if ($stm->rowCount() > 0) {
    $result = $stm->fetch();
    echo json_encode($result[0]);
}

function timeAgo($timestamp) {
    $currentTime = time();
    $notificationTime = strtotime($timestamp);
    $timeDiff = $currentTime - $notificationTime;

    if ($timeDiff < 60) {
        return $timeDiff . 's ago';
    } elseif ($timeDiff < 3600) {
        return floor($timeDiff / 60) . 'm ago';
    } elseif ($timeDiff < 86400) {
        return floor($timeDiff / 3600) . 'h ago';
    } else {
        return floor($timeDiff / 86400) . 'd ago';
    }
}

?>
