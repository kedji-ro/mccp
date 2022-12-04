<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Patient Information Request</h1>
</div>

<?php
$q = "SELECT `tb_appointment`.`appointment_id` as a_id, 
            `tb_appointment`.`doctor_id` as d_id, 
            `tb_appointment`.`patient_id` as p_id, 
            `tb_appointment`.`clinic_id` as ac_id, 
            `tb_appointment`.`appointment_date` as a_date, 
            `tb_users`.`firstname` as p_fname, 
            `tb_users`.`middlename` as p_mname, 
            `tb_users`.`lastname` as p_lname, 
            `tb_users`.`suffix` as p_sufx, 
            `tb_clinic`.`clinic_name` as c_name,
            `tb_clinic`.`clinic_address` as c_addr,
            `tb_appointment`.a_stat,
            tb_appointment.transfer_date
            FROM `tb_appointment` 
            INNER JOIN `tb_users` ON `tb_users`.`user_id` = `tb_appointment`.`patient_id` 
            INNER JOIN `tb_clinic` ON `tb_clinic`.`clinic_id` = `tb_appointment`.`clinic_id`";

$query_run = mysqli_query($con, $q);
?>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="content">
            <div class="" id="patientReqList">
                <div class="table-responsive animated--fade-in">
                    <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable3" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden></th>
                                <th hidden></th>
                                <th>Requested By</th>
                                <th>Transfer To</th>
                                <th>Request Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <?php
                        $qry = "CALL `SP_WEB_GET_PATIENT_INFO_TRANSFER_REQS_OUTGOING`(" . $_SESSION['U_ID'] . ");";
                        $res = $con->query($qry);
                        if ($res) {
                            foreach ($res as $rows) {
                        ?>
                                <tr>
                                    <td hidden><?php echo $rows['a_id']; ?></td>
                                    <td hidden><?php echo $rows['a_id']; ?></td>
                                    <td><?php echo $rows['p']; ?></td>
                                    <td><?php echo $rows['reqby'];?></td>
                                    <td><?php echo $rows['date_logged']; ?></td>
                                    <td class="text-center">
                                        <h5><span class="badge badge-pill badge-danger">Outgoing</span></h5>
                                    </td>
                                    <td class="text-center"><button type="button" class="btn btn-primary btn-circle btn-sm" title="View/Edit Details"><i class="fa fa-edit"></i></button>
                                        <span><button type="button" class="btn btn-secondary btn-circle btn-sm" title="Print"><i class="fa fa-print"></i></button></span>
                                </tr>
                        <?php
                            }
                        } ?>

                        <?php
                        $qry = "CALL `SP_WEB_GET_PATIENT_INFO_TRANSFER_REQS_INCOMING`(" . $_SESSION['U_ID'] . ");";
                        $res = $con->query($qry);
                        if ($res) {
                            foreach ($res as $rows) {
                        ?>
                                <tr>
                                    <td hidden><?php echo $rows['a_id']; ?></td>
                                    <td><?php echo $rows['p']; ?></td>
                                    <td><?php echo $rows['reqby'];
                                        ?></td>
                                    <td><?php echo $rows['clinic_name'];
                                        ?></td>
                                    <td><?php echo $rows['date_logged']; ?></td>
                                    <td class="text-center">
                                        <h5><span class="badge badge-pill badge-warning">Incoming</span></h5>
                                    </td>
                                    <td class="text-center"><button type="button" class="btn btn-primary btn-circle btn-sm" title="View/Edit Details"><i class="fa fa-edit"></i></button>
                                        <span><button type="button" class="btn btn-secondary btn-circle btn-sm" title="Print"><i class="fa fa-print"></i></button></span>
                                </tr>
                        <?php
                            }
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#dataTable').dataTable().fnSort([
            [5, 'asc']
        ]);
        $('#dataTable2').dataTable();
        $('#dataTable3').dataTable();


    });

    $("#pReqList").click(function() {
        $('.aReqCount').removeClass('badge badge-primary aReqCount').addClass('badge badge-light aReqCount');
        alert('f');
    });

    $("#pList").click(function() {
        $('.aReqCount').removeClass('badge badge-light aReqCount').addClass('badge badge-primary aReqCount');
    });

    $("#cPatientList").click(function() {
        $('.aReqCount').removeClass('badge badge-light aReqCount').addClass('badge badge-primary aReqCount');
    });
</script>