<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center">Set an Appointment</h1>
</div> -->
<h3 class="h3 mb-3 align-items-center text-center">Request Information Transfer</h3>
<div class="row animated--fade-in">
    <div class="col-sm-4 container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <form action="actions.php" method="POST">
                <div class="card-body">
                    <div class="card-body text-black">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>From</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-user-doctor"></i></div>
                                    </div>
                                    <select class="form-control" name="d_from" id="d_from" required>

                                        <option value="" selected>Select Doctor</option>
                                        <?php
                                        $q = "SELECT * FROM tb_users tu 
                                                INNER JOIN tb_appointment ta ON ta.doctor_id = tu.user_id
                                                WHERE tu.role = '2' AND ta.patient_id = '" . $_SESSION['U_ID'] . "'";
                                        $q_run = mysqli_query($con, $q);
                                        if ($q_run) {
                                            foreach ($q_run as $rows) { ?>
                                                <option value="<?php echo $rows['user_id']; ?>"><?php echo $rows['firstname'] . ' ' . $rows['middlename'] . ' ' . $rows['lastname'] . ' ' . $rows['suffix']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>To</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa-solid fa-share"></i></div>
                                    </div>
                                    <select class="form-control" name="d_to" id="d_to" required>
                                        <option value="" selected>Select Doctor</option>
                                        <?php
                                        $q = "SELECT * FROM tb_users tu WHERE tu.role = '2'";
                                        $q_run = mysqli_query($con, $q);
                                        if ($q_run) {
                                            foreach ($q_run as $rows) { ?>
                                                <option value="<?php echo $rows['user_id']; ?>"><?php echo $rows['firstname'] . ' ' . $rows['middlename'] . ' ' . $rows['lastname'] . ' ' . $rows['suffix']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3" style="padding: 15px;">
                            <p class="small">
                                <span style="font-weight: bold;">NOTE: </span>
                                Upon approval of information transfer request, the recieving doctor will have access to all your appointment history data.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" type="submit" name="request_transfer" id="request_transfer" title="Book Now"><i class="fa fa-paper-plane fa-sm"></i>&nbsp;&nbsp;Send Request</button>
                </div>
        </div>
        </form>
    </div>
</div>

<script>

</script>