<?php

    include '../login/db_conn.php';

    $token = isset($_GET['token'])? mysqli_real_escape_string($con, $_GET['token']): null;

    $query_getToken = "SELECT `verification_token`, `is_active` FROM `tb_users` WHERE `verification_token`='".$token."' AND `is_active` = 0"; 
    $result = $con->query($query_getToken); 
    $row_cnt = $result->num_rows;  

    $today = date("Y-m-d H:i:s");  

    if ($row_cnt > 0){
        $query_updateAcct = "UPDATE `tb_users` SET `is_active`= 1 WHERE `verification_token`='".$token."' AND `is_active` = 0"; 
        $con->query($query_updateAcct); 

        $_SESSION['message'] = "Email verification successful. You can now login.";
        echo $_SESSION['message'];
        
        //header("Location: https://motherchildcareportal.com/");
        //exit(0);       
    }

    elseif ($row_cnt == 0) {
        $_SESSION['message'] = "Email already verified, Continue to login. You can now login.";
        echo $_SESSION['message'];
        
        //exit(0);
    }

    else {
        $_SESSION['message'] = "Internal Server error.";
        echo $_SESSION['message'];
       
        //exit(0);
    }

    $con->close();  
?>