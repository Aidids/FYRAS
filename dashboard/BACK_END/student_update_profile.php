<?php
    session_start();
    require_once('db_connection.php');

    $id = $_POST['stud_id'];
    $name = $_POST['edit_stud_name'];
    $ic = $_POST['edit_stud_ic'];
    $phone = $_POST['edit_stud_phone'];
    
    $stmtUpdate = $db->prepare("UPDATE STUDENT SET 
    STUD_NAME = :new_name, STUD_IC = :new_ic, STUD_PHONE = :new_phone
    WHERE STUD_ID = :stud_id");

    $stmtUpdate->bindParam(":new_name", $name);
    $stmtUpdate->bindParam(":new_ic", $ic);
    $stmtUpdate->bindParam(":new_phone", $phone);
    $stmtUpdate->bindParam(":stud_id", $id);

    $stmtUpdate->execute();
    $rowUpdate = $stmtUpdate->rowCount();

    if($rowUpdate > 0){
        if($_SESSION['user_type'] == "student"){
            echo "<script language = 'javascript'> window.location = '../STUDENTS/list_res_project'</script>";
        }
    }
    else{
        var_dump($db->errorInfo());
        // echo "<script language = 'javascript'> alert('Update Failed!!'); window.history.back()</script>";
    }
?>