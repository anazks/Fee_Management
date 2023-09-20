<?php
include("connection.php");
?>

<!DOCTYPE html>
<html>
<head>
<title>Online College Fee Payment</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"/>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>

<div class="sticky">

<nav class="navbar navbar-expand-lg navbar-dark fixed-top" style="background-color:#c04545;">
  <a class="navbar-brand" href="#" style="font-size: 24px;">Online College Fee Payment</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
    <ul class="navbar-nav">
	  <li class="nav-item">
        <a class="nav-link ones" href="ManageCourse.php">Manage Course</a>
      </li>	
	 <li class="nav-item dropdown">
		  <a class="nav-link dropdown-toggle ones1" href="#" id="navbardrop" data-toggle="dropdown">
			Student
		  </a>
		<div class="dropdown-menu">
			<a class="dropdown-item" href="AddStudents.php">Add Students</a>
			<a class="dropdown-item" href="ManageStudents.php">View/Update Students</a>			
		</div>
	  </li>	  	 
	  <li class="nav-item">
        <a class="nav-link" href="ViewFees.php">View Fees</a>
      </li>
	  <li class="nav-item">
        <a class="nav-link" href="Logout.php"><span class="fa fa-sign-in"></span> Logout</a>
      </li>
    </ul>
  </div>
</nav>