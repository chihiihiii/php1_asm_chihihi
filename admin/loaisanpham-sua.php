<?php
if (isset($_GET['id'])) :
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
                    <h4 class="page-title">QUẢN LÝ LOẠI SẢN PHẨM</h4>
                    <div class="ms-auto text-end">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Sửa loại sản phẩm</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <form class="form-horizontal" action="loaisanpham-sua-xuly.php" method="POST">
                            <div class="card-body">
                                <h4 class="card-title">Sửa loại sản phẩm</h4>
                                <?php
                                require '../connect.php';
                                $id = $_GET['id'];
                                // print_r($user_id);
                                $query = "SELECT * FROM loaisanpham WHERE id_lsp=$id";
                                $loaisanpham_ds = $conn->query($query);
                                // lay du lieu cho mang user 
                                $loaisanpham = $loaisanpham_ds->fetch_assoc();
                                ?>
                                <input type="hidden" name="id_lsp" value="<?=$id?>" id="">
                                <div class="form-group row">
                                    <label for="ten" class="col-sm-3 text-end control-label col-form-label">Tên</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="ten" placeholder="Nhập tên loại sản phẩm..." name="ten" value="<?= $loaisanpham['ten'] ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 text-end control-label col-form-label">Trạng thái</label>
                                    <div class="col-md-9">
                                        <select class="select2 form-select shadow-none" style="width: 100%; height:36px;" name="trangthai">
                                            <option value="1" <?= ($loaisanpham['trangthai'] == 1 ? 'selected' : '') ?>>Hiển thị</option>
                                            <option value="0" <?= ($loaisanpham['trangthai'] == 0 ? 'selected' : '') ?>>Ẩn</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary" name="sua">Sửa</button>
                                </div>
                            </div>
                        </form>
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

endif;
    ?>