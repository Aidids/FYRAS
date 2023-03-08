<?php    
    session_destroy();
    session_start();

    $_SESSION['login_error'] = 0;
    $_SESSION['first_log_in'] = 0;
    $_SESSION['user_type'] = "";
    header('Location: ../../login');
?>