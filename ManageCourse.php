<?php session_start();
include('AdminHeader.php');

$val = !empty($_SESSION["adminid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?logintype=admin'</script>";
}
$adminid_session = $_SESSION["adminid_session"];

?>

<style>

tbody {
    display: block;
    height: 450px;
    overflow:auto;
}
thead, tbody tr {
    display:table;
    width:100%;
    table-layout:fixed;
}

tbody td{	
	word-break: break-word;	
}	

</style>

<div class="container" style="margin-top:7%;">

<div class="row">
<div class="col-md-6 col-lg-6">		
</div>


<div class="col-md-6 col-lg-6 text-right">
	<button class="btn btn-primary" style="width:10%;" id="btn_add">Add</button>
</div>
</div>


<div class="row mt-2">
<div class="col-md-6 col-lg-6" style="margin:auto;">

 <div class="table-responsive" id="CourseTableArea">
	<table id="CourseTable" class="table table-striped table-bordered table-hover text-center" width="100%">
			
	<?php
	
	$sel = "Select Distinct CId,Course from Course Order by CId Asc";							
	$rel=$con->query($sel);
	if(mysqli_num_rows($rel)==0)
	{			  
		echo "<center><h3>No records to display</h3></center>";		
	}
	else
	{
		echo'<thead style="background-color:grey;color:white">           
		<tr> 
		<th>Course</th>
		<th>Action</th>
		</tr>
		</thead>

		<tbody>';
			  
		while($data=mysqli_fetch_array($rel))
		{		
			$course=$data['Course'];
			$cid=$data['CId'];
			
			echo'<tr>
			<td>'.$course.'</td>
			<td><a href="SelectBatch.php?cid='.$cid.'" class="btn btn-primary">Select</a></td>	
			</tr>';
			
		}
		
		echo"</tbody>";
	}		
			
	?>
				 
  </table>
  </div>
  
  </div>
 </div>

</div>


<div class="modal small fade" id="myModal_Add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">              
                 <h3 class="modal-title">Add Course</h3>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
			
		<form id="myform" method="post">
            <div class="modal-body">			
			   <div class="row">				  									
					<div class="col-md-12 col-lg-12">
						<div class="form-group">
							<label>Course:</label>
							<input type="text" class="form-control" name="course" placeholder="Enter Course">
						</div>
					</div>				
			  </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button> <input type="submit" name="btn_submit" class="btn btn-primary" value="Submit"/>
            </div>
		</form>
      
    </div>
	</div>
</div>
</div>


<?php 

if(isset($_POST['btn_submit']))
{
	$course = $_POST['course']; 

	$var="select max(CId) as CId from Course";
	$res_var=$con->query($var);
	$row = mysqli_fetch_assoc($res_var);
	$cid_row = $row['CId'];	
	if(!empty($cid_row))
	{
		$cid = $cid_row + 1;
	}
	else
	{		
		$cid = '1';						
	}	
	
	$sel1 = "select Course from course where Course like '%$course%'";
	$rel1=$con->query($sel1);	
	$data1=mysqli_fetch_assoc($rel1);	
	$Course_data = $data1['Course'];
	
	if(mysqli_num_rows($rel1) == 0){
		
		$ins = "Insert into course(cid,course,batch)values('$cid','$course','')";				
	
		if(mysqli_query($con, $ins))
		{
			echo "<script>alert('Course Added Succesfully');</script>";
			echo "<script>window.location.href='ManageCourse.php'</script>";			
		}	
		else
		{
			echo "<script>alert('Invalid');</script>";
		}	
	}
	else{
		
		echo "<script>alert('This Course is already added');</script>";
		
	}	
	
}

include('Footer.php')

?>


<script type="text/javascript">


$('#btn_add').click(function(){
	$('#myModal_Add').modal('show');	
});


		$("#myform").validate({
            
            rules:{         						
				course: "required",				
            },

            messages:{        
				course:"<h5>Please Enter Course</h5>",
            },
			
            submitHandler: function(form){
                form.submit();
            }
			
        });

</script>

</body>
</html>