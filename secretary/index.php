<?php
include '../login/db_conn.php';

// if (isset($_SESSION['D_ID'])) {
//     if (isset($_SESSION['U_ROLE'])) {
//         if ($_SESSION['U_ROLE'] != '2') {
//             header('Location: http://localhost:8080/mccp/admin/?dashboard');
//         }
//     } else {
//         header('Location: http://localhost:8080/mccp/?');
//     }
// } else {
//     header('Location: http://localhost:8080/mccp/?');
// }

// if (empty($_GET)) {
//     header('Location: ?dashboard');
// }

// $q = "SELECT COUNT(appointment_id) AS appt_count 
// FROM tb_appointment
// WHERE doctor_id = " . $_SESSION['D_ID'] . "  AND DATE(appointment_date) > (NOW()) AND a_stat = 0";

$q = "SELECT COUNT(appointment_id) AS appt_count  FROM tb_appointment ta WHERE ta.a_stat = 0 AND ta.doctor_id = '" . $_SESSION['D_ID'] . "'";

$result = mysqli_query($con, $q);

if ($result) {
    $rows = mysqli_fetch_assoc($result);
    $_SESSION['APPT_COUNT'] = $rows['appt_count'];
}

$q = "SELECT COUNT(appointment_id) AS atr_count 
FROM tb_appointment
WHERE doctor_id = " . $_SESSION['D_ID'] . "  AND DATE(transfer_date) = null AND a_stat = 3";

$result = mysqli_query($con, $q);

if ($result) {
    $rows = mysqli_fetch_assoc($result);
    $_SESSION['PATREQ_COUNT'] = $rows['atr_count'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php if (isset($_GET['appointments']) != null) { ?>
        <title>Appointments | MOTHER CHILD CARE PORTAL</title>
    <?php } ?>
    <?php if (isset($_GET['reg-patient']) != null) { ?>
        <title>Register Patient | MOTHER CHILD CARE PORTAL</title>
    <?php } ?>

    <script src="../assets/vendor/jquery/jquery.min.js"></script>

    <!-- Custom fonts for this template-->
    <!-- <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!--     FullCalendar     -->
    <link rel="stylesheet" href="../assets/fullcalendar/lib/main.min.css">
    <link rel="stylesheet" href="../assets/fullcalendar/lib/main.css">

</head>

<body id="page-top">
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="?dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="../assets/img/baby.png" width="50px" height="50px" alt="logo">
                </div>
                <div class="sidebar-brand-text mx-2">MOTHER CHILD CARE PORTAL</div>
            </a>

            <hr class="sidebar-divider my-0">

            <!-- RECORDS -->
            <li class="nav-item <?php if (isset($_GET['appointments']) != null) {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="?appointments">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Appointments</span><?php if ($_SESSION['APPT_COUNT'] != 0) { ?>
                        <span class="badge badge-light" id="aReqCount" style="margin-left:55px; position:absolute;"><?php echo $_SESSION['APPT_COUNT']; ?></span>
                    <?php } ?>
                </a>
            </li>
            <li class="nav-item <?php if (isset($_GET['reg-patient']) != null) {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="?reg-patient">
                    <i class="fas fa-fw fa-id-card"></i>
                    <span>Register Patient</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Version -->
            <div class="text-center d-none d-md-inline">
                <?php include '../version.php'; ?>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['FULLNAME']; ?></span>
                                <img class="img-profile rounded-circle" src="../assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Page Content -->
                <div class="container-fluid">
                    <?php

                    if (isset($_GET['appointments']) != null) {
                        include('pages/appointments.php');
                    }

                    if (isset($_GET['reg-patient']) != null) {
                        include('pages/reg-patient.php');
                    }
                    
                    ?>
                </div>
                <!-- End of Page Content -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MOTHER CHILD CARE PORTAL 2022</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../login/logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php include('modals.php'); ?>


    <!-- Bootstrap core JavaScript-->
    <!-- <script src="../assets/vendor/jquery/jquery.min.js"></script> -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/datatables-demo.js"></script>

    <!-- FullCalendar -->
    <script src="../assets/fullcalendar/lib/main.min.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

<script>
    $(document).ready(function() {
        $('.toast').toast('show');
    });

    $('.toast').toast({
        delay: 3000
    })

    $(document).ready(function() {
        $('#list').DataTable();
    });

    <?php unset($_SESSION['msg']); ?>
</script>

</html>