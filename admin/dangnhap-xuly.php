<?php
session_start();
if (isset($_POST['dangnhap'])) {
    require '../connect.php';

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    // $row = $conn->query($query)->fetch_assoc();
    // var_dump($row);

    
    if ($conn->query($query)->num_rows > 0) {
        $_SESSION['admin'] = $username;
        header('location: index.php');
    } else {
        echo ("LOI" . $conn->connect_error);
    }
}
