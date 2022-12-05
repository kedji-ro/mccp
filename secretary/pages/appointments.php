<?php

$q = "SELECT * FROM tb_appointment ta 
                INNER JOIN tb_clinic tc ON ta.clinic_id = tc.clinic_id
                INNER JOIN tb_users tu ON ta.patient_id = tu.user_id
                WHERE ta.doctor_id = '" . $_SESSION['D_ID'] . "'";

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Appointments</h1>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#apptLists" data-toggle="tab" id="hlAppts">Appointments List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#apptRequests" data-toggle="tab" id="hlPendReq">Pending Requests
                    <?php if ($_SESSION['APPT_COUNT'] != 0) { ?>
                        <span class="badge badge-primary aReqCount" style="margin-left:10px;"><?php echo $_SESSION['APPT_COUNT']; ?></span>
                    <?php } ?>
                </a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="card-body text-black">

            <!-- Tab Content -->
            <div class="content tab-content">

                <!-- Appointments List -->
                <div class="tab-pane active" id="apptLists">
                    <div class="table-responsive animated--fade-in container-fluid">
                        <table class="table table-bordered table-condensed table-fixed table-striped" id="apptListDT" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Patient Name</th>
                                    <th>Contact No.</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Description</th>
                                    <th>Clinic</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                </tr>
                            </thead>

                            <?php
                            $res = $con->query($q);
                            foreach ($res as $row) {
                                if ($row['a_stat'] != 0 && $row['a_stat'] != 2) {


                            ?>
                                    <tr>
                                        <td><?php echo $row['appointment_id']; ?></td>
                                        <td><?php echo $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']; ?></td>
                                        <td><?php echo 'Phone:   ' . $row['phone_no'] . '<br> Tel:   ' . (($row['tel_no'] == '') ? 'N/A' : $row['tel_no']); ?></td>
                                        <td><?php echo date('Y-m-d', strtotime($row['appointment_date'])); ?></td>
                                        <td><?php echo date('h:i A', strtotime($row['appointment_date'])); ?></td>
                                        <td><?php echo $row['a_desc']; ?></td>
                                        <td><?php echo $row['clinic_name']; ?></td>
                                        <td class="text-center">
                                            <?php
                                            switch ($row['a_stat']) {
                                                case 0:
                                            ?>
                                                    <h5><span class="badge badge-pill badge-warning">Pending</span></h5>
                                                <?php break;
                                                case 1:
                                                ?>
                                                    <h5><span class="badge badge-pill badge-primary">Approved</span></h5>
                                                <?php break;
                                                case 2:
                                                ?>
                                                    <h5><span class="badge badge-pill badge-danger">Denied</span></h5>
                                                <?php break;
                                                case 3:
                                                ?>
                                                    <h5><span class="badge badge-pill badge-danger">Cancelled</span></h5>
                                                <?php break;
                                                case 4: ?>
                                                    <h5><span class="badge badge-pill badge-success">Completed</span></h5>
                                            <?php break;
                                            } ?>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-circle btn-sm viewABtn" title="View/Add Details"><i class="fas fa-edit"></i></button>
                                            <span><button type="button" class="btn btn-success btn-circle btn-sm completeABtn" title="Mark As Comlpete" <?php echo (($row['a_stat'] == 2 || $row['a_stat'] == 4) ? 'disabled' : ''); ?>><i class="fas fa-check"></i></button></span>
                                            <span><button type="button" class="btn btn-danger btn-circle btn-sm cancelABtn" title="Cancel" <?php echo (($row['a_stat'] == 2 || $row['a_stat'] == 4) ? 'disabled' : ''); ?>><i class="fas fa-close"></i></button></span>
                                            <span><button type="button" class="btn btn-secondary btn-circle btn-sm printABtn" title="Print"><i class="fas fa-print"></i></button></span>
                                            <span><button type="button" class="btn btn-warning btn-circle btn-sm resABtn" title="Reschedule" <?php echo (($row['a_stat'] == 2 || $row['a_stat'] == 4) ? 'disabled' : ''); ?>><i class="fas fa-calendar-days text-gray-900"></i></button></span>
                                        </td>

                                        <td hidden><?php echo $row['contact_no']; ?></td>
                                        <td hidden><?php echo $row['clinic_address']; ?></td>
                                        <td hidden><?php echo date('H:i:s', strtotime($row['appointment_date'])); ?></td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </table>
                    </div>
                    <script>
                        $('.viewABtn').on('click', function() {

                            $('#viewAppointmentListModal').modal('show');

                            $tr = $(this).closest('tr');

                            var data = $tr.children("td").map(function() {
                                return $(this).text();
                            }).get();

                            $('#alp_id').val(data[0]);
                            $('#alp_name').val(data[1]);
                            $('#alp_pemail').val(data[8]);
                            $('#alp_con').val(data[9]);
                            $('#alp_tel').val(data[10]);
                            $('#alp_date').val(data[2]);
                            $('#alp_time').val(data[3]);
                            $('#alp_clinic').val(data[5]);
                            $('#alp_cadd').val(data[11]);
                        });

                        $('.cancelABtn').on('click', function() {

                            $('#cancelApptModal').modal('show');

                            $tr = $(this).closest('tr');

                            var data = $tr.children("td").map(function() {
                                return $(this).text();
                            }).get();

                            $('#cam_id').val(data[0]);
                        });

                        $('.resABtn').on('click', function() {

                            $('#reschedModal').modal('show');

                            $tr = $(this).closest('tr');

                            var data = $tr.children("td").map(function() {
                                return $(this).text();
                            }).get();

                            $('#raid').val(data[0]);
                            $('#rad').val(data[2]);
                            $('#rat').val(data[12]);
                        });

                        $('.printABtn').on('click', function() {

                            $tr = $(this).closest('tr');
                            var data = $tr.children("td").map(function() {
                                return $(this).text();
                            }).get();

                            window.location.href = "<?php echo home; ?>/secretary/print/appointments-data.php?id=" + data[0];
                        });
                    </script>
                </div>

                <!-- Pending Requests -->
                <div class="tab-pane" id="apptRequests">
                    <div class="table-responsive animated--fade-in">
                        <table class="table table-bordered table-condensed table-fixed table-striped" id="apptReqsDT" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Patient Name</th>
                                    <th>Contact No.</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Description</th>
                                    <th>Clinic</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Actions</th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                </tr>
                            </thead>

                            <?php
                            $res = $con->query($q);
                            foreach ($res as $row) {
                                if ($row['a_stat'] == 0 || $row['a_stat'] == 2) {


                            ?>
                                    <tr>
                                        <td><?php echo $row['appointment_id']; ?></td>
                                        <td><?php echo $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']; ?></td>
                                        <td><?php echo 'Phone:   ' . $row['phone_no'] . '<br> Tel:   ' . (($row['tel_no'] == '') ? 'N/A' : $row['tel_no']); ?></td>
                                        <td><?php echo date('Y-m-d', strtotime($row['appointment_date'])); ?></td>
                                        <td><?php echo date('h:i A', strtotime($row['appointment_date'])); ?></td>
                                        <td><?php echo $row['a_desc']; ?></td>
                                        <td><?php echo $row['clinic_name']; ?></td>
                                        <td class="text-center">
                                            <?php
                                            switch ($row['a_stat']) {
                                                case 0:
                                            ?>
                                                    <h5><span class="badge badge-pill badge-warning">Pending</span></h5>
                                                <?php break;
                                                case 1:
                                                ?>
                                                    <h5><span class="badge badge-pill badge-primary">Approved</span></h5>
                                                <?php break;
                                                case 2:
                                                ?>
                                                    <h5><span class="badge badge-pill badge-danger">Denied</span></h5>
                                                <?php break;
                                                case 3:
                                                ?>
                                                    <h5><span class="badge badge-pill badge-danger">Cancelled</span></h5>
                                                <?php break;
                                                case 4: ?>
                                                    <h5><span class="badge badge-pill badge-success">Completed</span></h5>
                                            <?php break;
                                            } ?>
                                        </td>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-success btn-circle btn-sm completeABtn" title="Mark As Comlpete" <?php echo (($row['a_stat'] == 2 || $row['a_stat'] == 4) ? 'disabled' : ''); ?>><i class="fas fa-check"></i></button>
                                            <span><button type="button" class="btn btn-danger btn-circle btn-sm cancelABtn" title="Cancel" <?php echo (($row['a_stat'] == 2 || $row['a_stat'] == 4) ? 'disabled' : ''); ?>><i class="fas fa-close"></i></button></span>
                                            <span><button type="button" class="btn btn-warning btn-circle btn-sm resABtn" title="Reschedule" <?php echo (($row['a_stat'] == 2 || $row['a_stat'] == 4) ? 'disabled' : ''); ?>><i class="fas fa-calendar-days text-gray-900"></i></button></span>
                                        </td>

                                        <td hidden><?php echo $row['contact_no']; ?></td>
                                        <td hidden><?php echo $row['clinic_address']; ?></td>
                                        <td hidden><?php echo date('H:i:s', strtotime($row['appointment_date'])); ?></td>
                                    </tr>
                            <?php }
                            }
                            ?>
                        </table>
                    </div>
                    <script>
                        $('.viewPRBtn').on('click', function() {

                            $('#viewAppointmentListModal').modal('show');

                            $tr = $(this).closest('tr');

                            var data = $tr.children("td").map(function() {
                                return $(this).text();
                            }).get();

                            $('#alp_id').val(data[0]);
                            $('#alp_name').val(data[1]);
                            $('#alp_pemail').val(data[9]);
                            $('#alp_con').val(data[10]);
                            $('#alp_tel').val(data[11]);
                            $('#alp_date').val(data[2]);
                            $('#alp_time').val(data[3]);
                            $('#alp_clinic').val(data[5]);
                            $('#alp_cadd').val(data[12]);
                        });

                        $('.approveBtn').on('click', function() {

                            $('#approveApptModal').modal('show');

                            $tr = $(this).closest('tr');

                            var data = $tr.children("td").map(function() {
                                return $(this).text();
                            }).get();

                            $('#am_title').html('Approve');
                            $('#am_op').html('Approve');
                            $('#am_pname').html(data[1]);
                            $('#am_id').val(data[0]);
                            $('#am_appstat').val(1);
                        });

                        $('.denyBtn').on('click', function() {

                            $('#approveApptModal').modal('show');

                            $tr = $(this).closest('tr');

                            var data = $tr.children("td").map(function() {
                                return $(this).text();
                            }).get();

                            $('#am_title').html('Deny');
                            $('#am_op').html('Deny');
                            $('#am_pname').html(data[1]);
                            $('#am_id').val(data[0]);
                            $('#am_appstat').val(2);
                        });

                        $('#rbShowPending').on('click', function() {
                            if ($('#rbShowPending').is(':checked')) {
                                var $rowsNo = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Expired"
                                }).hide();

                                var $rowsNo2 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Denied"
                                }).hide();

                                var $rowsNo3 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Pending"
                                }).show();
                            }
                        });

                        $('#rbShowDenied').on('click', function() {
                            if ($('#rbShowDenied').is(':checked')) {
                                var $rowsNo = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Pending"
                                }).hide();

                                var $rowsNo2 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Expired"
                                }).hide();

                                var $rowsNo3 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Denied"
                                }).show();
                            }
                        });

                        $('#rbShowExpired').on('click', function() {
                            if ($('#rbShowExpired').is(':checked')) {
                                var $rowsNo = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Pending"
                                }).hide();

                                var $rowsNo2 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Denied"
                                }).hide();

                                var $rowsNo3 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Expired"
                                }).show();
                            }
                        });

                        $('#rbShowAll').on('click', function() {
                            if ($('#rbShowAll').is(':checked')) {
                                var $rowsNo = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Pending"
                                }).show();

                                var $rowsNo2 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Denied"
                                }).show();

                                var $rowsNo3 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Expired"
                                }).show();
                            }
                        });

                        $(document).ready(function() {
                            if ($('#rbShowPending').is(':checked')) {
                                var $rowsNo = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Expired"
                                }).hide();

                                var $rowsNo2 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Denied"
                                }).hide();

                                var $rowsNo3 = $('#apptReqsDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(7).text()) === "Pending"
                                }).show();
                            }
                        });
                    </script>
                </div>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#apptReqsDT').dataTable().fnSort([
            [7, 'desc']
        ]);
        $('#apptListDT').dataTable().fnSort([
            [6, 'asc']
        ]);

        var calendarAppts = document.getElementById('appt-calendar');

        var calendarA = new FullCalendar.Calendar(calendarAppts, {
            themeSystem: 'bootstrap',
            initialView: 'dayGridMonth',
            initialDate: '<?php echo $date; ?>',
            editable: true,
            selectable: true,
            height: 700,
            headerToolbar: {
                left: 'title',
                right: 'today prev,next'
            },
            events: appts,
            eventClick(info) {
                $('#viewAppointmentModal').modal('show');
                console.log(info);
            }
        });

        calendarA.render();
    });

    $("#hlPendReq").click(function() {
        $('.aReqCount').removeClass('badge badge-primary aReqCount').addClass('badge badge-light aReqCount');
    });

    $("#hlAppts").click(function() {
        $('.aReqCount').removeClass('badge badge-light aReqCount').addClass('badge badge-primary aReqCount');
    });

    $("#hlCal").click(function() {
        $('.aReqCount').removeClass('badge badge-light aReqCount').addClass('badge badge-primary aReqCount');
    });
</script>