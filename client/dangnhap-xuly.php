<?php
session_start();
if (isset($_POST['dangnhap'])) {
    require '../connect.php';

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $query = "SELECT * FROM khachhang WHERE username='$username' AND password='$password'";
    // $row = $conn->query($query)->fetch_assoc();
    // var_dump($row);

    
    if ($conn->query($query)->num_rows > 0) {
        $khachhang=$conn->query($query)->fetch_assoc();
        $_SESSION['khachhang'] = $username;
        $_SESSION['id_kh'] = $khachhang['id_kh'];
        header('location: sanpham-ds.php');
    } else {
        echo ("LOI" . $conn->connect_error);
    }
}
