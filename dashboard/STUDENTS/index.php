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
            
            <div class="col-sm-3">
                <div class="float-right">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb bg-light">
                        <li class="breadcrumb-item"><a href="index">Home</a></li>
                      </ol>
                    </nav>
                </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h3 class="">Supervisor Quantity</h3>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Orders</h4>
                  <p class="text-small">-1.08% Since last month</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-dark font-weight-bold">55,543<span class="text-muted text-extra-small">/ per month</span></h2>
                    <div class="text-success font-weight-bold d-flex justify-content-between align-items-center">
                        <i class="mdi mdi-chevron-up mdi-24px"></i> <span class=" text-extra-small">130.5%</span>
                    </div>
                  </div>
                  <canvas id="orders"></canvas>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Growth</h4>
                  <p class="text-small">+5.27% Since last month</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-dark font-weight-bold">58.86%<span class="text-muted text-extra-small">/ per month</span></h2>
                    <div class="text-success font-weight-bold d-flex justify-content-between align-items-center">
                        <i class="mdi mdi-chevron-up mdi-24px"></i> <span class=" text-extra-small">120.3%</span>
                    </div>
                  </div>
                  <canvas id="growth"></canvas>
                </div>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Revenue</h4>
                  <p class="text-small"> +7.00% Since last month</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-dark font-weight-bold">USD 42,9536<span class="text-muted text-extra-small">/ per month</span></h2>
                  </div>
                  <canvas id="revenue"></canvas>
                </div>
              </div>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Customers</h4>
                  <p class="text-small">+5.27% Since last month</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-dark font-weight-bold">43,981<span class="text-muted text-extra-small">/ per month</span></h2>
                    <div class="text-danger font-weight-bold d-flex justify-content-between align-items-center">
                        <i class="mdi mdi-chevron-down mdi-24px"></i> <span class=" text-extra-small">40.8%</span>
                    </div>
                  </div>
                  <canvas id="customer"></canvas>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Orders</h4>
                  <p class="text-small">-1.08% Since last month</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-dark font-weight-bold">55,543<span class="text-muted text-extra-small">/ per month</span></h2>
                    <div class="text-success font-weight-bold d-flex justify-content-between align-items-center">
                        <i class="mdi mdi-chevron-up mdi-24px"></i> <span class=" text-extra-small">130.5%</span>
                    </div>
                  </div>
                  <canvas id="orders"></canvas>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Growth</h4>
                  <p class="text-small">+5.27% Since last month</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-dark font-weight-bold">58.86%<span class="text-muted text-extra-small">/ per month</span></h2>
                    <div class="text-success font-weight-bold d-flex justify-content-between align-items-center">
                        <i class="mdi mdi-chevron-up mdi-24px"></i> <span class=" text-extra-small">120.3%</span>
                    </div>
                  </div>
                  <canvas id="growth"></canvas>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Revenue</h4>
                  <p class="text-small"> +7.00% Since last month</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <h2 class="text-dark font-weight-bold">USD 42,9536<span class="text-muted text-extra-small">/ per month</span></h2>
                  </div>
                  <canvas id="revenue"></canvas>
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