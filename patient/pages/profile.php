<div class="row animated--fade-in container-fluid">
    <div class="col-sm-7">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3"></div>
            <div class="card-body">
                <form action="actions.php" method="POST">
                    <h4>User Information</h4>
                    <?php
                    $q = "SELECT * FROM tb_users WHERE user_id ='" . $_SESSION['U_ID'] . "'";

                    $row = mysqli_fetch_assoc(mysqli_query($con, $q));
                    ?>
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-9">
                            <?php
                            $atPos = strpos($row['email'], '@') - 1;
                            $email = substr_replace($row['email'], "******", 1, $atPos);
                            ?>
                            <input type="text" name="em" id="em" class="form-control" placeholder="" required value="<?php echo $email; ?>" readonly />
                        </div>
                        <div class="form-group col-md-3">
                            <button type="button" name="u_cPass" id="u_cPass" class="form-control btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                        </div>
                    </div>
                    <br>

                    <h4>Personal Information</h4>
                    <div class="row align-items-center">
                        <div class="form-group col-md-6">
                            <label for="fname">First Name</label>
                            <input type="text" name="pfn" id="pfn" class="form-control" placeholder="" required value="<?php echo $row['firstname']; ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <label for="mname">Middle Name</label>
                            <input type="text" name="pmn" id="pmn" class="form-control" placeholder="" value="<?php echo $row['middlename']; ?>" />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-6">
                            <label for="lname">Last Name</label>
                            <input type="text" name="pln" id="pln" class="form-control" placeholder="" required value="<?php echo $row['lastname']; ?>" />
                        </div>
                        <div class="col-md-6">
                            <label for="sufx">First Day of Last Men Period</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                </div>
                                <input type="date" name="pmen" id="pmen" class="form-control" placeholder="Date of Birth" required value="<?php echo $row['date_first_men_period']; ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <label for="dob">Date of Birth</label>
                        </div>
                        <div class="col-md-4">
                            <label for="dob">Phone No.</label>
                        </div>
                        <div class="col-md-4">
                            <label for="dob">Marital Status</label>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group input-group col-md-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="date" name="pdob" id="pdob" class="form-control" placeholder="Date of Birth" required value="<?php echo $row['DOB']; ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="pno" id="pno" class="form-control" placeholder="Phone No." value="<?php echo $row['phone_no']; ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" name="pms" id="pms" class="form-control" value="<?php echo $row['marital_status']; ?>" />
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-12">
                            <label for="u_add">Address</label>
                            <textarea type="text" name="padd" id="padd" class="form-control" value="<?php echo $row['address']; ?>"><?php echo $row['address']; ?></textarea>
                        </div>
                    </div><br>
            </div>
            <div class="card-footer text-right">
                <button type="submit" name="save_profile" id="save_profile" class="btn btn-primary"><i class="fas fa-save"></i> &nbsp;Save</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-sm-4">
    </div>
</div>