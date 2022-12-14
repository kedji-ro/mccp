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

<!-- View Appointment Modal -->
<div class="modal fade" id="viewApptModal" tabindex="-1" role="dialog" aria-labelledby="viewApptModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Appointment Details</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Clinic</label>
                                <input type="text" id="acn" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Location</label>
                                <textarea class="form-control" id="acl" cols="30" rows="3" readonly></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Clinic Contact No.</label>
                                <input type="text" id="acc" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Description</label>
                                <textarea class="form-control" id="ad" cols="30" rows="3" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Payment -->
<div class="modal fade" id="payApptModal" tabindex="-1" role="dialog" aria-labelledby="payApptModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Payment</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <input type="hidden" id="paid" name="paid" class="form-control">
                                <label for="rad">Mode of Payment</label>
                                <select class="form-control" name="pmop" id="pmop" required>
                                    <option value="" selected>Select</option>
                                    <option value="Cash">Cash</option>
                                    <option value="GCash">GCash</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="rad">Reference No</label>
                                <input type="text" id="pref" name="pref" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label for="rad">Amount</label>
                                <input type="number" id="pamt" name="pamt" class="form-control">
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="pay_appointment" name="pay_appointment">Confirm</button>
                </div>
            </form>
            <script>
                $(document).ready(function() {
                    var el = document.getElementById('pmop');
                    var ref = document.getElementById('pref');
                    if (el.value == "GCash") {
                        ref.removeAttribute('disabled');
                    } else {
                        ref.setAttribute('disabled', 'true');
                    }
                });

                $('#pmop').on('change', function() {
                    var el = document.getElementById('pmop');
                    var ref = document.getElementById('pref');
                    if (el.value == "GCash") {
                        ref.removeAttribute('disabled');
                    } else {
                        ref.setAttribute('disabled', 'true');
                    }
                });
            </script>
        </div>
    </div>
</div>

<!-- Reschedule Appointment -->
<div class="modal fade" id="reschedApptModal" tabindex="-1" role="dialog" aria-labelledby="reschedApptModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reschedule Appointment</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-9">
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa-solid fa-calendar-days"></i></div>
                                            </div>
                                            <select class="form-control" id="rad" name="rad" required>
                                                <option value="" selected>Select Date</option>
                                            </select>
                                            <input type="hidden" name="rad_date" id="rad_date">
                                            <input type="hidden" id="raid" name="raid" class="form-control">
                                            <input type="hidden" id="rraid" name="rraid" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <div class="input-group mb-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fa-solid fa-clock"></i></div>
                                            </div>
                                            <select class="form-control" id="rat" name="rat" required>
                                                <option value="" selected>Select Time</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 text-center">
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <h6>SLOTS<br>REMAINING</h6>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <h2 class="rslots"></h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" id="resched_appointment" name="resched_appointment">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#reschedApptModal').on('shown.bs.modal', function() {
        var did = document.getElementById('raid');
        loadD(did);
    });

    $('#rad').on('change', function() {
        var did = document.getElementById('rad');
        loadS(did);
        loadT(did);

        var text = did.options[did.selectedIndex].text;
        $('#rad_date').val(text);

        if (did.value == '') {
            $("#rat").html('');

            $('#rat').append($('<option>', {
                value: '',
                text: 'Select Time'
            }));
        }
    });

    function loadD(id) {
        $.ajax({
            type: 'POST',
            url: 'appt-loads.php',
            data: {
                "load_dates": "true",
                "d_id": id.value
            },
            dataType: 'json',
            success: function(msg) {
                $("#rad").html('');

                $('#rad').append($('<option>', {
                    value: '',
                    text: 'Select Date'
                }));

                $.each(msg, function(i, item) {
                    $('#rad').append($('<option>', {
                        value: item.schedule_id,
                        text: item.date_available
                    }));
                });
            }
        });
    }

    function loadT(id) {
        console.log('g');
        $.ajax({
            type: 'POST',
            url: 'appt-loads.php',
            data: {
                "load_time": "true",
                "s_id": id.value
            },
            dataType: 'json',
            success: function(msg) {
                console.log('g');
                $("#rat").html('');

                $('#rat').append($('<option>', {
                    value: '',
                    text: 'Select Time'
                }));

                if (id.value != '') {
                    $.each(msg, function(i, item) {
                        $('#rat').append($('<option>', {
                            value: item,
                            text: item
                        }));
                    });
                }
            }
        });
    }

    function loadS(id) {
        $.ajax({
            type: 'POST',
            url: 'appt-loads.php',
            data: {
                "load_slots": "true",
                "s_id": id.value
            },
            dataType: 'json',
            success: function(msg) {
                if (id.value != '') {
                    $(".rslots").html(msg[0].taken_slots);
                    $(".r_slots").val(msg[0].taken_slots);
                } else {
                    $(".rslots").html('');
                }
            }
        });
    }
</script>

<!-- Cancel Appointment -->
<div class="modal fade" id="cancelApptModal" tabindex="-1" role="dialog" aria-labelledby="cancelApptModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="caid" name="caid" class="form-control">
                            <div class="col-sm-12">
                                <p>Cancel apppointment?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="cancel_appointment" name="cancel_appointment" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Cancel Request -->
<div class="modal fade" id="cancelReqModal" tabindex="-1" role="dialog" aria-labelledby="cancelReqModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cancel</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="crid" name="crid" class="form-control">
                            <div class="col-sm-12">
                                <p>Cancel information transfer request?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="cancel_request" name="cancel_request" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Change Password Modal-->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="d_cOldPass">Old Passwword <span style="color: red;">*</span></label>
                            <input type="password" id="d_cOldPass" name="d_cOldPass" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-sm-6">
                            <label for="d_cNewPass">New Passwword <span style="color: red;">*</span></label>
                            <input type="password" id="d_cNewPass" name="d_cNewPass" class="form-control">
                        </div>
                        <div class="col-sm-6">
                            <label for="d_cRePass">Confirm Passwword <span style="color: red;">*</span></label>
                            <input type="password" id="d_cRePass" name="d_cRePass" class="form-control">
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="">Confirm</a>
            </div>
        </div>
    </div>
</div>