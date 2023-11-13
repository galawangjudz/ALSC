
<?php 
$usertype = $_settings->userdata('user_type'); 
$level = $_settings->userdata('type'); 
$session_id = $_settings->userdata('user_code');
?>

<section class="content">
    <div class="container-fluid">
      
      <div class="">
        <div class="pd-ltr-20">
          <div class="info-box pd-20 height-1400-p mb-30">
            <div class="row align-items-center">
              <div class="col-md-4 user-icon">
                <img src="../vendors/images/banner-img.png" alt="">
              </div>
              <div class="col-md-8">

                <?php $query= mysqli_query($conn,"select * from users where id = '$session_id'")or die(mysqli_error());
                    $row = mysqli_fetch_array($query);
                ?>

                <h4 class="font-20 weight-500 mb-10 text-capitalize">
                  Welcome back <div class="weight-600 font-30 text-blue"><?php echo $row['firstname']. " " .$row['lastname']; ?>,</div>
                </h4>
                <p class="font-18 max-width-600"> We're delighted to see you again.</p>
              </div>
            </div>
          </div>
          
        </div>
  </div>
</section>
