<?php

if (isset($_POST['sua'])) {
    require '../connect.php';

    // lay thong tin tu form edit 
    $id_sp = $_POST['id_sp'];
    $ten = $_POST['ten'];
    $gia = $_POST['gia'];
    $mota = $_POST['mota'];
    $id_lsp = $_POST['id_lsp'];
    $trangthai = $_POST['trangthai'];

    if ($_FILES['hinhanh']['tmp_name'] == '') {
        $query = "UPDATE sanpham SET ten='$ten', gia=$gia, mota='$mota', id_lsp=$id_lsp, trangthai=$trangthai WHERE id_sp=$id_sp";

        // thuc hien sua 
        if ($conn->query($query) === true) {
            header('location: sanpham-ds.php');
        } else {
            echo ("LOI" . $conn->connect_error);
            // header('location: sanpham-ds.php');
        }
    } else {
        $file = $_FILES['hinhanh']['tmp_name'];

        // lay extension cua file 
        $image_ext = pathinfo($_FILES['hinhanh']['name'], PATHINFO_EXTENSION);

        // doi ten file thanh thoi gian hien tai 
        $image_name = date('YmdHis') . '.' . $image_ext;

        // cau hinh duong dan de di chuyen file 
        $path = "../uploads/" . $image_name;


        if (move_uploaded_file($file, $path)) {
            // echo "Tải tập tin thành công";
            $query = "UPDATE sanpham SET ten='$ten', gia=$gia, hinhanh='$image_name', mota='$mota', id_lsp=$id_lsp, trangthai=$trangthai WHERE id_sp=$id_sp";

            // thuc hien sua 
            if ($conn->query($query) === true) {
                header('location: sanpham-ds.php');
            } else {
                echo ("LOI" . $conn->connect_error);
                // header('location: sanpham-ds.php');
            }
        } else {
            echo "Tải tập tin thất bại";
        }
    }
}
