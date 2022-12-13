<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Transferred Patient Information</h1>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <?php
    $q = "SELECT DISTINCT *, tr.user_id as u_id FROM tb_requests tr 
            INNER JOIN tb_users tu ON tr.user_id = tu.user_id 
            INNER JOIN (SELECT tu.user_id, 
            CONCAT(IFNULL(tu.firstname,''),' ', IFNULL(tu.middlename,''),' ', IFNULL(tu.lastname,''),' ', IFNULL(tu.suffix,'')) AS docFrom FROM tb_users tu WHERE tu.role = 2) AS tdf ON tdf.user_id = tr.docfrom_id
            WHERE tr.docto_id = '" . $_SESSION['U_ID'] . "' AND req_stat = 1";
    $q_run = mysqli_query($con, $q);
    ?>
    <div class="card-body">
        <div class="table-responsive" id="tb_body">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden>c_id</th>
                        <th>Patient Name</th>
                        <th>Requested From</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <?php
                if ($q_run) {
                    foreach ($q_run as $rows) {
                ?>
                        <tr>
                            <td hidden><?php echo $rows['u_id']; ?></td>
                            <td><?php echo $rows['lastname'] . ', ' . $rows['firstname'] . ' ' . $rows['middlename']; ?></td>
                            <td><?php echo $rows['docFrom']; ?></td>
                            <td class="text-center">
                                <button type="button" class="btn btn-secondary btn-circle btn-sm printABtn" title="Print"><i class="fas fa-print"></i></button>
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
    $('.printABtn').on('click', function() {

        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        window.location.href = "<?php echo home; ?>/doctor/print/patient-info.php?id=" + data[0];
    });
</script>