<?php
    session_start();
    require_once('db_connection.php');

    $Profile_id = $_POST['current_profile_id'];
    $Profile_name = $_POST['edit_profile_name'];
    $Profile_password = $_POST['edit_profile_password'];
    $Profile_email = $_POST['edit_profile_email'];
    $Profile_phone = $_POST['edit_profile_phone'];
    
    $stmtUpdate = $db->prepare("UPDATE USER_ACCOUNT SET 
    USER_NAME = :new_name, USER_PASSWORD = :new_password, USER_EMAIL = :new_email, PHONE_NUMBER = :new_phone 
    WHERE USER_ID = :user_id");

    $stmtUpdate->bindParam(":new_name", $Profile_name);
    $stmtUpdate->bindParam(":new_password", $Profile_password);
    $stmtUpdate->bindParam(":new_email", $Profile_email);
    $stmtUpdate->bindParam(":new_phone", $Profile_phone);
    $stmtUpdate->bindParam(":user_id", $Profile_id);

    $stmtUpdate->execute();
    $rowUpdate = $stmtUpdate->rowCount();

    if($rowUpdate > 0){
        if($_SESSION['user_type'] == "admin"){
            echo "<script language = 'javascript'> window.location = '../OWNER/index'</script>";
        }
        else if(($_SESSION['user_type'] == "supervisor")){
            echo "<script language = 'javascript'> window.location = '../SUPERVISOR/index'</script>";
        }
    }
    else{
        var_dump($db->errorInfo());
        echo "<script language = 'javascript'> alert('Update Failed!!'); window.history.back()</script>";
    }
?>