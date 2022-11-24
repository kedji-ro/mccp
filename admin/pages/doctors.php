<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Doctors Management</h1>
    <!-- <button type="button" class="btn btn-success" data-toggle="modal" data-target="#studentaddmodal">
        <i class="fas fa-plus"></i></button> -->
</div>

<?php
$query = "SELECT * FROM `tb_users` WHERE role = 2";
$query_run = mysqli_query($con, $query);
?>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3"></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Doctor's Name</th>
                        <th>Birthdate</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                    </tr>
                </thead>
                <!-- Displays Information from Database -->
                <?php
                if ($query_run) {
                    foreach ($query_run as $rows) {
                ?>
                        <tr class="mt-3">
                            <td><?php echo $rows['doctor_id']; ?></td>
                            <td><?php echo $rows['firstname'] . ' ' .  $rows['middlename'] . ' ' .  $rows['lastname'] . ' ' .  $rows['suffix']; ?></td>
                            <td><?php echo $rows['DOB']; ?></td>
                            <td><?php echo $rows['email']; ?></td>
                            <td><?php echo $rows['phone_no']; ?></td>

                            <?php if ($rows['is_active'] == '1') { ?>
                                <td class="text-center">
                                    <h5><span class="badge badge-pill badge-success">Active</span></h5>
                                </td>
                            <?php } else { ?>
                                <td class="text-center">
                                    <h5><span class="badge badge-pill badge-secondary">Inactive</span></h5>
                                </td>
                            <?php } ?>

                            <!--buttons-->
                            <td class="text-center">
                                <span> <button type="button" class="btn btn-primary btn-circle viewEditDBtn btn-sm" title="View/Edit">
                                        <i class="fa fa-edit"></i>
                                    </button></span>

                                <?php if ($rows['is_active'] == '1') { ?>
                                    <span> <button type="button" class="btn btn-secondary btn-circle deletebtn btn-sm" title="archive">
                                            <i class="fa fa-archive"></i>
                                        </button></span>
                                <?php } else { ?>
                                    <span> <button type="button" class="btn btn-secondary btn-circle deletebtn btn-sm" title="archive" disabled>
                                            <i class="fa fa-archive"></i>
                                        </button></span>
                                <?php } ?>
                            </td>
                            <td hidden></td>
                            <td hidden></td>
                            <td hidden></td>
                            <td hidden></td>
                            <td hidden></td>
                            <td hidden></td>
                            <td hidden></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('.viewEditDBtn').on('click', function() {

            $('#viewEditDoctorModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
        });
    });
</script>