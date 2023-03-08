<?php
    session_start();
    require_once('db_connection.php');

    if(empty($_POST['student_id']) && empty($_POST['student_ic'])){
        echo "<script language = 'javascript'>window.history.back()</script>";
    }
    else{
        $student_id = $_POST['student_id'];
        $student_ic = $_POST['student_ic'];

        
        if(strlen($student_ic) == 12){
            $student_ic = substr_replace($student_ic, "-", 6, 0);
            $student_ic = substr_replace($student_ic, "-", 9, 0);
            // echo $student_ic;
        }

        $sql = $db->prepare("SELECT * FROM STUDENT WHERE STUD_ID = :student_id AND STUD_IC = :student_ic");
        $sql->bindParam("student_id",$student_id);
        $sql->bindParam("student_ic",$student_ic);

        $sql->execute();
        $rowResult = $sql->rowCount();

        if($rowResult > 0){
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            $_SESSION['CURRENT_STUDENT_ID'] = $result['STUD_ID'];
            $_SESSION['first_log_in'] = 1;
            $_SESSION['user_type'] = "student";
            echo "<script language = 'javascript'>window.location = '../STUDENTS/list_res_project'</script>";
        }
        else{
            $_SESSION['login_error'] = 401;
            // echo "<script language = 'javascript'>window.location = '../../login.php'</script>";
            echo "<script language = 'javascript'>window.history.back();</script>";
        }
    }
?>