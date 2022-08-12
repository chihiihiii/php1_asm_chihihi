<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "php1_asm"; // dat ten gi thi lam on de vao gium

// Create connection
$conn = new mysqli($servername, $username, $password, $database);


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
