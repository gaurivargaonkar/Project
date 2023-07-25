<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="style.css">

    <script type="text/javascript">
        function validate() {
            
            var correct_pass = /^[A-Za-z0-9][@][a-z]{2,3}$/;
            //var correct_email=/^[A-Za-z0-9][@][A-Za-z][.][A-Za-z]{2,3}$/;
            
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            

            if (email == "") {
                document.getElementById("emailerror").innerHTML = "Enter Email";
                return false;

            }

            if (password == "") {
                document.getElementById("passerror").innerHTML = "Enter Password";
                return false;
            }
            /*
            if (!password.match(correct_pass)) {
                document.getElementById("passerror").innerHTML = "Enter in specials characters";
                return false;
            } 

            */


        }
    </script>

</head>

<body>
    <div>
        <?php


        require 'config.php';


        session_start();



        if (isset($_POST['check'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            //$conn = new mysqli('localhost', 'root', '', 'urals');

            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;




            $res = mysqli_query($conn, "select * from user_info where email='$email'");
            //$row = mysqli_fetch_array($result);

            if ($email == $_POST['email']) {
                $row = mysqli_fetch_assoc($res);
                $verify = password_verify($password, $row['password']);
                if ($password == $_POST['password']) {
                    echo "successful";
                    header('location:user_profile.php');
                } else {
                    echo "Please enter correct password";
                }
            } else {
                echo "User Doesnotexit";
            }
        }
        ?>


        <div class="center">

            <form action="login.php" onsubmit="return validate()" name="myform" method="POST">

                <center>
                    <h1 style="margin-top: 15px;">Login</h1>
                </center>

                <div class="txt_field">
                    <label for="email">Email Address</label><br><br>
                    <input type="email" id="email" name="email" placeholder="" value="" autocomplete="off" style="font-size:15px;">
                    <span id="emailerror" style="color:red;"></span><br>

                </div>

                <div class="txt_field">
                    <label for="password">Password</label><br><br>
                    <input type="password" id="password" name="password" placeholder="" style="font-size:15px;">
                    <span id="passerror" style="color:red;"></span><br>
                </div>

                <div>
                    <a href="forget.php" class="signup_link">Forget Password</a>
                </div>



                <input type="submit" name="check" value="Login" style="color: white; background-color:blue;">

                <p class="signup_link">Don't have an account?<a href="register.php">Register</a></p>

        </div>
        </form>
    </div>
    </div>
</body>

</html>