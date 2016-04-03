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
<div class="container">
<!--This is a center block, helps keep vertyhing in the center for the theme-->
<div class="center-block col-md-12" style="float: none; background-color: #52BE80">

<!-- PAGE HEADER -->
	<div class="col-xs-12">
		<h1><center><font color="white"><strong> New User </strong></font><br></center></h1>
	</div>
	
<!--FORM INPUT FOR NEW USER -->
	<form class="form-horizontal">
		<h4><font color="white">User Info </font></h4>
		<!--Username id= username -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" id="username" placeholder="Username"> </div>
		</div>

		<!-- Password1 id= password1 -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="password" class="form-control" id="password1" placeholder="Password"> </div>
		</div>
		
		
		<!-- Password2 id= password2 -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="password" class="form-control" id="password2" placeholder="Repeat Password"> </div>
		</div>
		<br>
		
		
		<h4><font color="white">Personal Info </font></h4>
		<!-- First Name id= fname --->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" id="fname" placeholder="First Name"> </div>
		</div>
		
		<!-- Last Name id= lname-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" id="lname" placeholder="Last Name"> </div>
		</div>
		<!-- Email id= email -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" id="email" placeholder="E-mail ##@example.com"> </div>
		</div>
		
		<!--Phone Number id= phone-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" id="phone" placeholder="Phone Number ###-###-####"> </div>
		</div>		
		<!--Address id= adress -->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" id="adress" placeholder="Address"> </div>
		</div>		
		
		<!--SUBMIT BUTTON -->
		<center><button type="submit" class="btn btn-default btn-lg">Submit</button></center>
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