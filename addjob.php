<?php
	include_once('config.php');
	include_once('dbutils.php');
?>
<?php
// check if user logged in, if not, kick them to login.php
session_start();
if(!isset($_SESSION['username'])) {
	// if this is not set, it means they are not logged in
	header("Location: login.php");
}

$menuActive="1"	
?>


<html>
<!--
Reached by click JOBS on navbar. View and ADD jobs
Orginally created by Trenton, if you have an questions ask.
-->
<header>

<title> Jobs </title>

<!-- BOOTSTRAP CODE -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!-- NAVBAR STYLE REF CSS -->
<link rel="stylesheet" href="navbarstyle.css">

<!--ADDITIONAL CSS-->
<style>
.container {
	padding: 60px 20px;
	letter-spacing: 2px;
	color: white;
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


<?php
// Back to PHP to perform the search if one has been submitted. Note
// that $_POST['submit'] will be set only if you invoke this PHP code as
// the result of a POST action, presumably from having pressed Submit
// on the form we just displayed above.
if (isset($_POST['submit'])) {
//	echo '<p>we are processing form data</p>';
//	print_r($_POST);

	// get data from the input fields
	$Business_Name = $_POST['Business_Name'];
	$Business_Address = $_POST['Business_Address'];
	$Position = $_POST['Position'];
	

	if (!$Business_Name) {
		punt("Please enter a Business Name");
	}
	if (!$Business_Address) {
		punt("Please enter a Business Address");
	}
	if (!Position) {
		punt ("Please enter a Position");
	}
	
	


	// connect
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	

	//Check if business is already in the database
	$query = "SELECT * FROM Business_T WHERE Business_Name='$Business_Name' AND Business_Address='$Business_Address' AND Position='$Position';";
	$result = queryDB($query,$db);
	if (nTuples($result) > 0) {
		//IF job search comes back then the person is assigned this job already
		punt("ERROR: The Business '$Business_Name' at '$Business_Address' with the position of '$Position' has already been created");
	} else {		
		$query = "INSERT INTO Business_T(Business_Name, Business_Address, Position) VALUES ('$Business_Name', '$Business_Address', '$Position');";
		$result = queryDB($query, $db);
		header('Location: jobs.php');	
	}
	
}
?>



<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="White"><strong> Add New Business </strong></font></center><hr width="50%"></h1>
	</div>
	
	
	<!--ADD JOBS-->
	<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<h4><font color="white"><b>Add Business </b></font></h4>
		
		<!--Business Name name= Business_Name-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="Business_Name" placeholder="Business Name"> </div>
		</div>
		
		<!--Business Address name= Business_Address-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="Business_Address" placeholder="Business Address"> </div>
		</div>
		
		<!--Business Address name= Position-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="Position" placeholder="Your Position"> </div>
		</div>
		
		<!--BUTTON-->
		<center><button type="submit" class="btn btn-default btn-lg" name="submit">Submit</button></center>
	</form>



</body>


<footer>
<?php
	include_once('footer.php');
?>
</div>
</footer>
</div>
</div>
