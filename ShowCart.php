<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8">
        <title>Flowers - Giỏ Hàng</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

        <!-- Icon Font Stylesheet -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
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
<?php
include('cart.php');
?>
    <body>
    <?php
include('show-detail.php');
?>
<?php
    include('header_cus.php');
?>


        <!-- Single Page Header start -->
        <div class="container-fluid page-header py-5">
            <h1 class="text-center text-white display-6">Giỏ</h1>
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a href="index.php">Trang Chủ</a></li>
                <li class="breadcrumb-item active text-red">Giỏ Hàng</li>
            </ol>
        </div>
        <!-- Single Page Header End -->


        <!-- Cart Page Start -->
        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="table-responsive">
                <?php if (empty($_SESSION['cart'])) { ?>
                    <table class="table">
                        <tr>
                            <td>
                                <p>Không có sản phẩm nào trong giỏ hàng. Đến cửa hàng để thêm sản phẩm<a href="shop_us.php" class="btn border border-secondary rounded-pill px-3 text-primary"><i class="fa fa-shopping-bag me-2 text-primary"></i> </a></p>
                            </td>
                        </tr>
                    </table>
                <?php
                } ?>
                <?php if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) { ?>
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">Sản phẩm</th>
                            <th scope="col">Tên</th>
                            <th scope="col">Giá</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Thành tiền</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php
                            $totalCounter = 0;
                            $itemCounter = 0;
                            $count = count($_SESSION['cart']);
                            for ($i = 0; $i < $count; $i++) {
                                $item = $_SESSION['cart'][$i];
                                //foreach($_SESSION['cart'] as $key => $item){
                                $imgUrl = "img/" . $item["hinh"];
                                $total = (float)$item["Gia"] * (int)$item["sl"];
                                $_SESSION["totalCounter"] = $totalCounter += $total;
                                $itemCounter += intval($item["sl"]);
                            ?>
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo $imgUrl ?>" class="img-fluid me-5 rounded-circle" style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $item['tenHoa']; ?></p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $item['Gia']; ?>đ</p>
                                </td>
                                <td>
                                <form action="ShowCart.php" method="get">
                                            <input type="hidden" name="updateId" value="<?php echo $i ?>">
                                            <input type="number" name="num_sl" class="cart-qty-single" data-item="<?php echo $key ?>" value="<?php echo $item['sl']; ?>" min="1" max="1000">
                                            <button type="submit" class="text-primary"><i class="bi bi-pencil-square"></i></button>


                                        </form>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4"><?php echo $total; ?>đ</p>
                                </td>
                                <td>
                                <a href="ShowCart.php?delId=<?php echo $i ?>" class="text-danger">
                                            <i class="bi bi-trash-fill"></i>
                                        </a>
                                </td>
                            
                            </tr>
                            <?php } ?>
                            <tr class="border-top border-bottom">
                                <td><a class="btn btn-danger btn-sm" href="ShowCart.php?emptyCart=1">Clear Cart</a></td>
                                <td></td>
                                <td>
                                    <strong>
                                        <?php
                                        echo ($itemCounter == 1) ? $itemCounter . ' item' : $itemCounter . ' items'; ?>
                                    </strong>
                                </td>
                                <td><strong><?php echo $totalCounter; ?>đ</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">
                    <input type="text" class="border-0 border-bottom rounded me-5 py-3 mb-4" placeholder="Mã Code">
                    <button class="btn border-secondary rounded-pill px-4 py-3 text-primary" type="button">Apply</button>
                </div>
                <div class="row g-4 justify-content-end">
                    <div class="col-8"></div>
                    <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                        <div class="bg-light rounded">
                            <div class="p-4">
                                <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                                <div class="d-flex justify-content-between mb-4">
                                    <h5 class="mb-0 me-4">Tổng thu:</h5>
                                    <p class="mb-0"><?php echo $total; ?>đ</p>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <h5 class="mb-0 me-4">Shipping</h5>
                                    <div class="">
                                        <p class="mb-0 text-end">Miễn Phí Vận Chuyển</p>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                                <h5 class="mb-0 ps-4 me-4">Tổng tiền:</h5>
                                <p class="mb-0 pe-4"><?php echo $total; ?>đ</p>
                            </div>
                            <a href="checkout.php"><button class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4" type="button">Proceed Checkout</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
        <!-- Cart Page End -->
        <!-- Back to Top -->
        <a href="#" class="btn btn-primary border-3 border-primary rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>   

        
    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    </body>

</html>