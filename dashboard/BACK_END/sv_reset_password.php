<?php
	session_start();
	require 'db_connection.php';

    $id = $_POST['sv_id'];
    $reset_password = $id;
    
    $sqlUpdate = $db->prepare("UPDATE USER_ACCOUNT SET USER_PASSWORD = :reset_password WHERE USER_ID = :user_id");
    $sqlUpdate->bindParam('reset_password', $reset_password);
    $sqlUpdate->bindParam('user_id', $id);

    $sqlUpdate->execute();
    $rowUpdate = $sqlUpdate->rowCount();

    if($rowUpdate > 0){
        echo "<script language = 'javascript'> alert('Password Reset Successful!!'); window.location = '../OWNER/list_supervisor'</script>";
    }
    else{
        echo "<script language = 'javascript'> alert('Password Already Reset...'); window.history.back()</script>";
        // var_dump($db->errorInfo());
    }
?>