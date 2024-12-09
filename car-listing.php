<?php 
session_start();
include('includes/config.php');
error_reporting(0);
?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Car Rental Portal | Car Listing</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
</head>
<body style="background-color:teal">
<?php include('includes/header.php');?>
<section> 
<?php
$sql = "SELECT vehicle_id from vehicles_list";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=$query->rowCount();
?>
<p  style="text-align:center;font-size:20px;color:white"><b><u><span><?php echo htmlentities($cnt);?> Listings</span></u></b></p>
<div style="display:flex;justify-content:space-around;">
<?php $sql = "SELECT * from vehicles_list";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>  
       <div style="border: 2px dashed black;border-radius:20% 20% 20% 20%;padding:20px;background-color:cornsilk;margin-top:20px;width:15%">          
            <center><u><h4><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vehicle_id);?>" style="color:purple"> <?php echo htmlentities($result->vehicle_title);?></a></u></h4>
            <p class="list-price">Rs. <?php echo htmlentities($result->price_per_day);?> Per Day</p></center>
            <ul>
              <li><i class="fa fa-user" aria-hidden="true"></i><?php echo htmlentities($result->seating_capacity);?> seats</li>
              <li><i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($result->model_year);?> model</li>
              <li><i class="fa fa-car" aria-hidden="true"></i><?php echo htmlentities($result->fuel_type);?></li>
            </ul>
            <center><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vehicle_id);?>" class="btn">View Details <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></a></center>
          </div>
      <?php }} ?> 
    </div>
  </div>
</section>
<?php include('includes/footer.php');?>
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<?php include('includes/login.php');?>
<?php include('includes/registration.php');?>
<?php include('includes/forgotpassword.php');?>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>
</body>
</html>