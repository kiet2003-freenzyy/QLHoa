<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Flowers-Website_Product</title>
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
</head>

<body>
    <?php
    include("Database.php");
   
    $database = new Database();
    $pdo = $database->connect();
   
    function generate_ma_hoa($pdo)
    {
        $sql2 = "SELECT MAX(ma_hoa) AS max_ma_hoa FROM ds_hoa";
        $stmt = $pdo->query($sql2);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $max_ma_hoa = $row['max_ma_hoa'];
        $last_id = intval(substr($max_ma_hoa, 3));
        $new_id = $last_id + 1;
        return "HOA" . str_pad($new_id, 3, "0", STR_PAD_LEFT);
    }

    $ma_hoa = $ma_cd = $ten_hoa = $noidung = $gia = $gia_khuyenmai = $khuyenmai = $hinh = "";
    $isEditing = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['btn_Save'])) {
            $ma_hoa = generate_ma_hoa($pdo);
            $ma_cd = $_POST['ma_cd'];
            $ten_hoa = $_POST['ten_hoa'];
            $noidung = $_POST['noidung'];
            $gia = $_POST['gia'];
            $gia_khuyenmai = $_POST['gia_khuyenmai'];
            $khuyenmai = $_POST['khuyenmai'];
            $hinh = $_FILES['hinh']['name'];
            $target = "images/".basename($hinh);

            $sql1 = "INSERT INTO Ds_hoa(ma_hoa, ma_cd, ten_hoa, noidung, gia, gia_khuyenmai, khuyenmai, hinh) 
                     VALUES (:ma_hoa, :ma_cd, :ten_hoa, :noidung, :gia, :gia_khuyenmai, :khuyenmai, :hinh)";
            $stmt = $pdo->prepare($sql1);
            $stmt->execute([
                ':ma_hoa' => $ma_hoa,
                ':ma_cd' => $ma_cd,
                ':ten_hoa' => $ten_hoa,
                ':noidung' => $noidung,
                ':gia' => $gia,
                ':gia_khuyenmai' => $gia_khuyenmai,
                ':khuyenmai' => $khuyenmai,
                ':hinh' => $hinh
            ]);

            if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }
        } elseif (isset($_POST['btn_Update'])) {
            $ma_hoa = $_POST['ma_hoa'];
            $ma_cd = $_POST['ma_cd'];
            $ten_hoa = $_POST['ten_hoa'];
            $noidung = $_POST['noidung'];
            $gia = $_POST['gia'];
            $gia_khuyenmai = $_POST['gia_khuyenmai'];
            $khuyenmai = $_POST['khuyenmai'];
            $hinh = $_FILES['hinh']['name'];
            $target = "images/".basename($hinh);

            $sql1 = "UPDATE Ds_hoa SET ma_cd=:ma_cd, ten_hoa=:ten_hoa, noidung=:noidung, gia=:gia, gia_khuyenmai=:gia_khuyenmai, khuyenmai=:khuyenmai, hinh=:hinh 
                     WHERE ma_hoa=:ma_hoa";
            $stmt = $pdo->prepare($sql1);
            $stmt->execute([
                ':ma_hoa' => $ma_hoa,
                ':ma_cd' => $ma_cd,
                ':ten_hoa' => $ten_hoa,
                ':noidung' => $noidung,
                ':gia' => $gia,
                ':gia_khuyenmai' => $gia_khuyenmai,
                ':khuyenmai' => $khuyenmai,
                ':hinh' => $hinh
            ]);

            if (move_uploaded_file($_FILES['hinh']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }
        }
    }

    if (isset($_GET['edit_id'])) {
        $ma_hoa = $_GET['edit_id'];
        $sql = "SELECT * FROM Ds_hoa WHERE ma_hoa = :ma_hoa";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ma_hoa' => $ma_hoa]);
        $hoa = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($hoa) {
            $ma_cd = $hoa['ma_cd'];
            $ten_hoa = $hoa['ten_hoa'];
            $noidung = $hoa['noidung'];
            $gia = $hoa['gia'];
            $gia_khuyenmai = $hoa['gia_khuyenmai'];
            $khuyenmai = $hoa['khuyenmai'];
            $hinh = $hoa['hinh'];
            $isEditing = true;
        }
    }

    if (isset($_GET['add_new'])) {
        $ma_hoa = $ma_cd = $ten_hoa = $noidung = $gia = $gia_khuyenmai = $khuyenmai = $hinh = "";
        $isEditing = false;
    }

    if (isset($_GET['delete_id'])) {
        $ma_hoa = $_GET['delete_id'];
        $sql = "DELETE FROM Ds_hoa WHERE ma_hoa = :ma_hoa";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ma_hoa' => $ma_hoa]);
    }
    ?>

    <?php 
        include 'header_ad.php'
    ?>

    <!-- Product Form and List -->
    <div class="container center py-5"   style="margin-top: 6%;" id="registration-container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="bg-primary p-5">
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0" placeholder="Mã chủ đề" name="ma_cd" value="<?php echo htmlspecialchars($ma_cd); ?>">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0" placeholder="Tên hoa" name="ten_hoa" value="<?php echo htmlspecialchars($ten_hoa); ?>">
                            </div>
                            <div class="col-12">
                                <textarea class="form-control bg-light border-0" placeholder="Nội dung" name="noidung"><?php echo htmlspecialchars($noidung); ?></textarea>
                            </div>
                            <div class="col-12">
                                <input type="number" class="form-control bg-light border-0" placeholder="Giá" name="gia" value="<?php echo htmlspecialchars($gia); ?>">
                            </div>
                            <div class="col-12">
                                <input type="number" class="form-control bg-light border-0" placeholder="Giá khuyến mãi" name="gia_khuyenmai" value="<?php echo htmlspecialchars($gia_khuyenmai); ?>">
                            </div>
                            <div class="col-12">
                                <input type="text" class="form-control bg-light border-0" placeholder="Khuyến mãi" name="khuyenmai" value="<?php echo htmlspecialchars($khuyenmai); ?>">
                            </div>
                            <div class="col-12">
                                <input type="file" class="form-control bg-light border-0" name="hinh">
                            </div>
                            <div class="col-12">
                                <?php if ($isEditing) : ?>
                                    <input type="hidden" name="ma_hoa" value="<?php echo htmlspecialchars($ma_hoa); ?>">
                                    <button class="btn btn-secondary w-100 py-3" type="submit" name="btn_Update">Cập nhật</button>
                                <?php else : ?>
                                    <button class="btn btn-secondary w-100 py-3" type="submit" name="btn_Save">Lưu</button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Product List -->
                <div class="bg-light p-5 mt-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Mã hoa</th>
                                <th scope="col">Mã chủ đề</th>
                                <th scope="col">Tên hoa</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Giá khuyến mãi</th>
                                <th scope="col">Khuyến mãi</th>
                                <th scope="col">Hình</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM ds_hoa";
                            $stmt = $pdo->query($sql);
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['ma_hoa']); ?></td>
                                    <td><?php echo htmlspecialchars($row['ma_cd']); ?></td>
                                    <td><?php echo htmlspecialchars($row['ten_hoa']); ?></td>
                                    <td><?php echo htmlspecialchars($row['noidung']); ?></td>
                                    <td><?php echo htmlspecialchars($row['gia']); ?></td>
                                    <td><?php echo htmlspecialchars($row['gia_khuyenmai']); ?></td>
                                    <td><?php echo htmlspecialchars($row['khuyenmai']); ?></td>
                                    <td><img src="img/<?php echo htmlspecialchars($row['hinh']); ?>" alt="<?php echo htmlspecialchars($row['ten_hoa']); ?>" width="50"></td>
                                    <td>
                                        <a href="ds_sanpham.php?edit_id=<?php echo htmlspecialchars($row['ma_hoa']); ?>" class="btn btn-sm btn-primary">Sửa</a>
                                        <a href="ds_sanpham.php?delete_id=<?php echo htmlspecialchars($row['ma_hoa']); ?>" class="btn btn-sm btn-danger">Xóa</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                    <a href="ds_sanpham.php?add_new=true" class="btn btn-success">Thêm mới</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light mt-5 py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-md-6 col-lg-4">
                    <h5 class="text-light mb-4">Address</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                    <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                        <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <h5 class="text-light mb-4">Instagram</h5>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-1.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-2.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-3.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-4.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-5.jpg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/portfolio-6.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-dark text-light border-top border-secondary py-4">
            <div class="container">
                <div class="row g-5">
                    <div class="col-md-6 text-center text-md-start">
                        <p class="mb-md-0">&copy; <a class="text-primary" href="#">Your Site Name</a>. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">Designed by <a class="text-primary" href="https://htmlcodex.com">HTML Codex</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>


    
</body>

</html>
