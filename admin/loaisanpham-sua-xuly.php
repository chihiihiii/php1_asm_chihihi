<?php

if (isset($_POST['sua'])) {
    require '../connect.php';

    // lay thong tin tu form edit 
    $id_lsp = $_POST['id_lsp'];
    $ten = $_POST['ten'];
    $trangthai = $_POST['trangthai'];

    // cau lenh edit 
    $query = "UPDATE loaisanpham SET ten='$ten', trangthai=$trangthai WHERE id_lsp=$id_lsp";

    // thuc hien sua 
    if ($conn->query($query) === true) {
        // chuyen huong qua trang list 
        header('location: loaisanpham-ds.php');
    } else {
        echo ("loi ko sua dc " . $conn->connect_error);
    }
}
