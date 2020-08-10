<?php

if (isset($_POST['LogInButton']) || isset($_GET['createdtest']) ) {

include "connect.php";

				//real escapes
$user = mysqli_real_escape_string($conn,$_POST["username"]); 
$pass = mysqli_real_escape_string($conn,$_POST["password"]); 
	


		// prepare and bind
		
		$query="SELECT * FROM users WHERE username = ? ";

		if (!($stmt = $conn->prepare($query))) {

  		//echo("Error description: " . $mysqli -> error);
		header("Location: loginmain.php?error=sqlerrorloginquery");
		exit();
		}
		else{
			 	// prepare and bind

		$stmt->bind_param("s", $user);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();

		
			}


?>


<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" type="text/css" href="homeimage.css">
	<title>Welcome home!</title>
	<STYLE>

		A {
		text-decoration: none;
	width: 100%;
	
	border-radius: 20px;
	font-size: 22px;
	margin: 10px 10px;
	border: none;
	outline: none;
	cursor: pointer;
	transition: 0.6s ease;
	background: lightgray;
	color: #000;
	} 

	A:hover{
			background-color: green;
	color: #fff;


	} 

	#start_test{
		/* padding: 10px 160px; */ 
		font-size: 20px;
		width: 70%;
	}


	 #create_test{
		/* padding: 10px 146px;  */
		font-size: 20px;
		width: 70%;
	}


</STYLE>
</head>
<body>

<header>
	
	<div class="title">
	<h1>
		<?php


if (mysqli_num_rows($result) == 1 && password_verify($pass,$row["password"]) && strcmp($user, $row["username"])== 0 ) {

	
	
	echo "Welcome ".$row["firstname"];
	$userid=$row["user_id"];
}
 else {
//Fail
	header("Location: loginmain.php?err=username or password wrong&username=".$_POST["username"]);
	exit();
}


?>
	</h1>

						
				<br><br>
				<center><form action="mytests.php?<?php echo "username=".$user."&userid=".$userid; ?>" method="post">
					<input type="submit" id='start_test' class="loginbutton" name="StartTest" value="Start Test">
				</form></center>
				
				<center><form action="testname.php?<?php echo "username=".$user."&userid=".$userid; ?>" method="post">
					<input type="submit" id='create_test' class="loginbutton" name="CreateTest" value="Create Test">
				</form></center>

			
			
</div>

</header>

</body>
</html>

<?php 


}
else{
	header("Location: loginmain.php?error=unknownacess");
exit();
}


?>