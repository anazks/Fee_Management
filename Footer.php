</div>

<div class="text-right footer">
	<p class="footerp"></p>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>


$(function() {
  $('li a[href^="' + location.pathname.split("/")[2] + '"]').addClass('active');
  
  var url = location.pathname.split("/")[2];
  if(url == "SelectBatch.php"){
	  
	  $('.ones').addClass('active');
  } 
  else if(url == "ManageStudents.php" || url == "AddStudents.php"){
	  
	   $('.ones1').addClass('active');
  }
   
});

</script>
