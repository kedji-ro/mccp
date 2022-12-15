<?php

include '../login/db_conn.php';

if (isset($_POST['edit_user'])) {

    $id = $_POST['euid'];
    $e = $_POST['eue'];
    $op = $_POST['euop'];
    $p = $_POST['eunp'];
    $cp = $_POST['eucp'];

    $chk = $con->query("SELECT 1 FROM tb_users WHERE password = MD5('".$op."') AND user_id = '".$id."'");
    $cnt = mysqli_num_rows($chk);

    if ($cnt == 0 && ($op != '' && $p != '')) {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Incorrect old password." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";

        header('Location: '.home.'/admin/?users');
        exit;
    }

    if ($cp != $p && ($op != '' && $p != '')) {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Passwords don't match." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";

        header('Location: '.home.'/admin/?users');
        exit;
    }

    $q = "";

    if ($op === '' && $p === '') {
        $q = "UPDATE tb_users SET email = '".$e."' WHERE user_id = '".$id."'";
    } else {
        $q = "UPDATE tb_users SET email = '".$e."', password = MD5('".$p."') WHERE user_id = '".$id."'";
    }

    $res = $con->query($q);

    if ($res) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "User settings updated.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: '.home.'/admin/?users');

    $con->error;
}

if (isset($_POST['add_service'])) {

    $serv = $_POST['ns'];

    $q = "INSERT INTO tb_services(srv_desc,srv_stat) VALUES('" . $serv . "','1')";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Service added.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?doctors');
    $con->close();
}

if (isset($_POST['archive_serv'])) {

    $id = $_POST['asrid'];

    $q = "UPDATE tb_services SET srv_stat = '0' WHERE serv_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        echo json_encode('Updated');
    } 

    $con->close();
}

if (isset($_POST['archive_spec'])) {

    $id = $_POST['asid'];

    $q = "UPDATE tb_specialization SET spec_stat = '0' WHERE spec_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        echo json_encode('Updated');
    } 

    $con->close();
}

if (isset($_POST['add_admin'])) {

    $e = $_POST['nae'];
    $p = $_POST['nap'];
    $fn = $_POST['nafn'];
    $mn = $_POST['namn'];
    $ln = $_POST['naln'];
    $sf = $_POST['nasf'];
    $pn = $_POST['napn'];
    $addr = $_POST['naaddr'];

    $q = "INSERT INTO tb_users (username, password, email, firstname, middlename, lastname, suffix, address, phone_no, is_active, role)
                    VALUES('".$e."',MD5('".$p."'),'".$e."','".$fn."','".$mn."','".$ln."','".$sf."','".$addr."', '".$pn."', '1', '1')";

    $res = $con->query($q);

    if ($res) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "New admin account created.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: '.home.'/admin/?users');

    $con->error;
}

if (isset($_POST['archive_user'])) {

    $id = $_POST['auid'];

    $q = "UPDATE tb_users SET is_active = '2' WHERE user_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "User archived.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?users');
    $con->close();
}

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

    header('Location: '.home.'/admin/?mothers');

    $con->error;
}

if (isset($_POST['edit_patient'])) {

    $id = $_POST['emid'];
    $fn = $_POST['emfn'];
    $mn = $_POST['emmn'];
    $ln = $_POST['emln'];
    $mens = $_POST['emmen'];
    $ms = $_POST['emms'];
    $dob = $_POST['emdob'];
    $pn = $_POST['empn'];
    $addr = $_POST['emaddr'];

    $q = "UPDATE tb_users SET firstname = '".$fn."', middlename = '".$mn."', lastname = '".$ln."', 
                              date_first_men_period = '".$mens."', marital_status = '".$ms."',
                              DOB = '".$dob."', phone_no = '".$pn."', address = '".$addr."' WHERE user_id = '".$id."'";

    $res = $con->query($q);

    if ($res) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Mother info edited.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: '.home.'/admin/?mothers');

    $con->error;
}

if (isset($_POST['archive_child'])) {

    $c_id = $_POST['arcid'];

    $q = "UPDATE tb_child_details SET ch_stat = '0' WHERE child_id = '" . $c_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Child info archived.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?children');
    $con->close();
}

if (isset($_POST['archive_mo'])) {

    $c_id = $_POST['aarmid'];

    $q = "UPDATE tb_users SET is_active = '0' WHERE user_id = '" . $c_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Mother info archived.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?mothers');
    $con->close();
}

if (isset($_POST['edit_child'])) {

    $c_id = $_POST['ch_id'];
    $cfn = $_POST['chfn'];
    $cmn = $_POST['chmn'];
    $cln = $_POST['chln'];
    $csf = $_POST['chsf'];
    $cdob = $_POST['chdob'];
    $chh = $_POST['chh'];
    $chw = $_POST['chw'];

    $q = "UPDATE tb_child_details SET firstname = '" . $cfn . "', middlename = '" . $cmn . "',
                              lastname = '" . $cln . "', suffix = '" . $csf . "', 
                              height = '" . $chh . "', weight = '" . $chw . "', dateofbirth = '" . $cdob . "'
                        WHERE child_id = '" . $c_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Child info edited.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?children');
    $con->close();
}

if (isset($_POST['deact_user'])) {

    $user_id = (isset($_POST['u_id'])) ? $_POST['u_id'] : $_POST['ur_id'];

    $check_active = "SELECT `is_active` FROM `tb_users` WHERE `user_id` =" . $user_id;
    $result = mysqli_query($con, $check_active);

    $num = mysqli_num_rows($result);

    if ($user_id == $_SESSION['U_ID']) {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "User is currently logged in.";
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";

        header('Location: ' . home . '/admin/?users');
        exit;
    }

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
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong.";
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?users');

    $con->close();
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
        
        $_SESSION['U_FULLNAME'] = $fn . ' ' . $mn . ' ' . $ln . ' ' . $sf;
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

if (isset($_POST['register_child'])) {

    $p_id = $_SESSION['U_ID'];
    $cfn = $_POST['rchfn'];
    $cmn = $_POST['rchmn'];
    $cln = $_POST['rchln'];
    $csf = $_POST['rchsf'];
    $cdob = $_POST['rchdob'];
    $chh = $_POST['rchh'];
    $chw = $_POST['rchw'];

    $q = "INSERT INTO tb_child_details (parent_id, firstname, middlename, lastname, suffix, height, weight, dateofbirth)
                        VALUES ('" . $p_id . "','" . $cfn . "','" . $cmn . "','" . $cln . "','" . $csf . "','" . $chh . "','" . $chw . "','" . $cdob . "')";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Child registered succcesfully.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/admin/?children');
    $con->close();
}

?>