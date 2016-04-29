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
<?php
//CLICKING SUBMIT BUTTON
if (isset($_POST['submit'])) {

	// connect and get variables
	$PID = $_SESSION['PID'];
	$BID = $_POST['BID'];
	$Wage = $_POST['Wage'];
	
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	//check to see if user is already assigned the job
	$query = "SELECT * FROM Job_T WHERE PID = '$PID' AND BID = '$BID';";
	$result = queryDB($query, $db);
	if (nTuples($result) > 0) {
		//IF job search comes back then the person is assigned this job already
		punt("ERROR: You are already assigned to this job");
	} else {		
		//else, insert job into jobs table assigned to this person
		$query = "INSERT INTO Job_T(PID, BID, Wage) VALUES ('$PID', '$BID', '$Wage');";
		$result = queryDB($query,$db);
	}
	
}
?>

<?php
//DROP BOX FOR BUSINESS OPTIONS
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
		<h1><center><font color="White"><strong> Jobs </strong></font></center><hr width="50%"></h1>
	</div>
	

<!--WHERE THE TABLE USED TO BE-->

	
	<!--ADD JOBS-->
	<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<h4><font color="white"><b>Add Job </b></font></h4>

		<!-- Shows Business name and address GROUP -->
		<div class="form-group"><div class="col-sm-12">
			<div class="input-group">
				<!-- Drop down box -->
				<select class="form-control" name="BID"><?php echo $Business_Options; ?></select>
					
					<!-- button to add a new job -->
					<div class="input-group-btn">
						<a class="btn btn-default" href="addjob.php" type="button">Don't see your Business?</a>
					</div>
			</div>
			</div>
		</div>
		<div class="form-group"><div class="col-sm-12">
			<div class="input-group">
				<span class="input-group-addon">$</span>
				<input type="number" step="0.01" class="form-control" name="Wage" placeholder="Hourly Wage - Dollars">
			</div></div>
		</div>
		
		
		<!--BUTTON-->
		<center><button type="submit" class="btn btn-default btn-lg" name="submit">Submit</button></center>
	</form>
<?php
//CURRENT JOB TABLE

$PID=$_SESSION['PID'];
//Connect to db
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

//Query to populate table with list of Jobs pertaining to the Person logged in
$query = "SELECT b.Business_Name, b.Position, b.Business_Address, j.Wage FROM Business_T as b, Job_T as j WHERE j.PID = $PID AND b.BID = j.BID ORDER BY Business_Name;";
$result = queryDB($query,$db);
if (nTuples($result) > 0) {
    // Creating table
    echo "<table class='table table-hover'>\n";
    echo "<thead><tr><th align=left>Business Name</th><th align=left>Position</th><th align=left>Address</th><th align=left>Wage Per Hour</th></tr></thead>\n";
    while ($row = nextTuple($result)) {
        echo '<tr><td align=left>';
        echo $row['Business_Name'];
        echo '</td><td align=left>';
        echo $row['Position'];
        echo '</td><td align=left>';
        echo $row['Business_Address'];
		echo '</td><td alight=left>';
		echo "$" . $row['Wage'];
        echo "</td></tr>\n";
	  }
    echo "</table>\n";
} else {
    // No results found; display a message to that effect.
    echo "<i><font size=4 color='white'>You are currently not assigned any jobs. Please do so.</font></i></br>";
    }

?>


</body>


<footer>
<?php
	include_once('footer.php');
?>
</div>
</footer>
</div>
</div>
