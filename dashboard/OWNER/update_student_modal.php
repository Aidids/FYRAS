<!-- MODAL -->
<div class="modal fade" id="editStudent<?php echo $studentRow['STUD_ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Student Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>

            <form class="forms" action="../BACK_END/update_student.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Student ID</label>
                        <input type="hidden" name="original_stud_id" value="<?php echo $studentRow['STUD_ID']?>">
                        <input type="number" class="form-control" value="<?php echo $studentRow['STUD_ID']?>" name="edit_stud_id">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Student Name</label>
                        <input type="text" class="form-control" value="<?php echo $studentRow['STUD_NAME']?>" name="edit_stud_name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Student I/C</label>
                        <input type="text" class="form-control" value="<?php echo $studentRow['STUD_IC']?>" name="edit_stud_ic">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputUsername1">Student Phone Number</label>
                        <input type="number" class="form-control" value="<?php echo $studentRow['STUD_PHONE']?>" name="edit_stud_phone">
                    </div>
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