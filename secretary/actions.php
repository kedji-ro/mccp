<?php

include '../login/db_conn.php';

if (isset($_POST['register_patient'])) {

    $pe = $_POST['em'];
    $ppass = $_POST['ppass'];
    $pfn = $_POST['pfn'];
    $pmn = $_POST['pmn'];
    $pln = $_POST['pln'];
    $pmen = $_POST['pmen'];
    $pms = $_POST['pms'];
    $pdob = $_POST['pdob'];
    $pphone = $_POST['pno'];
    $paddr = $_POST['padd'];

    $q = "INSERT INTO tb_users (username, password, email, firstname, middlename, lastname, DOB, address, phone_no, date_first_men_period, role, marital_status, is_active)
                    VALUES('".$pe."',MD5('".$ppass."'),'".$pe."','".$pfn."','".$pmn."','".$pln."','".$pdob."','".$paddr."','".$pphone."','".$pmen."','3','".$pms."', '1')";

    $res = $con->query($q);

    if ($res) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Registration successful.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: '.home.'/secretary/?reg-patient');

    $con->error;
}

?>
