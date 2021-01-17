<?php

 if(!isset($_GET['testname']) || !isset($_GET['userid']) || !isset($_GET['username']) ){ 
 	
 	header("Location: testname.php?userid=".$userid);
 	 exit();
 	
}
else{
	$testname=$_GET['testname'];
	$userid=$_GET['userid'];
	$username=$_GET['username']; 

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

	#AddQuestion{
		/* padding: 10px 160px; */ 
		font-size: 20px;
		width: 30%;
	}
	#Done{
		/* padding: 10px 160px; */ 
		font-size: 20px;
		width: 30%;
	}


	</style>
</head>
<body>

		<header>

			<div class="create_test">
				<h1>CREATE TEST <?php echo $testname; ?> </h1><br>
				<form action="createtestconf.php?<?php echo "testname=".$testname."&userid=".$userid."&username=".$username; ?>" method="post">
					<input type="text" name="question" value="" placeholder="Question" class="inputbox"><br>
					<input type="text" name="answer" value="" placeholder="Answer" class="inputbox"><br>
					<input type="text" name="option1" value="" placeholder="Option1" class="inputbox"><br>
					<input type="text" name="option2" value="" placeholder="Option2" class="inputbox"><br>
					<input type="text" name="option3" value="" placeholder="Option3" class="inputbox"><br>
					<input type="text" name="option4" value="" placeholder="Option4" class="inputbox" ><br>
					<input type="submit" name="addquestion" value="Add this Question" class="loginbutton" id='AddQuestion'>
					<input type="submit" name="done" value="Done" class="loginbutton" id='Done'>
				</form>
				
			</div>
		</header>
			
		
</body>
</html>