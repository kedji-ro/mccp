<?php
include '../login/db_conn.php';

if (isset($_SESSION['U_ID'])) {
    if (isset($_SESSION['U_ROLE'])) {

        switch ($_SESSION['U_ROLE']) {
            case '1':
                header('Location: ' . home . '/admin/?dashboard');
                break;
            case '2':
                header('Location: ' . home . '/doctor/?dashboard');
                break;
            case '4':
                header('Location: ' . home . '/secretary/?appointments');
                break;
        }
    }
} else {
    header('Location: '.home.'/?');
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

    <?php if (isset($_GET['set-appointment']) != null) { ?>
        <title>Set an Appointment | MOTHER CHILD CARE PORTAL</title>
    <?php } ?>
    <?php if (isset($_GET['my-appointments']) != null) { ?>
        <title>My Appointments | MOTHER CHILD CARE PORTAL</title>
    <?php } ?>
    <?php if (isset($_GET['req-info']) != null) { ?>
        <title>Request Information | MOTHER CHILD CARE PORTAL</title>
    <?php } ?>
    <?php if (isset($_GET['reqs']) != null) { ?>
        <title>Transfer Requests | MOTHER CHILD CARE PORTAL</title>
    <?php } ?>
    <?php if (isset($_GET['children']) != null) { ?>
        <title>Registered Children | MOTHER CHILD CARE PORTAL</title>
    <?php } ?>
    <?php if (isset($_GET['my-profile']) != null) { ?>
        <title>My Profile | MOTHER CHILD CARE PORTAL</title>
    <?php } ?>
    <?php if (isset($_GET['payments']) != null) { ?>
        <title>Payments | MOTHER CHILD CARE PORTAL</title>
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
            <li class="nav-item <?php if (isset($_GET['set-appointment']) != null) {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="?set-appointment">
                    <i class="fas fa-fw fa-calendar-plus"></i>
                    <span>Set an Appointment</span>
                </a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">RECORDS</div>
            <li class="nav-item <?php if (isset($_GET['my-appointments']) != null) {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="?my-appointments">
                    <i class="fas fa-fw fa-calendar-days"></i>
                    <span>My Appointments</span></a>
            </li>
            <li class="nav-item <?php if (isset($_GET['req-info']) || isset($_GET['reqs'])) {
                                    echo 'active';
                                } ?>">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-paper-plane"></i>
                    <span>Info Transfer</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item <?php if (isset($_GET['req-info'])) {
                                                    echo 'active';
                                                } ?>" href="?req-info">Send Request</a>
                        <a class="collapse-item <?php if (isset($_GET['reqs'])) {
                                                    echo 'active';
                                                } ?>" href="?reqs">See Requests</a>
                    </div>
                </div>
            </li>

            <li class="nav-item <?php if (isset($_GET['children']) != null) {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="?children">
                    <i class="fas fa-fw fa-children"></i>
                    <span>Registered Children</span></a>
            </li>
            <li class="nav-item <?php if (isset($_GET['payments']) != null) {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="?payments">
                    <i class="fas fa-fw fa-coins"></i>
                    <span>Payments</span></a>
            </li>

            <hr class="sidebar-divider d-none d-md-block">

            <div class="sidebar-heading">Settings</div>
            <li class="nav-item <?php if (isset($_GET['my-profile']) != null) {
                                    echo 'active';
                                } ?>">
                <a class="nav-link" href="?my-profile">
                    <i class="fas fa-fw fa-user"></i>
                    <span>My Profile</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
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

                    if (isset($_GET['set-appointment']) != null) {
                        include('pages/set-appointment.php');
                    }
                    if (isset($_GET['my-appointments']) != null) {
                        include('pages/my-appointments.php');
                    }
                    if (isset($_GET['req-info']) != null) {
                        include('pages/request-info.php');
                    }
                    if (isset($_GET['reqs']) != null) {
                        include('pages/reqs.php');
                    }
                    if (isset($_GET['children']) != null) {
                        include('pages/children.php');
                    }
                    if (isset($_GET['my-profile']) != null) {
                        include('pages/profile.php');
                    }
                    if (isset($_GET['payments']) != null) {
                        include('pages/payments.php');
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
        delay: 5000
    })

    <?php unset($_SESSION['msg']); ?>
</script>

</html>