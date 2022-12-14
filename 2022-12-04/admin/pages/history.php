<?php

$q = "SELECT    tb_appointment.appointment_id as a_id,
                tb_appointment.patient_id as p_id,
                DATE(tb_appointment.appointment_date) as a_d,
                TIME_FORMAT(TIME(tb_appointment.appointment_date), '%h:%i %p') as a_t,
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
                tb_users.email as p_email
                FROM tb_appointment 
                INNER JOIN tb_users on tb_users.user_id = tb_appointment.patient_id
                LEFT JOIN tb_clinic on tb_clinic.clinic_id = tb_appointment.clinic_id";
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Appointments History</h1>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="card-body text-black">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Patient Name</th>
                            <th>Doctor Appointed</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Clinic</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <?php
                    $query_run = mysqli_query($con, $q);

                    if ($query_run) {
                        foreach ($query_run as $rows) {
                    ?>
                            <tr>
                                <td><?php echo $rows['a_id']; ?></td>
                                <td><?php echo $rows['p_ln'] . ', ' . $rows['p_fn'] . ' ' . $rows['p_mn'] . ' ' . $rows['p_s']; ?></td>
                                <td><?php  ?></td>
                                <td><?php echo $rows['a_d']; ?></td>
                                <td><?php echo $rows['a_t']; ?></td>
                                <td><?php echo $rows['c_name']; ?></td>
                                <?php if ($rows['a_stat'] == 1 && $rows['a_d'] >= $date) { ?>
    <td class="text-center">
      <h5><span class="badge badge-pill badge-primary">Approved</span></h5>
    </td>
  <?php } elseif ($rows['a_stat'] == 2) { ?>
    <td class="text-center">
      <h5><span class="badge badge-pill badge-danger">Cancelled</span></h5>
    </td>
    <?php } elseif ($rows['a_stat'] == 0) {
    if ($rows['a_d'] >= $date) { ?>
      <td class="text-center">
        <h5><span class="badge badge-pill badge-warning text-gray-900">Pending</span></h5>
      </td>
    <?php } else { ?>
      <td class="text-center">
        <h5><span class="badge badge-pill badge-secondary">Expired</span></h5>
      </td>
    <?php }
  } else { ?>
    <td class="text-center">
      <h5><span class="badge badge-pill badge-success">Completed</span></h5>
    </td>
  <?php } ?>
                                <td class="text-center"><button type="button" class="btn btn-primary btn-sm btn-circle" title="View Details"><i class="fas fa-search"></i></button>
                                    <span><button type="button" class="btn btn-secondary viewbtn btn-sm btn-circle" title="Print"><i class="fas fa-print"></i></button></span>
                                </td>
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

<script>

</script>