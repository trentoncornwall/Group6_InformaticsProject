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
	$PID = $_SESSION['PID'];
	$Hours_Date = $_POST['Hours_Date'];
	$Hours = $_POST['Hours'];
	$BID = $_POST['BID'];
		
	// check to make sure fields are entered
	if (!$Hours_Date) {
		punt("Please select a date");
	}

	if (!$Hours) {
		punt("Please enter how many hours you worked (8.5)");
	}
	
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	//Select JID
	$query = "SELECT DISTINCT JID FROM Job_T WHERE Job_T(PID) = $PID AND Job_T(BID) = $BID;";
	
	//Run query
	$result = queryDB($query, $db);
	
	//Set JID variable to query result
	$JID = $result;
	
	echo "<div class='panel panel-default'>\n";
	echo "\t<div class='panel-body'>\n";
    echo "\t\tJID HAS BEEN SELECTED" . $JID . ".\n";
	echo "</div></div>\n";
	// set up my query
	$query = "INSERT INTO Hours_T(JID, Hours, Hours_Date) VALUES ('$JID', '$Hours', '$Hours_Date');";
	
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
<!--This is a center block, helps keep vertyhing in the center for the theme-->
<div class="center-block col-sm-12" style="float: none; background-color: #52BE80">

<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="White"><strong> Hours </strong></font></center><hr></h1>
	</div>
	
<?php
	
	
//CREATING QUERY TO VIEW Business DROP BOX and get BID
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
$query = "SELECT BID, Business_Name, Position, Business_Address FROM Business_T ORDER BY Business_Name;";
$result = queryDB($query, $db);

$Business_Options = "";

if (nTuples($result) > 0) {
    while ($row=nextTuple($result)) {
		$Business_Options .= "\t\t\t";
		$Business_Options .= "<option value='";
		$Business_Options .= $row['BID'] . "'>" . $row['Business_Name'] . "  -  " . $row['Position'] . "  -  " . $row['Business_Address'] . "</option>\n";
		}
	}
?>	

<?php
	include_once('navbar.php');
?>
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
					<div class="input-group">
				
				<!--id=hours-->
						<input type="text" class="form-control" id="hours" name="Hours" placeholder="Hours">
						<div class="input-group-addon"> </div>
					</div>
					</div>
				  
			
				<!-- Drop down box for jobs -->
				<!-- Insert php and sql to input jobs -->
				<select class="form-control" name="BID"><?php echo $Business_Options; ?></select>
				<br>
				<!--SUBMIT BUTTON -->
				<div class="form-group"> 
					<center><input class="btn btn-default btn-lg" id="submit" name="submit" type="submit"></button></center>
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
