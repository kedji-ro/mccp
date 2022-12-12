<?php

include '../login/db_conn.php';

if (isset($_POST['load_doctors'])) {

    $cid = $_POST['clid'];

    $q = $con->query("SELECT DISTINCT user_id, CONCAT(IFNULL(firstname,''),' ',IFNULL(middlename,''),' ',IFNULL(lastname,''),' ',IFNULL(suffix,'')) AS doc_name FROM tb_users tu
                LEFT JOIN tb_doctor_clinics tdc ON tdc.doctor_id = tu.user_id
                WHERE tu.role = 2 AND tdc.clinic_id = '" . $cid . "'");

    $docs = array();
    while ($r = mysqli_fetch_assoc($q)) {
        $docs[] = $r;
    }

    echo json_encode($docs);
    $con->close();
}

if (isset($_POST['load_clinic'])) {

    $cid = $_POST['cl_id'];

    $q = $con->query("SELECT * from tb_clinic WHERE clinic_id = '" . $cid . "'");

    $clinic = array();
    while ($r = mysqli_fetch_assoc($q)) {
        $clinic[] = $r;
    }
    
    echo json_encode($clinic);
    $con->close();
}

if (isset($_POST['load_doc_details'])) {

    $did = $_POST['did'];

    $q = $con->query("SELECT DISTINCT user_id, CONCAT(IFNULL(firstname,''),' ',IFNULL(middlename,''),' ',IFNULL(lastname,''),' ',IFNULL(suffix,'')) AS docs_name, s_desc, doc_services FROM tb_users tu
                INNER JOIN tb_doctor_clinics tdc ON tdc.doctor_id = tu.user_id
                LEFT JOIN tb_specialization ts ON ts.spec_id = tu.spec_id
                WHERE tu.role = 2 AND tu.user_id = '" . $did . "'");

    $docd = array();
    while ($r = mysqli_fetch_assoc($q)) {
        $docd[] = $r;
    }

    echo json_encode($docd);
    $con->close();
}


if (isset($_POST['load_dates'])) {
    $did = $_POST['d_id'];

    $q = $con->query("SELECT DISTINCT tds.date_available FROM tb_doctor_schedule tds WHERE tds.doctor_id = '" . $did . "' AND tds.taken_slots <= tds.slots");

    $dates = array();
    while ($r = mysqli_fetch_assoc($q)) {
        $dates[] = $r;
    }

    echo json_encode($dates);
    $con->close();
}

?>