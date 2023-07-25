<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript">
        function validate() {
            var correct_username = /^[A-Za-z][A-Za-z_]{7,29}$/;
            var correct_pass=/^[A-Za-z0-9][@][a-z]{2,3}$/;
            var correct_email=/^[A-Za-z0-9]+@[a-z]+\.[a-z]{2,3}$/;
            var username = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            if (username == "") {
                document.getElementById("uerror").innerHTML = "Enter Username";
                return false;
            }
            if (username.length < 5) {
                document.getElementById("uerror").innerHTML = "Enter Atleast 5 Characters";
                return false;
            }
            if (!username.match(correct_username)) {
                document.getElementById("uerror").innerHTML = "Enter in proper format";
                return false;
            } 


            if (email == "") {
                document.getElementById("emailerror").innerHTML = "Enter Email";
                return false;

            }
            if (!email.match(correct_email)) {
                document.getElementById("emailerror").innerHTML = "Enter in proper format";
                return false;
            } 
            
            if (password == "") {
                document.getElementById("passerror").innerHTML = "Enter Password";
                return false;
            }

            
            

        }
    </script>
</head>

<body>
    <div class="center">
        <div id="container">



            <div>
                <?php


                $conn = mysqli_connect("localhost", "root", "", "urals");
                include 'config.php';

                if (!empty($_POST["email"])) {

                    $query = "SELECT * FROM user_info WHERE email='" . $_POST["email"] . "'";
                    $result = mysqli_query($conn, $query);
                    $count = mysqli_num_rows($result);

                    if ($count > 0) {
                        echo "User Already Exists!";
                        echo $count;
                    } else {
                        if (isset($_POST['submit'])) {
                            $username = mysqli_real_escape_string($conn, $_POST['username']);
                            $email = mysqli_real_escape_string($conn, $_POST['email']);
                            $password = mysqli_real_escape_string($conn, $_POST['password']);

                            $_SESSION['username'] = $username;
                            $_SESSION['email'] = $email;
                            $_SESSION['password'] = $password;

                            $password = password_hash($password, PASSWORD_DEFAULT);

                            $token = bin2hex(random_bytes(15));

                            $insert = mysqli_query($conn, "insert into user_info values ('$username','$email','$password','$token')");
                        }
                    }
                }

                ?>
            </div>



            <form name="myform" onsubmit="return validate()" action="register.php" method="POST" style="padding:15px;">



                <center>
                    <h1 style="margin-top: 15px;">Register</h1>
                </center>

                <div class="txt_field">
                    <label for="username" style="color: black;">Username</label><br><br>
                    <input type="text" id="username" name="username" placeholder="EX.abc_abc">
                    <span id="uerror" style="color:red;"></span>
                </div>

                <div class="txt_field">
                    <label for="email" style="color: black;">Email Address</label><br><br>
                    <input type="email" id="email" name="email" placeholder="" autocomplete="off">
                    <span id="emailerror" style="color:red;"></span>

                </div>

                <div class="txt_field">
                    <label for="password" style="color: black;">Password</label><br><br>
                    <input type="password" id="password" name="password" placeholder="" autocomplete="off">
                    <span id="passerror" style="color:red;"></span>

                </div>



                <input type="submit" name="submit" value="Submit" style="color: white; background-color:blue;">

                <p class="signup_link">Have an account?<a href="login.php">Login</a></p>

        </div>
        </form>
    </div>
    </div>
</body>



</html>