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

<!-- partial -->
<div class="main-panel">
        <div class="content-wrapper">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">My Certificate List</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive table-striped">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th>No.</th>
                            <th>Project Title</th>
                            <th>Supervisor Name</th>
                            <th>Submission Date</th>
                            <th>View</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $certStmt = $db->prepare("SELECT * FROM CERTIFICATE_DATA CD 
                          JOIN RESEARCH_PROJECT RP ON CD.PROJECT_ID = RP.PROJECT_ID 
                          JOIN STUDENT S ON RP.STUDENT_ID = S.STUD_ID
                          JOIN USER_ACCOUNT UA ON RP.SUPERVISOR_ID = UA.USER_ID
                          WHERE RP.STUDENT_ID = :stud_id");
                          $certStmt->bindParam(':stud_id', $_SESSION['CURRENT_STUDENT_ID']);

                          $certStmt->execute();

                          $bil=0;
                          while($certRow = $certStmt->fetch(PDO::FETCH_ASSOC)){
                            $bil++;
                        ?>
                        <tr>
                            <td><?php echo $bil; ?></td>
                            <td><?php echo $certRow['PROJECT_TITLE']; ?></td>
                            <td><?php echo $certRow['USER_NAME']; ?></td>
                            <td>
                                <?php 
                                    echo date('d  F  Y',strtotime($certRow['PROJECT_SUBMISSION_DATE']));;
                                ?>
                            </td>

                            <td width="10%">
                              <?php
                                $string = $certRow['CERT_ID'];
                                $encryption = openssl_encrypt($string, $ciphering, 
                                            $encryption_key, $options, $encryption_iv);
                                ; 

                                echo "<a target='_blank' href='../BACK_END/certificate/Class1/basic.php?id=" .$encryption."'>";
                              ?>
                                <button class="btn btn-outline-info">
                                    <i class="fa fa-eye"></i> View
                                </button>
                              </a>
                              
                            </td>
                        </tr>
                        <?php
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