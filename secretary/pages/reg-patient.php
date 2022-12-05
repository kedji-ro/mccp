<div class="row animated--fade-in container-fluid ">
    <div class="col-sm-8 container-fluid">
        <div class="text-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Register Patient</h1>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3"></div>
            <div class="card-body">
                <form action="actions.php" method="POST">
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
            <div class="card-footer text-right">
                <button type="submit" name="register_patient" id="register_patient" class="btn btn-success"><i class="fas fa-user-plus"></i> &nbsp;Register</button>
            </div>
            </form>
        </div>
    </div>
</div>