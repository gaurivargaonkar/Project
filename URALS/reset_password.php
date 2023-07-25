<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">

    <script>
        function validate(){
            var npass = document.getElementById("password").value;
            var cpass = document.getElementById("cpassword").value;

            if(npass == ""){
                document.getElementById("newpass_error").innerHTML="Enter Password";
                return false;
            }
            if(cpass == ""){
                document.getElementById("cpass_error").innerHTML="Enter Password";
                return false;
            }
        }
    </script>
</head>

<body>

    <div class="center" style="padding: 15px;">
        <form action="" onsubmit="return validate()" name="myform" method="POST">
            <center>
                <h1 style="margin-top: 15px;">Reset Password</h1>
            </center>
            <div>
                <?php

                include 'config.php';

                if (isset($_POST["submit"])) {

                    if (isset($_GET['token'])) {
                        $token = $_GET['token'];
                        $newpassword = mysqli_real_escape_string($conn, $_POST['password']);
                        $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

                        $pass = password_hash($newpassword, PASSWORD_BCRYPT);
                        $cpass = password_hash($cpassword, PASSWORD_BCRYPT);



                        if ($newpassword == $cpassword) {

                            $update = "update user_info set password='$pass' where token='$token'";

                            $iquery = mysqli_query($conn, $update);

                            if ($update) {
                                echo "successful";
                                header('location:login.php');
                            } else {
                                echo "error";
                                header('location:reset_password.php');
                            }
                        } else {
                            echo "Password not same";
                        }
                    }else{
                        echo "user not found";
                    }
                }

                ?>
            </div>


            <div class="txt_field">
                <label for="new_password">New Password</label>
                <input type="password" name="password" id="password"><br>
                <span id="npass_error"></span>
            </div>
            <div class="txt_field">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="cpassword" id="cpassword"><br>
                <span id="cpass_error"></span>
            </div>
            <div>
                <input type="submit" name="submit" value="Update" style="color: white; background-color:blue;">
            </div>
        </form>
    </div>

</body>

</html>