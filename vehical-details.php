<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$fromdate=$_POST['fromdate'];
$todate=$_POST['todate'];
$useremail=$_SESSION['login'];
$status=0;
$vhid=$_GET['vhid'];
$sql="INSERT INTO booking(usr_email,vehicle_id,from_date,to_date,status) VALUES(:useremail,:vhid,:fromdate,:todate,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
$query->bindParam(':vhid',$vhid,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking successfull.');</script>";
echo "<script type='text/javascript'> document.location = 'my-booking.php'; </script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
 echo "<script type='text/javascript'> document.location = 'car-listing.php'; </script>";
} 
}?>

<!DOCTYPE HTML>
<html lang="en">
<head>

<title>Car Rental | Vehicle Details</title>
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
</head>
<body style="background-color:teal">
<?php include('includes/header.php');?>
<?php 
$vhid=intval($_GET['vhid']);
$sql = "SELECT * from vehicles_list where vehicle_id=:vhid";
$query = $dbh -> prepare($sql);
$query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
switch($result->vehicle_id)
{
  case 1:echo '<center><img src="assets/images/thar.jpg" class="img-responsive" alt="image" style="width:900px;height:560px;border-radius:20px;margin:30px"></center>';
          break;
  case 2:echo '<center><img src="assets/images/bmw5series.jpg" class="img-responsive" alt="image" style="width:900px;height:560px;border-radius:20px;margin:30px"></center>';
         break;
  case 3:echo '<center><img src="assets/images/audiq8.jpg" class="img-responsive" alt="image" style="width:900px;height:560px;border-radius:20px;margin:30px"></center>';
         break;
  case 4:echo '<center><img src="assets/images/fortuner.jpg" class="img-responsive" alt="image" style="width:900px;height:560px;border-radius:20px;margin:30px"></center>';
         break; 
  case 5:echo '<center><img src="assets/images/nano.jpg" class="img-responsive" alt="image" style="width:900px;height:560px;border-radius:20px;margin:30px"></center>';
         break;
  case 6:echo '<center><img src="assets/images/wagonr.jpg" class="img-responsive" alt="image" style="width=900px;height:560px;border-radius:20px;margin:30px"></center>';
         break;
  default:echo '<center><img src="assets/images/default.jpg" class="img-responsive" alt="image" style="width:900px;height:560px;border-radius:20px;margin:30px"></center>';
          break;      
}?>
<section style="display:flex;justify-content:space-around;">
  <div>
      <div style="color:white">
        <span style="font-size:50px;padding:20px;"><b><?php echo htmlentities($result->vehicle_title);?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;---&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span style="font-size:30px"> Rs. <?php echo htmlentities($result->price_per_day);?> Per Day</br></span>
      </div>
    <div >
          <ul style="color:white">
            <li> 
              <h5><?php echo htmlentities($result->model_year);?></h5>
              <p>Reg.Year</p>
            </li>
            <li> 
              <h5><?php echo htmlentities($result->fuel_type);?></h5>
              <p>Fuel Type</p>
            </li>
            <li>
              <h5><?php echo htmlentities($result->seating_capacity);?></h5>
              <p>Seats</p>
            </li>
          </ul>
    </div>
  </div>
<?php }} ?>
      <aside style="margin-right:30px;">
          <div style="margin-top:70px;">
            <h4 style="color:white;"><u>Book Now</u></h4>
          </div>
          <form method="post" >
            <div style="margin-top:20px">
              <label style="color:white;">From Date:</label>
              <input type="date"  name="fromdate" placeholder="From Date" required>
            </div>
            <div style="margin-top:20px">
              <label style="color:white;">To Date:</label>
              <input type="date"  name="todate" placeholder="To Date" required>
            </div>
          <?php if($_SESSION['login'])
              {?>
              <div class="form-group" style="margin-top:20px">
                <input type="submit" class="btn"  name="submit" value="Book Now">
              </div>
              <?php } else { ?>
<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal"><div style="border:1px solid black;padding:3px;text-align:center;margin-top:20px;background-color:beige;">Login For Book</div></a>
              <?php } ?>
          </form>
      </aside>
      </section>
<?php include('includes/footer.php');?>
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<?php include('includes/login.php');?>
<?php include('includes/registration.php');?>
<?php include('includes/forgotpassword.php');?>

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>