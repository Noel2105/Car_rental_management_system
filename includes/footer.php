<?php
if(isset($_POST['emailsubscibe']))
{
$subscriberemail=$_POST['subscriberemail'];
$sql ="SELECT sub_email FROM subscribers WHERE sub_email=:subscriberemail";
$query= $dbh -> prepare($sql);
$query-> bindParam(':subscriberemail', $subscriberemail, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query -> rowCount() > 0)
{
echo "<script>alert('Already Subscribed.');</script>";
}
else{
  $sql1 ="SELECT email_id FROM users WHERE email_id=:subscriberemail";
  $query1= $dbh -> prepare($sql1);
  $query1-> bindParam(':subscriberemail', $subscriberemail, PDO::PARAM_STR);
  $query1-> execute();
  $results1 = $query1 -> fetchAll(PDO::FETCH_OBJ);
  if($query1 -> rowCount() == 0)
  {
  echo "<script>alert('Users doesnt exists');</script>";
  }
  else{
$sql2="INSERT INTO  subscribers(sub_email) VALUES(:subscriberemail)";
$query2 = $dbh->prepare($sql2);
$query2->bindParam(':subscriberemail',$subscriberemail,PDO::PARAM_STR);
$query2->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Subscribed successfully.');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
}
}
?>

<footer>
  <div class="footer-top" style="margin-top:10vh;margin-bottom:10px;background-color:lightcyan;border-radius:30px;border-top:2px solid black;">
    <div class="container">
      <div class="row">     
        <div class="col-md-6" style="margin-top:15px;color:purple;">
          <u><h4>About Us</h4></u>
          <ul>
            <li>KAR'O'BAR.Co<br></li><li>JK & ASSOCIATES,DALHOUSIE,HP</li>
          </ul>
          <a href="admin/">Admin Login</a>
        </div>
        <div class="col-md-3 col-sm-6">
          <u><h4>Subscribe Newsletter</h4></u>
          <div class="newsletter-form">
            <form method="post">
              <div class="form-group">
                <input type="email" name="subscriberemail" class="form-control newsletter-input" required placeholder="Enter Email Address" />
              </div>
              <button type="submit" name="emailsubscibe" class="btn btn-block">Subscribe <span class="angle_arrow"><i class="fa fa-angle-right" aria-hidden="true"></i></span></button>
            </form>
            <p class="subscribed-text">Know about our great deals and latest auto news by subscribing us.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>