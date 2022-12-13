<?php

$q = $con->query("SELECT    schedule_id as s_id,
                            doctor_id as sd_id, 
                            days_available as s_days, 
                            date_available as s_d, 
                            slots,
                            tds.s_stat,
                            tc.clinic_name as s_cname,
                            tc.clinic_address as s_caddrs,
                            tds.bg_color,
                            tds.start_time, tds.end_time, tds.clinic_id as c_id
                            FROM tb_doctor_schedule tds  
                            LEFT JOIN tb_clinic tc ON tc.clinic_id = tds.clinic_id WHERE doctor_id = " . $_SESSION['U_ID']);

$schedules = [];
$sched = [];

foreach ($q as $row) {
    if ($row['s_stat'] != 0) {
        $daysofweek = explode(',', $row['s_days']);

        $sched['title'] = (count($daysofweek) > 1) ? $row['s_cname'].' (R)' : $row['s_cname'];
        $sched['start'] = $row['s_d'];
        $sched['backgroundColor'] = $row['bg_color'];
        $sched['borderColor'] = $row['bg_color'];
        $sched['daysOfWeek'] = (count($daysofweek) > 1) ? $daysofweek : null;
        
        $sched['textColor'] = strpos(strval($row['bg_color']),'99') ? 'black' : 'white';
    
    }
    
    $schedules[] = $sched;
}
?>

<script>
    var scheds = $.parseJSON('<?= json_encode($schedules) ?>');
</script>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Schedule Management</h1>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addSchedModal">
        <i class="fas fa-plus"></i> New Schedule</button>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
        <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" href="#schedCalendar" data-toggle="tab">Calendar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#schedLists" data-toggle="tab">Schedules</a>
            </li>
        </ul>
    </div>
    <div class="card-body">

        <!-- Tab Content -->
        <div class="content tab-content">
            <div class="tab-pane active" id="schedCalendar">
                <div class="content animated--fade-in">
                    <div id='sched-calendar'></div> <br>
                </div>
            </div>

            <div class="tab-pane" id="schedLists">
                <div class="row mb-4">
                </div>
                <div class="table-responsive animated--fade-in">
                    <table class="table table-bordered table-condensed table-fixed table-striped" id="list" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden></th>
                                <th>Clinic Name</th>
                                <th>Date</th>
                                <th>Recurring Days</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Slots</th>
                                <th>Color</th>
                                <th class="text-center" style="width: 8%;">Status</th>
                                <th class="text-center" style="width: 8%;">Actions</th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                                <th hidden></th>
                            </tr>
                        </thead>

                        <?php

                        if ($q) {
                            foreach ($q as $rows) {
                                $daysofweek = explode(',', $rows['s_days']);
                                $rdays = array();
                                foreach ($daysofweek as $d) {
                                    $rdays[] = date('l', strtotime("Sunday +{$d} days"));
                                }

                                $rdays = implode(', ', $rdays);
                        ?>
                                <tr>
                                    <td hidden><?php echo $rows['s_id']; ?></td>
                                    <td><?php echo $rows['s_cname']; ?></td>
                                    <td><?php echo $rows['s_d']; ?></td>
                                    <td><?php echo ($rows['s_days'] == '') ? date("l",strtotime($rows['s_d'])) : $rdays; ?></td>
                                    <td><?php echo date("h:i A",strtotime($rows['start_time'])); ?></td>
                                    <td><?php echo date("h:i A",strtotime($rows['end_time'])); ?></td>
                                    <td><?php echo $rows['slots']; ?></td>
                                    <td><div class="container-fluid" style="background-color: <?php echo $rows['bg_color']; ?>;">&nbsp;</div></td>
                                    <?php if ($rows['s_stat'] == '1') { ?>
                                        <td class="text-center">
                                            <h5><span class="badge badge-pill badge-success">Active</span></h5>
                                        </td>
                                    <?php } else { ?>
                                        <td class="text-center">
                                            <h5><span class="badge badge-pill badge-secondary">Inactive</span></h5>
                                        </td>
                                    <?php } ?>

                                    <td class="text-center"><button type="button" class="btn btn-sm btn-primary btn-circle editSchedBtn" title="View/Edit Details" <?php echo (($rows['s_stat'] == '0') ? 'disabled' : ''); ?>><i class="fas fa-edit"></i> </button>
                                        <span> <button type="button" class="btn btn-sm btn-secondary btn-circle deactSchedBtn" title="Archive" <?php echo (($rows['s_stat'] == '0') ? 'disabled' : ''); ?>><i class="fas fa-archive"></i></button></span>
                                    </td>
                                    <td hidden><?php echo $rows['bg_color']; ?></td>
                                    <td hidden><?php echo $rows['start_time']; ?></td>
                                    <td hidden><?php echo $rows['end_time']; ?></td>
                                    <td hidden><?php echo $rows['c_id']; ?></td>
                                    <td hidden><?php echo $rows['days_available']; ?></td>

                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('.deactSchedBtn').on('click', function() {

        $('#deactSchedModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#sid').val(data[0]);
    });

    $('.editSchedBtn').on('click', function() {

        $('#editSchedModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#esid').val(data[0]);
        $('#esc').val(data[10]);
        $('#escl').val(data[13]);
        $('#esd').val(data[2]);
        $('#esst').val(data[11]);
        $('#eset').val(data[12]);
        $('#smslse').val(data[6]);


    });


    $(document).ready(function() {
        $('#list').dataTable().fnSort( [ [7,'asc'] ] );
        
        var calendarSched = document.getElementById('sched-calendar');

        var calendarS = new FullCalendar.Calendar(calendarSched, {
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
            events: scheds
        });

        calendarS.render();
    });
</script>