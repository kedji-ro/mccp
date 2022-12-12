<?php require_once('../../login/db_conn.php'); ?>
<?php if (isset($_SESSION['U_ID']) == null) : ?>
    <script>
        window.location.href = "<?php echo home; ?>/?";
    </script>
<?php elseif (isset($_SESSION['U_ID'])) : ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Print Data</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="stylesheet" type="text/css" href="../assets/css/main.css">

        <style type="text/css" media="print">
            @media print {
                @page {
                    margin-top: 0;
                    margin-bottom: 0;
                }

                body {
                    padding-top: 0px;
                    padding-bottom: 0px;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                }

                .sep {
                    padding-left: 20px;
                }

                .inf {
                    padding-left: 15px;
                }
            }
        </style>

        <style type="text/css">
            hr.m0 {
                margin-top: 0px;
                margin-bottom: 0px;
            }

            .table>tbody>tr>td,
            .table>tbody>tr>th,
            .table>tfoot>tr>td,
            .table>tfoot>tr>th,
            .table>thead>tr>td,
            .table>thead>tr>th {
                padding: 2px;
            }

            body:not(.page-loaded) {
                opacity: 1;
            }
        </style>
    </head>

    <?php
    $q = "SELECT * FROM tb_appointment ta
            INNER JOIN tb_users tu ON tu.user_id = ta.patient_id
            INNER JOIN tb_clinic tc ON tc.clinic_id = ta.clinic_id
            INNER JOIN (SELECT tu.user_id, CONCAT(IFNULL(tu.firstname,''),' ', IFNULL(tu.middlename,''),' ', IFNULL(tu.lastname,''),' ', IFNULL(tu.suffix,'')) AS doc FROM tb_users tu WHERE tu.role = 2) AS td ON td.user_id = ta.doctor_id
            WHERE ta.patient_id  = " . $_GET['id'];

    $res = $con->query($q);
    ?>

    <body>
        <div class="page-content">
            <div class="row">

                <!-- Page Header -->
                <div class="col-md-12" style="padding: 50px 0px 0px 0px;">
                    <div style="text-align: center;">
                        <p style="line-height: 1.5;"> <span style="font-size: 12pt;"> Mother Child Care Portal </span><br>
                            <span style="font-weight: bold; font-size: 14pt;">Patient Appointment Data</span><br>
                            <span style="font-size: 10pt;"> Date: <span><?php echo date("M d, Y", strtotime($date)); ?></span>
                        </p>
                    </div>
                </div>

                <!-- Page Body -->
                <div class="col-md-12" style="padding: 30px 30px 30px 30px; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; line-height: 1.3;">
                    <?php if ($res) {
                        //$r = mysqli_fetch_assoc($res); 
                        foreach ($res as $r) { ?>
                            <table>
                                <tr>
                                    <td>Appointment No.</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo $r['a_id']; ?></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>Patient Name</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo $r['p_fn'] . ' ' . $r['p_mn'] . ' ' . $r['p_ln'] . ' ' . $r['p_s']; ?></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>Date</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo $r['a_d']; ?></td>
                                </tr>
                                <tr>
                                    <td>Time</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo $r['a_t']; ?></td>
                                </tr>
                                <tr>
                                    <td>Day</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo $r['a_day']; ?></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>Contact No.</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo $r['p_cn']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tel No.</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo ($r['p_tel'] == '') ? 'N/A' : $r['p_tel']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo $r['p_email']; ?></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td>Remarks</td>
                                    <td class="sep">:</td>
                                    <td class="inf"></td>
                                </tr>
                            </table>
                            <hr>
                            <h3>Clinic Information</h3>
                            <table>
                                <tr>
                                    <td>Name</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo ($r['c_name'] == '') ? 'N/A' : $r['c_name']; ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo ($r['c_addr'] == '') ? 'N/A' : $r['c_addr']; ?></td>
                                </tr>
                                <tr>
                                    <td>Contact No.</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo ($r['c_cont'] == '') ? 'N/A' : $r['c_cont']; ?></td>
                                </tr>
                                <tr>
                                    <td>Tel No.</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo ($r['c_tel'] == '') ? 'N/A' : $r['c_tel']; ?></td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                </tr>
                                <tr>
                                    <td style="font-weight: bold;">Operating Hours</td>
                                </tr>
                                <tr>
                                    <td>From</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo ($r['open_time'] == '') ? 'N/A' : $r['open_time']; ?></td>
                                </tr>
                                <tr>
                                    <td>To</td>
                                    <td class="sep">:</td>
                                    <td class="inf"><?php echo ($r['close_time'] == '') ? 'N/A' : $r['close_time']; ?></td>
                                </tr>
                            </table>
                    <?php }
                    } ?>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="../assets/js/jquery.js"></script>
        <script>
            window.onafterprint = function(e) {
                window.location.href = "../?transferred";
            };

            window.print();

            setTimeout(function() {
                $(window).one('mousemove', window.onafterprint);
            }, 1);
        </script>
    </body>

    </html>
<?php else : ?>
    <script>
        window.location.href = "../?transferred";
    </script>
<?php endif; ?>