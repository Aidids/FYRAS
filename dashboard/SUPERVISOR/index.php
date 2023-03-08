<?php
    require('header.php');

    // echo "<script type='text/javascript'>showSuccessToast();</script>";
    // echo "<script language = 'javascript'>showSuccessToast();</script>";

    if($_SESSION['first_log_in'] == 1){
      echo "<body onload='showSuccessLogin()'>";
      $_SESSION['first_log_in'] = 0;
    }
?>
        
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-9">
              <div class="row">
                <div class="col-sm-12 pr-0">
                  <div class="d-lg-flex">
                    <h3 class="text-dark font-weight-bold mb-0 mr-5">Final Year Research Archive System</h3>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row mt-3">
            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2 class="display-4" style="font-weight: heavy; color: blue;">Student Quantity</h2>
                  <?php
                    $sql = $db->query("SELECT COUNT(STUD_ID) AS STUDENT_QTY FROM STUDENT;");
                    $sql->execute();

                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <br/>
                  <h2><?php echo $row["STUDENT_QTY"];?></h2>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2 h2 class="display-4" style="font-weight: heavy; color: blue;">Programme Quantity</h2>
                  <?php
                    $sql = $db->query("SELECT COUNT(PROGRAMME_ID) AS PROG_QTY FROM PROGRAMME;");
                    $sql->execute();

                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <br/>
                  <h2><?php echo $row["PROG_QTY"];?></h2>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h2 class="display-4" style="font-weight: heavy; color: blue;">Research Project Quantity</h2>
                <?php
                  $sql = $db->query("SELECT COUNT(PROJECT_ID) AS RP_QTY FROM RESEARCH_PROJECT;");
                  $sql->execute();

                  $row = $sql->fetch(PDO::FETCH_ASSOC);
                ?>
                <br/>
                <h2><?php echo $row["RP_QTY"];?></h2>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2 class="display-4" style="font-weight: heavy; color: blue;">Field of Expertise Quantity</h2>
                  <?php
                    $sql = $db->query("SELECT COUNT(FOE_ID) AS FOE_QTY FROM FIELD_OF_EXPERTISE;");
                    $sql->execute();

                    $row = $sql->fetch(PDO::FETCH_ASSOC);
                  ?>
                  <br/>
                  <h2><?php echo $row["FOE_QTY"];?></h2>
                </div>
              </div>
            </div>
          </div>
          </div>
        </div>

        
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <!-- <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2018 <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrapdash</a>. All rights reserved.</span> -->
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block"></span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

<?php
    require('footer.php');
?>