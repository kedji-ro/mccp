<?php
SESSION_START();
include 'db_conn.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../assets/vendor/autoload.php';
require '../assets/vendor/phpmailer/phpmailer/src/Exception.php';
require '../assets/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../assets/vendor/phpmailer/phpmailer/src/SMTP.php';
require 'db_conn.php';


if (isset($_POST['register_doctor'])) {

    $fn = $_POST['r_fn'];
    $mn = $_POST['r_mn'];
    $ln = $_POST['r_ln'];
    $sf = $_POST['r_sn'];
    $addr = $_POST['r_addr'];
    $dob = $_POST['r_dob'];
    $phone = $_POST['r_phone'];
    $tel = $_POST['r_tel'];
    $lic = $_POST['r_lic'];
    $spec = $_POST['r_spec'];
    $ti = $_POST['r_ti'];
    $email = $_POST['r_email'];
    $pass = $_POST['r_pass'];
    $re_pass = $_POST['r_repass'];

    $v_token = md5($email);
    $url = "".home."/register/verify-email.php?token=" . $v_token;

    // Validate if email is unique/not yet registered
    $q = "SELECT 1 FROM tb_users WHERE email = '" . $email . "' LIMIT 1";
    $res = mysqli_query($con, $q);

    $email_count = mysqli_num_rows($res);

    if ($email_count > 0) {
        $_SESSION['msg'] = "Email already exist.";
        $_SESSION['msg-h'] = "NOTICE";
        $_SESSION['msg-t'] = "danger";

        header('Location: http://localhost:8080/mccp/register/?doctor');
        exit(0);
    }

    /** Validate if passwords match and if matches criteria */
    // $number = preg_match('@[0-9]@', $pass);
    // $uppercase = preg_match('@[A-Z]@', $pass);
    // $lowercase = preg_match('@[a-z]@', $pass);
    // $spChars = preg_match('@[^\w]@', $pass);

    // if ($re_pass === $pass) {
    //     if (strlen($pass) < 8 || strlen($pass) > 20  || !$number || !$uppercase || !$lowercase || $spChars) {
    //         $_SESSION['msg'] = "Password must be at least: <br>
    //                                 <ul>
    //                                     <li>8 characters in length</li>
    //                                     <li>Must contain at least one number</li>
    //                                     <li>Must contain at least one upper case letter</li>
    //                                     <li>Must contain at least one lower case letter</li>
    //                                     <li>Must contain at least one special character</li>
    //                                 </ul>";
    //         $_SESSION['msg-h'] = "NOTICE";
    //         $_SESSION['msg-t'] = "danger";

    //         header('Location: http://localhost:8080/mccp/register/?doctor');
    //         exit(0);
    //     }
    // } else {
    //     $_SESSION['msg'] = "Passwords don't match.";
    //     $_SESSION['msg-h'] = "NOTICE";
    //     $_SESSION['msg-t'] = "danger";

    //     header('Location: http://localhost:8080/mccp/register/?doctor');
    //     exit(0);
    // }

    /** Uncomment and comment code above to bypass length and character validation of password */
    if ($re_pass !== $pass) {
        $_SESSION['msg'] = "Passwords don't match.";
        $_SESSION['msg-h'] = "NOTICE";
        $_SESSION['msg-t'] = "danger";

        header('Location: '.home.'/register/?doctor');
        exit(0);
    }

    // Will proceed to inserting data to db if validations passed
    $qry = "INSERT INTO `tb_users`(`username`, `password`, `email`, 
                                    `firstname`, `middlename`, `lastname`, `suffix`, 
                                    `DOB`, `address`, `phone_no`,  `tel_no`, `license_no`, 
                                    `spec_id`, `title`, `verification_token`, `role`,`is_active`, `registration_date`)
                        VALUES ('" . $email . "',
                            MD5('" . $pass . "'),
                                '" . $email . "',
                                '" . $fn . "',
                                '" . $mn . "',
                                '" . $ln . "',
                                '" . $sf . "',
                                '" . $dob . "',
                                '" . $addr . "', 
                                '" . $phone . "',
                                '" . $tel . "', 
                                '" . $lic . "',
                                '" . $spec . "',
                                '" . $ti . "',
                                '" . $v_token . "',
                                2, 
                                0,
                                '".$datetime."')";

    $result = mysqli_query($con, $qry);

    if ($result) {
        if (send_VerifyEmail($ln, $email, $url)) {
            $_SESSION['msg'] = "Registered succesfully. Please check your email to verify your account.";
            $_SESSION['msg-h'] = "SUCCESS";
            $_SESSION['msg-t'] = "success";
        } else {
            $_SESSION['msg'] = "Something wrong with sending email verification.";
            $_SESSION['msg-h'] = "ERROR";
            $_SESSION['msg-t'] = "danger";
        }
        header('Location: '.home.'/register/?doctor');
    } else {
        $_SESSION['msg'] = "Something went wrong." . $con->error;
        $_SESSION['msg-h'] = "ERROR";
        $_SESSION['msg-t'] = "danger";

        echo $con->error;
    }

    header('Location: '.home.'/register/?doctor');

    $con->close();
}

if (isset($_POST['login_account'])) {

    $email = $_POST['l_email'];
    $pass = $_POST['l_pass'];

    $q ="SELECT 1 FROM tb_users WHERE email = '".$email."' AND password = MD5('".$pass."') LIMIT 1";

    $result = mysqli_query($con, $q);
    $user_count = mysqli_num_rows($result);

    if ($user_count > 0) {
        $qry = "SELECT * FROM tb_users WHERE email = '".$email."' AND password = MD5('".$pass."') LIMIT 1";

        $row = mysqli_fetch_assoc(mysqli_query($con,$qry));

        if ($row['is_active'] == 1) {

            //OLD
            $_SESSION['ADMIN_ID'] = $row['user_id'];
            $_SESSION['ADMIN_EMAIL_ADDRESS'] = $row['email'];
            $_SESSION['USER_NAME'] = $row['email'];
            $_SESSION['FULLNAME'] = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ' ' . $row['suffix'];

            //NEW
            $_SESSION['U_ID'] = $row['user_id'];
            $_SESSION['U_EMAIL'] = $row['email'];
            $_SESSION['U_FULLNAME'] = $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . ' ' . $row['suffix'];
            $_SESSION['U_ROLE'] = $row['role'];
            $_SESSION['D_ID'] = $row['d_id'];

            if ($row['role'] == '1') {
                $_SESSION['msg-h'] = "WELCOME";
                $_SESSION['msg'] = "Welcome admin " . $_SESSION['FULLNAME'];
                $_SESSION['msg-t'] = "success";
                $_SESSION['msg-bg'] = "#e8fae9";

                header('Location: '.home.'/admin/?dashboard');
            } elseif ($row['role'] == '2') {
                $_SESSION['msg-h'] = "WELCOME";
                $_SESSION['msg'] = "Welcome admin " . $_SESSION['FULLNAME'];
                $_SESSION['msg-t'] = "success";
                $_SESSION['msg-bg'] = "#e8fae9";

                header('Location: '.home.'/doctor/?dashboard');
            } elseif ($row['role'] == '4') {
                $_SESSION['msg-h'] = "WELCOME";
                $_SESSION['msg'] = "Welcome secretary " . $_SESSION['FULLNAME'];
                $_SESSION['msg-t'] = "success";
                $_SESSION['msg-bg'] = "#e8fae9";

                header('Location: '.home.'/secretary/?appointments');
            } elseif ($row['role'] == '3') {
                $_SESSION['msg-h'] = "WELCOME";
                $_SESSION['msg'] = "Welcome patient " . $_SESSION['FULLNAME'];
                $_SESSION['msg-t'] = "success";
                $_SESSION['msg-bg'] = "#e8fae9";

                header('Location: '.home.'/patient/?appointment');
            }
        } else {
            $_SESSION['msg-h'] = "NOTICE";
            $_SESSION['msg'] = "User not verified. Please check your email to verify your account";
            $_SESSION['msg-t'] = "danger";
            header('Location: '.home.'/login/?');
        }
    } else {
        $_SESSION['msg-h'] = "NOTICE";
        $_SESSION['msg'] = "We couldn't find any user that matches your data";
        $_SESSION['msg-t'] = "danger";     
        header('Location: '.home.'/login/?');
    }

    $con->close();
}

function send_VerifyEmail($d_lname, $d_email, $url)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth   = true;

    $mail->Host       = 'motherchildcareportal.com';
    $mail->Username   = 'support@motherchildcareportal.com';
    $mail->Password   = 'iwo86OJ0ik9K';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('support@motherchildcareportal.com', 'Mother Child Care');
    $mail->addAddress($d_email);

    $mail->isHTML(true);
    $mail->Subject = 'Email Verification';

    $email_template =
        '<table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#7858A6" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#7858A6" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2;">Welcome<br>Dr. ' . $d_lname . '!</h1> <img src=" https://img.icons8.com/clouds/100/000000/handshake.png" width="125" height="120" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 40px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">We are excited to have you get started. First, you need to confirm your account. Just press the button below.</p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 20px 30px 60px 30px;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="border-radius: 3px;" bgcolor="#7858A6"><a href="' . $url . '" style="font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 15px 25px; border-radius: 2px; border: 1px solid #7858A6; display: inline-block;">Verify Account</a></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> 
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 0px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">If that does not work, copy and paste the following link in your browser:</p>
                        </td>
                    </tr> 
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 20px 30px 20px 30px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;"><a href="' . $url . '" style="color: #7858A6;">' . $url . '</a></p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Regards,<br>Support Team</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#f4f4f4" align="left" style="padding: 0px 30px 30px 30px; color: #666666; font-size: 14px; font-weight: 400; line-height: 18px;"> <br></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>';

    $mail->Body = $email_template;

    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }
}

?>