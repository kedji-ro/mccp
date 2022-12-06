<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Clinics Management</h1>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEditClinicModal" title="Add Clinic" onclick="$('#c_mTitle').html('Add'); $('#addedit_clinic').attr('name','add_clinic');">
        <i class="fas fa-plus"></i> Add Clinic</button>
</div>

<div class="card shadow mb-4">
    <div class="card-header py-3"></div>
    <?php
    $q = "SELECT *  FROM tb_doctor_clinics tdc INNER JOIN  tb_clinic tc ON tdc.clinic_id = tc.clinic_id WHERE tdc.doctor_id = '".$_SESSION['U_ID']."'";
    $q_run = mysqli_query($con, $q);
    ?>
    <div class="card-body">
        <div class="table-responsive" id="tb_body">
            <table class="table table-bordered table-condensed table-fixed table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th hidden>c_id</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone No.</th>
                        <th>Tel No.</th>
                        <th>Operating Hours.</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                        <th hidden></th>
                        <th hidden></th>
                    </tr>
                </thead>

                <?php
                if ($q_run) {
                    foreach ($q_run as $rows) {
                ?>
                        <tr>
                            <td hidden><?php echo $rows['clinic_id']; ?></td>
                            <td><?php echo $rows['clinic_name']; ?></td>
                            <td><?php echo $rows['clinic_address']; ?></td>
                            <td><?php echo $rows['contact_no']; ?></td>
                            <td><?php echo $rows['tel_no']; ?></td>
                            <td><?php echo $rows['open_time']. ' - ' .$rows['close_time']; ?></td>
                            <?php if ($rows['c_stat'] == '1') { ?>
                                <td class="text-center">
                                    <h5><span class="badge badge-pill badge-success">Active</span></h5>
                                </td>
                            <?php } else { ?>
                                <td class="text-center">
                                    <h5><span class="badge badge-pill badge-secondary">Inactive</span></h5>
                                </td>
                            <?php } ?>
                            <td class="text-center"><button type="button" class="btn btn-primary btn-circle btn-sm editClinic" title="View/Edit Details"><i class="fa fa-edit"></i></button>
                                <?php if ($rows['c_stat'] == '1') { ?>
                                    <span><button type="button" class="btn btn-danger btn-circle btn-sm deactClinicBtn" title="Deactivate"><i class="fa fa-close"></i></button></span>
                                <?php } else { ?>
                                    <span><button type="button" class="btn btn-success btn-circle btn-sm reactClinicBtn" title="Reactivate" <?php echo ($rows['c_stat'] == 2) ? 'disabled': '';?>><i class="fa fa-check"></i></button></span>
                                    <span><button type="button" class="btn btn-secondary btn-circle btn-sm archiveClinicBtn" title="Archive" <?php echo ($rows['c_stat'] == 2) ? 'disabled': '';?>><i class="fa fa-archive"></i></button></span>
                                <?php } ?>
                            </td>
                            <td hidden><?php echo $rows['open_time']; ?></td>
                            <td hidden><?php echo $rows['close_time']; ?></td>
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
        $('#clinic_list').dataTable();

        $('.editClinic').on('click', function() {

            $('#addEditClinicModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#c_mTitle').html('Edit');
            $('#c_id').val(data[0]);
            $('#c_name').val(data[1]);
            $('#c_address').val(data[2]);
            $('#c_phoneno').val(data[3]);
            $('#c_telno').val(data[4]);
            $('#addedit_clinic').attr('name','edit_clinic');
            $('#co').val(data[8]);
            $('#cc').val(data[9]);
        });

        $('.deactClinicBtn').on('click', function() {

            $('#deactReactClinicModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#c_deactReactTitle').html('Deactivate');
            $('#c_op').html('Deactivate');
            $('#c_drid').val(data[0]);
            $('#c_drname').html(data[1]);
            $('#c_stat').val($.trim(data[5]));
        });

        $('.reactClinicBtn').on('click', function() {

            $('#deactReactClinicModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#c_deactReactTitle').html('Reactivate');
            $('#c_op').html('Reactivate');
            $('#c_drid').val(data[0]);
            $('#c_drname').html(data[1]);
            $('#c_stat').val($.trim(data[5]));
        });
        
        $('.archiveClinicBtn').on('click', function() {

            $('#archiveClinicModal').modal('show');

            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#ct').html('Archive');
            $('#carid').val(data[0]);
            $('#cnm').html(data[1]);
        });
    });
</script>