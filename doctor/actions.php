<?php

include '../login/db_conn.php';

if (isset($_POST['archive_sec'])) {

    $id = $_POST['sec_id'];

    $q = "UPDATE tb_users SET is_active = '0' WHERE user_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        echo json_encode('Updated');
    } 

    $con->close();
}

if (isset($_POST['add_sec'])) {

    $e = $_POST['nae'];
    $p = $_POST['nap'];
    $fn = $_POST['nafn'];
    $mn = $_POST['namn'];
    $ln = $_POST['naln'];
    $sf = $_POST['nasf'];
    $pn = $_POST['napn'];
    $addr = $_POST['naaddr'];

    $q = "INSERT INTO tb_users (username, password, email, firstname, middlename, lastname, suffix, address, phone_no, is_active, role, sec_docid)
                    VALUES('".$e."',MD5('".$p."'),'".$e."','".$fn."','".$mn."','".$ln."','".$sf."','".$addr."', '".$pn."', '1', '4', '".$_SESSION['U_ID']."')";

    $res = $con->query($q);

    if ($res) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "New secretary account created.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: '.home.'/doctor/?profile');

    $con->error;
}

if (isset($_POST['transfer_patient'])) {

    $apt_id = $_POST['tp_aid'];
    $c_id = $_POST['tp_toclinic'];

    $q = "UPDATE tb_appointment SET clinic_id = '" . $c_id . "' WHERE appointment_id = '" . $apt_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Patient transfered.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?patient-transfer');
    $con->close();
}

if (isset($_POST['upload'])) {

    $c_id = $_SESSION['U_ID'];

    $q = "";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "ID uploaded.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?profile');
    $con->close();
}

if (isset($_POST['add_clinic'])) {

    $c_id = $_POST['c_eid'];
    $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
    $c_add = mysqli_real_escape_string($con, $_POST['c_address']);
    $c_phone = mysqli_real_escape_string($con, $_POST['c_phoneno']);
    $c_tel = mysqli_real_escape_string($con, $_POST['c_telno']);

    $q = "INSERT INTO `tb_clinic`(`clinic_name`, `clinic_address`, `contact_no`, `tel_no`, `c_stat`) 
             VALUES ('" . $c_name . "','" . $c_add . "', '" . $c_phone . "','" . $c_tel . "','1')";

    $qq = "INSERT INTO `tb_doctor_clinics`(`doctor_id`, `clinic_id`, `dc_stat`)
    VALUES ('" . $_SESSION['U_ID'] . "',LAST_INSERT_ID(),'1')";

    if ($c_id > -1) {
        $check = $con->query("SELECT 1 FROM tb_doctor_clinics WHERE clinic_id = '" . $c_id . "' AND  doctor_id = '" . $_SESSION['U_ID'] . "'");
        $c_count = mysqli_num_rows($check);

        if ($c_count <= 0) {
            $q = "INSERT INTO `tb_doctor_clinics`(`doctor_id`, `clinic_id`, `dc_stat`)
            VALUES ('" . $_SESSION['U_ID'] . "', '" . $c_id . "','1')";
            if (mysqli_query($con, $q)) {
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
            $_SESSION['msg'] = "You are already in this clinic." . $con->error;
            $_SESSION['msg-t'] = "danger";
            $_SESSION['msg-bg'] = "#fae8ea";
        }
    } else {
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
    }

    header('Location: ' . home . '/doctor/?clinics');
    $con->close();
}

if (isset($_POST['edit_clinic'])) {

    $c_id = mysqli_real_escape_string($con, $_POST['c_id']);
    $c_name = mysqli_real_escape_string($con, $_POST['c_name']);
    $c_add = mysqli_real_escape_string($con, $_POST['c_address']);
    $c_phone = mysqli_real_escape_string($con, $_POST['c_phoneno']);
    $c_tel = mysqli_real_escape_string($con, $_POST['c_telno']);

    $q = "UPDATE tb_clinic SET clinic_name = '" . $c_name . "',
                               clinic_address = '" . $c_add . "', 
                               contact_no = '" . $c_phone . "', 
                               tel_no = '" . $c_tel . "' WHERE clinic_id = '" . $c_id . "'";

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

    header('Location: ' . home . '/doctor/?clinics');
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

    header('Location: ' . home . '/doctor/?clinics');
    $con->close();
}

if (isset($_POST['complete_appointment'])) {

    $a_id = $_POST['cacid'];
    $a_stat = $_POST['am_appstat'];

    $q = "UPDATE tb_appointment SET a_stat = '1' WHERE appointment_id = '" . $a_id . "'";
    $qn = "INSERT INTO tb_notifs(user_id, n_desc, is_read, date_logged)
            SELECT ta.patient_id, CONCAT('Appointment No. ', ta.appointment_id ,' has been completed.'),'0', '" . $datetime . "' FROM tb_appointment ta WHERE appointment_id = '" . $a_id . "'";

    if (mysqli_query($con, $q)) {
        if (mysqli_query($con, $qn)) {
            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "Appointment marked as complete.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
        }
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?appointments=1');
    $con->close();
}

if (isset($_POST['cancel_appointment'])) {

    $a_id = $_POST['cam_id'];

    $q = "UPDATE tb_appointment SET a_stat = '2' WHERE appointment_id = '" . $a_id . "'";
    $qn = "INSERT INTO tb_notifs(user_id, n_desc, is_read, date_logged)
            SELECT ta.patient_id, CONCAT('Appointment No. ', ta.appointment_id ,' has been cancelled.'),'0', '" . $datetime . "' FROM tb_appointment ta WHERE appointment_id = '" . $a_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Appointment cancelled.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?appointments=1');
    $con->close();
}

if (isset($_POST['add_schedule'])) {

    $d_id = $_SESSION['U_ID'];
    $clinic = $_POST['sm_clinic'];
    $date = $_POST['sm_date'];
    $color = $_POST['sm_color'];
    $start = $_POST['sm_st'];
    $end = $_POST['sm_et'];
    $slots = $_POST['smsls'];

    $days = $_POST['sdays'];

    $arr = [];
    for ($i = 0; $i < strlen($days); $i++) {
        $arr[$i] = $days[$i];
    }

    $rdays = implode(',',  $arr);

    $q = "INSERT INTO tb_doctor_schedule (doctor_id, clinic_id, date_available, start_time, end_time, bg_color, s_stat, slots,days_available, taken_slots)
                        VALUES ('" . $d_id . "','" . $clinic . "','" . $date . "','" . $start . "','" . $end . "','" . $color . "','1','" . $slots . "','" . $rdays . "','" . $slots . "')";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Schedule added.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?schedule');
    $con->close();
}

if (isset($_POST['edit_schedule'])) {

    $sid = $_POST['esid'];
    $clinic = $_POST['escl'];
    $date = $_POST['esd'];
    $color = $_POST['esc'];
    $start = $_POST['esst'];
    $end = $_POST['eset'];
    $slots = $_POST['smslse'];

    $days = $_POST['esdays'];

    $arr = [];
    for ($i = 0; $i < strlen($days); $i++) {
        $arr[$i] = $days[$i];
    }

    $rdays = implode(',',  $arr);

    $q = "UPDATE tb_doctor_schedule SET clinic_id = '" . $clinic . "', date_available = '" . $date . "' ,
                                        start_time = '" . $start . "', end_time = '" . $end . "', bg_color = '" . $color . "' ,
                                        slots = '" . $slots . "', taken_slots = '" . $slots . "',
                                        days_available = '" . $rdays . "'
                                        WHERE schedule_id = '" . $sid . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Schedule updated successfully." . $daysofweek . ' ' . $rdays;
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?schedule');
    $con->close();
}

if (isset($_POST['deactivate_sched'])) {

    $s_id = $_POST['sid'];

    $q = "UPDATE tb_doctor_schedule SET s_stat = 0 WHERE schedule_id = '" . $s_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Schedule deactivated.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?schedule');
    $con->close();
}

if (isset($_POST['save_notes'])) {

    $id = $_POST['an_id'];
    $dr = $_POST['alp_drem'];

    $q = "UPDATE tb_appointment SET doctor_remarks = '" . $dr . "' WHERE appointment_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Notes Added.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?appointments');
    $con->close();
}

if (isset($_POST['resched_appointment'])) {

    $sid = $_POST['raid'];
    $sd = $_POST['rad'];
    $st = $_POST['rat'];

    $newad = $sd . ' ' . $st;

    $q = "UPDATE tb_appointment SET appointment_date = '" . $newad . "', a_stat = '0' WHERE appointment_id = '" . $sid . "'";
    $qn = "INSERT INTO tb_notifs(user_id, n_desc, is_read, date_logged)
            SELECT ta.patient_id, CONCAT('Appointment No. ', ta.appointment_id ,' has been rescheduled on ','" . $newad . ".'),'0', '" . $datetime . "' FROM tb_appointment ta WHERE appointment_id = '" . $sid . "'";

    if (mysqli_query($con, $q)) {
        if (mysqli_query($con, $qn)) {
            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "Appointment rescheduled successfully.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
        }
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?appointments=1');
    $con->close();
}

if (isset($_POST['request_info'])) {

    $aid = $_POST['arid'];

    $q = "INSERT INTO tb_appointment(doctor_id, clinic_id, original_id, appointment_date, doctor_remarks, a_stat, date_logged, req_by_id, a_desc)
                              SELECT doctor_id, clinic_id, appointment_id, appointment_date, doctor_remarks, 4, '" . $datetime . "', " . $_SESSION['U_ID'] . ", a_desc 
                              FROM tb_appointment WHERE appointment_id = " . $aid;

    if (mysqli_query($con, $q)) {
        $qr = "UPDATE tb_appointment SET a_stat = 4 WHERE appointment_id = " . $aid;
        if (mysqli_query($con, $qr)) {
            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "Patient info request sent.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
        } else {
            $_SESSION['msg-h'] = "ERROR";
            $_SESSION['msg'] = "Something went wrong." . $con->error;
            $_SESSION['msg-type'] = "danger";
            $_SESSION['msg-bg'] = "#fae8ea";
        }
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?patient-transfer');
    $con->close();
}

if (isset($_POST['save_profile'])) {

    $user = mysqli_real_escape_string($con, $_POST['u_user']);
    $fn = mysqli_real_escape_string($con, $_POST['u_fname']);
    $mn = mysqli_real_escape_string($con, $_POST['u_mname']);
    $ln = mysqli_real_escape_string($con, $_POST['u_lname']);
    $sufx = mysqli_real_escape_string($con, $_POST['u_sufx']);
    $dob = mysqli_real_escape_string($con, $_POST['u_dob']);
    $add = mysqli_real_escape_string($con, $_POST['u_add']);
    $phone = mysqli_real_escape_string($con, $_POST['u_phone']);
    $license = mysqli_real_escape_string($con, $_POST['u_lic']);
    $spec = mysqli_real_escape_string($con, $_POST['u_spec']);
    $title = mysqli_real_escape_string($con, $_POST['u_title']);

    $q_user = "UPDATE `tb_users` SET `username`='" . $user . "'
                                    ,`firstname`='" . $fn . "',`middlename`='" . $mn . "',`lastname`='" . $ln . "',`suffix`='" . $sufx . "'
                                    ,license_no = '" . $license . "', spec_id = '" . $spec . "', title = '" . $title . "'
                                    ,`DOB`='" . $dob . "',`address`='" . $add . "',`phone_no`='" . $phone . "' WHERE `user_id` = '" . $_SESSION['U_ID'] . "'";

    if (mysqli_query($con, $q_user)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Profile updated.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";

        $_SESSION['FULLNAME'] = $fn . ' ' . $mn . ' ' . $ln . ' ' . $sufx;
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?profile');

    $con->close();
}

if (isset($_POST['deny_req'])) {

    $id = $_POST['drid'];

    $q = "UPDATE tb_requests SET req_stat = '2' WHERE req_id = '" . $id . "'";
    $qn = "INSERT INTO tb_notifs(user_id, n_desc, is_read, date_logged)
            SELECT tr.user_id, CONCAT('Your Info Transfer Request No. ', tr.id ,' has been denied.') ,'0', '" . $datetime . "' FROM tb_requests tr WHERE req_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        if (mysqli_query($con, $qn)) {
            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "Request denied.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
        }
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?patient-transfer');
    $con->close();
}

if (isset($_POST['approve_req'])) {

    $id = $_POST['aridm'];

    $q = "UPDATE tb_requests SET req_stat = '1' WHERE req_id = '" . $id . "'";
    $qn = "INSERT INTO tb_notifs(user_id, n_desc, is_read, date_logged)
            SELECT tr.user_id, CONCAT('Your Info Transfer Request No. ', tr.id ,' has been approved.') ,'0', '" . $datetime . "' FROM tb_requests tr WHERE req_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        if (mysqli_query($con, $qn)) {
            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg'] = "Request approved.";
            $_SESSION['msg-t'] = "success";
            $_SESSION['msg-bg'] = "#e8fae9";
        }
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?patient-transfer');
    $con->close();
}

if (isset($_POST['archive_serv'])) {

    $id = $_POST['id'];

    $q = "UPDATE tb_doctor_services SET sd_stat = '0' WHERE sd_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        echo json_encode('Updated');
    } 

    $con->close();
}

if (isset($_POST['add_service'])) {

    $sid = $_POST['nss'];
    $serv = $_POST['ns'];

    $q = '';
    $q2 = '';

    if ($sid == '') {
        $q = "INSERT INTO tb_services(srv_desc,srv_stat) VALUES('" . $serv . "','1')";
        $q2 = "INSERT INTO tb_doctor_services(doc_id, sev_is, sd_stat) VALUES ('" . $_SESSION['U_ID'] . "',LAST_INSERT_ID(),'1')";
    } else {
        $check = $con->query("SELECT 1 FROM tb_doctor_services WHERE sev_is ='" . $sid . "'");
        $cnt = mysqli_num_rows($check);

        if ($cnt > 0) {
            $_SESSION['msg-h'] = "ERROR";
            $_SESSION['msg'] = "You already have this service.";
            $_SESSION['msg-type'] = "danger";
            $_SESSION['msg-bg'] = "#fae8ea";

            header('Location: ' . home . '/doctor/?profile');
            exit;
        }

        $q2 = "INSERT INTO tb_doctor_services(doc_id, sev_is, sd_stat) VALUES ('" . $_SESSION['U_ID'] . "','" . $sid . "','1')";
    }

    if ($sid == '') {
        if (mysqli_query($con, $q)) {
            if (mysqli_query($con, $q2)) {
                $_SESSION['msg-h'] = "SUCCESS";
                $_SESSION['msg'] = "Service added.";
                $_SESSION['msg-t'] = "success";
                $_SESSION['msg-bg'] = "#e8fae9";
            }
        } else {
            $_SESSION['msg-h'] = "ERROR";
            $_SESSION['msg'] = "Something went wrong." . $con->error;
            $_SESSION['msg-type'] = "danger";
            $_SESSION['msg-bg'] = "#fae8ea";
        }
    } else {
        if (mysqli_query($con, $q2)) {
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
    }

    header('Location: ' . home . '/doctor/?profile');
    $con->close();
}

if (isset($_FILES['lic_img']['name'])) {

    $id = $_SESSION['U_ID'];

    $img_name = $_FILES['lic_img']['name'];
    $img_tempname = $_FILES['lic_img']['tmp_name'];
    $img_size = $_FILES['lic_img']['size'];
    $folder = "../assets/img/uploads/licenses/" . $img_name;

    $q = "UPDATE tb_users SET license_img = '" . $img_name . "' WHERE user_id = '" . $id . "'";

    if ($img_size != 0) {
        if (mysqli_query($con, $q)) {
            if (move_uploaded_file($img_tempname, $folder)) {
                $_SESSION['msg-h'] = "SUCCESS";
                $_SESSION['msg'] = "License image updated.";
                $_SESSION['msg-t'] = "success";
                $_SESSION['msg-bg'] = "#e8fae9";
            }
        } else {
            $_SESSION['msg-h'] = "ERROR";
            $_SESSION['msg'] = "Something went wrong." . $con->error;
            $_SESSION['msg-type'] = "danger";
            $_SESSION['msg-bg'] = "#fae8ea";
        }
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "No file is selected.";
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/doctor/?profile');
    $con->close();
}
