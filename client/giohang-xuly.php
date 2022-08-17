<?php

// thêm vào giỏ hàng 
if (isset($_POST['them'])) {
    require '../connect.php';

    $id_sp = isset($_POST['id_sp']) ? $_POST['id_sp'] : '';

    $sanpham = $conn->query("SELECT * FROM sanpham WHERE id_sp = $id_sp ");
    $sp = $sanpham->fetch_assoc();
    $ten = $sp['ten'];
    $hinhanh = $sp['hinhanh'];
    $gia = $sp['gia'];

    if (isset($_COOKIE['cart'])) {
        // nếu đã tồn tại cookie cart thì lấy giá trị của cookie cart 
        $cookie_data = $_COOKIE['cart'];

        // chuyển string thành array 
        $cart_data = json_decode($cookie_data, true);
    } else {
        $cart_data = array();
    }

    $id_sp_ds = array_column($cart_data, 'id_sp');

    // kiểm tra id_sp có tồn tại trong cookie cart chưa 
    if (in_array($id_sp, $id_sp_ds)) {
        foreach ($cart_data as $key => $value) {
            // nếu có thì tăng có lượng sản phẩm 

            if ($cart_data[$key]['id_sp'] == $id_sp) {
                $cart_data[$key]['soluong'] = $cart_data[$key]['soluong'] + 1;
            }
        }
    } else {
        // nếu chưa có thì thêm vào cookie cart 
        $product_array = array(
            'id_sp' => $id_sp,
            'ten' => $ten,
            'gia' => $gia,
            'soluong' => 1,
            'hinhanh' => $hinhanh
        );
        $cart_data[] = $product_array;
    }

    // chuyển array thành string để lưu vào cookie cart 
    $product_data = json_encode($cart_data);

    // lưu cookie 
    setcookie('cart', $product_data, time() +  3600 * 24 * 30 * 12);


    header('location: giohang.php');
}

// sửa số lượng sản phẩm trong giỏ hàng 
if (isset($_POST['sua'])) {

    $id_sp = $_POST['id_sp'];
    $soluong = $_POST['soluong'];
    $ten = $_POST['ten'];
    $hinhanh = $_POST['hinhanh'];
    $gia = $_POST['gia'];
    if (isset($_COOKIE['cart'])) {
        $cookie_data = $_COOKIE['cart'];
        $cart_data = json_decode($cookie_data, true);
    } else {
        $cart_data = array();
    }

    $id_sp_ds = array_column($cart_data, 'id_sp');

    if (in_array($id_sp, $id_sp_ds)) {
        foreach ($cart_data as $key => $value) {
            if ($cart_data[$key]['id_sp'] == $id_sp) {
                $cart_data[$key]['soluong'] =  $soluong;
            }
        }
    } else {
        $product_array = array(
            'id_sp' => $id_sp,
            'ten' => $ten,
            'gia' => $gia,
            'soluong' => 1,
            'hinhanh' => $hinhanh
        );
        $cart_data[] = $product_array;
    }

    $product_data = json_encode($cart_data);
    setcookie('cart', $product_data, time() + 3600 * 24 * 30 * 12);

    header('location: giohang.php');
}

// xóa sản phẩm trong giỏ hàng 
if (isset($_POST['xoa'])) {
    if (isset($_COOKIE['cart'])) {
        $cookie_data = $_COOKIE['cart'];
        $cart_data = json_decode($cookie_data, true);
        foreach ($cart_data as $key => $value) {
            if ($cart_data[$key]['id_sp'] == $_POST['id_sp']) {
                unset($cart_data[$key]);
                $product_data = json_encode($cart_data);

                setcookie("cart", $product_data, time() +  3600 * 24 * 30 * 12);
            }
        }
    }
    header('location: giohang.php');
}

// xóa cookie giỏ hàng
if (isset($_POST['xoatatca'])) {
    if (isset($_COOKIE['cart'])) {
        setcookie("cart", "", time() -  3600 * 24 * 30 * 12);
    }
    header('location: giohang.php');
}
