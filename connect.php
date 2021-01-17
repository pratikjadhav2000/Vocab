
<?php 

// Create connection
$conn = new mysqli('localhost','slueatrx_vocab', 'Pratik@252239','slueatrx_vocab');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


?>


