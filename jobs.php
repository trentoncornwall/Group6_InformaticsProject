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
}
.container-2 {
	padding: 20px 20px;	
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
<div class="container-2">


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
	
	


	// connect
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	

	// Business TABLE FIRST
	$query = "INSERT INTO Business_T(Business_Name, Business_Address) VALUES ('$Business_Name', '$Business_Address');";
	$result = queryDB($query, $db);
	
	// Job Table NEXT
	// HAD AN ERROR TALK TO TEAM
	

	
}
?>



<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="White"><strong> Jobs </strong></font></center><hr width="50%"></h1>
	</div>
	


<!--List of Current Jobs-->
	<h4><font color="white"><b>Current Jobs</b></font></h4>
	<!--TABLE THAT SHOWS JOBS OF USER-->

<?php
	
	
//CREATING QUERY TO VIEW JOBS
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
$query = "SELECT b.Business_Name, b.Business_Address, b.BID, p.PID FROM Business_T as b, Person_T as p WHERE p.PID = b.BID;";
$result = queryDB($query, $db);

if (nTuples($result) > 0) {
    echo "<div><table class='table table-hover' align=center>\n";
    //echo "<tr><thead><th align=left>Name</th><th align=left>Address</th></thead></tr>\n";
    while ($row=nextTuple($result)) {
        echo '<tr><td align=left>';
        echo $row['Business_Name'];
        echo '</td><td align=left>';
        echo $row['Business_Address'];
        echo "</td></tr>\n";
      }
    echo "</div></table>\n";
} else {
     //No results found; display a message to that effect.
    echo "No Current Business Assigned To You</br>";
    }
?>

	
	
	<!--ADD JOBS-->
	<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
		<h4><font color="white"><b>Add Job </b></font></h4>
		
		<!--Business Name name= Business_Name-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="Business_Name" placeholder="Business Name"> </div>
		</div>
		
		<!--Business Address name= Business_Address-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="Business_Address" placeholder="Business Address"> </div>
		</div>
		
		<!--Business Address name= Business_Address-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="Position" placeholder="Your Position"> </div>
		</div>
		
		<!--BUTTON-->
		<center><button type="submit" class="btn btn-default btn-lg" name="submit">Submit</button></center>
	</form>

</div>


</body>


<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
