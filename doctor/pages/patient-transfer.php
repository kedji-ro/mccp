<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Patient Information Request</h1>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="content">
            <div class="" id="patientReqList">
                <div class="table-responsive animated--fade-in">
                    <table class="table table-bordered table-condensed table-fixed table-striped" id="reqsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th hidden></th>
                                <th>Requested By</th>
                                <th>Transfer To</th>
                                <th>Request Date</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <?php

                        $q = "SELECT * FROM tb_requests tr INNER JOIN tb_users tu ON tu.user_id = tr.user_id
                                LEFT JOIN (SELECT user_id, CONCAT(IFNULL(firstname,''),' ',IFNULL(middlename,''),' ',IFNULL(lastname,''),' ',IFNULL(suffix,'')) AS doct_name FROM tb_users WHERE role = 2) td
                                ON td.user_id = tr.docto_id
                                WHERE docfrom_id = '" . $_SESSION['U_ID'] . "'";
                        $res = $con->query($q);
                        if ($res) {
                            foreach ($res as $rows) {
                        ?>
                                <tr>
                                    <td hidden><?php echo $rows['req_id']; ?></td>
                                    <td><?php echo $rows['firstname'] . ' ' . $rows['middlename'] . ' ' . $rows['lastname'] . ' ' . $rows['suffix']; ?></td>
                                    <td><?php echo $rows['doct_name']; ?></td>
                                    <td><?php echo $rows['date_logged']; ?></td>
                                    <td class="text-center">
                                        <?php
                                        switch ($rows['req_stat']) {
                                            case 0: ?>
                                                <h5><span class="badge badge-pill badge-warning">Pending</span></h5>
                                            <?php break;
                                            case 1: ?>
                                                <h5><span class="badge badge-pill badge-success">Transferred</span></h5>
                                            <?php break;
                                            case 2: ?>
                                                <h5><span class="badge badge-pill badge-danger">Denied</span></h5>
                                        <?php break;
                                        } ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-success btn-circle btn-sm btnApproveReq" title="Approve" <?php echo ($rows['req_stat'] != 0)?'disabled' : ''; ?>><i class="fa fa-check"></i></button>
                                        <span><button type="button" class="btn btn-danger btn-circle btn-sm btnDenyReq" title="Deny" <?php echo ($rows['req_stat'] != 0)?'disabled' : ''; ?>><i class="fa fa-close"></i></button></span>
                                </tr>
                        <?php
                            }
                        } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#reqsTable').dataTable().fnSort([
            [4, 'asc']
        ]);
    });
    
    $('.btnApproveReq').on('click', function() {

        $('#approveReq').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#aridm').val(data[0]);
    });

    $('.btnDenyReq').on('click', function() {

        $('#denyReq').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#drid').val(data[0]);
    });
</script>