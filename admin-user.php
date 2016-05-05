<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

<html>
<header>

<?php
// check if user logged in, if not, kick them to login.php
session_start();
if(!isset($_SESSION['username'])) {
	// if this is not set, it means they are not logged in
	header("Location: login.php");
}
$menuActive="1"
?>		
	
<title> USER </title>

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
	include_once('ad-nav.php')
?>
<!--This is a center block, helps keep vertyhing in the center for the theme-->
<div class="center-block col-sm-12" style="float: none; background-color: #52BE80">

<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="White"><strong> Welcome </strong></font></center><hr></h1>
	</div>

<!--Messages for Users-->
<div class="container-2">

<center><font color="white">




<font color=white><h4>User Hours</h4></font>

<?php
//paystub table
$PID=$_GET['PID'];
$_SESSION['PID']=$_GET['PID'];

//Connect to db
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

//Query to populate table with hours and date entered. limit 14 days
$query = "SELECT DISTINCT HID, Hours, Hours_Date, Business_Name, Position FROM Hours_T, Job_T, Business_T WHERE Job_T.PID = '$PID' AND Hours_T.JID = Job_T.JID AND Business_T.BID = Job_T.BID ORDER BY Hours_Date DESC LIMIT 14;";

$result = queryDB($query,$db);
if (nTuples($result) > 0) {
    // Creating table
    echo "<table class='table table-hover'>\n";
    echo "<thead><tr><th align=left>Business Name</th><th align=left>Position</th><th align=left>Hours</th><th align=left>Date</th></tr></thead>\n";
    while ($row = nextTuple($result)) {
        echo '<tr><td align=left>';
		echo $row['Business_Name'];
        echo '</td><td align=left>';
		echo $row['Position'];
        echo '</td><td align=left>';
        echo $row['Hours'];
		echo '</td><td align=left>';
        echo $row['Hours_Date'];        
        echo "</td></tr>\n";
	  }
    echo "</table>\n";
	} else {
    // No hours have been entered.
    echo "<i><center><font size=4 color='white'>You've not entered any hours.</center></font></i></br>";
    }

//Query to populate table with recently entered paystubs

//paystub table

?>

<font color=white><h4>User Paystubs</h4></font>

<?php

//Connect to db
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

//Query to populate table with recently entered paystubs
$query = "SELECT PSID, Amount, Stub_Hours, S_Date, E_Date, Business_Name, Position FROM Paystub_T, Business_T, Job_T WHERE Job_T.PID = $PID AND Paystub_T.JID = Job_T.JID AND Business_T.BID = Job_T.BID ORDER BY S_Date DESC;";
$result = queryDB($query,$db);

if (nTuples($result) > 0) {
    // Creating table
    echo "<table class='table table-hover'>\n";
    echo "<thead><tr><th align=left>Business Name</th><th align=left>Position</th><th align=left>Hours</th><th align=left>Amount</th><th align=left>Start Date</th><th align=left>End Date</th></tr></thead>\n";
    while ($row = nextTuple($result)) {		
		echo '<tr><td align=left>';
        echo $row['Business_Name'];
        echo '</td><td align=left>';
		echo $row['Position'];
		echo '</td><td align=left>';
		echo $row['Stub_Hours'];
		echo '</td><td align=left>';
        echo "$" . $row['Amount'];
		echo '</td><td align=left>';
		echo $row['S_Date'];		
		echo '</td><td align=left>';
		echo $row['E_Date'];
        echo "</td></tr>\n";			
	  }
    echo "</table>\n";
} else {
    // No paystubs have been entered.
    echo "<font size=4 color='white'><center>You've not entered any paystubs.</center></font></br>";
    }

?>

<center><a href="ad-profile.php"><div class="btn btn-default" type="button">EDIT</div></a></center>


</body>



<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
