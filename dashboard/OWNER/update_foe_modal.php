<!-- MODAL -->
<div class="modal fade" id="editFoe<?php echo $foeRow['FOE_ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Field of Expertise Detail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            
            <form class="forms" action="../BACK_END/update_foe.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                    <label>Field of Expertise Name</label>
                        <input type="hidden" name="foe_id" value="<?php echo $foeRow['FOE_ID']?>">
                        <input type="text" class="form-control" value="<?php echo $foeRow['FOE_DESCRIPTION']?>" name="edit_foe_name">
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