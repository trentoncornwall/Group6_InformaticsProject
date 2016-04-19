<html>
<header>
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
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Hours</th>
			<th>Start Date</th>
			<th>End Date</th>
		</tr>
	</thead>
	<tbody>
		  <tr>
			<td>39.50</td>
			<td>03/10/16</td>
			<td>03/24/16</td>
		  </tr>  
	</tbody>
</table>
</font>
</div>
</body>


<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
