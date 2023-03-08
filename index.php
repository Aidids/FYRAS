<?php
    session_start();

    $_SESSION['login_error'] = 0;

    header("Location: login");
?>