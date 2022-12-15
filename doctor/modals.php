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

<!-- Sec List -->
<div class="modal fade" id="secListModal" tabindex="-1" role="dialog" aria-labelledby="secListModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registered Secretaries</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST" id="addServiceForm">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12 container-fluid" id="secRow">
                                <table class="table table-bordered table-condensed table-fixed table-striped table-sm" width="100%" cellspacing="0" id="secTable">
                                    <thead>
                                        <tr>
                                            <th hidden></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone No.</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <?php
                                        $q = $con->query("SELECT * FROM tb_users WHERE role = 4 AND sec_docid = '" . $_SESSION['U_ID'] . "'");
                                        if ($q) {
                                            foreach ($q as $r) {
                                        ?>
                                                <tr>
                                                    <td hidden><?php echo $r['user_id']; ?></td>
                                                    <td><?php echo $r['firstname'] . ' ' . $r['middlename'] . ' ' . $r['lastname'] . ' ' . $r['suffix']; ?></td>
                                                    <td><?php echo $r['email']; ?></td>
                                                    <td><?php echo ($r['phone_no'] == '') ? 'N/A' : $r['phone_no']; ?></td>
                                                    <td class="text-center">
                                                        <h5><span class="badge badge-pill badge-<?php echo ($r['is_active'] == '1') ? 'success' : 'secondary'; ?>"><?php echo ($r['is_active'] == '1') ? 'Active' : 'Inactive'; ?></span></h5>
                                                    </td>
                                                    <td class="text-center"><button onclick="archiveSec(<?php echo $r['user_id']; ?>)" class="btn btn-secondary btn-circle btn-sm" type="button" title="Archive" <?php echo ($r['is_active'] == '0') ? 'disabled' : ''; ?>><i class="fa fa-archive"></i></button></td>
                                                </tr>
                                        <?php }
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
            <script>
                function archiveSec(id) {
                    $.ajax({
                        type: 'POST',
                        url: 'actions.php',
                        data: {
                            "archive_sec": "true",
                            "sec_id": id
                        },
                        dataType: 'json',
                        success: function(msg) {
                            $("#secTable").load(location.href + " #secTable");
                        }
                    });
                }

                $(document).ready(function() {
                    $('#secTable').dataTable();
                });
            </script>
        </div>
    </div>
</div>

<!-- Create Sec -->
<div class="modal fade" id="createSecModal" tabindex="-1" role="dialog" aria-labelledby="createSecModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Secretary Account</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Email</label>
                                <input type="email" name="nae" id="nae" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Password</label>
                                <input type="password" name="nap" id="nap" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>First Name</label>
                                <input type="text" name="nafn" id="nafn" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Middle Name</label>
                                <input type="text" name="namn" id="namn" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Last Name</label>
                                <input type="text" name="naln" id="naln" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label>Suffix</label>
                                <input type="text" name="nasf" id="nasf" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Phone No.</label>
                                <input type="number" id="napn" name="napn" class="form-control" required value="">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Address</span></label>
                                <textarea rows="3" id="naaddr" name="naaddr" class="form-control"></textarea>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="add_sec" name="add_sec" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

<!-- Request Patient Info Modal -->
<div class="modal fade" id="reqInfoModal" tabindex="-1" role="dialog" aria-labelledby="reqInfoModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="c_deactReactTitle">Request Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="arid" name="arid" class="form-control">
                            <div class="col-sm-12">
                                <p>Send information transfer request?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="request_info" name="request_info" class="btn btn-primary">Confirm</button>
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
            <form action="actions.php" method="POST" id="frmAddEditClinic">
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
                                    <label>Open From</label>
                                    <input type="time" id="co" name="co" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label>To</label>
                                    <input type="time" id="cc" name="cc" class="form-control">
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
                <h5 class="modal-title">Add Notes and Additional Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <input type="hidden" id="alp_id" name="alp_id" class="form-control">
                                <label for="ap_clinic">Clinic Contact No.</label>
                                <input type="text" id="alp_clinic" name="alp_clinic" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="alp_cadd">Clinic Address</label>
                                <textarea id="alp_cadd" name="alp_cadd" class="form-control" readonly></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <input type="hidden" id="an_id" name="an_id" class="form-control">
                            <div class="col-sm-12">
                                <label for="alp_desc">Appointment Description</span></label>
                                <textarea id="alp_desc" name="alp_desc" class="form-control" readonly></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="alp_drem">Doctor's Notes (500 characters)</label>
                                <textarea id="alp_drem" name="alp_drem" rows="5" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="save_notes" id="save_notes">Save Notes</button>
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

<!-- Complete Appointment -->
<div class="modal fade" id="compApptModal" tabindex="-1" role="dialog" aria-labelledby="compApptModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="am_title">Complete</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="cacid" name="cacid" class="form-control">
                            <div class="col-sm-12">
                                <p>Mark appointment as complete?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="complete_appointment" name="complete_appointment" class="btn btn-primary">Confirm</button>
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
                            <div class="col-sm-9">
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
                            <div class="col-sm-3">
                                <label>Slots</label>
                                <input type="number" id="smsls" name="smsls" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="">Repeat</label><br>
                                <div id="" class="d-sm-flex align-items-center justify-content-between">
                                    <a class="btn btn-light btn-circle" onclick="markActive('rSu','0','sdays');" id="rSu">Su</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('rMo','1','sdays');" id="rMo">Mo</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('rTu','2','sdays');" id="rTu">Tu</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('rWe','3','sdays');" id="rWe">We</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('rTh','4','sdays');" id="rTh">Th</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('rFr','5','sdays');" id="rFr">Fr</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('rSa','6','sdays');" id="rSa">Sa</a>
                                </div>
                                <input type="hidden" id="sdays" name="sdays">
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
                            <div class="col-sm-9">
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
                            <div class="col-sm-3">
                                <label>Slots</label>
                                <input type="number" id="smslse" name="smslse" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="">Repeat</label><br>
                                <div id="" class="d-sm-flex align-items-center justify-content-between">
                                    <a class="btn btn-light btn-circle" onclick="markActive('erSu','0','esdays');" id="erSu">Su</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('erMo','1','esdays');" id="erMo">Mo</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('erTu','2','esdays');" id="erTu">Tu</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('erWe','3','esdays');" id="erWe">We</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('erTh','4','esdays');" id="erTh">Th</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('erFr','5','esdays');" id="erFr">Fr</a>
                                    <a class="btn btn-light btn-circle" onclick="markActive('erSa','6','esdays');" id="erSa">Sa</a>
                                </div>
                                <input type="hidden" id="esdays" name="esdays">
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

<!-- Approve req -->
<div class="modal fade" id="approveReq" tabindex="-1" role="dialog" aria-labelledby="approveReq" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Approve</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="aridm" name="aridm" class="form-control">
                            <div class="col-sm-12">
                                <p>Approve request?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="approve_req" name="approve_req" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Deny req -->
<div class="modal fade" id="denyReq" tabindex="-1" role="dialog" aria-labelledby="denyReq" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deny</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="drid" name="drid" class="form-control">
                            <div class="col-sm-12">
                                <p>Deny request?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="deny_req" name="deny_req" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add services -->
<div class="modal fade" id="addServicesModal" tabindex="-1" role="dialog" aria-labelledby="addServicesModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Service</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST" id="addServiceForm">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="text" name="ns" id="ns" class="form-control">
                            <select name="nss" id="nss" class="form-control">
                                <option value="" selected>Select from existing services...</option>
                                <?php
                                $q = $con->query("SELECT * FROM tb_services WHERE srv_stat = 1");
                                if ($q) {
                                    foreach ($q as $r) { ?>
                                        <option value="<?php echo $r['serv_id']; ?>"><?php echo $r['srv_desc']; ?></option>
                                <?php }
                                }
                                ?>
                            </select>

                            <button class="btn btn-success btn-sm mt-3 btnServ" type="button" title="Add New Service"><i class="fa fa-plus"></i>&nbsp; New</button>
                        </div>
                        <div class="row mt-3" id="servTableRow">
                            <table class="table table-bordered table-condensed table-fixed table-striped table-sm" width="100%" cellspacing="0" id="servTable">
                                <thead>
                                    <tr>
                                        <th hidden></th>
                                        <th>Description</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q = $con->query("SELECT * FROM tb_doctor_services tds INNER JOIN tb_services ts ON tds.sev_is = ts.serv_id WHERE tds.sd_stat = 1 AND tds.doc_id = '" . $_SESSION['U_ID'] . "'");
                                    if ($q) {
                                        foreach ($q as $r) {
                                    ?>
                                            <tr>
                                                <td hidden><?php echo $r['srv_id']; ?></td>
                                                <td><?php echo $r['srv_desc']; ?></td>
                                                <td class="text-center"><button onclick="archiveServ(<?php echo $r['srv_id']; ?>)" class="btn btn-secondary btn-circle btn-sm" type="button" title="Archive"><i class="fa fa-archive"></i></button></td>
                                            </tr>
                                    <?php }
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="add_service" name="add_service" class="btn btn-primary">Confirm</button>
                </div>
            </form>
            <script>
                $(document).ready(function() {
                    $('#ns').attr('type', 'hidden');
                });

                var def = true;

                $('.btnServ').on('click', function() {
                    if (def == false) {
                        $('#ns').attr('type', 'hidden');
                        $('#nss').attr('hidden', false);
                        $('.btnServ').removeClass('btn btn-primary btn-sm btnServ').addClass('btn btn-success btn-sm btnServ');
                        $('.btnServ').html('<i class="fa fa-plus"></i> New');

                        def = true;
                    } else {
                        $('#ns').attr('type', 'text');
                        $('#nss').attr('hidden', true);
                        $('.btnServ').removeClass('btn btn-success btn-sm btnServ').addClass('btn btn-primary btn-sm btnServ');
                        $('.btnServ').html('<i class="fa fa-plus"></i> Existing');
                        def = false;
                    }
                });

                function archiveServ(id) {
                    $.ajax({
                        type: 'POST',
                        url: 'actions.php',
                        data: {
                            "archive_serv": "true",
                            "id": id
                        },
                        dataType: 'json',
                        success: function(msg) {
                            console.log(id + ' - ' + msg);
                            $("#servTableRow").load(location.href + " #servTable");
                        }
                    });
                }
            </script>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#addEditClinicModal').find('input:text').val('');

        $('#addEditClinicModal').on('hidden.bs.modal', function() {
            $('#addEditClinicModal').find('input').val('');
            $('#addEditClinicModal').find('textarea').val('');
        });
    });

    function markActive(id, no, input) {
        var el = document.getElementById(id);
        var d = document.getElementById(input);

        if (el.classList.contains('active')) {
            $('#' + id + '').removeClass('btn btn-primary btn-circle active');
            $('#' + id + '').addClass('btn btn-primary btn-circle');

            var rVal = d.value;

            $('#' + input + '').val(rVal.replace(no, ''));

        } else {
            $('#' + id + '').removeClass('btn btn-primary btn-circle');
            $('#' + id + '').addClass('btn btn-primary btn-circle active');

            if (d.value == '') {
                $('#' + input + '').val(no);
            } else {
                $('#' + input + '').val(d.value + no);
            }
        }
    }
</script>