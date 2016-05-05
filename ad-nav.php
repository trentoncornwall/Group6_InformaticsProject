
	
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>
				<a class="navbar-brand" href="#"><?php echo $_SESSION['username']; ?></a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav navbar-right">
					<li <?php if ($menuActive==0) echo "class='active'"; ?>><a href="admin.php">HOME</a></li>
					<li <?php if ($menuActive==1) echo "class='active'"; ?>><a href="adminbus.php"> BUSINESSES </a></li>
					<li <?php if ($menuActive==4) echo "class='active'"; ?>><a href="logout.php">LOG OUT</a></li>
				</ul>
			</div>
		</div>
	</nav>