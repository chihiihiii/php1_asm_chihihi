<?php
session_start();
if (empty($_COOKIE['cart'])) {
    header('location: sanpham-ds.php');
}

if (empty($_SESSION['khachhang'])) {
    header('location: dangnhap.php');
}

?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container pt-5">
        <div class="row">
            <div class="col-sm-6">
                <h5 class="text-center">CHI TIẾT HÓA ĐƠN</h5>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        require '../connect.php';


                        $cookie_data = $_COOKIE['cart'];
                        $cart_data = json_decode($cookie_data, true);

                        $tongtatca = 0;
                        // var_dump($cart_data);
                        foreach ($cart_data as $sp) :
                            $tongtien = $sp['gia'] * $sp['soluong'];
                            $tongtatca += $tongtien;
                        ?>
                            <tr>
                                <td scope="row"><?= $sp['id_sp'] ?></td>
                                <td><?= $sp['ten'] ?></td>
                                <td> <?= number_format($sp['gia']) ?> đ</td>
                                <td width="200px">
                                    <?= $sp['soluong'] ?>

                                </td>
                            </tr>
                        <?php
                        endforeach;
                        ?>

                        <tr>
                            <td colspan="3">Thanh toán</td>
                            <td>
                                <b><?= number_format($tongtatca) ?> đ</b>
                            </td>
                            <td></td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <div class="col-sm-6">
                <?php
                $username = $_SESSION['khachhang'];
                $query = "SELECT * FROM khachhang WHERE username='$username'";
                // if ($conn->query($query)->num_rows = 0) {

                //     header('location: sanpham-ds.php');
                // }
                $khachhang = $conn->query($query)->fetch_assoc();
                ?>
                <h5 class="text-center">THÔNG TIN THANH TOÁN</h5>

                <form action="thanhtoan-xuly.php" method="post">
                    <input type="hidden" name="id_kh" id="" value="<?= $khachhang['id_kh'] ?>">
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" name="username" id="" value="<?= $_SESSION['khachhang'] ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sdt">Số điện thoại</label>
                        <input type="text" name="sdt" id="" value="<?= $khachhang['sdt'] ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="diachi">Địa chỉ</label>
                        <textarea name="diachi" id="" rows="5" class="form-control" required><?= $khachhang['diachi'] ?></textarea>
                    </div>
                    <input type="hidden" name="tongtien" id="" value="<?= $tongtatca ?>">

                    <button class="btn btn-outline-dark" name="thanhtoan">ĐẶT HÀNG</button>
                </form>
            </div>
        </div>

    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>