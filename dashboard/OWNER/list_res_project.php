<?php
  require('header.php');
  require_once('../BACK_END/db_connection.php');

  // ENCRYPTION FUNCTION
  // Store cipher method 
  $ciphering = "BF-CBC"; 
  //OpenSSl encryption method 
  $iv_length = openssl_cipher_iv_length($ciphering); 
  $options = 0; 

  $encryption_iv = '11223344'; 
  $encryption_key = openssl_digest(php_uname(), 'MD5', TRUE); 
  /*##########ENCRYPTING DOC_ID*#############*/

  $string = 8; //retrieve file id from database
  $encryption = openssl_encrypt($string, $ciphering, 
              $encryption_key, $options, $encryption_iv);
?>

<!-- MODAL FOR RESEARCH PROJECT REGISTERING -->
<?php
  include 'reg_research_project_modal.php';
?>
<!-- MODAL FOR RESEARCH PROJECT REGISTERING -->


<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <button type="button" class="btn btn-info btn-rounded btn-fw" data-toggle="modal" data-target="#addResearchProject">
                <i class="mdi mdi-plus"></i>Add New Research Project 
              </button>

              <br><br><br>

              <h4 class="card-title">Research Project List</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive table-striped">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Project Title</th>
                            <th>Field of Expertise</th>
                            <th>Student ID</th>
                            <th>Supervisor ID</th>
                            <th>Actions</th>
                            <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $rpStmt = $db->query("SELECT * FROM RESEARCH_PROJECT RP JOIN FIELD_OF_EXPERTISE FOE ON RP.FOE_ID = FOE.FOE_ID");
                          $rpStmt->execute();

                          $bil=0;
                          while($rpRow = $rpStmt->fetch(PDO::FETCH_ASSOC)){
                            $bil++;
                        ?>
                        <tr>
                            <td><?php echo $bil; ?></td>
                            <td><?php echo $rpRow['PROJECT_TITLE']; ?></td>
                            <td><?php echo $rpRow['FOE_DESCRIPTION']; ?></td>                            
                            <td><?php echo $rpRow['STUDENT_ID']; ?></td>                            
                            <td><?php echo $rpRow['SUPERVISOR_ID']; ?></td>

                            <!-- <td width="10%"> -->
                              <!-- <button class="btn btn-outline-info" data-toggle="modal" data-target="#editResearchProject<?php //echo $rpRow['PROJECT_ID']?>"> -->
                              <!-- <a target='_blank' href='../BACK_END/view.php?id=<?php echo $encryption?>'>
                                <i class="fa fa-eye"></i> View
                              </a>
                              </button> -->
                            <!-- </td> -->

                            <td width="10%">
                              <button class="btn btn-outline-primary" data-toggle="modal" data-target="#editResearchProject<?php echo $rpRow['PROJECT_ID']?>">Edit</button>
                            </td>

                            <td width="10%">
                              <?php
                                $string = $rpRow['PROJECT_ID'];
                                $encryption = openssl_encrypt($string, $ciphering, 
                                            $encryption_key, $options, $encryption_iv);
                                ; 

                                echo "<a target='_self' href='#?id=" .$encryption."'>";
                              ?>
                                <button class="btn btn-outline-danger btn-rounded">
                                  <i class="fa fa-trash-o"></i> Delete
                                </button>
                              </a>
                              
                            </td>
                        </tr>
                        <?php
                          // include "update_programme_modal.php";
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