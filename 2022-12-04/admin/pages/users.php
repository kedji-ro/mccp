<?php
$query = "SELECT * FROM tb_users";
$query_run = mysqli_query($con, $query);
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Users Management</h1>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#">
        <i class="fas fa-plus"></i> Create Admin Account</button>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3"></div>
    <div class="card-body text-black">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th>Email </th>
                        <th>Mobile</th>
                        <th>Tel No.</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <?php
                if ($query_run) {
                    foreach ($query_run as $rows) {
                ?>
                        <tr>
                            <td><?php echo $rows['user_id']; ?></td>
                            <td hidden><?php echo $rows['firstname']; ?></td>
                            <td hidden><?php echo $rows['lastname']; ?></td>
                            <td><?php echo $rows['lastname'] . ', ' . $rows['firstname']; ?></td>
                            <td><?php echo $rows['email']; ?></td>
                            <td><?php echo $rows['phone_no']; ?></td>
                            <td><?php echo $rows['u_telno']; ?></td>

                            <?php if ($rows['is_active'] == '1') { ?>
                                <td class="text-center">
                                    <h5><span class="badge badge-pill badge-success">Active</span></h5>
                                </td>
                            <?php } else { ?>
                                <td class="text-center">
                                    <h5><span class="badge badge-pill badge-secondary">Inactive</span></h5>
                                </td>
                            <?php } ?>

                            <td class="text-center"><button type="button" class="btn btn-primary btn-circle editBtn btn-sm" title="View/Edit">
                                    <i class="fa fa-edit"></i>
                                </button>
                                <span>
                                    <?php if ($rows['is_active'] == '1') {  ?>
                                        <button type="button" class="btn btn-danger btn-circle deactBtn btn-sm" title="Deactivate">
                                            <i class="fa fa-close"></i>
                                        </button>

                                    <?php } else { ?>
                                        <button type="button" class="btn btn-success btn-circle reactBtn btn-sm" title="Deactivate">
                                            <i class="fa fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-secondary btn-circle archiveBtn btn-sm" title="Archive">
                                            <i class="fa fa-archive"></i>
                                        </button>
                                    <?php } ?>
                            </td>
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

        $('.deactBtn').on('click', function() {

            $('#deactUserModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#u_id').val(data[0]);
        });
    });

    $(document).ready(function() {

        $('.reactBtn').on('click', function() {

            $('#reactUserModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#ur_id').val(data[0]);
        });
    });
</script>