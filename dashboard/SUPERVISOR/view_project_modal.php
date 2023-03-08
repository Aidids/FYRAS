<!-- MODAL -->
<div class="modal fade" id="viewResearchProject<?php echo $rpRow['PROJECT_ID']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="exampleModalLabel">RESEARCH PROJECT DETAIL</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h4>Project Title</h4>
                        <p><?php echo $rpRow['PROJECT_TITLE']?></p>
                    </div>

                    <div class="form-group">
                        <h4>Abstract</h4>
                        <p><?php echo $rpRow['PROJECT_DESCRIPTION']?></p>
                        <!-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.rr</p> -->
                    </div>
                    
                    <div class="form-group">
                        <h4>Project Date</h4>
                        <!-- <p><?php echo $rpRow['PROJECT_SUBMISSION_DATE']?></p> -->
                        <p>
                            <?php 
                                echo date('d  F  Y',strtotime($rpRow['PROJECT_SUBMISSION_DATE']));
                            ?>
                        </p>
                    </div>

                    <div class="form-group">
                        <h4>Field of Expertise</h4>
                        <p><?php echo $rpRow['FOE_DESCRIPTION']?></p>
                    </div>

                    <div class="form-group">
                        <h4>Programme Code</h4>
                        <p><?php echo $rpRow['PROGRAMME_NAME'] ." - " . $rpRow['PROGRAMME_CODE']?></p>
                    </div>

                    <div class="form-group">
                        <h4>Student Details</h4>
                        <p><?php echo $rpRow['STUD_NAME']?></p>
                    </div>

                    <div class="form-group">
                        <h4>Supervisor Name</h4>
                        <p><?php echo $rpRow['USER_NAME']?></p>
                    </div>

                    <?php
                        $stmtFile = $db->prepare("SELECT FILE_ID, FILE_NAME FROM FILE WHERE PROJECT_ID = :project_id");
                        $stmtFile->bindParam(':project_id', $rpRow['PROJECT_ID']);
                        $stmtFile->execute();
                    ?>

                    <div class="form-group">
                        <h4>Attached File</h4>
                        <ul>
                            <?php
                                while($rpFile = $stmtFile->fetch(PDO::FETCH_ASSOC)){
                            ?>
                            <li>                                      
                                <?php
                                    $string = $rpFile['FILE_ID']; //retrieve file id from database
                                    $encryption = openssl_encrypt($string, $ciphering, 
                                                $encryption_key, $options, $encryption_iv);
                                ?>
                                <!-- <p><?php //var_dump (openssl_error_string ());?></p><br/> -->
                                <a href="../BACK_END/view?id=<?php echo $encryption;?>" target="_blank">
                                    <button class="btn btn-inverse-primary btn-sm btn-fw">
                                        <?php
                                            $fileName = explode("-", $rpFile['FILE_NAME']);

                                            echo $fileName[1];
                                        ?>
                                    </button>
                                </a>
                            </li>
                            <br>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>   
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->