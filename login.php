<?php

include "connect.php";

	$user=$_POST["username"];
	$pass=$_POST["password"];

$query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'" ;
$result = mysqli_query($conn,$query);


?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Welcome home!</title>
	<STYLE>

		A {
		text-decoration: none;
	width: 100%;
	padding: 10px 160px;
	border-radius: 20px;
	font-size: 22px;
	margin: 10px 0;
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


</STYLE>
</head>
<body>

<header>
	
	<div class="title">
	<h1>
		<?php


if (mysqli_num_rows($result) == 1) {

	$row = $result->fetch_assoc();
	
	echo "Welcome ".$row["firstname"];
	
}
 else {
//Fail
	echo "Wrong username or password!";
	return ;
}

?>
	</h1>

								
				<br><br>
				<center><a href="maintest.php" >Start Test</a></center>
			
			
</div>

</header>

</body>
</html>