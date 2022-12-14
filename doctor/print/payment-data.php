<?php require_once('../../login/db_conn.php'); ?>
<?php if (isset($_SESSION['U_ID']) == null) : ?>
    <script>
        window.location.href = "<?php echo home; ?>/?";
    </script>
<?php elseif (isset($_SESSION['U_ID'])) : ?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Payment Information</title>
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
    $q = "SELECT * FROM tb_payment WHERE record_id = " . $_GET['id'];

    $res = $con->query($q);
    ?>

    <body>
        <div class="page-content">
            <div class="row">

                <!-- Page Header -->
                <div class="col-md-12" style="padding: 50px 0px 0px 0px;">
                    <div style="text-align: center;">
                        <p style="line-height: 1.5;"> <span style="font-size: 12pt;"> Mother Child Care Portal </span><br>
                            <span style="font-weight: bold; font-size: 14pt;">Payment Information</span><br>
                            <span style="font-size: 10pt;"> Date: <span><?php echo date("M d, Y", strtotime($date)); ?></span>
                        </p>
                    </div>
                </div>

                <!-- Page Body -->
                <div class="col-md-12" style="padding: 30px 30px 30px 30px; font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif; line-height: 1.3;">
                    <?php if ($res) {
                        $r = mysqli_fetch_assoc($res); ?>
                        <table>
                            <tr>
                                <td>Appointment No.</td>
                                <td class="sep">:</td>
                                <td class="inf"><?php echo $r['appt_id']; ?></td>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr>
                                <td>Payment Method</td>
                                <td class="sep">:</td>
                                <td class="inf"><?php echo $r['payment_method']; ?></td>
                            </tr>
                            <tr>
                                <td>Reference No.</td>
                                <td class="sep">:</td>
                                <td class="inf"><?php echo ($r['ref_no'] == '') ? 'N/A' : $r['ref_no']; ?></td>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr>
                                <td>Sent On:</td>
                                <td class="sep">:</td>
                                <td class="inf"><?php echo $r['payment_date']; ?></td>
                            </tr>
                            <tr>
                                <td>Recieved On:</td>
                                <td class="sep">:</td>
                                <td class="inf"><?php echo ($r['date_paid'] == '' || $r['date_paid'] == '0000-00-00 00:00:00') ? 'To be recieved' : $r['date_paid']; ?></td>
                            </tr>
                            <tr>
                                <td><br></td>
                            </tr>
                            <tr>
                                <td>Amount</td>
                                <td class="sep">:</td>
                                <td class="inf">PHP <?php echo $r['amount_paid']; ?></td>
                            </tr>
                        </table>
                    <?php } ?>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="../assets/js/jquery.js"></script>
        <script>
            window.onafterprint = function(e) {
                window.location.href = "../?payments";
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
        window.location.href = "../?payments";
    </script>
<?php endif; ?>