<?php session_start();
include('AdminHeader.php');

$val = !empty($_SESSION["adminid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?logintype=admin'</script>";
}
$adminid_session = $_SESSION["adminid_session"];

if(isset($_GET['cid']) && !empty($_GET['cid'])){
	
	$cid = $_GET['cid'];


$sel = "Select Course from course where CId='".$cid."'";
$rel=$con->query($sel);
if($data=mysqli_fetch_assoc($rel)){
	
	$course = $data['Course'];	
}	

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

<a href="ManageCourse.php"><i class="fa fa-arrow-left"></i> Back</a><br/><br/>

<h5>Course Name: <span style="font-size:18px; color:maroon;"><?php echo $course ?></span></h5>

<div class="row mt-4">
	<div class="col-md-6 col-lg-6">
		<div class="row">
			<div class="col-md-12 col-lg-12 mx-auto bg-white rounded p-3 shadow-lg">
				<form id="myform" method="POST">
					<div class="form-group">
						<label>Batch:</label>
						<input type="text" class="form-control" name="txtbxbatch" placeholder="Enter Batch">
					</div>	
					
					<input type="submit" name="btn_submit" class="btn btn-info" value="Submit"/>
				</form>
			</div>
		</div>
	</div>
	<div class="col-md-6 col-lg-6">
		<div class="table-responsive" id="CourseTableArea">
		<table id="CourseTable" class="table table-striped table-bordered table-hover text-center" width="100%">
				
		<?php
		
		$sel = "Select Batch from Course where CId='".$cid."' Order by Batch desc";							
		$rel=$con->query($sel);
		if(mysqli_num_rows($rel)==0)
		{			  
			echo "<center><h3>No batches to display</h3></center>";		
		}
		else
		{
			echo'<thead style="background-color:grey;color:white">           
			<tr> 
			<th>Batch</th>
			</tr>
			</thead>

			<tbody>';
				  
			while($data=mysqli_fetch_array($rel))
			{		
				$batch=$data['Batch'];
				
				if($batch == ""){
					echo'<tr>
					<td>No batches to display</td>
					</tr>';
				}
				else{
					echo'<tr>
					<td>'.$batch.'</td>
					</tr>';
				}	
				
			}
			
			echo"</tbody>";
		}		
				
		?>
					 
	  </table>
	  </div>
	</div>
</div>


</div>


<?php 

if(isset($_POST['btn_submit']))
{
	$txtbxbatch = $_POST['txtbxbatch']; 

	$sel = "Select Batch from course where CId='".$cid."'";
	$rel=$con->query($sel);
	if($data=mysqli_fetch_assoc($rel)){
	
		$batch = $data['Batch'];
		
		if($batch == ""){
			
			$upd = "Update course set Batch='$txtbxbatch' where CId = '".$cid."'";				
			if(mysqli_query($con, $upd))
			{
				echo "<script>alert('Batch Added Succesfully');</script>";
				echo "<script>window.location.href='SelectBatch.php?cid=".$cid."'</script>";			
			}	
			else
			{
				echo "<script>alert('Invalid');</script>";
			}
		}
		else{
			
			$sel2 = "Select * from course where Batch like '%$txtbxbatch%'";
			$rel2=$con->query($sel2);
			$data2=mysqli_fetch_assoc($rel2);
			$batch_fetch = $data2['Batch'];
			
			if(mysqli_num_rows($rel2) == 0){
				
				$ins = "Insert into course(cid,course,batch)values('$cid','$course','$txtbxbatch')";
				if(mysqli_query($con, $ins))
				{
					echo "<script>alert('Batch Added Succesfully');</script>";
					echo "<script>window.location.href='SelectBatch.php?cid=".$cid."'</script>";		
				}	
				else
				{
					echo "<script>alert('Invalid');</script>";
				}
			}
			else{
				
				echo "<script>alert('This Batch is already added');</script>";	
			}	
					
		}
		
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
				txtbxbatch: "required",				
            },

            messages:{        
				txtbxbatch:"<h5>Please Enter Batch</h5>",
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
else if(empty($_GET['cid'])){
	
	echo"<script>window.location.href='ManageCourse.php'</script>";
	exit;
}	

?>