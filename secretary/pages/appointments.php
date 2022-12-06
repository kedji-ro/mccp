<?php

$q = "SELECT * FROM tb_appointment ta 
                LEFT JOIN tb_clinic tc ON ta.clinic_id = tc.clinic_id
                LEFT JOIN tb_users tu ON ta.patient_id = tu.user_id
                WHERE ta.doctor_id = '" . $_SESSION['D_ID'] . "'";

?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Appointments Management</h1>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="card-body text-black">

            <div class="table-responsive animated--fade-in container-fluid">
                <table class="table table-bordered table-condensed table-fixed table-striped" id="apptListDT" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Patient Name</th>
                            <th>Contact No.</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Clinic</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                            <th hidden></th>
                            <th hidden></th>
                            <th hidden></th>
                            <th hidden></th>
                            <th hidden></th>
                            <th hidden></th>
                        </tr>
                    </thead>

                    <?php
                    $res = $con->query($q);
                    foreach ($res as $row) {
                    ?>
                        <tr>
                            <td><?php echo $row['appointment_id']; ?></td>
                            <td><?php echo $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname']; ?></td>
                            <td><?php echo 'Phone:   ' . $row['phone_no'] . '<br> Tel:   ' . (($row['tel_no'] == '') ? 'N/A' : $row['tel_no']); ?></td>
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
                                <button type="button" class="btn btn-primary btn-circle btn-sm viewABtn" title="View Details"><i class="fas fa-eye"></i></button>
                                <span><button type="button" class="btn btn-secondary btn-circle btn-sm printABtn" title="Print"><i class="fas fa-print"></i></button></span>
                                <span><button type="button" class="btn btn-success btn-circle btn-sm completeABtn" title="Mark As Comlpete" <?php echo (($row['a_stat'] == 1 || $row['a_stat'] == 2) ? 'disabled' : ''); ?>><i class="fas fa-check"></i></button></span>
                                <span><button type="button" class="btn btn-danger btn-circle btn-sm cancelABtn" title="Cancel" <?php echo (($row['a_stat'] == 1 || $row['a_stat'] == 2) ? 'disabled' : ''); ?>><i class="fas fa-close"></i></button></span>
                                <span><button type="button" class="btn btn-warning btn-circle btn-sm resABtn" title="Reschedule" <?php echo (($row['a_stat'] == 1) ? 'disabled' : ''); ?>><i class="fas fa-calendar-days text-gray-900"></i></button></span>
                            </td>

                            <td hidden><?php echo $row['contact_no']; ?></td>
                            <td hidden><?php echo $row['clinic_address']; ?></td>
                            <td hidden><?php echo date('H:i:s', strtotime($row['appointment_date'])); ?></td>
                            <td hidden><?php echo $row['a_desc']; ?></td>
                            <td hidden><?php echo $row['phone_no']; ?></td>
                            <td hidden><?php echo $row['doctor_remarks']; ?></td>
                        </tr>
                    <?php }
                    ?>
                </table>
            </div>
            <script>
                $('.viewABtn').on('click', function() {

                    $('#viewAppointmentModal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    $('#apn').val(data[1]);
                    $('#apno').val(data[12]);
                    $('#apdes').val(data[11]);
                    $('#apd').val(data[3]);
                    $('#apt').val(data[10]);
                    $('#apcll').val(data[9]);
                    $('#apdr').val(data[13]);
                });

                $('.completeABtn').on('click', function() {

                    $('#compApptModal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    $('#coaid').val(data[0]);
                });

                $('.cancelABtn').on('click', function() {

                    $('#cancelApptModal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    $('#canid').val(data[0]);
                });

                $('.resABtn').on('click', function() {

                    $('#reschedModal').modal('show');

                    $tr = $(this).closest('tr');

                    var data = $tr.children("td").map(function() {
                        return $(this).text();
                    }).get();

                    $('#raid').val(data[0]);
                    $('#rad').val(data[3]);
                    $('#rat').val(data[10]);
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
    </div>
</div>


<script>
    $(document).ready(function() {
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
</script>