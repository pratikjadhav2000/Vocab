<?php


if (!isset($_POST['SignUpButton'])) {
	header("Location: signupmain.php");
		exit();
}

include "connect.php";
				
				//filter sql injections

	$firstname=mysqli_real_escape_string($conn,$_POST["firstname"]);
	$lastname=mysqli_real_escape_string($conn,$_POST["lastname"]);
	$email=mysqli_real_escape_string($conn,$_POST["email"]);
	$phone=mysqli_real_escape_string($conn,$_POST["phone"]);
	$username=mysqli_real_escape_string($conn,$_POST["username"]);
	$password=mysqli_real_escape_string($conn,$_POST["password"]);
	$vpassword=mysqli_real_escape_string($conn,$_POST["vpassword"]);

				//validation of the input

	if(empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($username)){

			header("Location: signupmain.php?error=emptyfields&username=".$username."&email=".$email);
			exit();
	}
	else if(!preg_match("/^[a-zA-Z]*$/", $firstname)){

		header("Location: signupmain.php?error=invalidfirstname&username=".$username."&mail=".$email);
			exit();

	}
	else if(!preg_match("/^[a-zA-Z]*$/", $lastname) ){

		header("Location: signupmain.php?error=invalidlastname&username=".$username."&mail=".$email);
			exit();

	}
	else if(!preg_match("/^[0-9]*$/", $phone)){

		header("Location: signupmain.php?error=invalidphonenumber&username=".$username."&mail=".$email);
			exit();

	}
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username) ){

		header("Location: signupmain.php?error=invalidmailuid");
			exit();

	}
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){

		header("Location: signupmain.php?error=invalidmail&uid=".$username);
			exit();

	}
	else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){

		header("Location: signupmain.php?error=invalidusername&mail=".$email);
			exit();

	}
	else if (strcmp($password, $vpassword) != 0) {
	 	//echo "Passwords do not match! Please re-enter passwords.";
	 	header("Location: signupmain.php?error=passwordsmismatch&username=".$username."&email=".$email);
			exit();
	 } 
	else{

			//check username already exists in the database

		$query="select * from users where username=?";
			if (!($stmt = $conn->prepare($query))) {
				 //echo("Error description: " . $conn -> error);
			header("Location: signupmain.php?error=sqlerrorusernamequery");
			exit();

			}
			else{
				$stmt->bind_param("s", $username);
				$stmt->execute();
				$result = $stmt->get_result();
				if(mysqli_num_rows($result) > 0){
						header("Location: signupmain.php?error=usernametaken");
						exit();
				}
				else{

				}
			}


			//if username is not in the database insert it

		$password=password_hash($password, PASSWORD_DEFAULT);
	 	$query="INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `email`, `phone`) VALUES (NULL,?,?,?,?,?,?)";

		if (!($stmt = $conn->prepare($query))) {

  		//echo("Error description: " . $conn -> error);
		header("Location: signupmain.php?error=sqlerrorinsertquery");
		exit();
		}
		else{
			 	// prepare and bind

		$stmt->bind_param("sssssi", $username,$password,$firstname,$lastname,$email,$phone);
		$stmt->execute();

		echo "Registration successfull !";
		header("Location: loginmain.php?signup=Registrationsuccessfull");
			}



	 }

?>