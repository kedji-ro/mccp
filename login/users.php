<?php
    include 'db_conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Users | MOTHER CHILD CARE PORTAL</title>

    <!-- Custom fonts for this template -->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="../assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <img src="../assets/img/baby.png" width="50px"height="50px"alt="logo">
                </div>
                <div class="sidebar-brand-text mx-2">MOTHER AND CHILD PORTAL</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
                
            <!-- Heading -->
            <div class="sidebar-heading">
               RECORDS
            </div>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="doctors.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Doctors</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="patient.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Patients</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="child.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Children</span></a>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="history.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>History</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                CONFIGURATION
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
           <li class="nav-item active">
            <a class="nav-link" href="users.php">
                <i class="fa fa-user"></i>
                <span>Users</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
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
                    <!-- <h6> <i class="fa fa-user-md" aria-hidden="true"></i> <span>MOTHER CHILD CARE PORTAL </span></h6> -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['ADMIN_EMAIL_ADDRESS']; ?></span>
                                <img class="img-profile rounded-circle" src="../assets/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add Hospital</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="insert-code.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Name of Hospitals </label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Hospital Name">
                        </div>

                        <div class="form-group">
                            <label> Address </label>
                            <input type="text" name="address" class="form-control" placeholder="Enter address">
                        </div>

                        <div class="form-group">
                            <label> Mobile No. </label>
                            <input type="text" name="mobile" class="form-control" placeholder="Enter Mobile No.">
                        </div>

                        <div class="form-group">
                            <label> Tel No. </label>
                            <input type="text" name="telephone" class="form-control" placeholder="Enter Tel No.">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- EDIT POP UP FORM (Bootstrap MODAL) -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit User Data </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="update-code.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="update_id" id="update_id">

                        <div class="form-group container">
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <label> First Name </label>
                                    <input type="text" name="fname" id="fname" class="form-control" placeholder="First Name">
                                </div>
                                <div class="col-sm-6">
                                    <label> Last Name </label>
                                    <input type="text" name="lname" id="lname" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label> Email </label>
                                    <input type="text" name="email" id="email" class="form-control" placeholder="Email">
                                </div> 
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-12">
                                    <label> Mobile No. </label>
                                    <input type="text" name="mobile" id="mobile" class="form-control" placeholder="Mobile No.">
                                </div> 
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="updatedata" id="updatedata" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

                <!-- Page Heading -->
                <h1 class="h3 mb-2 text-gray-800">List of Users</h1>
                
                    <?php
                        $query = "SELECT * FROM tb_users";
                        $query_run = mysqli_query($con, $query);
                    ?>
                    <!-- Table -->
                    <hr>                  
                        <div class="card-body text-black">
                            <div class="table-responsive">
                                <table class="table table-bordered table-condensed table-fixed table-striped" id="list" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th hidden>FNAME</th>
                                            <th hidden>LNAME</th>
                                            <th>EMAIL ADDRESS</th>
                                            <th>MOBILE/TEL NO.</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    if($query_run)
                                    {
                                        foreach($query_run as $rows)
                                        {
                                        ?>  
                                        <tr>
                                        <td><?php echo $rows['user_id']; ?></td>
                                        <td hidden><?php echo $rows['firstname']; ?></td>
                                        <td hidden><?php echo $rows['lastname']; ?></td>
                                        <td><?php echo $rows['lastname'].', '.$rows['firstname']; ?></td>
                                        <td><?php echo $rows['email']; ?></td>
                                        <td><?php echo $rows['phone_no']; ?></td> 
                                        <td><?php if ($rows['is_active'] == '1') { echo 'Active'; } else { echo 'Inactive'; } ?></td>                                
                                        <td><button type="button" class="btn btn-primary editbtn btn-sm" style="border-radius: 15px;"> EDIT </button> 
                                        <span> <a type="button" name="deact_btn" id="deact_btn" class="btn <?php if($rows['is_active'] == '1') { echo 'btn-danger'; } else { echo 'btn-success'; }?> deletebtn btn-sm" style="border-radius: 15px;" value="" href="update-code.php?uid=<?php echo $rows['user_id']; ?>"> <?php if($rows['is_active'] == '1') { echo 'DEACT'; } else { echo 'REACT'; }?> </a></span></td>             
                                        </tr>                                       
                                    <?php           
                                            }
                                        }
                                        else 
                                            {
                                                //echo "No Record Found";
                                            }
                                    ?>
                                    <!-- <tfoot>
                                        <tr>
                                            <th>CODE</th>
                                            <th>NAME</th>
                                            <th>EMAIL ADDRESS</th>
                                            <th>PASSWORD</th>
                                            <th>MOBILE/TEL NO.</th>
                                            <th>STATUS</th>
                                            <th>ACTION</th>
                                        </tr>
                                    </tfoot> -->
                                </table>
                            </div>                   
                        </div>
                        <hr>
                    </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                <script>
                    $(document).ready( function() {
                    $('#list').dataTable( {
                        "language": {
			           "emptyTable": "No record available"
			         },
                        "scrollY": "300px",
                        "scrollCollapse": false,
                        paging: true,
                        searching: true
                    } );
                    } );
                </script>
                <script>
                    $(document).ready(function () {

                        $('.editbtn').on('click', function () {

                            $('#editmodal').modal('show');

                            $tr = $(this).closest('tr');

                            var data = $tr.children("td").map(function () {
                                return $(this).text();
                            }).get();

                            console.log(data);

                            $('#update_id').val(data[0]);
                            $('#fname').val(data[1]);
                            $('#lname').val(data[2]);
                            $('#email').val(data[4]);
                            $('#mobile').val(data[5]);
                        });
                    });
                </script>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; MOTHER CHILD CARE PORTAL 2023 </span>
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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
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
</body>

</html>