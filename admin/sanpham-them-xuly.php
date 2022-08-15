<?php

if (isset($_POST['them'])) {
    require '../connect.php';

    $file = $_FILES['hinhanh']['tmp_name'];

    // lay extension cua file 
    $image_ext = pathinfo($_FILES['hinhanh']['name'], PATHINFO_EXTENSION);

    // doi ten file thanh thoi gian hien tai 
    $image_name = date('YmdHis') . '.' . $image_ext;

    // cau hinh duong dan de di chuyen file 
    $path = "../uploads/" . $image_name;

    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $mota = $_POST['mota'];
    $id_lsp = $_POST['id_lsp'];
    $trangthai = $_POST['trangthai'];

    // var_dump($_POST);

    if (move_uploaded_file($file, $path)) {
        // echo "Tải tập tin thành công";
        $query = "INSERT INTO sanpham (ten, gia, hinhanh, mota, id_lsp, trangthai) VALUES ('$ten', '$gia', '$image_name', '$mota', '$id_lsp', '$trangthai')";

        // thuc hien them 
        if ($conn->query($query) === true) {
            header('location: sanpham-ds.php');
        } else {
            echo ("LOI" . $conn->connect_error);
            // header('location: loaisanpham-ds.php');
        }
    } else {
        echo "Tải tập tin thất bại";
    }
} else {
    header('location: index.php');
}
