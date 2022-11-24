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
            `tb_appointment`.a_stat
            FROM `tb_appointment` 
            INNER JOIN `tb_users` ON `tb_users`.`user_id` = `tb_appointment`.`patient_id` 
            INNER JOIN `tb_clinic` ON `tb_clinic`.`clinic_id` = `tb_appointment`.`clinic_id`";
           // WHERE `tb_appointment`.`doctor_id` = " . $_SESSION['U_ID'];
           

$qcp = "SELECT `tb_appointment`.`appointment_id` as a_id, 
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
            `tb_appointment`.a_stat
            FROM `tb_appointment` 
            INNER JOIN `tb_users` ON `tb_users`.`user_id` = `tb_appointment`.`patient_id` 
            INNER JOIN `tb_clinic` ON `tb_clinic`.`clinic_id` = `tb_appointment`.`clinic_id`
            WHERE `tb_appointment`.`doctor_id` = " . $_SESSION['U_ID'];
 

$query_run = mysqli_query($con, $q);
?>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#patientsList" data-toggle="tab" id="#pList">All Patients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#currentPatientList" data-toggle="tab" id="#cPatientList">Current Patients</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#patientReqList" data-toggle="tab" id="#pReqList">Pending Requests
                    <?php if ($_SESSION['PATREQ_COUNT'] != 0) { ?>
                        <span class="badge badge-primary aReqCount" style="margin-left:10px;"><?php echo $_SESSION['PATREQ_COUNT']; ?></span>
                    <?php } ?>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <!-- Tab Content -->
        <div class="content tab-content">

            <!-- Patients -->
            <div class="tab-pane active" id="patientsList">
                <div class="content animated--fade-in">
                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th hidden>appt_id</th>
                                    <th>Patient Name</th>
                                    <th>Appointment Date/Time</th>
                                    <th>Current Clinic</th>
                                    <th>Clinic Addres</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <!-- Displays Information from Database -->
                            <?php

                            if ($query_run) {
                                foreach ($query_run as $rows) {
                            ?>
                                    <tr>
                                        <td hidden><?php echo $rows['a_id']; ?></td>
                                        <td><?php echo $rows['p_fname'] . ' ' . $rows['p_mname'] . ' ' . $rows['p_lname'] . ' ' . $rows['p_sufx']; ?></td>
                                        <td><?php echo $rows['a_date']; ?></td>
                                        <td><?php echo $rows['c_name']; ?></td>
                                        <td><?php echo $rows['c_addr']; ?></td>
                                        <?php if ($rows['a_stat'] == '1') { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-success">Active</span></h5>
                                            </td>
                                        <?php } else { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-secondary">Inactive</span></h5>
                                            </td>
                                        <?php } ?>
                                        <td class="text-center"> <button type="button" class="btn btn-primary btn-circle btn-sm" title="View Details"><i class="fa fa-search"></i></button>
                                            <span><button type="button" class="btn btn-warning btn-circle btn-sm text-gray-900 transferBtn" title="Request Information"><i class="fa fa-download"></i></button></span>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>

            <div class="tab-pane" id="currentPatientList">
                    <div class="table-responsive animated--fade-in">
                        <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable2" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th hidden>appt_id</th>
                                    <th>Patient Name</th>
                                    <th>Appointment Date/Time</th>
                                    <th>Current Clinic</th>
                                    <th>Clinic Addres</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <!-- Displays Information from Database -->
                            <?php
                            $qrun = mysqli_query($con, $qcp);
                            if (($qrun)) {
                                foreach ($qrun as $rows) {
                            ?>
                                    <tr>
                                        <td hidden><?php echo $rows['a_id']; ?></td>
                                        <td><?php echo $rows['p_fname'] . ' ' . $rows['p_mname'] . ' ' . $rows['p_lname'] . ' ' . $rows['p_sufx']; ?></td>
                                        <td><?php echo $rows['a_date']; ?></td>
                                        <td><?php echo $rows['c_name']; ?></td>
                                        <td><?php echo $rows['c_addr']; ?></td>
                                        <?php if ($rows['a_stat'] == '1') { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-success">Active</span></h5>
                                            </td>
                                        <?php } else { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-secondary">Inactive</span></h5>
                                            </td>
                                        <?php } ?>
                                        <td class="text-center"><button type="button" class="btn btn-primary btn-circle btn-sm" title="View/Edit Details"><i class="fa fa-edit"></i></button>
                                        <span><button type="button" class="btn btn-secondary btn-circle btn-sm" title="Print"><i class="fa fa-print"></i></button></span>
                                    </tr>
                            <?php
                                }
                            } ?>
                        </table>
                    </div>
            </div>

            <div class="tab-pane" id="patientReqList">
                    <div class="table-responsive animated--fade-in">
                        <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th hidden>appt_id</th>
                                    <th>Patient Name</th>
                                    <th>Requested By</th>
                                    <th>Clinic</th>
                                    <th>Request Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <!-- Displays Information from Database -->
                            <?php
                            $qrun = mysqli_query($con, $qcp);
                            if (($qrun)) {
                                foreach ($qrun as $rows) {
                            ?>
                                    <tr>
                                        <td hidden><?php echo $rows['a_id']; ?></td>
                                        <td><?php echo $rows['p_fname'] . ' ' . $rows['p_mname'] . ' ' . $rows['p_lname'] . ' ' . $rows['p_sufx']; ?></td>
                                        <td><?php //echo $rows['a_date']; ?></td>
                                        <td><?php //echo $rows['c_name']; ?></td>
                                        <td><?php echo $rows['c_name']; ?></td>
                                        <?php if ($rows['a_stat'] == '1') { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-success">Active</span></h5>
                                            </td>
                                        <?php } else { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-secondary">Inactive</span></h5>
                                            </td>
                                        <?php } ?>
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
        $('.transferBtn').on('click', function() {

            $('#transferPatientModal').modal('show');

            $tr = $(this).closest('tr');
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#tp_aid').val(data[0]);
            $('#tp_name').val(data[1]);
            $('#tp_currclinic').val(data[3]);
        });
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