<?php
require('notif_con.php');

$usertype = $_GET['user_type'];

$query = 'UPDATE message_tbl SET seen = 1 WHERE user_to_be_notified = :usertype';
$stm = $pdo->prepare($query);
$stm->bindParam(':usertype', $usertype);

if ($stm->execute()) {
    $query2 = 'SELECT message AS msg FROM message_tbl WHERE seen = 1 AND user_to_be_notified = :usertype';
    $stm2 = $pdo->prepare($query2);
    $stm2->bindParam(':usertype', $usertype);

    if ($stm2->execute()) {
        $result = $stm2->fetchAll();
        echo json_encode($result);
    }
}
?>
