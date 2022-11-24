<?php include '../login/db_conn.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Doctor Registration | Mother Child Care Portal</title>

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <?php

        if (isset($_GET['patient'])) {
            include 'reg-patient.php';
        }

        if (isset($_GET['doctor'])) {
            include 'reg-doctor.php';
        }

        ?>

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

            $("#r_phone").on('keypress', function() {
                return isNumber(event, this, 10, false);
            });

            $("#r_tel").on('keypress', function() {
                return isNumber(event, this, 10, true);
            });

            $("#r_tel").mask('(0000)-0000');

            function isNumber(evt, element, max_chars, isTel) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (isTel == true) {
                    if (charCode > 31 && (charCode < 40 || charCode > 57 || charCode == 42 || charCode == 43 || charCode == 44 || charCode == 46 || charCode == 47)) {
                        return false;
                    }
                } else {
                    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                        return false;
                    }
                }

                if (element.value.length > max_chars) {
                    element.value = element.value.substr(0, max_chars);
                }
                return true;
            }
        });

        $('.toast').toast({
            delay: 6000
        })
    </script>

</body>

</html>