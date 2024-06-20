<!DOCTYPE html>
<html lang="en">
<?php
session_start();
// ĐỌC DỮ LIỆU TỪ TABLE chude_hoa - Khai báo biến đối tượng PDO kết nối CSDL
$pdo = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo->query("set names utf8");

$sql = "SELECT ma_cd, ten_cd, mo_ta FROM chude_hoa";
$loai_hoa = $pdo->query($sql);

$pdo = null;

// ĐỌC DỮ LIỆU TỪ TABLE ds_hoa - Khai báo biến đối tượng PDO kết nối CSDL
$pdo1 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo1->query("set names utf8");

$sql1 = "SELECT * FROM ds_hoa";
$hoa_dep = $pdo1->query($sql1);
$pdo1 = null;

// Món Theo Loại
$pdo2 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo2->query("set names utf8");

if (isset($_GET['ml'])) {
    if ($_GET["ml"] == NULL) {
        $ml = 0; // show all
    } else {
        $ml = $_GET["ml"];
    }

    if ($ml == 0) {
        $sql2 = "SELECT * FROM ds_hoa";
        $hoa_dep2 = $pdo2->query($sql2);
    } else {
        $sql2 = "SELECT * FROM ds_hoa WHERE ma_cd = :ml";
        $stmt = $pdo2->prepare($sql2);
        $stmt->bindParam(':ml', $ml, PDO::PARAM_STR); // Sử dụng PDO::PARAM_STR nếu ma_cd là chuỗi
        $stmt->execute();
        $hoa_dep2 = $stmt;
    }
}

// Món theo Giá
$pdo3 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo3->query("set names utf8");
if (isset($_GET['gt']) && isset($_GET['gc'])) {
    $gt = $_GET['gt'];
    $gc = $_GET['gc'];
    if ($gt == 0 && $gc == 0) {
        $sql3 = "SELECT * FROM ds_hoa";
    } else {
        $sql3 = "SELECT * FROM ds_hoa WHERE gia > :gt AND gia <= :gc";
        $stmt = $pdo3->prepare($sql3);
        $stmt->bindParam(':gt', $gt, PDO::PARAM_INT);
        $stmt->bindParam(':gc', $gc, PDO::PARAM_INT);
        $stmt->execute();
        $hoa_dep3 = $stmt;
    }
    $pdo3 = null;
}

// Tìm kiếm theo tên
$pdo4 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo4->query("set names utf8");
if (isset($_GET['txt_Search'])) {
    $Ten = $_GET["txt_Search"];
    $sql4 = "SELECT * FROM ds_hoa WHERE ten_hoa LIKE :Ten";
    $stmt = $pdo4->prepare($sql4);
    $searchTerm = "%" . $Ten . "%";
    $stmt->bindParam(':Ten', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $hoa_dep4 = $stmt;
    $pdo4 = null;
}

// Chi Tiết hoa
$pdo5 = new PDO("mysql:host=localhost;dbname=ql_hoa", "root", "");
$pdo5->query("set names utf8");
if (isset($_GET['id'])) {
    $maMon = $_GET["id"];
    $sql5 = "SELECT ds_hoa.*, ten_cd FROM ds_hoa, chude_hoa WHERE ds_hoa.ma_cd = chude_hoa.ma_cd and ma_hoa = :maMon";
    $stmt = $pdo5->prepare($sql5);
    $stmt->bindParam(':maMon', $maMon, PDO::PARAM_STR);
    $stmt->execute();
    $hoadep = $stmt;
    $pdo5 = null;
}
?>

<head>
    <meta charset="utf-8">
    <title>Flowers-Website_Chi Tiết Cửa Hàng</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <style>
        /* Ẩn các phím tăng giảm trong input kiểu số */
        input#productQty::-webkit-inner-spin-button,
        input#productQty::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input#productQty {
            -moz-appearance: textfield;
            /* Firefox */
        }
    </style>
</head>

<body>

    <?php
    include 'header_cus.php';
    ?>
    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">Chi Tiết Sản Phẩm</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Trang Chủ</a></li>
            <li class="breadcrumb-item"><a href="shop_us.php">Sản Phẩm</a></li>
            <li class="breadcrumb-item active text-white">Chi Tiết Sản Phẩm</li>
        </ol>
    </div>
    <!-- Single Page Header End -->


    <!-- Single Product Start -->
    <div class="container-fluid py-5 mt-5">
        <div class="container py-5">
            <div class="row g-4 mb-5">
                <div class="col-lg-8 col-xl-9">
                    <div class="row g-4">
                        <?php
                        if (isset($hoadep)) {
                            foreach ($hoadep as $h) {
                                $gia = $h['gia_khuyenmai'];
                                if (empty($h['gia_khuyenmai']))
                                    $gia = $h['gia'];
                        ?>
                                <div class="col-lg-6">
                                    <div class="border rounded">
                                        <a href="#">
                                            <img src="img/<?php echo $h['hinh']; ?>" class="img-fluid rounded" alt="Image">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <h4 class="fw-bold mb-3"><?php echo $h['ten_hoa']; ?></h4>
                                    <p class="mb-3">Loại: <?php echo $h['ten_cd']; ?></p>
                                    <h5 class="fw-bold mb-3"><?php echo $gia . " đ "; ?></h5>
                                    <div class="d-flex mb-4">
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star text-secondary"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p class="mb-4"><?php echo $h['noidung']; ?></p>
                                    <form class="form-inline" method="POST" action="ShowCart.php">
                                        <input type="hidden" name="maHoa" value="<?php echo $h['ma_hoa']; ?>">
                                        <input type="hidden" name="hinh" value="<?php echo $h['hinh']; ?>">
                                        <input type="hidden" name="tenHoa" value="<?php echo $h['ten_hoa']; ?>">
                                        <input type="hidden" name="Gia" value="<?php echo $gia ?>">
                                        <input type="hidden" name="GiaKM" value="<?php echo $h['gia_khuyenmai']; ?>">
                                        <div class="input-group quantity mb-5" style="width: 100px;">
                                            <div class="input-group-btn">
                                                <button type="button" class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="number" name="sl" id="productQty" class="form-control form-control-sm text-center border-0" min="1" max="1000" value="1">
                                            <div class="input-group-btn">


                                                <button type="button" class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn border border-secondary rounded-pill px-4 py-2 mb-4 text-primary" name="add_to_cart" value="add to cart">
                                            <i class="fa fa-shopping-bag me-2 text-primary"></i> Đặt Hàng
                                        </button>
                                    </form>
                                </div>

                                <div class="col-lg-12">
                                    <nav>
                                        <div class="nav nav-tabs mb-3">
                                            <button class="nav-link active border-white border-bottom-0" type="button" role="tab" id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about" aria-controls="nav-about" aria-selected="true">Mô Tả Sản Phẩm</button>
                                            <button class="nav-link border-white border-bottom-0" type="button" role="tab" id="nav-mission-tab" data-bs-toggle="tab" data-bs-target="#nav-mission" aria-controls="nav-mission" aria-selected="false">Feed Back</button>
                                        </div>
                                    </nav>
                                    <div class="tab-content mb-5">
                                        <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                            <p>Hoa hồng đỏ là biểu tượng của tình yêu và sự lãng mạn. Với màu sắc đỏ rực rỡ, hoa hồng không chỉ là một món quà ý nghĩa mà còn thể hiện sự đẹp đẽ và sự quý phái. </p>
                                            <p> Sản phẩm này có giá 270.000 đồng và thích hợp để biếu tặng trong những dịp đặc biệt như Valentine, kỷ niệm ngày cưới, hoặc để thể hiện tình cảm sâu lắng đối với người thân yêu.</p>
                                            <div class="px-2">
                                                <div class="row g-4">
                                                    <div class="col-6">
                                                        <div class="row bg-light align-items-center text-center justify-content-center py-2">
                                                            <div class="col-6">
                                                                <p class="mb-0">Cân nặng</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="mb-0">600gram</p>
                                                            </div>
                                                        </div>
                                                        <div class="row text-center align-items-center justify-content-center py-2">
                                                            <div class="col-6">
                                                                <p class="mb-0">Nguồn Gốc</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="mb-0">Đà Lạt</p>
                                                            </div>
                                                        </div>
                                                        <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                            <div class="col-6">
                                                                <p class="mb-0">Tình Trạng</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="mb-0">Hoa Tươi</p>
                                                            </div>
                                                        </div>
                                                        <div class="row bg-light text-center align-items-center justify-content-center py-2">
                                                            <div class="col-6">
                                                                <p class="mb-0">Max Số Lượng Hoa</p>
                                                            </div>
                                                            <div class="col-6">
                                                                <p class="mb-0">100 Bông</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="nav-mission" role="tabpanel" aria-labelledby="nav-mission-tab">
                                            <div class="d-flex">
                                                <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                                <div class="">
                                                    <p class="mb-2" style="font-size: 14px;">April 30, 2024</p>
                                                    <div class="d-flex justify-content-between">
                                                        <h5>Jason Smith</h5>
                                                        <div class="d-flex mb-3">
                                                            <i class="fa fa-star text-secondary"></i>
                                                            <i class="fa fa-star text-secondary"></i>
                                                            <i class="fa fa-star text-secondary"></i>
                                                            <i class="fa fa-star text-secondary"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p>Hoa rất đẹp và tươi, rất hài lòng với sản phẩm này. </p>
                                                </div>
                                            </div>
                                            <div class="d-flex">
                                                <img src="img/avatar.jpg" class="img-fluid rounded-circle p-3" style="width: 100px; height: 100px;" alt="">
                                                <div class="">
                                                    <p class="mb-2" style="font-size: 14px;">April 12, 2024</p>
                                                    <div class="d-flex justify-content-between">
                                                        <h5>Sam Peters</h5>
                                                        <div class="d-flex mb-3">
                                                            <i class="fa fa-star text-secondary"></i>
                                                            <i class="fa fa-star text-secondary"></i>
                                                            <i class="fa fa-star text-secondary"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p class="text-dark">Giao hàng nhanh chóng và chất lượng sản phẩm tốt. Sẽ mua lại trong tương lai. </p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane" id="nav-vision" role="tabpanel">
                                            <p class="text-dark">Tempor erat elitr rebum at clita. Diam dolor diam ipsum et tempor sit. Aliqu diam
                                                amet diam et eos labore. 3</p>
                                            <p class="mb-0">Diam dolor diam ipsum et tempor sit. Aliqu diam amet diam et eos labore.
                                                Clita erat ipsum et lorem et sit</p>
                                        </div>
                                    </div>
                                </div>
                                <form action="#">
                                    <h4 class="mb-5 fw-bold">Lời Nhắn</h4>
                                    <div class="row g-4">
                                        <div class="col-lg-6">
                                            <div class="border-bottom rounded">
                                                <input type="text" class="form-control border-0 me-4" placeholder="Tên của bạn? *">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="border-bottom rounded">
                                                <input type="email" class="form-control border-0" placeholder="Email *">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="border-bottom rounded my-4">
                                                <textarea name="" id="" class="form-control border-0" cols="30" rows="8" placeholder="Đánh giá của bạn về cửa hàng của chúng tôi *" spellcheck="false"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex justify-content-between py-3 mb-5">
                                                <div class="d-flex align-items-center">
                                                    <p class="mb-0 me-3">Chất Lượng:</p>
                                                    <div class="d-flex align-items-center" style="font-size: 12px;">
                                                        <i class="fa fa-star text-muted"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                </div>
                                                <a href="#" class="btn border border-secondary text-primary rounded-pill px-4 py-3"> Đăng Comment</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        <?php }
                        } ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- Single Product End -->


    <!-- Footer Start -->
    <?php
    include('footer_ad.php');
    ?>
    <!-- Footer End -->

    <!-- Copyright Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i class="fas fa-copyright text-light me-2"></i>Your Site Name</a>, All right reserved.</span>
                </div>
                <div class="col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author’s credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author’s credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a> Distributed By <a class="border-bottom" href="https://themewagon.com">ThemeWagon</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Copyright End -->



    <!-- Back to Top -->
    <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>


    <script>
        function addToCart() {
            // Lấy giá trị số lượng từ input
            var quantity = document.getElementById('productQty').value;

            // Cập nhật số lượng trong form
            document.getElementsByName('sl')[0].value = quantity;

            // Submit form
            document.forms[0].submit();
        }

        // Xử lý sự kiện tăng giảm số lượng
        document.querySelector('.btn-minus').addEventListener('click', function() {
            var input = document.getElementById('productQty');
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 1 : value;
            value--;
            input.value = value < 1 ? 1 : value;
        });

        document.querySelector('.btn-plus').addEventListener('click', function() {
            var input = document.getElementById('productQty');
            var value = parseInt(input.value, 10);
            value = isNaN(value) ? 1 : value;
            value++;
            input.value = value;
        });
    </script>
</body>


</html>