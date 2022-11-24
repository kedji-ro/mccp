<?php

include '../login/db_conn.php';

if (isset($_POST['deact_user'])) {

    $user_id = (isset($_POST['u_id'])) ? $_POST['u_id'] : $_POST['ur_id'];
    // $user_rid = (isset($_POST['ur_id'])) ? $_POST['ur_id'] : "";

    $check_active = "SELECT `is_active` FROM `tb_users` WHERE `user_id` =" . $user_id;
    $result = mysqli_query($con, $check_active);

    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['is_active'] == '1') {
            $q = "UPDATE `tb_users` SET `is_active`='0' WHERE `user_id` =" . $user_id;
            $update_run = mysqli_query($con, $q);

            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "User deactivated.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
        } else {
            $q = "UPDATE `tb_users` SET `is_active`='1' WHERE `user_id` =" . $user_id;
            $update_run = mysqli_query($con, $q);

            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "User reactivated.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
        }

        header("Location: https://motherchildcareportal.com/admin/?users");
    } else {
        echo $con->error;
        echo 'error';
    }
}


if (isset($_POST['add_clinic'])) {

    $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
    $c_add = mysqli_real_escape_string($con, $_POST['c_address']);
    $c_phone = mysqli_real_escape_string($con, $_POST['c_phoneno']);
    $c_tel = mysqli_real_escape_string($con, $_POST['c_telno']);

    $q = "INSERT INTO `tb_clinic`(`clinic_name`, `clinic_address`, `contact_no`, `tel_no`, `c_stat`) 
             VALUES ('" . $c_name . "','" . $c_add . "', '" . $c_phone . "','" . $c_tel . "','1')";

    $qq = "INSERT INTO `tb_doctor_clinics`(`doctor_id`, `clinic_id`, `dc_stat`)
    VALUES ('" . $_SESSION['DOC_ID'] . "',LAST_INSERT_ID(),'1')";

    $query_run = mysqli_query($con, $q);

    if ($query_run) {
        $query_run = mysqli_query($con, $qq);
        if ($query_run) {
            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "Clinic added.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
        } else {
            $_SESSION['msg-h'] = "ERROR";
            $_SESSION['msg'] = "Something went wrong." . $con->error;
            $_SESSION['msg-t'] = "danger";
            $_SESSION['msg-bg'] = "#fae8ea";
        }
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong."  . $con->error;
        $_SESSION['msg-t'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: https://motherchildcareportal.com/admin/?clinics');
    $con->close();
}

if (isset($_POST['edit_clinic'])) {

    $c_id = mysqli_real_escape_string($con, $_POST['c_id']);
    $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
    $c_add = mysqli_real_escape_string($con, $_POST['c_address']);
    $c_phone = mysqli_real_escape_string($con, $_POST['c_phoneno']);
    $c_tel = mysqli_real_escape_string($con, $_POST['c_telno']);

    $q = "UPDATE tb_clinic SET clinic_name = '".$c_name."',
                               clinic_address = '".$c_add."', 
                               contact_no = '".$c_phone."', 
                               tel_no = '".$c_tel."' WHERE clinic_id = '".$c_id."'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Clinic information updated.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-t'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: https://motherchildcareportal.com/admin/?clinics');
    $con->close();
}

if (isset($_POST['deactreact_clinic'])) {

    $c_id = $_POST['c_drid'];
    $c_stat = $_POST['c_stat'];
    $stat = ($c_stat == 'Active') ? 0 : 1;

    $q = "UPDATE tb_clinic SET c_stat = '".$stat."' WHERE clinic_id = '" . $c_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = ($stat == '0') ? "Clinic deactivated." : "Clinic reactivated.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: https://motherchildcareportal.com/admin/?clinics');
    $con->close();
}

?>
