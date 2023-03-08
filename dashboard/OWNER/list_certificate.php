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
              <h4 class="card-title">Certificate List</h4>
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive table-striped">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="5%">No.</th>
                            <th>Student ID</th>
                            <th>Supervisor ID</th>
                            <th>Project Name</th>
                            <th>View</th>
                            <th>Delete</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php

                          $certStmt = $db->query("SELECT * FROM CERTIFICATE_DATA CD 
                          JOIN RESEARCH_PROJECT RP ON CD.PROJECT_ID = RP.PROJECT_ID;");
                          $certStmt->execute();

                          $bil=0;
                          while($certRow = $certStmt->fetch(PDO::FETCH_ASSOC)){
                            $bil++;
                        ?>
                        <tr>
                            <td><?php echo $bil; ?></td>
                            <td><?php echo $certRow['STUDENT_ID']; ?></td>
                            <td><?php echo $certRow['SUPERVISOR_ID']; ?></td>
                            <td><?php echo $certRow['PROJECT_TITLE']; ?></td>

                            <td width="10%">
                              <?php
                                $string = $certRow['CERT_ID'];
                                $encryption = openssl_encrypt($string, $ciphering, 
                                            $encryption_key, $options, $encryption_iv);
                                ; 

                                echo "<a target='_self' href='../BACK_END/certificate/Class1/basic.php?id=" .$encryption."'>";
                              ?>
                                <button class="btn btn-outline-primary btn-rounded btn-icon-text">
                                  <i class="fa fa-eye"></i> View
                                </button>
                              </a>

                            <td width="10%">
                              <?php
                                echo "<a target='_self' href='../BACK_END/delete_cert.php?id=" .$encryption."'>";
                              ?>
                                <button class="btn btn-outline-danger btn-rounded btn-icon-text">
                                  <i class="fa fa-trash-o"></i> Delete
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