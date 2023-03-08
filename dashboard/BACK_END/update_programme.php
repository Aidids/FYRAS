<?php
    session_start();
    require_once('db_connection.php');

    $programme_id = $_POST['programme_id'];
    $new_programme_code = $_POST['edit_prog_code'];
    $new_programme_name = $_POST['edit_prog_name'];

    // var_dump($programme_id);
    // var_dump($new_programme_code);
    // var_dump($new_programme_name);

    $stmtUpdateProg = $db->prepare("UPDATE PROGRAMME SET PROGRAMME_CODE = :prog_code, PROGRAMME_NAME = :prog_name WHERE PROGRAMME_ID = :prog_id");

    $stmtUpdateProg->bindParam("prog_code", $new_programme_code);
    $stmtUpdateProg->bindParam("prog_name", $new_programme_name);
    $stmtUpdateProg->bindParam("prog_id", $programme_id);

    $stmtUpdateProg->execute();
    $countProg = $stmtUpdateProg->rowCount();

    if($countProg > 0){
        echo "<script language = 'javascript'> window.location = '../OWNER/list_programme'</script>";
    }
    else{
        var_dump($db->errorInfo());
        // echo "<script language = 'javascript'> alert('Registration Failed!!'); window.history.back()</script>";
    }
?>