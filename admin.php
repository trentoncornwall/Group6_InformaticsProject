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
$menuActive="0"
?>	
	
	
<title> Admin </title>

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
		<h1><center><font color="White"><strong> Admin </strong></font></center><hr></h1>
	</div>
	


<!--Tables-->
<div class="container-2">
    <h2> Users </h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Job(s)</th>
                <th>Business</th>
                <th>#</th>
                <th>Address</th>
            </tr>
        </thead>
        <tbody>
			<?php
			
			$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
			
			$query = ("SELECT p.FName, p.LName, p.PID, b.Business_Name, b.Business_Address, b.Position FROM Person_T as p, Business_T as b, Job_T as j WHERE p.PID = j.PID and b.BID = j.BID ORDER BY PID;");
			
			$result = queryDB($query, $db);
			
			
			// Back to PHP to handle the rows in the table, tuple by tuple.
			while ($row=nextTuple($result)) {
				
				//make a variable that combines fname and lname
				
				//make a while loop that puts the bussiness into one row and a loop for address
				
				// Useful for debugging; leave commented out otherwise.
				// echo "\n<!-- ", print_r($row), " -->\n";
				echo "\n <tr>";
				echo "<td>" . $row['FName'] . "</td>"; //need to add a hyperlink to these rows
				echo "<td>" . $row['Position'] . "</td>";
				echo "<td>" . $row['Business_Name'] . "</td>";
				echo "<td>" . $row['Business_Addres'] . "</td>";
				echo "<td>" . $row['PID'] . "</td>";
				echo "</tr>";
			
			  }
			  
			?>
        </tbody>
    </table>
    
    





</body>


<footer>
<?php
	include_once('footer.php');
?>
</footer>
</div>
</div>
