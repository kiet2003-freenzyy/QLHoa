<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Flowers -Trang Chủ</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- Libraries Stylesheet -->
        <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
        <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">


        <!-- Customized Bootstrap Stylesheet -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="css/style.css" rel="stylesheet">
        <style>
            .fixed-size {
            width: 200px; /* Chiều rộng cố định */
            height: 200px; /* Chiều cao cố định */
            object-fit: cover; /* Giữ tỉ lệ ảnh */
            }
        </style>
    

    </head>
  
<body>

<?php
include('Connect.php');

?>

<?php
            include("header_cus.php");
        ?>
        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->
        <!-- Hero Start -->
        <div class="container-fluid py-5 mb-5 hero-header">
            <div class="container py-5">
                <div class="row g-5 align-items-center">
                    <div class="col-md-12 col-lg-7">
                        <h4 class="mb-3 text-secondary">100% Hoa Tươi</h4>
                        <h1 class="mb-5 display-3 text-primary">Hoa Tinh Khiết - Hương Thơm Từ Tự Nhiên</h1>
                        <div class="position-relative mx-auto">
                            <input class="form-control border-2 border-secondary w-75 py-3 px-4 rounded-pill" type="number" placeholder="Search">
                            <button type="submit" class="btn btn-primary border-2 border-secondary py-3 px-4 position-absolute rounded-pill text-white h-100" style="top: 0; right: 25%;">Submit Now</button>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-5">
                        <div id="carouselId" class="carousel slide position-relative" data-bs-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active rounded">
                                    <img src="img/hero-img-1.png" class="img-fluid w-100 bg-secondary rounded" alt="First slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Rose</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="img/hero-img-3.jpg" class="img-fluid w-100 rounded" alt="Second slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Tulip</a>
                                </div>
                                <div class="carousel-item rounded">
                                    <img src="img/hero-img-4.jpg" class="img-fluid w-100 rounded" alt="Second slide">
                                    <a href="#" class="btn px-4 py-2 text-white rounded">Baby</a>
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselId" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselId" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Hero End -->
        <!-- Featurs Section Start -->
        <div class="container-fluid featurs py-5">
            <div class="container py-5">
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-car-side fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Miễn Phí Vận Chuyển</h5>
                                <p class="mb-0">Cho đơn hàng trên 400.000 đ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-user-shield fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>Thanh Toán Bảo Mật</h5>
                                <p class="mb-0">100% An Toàn</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fas fa-exchange-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>7 Ngày Hoàn Trả</h5>
                                <p class="mb-0">Đảm bảo hoàn tiền trong 7 ngày</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="featurs-item text-center rounded bg-light p-4">
                            <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 mx-auto">
                                <i class="fa fa-phone-alt fa-3x text-white"></i>
                            </div>
                            <div class="featurs-content text-center">
                                <h5>24/7 Hỗ Trợ</h5>
                                <p class="mb-0">Hỗ Trợ Nhanh Chóng Mọi Lúc</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs Section End -->
        <!-- Flower Shop Start-->
        <div class="container-fluid hoa py-5">
            <div class="container py-5">
                <div class="tab-class text-center">
                    <div class="row g-4">
                        <div class="col-lg-4 text-start">
                            <h1>Sản Phẩm</h1>
                        </div>
                        <div class="col-lg-8 text-end">
                            <ul class="nav nav-pills d-inline-flex text-center mb-5">
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill active" data-bs-toggle="pill" href="#tab-1">
                                        <span class="text-dark" style="width: 130px;">Tất Cả </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex py-2 m-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-2">
                                        <span class="text-dark" style="width: 130px;">Hoa Hồng Đỏ</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-3">
                                        <span class="text-dark" style="width: 130px;">Hoa Hồng Xanh</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-4">
                                        <span class="text-dark" style="width: 130px;">Hồng Grandiflora</span>
                                    </a>
                                </li>
                                <!--<li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-5">
                                        <span class="text-dark" style="width: 130px;">Hồng Antique</span>
                                    </a>
                                </li>-->
                                <li class="nav-item">
                                    <a class="d-flex m-2 py-2 bg-light rounded-pill" data-bs-toggle="pill" href="#tab-6">
                                        <span class="text-dark" style="width: 130px;">Pink Rose</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <div class="row g-4">
                                <div class="col-lg-12">
                                    <div class="row g-4">
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative hoa-item">
                                                <div class="hoa-img">
                                                    <img src="img/rose-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Rose</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Hồng Đỏ</h4>
                                                    <p>Hoa hồng đỏ biểu tượng cho tình yêu và sự lãng mạn. Với màu đỏ rực rỡ, hoa hồng là món quà ý nghĩa và đẹp đẽ.</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">300.000 đ / bó</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative hoa-item">
                                                <div class="hoa-img">
                                                    <img src="img/rose-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Rose</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Crimson Charm</h4>
                                                    <p>Một sức hút mạnh mẽ,hoa hồng là món quà ý nghĩa và đẹp đẽ, sự quyến rũ của màu đỏ tươi sáng và cuốn hút.</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">500.000 đ / bó</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative hoa-item">
                                                <div class="hoa-img">
                                                    <img src="img/hoa-item-4.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Blue Rose</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Giấc mơ ngọc lục bảo</h4>
                                                    <p>Một bức tranh huyền bí của thiên nhiên với sắc xanh ngọc bích, đưa người ta vào thế giới ẩn hiện đầy mộng mơ và lôi cuốn. 💎</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">400.000 đ / bó</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative hoa-item">
                                                <div class="hoa-img">
                                                    <img src="img/hoa-item-9.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Grandiflora</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Nữ Hoàng Grace</h4>
                                                    <p>Duyên dáng và quý phái như một nữ hoàng trong vườn hoa.Cho thấy tính hoàng gia và tự nhiên đẹp của hoa hồng Grandiflora.</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">600.000 đ / bó</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative hoa-item">
                                                <div class="hoa-img">
                                                    <img src="img/hoa-item-3.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Blue Rose</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Xanh Mát Tinh Khiết</h4>
                                                    <p>Sự tươi mới, thanh khiết, và nguyên sơ như làn gió xanh mát trong vườn hoa.</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">575.000 đ / bó</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative hoa-item">
                                                <div class="hoa-img">
                                                    <img src="img/hoa-item-12.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Antique</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Kỷ Niệm Thanh Xuân</h4>
                                                    <p>Được mệnh danh là kỷ niệm về tuổi thanh xuân qua vẻ đẹp cổ điển của hoa hồng Antique.</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">345.000 đ / bó</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative hoa-item">
                                                <div class="hoa-img">
                                                    <img src="img/hoa-item-13.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Antique</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Vintage Elegance</h4>
                                                    <p>Kết hợp giữa sự cổ điển và tinh tế, thể hiện vẻ đẹp thanh lịch và sang trọng của hoa hồng Antique.</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">485.000 đ / bó</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4 col-xl-3">
                                            <div class="rounded position-relative hoa-item">
                                                <div class="hoa-img">
                                                    <img src="img/hoa-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                                                </div>
                                                <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;">Grandiflora</div>
                                                <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                    <h4>Hồng Ngọc Lấp Lánh</h4>
                                                    <p>Phản ánh vẻ đẹp lấp lánh, quý phái và sang trọng của hoa hồng Grandiflora.</p>
                                                    <div class="d-flex justify-content-between flex-lg-wrap">
                                                        <p class="text-dark fs-5 fw-bold mb-0">299.000 đ / bó</p>
                                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="row g-4">
                                <?php 
                                $hoa_dep_data = $hoa_dep->fetchAll(PDO::FETCH_ASSOC);
                                $hoa_cd001 = array_filter($hoa_dep_data, function($row) {
                                    return $row['ma_cd'] === 'CD001';
                                });
                                
                                foreach ($hoa_cd001 as $row): ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative hoa-item">
                                            <div class="hoa-img">
                                                <img src="img/<?php echo $row['hinh']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['ten_cd']; ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $row['ten_hoa']; ?></h4>
                                                <p><?php echo $row['noidung']; ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0"><?php echo number_format($row['gia'], 0, ',', '.'); ?> đ / bó</p>
                                                    <a href="shop-detail.php?id=<?php echo $row['ma_hoa']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div id="tab-3" class="tab-pane fade show p-0"> <!--Hồng Xanh-->
                            <div class="row g-4">
                                <?php 
                                $hoa_cd002 = array_filter($hoa_dep_data, function($row) {
                                    return $row['ma_cd'] === 'CD002';
                                });
                                
                                foreach ($hoa_cd002 as $row): ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative hoa-item">
                                            <div class="hoa-img">
                                                <img src="img/<?php echo $row['hinh']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['ten_cd']; ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $row['ten_hoa']; ?></h4>
                                                <p><?php echo $row['noidung']; ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0"><?php echo number_format($row['gia'], 0, ',', '.'); ?> đ / bó</p>
                                                    <a href="shop-detail.php?id=<?php echo $row['ma_hoa']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div> <!--Hồng Xanh-->
                    <div id="tab-4" class="tab-pane fade show p-0"><!--Hồng Grandiflora-->
                            <div class="row g-4">
                                <?php 
                                $hoa_cd004 = array_filter($hoa_dep_data, function($row) {
                                    return $row['ma_cd'] === 'CD004';
                                });
                                
                                foreach ($hoa_cd004 as $row): ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative hoa-item">
                                            <div class="hoa-img">
                                                <img src="img/<?php echo $row['hinh']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['ten_cd']; ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $row['ten_hoa']; ?></h4>
                                                <p><?php echo $row['noidung']; ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0"><?php echo number_format($row['gia'], 0, ',', '.'); ?> đ / bó</p>
                                                    <a href="shop-detail.php?id=<?php echo $row['ma_hoa']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div> <!--Hồng Grandiflora-->
                        <div id="tab-5" class="tab-pane fade show p-0"><!--Hồng Antique-->
                            <div class="row g-4">
                                <?php 
                                $hoa_cd005 = array_filter($hoa_dep_data, function($row) {
                                    return $row['ma_cd'] === 'CD005';
                                });
                                
                                foreach ($hoa_cd005 as $row): ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative hoa-item">
                                            <div class="hoa-img">
                                                <img src="img/<?php echo $row['hinh']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['ten_cd']; ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $row['ten_hoa']; ?></h4>
                                                <p><?php echo $row['noidung']; ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0"><?php echo number_format($row['gia'], 0, ',', '.'); ?> đ / bó</p>
                                                    <a href="shop-detail.php?id=<?php echo $row['ma_hoa']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div id="tab-6" class="tab-pane fade show p-0"><!--Hồng Antique-->
                            <div class="row g-4">
                                <?php 
                                $hoa_cd003 = array_filter($hoa_dep_data, function($row) {
                                    return $row['ma_cd'] === 'CD003';
                                });
                                
                                foreach ($hoa_cd003 as $row): ?>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="rounded position-relative hoa-item">
                                            <div class="hoa-img">
                                                <img src="img/<?php echo $row['hinh']; ?>" class="img-fluid w-100 rounded-top" alt="">
                                            </div>
                                            <div class="text-white bg-secondary px-3 py-1 rounded position-absolute" style="top: 10px; left: 10px;"><?php echo $row['ten_cd']; ?></div>
                                            <div class="p-4 border border-secondary border-top-0 rounded-bottom">
                                                <h4><?php echo $row['ten_hoa']; ?></h4>
                                                <p><?php echo $row['noidung']; ?></p>
                                                <div class="d-flex justify-content-between flex-lg-wrap">
                                                    <p class="text-dark fs-5 fw-bold mb-0"><?php echo number_format($row['gia'], 0, ',', '.'); ?> đ / bó</p>
                                                    <a href="shop-detail.php?id=<?php echo $row['ma_hoa']; ?>" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
        </div>
        <!-- Flower Shop End-->
        <!-- Featurs Start(Tuyên bố giá trị) -->
        <div class="container-fluid service py-5">
            <div class="container py-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-secondary rounded border border-secondary">
                                <img src="img/featur-4.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-primary text-center p-4 rounded">
                                        <h5 class="text-white">Fresh Flowers</h5>
                                        <h3 class="mb-0">10% OFF</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-dark rounded border border-dark">
                                <img src="img/featur-5.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-light text-center p-4 rounded">
                                        <h5 class="text-primary">Beautiful Flower</h5>
                                        <h3 class="mb-0">Free delivery</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <a href="#">
                            <div class="service-item bg-primary rounded border border-primary">
                                <img src="img/featur-6.jpg" class="img-fluid rounded-top w-100" alt="">
                                <div class="px-4 rounded-bottom">
                                    <div class="service-content bg-secondary text-center p-4 rounded">
                                        <h5 class="text-white">Flowers Are Not Fresh</h5>
                                        <h3 class="mb-0">Discount 50%</h3>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Featurs End -->
        <!-- hoa Shop Start-->
        <!--Hoa Rose Start-->
        <style>
        .hoa .tab-class .nav-item a.active {
            background: var(--bs-secondary) !important;
        }

        .hoa .tab-class .nav-item a.active span {
            color: var(--bs-white) !important; 
        }

        .hoa .hoa-categorie .hoa-name {
            line-height: 40px;
        }

        .hoa .hoa-categorie .hoa-name a {
            transition: 0.5s;
        }

        .hoa .hoa-categorie .hoa-name a:hover {
            color: var(--bs-secondary);
        }

        .hoa .hoa-item {
            height: 100%;
            transition: 0.5s;
            border-radius: 10px; /* Đặt viền cong cho khung hình */
            overflow: hidden; /* Ẩn phần nội dung ra ngoài khung hình */
        }

        .hoa .hoa-item:hover {
            box-shadow: 0 0 55px rgba(0, 0, 0, 0.4);
        }

        .hoa .hoa-item .hoa-img {
            overflow: hidden;
            transition: 0.5s;
            border-radius: 10px 10px 0 0;
            height: 200px; /* Kích thước cố định cho khung hình */
        }

        .hoa .hoa-item .hoa-img img {
            width: 100%;
            height: auto;
            transition: transform 0.5s;
        }

        .hoa .hoa-item .hoa-img img:hover {
            transform: scale(1.3);
        }

        .hoa .owl-carousel {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .hoa .owl-carousel .hoa-item {
            flex: 0 0 calc(25% - 20px);
            margin: 10px;
        }
        </style>
    <div class="container-fluid hoa py-5">
            <div class="container py-5">
                <h1 class="mb-0">Hoa Đẹp "Đốn Tim" Khách Hàng 🌺🌼🌻</h1>
                <div class="owl-carousel hoa-carousel justify-content-center">
                    <div class="border border-primary rounded position-relative hoa-item">
                        <div class="hoa-img">
                            <img src="img/rose-item-1.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Red Rose</div>
                        <div class="p-4 rounded-bottom">
                            <h4>Ngọn lửa của tình yêu</h4>
                            <p>Bó hoa hồng đỏ tuyệt vời này thể hiện sự đam mê mãnh liệt và đẳng cấp sang trọng của tình yêu. Hãy để nó nói lên trái tim bạn</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">400.000 đ / bó</p>
                                <a href="cart.php" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative hoa-item">
                        <div class="hoa-img">
                            <img src="img/rose-item-2.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Red Rose</div>
                        <div class="p-4 rounded-bottom">
                            <h4>Crimson Charm</h4>
                            <p>Một sức hút mạnh mẽ, sự quyến rũ của màu đỏ tươi sáng và cuốn hút.</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">500.000 đ / bó</p>
                                <a href="cart.php" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative hoa-item">
                        <div class="hoa-img">
                            <img src="img/rose-item-3.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Red Rose</div>
                    <div class="p-4 rounded-bottom">
                            <h4>Passionate Red</h4>
                            <p>Một biểu tượng của sự đam mê mãnh liệt và sự sôi động nhiệt huyết.</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">1.000.000 đ / bó</p>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative hoa-item">
                        <div class="hoa-img">
                            <img src="img/rose-item-4.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Red Rose</div>
                        <div class="p-4 rounded-bottom">
                            <h4>Scarlet Bliss</h4>
                            <p>Một cảm giác êm dịu và hạnh phúc, với màu sắc của niềm vui và hạnh phúc.</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">700.000 đ / bó</p>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative hoa-item">
                        <div class="hoa-img">
                            <img src="img/rose-item-5.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Red Rose</div>
                        <div class="p-4 rounded-bottom">
                            <h4>Ruby Radiance</h4>
                            <p>Sự lấp lánh rực rỡ, nhưng vẫn giữ được vẻ đẹp quý phái và đẳng cấp.</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">350.000 đ / bó</p>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative hoa-item">
<div class="hoa-img">
                            <img src="img/rose-item-6.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Red Rose</div>
                        <div class="p-4 rounded-bottom">
                            <h4>Fiery Kisses</h4>
                            <p>Một biểu tượng của tình yêu mãnh liệt và sự nồng nhiệt bùng cháy như lửa.</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">650.000 đ / bó</p>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                    <div class="border border-primary rounded position-relative hoa-item">
                        <div class="hoa-img">
                            <img src="img/rose-item-7.jpg" class="img-fluid w-100 rounded-top" alt="">
                        </div>
                        <div class="text-white bg-primary px-3 py-1 rounded position-absolute" style="top: 10px; right: 10px;">Red Rose</div>
                        <div class="p-4 rounded-bottom">
                            <h4>Red Petal Love</h4>
                            <p>Một cảm giác ấm áp và gần gũi, như những cánh
                            hoa đỏ thắm nở rộ trong tình yêu.</p>
                            <div class="d-flex justify-content-between flex-lg-wrap">
                                <p class="text-dark fs-5 fw-bold mb-0">450.000 đ / bó</p>
                                <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Thêm vào giỏ</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- hoa Shop End -->
        <!-- Banner Section Start-->
        <style>
            .rounded-circle-text {
            position: absolute;
            width: 140px;
            height: 140px;
            top: 0;
            left: 0;
            background-color: rgba(255, 255, 255, 0.8); /* Màu nền */
            border-radius: 50%; /* Tạo hình tròn */
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .rounded-circle-text h1 {
            font-size: 36px; /* Kích thước của số */
            color: #333; /* Màu sắc của số */
            margin: 0;
        }

        .rounded-circle-text span {
            font-size: 18px; /* Kích thước của văn bản phụ */
            color: #666; /* Màu sắc của văn bản phụ */
        }

        </style>
        <div class="container-fluid banner bg-secondary my-5">
            <div class="container py-5">
                <div class="row g-4 align-items-center">
                    <div class="col-lg-6">
                        <div class="py-4">
                            <h1 class="display-3 text-white">Bộ Sưu Tập</h1>
                            <p class="fw-normal display-3 text-dark mb-4">Hoa Hồng Đỏ</p>
                            <p class="mb-4 text-dark">"Những cánh hoa mềm mại như lụa là cách tự nhiên thể hiện rằng sự hoàn hảo không phải là chuyện hoang đường."</p>
                            <a href="#" class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">Xem Thêm</a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="position-relative">
                        <img src="img/banner-1.jpg" class="img-fluid w-100 rounded" alt="">
                        <div class="rounded-circle-text position-absolute">
                            <h1>1</h1>
                            <div class="d-flex flex-column">
                                <b><span>500.000 đ</span></b>
                                <span class="text-muted">bó</span>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Section End -->
        <div class="container-fluid py-5">
                <div class="container py-5">
                    <div class="text-center mx-auto mb-5" style="max-width: 700px;">
                        <h1 class="display-4">Bestseller</h1>
                        <p>"Khám phá bộ sưu tập tuyệt đẹp của chúng tôi về những loài hoa tinh tế và phổ biến nhất, chắc chắn sẽ làm bừng sáng bất kỳ dịp nào! Từ hoa hồng trang nhã đến hoa hướng dương rực rỡ, bộ sưu tập hoa bán chạy nhất của chúng tôi có đủ loại dành cho mọi sở thích và lễ kỷ niệm. Mang vẻ đẹp và niềm vui vào cuộc sống của bạn với Những cách cắm hoa được tuyển chọn tỉ mỉ của chúng tôi Hãy đặt hàng ngay bây giờ và làm cho ngày của ai đó trở nên đặc biệt với những kho báu hoa đầy mê hoặc này! 🌷💐🌻✨.</p>
                    </div>
                    <div class="row g-4">
                        <div class="col-lg-6 col-xl-4">
                            <div class="p-4 rounded bg-light">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <img src="img/best-product-1.jpg" class="img-fluid rounded-circle w-100 fixed-size" alt="">
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="h5">Hoa Hồng Baby</a>
                                        <div class="d-flex my-3">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mb-3">300.000 đ</h4>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i>Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="p-4 rounded bg-light">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <img src="img/best-product-2.jpg" class="img-fluid rounded-circle w-100 fixed-size" alt="">
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="h5">Hồng Nhạt</a>
                                        <div class="d-flex my-3">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mb-3">250.000 đ</h4>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="p-4 rounded bg-light">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <img src="img/best-product-3.jpg" class="img-fluid rounded-circle w-100 fixed-size" alt="">
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="h5">White Blue Rose</a>
                                        <div class="d-flex my-3">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mb-3">250.000 đ</h4>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="p-4 rounded bg-light">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <img src="img/best-product-4.jpg" class="img-fluid rounded-circle w-100 fixed-size" alt="">
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="h5">Hoa Hồng Đỏ</a>
                                        <div class="d-flex my-3">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mb-3">500.000 đ</h4>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="p-4 rounded bg-light">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <img src="img/best-product-5.jpg" class="img-fluid rounded-circle w-100 fixed-size" alt="">
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="h5">Hồng Đào</a>
                                        <div class="d-flex my-3">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mb-3">600.000 đ</h4>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i>Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-xl-4">
                            <div class="p-4 rounded bg-light">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <img src="img/best-product-6.jpg" class="img-fluid rounded-circle w-100 fixed-size" alt="">
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="h5">Hồng Trắng</a>
                                        <div class="d-flex my-3">
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star text-primary"></i>
                                            <i class="fas fa-star"></i>
                                        </div>
                                        <h4 class="mb-3">400.000 đ</h4>
                                        <a href="#" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i>Xem Chi Tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!-- Review Start -->
        <div class="container-fluid review py-5">
            <div class="container py-5">
                <div class="review-header text-center">
                    <h4 class="text-primary">Đánh Giá Về Cửa Hàng</h4>
                    <h1 class="display-5 mb-5 text-dark">Review Của Khách Hàng</h1>
                </div>
                <div class="owl-carousel review-carousel">
                    <div class="review-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">Hoa rất tươi, đẹp và thơm. Được giao hàng đúng hẹn, dịch vụ chuyên nghiệp. Rất hài lòng với sản phẩm và sẽ quay lại mua tiếp! 🌺🌟👍
                                </p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="img/review-2.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark">Vũ Đức Thịnh</h4>
                                    <p class="m-0 pb-3">Giảng Viên</p>
                                    <div class="d-flex pe-5">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="review-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">Sản phẩm chất lượng cao, vẻ đẹp tinh tế đúng như hình ảnh hiển thị trên website. Quà tặng ý nghĩa cho người thân. Cảm ơn cửa hàng 💐😍👌
                                </p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="img/review-1.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark">Nguyễn Tuấn Kiệt</h4>
                                    <p class="m-0 pb-3">Sinh Viên</p>
                                    <div class="d-flex pe-5">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="review-item img-border-radius bg-light rounded p-4">
                        <div class="position-relative">
                            <i class="fa fa-quote-right fa-2x text-secondary position-absolute" style="bottom: 30px; right: 0;"></i>
                            <div class="mb-4 pb-4 border-bottom border-secondary">
                                <p class="mb-0">Hoa tươi nguyên, đóng gói cẩn thận. Đã là lần thứ 3 đặt hàng ở đây, luôn tự tin vào chất lượng và dịch vụ. Chắc chắn sẽ giới thiệu bạn bè! 🌸🌺👏
                                </p>
                            </div>
                            <div class="d-flex align-items-center flex-nowrap">
                                <div class="bg-secondary rounded">
                                    <img src="img/review-3.jpg" class="img-fluid rounded" style="width: 100px; height: 100px;" alt="">
                                </div>
                                <div class="ms-4 d-block">
                                    <h4 class="text-dark">Nguyễn Thị Thu Hoa</h4>
                                    <p class="m-0 pb-3">Sinh Viên</p>
                                    <div class="d-flex pe-5">
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                        <i class="fas fa-star text-primary"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Review End -->
        <!-- Footer Start -->
        <?php
        include('footer_ad.php');
        ?>
        <!-- Footer End -->       
        
    </body>
</html>