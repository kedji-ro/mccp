<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row animated--fade-in">
    <?php
    $query = "SELECT appointment_id FROM tb_appointment WHERE doctor_id = '" . $_SESSION['U_ID'] . "'  AND DATE(appointment_date) = DATE(NOW()) ORDER BY appointment_id";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_num_rows($query_run);
    ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-danger shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                            Today's Appointments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-user-clock fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $query = "SELECT appointment_id FROM tb_appointment 
                WHERE doctor_id = '" . $_SESSION['ADMIN_ID'] . "' 
                AND a_stat = 1 AND  DATE(appointment_date) > DATE(NOW()) ";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_num_rows($query_run);
    ?>
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Active Appointments</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-check fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Total Pending Appointment Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $_SESSION['APPT_COUNT']; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Incoming Patient Info Requests</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $_SESSION['PATREQ_COUNT']; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fa fa-info-circle fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>