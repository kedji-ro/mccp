<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
</div>

<div class="row animated--fade-in">
    <div class="col-sm-8 container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3"></div>
            <div class="card-body">
                <form action="../actions/update-profile.php" method="POST">
                    <h4>User Information</h4>
                    <?php
                    $q = "SELECT * FROM tb_users WHERE role = 2 AND user_id ='" . $_SESSION['U_ID'] . "'";

                    $row = mysqli_fetch_assoc(mysqli_query($con, $q));
                    ?>
                    <div class="row align-items-center">
                        <div class="col-md-3">
                            <label for="user">Username</label>
                        </div>
                        <div class="col-md-5">
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-3">
                            <input type="text" name="u_user" id="u_user" class="form-control" placeholder="" required value="<?php echo $row['username']; ?>" />
                        </div>
                        <div class="form-group col-md-6">
                            <?php
                            $atPos = strpos($row['email'], '@') - 1;
                            $email = substr_replace($row['email'], "******", 1, $atPos);
                            ?>
                            <input type="text" name="u_email" id="u_email" class="form-control" placeholder="" required value="<?php echo $email; ?>" readonly />
                        </div>
                        <div class="form-group col-md-3">
                            <button type="button" name="u_cPass" id="u_cPass" class="form-control btn btn-primary" data-toggle="modal" data-target="#changePasswordModal">Change Password</button>
                        </div>
                    </div>
                    <br>

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
                            <input type="text" name="age" id="age" class="form-control" placeholder="Age" readonly value="<?php echo '23'; ?>" />
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
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-md-5">
                            <label for="spec">License No.</label>
                            <input type="text" name="u_lic" id="u_lic" class="form-control" required value="<?php echo $row['license_no'];
                                                                                                            ?>" />
                        </div>
                        <div class="form-group col-md-4">
                            <label for="spec">Specialization</label>
                            <input type="text" name="u_spec" id="u_spec" class="form-control" required value="<?php echo $row['specialization']; ?>" />
                        </div>
                        <div class="form-group col-md-3">
                            <label for="degree">Title</label>
                            <input type="text" name="u_title" id="u_title" class="form-control" required value="<?php echo $row['degree']; ?>" />
                        </div>
                    </div>
                    <div class="row align-items-center" style="padding: 0px 0px 0px 10px;">
                        <div class="form-group col-md-4"></div>
                        <div class="form-group col-md-2"></div>
                        <div class="form-group col-md-3"></div>
                        <div class="form-group col-md-3">
                            <button type="submit" name="u_save" id="u_save" class="btn btn-primary container-fluid"><i class="fas fa-save"></i> Save</button>
                        </div>
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3"></div>
            <div class="card-body container-fluid" style="padding: 0% 0% 20% 0%;">
                <div class="row">
                    <div class="col" style="padding: 10% 25% 5% 25%;">
                        <img class="containter-fluid" src="../assets/img/undraw_profile.svg" alt="">
                    </div>
                </div>
                <div class="row mb-4">
                    <div class="col">
                        <h2 class="text-center"><?php echo $row['firstname']; ?> <?php echo $row['middlename']; ?> <?php echo $row['lastname']; ?> <?php echo $row['suffix']; ?></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="margin: 0% 20% 0% 20%;">
                        <form>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile" accept="image/*">
                                <label class="custom-file-label" for="customFile">Change profile picture</label>
                            </div>
                        </form>

                        <div class="text-center" style="margin: 5% 0% 0% 0%;">
                            <button type="button" class="btn btn-primary container-fluid">Upload</button>
                        </div>


                        <script>
                            // Add the following code if you want the name of the file appear on select
                            $(".custom-file-input").on("change", function() {
                                var fileName = $(this).val().split("\\").pop();
                                $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateProfile() {
            var user = document.getElementById('u_user').value;
            var fname = document.getElementById('u_fname').value;
            var mname = document.getElementById('u_mname').value;
            var lname = document.getElementById('u_lname').value;
            var sfx = document.getElementById('u_sufx').value;
            var dob = document.getElementById('u_dob').value;
            var add = document.getElementById('u_add').value;
            var phone = document.getElementById('u_phone').value;
            var lic = document.getElementById('u_lic').value;
            var spec = document.getElementById('u_spec').value;
            var title = document.getElementById('u_title').value;

            $.ajax({
                type: 'POST',
                url: '../actions/update-profile.php',
                data: {
                    "u_user": user,
                    "u_fname": fname,
                    "u_lname": lname,
                    "u_sufx": sfx,
                    "u_dob": dob,
                    "u_add": add,
                    "u_phone": phone,
                    "u_lic": lic,
                    "u_spec": spec,
                    "u_title": title,
                    "u_mname": mname
                },
                success: function(msg) {
                    document.getElementById('alert-text').innerText = "Profile updated.";
                    $("#user_prof").load(location.href + " #user_prof");
                    $('#alertModal').modal('show');
                    setTimeout(function() {
                        $('#alertModal').modal('hide');
                    }, 4000);

                }
            });
            document.getElementById('alert-text').innerText = "";
        }
    </script>