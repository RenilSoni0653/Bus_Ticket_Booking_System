<?php
	include('config.php');
	session_start();
	
	$id=$_SESSION['id'];
?>

<!DOCTYPE HTML>
<HTML>
	<HEAD>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta charset="UTF-8">

	<title>Bus Ticket Booking</title>

	<link rel="stylesheet" type="text/css" href="Tickets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="Tickets/css/bootstrap-responsive.css">
	<link rel="stylesheet" type="text/css" href="Tickets/css/datepicker.css">
		
	<link rel="stylesheet" href="admin/css/font-awesome.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="admin/css/bootstrap-social.css">
	<link rel="stylesheet" href="admin/css/bootstrap-select.css">
	<link rel="stylesheet" href="admin/css/fileinput.min.css">
	<link rel="stylesheet" href="admin/css/awesome-bootstrap-checkbox.css">
	<link rel="stylesheet" href="admin/css/style.css">
	</HEAD>
	
	<style>
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
  background-color: #3e8e41;
}

#myInput {
  box-sizing: border-box;
  background-image: url('searchicon.png');
  background-position: 14px 12px;
  background-repeat: no-repeat;
  font-size: 16px;
  padding: 14px 20px 12px 45px;
  border: none;
  border-bottom: 1px solid #ddd;
}

#myInput:focus {outline: 3px solid #ddd;}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}
</style>
  
<BODY>
<?php include('header.php');?>
	<div class="ts-main-content">
	<?php include('sidebar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">
				<h2 class="page-title" style="margin-top:4%">Select Source & Destination</h2>	
					<div class="row well col-md-offset-0 col-md-12">
						<div class="span10">
						
							<form method="post" action="user-schedule.php">
							
								<div class="form-group">
									<label class="col-sm-2 control-label">Source : </label>
										<div class="col-sm-10">
											<select name="source" id="source" class="form-control" required> 
											<option value="">--------------------Select Source--------------------</option>
											<?php 
												$ret="select DISTINCT source from buses";
												$stmt= $mysqli->prepare($ret) ;
												//$stmt->bind_param('i',$aid);
												$stmt->execute();
												$res=$stmt->get_result();
											
												while($row=$res->fetch_object())
												{
											?>
											<option value="<?php echo $row->source;?>"> <?php echo $row->source;?></option>
												
											<?php } ?>
											</select>							
										</div>
								</div>
			
<br><br><br><br><br>
<div class="form-group">
	<label class="col-sm-2 control-label">Destination : </label>
	<div class="col-sm-10">
		<select name="dest" id="dest" class="form-control" required> 
			<option value="">-----------------Select Destination------------------</option>
			<?php 
				$ret="select DISTINCT destination from buses";
				$stmt= $mysqli->prepare($ret) ;
				//$stmt->bind_param('i',$aid);
				$stmt->execute();
				$res=$stmt->get_result();
				while($row=$res->fetch_object())
				{
			?>
			
			<option value='<?php echo $row->destination;?>'> <?php echo $row->destination;?></option>
				<?php }  ?>
		</select> 
		
	</div>
	
</div>

<br><br><br><br><br>
<label class="col-sm-2 control-label">Date of Journey : </label>  &nbsp;&nbsp;&nbsp;

<div data-date-format="yyyy-mm-dd" data-date="document.write(date())" class="input-append date myDatepicker">
	<input type="text" value="" name="doj" size="16" class="span8" required>
	<span class="add-on"><i class="icon-calendar"></i></span>	
</div>

<br><br><br><br>

<center>
	<button type="submit" name="submit" class="btn btn-info" style="font-size:15px;">
		<i class="icon-ok icon-white"></i> Submit
	</button>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

	<button type="reset" class="btn" style="font-size:15px;">
		<i class="icon-refresh icon-black"></i> Clear
	</button>
</center>

				</div>
			</div>
		</div>
	</div>	
</div>
</form>

	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script>window.jQuery || document.write('<script src="js/jquery-latest.min.js">\x3C/script>')</script>
	<script type="text/javascript" src="Tickets/js/bootstrap.js"></script>
	<script type="text/javascript" src="Tickets/js/bootstrap-datepicker.js"></script>
	
	<script>
		$('.myDatepicker').each(function() {
		    var minDate = new Date();
		    minDate.setHours(0);
		    minDate.setMinutes(0);
		    minDate.setSeconds(0,0);
		    
		    var $picker = $(this);
		    $picker.datepicker();
		    
		    var pickerObject = $picker.data('datepicker');
		    
		    $picker.on('changeDate', function(ev){
		        if (ev.date.valueOf() < minDate.valueOf()){
		            
		            // Handle previous date
		            alert('You can not select past date.');
		            pickerObject.setValue(minDate);
			            
		            // And this for later versions (in case)
		            ev.preventDefault();
		            return false;
		        }
		    });
		});					
	</script>
	
</BODY>
</HTML>