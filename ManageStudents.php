<?php session_start();
include('AdminHeader.php');

$val = !empty($_SESSION["adminid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?logintype=admin'</script>";
}
$adminid_session = $_SESSION["adminid_session"];

?>


<div class="container-fluid" style="margin-top: 7%;">

    <div class="row" id="searchbox">
        <div class="col-md-6 col-lg-6"> 
			<form method="POST">
				<div class="input-group" style="width: 60%;">
					<input name="search_name" type="text" class="form-control" placeholder="Search Student Name/Email ID/Mobile No.">				
					<div class="input-group-btn">
						<button class="btn btn-primary" name="btn_search" type="submit">
							<i class="fa fa-search" aria-hidden="true" style="font-size: 17px;"></i>
						</button>
					</div>
				</div>
			</form>
		</div>          
    </div>
		
	<div class="row mt-3">
        <div class="col-md-12 col-lg-12 text-center">
		
		 <div class="table-responsive" id="StudentsTableArea">
		   <table id="StudentsTable" class="table table-striped table-bordered table-hover text-center" width="100%">				
				<?php

				if(isset($_POST['btn_search']))
				{
					$sel = "Select SId,Name,Dob,MobileNo,EmailId,Address,City,Course,Batch,College_University,Fees from student where (name like '%".$_POST['search_name']."%' or emailid like '%".$_POST['search_name']."%' or MobileNo like '%".$_POST['search_name']."%')";	
				}
				else
				{
				   $sel = "Select SId,Name,Dob,MobileNo,EmailId,Address,City,Course,Batch,College_University,Fees from student";		   
				}
			
				$rel=$con->query($sel);
				if(mysqli_num_rows($rel)==0)
				{			  
					echo "<center><h4>No records to display</h4></center>
					<script>document.getElementById('searchbox').style.display='none'</script>";
				}
				else
				{
					echo '<script>document.getElementById("searchbox").style.display="block"</script>        <thead style="background-color:grey; color:white;">
					<tr>
					<th>Name</th>
					<th>Date Of Birth</th>	
					<th>Mobile No.</th>	
					<th>Email ID</th>							
					<th>Address</th>				
					<th>City</th>
					<th>Course</th>
					<th>Batch</th>
					<th>State Board/Universiy</th>					
					<th>Fees</th>
					<th>Action</th>
					</tr>
					</thead>

					<tbody>';
						  
					while($data=mysqli_fetch_array($rel))
					{
						$name = $data['Name'];
						$dob = $data['Dob'];
						$mobileno=$data['MobileNo'];							
						$emailid=$data['EmailId'];
						$address=$data['Address'];
						$city = $data['City'];
						$course = $data['Course'];
						$batch = $data['Batch'];
						$College_University = $data['College_University'];
						$fees = $data['Fees'];
						
						echo'<tr>
						<td>'.$name.'</td>
						<td>'.$dob.'</td>
						<td>'.$mobileno.'</td>
						<td>'.$emailid.'</td>
						<td>'.$address.'</td>		
						<td>'.$city.'</td>
						<td>'.$course.'</td>
						<td>'.$batch.'</td>
						<td>'.$College_University.'</td>						
						<td>'.$fees.'</td>
						<td><i class="fa fa-pencil-square-o btn_upd" style="color:green;font-size:30px; cursor:pointer;" id="'.$data['SId'].'"></i></td>							
						</tr>';					
					}
					
					echo'</tbody>';
				}
									
				?>
				
				</table> 
				</div>
				
			</div>
		</div>			
						
</div>


<div class="modal small fade" id="Modal_Upd" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">              
                <h3 class="modal-title">Update Students</h3>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
			
			<form id="myform1" method="post">
            <div class="modal-body">
					
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Student Name: </label>
						<input type="text" name="txtbx_student" class="form-control txtOnly" id="st_name" readonly />						
					</div>
				</div>         
			</div>
			
			
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">					
						<label>Date Of Birth: </label>
						<input type="text" class="form-control select_date" readonly placeholder="Enter Date Of Birth" name="txtbx_dobupd" id="st_dob">						
					</div>
				</div>
			</div>			
		
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Student Mobile No.: </label>
						<input type="number" name="txtbx_mobupd" class="form-control" placeholder="Enter Mobile No." id="st_mob" />						
					</div>
				</div>         
			</div>
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Student Email ID: </label>
						<input type="email" name="txtbx_emailid" class="form-control" id="st_emailid" readonly />						
					</div>
				</div>         
			</div>	
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Address: </label>
						<textarea name="txtarea_addrupd" rows="4" placeholder="Enter Address" class="form-control" id="st_addr"></textarea>					
					</div>
				</div>         
			</div>	
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>City: </label>
						<input type="text" name="txtbx_cityupd" id="st_city" class="form-control" placeholder="Enter City" />						
					</div>
				</div>         
			</div>
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>Course: </label>						
						<select id="selc_course" name="dd_course" class="form-control">	
						
					   </select>
						<input type="hidden" id="dd_courseid" name="dd_courseupd" value="" />
											
					</div>
				</div>         
			</div>
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">						
						<div id="txtHint">
						   <label>Batch: </label>
							<input type="text" name="txtbx_batchupd" id="st_batch" class="form-control" placeholder="Enter Batch" />
						</div>						
						
					</div>
				</div>         
			</div>
			
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="form-group">
						<label>State Board/University Name: </label>
						<input type="text" name="txtbx_collegeupd" id="st_college" class="form-control" placeholder="Enter College/University Name" />						
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
						<input type="number" name="txtbx_feesupd" id="st_fees" class="form-control number" placeholder="Enter Fees" />						
					</div>
				</div>         
			</div>
			
			<input type="hidden" value="" id="sid" name="txtbx_sid"/>
						  
			</div>
			
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button> <input type="submit" name="btn_update" class="btn btn-primary" value="Submit"/>
            </div>
		</form>
      
    </div>
	</div>
</div>	

<?php 

if(isset($_POST['btn_update']))
{		
	$txtbx_mobupd = mysqli_real_escape_string($con,$_POST['txtbx_mobupd']);	
	$txtarea_addrupd = mysqli_real_escape_string($con,$_POST['txtarea_addrupd']);
	$txtbx_cityupd = mysqli_real_escape_string($con,$_POST['txtbx_cityupd']);
	$dd_courseupd = mysqli_real_escape_string($con,$_POST['dd_courseupd']);
	$txtbx_collegeupd = mysqli_real_escape_string($con,$_POST['txtbx_collegeupd']);
	$txtbx_dobupd = mysqli_real_escape_string($con,$_POST['txtbx_dobupd']);
	$txtbx_batchupd = mysqli_real_escape_string($con,$_POST['txtbx_batchupd']);
	$txtbx_feesupd = mysqli_real_escape_string($con,$_POST['txtbx_feesupd']);
	$txtbx_sid = mysqli_real_escape_string($con,$_POST['txtbx_sid']);
	
	if($_POST['txtbx_batchupd'] == "nodata"){
		echo "<script>alert('Please Select Batch');</script>";
	}
	else{
		
		$update = "Update student set mobileno='".$txtbx_mobupd."',address='".$txtarea_addrupd."',city='".$txtbx_cityupd."',course='".$dd_courseupd."',college_university='".$txtbx_collegeupd."',dob='".$txtbx_dobupd."',batch='".$txtbx_batchupd ."',fees='".$txtbx_feesupd."' where sid='".$txtbx_sid."'";
		if(mysqli_query($con, $update))
		{
			echo "<script>alert('Student Updated Successfully');</script>";
			echo "<script>window.location.href='ManageStudents.php'</script>";			
		}	
		else
		{
			echo "<script>alert('Invalid');</script>";
		}

	}		
	
		
}

include('Footer.php') 

?>

<script type="text/javascript">

$(document).ready(function() {
	
  $(".select_date").datepicker({
	   dateFormat: "yy-mm-dd",
  });

 $(".select_date").keypress(function (evt) {
       evt.preventDefault();
  });
  
	
 $(document).on("click",".btn_upd",function() {
	
	var id = $(this).attr('id');
	
	$.ajax({
	  type: "POST",
	  url: "modal_updstudents.php",
	  dataType: "json",
	  data:{id:id},
	  success: function(data){
		 
		var html = '';
		$("#selc_course").empty();
	 
		$('#Modal_Upd').modal('show');

		$("#st_name").val(data[0][0].name);
		$("#st_mob").val(data[0][0].mobileno);
		$("#st_emailid").val(data[0][0].emailid);	
		$("#st_dob").val(data[0][0].dob);
		$("#st_addr").val(data[0][0].address);
		$("#st_city").val(data[0][0].city);				 
		$("#st_batch").val(data[0][0].batch);		
		$("#st_college").val(data[0][0].college_university);
		$("#st_fees").val(data[0][0].fees);
		
		
		  if(data!= "")
		  {
			html += '<option value="--Select Course--" disabled >--Select Course--</option>';
			  $.each(data[1],function(key, val){
				
				html += '<option value='+val.CId+'>'+val.Course+'</option>';
									
			});
			
		  }
		
		 $("#selc_course").append(html);
		 $( "#selc_course option:selected" ).text(data[0][0].course);
		 $("#dd_courseid").val(data[0][0].course);	
		 
	  }
	  
	});
	
	$("#sid").val(id);
	
 });
 
 
 $(document).on("change","#selc_course",function() {
	
	var id = $('#selc_course').find(":selected").val();
	var text = $('#selc_course').find(":selected").text();
	
	$("#dd_courseid").val(text);

	$.ajax({
	  type: "POST",
	  url: "viewbatches.php",
	  dataType: "json",
	  data:{id:id},
	  success: function(data){
		  
		  
		  var html = '';
		  $("#txtHint").empty();
		  
		   html += "<div class='row'><div class='col-md-12 col-lg-12'><div class='form-group'><label>Select Batch: </label><select id='selc_batch' name='txtbx_batchupd' class='form-control'>";
		  
		  if(data[0].Batch == null || data[0].Batch == ""){
			  
			html += '<option value="nodata">--No records to display--</option>';
			
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
	
 });	
	
	
	$("#myform1").validate({ 		
		
			rules: { 
			txtbx_dobupd: "required",
			txtbx_mobupd: {
			  required:true,
			  number:true,
			  maxlength:10,
			  minlength:10
			},
			txtarea_addrupd : "required",
			txtbx_cityupd : "required",
			txtbx_courseupd : "required",
			txtbx_batchupd: "required",
			txtbx_cityupd : "required",
			txtbx_collegeupd: "required",			
			txtbx_feesupd: "required",
			},		
			messages: { 				
				txtbx_dobupd: "<h5>Please Select Date Of Birth</h5>",
				txtbx_mobupd:"<h5>Please Enter Mobile No.</h5>",				
				txtarea_addrupd:"<h5>Please Enter Address</h5>",
				txtbx_cityupd :"<h5>Please Enter City</h5>",
				txtbx_courseupd:"<h5>Please Enter Course</h5>",
				txtbx_batchupd:"<h5>Please Enter Batch</h5>",
				txtbx_collegeupd:"<h5>Please Enter College/University Name</h5>",
				txtbx_feesupd:"<h5>Please Enter Fees</h5>",
				
				}
			});
});



 

</script>
