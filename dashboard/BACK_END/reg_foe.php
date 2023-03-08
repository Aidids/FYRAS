<?php
    require_once('../BACK_END/db_connection.php');

    $foe_name = strtoupper($_POST['reg_foe_name']);

    $stmtFoe = $db->prepare("INSERT INTO FIELD_OF_EXPERTISE (FOE_DESCRIPTION) VALUE (:foe_name)");
    $stmtFoe->bindParam(":foe_name", $foe_name);
    
    $stmtFoe->execute();
    $countFoe = $stmtFoe->rowCount();

    if($countFoe > 0){
        echo "<script language = 'javascript'> window.location = '../OWNER/list_foe'</script>";
    }
    else{
        var_dump($db->errorInfo());
        // echo "<script language = 'javascript'> alert('Registration Failed!!'); window.history.back()</script>";
    }
?>