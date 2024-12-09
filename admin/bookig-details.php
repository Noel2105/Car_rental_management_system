<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
{
$eid=intval($_GET['eid']);
$status="2";
$sql = "UPDATE booking SET status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();
  echo "<script>alert('Booking Successfully Cancelled');</script>";
	echo "<script type='text/javascript'> document.location = 'canceled-bookings.php; </script>";
}
if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;
$sql = "UPDATE booking SET status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();
echo "<script>alert('Booking Successfully Confirmed');</script>";
echo "<script type='text/javascript'> document.location = 'confirmed-bookings.php'; </script>";
}?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">	
	<title>Car Rental Portal | New Bookings</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>
</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
		<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h2 class="page-title">Booking Details</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Bookings Info</div>
							<div class="panel-body">
<div id="print">
								<table border="1"  class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%"  >				
									<tbody>
									<?php 
$bid=intval($_GET['bid']);
$sql = "SELECT users.*,vehicles_list.vehicle_title,booking.from_date,booking.to_date,booking.vehicle_id,booking.status,booking.id,DATEDIFF(booking.to_date,booking.from_date) as totalnodays,vehicles_list.price_per_day from booking join vehicles_list on vehicles_list.vehicle_id=booking.vehicle_id join users on users.email_id=booking.usr_email where booking.id=:bid";
$query = $dbh -> prepare($sql);
$query -> bindParam(':bid',$bid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{?>	
	<h3 style="text-align:center; color:red">USER_NAME: <?php echo htmlentities($result->full_name);?></h3>
		<tr>
											<th colspan="4" style="text-align:center;color:blue">User Details</th>
										</tr>
										<tr>
											<th>Name</th>
											<td><?php echo htmlentities($result->full_name);?></td>
										</tr>
										<tr>											
											<th>Email Id</th>
											<td><?php echo htmlentities($result->email_id);?></td>
											<th>Contact No</th>
											<td><?php echo htmlentities($result->contact_no);?></td>
										</tr>
											<tr>											
											<th>Address</th>
											<td><?php echo htmlentities($result->address);?></td>
										</tr>

										<tr>
											<th colspan="4" style="text-align:center;color:blue">Booking Details</th>
										</tr>
											<tr>											
											<th>Vehicle Name</th>
											<td><a href="edit-vehicle.php?id=<?php echo htmlentities($result->vehicle_id);?>"><?php echo htmlentities($result->vehicle_title);?></td>
											<th>Booking No.</th>
											<td><?php echo htmlentities($result->id);?></td>
										</tr>
										<tr>
											<th>From Date</th>
											<td><?php echo htmlentities($result->from_date);?></td>
											<th>To Date</th>
											<td><?php echo htmlentities($result->to_date);?></td>
										</tr>
<tr>
	<th>Total Days</th>
	<td><?php echo htmlentities($tdays=$result->totalnodays);?></td>
	<th>Rent Per Days</th>
	<td><?php echo htmlentities($ppdays=$result->price_per_day);?></td>
</tr>
<tr>
	<th colspan="3" style="text-align:center">Grand Total</th>
	<td><?php echo htmlentities($tdays*$ppdays);?></td>
</tr>
<tr>
<th>Booking status</th>
<td><?php 
if($result->status==0)
{
echo htmlentities('Not Confirmed yet');
} else if ($result->status==1) {
echo htmlentities('Confirmed');
}
 else{
 	echo htmlentities('Cancelled');
 }
										?></td>
									</tr>
									<?php if($result->status==0){ ?>
										<tr>	
										<td style="text-align:center" colspan="4">
				<a href="bookig-details.php?aeid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Confirm this booking')" class="btn btn-primary"> Confirm Booking</a> 
<a href="bookig-details.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Cancel this Booking')" class="btn btn-danger"> Cancel Booking</a>
</td>
</tr>
<?php } ?>
										<?php $cnt=$cnt+1; }} ?>
									</tbody>
								</table>
								<form method="post">
	   <input name="Submit2" type="submit" class="txtbox4" value="Print" onClick="return f3();" style="cursor: pointer;"  />
	</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
	<script language="javascript" type="text/javascript">

function f3()
{
window.print(); 
}
</script>
</body>
</html>
<?php } ?>
