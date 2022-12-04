<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image-doc"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" action="../login/action.php" method="POST" id="r_form" autocomplete="on">
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="r_fn" name="r_fn" placeholder="First Name *" required autocomplete="given-name">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="r_mn" name="r_mn" placeholder="Middle Name" autocomplete="additional-name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="r_ln" name="r_ln" placeholder="Last Name *" required autocomplete="family-name">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="r_sn" name="r_sn" placeholder="Suffix (Jr, Sr, I, III etc.)" title="Jr, Sr, I, III etc." autocomplete="honorific-prefix">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-user" id="r_addr" name="r_addr" placeholder="Address *" required address-line1>
                            </div>
                            <div class="col-sm-4">
                                <input type="date" class="form-control form-control-user" id="r_dob" name="r_dob" placeholder="Birthdate" title="Birthdate" autocomplete="bday">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="tel" class="form-control form-control-user" id="r_phone" name="r_phone" placeholder="Phone No. * (11 Digits)" required pattern="[0-9]{11}" title="e.g. 09123456789">
                            </div>
                            <div class="col-sm-6">
                                <input type="tel" class="form-control form-control-user" id="r_tel" name="r_tel" placeholder="Tel No. (8 Digits)" pattern="[0-9]({4})-{4}" title="e.g 8123-1234" autocomplete="tel">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="r_lic" name="r_lic" placeholder="License No. *" required>
                            </div>
                            <div class="col-sm-4">
                                <div class="dropdown">
                                    <input type="text" class="form-control form-control-user dropdown-toggle" id="sp" placeholder="Specialization" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" autocomplete="off">
                                    <input type="hidden" class="form-control form-control-user" id="r_spec" name="r_spec">
                                    <div class="dropdown-menu" aria-labelledby="r_spec">
                                        <?php
                                        $q = $con->query("SELECT * FROM tb_specialization WHERE spec_stat = 1");
                                        if ($q) {
                                            foreach ($q as $r) {
                                        ?>
                                                <a class="dropdown-item" onclick="getSpec('<?php echo $r['spec_id']; ?>', '<?php echo $r['s_desc']; ?>');"><?php echo $r['s_desc']; ?></a>
                                        <?php }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <script>
                                function getSpec(id, val) {
                                    $("#sp").val(val);
                                    $("#r_spec").val(id);
                                }
                            </script>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-user" id="r_ti" name="r_ti" placeholder="Title">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="r_email" name="r_email" placeholder="Email Address *" required autocomplete="email">
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="r_pass" name="r_pass" placeholder="Password *" required autocomplete="new-password">
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="r_repass" name="r_repass" placeholder="Repeat Password *" required autocomplete="new-password">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block regBtn" id="register_doctor" name="register_doctor">
                            <i class="fas fa-stethoscope fa-fw"></i>
                            Register as Doctor
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="../login/?">Already have an account? Login!</a>
                    </div>
                    <div class="text-center">
                        <a class="small" href="../?">Back to Home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>