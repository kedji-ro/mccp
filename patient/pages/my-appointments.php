<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">My Appointments</h1>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive animated--fade-in">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="appointmentsTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Clinic</th>
                        <th>Doctor</th>
                        <th>Doctor's No.</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                    </tr>
                </thead>

                <?php
                $q = $con->query("SELECT * FROM tb_appointment ta 
                                    INNER JOIN tb_clinic tc ON ta.clinic_id = tc.clinic_id
                                    INNER JOIN tb_users tu ON ta.doctor_id = tu.user_id
                                    LEFT JOIN (SELECT DISTINCT appt_id, patient_id, 1 FROM tb_payment) tp ON ta.appointment_id = tp.appt_id
                                    WHERE ta.patient_id = '" . $_SESSION['U_ID'] . "'");
                if ($q) {
                    foreach ($q as $rows) {
                ?>
                        <tr>
                            <td><?php echo $rows['appointment_id']; ?></td>
                            <td><?php echo date('Y-m-d', strtotime($rows['appointment_date'])); ?></td>
                            <td><?php echo date('h:i A', strtotime($rows['appointment_date'])); ?></td>
                            <td><?php echo $rows['clinic_name']; ?></td>
                            <td><?php echo $rows['firstname'] . ' ' . $rows['middlename'] . ' ' . $rows['lastname'] . ' ' . $rows['suffix']; ?></td>
                            <td><?php echo 'Phone:  ' . $rows['phone_no'] . '<br> Tel:  ' . (($rows['tel_no'] == '') ? 'N/A' : $rows['tel_no']); ?></td>

                            <td class="text-center">
                                <?php
                                switch ($rows['a_stat']) {
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
                                <button type="button" class="btn btn-sm btn-primary btn-circle viewApptBtn" title="View Details"><i class="fas fa-eye"></i> </button>

                                <?php if ($rows['a_stat'] == 1) { ?>
                                    <span><button type="button" class="btn btn-sm btn-success btn-circle payApptBtn" title="<?php echo ($rows['1'] == 1) ? 'Payment Sent' : 'Send Payment'; ?>" <?php echo ($rows['1'] == 1) ? 'disabled' : ''; ?>><i class="fa-solid fa-money-bill-wave"></i></button></span>
                                <?php } ?>

                                <span><button type="button" class="btn btn-sm btn-danger btn-circle cancelApptBtn" title="Cancel" <?php echo (($rows['a_stat'] == '0' || $rows['a_stat'] == '2' || $rows['a_stat'] == '4' || $rows['a_stat'] == '3') ? 'disabled' : ''); ?>><i class="fas fa-close"></i></button></span>
                                <span><button type="button" class="btn btn-sm btn-warning btn-circle reschedApptBtn text-gray-900" title="Reschedule" <?php echo (($rows['a_stat'] == '4' || $rows['a_stat'] == '3') ? 'disabled' : ''); ?>><i class="fas fa-calendar-day"></i></button></span>
                            </td>

                            <td hidden><?php echo $rows['contact_no']; ?></td>
                            <td hidden><?php echo $rows['clinic_address']; ?></td>
                            <td hidden><?php echo $rows['a_desc']; ?></td>
                            <td hidden><?php echo date('H:i:s', strtotime($rows['appointment_date'])); ?></td>
                        </tr>
                <?php }
                } ?>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#appointmentsTable').dataTable();
    });

    $('.viewApptBtn').on('click', function() {

        $('#viewApptModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#acn').val(data[3]);
        $('#acl').val(data[9]);
        $('#acc').val(data[8]);
        $('#ad').val(data[10]);
    });

    $('.reschedApptBtn').on('click', function() {

        $('#reschedApptModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#raid').val(data[0]);
        $('#rad').val(data[1]);
        $('#rat').val(data[11]);
    });

    $('.cancelApptBtn').on('click', function() {

        $('#cancelApptModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#caid').val(data[0]);
    });

    $('.payApptBtn').on('click', function() {

        $('#payApptModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#paid').val(data[0]);
    });
</script>