
<?php 

// Create connection
$conn_test = new mysqli('localhost','slueatrx_vocab', 'Pratik@252239','slueatrx_vocab');

// Check connection
if ($conn_test->connect_error) {
    die("Connection failed: " . $conn_test->connect_error);
}


?>


