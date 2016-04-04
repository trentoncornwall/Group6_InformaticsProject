<html>
<!--
This page is reached after user logs in. This is their home. Access to everything
Orginally created by Trenton, if you have an questions ask.
-->
<header>
<title> Home </title>

<!-- BOOTSTRAP CODE -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- NAVBAR STYLE REF CSS -->
<link rel="stylesheet" href="navbarstyle.css">

<!--STYLE REF FOR DATEPICKER-->
<!--  jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

<!-- Isolated Version of Bootstrap, not needed if your site already used Bootstrap -->
<link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>



<!--ADDITIONAL CSS-->
<style>
.container {
	padding: 60px 20px;
}
.container-2 {
	padding: 60px 120px;	
}
</style>
</header>



<body>
<div class="container">
<!--NAV BAR -->
<?php
	include_once('navbar.php')
?>
<!--This is a center block, helps keep vertyhing in the center for the theme-->
<div class="center-block col-sm-12" style="float: none; background-color: #52BE80">

<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="White"><strong> Hours </strong></font></center><hr></h1>
	</div>
	


<!--Entering in Date-->
<!--Entering in Date-->
<div class="container-2">
	
	<div class="boostrap-iso">
		<div class="container-fluid">
			<div class="row">

			<!--Form Code Begins-->
			<form method="post">
			
				<!--Date id=date -->
				<div class="form-group">
						<input class="form-control" id="date" name="date" placeholder="MM/DD/YYYY" type="text"/>
				</div>
				
				<script>
					var date_input=$('input[name="date"]'); //our date input has the name "date"
					var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
					var options={
						format: 'mm/dd/yyyy',
						container: container,
						todayHighlight: true,
						autoclose: true,
						};
					date_input.datepicker(options); //initiali110/26/2015 8:20:59 PM ze plugin
				</script>
				
				<!--Hours-->
				<form class="form-inline">
				
					<div class="form-group">
						<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
					<div class="input-group">
				
				<!--id=hours-->
						<input type="text" class="form-control" id="hours" placeholder="Hours">
						<div class="input-group-addon"> </div>
				<!--id=minutes-->
						<input type="text" class="form-control" id="minutes" placeholder="Minutes">
					</div>
					</div>
				  
				</form>
				
				<!-- Drop down box for jobs -->
				
				<select class="form-control">
					<option value="one">Job Example</option>
					<option value="two">University of Iowa</option>
					<option value="three">Fill in these</option>
					<option value="four">Useing a query command</option>
				</select>		
				<br>
				<!--SUBMIT BUTTON -->
				<div class="form-group"> 
					<center><button class="btn btn-default btn-lg" name="submit" type="submit">Submit</button></center>
				</div>
			</form>
			
			<!--JAVASCRIPT to control the calander--->
			
			
			</div>
		</div>
	</div>

</div>
</body>


<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
