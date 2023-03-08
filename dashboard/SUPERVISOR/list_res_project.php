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
                            <th>Student Name</th>
                            <th>Supervisor Name</th>
                            <th>Details</th>
                            <th width="5%">Actions</th>
                            <th width="8%">Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $rpStmt = $db->query("
                          SELECT DISTINCT(RP.PROJECT_ID) AS PROJECT_ID, RP.PROJECT_TITLE, RP.PROJECT_DESCRIPTION, RP.PROJECT_SUBMISSION_DATE, 
                          RP.PROJECT_VIEW_TOTAL, RP.STUDENT_ID, RP.SUPERVISOR_ID, FOE.FOE_ID, FOE.FOE_DESCRIPTION, P.PROGRAMME_ID,
                          P.PROGRAMME_NAME, P.PROGRAMME_CODE, S.STUD_NAME, UA.USER_NAME, F.FILE_ID
                          FROM RESEARCH_PROJECT RP 
                          JOIN FIELD_OF_EXPERTISE FOE ON RP.FOE_ID = FOE.FOE_ID 
                          JOIN PROGRAMME P ON RP.PROGRAMME_ID = P.PROGRAMME_ID 
                          JOIN FILE F ON RP.PROJECT_ID = F.PROJECT_ID 
                          JOIN USER_ACCOUNT UA ON RP.SUPERVISOR_ID = UA.USER_ID 
                          JOIN STUDENT S ON RP.STUDENT_ID = S.STUD_ID
                          GROUP BY PROJECT_ID;");
                          $rpStmt->execute();

                          $bil=0;
                          while($rpRow = $rpStmt->fetch(PDO::FETCH_ASSOC)){
                            $bil++;
                        ?>
                        <tr>
                            <td><?php echo $bil; ?></td>
                            <td><?php echo $rpRow['PROJECT_TITLE']; ?></td>
                            <td><?php echo $rpRow['FOE_DESCRIPTION']; ?></td>                            
                            <td><?php echo $rpRow['STUD_NAME']; ?></td>                            
                            <td><?php echo $rpRow['USER_NAME']; ?></td>

                            <td width="10%">
                              <button class="btn btn-outline-info" data-toggle="modal" 
                              data-target="#viewResearchProject<?php echo $rpRow['PROJECT_ID']?>">
                                <i class="fa fa-eye"></i> View
                              </button>
                            </td>

                            <td>
                              <button class="btn btn-outline-primary" data-toggle="modal" 
                              data-target="#editResearchProject<?php echo $rpRow['PROJECT_ID']?>">Edit</button>
                            </td>

                            <td>
                              <?php
                                $string = $rpRow['PROJECT_ID'];
                                $encryption = openssl_encrypt($string, $ciphering, 
                                            $encryption_key, $options, $encryption_iv);
                                ; 

                                echo "<a target='_self' href='../BACK_END/delete_research_project.php?id=" .$encryption."'>";
                              ?>
                                <button class="btn btn-outline-danger btn-rounded">
                                  <i class="fa fa-trash-o"></i> Delete
                                </button>
                              </a>
                              
                            </td>
                        </tr>
                        <?php
                          include "view_project_modal.php";
                          include "update_project_modal.php";
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