<?php


include "connect.php";
include "tests.php";



if ( isset($_POST['testnamebutton']) ) {

if(isset($_GET['username']) && isset($_GET['userid'])){ 
 	$username=$_GET['username']; 
 	 $userid=$_GET['userid']; 
}
else{
	header("Location: loginmain.php?error=unknownacess");
exit();
	
}

//$tablename= userid + testname input by user
														
$testname=$_POST['testname'];
$tablename=mysqli_real_escape_string($conn_test,$userid."_".$testname);

//check whether the tablename already exists in the database tests
$query="show tables where Tables_in_slueatrx_vocab=?";

			if (!($stmt = $conn_test->prepare($query))) {
				 echo("Error description: " . $conn_test -> error);
			//header("Location: signupmain.php?error=sqlerrorusernamequery");
			exit();

			}
			else{
				
				$stmt->bind_param("s", $tablename);
				//$stmt->execute();
				
				if(!$stmt->execute()){
						echo("Error description: " . $conn_test -> error);
						exit();
						}
				$result = $stmt->get_result();
				if(mysqli_num_rows($result) > 0){
					header("Location: testname.php?username=".$username."&userid=".$userid."&err=test-already-exists"); 	 			//handle this error
						exit();
						}
				}
			
					// else create the table in the database

$query="CREATE TABLE `slueatrx_vocab`.`$tablename` ( `question_id` INT NOT NULL AUTO_INCREMENT , `question` TEXT NOT NULL , `answer` TEXT NOT NULL , `option1` TEXT NOT NULL , `option2` TEXT NOT NULL , `option3` TEXT NOT NULL , `option4` TEXT NOT NULL , PRIMARY KEY (`question_id`)) ENGINE = InnoDB;";

			if (!($stmt = $conn_test->prepare($query))) {
				 echo("Error description: stmtprepare" . $conn_test -> error);
			//header("Location: signupmain.php?error=sqlerrorusernamequery");
			exit();

			}
			else{
				
				//$stmt->execute();
				
				if(!$stmt->execute()){
						echo("Error description: stmtexecute " . $conn_test -> error);
						exit();
				}
						
						//header("Location: createtest.php?testname=".$testname."&userid=".$userid);
					//echo "Success creating table!  ";
				
			}

			//insert userid,testname and tablename in the master table

$query="INSERT INTO `master` (`test_id`, `table_name`, `test_name`, `user_id`) VALUES (NULL,?,?,?)";

			if (!($stmt = $conn_test->prepare($query))) {
				 echo("Error description: stmtprepare" . $conn_test -> error);
			//header("Location: signupmain.php?error=sqlerrorusernamequery");
			exit();

			}
			else{
				
				//$stmt->execute();
				$stmt->bind_param("ssi",$tablename,$testname,$userid);
				if(!$stmt->execute()){
						echo("Error description: stmtexecute " . $conn_test -> error);
						exit();
				}
						
						header("Location: createtest.php?testname=".$testname."&userid=".$userid."&username=".$username);
							exit();
					//echo "Success creating table!  ";
				
			}			



}




if (isset($_POST['addquestion'])) {

	if( isset($_GET['userid']) && isset($_GET['username']) ){ 
 	 $userid=$_GET['userid'];
 	 $username=$_GET['username']; 
}
else{
	header("Location: loginmain.php?error=useridtesterror");
exit();
	
}



if( isset($_GET['testname']) ){ 
 	$testname=$_GET['testname'];
}
else if( isset($_POST['testname']) ){
	$testname=$_POST['testname'];
}
else{
	header("Location: loginmain.php?error=testnameerror");
exit();
	
}
	
	//$tablename= userid + testname input by user
														

$tablename=mysqli_real_escape_string($conn_test,$userid."_".$testname);

	//insert question into the database

$question=mysqli_real_escape_string($conn_test,$_POST["question"]);
$answer=mysqli_real_escape_string($conn_test,$_POST["answer"]);
$option1=mysqli_real_escape_string($conn_test,$_POST["option1"]);
$option2=mysqli_real_escape_string($conn_test,$_POST["option2"]);
$option3=mysqli_real_escape_string($conn_test,$_POST["option3"]);
$option4=mysqli_real_escape_string($conn_test,$_POST["option4"]);


$query="INSERT INTO $tablename (`question_id`, `question`, `answer`, `option1`, `option2`, `option3`, `option4`) VALUES (NULL,?,?,?,?,?,?)";

			if (!($stmt = $conn_test->prepare($query))) {
				 echo("Error description: " . $conn_test -> error);
			//header("Location: signupmain.php?error=sqlerrorusernamequery");
			exit();

			}
			else{
				$stmt->bind_param("ssssss",$question,$answer,$option1,$option2,$option3,$option4);
				$stmt->execute();

						//header("Location: signupmain.php?error=usernametaken");
					echo "Success inserting values!";
				
			}	


header("Location: createtest.php?testname=".$testname."&userid=".$userid."&username=".$username);
exit();
}



if (isset($_POST['done'])) {

	if(isset($_GET['username']) && isset($_GET['userid'])){ 
 	$username=$_GET['username']; 
 	 $userid=$_GET['userid']; 
   }
	else{
	header("Location: loginmain.php?error=unknownacess");
	exit();
	
	}

header("Location: mytests.php?username=".$username."&userid=".$userid);
exit();

}


?>