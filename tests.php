
<?php 

// Create connection
$conn_test = new mysqli('localhost','root', '','tests');

// Check connection
if ($conn_test->connect_error) {
    die("Connection failed: " . $conn_test->connect_error);
}


?>


