<?php
include("connection.php");

$sid = $_POST['id'];

$sel = "Select name,mobileno,emailid,dob,address,city,college_university,course,batch,fees from student  where sid='".$sid."'";
$rel=$con->query($sel);
while($data=mysqli_fetch_array($rel))
{
	/*$output['name'] = $data['name'];
	$output['mobileno'] = $data['mobileno'];
	$output['emailid'] = $data['emailid'];
	$output['dob'] = $data['dob'];	
	$output['address'] = $data['address'];	
	$output['city'] = $data['city'];
	$output['college_university'] = $data['college_university'];
	$output['course'] = $data['course'];
	$output['batch'] = $data['batch'];
	$output['fees'] = $data['fees'];*/

	//$output1[][0] = $output;	
	
	$data1[] = $data;
}


$sel1 = "select Distinct CId,Course from Course";
$rel1=$con->query($sel1);
while($data3=mysqli_fetch_array($rel1))
{
	/*$output_c['cid']= $data1['CId'];
	$output_c['course']= $data1['Course'];	
	$output1[][1] = $output_c;*/
	
	$data2[] = $data3;
}  

echo json_encode(array($data1,$data2));  
     
?>