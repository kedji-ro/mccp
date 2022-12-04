<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Information Transfer Requests</h1>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive animated--fade-in">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="reqsTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden></th>
                        <th>Requested On</th>
                        <th>From</th>
                        <th>To</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <?php
                $qry = "SELECT tr.req_id, tr.user_id, tr.date_logged, tf.docfrom, tt.docto, tr.req_stat
                        FROM tb_requests tr 
                        INNER JOIN tb_users tu ON tu.user_id = tr.user_id 
                        INNER JOIN (SELECT user_id AS uid, CONCAT(IFNULL(firstname,''),' ',IFNULL(middlename,''),' ',IFNULL(lastname,''),' ',IFNULL(suffix,'')) AS docfrom FROM tb_users WHERE role = 2) AS tf ON tr.docfrom_id = tf.uid
                        INNER JOIN (SELECT user_id AS uid, CONCAT(IFNULL(firstname,''),' ',IFNULL(middlename,''),' ',IFNULL(lastname,''),' ',IFNULL(suffix,'')) AS docto FROM tb_users WHERE role = 2) AS tt ON tr.docto_id = tt.uid
                        WHERE tr.user_id = '" . $_SESSION['U_ID'] . "'";

                $q = $con->query($qry);
                if ($q) {
                    foreach ($q as $rows) {
                ?>
                        <tr>
                            <td hidden><?php echo $rows['req_id']; ?></td>
                            <td><?php echo $rows['date_logged']; ?></td>
                            <td><?php echo $rows['docfrom']; ?></td>
                            <td><?php echo $rows['docto']; ?></td>

                            <td class="text-center">
                                <?php
                                switch ($rows['req_stat']) {
                                    case 0: ?>
                                        <h5><span class="badge badge-pill badge-warning">Sent</span></h5>
                                    <?php break;
                                    case 1: ?>
                                        <h5><span class="badge badge-pill badge-success">Transferred</span></h5>
                                    <?php break;
                                    case 2: ?>
                                        <h5><span class="badge badge-pill badge-secondary">Cancelled</span></h5>
                                <?php break;
                                } ?>
                            </td>

                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-danger btn-circle cancelReqBtn" title="Cancel" <?php echo ($rows['req_stat'] == 1 || $rows['req_stat'] == 2) ? 'disabled' : ''; ?>><i class="fas fa-close"></i></button>
                            </td>
                        </tr>
                <?php }
                } ?>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#reqsTable').dataTable();
    });

    $('.cancelReqBtn').on('click', function() {

        $('#cancelReqModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#crid').val(data[0]);
    });
</script>