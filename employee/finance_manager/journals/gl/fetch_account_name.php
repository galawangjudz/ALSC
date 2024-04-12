<?php

//require_once('./../../../config.php');


if (isset($_POST['accountCode'])) {
    $accountCode = $_POST['accountCode'];

    $stmt = $conn->prepare("SELECT name FROM account_list WHERE account_code = ?");
    $stmt->bind_param("s", $accountCode);
    $stmt->execute();
    $stmt->bind_result($accountName);

    if ($stmt->fetch()) {

        echo $accountName;
    } else {

        echo 'Account not found';
    }

    $stmt->close();
} else {

    echo 'Invalid request';
}
?>
