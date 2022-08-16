<?php

if (isset($_POST['them'])) {
    require '../connect.php';

    $id_sp = isset($_POST['id_sp']) ? $_POST['id_sp'] : '';

    $sanpham = $conn->query("SELECT * FROM sanpham WHERE id_sp = $id_sp ");
    $sp = $sanpham->fetch_assoc();
    $ten = $sp['ten'];
    $hinhanh = $sp['hinhanh'];
    $gia = $sp['gia'];

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
                $cart_data[$key]['soluong'] = $cart_data[$key]['soluong'] + 1;
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
    setcookie('cart', $product_data, time() +  3600 * 24 * 30 * 12);


    header('location: giohang.php');
    // var_dump($_COOKIE['cart']);

    // header('location: cart.php');
}

if (isset($_POST['sua'])) {

    $id_sp = $_POST['id_sp'];
    $soluong = $_POST['soluong'];
        if (isset($_COOKIE['cart'])) {
            $cookie_data = $_COOKIE['cart'];
        }
    else {
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
