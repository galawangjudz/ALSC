
<?php 
$usertype = $_settings->userdata('user_type'); 
$level = $_settings->userdata('type'); 
$session_id = $_settings->userdata('user_code');
?>
<style>
  #img_cont{
    height:auto;
    width:400px;
    margin-right:-40px;
  }
</style>
<section class="content">
    <div class="container-fluid">
      
      <div class="">
        <div class="pd-ltr-20">
          <div class="info-box pd-20 height-1400-p mb-30">
            <div class="row align-items-center">
              <div class="col-md-4 user-icon" id="img_cont">
                <img src="../images/logo.jpg" alt="">
              </div>
              <div class="col-md-8">

                <?php $query= mysqli_query($conn,"select * from users where user_code = '$session_id'")or die(mysqli_error());
                    $row = mysqli_fetch_array($query);
                ?>

                <div style="font-family: Armata; font-size: 25px;">
                    Welcome back, <div class="text-blue"><strong><?php echo $row['firstname'] . " " . $row['lastname']; ?>!</strong></div>
                </div>
                <p class="font-18 max-width-600"> We're delighted to see you again.</p>
              </div>
            </div>
          </div>
          
        </div>
  </div>
</section>
