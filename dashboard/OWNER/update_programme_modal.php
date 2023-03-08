<!-- MODAL -->
<div class="modal fade" id="editProgramme<?php echo $progRow['PROGRAMME_ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Programme Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form class="forms" action="../BACK_END/update_programme.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                    <label>Programme Code</label>
                        <input type="hidden" name="programme_id" value="<?php echo $progRow['PROGRAMME_ID']?>">
                        <input type="text" class="form-control" value="<?php echo $progRow['PROGRAMME_CODE']?>" name="edit_prog_code">
                    </div>

                    <div class="form-group">
                        <label>Programme Detail</label>
                        <input type="text" class="form-control" value="<?php echo $progRow['PROGRAMME_NAME']?>" name="edit_prog_name">
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