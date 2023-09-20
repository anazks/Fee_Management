<?php session_start();
include('AdminHeader.php');

$val = !empty($_SESSION["adminid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?logintype=admin'</script>";
}
$adminid_session = $_SESSION["adminid_session"];

?>


<div class="container" style="margin-top: 7%;">

	<div class="row" id="searchbox">
        <div class="col-md-6 col-lg-6"> 
			<form method="POST">
				<div class="input-group" style="width: 80%;">
					<input name="search_name" type="text" class="form-control" placeholder="Search Student Name/Order ID">				
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
	
				<?php
				
				$currdate = date("Y-m-d");
				$currmontharr = date("m", strtotime($currdate));
				
				if(isset($_POST['btn_search']))
				{
					$sel = "Select s.Name,o.OId,o.Date,o.Totalamount from Orders as o join student as s on o.SId= s.SId where (s.Name like '%".$_POST['search_name']."%' or o.OId like '%".$_POST['search_name']."%') Order by o.Date desc";	
				}
				else
				{
				   $sel = "Select s.Name,o.OId,o.Date,o.Totalamount from Orders as o join student as s on o.SId= s.SId Order by o.Date desc";		   
				}
				
				$rel = $con->query($sel);	
				if(mysqli_num_rows($rel)==0)
				{
					echo "<center><h4>No records to display</h4></center>
					<script>document.getElementById('searchbox').style.display='none'</script>";
				}
				else{
					
					echo '<script>document.getElementById("searchbox").style.display="block"</script>
					<table class="table table-striped table-bordered table-hover text-center" width="100%"><thead style="background-color:grey; color:white;">
					<tr>
					<th>Student Name</th>	
					<th>Order ID</th>
					<th>Date</th>	
					<th>Fees (Monthly)</th>
					<th>Payment Status</th>					
					</tr>
					</thead>

					<tbody>';
					
					while($data=mysqli_fetch_array($rel)){
						
						$oid = $data['OId'];
						$fees = $data['Totalamount'];
						$date_fetch = $data['Date'];
						$name = $data['Name'];
						
						$orderdatearr = date("m", strtotime($date_fetch));
						
						echo'<tr>
						<td>'.$name.'</td>		
						<td>'.$oid.'</td>						
						<td>'.$date_fetch.'</td>
						<td>'.$fees.'</td>';

						if($orderdatearr == $currmontharr){
							echo'<td>Paid</td>';
						}
						else{
							
							echo'<td>Pending</td>';							
						}		
						
						echo'</tr>';
						
					}

					echo'</tbody></table> ';
				}	
									
				?>
							
				
			</div>
		</div>			
						
</div>

<?php 

include('Footer.php') 

?>
