<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Doctors Management</h1>
    <div class="d-sm-flex align-items-center justify-content-between">
        <button type="button" class="btn btn-success addDocBtn">
            <i class="fas fa-plus"></i> Add Doctor</button> &nbsp;
        <button type="button" class="btn btn-primary addSpecBtn">
            <i class="fas fa-plus"></i> Add Specialization</button> &nbsp;
        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#addServicesModal">
            <i class="fas fa-plus"></i> Add Services</button>
    </div>
</div>

<?php
$query = "SELECT * FROM `tb_users` LEFT JOIN tb_specialization on tb_specialization.spec_id = tb_users.spec_id  WHERE role = 2";
$query_run = mysqli_query($con, $query);
?>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3"></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden>No.</th>
                        <th>Doctor's Name</th>
                        <th>Specialization</th>
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
                        <th hidden></th>
                    </tr>
                </thead>

                <?php
                if ($query_run) {
                    foreach ($query_run as $rows) {
                ?>
                        <tr class="mt-3">
                            <td hidden><?php echo $rows['user_id']; ?></td>
                            <td><?php echo $rows['firstname'] . ' ' .  $rows['middlename'] . ' ' .  $rows['lastname'] . ' ' .  $rows['suffix']; ?></td>
                            <td><?php echo $rows['s_desc']; ?></td>
                            <td><?php echo $rows['DOB']; ?></td>
                            <td><?php echo $rows['email']; ?></td>
                            <td><?php echo $rows['phone_no']; ?></td>

                            <?php if ($rows['is_active'] == '1') { ?>
                                <td class="text-center">
                                    <h5><span class="badge badge-pill badge-success">Active</span></h5>
                                </td>
                            <?php } elseif ($rows['is_active'] == '2') { ?>
                                <td class="text-center">
                                    <h5><span class="badge badge-pill badge-secondary">Archived</span></h5>
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
                                    <span> <button type="button" class="btn btn-secondary btn-circle archiveBtn btn-sm" title="Archive">
                                            <i class="fa fa-archive"></i>
                                        </button></span>
                                <?php } else { ?>
                                    <span> <button type="button" class="btn btn-secondary btn-circle btn-sm" title="Archive" disabled>
                                            <i class="fa fa-archive"></i>
                                        </button></span>
                                <?php } ?>
                            </td>
                            <td hidden><?php echo $rows['firstname']; ?></td>
                            <td hidden><?php echo $rows['middlename']; ?></td>
                            <td hidden><?php echo $rows['lastname']; ?></td>
                            <td hidden><?php echo $rows['suffix']; ?></td>
                            <td hidden><?php echo $rows['spec_id']; ?></td>
                            <td hidden><?php echo $rows['address']; ?></td>
                            <td hidden><?php echo $rows['license_no']; ?></td>
                            <td hidden><?php echo $rows['title']; ?></td>
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

            $('#u_email').val(data[4]);
            $('#u_fname').val(data[8]);
            $('#u_mname').val(data[9]);
            $('#u_lname').val(data[10]);
            $('#u_sufx').val(data[11]);
            $('#u_dob').val(data[3]);
            $('#u_phone').val(data[5]);
            $('#u_add').val(data[13]);
            $('#u_lic').val(data[14]);
            $('#u_spec').val(data[12]);
            $('#u_title').val(data[15]);
        });

        $('.archiveBtn').on('click', function() {

            $('#archiveDocModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#adid').val(data[0]);
        });

        $('.addDocBtn').on('click', function() {
            $('#addDocModal').modal('show');
        });

        $('.addSpecBtn').on('click', function() {
            $('#addSpecModal').modal('show');
        });

    });
</script>