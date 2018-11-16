<?php
    session_start();
    $_SESSION['username'] = null;
    $_SESSION['userid'] = null;
    session_destroy();
    header('location:sign.php');
?>