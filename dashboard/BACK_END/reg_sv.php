<?php
    session_start();
    require_once 'db_connection.php';

    
    $reg_sv_id = (int)$_POST['reg_sv_id'];
    $reg_sv_pass = $reg_sv_id;
    $reg_sv_name = strtoupper($_POST['reg_sv_name']);
    $reg_user_category = "SUPERVISOR";

    $reg_sv_email = "-";
    $reg_sv_phone = "-";
    if(!empty($_POST['reg_sv_email'])){
        $reg_sv_email = $_POST['reg_sv_email'];
    }

    if(!empty($_POST['reg_sv_phone'])){
        $reg_sv_phone = $_POST['reg_sv_phone'];
    }
    

    $stmtRegister = $db->prepare("INSERT INTO USER_ACCOUNT 
    (USER_ID, USER_PASSWORD, USER_NAME, USER_EMAIL, PHONE_NUMBER, USER_CATEGORY) 
    VALUES 
    (:user_id, :user_password, :user_name, :user_email, :user_phone, :user_category)");
    $stmtRegister->bindParam(':user_id',$reg_sv_id);
    $stmtRegister->bindParam(':user_password',$reg_sv_pass);
    $stmtRegister->bindParam(':user_name',$reg_sv_name);
    $stmtRegister->bindParam(':user_email',$reg_sv_email);
    $stmtRegister->bindParam(':user_phone',$reg_sv_phone);
    $stmtRegister->bindParam(':user_category',$reg_user_category);

    $stmtRegister->execute();
    $countRegister = $stmtRegister->rowCount();

    if($countRegister > 0){
        // echo "<script language = 'javascript'> alert('User Registered Successfully!!'); window.location = '../register.php'</script>";
        echo "<script language = 'javascript'> window.location = '../OWNER/list_supervisor.php'</script>";
    }
    else{
        var_dump($db->errorInfo());
        // echo "<script language = 'javascript'> alert('Registration Failed!!'); window.history.back()</script>";
    }
?>