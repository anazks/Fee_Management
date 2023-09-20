<?php session_start();
include("connection.php");

if($_GET['logintype'] == "admin" || $_GET['logintype'] == "student"){

?>

<!DOCTYPE html>
<html>
<head>
<title>Online College Fee Payment</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css" />


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>

</head>
<style>
	.login{
		margin-top:100px;
		padding:10px;
	}
	.box{
		padding:10px;
	}
	.form{
		padding:10px;
	}
	.form input{
		width:100%;
		margin:auto
	}
	.button-adminlogin{
			background-color:white
			border:none;
	}
</style>

<body style="background: url(https://img.freepik.com/premium-vector/network-connection-background-abstract-style_23-2148875738.jpg); background-repeat: no-repeat; background-size: cover; background-color: #ffffff5e; background-blend-mode: color-burn;">

<div class="container login">
	<div class="row">
		<div class="col-md-5 col-lg-5 mt-4 mb-4 mx-auto bg-white shadow-lg p-3 rounded box">
				<form id="myform" method="POST" class="form">
						<div class="row">
							<div class="col-sm-12">
								<?php
									
								if($_GET['logintype'] == "admin"){
									
								?>									
								<h1 class="h1-formbox">Admin Login</h1>
								<?php
										
								}
								else if($_GET['logintype'] == "student"){
								?>
								<h1 class="h1-formbox">Student Login</h1>
								
								<?php
								}
								?>
								
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox">
								
									<?php
									
									if($_GET['logintype'] == "admin"){
									
									?>
									
									<div class="inputText">Admin Id</div>
									<input type="text" name="txtbx_adminid" class="input">
									
									<?php
										
									}
									else if($_GET['logintype'] == "student"){
									?>
									
									<div class="inputText">Email Id</div>
									<input type="text" name="txtbx_emailid" class="input">
									
									<?php
									}
									?>
									
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-12">
								<div class="inputBox">
									<div class="inputText">Password</div>
									<input type="password" name="txtbx_pswd" class="input">
									
									<?php
									
									if($_GET['logintype'] == "admin"){
									
									?>
									
									<?php
										
									}
									else if($_GET['logintype'] == "student"){
									?>
									<br/><span>Note: Password is your Mobile No.</span>
									<?php
									}
									?>
									
									
									
								</div>
							</div>
						</div>
						
						<div class="row mb-2">
							<div class="col-sm-12">
							
							<?php
									
							if($_GET['logintype'] == "admin"){
									
							?>
							<input type="submit" name="btn_adminlogin" class="button-adminlogin" value="Submit" />
							
							<?php										
							}
							else if($_GET['logintype'] == "student"){
							?>
							<input type="submit" name="btn_studentlogin" class="button-adminlogin" value="Submit" /><br/>
							
							<?php										
							}
							
							?>							
								
							</div>
						</div>
						
						<center style="color: blue; font-weight: bold;"><a href="index.php"> <i class="fa fa-arrow-left"></i> Back To Home</a></center>
												
				</form>
		</div>
	</div>
		
</div>

<?php

if(isset($_POST['btn_adminlogin'])){

	$txtbx_adminid = $_POST['txtbx_adminid'];
	$txtbx_pswd = $_POST['txtbx_pswd'];
	
	$sel = "select adminid from admin where adminid='$txtbx_adminid' and password='$txtbx_pswd'";
	$rel=$con->query($sel);	
		
	if($data=mysqli_fetch_array($rel))
	{
		$adminid = $data['adminid'];
			
		$_SESSION["adminid_session"] = $adminid;
		
		echo "<script>window.location.href='AddStudents.php'</script>";							
	}
	else
	{
		echo "<script>alert('Invalid Login');</script>";
	}
	

}

if(isset($_POST['btn_studentlogin'])){

	$txtbx_emailid = $_POST['txtbx_emailid'];
	$txtbx_pswd = $_POST['txtbx_pswd'];
	
	$sel = "select sid from student where Emailid='$txtbx_emailid' and MobileNo='$txtbx_pswd'";
	$rel=$con->query($sel);	
		
	if($data=mysqli_fetch_array($rel))
	{
		$sid = $data['sid'];
			
		$_SESSION["sid_session"] = $sid;
		
		echo "<script>window.location.href='StudentProfile.php'</script>";							
	}
	else
	{
		echo "<script>alert('Invalid Login');</script>";
	}
	
}

?>
 

<script type="text/javascript">

	$(".input").focus(function() {
		$(this).parent().addClass("focus");
	});
	
	
	$("#myform").validate({
            
            rules:{
				
				<?php
				if($_GET['logintype'] == "admin")
				{
				?>						
				txtbx_adminid: "required",
					
				<?php	 
				}
				else if($_GET['logintype'] == "student"){
				?>
               	txtbx_emailid: "required",
                
				<?php
				}
				?>
				
				txtbx_pswd : "required",				
				
           },

            messages:{
				<?php
				if($_GET['logintype'] == "admin")
				{
				?>					
				txtbx_adminid:"<h5 style='font-size: 15px;'>Please Enter Admin Id</h5>",
				<?php
				}
				else if($_GET['logintype'] == "student"){					
				?>
				txtbx_emailid:"<h5 style='font-size: 15px;'>Please Enter Email Id</h5>",
				<?php 
				}
				?>
                txtbx_pswd:"<h5 style='font-size: 15px;'>Please Enter Password</h5>",
                							
            },

            submitHandler: function(form){
                form.submit();
            }

        });
	
</script>


</body>

</html>


<?php

}
else{
	echo "<script>window.location.href = 'index.php';</script>";
}	

?>