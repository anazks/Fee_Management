<?php session_start();
include('StudentHeader.php');

$val = !empty($_SESSION["sid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?logintype=student'</script>";
}
$sid_session = $_SESSION["sid_session"];

$sel="Select Name,Dob,MobileNo,EmailId,Address,City,Course,Batch,College_University,Fees from student where SId='".$sid_session."'";
$rel=$con->query($sel);
$data = mysqli_fetch_assoc($rel);

$name = $data['Name'];
$mob = $data['MobileNo'];
$dob = $data['Dob'];
$emailid = $data['EmailId'];
$address = $data['Address'];
$city = $data['City'];
$course = $data['Course'];
$batch = $data['Batch'];
$college_university = $data['College_University'];
$fees = $data['Fees'];

?>

<div class="container" style="margin-top: 7%; margin-bottom:3%;">

	<div class="card_profile">
	  <img src="https://cdn5.vectorstock.com/i/1000x1000/52/54/male-student-graduation-avatar-profile-vector-12055254.jpg" alt="John" class="img-responsive" style="width:120px; margin:auto;">
	  
	  <h2><?php echo $name ?></h2><br/>
	  
	  <label><i class="fa fa-birthday-cake"></i> <?php echo $dob ?></label><br/>
	  <label><i class="fa fa-phone"></i> <?php echo $mob ?></label><br/>
	  <label><i class="fa fa-envelope"></i> <?php echo $emailid ?></label><br/>
	  <p><i class="fa fa-address-card"></i> <?php echo $address ?></p><br/>
	  <label><i class="fa fa-map-marker"></i> <?php echo $city ?></label><br/>
	  
	  <hr/>
	  
	  <label><b>Course:</b> <?php echo $course ?></label><br/>

	  <label><b>College/University Name:</b> <?php echo $college_university ?></label><br/>
	  <label><b>Fees:</b> <?php echo $fees ?></label>
	  
</div>

</div>

<?php 

include('Footer.php')

?>
