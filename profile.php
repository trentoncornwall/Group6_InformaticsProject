<html>
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

$menuActive="5"	
?>

<title> Profile </title>

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
<?php
// Clicking Edit will update the profile
if (isset($_POST['submit'])) {
	
	$PID = $_SESSION['PID'];
	$FName = $_POST['FName'];
	$LName = $_POST['LName'];
	$Email = $_POST['Email'];
	$Address = $_POST['Address'];

	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$query = "UPDATE Person_T SET FName='$FName', LName='$LName', Email='$Email', Address='$Address' WHERE PID='$PID';";
	$result = queryDB($query, $db);

	}
?>

<?php
// collects all the info about user

$PID = $_SESSION['PID'];
$FName = "";
$LName = "";
$Email = "";
$Phonenumber = "";
$Address = "";

// set up query to collect
$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
$query = "SELECT * FROM Person_T WHERE PID='$PID';";
$result = queryDB($query, $db); 

//collect and insert into empty varibles

if (nTuples($result) > 0) {
    while ($row=nextTuple($result)) {
		$FName = $row['FName'];
		$LName = $row['LName'];
		$Email = $row['Email'];
		$Phonenumber = $row['Phonenumber'];
		$Address = $row['Address'];
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
		<h1><center><font color="White"><strong> Profile </strong></font></center><hr width="50%"></h1>
	</div>
	


<!--Shows user information-->
<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

	<div class="form-group">
	<div class="col-sm-12">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">First name</span>
		  <input type="text" class="form-control" name="FName" value=<?php echo $FName ?>>
		</div>
	</div>
	</div>


	<div class="form-group">
	<div class="col-sm-12">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Last name</span>
		  <input type="text" class="form-control" name="LName" value=<?php echo $LName ?>>
		</div>
	</div>
	</div>

	<div class="form-group">
	<div class="col-sm-12">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Email name</span>
		  <input type="text" class="form-control" name="Email" value=<?php echo $Email?>>
		</div>
	</div>
	</div>
	
	<div class="form-group">
	<div class="col-sm-12">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Phone</span>
		  <input type="text" class="form-control" name="Phonenumber" value=<?php echo $Phonenumber?>>
		</div>
	</div>	
	</div>	

	<div class="form-group">
	<div class="col-sm-12">
		<div class="input-group">
		  <span class="input-group-addon" id="basic-addon1">Address</span>
		  <input type="text" class="form-control" name="Address" value=<?php echo $Address?>>
		</div>
	</div>
	</div>

	<center><button type="submit" class="btn btn-default btn-lg" name="submit" onclick="Alert()">Edit</button></center>
</form>

<script>
function Alert() {
    alert("Your profile has been updated");
}
</script>

</body>
<footer>
<br>
<?php
	include_once('footer.php');
?>
</div>
</footer>
</div>
</div>
