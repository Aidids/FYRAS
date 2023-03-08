<?php
    session_start();
    require_once('db_connection.php');

    if(empty($_POST['user_login_id']) && empty($_POST['user_login_password'])){
        header('Location: ../../login.php'); //redirect back to login page if the data field is empty
        $_SESSION['login_error'] = 4;
    }
    else{
        $user_id = $_POST['user_login_id'];
        $user_pass = $_POST['user_login_password'];

        $sql = $db->prepare("SELECT * FROM USER_ACCOUNT WHERE USER_ID = :user_id AND USER_PASSWORD = :user_pass");
        $sql->bindParam("user_id",$user_id);
        $sql->bindParam("user_pass",$user_pass);

        $sql->execute();
        $rowResult = $sql->rowCount();

        if($rowResult > 0){
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['CURRENT_USER_ID'] = $result['USER_ID'];
            $_SESSION['USER_CATEGORY'] = $result['USER_CATEGORY'];

            switch ($result['USER_CATEGORY']){
                case "ADMIN":
                    $_SESSION['first_log_in'] = 1;
                    $_SESSION['user_type'] = "admin";
                    echo "<script language = 'javascript'>window.location = '../OWNER/index'</script>";
                    break;
                case "SUPERVISOR":
                    $_SESSION['first_log_in'] = 1;
                    $_SESSION['user_type'] = "supervisor";
                    echo "<script language = 'javascript'>window.location = '../SUPERVISOR/index'</script>";
                    break;
                default:
                    break;
            }   
        }
        else{
            $_SESSION['login_error'] = 401;
            echo "<script language = 'javascript'>window.location = '../../login'</script>";
        }
    }
?>