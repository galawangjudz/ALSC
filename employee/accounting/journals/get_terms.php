<?php
require_once('./../../../config.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['termsId'])) {
    $termsId = $_POST['termsId'];

    $termsData = array();

    $terms_qry = $conn->query("SELECT terms,days_before_due, days_in_following_month FROM `payment_terms` WHERE terms_indicator = $termsId");

    if ($terms_qry) {
        $row = $terms_qry->fetch_assoc();

        $termsData = array(
            'days_before_due' => $row['days_before_due'],
            'days_in_following_month' => $row['days_in_following_month'],
            'terms' => $row['terms']
        );

        echo json_encode($termsData);
    }
}
?>
