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
// Initialize last activity if not already set
if (!isset($_SESSION['last_activity'])) {
    $_SESSION['last_activity'] = time();
}

// Check if the session has expired
$lastActivity = $_SESSION['last_activity'];
$sessionExpiration = 60 * 5; // Session expires after 5 minutes of inactivity



echo $lastActivity;
echo $sessionExpiration;
/* if (time() - $lastActivity > $sessionExpiration) {
    // Session has expired, destroy the session and redirect to the login page
    session_unset();
    session_destroy();
    
    echo "<script>alert('Your session has expired. Please log in again.');</script>";

    // Redirect to the login page
    redirect('auth/login.php');
    exit;
}
 */
// Update the last activity time
$_SESSION['last_activity'] = time();
// if(!isset($_SESSION['userdata']) || $usertype !== 'IT Admin') {
   
//     unset($_SESSION['userdata']);
// 	session_destroy(); // destroy session
// 	//create later page for access denied!!!!
// 	redirect('auth/access_denied.php');

// }

?>
