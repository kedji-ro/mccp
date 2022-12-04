<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Payments</h1>
</div>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3">
    </div>
    <div class="card-body">
        <div class="table-responsive animated--fade-in">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="appointmentsTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden></th>
                        <th>Date/Time Sent</th>
                        <th>Appt. No</th>
                        <th>Mode of Payment</th>
                        <th>Ref No.</th>
                        <th>Amount</th>
                        <th>Date/Time Recieved</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <?php
                $q = $con->query("SELECT * FROM tb_payment WHERE patient_id = '" . $_SESSION['U_ID'] . "'");
                if ($q) {
                    foreach ($q as $rows) {
                ?>
                        <tr>
                            <td hidden><?php echo $rows['record_id']; ?></td>
                            <td><?php echo $rows['payment_date']; ?></td>
                            <td><?php echo $rows['appt_id']; ?></td>
                            <td><?php echo $rows['payment_method']; ?></td>
                            <td><?php echo $rows['ref_no']; ?></td>
                            <td><?php echo $rows['amount_paid']; ?></td>
                            <td><?php echo ($rows['date_paid'] == '' || $rows['date_paid'] == '0000-00-00 00:00:00') ? 'N/A' : $rows['date_paid']; ?></td>
                            <td class="text-center">
                                <?php
                                switch ($rows['p_stat']) {
                                    case 0:
                                ?>
                                        <h5><span class="badge badge-pill badge-warning">Sent</span></h5>
                                    <?php break;
                                    case 1:
                                    ?>
                                        <h5><span class="badge badge-pill badge-success">Recieved</span></h5>
                                <?php break;
                                } ?>
                            </td>

                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-secondary btn-circle viewApptBtn" title="Print"><i class="fas fa-print"></i> </button>
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
        $('#appointmentsTable').dataTable();
    });

    $('.viewApptBtn').on('click', function() {

        $('#viewApptModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#acn').val(data[3]);
        $('#acl').val(data[9]);
        $('#acc').val(data[8]);
        $('#ad').val(data[10]);
    });

    $('.reschedApptBtn').on('click', function() {

        $('#reschedApptModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#raid').val(data[0]);
        $('#rad').val(data[1]);
        $('#rat').val(data[11]);
    });

    $('.cancelApptBtn').on('click', function() {

        $('#cancelApptModal').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#caid').val(data[0]);
    });
</script>