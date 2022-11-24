<?php session_start();
unset($_SESSION['message']); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body>
    <style>
        body {
            background-color: #7858A6;
        }
    </style>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6" style="margin-bottom: 50px;">
                <div class="card shadow">
                    <div class="card-header text-center">
                        <h4>Doctor Registration Form</h4>
                        <?php include 'alert-message.php'; ?>
                    </div>
                    <div class="card-body">
                        <div class="container">
                            <form action="../actions/account-register.php" method="POST" oninput='d_RePass.setCustomValidity(d_RePass.value != d_pass.value ? "Passwords do not match." : "")'>
                                <div class="row mb-3">
                                    <h5>Basic Information</h5>
                                </div>
                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <label>First Name<span style="color:red;"> *</span></label>
                                        <input type="text" name="d_fname" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label>Middle Name</label>
                                        <input type="text" name="d_mname" placeholder="" class="form-control">
                                    </div>
                                    <div class="col mb-3">
                                        <label>Last Name<span style="color:red;"> *</span></label>
                                        <input type="text" name="d_lname" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="col-sm-2 mb-3">
                                        <label>Suffix</label>
                                        <input type="text" name="d_sfx" placeholder="Jr, Sr" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <label>Birthday<span style="color:red;"> *</span></label>
                                        <input type="date" name="d_dob" placeholder="Enter birthday" class="form-control" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label>Tel No.</label>
                                        <input type="tel" name="d_tel" placeholder="e.i. 81234567" class="form-control" pattern="[0-9]{8}" onkeypress="return isNumber(event, this, 7)">
                                    </div>
                                    <div class="col mb-3">
                                        <label>Phone No.</label>
                                        <input type="tel" name="d_phone" placeholder="e.i. 09123456789" class="form-control" pattern="[0-9]{11}" onkeypress="return isNumber(event, this, 10)">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <label>Home Address</label>
                                        <input type="text" name="d_address" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <label>License No.<span style="color:red;"> *</span></label>
                                        <input type="text" name="d_license" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label>Specialization</label>
                                        <input type="text" name="d_spec" placeholder="" class="form-control">
                                    </div>
                                    <div class="col mb-3">
                                        <label>Title</label>
                                        <input type="text" name="d_deg" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <h5>User Account Information</h5>
                                </div>

                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <label>Email<span style="color:red;"> *</span></label>
                                        <input type="email" name="d_email" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label>Username<span style="color:red;"> *</span></label>
                                        <input type="text" name="d_user" placeholder="" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col mb-3">
                                        <label>Create Password<span style="color:red;"> *</span></label>
                                        <input type="password" name="d_pass" placeholder="" class="form-control" required>
                                    </div>
                                    <div class="col mb-3">
                                        <label>Confirm Password<span style="color:red;"> *</span></label>
                                        <input type="password" name="d_RePass" placeholder="" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-1 text-center">
                                    <div class="col mb-3">
                                        <button type="submit" name="register_d" class="btn btn-primary container-fluid">Register</button>
                                    </div>
                                </div>
                                <div class="col mb-3 text-center">
                                    <a href="../?" style="text-decoration:none"> ← Back to Home</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['message'])) { ?>
        <div class="toast" style="position: absolute; top: 10px; right: 10px; width: 500px; background-color: #a2fab5;">
            <div class="toast-header">
                <strong class="mr-auto text-muted">Message</strong>
                <!-- <small class="text-muted">5 mins ago</small> -->
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body">
                <?php if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                } else {
                    echo 'Toast Body';
                } ?>
            </div>
        </div>
    <?php } ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script>
    function isNumber(evt, element, max_chars) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }

        if (element.value.length > max_chars) {
            element.value = element.value.substr(0, max_chars);
        }
        return true;
    }

    $(document).ready(function() {
        $('.toast').toast('show')
        setTimeout(function() {
            $('.toast').modal('hide');
        }, 100);
    });

    <?php unset($_SESSION['message']); ?>
</script>

</html>