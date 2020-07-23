<?php

 if(isset($_GET['username'])){ 
 	$username=$_GET['username']; 
 	$err=$_GET['err']; 
}
else{
	$username="";
	$err="";
}

  ?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/homeimage.css">
	<title>Log in</title>
	<style>
		#err{
		color: red; 
	}
	</style>
</head>
<body>

		<header>
			<div class="main">
				
			<ul>
				<li ><a class="active" href="#">HOME</a> </li>
				<li><a href="#">CONTACTS</a> </li>
				<li><a href="#">ABOUT US</a> </li>
				<li><a href="#">LEARN MORE</a> </li>

			</ul>
				
			</div>

			<div class="titlelogin">
				<h1>VOCAB</h1>
			</div>

			<div class="login">
				<h1>LOG IN</h1><br>
				<form action="login.php" method="post">
					<input type="text" name="username" value="<?php echo $username ?>" placeholder="Username" class="inputbox"><br>
					<input type="password" name="password" value="" placeholder="Password" class="inputbox" ><br><br>
					<input type="submit" name="LogInButton" value="Log in" class="loginbutton">
					<p id='err'><?php echo $err ?></p>
				</form><br><br>

				
				<p>New User?</p>
				<a href="signupmain.php">Sign Up</a>
				
			</div>
		</header>
			
		
</body>
</html>