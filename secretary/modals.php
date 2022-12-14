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


<!-- Complete Appointment -->
<div class="modal fade" id="compApptModal" tabindex="-1" role="dialog" aria-labelledby="compApptModal" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Complete</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <input type="hidden" id="coaid" name="coaid" class="form-control">
                            <div class="col-sm-12">
                                <p>Mark appointment as complete?</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" id="complete_appointment" name="complete_appointment" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                            <input type="hidden" id="canid" name="canid" class="form-control">
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

<!-- Reschedule Appointment -->
<div class="modal fade" id="reschedModal" tabindex="-1" role="dialog" aria-labelledby="reschedModal" aria-hidden="true">
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
                        <div class="row mt-3">
                            <div class="col-sm-7">
                                <input type="hidden" id="raid" name="raid" class="form-control">
                                <label for="rad">Date</label>
                                <input type="date" id="rad" name="rad" class="form-control">
                            </div>
                            <div class="col-sm-5">
                                <label for="rat">Time</label>
                                <input type="time" id="rat" name="rat" class="form-control">
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

<!-- View Appointment From Calendar Modal -->
<div class="modal fade" id="viewAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="viewAppointmentModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Appointment Information</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="actions.php" method="POST">
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Patient Name</span></label>
                                <input type="text" id="apn" name="apn" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Contact No.</label>
                                <input type="text" id="apno" name="apno" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Appointment Description</label>
                                <textarea id="apdes" name="apdes" class="form-control" readonly></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-7">
                                <label>Appointment Date</label>
                                <input type="text" id="apd" name="apd" class="form-control" readonly>
                            </div>
                            <div class="col-sm-5">
                                <label>Time</label>
                                <input type="text" id="apt" name="apt" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Clinic Location</label>
                                <textarea id="apcll" name="apcll" class="form-control" readonly></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <label>Doctor Remarks</label>
                                <textarea id="apdr" name="apdr" class="form-control" readonly></textarea>
                            </div>
                        </div>
                    </div>
                </div><br>
                <div class="modal-footer">
                    <button class="btn btn-primary" type="button" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>