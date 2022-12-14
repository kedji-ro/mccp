<?php
include 'db_conn.php';

if (isset($_SESSION['U_ID'])) {
  if (isset($_SESSION['U_ROLE'])) {
    if ($_SESSION['U_ROLE'] == '1') {
      header('Location: http://localhost:8080/mccp/admin/?dashboard');
    } elseif ($_SESSION['U_ROLE'] == '2') {
      header('Location: http://localhost:8080/mccp/doctor/?dashboard');
    } else {
      header('Location: http://localhost:8080/mccp/?');
    }
  } else {
    session_destroy();
  }
} else {
  session_destroy();
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

    <title>Login | Mother Child Care Portal</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    
    <script src="../assets/vendor/jquery/jquery.min.js"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="../assets/img/doctor-logo.png" width="90px" height="70px" alt="logo">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    <form action="action.php" method="POST" class="user">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="login_email_address" name="l_email" aria-describedby="emailHelp" placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="login_password" name="l_pass" placeholder="Password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block" name="login_account" id="login_account">
                                            Login
                                        </button>
                                        <hr>
                                        <p class="text-center text-gray-900 mb-2">Don't have an account yet?<br><span style="font-weight:bold;">Register</span></p>
                                        <div class="row">
                                            <div class="col">
                                                <a href="../register/?patient" class="btn btn-google btn-user btn-block">
                                                    <i class="fas fa-user fa-fw"></i> As Patient
                                                </a>
                                            </div>
                                            <div class="col">
                                                <a href="../register/?doctor" class="btn btn-facebook btn-user btn-block">
                                                    <i class="fas fa-stethoscope fa-fw"></i> As Doctor
                                                </a>
                                            </div>
                                        </div>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="../?">Back to Home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    
    <!-- Toast -->
    <?php if (isset($_SESSION['msg'])) { ?>
        <div class="toast" style="position: absolute; top: 30px; right: 25px; width: 500px;">
            <div class="toast-header">
                <strong class="mr-auto text-<?php echo $_SESSION['msg-t']; ?>"><?php if (isset($_SESSION['msg-h'])) {
                                                                                    echo $_SESSION['msg-h'];
                                                                                } else {
                                                                                    echo 'Toast Header';
                                                                                } ?></strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
            </div>
            <div class="toast-body">
                <?php if (isset($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                } else {
                    echo 'Toast Body';
                } ?>
            </div>
        </div>
    <?php session_destroy();
    } ?>

    <!-- Bootstrap core JavaScript-->
    <!-- <script src="../assets/vendor/jquery/jquery.min.js"></script> -->
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.toast').toast('show');
        });

        $('.toast').toast({
            delay: 6000
        })
    </script>

</body>

</html>