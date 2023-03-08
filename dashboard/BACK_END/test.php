<?php
    //CODING TO RETREIEVE ID FROM TABLE RESEARCH PROJECT


    require_once('db_connection.php');

    $pc = "CS 110";
    $pn = "Computer SCIENCE";

    $sql = $db->prepare("INSERT INTO PROGRAMME (PROGRAMME_CODE, PROGRAMME_NAME) VALUES (:pc, :pn)");
    $sql->bindParam(":pc", $pc);
    $sql->bindParam(":pn", $pn);

    $sql->execute();
    $id = $db->lastInsertId();

    echo $id;
?>