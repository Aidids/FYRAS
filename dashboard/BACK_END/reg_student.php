<?php
    session_start();
    require_once 'db_connection.php';

    $reg_stud_id = (int)$_POST['reg_stud_id'];
    $reg_stud_name = strtoupper($_POST['reg_stud_name']);
    $reg_stud_ic = $_POST['reg_stud_ic'];
    $reg_stud_phone = $_POST['reg_stud_phone'];

    $reg_stud_ic = substr_replace($reg_stud_ic, "-", 6, 0);
    $reg_stud_ic = substr_replace($reg_stud_ic, "-", 9, 0);

    $stmtRegister = $db->prepare("INSERT INTO STUDENT 
    (STUD_ID, STUD_NAME, STUD_IC, STUD_PHONE)
    VALUES
    (:student_id, :student_name, :student_ic, :student_phone)");
    $stmtRegister->bindParam(":student_id", $reg_stud_id);
    $stmtRegister->bindParam(":student_name", $reg_stud_name);
    $stmtRegister->bindParam(":student_ic", $reg_stud_ic);
    $stmtRegister->bindParam(":student_phone", $reg_stud_phone);

    $stmtRegister->execute();
    $countReg = $stmtRegister->rowCount();

    if($countReg > 0){
        if($_SESSION['user_type'] == 'admin'){
            echo "<script language = 'javascript'> window.location = '../OWNER/list_students'</script>";
        }   
        else if($_SESSION['user_type'] == null){
            echo "<script language = 'javascript'>alert('Registration Successfull! You can login now...'); 
            window.location = '../../login'</script>";
        }
    }
    else{
        var_dump($db->errorInfo());
        // echo "<script language = 'javascript'> alert('Registration Failed!!'); window.history.back()</script>";
    }
?>