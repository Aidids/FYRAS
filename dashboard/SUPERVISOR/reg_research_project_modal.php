<?php
    require_once('../BACK_END/db_connection.php');
?>
<!-- partial -->
<div class="modal fade" id="addResearchProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <form action="../BACK_END/reg_research_project.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Reserach Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">x</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="form-group">
                    <label>Reserach Project Title</label>
                    <input type="text" class="form-control" style="border: 1px solid;" autocomplete="off" name="reg_rp_name" required="required"/>
                </div>

                <div class="form-group">
                    <label>Abstract</label>
                    <input type="text" class="form-control" style="border: 1px solid;" autocomplete="off" name="reg_rp_description"/>
                </div>

                <div class="form-group">
                    <?php
                        $stmtFoe = $db->query("SELECT * FROM FIELD_OF_EXPERTISE");
                        $stmtFoe->execute();
                    ?>
                    <label>Field of Expertise</label>
                    <select class="js-example-basic-single" style="width: 100%;" name="reg_rp_foe" required>
                        <option value="" disabled=disabled selected=selected>- - SELECT ONE - -</option>
                        <?php
                            while($rowFoe = $stmtFoe->fetch(PDO::FETCH_ASSOC)){
                                echo "<option value='".$rowFoe['FOE_ID']."'>".$rowFoe['FOE_DESCRIPTION']."</option>" ;                               
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Programme:</label>
                    <?php
                        $stmtProg = $db->query("SELECT * FROM PROGRAMME");
                        $stmtProg->execute();

                        while($rowProg = $stmtProg->fetch(PDO::FETCH_ASSOC)){
                            echo "
                            <div class='form-check'>
                                <label class='form-check-label'>
                                    <input type='radio' class='form-check-input' name='programme_id' id='optionsRadios1' value='".$rowProg['PROGRAMME_ID']."'required>".
                                    $rowProg['PROGRAMME_CODE'] . "  -  " . $rowProg['PROGRAMME_NAME'] ."
                                </label>
                            </div>
                            ";
                        }
                    ?>
                </div>

                <!-- <div class="form-group">
                    <label>Student ID</label>
                    <input type="number" class="form-control" name="reg_rp_student_id" required="required"/>
                </div> -->

                <div class="form-group">
                    <?php
                        $stmtStud = $db->query("SELECT * FROM STUDENT");
                        $stmtStud->execute();
                    ?>
                    <label>Student ID</label>
                    <select class="js-example-basic-single" style="width: 100%;" 
                    name="reg_rp_student_id" value="" required>
                        <option value="" disabled="disabled" selected=selected>-- CHOOSE STUDENT --</option>
                        <?php
                            while($rowStud = $stmtStud->fetch(PDO::FETCH_ASSOC)){
                                echo "<option value='".$rowStud['STUD_ID']."'>".$rowStud['STUD_ID']. " - " . $rowStud['STUD_NAME']."</option>" ;                               
                            }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Upload File:</label>
                    <input type="file" class="dropify" value="" name="file[]"  multiple="multiple">
                </div>
            </div>

            

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="Submit" class="btn btn-primary">Add</button>
          </div>

        </form>
        </div>
    </div>
</div>
<!-- partial -->