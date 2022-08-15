<?php
include 'header.php';
?>

<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">QUẢN LÝ SẢN PHẨM</h4>
                <div class="ms-auto text-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Danh sách sản phẩm</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Danh sách sản phẩm</h5>
                        <div class="table-responsive">
                            <table id="" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên</th>
                                        <th>Giá</th>
                                        <th>Trạng thái</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    require '../connect.php';
                                    $query = "SELECT * FROM sanpham";
                                    $sanpham_ds = $conn->query($query);
                                    if ($sanpham_ds->num_rows > 0) :
                                        while ($sanpham = $sanpham_ds->fetch_assoc()) :

                                    ?>
                                            <tr>
                                                <td><?= $sanpham['id_sp'] ?></td>
                                                <td>
                                                    <img src="../uploads/<?= $sanpham['hinhanh'] ?>" alt="" width="100px">

                                                </td>
                                                <td><?= $sanpham['ten'] ?></td>
                                                <td><?= number_format($sanpham['gia'])  ?></td>
                                                <td><?= ($sanpham['trangthai'] == 1) ? 'Hiển thị' : 'Ẩn' ?></td>
                                                <td>
                                                    <a href="sanpham-sua.php?id=<?= $sanpham['id_sp'] ?>">Sửa</a>
                                                </td>
                                            </tr>

                                    <?php
                                        endwhile;
                                    endif;

                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->


    <?php
    include 'footer.php';
    ?>