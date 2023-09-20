<?php session_start();
include('StudentHeader.php');

$val = !empty($_SESSION["sid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?logintype=student'</script>";
}
$sid_session = $_SESSION["sid_session"];

?>


<div class="container" style="margin-top: 7%;">

	<div class="row mt-3">
        <div class="col-md-12 col-lg-12 text-center">
	
				<?php
				
				$currdate = date('Y-m-d');
				$currmontharr = date("m", strtotime($currdate));

				$sel = "Select MobileNo,EmailId,Course,Batch,Fees from student where sid='".$sid_session."'";		   
							
				$rel=$con->query($sel);
				if(mysqli_num_rows($rel)==0)
				{			  
					//echo "<center><h4>No records to display</h4></center>";
				}	
				else
				{
					echo '<h5 style="text-align:left;">My Details: </h5><table class="table table-striped table-bordered table-hover text-center" width="100%"><thead style="background-color:grey; color:white;">
					<tr>
					<th>MobileNo</th>
					<th>EmailId</th>	
					<th>Course</th>	
					<th>Batch</th>							
					<th>Fees</th>
					</tr>
					</thead>

					<tbody>';
						  
					while($data=mysqli_fetch_array($rel))
					{						
						$mobileno=$data['MobileNo'];							
						$emailid=$data['EmailId'];						
						$course = $data['Course'];
						$batch = $data['Batch'];
						$fees = $data['Fees'];
						
						
						echo'<tr>
						<td>'.$mobileno.'</td>
						<td>'.$emailid.'</td>
						<td>'.$course.'</td>
						<td>'.$batch.'</td>
						<td>'.$fees.'</td>';
						echo'</tr>';					
					}
					
					echo'</tbody></table><br/>';
				}
					
					
				$sel = "Select OId,Date,Totalamount from orders where SId='".$sid_session."'";
				$rel = $con->query($sel);	
				if(mysqli_num_rows($rel)==0)
				{
					//echo "<center><h4>No Payment Made</h4></center>";
				}
				else{
					
					echo '<h5 style="text-align:left;">My Transactions: </h5>
					<table class="table table-striped table-bordered table-hover text-center" width="100%"><thead style="background-color:grey; color:white;">
					<tr>
					<th>Order ID</th>
					<th>Date</th>	
					<th>Fees (Monthly)</th>
					<th>Payment Status</th>					
					</tr>
					</thead>

					<tbody>';
					
					if($data=mysqli_fetch_array($rel)){
						
						$oid = $data['OId'];
						$fees = $data['Totalamount'];
						$date_fetch = $data['Date'];
						
						$orderdatearr = date("m", strtotime($date_fetch));
						
						echo'<tr>
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

					echo'</tbody></table>';
				
				}	
				
				
				$sel1 = "Select date from Orders where sid='".$sid_session."'";
				$rel1=$con->query($sel1);
				if(mysqli_num_rows($rel1)==0)
				{
					echo '<h5>Total Amount Payable: '.$fees.'</h5><br/><button class="btn btn-info btn_payt" id="'.$fees.'">Payment</button><br/>';
				}
				else{
					
					$totalFees = 0;
					
					if($data1=mysqli_fetch_array($rel1))
					{
						$orderdate = $data1['date'];
						$orderdatearr = date("m", strtotime($orderdate));
						
						if($orderdatearr == $currmontharr){
							$totalFees = $fees;
						}						
						else{							
							
							$datetime1 = new DateTime($orderdate);
							$datetime2 = new DateTime($currdate);
	
							$interval = date_diff($datetime1, $datetime2);
							$interval->format('%m months');
							$months_diff = $interval->format('%m months');							
							
							for($i = 1; $i <=($months_diff+1); $i++){
								$totalFees = $fees + $totalFees;
							}							
						
							echo '<h5>Total Amount Payable: '.$totalFees.'</h5><br/><button class="btn btn-info btn_payt" id="'.$totalFees.'">Payment</button><br/>';							
						}	
						
					}
					
				}	
									
			?>
															
			</div>
		</div>			
						
</div>


<div class="modal small fade" id="Modal_Pay" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">              
                <h3 class="modal-title">Payment</h3>
				
            </div>
			
			<form id="myform" method="post">
            <div class="modal-body">
			
			<div class="row">
				<div class="col-md-8 col-lg-8 col-sm-8 mx-auto">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label for="">Name on Card</label>
							<input  type="text" placeholder="Enter Name on Card" name="name_card" class="form-control"><br/>
						</div>
					</div>
					
					
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label for="">Card No</label>
							<input  type="number" placeholder="Enter Card No" name="cardno" class="form-control number"><br/>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label for="">CVV</label>
							<input type="number" placeholder="Enter CVV" name="cvv" class="form-control number"><br/>
						</div>
					</div>
					
					<div class="row">
					<div class="col-md-12 col-lg-12">
						<label for="">Expiry Month & Year</label>
					</div>
					
                    <div class="col-md-3 col-lg-3">                                 
						<input type="number" name="mm" onKeyPress="if(this.value.length==2) return false;" placeholder="mm" class="form-control number"><br/>
                    </div>
                    <div class="col-md-2 col-lg-2" style="padding-right: 0px !important; padding-left: 0px !important; max-width: 1.666667%;">
                        <span style="font-size: 20px;">/</span>
                    </div>
                    <div class="col-md-3 col-lg-3">                                              
                        <input type="number" name="yy" onKeyPress="if(this.value.length==4) return false;" placeholder="yy" class="form-control number"><br/>
                    </div>
                </div>
					
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<label for="">Total Amount</label>
							<input value="" type="text" name="totalamount" id="t_amt" class="form-control" readonly>
						</div>
					</div>
						
				</div>
			</div>
			
						
			</div>
			
            <div class="modal-footer">
                <input type="submit" name="btn_pay" class="btn btn-success" value="Payment"/>
				<button class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button> 
            </div>
		</form>
      
    </div>
	</div>
</div>	

<?php 

if(isset($_POST['btn_pay']))
{
	$totalamount = $_POST['totalamount'];
	
	$var="select max(oid) as oid from orders";
	$res_var=$con->query($var);
	$row = mysqli_fetch_assoc($res_var);
	$oid_row = $row['oid'];	
	if(!empty($oid_row))
	{
		$oid_arr = explode('-',$oid_row);
		$oid_val = $oid_arr[1] + 1;	
		$oid = 'O-'.$oid_val;
	}
	else
	{		
		$oid = 'O-1001';						
	}
	
	$date = date("Y-m-d");
	
	$sel = "Select * from Orders where sid='".$sid_session."'";
	$rel=$con->query($sel);
	if(mysqli_num_rows($rel) == 0){
		
		$ins = "Insert into orders(oid,sid,totalamount,date) values('$oid','$sid_session','$totalamount','$date')";

		if(mysqli_query($con, $ins))
		{
			echo "<script>alert('Payment Made Successfully');</script>";		
			echo '<script>window.location.href="FeePayment.php"</script>';		
		}	
		else
		{
			echo "<script>alert('Invalid Payment');</script>";
		}
	
	}	
	else{
				
		$update = "Update orders set date='".$date."' where sid='".$sid_session."'";
		if(mysqli_query($con, $update))
		{
			echo "<script>alert('Payment Made Successfully');</script>";		
			echo '<script>window.location.href="FeePayment.php"</script>';	
		}
		else{
				
			echo "<script>alert('Invalid Payment');</script>";
		}
					
	}	
		
	
}
	
include('Footer.php') 

?>

<script type="text/javascript">
$(document).on("click",".btn_payt",function() {
	
	var fees = $(this).attr('id');
	
	
	$('#Modal_Pay').modal('show');

	
	$("#t_amt").val(fees);
	
 });




  $('.number').keyup(function () {
            this.value = this.value.replace(/[^0-9\.]/g, '');
        });
		
	$(function()
    {	
		$("#myform").validate({
            
            rules:{
                name_card : "required",
				cardno: {
				  required: true,
				  maxlength: 16,
				  minlength: 16,
				},
                cvv: {
				  required: true,
				  maxlength: 3,
				  minlength: 3,
				},
				mm: {
				  required: true,
				  maxlength: 2,
				  minlength: 2,
				},
				yy: {
				  required: true,
				  maxlength: 4,
				  minlength: 4,
				},				
            },

            messages:{
                name_card:"<h5>Please Enter Name on Card</h5>",
                cardno:"<h5>Please Enter Card No</h5>",             
                cvv:"<h5>Please Enter CVV</h5>",
				mm:"<h5>Please Enter Expiry Month</h5>",
				yy:"<h5>Please Enter Expiry Year</h5>",
            },

           });
		
});
</script>
