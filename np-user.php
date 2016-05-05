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
	
<title> Non-Profit </title>

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
	include_once('np-nav.php')
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

<?php
//Hours table
$PID=$_GET['PID'];
$_SESSION['PID']=$_GET['PID'];
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

echo '<h3>Reports</h3>';
$query = ("SELECT Pay_Difference, Hour_Difference, S_Date, E_Date, Amount FROM Report_T as r, Paystub_T as p WHERE p.PSID = r.PSID and r.PID = $PID;");
$result = queryDB($query,$db);

if (nTuples($result) > 0) {
    // Creating table
    echo "<table class='table table-hover'>\n";
    echo "<thead><tr><th align=left>Hours</th><th align=left>Pay Difference</th><th align=left>Hour Difference</th><th align=left>Start Date</th><th align=left>End Date</th></tr></thead>\n";
    while ($row = nextTuple($result)) {
        echo '<tr><td align=left>';
        echo $row['Hour_Difference'];
        echo '</td><td align=left>';
		echo '$' . $row['Pay_Difference'];
		echo '</td><td align=left>';
        echo '$' . $row['Amount'];
        echo '</td><td align=left>';
        echo $row['S_Date'];
		echo '</td><td align=left>';
        echo $row['E_Date'];
        echo "</td></tr>\n";
	  }
    echo "</table>\n";
}


echo '<h3>Daily Hours Logged</h3>';
$query = "SELECT Hours, Hours_Date FROM Hours_T, Job_T WHERE Hours_T.JID = Job_T.JID and Job_T.PID = $PID ORDER BY Hours_Date DESC LIMIT 14;";
$result = queryDB($query,$db);
if (nTuples($result) > 0) {
    // Creating table
    echo "<table class='table table-hover'>\n";
    echo "<thead><tr><th align=left>Hours</th><th align=left>Date</th></tr></thead>\n";
    while ($row = nextTuple($result)) {
        echo '<tr><td align=left>';
        echo $row['Hours'];
        echo '</td><td align=left>';
        echo $row['Hours_Date'];        
        echo "</td></tr>\n";
	  }
    echo "</table>\n";
}
else {
    // No hours have been entered.
    echo "<i><font size=4 color='white'>User has not entered any hours.</font></i></br>";
}

	

echo '<h3>Paystub Hours Logged</h3>';

//Query to populate table with recently entered paystubs
$query = "SELECT PSID, Amount, Stub_Hours, S_Date, E_Date, Business_Name, Position FROM Paystub_T, Business_T, Job_T WHERE Job_T.PID = $PID AND Paystub_T.JID = Job_T.JID AND Business_T.BID = Job_T.BID ORDER BY S_Date DESC;";
$result = queryDB($query,$db);

if (nTuples($result) > 0) {
    // Creating table
    echo "<table class='table table-hover'>\n";
    echo "<thead><tr><th align=left>Paystub ID#</th><th align=left>Amount</th><th align=left>Hours</th><th align=left>Start Date</th><th align=left>Business</th><th align=left>Position</th></tr></thead>\n";
    while ($row = nextTuple($result)) {
		echo '<tr><td align=left>';
        echo $row['PSID'];
        echo '</td><td align=left>';
        echo "$" . $row['Amount'];
		echo '</td><td align=left>';
		echo $row['Stub_Hours'];
		echo '</td><td align=left>';
		echo $row['S_Date'];
		echo '</td><td align=left>';
		echo $row['Business_Name'];
		echo '</td><td align=left>';
		echo $row['Position'];
        echo "</td></tr>\n";
		$row = nextTuple($result);
	  }
    echo "</table>\n";
} else {
    // No paystubs have been entered.
    echo "<i><font size=4 color='white'>User has not entered any paystubs.</font></i></br>";
    }

?>


</body>



<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
