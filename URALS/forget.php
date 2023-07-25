<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Mail</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="center" style="padding: 15px;">

        <?php
        $conn = mysqli_connect("localhost", "root", "", "urals");
        include 'config.php';

        if (!empty($_POST["email"])) {

            $query = "SELECT * FROM user_info WHERE email='" . $_POST["email"] . "'";
            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                if (isset($_POST["send"])) {
                    $email = $_POST["email"];

                    $userdata = mysqli_fetch_array($result);

                    $username = $userdata['username'];

                    $token = $userdata['token'];

                    $mail = new PHPMailer(true);

                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'gaurivargaonkar@gmail.com';
                    $mail->Password = 'yrzoulvvodyvhfxq';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;

                    $mail->setFrom('gaurivargaonkar@gmail.com');
                    $mail->addAddress($_POST["email"]);

                    $mail->isHTML(true);

                    $mail->Subject = "Password Reset";
                    $mail->Body = "Hi $username.Click here too reset your password http://localhost/URALS/reset_password.php?token=$token";
                    $mail->send();

                    echo "Sent Successfully";
                    header('location:login.php');
                } else {
                    echo "Email sending failed...";
                }
            } else {
                echo "Email not found";
                //echo $email;
                echo $count;
            }
        }
        ?>

        <h1>Recover Email</h1>
        <form action="forget.php" name="myform" method="POST">


            <div class="txt_field">
                <label for="email"></label><br>
                <input type="email" id="email" name="email" placeholder="Email Address" required>


            </div>

            <div>
                <input type="submit" name="send" value="Send"><br>
            </div>

        </form>
    </div>
</body>

</html>