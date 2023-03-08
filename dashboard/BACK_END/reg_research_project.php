<?php
    session_start();
    require_once('db_connection.php');

    $rp_title = $_POST['reg_rp_name'];
    $rp_desc = $_POST['reg_rp_description'];
    $foe_id = $_POST['reg_rp_foe'];
    $programme_id = $_POST['programme_id'];
    $student_id = $_POST['reg_rp_student_id'];
    $supervisor_id = (int)$_SESSION['CURRENT_USER_ID'];

    if(empty($rp_desc)){
        $rp_desc = "-";
    }

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $rp_submit_date = date('Y-m-d H:i:s');
    $view_total = 0;

    $stmtRP = $db->prepare("INSERT INTO RESEARCH_PROJECT 
    (PROJECT_TITLE, PROJECT_DESCRIPTION, PROJECT_SUBMISSION_DATE, FOE_ID, PROGRAMME_ID, STUDENT_ID, SUPERVISOR_ID)
    VALUES
    (:proj_title, :proj_desc, :proj_submit_date, :foe_id, :prog_id, :stud_id, :sv_id)");
    $stmtRP->bindParam(":proj_title", $rp_title);
    $stmtRP->bindParam(":proj_desc", $rp_desc);
    $stmtRP->bindParam(":proj_submit_date", $rp_submit_date);
    $stmtRP->bindParam(":foe_id", $foe_id);
    $stmtRP->bindParam(":prog_id", $programme_id);
    $stmtRP->bindParam(":stud_id", $student_id);
    $stmtRP->bindParam(":sv_id", $supervisor_id);

    $stmtRP->execute();

    $countRP = $stmtRP->rowCount();

    //INSERTION FOR DOCUMENT TABLE
    function restructArray(array $arr){
        $result = array();
            
        foreach($arr as $key => $value){
            for($a=0; $a < count($value); $a++){
                $result[$a][$key] = $value[$a];
            }
        }
        return $result;
    }

    //get project id from db
    $project_id;

    $stmtID = $db->query("SELECT PROJECT_ID FROM RESEARCH_PROJECT ORDER BY PROJECT_ID DESC LIMIT 1;");
    $stmtID->execute();
    $row = $stmtID->fetch(PDO::FETCH_ASSOC);
    $project_id = (int)$row["PROJECT_ID"];

    // $id = $db->lastInsertId();
    #############################################
    $doc = [];
    if(!empty($_FILES['file'])){
        $doc = restructArray($_FILES['file']);
    }
    // echo "<pre>";print_r($doc); echo "</pre>";

    $countDoc = 0;
    foreach($doc as $try){
        $doc_name = rand(00,99) . '-' . $try['name'];
        $t_name = $try['tmp_name'];
        $doc_type = $try['type'];
        $doc_size = $try['size'];
        
        $doc_dir = "../../Documents/";
        $doc_loc = $doc_dir . $doc_name;

        if(!empty($doc_name) && $doc_type == "application/pdf"){
            if($doc_name != '' && move_uploaded_file($t_name,$doc_loc)){
                $stmtDoc = $db->prepare("INSERT INTO FILE (FILE_NAME, FILE_SIZE,  FILE_LOC, FILE_TYPE, PROJECT_ID) 
                VALUES 
                (:file_name, :file_size, :file_loc, :file_type, :project_id)");

                $stmtDoc->bindParam(':file_name',$doc_name);
                $stmtDoc->bindParam(':file_size',$doc_size);
                $stmtDoc->bindParam(':file_loc',$doc_loc);
                $stmtDoc->bindParam(':file_type',$doc_type);
                $stmtDoc->bindParam(':project_id', $project_id);

                $stmtDoc->execute();
                $countDoc = $stmtDoc->rowCount();
            }
        }
    }

    $cert_name = "CERTIFICATE OF COMPLETION";
    $cert_date = $rp_submit_date;
    $stmtCert = $db->prepare("INSERT INTO CERTIFICATE_DATA (CERT_NAME, DATE_CREATED, PROJECT_ID) VALUES (:cert_name, :cert_date, :project_id)");
    $stmtCert->bindParam(':cert_name', $cert_name);
    $stmtCert->bindParam(':cert_date', $cert_date);
    $stmtCert->bindParam(':project_id', $project_id);
    $stmtCert->execute();
    $countCert = $stmtDoc->rowCount();

    // if()

    if(($countRP > 0 && $countDoc > 0) && $countCert > 0){
        echo "<script language = 'javascript'> window.location = '../SUPERVISOR/list_res_project'</script>";
    }
    else{
        var_dump($db->errorInfo());
        echo "<br>";
        // print_r($stmtRP->errorInfo());
    }
?>