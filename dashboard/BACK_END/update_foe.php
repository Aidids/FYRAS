<?php
    session_start();
    require_once('db_connection.php');

    $foe_id = $_POST['foe_id'];
    $new_foe_desc = $_POST['edit_foe_name'];

    $stmtUpdateFoe = $db->prepare("UPDATE FIELD_OF_EXPERTISE SET FOE_DESCRIPTION = :foe_desc WHERE FOE_ID = :foe_id");

    $stmtUpdateFoe->bindParam("foe_desc", $new_foe_desc);
    $stmtUpdateFoe->bindParam("foe_id", $foe_id);

    $stmtUpdateFoe->execute();
    $countFoe = $stmtUpdateFoe->rowCount();

    if($countFoe > 0){
        echo "<script language = 'javascript'> window.location = '../OWNER/list_foe'</script>";
    }
    else{
        var_dump($db->errorInfo());
        // echo "<script language = 'javascript'> alert('Registration Failed!!'); window.history.back()</script>";
    }
?>