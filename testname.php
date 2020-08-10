<?php 

if(isset($_GET['username']) && isset($_GET['userid'])){ 
 	$username=$_GET['username']; 
 	 $userid=$_GET['userid']; 
}
else{
header("Location: loginmain.php?error=unknownacess");
exit();
	
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Create test</title>
	<style>
		.create_test{
	position: absolute;
	top: 32%;
	left: 50.55%;
	transform: translate(-50%, -50%);

	width: 700px;
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

.create_test p{
		color: blue;
		
	}

	#createtest{
		/* padding: 10px 160px; */ 
		font-size: 20px;
		width: 30%;
	}


	</style>
</head>
<body>

		<header>

			<div class="create_test">
				<h1>ENTER TEST NAME </h1><br>

				<form action="createtestconf.php?<?php echo "username=".$username."&userid=".$userid; ?>" method="post">

					<input type="text"  name="testname" value="" placeholder="" class="inputbox"><br>
					<input type="submit" id='createtest' class="loginbutton" name="testnamebutton" value="Create" >

				</form>
				
			</div>
		</header>
			
		
</body>
</html>