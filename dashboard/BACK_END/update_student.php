<?php
    session_start();
    require_once('db_connection.php');

    $id = $_POST['original_stud_id'];

    $new_id = $_POST['edit_stud_id'];
    $name = $_POST['edit_stud_name'];
    $ic = $_POST['edit_stud_ic'];
    $phone = $_POST['edit_stud_phone'];

    $stmtUpdate = $db->prepare("UPDATE STUDENT SET 
    STUD_ID = :new_id, STUD_NAME = :new_name, STUD_IC = :new_ic, STUD_PHONE = :new_phone
    WHERE STUD_ID = :id");
    $stmtUpdate->bindParam(':new_id', $new_id);
    $stmtUpdate->bindParam(':new_name', $name);
    $stmtUpdate->bindParam(':new_ic', $ic);
    $stmtUpdate->bindParam(':new_phone', $phone);
    $stmtUpdate->bindParam(':id', $id);

    $stmtUpdate->execute();
    $count = $stmtUpdate->rowCount();

    if($count > 0){
        echo "<script language = 'javascript'>window.location = '../OWNER/list_students'</script>";
    }
    else{
        // var_dump($db->errorInfo());
    }

?>