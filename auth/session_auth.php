<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['userdata'])){
    if($_SESSION['userdata']['user_type'] =='Purchasing Officer'){
        if(strpos($link, 'login.php') === false){
            redirect('employee/po/index.php');
        }
    } 
    if($_SESSION['userdata']['user_type'] == 'Manager'){
        if(strpos($link, 'login.php') === false){
            redirect('employee/finance_manager/index.php');
        }
    } 
    if($_SESSION['userdata']['user_type'] == 'CFO'){
        if(strpos($link, 'login.php') === false){
            redirect('mancomm/cfo/index.php');
        }
    } 
    if($_SESSION['userdata']['user_type'] == 'SOS'){
        if(strpos($link, 'login.php') === false){
            redirect('employee/sales_manager/index.php');
        }
    }  
    // elseif($_SESSION['userdata']['user_type'] == 'CA'){
    //     if(strpos($link, 'login.php') === false){
    //         redirect('employee/ca/index.php');
    //     }
    // }     
    // elseif($_SESSION['userdata']['user_type'] == 'Cashier'){
    //     if(strpos($link, 'login.php') === false){
    //         redirect('employee/cashier/index.php');
    //     }
    // }
    // elseif($_SESSION['userdata']['user_type'] == 'COO'){
    //     if(strpos($link, 'login.php') === false){
    //         redirect('mancomm/coo/index.php');
    //     }
    // }  
    // elseif($_SESSION['userdata']['user_type'] == 'CFO'){
    //     if(strpos($link, 'login.php') === false){
    //         redirect('mancomm/cfo/index.php');
    //     }
    // }  
    if($_SESSION['userdata']['user_type'] == 'Accounting Officer'){
        if(strpos($link, 'login.php') === false){
            redirect('employee/accounting/index.php');
        }
    }  
}

?>

