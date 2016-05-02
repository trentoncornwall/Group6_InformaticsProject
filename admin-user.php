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

<h3>Daily Hours Logged</h3>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Hours</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>
		  <tr>
			<td>6</td>
			<td>03/10/2016</td>
		  </tr>
		  <tr>
			<td>4.25</td>
			<td>03/12/2016</td>
		  </tr>
	</tbody>
</table>

<h3>Paystub Hours Logged</h3>

<?php
//paystub table

$PID=$_SESSION['PID'];

//Connect to db
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

//Query to populate table with recently entered paystubs
$query = "SELECT DISTINCT p.PSID, p.Amount, p.Stub_Hours, p.S_Date, b.Business_Name, b.Position FROM Paystub_T as p, Business_T as b, Job_T WHERE Job_T.PID = $PID ORDER BY PSID;";
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
    echo "<i><font size=4 color='white'>You've not entered any paystubs.</font></i></br>";
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
