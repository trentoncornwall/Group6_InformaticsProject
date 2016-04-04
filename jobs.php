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
}
.container-2 {
	padding: 20px 20px;	
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
		<h1><center><font color="White"><strong> Jobs </strong></font></center><hr></h1>
	</div>
	


<!--List of Current Jobs-->
<div class="container-2">
	<h4><font color="white">Current Jobs</font></h4><br>
	<!--TABLE THAT SHOWS JOBS OF USER-->
	
	
	<!--ADD JOBS-->
	<form class="form-horizontal">
		<h4><font color="white">Add Job </font></h4>
		
		<!--Business Name id= Business_Name-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" id="Buisness_Name" placeholder="Buisness Name"> </div>
		</div>
		
		<!--Business Address id= Business_Address-->
		<div class="form-group">
			<div class="col-sm-12"> <input type="text" class="form-control" id="Buisness_Address" placeholder="Buisness Address"> </div>
		</div>
		
		<!--BUTTON-->
		<center><button type="submit" class="btn btn-default btn-lg">Submit</button></center>

</div>


</body>


<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
