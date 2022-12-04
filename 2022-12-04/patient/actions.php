<?php

include '../login/db_conn.php';

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

    header('Location: http://localhost:8080/mccp/doctor/?patient-transfer');
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
    VALUES ('" . $_SESSION['D_ID'] . "',LAST_INSERT_ID(),'1')";

    if ($c_id > -1) {
        $check = $con->query("SELECT 1 FROM tb_doctor_clinics WHERE clinic_id = '" . $c_id . "' AND  doctor_id = '" . $_SESSION['D_ID'] . "'");
        $c_count = mysqli_num_rows($check);

        if ($c_count <= 0) {
            $q = "INSERT INTO `tb_doctor_clinics`(`doctor_id`, `clinic_id`, `dc_stat`)
            VALUES ('" . $_SESSION['D_ID'] . "', '" . $c_id . "','1')";
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

    header('Location: http://localhost:8080/mccp/doctor/?clinics');
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

    header('Location: http://localhost:8080/mccp/doctor/?clinics');
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

    header('Location: http://localhost:8080/mccp/doctor/?clinics');
    $con->close();
}

if (isset($_POST['approvedeny_appointment'])) {

    $a_id = $_POST['am_id'];
    $a_stat = $_POST['am_appstat'];

    $q = "UPDATE tb_appointment SET a_stat = '".$a_stat."' WHERE appointment_id = '" . $a_id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = ($a_stat == '1') ? "Appointment request approved." : "Appointment request denied.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: http://localhost:8080/mccp/doctor/?appointments');
    $con->close();
}

if (isset($_POST['cancel_appointment'])) {

    $a_id = $_POST['cam_id'];

    $q = "UPDATE tb_appointment SET a_stat = '2' WHERE appointment_id = '" . $a_id . "'";

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

    header('Location: http://localhost:8080/mccp/doctor/?appointments');
    $con->close();
}

if (isset($_POST['add_schedule'])) {

    $d_id = $_SESSION['D_ID'];
    $clinic = $_POST['sm_clinic'];
    $date = $_POST['sm_date'];
    $color = $_POST['sm_color'];
    $start = $_POST['sm_st'];
    $end = $_POST['sm_et'];
    

    $q = "INSERT INTO tb_doctor_schedule (doctor_id, clinic_id, date_available, start_time, end_time, bg_color, s_stat)
                        VALUES ('".$d_id."','".$clinic."','".$date."','".$start."','".$end."','".$color."','1')";

    if (mysqli_query($con,$q)) {
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

    header('Location: http://localhost:8080/mccp/doctor/?schedule');
    $con->close();
}

if (isset($_POST['edit_schedule'])) {

    $sid = $_POST['esid'];
    $clinic = $_POST['escl'];
    $date = $_POST['esd'];
    $color = $_POST['esc'];
    $start = $_POST['esst'];
    $end = $_POST['eset'];
    

    $q = "UPDATE tb_doctor_schedule SET clinic_id = '".$clinic."', date_available = '".$date."' ,
                                        start_time = '".$start."', end_time = '".$end."', bg_color = '".$color."' 
                                        WHERE schedule_id = '".$sid."'";

    if (mysqli_query($con,$q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Schedule updated successfully.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: http://localhost:8080/mccp/doctor/?schedule');
    $con->close();
}

if (isset($_POST['deactivate_sched'])) {

    $s_id = $_POST['sid'];
    
    $q = "UPDATE tb_doctor_schedule SET s_stat = 0 WHERE schedule_id = '".$s_id."'";

    if (mysqli_query($con,$q)) {
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

    header('Location: http://localhost:8080/mccp/doctor/?schedule');
    $con->close();
}

if (isset($_POST['resched_appointment'])) {

    $sid = $_POST['raid'];
    $sd = $_POST['rad'];
    $st = $_POST['rat'];
    
    $newad = $sd .' '. $st;
    
    $q = "UPDATE tb_appointment SET appointment_date = '".$newad."' WHERE appointment_id = '".$sid."'";

    if (mysqli_query($con,$q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Appointment rescheduled successfully.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: http://localhost:8080/mccp/doctor/?appointments');
    $con->close();
}

if (isset($_POST['request_info'])) {

    $aid = $_POST['arid'];

    $q = "INSERT INTO tb_appointment(doctor_id, clinic_id, original_id, appointment_date, doctor_remarks, a_stat, date_logged, req_by_id, a_desc)
                              SELECT doctor_id, clinic_id, appointment_id, appointment_date, doctor_remarks, 4, '" . $datetime . "', " . $_SESSION['D_ID'] . ", a_desc 
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

    header('Location: http://localhost:8080/mccp/doctor/?patient-transfer');
    $con->close();
}

?>
