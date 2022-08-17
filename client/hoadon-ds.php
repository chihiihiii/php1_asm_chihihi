<?php
session_start();

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
    <meta ten="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid" id="history">
        <div class="history">
            <h1 class="text-center">LỊCH SỬ ĐẶT HÀNG</h1>
            <table class="table table-striped">
                <tr>

                    <th>
                        ID
                    </th>
                    <th>
                        Tên
                    </th>
                    <th>
                        Số lượng
                    </th>
                    <th>
                        Đơn giá
                    </th>
                    <th>
                        Tổng tiền
                    </th>
                    <th>
                        Thời gian đặt
                    </th>
                    <th></th>

                </tr>

                <?php
                if (isset($_SESSION['khachhang'])) :
                    require '../connect.php';
                    $id_kh = $_SESSION['id_kh'];
                    if ($hoadon = $conn->query("SELECT * FROM hoadon WHERE id_kh=$id_kh ")) :
                        while ($hd = $hoadon->fetch_assoc()) :
                            $id_hd = $hd['id_hd'];
                            $tongtien = $hd['tongtien'];
                            $tgdat = $hd['tgdat'];

                            $chitiethoadon = $conn->query("SELECT * FROM chitiethoadon WHERE id_hd = $id_hd ");

                ?>


                            <tr>
                                <td><?= $id_hd ?></td>



                                <td>
                                    <?php
                                    foreach ($chitiethoadon as $cthd) {
                                        $id_sp = $cthd['id_sp'];
                                        $sanpham = $conn->query("SELECT * FROM sanpham WHERE id_sp = $id_sp ");
                                        $sp = $sanpham->fetch_assoc();
                                        $ten_sanpham = $sp['ten'];
                                        echo $ten_sanpham . '<br>';
                                    }
                                    ?>

                                </td>
                                <td>
                                    <?php
                                    foreach ($chitiethoadon as $cthd) {
                                        $soluong = $cthd['soluong'];
                                        echo $soluong . '<br>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    foreach ($chitiethoadon as $cthd) {
                                        $gia = $cthd['gia'];
                                        echo number_format($gia) . '<br>';
                                    }
                                    ?>
                                </td>
                                <td><?= number_format($tongtien) ?></td>

                                <td><?= $tgdat ?></td>

                            </tr>
                <?php
                        endwhile;
                    endif;
                endif;
                $conn->close();
                ?>

            </table>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>