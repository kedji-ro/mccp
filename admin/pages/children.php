<?php

$q = $con->query("SELECT *  ,CONCAT(IFNULL(tcd.firstname,''),' ',IFNULL(tcd.middlename,''),' ',IFNULL(tcd.lastname,'')) as child
                            ,CONCAT(IFNULL(tu.firstname,''),' ',IFNULL(tu.middlename,''),' ',IFNULL(tu.lastname,'')) as guardian 
                            FROM tb_child_details tcd 
                            INNER JOIN tb_users tu ON tcd.parent_id = tu.user_id");

?>


<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Patients Management (Children)</h1>
    <button type="button" class="btn btn-success regChildBtn">
        <i class="fas fa-plus"></i> Register Child</button>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="childTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden></th>
                        <th>Child's Name</th>
                        <th>Mother/Guardian</th>
                        <th>Date of Birth</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                        <th hidden></th>
                    </tr>
                </thead>

                <?php

                if ($q) {
                    foreach ($q as $rows) {
                ?>
                        <tr>
                            <td hidden><?php echo $rows['child_id']; ?></td>
                            <td><?php echo $rows['child'];?></td>
                            <td><?php echo $rows['guardian']; ?></td>
                            <td><?php echo $rows['dateofbirth']; ?></td>
                            <td><?php echo $rows['height']; ?></td>
                            <td><?php echo $rows['weight']; ?></td>
                            <td><h5><span class="badge badge-pill badge-<?php echo ($rows['ch_stat'] == '1') ? 'success' : 'secondary' ;?>"><?php echo ($rows['ch_stat'] == '1') ? 'Active' : 'Inactive' ;?></span></h5></td>

                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-primary btn-circle editChildBtn" title="View/Edit Details"><i class="fas fa-edit"></i> </button>
                                <span> <button type="button" class="btn btn-sm btn-secondary btn-circle archiveChildBtn" title="Archive" <?php echo (($rows['ch_stat'] == '0') ? 'disabled' : ''); ?>><i class="fas fa-archive"></i></button></span>
                            </td>

                            <td hidden><?php echo $rows['firstname']; ?></td>
                            <td hidden><?php echo $rows['middlename']; ?></td>
                            <td hidden><?php echo $rows['lastname']; ?></td>
                            <td hidden><?php echo $rows['suffix']; ?></td>
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
$('.regChildBtn').on('click', function() {

        $('#registerChildModal').modal('show');
    });

    $('.editChildBtn').on('click', function() {

        $('#editChildModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#ch_id').val(data[0]);
        $('#chfn').val(data[7]);
        $('#chmn').val(data[8]);
        $('#chln').val(data[9]);
        $('#chsf').val(data[10]);
        $('#chdob').val(data[2]);
        $('#chh').val(data[3]);
        $('#chw').val(data[4]);
    });

    $('.archiveChildBtn').on('click', function() {

        $('#archiveChildModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#arcid').val(data[0]);
    });


    $(document).ready(function() {
        $('#childTable').dataTable().fnSort([
            [6, 'asc']
        ]);
    });
</script>