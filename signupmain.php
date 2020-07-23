<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/homeimage.css">
	<title>Signup</title>
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

			<div class="titlesignup">
				<h1>VOCAB</h1>
			</div>

			<div class="login">
				<h1>SIGN UP</h1><br>
				<form action="signup.php" method="post">
					<input type="text" name="firstname" value="" placeholder="FirstName" class="inputbox"><br>
					<input type="text" name="lastname" value="" placeholder="Lastname" class="inputbox"><br>
					<input type="text" name="email" value="" placeholder="Email" class="inputbox"><br>
					<input type="text" name="phone" value="" placeholder="Phone" class="inputbox"><br>
					<input type="text" name="username" value="" placeholder="Set Username" class="inputbox"><br>
					<input type="password" name="password" value="" placeholder="Set Password" class="inputbox" ><br>
					<input type="password" name="vpassword" value="" placeholder="Verify Password" class="inputbox" ><br><br>
					<input type="submit" name="SignUpButton" value="Sign Up" class="loginbutton">
				</form>
				
			</div>
		</header>
			
		
</body>
</html>