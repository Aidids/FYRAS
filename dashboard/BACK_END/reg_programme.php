<?php
    session_start();
    require_once('db_connection.php');
    
    $reg_prog_code = strtoupper($_POST['reg_prog_code']);
    $reg_prog_name = strtoupper($_POST['reg_prog_name']);

    $stmt = $db->prepare("INSERT INTO PROGRAMME (PROGRAMME_CODE, PROGRAMME_NAME) 
    VALUES (:reg_prog_code, :reg_prog_name)");
    $stmt->bindParam("reg_prog_code", $reg_prog_code);
    $stmt->bindParam("reg_prog_name", $reg_prog_name);
    
    $stmt->execute();

    $countRegProg = $stmt->rowCount();

    if($countRegProg > 0){
        echo "<script language = 'javascript'> window.location = '../OWNER/list_programme'</script>";
    }
    else{
        var_dump($db->errorInfo());
        // echo "<script language = 'javascript'> alert('Registration Failed!!'); window.history.back()</script>";
    }
?>