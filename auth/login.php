<?php require_once('../config.php') ?>
<style>
  .image-container {
    display: flex;
    justify-content: center; 
    align-items: center;
    height: auto; 
    padding:none;
}
</style>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">

<?php
  require_once('session_auth.php');
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  	<title><?php echo $_settings->info('title') != false ? $_settings->info('title').' | ' : '' ?><?php echo $_settings->info('name') ?></title>
    <!-- Google Font: Source Sans Pro -->
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
      <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
   <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2/css/select2.min.css">
     <link rel="stylesheet" href="<?php echo base_url ?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/adminlte.css">
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/custom.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.css">
     <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo base_url ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <style type="text/css">/* Chart.js */
      @keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}
    </style>

     <!-- jQuery -->
     <script src="https://code.jquery.com/jquery-3.5.1.min.js"  crossorigin="anonymous"></script>
    <script src="<?php echo base_url ?>plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="<?php echo base_url ?>plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url ?>plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url ?>plugins/toastr/toastr.min.js"></script>
    <script>
        var _base_url_ = '<?php echo base_url ?>';
    </script>
    <script src="<?php echo base_url ?>dist/js/script.js"></script>
    <script src="<?php echo base_url ?>dist/js/scripts.js"></script>
    <script src="<?php echo base_url ?>dist/js/common.js"></script>

    <script src="<?php echo base_url ?>dist/js/TimeCircles.js"></script>
    <link rel="stylesheet" href="<?php echo base_url ?>dist/css/TimeCircles.css">

  </head>
<style>
/* General Styles */
body.hold-transition.login-page, body.hold-transition.register-page {
    background: url('<?php echo base_url . 'images/login-bg.jpg'; ?>') no-repeat center center fixed;
    background-size: cover;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
}

/* Overlay for Better Readability */
body.hold-transition.login-page::before, body.hold-transition.register-page::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5); /* Semi-transparent black overlay */
    z-index: 1;
}

/* Content Box Positioning */
.login-box, .register-box {
    position: relative;
    z-index: 2; /* Ensure it is above the overlay */
    background-color: rgba(255, 255, 255, 0); /* Fully transparent */
    padding: 20px;
    border-radius: 4px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
    border: none; /* Remove the border */
}

@media (max-width: 576px) {
    .login-box, .register-box {
        width: 90%;
        margin-top: 0.5rem;
    }
}

/* Card Styling */
.login-card-body, .register-card-body {
    background-color: transparent;
    border-top: 0;
    color: #666;
    padding: 20px;
}

.login-card-body .input-group .form-control, .register-card-body .input-group .form-control {
    border-right: 0;
}

.login-card-body .input-group .form-control:focus, .register-card-body .input-group .form-control:focus {
    box-shadow: none;
    border-color: #80bdff;
}

.login-card-body .input-group .form-control.is-valid:focus, 
.register-card-body .input-group .form-control.is-valid:focus {
    box-shadow: none;
}

.login-card-body .input-group .input-group-text, .register-card-body .input-group .input-group-text {
    background-color: transparent;
    color: #777;
    border-left: 0;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

/* Responsive Alignment */
.login-logo, .register-logo {
    font-size: 2.1rem;
    font-weight: 300;
    margin-bottom: 0.9rem;
    text-align: center;
}

.login-logo a, .register-logo a {
    color: #495057;
}

.login-box-msg, .register-box-msg {
    margin: 0;
    padding: 0 20px 20px;
    text-align: center;
}

/* Input Fields */
.input-group .form-control {
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
}

.input-group .form-control:focus {
    box-shadow: none;
    border-color: #17a2b8;
}

.input-group .input-group-text {
    padding: 0.375rem 0.75rem;
}

/* Buttons */
button {
    transition: all 0.3s ease;
    background-color: #007bff;
    color: #fff;
    border: none;
    padding: 10px 15px;
    font-size: 1rem;
    border-radius: 5px;
}

button:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

/* Remember Me and Forgot Password */
.d-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1rem;
}

.form-check-label {
    font-size: 0.9rem;
    color: #495057;
}

a.text-primary {
    font-size: 0.9rem;
    color: #007bff;
    text-decoration: none;
}

a.text-primary:hover {
    text-decoration: underline;
}

/* Image Container */
.image-container {
    text-align: center;
    margin-bottom: 1rem;
}

.image-container img {
    width: 150px;
    height: 120px;
}

/* Button Alignment */
.row.justify-content-center {
    margin-top: 1rem;
}

.row.justify-content-center .btn {
    width: 100%;
}

/* Additional Styling for Mobile */
@media (max-width: 576px) {
    .btn {
        padding: 0.75rem;
        font-size: 1rem;
    }
}
</style>

<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>

 <!--  <h1 class="text-center"><?= $_settings->info('name') ?></h1> -->

<div class="login-box">
  <!-- /.login-logo -->
  
  <div class="card card-outline rounded-0 card-blue rounded-0">

    <!-- <div class="card-header text-center">
      <a href="./" class="h1"><b>Login</b></a>
    </div> -->

    <div class="card-body">
    <div class="image-container">
      <img src="<?php echo base_url . 'images/logo.jpg'; ?>" alt="PDF Icon" width="150" height="120">
  </div>
<hr>
      <p class="login-box-msg">Sign in to start your session</p>

      <form id="login-frm" action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="username" placeholder="User ID">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
          
          <!-- Forgot Password -->
          <div>
            <a href="auth-reset-password.htm" class="text-primary">Forgot Password?</a>
          </div>
        </div>
        <div class="row justify-content-center">
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" class="btn btn-flat btn-default bg-blue btn-block"><i class="fa fa-unlock" aria-hidden="true"></i>&nbsp;&nbsp;Login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<!-- <script src="plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
<!-- AdminLTE App -->
<!-- <script src="dist/js/adminlte.min.js"></script> -->

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>