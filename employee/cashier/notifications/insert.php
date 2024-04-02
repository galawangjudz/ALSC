<?php


require('notif_con.php');

if(isset($_POST['msg'])){
    $query = 'INSERT INTO message_tbl (message) VALUES (:msg)';
    
    $stm = $pdo->prepare($query);
    $stm->bindValue(':msg',$_POST['msg']);
    if($stm->execute()){
        echo json_encode('added');
    }
}