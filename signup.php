<?php


include "connect.php";

	$firstname=$_POST["firstname"];
	$lastname=$_POST["lastname"];
	$email=$_POST["email"];
	$phone=$_POST["phone"];
	$username=$_POST["username"];
	$password=$_POST["password"];
	$vpassword=$_POST["vpassword"];

	 if (strcmp($password, $vpassword) != 0) {
	 	echo "Passwords do not match! Please re-enter passwords.";
	 } 
	 else{
	 	$query = "INSERT INTO `users` (`user_id`, `username`, `password`, `firstname`, `lastname`, `email`, `phone`) VALUES (NULL, '$username', '$password', '$firstname', '$lastname', '$email', '$phone')" ;
$result = mysqli_query($conn,$query);

	if (!$result) {
  echo("Error description: " . $mysqli -> error);
}
	else{
		echo "Registration successfull !";
	}


	 }
	



?>