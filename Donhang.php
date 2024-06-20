<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Đơn Hàng</title>
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
            width: 200px;
            /* Chiều rộng cố định */
            height: 200px;
            /* Chiều cao cố định */
            object-fit: cover;
            /* Giữ tỉ lệ ảnh */
        }
    </style>


</head>

<body>
    <?php

    include("Database.php");
    $database = new Database();
    $pdo = $database->connect();
    session_start();
    if (isset($_GET['delete_hd_id'])) {
        $ma_hd = $_GET['delete_hd_id'];
        $sql2 = "DELETE FROM hoadon_hoa WHERE ma_hd = :ma_hd";
        $stmt2 = $pdo->prepare($sql2);
        $stmt2->execute([':ma_hd' => $ma_hd]);

        $sql1 = "DELETE FROM chitiet_hoadon WHERE ma_hd = :ma_hd";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([':ma_hd' => $ma_hd]);

        $sql = "DELETE FROM hoa_don WHERE ma_hd = :ma_hd";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':ma_hd' => $ma_hd]);
    }

    //Tìm hóa đơn của Khach hàng
    if (isset($_GET['txt_Search'])) {

        $Ten = $_GET["txt_Search"];
        $sql4 = "SELECT * FROM hoa_don WHERE ma_kh LIKE :Ten";
        $stmt = $pdo->prepare($sql4);
        $searchTerm = "%" . $Ten . "%";
        $stmt->bindParam(':Ten', $searchTerm, PDO::PARAM_STR);
        $stmt->execute();
        $donhang = $stmt;
    } else {
        $sql = "SELECT * FROM hoa_don";
        $donhang = $pdo->query($sql);
    }
    //lọc hóa đơn 
    if (isset($_GET['status_filter'])) {
        $Ten = $_GET["status_filter"];
        if ($Ten == "Đã giao") {
            $sql4 = "SELECT * FROM hoa_don WHERE trangthai_hd LIKE :Ten";
            $stmt = $pdo->prepare($sql4);
            $Tentim = "Đã giao";
            $stmt->bindParam(':Ten', $Tentim, PDO::PARAM_STR);
            $stmt->execute();
            $donhang = $stmt;
        } else if ($Ten == "Chưa giao") {
            $sql4 = "SELECT * FROM hoa_don WHERE trangthai_hd LIKE :Ten";
            $stmt = $pdo->prepare($sql4);
            $Tentim = "Đang xử lý";
            $stmt->bindParam(':Ten', $Tentim, PDO::PARAM_STR);
            $stmt->execute();
            $donhang = $stmt;
        } else {
            $sql = "SELECT * FROM hoa_don";
            $donhang = $pdo->query($sql);
        }
    }
    ?>
    <?php
    include 'header_ad.php'
    ?>
    <!-- Customer Form and List -->
    <div class="container center py-5" style="margin-top: 6%;"  id="registration-container">
        <div class="row justify-content-center">
            <!-- Nút lọc-->
            <div class="form-group">
                <label for="status_filter">Trạng Thái Đơn</label>
                <form method="get" action="donhang.php">
                    <select type="get" class="form-control" id="status_filter" name="status_filter">
                        <option value="">Tất cả</option>
                        <option value="Đã giao">Đã Giao</option>
                        <option value="Chưa giao">Chưa giao</option>

                    </select>

                    <button href="HD_Shipper.php" type="submit" class="btn btn-primary mt-2">Lọc</button>
                </form>


            </div>

            <form method="get" action="donhang.php">
                <div class="col-11">
                    <input class="form-control mr-2 w-25" type="text" placeholder="Search" aria-label="Search" name="txt_Search">

                    <button class="btn btn-outline-dark" style="margin-right:20px;" name="btn_Search">Search</button>



            </form>

            <!-- Displaying customers có đơn -->
            <div class="col-lg-12 col-md-12 mt-4">
                <h2 class="text-center">Danh Sách Đơn Hàng</h2>
                <div class="bg-primary p-5">
                    <table class="table table-hover text-light">
                        <thead>
                            <tr>
                                <th>Mã đơn hàng</th>
                                <th>Mã khách hàng</th>
                                <th>Tên người nhận</th>
                                <th>Địa chỉ</th>
                                <th>Điện Thoại</th>
                                <th>Tổng tiền</th>
                                <th>Trạng thái giao hàng</th>
                                <th>feedback</th>
                                <th>Mã nhân viên</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <style>
                                .btn-custom-light {
                                    background-color: white !important;
                                    /* Đặt màu nền trắng */
                                    color: black;
                                    /* Đặt màu chữ đen để dễ nhìn */
                                }
                            </style>
                            <?php
                            $sql3 = "SELECT * FROM ds_kh";
                            $stmt = $pdo->query($sql3);
                            while ($row = $donhang->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['ma_hd']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ma_kh']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ten_nguoinhan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['diachi_nguoinhan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['sdt_nguoinhan']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['tong_tien']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['trangthai_hd']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['feedback']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['ma_nv']) . "</td>";
                                echo "<td>";

                                echo "<a href='edit_hoadon.php?ma_hd=" . htmlspecialchars($row['ma_hd']) . "' class='btn btn-light btn-sm'\"><i class='fa-solid fa-user-pen'></i></a> ";
                                echo "<a href='Donhang.php?delete_id=" . htmlspecialchars($row['ma_hd']) . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Chắc chắn muốn xoá đơn của khách hàng này?');\"><i class='fa-solid fa-trash-can'></i></a>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
    <!-- Đơn Hàng Form and List -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="fas fa-arrow-up"></i></a>



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