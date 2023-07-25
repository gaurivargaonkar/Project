<?php
   require('config.php');

   unset($_SESSION['IS LOGIN']);
   header('location:login.php');
   die();
?>