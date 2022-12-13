<?php

include '../login/db_conn.php';

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

    header('Location: ' . home . '/patient/?children');
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

    header('Location: ' . home . '/patient/?children');
    $con->close();
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

    header('Location: ' . home . '/patient/?children');
    $con->close();
}

if (isset($_POST['create_appointment'])) {

    $pid = $_SESSION['U_ID'];
    $cid = $_POST['a_clinic'];
    $did = $_POST['a_doc'];
    $date = $_POST['aa_date'];
    $time = $_POST['a_time'];
    $desc =  $_POST['a_desc'];

    $s_id = $_POST['a_date'];
    $r_slots = $_POST['r_slots'];

    $ntime = substr($time, 0, 8);

    $dt = $date . ' ' . $ntime;

    $q = "INSERT INTO tb_appointment(patient_id, clinic_id, doctor_id, a_desc, appointment_date)
                              VALUES('".$pid."','".$cid."','".$did."','".$desc."','".$dt."')";

    $qus = "UPDATE tb_doctor_schedule SET taken_slots = (taken_slots - 1) WHERE schedule_id = '".$s_id."'";

    if ($r_slots != 0) {
        if (mysqli_query($con, $q)) {
            if (mysqli_query($con, $qus)) {
                $_SESSION['msg-h'] = "SUCCESS";
                $_SESSION['msg'] = "Successfully booked an appointment.";
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
        $_SESSION['msg'] = "No more slots available on the selected schedule." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }
    
    header('Location: ' . home . '/patient/?set-appointment');
    $con->close();
}

if (isset($_POST['cancel_appointment'])) {

    $id = $_POST['caid'];

    $q = "UPDATE tb_appointment SET a_stat = '3' WHERE appointment_id = '" . $id . "'";

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

    header('Location: ' . home . '/patient/?my-appointments');
    $con->close();
}

if (isset($_POST['resched_appointment'])) {

    $id = $_POST['raid'];
    $dt = $_POST['rad'] . ' ' . $_POST['rat'];

    $q = "UPDATE tb_appointment SET appointment_date = '" . $dt . "', a_stat = '0' WHERE appointment_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Appointment rescheduled.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/patient/?my-appointments');
    $con->close();
}

if (isset($_POST['pay_appointment'])) {

    $pid = $_SESSION['U_ID'];
    $id = $_POST['paid'];
    $mop = $_POST['pmop'];
    $ref = ($_POST['pref'] == '') ? null : $_POST['pref'];
    $amt = $_POST['pamt'];

    $q = "INSERT INTO tb_payment (patient_id, appt_id, payment_method, amount_paid, ref_no)
                VALUES ('" . $pid . "','" . $id . "','" . $mop . "','" . $amt . "','" . $ref . "')";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Payment sent.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/patient/?my-appointments');
    $con->close();
}

if (isset($_POST['request_transfer'])) {

    $pid = $_SESSION['U_ID'];
    $from = $_POST['d_from'];
    $to = $_POST['d_to'];

    $q = "INSERT INTO tb_requests (user_id, docfrom_id, docto_id)
                VALUES ('" . $pid . "','" . $from . "','" . $to . "')";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Information transfer request sent.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/patient/?req-info');
    $con->close();
}

if (isset($_POST['cancel_request'])) {

    $id = $_POST['crid'];

    $q = "UPDATE tb_requests SET req_stat = '2' WHERE req_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Transfer request cancelled.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/patient/?reqs');
    $con->close();
}

if (isset($_POST['save_profile'])) {

    $id = $_SESSION['U_ID'];
    //$em = $_POST['em'];
    $fn = $_POST['pfn'];
    $mn = $_POST['pmn'];
    $ln = $_POST['pln'];
    $men = $_POST['pmen'];
    $dob = $_POST['pdob'];
    $phone = $_POST['pno'];
    $ms = $_POST['pms'];
    $add = $_POST['padd'];


    $q = "UPDATE tb_users SET firstname = '" . $fn . "',
                              middlename ='" . $mn . "',
                              lastname = '" . $ln . "',
                              date_first_men_period = '" . $men . "',
                              DOB = '" . $dob . "',
                              phone_no = '" . $phone . "',
                              marital_status = '" . $ms . "',
                              address = '" . $add . "'  
                        WHERE user_id = '" . $id . "'";

    if (mysqli_query($con, $q)) {
        $_SESSION['msg-h'] = "SUCCESS";
        $_SESSION['msg'] = "Profile updated.";
        $_SESSION['msg-t'] = "success";
        $_SESSION['msg-bg'] = "#e8fae9";

        $_SESSION['FULLNAME'] = $fn . ' ' . $mn . ' ' . $ln;
    } else {
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-type'] = "danger";
        $_SESSION['msg-bg'] = "#fae8ea";
    }

    header('Location: ' . home . '/patient/?my-profile');
    $con->close();
}

?>