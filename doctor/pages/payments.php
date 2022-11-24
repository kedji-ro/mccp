<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Payment History</h1>
</div>

<?php
$q = "SELECT *
        FROM tb_payment 
        INNER JOIN tb_appointment on tb_appointment.appointment_id = tb_payment.appt_id
        INNER JOIN tb_users on tb_users.user_id = tb_appointment.patient_id
        LEFT JOIN tb_clinic on tb_clinic.clinic_id = tb_appointment.clinic_id
        WHERE tb_payment.doctor_id = " . $_SESSION['ADMIN_ID'];
$query_run = mysqli_query($con, $q);
?>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3"></div>
    <div class="card-body">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-fixed table-striped" id="list" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Appt<br>No.</th>
                            <th>Patient</th>
                            <th>Clinic</th>
                            <th>Date Recieved</th>
                            <th>Full Amount</th>
                            <th>HMO Discount</th>
                            <th>Payment Method</th>
                            <th class="text-center" style="width: 9%;">Action</th>
                        </tr>
                    </thead>

                    <?php
                    if ($query_run) {
                        foreach ($query_run as $rows) {
                    ?>
                            <tr>
                                <td><?php echo $rows['appt_id']; ?></td>
                                <td><?php echo $rows['lastname'].', '.$rows['firstname']. ' '. $rows['middlename'].' '.$rows['suffix']; ?></td>
                                <td><?php echo $rows['clinic_name']; ?></td>
                                <td><?php echo $rows['date_paid']; ?></td>
                                <td><?php echo $rows['amount_paid']; ?></td>
                                <td><?php echo $rows['hmo_discount']; ?></td>
                                <td><?php echo $rows['payment_method']; ?></td>
                
                                <td class="text-center"><button type="button" class="btn btn-primary btn-sm" title="View Details"><i class="fas fa-search"></i></button>
                                    <span><button type="button" class="btn btn-secondary btn-sm" title="Print"><i class="fas fa-print"></i></button></span>
                            </tr>
                    <?php
                        }
                    } else {
                        echo $con->error;
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>