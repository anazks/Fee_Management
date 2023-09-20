<?php session_start(); ?>

<!DOCTYPE html>

<html>
<head>
<title></title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

</head>

<body>

<?php 

if (isset($_SESSION['adminid_session']) && !empty($_SESSION['adminid_session']))
{
	session_destroy();
	echo "<script>window.location.href='Login.php?logintype=admin'</script>";
}
else if(isset($_SESSION['sid_session']) && !empty($_SESSION['sid_session']))
{
	session_destroy();
	echo "<script>window.location.href='Login.php?logintype=student'</script>";
}

?>


</body>
</html>
