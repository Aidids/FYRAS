<!-- MODAL -->
<div class="modal fade" id="editResearchProject<?php echo $rpRow['PROJECT_ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT RESEARCH PROJECT DETAIL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
                </button>
            </div>
            
            <form class="forms" action="../BACK_END/update_research_project.php" method="POST">
                <div class="modal-body">

                    <input type="hidden" value="<?php echo $rpRow['PROJECT_ID'] ?>" name="project_id">

                    <div class="form-group">
                    <label>Project Title</label>
                        <input type="text" type="text" style="border: 1px solid;" class="form-control" 
                        value="<?php echo $rpRow['PROJECT_TITLE'] ?>" name="edit_project_title">
                    </div>

                    <div class="form-group">
                        <label>Project Summary</label>
                        <input type="text" type="text" style="border: 1px solid;" class="form-control" 
                        value="<?php echo $rpRow['PROJECT_DESCRIPTION'] ?>" name="edit_project_description">
                    </div>

                    <div class="form-group">
                        <?php
                            $stmtFoe = $db->query("SELECT * FROM FIELD_OF_EXPERTISE");
                            $stmtFoe->execute();
                        ?>
                        <label>Field of Expertise</label>
                        <select class="js-example-basic-single" style="width: 100%;" name="edit_foe_id" value="<?php ?>">
                            <option value="<?php echo $rpRow['FOE_ID']?>"  selected=selected><?php echo $rpRow['FOE_DESCRIPTION']?></option>
                            <?php
                                while($rowFoe = $stmtFoe->fetch(PDO::FETCH_ASSOC)){
                                    echo "<option value='".$rowFoe['FOE_ID']."'>".$rowFoe['FOE_DESCRIPTION']."</option>" ;                               
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Project Programe</label>
                        <select class="js-example-basic-single" style="width: 100%;" 
                        name="edit_programme_id" value="">
                            <option value="<?php echo $rpRow['PROGRAMME_ID'] ?>" selected=selected> 
                            <?php echo $rpRow['PROGRAMME_CODE']." - ".$rpRow['PROGRAMME_NAME'] ?></option>
                            <?php
                                $stmtProg = $db->query("SELECT * FROM PROGRAMME");
                                $stmtProg->execute();
                                while($rowProg = $stmtProg->fetch(PDO::FETCH_ASSOC)){
                                    echo "<option value='".$rowProg['PROGRAMME_ID']."'>".$rowProg['PROGRAMME_CODE'] . " - " . $rowProg['PROGRAMME_NAME'] ."</option>" ;                               
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <?php
                            $stmtStud = $db->query("SELECT * FROM STUDENT");
                            $stmtStud->execute();
                        ?>
                        <label>Student ID</label>
                        <select class="js-example-basic-single" style="width: 100%;" 
                        name="edit_student_id" value="<?php ?>">
                            <option value="<?php echo $rpRow['STUDENT_ID'] ?>" selected=selected><?php echo $rpRow['STUDENT_ID'] ?></option>
                            <?php
                                while($rowStud = $stmtStud->fetch(PDO::FETCH_ASSOC)){
                                    echo "<option value='".$rowStud['STUD_ID']."'>".$rowStud['STUD_ID']."</option>" ;                               
                                }
                            ?>
                        </select>
                    </div>

                    <!-- <div class="form-group">
                        <label>Student ID</label>
                            <input type="text" style="border: 1px solid;" class="form-control" 
                            value="<?php echo $rpRow['STUDENT_ID'] ?>" name="edit_student_id">
                    </div> -->
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>            
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->