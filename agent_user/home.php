
<h3 class="text-dark"><i>Welcome <?php echo $_settings->userdata('username') ?>!</i></h3>
<hr>
<section class="content">
    <div class="container-fluid">
    <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Approved RA</b></span>
                <span class="info-box-number">
                  <?php echo number_format($conn->query("SELECT * FROM t_approval_csr where c_csr_status = 1")->num_rows) ?>
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-th-list"></i></span>
              <div class="info-box-content">
                <span class="info-box-text"><b>Lots</b></span>
                <span class="info-box-number"> <?php echo number_format($conn->query("SELECT * FROM t_lots")->num_rows) ?></span>
              </div>
            </div>
          </div>
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-box"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Houses</b></span>
                <span class="info-box-number"><?php echo number_format($conn->query("SELECT * FROM t_house")->num_rows) ?></span>
              </div>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-hands-helping"></i></span>

              <div class="info-box-content">
                <span class="info-box-text"><b>Users</b></span>
                <span class="info-box-number"><?php echo number_format($conn->query("SELECT * FROM users")->num_rows) ?></span>
              </div>
          </div>
        </div>
    </div>
</section>
