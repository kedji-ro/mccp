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

if (isset($_POST['load_services'])) {

    $did = $_POST['did'];

    $q = $con->query("SELECT srv_desc FROM tb_doctor_services tds INNER JOIN tb_services ts ON tds.sev_is = ts.serv_id WHERE tds.sd_stat = 1 AND tds.doc_id = '" . $did . "'");

    $serv = [];
    $srv = [];
    while ($r = mysqli_fetch_assoc($q)) {
        $srv['i'] = $r['srv_desc'];
        $serv[] = $srv;
    }

    echo json_encode($serv);
    $con->close();
}


if (isset($_POST['load_dates'])) {
    $did = $_POST['d_id'];

    $q = $con->query("SELECT DISTINCT tds.date_available, tds.schedule_id FROM tb_doctor_schedule tds WHERE tds.s_stat = 1 AND tds.doctor_id = '" . $did . "'");

    $dates = array();
    while ($r = mysqli_fetch_assoc($q)) {
        $dates[] = $r;
    }

    echo json_encode($dates);
    $con->close();
}

if (isset($_POST['load_slots'])) {
    $did = $_POST['s_id'];

    $q = $con->query("SELECT DISTINCT (tds.slots - tds.taken_slots) as taken_slots FROM tb_doctor_schedule tds WHERE tds.schedule_id = '" . $did . "'");

    $slots = array();
    while ($r = mysqli_fetch_assoc($q)) {
        $slots[] = $r;
    }

    echo json_encode($slots);
    $con->close();
}

if (isset($_POST['load_time'])) {
    $did = $_POST['s_id'];

    $q = $con->query("SELECT start_time, end_time FROM tb_doctor_schedule tds WHERE tds.schedule_id = '" . $did . "'");
    $r = mysqli_fetch_assoc($q);

    $time = array();

    $stinit = intval(str_replace(':', '', $r['start_time']));
    $etinit = intval(str_replace(':', '', $r['end_time']));

    $nstart = $stinit;
    $sin = false;

    for ($i = $stinit + 10000 ; $i < $etinit; $i += 10000) {
        $nstart += 10000;
        $nnstart = $nstart + 10000;

        if ($nnstart > $etinit) {
            $nnstart = $etinit;
        }
        
        if (($nstart - 10000) == $stinit && $sin == false) {
            $nstart = $stinit;
        }

        if (strlen(strval($nstart)) < 6) {
            $n = '0' . strval($nstart);
            $nn = '';

            if (strlen(strval($nnstart)) < 6) {
                $nn = '0' . strval($nnstart);
            }

            $time[] = implode(':', str_split($n, 2)) . ' - ' . implode(':', str_split(($nn == '') ? $nnstart : $nn, 2));
        } else {
            $nn = '';

            if (strlen(strval($nnstart)) < 6) {
                $nn = '0' . strval($nnstart);
            }
            $time[] = implode(':', str_split($nstart, 2)) . ' - ' . implode(':', str_split(($nn == '') ? $nnstart : $nn, 2));
        }
        
        if ($nstart == $stinit) { 
            $nstart += 10000;
            $sin = true;
        }
    }

    echo json_encode($time);
    $con->close();
}

?>
