<?php

if (isset($_POST['them'])) {
    require '../connect.php';

    $ten = $_POST['ten'];
    $trangthai = $_POST['trangthai'];

    $query = "INSERT INTO loaisanpham (ten, trangthai) VALUES ('$ten', '$trangthai')";

    // thuc hien them 
    if ($conn->query($query) === true) {
        header('location: loaisanpham-ds.php');
    } else {
        echo ("LOI" . $conn->connect_error);
        // header('location: loaisanpham-ds.php');
    }
} else {
    header('location: index.php');
}
