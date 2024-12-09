<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Car Rental Portal | Canceled Bookings   </title>
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
						<h2 class="page-title">Cancelled Bookings</h2>
						<div class="panel panel-default">
							<div class="panel-heading">Bookings Info</div>
							<div class="panel-body">
								<table class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Name</th>
											<th>Booking No.</th>
											<th>Vehicle</th>
											<th>From Date</th>
											<th>To Date</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
<?php 
$status=2;
$sql = "SELECT users.full_name,vehicles_list.vehicle_title,booking.from_date,booking.to_date,booking.vehicle_id,booking.status,booking.id  from booking join vehicles_list on vehicles_list.vehicle_id=booking.vehicle_id join users on users.email_id=booking.usr_email where booking.status=:status";
$query = $dbh -> prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->full_name);?></td>
											<td><?php echo htmlentities($result->id);?></td>
											<td><a href="edit-vehicle.php?id=<?php echo htmlentities($result->vehicle_id);?>"><?php echo htmlentities($result->vehicle_title);?></td>
											<td><?php echo htmlentities($result->from_date);?></td>
											<td><?php echo htmlentities($result->to_date);?></td>
										<td>
<a href="bookig-details.php?bid=<?php echo htmlentities($result->id);?>"> View</a>
</td>
										</tr>
										<?php $cnt=$cnt+1; }} ?>
									</tbody>
								</table>
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
</body>
</html>
<?php } ?>
