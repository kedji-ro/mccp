<!-- Toast -->
<?php if (isset($_SESSION['msg'])) { ?>
    <div class="toast" style="position: absolute; top: 30px; right: 25px; width: 500px;">
        <div class="toast-header" style="background-color:<?php echo $_SESSION['msg-bg']; ?>;">
            <strong class="mr-auto text-<?php echo $_SESSION['msg-t']; ?>"><?php if (isset($_SESSION['msg-h'])) {
                                                                                echo $_SESSION['msg-h'];
                                                                            } else {
                                                                                echo 'Toast Header';
                                                                            } ?></strong>
            <!-- <small class="text-muted">5 mins ago</small> -->
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
        </div>
        <div class="toast-body" style="background-color:<?php echo $_SESSION['msg-bg']; ?>50;">
            <?php if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
            } else {
                echo 'Toast Body';
            } ?>
        </div>
    </div>
<?php } ?>

<!-- Change Password Modal-->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="d_cOldPass">Old Passwword <span style="color: red;">*</span></label>
                            <input type="password" id="d_cOldPass" name="d_cOldPass" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <label for="d_cNewPass">New Passwword <span style="color: red;">*</span></label>
                            <input type="password" id="d_cNewPass" name="d_cNewPass" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="d_cRePass">Confirm Passwword <span style="color: red;">*</span></label>
                            <input type="password" id="d_cRePass" name="d_cRePass" class="form-control">
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="">Confirm</a>
            </div>
        </div>
    </div>
</div>


<!-----------------------------------------------------
-              ** Modals Per Module **                -
------------------------------------------------------>

<!-----------------------------------------------------
-            Patient Transfer Modals Start            -
------------------------------------------------------>
<!-- Transfer Patient Modal -->
<div class="modal fade" id="transferPatientModal" tabindex="-1" role="dialog" aria-labelledby="transferPatientModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Transfer Patient</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <form action="actions.php" method="POST">
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="tp_name">Patient Name</label>
                                <input type="hidden" id="tp_aid" name="tp_aid" class="form-control">
                                <input type="text" id="tp_name" name="tp_name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="tp_currclinic">Current Clinic</label>
                                <input type="text" id="tp_currclinic" name="tp_currclinic" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <?php
                            $q = "SELECT * FROM tb_clinic WHERE c_stat = 1 ORDER BY clinic_name";
                            $q_run = mysqli_query($con, $q);
                            ?>

                            <div class="col-sm-12">
                                <label for="tp_toclinic">Transfer To</span></label>
                                <select class="form-control" name="tp_toclinic" id="tp_toclinic">
                                    <option selected>Select clinic...</option>
                                    <?php
                                    if ($q_run) {
                                        foreach ($q_run as $rows) { ?>
                                            <option value="<?php echo $rows['clinic_id']; ?>"><?php echo $rows['clinic_name']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                </div>
            </div><br>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <button class="btn btn-primary" type="submit" id="transfer_patient" name="transfer_patient">Confirm</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!----------- Patient Transfer Modals End ------------>


<!-----------------------------------------------------
-                Clinics Modals Start                 -
------------------------------------------------------>
<!-- Add/Edit Clinic Modal-->
<div class="modal fade" id="addEditClinicModal" tabindex="-1" role="dialog" aria-labelledby="addEditClinicModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><span id="c_mTitle">Add</span> New Clinic</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button class="btn btn-success btn-sm newClinicBtn" type="button"><i class="fa fa-plus"></i> New Clinic</button>
                            </div>
                        </div>
                        <div class="addExistingClinicDiv">
                            <?php
                            $q = "SELECT * FROM tb_clinic WHERE c_stat = 1 ORDER BY clinic_name";
                            $q_run = mysqli_query($con, $q);
                            ?>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <select class="form-control" name="c_eid" id="c_eid">
                                        <option value="-1" selected>Select from existing clinics...</option>
                                        <?php
                                        if ($q_run) {
                                            foreach ($q_run as $rows) { ?>
                                                <option value="<?php echo $rows['clinic_id']; ?>"><?php echo $rows['clinic_name']; ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="addNewClinicDiv" hidden>
                            <div class="row mt-3">
                                <input type="hidden" id="c_id" name="c_id" class="form-control">
                                <div class="col-sm-12">
                                    <label for="c_name">Clinic Name <span style="color: red;">*</span></label>
                                    <input type="text" id="c_name" name="c_name" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-6">
                                    <label for="c_phoneno">Clinic Phone No. <span style="color: red;">*</span></label>
                                    <input type="text" id="c_phoneno" name="c_phoneno" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label for="c_telno">Clinic Tel No.</label>
                                    <input type="text" id="c_telno" name="c_telno" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <label for="c_address">Clinic Address <span style="color: red;">*</span></label>
                                    <textarea type="text" id="c_address" name="c_address" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="addedit_clinic" name="add_clinic" class="btn btn-primary">Confirm</button>
                </div>
            </form>
            <script>
                var def = true;

                $('.newClinicBtn').on('click', function() {
                    if (def == false) {
                        $('.addExistingClinicDiv').attr('hidden', false);
                        $('.addNewClinicDiv').attr('hidden', true);
                        $('.newClinicBtn').removeClass('btn btn-primary btn-sm newClinicBtn').addClass('btn btn-success btn-sm newClinicBtn');
                        $('.newClinicBtn').html('<i class="fa fa-plus"></i> New Clinic');

                        def = true;
                    } else {
                        $('.addNewClinicDiv').attr('hidden', false);
                        $('.addExistingClinicDiv').attr('hidden', true);
                        $('.newClinicBtn').removeClass('btn btn-success btn-sm newClinicBtn').addClass('btn btn-primary btn-sm newClinicBtn');
                        $('.newClinicBtn').html('<i class="fa fa-plus"></i> Add Existing Clinic');

                        def = false;
                    }
                });
            </script>
        </div>
    </div>
</div>

<!-- Deactivate/Reactivate Clinic Modal -->
<div class="modal fade" id="deactReactClinicModal" tabindex="-1" role="dialog" aria-labelledby="deactReactClinicModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="c_deactReactTitle">Deactivate</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="c_drid" name="c_drid" class="form-control">
                            <input type="hidden" id="c_stat" name="c_stat" class="form-control">
                            <div class="col-sm-12">
                                <p><span id="c_op">Deactivate</span> <span id="c_drname" style="font-weight: bold;"></span>?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="deactreact_clinic" name="deactreact_clinic" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!---------------- Clinics Modals End ---------------->


<!-----------------------------------------------------
-             Appointments Modals Start               -
------------------------------------------------------>
<!-- View Appointment From Calendar Modal -->
<div class="modal fade" id="viewAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="viewAppointmentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Appointment Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <h4><span class="badge badge-success">STATUS</span></h4>
                        <div class="row">
                            <input type="hidden" id="ap_id" name="ap_id" class="form-control">
                            <div class="col-sm-12">
                                <label for="ap_name">Patient Name</span></label>
                                <input type="text" id="ap_name" name="ap_name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="ap_con">Contact No.</label>
                                <input type="text" id="ap_con" name="ap_con" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-7">
                                <label for="ap_date">Appointment Date</label>
                                <input type="text" id="ap_date" name="ap_date" class="form-control" readonly>
                            </div>
                            <div class="col-sm-5">
                                <label for="ap_time">Time</label>
                                <input type="text" id="ap_time" name="ap_time" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="ap_clinic">Clinic</label>
                                <input type="text" id="ap_clinic" name="ap_clinic" class="form-control" readonly>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Appointment From List Modal -->
<div class="modal fade" id="viewAppointmentListModal" tabindex="-1" role="dialog" aria-labelledby="viewAppointmentListModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Appointment Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3 text-gray-900">
                            <div class="col-sm-12">
                                <h5>Patient Information</h5>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" id="alp_id" name="alp_id" class="form-control">
                            <div class="col-sm-12">
                                <label for="alp_name">Name</span></label>
                                <input type="text" id="alp_name" name="alp_name" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="alp_pemail">Email</label>
                                <input type="text" id="alp_pemail" name="alp_pemail" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label for="alp_con">Contact No.</label>
                                <input type="text" id="alp_con" name="alp_con" class="form-control" readonly>
                            </div>
                            <div class="col-sm-6">
                                <label for="alp_tel">Tel No.</label>
                                <input type="text" id="alp_tel" name="alp_tel" class="form-control" readonly>
                            </div>
                        </div> <br>
                        <div class="row mt-3 text-gray-900">
                            <div class="col-sm-12">
                                <h5>Appointment Information</h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-7">
                                <label for="alp_date">Date</label>
                                <input type="text" id="alp_date" name="alp_date" class="form-control" readonly>
                            </div>
                            <div class="col-sm-5">
                                <label for="alp_time">Time</label>
                                <input type="text" id="alp_time" name="alp_time" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="ap_clinic">Clinic</label>
                                <input type="text" id="alp_clinic" name="alp_clinic" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="alp_cadd">Clinic Address</label>
                                <textarea id="alp_cadd" name="alp_cadd" class="form-control" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approve/Deny Appointment Request -->
<div class="modal fade" id="approveApptModal" tabindex="-1" role="dialog" aria-labelledby="approveApptModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="am_title">Approve</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="am_id" name="am_id" class="form-control">
                            <input type="hidden" id="am_appstat" name="am_appstat" class="form-control">
                            <div class="col-sm-12">
                                <p><span id="am_op">Approve</span> appointment request by <span id="am_pname" style="font-weight: bold;"></span>?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="approvedeny_appointment" name="approvedeny_appointment" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cancel Appointment -->
<div class="modal fade" id="cancelApptModal" tabindex="-1" role="dialog" aria-labelledby="cancelApptModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="cam_id" name="cam_id" class="form-control">
                            <div class="col-sm-12">
                                <p>Cancel apppointment?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="cancel_appointment" name="cancel_appointment" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reschedule Appointment -->
<div class="modal fade" id="reschedModal" tabindex="-1" role="dialog" aria-labelledby="reschedModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reschedule Appointment</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col-sm-7">
                                <input type="hidden" id="raid" name="raid" class="form-control">
                                <label for="rad">Date</label>
                                <input type="date" id="rad" name="rad" class="form-control">
                            </div>
                            <div class="col-sm-5">
                                <label for="rat">Time</label>
                                <input type="time" id="rat" name="rat" class="form-control">
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="resched_appointment" name="resched_appointment">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!------------ Appointments Modals End --------------->

<!----------------------------------------------------
-            Manage Schedule Modals Start            -
----------------------------------------------------->
<!-- Add Schedule Modal -->
<div class="modal fade" id="addSchedModal" tabindex="-1" role="dialog" aria-labelledby="addSchedModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Schedule</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3">
                            <input type="hidden" id="sm_id" name="sm_id" class="form-control">
                            <div class="col-sm-9">
                                <label for="sm_date">Date</span></label>
                                <input type="date" id="sm_date" name="sm_date" class="form-control" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="sm_color">Color &nbsp;</label><i class="fa fa-circle-question" title="Sets color in Calendar. Uses Blue as Default."></i>
                                <input class="form-control" type="color" id="sm_color" name="sm_color" value="#4e73df"><br><br>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label for="sm_st">Start Time</span></label>
                                <input type="time" id="sm_st" name="sm_st" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="sm_et">End Time</label>
                                <input type="time" id="sm_et" name="sm_et" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="sm_clinic">Clinic</label>
                                <select class="form-control" name="sm_clinic" id="sm_clinic" required>
                                    <option selected>Select clinic...</option>
                                    <?php
                                    if ($q_run) {
                                        foreach ($q_run as $rows) { ?>
                                            <option value="<?php echo $rows['clinic_id']; ?>"><?php echo $rows['clinic_name']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="">Repeat</label><br>
                                <div id="" class="d-sm-flex align-items-center justify-content-between">
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rSu">Su</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rMo">Mo</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rTu">Tu</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rWe">We</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rTh">Th</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rFr">Fr</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rSa">Sa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="add_schedule" name="add_schedule">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Schedule Modal -->
<div class="modal fade" id="editSchedModal" tabindex="-1" role="dialog" aria-labelledby="editSchedModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Schedule</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3">
                            <input type="hidden" id="esid" name="esid" class="form-control">
                            <div class="col-sm-9">
                                <label for="sm_date">Date</span></label>
                                <input type="date" id="esd" name="esd" class="form-control" required>
                            </div>
                            <div class="col-sm-3">
                                <label for="esc">Color &nbsp;</label><i class="fa fa-circle-question" title="Sets color in Calendar. Uses Blue as Default."></i>
                                <input class="form-control" type="color" id="esc" name="esc" value="#4e73df"><br><br>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label for="sm_st">Start Time</span></label>
                                <input type="time" id="esst" name="esst" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="sm_et">End Time</label>
                                <input type="time" id="eset" name="eset" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="sm_clinic">Clinic</label>
                                <select class="form-control" name="escl" id="escl" required>
                                    <option selected>Select clinic...</option>
                                    <?php
                                    if ($q_run) {
                                        foreach ($q_run as $rows) { ?>
                                            <option value="<?php echo $rows['clinic_id']; ?>"><?php echo $rows['clinic_name']; ?></option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="">Repeat</label><br>
                                <div id="" class="d-sm-flex align-items-center justify-content-between">
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rSu">Su</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rMo">Mo</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rTu">Tu</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rWe">We</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rTh">Th</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rFr">Fr</a>
                                    <a class="btn btn-light btn-circle" onclick="$(this).addClass('btn btn-primary btn-circle active');" id="rSa">Sa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="edit_schedule" name="edit_schedule">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Deactivate Schedule Modal -->
<div class="modal fade" id="deactSchedModal" tabindex="-1" role="dialog" aria-labelledby="deactSchedModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"></h5>Deactivate</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="sid" name="sid" class="form-control">
                            <div class="col-sm-12">
                                <p>Deactivate schedule?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="deactivate_sched" name="deactivate_sched" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>