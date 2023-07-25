<?php
require('config.php');
session_start();

$username = $_SESSION['username'];
$email = $_SESSION['email'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profile.css">

</head>

<body>
    <center>
        <div class="center" style="height: 400px;">

            <h1 style="padding: 15px;">Profile Information</h1>
            <div class="profile">
                <div class="profile-pic-div" style="margin: 15px;">
                    <img src="pg.jpg" id="photo">
                    <input type="file" id="file">
                    <label for="file" id="uploadBtn">Choose Photo</label>

                </div>
                <div class="data">
                    <span>
                        <?php
                        echo $username;
                        ?>
                    </span>
                    <span>
                        <?php
                        echo $email;
                        ?>
                    </span>

                </div>

                <script src="app.js"></script>

            </div>

            <div class="buttons">

                <a href="logout.php" class="btn">Logout</a>
            </div>
        </div>
        </div>
    </center>


</body>

</html>