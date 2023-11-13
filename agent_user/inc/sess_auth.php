<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') 
    $link = "https"; 
else
    $link = "http"; 
$link .= "://"; 
$link .= $_SERVER['HTTP_HOST']; 
$link .= $_SERVER['REQUEST_URI'];
if(!isset($_SESSION['userdata']) && !strpos($link, 'login.php')){
	redirect('auth/login.php');
}

$usertype = $_settings->userdata('user_type'); 
$level = $_settings->userdata('type'); 
$session_id = $_settings->userdata('user_code');
if(!isset($_SESSION['userdata']) && !strpos($link, 'login.php')){
	redirect('auth/login.php');
}
// if(!isset($_SESSION['userdata']) || $usertype !== 'IT Admin') {
   
//     unset($_SESSION['userdata']);
// 	session_destroy(); // destroy session
// 	//create later page for access denied!!!!
// 	redirect('auth/access_denied.php');

// }

?>
