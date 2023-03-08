<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Student Register</title>
  <!-- base:css -->
  <link rel="stylesheet" href="dashboard_plugin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="dashboard_plugin/vendors/feather/feather.css">
  <link rel="stylesheet" href="dashboard_plugin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="dashboard_plugin/css/horizontal-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="dashboard_plugin/images/favicon.png" />
  <style>
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        display: none;
      }
    </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="main-panel">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                <div class="brand-logo">
                  <img src="dashboard_plugin/images/FYRAS-removebg-preview.png" alt="logo">
                </div>
                <h4>New here?</h4>
                <h6 class="font-weight-light">Please fill in all the details..</h6>
                <form class="pt-3" method="POST" action="dashboard/BACK_END/reg_student.php">
                  <div class="form-group">
                    <input type="number" class="form-control form-control-lg" name="reg_stud_id" id="exampleInputUsername1" placeholder="STUDENT ID">
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="reg_stud_name" placeholder="Full Name">
                  </div>

                  <div class="form-group">
                    <input type="number" class="form-control form-control-lg" name="reg_stud_ic" id="exampleInputUsername1" placeholder="I/C Number">
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="reg_stud_phone" id="exampleInputUsername1" placeholder="Phone Number">
                  </div>

                  <!-- <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input">
                        I agree to all Terms & Conditions
                      </label>
                    </div>
                  </div> -->

                  <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">
                        SIGN UP
                    </button>
                  </div>
                  <div class="text-center mt-4 font-weight-light">
                    Already have an account? <a href="login" class="text-primary">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- base:js -->
  <script src="dashboard_plugin/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="dashboard_plugin/js/off-canvas.js"></script>
  <script src="dashboard_plugin/js/hoverable-collapse.js"></script>
  <script src="dashboard_plugin/js/template.js"></script>
  <script src="dashboard_plugin/js/settings.js"></script>
  <script src="dashboard_plugin/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>