<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Patients Management (Mothers)</h1>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#regMotherModal">
        <i class="fas fa-plus"></i> Register Mother</button>
</div>

<?php
$query = "SELECT * FROM `tb_users` where role = 3";
$query_run = mysqli_query($con, $query);
?>

<div class="card shadow mb-4 animated--fade-in">
    <div class="card-header py-3"></div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>CODE</th>
                        <th>PATIENT'S NAME</th>
                        <th>ADDRESS</th>
                        <th>DATE OF BIRTH</th>
                        <th>MARITAL STATUS</th>
                        <th>F-DAY OF L-MENS PERIOD </th>
                        <th class="text-center" style="width:8%;">STATUS</th>
                        <th class="text-center" style="width:8%;">ACTION</th>
                    </tr>
                </thead>
                
                        <tbody>
                            <?php
                if ($query_run) {
                    foreach ($query_run as $rows) {
                ?>
                            <tr>
                                <td><?php echo $rows['user_id']; ?></td>
                                <td><?php echo $rows['firstname'] . ' ' .  $rows['middlename'] . ' ' .  $rows['lastname'] . ' ' .  $rows['suffix']; ?></td>
                                <td><?php echo $rows['address']; ?></td>
                                <td><?php echo $rows['DOB']; ?></td>
                                <td><?php echo $rows['marital_status']; ?></td>
                                <td><?php echo $rows['date_first_men_period']; ?></td>
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
                                    <span> <button type="button" class="btn btn-primary btn-circle edit btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </button></span>

                                    <?php if ($rows['is_active'] == '1') { ?>
                                        <span> <button type="button" class="btn btn-secondary btn-circle archm btn-sm">
                                                <i class="fa fa-archive"></i>
                                            </button></span>
                                    <?php } else { ?>
                                        <span> <button type="button" class="btn btn-secondary btn-circle btn-sm" disabled>
                                                <i class="fa fa-archive"></i>
                                            </button></span>
                                    <?php } ?>
                                </td>
                            </tr>
                              <?php
                    }
                }
                ?>
                        </tbody>
              
            </table>
        </div>
    </div>
</div>

<script>
    $('.edit').on('click', function() {

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

    $('.archm').on('click', function() {

        $('#archivem').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        $('#aarmid').val(data[0]);
    });

</script>