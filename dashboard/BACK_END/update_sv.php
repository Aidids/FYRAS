<?php
    session_start();
	require 'db_connection.php'; 

    $id = $_POST['original_sv_id'];
    
    $new_id = $_POST['edit_sv_id'];
    $name = strtoupper($_POST['edit_sv_name']);
    $email = $_POST['edit_sv_email'];
    $phone = $_POST['edit_sv_phone'];

    $stmtUpdate = $db->prepare("UPDATE USER_ACCOUNT SET 
    USER_ID = :new_id, USER_NAME = :new_name, USER_EMAIL = :new_email, PHONE_NUMBER = :new_phone
    WHERE USER_ID = :user_id");
    $stmtUpdate->bindParam('new_id', $new_id);
    $stmtUpdate->bindParam('new_name', $name);
    $stmtUpdate->bindParam('new_email', $email);
    $stmtUpdate->bindParam('new_phone', $phone);
    $stmtUpdate->bindParam('user_id', $id);

    $stmtUpdate->execute();
    $rowUpdate = $stmtUpdate->rowCount();

    if($rowUpdate > 0){
        echo "<script language = 'javascript'>window.location = '../OWNER/list_supervisor'</script>";
    }
    else{
        // var_dump($db->errorInfo());
        
    }
?>