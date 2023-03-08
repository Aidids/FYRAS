<?php
  //Check session here
  session_start();
  require_once('../BACK_END/db_connection.php');
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>STUDENT</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/feather/feather.css">
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <!-- End plugin css for this page -->

  <!-- inject:css -->
  <link rel="stylesheet" href="../../dashboard_plugin/css/vertical-layout-light/style.css">
  <!-- endinject -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/font-awesome/css/font-awesome.min.css"/>
  <!-- End plugin css for this page -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->

  <link rel="shortcut icon" href="../../dashboard_plugin/images/favicon.png" /> 
  
  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        /* display: none; <- Crashes Chrome on hover */
        -webkit-appearance: none;
        margin: 0; /* <-- Apparently some margin are still there even though it's hidden */
    }

    input[type=number] {
        -moz-appearance:textfield; /* Firefox */
    }
  </style>
</head>


<!-- MODAL -->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Profile Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">X</span>
                </button>
            </div>
            <?php
              $current_stud_id = (int)$_SESSION['CURRENT_STUDENT_ID'];

              $stmtOwnProfile = $db->prepare("SELECT * FROM STUDENT WHERE STUD_ID = :cur_stud_id");
              $stmtOwnProfile->bindParam(":cur_stud_id", $current_stud_id);
              $stmtOwnProfile->execute();

              $rowProfile = $stmtOwnProfile->fetch(PDO::FETCH_ASSOC);
            ?>
            
            <form class="forms" action="../BACK_END/student_update_profile.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>My ID: <?php echo $rowProfile['STUD_ID']; ?></label>
                        <input type="hidden" name="stud_id" value="<?php echo $rowProfile['STUD_ID']; ?>">
                    </div>

                    <div class="form-group">
                        <label>My Name</label>
                        <input type="text" class="form-control" value="<?php echo $rowProfile['STUD_NAME']; ?>" name="edit_stud_name">
                    </div>

                    <div class="form-group">
                        <label>My I/C</label>
                        <!-- <input class="form-control" disabled="disabled" name="" placeholder="Old Password: <?php //echo $rowProfile['USER_PASSWORD']; ?>"> -->
                        <input type="text" class="form-control" value="<?php echo $rowProfile['STUD_IC']; ?>" name="edit_stud_ic">
                    </div>
                    
                    <div class="form-group">
                        <label>My Phone Number</label>
                        <input type="number" class="form-control" value="<?php echo $rowProfile['STUD_PHONE']; ?>" name="edit_stud_phone">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>            
            </div>
        </div>
    </div>
</div>
<!-- MODAL -->


<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex align-items-center justify-content-between">
        <a class="navbar-brand brand-logo" href="index.html"><img src="../../dashboard_plugin/images/FYRAS.png" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="../../dashboard_plugin/images/logo-mini.svg" alt="logo"/></a>
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <img src="../../dashboard_plugin/images/sidebar/menu.svg" alt="" class="">
        </button>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group pl-0">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">

          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown-navbar">
            <img src="../../dashboard_plugin/images/Profile.png" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown flat-dropdown" aria-labelledby="profileDropdown-navbar">
              <div class="flat-dropdown-header">
                <div class="d-flex">
                    <div>
                      <span class="profile-name font-weight-bold"><?php echo $rowProfile['STUD_NAME']; ?></span>
                      <p class="profile-designation">Student</p>
                    </div>
                </div>
              </div>
              <div class="profile-dropdown-body">
                  <ul class="list-profile-items">
                    <li class="profile-item">
                      <a href="#" class="profile-dropdown-link">
                        <div class="d-flex align-items-center">
                            <i class="mdi mdi-account-outline text-primary"></i>
                            <div>
                              <h5 class="item-title" data-toggle="modal" data-target="#editProfile">
                                My Profile
                              </h5>
                            </div>
                          </div>
                      </a>
                    </li>
                    <li class="profile-item">
                        <a href="../BACK_END/logout.php" class="profile-dropdown-link">
                          <div class="d-flex align-items-center">
                            <i class="mdi mdi-power text-dark"></i>
                            <div>
                              <h5 class="item-title mt-0">Logout</h5>
                            </div>
                          </div>
                        </a>
                      </li>
                  </ul>
                </div>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <img src="../../dashboard_plugin/images/sidebar/menu.svg" alt="" class="">
        </button>
      </div>
    </nav>
    <!-- partial -->

    
    <div class="container-fluid page-body-wrapper">

      <!-- partial:partials/_settings-panel.html -->
      <!-- <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="mdi mdi-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close mdi mdi-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles primary"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>  -->

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item"></li> <!-- add space on top of nav bar -->

          <!-- <li class="nav-item">
            <div class="sidebar-menu-title">
              <img src="../../dashboard_plugin/images/sidebar/home.svg" alt="" class="sidebar-icon-title"> <span>Home</span>
            </div>
              <ul class="nav submenu-wrapper">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">
                      <span class="menu-title">Dashboard </span>
                    </a>
                </li>
              </ul>
          </li> -->

          <li class="nav-item">
            <div class="sidebar-menu-title">
              <img src="../../dashboard_plugin/images/sidebar/doc.svg" alt="" class="sidebar-icon-title"> <span>View</span>
            </div>
              <ul class="nav submenu-wrapper">
                <li class="nav-item">
                    <a class="nav-link" href="list_res_project">
                      <span class="menu-title">Research Project</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="list_certificate">
                      <span class="menu-title">My Certificate</span>
                    </a>
                </li>
              </ul>
          </li>

          <li class="nav-item">
            <div class="sidebar-menu-title">
                <i class="fa fa-gears"></i>
                &nbsp;&nbsp;&nbsp;
                <span> Other </span>
            </div>
            <ul class="nav submenu-wrapper">
              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                  <span class="menu-title">Settings</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                  <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> 
                      <a class="nav-link" href="#" data-toggle="modal" data-target="#editProfile">
                        My Profile                      
                      </a>

                    </li>
                    <li class="nav-item"> 
                      <a class="nav-link" onclick="showSwal('warning-message-and-cancel')" href="../BACK_END/logout">
                        <!-- <button class="btn btn-outline-success" onclick="showSwal('warning-message-and-cancel')">Logout</button> -->
                        Logout
                      </a>
                    </li>
                  </ul>
                </div>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- partial -->