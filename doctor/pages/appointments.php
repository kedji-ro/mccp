<?php

$q = "SELECT * FROM tb_appointment ta
                LEFT JOIN tb_users tu on tu.user_id = ta.patient_id
                LEFT JOIN tb_clinic tc on tc.clinic_id = ta.clinic_id
                    WHERE ta.doctor_id = '" . $_SESSION['U_ID'] . "';";


$rs = $con->query($q);

$appt_col = [];
$appt = [];

foreach ($rs as $r) {

    $appt['id'] = $r['appointment_id'];
    $appt['title'] = date('h:i A', strtotime($r['appointment_date']));
    $appt['start'] = date('Y-m-d', strtotime($r['appointment_date']));

    switch ($r['a_stat']) {
        case 0:
            $appt['backgroundColor'] = '#4e73df';
            $appt['borderColor'] = '#4e73df';
            break;
        case 1:
            $appt['backgroundColor'] = '#1cc88a';
            $appt['borderColor'] = '#1cc88a';
            break;
        case 2:
            $appt['backgroundColor'] = '#e74a3b';
            $appt['borderColor'] = '#e74a3b';
            break;
    }

    $appt_col[] = $appt;
}
?>

<script>
    var appts = $.parseJSON('<?= json_encode($appt_col) ?>');
</script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Appointments</h1>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#apptCalendar" data-toggle="tab" id="hlCal">Calendar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#apptLists" data-toggle="tab" id="hlAppts">Appointments List
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

                <!-- Calendar -->
                <div class="tab-pane active" id="apptCalendar">
                    <div class="content animated--fade-in">
                        <div class="mb-4">
                            <h5>
                                <span class="badge badge-primary">APPROVED</span>
                                <span class="badge badge-success">COMPLETED</span>
                                <span class="badge badge-danger">CANCELLED</span>
                            </h5>
                        </div>
                        <div id='appt-calendar'></div>
                    </div>
                </div>

                <!-- Appointments List -->
                <div class="tab-pane" id="apptLists">
                    <div class="table-responsive animated--fade-in container-fluid">
                        <table class="table table-bordered table-condensed table-fixed table-striped" id="apptListDT" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Patient Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Clinic</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                </tr>
                            </thead>

                            <?php
                            $result = $con->query($q);
                            while ($row = $result->fetch_array()) {
                            ?>
                                <tr>
                                    <td><?php echo $row['appointment_id']; ?></td>
                                    <td><?php echo $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']; ?></td>
                                    <td><?php echo date('Y-m-d', strtotime($row['appointment_date'])); ?></td>
                                    <td><?php echo date('h:i A', strtotime($row['appointment_date'])); ?></td>
                                    <td><?php echo $row['clinic_name']; ?></td>

                                    <td class="text-center">
                                        <?php
                                        switch ($row['a_stat']) {
                                            case 0:
                                        ?>
                                                <h5><span class="badge badge-pill badge-primary">Approved</span></h5>
                                            <?php break;
                                            case 1:
                                            ?>
                                                <h5><span class="badge badge-pill badge-success">Completed</span></h5>
                                            <?php break;
                                            case 2:
                                            ?>
                                                <h5><span class="badge badge-pill badge-danger">Cancelled</span></h5>
                                        <?php break;
                                        } ?>
                                    </td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-primary btn-circle btn-sm viewABtn" title="View/Add Details"><i class="fas fa-edit"></i></button>
                                        <span><button type="button" class="btn btn-secondary btn-circle btn-sm printABtn" title="Print"><i class="fas fa-print"></i></button></span>
                                        <span><button type="button" class="btn btn-success btn-circle btn-sm completeABtn" title="Mark As Comlpete" <?php echo (($row['a_stat'] != 0 ) ? 'disabled' : ''); ?>><i class="fas fa-check"></i></button></span>
                                        <span><button type="button" class="btn btn-danger btn-circle btn-sm cancelABtn" title="Cancel" <?php echo (($row['a_stat'] != 0 ) ? 'disabled' : ''); ?>><i class="fas fa-close"></i></button></span>
                                        <span><button type="button" class="btn btn-warning btn-circle btn-sm resABtn" title="Reschedule" <?php echo (($row['a_stat'] == 1 ) ? 'disabled' : ''); ?>><i class="fas fa-calendar-days text-gray-900"></i></button></span>
                                    </td>
                                    <td hidden><?php echo $row['email']; ?></td>
                                    <td hidden><?php echo $row['phone_no']; ?></td>
                                    <td hidden><?php echo $row['tel_no']; ?></td>
                                    <td hidden><?php echo $row['clinic_address']; ?></td>
                                    <td hidden><?php echo date('H:i:s', strtotime($row['appointment_date'])); ?></td>

                                </tr>

                            <?php }
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

                            window.location.href = "<?php echo home; ?>/doctor/print/appointments-data.php?id=" + data[0];
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#apptListDT').dataTable().fnSort([
            [5, 'asc']
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
                console.log(info);
            }
        });

        calendarA.render();
    });

    $("#hlAppts").click(function() {
        $('.aReqCount').removeClass('badge badge-primary aReqCount').addClass('badge badge-light aReqCount');
    });

    $("#hlCal").click(function() {
        $('.aReqCount').removeClass('badge badge-light aReqCount').addClass('badge badge-primary aReqCount');
    });
</script>