      
      <?php
session_start();
?><!-- Google Web Fonts -->
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

      <!-- Navbar start -->
      <div class="container-fluid fixed-top">
          <div class="container topbar bg-primary d-none d-lg-block">
              <div class="d-flex justify-content-between">
                  <div class="top-info ps-2">
                      <small class="me-3"><i class="fas fa-map-marker-alt me-2 text-secondary"></i> <a href="#" class="text-white">140 Lê Trọng Tấn, Tây Thạnh , Tân Phú ,HCM City</a></small>
                      <small class="me-3"><i class="fas fa-envelope me-2 text-secondary"></i><a href="#" class="text-white">anhthu.thuhoa@gmail.com</a></small>
                  </div>
                  <div class="top-link pe-2">
                      <a href="#" class="text-white"><small class="text-white mx-2">Privacy Policy</small>/</a>
                      <a href="#" class="text-white"><small class="text-white mx-2">Terms of Use</small>/</a>
                      <a href="#" class="text-white"><small class="text-white ms-2">Sales and Refunds</small></a>
                  </div>
              </div>
          </div>
          <div class="container px-0">
              <nav class="navbar navbar-light bg-white navbar-expand-xl">
                  <a href="index.php" class="navbar-brand">
                      <h1 class="text-primary display-6">Flowers.</h1>
                  </a>
                  <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                      <span class="fa fa-bars text-primary"></span>
                  </button>
                  <div class="collapse navbar-collapse bg-white" id="navbarCollapse">
                      <div class="navbar-nav mx-auto">
                          <a href="index.php" class="nav-item nav-link active">Trang Chủ</a>
                          <a href="#" class="nav-item nav-link">Giới Thiệu</a>
                          <div class="nav-item dropdown">
                              <a href="shop_us.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Cửa Hàng</a>
                              <div class="dropdown-menu m-0 bg-secondary rounded-0">
                                  <a href="shop_us.php" class="dropdown-item">Sản phẩm</a>
                                  <a href="checkout.php" class="dropdown-item">Chi Tiết Hoá Đơn</a>
                                  <a href="#" class="dropdown-item">Theo Dõi Đơn Hàng</a>

                              </div>
                          </div>
                          <a href="review.php" class="nav-item nav-link">Review</a>
                          <a href="contact.php" class="nav-item nav-link">Liên hệ</a>
                      </div>
                      <div class="d-flex m-3 me-0">
                          <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white me-4" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search text-primary"></i></button>
                          <a href="ShowCart.php" class="position-relative me-4 my-auto">
                              <i class="fa fa-shopping-bag fa-2x"></i>
                              <span class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1" style="top: -5px; left: 15px; height: 20px; min-width: 20px;">
                              <?php
                              echo isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                              ?></span> <!--Hiển thị số sản phẩm đã thêm vào đơn hàng */-->                                                                                                                                                                                                         
                          </a>
                          
                      </div>
                      <div class="d-flex m-3 me-0">
                   
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-danger btn-md-square rounded-circle dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user-tie"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <!-- <li><a class="dropdown-item" href="#">Xin chào, <?php echo $_SESSION['taikhoan'] ?></a></li> -->
                            <li><a class="dropdown-item" href="#">Xin chào, <?php echo htmlspecialchars(isset($_SESSION['taikhoan']) ? $_SESSION['taikhoan'] : ""); ?></a></li>
                          
                            <?php if (isset($_SESSION['taikhoan'])) { ?>
                                <a  class="dropdown-item" href="logout.php">Đăng Xuất</a>
                          <?php
                            } else {
                            ?>
                              <a  class="dropdown-item" href="login.php">Đăng nhập</a>
                          <?php } ?>
                        
                           
                        </ul>
                    </div>
                    <!-- End of User Dropdown -->
                </div>

                      <div class="d-flex m-3 me-0">
                          <!-- Button Lịch sử mua hàng -->
                          <?php if (isset($_SESSION['taikhoan'])) { ?>
                              <a href="lichsu_muahang.php" class="me-4 my-auto">
                                  <button class="btn btn-primary">Lịch sử mua hàng</button>
                              </a>
                          <?php
                            } else {
                            ?>
                              <a href="tracuu_donhang.php" class="me-4 my-auto">
                                  <button class="btn btn-primary">Tra cứu đơn hàng</button>
                              </a>
                          <?php } ?>
                      </div>
              </nav>
          </div>
      </div>
      <!-- Navbar End -->

      <!-- Modal Search Start -->
      <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-fullscreen">
              <div class="modal-content rounded-0">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                      <button type="button_search" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body d-flex align-items-center">
                      <form action="shop_us.php" method="post" class="input-group w-75 mx-auto d-flex">
                          <input type="text" name="timKiem" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                          <button name="tim_theo_ten" type="submit" id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      <!-- Modal Search End -->