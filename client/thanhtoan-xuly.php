<?php

session_start();

if (isset($_POST['thanhtoan'])) {
    require '../connect.php';
    if (isset($_SESSION['khachhang'])) {

        $id_kh = $_POST['id_kh'];
        $tongtien = $_POST['tongtien'];
        $username = $_SESSION['khachhang'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];


        if (isset($_COOKIE['cart'])) {
            $cookie_data = $_COOKIE['cart'];

            $cart_data = json_decode($cookie_data, true);

            $insert_hoadon = "INSERT INTO hoadon (sdt, diachi, tongtien, id_kh)
                VALUES ('$sdt', '$diachi', '$tongtien', '$id_kh')";

            if ($conn->query($insert_hoadon)) {
                $id_hd = $conn->insert_id;
                foreach ($cart_data as $key => $value) {
                    $id_sp = $value['id_sp'];
                    $soluong = $value['soluong'];
                    $gia = $value['gia'];
                    $insert_chitiethoadon = "INSERT INTO chitiethoadon (id_hd, id_sp, soluong, gia)
                                                        VALUES ('$id_hd', '$id_sp', '$soluong', '$gia' )";
                    if ($conn->query($insert_chitiethoadon)) {
                        setcookie("cart", "", time() -  3600 * 24 * 30 * 12);
                        if (isset($_COOKIE['cart'])) {
                            setcookie("cart", "", time() -  3600 * 24 * 30 * 12);
                        }
                        // header('location: sanpham-ds.php');

                    }
                }
            }
        }
    }
}
header('location: hoadon-ds.php');
