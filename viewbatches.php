<?php
include("connection.php");

$cid = $_POST['id'];

$sel = "select Distinct Batch from Course where CId='$cid'";
$rel=$con->query($sel);
while($data=mysqli_fetch_array($rel))
{
	$data1[] = $data;
} 

echo json_encode($data1);  
     
?>