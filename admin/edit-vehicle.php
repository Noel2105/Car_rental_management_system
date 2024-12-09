<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {
$vehicletitle=$_POST['vehicletitle'];
$priceperday=$_POST['priceperday'];
$fueltype=$_POST['fueltype'];
$modelyear=$_POST['modelyear'];
$seatingcapacity=$_POST['seatingcapacity'];
$id=intval($_GET['id']);
$sql="update vehicles_list set vehicle_title=:vehicletitle,price_per_day=:priceperday,fuel_type=:fueltype,model_year=:modelyear,seating_capacity=:seatingcapacity where vehicle_id=:id ";
$query = $dbh->prepare($sql);
$query->bindParam(':vehicletitle',$vehicletitle,PDO::PARAM_STR);
$query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
$query->bindParam(':fueltype',$fueltype,PDO::PARAM_STR);
$query->bindParam(':modelyear',$modelyear,PDO::PARAM_STR);
$query->bindParam(':seatingcapacity',$seatingcapacity,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$msg="Data updated successfully";
}?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="theme-color" content="#3e454c">	
	<title>Car Rental Portal | Admin Edit Vehicle Info</title>
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
						<h2 class="page-title">Edit Vehicle</h2>
						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<div class="panel-body">
<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
<?php 
$id=intval($_GET['id']);
$sql ="SELECT * from vehicles_list where vehicle_id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{?>
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Vehicle Title<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="vehicletitle" class="form-control" value="<?php echo htmlentities($result->vehicle_title)?>" required>									
<div class="hr-dashed"></div>

<div class="form-group">
<label class="col-sm-2 control-label">Price Per Day(in USD)<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="priceperday" class="form-control" value="<?php echo htmlentities($result->price_per_day);?>" style="margin-top:20px" required>
</div>
<label class="col-sm-2 control-label">Select Fuel Type<span style="color:red">*</span></label>
<div class="col-sm-4">
<select name="fueltype" style="margin-top:35px" required>
<option value="Petrol">Petrol</option>
<option value="Diesel">Diesel</option>
<option value="CNG">CNG</option>
</select>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Model Year<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="modelyear" class="form-control" value="<?php echo htmlentities($result->model_year);?>" required>
</div>
<label class="col-sm-2 control-label">Seating Capacity<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="seatingcapacity" class="form-control" value="<?php echo htmlentities($result->seating_capacity);?>" required>
</div>
</div>
<div class="hr-dashed"></div>
</div>
</div>
<?php }} ?>
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2" >
<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
												</div>
											</div>
										</form>
									</div>
								</div>
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