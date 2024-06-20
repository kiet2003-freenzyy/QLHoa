<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Flowers-Website_Cửa Hàng</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    

</head>
<?php
include("Connect.php");
?>

<body>
    <?php
    include("header_cus.php");
    ?>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Cửa Hàng</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
            <li class="breadcrumb-item active text-white">Sản Phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->
        <!-- Flowers Shop Start-->
        <div class="container-fluid hoa py-5">
        <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-8">
                <h1 class="mb-0">Hoa Trong Cửa Hàng</h1>
            </div>
            <div class="col-md-4 d-flex align-items-center">
                <form action="shop_us.php" method="post" class="input-group">
                    <input type="search" name="timKiem" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                    <button name="tim_theo_ten" type="submit" id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                </form>
            </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-12">
                    <div class="container py-5">
                        <div class="row g-4">
                            <div class="col-lg-3">
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <h4 class="nav-item dropdown dropdown-toggle" id="hoaDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                                Loại Hoa
                                            </h4>
                                            <ul class="list-unstyled hoa-categorie dropdown-menu m-0 rounded-0" aria-labelledby="hoaDropdown">
                                                <?php foreach ($loai_hoa as $loai) { ?>
                                                    <li class="dropdown-item">
                                                        <a href="shop_us.php?ml=<?php echo $loai['ma_cd'] ?>" style="text-transform:uppercase; text-decoration:none;">
                                                            <?php echo $loai['ten_cd'] ?>
                                                        </a>
                                                    </li>
                                                <?php } ?>
                                                <li class="dropdown-item">
                                                    <a href="shop_us.php" style="text-transform:uppercase; text-decoration:none;">
                                                        SHOW ALL
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <h4 class="nav-item dropdown dropdown-toggle" id="hoaDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                            Hoa Theo Giá
                                        </h4>
                                        <ul class="list-unstyled hoa-categorie dropdown-menu m-0 rounded-0" aria-labelledby="hoaDropdown">
                                            <li class="dropdown-item">
                                                <div class="mb-2">
                                                    <a href="shop_us.php?price_min=0&price_max=500000"> 500,000đ trở xuống</a>
                                                </div>
                                            </li>
                                            <li class="dropdown-item">
                                                <div class="mb-2">
                                                    <a href="shop_us.php?price_min=500000&price_max=600000">500,000đ - 600,000đ</a>
                                                </div>
                                            </li>
                                            <li class="dropdown-item">
                                                <div class="mb-2">
                                                    <a href="shop_us.php?price_min=600000&price_max=1500000">600,000đ trở lên</a>
                                                </div>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <h4 class="mb-3">Sản Phẩm Nổi Bật</h4>
                                    <div class="d-flex align-items-center justify-content-start mb-4">
                                        <div class="rounded me-4" style="width: 70px; height: 100px;">
                                            <img src="img/rose-item-3.jpg" class="img-fluid rounded" alt="">
                                        </div>
                                        <div>
                                            <h6 class="mb-2">Rose Red</h6>
                                            <div class="d-flex mb-2">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <h5 class="fw-bold me-2">500.000 đ</h5>
                                                <h5 class="text-danger text-decoration-line-through">1.000.000</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded me-4" style="width: 70px; height: 100px;">
                                            <img src="img/hoa-item-12.jpg" class="img-fluid rounded" alt="">
                                        </div>
                                        <div>
                                            <h6 class="mb-2">Hồng Antique</h6>
                                            <div class="d-flex mb-2">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <h5 class="fw-bold me-2">200.000 đ</h5>
                                                <h5 class="text-danger text-decoration-line-through">700.000 đ</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-start">
                                        <div class="rounded me-4" style="width: 70px; height: 100px;">
                                            <img src="img/hoa-item-8.jpg" class="img-fluid rounded" alt="">
                                        </div>
                                        <div>
                                            <h6 class="mb-2">Hồng Grandiflora</h6>
                                            <div class="d-flex mb-2">
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star text-secondary"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="d-flex mb-2">
                                                <h5 class="fw-bold me-2">250.000 đ</h5>
                                                <h5 class="text-danger text-decoration-line-through">800.000 đ</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center my-4">
                                        <a href="#" class="btn border border-secondary px-4 py-3 rounded-pill text-primary w-100">Xem Thêm</a>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="position-relative">
                                        <img src="img/banner-hoa.jpg" class="img-fluid w-100 rounded" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row g-4 justify-content-center">
                                    <?php
                                    include('PhanTrang.php');
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    <!-- Flowers Shop End-->

    <?php
    include('footer_ad.php');
    ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>


</body>

</html>