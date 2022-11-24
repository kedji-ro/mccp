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

<!-- Deact User Modal-->
<div class="modal fade" id="deactUserModal" role="dialog" aria-labelledby="deactUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <input type="hidden" name="u_id" id="u_id">
                <div class="modal-body">Deactivate user?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="deact_user" id="deact_user">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- React User Modal-->
<div class="modal fade" id="reactUserModal" role="dialog" aria-labelledby="reactUserModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <input type="hidden" name="ur_id" id="ur_id">
                <div class="modal-body">Reactivate user?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="deact_user" id="deact_user">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                            <input type="hidden" id="c_id" name="c_id" class="form-control">
                            <div class="col-sm-12">
                                <label for="c_name">Clinic Name <span style="color: red;">*</span></label>
                                <input type="text" id="c_name" name="c_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label for="c_phoneno">Clinic Phone No. <span style="color: red;">*</span></label>
                                <input type="text" id="c_phoneno" name="c_phoneno" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="c_telno">Clinic Tel No.</label>
                                <input type="text" id="c_telno" name="c_telno" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="c_address">Clinic Address <span style="color: red;">*</span></label>
                                <textarea type="text" id="c_address" name="c_address" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="addedit_clinic" name="add_clinic" class="btn btn-primary">Confirm</button>
                </div>
            </form>
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

<!-- View/Edit Doctor Modal -->
<div class="modal fade" id="viewEditDoctorModal" tabindex="-1" role="dialog" aria-labelledby="viewEditDoctorModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="c_deactReactTitle">Doctor Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../actions/update-profile.php" method="POST">
                <div class="modal-body">
                    <h4>User Information</h4>

                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <label for="user">Username</label>
                        </div>
                        <div class="col-md-5">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-5">
                            <input type="text" name="u_user" id="u_user" class="form-control" placeholder="" required value="" readonly />
                        </div>
                        <div class="form-group col-md-7">
                            <?php
                            // $atPos = strpos($row['email'], '@') - 1;
                            // $email = substr_replace($row['email'], "******", 1, $atPos);
                            ?>
                            <input type="text" name="u_email" id="u_email" class="form-control" placeholder="" required value="" readonly />
                        </div>
                    </div>
                    <br>

                    <h4>Personal Information</h4>
                    <div class="row align-items-center">
                        <div class="form-group col-md-3">
                            <label for="fname">First Name</label>
                            <input type="text" name="u_fname" id="u_fname" class="form-control" placeholder="" required value="" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="mname">Middle Name</label>
                            <input type="text" name="u_mname" id="u_mname" class="form-control" placeholder="" value="" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="lname">Last Name</label>
                            <input type="text" name="u_lname" id="u_lname" class="form-control" placeholder="" required value="" />
                        </div>
                        <div class="form-group col-md-2">
                            <label for="sufx">Suffix</label>
                            <input type="text" name="u_sufx" id="u_sufx" class="form-control" placeholder="" value="" />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <label for="dob">Date of Birth</label>
                        </div>
                        <div class="col-md-2">
                            <label for="dob">Age</label>
                        </div>
                        <div class="col-md-4">
                            <label for="dob">Phone No.</label>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group input-group col-md-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" name="u_dob" id="u_dob" class="form-control" required value="" />
                        </div>
                        <div class="form-group col-md-2">
                            <input type="text" name="age" id="age" class="form-control" placeholder="Age" readonly value="" />
                        </div>
                        <div class="form-group col-md-5">
                            <input type="text" name="u_phone" id="u_phone" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-12">
                            <label for="u_add">Address</label>
                            <textarea type="text" name="u_add" id="u_add" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-5">
                            <label for="spec">License No.</label>
                            <input type="text" name="u_lic" id="u_lic" class="form-control" required value="" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="spec">Specialization</label>
                            <input type="text" name="u_spec" id="u_spec" class="form-control" required value="" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="degree">Title</label>
                            <input type="text" name="u_title" id="u_title" class="form-control" required value="" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="u_save" id="u_save" class="btn btn-success"><i class="fas fa-save"></i>&nbsp; Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
