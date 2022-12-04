<?php

include '../login/db_conn.php';

if (isset($_POST['deact_user'])) {

    $user_id = (isset($_POST['u_id'])) ? $_POST['u_id'] : $_POST['ur_id'];

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

        header('Location: ' . home . '/admin/?users');
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
    $open = $_POST['co'];
    $close = $_POST['cc'];

    $q = "INSERT INTO `tb_clinic`(`clinic_name`, `clinic_address`, `contact_no`, `tel_no`, `c_stat`, open_time, close_time) 
             VALUES ('" . $c_name . "','" . $c_add . "', '" . $c_phone . "','" . $c_tel . "','1', '" . $open . "', '" . $close . "')";

    $qq = "INSERT INTO `tb_doctor_clinics`(`doctor_id`, `clinic_id`, `dc_stat`)
    VALUES ('" . $_SESSION['U_ID'] . "',LAST_INSERT_ID(),'1')";

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

    header('Location: ' . home . '/admin/?clinics');
    $con->close();
}

if (isset($_POST['edit_clinic'])) {

    $c_id = mysqli_real_escape_string($con, $_POST['c_id']);
    $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
    $c_add = mysqli_real_escape_string($con, $_POST['c_address']);
    $c_phone = mysqli_real_escape_string($con, $_POST['c_phoneno']);
    $c_tel = mysqli_real_escape_string($con, $_POST['c_telno']);
    $open = $_POST['co'];
    $close = $_POST['cc'];

    $q = "UPDATE tb_clinic SET clinic_name = '" . $c_name . "',
                               clinic_address = '" . $c_add . "', 
                               contact_no = '" . $c_phone . "', 
                               tel_no = '" . $c_tel . "',
                               open_time = '" . $open . "',
                               close_time = '" . $close . "' WHERE clinic_id = '" . $c_id . "'";

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

    header('Location: ' . home . '/admin/?clinics');
    $con->close();
}

if (isset($_POST['deactreact_clinic'])) {

    $c_id = $_POST['c_drid'];
    $c_stat = $_POST['c_stat'];
    $stat = ($c_stat == 'Active') ? 0 : 1;

    $q = "UPDATE tb_clinic SET c_stat = '" . $stat . "' WHERE clinic_id = '" . $c_id . "'";

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

    header('Location: ' . home . '/admin/?clinics');
    $con->close();
}

if (isset($_POST['archive_clinic'])) {

    $c_id = $_POST['carid'];

    $q = "UPDATE tb_clinic SET c_stat = '2' WHERE clinic_id = '" . $c_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Clinic archived.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?clinics');
    $con->close();
}

if (isset($_POST['archive_clinic'])) {

    $c_id = $_POST['caid'];

    $q = "UPDATE tb_clinic SET c_stat = '4' WHERE clinic_id = '" . $c_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Clinic archived";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?clinics');
    $con->close();
}

if (isset($_POST['edit_profile'])) {

    $id = $_POST['aid'];
    $fn = $_POST['afn'];
    $mn = $_POST['amn'];
    $ln = $_POST['aln'];
    $sf = $_POST['asf'];
    $email = $_POST['ae'];
    $phone = $_POST['ap'];
    $addr = $_POST['aaddr'];

    $q = "UPDATE tb_users SET firstname = '" . $fn . "', middlename = '" . $mn . "', lastname = '" . $ln . "', suffix = '" . $sf . "'
                            , email = '" . $email . "', phone_no = '" . $phone . "', address = '" . $addr . "' WHERE user_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Profile update.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?dashboard');
    $con->close();
}

if (isset($_POST['add_doctor'])) {

    $fn = $_POST['r_fn'];
    $mn = $_POST['r_mn'];
    $ln = $_POST['r_ln'];
    $sf = $_POST['r_sn'];
    $addr = $_POST['r_addr'];
    $dob = $_POST['r_dob'];
    $phone = $_POST['r_phone'];
    $tel = $_POST['r_tel'];
    $lic = $_POST['r_lic'];
    $spec = $_POST['r_spec'];
    $ti = $_POST['r_ti'];
    $email = $_POST['r_email'];
    $pass = $_POST['r_pass'];
    $re_pass = $_POST['r_repass'];

    // Validate if email is unique/not yet registered
    $q = "SELECT 1 FROM tb_users WHERE email = '" . $email . "' LIMIT 1";
    $res = mysqli_query($con, $q);

    $email_count = mysqli_num_rows($res);

    if ($email_count > 0) {
        $_SESSION['msg'] = "Email already exist.";
        $_SESSION['msg-h'] = "NOTICE";
        $_SESSION['msg-t'] = "danger";

        header('Location: ' . home . '/admin/?doctors');
        exit(0);
    }

    if ($re_pass !== $pass) {
        $_SESSION['msg'] = "Passwords don't match.";
        $_SESSION['msg-h'] = "NOTICE";
        $_SESSION['msg-t'] = "danger";

        header('Location: ' . home . '/admin/?doctors');
        exit(0);
    }

    $qry = "INSERT INTO `tb_users`(`username`, `password`, `email`, 
                                    `firstname`, `middlename`, `lastname`, `suffix`, 
                                    `DOB`, `address`, `phone_no`,  `tel_no`, `license_no`, 
                                    `spec_id`, `title`, `role`,`is_active`, `registration_date`)
                        VALUES ('" . $email . "',
                            MD5('" . $pass . "'),
                                '" . $email . "',
                                '" . $fn . "',
                                '" . $mn . "',
                                '" . $ln . "',
                                '" . $sf . "',
                                '" . $dob . "',
                                '" . $addr . "', 
                                '" . $phone . "',
                                '" . $tel . "', 
                                '" . $lic . "',
                                '" . $spec . "',
                                '" . $ti . "',
                                2, 
                                1,
                                '" . $datetime . "')";

    $result = mysqli_query($con, $qry);

    if ($result) {
        $_SESSION['msg'] = "Doctor added.";
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg-t'] = "success";
    } else {
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg-t'] = "danger";

        echo $con->error;
    }

    header('Location: ' . home . '/admin/?doctors');

    $con->close();
}

if (isset($_POST['add_specialization'])) {

    $spec = $_POST['nspec'];

    $q = "INSERT INTO `tb_specialization`(s_desc) 
             VALUES ('" . $spec . "')";

    $query_run = mysqli_query($con, $q);

    if ($query_run) {
            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "New specialization added.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong."  . $con->error;
        $_SESSION['msg-t'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?doctors');
    $con->close();
}

if (isset($_POST['archive_doctor'])) {

    $did = $_POST['adid'];

    $q = "UPDATE tb_users SET is_active = 2 WHERE user_id = '".$did."'";

    $query_run = mysqli_query($con, $q);

    if ($query_run) {
            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "Doctor archived.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong."  . $con->error;
        $_SESSION['msg-t'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?doctors');
    $con->close();
}

?>