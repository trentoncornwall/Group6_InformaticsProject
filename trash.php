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
?>

<html>
<?php
print $_GET['JID'];
?>
<body>
<?PHP

	// Set up the deletion query.
	$db = connectDB($DBHost,$DBUser,$DBPasswd,$DBName);
	$query = 'SET FOREIGN_KEY_CHECKS=0;';
	$result = queryDB($query, $db);
	$query = 'DELETE FROM Job_T WHERE JID=' . $_GET['JID'] . ';'; 
	$result = queryDB($query, $db);
	$query = 'SET FOREIGN_KEY_CHECKS=1;';
	$result = queryDB($query, $db);

	header("Location: jobs.php");

?>
</body>
</html>
