<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center">Set an Appointment</h1>
</div> -->
<h3 class="h3 mb-3 align-items-center text-center">Set an Appointment</h3>
<div class="row animated--fade-in">
    <div class="col-sm-7 container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
            </div>
            <form action="actions.php" method="POST">
                <div class="card-body row">
                    <div class="col-sm-6">
                        <div class="card-body text-black">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa-solid fa-house-chimney-medical"></i></div>
                                        </div>
                                        <select class="form-control" name="a_clinic" id="a_clinic" required>
                                            <option value="" selected>Select Clinic</option>
                                            <?php
                                            $q = "SELECT * FROM tb_clinic WHERE c_stat = 1 ORDER BY clinic_name";
                                            $q_run = mysqli_query($con, $q);
                                            if ($q_run) {
                                                foreach ($q_run as $rows) { ?>
                                                    <option value="<?php echo $rows['clinic_id']; ?>"><?php echo $rows['clinic_name']; ?></option>
                                            <?php }
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa-solid fa-user-doctor"></i></div>
                                        </div>
                                        <select class="form-control" name="a_doc" id="a_doc" required>
                                            <option value="" selected>Select Doctor</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa-solid fa-calendar-days"></i></div>
                                        </div>
                                        <select class="form-control" name="a_date" id="a_date" required>
                                            <option value="" selected>Select Date</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <div class="input-group mb-2">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text"><i class="fa-solid fa-clock"></i></div>
                                        </div>
                                        <input type="time" class="form-control" id="a_time" name="a_time">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-sm-12">
                                    <textarea class="form-control" name="a_desc" id="a_desc" cols="30" rows="10" placeholder="Appointment Details"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6" style="border-left: 0.01em solid lightgray;">
                        <style>
                            .p-head {
                                font-weight: bold;
                            }
                        </style>
                        <h4>Appointment Details</h4><br>
                        <div class="row">
                            <div class="col-sm-12">
                                <p class="c_details" style="font-size: 13pt; padding-left:5px;">
                                    <span class="p-head">Name:</span><br>
                                    <span class="cn"></span><br><br>
                                    <span class="p-head">Location:</span><br>
                                    <span class="cloc"></span><br><br>
                                    <span class="p-head">Contact No:</span><br>
                                    <span class="ccont"></span>
                                </p>
                                <hr>
                                <p class="d_details" style="font-size: 13pt; padding-left:5px;">
                                    <span class="p-head">Doctor:</span><br>
                                    <span class="dn"></span><br><br>
                                    <span class="p-head">Specialization:</span><br>
                                    <span class="dspec"></span><br><br>
                                    <span class="p-head">Services:</span><br>
                                    <span class="dserv"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-success" type="button" title="Add Children" data-toggle="modal" data-target="#registerChildModal"><i class="fa fa-child"></i><i class="fa fa-plus fa-2xs"></i></button>
                    <button class="btn btn-primary" type="submit" id="create_appointment" name="create_appointment" title="Book Now"><i class="fa fa-calendar-plus fa-sm"></i>&nbsp;&nbsp;Book Now</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#a_clinic').on('change', function() {
        var cid = document.getElementById('a_clinic');
        loadDocs(cid);
        loadClinicInfo(cid);
    });

    $('#a_doc').on('change', function() {
        var did = document.getElementById('a_doc');
        loadDates(did);
        loadDocInfo(did);
    });

    function loadDocs(id) {
        $.ajax({
            type: 'POST',
            url: 'appt-loads.php',
            data: {
                "load_doctors": "true",
                "clid": id.value
            },
            dataType: 'json',
            success: function(msg) {

                $("#a_doc").html('');

                $('#a_doc').append($('<option>', {
                    value: '',
                    text: 'Select Doctor'
                }));

                $.each(msg, function(i, item) {
                    $('#a_doc').append($('<option>', {
                        value: item.user_id,
                        text: item.doc_name
                    }));
                });
            }
        });
    }

    function loadClinicInfo(id) {
        $.ajax({
            type: 'POST',
            url: 'appt-loads.php',
            data: {
                "load_clinic": "true",
                "cl_id": id.value
            },
            dataType: 'json',
            success: function(msg) {
                if (id.value == '') {
                    $(".cn").html('');
                    $(".cloc").html('');
                    $(".ccont").html('');
                } else {
                    $(".cn").html(msg[0].clinic_name);
                    $(".cloc").html(msg[0].clinic_address);
                    $(".ccont").html('Phone -  ' + msg[0].contact_no + '<br> Tel -  ' + ((msg[0].tel_no == '')? 'N/A' : msg[0].tel_no));
                }
            }
        });
    }

    function loadDocInfo(id) {
        $.ajax({
            type: 'POST',
            url: 'appt-loads.php',
            data: {
                "load_doc_details": "true",
                "did": id.value
            },
            dataType: 'json',
            success: function(msg) {
                console.log(msg);
                if (id.value == '') {
                    $(".dn").html('');
                    $(".dspec").html('');
                    $(".dserv").html('');
                } else {
                    $(".dn").html(msg[0].doc_name);
                    $(".dspec").html(msg[0].s_desc);
                    $(".dserv").html(msg[0].doc_services);
                }
            }
        });
    }

    function loadDates(id) {
        $.ajax({
            type: 'POST',
            url: 'appt-loads.php',
            data: {
                "load_dates": "true",
                "d_id": id.value
            },
            dataType: 'json',
            success: function(msg) {

                $("#a_date").html('');

                $('#a_date').append($('<option>', {
                    value: '',
                    text: 'Select Date'
                }));

                $.each(msg, function(i, item) {
                    $('#a_date').append($('<option>', {
                        value: item.date_available,
                        text: item.date_available
                    }));
                });
            }
        });
    }
</script>