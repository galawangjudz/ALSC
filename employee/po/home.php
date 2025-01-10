<?php 
$usertype = $_settings->userdata('user_type'); 
$level = $_settings->userdata('type'); 
$session_id = $_settings->userdata('user_code');
?>
<style>
  #img_cont {
    max-width: 100%;
    margin: 0 auto;
    text-align: center;
  }
  #img_cont img {
    width: 100%;
    max-width: 400px;
    height: auto;
  }
  .note {
    text-align: center;
    font-family: Armata, sans-serif;
    font-size: 1.5rem;
  }
  .text-blue {
    color: #007BFF;
  }
  .content {
    padding: 20px;
  }
  .info-box {
    padding: 20px;
    border-radius: 8px;
    background-color: #f8f9fa;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }
  .align-items-center {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
  }
  .col-md-4,
  .col-md-8 {
    flex: 0 0 100%;
    max-width: 100%;
    text-align: center;
  }
  @media (min-width: 768px) {
    .col-md-4 {
      flex: 0 0 33.333%;
      max-width: 33.333%;
    }
    .col-md-8 {
      flex: 0 0 66.666%;
      max-width: 66.666%;
      text-align: left;
    }
  }
</style>
<section class="content">
  <div class="container-fluid">
  <div class="">
    <div class="pd-ltr-20">
      <div class="info-box pd-20 height-1400-p mb-30">
        <div class="row align-items-center">
          <div class="col-md-4 user-icon" id="img_cont">
            <img src="../../images/logo.jpg" alt="Logo">
          </div>
          <div class="col-md-8">
            <?php $query= mysqli_query($conn, "select * from users where user_code = '$session_id'") or die(mysqli_error());
              $row = mysqli_fetch_array($query);
            ?>
            <div class="note">
              Welcome back, 
              <div class="text-blue">
                <strong><?php echo $row['firstname'] . " " . $row['lastname']; ?>!</strong>
              </div>
            </div>
            <p class="font-18 max-width-600 note">
              We're delighted to see you again.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
