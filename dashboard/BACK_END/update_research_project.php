<?php
    session_start();
    require_once('db_connection.php');

    $proj_id = $_POST['project_id'];
    $proj_title = $_POST['edit_project_title'];
    $proj_desc = $_POST['edit_project_description'];
    $foe_id = $_POST['edit_foe_id'];
    $programme_id = $_POST['edit_programme_id'];
    $student_id = $_POST['edit_student_id'];

    
    $stmtUpdate = $db->prepare("UPDATE RESEARCH_PROJECT SET 
    PROJECT_TITLE = :proj_title, PROJECT_DESCRIPTION = :proj_desc, FOE_ID = :foe_id, PROGRAMME_ID = :programme_id, student_id = :student_id
    WHERE PROJECT_ID = :proj_id");

    $stmtUpdate->bindParam('proj_title', $proj_title);
    $stmtUpdate->bindParam('proj_desc', $proj_desc);
    $stmtUpdate->bindParam('foe_id', $foe_id);
    $stmtUpdate->bindParam('programme_id', $programme_id);
    $stmtUpdate->bindParam('student_id', $student_id);
    $stmtUpdate->bindParam(':proj_id', $proj_id);

    $stmtUpdate->execute();
    $rowUpdate = $stmtUpdate->rowCount();

    echo $rowUpdate;
    
    if($rowUpdate > 0){
        echo "<script language = 'javascript'> window.location = '../SUPERVISOR/list_res_project'</script>";
    }
    else{

    }
?>