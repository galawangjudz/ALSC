<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['userdata'])){
    if($_SESSION['userdata']['user_type'] == 'IT Admin' || 'Purchasing Officer'){
        if(strpos($link, 'login.php') === false){
            redirect('admin/index.php');
        }
    } 
    elseif($_SESSION['userdata']['user_type'] == 'Agent'){
        if(strpos($link, 'login.php') === false){
            redirect('agent_user/index.php');
        }
    } 
    elseif($_SESSION['userdata']['user_type'] == 'SOS'){
        if(strpos($link, 'login.php') === false){
            redirect('employee/sales_manager/index.php');
        }
    }  
    elseif($_SESSION['userdata']['user_type'] == 'CA'){
        if(strpos($link, 'login.php') === false){
            redirect('employee/ca/index.php');
        }
    }     
    elseif($_SESSION['userdata']['user_type'] == 'Cashier'){
        if(strpos($link, 'login.php') === false){
            redirect('employee/cashier/index.php');
        }
    }
    elseif($_SESSION['userdata']['user_type'] == 'COO'){
        if(strpos($link, 'login.php') === false){
            redirect('mancomm/coo/index.php');
        }
    }  
    elseif($_SESSION['userdata']['user_type'] == 'CFO'){
        if(strpos($link, 'login.php') === false){
            redirect('mancomm/cfo/index.php');
        }
    }  
    elseif($_SESSION['userdata']['user_type'] == 'Accounting Officer'){
        if(strpos($link, 'login.php') === false){
            redirect('employee/accounting/index.php');
        }
    }  
}

?>

