<?php
	include_once('config.php');
	include_once('dbutils.php');
?>

<?php
// PHP to log users in if they have a database entry

//POST on submit button pressed
if (isset($_POST['submit'])) {
	
	
//	echo '<p>we are processing form data</p>';
//	print_r($_POST);

	// get data from the input fields
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	
	// check to make sure we have an username
	if (!$username) {
		header("Location: login.php");
	}
	
	if (!$password) {
		header("Location: login.php");
	}

	// check if user is in the database
		// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query
	$query = "SELECT Username, HashedPass FROM Person_T WHERE Username='$username';";
	
	// run the query
	$result = queryDB($query, $db);
	
	
	// check if the username is there
	if (nTuples($result) > 0) {
		$row = nextTuple($result);
		
		if ($row['HashedPass'] == crypt($password, $row['HashedPass'])) {
			// Password is correct
			if (session_start()) {
				$_SESSION['username'] = $username;
				header('Location: home.php');
			} else {
				punt("Unable to create session");
			}
		} else {
			// Password is not correct
			punt('The password you entered is incorrect');
		}
	} else {
		punt("The username '$username' is not in our database");
	}	
	
}

?>

<html>
<!--
This page set to be the main page. The page the user first visit. Here the user will
beable to log in or create a user profile. Also were the admin logs in. Finially a little 
bit of information will be displayed at the bottom about wage theft.
Orginally created by Trenton, if you have an questions ask. 
-->


<header>
<title>Log In</title>

<!-- BOOTSTRAP CODE -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<!--ADDITIONAL CSS-->
<style>
.container {
	padding: 60px 20px;
}
</style>

</header>



<body>
<div class="container">
<!--This is a center block, helps keep vertyhing in the center for the theme-->
<div class="center-block col-sm-12" style="float: none; background-color: #52BE80">
	
	
<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="White"><strong> Log In </strong></font><hr><br></center></h1>
	</div>

<!-- LOG IN FORMS -->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<form class="form-horizontal">
		<center>
		<!-- Username name=username -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="username" placeholder="Username"> </div>
		</div>
		
		<!-- Password name=password -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="password" class="form-control" name="password" placeholder="Password"> </div>
		</div>
		<br>
		<!-- Log In Button-->
		<button type="submit" class="btn btn-default btn-lg" name="submit">Log In </button>
		
		<!--Create New User Button... Goes to newuser.php ..-->
		<a class="btn btn-default btn-lg" href="newuser.php" role="button"> Join </a>
	</form>
	<br><br>
<!-- WAGE THEFT INFO -->

	<!-- Trigger the modal with a button -->
	<button type="button" class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal"> What Is Wage Theft? </button>
	
	<!--Modal-->
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		
		<!--Modal Content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Wage Theft</h4>
			</div>
			<div class="modal-body">
				<p> 
					Wage theft happens when people do not get paid what they are legally entitled to as part of a job. Typical concerns include not being paid for
					overtime, violations of minimum wage laws, illegal deductions in pay, working off the clock, or not being
					paid at all.Individual workers often do not seek legal action in these cases as they fear they may lose their jobs
					and/or have difficulty finding another job. Our organization offers you the ability to track hours and how much you
					should be getting paid to notifiy you if you're a victim of wage theft as well notifications if others at your job are also victims of wage theft.
				</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	
	</center>
	<br><br>
</body>

<footer>
<?php
	include_once('footer.php');
?>
</footer>

</div>
</div>
</html>
