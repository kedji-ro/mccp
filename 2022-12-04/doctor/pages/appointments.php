<?php

$q = "SELECT    tb_appointment.appointment_id as a_id,
                tb_appointment.patient_id as p_id,
                DATE(tb_appointment.appointment_date) as a_d,
                TIME_FORMAT(TIME(tb_appointment.appointment_date), '%h:%i %p') as a_t,
                TIME(tb_appointment.appointment_date) as att,
                DAYNAME(tb_appointment.appointment_date) as a_day,
                tb_appointment.a_stat,
                tb_clinic.clinic_name as c_name,
                tb_clinic.clinic_address as c_addr,
                tb_users.firstname as p_fn,
                tb_users.middlename as p_mn,
                tb_users.lastname as p_ln,
                tb_users.suffix as p_s,
                tb_users.phone_no as p_cn,
                tb_users.tel_no as p_tel,
                tb_users.email as p_email,
                tb_appointment.date_logged,
                tb_appointment.a_desc
                FROM tb_appointment 
                LEFT JOIN tb_users on tb_users.user_id = tb_appointment.patient_id
                LEFT JOIN tb_clinic on tb_clinic.clinic_id = tb_appointment.clinic_id
                    WHERE tb_appointment.doctor_id = '" . $_SESSION['U_ID'] . "';";


$rs = $con->query($q);

$appt_col = [];
$appt = [];

while ($r = $rs->fetch_array()) {
    if ($r['a_stat'] !== 2) {
        $appt['id'] = $r['a_id'];
        $appt['title'] = $r['a_t'];
        $appt['start'] = $r['a_d'];

        if ($r['a_stat'] == 1) {
            if ($r['a_d'] > $date) {
                $appt['backgroundColor'] = '#4e73df';
                $appt['borderColor'] = '#4e73df';
            } else {
                $appt['backgroundColor'] = '#1cc88a';
                $appt['borderColor'] = '#1cc88a';
            }
        } elseif ($r['a_stat'] == 4) {
            $appt['backgroundColor'] = '#f6c23e';
            $appt['borderColor'] = '#f6c23e';
        } else {
            $appt['backgroundColor'] = '#858796';
            $appt['borderColor'] = '#858796';
        }

        $appt['textColor'] = ($appt['backgroundColor'] == '#f6c23e') ? 'black' : 'white';
    }

    $appt_col[] = $appt;
}

if (count($appt_col) !== 0) {
?>

    <script>
        var appts = $.parseJSON('<?= json_encode($appt_col) ?>');
    </script>

<?php } ?>

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
                <a class="nav-link" href="#apptLists" data-toggle="tab" id="hlAppts">Appointments List</a>
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

                <!-- Calendar -->
                <div class="tab-pane active" id="apptCalendar">
                    <div class="content animated--fade-in">
                        <div class="mb-4">
                            <h5>
                                <span class="badge badge-warning text-gray-900">PENDING</span>
                                <span class="badge badge-secondary">EXPIRED</span>
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
                        <div class="row mb-4">
                            <div class="form-check" style="padding: 0% 2% 0% 30px;">
                                <input class="form-check-input" type="radio" name="rbAppts" id="rbShowApproved" checked>
                                <label class="form-check-label" for="rbShowApproved">
                                    Show Approved Only
                                </label>
                            </div>
                            <div class="form-check" style="padding-right: 2%;">
                                <input class="form-check-input" type="radio" name="rbAppts" id="rbShowCompleted">
                                <label class="form-check-label" for="rbShowCompleted">
                                    Show Completed Only
                                </label>
                            </div>
                            <div class="form-check" style="padding-right: 2%;">
                                <input class="form-check-input" type="radio" name="rbAppts" id="rbShowCancelled">
                                <label class="form-check-label" for="rbShowCancelled">
                                    Show Cancelled Only
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="rbAppts" id="rbShowAllAppts">
                                <label class="form-check-label" for="rbShowAllAppts">
                                    Show All
                                </label>
                            </div>
                        </div>
                        <table class="table table-bordered table-condensed table-fixed table-striped" id="apptListDT" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Patient Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Day</th>
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
                                if ($row['a_stat'] != 0 || $row['a_stat'] != 2) {
                            ?>
                                    <tr>
                                        <td><?php echo $row['a_id']; ?></td>
                                        <td><?php echo $row['p_fn'] . ' ' . $row['p_mn'] . ' ' . $row['p_ln'] . ' ' . $row['p_s']; ?></td>
                                        <td><?php echo $row['a_d']; ?></td>
                                        <td><?php echo $row['a_t']; ?></td>
                                        <td><?php echo $row['a_day']; ?></td>
                                        <td><?php echo $row['c_name']; ?></td>

                                        <?php if ($row['a_stat'] == 1) { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-primary">Approved</span></h5>
                                            </td>
                                        <?php } elseif ($row['a_stat'] == 3) { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-danger">Cancelled</span></h5>
                                            </td>
                                        <?php } elseif ($row['a_stat'] == 4) { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-success">Completed</span></h5>
                                            </td>
                                        <?php } ?>

                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-circle btn-sm viewABtn" title="View/Add Details"><i class="fas fa-edit"></i></button>
                                            <span><button type="button" class="btn btn-secondary btn-circle btn-sm printABtn" title="Print"><i class="fas fa-print"></i></button></span>
                                            <span><button type="button" class="btn btn-success btn-circle btn-sm completeBtn" title="Mark as Complete" <?php echo (($row['a_stat'] == 2) ? 'disabled' : ''); ?>><i class="fas fa-check"></i></button></span>
                                            <span><button type="button" class="btn btn-danger btn-circle btn-sm cancelABtn" title="Cancel" <?php echo (($row['a_stat'] == 2) ? 'disabled' : ''); ?>><i class="fas fa-close"></i></button></span>
                                            <span><button type="button" class="btn btn-warning btn-circle btn-sm resABtn" title="Reschedule" <?php echo (($row['a_stat'] == 2) ? 'disabled' : ''); ?>><i class="fas fa-calendar-days text-gray-900"></i></button></span>
                                        </td>
                                        <td hidden><?php echo $row['p_email']; ?></td>
                                        <td hidden><?php echo $row['p_cn']; ?></td>
                                        <td hidden><?php echo $row['p_tel']; ?></td>
                                        <td hidden><?php echo $row['c_addr']; ?></td>
                                        <td hidden><?php echo $row['att']; ?></td>

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

                        $('.completeBtn').on('click', function() {

                            $('#compApptModal').modal('show');

                            $tr = $(this).closest('tr');

                            var data = $tr.children("td").map(function() {
                                return $(this).text();
                            }).get();

                            $('#acid').val(data[0]);
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

                        $('#rbShowApproved').on('click', function() {
                            if ($('#rbShowApproved').is(':checked')) {
                                var $rowsNo = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Completed"
                                }).hide();

                                var $rowsNo2 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Cancelled"
                                }).hide();

                                var $rowsNo3 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Approved"
                                }).show();
                            }
                        });

                        $('#rbShowCancelled').on('click', function() {
                            if ($('#rbShowCancelled').is(':checked')) {
                                var $rowsNo = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Completed"
                                }).hide();

                                var $rowsNo2 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Approved"
                                }).hide();

                                var $rowsNo3 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Cancelled"
                                }).show();
                            }
                        });

                        $('#rbShowCompleted').on('click', function() {
                            if ($('#rbShowCompleted').is(':checked')) {
                                var $rowsNo = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Approved"
                                }).hide();

                                var $rowsNo2 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Cancelled"
                                }).hide();

                                var $rowsNo3 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Completed"
                                }).show();
                            }
                        });

                        $('#rbShowAllAppts').on('click', function() {
                            if ($('#rbShowAllAppts').is(':checked')) {
                                var $rowsNo = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Completed"
                                }).show();

                                var $rowsNo2 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Cancelled"
                                }).show();

                                var $rowsNo3 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Approved"
                                }).show();
                            }
                        });

                        $(document).ready(function() {
                            if ($('#rbShowApproved').is(':checked')) {
                                var $rowsNo = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Completed"
                                }).hide();

                                var $rowsNo2 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Cancelled"
                                }).hide();

                                var $rowsNo3 = $('#apptListDT tbody tr').filter(function() {
                                    return $.trim($(this).find('td').eq(6).text()) === "Approved"
                                }).show();
                            }
                        });
                    </script>
                </div>

                <!-- Pending Requests -->
                <div class="tab-pane" id="apptRequests">
                    <div class="row mb-4">
                        <div class="form-check" style="padding: 0% 2% 0% 30px;">
                            <input class="form-check-input" type="radio" name="rbReqs" id="rbShowPending" checked>
                            <label class="form-check-label" for="rbShowPending">
                                Show Pending Only
                            </label>
                        </div>
                        <div class="form-check" style="padding-right: 2%;">
                            <input class="form-check-input" type="radio" name="rbReqs" id="rbShowDenied">
                            <label class="form-check-label" for="rbShowDenied">
                                Show Denied Only
                            </label>
                        </div>
                        <div class="form-check" style="padding-right: 2%;">
                            <input class="form-check-input" type="radio" name="rbReqs" id="rbShowExpired">
                            <label class="form-check-label" for="rbShowExpired">
                                Show Expired Only
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="rbReqs" id="rbShowAll">
                            <label class="form-check-label" for="chkShowAll">
                                Show All
                            </label>
                        </div>
                    </div>
                    <div class="table-responsive animated--fade-in">
                        <table class="table table-bordered table-condensed table-fixed table-striped" id="apptReqsDT" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th hidden></th>
                                    <th>Patient Name</th>
                                    <th>Date Requested</th>
                                    <th>Time Requested</th>
                                    <th>Day Requested</th>
                                    <th>Clinic</th>
                                    <th>Requested On</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 12%;">Action</th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                    <th hidden></th>
                                </tr>
                            </thead>

                            <?php
                            $res = $con->query($q);
                            while ($rows = $res->fetch_array()) {
                                if ($rows['a_stat'] == 0 || $rows['a_stat'] == 2) {
                            ?>
                                    <tr>
                                        <td hidden><?php echo $rows['a_id']; ?></td>
                                        <td><?php echo $rows['p_fn'] . ' ' . $rows['p_mn'] . ' ' . $rows['p_ln'] . ' ' . $rows['p_s']; ?></td>
                                        <td><?php echo $rows['a_d']; ?></td>
                                        <td><?php echo $rows['a_t']; ?></td>
                                        <td><?php echo $rows['a_day']; ?></td>
                                        <td><?php echo $rows['c_name']; ?></td>
                                        <td><?php echo $rows['date_logged']; ?></td>
                                        <?php if ($rows['a_stat'] == 0) {
                                            if ($rows['a_d'] < $date) { ?>
                                                <td class="text-center">
                                                    <h5><span class="badge badge-pill badge-secondary">Expired</span></h5>
                                                </td>
                                            <?php } else { ?>
                                                <td class="text-center">
                                                    <h5><span class="badge badge-pill badge-warning text-gray-900">Pending</span></h5>
                                                </td>
                                            <?php } ?>
                                        <?php } elseif ($rows['a_stat'] == 2) { ?>
                                            <td class="text-center">
                                                <h5><span class="badge badge-pill badge-danger">Denied</span></h5>
                                            </td>
                                        <?php } ?>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-primary btn-circle btn-sm viewPRBtn" title="View Details"><i class="fas fa-search"></i></button>
                                            <span><button type="button" class="btn btn-success btn-circle btn-sm approveBtn" title="Approve Request" <?php echo (($rows['a_d'] < $date || $rows['a_stat'] == 2) ? 'disabled' : ''); ?>><i class="fas fa-check"></i></button></span>
                                            <span><button type="button" class="btn btn-danger btn-circle btn-sm denyBtn" title="Deny Request" <?php echo (($rows['a_d'] < $date || $rows['a_stat'] == 2) ? 'disabled' : ''); ?>><i class="fas fa-close"></i></button></span>
                                        </td>
                                        <td hidden><?php echo $rows['p_email']; ?></td>
                                        <td hidden><?php echo $rows['p_cn']; ?></td>
                                        <td hidden><?php echo $rows['p_tel']; ?></td>
                                        <td hidden><?php echo $rows['c_addr']; ?></td>
                                    </tr>
                            <?php
                                }
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