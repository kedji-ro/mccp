<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<div class="row animated--fade-in">

    <?php
    $query = "SELECT 1 FROM tb_users WHERE role = 3";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_num_rows($query_run);
    ?>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            TOTAL REG. MOTHERS</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $query = "SELECT child_id FROM tb_child_details ORDER BY child_id";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_num_rows($query_run);
    ?>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            TOTAL REG. CHILDREN</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $query = "SELECT * FROM tb_users WHERE role = '2'";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_num_rows($query_run);
    ?>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">TOTAL REG. DOCTORS
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row; ?></div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    $query = "SELECT appointment_id FROM tb_appointment ORDER BY appointment_id";
    $query_run = mysqli_query($con, $query);
    $row = mysqli_num_rows($query_run);
    ?>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            TOTAL APPOINTMENTS</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $row; ?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>