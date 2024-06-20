<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Flowers-Website_Tra Cứu</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
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

    // Xóa hóa đơn
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

    // Tìm hóa đơn của Khach hàng
    $donhang = [];
    if (isset($_GET['txt_Search']) && isset($_GET['txt_Sdt'])) {
        $ma_kh = $_GET['txt_Search'];
        $sdt = $_GET['txt_Sdt'];

        // Kiểm tra số điện thoại
        $sql_check_sdt = "SELECT * FROM ds_kh WHERE ma_kh = :ma_kh AND sdt_kh = :sdt";
        $stmt_check_sdt = $pdo->prepare($sql_check_sdt);
        $stmt_check_sdt->execute([':ma_kh' => $ma_kh, ':sdt' => $sdt]);

        if ($stmt_check_sdt->rowCount() > 0) {
            $sql4 = "SELECT * FROM hoa_don WHERE ma_kh LIKE :ma_kh";
            $stmt = $pdo->prepare($sql4);
            $searchTerm = "%" . $ma_kh . "%";
            $stmt->bindParam(':ma_kh', $searchTerm, PDO::PARAM_STR);
            $stmt->execute();
            $donhang = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $error_message = "Số điện thoại không đúng hoặc sai mã khách hàng!";
        }
    }
    include('header_cus.php');
    ?>
    <div class="container center py-5" id="registration-container">
        
    </div>
    <!-- Customer Form and List -->
    <div class="container center py-5" id="registration-container" style="margin-top: 6%">
        <div class="row justify-content-center">
        <form method="get" action="tracuu_donhang.php" class="col-11">
        <div class="form-row">
            <div class="col-md-4 mb-3">
                <input class="form-control" type="text" placeholder="Mã khách hàng" aria-label="Search" name="txt_Search">
            </div>
            <div class="col-md-4 mb-3 d-flex">
                <input class="form-control me-2" type="text" placeholder="Số điện thoại" aria-label="Search" name="txt_Sdt">
                <button class="btn-search btn border border-secondary btn-md-square rounded-circle bg-white" data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="fas fa-search text-primary"></i>
                </button>
            </div>
            <div class="col-md-4 mb-3">
                <!-- Nội dung khác nếu có -->
            </div>
        </div>
    </form>
        </div>
        <div class="row justify-content-center">
            <?php if (isset($error_message)) : ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
            <?php endif; ?>
        </div>
        <!-- Displaying customers -->
        <div class="col-lg-12 col-md-12 mt-4">
            <h2 class="text-center">Danh sách Hóa đơn</h2>
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
                            <th>Feedback</th>
                            <th>Mã nhân viên</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($donhang)) {
                            foreach ($donhang as $row) {
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
                                echo "<a href='xemchitiet_kh.php?ma_hd=" . htmlspecialchars($row['ma_hd']) . "' class='btn btn-light btn-sm'>Chi tiết</a> ";
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Customer Form and List -->
                        <?php 
                        include('footer_ad.php');?>
    <!-- Back to Top -->
    <a href="#" class="btn btn-secondary py-3 fs-4 back-to-top"><i class="fas fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>