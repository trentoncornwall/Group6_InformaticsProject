<html>
<!--
This page is reached after user logs in. This is their home. Access to everything
Orginally created by Trenton, if you have an questions ask.
-->
<header>

<?php
	include_once('config.php');
	include_once('dbutils.php');

// check if user logged in, if not, kick them to login.php
session_start();
if(!isset($_SESSION['username'])) {
	// if this is not set, it means they are not logged in
	header("Location: login.php");
}

$menuActive="0"	
?>



<title> Home </title>

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
		<h1><center><font color="White"><strong> Welcome </strong></font></center><hr width="50%"></h1>
	</div>
	
<center><font color="white">
<h4> Notification Center</h4> </br>
</center></font>


<!--Messages for Users-->
<?php 
	$PID = $_SESSION['PID'];
// This will look up the user's PID and IF the user PID is inside the Report_T then will notify the user that his paystub has been flagged as possible fraud
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$query = "SELECT  RID, Business_T.BID, Business_Name, Position, Hour_Difference, Pay_Difference FROM Business_T, Job_T, Report_T WHERE Report_T.PID = 3 AND Business_T.BID = Job_T.BID AND Job_T.PID = 3 AND Report_T.JID = Job_T.JID ORDER BY Business_Name;";
	$result = queryDB($query, $db);
	
// this will run if there is a result
	if (nTuples($result) > 0) {
		echo '<center> <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#myModal"> You have a paystub which showed signs of possible wage theft</button> </center>';
				
		
		}

?>

	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		
		<!--Modal Content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><center>Wage Theft Reports </center></h4>
			</div>
			<div class="modal-body">
				<p> <?php
					echo "<table class='table table-hover'>\n";
					echo "<thead><tr><th align=left>Business Name</th><th align=left>Position</th><th align=left>Hour Difference</th><th align=left>Pay Difference</th></tr></thead>\n";							
					while ($row=nextTuple($result)) {
						echo '<tr><td align=left>';
						echo $row['Business_Name'];
						echo '</td><td align=left>';
						echo $row['Position'];
						echo '</td><td align=left>';
						echo $row['Hour_Difference'];
						echo '</td><td align=left>';
						echo $row['Pay_Difference'];
						echo '</td></tr>';

						}
						
						
					
					echo "</table>\n";
					
					?>
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
		</div>
	</div>
<br>
</body>
<footer>
<?php
include_once("footer.php");
?>
</footer>
</div>
</div>

