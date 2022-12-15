<div class="row animated--fade-in">
    <div class="col-sm-10 container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-0">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
            </div>
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <button class="btn btn-warning" data-toggle="modal" data-target="#addServicesModal"><i class="fa fa-plus"></i> Add Services</button> &nbsp;
                <button class="btn btn-primary"><i class="fa fa-list"></i> Secretary Accounts</button> &nbsp;
                <button class="btn btn-success"><i class="fa fa-user-plus"></i> Register a Secretary</button>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                User Information
            </div>
            <div class="card-body">
                <?php
                $q = "SELECT * FROM tb_users tu 
                            LEFT JOIN tb_specialization ts ON tu.spec_id = ts.spec_id WHERE role = 2 AND user_id ='" . $_SESSION['U_ID'] . "'";

                $row = mysqli_fetch_assoc(mysqli_query($con, $q));
                ?>
                <div class="row align-items-center">
                    <div class="col-md-5">

                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="form-group col-md-5 text-right licDiv" style="margin: 0;">
                        <img class="licImg" src="../assets/img/uploads/licenses/<?php echo ($row['license_img'] == '') ? 'default.JPG' : $row['license_img']; ?>" alt="License Image" style="width: 100%; height:100%; position: fit; border:  0.1em solid lightgray;">
                    </div>
                    <div class="form-group col-md-3" style="margin: 0;">
                        <div class="row align-items-center">
                            <div class="form-group col-md-12">
                                <?php
                                $atPos = strpos($row['email'], '@') - 1;
                                $email = substr_replace($row['email'], "******", 1, $atPos);
                                ?>
                                <label>Email</label>
                                <input type="text" name="u_email" id="u_email" class="form-control" placeholder="" required value="<?php echo $email; ?>" readonly />
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="form-group col-md-12">
                                <button type="button" name="u_cPass" id="u_cPass" class="form-control btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="form-group col-md-12">

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="lic_img" id="lic_img" accept="image/*">
                                    <label class="custom-file-label" for="customFile">License image...</label>
                                </div>

                                <script>
                                    // Add the following code if you want the name of the file appear on select
                                    $(".custom-file-input").on("change", function() {
                                        var fileName = $(this).val().split("\\").pop();
                                        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                                    });
                                </script>

                                <div class="text-center" style="margin: 5% 0% 0% 0%;">
                                    <button type="button" onclick="uploadLicense()" class="btn btn-primary container-fluid" name="upload_img" id="upload_img">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-md-4 text-left" style="padding: 25px 25px 0px 25px;">
                        <form action="actions.php" method="POST" enctype="multipart/form-data">
                            <div class="row ">
                                <label for="spec">License No.</label>
                                <input type="text" name="u_lic" id="u_lic" class="form-control" required value="<?php echo $row['license_no']; ?>" />
                            </div>
                            <div class="row mt-2">
                                <label>Specialization</label>
                                <select type="text" class="form-control form-control-user" id="u_spec" name="u_spec">
                                    <option value="<?php echo $row['spec_id']; ?>" selected><?php echo $row['s_desc']; ?></option>
                                    <?php
                                    $q = $con->query("SELECT * FROM tb_specialization WHERE spec_stat = 1 and spec_id != '" . $row['spec_id'] . "'");
                                    if ($q) {
                                        foreach ($q as $r) {
                                    ?>
                                            <option value="<?php echo $r['spec_id']; ?>"><?php echo $r['s_desc']; ?></option>
                                    <?php }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="row mt-2">
                                <label for="degree">Title</label>
                                <input type="text" name="u_title" id="u_title" class="form-control" required value="<?php echo $row['title']; ?>" />
                            </div>
                    </div>
                </div>
                <hr>

                <h4>Personal Information</h4>
                <div class="row align-items-center">
                    <div class="form-group col-md-3">
                        <label for="fname">First Name</label>
                        <input type="text" name="u_fname" id="u_fname" class="form-control" placeholder="" required value="<?php echo $row['firstname']; ?>" />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="mname">Middle Name</label>
                        <input type="text" name="u_mname" id="u_mname" class="form-control" placeholder="" value="<?php echo $row['middlename']; ?>" />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lname">Last Name</label>
                        <input type="text" name="u_lname" id="u_lname" class="form-control" placeholder="" required value="<?php echo $row['lastname']; ?>" />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="sufx">Suffix</label>
                        <input type="text" name="u_sufx" id="u_sufx" class="form-control" placeholder="" value="<?php echo $row['suffix']; ?>" />
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
                        <input type="date" name="u_dob" id="u_dob" class="form-control" placeholder="Date of Birth" required value="<?php echo $row['DOB']; ?>" />
                    </div>
                    <div class="form-group col-md-2">
                        <input type="text" name="age" id="age" class="form-control" placeholder="Age" readonly value="" />
                    </div>
                    <div class="form-group col-md-5">
                        <input type="text" name="u_phone" id="u_phone" class="form-control" placeholder="Phone No." value="<?php echo $row['phone_no']; ?>" />
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="form-group col-md-12">
                        <label for="u_add">Address</label>
                        <textarea type="text" name="u_add" id="u_add" class="form-control" value="<?php echo $row['address']; ?>"><?php echo $row['address']; ?></textarea>
                    </div>
                </div><br>
            </div>
            <div class="card-footer text-right">
                <button type="submit" name="save_profile" id="save_profile" class="btn btn-primary"><i class="fas fa-save"></i> &nbsp;Update Profile</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        var today = new Date();
        var dob = new Date($("#u_dob").val());
        var age = new Date(today - dob).getFullYear() - 1970;

        $("#age").val(age);
    });

    $("#u_dob").change(function() {
        var today = new Date();
        var dob = new Date($("#u_dob").val());
        var age = new Date(today - dob).getFullYear() - 1970;

        $("#age").val(age);
    });

    function uploadLicense() {
        var f = $('#lic_img')[0].files;
        var fd = new FormData();


        if (f.length > 0) {
            fd.append('lic_img', f[0]);

            $.ajax({
                url: 'actions.php',
                type: 'post',
                data: fd,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response != 0) {
                        $(".licDiv").load(location.href + " .licImg");
                        alert(files);
                    } else {
                        alert('file not uploaded');
                    }
                },
            });
        } else {
            alert("Please select a file.");
        }
    }
</script>