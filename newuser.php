<?php
	include_once('config.php');
	include_once('dbutils.php');
	include_once('hashutil.php');	
?>


<html>
<!--
This page is reached after pressing new user button at login.php. It allows users to create
a profile requesting specific information. Orginally created by Trenton, if you have an questions ask.
-->
<header>
<title> New User </title>

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
<?php
// PHP to add users to database.
// POST if submit button is pressed
if (isset($_POST['submit'])) {

	// get data from the input fields
	$username = $_POST['username'];
	$password1 = $_POST['password1'];
	$password2 = $_POST['password2'];
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$address = $_POST['address'];
	
	// check to make sure we have username
	if (!$username) {
		punt("Please enter a username");
	}

	if (!$password1) {
		punt("Please enter a password");
	}

	if (!$password2) {
		punt("Please enter your password twice");
	}
	
	if ($password1 != $password2) {
		punt("Your two passwords are not the same");
	}

	// check if username already in database
		// connect to database
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	
	// set up my query
	$query = "SELECT Username FROM Person_T WHERE Username='$username';";
	
	// run the query
	$result = queryDB($query, $db);
	
	// check if the username is there
	if (nTuples($result) > 0) {
		punt("The username $username is already taken");
	}
	
	// generate hashed password
	$hashedPass = crypt($password1, getSalt());
	
	// set up my query
	$query = "INSERT INTO Person_T(Username, HashedPass, LName, FName, Email, Phonenumber, Address) VALUES ('$username', '$hashedPass', '$lname', '$fname', '$email', '$phone', '$address');";
	
	// run the query
	$result = queryDB($query, $db);
	
	// tell users that we added the person to the database
	echo "<div class='panel panel-default'>\n";
	echo "\t<div class='panel-body'>\n";
    echo "\t\tThe user " . $username . " was added to the database\n";
	echo "</div></div>\n";
	
}
?>
<div class="container">
<!--This is a center block, helps keep vertyhing in the center for the theme-->
<div class="center-block col-md-12" style="float: none; background-color: #52BE80">

<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="white"><strong> New User </strong></font><hr></center></h1>
	</div>
	
<!--FORM INPUT FOR NEW USER -->
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">	
	<form class="form-horizontal">
		<h4><font color="white">User Info </font></h4>
		<!--Username name= username -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="username" placeholder="Username"> </div>
		</div>

		<!-- Password1 name= password1 -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="password" class="form-control" name="password1" placeholder="Password"> </div>
		</div>
		
		
		<!-- Password2 name= password2 -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="password" class="form-control" name="password2" placeholder="Repeat Password"> </div>
		</div>
		<br>
		
		
		<h4><font color="white">Personal Info </font></h4>
		<!-- First Name name= fname --->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="fname" placeholder="First Name"> </div>
		</div>
		
		<!-- Last Name name= lname-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="lname" placeholder="Last Name"> </div>
		</div>
		<!-- Email name= email -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="email" placeholder="E-mail ##@example.com"> </div>
		</div>
		
		<!--Phone Number name= phone-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="phone" placeholder="Phone Number ###-###-####"> </div>
		</div>		
		<!--Address name= address -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" name="address" placeholder="Address"> </div>
		</div>		
		
		<!--SUBMIT BUTTON -->
		<center><button type="submit" class="btn btn-default btn-lg" name="submit" href="login.php">Submit</button></center>
		<br><br>
	</form>
</body>

<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
</html>