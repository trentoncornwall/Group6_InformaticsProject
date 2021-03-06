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
$menuActive="3"
?>	
	
<title> Paystub </title>

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
<!--NAV BAR -->
<?php
	include_once('navbar.php')
?>
<!--This is a center block, helps keep vertyhing in the center for the theme-->
<div class="center-block col-sm-12" style="float: none; background-color: #52BE80">

<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="White"><strong> Paystub </strong></font></center><hr width="50%"></h1>
	</div>
	
<?php
$PID = $_SESSION['PID'];

// connect
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

$query = "SELECT b.Business_Name, b.Position, b.Business_Address, j.JID FROM Business_T as b, Job_T as j, Hours_T WHERE j.PID = $PID AND b.BID = j.BID AND Hours_T.JID = j.JID ORDER BY Business_Name;";

$result = queryDB($query, $db);

$Job_Options = "";

if (nTuples($result) > 0) {
    while ($row=nextTuple($result)) {
		$Job_Options .= "\t\t\t";
		$Job_Options .= "<option value='";
		$Job_Options .= $row['JID'] . "'>" . $row['Business_Name'] . "  -  " . $row['Position'] . "  -  " . $row['Business_Address'] . "</option>\n";
		}
	}

	
	
?>


<!--Entering in Date-->
<!--Entering in Date-->
	
	<div class="boostrap-iso">
		<div class="container-fluid">
			<div class="row">



		

			<!--Form Code Begins-->
			<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			
			
				<!--Date id=s_date -->
				<div class="form-group"><div class="col-sm-12">
						<input class="form-control" id="s_date" name="s_date" placeholder=" Start Date yyyy-mm-dd" type="text"/>
				</div></div>
				
				<script>
					var date_input=$('input[name="s_date"]'); //our date input has the name "date"
					var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
					var options={
						format: 'yyyy-mm-dd',
						container: container,
						todayHighlight: true,
						autoclose: true,
						};
					date_input.datepicker(options); //initiali110/26/2015 8:20:59 PM ze plugin
				</script>
				
				
				
				<!--Date id=paydate -->
				<div class="form-group"><div class="col-sm-12">
						<input class="form-control" id="e_date" name="e_date" placeholder="End Date yyyy-mm-dd" type="text"/>
				</div></div>
				
				<script>
					var date_input=$('input[name="e_date"]'); //our date input has the name "date"
					var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
					var options={
						format: 'yyyy-mm-dd',
						container: container,
						todayHighlight: true,
						autoclose: true,
						};
					date_input.datepicker(options); //initiali110/26/2015 8:20:59 PM ze plugin
				</script>
				

				<!--id=hours-->
				<div class="form-group"><div class="col-sm-12">
						<input type="number" step="0.1" class="form-control" name="hours" placeholder="Hours">
				</div></div>
				  
				<!--Amount-->
				<div class="form-group"><div class="col-sm-12">
					<div class="input-group">
						<span class="input-group-addon">$</span>
						<input type="number" step="0.01" class="form-control" name="amount" placeholder="Amount Paid - Dollars">
					</div>
				</div></div>
				
				
				<!-- Drop down box for jobs -->
				<div class="form-group"> <div class="col-sm-12">
				<select class="form-control" name="JID"><?php echo $Job_Options; ?></select>
				</div></div>
				<br>
				
				<!--SUBMIT BUTTON -->
				<div class="form-group"><div class="col-sm-12"> 
					<center><button class="btn btn-default btn-lg" name="submit" type="submit">Submit</button></center>
				</div></div>
			</form>
			
			
			</div>
		</div>
	</div>




<?php

//check to make sure it was submited
	// create varibles to enter into query
if (isset($_POST['submit'])) {
	$Username = $_SESSION['username'];
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	
	$s_date = $_POST['s_date'];
	$e_date = $_POST['e_date'];
	$amount = $_POST['amount'];
	$hours = $_POST['hours'];
	$JID = $_POST['JID'];
	
    if (!$s_date){
		punt("Please enter a start date");        
    }
	if (!$e_date){
		punt("Please enter an end date");        
    }
	if (!$amount){
		punt("Please enter an amount of wage");        
    }
	if (!$hours){
		punt("Please enter an amount of hours worked");        
    }
	if (!$JID){
		punt("Please choose a job");        
    }
	else{   
		$query = "SELECT * FROM Paystub_T WHERE Paystub_T.JID = $JID AND S_Date = '$s_date' AND E_Date = '$e_date';";
		$result = queryDB($query, $db);
		
		if (nTuples($result) > 0) {
			punt("This pay stub as already been added");
		} else {
		
			// set the query
			$query = "INSERT INTO Paystub_T (JID, Amount, Stub_Hours, S_Date, E_Date) VALUES ('$JID', '$amount', '$hours', '$s_date', '$e_date');";
			
			// run the query
			$result = queryDB($query, $db);
		}


					
		
		//set up query to call total hours entered
		$query = "SELECT SUM(Hours) AS Total_Hours FROM Hours_T WHERE Hours_T.Hours_Date <= '$e_date' AND Hours_T.Hours_Date >= '$s_date' AND Hours_T.JID = $JID;";
		
		$result = queryDB($query, $db);
		
		$tuple = nextTuple($result);
		
		$Total_Hours = $tuple['Total_Hours'];
		
		
		//select job wage to calculate expected wage
		$query = "SELECT Wage FROM Job_T WHERE Job_T.JID = $JID;";
		
		$result = queryDB($query, $db);
		
		$tuple = nextTuple($result);
		
		
		$Hourly_Wage = $tuple['Wage'];
		
		//multiply hourly wage by total hours worked
		$Expected_Pay = $Total_Hours * $Hourly_Wage;
		
		//compare expected with actual pay
		$Pay_Difference = "";
		$Hour_Difference = "";

		if (($Expected_Pay != $amount) or ($Total_Hours != $hours)) {
			
			$Pay_Difference = abs($amount - $Expected_Pay);
			
			$Hour_Difference = abs($hours - $Total_Hours);
			//set up query to access PSID of date range submitted for the user with JID of $JID
			$query = "SELECT PSID FROM Paystub_T WHERE S_Date = '$s_date' AND E_Date = '$e_date' AND Paystub_T.JID = $JID;";
			$result = queryDB($query, $db);
			$tuple = nextTuple($result);
			$PSID = $tuple['PSID'];
			
			//query to insert difference as a report. we insert difference and PSID, report ID is generated for each report generated
			$query = "INSERT INTO Report_T (PSID, PID, JID, Pay_Difference, Hour_Difference) VALUES ('$PSID', '$PID', '$JID', '$Pay_Difference', '$Hour_Difference');";
			$result = queryDB($query, $db);
			

			echo 	'<div class="alert alert-danger alert-dismissible" role="alert">';
			echo 	'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
			echo	'<strong>ALERT!</strong> We noticed a new flag with the recent Pay stub submission - Check the Notification Center on Home Page. <strong>ALERT!</strong>';
			echo	'</div>';

		}

		
		}

	}


?>

<!-- Paystub Table -->

<?php
//paystub table

$PID=$_SESSION['PID'];

//Connect to db
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);

//Query to populate table with recently entered paystubs
$query = "SELECT PSID, Amount, Stub_Hours, S_Date, E_Date, Business_Name, Position FROM Paystub_T, Business_T, Job_T WHERE Job_T.PID = $PID AND Paystub_T.JID = Job_T.JID AND Business_T.BID = Job_T.BID ORDER BY S_Date DESC;";
$result = queryDB($query,$db);

if (nTuples($result) > 0) {
    // Creating table
    echo "<table class='table table-hover'>\n";
    echo "<thead><tr><th align=left>Business Name</th><th align=left>Position</th><th align=left>Hours</th><th align=left>Amount</th><th align=left>Start Date</th><th align=left>End Date</th><th></th></tr></thead>\n";
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
		echo '</td><td align=left>';
		echo '<a href=' . genURL('trashps.php?PSID=' . $row['PSID']) . '><font color=red><span class="glyphicon glyphicon-remove" aria-hidden="true"></font></span></a>';
        echo "</td></tr>\n";			
	  }
    echo "</table>\n";
} else {
    // No paystubs have been entered.
    echo "<font size=4 color='white'><center>You've not entered any paystubs.</center></font></br>";
    }

?>
	<div class="alert alert-info alert-dismissible" role="alert">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<center><strong>Heads up!</strong> Make sure you've entered in all of your hours before submitting your pay stub.</center>
	</div>

</body>


<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
