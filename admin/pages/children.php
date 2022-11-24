<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Patients Management (Children)</h1>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#studentaddmodal">
        <i class="fas fa-plus"></i> Register Child</button>
</div>
<?php

$query = "SELECT *, 
                                        `tb_users`.`firstname` AS m_fname,
                                        `tb_users`.`middlename` AS m_mname,
                                        `tb_users`.`lastname` AS m_lname,
                                        `tb_users`.`suffix` AS m_sname,
                                        `tb_child_details`.`firstname` AS c_fname,
                                        `tb_child_details`.`middlename` AS c_mname,
                                        `tb_child_details`.`lastname` AS c_lname,
                                        `tb_child_details`.`suffix` AS c_sname
                                        
                                        FROM `tb_child_details` INNER JOIN `tb_users` ON `tb_users`.`user_id` = `tb_child_details`.`parent_id`";

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
                        <th>Child's Name</th>
                        <th>Address</th>
                        <th>Birthdate</th>
                        <th>Age</th>
                        <th>Mother's Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <?php
                if ($query_run) {
                    foreach ($query_run as $rows) {
                        $c_fullname = $rows['c_fname'] . ' ' . $rows['c_mname'] . ' ' . $rows['c_lname'] . ' ' . $rows['c_sname'];
                        $p_fullname = $rows['m_fname'] . ' ' . $rows['m_mname'] . ' ' . $rows['m_lname'] . ' ' . $rows['m_sname'];
                ?>
                        <tbody>
                            <tr>
                                <td><?php echo $rows['child_id']; ?></td>
                                <td><?php echo $c_fullname; ?></td>
                                <td><?php echo $rows['address']; ?></td>
                                <td><?php echo $rows['c_dob']; ?></td>
                                <td><?php echo ''; ?></td>
                                <td><?php echo $p_fullname; ?></td>
                                <!--buttons-->
                                <td>
                                    <span> <button type="button" class="btn btn-primary btn-circle editbtn btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button></span>

                                    <?php if ($rows['is_active'] == '1') { ?>
                                        <span> <button type="button" class="btn btn-danger btn-circle deletebtn btn-sm">
                                                <i class="fa fa-close"></i>
                                            </button></span>
                                    <?php } else { ?>
                                        <span> <button type="button" class="btn btn-danger btn-circle deletebtn btn-sm" disabled>
                                                <i class="fa fa-close"></i>
                                            </button></span>
                                    <?php } ?>
                                </td>
                            </tr>
                        </tbody>
                <?php
                    }
                } else {
                    //echo "No Record Found";
                }
                ?>
                <tfoot>
                    <tr>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>