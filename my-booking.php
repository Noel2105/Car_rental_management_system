<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
?><!DOCTYPE HTML>
<html lang="en">
<head>
<title>Car Rental Portal - My Booking</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<style>
  th,td{
    border:1px solid black;
    text-align:center;
    height:20px;
    padding:5px;
  }
</style>
</head>
<body style="background-color:teal;">
<?php include('includes/header.php');?>
<section class="page-header profile_page" style="color:white">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1>My Booking</h1>
      </div>
</section>
<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT * from users where email_id=:useremail ";
$query = $dbh -> prepare($sql);
$query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<section class="user_profile inner_pages" style="background-color:honeydew;">
  <div class="container">
    <div class="user_profile_info gray-bg padding_4x4_40">
      <div class="upload_user_logo">
      </div>
      <div class="dealer_info">
        <h3>User name : <?php echo htmlentities($result->full_name);?></h3>
        <p>Address: <?php echo htmlentities($result->address);?><br></p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-3">
       <?php include('includes/sidebar.php');?>
      <div class="col-md-8 col-sm-8">
        <div >
          <div class="my_vehicles_list">
            <ol class="vehicle_listing">
<?php 
$useremail=$_SESSION['login'];
 $sql = "SELECT vehicles_list.vehicle_title,vehicles_list.vehicle_id,booking.from_date,booking.to_date,booking.status,vehicles_list.price_per_day,DATEDIFF(booking.to_date,booking.from_date) as totaldays,booking.id from booking join vehicles_list on booking.vehicle_id=vehicles_list.vehicle_id where booking.usr_email=:useremail order by booking.id desc";
$query = $dbh -> prepare($sql);
$query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ ?>
<li>
      <div class="vehicle_img"> <a href="vehical-details.php?vhid=<php echo htmlentities($result->vehicle_id);?>"></a> </div> -->
                <div class="vehicle_title">
                  <u><h4><a href="vehical-details.php?vhid=<?php echo htmlentities($result->vehicle_id);?>"> <?php echo htmlentities($result->vehicle_title);?></a></h4></u>
                  <p><b>From &nbsp;&nbsp;&nbsp;&nbsp;</b> <?php echo htmlentities($result->from_date);?> &nbsp;&nbsp;&nbsp;<b>To </b> &nbsp;&nbsp;&nbsp;<?php echo htmlentities($result->to_date);?></p>
                </div>
                <?php if($result->status==1)
                { ?>
                <div class="vehicle_status"><b>Status : &nbsp;</b>Confirmed
        </div>
      <?php } else if($result->status==2) { ?>
 <div class="vehicle_status"> <b>Status : &nbsp;</b>Cancelled     
        </div>
      <?php } else { ?>
 <div class="vehicle_status"><b>Status : &nbsp;</b>Not Confirm yet
        </div>
                <?php } ?>
              </li>
<h4 style="color:green">Invoice</h4>
<table>
  <tr>
    <th>Car Name</th>
    <th>From Date</th>
    <th>To Date</th>
    <th>Total Days</th>
    <th>Rent / Day</th>
  </tr>
  <tr>
    <td><?php echo htmlentities($result->vehicle_title);?></td>
     <td><?php echo htmlentities($result->from_date);?></td>
      <td> <?php echo htmlentities($result->to_date);?></td>
       <td><?php echo htmlentities($tds=$result->totaldays);?></td>
        <td> <?php echo htmlentities($ppd=$result->price_per_day);?></td>
  </tr>
  <tr>
    <th colspan="4" style="text-align:center;"> Grand Total</th>
    <th><?php echo htmlentities($tds*$ppd);?></th>
  </tr>
</table>
<hr style="border:2px solid black;"/>
              <?php }}  else { ?>
                <h5 align="center" style="color:red">No booking yet</h5>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> 
<?php include('includes/footer.php');?>
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
<?php }}} ?>