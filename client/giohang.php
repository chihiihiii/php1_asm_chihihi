<?php
if (empty($_COOKIE['cart'])) {
    header('location: sanpham-ds.php');
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
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng tiền</th>
                    <th width="15%"></th>
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
                            <!-- cập nhật số lượng sản phẩm  -->

                            <form action="giohang-xuly.php" method="post">
                                <input type="number" name="soluong" value="<?= $sp['soluong'] ?>" onchange="this.form.submit()" class="form-control" min=1>
                                <input type="hidden" name="id_sp" value="<?= $sp['id_sp'] ?>">
                                <input type="hidden" name="ten" value="<?= $sp['ten'] ?>">
                                <input type="hidden" name="gia" value="<?= $sp['gia'] ?>">
                                <input type="hidden" name="hinhanh" value="<?= $sp['hinhanh'] ?>">
                                <input type="hidden" name="sua">

                            </form>

                        </td>
                        <td> <?= number_format($tongtien) ?> đ</td>
                        <td class="text-right">
                            <!-- xóa sản phẩm trong giỏ hàng  -->
                            <form action="giohang-xuly.php" method="post">

                                <input type="hidden" name="id_sp" id="" value="<?= $sp['id_sp'] ?>">
                                <button class="btn btn-outline-danger" name="xoa">Xóa</button>
                            </form>

                        </td>
                    </tr>
                <?php
                endforeach;
                ?>

                <tr>
                    <td colspan="4">Tổng tiền tất cả</td>
                    <td>
                        <b><?= number_format($tongtatca) ?> đ</b>
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="5">
                        <a href="thanhtoan.php" class="btn btn-outline-dark">Thanh toán</a>
                    </td>
                    <td class="text-right">
                        <!-- xóa giỏ hàng  -->
                        <form action="giohang-xuly.php" method="post">
                            <button class="btn btn-outline-danger" name="xoatatca">Xóa giỏ hàng</button>
                        </form>
                    </td>
                </tr>

            </tbody>
        </table>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>