<?php
    require('header.php');
    require_once('../BACK_END/db_connection.php');

    // ENCRYPTION FUNCTION
    $ciphering = "AES-128-CTR"; 
    //OpenSSl encryption method 
    $iv_length = openssl_cipher_iv_length($ciphering); 
    $options = 0; 
    // Non-NULL Initialization Vector for encryption
    $encryption_iv = '1234567891011121'; 
    $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
    /*##########ENCRYPTING DOC_ID*#############*/
?>


<!-- ADD USER MODAL -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Supervisor</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
            </button>
        </div>
        <form class="forms" action="../BACK_END/reg_sv.php" method="POST">
          
          <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputUsername1">Supervisor ID</label>
                <input type="number" class="form-control" name="reg_sv_id" required="required"  maxlength="20"/>
            </div>

            <div class="form-group">
                <label for="exampleInputUsername1">Supervisor Name</label>
                <input type="text" class="form-control" name="reg_sv_name" maxlength="255" required="required"/>
            </div>

            <div class="form-group">
                <label for="exampleInputUsername1">Supervisor Email</label>
                <input type="email" class="form-control" name="reg_sv_email" maxlength="255"/>
            </div>

            <div class="form-group">
                <label for="exampleInputUsername1">Supervisor Phone</label>
                <input type="number" class="form-control" name="reg_sv_phone" maxlength="15"/>
            </div>
          </div>
          
          <div class="form-group">
            <center>
              <p>Please double check all details, before clicking 'Register' button</p>
            </center>
          </div>

          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="Submit" class="btn btn-primary">Register</button>
          </div>
        </form>
      </div>
  </div>
</div>
<!-- ADD USER MODAL -->

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <button type="button" class="btn btn-info btn-rounded btn-fw" data-toggle="modal" data-target="#addUserModal">
                <i class="mdi mdi-plus"></i>Add New Supervisor
              </button>

              <br><br><br>

              <h4 class="card-title">Supervisors List</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive table-striped">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>SV ID</th>
                            <th>SV Name</th>
                            <th>SV Email</th>
                            <th>SV Phone</th>
                            <th>Actions</th>
                            <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                          $userStmt = $db->prepare("SELECT * FROM USER_ACCOUNT WHERE USER_ID != :admin_id");
                          $userStmt->bindParam(":admin_id", $_SESSION['CURRENT_USER_ID']);
                          $userStmt->execute();

                          $bil=0;
                          while($userRow = $userStmt->fetch(PDO::FETCH_ASSOC)){
                            $bil++;
                        ?>
                        <tr>
                            <td><?php echo $bil; ?></td>
                            <td><?php echo $userRow['USER_ID']; ?></td>
                            <td><?php echo $userRow['USER_NAME']; ?></td>
                            <td><?php echo $userRow['USER_EMAIL']; ?></td>
                            <td><?php echo $userRow['PHONE_NUMBER']; ?></td>

                            <td width="10%">
                              <button class="btn btn-outline-primary" data-toggle="modal" data-target="#editUser<?php echo $userRow['USER_ID']?>">Edit</button>
                            </td>

                            <td width="10%">
                              <?php
                                $string = $userRow['USER_ID'];
                                $encryption = openssl_encrypt($string, $ciphering, 
                                            $encryption_key, $options, $encryption_iv);
                                ; 

                                echo "<a target='_self' href='../BACK_END/delete_sv.php?id=" .$encryption."'>";
                              ?>
                                <button class="btn btn-outline-danger btn-rounded">
                                  <i class="fa fa-trash-o"></i> Delete
                                </button>
                              </a>
                              
                            </td>
                        </tr>
                        <?php
                          include "update_supervisor_modal.php";
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->

<?php
    require('footer.php');
?>