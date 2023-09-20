<?php session_start();
include('AdminHeader.php');

$val = !empty($_SESSION["adminid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?logintype=admin'</script>";
}
$adminid_session = $_SESSION["adminid_session"];

$sel1 = "select max(sid) as sid,count(sid) as noOfsid from student";
$rel1=$con->query($sel1);
$data1=mysqli_fetch_array($rel1);
$sid_data1 = $data1['sid'];
$noOfsid = $data1['noOfsid'];

?>


<div class="container" style="margin-top:7%;">

<form method="POST" id="myform">

<div class="row">
	<div class="col-md-8 mb-5 mx-auto">
	
		<div class="card">
		<div class="card-header"><b>Add Student</b></div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Course ID: </label>
						
						<?php
						
						if($noOfsid == 0){
						?>	
						<input type="text" class="form-control" value="ST-1" readonly />		

						<?php						
						}
						else{
						$sid_arr = explode('-',$sid_data1);
						$sid_val = $sid_arr[1] + 1;	
						$sid = 'BCA-'.$sid_val;
							
						?>
						<input type="text" class="form-control" value="<?php echo $sid ?>" />	
						
						<?php
							
						}	
						
						?>
																
					</div>
				</div>         
			</div>	
		
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Student Name: </label>
						<input type="text" name="txtbx_student" class="form-control txtOnly" placeholder="Enter Student Name" />						
					</div>
				</div>         
			</div>
			
			
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">					
						<label>Date Of Birth: </label>
						<input type="text" class="form-control select_date" placeholder="Select Date Of Birth" name="txtbx_dob">						
					</div>
				</div>
			</div>			
		
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Student Mobile No.: </label>
						<input type="number" name="txtbx_mob" class="form-control" placeholder="Enter Mobile No." />						
					</div>
				</div>         
			</div>
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Student Email ID: </label>
						<input type="email" name="txtbx_emailid" class="form-control" placeholder="Enter Email ID" />						
					</div>
				</div>         
			</div>	
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Address: </label>
						<textarea name="txtarea_addr" rows="4" placeholder="Enter Address" class="form-control"></textarea>					
					</div>
				</div>         
			</div>	
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>City: </label>
						<input type="text" name="txtbx_city" class="form-control" placeholder="Enter City" />						
					</div>
				</div>         
			</div>
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Select Course: </label>
						<select id="selc_course" name="dd_course" class="form-control" onchange="onChange();">							
						<?php
						
							$sel="Select Distinct CId,Course from Course";
							$rel=$con->query($sel);

							if(mysqli_num_rows($rel)==0)
							{
							     echo "<option value='nodata'>--No records to display--</option>";
							}
							else
							{
								echo'<option value="--Select Course--">--Select Course--</option>';
							      while($data=mysqli_fetch_array($rel))
							      {                            
							            echo "<option value='".$data['CId']."'>".$data['Course']."</option>";						             
							      }
							}
							
						?>
						
					</select>	
					
					<input type="hidden" id="hidd_course" name="hidd_coursetxt"/>
											
					</div>
				</div>         
			</div>
			
			<div id="txtHint">					
			</div>			
					
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>College/University : </label>
						<input type="text" name="txtbx_college" class="form-control" placeholder="Enter College/University Name" />						
					</div>
				</div>         
			</div>
		
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Fee Type: <span style="font-weight:bold; font-size:18px;">Yearly</span></label>										
					</div>
				</div>         
			</div>
						
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Fees: </label>
						<input type="number" name="txtbx_fees" class="form-control number" placeholder="Enter Fees" />						
					</div>
				</div>         
			</div>
			
			<input type="hidden" id="hidd_batch" name="hidd_batchtxt" value="" />
							
		</div>
		
		<div class="card-footer text-center"><button type="submit" name="btn_submit" class="btn btn-success">Submit</button></div>
		
	  </div>
  
	 </div>
	</div>
	
</form>
	
</div>


<?php 

if(isset($_POST['btn_submit']))
{	
	$txtbx_student = mysqli_real_escape_string($con,$_POST['txtbx_student']);
	$txtbx_mob = mysqli_real_escape_string($con,$_POST['txtbx_mob']);
	$txtbx_emailid = mysqli_real_escape_string($con,$_POST['txtbx_emailid']);
	$txtarea_addr = mysqli_real_escape_string($con,$_POST['txtarea_addr']);
	$txtbx_city = mysqli_real_escape_string($con,$_POST['txtbx_city']);
	$hidd_coursetxt = mysqli_real_escape_string($con,$_POST['hidd_coursetxt']);
	$txtbx_college = mysqli_real_escape_string($con,$_POST['txtbx_college']);
	$txtbx_dob = mysqli_real_escape_string($con,$_POST['txtbx_dob']);
	$hidd_batchtxt = mysqli_real_escape_string($con,$_POST['hidd_batchtxt']);
	$txtbx_fees = mysqli_real_escape_string($con,$_POST['txtbx_fees']);
	
	
	$var="select max(sid) as sid from student";
	$res_var=$con->query($var);
	$row = mysqli_fetch_assoc($res_var);
	$sid_row = $row['sid'];	
	if(!empty($sid_row))
	{
		$sid_arr = explode('-',$sid_row);
		$sid_val = $sid_arr[1] + 1;	
		$sid = 'ST-'.$sid_val;
	}
	else
	{		
		$sid = 'ST-1';						
	}
	
	$sel1 = "select emailid from student where emailid='".$txtbx_emailid."'";
	$rel1=$con->query($sel1);	
	$data1=mysqli_fetch_assoc($rel1);	
	print_r($data1);
	$emailid_data = $data1['emailid'];
			
	if($txtbx_emailid==$emailid_data)
	{
		echo "<script>alert('This Email ID is already added');</script>";
	}
	else{
		
		if($_POST['dd_course'] == "nodata"){
			echo "<script>alert('Please Add Course');</script>";
		}
		else if($_POST['hidd_batchtxt'] == "nodata"){
			echo "<script>alert('Please Select Batch');</script>";
		}
		else{
			
			$insert = "Insert into student(sid,name,dob,mobileno,emailid,address,city
			,course,batch,college_university,fees) values('$sid','$txtbx_student','$txtbx_dob','$txtbx_mob','$txtbx_emailid','$txtarea_addr','$txtbx_city','$hidd_coursetxt','$hidd_batchtxt','$txtbx_college','$txtbx_fees')";
			
			if(mysqli_query($con, $insert))
			{
				echo "<script>alert('Student Added Successfully');</script>";
				echo "<script>window.location.href='ManageStudents.php'</script>";			
			}	
			else
			{
				echo "<script>alert('Invalid');</script>";
			}
			
		}	
		
		
		
	}
		
}

include('Footer.php')

?>


<script type="text/javascript">

$( ".txtOnly" ).keypress(function(e) {
    var key = e.keyCode;
    if (key >= 48 && key <= 57) {
        e.preventDefault();
    }
 });
 
 $(".select_date").datepicker({
    dateFormat: "yy-mm-dd",
});

 $(".select_date").keypress(function (evt) {
       evt.preventDefault();
  });
  

	$(function()
    {
		 $.validator.addMethod("val_course", function(value, element, arg){
		  return arg !== value;
		 },);
		 
		 $.validator.addMethod("val_batch", function(value, element, arg){
		  return arg !== value;
		 },);
		 
		 
		$("#myform").validate({ 		
		
			rules: { 
			txtbx_student : "required",
			txtbx_dob: "required",
			txtbx_mob: {
			  required:true,
			  number:true,
			  maxlength:10,
			  minlength:10
			},
			txtbx_emailid : "required",
			txtarea_addr : "required",
			txtbx_city : "required",
			dd_course: { val_course: "--Select Course--" },
			dd_batch: { val_batch: "--Select Batch--" },
			txtbx_city : "required",
			txtbx_college: "required",			
			txtbx_fees: "required",
			},		
			messages: {
				
				txtbx_student:"<h5>Please Enter Student Name</h5>",
				txtbx_dob: "<h5>Please Select Date Of Birth</h5>",
				txtbx_mob:"<h5>Please Enter Mobile No.</h5>",
				txtbx_emailid:"<h5>Please Enter Email ID</h5>",
				txtarea_addr:"<h5>Please Enter Address</h5>",
				txtbx_city :"<h5>Please Enter City</h5>",
				dd_course: { val_course: "<h5>Please Select Course</h5>" },
				dd_batch: { val_batch: "<h5>Please Select Batch</h5>" },
				txtbx_college:"<h5>College Name Name</h5>",
				txtbx_fees:"<h5>Please Enter Fees</h5>",
				
				}
				
			});
			
	});
	

	
 function onChange(){
	
	var id = $('#selc_course').find(":selected").val();
	var text = $('#selc_course').find(":selected").text();
	
	$("#hidd_course").val(text);

	$.ajax({
	  type: "POST",
	  url: "viewbatches.php",
	  dataType: "json",
	  data:{id:id},
	  success: function(data){
		  
		  
		  var html = '';
		  $("#txtHint").empty();
		  
		   html += "<div class='row'><div class='col-md-12 col-lg-12'><div class='form-group'><label>Select Batch: </label><select id='selc_batch' name='hidd_batchtxt' class='form-control'>";
		  
		  if(data[0].Batch == null || data[0].Batch == ""){
			  
			html += '<option value="nodata">--No records to display--</option>';
			$("#hidd_batch").val("nodata");
		  }
		  else{
			 			
			html +="<option>--Select Batch--</option>";
		  
			  $.each(data,function(key, val){
				
				html += '<option>'+val.Batch+'</option>';
									
			});
			  			  
		  }

		 html += "</select></div></div></div>";
		  		  
		 $("#txtHint").append(html);
			
	  }
	  
	});	

}

$(document).on("change","#selc_batch",function() {
     var batchval = $(this).find(":selected").text();   
	 $("#hidd_batch").val(batchval);
});
	
		
		
</script>

</body>
</html>