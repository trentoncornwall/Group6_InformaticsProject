<?php
	include_once('config.php');
	include_once('dbutils.php');
?>
	
<html>
<!--
This page is reached after user logs in. This is their home. Access to everything
Orginally created by Trenton, if you have an questions ask.
-->
<header>
<?php
// check if user logged in, if not, kick them to login.php
session_start();
if(!isset($_SESSION['username'])) {
	// if this is not set, it means they are not logged in
	header("Location: login.php");
}
$menuActive="2"
?>	
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

<?php
// PHP to add hours to database.
// POST if submit button is pressed
if (isset($_POST['submit'])) {

	// get data from the input fields
	$Hours_Date = $_POST['Hours_Date'];
	$Hours = $_POST['Hours'];
		
	// check to make sure fields are entered
	if (!$Hours_Date) {
		punt("Please select a date");
	}

	if (!$Hours) {
		punt("Please enter how many hours you worked (8.5)");
	}
	
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query
	$query = "INSERT INTO Hours_T(Hours, Hours_Date) VALUES ('$Hours', '$Hours_Date');";
	
	// run the query
	$result = queryDB($query, $db);
	
	// tell users that we added the person to the database
	echo "<div class='panel panel-default'>\n";
	echo "\t<div class='panel-body'>\n";
    echo "\t\tYour Hours have been added.\n";
	echo "</div></div>\n";
	
}
?>
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
			<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			 <!-- NOT SURE IF THIS IS CORRECT--!>
			
				<!--Date id=date -->
				<div class="form-group">
						<input class="form-control" id="date" name="Hours_Date" placeholder="YYYY-MM-DD" type="text"/>
				</div>
				
				<script>
					var date_input=$('input[name="Hours_Date"]'); //our date input has the name "date"
					var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
					var options={
						format: 'yyyy-mm-dd',
						container: container,
						todayHighlight: true,
						autoclose: true,
						};
					date_input.datepicker(options); //initiali110/26/2015 8:20:59 PM ze plugin
				</script>
				
				<!--Hours-->
				
				
					<div class="form-group">
						<label class="sr-only" for="exampleInputAmount">Amount (in dollars)</label>
					<div class="input-group">
				
				<!--id=hours-->
						<input type="text" class="form-control" id="hours" name="Hours" placeholder="Hours">
						<div class="input-group-addon"> </div>
					</div>
					</div>
				  
				
				<!-- Drop down box for jobs -->
				<!-- Insert php and sql to input jobs -->
				<select class="form-control">
					<option value="one">Job Example</option>
					<option value="two">University of Iowa</option>
					<option value="three">Fill in these</option>
					<option value="four">Useing a query command</option>
				</select>		
				<br>
				<!--SUBMIT BUTTON -->
				<div class="form-group"> 
					<center><input class="btn btn-default btn-lg" id="submit" name="submit" type="submit">Submit</button></center>
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
