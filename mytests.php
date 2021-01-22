<?php

 if( !isset($_GET['userid']) && !isset($_GET['username']) ){ 
 	
 	header("Location: loginmain.php?err=unknownaccess");
 	 exit();
 	
}
else{
	$username=$_GET['username'];
	$userid=$_GET['userid']; 

}

include "connect.php"

  ?>

<!DOCTYPE html>
<html>
<head>

	<title>Create test</title>
	<style>
		.create_test{
	position: absolute;
	top: 32%;
	left: 47.55%;
	transform: translate(-50%, -50%);

	width: 100%;
	box-shadow: 0 0 3px 0 rgba(0,0,0,0.3);
	background: #fff;
	padding: 40px;
	margin: 8% auto 0;
	text-align: center;
}

.create_test h1{
		color: #000;
		font-size: 30px;
	}

.create_test ul{

			list-style-type: none;
		
	}	
.create_test li{
		
		margin: 40px 100px 40px 50px;
	}
.create_test a{
	width: 50%;
	color: #000;
	text-decoration: none;
	padding: 10px 40px;
	border-radius: 20px;
	font-size: 25px;
	margin: 10px 10px;
	border: none;
	outline: none;
	cursor: pointer;
	transition: 0.6s ease;
	background: lightgray;

		
	}
.create_test a:hover{
		background-color: green;
		color: #fff;
		
	}	

.logoutbutton{
	
	width: 10%;
	padding: 10px 10px 10px 10px;
	border-radius: 20px;
	font-size: 15px;
	margin: 10px 0;
	border: none;
	outline: none;
	cursor: pointer;
	transition: 0.6s ease;
	background: lightgray;
	float: right;
	top: 0;
	text-align: center;

}

.logoutbutton:hover{
	background-color: green;
	color: #fff;
}

	</style>
</head>
<body>

		<header>

				<form action="loginmain.php" method="post">
					<input type="submit" class="logoutbutton" name="logout" value="LogOut">
				</form>
				<p class="logoutbutton"><?php echo $username ?></p><br><br>

				
			<div class="create_test">

				<h1>MY TESTS</h1><br>
				<ul>

				<li><a href="maintest.php?<?php echo "username=".$username."&userid=default&testname=test"; ?>">Default Test</a> </li>

				<!--	write the php code here to fetch the tests -->
				<?php

			$query="select * from master where user_id=?";

			if (!($stmt = $conn->prepare($query))) {
				 echo("Error description: stmtprepare" . $conn -> error);
			//header("Location: signupmain.php?error=sqlerrorusernamequery");
			exit();

			}
			else{
				
				$stmt->bind_param("i",$userid);
				
				if(!$stmt->execute()){
						echo("Error description: stmtexecute " . $conn -> error);
						exit();
				}
						//store the result variable here
				$result = $stmt->get_result();

				while( $row = $result->fetch_assoc() ){

					echo "<li><a href='maintest.php?username=".$username."&userid=".$userid."&testname=".$row["test_name"]."'>".$row["test_name"]."</a> </li>";

				}
				
			}

				 ?>
					
				</ul>
				
			</div>
			

		</header>
			
		
</body>
</html>