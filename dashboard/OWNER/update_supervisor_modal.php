<!-- MODAL -->
<div class="modal fade" id="editUser<?php echo $userRow['USER_ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Supervisor Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>

            <br><br>
            
            <center>
                <div class="form-group">
                    <form action="../BACK_END/sv_reset_password.php" method="POST">
                        <input type="hidden" name="sv_id" value="<?php echo $userRow['USER_ID']?>">
                        <button type="submit" class="btn btn-danger btn-rounded">Reset Password</button>
                    </form>
                </div>
            </center>
            
            <form class="forms" action="../BACK_END/update_sv.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="exampleInputUsername1">Supervisor ID</label>
                        <input type="hidden" name="original_sv_id" value="<?php echo $userRow['USER_ID']?>">
                        <input type="number" class="form-control" value="<?php echo $userRow['USER_ID']?>" name="edit_sv_id">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Supervisor Name</label>
                        <input type="text" class="form-control" value="<?php echo $userRow['USER_NAME']?>" name="edit_sv_name">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputUsername1">Supervisor Email</label>
                        <input type="text" class="form-control" value="<?php echo $userRow['USER_EMAIL']?>" name="edit_sv_email">
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputUsername1">Supervisor Phone Number</label>
                        <input type="number" class="form-control" value="<?php echo $userRow['PHONE_NUMBER']?>" name="edit_sv_phone">
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