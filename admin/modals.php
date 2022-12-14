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

<!-- Reg Mother -->
<div class="modal fade" id="regMotherModal" tabindex="-1" role="dialog" aria-labelledby="regMotherModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Mother</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                 <div class="modal-body">
                    <h5>User Information</h5>
                    <div class="row align-items-center">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="em" id="em" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="ppass" id="ppass" class="form-control" required>
                        </div>
                    </div>
                    <br>

                    <h5>Personal Information</h5>
                    <div class="row align-items-center">
                        <div class="form-group col-md-4">
                            <label>First Name</label>
                            <input type="text" name="pfn" id="pfn" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Middle Name</label>
                            <input type="text" name="pmn" id="pmn" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Last Name</label>
                            <input type="text" name="pln" id="pln" class="form-control" required>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <label for="sufx">First Day of Last Men Period</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" name="pmen" id="pmen" class="form-control" placeholder="Date of Birth" required value="<?php echo $row['date_first_men_period']; ?>" />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Marital Status</label>
                            <input type="text" name="pms" id="pms" class="form-control">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class=" col-md-6">
                            <label>Date of Birth</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" name="pdob" id="pdob" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone No.</label>
                            <input type="number" name="pno" id="pno" class="form-control" pattern="[0-9]{11}">
                        </div>
                        
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-12">
                            <label for="u_add">Address</label>
                            <textarea type="text" name="padd" id="padd" class="form-control"></textarea>
                        </div>
                    </div><br>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="register_patient" name="register_patient">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Mother -->
<div class="modal fade" id="editMotherModal" tabindex="-1" role="dialog" aria-labelledby="editMotherModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                 <div class="modal-body">
                    <h5>User Information</h5>
                    <div class="row align-items-center">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="eem" id="eem" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Password</label>
                            <input type="password" name="eppass" id="eppass" class="form-control" required>
                        </div>
                    </div>
                    <br>

                    <h5>Personal Information</h5>
                    <div class="row align-items-center">
                        <div class="form-group col-md-4">
                            <label>First Name</label>
                            <input type="text" name="epfn" id="epfn" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Middle Name</label>
                            <input type="text" name="epmn" id="epmn" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Last Name</label>
                            <input type="text" name="epln" id="epln" class="form-control" required>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <label for="sufx">First Day of Last Men Period</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" name="epmen" id="epmen" class="form-control" placeholder="Date of Birth" required value="<?php echo $row['date_first_men_period']; ?>" />
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Marital Status</label>
                            <input type="text" name="epms" id="epms" class="form-control">
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class=" col-md-6">
                            <label>Date of Birth</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" name="epdob" id="epdob" class="form-control">
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Phone No.</label>
                            <input type="number" name="epno" id="epno" class="form-control" pattern="[0-9]{11}">
                        </div>
                        
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-12">
                            <label for="u_add">Address</label>
                            <textarea type="text" name="epadd" id="epadd" class="form-control"></textarea>
                        </div>
                    </div><br>
            </div>
            <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="edit_patient" name="edit_patient">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Archive mother Modal-->
<div class="modal fade" id="archivem" tabindex="-1" role="dialog" aria-labelledby="archivem" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Archive</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="aarmid" name="aarmid" class="form-control">
                            <div class="col-sm-12">
                                <p>Archive patient?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="archive_mo" name="archive_mo" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Archive Child Modal-->
<div class="modal fade" id="archiveChildModal" tabindex="-1" role="dialog" aria-labelledby="archiveChildModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Archive</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="arcid" name="arcid" class="form-control">
                            <div class="col-sm-12">
                                <p>Archive child?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="archive_child" name="archive_child" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                                <input type="number" id="c_phoneno" name="c_phoneno" class="form-control" pattern="[0-9]{11}" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="c_telno">Clinic Tel No.</label>
                                <input type="tel" id="c_telno" name="c_telno" class="form-control" pattern="[0-9]({4})-{4}">
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

<!-- Archive Clinic Modal -->
<div class="modal fade" id="archiveClinicModal" tabindex="-1" role="dialog" aria-labelledby="archiveClinicModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ct">Deactivate</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="carid" name="carid" class="form-control">
                            <div class="col-sm-12">
                                <p>Archive <span id="cnm" style="font-weight: bold;"></span>?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="archive_clinic" name="archive_clinic" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View/Edit Doctor Modal -->
<div class="modal fade" id="viewEditDoctorModal" tabindex="-1" role="dialog" aria-labelledby="viewEditDoctorModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="c_deactReactTitle">Doctor Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="../actions/update-profile.php" method="POST">
                <div class="modal-body">
                    <h5>User Information</h4>
                    <div class="row align-items-center">
                        <div class="form-group col-md-12">
                            <label for="email">Email</label>
                            <input type="text" name="u_email" id="u_email" class="form-control" placeholder="" required value="" readonly />
                        </div>
                    </div>
                    <br>

                    <h5>Personal Information</h4>
                    <div class="row align-items-center">
                        <div class="form-group col-md-6">
                            <label for="fname">First Name</label>
                            <input type="text" name="u_fname" id="u_fname" class="form-control" placeholder="" required value="" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mname">Middle Name</label>
                            <input type="text" name="u_mname" id="u_mname" class="form-control" placeholder="" value="" />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-6">
                            <label for="lname">Last Name</label>
                            <input type="text" name="u_lname" id="u_lname" class="form-control" placeholder="" required value="" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sufx">Suffix</label>
                            <input type="text" name="u_sufx" id="u_sufx" class="form-control" placeholder="" value="" />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <label for="dob">Date of Birth</label>
                        </div>
                        <div class="col-md-6">
                            <label for="dob">Phone No.</label>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group input-group col-md-6">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" name="u_dob" id="u_dob" class="form-control" required value="" />
                        </div>
                        <div class="form-group col-md-6">
                            <input type="number" name="u_phone" id="u_phone" class="form-control" value="" />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-12">
                            <label for="u_add">Address</label>
                            <textarea type="text" name="u_add" id="u_add" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-6">
                            <label for="spec">License No.</label>
                            <input type="text" name="u_lic" id="u_lic" class="form-control" required value="" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="spec">Specialization</label>
                            <select type="text" class="form-control form-control-user" id="u_spec" name="u_spec">
                                <option value="" selected></option>
                                <?php
                                $q = $con->query("SELECT * FROM tb_specialization WHERE spec_stat = 1");
                                if ($q) {
                                    foreach ($q as $r) {
                                ?>
                                        <option value="<?php echo $r['spec_id']; ?>"><?php echo $r['s_desc']; ?></option>
                                <?php }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-12">
                            <label for="degree">Title</label>
                            <input type="text" name="u_title" id="u_title" class="form-control" required value="" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="u_save" id="u_save" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp; Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Admin Profile Modal-->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php
            $q = "SELECT * FROM tb_users WHERE user_id = '" . $_SESSION['U_ID'] . "'";
            $res = $con->query($q);
            ?>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3">
                            <input type="hidden" id="aid" name="aid" class="form-control" value="<?php echo $_SESSION['U_ID']; ?>">
                            <?php if ($res) {
                                $r = mysqli_fetch_assoc($res); ?>
                                <div class="col-sm-6">
                                    <label>Firstname<span style="color: red;"> *</span></label>
                                    <input type="text" id="afn" name="afn" class="form-control" required value="<?php echo $r['firstname']; ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label>Lastname<span style="color: red;"> *</span></label>
                                    <input type="text" id="aln" name="aln" class="form-control" required value="<?php echo $r['lastname']; ?>">
                                </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Middlename</label>
                                <input type="text" id="amn" name="amn" class="form-control" value="<?php echo $r['middlename']; ?>">
                            </div>
                            <div class="col-sm-6">
                                <label>Suffix</label>
                                <input type="text" id="asf" name="asf" class="form-control" value="<?php echo $r['suffix']; ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Email<span style="color: red;"> *</span></label>
                                <input type="email" id="ae" name="ae" class="form-control" required value="<?php echo $r['email']; ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Phone No.</label>
                                <input type="number" id="ap" name="ap" class="form-control" required value="<?php echo $r['phone_no']; ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Address</span></label>
                                <textarea rows="3" id="aaddr" name="aaddr" class="form-control"><?php echo $r['address']; ?></textarea>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="edit_profile" name="edit_profile" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Doctor Modal-->
<div class="modal fade" id="addDocModal" tabindex="-1" role="dialog" aria-labelledby="addDocModal" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Doctor</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="mt-3 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="r_fn" name="r_fn" placeholder="First Name *" required autocomplete="given-name">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="r_mn" name="r_mn" placeholder="Middle Name" autocomplete="additional-name">
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="r_ln" name="r_ln" placeholder="Last Name *" required autocomplete="family-name">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="r_sn" name="r_sn" placeholder="Suffix (Jr, Sr, I, III etc.)" title="Jr, Sr, I, III etc." autocomplete="honorific-prefix">
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-user" id="r_addr" name="r_addr" placeholder="Address *" required address-line1>
                            </div>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-user" id="r_dob" name="r_dob" placeholder="Birthdate" title="Birthdate" autocomplete="bday">
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="tel" class="form-control form-control-user" id="r_phone" name="r_phone" placeholder="Phone No. * (11 Digits)" required pattern="[0-9]{11}" title="e.g. 09123456789">
                            </div>
                            <div class="col-sm-6">
                                <input type="tel" class="form-control form-control-user" id="r_tel" name="r_tel" placeholder="Tel No. (8 Digits)" pattern="[0-9]({4})-{4}" title="e.g 8123-1234" autocomplete="tel">
                            </div>
                        </div>
                        <div class="mt-3 row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="r_lic" name="r_lic" placeholder="License No. *" required>
                            </div>
                            <div class="col-sm-4">
                                <select type="text" class="form-control form-control-user" id="r_spec" name="r_spec">
                                    <option value="" selected>Specialization</option>
                                    <?php
                                    $q = $con->query("SELECT * FROM tb_specialization WHERE spec_stat = 1");
                                    if ($q) {
                                        foreach ($q as $r) {
                                    ?>
                                            <option value="<?php echo $r['spec_id']; ?>"><?php echo $r['s_desc']; ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-user" id="r_ti" name="r_ti" placeholder="Title">
                            </div>
                        </div>
                        <hr>
                        <div class="mt-3">
                            <input type="email" class="form-control form-control-user" id="r_email" name="r_email" placeholder="Email Address *" required autocomplete="email">
                        </div>
                        <div class="mt-3 row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="r_pass" name="r_pass" placeholder="Password *" required autocomplete="new-password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="r_repass" name="r_repass" placeholder="Repeat Password *" required autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="add_doctor" name="add_doctor" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Specialization Modal -->
<div class="modal fade" id="addSpecModal" tabindex="-1" role="dialog" aria-labelledby="addSpecModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Specialization</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>New Specialization</label>
                                <input type="text" id="nspec" name="nspec" class="form-control">
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="add_specialization" name="add_specialization" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Archive Doctor -->
<div class="modal fade" id="archiveDocModal" tabindex="-1" role="dialog" aria-labelledby="archiveDocModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Archive</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="adid" name="adid" class="form-control">
                            <div class="col-sm-12">
                                <p>Archive doctor?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="archive_doctor" name="archive_doctor" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Register Child Modal -->
<div class="modal fade" id="registerChildModal" tabindex="-1" role="dialog" aria-labelledby="registerChildModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register Child</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>First Name</label>
                                <input type="text" id="rchfn" name="rchfn" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Middle Name</label>
                                <input type="text" id="rchmn" name="rchmn" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Last Name</label>
                                <input type="text" id="rchln" name="rchln" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Suffix</label>
                                <input type="text" id="rchsf" name="rchsf" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Date of Birth</label>
                                <input type="date" id="rchdob" name="rchdob" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Height</label>
                                <input type="text" id="rchh" name="rchh" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Weight</label>
                                <input type="text" id="rchw" name="rchw" class="form-control">
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="register_child" name="register_child">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Child Modal -->
<div class="modal fade" id="editChildModal" tabindex="-1" role="dialog" aria-labelledby="editChildModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Child</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <input type="hidden" id="ch_id" name="ch_id" class="form-control">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>First Name</label>
                                <input type="text" id="chfn" name="chfn" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Middle Name</label>
                                <input type="text" id="chmn" name="chmn" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Last Name</label>
                                <input type="text" id="chln" name="chln" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Suffix</label>
                                <input type="text" id="chsf" name="chsf" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Date of Birth</label>
                                <input type="date" id="chdob" name="chdob" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-6">
                                <label>Height</label>
                                <input type="text" id="chh" name="chh" class="form-control" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Weight</label>
                                <input type="text" id="chw" name="chw" class="form-control">
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" id="edit_child" name="edit_child">Confirm</button>
                </div>
            </form>
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

        $("#c_phoneno").on('keypress', function() {
            return isNumber(event, this, 10, false);
        });

        $("#u_phone").on('keypress', function() {
            return isNumber(event, this, 10, false);
        });

        $("#c_telno").on('keypress', function() {
            return isNumber(event, this, 10, true);
        });

        $("#c_telno").mask('(0000)-0000');

        function isNumber(evt, element, max_chars, isTel) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (isTel == true) {
                if (charCode > 31 && (charCode < 40 || charCode > 57 || charCode == 42 || charCode == 43 || charCode == 44 || charCode == 46 || charCode == 47)) {
                    return false;
                }
            } else {
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
            }

            if (element.value.length > max_chars) {
                element.value = element.value.substr(0, max_chars);
            }
            return true;
        }
    });
</script>