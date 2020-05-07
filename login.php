<?php

include "connect.php";

				//real escapes
$user = mysqli_real_escape_string($conn,$_POST["username"]); 
$pass = mysqli_real_escape_string($conn,$_POST["password"]); 
	


// prepare and bind
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $user,$pass);
$stmt->execute();

$result = $stmt->get_result();


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
		padding: 10px 160px;
	}


	 #create_test{
		padding: 10px 146px;
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
				<center><a href="maintest.php" id='start_test' >Start Test</a></center>
				<br><br>
				<center><a href="working.html" id='create_test' >Create Test</a></center>

			
			
</div>

</header>

</body>
</html>
