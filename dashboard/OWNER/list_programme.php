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
?>

<!-- ADD PROGRAMME MODAL -->
<div class="modal fade" id="addProgrammeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Programme</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">x</span>
            </button>
        </div>
        <form class="forms" action="../BACK_END/reg_programme.php" method="POST">
          
          <div class="modal-body">
            <div class="form-group">
                <label>Programme Code</label>
                <input type="text" class="form-control" name="reg_prog_code" maxlength="20" required="required"/>
            </div>

            <div class="form-group">
                <label>Programme Name</label>
                <input type="text" class="form-control" name="reg_prog_name" maxlength="255" required="required"/>
            </div>
        </div>
          
          <!-- <div class="form-group">
            <center>
              <p>Please double check all details, before clicking 'Register' button</p>
            </center>
          </div> -->

          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="Submit" class="btn btn-primary">Add</button>
          </div>
        </form>
      </div>
  </div>
</div>
<!-- ADD PROGRAMME MODAL -->

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <button type="button" class="btn btn-info btn-rounded btn-fw" data-toggle="modal" data-target="#addProgrammeModal">
                <i class="mdi mdi-plus"></i>Add New Programme 
              </button>

              <br><br><br>

              <h4 class="card-title">Programme List</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive table-striped">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Programme Code</th>
                            <th>Programme Name</th>
                            <th>Actions</th>
                            <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $progStmt = $db->query("SELECT * FROM PROGRAMME");
                          $progStmt->execute();

                          $bil=0;
                          while($progRow = $progStmt->fetch(PDO::FETCH_ASSOC)){
                            $bil++;
                        ?>
                        <tr>
                            <td><?php echo $bil; ?></td>
                            <td><?php echo $progRow['PROGRAMME_CODE']; ?></td>
                            <td><?php echo $progRow['PROGRAMME_NAME']; ?></td>

                            <td width="10%">
                              <button class="btn btn-outline-primary" data-toggle="modal" data-target="#editProgramme<?php echo $progRow['PROGRAMME_ID']?>">Edit</button>
                            </td>

                            <td width="10%">
                              <?php
                                $string = $progRow['PROGRAMME_ID'];
                                $encryption = openssl_encrypt($string, $ciphering, 
                                            $encryption_key, $options, $encryption_iv);
                                ; 

                                echo "<a target='_self' href='../BACK_END/delete_programme.php?id=" .$encryption."'>";
                              ?>
                                <button class="btn btn-outline-danger btn-rounded">
                                  <i class="fa fa-trash-o"></i> Delete
                                </button>
                              </a>
                              
                            </td>
                        </tr>
                        <?php
                          include "update_programme_modal.php";
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