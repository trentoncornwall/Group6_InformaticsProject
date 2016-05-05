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
	letter-spacing: 2px;
}
.container-2 {
	padding: 60px 120px;	
}
</style>
</header>

<body>


<div class="container">
<!--This is a center block, helps keep vertyhing in the center for the theme-->
<div class="center-block col-sm-12" style="float: none; background-color: #52BE80">

<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="White"><strong> Hours </strong></font></center><hr width="50%"></h1>
	</div>
	
<?php
//Set PID for Business_Options dropdown
$PID = $_SESSION['PID'];	

//Connect to db
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
//Query to populate drop down box with list of Jobs pertaining to the Person logged in
$query = "SELECT b.BID, b.Business_Name, b.Position, b.Business_Address, j.JID FROM Business_T as b, Job_T as j WHERE j.PID = $PID AND b.BID = j.BID ORDER BY Business_Name;";

$result = queryDB($query, $db);

$Business_Options = "";

if (nTuples($result) > 0) {
    while ($row=nextTuple($result)) {
		$Business_Options .= "\t\t\t";
		$Business_Options .= "<option value='";
		$Business_Options .= $row['BID'] . "'>" . $row['Business_Name'] . "  -  " . $row['Position'] . "  -  " . $row['Business_Address'] . "</option>\n";
		}
	} else {
		echo "<b>NOTICE: You currently have no jobs added to your job list. Please enter a job under the Jobs tab</b>";
	}
?>	

<?php
	include_once('navbar.php');
?>
<!--Hours table-->


<!--Entering in Date-->

	
	<div class="boostrap-iso">
		<div class="container-fluid">
			<div class="row">

			<!--Form Code Begins-->
			<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			 
			
				<!--Date id=date -->
				<div class="form-group"><div class="col-sm-12">
						<input class="form-control" id="date" name="Hours_Date" placeholder="YYYY-MM-DD" type="text"/>
				</div></div>
				
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
				
				
				<div class="form-group"><div class="col-sm-12">					
					<input type="number" step="0.1" class="form-control" id="hours" name="Hours" placeholder="Hours" max="24">
				</div></div>
				  
				<!-- Drop down box for jobs -->
				<div class="form-group"><div class="col-sm-12">
					<select class="form-control" name="BID"><?php echo $Business_Options; ?></select>
				</div></div>

				<!--SUBMIT BUTTON -->
				<div class="form-group"> <div class="col-sm-12">
					<center><input class="btn btn-default btn-lg" id="submit" name="submit" type="submit"></button></center>
				</div></div>
			</form>
			
			<!--JAVASCRIPT to control the calander--->
			
			
			</div>
		</div>
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
		punt("Please enter how many hours you worked (e.g. 8.5)");
	}
	
	// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	//Select JID
	$query = "SELECT JID FROM Job_T WHERE Job_T.PID = $PID AND Job_T.BID = $BID;";
	
	//Run query
	$result = queryDB($query, $db);
	
	//Set JID variable to query result
	$tuple = nextTuple($result);	
	$JID = $tuple['JID'];
	
	// set up my query
	$query = "INSERT INTO Hours_T(JID, Hours, Hours_Date) VALUES ('$JID', '$Hours', '$Hours_Date');";
	
	// run the query
	$result = queryDB($query, $db);
	
	// tell users that we added the person to the database
	// THIS NEEDS FIXIN'
			echo 	'<div class="alert alert-success alert-dismissible" role="alert">';
			echo 	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo	'<center><strong>Success!</strong> '. $Hours . ' Hours have been added for the date '.$Hours_Date.'.</center>';
			echo	'</div>';		
		;		

}
?>

<?php
//hours table

$PID=$_SESSION['PID'];


//Connect to db
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

//Query to populate table with hours and date entered. limit 14 days
$query = "SELECT DISTINCT HID, Hours, Hours_Date, Business_Name, Position FROM Hours_T, Job_T, Business_T WHERE Job_T.PID = '$PID' AND Hours_T.JID = Job_T.JID AND Business_T.BID = Job_T.BID ORDER BY Hours_Date DESC LIMIT 14;";

$result = queryDB($query,$db);
if (nTuples($result) > 0) {
    // Creating table
    echo "<table class='table table-hover'>\n";
    echo "<thead><tr><th align=left>Business Name</th><th align=left>Position</th><th align=left>Hours</th><th align=left>Date</th><th></th></tr></thead>\n";
    while ($row = nextTuple($result)) {
        echo '<tr><td align=left>';
		echo $row['Business_Name'];
        echo '</td><td align=left>';
		echo $row['Position'];
        echo '</td><td align=left>';
        echo $row['Hours'];
		echo '</td><td align=left>';
        echo $row['Hours_Date'];        
		echo '</td><td align=left>';
		echo '<a href=' . genURL('trashhours.php?HID=' . $row['HID']) . '><font color=red><span class="glyphicon glyphicon-remove" aria-hidden="true"></font></span></a>';
        echo "</td></tr>\n";
	  }
    echo "</table>\n";
	} else {
    // No hours have been entered.
    echo "<i><center><font size=4 color='white'>You've not entered any hours.</center></font></i></br>";
    }

?>
</div>

</body>


<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
