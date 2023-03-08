<?php
  //Check session here
  session_start();
  require_once('../BACK_END/db_connection.php');

  if($_SESSION['user_type'] == "admin"){
    header('Location: ../OWNER/index');
  }
  else if($_SESSION['user_type'] == "student"){
    header('Location: ../STUDENTS/list_res_project');
  }
?>

<!DOCTYPE html>
<html lang="en">
 
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SUPERVISOR</title>
  <!-- base:css -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/feather/feather.css">
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->

  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->
   <!-- plugin css for this page -->
   <link rel="stylesheet" href="../../dashboard_plugin/vendors/jquery-toast-plugin/jquery.toast.min.css">
  <!-- End plugin css for this page -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/font-awesome/css/font-awesome.min.css"/>
  <!-- End plugin css for this page -->

  
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="../../dashboard_plugin/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../dashboard_plugin/css/vertical-layout-light/style.css">
  <!-- endinject -->

  <link rel="stylesheet" href="../../dashboard_plugin/vendors/dropify/dropify.min.css">


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
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <?php
              $current_user_id = (int)$_SESSION['CURRENT_USER_ID'];

              $stmtOwnProfile = $db->prepare("SELECT * FROM USER_ACCOUNT WHERE USER_ID = :cur_user_id");
              $stmtOwnProfile->bindParam(":cur_user_id", $current_user_id);
              $stmtOwnProfile->execute();

              $rowProfile = $stmtOwnProfile->fetch(PDO::FETCH_ASSOC);
            ?>
            
            <form class="forms" action="../BACK_END/update_profile" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label>My ID: <?php echo $rowProfile['USER_ID']; ?></label>
                        <input type="hidden" name="current_profile_id" value="<?php echo $rowProfile['USER_ID']; ?>">
                    </div>

                    <div class="form-group">
                        <label>My Name</label>
                        <input type="text" class="form-control" value="<?php echo $rowProfile['USER_NAME']; ?>" name="edit_profile_name">
                    </div>

                    <div class="form-group">
                        <label>My Password</label>
                        <!-- <input class="form-control" disabled="disabled" name="" placeholder="Old Password: <?php //echo $rowProfile['USER_PASSWORD']; ?>"> -->
                        <input type="text" class="form-control" value="<?php echo $rowProfile['USER_PASSWORD']; ?>" name="edit_profile_password">
                    </div>

                    <div class="form-group">
                        <label>My Email</label>
                        <input type="text" class="form-control" value="<?php echo $rowProfile['USER_EMAIL']; ?>" name="edit_profile_email">
                    </div>
                    
                    <div class="form-group">
                        <label>My Phone Number</label>
                        <input type="number" class="form-control" value="<?php echo $rowProfile['PHONE_NUMBER']; ?>" name="edit_profile_phone">
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
        <a class="navbar-brand brand-logo" href="index">
          <img src="../../dashboard_plugin/images/FYRAS.png" alt="FYRAS logo"/>
        </a>

        <a class="navbar-brand brand-logo-mini" href="index">
          <img src="../../dashboard_plugin/images/logo-mini.svg" alt="FYRAS logo"/>
        </a>
        
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <img src="../../dashboard_plugin/images/sidebar/menu.svg" alt="" class="">
        </button>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group pl-0">
              <input type="text" class="form-control ml-0" placeholder="Search Projects.." aria-label="search">
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
                      <span class="profile-name font-weight-bold"><?php echo $rowProfile['USER_NAME']; ?></span>
                      <p class="profile-designation">Supervisor</p>
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
                        <a href="../BACK_END/logout" class="profile-dropdown-link">
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
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item"></li> <!-- add space on top of nav bar -->

          <li class="nav-item">
            <div class="sidebar-menu-title">
              <img src="../../dashboard_plugin/images/sidebar/home.svg" alt="" class="sidebar-icon-title"> <span>Home</span>
            </div>
              <ul class="nav submenu-wrapper">
                <li class="nav-item">
                    <a class="nav-link" href="index">
                      <span class="menu-title">Dashboard </span>
                    </a>
                </li>
              </ul>
          </li>

          <li class="nav-item">
            <div class="sidebar-menu-title">
              <img src="../../dashboard_plugin/images/sidebar/doc.svg" alt="" class="sidebar-icon-title"> 
              <span>View</span>
            </div>
              <ul class="nav submenu-wrapper">
                <li class="nav-item">
                    <a class="nav-link" href="search_research_project">
                      <span class="menu-title">Search Research Project </span>
                    </a>
                </li>
              </ul>
          </li>

          <li class="nav-item">
            <div class="sidebar-menu-title">
                <img src="../../dashboard_plugin/images/sidebar/data.svg" alt="" class="sidebar-icon-title">  
                <span>Data</span>
            </div>
            <ul class="nav submenu-wrapper">

              <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                  <span class="menu-title">Manage Data</span>
                  <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="tables">
                  <ul class="nav flex-column sub-menu">
                    <!-- <li class="nav-item"> 
                      <a class="nav-link" href="../../dashboard_plugin/demo/vertical-fixed/pages/tables/data-table.html">Data table</a>
                    </li> -->
                    <li class="nav-item">
                      <a class="nav-link" href="list_res_project">Research Project</a>
                    </li>
                    <!-- <li class="nav-item">
                      <a class="nav-link" href="list_certificate">Supervisee Certificate</a>
                    </li> -->
                  </ul>
                </div>
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