<?php
  session_start();

  if(!isset($_SESSION['login_error']) && !empty($_SESSION['login_error'])){
    $_SESSION['login_error'] = 0;
  }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>FYRAS LOGIN</title>
  <!-- base:css -->
  <link rel="stylesheet" href="dashboard_plugin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="dashboard_plugin/vendors/feather/feather.css">
  <link rel="stylesheet" href="dashboard_plugin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="dashboard_plugin/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <!-- End plugin css for this page -->

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
  
  <!-- inject:css -->
  <link rel="stylesheet" href="dashboard_plugin/css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="dashboard_plugin/images/favicon.png" />

  <style>
  .form {
  display: none;
  }
  .form.active {
    display: block
  }

  /* body{ */
    /* background-image: url('../Final/dashboard_plugin/images/purple-login-bg3.jpg'); */
    /* background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: cover;
    background-size: 100% 100%; */
  /* } */
  </style>

<script type="text/javascript">
$(document).ready(function() {
  $('input[name=colorCheckbox]:radio').change(function(e) {
    let value = e.target.value.trim()

    $('[class^="formrad"]').css('display', 'none');

    switch (value) {
      case 'staff':
        $('.formrad-a').show()
        break;
      case 'student':
        $('.formrad-b').show()
        break;
      default:
        break;
    }
  })
})
</script>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <center>
                <?php
                    switch ($_SESSION['login_error']){
                        case 4:
                          echo "
                          <div class='alert btn-outline-danger' role='alert'>
                              <i class='mdi mdi-alert-circle'>
                                <strong>Please Make Sure all Field are filled..</strong>
                              </i>
                          </div>
                          ";
                          $_SESSION['login_error'] = 0;
                          echo "<br><br><br>";
                          break;
                      case 401:
                        echo "
                            <div class='alert btn-outline-warning' role='alert'>
                                <i class='mdi mdi-alert-circle'>
                                  <strong>invalid id or password, please Re-enter</strong>
                                </i>
                            </div>
                            ";
                            $_SESSION['login_error'] = 0;
                            echo "<br><br><br>";
                            break;
                    }                    
                ?>                
                
                <div class="brand-logo">
                    <img src="dashboard_plugin/images/FYRAS-removebg-preview.png" alt="logo">
                </div>
                <h2>Welcome</h2>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <br><br><br>
                <!-- <input type="radio" name="loginForm" value="One" checked/> Staff 
                <input type="radio" name="loginForm" value="Two"/> Student -->
                <label>
                  <input type="radio" name="colorCheckbox" value="staff" checked> STAFF 
                </label>
                &nbsp;&nbsp;&nbsp;
                <label>
                  <input type="radio" name="colorCheckbox" value="student"> STUDENT
                </label>
                
              </center>

              <br><br>
              <!-- STAFF LOGIN FORM -->
              <div class="formrad-a">
                <form class="pt-3" action="dashboard/BACK_END/login_auth" METHOD="POST">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="user_login_id" placeholder="Staff ID" required>
                  </div>

                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="user_login_password" placeholder="Password" required>
                  </div>

                  <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN
                  </div>
                </form>
              </div>  

              <!-- STUDENT LOGIN FORM -->

              <div class="formrad-b" style="display: none">
                <form class="pt-3" action="dashboard/BACK_END/student_login_auth" METHOD="POST">
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="student_id" placeholder="Student ID" required>
                  </div>

                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="student_ic" placeholder="I/C Number" required>
                  </div>

                  <div class="mt-3">
                    <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">SIGN IN
                  </div>
                </form>

                <div class="text-center mt-4 font-weight-light">
                  Don't have an account? &nbsp<a href="signup" class="text-primary"> Register Here</a>
                </div>
              </div>  

              <!-- ############################################################ -->
              <div class="my-2 d-flex justify-content-between align-items-center">
                <div class="form-check">
                  <label class="form-check-label text-muted">
                    <!-- <input type="checkbox" class="form-check-input">
                    Keep me signed in -->
                  </label>
                </div>
                <!-- <a href="#" class="auth-link text-black">Forgot password?</a> -->
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

  <!-- plugin js for this page -->
  <script src="dashboard_plugin/vendors/jquery-toast-plugin/jquery.toast.min.js"></script>
  <!-- End plugin js for this page -->

  <!-- endinject -->
</body>

</html>
