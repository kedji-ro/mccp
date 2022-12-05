<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                    </div>
                    <form class="user" action="../login/action.php" method="POST" id="rp_form" autocomplete="on">
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" id="rpfn" name="rpfn" placeholder="First Name *" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-user" id="rpmn" name="rpmn" placeholder="Middle Name">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" class="form-control form-control-user" id="rpln" name="rpln" placeholder="Last Name *" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" id="rpms" name="rpms" placeholder="Marital Status">
                            </div>
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="date" class="form-control form-control-user" id="rpmen" name="rpmen" title="First Day of Last Men Period" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="date" class="form-control form-control-user" id="rpdob" name="rpdob" title="Date of Birth" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="number" class="form-control form-control-user" id="rpno" name="rpno" placeholder="Phone No." required>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" id="rpaddr" name="rpaddr" placeholder="Address" required>
                        </div>

                        <hr>

                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" id="rpem" name="rpem" placeholder="Email Address" required>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="password" class="form-control form-control-user" id="rppass" name="rppass" placeholder="Password" required>
                            </div>
                            <div class="col-sm-6">
                                <input type="password" class="form-control form-control-user" id="rprepass" name="rprepass" placeholder="Repeat Password" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block regBtn" id="register_patient" name="register_patient">
                            <i class="fas fa-user fa-fw"></i>
                            Register as Patient
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